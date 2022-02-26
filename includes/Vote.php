<?php
/**
 * Vote class - class for handling vote-related functions (counting
 * the average score of a given page, inserting/updating/removing a vote etc.)
 *
 * @file
 * @ingroup Extensions
 */

use MediaWiki\MediaWikiServices;
use Wikimedia\Rdbms\Database;

class Vote {
	/** @var int */
	public $PageID = 0;
	/** @var User */
	public $User;

	/**
	 * Constructor
	 *
	 * @param int $pageID Article ID number
	 * @param User $user
	 */
	public function __construct( $pageID, User $user ) {
		$this->PageID = $pageID;
		$this->User = $user;
	}

	/**
	 * Counts all votes, fetching the data from memcached if available
	 * or from the database if memcached isn't available
	 *
	 * @return int Amount of votes
	 */
	function count() {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		$fname = __METHOD__;

		return $cache->getWithSetCallback(
			$cache->makeKey( 'vote-count', $this->PageID ),
			$cache::TTL_WEEK,
			function ( $oldValue, &$ttl, &$setOpts ) use ( $fname ) {
				$dbr = wfGetDB( DB_REPLICA );
				$setOpts += Database::getCacheSetOptions( $dbr );

				return (int)$dbr->selectField(
					'Vote',
					'COUNT(*) AS votecount',
					[ 'vote_page_id' => $this->PageID ],
					$fname
				);
			}
		);
	}

	/**
	 * Gets the average score of all votes
	 *
	 * @return string Formatted average number of votes (something like 3.50)
	 */
	function getAverageVote() {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		$fname = __METHOD__;

		$voteAvg = $cache->getWithSetCallback(
			$cache->makeKey( 'vote-avg', $this->PageID ),
			$cache::TTL_WEEK,
			function ( $oldValue, &$ttl, &$setOpts ) use ( $fname ) {
				$dbr = wfGetDB( DB_REPLICA );
				$setOpts += Database::getCacheSetOptions( $dbr );

				return (float)$dbr->selectField(
					'Vote',
					'AVG(vote_value)',
					[ 'vote_page_id' => $this->PageID ],
					$fname
				);
			}
		);

		return number_format( $voteAvg, 2 );
	}

	/**
	 * Clear caches - memcached, parser cache and Squid cache
	 */
	function clearCache() {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();

		// Kill internal cache
		$cache->delete( $cache->makeKey( 'vote-count', $this->PageID ) );
		$cache->delete( $cache->makeKey( 'vote-avg', $this->PageID ) );

		// Purge squid
		$pageTitle = Title::newFromID( $this->PageID );
		if ( is_object( $pageTitle ) ) {
			// Invalidate page caches (including parser cache)
			$pageTitle->invalidateCache();
			$pageTitle->purgeSquid();
		}
	}

	/**
	 * Delete the user's vote from the database, purges normal caches and
	 * updates SocialProfile's statistics, if SocialProfile is active.
	 */
	function delete() {
		$dbw = wfGetDB( DB_PRIMARY );

		$dbw->delete(
			'Vote',
			[
				'vote_page_id' => $this->PageID,
				'vote_actor' => $this->User->getActorId()
			],
			__METHOD__
		);

		$this->clearCache();

		// Update social statistics if SocialProfile extension is enabled
		if ( class_exists( 'UserStatsTrack' ) ) {
			$stats = new UserStatsTrack( $this->User->getId(), $this->User->getName() );
			$stats->decStatField( 'vote' );
		}
	}

	/**
	 * Inserts a new vote into the Vote database table
	 *
	 * @param int $voteValue
	 */
	function insert( $voteValue ) {
		global $wgRequest;

		$dbw = wfGetDB( DB_PRIMARY );

		Wikimedia\suppressWarnings(); // E_STRICT whining
		$voteDate = date( 'Y-m-d H:i:s' );
		Wikimedia\restoreWarnings();

		if ( $this->hasUserAlreadyVoted() == false ) {
			$dbw->insert(
				'Vote',
				[
					'vote_page_id' => $this->PageID,
					'vote_value' => $voteValue,
					'vote_date' => $dbw->timestamp( $voteDate ),
					'vote_ip' => $wgRequest->getIP(),
					'vote_actor' => $this->User->getActorId()
				],
				__METHOD__
			);

			$this->clearCache();

			// Update social statistics if SocialProfile extension is enabled
			if ( class_exists( 'UserStatsTrack' ) ) {
				$stats = new UserStatsTrack( $this->User->getId(), $this->User->getName() );
				$stats->incStatField( 'vote' );
			}
		}
	}

	/**
	 * Checks if a user has already voted
	 *
	 * @return bool|int False if s/he hasn't, otherwise returns the
	 *                  value of 'vote_value' column from Vote DB table
	 */
	function hasUserAlreadyVoted() {
		$dbr = wfGetDB( DB_REPLICA );
		$s = $dbr->selectRow(
			'Vote',
			[ 'vote_value' ],
			[
				'vote_page_id' => $this->PageID,
				'vote_actor' => $this->User->getActorId()
			],
			__METHOD__
		);
		if ( $s === false ) {
			return false;
		} else {
			return $s->vote_value;
		}
	}

	/**
	 * Displays the green voting box
	 *
	 * @return string HTML output
	 */
	function display() {
		$voted = $this->hasUserAlreadyVoted();

		$make_vote_box_clickable = '';
		if ( $voted == false ) {
			$make_vote_box_clickable = ' vote-clickable';
		}

		$output = "<div class=\"vote-box{$make_vote_box_clickable}\" id=\"votebox\">";
		$output .= '<span id="PollVotes" class="vote-number">' . $this->count() . '</span>';
		$output .= '</div>';
		$output .= '<div id="Answer" class="vote-action">';

		if ( !$this->User->isAllowed( 'voteny' ) ) {
			// @todo FIXME: this is horrible. If we don't have enough
			// permissions to vote, we should tell the end-user /that/,
			// not require them to log in!
			$login = SpecialPage::getTitleFor( 'Userlogin' );
			$output .= '<a class="votebutton" href="' .
				htmlspecialchars( $login->getFullURL() ) . '" rel="nofollow">' .
				wfMessage( 'voteny-link' )->escaped() . '</a>';
		} else {
			if ( !MediaWikiServices::getInstance()->getReadOnlyMode()->isReadOnly() ) {
				if ( $voted == false ) {
					$output .= '<a href="javascript:void(0);" class="vote-vote-link">' .
						wfMessage( 'voteny-link' )->escaped() . '</a>';
				} else {
					$output .= '<a href="javascript:void(0);" class="vote-unvote-link">' .
						wfMessage( 'voteny-unvote-link' )->escaped() . '</a>';
				}
			}
		}
		$output .= '</div>';

		return $output;
	}
}
