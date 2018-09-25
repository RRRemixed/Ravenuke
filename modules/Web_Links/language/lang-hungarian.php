<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please go to the site and send to me        */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
global $anonwaitdays, $outsidewaitdays, $sitename;
define("_1WEEK","1 hét");
define("_2WEEKS","2 hét");
define("_30DAYS","30 nap");
define("_ADDALINK","Új link hozzáadása");
define("_ADDEDON","Felvétel napja");
define("_ADDITIONALDET","Egyéb részletek");
define("_ADDLINK","Link hozzáadása");
define("_ADDURL","Link hozzáadása");
define("_ALLOWTORATE","Tegye lehetõvé, hogy mások is értékelni tudják az Ön oldaláról!");
define("_AND","és");
define("_BESTRATED","Legjobb értéket kapott oldalak");
define("_BREAKDOWNBYVAL","Értékelés eloszlása");
define("_BUTTONLINK","Nyomógomb");
define("_CATEGORIES","kategória");
if (!defined('_CATEGORY')) define("_CATEGORY","Kategória");
define("_CATLAST3DAYS","A kategória új linkjei az elmúlt három napban");
define("_CATNEWTODAY","A kategória mai új linkjei");
define("_CATTHISWEEK","A kategória új linkjei az elmúlt héten");
define("_CHECKFORIT","Nem adott meg e-mail címet. Hamarosan ellenõrizzük a linket, és bekerül az adatbázisba.");
define("_COMPLETEVOTE1","Elfogadtuk a szavazatát.");
define("_COMPLETEVOTE2","Már szavazott az elmúlt $anonwaitdays napban.");
define("_COMPLETEVOTE3","Csak egyszer szavazzon egy linkre.<br>Minden szavazatot rögzítünk és felülvizsgálunk.");
define("_COMPLETEVOTE4","Nem szavazhat a saját maga által beküldött linkre.<br>Minden szavazatot rögzítünk és felülvizsgálunk.");
define("_COMPLETEVOTE5","Nem volt kijelölve választási lehetõség, ezért a szavazatát nem fogadtuk el.");
define("_COMPLETEVOTE6","$outsidewaitdays napon belül egy IP címrõl csak egyszer lehet szavazni.");
define("_DATE","Dátum");
define("_DATE1","Dátum (elõször a régebbiek)");
define("_DATE2","Dátum (elõször az újabbak)");
define("_DAYS","napban");
define("_DESCRIPTION","Leírás");
define("_DETAILS","Részletek");
define("_EDITORIAL","Szerkesztõi vélemény");
define("_EDITORIALBY","Szerkesztõ:");
define("_EDITORREVIEW","Szerkesztõi vélemény");
define("_EDITTHISLINK","Link szerkesztése");
define("_EMAILWHENADD","A link jóváhagyásakor e-mailt küldünk Önnek is.");
define("_FEELFREE2ADD","Nyugodtan küldje el megjegyzését ezzel a weboldallal kapcsolatban.");
define('_HIGHRATING','Legmagasabb osztályzat');
define('_HITS','találat');
define("_HTMLCODE1","Ebben az esetben használja a következõ HTML kódot:");
define("_HTMLCODE2","A fenti gomb forráskódja:");
define("_HTMLCODE3","Ezzel az ûrlappal a látogatói közvetlenül szavazhatnak a weboldalára, a szavazatokat pedig mi tároljuk. A fenti ûrlap nem mûködik, de a következõ kód mûködni fog, ha beszúrja a weboldala forrásába:");
define("_IDREFER","szám a HTML forrásban az Ön weboldalának azonosító száma a(z) $sitename adatbázisában. Vigyázzon, nehogy kihagyja!");
define("_IFYOUWEREREG","Regisztrált felhasználóként megjegyzéseket fûzhetne ehhez a weboldalhoz.");
define("_INDB","található az adatbázisban");
define("_INOTHERSENGINES","más keresõkkel");
define("_INSTRUCTIONS","Útmutató");
define("_ISTHISYOURSITE","Ön küldte be ezt a linket?");
define("_LAST30DAYS","Múlt hónapban");
define("_LASTWEEK","Múlt héten");
define("_LDESCRIPTION","Leírás: (max. 255 karakter)");
define("_LETSDECIDE","A visszajelzések segítik, hogy látogatóink a megfelelõ linkekre kattintsanak.");
define("_LINKALREADYEXT","HIBA: Ez az URL már benne van az adatbázisunkban!");
define("_LINKCOMMENTS","Megjegyzések");
define("_LINKID","Link száma");
define("_LINKNODESC","HIBA: Kérem, adja meg az URL rövid leírását is!");
define("_LINKNOTITLE","HIBA: Az URL címét is add meg!");
define("_LINKNOURL","HIBA: Elfelejtette megadni magát az URL-t!");
define("_LINKPROFILE","Az oldal neve");
define("_LINKRATING","Link értékelése");
define("_LINKRATINGDET","Link értékelésének részletei");
define("_LINKRECEIVED","Az Ön által megadott adatokat regisztráltuk. Köszönjük!");
define("_LINKS","link");
define("_LINKSDATESTRING","%Y. %m. %d.");
define("_LINKSMAIN","Linkek kezdõoldala");
define("_LINKSMAINCAT","Linkek - fõ kategóriák");
define('_LINKSNOCATS1','Legalább egy link kategóriát létre kell hoznia a'); //montego for RN0000571
define('_LINKSNOCATS2','webadminnak, mielõtt új linket hozzá tud adni.'); //montego for RN0000571
define("_LINKSNOTUSER1","Ön nem regisztrált felhasználónk, vagy nem lépett be.");
define("_LINKSNOTUSER2","Ha regisztrálná magát, Ön is hozzáadhatna új linkeket.");
define("_LINKSNOTUSER3","A regisztráció gyors és igen egyszerû folyamat.");
define("_LINKSNOTUSER4","Hogy miért kérünk regisztrációt egyes oldalakon?");
define("_LINKSNOTUSER5","Hogy a legmagasabb szintû tartalommal szolgálhassunk,");
define("_LINKSNOTUSER6","minden bevitt adatot egyesével ellenõriznek munkatársaink.");
define("_LINKSNOTUSER7","Reméljük, mindenhol sikerül értékes információkat nyújtanunk.");
define("_LINKSNOTUSER8","<a href=\"modules.php?name=Your_Account\">Regisztrálja magát!</a>");
define("_LINKTITLE","A céloldal neve");
define("_LINKVOTE","Szavazzon!");
define("_LOOKTOREQUEST","Hamarosan ellenõrizzük az információit.");
define("_LOWRATING","Legalacsonyabb érték");
define("_LTOTALVOTES","szavazat");
define("_LVOTES","szavazat");
define("_MAIN","Fõoldal");
define("_MODIFY","Változtatás");
define("_MOSTPOPULAR","Legkedveltebb");
define("_NEW","Legújabb");
define("_NEWLAST3DAYS","Az elmúlt három nap linkjei");
define("_NEWLINKS","Új linkek");
define("_NEWTHISWEEK","Az elmúlt hét linkjei");
define("_NEWTODAY","Mai linkek");
define("_NEXT","Következõ oldal");
define("_NOEDITORIAL","Errõl a weboldalról még nincs szerkesztõi vélemény.");
define("_NOMATCHES","A keresés nem eredményezett találatot");
define("_NOOUTSIDEVOTES","Más weboldalakon még nem értékelték");
define("_NOREGUSERSVOTES","Regisztrált felhasználó még nem értékelte");
define("_NOUNREGUSERSVOTES","Regisztrálatlan látogató még nem értékelte");
define("_NUMBEROFRATINGS","Értékelések száma");
define("_NUMOFCOMMENTS","Megjegyzések száma");
define("_NUMRATINGS","Értkelések száma");
if (!defined('_OF')) define("_OF","-");
define("_OFALL","az összesbõl");
define("_ONLYREGUSERSMODIFY","Csak regisztrált felhasználók kérhetnek linkmódosítást. Kérem <a href=\"modules.php?name=Your_Account\">regisztrálon, vagy jelentkezzen be</a>!");
define("_OUTSIDEVOTERS","Szavazatok más weboldalakról");
define("_OVERALLRATING","Átlag");
define("_PAGETITLE","Az oldal címe");
define("_PAGEURL","Link");
define("_POPULAR","Legnépszerûbb");
define("_POPULARITY","Népszerûség");
define("_POPULARITY1","Népszerûség (növekvõ sorrend)");
define("_POPULARITY2","Népszerûség (csökkenõ sorrend)");
define("_POSTPENDING","A linkek csak ellenõrzés után kerülnek az adatbázisba.");
define("_PREVIOUS","Elõzõ oldal");
define("_PROMOTE01","Talán érdekli valamelyik 'Szavazzon erre a weboldalra' lehetõségünk. Ezek lehetõvé teszik egy link (vagy akár szavazóûrlap) elhelyezését az Ön weboldalán, hogy növelje az oldala szavazatainak számát. Válasszon a lenti lehetõségek közül:");
define("_PROMOTE02","Látogatói szavazhatnak egyszerû szöveges link segítségével:");
define("_PROMOTE03","Ha esetleg többet szeretne, mint egy egyszerû szöveglink, használhat nyomógombot:");
define("_PROMOTE04","Ha valaki csal, a linkjét eltávolítjuk. Így fog kinézni a kérdõív, amellyel az oldalát más weboldalakról is értékelhetik:");
define("_PROMOTE05","Köszönöm! és sok sikert a szavazatokkal!");
define("_PROMOTEYOURSITE","Népszerûsítse a weboldalát");
define("_RANDOM","Véletlenszerûen");
define("_RATEIT","Szavazzon erre az oldalra!");
define("_RATENOTE1","Kérem, ne szavazzon kétszer egy linkre.");
define("_RATENOTE2","1-10-ig értékelhet, az 1-es a leggyengébb, a 10-es a legjobb érték.");
define("_RATENOTE3","Kérjem, értékeljen objektívan, ha mindenki egyest vagy tizest kap, nem sok segítséget nyújtanak az értékelések...");
define("_RATENOTE4","Megnézheti a <a href=\"modules.php?name=Web_Links&amp;l_op=TopRated\">legjobb értékeket kapott oldalak</a> listáját.");
define("_RATENOTE5","Ha lehet, ne szavazzon saját, vagy közvetlen versenytársai weboldalára.");
define("_RATESITE","Értékelje ezt az oldalt");
define("_RATETHISSITE","Értékelje ezt a weboldalt");
define("_RATING","értékelés");
define("_RATING1","Értékelések (növekvõ sorrend)");
define("_RATING2","Értékelések (csökkenõ sorrend)");
define("_REGISTEREDUSERS","Regisztrált felhasználók");
define("_REMOTEFORM","Távoli szavazóûrlap");
define("_REPORTBROKEN","Törött link bejelentése");
define("_REQUESTLINKMOD","Link változtatásának kérése");
define("_RETURNTO","Vissza az elõzõ oldalra:");
define("_SCOMMENTS","Megjegyzések");
define("_SEARCHRESULTS4","Keresés:");
define("_SELECTPAGE","Válasszon oldalt");
define("_SENDREQUEST","Kérés elküldése");
define("_SHOW","Megtekintés");
define("_SHOWTOP","Legnézettebb");
define("_SITESSORTED","Jelenlegi sorbarendezés:");
define("_SORTLINKSBY","Sorbarendezés:");
define("_STAFF","Munkatársak");
define("_SUBMITONCE","Egy linket csak egyszer küldjön el.");
define("_TEXTLINK","Szöveges link");
define("_THANKSBROKEN","Köszönöm, hogy segít fenntartani a linktárunk mûködését.");
define("_THANKSFORINFO","Köszönjük az információt.");
define("_THANKSTOTAKETIME","Köszönöm, hogy idõt szánt egy oldal értékelésere itt nálam -");
define("_THENUMBER","A");
define("_THEREARE","Jelenleg");
define("_TITLE","Cím");
define("_TITLEAZ","Cím (A-Z)");
define("_TITLEZA","Cím (Z-A)");
define("_TO","Címzett");
define("_TOPRATED","Legjobbra osztályozott");
define("_TOTALFORLAST","Összes link az elmúlt");
define("_TOTALNEWLINKS","Linkek száma összesen");
define("_TOTALOF","Összesen");
define("_TOTALVOTES","Összes szavazat:");
define("_TRATEDLINKS","összesen értékelt oldal");
define("_TRY2SEARCH","Keresés");
define("_TVOTESREQ","a minimálisan szükséges szavazatok sz.");
define("_UNREGISTEREDUSERS","Nem regisztrált látogatók");
define("_URL","URL");
define("_USER","felhasználó");
define("_USERANDIP","A felhasználónév és az IP cím feljegyzésre kerül, kérem, ne éljen vissza a rendszerrel.");
define("_USERAVGRATING","felhasználók átlagos értékelése");
define("_USUBCATEGORIES","Alkategóriák");
define("_VISITTHISSITE","Látogassa meg ezt a weboldalt");
define("_VOTE4THISSITE","Szavazzon erre az oldalra!");
define("_WEBLINKS","Linkek");
define("_WEIGHNOTE","* Megjegyzés: a regisztrált felhasználók értékelése többet nyom, mint a látogatóké");
define("_WEIGHOUTNOTE","* Megjegyzés: a regisztrált felhasználók értékelése többet nyom, mint a más weboldalakon szavazóké");
define("_YOUARENOTREGGED","Nem regisztrált felhasználónk, vagy nem lépett be.");
define("_YOUAREREGGED","Ön regisztrált felhasználó, és belépett.");
define("_YOUREMAIL","e-mail címe");
define("_YOURNAME","Neve");
?>