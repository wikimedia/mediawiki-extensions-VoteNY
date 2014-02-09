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
 * @author Shirayuki
 */
$messages['qqq'] = array(
	'voteny-desc' => '{{desc|name=Vote NY|url=http://www.mediawiki.org/wiki/Extension:VoteNY}}',
	'voteny-link' => 'Link title',
	'voteny-unvote-link' => 'Displayed to the user after their vote has been successfully added; they can click on this link to remove their vote.',
	'voteny-community-score' => 'Community score is the average of votes a page has been given.

Parameters:
* $1 - the actual score in numbers (i.e. 4.5 or 3)',
	'voteny-ratings' => 'Parameters:
* $1 - the number of ratings, if said number is greater than 1',
	'voteny-remove' => 'Link title, clicking on this link removes your vote. Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'voteny-gave-this' => 'Followed by the action link text {{msg-mw|Voteny-remove}}.

Parameter:
* $1 - a number, the vote the user gave to the page.

Refer to the [[mw:File:VoteNY.png|image]] for details.',
	'voteny-votes' => 'Parameters:
* $1 - number of votes',
	'topratings' => '{{doc-special|TopRatings}}',
	'topratings-no-pages' => 'Displayed on Special:TopRatings if there are no top rated pages, i.e. if no pages have been rated on the wiki at all.',
	'right-vote' => '{{doc-right|vote|prefix=Voteny-}}
Right to place a vote on pages with the extension.',
);

/** Asturian (asturianu)
 * @author Xuacu
 */
$messages['ast'] = array(
	'voteny-desc' => 'Votación basada en JavaScript cola etiqueta <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Votar',
	'voteny-unvote-link' => 'retirar el votu',
	'voteny-community-score' => 'puntuación de la comunidá: $1',
	'voteny-ratings' => '{{PLURAL:$1|una valoración|$1 valoraciones}}',
	'voteny-remove' => 'desaniciar',
	'voteny-gave-this' => 'dio-y a esto un $1',
	'voteny-votes' => '{{PLURAL:$1|un votu|$1 votos}}',
	'topratings' => 'Páxines meyor calificaes',
	'topratings-no-pages' => 'Nun hai páxines meyor calificaes',
	'right-vote' => 'Votar páxines',
);

/** Bulgarian (български)
 * @author පසිඳු කාවින්ද
 */
$messages['bg'] = array(
	'voteny-remove' => 'премахване',
);

/** Catalan (català)
 * @author Toniher
 */
$messages['ca'] = array(
	'voteny-desc' => "Votació basada en JavaScript amb l'etiqueta <tt>&lt;vote&gt;</tt>",
	'voteny-link' => 'Vota',
	'voteny-unvote-link' => 'anul·la el vot',
	'voteny-community-score' => 'puntuació comunitària: $1',
	'voteny-ratings' => '{{PLURAL:$1|una valoració|$1 valoracions}}',
	'voteny-remove' => 'suprimeix',
	'voteny-gave-this' => 'vau donar-li un $1',
	'voteny-votes' => '{{PLURAL:$1|un vot|$1 vots}}',
	'topratings' => 'Pàgines més puntuades',
	'topratings-no-pages' => 'No hi ha cap pàgina puntuada.',
	'right-vote' => 'Pàgines de votació',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 * @author Purodha
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
	'right-vote' => 'Abstimmen über Seiten',
);

/** German (formal address) (Deutsch (Sie-Form)‎)
 * @author Kghbln
 */
$messages['de-formal'] = array(
	'voteny-gave-this' => 'Sie haben eine $1 vergeben.',
);

/** Zazaki (Zazaki)
 * @author Erdemaslancan
 * @author Mirzali
 */
$messages['diq'] = array(
	'voteny-link' => 'Rey',
	'voteny-unvote-link' => 'rey mede',
	'voteny-community-score' => 'Puwanê şêlıki: $1',
	'voteny-ratings' => '{{PLURAL:$1|yew nırğnayış|$1 nırğnayışi}}',
	'voteny-remove' => 'wedare',
	'voteny-votes' => '{{PLURAL:$1|yew rey|$1 reyi}}',
	'right-vote' => 'Pelê reydayışi',
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
	'right-vote' => 'Wótgłosowańske boki',
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
	'right-vote' => 'Páginas de votación',
);

/** Persian (فارسی)
 * @author Ebraminio
 * @author Mjbmr
 * @author Omidh
 */
