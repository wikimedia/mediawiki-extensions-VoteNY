<?php

use MediaWiki\MediaWikiServices;

/**
 * A special page to display the highest rated pages on the wiki.
 *
 * This special page supports filtering by category and namespace, so
 * {{Special:TopRatings/Adventure Games/0/10}} will show 10 ratings where the
 * pages are in the "Adventure Games" category and the pages are in the main
 * (0) namespace.
 *
 * @file
 * @ingroup Extensions
 * @license To the extent that it is possible, this code is in the public domain
 */
class SpecialTopRatings extends IncludableSpecialPage {

	/**
	 * Constructor -- set up the new special page
	 */
	public function __construct() {
		parent::__construct( 'TopRatings' );
	}

	/**
	 * Show the special page
	 *
	 * @param string|null $par Parameter passed to the special page or null
	 */
	public function execute( $par ) {
		// Set the page title, robot policies, etc.
		$this->setHeaders();

		$out = $this->getOutput();
		$user = $this->getUser();

		$categoryName = $namespace = '';

		// Parse the parameters passed to the special page
		// Make sure that the limit parameter passed to the special page is
		// an integer and that it's less than 100 (performance!)
		if ( isset( $par ) && is_numeric( $par ) && $par < 100 ) {
			$limit = intval( $par );
		} elseif ( isset( $par ) && !is_numeric( $par ) ) {
			// $par is a string...assume that we can explode() it
			$exploded = explode( '/', $par );
			$categoryName = $exploded[0];
			$namespace = ( isset( $exploded[1] ) ? intval( $exploded[1] ) : $namespace );
			$limit = ( isset( $exploded[2] ) ? intval( $exploded[2] ) : 50 );
		} else {
			$limit = 50;
		}

		// Add CSS
		$out->addModuleStyles( 'ext.voteNY.styles' );
		/* scroll down some lines to see why I'm not including JS here anymore
		if ( $user->isAllowed( 'voteny' ) ) {
			$out->addModules( 'ext.voteNY.scripts' );
		}
		*/

		$output = '';

		$ratings = self::getTopRatings( $limit, $categoryName, $namespace );

		// If we have some ratings, start building HTML output
		if ( !empty( $ratings ) ) {
			/* XXX dirrrrrrty hack! because when we include this page, the JS
			 * is not included, but we want things to work still
			 * Actually, this is way harder than what it looks like.
			 * The JS uses wgArticleId but when directly viewing Special:TopRatings,
			 * wgArticleId is zero, because special pages aren't articles.
			 * As for including the special page, then wgArticleId would likely
			 * point at the ID of the page that includes {{Special:TopRatings}},
			 * which would be stupid and wrong.
			 * Besides, shouldn't you check out the images/pages that you're gonna
			 * vote for? Yeah, that's what I thought, too.
			if ( $this->including() && $user->isAllowed( 'voteny' ) ) {
				global $wgExtensionAssetsPath;
				$output .= '<script type="text/javascript" src="' .
					$wgExtensionAssetsPath . '/VoteNY/Vote.js"></script>';
			}
			*/

			$linkRenderer = $this->getLinkRenderer();

			// yes, array_keys() is needed
			foreach ( array_keys( $ratings ) as $discardThis => $pageId ) {
				$titleObj = Title::newFromId( $pageId );
				if ( !( $titleObj instanceof Title ) ) {
					continue;
				}

				$vote = new VoteStars( $pageId, $user );

				$output .= '<div class="user-list-rating">' .
					$linkRenderer->makeLink(
						$titleObj,
						$titleObj->getPrefixedText() // prefixed, so that the namespace shows!
					) . $this->msg( 'word-separator' )->escaped() . // i18n overkill? ya betcha...
					$this->msg( 'parentheses', $ratings[$pageId] )->escaped() .
				'</div>';

				$id = mt_rand(); // AFAIK these IDs are and originally were totally random...
				$output .= "<div id=\"rating_stars_{$id}\">" .
					$vote->displayStars(
						$id,
						self::getAverageRatingForPage( $pageId ),
						false
					) . '</div>';
				$output .= "<div id=\"rating_{$id}\" class=\"rating-total\">" .
					$vote->displayScore() .
				'</div>';
			}
		} else {
			// Nothing? Well, display an informative error message rather than
			// a blank page or somesuch.
			$output .= $this->msg( 'topratings-no-pages' )->escaped();
		}

		// Output everything!
		$out->addHTML( $output );
	}

	/**
	 * Static version of Vote::getAverageVote().
	 *
	 * @param int $pageId ID of the page for which we want to get the avg. rating
	 * @return int Average vote for the given page (ID)
	 */
	public static function getAverageRatingForPage( $pageId ) {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();
		$fname = __METHOD__;

		return $cache->getWithSetCallback(
			$cache->makeKey( 'vote-avg', $pageId ),
			$cache::TTL_WEEK,
			function ( $oldValue, &$ttl, &$setOpts ) use ( $pageId, $fname ) {
				$dbr = wfGetDB( DB_REPLICA );
				$setOpts += Database::getCacheSetOptions( $dbr );

				return (int)$dbr->selectField(
					'Vote',
					'AVG(vote_value) AS VoteAvg',
					[ 'vote_page_id' => $pageId ],
					$fname
				);
			}
		);
	}

	/**
	 * Get the $limit top rated pages, optionally in $categoryName a non-NS_MAIN $namespace.
	 *
	 * @param int $limit LIMIT for the SQL query (get this many records)
	 * @param string $categoryName Category name, if any; if this contains spaces they are replaced with underscores
	 * @param int $namespace Namespace index, if fetching pages from a non-NS_MAIN NS
	 * @return array Array of page ID => total votes mappings
	 */
	public static function getTopRatings( $limit = 10, $categoryName = '', $namespace = 0 ) {
		$dbr = wfGetDB( DB_REPLICA );
		$ratings = [];
		$joinConds = [];
		$whatToSelect = [ 'DISTINCT vote_page_id', 'SUM(vote_value) AS vote_value_sum' ];

		// By default we have no category and no namespace
		$tables = [ 'Vote' ];
		$where = [ 'vote_page_id <> 0' ];

		// isset(), because 0 is a totally valid NS
		if ( !empty( $categoryName ) && isset( $namespace ) ) {
			$tables = [ 'Vote', 'page', 'categorylinks' ];
			$where = [
				'vote_page_id <> 0',
				'cl_to' => str_replace( ' ', '_', $categoryName ),
				'page_namespace' => $namespace
			];
			$joinConds = [
				'categorylinks' => [ 'INNER JOIN', 'cl_from = page_id' ],
				'page' => [ 'INNER JOIN', 'page_id = vote_page_id' ]
			];
		}

		// Perform the SQL query with the given conditions; the basic idea is
		// that we get $limit (however, 100 or less) unique page IDs from the
		// Vote table. The GROUP BY is to make SUM(vote_value) give the SUM of
		// all vote_values for a page. If a category and a namespace have been
		// given, we also do an INNER JOIN with page and categorylinks table
		// to get the correct data.
		$res = $dbr->select(
			$tables,
			$whatToSelect,
			$where,
			__METHOD__,
			[ 'GROUP BY' => 'vote_page_id', 'LIMIT' => intval( $limit ) ],
			$joinConds
		);

		foreach ( $res as $row ) {
			// Add the results to the $ratings array
			// For example: $ratings[1] = 11 = page with the page ID 1 has 11
			// votes
			$ratings[$row->vote_page_id] = (int)$row->vote_value_sum;
		}

		return $ratings;
	}
}
