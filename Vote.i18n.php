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

/** Message documentation (Message documentation)
 * @author Darth Kule
 */
$messages['qqq'] = array(
	'voteny-desc' => '{{desc}}',
	'voteny-link' => 'Link title',
	'voteny-unvote-link' => 'Displayed to the user after their vote has been successfully added; they can click on this link to remove their vote.',
	'voteny-community-score' => 'Community score is the average of votes a page has been given, $1 is the actual score in numbers (i.e. 4.5 or 3)',
	'voteny-ratings' => '<code>$1</code> is the number of ratings, if said number is greater than 1.',
	'voteny-remove' => 'Link title, clicking on this link removes your vote. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'voteny-gave-this' => '$1 is a number, the vote you gave to the page. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'voteny-votes' => '$1 is the number of votes.',
	'topratings' => 'Title of Special:TopRatings, as shown on the special page itself and on Special:SpecialPages',
	'topratings-no-pages' => 'Displayed on Special:TopRatings if there are no top rated pages, i.e. if no pages have been rated on the wiki at all.',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'voteny-desc' => 'Ergänzt das Tag <tt>&lt;vote&gt;</tt> zum Durchführen JavaScript-gestützter Abstimmungen',
	'voteny-link' => 'Abstimmen',
	'voteny-unvote-link' => 'Stimme zurücknehmen',
	'voteny-community-score' => 'Punktestand der Gemeinschaft: $1',
	'voteny-ratings' => '{{PLURAL:$1|eine Bewertung|$1 Bewertungen}}',
	'voteny-remove' => 'entfernen',
	'voteny-gave-this' => 'Du hast eine $1 vergeben.',
	'voteny-votes' => '{{PLURAL:$1|eine Stimme|$1 Stimmen}}',
	'topratings' => 'Höchstbewertete Seiten',
	'topratings-no-pages' => 'Es sind keine höchstbewerteten Seiten vorhanden.',
);

/** German (formal address) (‪Deutsch (Sie-Form)‬)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'voteny-gave-this' => 'Sie haben eine $1 vergeben.',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'voteny-desc' => 'Wótgłosowanje z toflicku <tt>&lt;vote&gt;</tt> na zakłaźe JavaScripta',
	'voteny-link' => 'Wótgłosowaś',
	'voteny-unvote-link' => 'Wótgłosowanje anulěrowaś',
	'voteny-community-score' => 'Licba głosow zgromaźeństwa: $1',
	'voteny-ratings' => '{{PLURAL:$1|jadno pógódnośenje|$1 pógódnośeni|$1 pógódnośenja|$1 pógódnośenjow}}',
	'voteny-remove' => 'wótpóraś',
	'voteny-gave-this' => 'sy toś tomu $1 dał',
	'voteny-votes' => '{{PLURAL:$1|jaden głos|$1 głosa|$1 głose|$1 głosow}}',
	'topratings' => 'Nejwuše pógódnośone boki',
	'topratings-no-pages' => 'Žedne nejwuše pógódnośone boki.',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'voteny-desc' => 'Votación basada en JavaScript con la etiqueta <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Votar',
	'voteny-unvote-link' => 'Eliminar voto',
	'voteny-community-score' => 'puntuación de la comunidad: $1',
	'voteny-ratings' => '{{PLURAL:$1|una valoración|$1 valoraciones}}',
	'voteny-remove' => 'eliminar',
	'voteny-gave-this' => 'le diste a esto un $1',
	'voteny-votes' => '{{PLURAL:$1|un voto|$1 votos}}',
	'topratings' => 'Páginas más valoradas',
	'topratings-no-pages' => 'No hay páginas mejor valoradas',
);

/** Finnish (suomi)
 * @author Jack Phoenix <jack@countervandalism.net>
 * @author Nike
 */
$messages['fi'] = array(
	'voteny-link' => 'Äänestä',
	'voteny-unvote-link' => 'poista ääni',
	'voteny-community-score' => 'yhteisön antama pistemäärä: $1',
	'voteny-ratings' => '{{PLURAL:$1|yksi arvostelu|$1 arvostelua}}',
	'voteny-remove' => 'poista',
	'voteny-gave-this' => 'annoit {{PLURAL:$1|yhden tähden|$1 tähteä}}',
	'voteny-votes' => '{{PLURAL:$1|yksi ääni|$1 ääntä}}',
	'topratings' => 'Huippusivut',
	'topratings-no-pages' => 'Ei huippusivuja.',
);

/** French (français)
 * @author Jack Phoenix <jack@countervandalism.net>
 * @author Tititou36
 */