$messages['fa'] = array(
	'voteny-desc' => 'سامانه‌ای بر اساس جاوااسکریپت برای رای‌گیری با تگ <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'رأی دهی',
	'voteny-unvote-link' => 'حذف رأی',
	'voteny-community-score' => 'امتیاز کلی: $1',
	'voteny-ratings' => '{{PLURAL:$1|یک امتیاز|$1 امتیاز}}',
	'voteny-remove' => 'حذف',
	'voteny-gave-this' => 'شما $1 امتیاز دادید',
	'voteny-votes' => '{{PLURAL:$1|یک رای|$1 رای}}',
	'topratings' => 'صفحات دارای امتیاز بالا',
	'topratings-no-pages' => 'صفحه‌هایی با امتیاز بالا وجود ندارند.',
	'right-vote' => 'صفحه‌های رأی',
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
 * @author Crochet.david
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
	'right-vote' => 'Pages de vote',
);

/** Franco-Provençal (arpetan)
 * @author ChrisPtDe
 */
$messages['frp'] = array(
	'voteny-link' => 'Votar',
	'voteny-unvote-link' => 'enlevar lo voto',
	'voteny-community-score' => 'mârca de la comunôtât : $1',
	'voteny-ratings' => '{{PLURAL:$1|yona èstimacion|$1 èstimacions}}',
	'voteny-remove' => 'enlevar',
	'voteny-gave-this' => 'vos éd balyê $1',
	'voteny-votes' => '{{PLURAL:$1|yon voto|$1 votos}}',
	'right-vote' => 'Votar des pâges',
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
	'right-vote' => 'Votar páxinas',
);

/** Hebrew (עברית)
 * @author חיים
 */
$messages['he'] = array(
	'voteny-link' => 'הצבעה',
	'voteny-unvote-link' => 'הסר הצבעה',
	'voteny-remove' => 'הסרה',
	'voteny-gave-this' => 'נתת לזה $1',
	'voteny-votes' => '{{PLURAL:$1|הצבעה אחת|$1 הצבעות}}',
	'right-vote' => 'דפי ההצבעה',
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
	'right-vote' => 'Wothłosowanske strony',
);

/** Indonesian (Bahasa Indonesia)
 * @author පසිඳු කාවින්ද
 */
$messages['id'] = array(
	'voteny-remove' => 'hapus',
);

/** Italian (italiano)
 * @author Beta16
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
	'right-vote' => 'Vota le pagine',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'voteny-desc' => '<tt>&lt;vote&gt;</tt> タグを使用した、JavaScript ベースの投票',
	'voteny-link' => '投票',
	'voteny-unvote-link' => '投票取り消し',
	'voteny-community-score' => 'コミュニティでの得点: $1',
	'voteny-ratings' => '{{PLURAL:$1|$1 件の評価}}',
	'voteny-remove' => '除去',
	'voteny-gave-this' => 'あなたはこれを $1 と評価しました',
	'voteny-votes' => '{{PLURAL:$1|$1 票}}',
	'topratings' => '評価が高いページ',
	'topratings-no-pages' => '評価が高いページはありません。',
	'right-vote' => 'ページに投票',
);

/** Georgian (ქართული)
 * @author David1010
 */
$messages['ka'] = array(
	'voteny-link' => 'ხმის მიცემა',
	'voteny-remove' => 'წაშლა',
);

/** Korean (한국어)
 * @author 아라
 */
$messages['ko'] = array(
	'voteny-desc' => '<tt>&lt;vote&gt;</tt> 태그로 자바스크립트 기반 투포',
	'voteny-link' => '투표',
	'voteny-unvote-link' => '투표 취소',
	'voteny-community-score' => '공동체 점수: $1',
	'voteny-ratings' => '{{PLURAL:$1|평가 한 개|평가 $1개}}',
	'voteny-remove' => '제거',
	'voteny-gave-this' => '이것을 $1(으)로 주었습니다',
	'voteny-votes' => '{{PLURAL:$1|한 표|$1표}}',
	'topratings' => '평가가 높은 문서',
	'topratings-no-pages' => '평가가 높은 문서가 없습니다.',
	'right-vote' => '문서 투표',
);

/** Colognian (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'voteny-desc' => 'Afschtemmonge met JavaSkrep övver dä Befähl <code lang="en">&lt;vote&gt;</code>.',
	'voteny-link' => 'Afschtemme',
	'voteny-unvote-link' => 'Schtemm zerökträke',
	'voteny-community-score' => 'Jemeinschafflejje Pünkscher: $1',
	'voteny-ratings' => '{{PLURAL:$1|Ein Bewertong|$1 Bewertonge|Kein Bewertonge}}',
	'voteny-remove' => 'fott nämme',
	'voteny-gave-this' => 'Do häs en $1 verjovve.',
	'voteny-votes' => '{{PLURAL:$1|Ein Schtemm|$1 Schtemme|Kein Schtemme}}',
	'topratings' => 'Sigge met de hühste Bewertonge',
	'topratings-no-pages' => 'Kein Sigge met hühste Bewertonge jefonge.',
	'right-vote' => 'Övver Siige afschtemme',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 */
