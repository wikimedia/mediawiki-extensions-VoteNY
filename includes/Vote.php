<?php
/**
 * Vote class - class for handling vote-related functions (counting
 * the average score of a given page, inserting/updating/removing a vote etc.)
 *
 * @file
 * @ingroup Extensions
 */

use MediaWiki\MediaWikiServices;

class Vote {
	public $PageID = 0;
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
		global $wgMemc;

		$key = $wgMemc->makeKey( 'vote', 'count', $this->PageID );
		$data = $wgMemc->get( $key );

		// Try cache
		if ( $data ) {
			wfDebug( "Loading vote count for page {$this->PageID} from cache\n" );
			$vote_count = $data;
		} else {
			$dbr = wfGetDB( DB_REPLICA );
			$vote_count = 0;
			$res = $dbr->select(
				'Vote',
				'COUNT(*) AS votecount',
				[ 'vote_page_id' => $this->PageID ],
				__METHOD__
			);
			$row = $dbr->fetchObject( $res );
			if ( $row ) {
				$vote_count = $row->votecount;
			}
			$wgMemc->set( $key, $vote_count );
		}

		return $vote_count;
	}

	/**
	 * Gets the average score of all votes
	 *
	 * @return int Formatted average number of votes (something like 3.50)
	 */
	function getAverageVote() {
		global $wgMemc;

		$key = $wgMemc->makeKey( 'vote', 'avg', $this->PageID );
		$data = $wgMemc->get( $key );

		$voteAvg = 0;
		if ( $data ) {
			wfDebug( "Loading vote avg for page {$this->PageID} from cache\n" );
			$voteAvg = $data;
		} else {
			$dbr = wfGetDB( DB_REPLICA );
			$res = $dbr->select(
				'Vote',
				'AVG(vote_value) AS voteavg',
				[ 'vote_page_id' => $this->PageID ],
				__METHOD__
			);
			$row = $dbr->fetchObject( $res );
			if ( $row ) {
				$voteAvg = $row->voteavg;
			}
			$wgMemc->set( $key, $voteAvg );
		}

		return number_format( $voteAvg, 2 );
	}

	/**
	 * Clear caches - memcached, parser cache and Squid cache
	 */
	function clearCache() {
		global $wgMemc;

		// Kill internal cache
		$wgMemc->delete( $wgMemc->makeKey( 'vote', 'count', $this->PageID ) );
		$wgMemc->delete( $wgMemc->makeKey( 'vote', 'avg', $this->PageID ) );

		// Purge squid
		$pageTitle = Title::newFromID( $this->PageID );
		if ( is_object( $pageTitle ) ) {
			$pageTitle->invalidateCache();
			$pageTitle->purgeSquid();

			// Kill parser cache
			$article = new Article( $pageTitle, /* oldid */0 );
			$parserCache = MediaWikiServices::getInstance()->getParserCache();
			$parserKey = $parserCache->getKey(
				$article,
				$this->User
			);
			$wgMemc->delete( $parserKey );
		}
	}

	/**
	 * Delete the user's vote from the database, purges normal caches and
	 * updates SocialProfile's statistics, if SocialProfile is active.
	 */
	function delete() {
		$dbw = wfGetDB( DB_MASTER );

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

		$dbw = wfGetDB( DB_MASTER );

		Wikimedia\suppressWarnings(); // E_STRICT whining
		$voteDate = date( 'Y-m-d H:i:s' );
		Wikimedia\restoreWarnings();

		if ( $this->hasUserAlreadyVoted() == false ) {
			$dbw->insert(
				'Vote',
				[
					'vote_page_id' => $this->PageID,
					'vote_value' => $voteValue,
					'vote_date' => $voteDate,
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
				wfMessage( 'voteny-link' )->plain() . '</a>';
		} else {
			if ( !wfReadOnly() ) {
				if ( $voted == false ) {
					$output .= '<a href="javascript:void(0);" class="vote-vote-link">' .
						wfMessage( 'voteny-link' )->plain() . '</a>';
				} else {
					$output .= '<a href="javascript:void(0);" class="vote-unvote-link">' .
						wfMessage( 'voteny-unvote-link' )->plain() . '</a>';
				}
			}
		}
		$output .= '</div>';

		return $output;
	}
}
