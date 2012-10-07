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
 * @author Nemo bis
 */
$messages['qqq'] = array(
	'desc' => '{{desc}}',
	'link' => 'Link title',
	'unvote-link' => 'Displayed to the user after their vote has been successfully added; they can click on this link to remove their vote.',
	'community-score' => 'Community score is the average of votes a page has been given, $1 is the actual score in numbers (i.e. 4.5 or 3)',
	'ratings' => '<code>$1</code> is the number of ratings, if said number is greater than 1.',
	'remove' => 'Link title, clicking on this link removes your vote. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'gave-this' => '$1 is a number, the vote you gave to the page. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'votes' => '$1 is the number of votes.',
	'topratings' => 'Title of Special:TopRatings, as shown on the special page itself and on Special:SpecialPages',
	'topratings-no-pages' => 'Displayed on Special:TopRatings if there are no top rated pages, i.e. if no pages have been rated on the wiki at all.',
	'right-vote' => '{{doc-right}}
Right to place a vote on pages with the extension.',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 * @author Purodha
 */
$messages['de'] = array(
	'desc' => 'Ergänzt das Tag <tt>&lt;vote&gt;</tt> zum Durchführen JavaScript-gestützter Abstimmungen',
	'link' => 'Abstimmen',
	'unvote-link' => 'Stimme zurücknehmen',
	'community-score' => 'Punktestand der Gemeinschaft: $1',
	'ratings' => '{{PLURAL:$1|eine Bewertung|$1 Bewertungen}}',
	'remove' => 'entfernen',
	'gave-this' => 'Du hast eine $1 vergeben.',
	'votes' => '{{PLURAL:$1|eine Stimme|$1 Stimmen}}',
	'topratings' => 'Höchstbewertete Seiten',
	'topratings-no-pages' => 'Es sind keine höchstbewerteten Seiten vorhanden.',
	'right-vote' => 'Abstimmen über Seiten',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'gave-this' => 'Sie haben eine $1 vergeben.',
);

/** Lower Sorbian (dolnoserbski)
 * @author Michawiki
 */
$messages['dsb'] = array(
	'desc' => 'Wótgłosowanje z toflicku <tt>&lt;vote&gt;</tt> na zakłaźe JavaScripta',
	'link' => 'Wótgłosowaś',
	'unvote-link' => 'Wótgłosowanje anulěrowaś',
	'community-score' => 'Licba głosow zgromaźeństwa: $1',
	'ratings' => '{{PLURAL:$1|jadno pógódnośenje|$1 pógódnośeni|$1 pógódnośenja|$1 pógódnośenjow}}',
	'remove' => 'wótpóraś',
	'gave-this' => 'sy toś tomu $1 dał',
	'votes' => '{{PLURAL:$1|jaden głos|$1 głosa|$1 głose|$1 głosow}}',
	'topratings' => 'Nejwuše pógódnośone boki',
	'topratings-no-pages' => 'Žedne nejwuše pógódnośone boki.',
	'right-vote' => 'Wótgłosowańske boki',
);

/** Spanish (español)
 * @author Armando-Martin
 */
$messages['es'] = array(
	'desc' => 'Votación basada en JavaScript con la etiqueta <tt>&lt;vote&gt;</tt>',
	'link' => 'Votar',
	'unvote-link' => 'Eliminar voto',
	'community-score' => 'puntuación de la comunidad: $1',
	'ratings' => '{{PLURAL:$1|una valoración|$1 valoraciones}}',
	'remove' => 'eliminar',
	'gave-this' => 'le diste a esto un $1',
	'votes' => '{{PLURAL:$1|un voto|$1 votos}}',
	'topratings' => 'Páginas más valoradas',
	'topratings-no-pages' => 'No hay páginas mejor valoradas',
	'right-vote' => 'Páginas de votación',
);

/** Finnish (suomi)
 * @author Jack Phoenix <jack@countervandalism.net>
 * @author Nike
 */
$messages['fi'] = array(
	'link' => 'Äänestä',
	'unvote-link' => 'poista ääni',
	'community-score' => 'yhteisön antama pistemäärä: $1',
	'ratings' => '{{PLURAL:$1|yksi arvostelu|$1 arvostelua}}',
	'remove' => 'poista',
	'gave-this' => 'annoit {{PLURAL:$1|yhden tähden|$1 tähteä}}',
	'votes' => '{{PLURAL:$1|yksi ääni|$1 ääntä}}',
	'topratings' => 'Huippusivut',
	'topratings-no-pages' => 'Ei huippusivuja.',
);

/** French (français)
 * @author Jack Phoenix <jack@countervandalism.net>
 * @author Tititou36
 */
$messages['fr'] = array(
	'desc' => 'Système de vote en JavaScript avec la balise <tt>&lt;vote&gt;</tt>',
	'link' => 'Voter',
	'unvote-link' => 'supprimer vote',
	'community-score' => 'note de la communauté : $1',
	'ratings' => '{{PLURAL:$1|une note|$1 notes}}',
	'remove' => 'supprimer',
	'gave-this' => 'Vous avez noté $1',
	'votes' => '{{PLURAL:$1|un vote|$1 votes}}',
	'topratings' => 'Pages les mieux notées',
	'topratings-no-pages' => 'Aucune page notée.',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'desc' => 'Sistema de votación en JavaScript coa etiqueta <tt>&lt;vote&gt;</tt>',
	'link' => 'Votar',
	'unvote-link' => 'retirar o voto',
	'community-score' => 'puntuación da comunidade: $1',
	'ratings' => '{{PLURAL:$1|unha valoración|$1 valoracións}}',
	'remove' => 'eliminar',
	'gave-this' => 'vostede deu un $1',
	'votes' => '{{PLURAL:$1|un voto|$1 votos}}',
	'topratings' => 'Páxinas mellor valoradas',
	'topratings-no-pages' => 'Non hai ningunha páxina valorada.',
	'right-vote' => 'Votar páxinas',
);

/** Upper Sorbian (hornjoserbsce)
 * @author Michawiki
 */
$messages['hsb'] = array(
	'desc' => 'Wothłosowanje z tafličku <tt>&lt;vote&gt;</tt> na zakładźe JavaScripta',
	'link' => 'Wothłosować',
	'unvote-link' => 'Wothłosowanje anulować',
	'community-score' => 'Ličba hłosow zhromadźenstwa: $1',
	'ratings' => '{{PLURAL:$1|jedne pohódnoćenje|$1 pohódnoćeni|$1 pohódnoćenja|$1 pohódnoćenjow}}',
	'remove' => 'wotstronić',
	'gave-this' => 'sy tutomu $1 dał',
	'votes' => '{{PLURAL:$1|jedyn hłós|$1 hłosaj|$1 hłosy|$1 hłosow}}',
	'topratings' => 'Najwyše pohódnoćene strony',
	'topratings-no-pages' => 'Žane najwyše pohódnoćene strony.',
	'right-vote' => 'Wothłosowanske strony',
);

/** Italian (italiano)
 * @author Beta16
 * @author Darth Kule
 */
$messages['it'] = array(
	'desc' => 'Sistema di voto basato su JavaScript con il tag <tt>&lt;vote&gt;</tt>',
	'link' => 'Vota',
	'unvote-link' => 'rimuovi voto',
	'community-score' => 'punteggio della comunità: $1',
	'ratings' => '{{PLURAL:$1|un giudizio|$1 giudizi}}',
	'remove' => 'rimuovi',
	'gave-this' => 'hai dato $1',
	'votes' => '{{PLURAL:$1|un voto|$1 voti}}',
	'topratings' => 'Pagine migliori',
	'topratings-no-pages' => 'Nessuna pagina migliore.',
	'right-vote' => 'Vota le pagine',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'desc' => '<tt>&lt;vote&gt;</tt> タグを使用した、JavaScript ベースの投票',
	'link' => '投票',
	'unvote-link' => '投票取り消し',
	'community-score' => 'コミュニティでの得点: $1',
	'ratings' => '{{PLURAL:$1|$1 評価}}',
	'remove' => '除去',
	'gave-this' => 'あなたはこれを $1 と評価しました',
	'votes' => '{{PLURAL:$1|$1 票}}',
	'topratings' => '評価が高いページ',
	'topratings-no-pages' => '評価が高いページはありません。',
	'right-vote' => 'ページに投票',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'link' => 'ხმის მიცემა',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'desc' => 'Afschtemmonge met JavaSkrep övver dä Befähl <code lang="en">&lt;vote&gt;</code>.',
	'link' => 'Afschtemme',
	'unvote-link' => 'Schtemm zerökträke',
	'community-score' => 'Jemeinschafflejje Pünkscher: $1',
	'ratings' => '{{PLURAL:$1|Ein Bewertong|$1 Bewertonge|Kein Bewertonge}}',
	'remove' => 'fott nämme',
	'gave-this' => 'Do häs en $1 verjovve.',
	'votes' => '{{PLURAL:$1|Ein Schtemm|$1 Schtemme|Kein Schtemme}}',
	'topratings' => 'Sigge met de hühste Bewertonge',
	'topratings-no-pages' => 'Kein Sigge met hühste Bewertonge jefonge.',
	'right-vote' => 'Övver Siige afschtemme',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'link' => 'Ofstëmmen',
	'unvote-link' => 'Stëmm zréckzéien',
	'remove' => 'ewechhuelen',
	'gave-this' => 'Dir hutt eng $1 ofginn',
	'right-vote' => 'Ofstëmmen iwwer Säiten',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'desc' => 'Гласање на основа на JavaScript со ознаката <tt>&lt;vote&gt;</tt>',
	'link' => 'Гласај',
	'unvote-link' => 'повлечи глас',
	'community-score' => 'бодови од заедницата: $1',
	'ratings' => '{{PLURAL:$1|една оценка|$1 оценки}}',
	'remove' => 'отстрани',
	'gave-this' => 'страницава  ја оценивте со $1',
	'votes' => '{{PLURAL:$1|еден глас|$1 гласа}}',
	'topratings' => 'Водечки страници',
	'topratings-no-pages' => 'Нема водечки страници.',
	'right-vote' => 'Гласање за страници',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'desc' => 'Pengundian berasaskan JavaScript dengan teg <tt>&lt;vote&gt;</tt>',
	'link' => 'Undi',
	'unvote-link' => 'tarik balik undi',
	'community-score' => 'markah komuniti: $1',
	'ratings' => '$1 penilaian',
	'remove' => 'buang',
	'gave-this' => 'anda memberi yang ini $1',
	'votes' => '$1 undian',
);

/** Dutch (Nederlands)
 * @author Mitchel Corstjens
 * @author Siebrand
 */
$messages['nl'] = array(
	'desc' => 'Op JavaScript gebaseerde peilingen met het label <code>&lt;vote&gt;</code>',
	'link' => 'Stemmen',
	'unvote-link' => 'stem terugtrekken',
	'community-score' => 'gemeenschapsscore: $1',
	'ratings' => '{{PLURAL:$1|één waardering|$1 waarderingen}}',
	'remove' => 'verwijderen',
	'gave-this' => 'u heeft een $1 gegeven',
	'votes' => '{{PLURAL:$1|één stem|$1 stemmen}}',
	'topratings' => "Meest gewaardeerde pagina's",
	'topratings-no-pages' => "Er zijn nog geen meest gewaardeerde pagina's.",
	'right-vote' => "Op pagina's stemmen",
);

/** Polish (polski) */
$messages['pl'] = array(
	'link' => 'Głosuj',
	'unvote-link' => 'Anuluj',
	'community-score' => 'Wynik wśród społeczności: $1',
	'ratings' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
	'remove' => 'usuń',
	'gave-this' => 'Oceniłeś to na $1',
	'votes' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 * @author TheSleepyhollow02
 */
$messages['tl'] = array(
	'desc' => 'Botohan na nakabatay sa JavaScript na mayroong tatak na <tt>&lt;bumoto&gt;</tt>',
	'link' => 'Bumoto',
	'unvote-link' => 'huwag bumoto',
	'community-score' => 'puntos ng pamayanan: $1',
	'ratings' => '{{PLURAL:$1|isang pag-aantas|$1 mga pag-aantas}}',
	'remove' => 'tanggalin',
	'gave-this' => 'binigyan mo ito ng isang $1',
	'votes' => '{{PLURAL:$1| isang boto| $1 mga boto}}',
	'topratings' => 'Mga pahinang nangunguna sa pag-aantas',
	'topratings-no-pages' => 'Walang mga pahinang nangunguna sa pag-aantas.',
	'right-vote' => 'Iboto ang mga pahina',
);

