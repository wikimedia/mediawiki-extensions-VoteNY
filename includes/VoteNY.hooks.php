<?php
/**
 * All hooked functions used by VoteNY extension.
 *
 * @file
 * @ingroup Extensions
 */
class VoteHooks {

	/**
	 * Set up the <vote> parser hook.
	 *
	 * @param Parser $parser
	 */
	public static function registerParserHook( &$parser ) {
		$parser->setHook( 'vote', [ 'VoteHooks', 'renderVote' ] );
	}

	/**
	 * Callback function for registerParserHook.
	 *
	 * @param string $input User-supplied input, unused
	 * @param array $args User-supplied arguments
	 * @param Parser $parser Instance of Parser, unused
	 * @return string HTML
	 */
	public static function renderVote( $input, $args, $parser ) {
		$po = $parser->getOutput();
		// Disable parser cache (sadly we have to do this, because the caching is
		// messing stuff up; we want to show an up-to-date rating instead of old
		// or totally wrong rating, i.e. another page's rating...)
		$po->updateCacheExpiry( 0 );

		// Add CSS & JS
		// In order for us to do this *here* instead of having to do this in
		// registerParserHook(), we must've disabled parser cache
		$po->addModuleStyles( 'ext.voteNY.styles' );

		$user = $parser->getUser();
		if ( $user->isAllowed( 'voteny' ) ) {
			$po->addModules( 'ext.voteNY.scripts' );
		}

		// Define variable - 0 means that we'll get that green voting box by default
		$type = 0;

		// Determine what kind of a voting gadget the user wants: a box or pretty stars?
		if ( preg_match( "/^\s*type\s*=\s*(.*)/mi", $input, $matches ) ) {
			$type = htmlspecialchars( $matches[1] );
		} elseif ( !empty( $args['type'] ) ) {
			$type = intval( $args['type'] );
		}

		$output = '';
		$title = $parser->getTitle();
		if ( $title ) {
			$articleID = $title->getArticleID();
			switch ( $type ) {
				case 0:
					$vote = new Vote( $articleID, $user );
					break;
				case 1:
					$vote = new VoteStars( $articleID, $user );
					break;
				default:
					$vote = new Vote( $articleID, $user );
			}

			$output = $vote->display();
		}

		return $output;
	}

	/**
	 * For the Renameuser extension.
	 *
	 * @param RenameuserSQL $renameUserSQL
	 */
	public static function onUserRename( $renameUserSQL ) {
		$renameUserSQL->tables['Vote'] = [ 'username', 'vote_user_id' ];
	}

	/**
	 * Assign a value to {{NUMBEROFVOTES}}. First we try memcached and if that
	 * fails, we fetch it directly from the database and cache it for 24 hours.
	 *
	 * @param Parser $parser
	 * @param $cache
	 * @param string $magicWordId Magic word ID
	 * @param int $ret Return value (number of votes)
	 */
	public static function assignValueToMagicWord( &$parser, &$cache, &$magicWordId, &$ret ) {
		global $wgMemc;

		if ( $magicWordId == 'NUMBEROFVOTES' ) {
			$key = $wgMemc->makeKey( 'vote', 'magic-word' );
			$data = $wgMemc->get( $key );
			if ( $data != '' ) {
				// We have it in cache? Oh goody, let's just use the cached value!
				wfDebugLog(
					'VoteNY',
					'Got the amount of votes from memcached'
				);
				// return value
				$ret = $data;
			} else {
				// Not cached → have to fetch it from the database
				$dbr = wfGetDB( DB_REPLICA );
				$voteCount = (int)$dbr->selectField(
					'Vote',
					'COUNT(*) AS count',
					[],
					__METHOD__
				);
				wfDebugLog( 'VoteNY', 'Got the amount of votes from DB' );
				// Store the count in cache...
				// (86400 = seconds in a day)
				$wgMemc->set( $key, $voteCount, 86400 );
				// ...and return the value to the user
				$ret = $voteCount;
			}
		} elseif ( $magicWordId == 'NUMBEROFVOTESPAGE' ) {
			$ret = VoteHooks::getNumberOfVotesPage( $parser->getTitle() );
		}
	}

	/**
	 * Main function to get the number of votes for a specific page
	 *
	 * @param Title $title Page to get votes for
	 * @return int Number of votes for the given page
	 */
	public static function getNumberOfVotesPage( Title $title ) {
		global $wgMemc;

		$id = $title->getArticleID();

		$key = $wgMemc->makeKey( 'vote', 'magic-word-page', $id );
		$data = $wgMemc->get( $key );

		if ( $data ) {
			return $data;
		} else {
			$dbr = wfGetDB( DB_REPLICA );

			$voteCount = (int)$dbr->selectField(
				'Vote',
				'COUNT(*) AS count',
				[ 'vote_page_id' => $id ],
				__METHOD__
			);

			$wgMemc->set( $key, $voteCount, 3600 );

			return $voteCount;
		}
	}

	/**
	 * Hook for parser function {{NUMBEROFVOTESPAGE:<page>}}
	 *
	 * @param Parser $parser
	 * @param string $pagename Page name
	 * @return int Amount of votes for the given page
	 */
	public static function getNumberOfVotesPageParser( $parser, $pagename ) {
		$title = Title::newFromText( $pagename );

		if ( !$title instanceof Title ) {
			$title = $parser->getTitle();
		}

		return VoteHooks::getNumberOfVotesPage( $title );
	}

	/**
	 * Register the magic word ID for {{NUMBEROFVOTES}} and {{NUMBEROFVOTESPAGE}}
	 *
	 * @param array $variableIds Array of pre-existing variable IDs
	 */
	public static function registerVariableId( &$variableIds ) {
		$variableIds[] = 'NUMBEROFVOTES';
		$variableIds[] = 'NUMBEROFVOTESPAGE';
	}

	/**
	 * Hook to setup parser function {{NUMBEROFVOTESPAGE:<page>}}
	 *
	 * @param Parser $parser
	 */
	public static function setupNumberOfVotesPageParser( &$parser ) {
		$parser->setFunctionHook( 'NUMBEROFVOTESPAGE', 'VoteHooks::getNumberOfVotesPageParser', Parser::SFH_NO_HASH );
	}

	/**
	 * Creates the necessary database table when the user runs
	 * maintenance/update.php.
	 *
	 * @param DatabaseUpdater $updater
	 */
	public static function addTable( $updater ) {
		$db = $updater->getDB();
		$dbt = $db->getType();
		$sqlPath = __DIR__ . '/../sql';
		// If using SQLite, just use the MySQL/MariaDB schema, it's compatible
		// anyway. Only PGSQL and some more exotic variants need a totally
		// different schema.
		if ( $dbt === 'sqlite' ) {
			$dbt = 'mysql';
		}

		$file = "$sqlPath/vote.$dbt";
		if ( file_exists( $file ) ) {
			$updater->addExtensionTable( 'Vote', $file );
		} else {
			throw new MWException( "VoteNY does not support $dbt." );
		}

		// Actor support (see T227345)
		if ( $db->tableExists( 'Vote' ) && !$db->fieldExists( 'Vote', 'vote_actor', __METHOD__ ) ) {
			$updater->addExtensionField( 'Vote', 'vote_actor', "$sqlPath/patch-add-vote_actor-column.$dbt" );
		}
	}
}
