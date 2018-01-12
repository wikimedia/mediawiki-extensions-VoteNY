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
	public $Userid = 0;
	public $Username = null;

	/**
	 * Constructor
	 *
	 * @param int $pageID Article ID number
	 */
	public function __construct( $pageID ) {
		global $wgUser;

		$this->PageID = $pageID;
		$this->Username = $wgUser->getName();
		$this->Userid = $wgUser->getID();
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
				array( 'vote_page_id' => $this->PageID ),
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
				array( 'vote_page_id' => $this->PageID ),
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
		global $wgUser, $wgMemc;

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
			$parserKey = $parserCache->getKey( $article, $wgUser );
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
			array(
				'vote_page_id' => $this->PageID,
				'username' => $this->Username
			),
			__METHOD__
		);

		$this->clearCache();

		// Update social statistics if SocialProfile extension is enabled
		if ( class_exists( 'UserStatsTrack' ) ) {
			$stats = new UserStatsTrack( $this->Userid, $this->Username );
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
		MediaWiki\suppressWarnings(); // E_STRICT whining
		$voteDate = date( 'Y-m-d H:i:s' );
		MediaWiki\restoreWarnings();
		if ( $this->UserAlreadyVoted() == false ) {
			$dbw->insert(
				'Vote',
				array(
					'username' => $this->Username,
					'vote_user_id' => $this->Userid,
					'vote_page_id' => $this->PageID,
					'vote_value' => $voteValue,
					'vote_date' => $voteDate,
					'vote_ip' => $wgRequest->getIP(),
				),
				__METHOD__
			);

			$this->clearCache();

			// Update social statistics if SocialProfile extension is enabled
			if ( class_exists( 'UserStatsTrack' ) ) {
				$stats = new UserStatsTrack( $this->Userid, $this->Username );
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
	function UserAlreadyVoted() {
		$dbr = wfGetDB( DB_REPLICA );
		$s = $dbr->selectRow(
			'Vote',
			array( 'vote_value' ),
			array(
				'vote_page_id' => $this->PageID,
				'username' => $this->Username
			),
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
		global $wgUser;

		$voted = $this->UserAlreadyVoted();

		$make_vote_box_clickable = '';
		if ( $voted == false ) {
			$make_vote_box_clickable = ' vote-clickable';
		}

		$output = "<div class=\"vote-box{$make_vote_box_clickable}\" id=\"votebox\">";
	 	$output .= '<span id="PollVotes" class="vote-number">' . $this->count() . '</span>';
		$output .= '</div>';
		$output .= '<div id="Answer" class="vote-action">';

		if ( !$wgUser->isAllowed( 'voteny' ) ) {
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
