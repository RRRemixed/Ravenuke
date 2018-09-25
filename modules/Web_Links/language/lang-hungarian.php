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
define("_1WEEK","1 h�t");
define("_2WEEKS","2 h�t");
define("_30DAYS","30 nap");
define("_ADDALINK","�j link hozz�ad�sa");
define("_ADDEDON","Felv�tel napja");
define("_ADDITIONALDET","Egy�b r�szletek");
define("_ADDLINK","Link hozz�ad�sa");
define("_ADDURL","Link hozz�ad�sa");
define("_ALLOWTORATE","Tegye lehet�v�, hogy m�sok is �rt�kelni tudj�k az �n oldal�r�l!");
define("_AND","�s");
define("_BESTRATED","Legjobb �rt�ket kapott oldalak");
define("_BREAKDOWNBYVAL","�rt�kel�s eloszl�sa");
define("_BUTTONLINK","Nyom�gomb");
define("_CATEGORIES","kateg�ria");
if (!defined('_CATEGORY')) define("_CATEGORY","Kateg�ria");
define("_CATLAST3DAYS","A kateg�ria �j linkjei az elm�lt h�rom napban");
define("_CATNEWTODAY","A kateg�ria mai �j linkjei");
define("_CATTHISWEEK","A kateg�ria �j linkjei az elm�lt h�ten");
define("_CHECKFORIT","Nem adott meg e-mail c�met. Hamarosan ellen�rizz�k a linket, �s beker�l az adatb�zisba.");
define("_COMPLETEVOTE1","Elfogadtuk a szavazat�t.");
define("_COMPLETEVOTE2","M�r szavazott az elm�lt $anonwaitdays napban.");
define("_COMPLETEVOTE3","Csak egyszer szavazzon egy linkre.<br>Minden szavazatot r�gz�t�nk �s fel�lvizsg�lunk.");
define("_COMPLETEVOTE4","Nem szavazhat a saj�t maga �ltal bek�ld�tt linkre.<br>Minden szavazatot r�gz�t�nk �s fel�lvizsg�lunk.");
define("_COMPLETEVOTE5","Nem volt kijel�lve v�laszt�si lehet�s�g, ez�rt a szavazat�t nem fogadtuk el.");
define("_COMPLETEVOTE6","$outsidewaitdays napon bel�l egy IP c�mr�l csak egyszer lehet szavazni.");
define("_DATE","D�tum");
define("_DATE1","D�tum (el�sz�r a r�gebbiek)");
define("_DATE2","D�tum (el�sz�r az �jabbak)");
define("_DAYS","napban");
define("_DESCRIPTION","Le�r�s");
define("_DETAILS","R�szletek");
define("_EDITORIAL","Szerkeszt�i v�lem�ny");
define("_EDITORIALBY","Szerkeszt�:");
define("_EDITORREVIEW","Szerkeszt�i v�lem�ny");
define("_EDITTHISLINK","Link szerkeszt�se");
define("_EMAILWHENADD","A link j�v�hagy�sakor e-mailt k�ld�nk �nnek is.");
define("_FEELFREE2ADD","Nyugodtan k�ldje el megjegyz�s�t ezzel a weboldallal kapcsolatban.");
define('_HIGHRATING','Legmagasabb oszt�lyzat');
define('_HITS','tal�lat');
define("_HTMLCODE1","Ebben az esetben haszn�lja a k�vetkez� HTML k�dot:");
define("_HTMLCODE2","A fenti gomb forr�sk�dja:");
define("_HTMLCODE3","Ezzel az �rlappal a l�togat�i k�zvetlen�l szavazhatnak a weboldal�ra, a szavazatokat pedig mi t�roljuk. A fenti �rlap nem m�k�dik, de a k�vetkez� k�d m�k�dni fog, ha besz�rja a weboldala forr�s�ba:");
define("_IDREFER","sz�m a HTML forr�sban az �n weboldal�nak azonos�t� sz�ma a(z) $sitename adatb�zis�ban. Vigy�zzon, nehogy kihagyja!");
define("_IFYOUWEREREG","Regisztr�lt felhaszn�l�k�nt megjegyz�seket f�zhetne ehhez a weboldalhoz.");
define("_INDB","tal�lhat� az adatb�zisban");
define("_INOTHERSENGINES","m�s keres�kkel");
define("_INSTRUCTIONS","�tmutat�");
define("_ISTHISYOURSITE","�n k�ldte be ezt a linket?");
define("_LAST30DAYS","M�lt h�napban");
define("_LASTWEEK","M�lt h�ten");
define("_LDESCRIPTION","Le�r�s: (max. 255 karakter)");
define("_LETSDECIDE","A visszajelz�sek seg�tik, hogy l�togat�ink a megfelel� linkekre kattintsanak.");
define("_LINKALREADYEXT","HIBA: Ez az URL m�r benne van az adatb�zisunkban!");
define("_LINKCOMMENTS","Megjegyz�sek");
define("_LINKID","Link sz�ma");
define("_LINKNODESC","HIBA: K�rem, adja meg az URL r�vid le�r�s�t is!");
define("_LINKNOTITLE","HIBA: Az URL c�m�t is add meg!");
define("_LINKNOURL","HIBA: Elfelejtette megadni mag�t az URL-t!");
define("_LINKPROFILE","Az oldal neve");
define("_LINKRATING","Link �rt�kel�se");
define("_LINKRATINGDET","Link �rt�kel�s�nek r�szletei");
define("_LINKRECEIVED","Az �n �ltal megadott adatokat regisztr�ltuk. K�sz�nj�k!");
define("_LINKS","link");
define("_LINKSDATESTRING","%Y. %m. %d.");
define("_LINKSMAIN","Linkek kezd�oldala");
define("_LINKSMAINCAT","Linkek - f� kateg�ri�k");
define('_LINKSNOCATS1','Legal�bb egy link kateg�ri�t l�tre kell hoznia a'); //montego for RN0000571
define('_LINKSNOCATS2','webadminnak, miel�tt �j linket hozz� tud adni.'); //montego for RN0000571
define("_LINKSNOTUSER1","�n nem regisztr�lt felhaszn�l�nk, vagy nem l�pett be.");
define("_LINKSNOTUSER2","Ha regisztr�ln� mag�t, �n is hozz�adhatna �j linkeket.");
define("_LINKSNOTUSER3","A regisztr�ci� gyors �s igen egyszer� folyamat.");
define("_LINKSNOTUSER4","Hogy mi�rt k�r�nk regisztr�ci�t egyes oldalakon?");
define("_LINKSNOTUSER5","Hogy a legmagasabb szint� tartalommal szolg�lhassunk,");
define("_LINKSNOTUSER6","minden bevitt adatot egyes�vel ellen�riznek munkat�rsaink.");
define("_LINKSNOTUSER7","Rem�lj�k, mindenhol siker�l �rt�kes inform�ci�kat ny�jtanunk.");
define("_LINKSNOTUSER8","<a href=\"modules.php?name=Your_Account\">Regisztr�lja mag�t!</a>");
define("_LINKTITLE","A c�loldal neve");
define("_LINKVOTE","Szavazzon!");
define("_LOOKTOREQUEST","Hamarosan ellen�rizz�k az inform�ci�it.");
define("_LOWRATING","Legalacsonyabb �rt�k");
define("_LTOTALVOTES","szavazat");
define("_LVOTES","szavazat");
define("_MAIN","F�oldal");
define("_MODIFY","V�ltoztat�s");
define("_MOSTPOPULAR","Legkedveltebb");
define("_NEW","Leg�jabb");
define("_NEWLAST3DAYS","Az elm�lt h�rom nap linkjei");
define("_NEWLINKS","�j linkek");
define("_NEWTHISWEEK","Az elm�lt h�t linkjei");
define("_NEWTODAY","Mai linkek");
define("_NEXT","K�vetkez� oldal");
define("_NOEDITORIAL","Err�l a weboldalr�l m�g nincs szerkeszt�i v�lem�ny.");
define("_NOMATCHES","A keres�s nem eredm�nyezett tal�latot");
define("_NOOUTSIDEVOTES","M�s weboldalakon m�g nem �rt�kelt�k");
define("_NOREGUSERSVOTES","Regisztr�lt felhaszn�l� m�g nem �rt�kelte");
define("_NOUNREGUSERSVOTES","Regisztr�latlan l�togat� m�g nem �rt�kelte");
define("_NUMBEROFRATINGS","�rt�kel�sek sz�ma");
define("_NUMOFCOMMENTS","Megjegyz�sek sz�ma");
define("_NUMRATINGS","�rtkel�sek sz�ma");
if (!defined('_OF')) define("_OF","-");
define("_OFALL","az �sszesb�l");
define("_ONLYREGUSERSMODIFY","Csak regisztr�lt felhaszn�l�k k�rhetnek linkm�dos�t�st. K�rem <a href=\"modules.php?name=Your_Account\">regisztr�lon, vagy jelentkezzen be</a>!");
define("_OUTSIDEVOTERS","Szavazatok m�s weboldalakr�l");
define("_OVERALLRATING","�tlag");
define("_PAGETITLE","Az oldal c�me");
define("_PAGEURL","Link");
define("_POPULAR","Legn�pszer�bb");
define("_POPULARITY","N�pszer�s�g");
define("_POPULARITY1","N�pszer�s�g (n�vekv� sorrend)");
define("_POPULARITY2","N�pszer�s�g (cs�kken� sorrend)");
define("_POSTPENDING","A linkek csak ellen�rz�s ut�n ker�lnek az adatb�zisba.");
define("_PREVIOUS","El�z� oldal");
define("_PROMOTE01","Tal�n �rdekli valamelyik 'Szavazzon erre a weboldalra' lehet�s�g�nk. Ezek lehet�v� teszik egy link (vagy ak�r szavaz��rlap) elhelyez�s�t az �n weboldal�n, hogy n�velje az oldala szavazatainak sz�m�t. V�lasszon a lenti lehet�s�gek k�z�l:");
define("_PROMOTE02","L�togat�i szavazhatnak egyszer� sz�veges link seg�ts�g�vel:");
define("_PROMOTE03","Ha esetleg t�bbet szeretne, mint egy egyszer� sz�veglink, haszn�lhat nyom�gombot:");
define("_PROMOTE04","Ha valaki csal, a linkj�t elt�vol�tjuk. �gy fog kin�zni a k�rd��v, amellyel az oldal�t m�s weboldalakr�l is �rt�kelhetik:");
define("_PROMOTE05","K�sz�n�m! �s sok sikert a szavazatokkal!");
define("_PROMOTEYOURSITE","N�pszer�s�tse a weboldal�t");
define("_RANDOM","V�letlenszer�en");
define("_RATEIT","Szavazzon erre az oldalra!");
define("_RATENOTE1","K�rem, ne szavazzon k�tszer egy linkre.");
define("_RATENOTE2","1-10-ig �rt�kelhet, az 1-es a leggyeng�bb, a 10-es a legjobb �rt�k.");
define("_RATENOTE3","K�rjem, �rt�keljen objekt�van, ha mindenki egyest vagy tizest kap, nem sok seg�ts�get ny�jtanak az �rt�kel�sek...");
define("_RATENOTE4","Megn�zheti a <a href=\"modules.php?name=Web_Links&amp;l_op=TopRated\">legjobb �rt�keket kapott oldalak</a> list�j�t.");
define("_RATENOTE5","Ha lehet, ne szavazzon saj�t, vagy k�zvetlen versenyt�rsai weboldal�ra.");
define("_RATESITE","�rt�kelje ezt az oldalt");
define("_RATETHISSITE","�rt�kelje ezt a weboldalt");
define("_RATING","�rt�kel�s");
define("_RATING1","�rt�kel�sek (n�vekv� sorrend)");
define("_RATING2","�rt�kel�sek (cs�kken� sorrend)");
define("_REGISTEREDUSERS","Regisztr�lt felhaszn�l�k");
define("_REMOTEFORM","T�voli szavaz��rlap");
define("_REPORTBROKEN","T�r�tt link bejelent�se");
define("_REQUESTLINKMOD","Link v�ltoztat�s�nak k�r�se");
define("_RETURNTO","Vissza az el�z� oldalra:");
define("_SCOMMENTS","Megjegyz�sek");
define("_SEARCHRESULTS4","Keres�s:");
define("_SELECTPAGE","V�lasszon oldalt");
define("_SENDREQUEST","K�r�s elk�ld�se");
define("_SHOW","Megtekint�s");
define("_SHOWTOP","Legn�zettebb");
define("_SITESSORTED","Jelenlegi sorbarendez�s:");
define("_SORTLINKSBY","Sorbarendez�s:");
define("_STAFF","Munkat�rsak");
define("_SUBMITONCE","Egy linket csak egyszer k�ldj�n el.");
define("_TEXTLINK","Sz�veges link");
define("_THANKSBROKEN","K�sz�n�m, hogy seg�t fenntartani a linkt�runk m�k�d�s�t.");
define("_THANKSFORINFO","K�sz�nj�k az inform�ci�t.");
define("_THANKSTOTAKETIME","K�sz�n�m, hogy id�t sz�nt egy oldal �rt�kel�sere itt n�lam -");
define("_THENUMBER","A");
define("_THEREARE","Jelenleg");
define("_TITLE","C�m");
define("_TITLEAZ","C�m (A-Z)");
define("_TITLEZA","C�m (Z-A)");
define("_TO","C�mzett");
define("_TOPRATED","Legjobbra oszt�lyozott");
define("_TOTALFORLAST","�sszes link az elm�lt");
define("_TOTALNEWLINKS","Linkek sz�ma �sszesen");
define("_TOTALOF","�sszesen");
define("_TOTALVOTES","�sszes szavazat:");
define("_TRATEDLINKS","�sszesen �rt�kelt oldal");
define("_TRY2SEARCH","Keres�s");
define("_TVOTESREQ","a minim�lisan sz�ks�ges szavazatok sz.");
define("_UNREGISTEREDUSERS","Nem regisztr�lt l�togat�k");
define("_URL","URL");
define("_USER","felhaszn�l�");
define("_USERANDIP","A felhaszn�l�n�v �s az IP c�m feljegyz�sre ker�l, k�rem, ne �ljen vissza a rendszerrel.");
define("_USERAVGRATING","felhaszn�l�k �tlagos �rt�kel�se");
define("_USUBCATEGORIES","Alkateg�ri�k");
define("_VISITTHISSITE","L�togassa meg ezt a weboldalt");
define("_VOTE4THISSITE","Szavazzon erre az oldalra!");
define("_WEBLINKS","Linkek");
define("_WEIGHNOTE","* Megjegyz�s: a regisztr�lt felhaszn�l�k �rt�kel�se t�bbet nyom, mint a l�togat�k�");
define("_WEIGHOUTNOTE","* Megjegyz�s: a regisztr�lt felhaszn�l�k �rt�kel�se t�bbet nyom, mint a m�s weboldalakon szavaz�k�");
define("_YOUARENOTREGGED","Nem regisztr�lt felhaszn�l�nk, vagy nem l�pett be.");
define("_YOUAREREGGED","�n regisztr�lt felhaszn�l�, �s bel�pett.");
define("_YOUREMAIL","e-mail c�me");
define("_YOURNAME","Neve");
?>