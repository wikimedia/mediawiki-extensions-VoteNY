<?php

use MediaWiki\MediaWikiServices;
use MediaWiki\Parser\Parser;
use MediaWiki\Title\Title;
use Wikimedia\Rdbms\Database;

/**
 * All hooked functions used by VoteNY extension.
 *
 * @file
 * @ingroup Extensions
 */
class VoteNYHooks {

	/**
	 * Set up the <vote> parser hook.
	 *
	 * @param MediaWiki\Parser\Parser &$parser
	 */
	public static function registerParserHook( &$parser ) {
		$parser->setHook( 'vote', [ __CLASS__, 'renderVote' ] );
	}

	/**
	 * Callback function for registerParserHook.
	 *
	 * @param string $input User-supplied input, unused
	 * @param array $args User-supplied arguments
	 * @param MediaWiki\Parser\Parser $parser Instance of Parser, unused
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
		$po->addModuleStyles( [ 'ext.voteNY.styles' ] );

		$user = MediaWikiServices::getInstance()->getUserFactory()
			->newFromUserIdentity( $parser->getUserIdentity() );
		if ( $user->isAllowed( 'voteny' ) ) {
			$po->addModules( [ 'ext.voteNY.scripts' ] );
		}

		// Define variable - 0 means that we'll get that green voting box by default
		$type = 0;

		// Determine what kind of a voting gadget the user wants: a box or pretty stars?
		if ( preg_match( "/^\s*type\s*=\s*(.*)/mi", $input ?? '', $matches ) ) {
			$type = htmlspecialchars( $matches[1] );
		} elseif ( !empty( $args['type'] ) ) {
			$type = intval( $args['type'] );
		}

		$pageID = $parser->getTitle()->getArticleID();
		$vote = match ( $type ) {
			1 => new VoteStars( $pageID, $user ),
			default => new Vote( $pageID, $user ),
		};

		return $vote->display();
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
	 * @param MediaWiki\Parser\Parser $parser
	 * @param array &$wordCache
	 * @param string $magicWordId Magic word ID
	 * @param int &$ret Return value (number of votes)
	 */
	public static function assignValueToMagicWord( $parser, &$wordCache, $magicWordId, &$ret ) {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();

		if ( $magicWordId == 'NUMBEROFVOTES' ) {
			$fname = __METHOD__;
			$ret = $wordCache[$magicWordId] = $cache->getWithSetCallback(
				$cache->makeKey( 'vote-magicword' ),
				$cache::TTL_DAY,
				static function ( $oldValue, &$ttl, &$setOpts ) use ( $fname ) {
					$dbr = MediaWikiServices::getInstance()->getDBLoadBalancer()->getConnection( DB_REPLICA );
					$setOpts += Database::getCacheSetOptions( $dbr );

					return (int)$dbr->selectField(
						'Vote',
						'COUNT(*) AS count',
						[],
						$fname
					);
				}
			);
		} elseif ( $magicWordId == 'NUMBEROFVOTESPAGE' ) {
			$ret = $wordCache[$magicWordId] = self::getNumberOfVotesPage( $parser->getTitle() );
		}
	}

	/**
	 * Main function to get the number of votes for a specific page
	 *
	 * @param MediaWiki\Title\Title $title Page to get votes for
	 * @return int Number of votes for the given page
	 */
	public static function getNumberOfVotesPage( Title $title ) {
		$cache = MediaWikiServices::getInstance()->getMainWANObjectCache();

		$id = $title->getArticleID();
		$fname = __METHOD__;

		return $cache->getWithSetCallback(
			$cache->makeKey( 'vote-magicword-page', $id ),
			$cache::TTL_HOUR,
			static function ( $oldValue, &$ttl, &$setOpts ) use ( $id, $fname ) {
				$dbr = MediaWikiServices::getInstance()->getDBLoadBalancer()->getConnection( DB_REPLICA );
				$setOpts += Database::getCacheSetOptions( $dbr );

				return (int)$dbr->selectField(
					'Vote',
					'COUNT(*) AS count',
					[ 'vote_page_id' => $id ],
					$fname
				);
			}
		);
	}

	/**
	 * Hook for parser function {{NUMBEROFVOTESPAGE:<page>}}
	 *
	 * @param MediaWiki\Parser\Parser $parser
	 * @param string $pagename Page name
	 * @return int Amount of votes for the given page
	 */
	public static function getNumberOfVotesPageParser( $parser, $pagename ) {
		$title = Title::newFromText( $pagename ) ?? $parser->getTitle();
		return self::getNumberOfVotesPage( $title );
	}

	/**
	 * Register the magic word ID for {{NUMBEROFVOTES}} and {{NUMBEROFVOTESPAGE}}
	 *
	 * @param array &$variableIds Array of pre-existing variable IDs
	 */
	public static function registerVariableId( &$variableIds ) {
		$variableIds[] = 'NUMBEROFVOTES';
		$variableIds[] = 'NUMBEROFVOTESPAGE';
	}

	/**
	 * Hook to setup parser function {{NUMBEROFVOTESPAGE:<page>}}
	 *
	 * @param MediaWiki\Parser\Parser &$parser
	 */
	public static function setupNumberOfVotesPageParser( &$parser ) {
		$parser->setFunctionHook( 'NUMBEROFVOTESPAGE', 'VoteNYHooks::getNumberOfVotesPageParser', Parser::SFH_NO_HASH );
	}

	/**
	 * Creates the necessary database table when the user runs
	 * maintenance/update.php.
	 *
	 * @param MediaWiki\Installer\DatabaseUpdater $updater
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
		if ( $db->tableExists( 'Vote', __METHOD__ ) && !$db->fieldExists( 'Vote', 'vote_actor', __METHOD__ ) ) {
			$updater->addExtensionField( 'Vote', 'vote_actor', "$sqlPath/patch-add-vote_actor-column.$dbt" );

			$updater->addExtensionUpdate( [
				'runMaintenance',
				'MigrateOldVoteUserColumnsToActor'
			] );
		}
	}
}