$messages['lb'] = array(
	'voteny-link' => 'Ofstëmmen',
	'voteny-unvote-link' => 'Stëmm zréckzéien',
	'voteny-remove' => 'ewechhuelen',
	'voteny-gave-this' => 'Dir hutt eng $1 ofginn',
	'right-vote' => 'Ofstëmmen iwwer Säiten',
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
	'right-vote' => 'Гласање за страници',
);

/** Malay (Bahasa Melayu)
 * @author Anakmalaysia
 */
$messages['ms'] = array(
	'voteny-desc' => 'Pengundian berasaskan JavaScript dengan teg <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Undi',
	'voteny-unvote-link' => 'tarik balik undi',
	'voteny-community-score' => 'markah komuniti: $1',
	'voteny-ratings' => '$1 penilaian',
	'voteny-remove' => 'buang',
	'voteny-gave-this' => 'anda memberi yang ini $1',
	'voteny-votes' => '$1 undian',
	'topratings' => 'Halaman undian tertinggi',
	'topratings-no-pages' => 'Tiada halaman undian tertinggi.',
	'right-vote' => 'Mengundi halaman',
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
	'right-vote' => "Op pagina's stemmen",
);

/** Polish (polski)
 */
$messages['pl'] = array(
	'voteny-link' => 'Głosuj',
	'voteny-unvote-link' => 'Anuluj',
	'voteny-community-score' => 'Wynik wśród społeczności: $1',
	'voteny-ratings' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
	'voteny-remove' => 'usuń',
	'voteny-gave-this' => 'Oceniłeś to na $1',
	'voteny-votes' => '{{PLURAL:$1|1 głos|$1 głosy|$1 głosów}}',
);

/** Piedmontese (Piemontèis)
 * @author Borichèt
 * @author Dragonòt
 */
