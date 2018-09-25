<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* =======================================================================*/
/*                                                                        */
/* This is the language module with all the system messages               */
/*   File location: language/                                             */
/* If you make a translation, please go to                                */
/* ravenphpscripts.com and post your language translation in the forums   */
/*                                                                        */
/* If you need to use double quotes (') remember to add a backslash (\),  */
/* so your entry will look like: This is \'double quoted\' text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/
global $lastusername;
// Used in mainfile.php for RavenNuke(tm)
if(!defined('_RNINSTALLFILESFOUND')) { define('_RNINSTALLFILESFOUND','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//HU"><html><head><title>RavenNuke&trade; Telepítés/Beállítás </title><meta name="rating" content="general"><meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2008 by http://www.ravenphpscripts.com"></head><body><br /><br /><center><a href="http://www.ravenphpscripts.com" title="Raven Web Service: Minõségi webhoszting és támogatás"><img src="images/RavenWebServices_Banner.gif" border="0" alt="" /></a>&trade;<br /><br /><table width="75%" border="1"><tr><td align="center" style="color:blue;font-weight:bold;">INSTALLATION mappa fel van töltve a szerverre - Ha folytatja, a weboldalát veszélynek teszi ki.<br /><br />Vagy törölje vagy nevezze át az INSTALLATION mappát a folytatáshoz.</td></tr></table></center>'); }
// for Anagram, Milo and Karate theme support (header)
if(!defined('_TOPICS')) { define('_TOPICS','Rovatok'); }
if(!defined('_ALLTOPICS')) { define('_ALLTOPICS','Összes rovat'); }
if(!defined('_HELLO')) { define('_HELLO','Üdvözlöm,'); }
// for fisubice
define('_FSIADMINMENU','Admin Menü');
define('_FSIYOURACCOUNT','Az ön saját fiókja');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED', 'Hozzáférés megtagadva!');
define('_ACTIVEBUTNOTSEE','(Aktív, de nem látható link)');
define('_ADD','Hozzáad');
define('_ADDAHOME','Modul hozzáadása a kezdõlapjához');
define('_ADDITIONALYGRP','Ezen túlmenõen ez a modul a következõ felhasználói csoporthoz tartozik:');
define('_ADMIN','Adminisztráció:');
define('_ADMNOTSUB','Felhasználó nincs feliratkozva!');
define('_ADMSUB','Feliratkozott felhasználó!');
define('_ADMSUBEXPIREIN','Feliratkozása lejár:');
define('_ALLCATEGORIES','Minden kategória');
define('_ALLOWEDHTML','Használható HTML kódok:');
define('_APRIL','Április');
define('_AREYOUSURE','Ha írt linkeket is, nincsenek elgépelve?');
define('_ASREGISTERED','Még nem regisztrálta magát? <a href="modules.php?name=Your_Account">Itt megteheti</a>. A regisztrált felhasználók számos elõnnyel rendelkeznek: dizájnváltás, hozzászólások beállítása, és hozzászólások saját név alatt.');
define('_ASSOTOPIC','Hozzárendelt rovatok');
define('_AUGUST','Augusztus');
define('_BANTHIS','IP letiltása');
define('_BBFORUMS','Fórum');
define('_BIGSTORY','A legolvasottabb cikk ma:');
define('_BLATEST','Legutolsó');
define('_BLOCKPROBLEM','<center>Gondok vannak ezzel a blokkal.</center>');
define('_BLOCKPROBLEM2','<center>Nincs tartalom ehhez a blokkhoz.</center>');
define('_BMEM','Tagok');
define('_BMEMP','Tagság');
define('_BON','Most online');
define('_BOVER','Összesen');
define('_BPM','Privát üzenetek');
define('_BREAD','Olvasott');
define('_BREG','Regisztrál');
define('_BROADCAST','Nyilvános üzenet közzététele');
define('_BROADCASTFROM','Nyilvános üzenet küldõje:');
define('_BROKENDOWN','Hibás letöltések');
define('_BROKENLINKS','Hibás linkek');
define('_BTD','Új a mai napon');
define('_BTT','Össz.');
define('_BUNREAD','Olvasatlan');
define('_BVIS','Látogatók');
define('_BVISIT','Online felhasználók');
define('_BWEL','Üdvözlöm,');
define('_BY','Szerzõ:');
define('_BYD','Új a tegnapi napon');
if (!defined('_CANCEL')) define('_CANCEL','Mégse');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_COMMENTS','hozzászólás');
define('_CONTRIBUTEDBY','szerzõ:');
define('_CURRENTLY','Jelenleg');
if (!defined('_DATE')) define('_DATE','Dátum');
define('_DATESTRING','%Y. %m. %d. %H:00');
define('_DATESTRING2','%Y. %m. %d.');
define('_DECEMBER','December');
define('_DELETE','Törlés');
define('_EDIT','Szerkesztés');
define('_EXPIREIN','Lejárat ideje:');
define('_EXPIRELESSHOUR','Lejárat: kevesebb, mint egy óra');
define('_FEBRUARY','Február');
define('_FORADMINTESTS','(Admin teszthez)');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Vissza</a> ]');
define('_GOBACK2','Vissza');
define('_GUESTS','vendég és');
define('_HASEXPIRED','most lejárt.');
define('_HERE','itt');
define('_HOME','Fõoldal');
define('_HOMEPROBLEM','Probléma: nincs kezdõlapunk!!!');
define('_HOMEPROBLEMUSER','Pillanatnyilag gondok vannak a kazdõlappal. Kérem, látogasson vissza késõbb.');
define('_HOPESERVED','Remélem, elégedett volt a portál szolgáltatásaival...');
define('_HOUR','óra');
define('_HOURS','óra');
define('_HREADMORE','tovább...');
define('_HTTPREFERERS','HTTP utalások');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Biztonsági kód hibás...');
define('_IN','az alábbi alatt:'); //0000960
define('_INVISIBLEMODULES','Rejtett Modulok');
define('_JANUARY','Január');
define('_JOURNAL','Napló');
define('_JULY','Július');
define('_JUNE','Június');
define('_LASTIP','Utolsó felhasználó IP-je:');
define('_LOGIN','Belépés');
define('_LOGOUT','Kilépés');
define('_MARCH','Március');
define('_MAY','Május');
define('_MEMBERS','regisztrált felhasználó olvas bennünket.');
define('_MENUFOR','Személyes menü:');
define('_MODREQDOWN','Letöltések Modul');
define('_MODREQLINKS','Linkek Modul');
define('_MODULENOTACTIVE','Sajnos ez a modul nem aktív!');
define('_MODULESADMINS', 'Ez a modul csak <i>adminisztrátorok számára hozzáférhetõ.</i><br /><br />');
define('_MODULESSUBSCRIBER','Ez a modul csak <i>elõfizetett felhasználók számára hozzáférhetõ.</i>');
define('_MODULEUSERS', 'Ez a modul csak <i>Regisztrált felhasználók számára hozzáférhetõ.</i><br /><br />Ingyen regisztrálhat, ha <a href="modules.php?name=Your_Account&amp;op=new_user">ide</a> kattint.<br />');
define('_MORENEWS','Többet a hírek modulban');
define('_MULTILINGUALOFF','We\'re sorry but there are no language translations available. Please contact the Webmaster for further help.');
define('_MVIEWADMIN','Csak adminisztrátoroknak');
define('_MVIEWALL','Minden látogatónak');
define('_MVIEWANON','Csak névtelen látogatóknak');
define('_MVIEWSUBUSERS','Csak elõfizetett felhasználóknak');
define('_MVIEWUSERS','Csak regisztrált tagoknak');
define('_NEWPMSG','Új Privát Üzenetek');
define('_NICKNAME','Felhasználónév');
define('_NO','Nem');
define('_NOACTIVEMODULES','Inaktív Modulok');
define('_NOBIGSTORY','A mai napnak még nincs \'nagy sztorija\'.');
define('_NONE','Semmi');
define('_NOTE','Megjegyzés:');
define('_NOTSUB','Nem fizetett elõ a következõ hírlevélre:');
define('_NOVEMBER','November');
define('_NOW','most!');
define('_OCTOBER','Október');
if (!defined('_OF')) define('_OF','/');
define('_OLDERARTICLES','Régebbi cikkek');
define('_ON','Ideje:');
define('_OR','vagy');
define('_PAGEGENERATION','oldal generálása:');
define('_PAGESVIEWS','találatot kaptunk az oldal indítása óta:');
define('_PAGINATOR_TOTALITEMS','összes elem');
define('_PAGINATOR_PAGE','oldal');
define('_PAGINATOR_PAGES','oldal');
define('_PAGINATOR_GO','Lép');
define('_PAGINATOR_GOTOPAGE','Ugrás adott oldalhoz');
define('_PAGINATOR_GOTONEXT','Következõ oldalhoz');
define('_PAGINATOR_GOTOPREV','Elõzõ oldalhoz');
define('_PAGINATOR_GOTOFIRST','Elsõ oldalhoz');
define('_PAGINATOR_GOTOLAST','Utolsó oldalhoz');
define('_PASSWORD','Jelszó');
define('_PASTARTICLES','Korábbi cikkek');
define('_PCOMMENTS','Hozzászólások:');
define('_POLLS','Szavazások');
define('_POSTEDBY','Írta:');
define('_POSTEDON','Ideje:');
define('_PRIVATEMSG','személyes üzenete van.');
define('_READMYJOURNAL','Naplóm olvasása');
define('_READS','olvasás');
define('_REGISTERED','Regisztrált');
define('_RESTRICTEDAREA', 'Egy ön elõl zárt részre próbált bejutni.');
define('_RESULTS','Eredmények');
define('_RN_FOOTER_CREDITS','<center><br /><font class="small">:: fisubice phpbb2 style by <a href="http://www.forumimages.com/">Daz</a> :: PHP-Nuke theme by <a href="http://www.nukemods.com">www.nukemods.com</a> ::</font></center>'.'<center><font class="small">:: fisubice Theme Recoded To 100% W3C CSS &amp; HTML 4.01 Transitional &amp; XHTML 1.0 Transitional Compliance by RavenNuke&trade; TEAM :: </font></center>'.'<center><br /><font class="small">:: <a href="http://jigsaw.w3.org/css-validator/" target="_blank" title="W3C CSS Compliance Validation"><img src="themes/fisubice/images/w3c_css.gif" width="62" height="22" border="0" alt="W3C CSS Compliance Validation" /></a> :: <a href="http://validator.w3.org/" title="W3C HTML 4.01 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xxx.gif" alt="W3C HTML 4.01 Transitional Compliance Validation" width="62" height="22" border="0" /></a> :: <a href="http://validator.w3.org/" title="W3C XHTML 1.0 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xhtml.gif" alt="W3C XHTML 1.0 Transitional Compliance Validation" width="62" height="22" border="0" /></a> ::</font></center>'.'<br />'."\n");
define('_RSSPROBLEM','Jelenleg nem mûködik a site tartalomszolgáltatása');
define('_SBDAYS','nap');
define('_SBHOURS','óra');
define('_SBMINUTES','perc');
define('_SBSECONDS','másodperc');
define('_SBYEAR','év');
define('_SBYEARS','év');
define('_SEARCH','Keresés');
define('_SECONDS','másodperc');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Biztonsági kód');
define('_SELECTGUILANG','Válasszon nyelvet:');
define('_SELECTLANGUAGE','Válasszon nyelvet');
define('_SEPTEMBER','Szeptember');
define('_SUBEXPIRED','Elõfizetése lejárt');
define('_SUBEXPIREIN','Elõfizetése lejár:');
define('_SUBFROM','Feliratkozhat a következõ helyrõl ');
define('_SUBHERE','Feliratkozhat <a href="'.$subscription_url.'">innen</a>');
define('_SUBMISSIONS','Jóváhagyásra váró tartalom');
define('_SUBRENEW','Ha meg akarja újítani az elõfizetését, menjen a következõ oldalra:');
define('_SUBSCRIBER','elõfizetõ');
define('_SUBSCRIPTIONAT','Ez egy automatikus üzenet a következõ weboldallal kapcsolatos elõfizetésérõl: ');
define('_SURVEY','Szavazógép');
define('_TOPIC','Téma');
define('_TURNOFFMSG','Nyilvános üzenetek kikapcsolása');
define('_TYPESECCODE','Írja be ide a biztonsági kódot:');
define('_UDOWNLOADS','Letöltések');
define('_UMONTH','hónap');
define('_UNLIMITED','Korlátlan');
define('_USERS','Tagok');
define('_VOTE','szavazat');
define('_VOTES','szavazat');
define('_WAITINGCONT','Jóváhagyásra váró tartalom');
define('_WELCOMETO','Üdvözli');
define('_WERECEIVED','Összesen');
define('_WLINKS','Jóváhagyásra váró linkek');
define('_WREVIEWS','Jóváhagyásra váró ismertetõk');
define('_WRITES','küldte be az alábbi cikket');
define('_YEAR','év');
define('_YES','igen');
define('_YOUARE','Ön');
define('_YOUAREANON','Jelenleg névtelen látogató. Ingyenesen regisztrálhatja magát, <a href="modules.php?name=Your_Account">ide</a> kattintva');
define('_YOUARELOGGED','Üdvözlöm,');
define('_YOUHAVE','önnek');
define('_YOUHAVEONEMSG','Önnek 1 új privát üzenete van');
define('_YOUHAVEPOINTS','Pontok a tartalomkészítésben való szerepvállalásért:');
//// Raven's User Info Block
define('_ALT_CHKPROFILE','.$lastusername beállításainak ellenõrzése');
define('_ALT_SEND','Gyors privát üzenet küldése a következõ felhasználónak: ');
define('_BHITS','Találatok');
define('_GUESTIPS_OPTION','- Vendég IP címe -');
define('_HIDDEN','Rejtett');
define('_HIDDEN_ABBREV','(H)');
define('_PASSWORDLOST','Elfelejtett jelszó');
define('_SERDT','Dátum/Idõ a Szerveren:');
define('_TTL_RESENDEMAIL','Resend Email phpNuke Modul - RavenPHPScripts');
define('_WAITLINK','Várom');
define('_YOURIP','Az Ön IP címe: ');
define('_GCALENDAR_EVENTS', 'Calendar Events');

define('_RWS_WIW_UNABLECONNECTSERVER','Unable to connect to Server. ');
define('_RWS_WIW_UNABLECONNECTDB','Unable to connect to Database. ');
define('_RWS_WIW_UNABLETOREMOVE','Unable to Remove.');
define('_RWS_WIW_UNABLETOINSERT','Unable to Insert');
define('_RWS_WIW_MYSQLSAID','MySQL said');
define('_RWS_WIW_TITLE','Who is Where');
define('_RWS_WIW_GUESTSONLINE','Guest(s) Online');
define('_RWS_WIW_GUESTS','guest(s)');
define('_RWS_WIW_HOME','Home');
define('_RWS_WIW_USERSONLINE','User(s) Online');
define('_RWS_WIW_REFRESH','sec. refresh');
////
/*****************************************************/
/* Function to translate Datestrings                 */
/*****************************************************/

function translate($phrase) {
	 switch($phrase) {
	case 'xdatestring':  $tmp = '%A, %B %d @ %T %Z'; break;
	case 'linksdatestring': $tmp = '%d-%b-%Y'; break;
	case 'xdatestring2': $tmp = '%A, %B %d'; break;
	default:    $tmp = '$phrase'; break;
	 }
	 return $tmp;
}

?>