$messages['fr'] = array(
	'voteny-desc' => 'Système de vote en JavaScript avec la balise <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Voter',
	'voteny-unvote-link' => 'supprimer vote',
	'voteny-community-score' => 'note de la communauté : $1',
	'voteny-ratings' => '{{PLURAL:$1|une note|$1 notes}}',
	'voteny-remove' => 'supprimer',
	'voteny-gave-this' => 'Vous avez noté $1',
	'voteny-votes' => '{{PLURAL:$1|un vote|$1 votes}}',
	'topratings' => 'Pages les mieux notées',
	'topratings-no-pages' => 'Aucune page notée.',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'voteny-desc' => 'Sistema de votación en JavaScript coa etiqueta <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Votar',
	'voteny-unvote-link' => 'retirar o voto',
	'voteny-community-score' => 'puntuación da comunidade: $1',
	'voteny-ratings' => '{{PLURAL:$1|unha valoración|$1 valoracións}}',
	'voteny-remove' => 'eliminar',
	'voteny-gave-this' => 'vostede deu un $1',
	'voteny-votes' => '{{PLURAL:$1|un voto|$1 votos}}',
	'topratings' => 'Páxinas mellor valoradas',
	'topratings-no-pages' => 'Non hai ningunha páxina valorada.',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'voteny-desc' => 'Wothłosowanje z tafličku <tt>&lt;vote&gt;</tt> na zakładźe JavaScripta',
	'voteny-link' => 'Wothłosować',
	'voteny-unvote-link' => 'Wothłosowanje anulować',
	'voteny-community-score' => 'Ličba hłosow zhromadźenstwa: $1',
	'voteny-ratings' => '{{PLURAL:$1|jedne pohódnoćenje|$1 pohódnoćeni|$1 pohódnoćenja|$1 pohódnoćenjow}}',
	'voteny-remove' => 'wotstronić',
	'voteny-gave-this' => 'sy tutomu $1 dał',
	'voteny-votes' => '{{PLURAL:$1|jedyn hłós|$1 hłosaj|$1 hłosy|$1 hłosow}}',
	'topratings' => 'Najwyše pohódnoćene strony',
	'topratings-no-pages' => 'Žane najwyše pohódnoćene strony.',
);

/** Italian (italiano)
 * @author Darth Kule
 */
$messages['it'] = array(
	'voteny-desc' => 'Sistema di voto basato su JavaScript con il tag <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Vota',
	'voteny-unvote-link' => 'rimuovi voto',
	'voteny-community-score' => 'punteggio della comunità: $1',
	'voteny-ratings' => '{{PLURAL:$1|un giudizio|$1 giudizi}}',
	'voteny-remove' => 'rimuovi',
	'voteny-gave-this' => 'hai dato $1',
	'voteny-votes' => '{{PLURAL:$1|un voto|$1 voti}}',
	'topratings' => 'Pagine migliori',
	'topratings-no-pages' => 'Nessuna pagina migliore.',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'voteny-desc' => '<tt>&lt;vote&gt;</tt> タグを使用した、JavaScript ベースの投票',
	'voteny-link' => '投票',
	'voteny-unvote-link' => '投票取り消し',
	'voteny-community-score' => 'コミュニティでの得点: $1',
	'voteny-ratings' => '{{PLURAL:$1|$1 評価}}',
	'voteny-remove' => '除去',
	'voteny-gave-this' => 'あなたはこれを $1 と評価しました',
	'voteny-votes' => '{{PLURAL:$1|$1 票}}',
	'topratings' => '評価が高いページ',
	'topratings-no-pages' => '評価が高いページはありません。',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'voteny-desc' => 'Гласање на основа на JavaScript со ознаката <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Гласај',
	'voteny-unvote-link' => 'повлечи глас',
	'voteny-community-score' => 'бодови од заедницата: $1',
	'voteny-ratings' => '{{PLURAL:$1|една оценка|$1 оценки}}',
	'voteny-remove' => 'отстрани',
	'voteny-gave-this' => 'страницава  ја оценивте со $1',
	'voteny-votes' => '{{PLURAL:$1|еден глас|$1 гласа}}',
	'topratings' => 'Водечки страници',
	'topratings-no-pages' => 'Нема водечки страници.',
);

/** Dutch (Nederlands)
 * @author Mitchel Corstjens
 * @author Siebrand
 */
$messages['nl'] = array(
	'voteny-desc' => 'Op JavaScript gebaseerde peilingen met het label <code>&lt;vote&gt;</code>',
	'voteny-link' => 'Stemmen',
	'voteny-unvote-link' => 'stem terugtrekken',
	'voteny-community-score' => 'gemeenschapsscore: $1',
	'voteny-ratings' => '{{PLURAL:$1|één waardering|$1 waarderingen}}',
	'voteny-remove' => 'verwijderen',
	'voteny-gave-this' => 'u heeft een $1 gegeven',
	'voteny-votes' => '{{PLURAL:$1|één stem|$1 stemmen}}',
	'topratings' => "Meest gewaardeerde pagina's",
	'topratings-no-pages' => "Er zijn nog geen meest gewaardeerde pagina's.",
);

/** Polish (polski) */
$messages['pl'] = array(
	'voteny-link' => 'Głosuj',
	'voteny-unvote-link' => 'Anuluj',
	'voteny-community-score' => 'Wynik wśród społeczności: $1',
	'voteny-ratings' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
	'voteny-remove' => 'usuń',
	'voteny-gave-this' => 'Oceniłeś to na $1',
	'voteny-votes' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 */
$messages['tl'] = array(
	'voteny-desc' => 'Botohan na nakabatay sa JavaScript na mayroong tatak na <tt>&lt;bumoto&gt;</tt>',
	'voteny-link' => 'Bumoto',
	'voteny-unvote-link' => 'huwag bumoto',
	'voteny-community-score' => 'puntos ng pamayanan: $1',
	'voteny-ratings' => '{{PLURAL:$1|isang pag-aantas|$1 mga pag-aantas}}',
	'voteny-remove' => 'tanggalin',
	'voteny-gave-this' => 'binigyan mo ito ng isang $1',
	'voteny-votes' => '{{PLURAL:$1| isang boto| $1 mga boto}}',
	'topratings' => 'Mga pahinang nangunguna sa pag-aantas',
	'topratings-no-pages' => 'Walang mga pahinang nangunguna sa pag-aantas.',
);