$messages['pms'] = array(
	'voteny-desc' => 'Votassion basà dzor JavaScript con la tichëtta <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Voté',
	'voteny-unvote-link' => 'scancelé vot',
	'voteny-community-score' => 'Pontegi dla comunità: $1',
	'voteny-ratings' => '{{PLURAL:$1|na valutassion|$1 valutassion}}',
	'voteny-remove' => 'gava',
	'voteny-gave-this' => "It l'has daje un $1",
	'voteny-votes' => '{{PLURAL:$1|un vot|$1 vot}}',
	'topratings' => 'Le pàgine valutà mej',
	'topratings-no-pages' => 'Gnun-e pàgine valutà.',
	'right-vote' => 'Pàgine ëd vot',
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 */
$messages['ps'] = array(
	'right-vote' => 'د رايې مخونه',
);

/** Brazilian Portuguese (português do Brasil)
 * @author Luckas
 */
$messages['pt-br'] = array(
	'voteny-link' => 'Votar',
	'voteny-remove' => 'remover',
	'voteny-votes' => '{{PLURAL:$1|um voto|$1 votos}}',
);

/** Romanian (română)
 * @author Minisarm
 * @author Stelistcristi
 */
$messages['ro'] = array(
	'voteny-link' => 'Votați',
	'voteny-remove' => 'elimină',
);

/** tarandíne (tarandíne)
 * @author Joetaras
 */
$messages['roa-tara'] = array(
	'voteny-desc' => "Votazione ca se base sus a JavaScript cu 'u tag <tt>&lt;vote&gt;</tt>",
	'voteny-link' => 'Vote',
	'voteny-unvote-link' => 'no vutà',
	'voteny-community-score' => "pundegge d'a comunitate: $1",
	'voteny-ratings' => "{{PLURAL:$1|'na valutazione|$1 valutaziune}}",
	'voteny-remove' => 'live',
	'voteny-gave-this' => 'Tu è date quiste $1',
	'voteny-votes' => "{{PLURAL:$1|'nu vote|$1 vote}}",
	'topratings' => 'Pàggene cchiù vutate',
	'topratings-no-pages' => "Pàggene ca no stonne 'ngape a le vote.",
	'right-vote' => 'Vote le vôsce',
);

/** Russian (русский)
 * @author Kaganer
 * @author Okras
 */
$messages['ru'] = array(
	'voteny-desc' => 'Голосование на основе JavaScript с использованием тега <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Голосовать',
	'voteny-unvote-link' => 'отменить выбор',
	'voteny-community-score' => 'оценка сообщества: $1',
	'voteny-ratings' => '{{PLURAL:$1|$1 балл|$1 баллов|$1 балла}}',
	'voteny-remove' => 'отменить',
	'voteny-gave-this' => 'Вы поставили $1',
	'voteny-votes' => '{{PLURAL:$1|$1 голос|$1 голосов|$1 голоса}}',
	'topratings' => 'Самые популярные страницы',
	'topratings-no-pages' => 'Нет популярных страниц.',
	'right-vote' => 'Страницы голосований',
);

/** Sinhala (සිංහල)
 * @author පසිඳු කාවින්ද
 */
$messages['si'] = array(
	'voteny-link' => 'ඡන්දය දෙන්න',
	'voteny-unvote-link' => 'මනාපය ලබා නොදෙන්න',
	'voteny-community-score' => 'ප්‍රජා ලකුණ: $1',
	'voteny-ratings' => '{{PLURAL:$1|තරාතිරමක්|තරාතිරම් $1 ක්}}',
	'voteny-remove' => 'ඉවත් කරන්න',
	'voteny-gave-this' => 'ඔබ මෙයට $1 දී ඇත',
	'voteny-votes' => '{{PLURAL:$1|මනාපයක්|මනාප $1 ක්}}',
	'topratings' => 'ඉහළ ශ්‍රේණිගත පිටු',
	'topratings-no-pages' => 'ඉහළ ශ්‍රේණිගත පිටු නොමැත.',
	'right-vote' => 'මනාප පිටු',
);

/** Swedish (svenska)
 * @author WikiPhoenix
 */
$messages['sv'] = array(
	'voteny-link' => 'Rösta',
	'voteny-unvote-link' => 'ta bort röst',
	'voteny-community-score' => 'gemenskapspoäng: $1',
	'voteny-ratings' => '{{PLURAL:$1|ett betyg|$1 betyg}}',
	'voteny-remove' => 'ta bort',
	'voteny-gave-this' => 'du gav detta $1',
	'voteny-votes' => '{{PLURAL:$1|en röst|$1 röster}}',
	'topratings' => 'Topplistade sidor',
	'topratings-no-pages' => 'Inga topplistade sidor.',
);

/** Tamil (தமிழ்)
 * @author மதனாஹரன்
 */
$messages['ta'] = array(
	'voteny-link' => 'வாக்களி',
	'voteny-remove' => 'நீக்கு',
);

/** Tagalog (Tagalog)
 * @author AnakngAraw
 * @author TheSleepyhollow02
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
	'right-vote' => 'Iboto ang mga pahina',
);

/** Ukrainian (українська)
 * @author Base
 */
$messages['uk'] = array(
	'voteny-desc' => 'Голосування на основі JavaScript із теґом <tt>&lt;vote&gt;</tt>',
	'voteny-link' => 'Голосувати',
	'voteny-unvote-link' => 'скасувати голос',
	'voteny-community-score' => 'середня оцінка: $1',
	'voteny-ratings' => '{{PLURAL:$1|один голос|$1 голоси|$1 голосів}}',
	'voteny-remove' => 'вилучити',
	'voteny-gave-this' => 'Ви оцінили це як $1',
	'voteny-votes' => '{{PLURAL:$1|один голос|$1 голоси|$1 голосів}}',
	'topratings' => 'Сторінки із найвищим оцінками',
	'topratings-no-pages' => 'Сторінки із не найвищими оцінками.',
	'right-vote' => 'Голосувати за сторінки',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Shirayuki
 * @author Yfdyh000
 */
$messages['zh-hans'] = array(
	'voteny-desc' => '基于JavaScript的投票与<tt>&lt;vote&gt;</tt>标签',
	'voteny-link' => '投票',
	'voteny-unvote-link' => '消票',
	'voteny-community-score' => '社区分数：$1',
	'voteny-ratings' => '{{PLURAL:$1|$1人评分}}',
	'voteny-remove' => '删除',
	'voteny-gave-this' => '您给了$1分',
	'voteny-votes' => '{{PLURAL:$1|$1票}}',
	'topratings' => '最受好评的页面',
	'topratings-no-pages' => '没有最受好评的页面。',
	'right-vote' => '投票页面',
);

/** Traditional Chinese (中文（繁體）‎)
 * @author Justincheng12345
 * @author Shirayuki
 */
$messages['zh-hant'] = array(
	'voteny-desc' => '基於JavaScript的投票與<tt>&lt;vote&gt;</tt>標記',
	'voteny-link' => '投票',
	'voteny-unvote-link' => '取消投票',
	'voteny-community-score' => '社羣積分：$1',
	'voteny-ratings' => '{{PLURAL:$1|$1個評級}}',
	'voteny-remove' => '移除',
	'voteny-gave-this' => '你給了$1分',
	'voteny-votes' => '{{PLURAL:$1|$1票}}',
	'topratings' => '最受好評的頁面',
	'topratings-no-pages' => '沒有最受好評的頁面。',
	'right-vote' => '投票頁面',
);
