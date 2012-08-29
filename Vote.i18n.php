<?php
/**
 * Internationalization file for the Vote extension.
 *
 * @file
 * @ingroup Extensions
 */

$messages = array();

/** English
 * @author Aaron Wright <aaron.wright@gmail.com>
 * @author David Pean <david.pean@gmail.com>
 */
$messages['en'] = array(
	'voteny-desc' => 'JavaScript-based voting with the <tt>&lt;vote&gt;</tt> tag',
	'voteny-link' => 'Vote',
	'voteny-unvote-link' => 'unvote',
	'voteny-community-score' => 'community score: $1',
	'voteny-ratings' => '{{PLURAL:$1|one rating|$1 ratings}}',
	'voteny-remove' => 'remove',
	'voteny-gave-this' => 'you gave this a $1',
	'voteny-votes' => '{{PLURAL:$1|one vote|$1 votes}}',
	// Special:TopRatings
	'topratings' => 'Top rated pages',
	'topratings-no-pages' => 'No top rated pages.',
	// For Special:ListGroupRights
	'right-vote' => 'Vote pages',
);

/** Message documentation */
$messages['qqq'] = array(
	'voteny-link' => 'Link title',
	'voteny-unvote-link' => 'Displayed to the user after their vote has been successfully added; they can click on this link to remove their vote.',
	'voteny-community-score' => 'Community score is the average of votes a page has been given, $1 is the actual score in numbers (i.e. 4.5 or 3)',
	'voteny-remove' => 'Link title, clicking on this link removes your vote. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'voteny-gave-this' => '$1 is a number, the vote you gave to the page. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'topratings' => 'Title of Special:TopRatings, as shown on the special page itself and on Special:SpecialPages',
	'topratings-no-pages' => 'Displayed on Special:TopRatings if there are no top rated pages, i.e. if no pages have been rated on the wiki at all.',
	'right-vote' => 'Shown on Special:ListGroupRights',
);

/** Finnish (Suomi)
 * @author Jack Phoenix <jack@countervandalism.net>
 */
$messages['fi'] = array(
	'voteny-link' => 'Äänestä',
	'voteny-unvote-link' => 'poista ääni',
	'voteny-community-score' => 'yhteisön antama pistemäärä: $1',
	'voteny-ratings' => '{{PLURAL:$1|yksi arvostelu|$1 arvostelua}}',
	'voteny-remove' => 'poista',
	'voteny-gave-this' => 'annoit tälle {{PLURAL:$1|yhden tähden|$1 tähteä}}',
	'voteny-votes' => '{{PLURAL:$1|yksi ääni|$1 ääntä}}',
	'topratings' => 'Huippusivut',
	'topratings-no-pages' => 'Ei huippusivuja.',
	'right-vote' => 'Äänestää sivuja',
);

/** French (Français)
 * @author Jack Phoenix <jack@countervandalism.net>
 */
$messages['fr'] = array(
	'voteny-link' => 'Voter',
	'voteny-unvote-link' => 'supprimer vote',
	'voteny-remove' => 'supprimer',
	'voteny-votes' => '{{PLURAL:$1|un vote|$1 votes}}',
	'right-vote' => 'Voter pages',
);

/** Dutch (Nederlands)
 * @author Mitchel Corstjens
 */
$messages['nl'] = array(
	'voteny-link' => 'Stem',
	'voteny-unvote-link' => 'stem terugtrekken',
	'voteny-community-score' => 'gemeenschap score: $1',
	'voteny-remove' => 'verwijder',
	'voteny-gave-this' => 'je gaf dit een $1',
	'voteny-votes' => '{{PLURAL:$1|een stem|$1 stemmen}}',
	'topratings' => 'Meest gewaardeerde pagina\'s',
	'topratings-no-pages' => 'Er zijn nog geen meest gewaardeerde pagina\'s',
	'right-vote' => 'Stem paginas',
);

/** Polish (Polski)
 * @author Misiek95
 */
$messages['pl'] = array(
	'voteny-link' => 'Głosuj',
	'voteny-unvote-link' => 'Anuluj',
	'voteny-community-score' => 'Wynik wśród społeczności: $1',
	'voteny-ratings' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
	'voteny-remove' => 'usuń',
	'voteny-gave-this' => 'Oceniłeś to na $1',
	'voteny-votes' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
	'right-vote' => 'Udział w głosowaniach',
);