<?php
/***************************************************************************/
/* RavenNuke(tm) based on PHP-NUKE: Advanced Content Management System     */
/* ======================================================================= */
/*                                                                         */
/* This is the language module with all the system messages                */
/*  File location: /admin/language/                                        */
/* If you make a translation, please go to:                                */
/* http://www.ravenphpscripts.com                                          */
/* and post your translation in our forums                                 */
/*                                                                         */
/* You need to change the second quoted phrase, not the capitalised one!   */
/*                                                                         */
/* If you need to use double quotes (") remember to add a backslash (\),   */
/* so your entry will look like: This is \"double quoted\" text.           */
/* And, if you use HTML code, please double check it.                      */
/***************************************************************************/
global $sitename, $nukeurl;
define('_ACTBANNERS','Aktiv�lod a rekl�mcs�kokat az oldalon?');
define('_ACTIVATE','Bekapcsol�s');
define('_ACTIVATE2','Bekapcsol�s?');
define('_ACTIVATEHTTPREF','Idelinkel� oldalak nyilv�ntart�sa?');
define('_ACTIVE','Akt�v');
define('_ACTIVEBANNERS','Jelenleg akt�v rekl�mcs�kok');
define('_ACTIVEBANNERS2','Akt�v rekl�mok');
define('_ACTMULTILINGUAL','T�bbnyelv� lehet�s�g aktiv�l�sa? ');
define('_ACTUSEFLAGS','Z�szl�k a leny�l� lista helyett? ');
define('_ADDAUTHOR','�j adminisztr�tor hozz�ad�sa');
define('_ADDAUTHOR2','Szerz� hozz�ad�sa');
define('_ADDBANNER','�j rekl�m');
define('_ADDCLIENT','�j kliens hozz�ad�sa');
define('_ADDCLIENT2','Kliens hozz�ad�sa');
define('_ADDHEADLINE','�j oldal hozz�ad�sa');
define('_ADDIMPRESSIONS','T�bb egyedi l�togat� hozz�ad�sa');
define('_ADDMSG','�zenet hozz�ad�sa');
define('_ADDNEWBANNER','�j rekl�m hozz�ad�sa');
define('_ADDNEWBLOCK','�j blokk hozz�ad�sa');
define('_ADDNEWGROUP','�j felhaszn�l�i csoport hozz�ad�sa');
define('_ADMINEMAIL','Adminisztr�tor e-mail c�me');
define('_ADMINGRAPHIC','Az adminisztr�ci�s men� grafikus legyen?');
define('_ADMINID','Admin azonos�t�ja');
define('_ADMINISTRATION','Administration');
define('_ADMINLOGIN','Adminisztr�ci�s Rendszer - bel�p�s');
define('_ADMINLOGOUT','Kil�p�s');
define('_ADMINMENU','Adminisztr�ci�s men�');
define('_ADMPOLLS','Szavaz�s / k�zv�lem�ny-kutat�s');
define('_ADVERTISINGCLIENTS','Rekl�moz� �gyfelek');
define('_AFTEREXPIRATION','lej�rat ut�n');
define('_ALL','Minden');
define('_ALLMESSAGES','�zenetek �ttekint�se');
define('_ALLOWANONPOST','N�vtelen l�togat� bek�ldhet h�rt?');
define('_ALREADYOPTIMIZED','M�r optimaliz�lva');
define('_ALTTEXT','Sz�veg megv�ltoztat�sa');
//define('_ANEWSLETTER','H�rlev�l csak feliratkozott felhaszn�l�knak');
define('_ANONYMOUSNAME','N�vtelen l�togat� neve alapbe�ll�t�sban');
define('_ARESUREDELBLOCK','Biztos, hogy t�r�lni akarod ezt a blokkot:');
define('_ARTICLES','cikk');
define('_AUTHORDEL','Szerz� t�rl�se');
define('_AUTHORDELSURE','Biztos, hogy ki akarod t�r�lni:');
define('_AUTHORSADMIN','Szerz�k adminisztr�ci�ja');
define('_AUTOMATEDARTICLES','Programozott cikkek');
define('_A_GETOUT','L�PJEN KI !!!');
define('_A_INTRUDER_MSG','BETOLAKOD� RIASZT�S!!!');
define('_BACKENDCONF','Backend be�ll�t�sai');
define('_BACKENDLANG','Backend nyelve');
define('_BACKENDTITLE','Backend c�me');
define('_BANDATE','Tilt�s D�tuma');
define('_ADVERTISING','Rekl�moz�s');
//define('_BANNERS','Rekl�mcs�kok');
define('_ADVERTISINGADMIN','Rekl�moz�s Adminisztr�ci�ja');
//define('_BANNERS',,'Rekl�mcs�k adminisztr�ci�');
define('_BANNERSOPT','Rekl�mcs�kok be�ll�t�sai');
define('_BANNEWIP','�j IP c�m letilt�sa');
define('_BLOCK','Blokk');
define('_BLOCKACTIVATION','Blokk bekapcsol�sa');
define('_BLOCKDOWN','Blokk LE');
define('_BLOCKFILE','(Blokk f�jl)');
define('_BLOCKFILE2','FILE');
define('_BLOCKPREVIEW','Blokk:');
define('_BLOCKS','Blokkok');
define('_BLOCKSADMIN','Blokkok adminisztr�l�sa');
define('_BLOCKSYSTEM','SYSTEM');
define('_BLOCKUP','Blokk FEL');
define('_BROADCASTMSG','Sz�rt �zenetek aktiv�l�sa?');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_CENSORMODE','Cenz�ra m�d');
define('_CENSOROPTIONS','Cenz�ra Opci�k');
define('_CENSORREPLACE','Cenz�r�zott szavak helyettes�t�se ezzel:');
define('_CENTERBLOCK','K�z�ps� blokk');
define('_CENTERDOWN','K�z�pen alul');
define('_CENTERUP','K�z�pen fel�l');
define('_CHANGE','V�ltoztat�s');
define('_CHANGEDATE','Legyen a kezd� d�tum a mai?');
define('_CHANGEMODNAME','Modul nev�nek megv�ltoztat�sa');
define('_CLICKS','kattint�s');
define('_CLICKSPERCENT','% kattint�s');
define('_CLICKURL','Kattint�s linkje');
define('_CLIENTLOGIN','�gyf�l azonos�t�ja');
define('_CLIENTNAME','�gyf�l neve');
define('_CLIENTPASSWD','�gyf�l jelszava');
define('_CLIENTWITHOUTBANNERS','Az �gyf�lnek nincs jelenleg is fut� rekl�mja.');
define('_COMMENTSARTICLES','Aktiv�ljuk a megjegyz�seket a cikkekhez?');
define('_COMMENTSLIMIT','Maxim�lis hossz b�jtban');
define('_COMMENTSMOD','Megjegyz�sek moder�l�sa');
define('_COMMENTSOPT','Megjegyz�sek be�ll�t�sai');
define('_COMMENTSPOLLS','Megjegyz�sek a szavaz�sokn�l?');
define('_COMPLETEFIELDS','Ki kell t�lteni a k�telez� mez�ket');
define('_CONTACTEMAIL','Kapcsolat e-mail c�me');
define('_CONTACTNAME','Kapcsolat neve');
define('_CONTENT','Tartalom');
define('_CREATEBLOCK','L�trehoz�s');
define('_CREATEGROUP','Ennek a csoportnak a l�trehoz�sa');
define('_CREATEUSERDATA','Akarsz egy norm�l felhaszn�l�t l�trehozni ugyanilyen adatokkal?');
define('_CREATIONERROR','Hiba a szerz� hozz�ad�s�ban');
define('_CURRENTPOLL','Jelenlegi szavaz�s');
define('_CUSTOM','Egy�b');
define('_CUSTOMMODNAME','Egy�ni modul n�v:');
define('_CUSTOMTITLE','Egy�ni c�m');
define('_DAY','nap');
define('_DAYS','napban');
define('_DBOPTIMIZATION','Adatb�zis optimaliz�ci�');
define('_DEACTIVATE','Kikapcsol�s');
define('_DEFAULTTHEME','A weboldal alap�rtelmezett t�m�ja');
define('_DEFHOMEMODULE','Alap�rtelmezett f�oldali modul');
define('_DELAUTHOR','Szerz� t�rl�se');
define('_DELCLIENTHASBANNERS','Ez az �gyf�l a k�vetkez� jelenleg akt�v rekl�mokkal rendelkezik:');
define('_DELETEBANNER','Rekl�mcs�k t�rl�se');
define('_DELETECLIENT','�gyf�l t�rl�se');
define('_DELETEREFERERS','Idelinkel� oldalak t�rl�se');
define('_DESC01','Felhaszn�l�i napl�bejegyz�s. �rv�nyes a publikus �s a priv�t bejegyz�sekn�l is.');
define('_DESC02','Minden hozz�sz�l�s a felhaszn�l� publikus napl�j�hoz.');
define('_DESC03','Minden alkalommal, amikor a felhaszn�l� az Aj�nlja Weboldalamat funkci�val �zenetet k�ld egy bar�tj�nak.');
define('_DESC04','Minden h�r, amelyeket a H�rk�ld�s funkci�val elk�ld a felhaszn�l� �s azut�n j�v�hagy egy admin.');
define('_DESC05','Minden hozz�sz�l�s�rt, amely cikkekhez vagy h�rekhez �r�dott.');
define('_DESC06','Minden alkalommal, amikor a felhaszn�l� egy cikket/h�rt elk�ld egy bar�tj�nak a be�p�tett funkci�val.');
define('_DESC07','Minden alkalommal, amikor szavaz egy cikkre.');
define('_DESC08','Minden szavaz�s�rt (r�gi �s aktu�lis szavaz�s is lehet).');
define('_DESC09','Minden hozz�sz�l�s�rt, amelyet a felhaszn�l� egy aktu�lis vagy r�gi szavaz�shoz �r.');
define('_DESC10','Minden �j hozz�sz�l�s�rt a f�rumban.');
define('_DESC11','F�rum bejegyz�sek megv�laszol�s��rt.');
define('_DESC12','Minden megjelent, ismertet�h�z �rt hozz�sz�l�s�rt.');
define('_DESC13','Minden egyes oldallet�lt�s�rt.');
define('_DESC14','Minden alkalommal, amikor a felhaszn�l� r�kattint egy weblinkre a Linkek funkci�ban.');
define('_DESC15','Minden alkalommal, amikor a felhaszn�l� szavaz egy weblinkre.');
define('_DESC16','Minden alkalommal, amikor a felhaszn�l� hozz�sz�l�st �r a Linkek modulban.');
define('_DESC17','Minden alkalommal, amikor a felhaszn�l� let�lt egy f�jlt a Let�lthet� anyagok modulban.');
define('_DESC18','Minden alkalommal, amikor a felhaszn�l� szavaz egy let�lt�sre.');
define('_DESC19','Minden alkalommal, amikor a felhaszn�l� hozz�sz�l�st �r a Let�lthet� anyagok modulban.');
define('_DESC20','Minden alkalommal, amikor a felhaszn�l� sz�rt �zenetet tesz k�zz�.');
define('_DESC21','Rekl�mcs�kokra val� klikkel�s�rt.');
define('_DESCRIPTION','Le�r�s');
define('_DOWNLOAD','Let�lthet� anyagok');
define('_EDITADMINS','Admin adatainak szerkeszt�se');
define('_EDITBANNER','Rekl�m adatainak szerkeszt�se');
define('_EDITBLOCK','Szerkeszt�s');
define('_EDITCLIENT','Rekl�moz� �gyf�l adatainak szerkeszt�se');
define('_EDITGROUP','Felhaszn�l�i csoport szerkeszt�se');
define('_EDITHEADLINE','Oldal szerkeszt�se');
define('_EDITMSG','�zenet szerkeszt�se');
define('_EMAIL','Email');
define('_EMAIL2SENDMSG','Milyen e-mail c�mre?');
define('_EMAILFROM','Felad�');
define('_EMAILMSG','e-mail sz�vege');
define('_EMAILSUBJECT','e-mail t�m�ja');
define('_ENCYCLOPEDIA','Enciklop�dia');
define('_ERROR','HIBA:');
define('_EXACTMATCH','Teljes azonoss�g');
define('_EXPIRATION','Lej�rat');
define('_EXTRAINFO','Egy�b adatok');
define('_FAQ','Gy.I.K.');
define('_FILEINCLUDE','(V�lassz egy egy�ni blokkot. A t�bbi mez�t figyelmen k�v�l hagyjuk.)');
define('_FILENAME','F�jln�v');
define('_FIXBLOCKS','Blokkok �jrarendez�se');
define('_FOOTERLINE1','L�bl�c 1. sora');
define('_FOOTERLINE2','L�bl�c 2. sora');
define('_FOOTERLINE3','L�bl�c 3. sora');
define('_FOOTERMSG','L�bl�c �zenetei');
define('_FORCHANGES','(Csak a v�ltoztat�sokhoz)');
//define('_FROM','Felad�');
define('_FUNCTIONS','Funkci�k');
define('_GENSITEINFO','�ltal�nos Port�l inform�ci�');
define('_GO','Tov�bb');
define('_GODNOTDEL','*(A GOD admin nem t�r�lhet�, csak szerkeszthet�)');
define('_GRAPHICOPT','Grafikai be�ll�t�sok');
define('_GROUP','Csoport');
define('_GROUPADDERROR','Csoport l�trehoz�sakor hiba t�rt�nt!');
define('_GROUPDELETE','Felhaszn�l�i csoport t�rl�se');
define('_GROUPSADMIN','Felhaszn�l�i csoportok adminisztr�ci�ja');
define('_GTITLE','Csoport neve');
define('_HASBEENBANNED','ki lett tiltva a weboldalr�l');
define('_HEADLINESADMIN','H�rlista szerkeszt�se');
define('_HOMECONFIG','F�oldal be�ll�t�sa');
define('_HOMEPAGE','F�oldal');
define('_ID','ID');
define('_IFRSSWARNING','Ha kit�lt�d az RSS/RDF f�jl URL: vagy F�jln�v: mez�ket, a fenti tartalom nem jelenik meg.');
define('_IFYOUACTIVE','(Ha most aktiv�lod ezt az �zenetet, a mai lesz a kezd�d�tuma)');
define('_IMAGEURL','K�p linkje');
define('_IMPLEFT','M�g ennyi egyedi l�togat� kell');
define('_IMPRESSIONS','Egyedi l�togat�k');
define('_INACTIVE','Inakt�v');
define('_INACTIVEBANNERS','Inakt�v rekl�mcs�kok');
define('_INHOME','A f�oldalon');
define('_IPBANNED','Letiltott IP c�mek');
define('_IPBANSYSTEM','IP c�m letilt�s');
define('_IPENTERED','A beg�pelt IP c�m:');
define('_IPLOCALHOST','Nem lehet a localhost IP c�met letiltani!');
define('_IPNUMERIC','Az IP c�m numerikus legyen!');
define('_IPOUTRANGE','IP c�m tartom�nyon k�v�l!');
define('_IPSTARTZERO','Egy IP c�m nem kezd�dhet null�val!');
define('_IPYOURS','Nem tilthatod le a saj�t IP c�medet!');
define('_ITEMSTOP','Cikkek sz�ma a f�oldalon');
define('_KBSAVED','Kb-nyi megtakar�t�s az els� futtat�s �ta!');
define('_LANGUAGE','Nyelv');
define('_LAST','Utols�');
define('_LEFT','Bal');
define('_LEFTBLOCK','Baloldali blokk');
define('_LOCALEFORMAT','Helyi id�form�tum');
define('_MADE','K�sz�tette');
//define('_MAIL2ADMIN','�j cikkek elk�ld�se az adminnak lev�lben');
//define('_MAINACCOUNT','God Admin*');
//define('_MANYUSERSNOTE','FIGYELEM! Sok felhaszn�l� fogja megkapni ezt a sz�veget. V�rd meg a script lefut�s�t, mely ak�r percekig is eltarthat.');
//define('_MAREYOUSURE2SEND','Biztos vagy benne, hogy el akarod k�ldeni ezt a massz�v emailt most?');
//define('_MASSEMAIL','Massz�v Email');
//define('_MASSEMAILMSG',"=========================================================\n $sitename felhaszn�l�jak�nt kapja ezt az �zenetet. Rem�lj�k, nem zavarjuk ezzel a lev�llel �s hogy seg�t jobb� tenni webes szolg�ltat�sainkat.");
//define('_MASSEMAILSENT','A massz�v Email minden regisztr�lt felhaszn�l�nak el lett k�ldve.');
//define('_MASSMAIL','Massz�v e-mail MINDEN felhaszn�l�nak');
define('_MATCHANY','Egyez�s b�rhol a sz�vegben');
define('_MATCHBEG','Egyez�s az elej�n');
define('_MAXREF','Max. h�ny, az oldaladat linkel� oldal nyilv�ntart�sa?');
define('_MAXRSS','Max. h�ny RSS c�m legyen?');
define('_MESSAGECONTENT','Tartalom');
define('_MESSAGES','�zenetek');
define('_MESSAGESADMIN','�zenetek adminisztr�l�sa');
define('_MESSAGETITLE','C�m');
define('_MISCOPT','Egy�b be�ll�t�sok');
define('_MODADMIN','Adminisztr�torok �ltal');
define('_MODIFYINFO','Adatok szerkeszt�se');
define('_MODTYPE','Moder�l�s fajt�ja');
define('_MODULEEDIT','Modulok Szerkeszt�se');
define('_MODULEHOMENOTE','<b>-= FIGYELEM! =-</b><br />A vastagon szedett c�m� modul jelzi azt, amelyik a f�oldalon megjelenik. <br />Nem tudod deaktiv�lni vagy korl�tozni ezt a modult, am�g ez az alap�rtelmezett.<br />Ha ennek a modulnak a mapp�j�t t�rl�d, hiba�zenetet kapsz a f�oldalon.<br />Emellett ennek a modulnak a neve helyett <i>F�oldal</i> fog szerepelni a modulok men�j�ben.');
define('_MODULEINHOME','Modul a f�oldalon:');
define('_MODULES','Modulok');
define('_MODULESACTIVATION','Itt l�thatod a Modulokat/Addonokat a be�ll�t�saikkal, melyeket akt�vra vagy inakt�vra �ll�thatsz.<br />A <i>/modules/</i> mapp�ba bem�solt �j modulok automatikusan megjelennek itt is <i>Inakt�v</i> st�tusszal az oldal friss�t�se ut�n. Ha ki akarsz t�r�lni egy modult, egyszer�en t�r�ld ki a<br /> <i>/modules/</i> mappa al�l, a rendszer mag�t�l friss�teni fogja az adatb�zist is.');
define('_MODULESADDONS','Modulok �s Addonok');
define('_MODULESADMIN','Modulok Adminisztr�ci�ja');
define('_MODUSERS','Tagok �ltal');
define('_MULTILINGUALOPT','T�bbnyelv�s�g be�ll�t�sok');
//define('_MUSERWILLRECEIVE','A felhaszn�l�k meg fogj�k kapni ezt a levelet.');
define('_MUSTBEINIMG','az /images/ mapp�ban kell lennie. Csak az AvantGo modulra vonatkozik');
define('_MVADMIN','Csak adminisztr�torok');
define('_MVALL','Minden l�togat�');
define('_MVANON','Csak n�vtelen l�togat�k');
define('_MVUSERS','Csak regisztr�lt tagok');
define('_MYHEADLINES','Szalagc�m olvas� aktiv�l�sa?');
//define('_MYOUAREABOUTTOSEND','Most �ppen egy Massz�v e-mail kik�ld�sbe kezd MINDEN regisztr�lt felhaszn�l�nak.');
define('_NAME','N�v');
//define('_NAREYOUSURE2SEND','Biztos el akarod most k�ldeni ezt a h�rlevelet?');
define('_NEWS','H�rek');
//define('_NEWSLETTER','H�rlev�l');
//define('_NEWSLETTERSENT','H�rlev�l elk�ldve.');
//define('_NLUNSUBSCRIBE','=========================================================\nAz�rt kapja ezt a h�rlevelet, mert a $sitename erre rendszeres�tett fel�let�n feliratkozott r�.\nErre a linkre kattintva leiratkozhat:\n\n$nukeurl/modules.php?name=Your_Account&op=edituser\n\nItt v�lassza a Nem opci�t �s mentse el a v�ltoztat�st.');
define('_NEWWEIGHT','�j sorrend');
define('_NOADMINYET','Nincsenek m�g adminisztr�torok, hozz l�tre egy Super Usert:');
define('_NOAUTOARTICLES','Nincsenek programozott cikkek');
define('_NOFILTERING','Nincs sz�r�s');
define('_NOFUNCTIONS','---------');
define('_NOGROUPS','Nincsenek jelen pillanatban csoportok');
define('_NOMOD','Nincs moder�l�s');
define('_NONUMVALUE','Numerikus pont�rt�ket kell megadni. Menj vissza �s jav�tsd.');
define('_NORMAL','Norm�l');
define('_NOTIFYSUBMISSION','Elk�ldj�k e-mailben az �j cikkeket?');
define('_NOTINMENU','[ <big><strong>&middot;</strong></big> ] jel�l�s� modulok nem fognak megjelenni a men�ben.');
//define('_NUSERWILLRECEIVE','A felhaszn�l�k meg fogj�k kapni ezt a h�rlevelet.');
//define('_NYOUAREABOUTTOSEND','Most �ppen egy h�rlevelet fogsz kik�ldeni a regisztr�lt felhaszn�l�knak.');
define('_OK','OK!');
define('_OLDSTORIES','cikk a R�gebbi Cikkek boxban.');
define('_ONLYHEADLINES','(Csak �tvett cikkekhez)');
define('_ONLYNUMVAL','Csak numerikus adatokat lehet megadni');
define('_OPTIMIZATIONRESULTS','Optimaliz�ci� eredm�nye');
define('_OPTIMIZED','Optimaliz�lva!');
define('_OPTIMIZINGDB','Ennek az adatb�zisnak az optimaliz�l�sa:');
define('_ORDMSG','Weight values must be between 1 and 999');
define('_ORDMSG2','Duplicate Weight values not permitted');
define('_ORDMSGSIDEL','in left blocks');
define('_ORDMSGSIDEC','in center up blocks');
define('_ORDMSGSIDED','in center down blocks');
define('_ORDMSGSIDER','in right blocks');
define('_PASSWDLEN','Tagok jelszav�nak minim�lis hossza');
define('_PASSWDNOMATCH','Sajn�lom, az �j jelszavak nem egyform�k. Menj vissza �s pr�b�ld �jra.');
define('_PERMISSIONS','Jogok');
define('_POINTS','Pontok');
define('_POINTS01','Napl�bejegyz�s');
define('_POINTS02','Napl� hozz�sz�l�s');
define('_POINTS03','Aj�nl�s egy bar�tnak');
define('_POINTS04','J�v�hagyott h�rk�ld�s ');
define('_POINTS05','H�r hozz�sz�l�s');
define('_POINTS06','H�r k�ld�se egy bar�tnak');
define('_POINTS07','H�r �rt�kel�se');
define('_POINTS08','Szavaz�s');
define('_POINTS09','Hozz�sz�l�s szavaz�shoz');
define('_POINTS10','�j hozz�sz�l�s a f�rumban');
define('_POINTS11','V�lasz a f�rumban');
define('_POINTS12','Ismertet�h�z �rt hozz�sz�l�s');
define('_POINTS13','Oldallet�lt�s');
define('_POINTS14','WebLink megl�togat�sa');
define('_POINTS15','WebLink �rt�kel�se');
define('_POINTS16','Hozz�sz�l�s WebLinkhez');
define('_POINTS17','F�jl let�lt�se');
define('_POINTS18','Let�lt�s �rt�kel�se');
define('_POINTS19','Hozz�sz�l�s let�lt�shez');
define('_POINTS20','Sz�rt �zenet');
define('_POINTS21','Rekl�mcs�kra kattint�s');
define('_POINTSNEEDED','Sz�ks�ges pontsz�m');
define('_POINTSSYSTEM','Pontrendszer');
define('_POSITION','Poz�ci�');
//define('_POSSIBLESPAM','Gondolj arra, hogy egyes felhaszn�l�k rosszul fogadj�k a massz�v emaileket �s k�retlen �zenetk�nt veszik!');
define('_PREFERENCES','Be�ll�t�sok');
//define('_PREVIEW','El�n�zet');
define('_PUBLISHEDSTORIES','Ez a szerz� a k�vetkez� cikkeket publik�lta');
define('_PURCHASED','Megv�s�rolva');
define('_PURCHASEDIMPRESSIONS','Megvett egyedi l�togat� sz�m');
define('_PUTINHOME','F�oldalra');
define('_REASON','Az indok');
define('_REFRESHTIME','Friss�t�s ideje');
define('_REMOVECOMMENTS','Hozz�sz�l�s t�rl�se');
define('_REMOVEMSG','Biztos t�r�lni akarod ezt az �zenetet? ');
define('_REQUIRED','(K�telez�)');
define('_REQUIREDNOCHANGE','(k�telez�, k�s�bb nem lehet megv�ltoztatni)');
define('_RETYPEPASSWD','Jelsz� m�gegyszer');
define('_REVIEWS','Ismertet�k');
//define('_REVIEWTEXT','K�rlek n�zd �t �s ellen�rizd a sz�veget:');
define('_RIGHT','Jobb');
define('_RIGHTBLOCK','Jobboldali blokk');
define('_RSSCONTENT','(RSS/RDF tartalom)');
define('_RSSFAIL','Gond van a RSS f�jl URL-j�vel');
define('_RSSFILE','RSS/RDF f�jl URL-je');
define('_RSSTRYAGAIN','K�rj�k ellen�rizd az URL-t �s a RSS f�jl nev�t, majd pr�b�ld meg �jra.');
define('_SAVE','Ment');
define('_SAVEBLOCK','Ment�s');
define('_SAVECHANGES','V�ltoz�sok ment�se');
define('_SAVEDATABASE','Adatb�zis lement�se');
define('_SAVEGROUP','Csoport elment�se');
define('_SELECTNEWADMIN','V�lassz ki egy �j admint a jogok kiad�s�hoz');
define('_SELLANGUAGE','V�laszd ki a weboldal nyelv�t');
//define('_SEND','K�ld�s');
define('_SETUPHEADLINES','(V�laszd az Egyebet �s �rd be az URL-t, vagy v�lassz egy oldalt a list�b�l friss h�rlista let�lt�s�hez)');
define('_SHOW','Megtekint�s');
define('_SHOWINMENU','L�that� a modulok blokkban?');
define('_SITECONFIG','A website be�ll�t�sai');
define('_SITELOGO','Oldal log�ja');
define('_SITENAME','Site neve');
define('_SITESLOGAN','Site szlogen');
define('_SITEURL','Oldal webc�me');
define('_SIZE','M�ret');
define('_SPACESAVED','Megtakar�tott t�rhely');
//define('_STAFF','Munkat�rsak');
define('_STARTDATE','A weboldal indul�s�nak id�pontja');
define('_STATUS','�llapot');
define('_STORIESHOME','Cikkek sz�ma a f�oldalon');
define('_STORYID','Cikk sz�ma');
//define('_SUBJECT','C�m');
define('_SUBMIT','K�ld�s');
//define('_SUBSCRIBEDUSERS','Feliratkozott felhaszn�l�k');
define('_SUBUSERS','Feliratkozott felhaszn�l�k');
define('_SUBVISIBLE','Felhaszn�l�k sz�m�ra l�that�?');
define('_SUCCESS','Sikeres!!');
define('_SUPERUSER','SuperUser');
define('_SUPERWARNING','FIGYELMEZTET�S: Ha a SuperUser-t bejel�l�d, a felhaszn�l� minden jogot megkap!');
define('_SURE2DELHEADLINE','FIGYELMEZTET�S! Biztos, hogy t�r�lni akarod ezt az oldalt?');
define('_SUREGRPDEL1','Biztos t�r�lni akarod ezt a csoportot?:');
define('_SURETOBANIP','Biztos ENGED�LYEZNI akarod a k�vetkez� IP c�met?:');
define('_SURETOCHANGEMOD','Biztos meg akarod v�ltoztatni a F�oldaladat err�l?:');
define('_SURETODELBANNER','Biztos, hogy t�r�lni akarod ezt a rekl�mcs�kot?');
define('_SURETODELCLIENT','T�r�lni fogod ezt az �gyfelet �s az �sszes rekl�mcs�kj�t!');
define('_SURETODELCOMMENTS','Biztos, hogy t�r�lni szeretn�d a kiv�lasztott hozz�sz�l�st, valamint az �sszes t�bbit, amely erre v�laszul �rkezett?');
define('_TABLE','T�bl�zat');
define('_THEIP','Az IP c�m');
define('_TIMES','alkalommal');
define('_TITLE','C�m');
define('_TO','C�mzett');
if(!defined('_TOPICS')) define('_TOPICS','Rovatok');
define('_TOTALSPACESAVED','Teljes megtakar�tott t�rhely:');
define('_TYPE','T�pus');
define('_UGROUP','Felhaszn�l�i csoport');
define('_UGROUPS','Felhaszn�l�i csoport/Pontok');
define('_UNBAN','Enged�lyez�s');
define('_UPDATE','Friss�t');
define('_URL','URL');
define('_USERSCOUNT','Tagok sz�ma');
define('_USERSHOMENUM','Tagok megv�ltoztathatj�k a megjelen� cikkek sz�m�t a f�oldalon?');
define('_USERSOPTIONS','Users Options');
define('_VALIDIFREG','Csak akkor �rv�nyes, regisztr�lt felhaszn�l�k vannak fent kiv�lasztva');
define('_VIEW','L�tja');
define('_VIEWPRIV','Ki olvashatja?');
define('_WANT2ACTIVATE','Be akarod kapcsolni ennek a blokknak a megjelen�t�s�t?');
define('_WARNING','Figyelmeztet�s');
define('_WEBLINKS','Web Linkek');
define('_WEIGHT','Sorrend');
//define('_WHATTODO','Mit akarsz k�ldeni?');
define('_WHOLINKS','Ki linkeli be az oldalainkat?');
define('_WHOSONLINE','Ki olvas most minket?');
define('_YOUARELOGGEDOUT','Kil�pt�l!');
define('_YOUHAVERUNSCRIPT','Ezt a scriptet lefuttattad');
?>