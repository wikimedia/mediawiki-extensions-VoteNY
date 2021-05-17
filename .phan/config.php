<?php

$cfg = require __DIR__ . '/../vendor/mediawiki/mediawiki-phan-config/src/config.php';

$cfg['directory_list'] = array_merge(
	$cfg['directory_list'],
	[
		'../../extensions/Renameuser',
		'../../extensions/SocialProfile',
	]
);

$cfg['exclude_analysis_directory_list'] = array_merge(
	$cfg['exclude_analysis_directory_list'],
	[
		'../../extensions/Renameuser',
		'../../extensions/SocialProfile',
	]
);

// Suppress EVERYTHING for now, we only care about running seccheck and fixing legacy code
// suckage is a gigantic task for another day...
$cfg['suppress_issue_types'] = array_merge( $cfg['suppress_issue_types'], [
	# False positive (MediaWiki\MediaWikiServices::getActorNormalization calls in a maintenance script)
	'PhanUndeclaredMethod',
	# Renameuser-related
	'PhanUndeclaredTypeParameter',
	'PhanUndeclaredClassProperty'
] );

return $cfg;
