<?php
/**
 * Vote extension - JavaScript-based voting with the <vote> tag
 *
 * @file
 * @ingroup Extensions
 * @author Aaron Wright <aaron.wright@gmail.com>
 * @author David Pean <david.pean@gmail.com>
 * @author Jack Phoenix <jack@countervandalism.net>
 * @link https://www.mediawiki.org/wiki/Extension:VoteNY Documentation
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

// Extension credits that show up on Special:Version
$wgExtensionCredits['parserhook'][] = array(
	'name' => 'Vote',
	'version' => '2.7',
	'author' => array( 'Aaron Wright', 'David Pean', 'Jack Phoenix' ),
	'descriptionmsg' => 'voteny-desc',
	'url' => 'https://www.mediawiki.org/wiki/Extension:VoteNY'
);

// Path to Vote extension files
$wgVoteDirectory = "$IP/extensions/VoteNY";

// New user right
$wgAvailableRights[] = 'voteny';
$wgGroupPermissions['*']['voteny'] = false; // Anonymous users cannot vote
$wgGroupPermissions['user']['voteny'] = true; // Registered users can vote

// AJAX functions needed by this extension
require_once 'Vote_AjaxFunctions.php';

// Autoload classes and set up i18n
$wgMessagesDirs['VoteNY'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['VoteNYAlias'] = __DIR__ . '/VoteNY.alias.php';
$wgExtensionMessagesFiles['VoteNYMagic'] = __DIR__ . '/VoteNY.i18n.magic.php';

$wgAutoloadClasses['Vote'] = __DIR__ . '/VoteClass.php';
$wgAutoloadClasses['VoteStars'] = __DIR__ . '/VoteClass.php';

// Set up the new special page, Special:TopRatings, which shows top rated pages
// based on given criteria
$wgAutoloadClasses['SpecialTopRatings'] = __DIR__ . '/SpecialTopRatings.php';
$wgSpecialPages['TopRatings'] = 'SpecialTopRatings';

// Hooked functions
$wgAutoloadClasses['VoteHooks'] = __DIR__ . '/VoteHooks.php';

$wgHooks['ParserFirstCallInit'][] = 'VoteHooks::registerParserHook';
$wgHooks['RenameUserSQL'][] = 'VoteHooks::onUserRename';
$wgHooks['ParserGetVariableValueSwitch'][] = 'VoteHooks::assignValueToMagicWord';
$wgHooks['MagicWordwgVariableIDs'][] = 'VoteHooks::registerVariableId';
$wgHooks['ParserFirstCallInit'][] = 'VoteHooks::setupNumberOfVotesPageParser';
$wgHooks['LoadExtensionSchemaUpdates'][] = 'VoteHooks::addTable';

// ResourceLoader support for MediaWiki 1.17+
$wgResourceModules['ext.voteNY.styles'] = array(
	'styles' => 'Vote.css',
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'VoteNY',
	'position' => 'top' // available since r85616
);

$wgResourceModules['ext.voteNY.scripts'] = array(
	'scripts' => 'Vote.js',
	'messages' => array( 'voteny-link', 'voteny-unvote-link' ),
	'localBasePath' => __DIR__,
	'remoteExtPath' => 'VoteNY'
);
