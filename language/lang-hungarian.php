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
if(!defined('_RNINSTALLFILESFOUND')) { define('_RNINSTALLFILESFOUND','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//HU"><html><head><title>RavenNuke&trade; Telep�t�s/Be�ll�t�s </title><meta name="rating" content="general"><meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2008 by http://www.ravenphpscripts.com"></head><body><br /><br /><center><a href="http://www.ravenphpscripts.com" title="Raven Web Service: Min�s�gi webhoszting �s t�mogat�s"><img src="images/RavenWebServices_Banner.gif" border="0" alt="" /></a>&trade;<br /><br /><table width="75%" border="1"><tr><td align="center" style="color:blue;font-weight:bold;">INSTALLATION mappa fel van t�ltve a szerverre - Ha folytatja, a weboldal�t vesz�lynek teszi ki.<br /><br />Vagy t�r�lje vagy nevezze �t az INSTALLATION mapp�t a folytat�shoz.</td></tr></table></center>'); }
// for Anagram, Milo and Karate theme support (header)
if(!defined('_TOPICS')) { define('_TOPICS','Rovatok'); }
if(!defined('_ALLTOPICS')) { define('_ALLTOPICS','�sszes rovat'); }
if(!defined('_HELLO')) { define('_HELLO','�dv�zl�m,'); }
// for fisubice
define('_FSIADMINMENU','Admin Men�');
define('_FSIYOURACCOUNT','Az �n saj�t fi�kja');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED', 'Hozz�f�r�s megtagadva!');
define('_ACTIVEBUTNOTSEE','(Akt�v, de nem l�that� link)');
define('_ADD','Hozz�ad');
define('_ADDAHOME','Modul hozz�ad�sa a kezd�lapj�hoz');
define('_ADDITIONALYGRP','Ezen t�lmen�en ez a modul a k�vetkez� felhaszn�l�i csoporthoz tartozik:');
define('_ADMIN','Adminisztr�ci�:');
define('_ADMNOTSUB','Felhaszn�l� nincs feliratkozva!');
define('_ADMSUB','Feliratkozott felhaszn�l�!');
define('_ADMSUBEXPIREIN','Feliratkoz�sa lej�r:');
define('_ALLCATEGORIES','Minden kateg�ria');
define('_ALLOWEDHTML','Haszn�lhat� HTML k�dok:');
define('_APRIL','�prilis');
define('_AREYOUSURE','Ha �rt linkeket is, nincsenek elg�pelve?');
define('_ASREGISTERED','M�g nem regisztr�lta mag�t? <a href="modules.php?name=Your_Account">Itt megteheti</a>. A regisztr�lt felhaszn�l�k sz�mos el�nnyel rendelkeznek: diz�jnv�lt�s, hozz�sz�l�sok be�ll�t�sa, �s hozz�sz�l�sok saj�t n�v alatt.');
define('_ASSOTOPIC','Hozz�rendelt rovatok');
define('_AUGUST','Augusztus');
define('_BANTHIS','IP letilt�sa');
define('_BBFORUMS','F�rum');
define('_BIGSTORY','A legolvasottabb cikk ma:');
define('_BLATEST','Legutols�');
define('_BLOCKPROBLEM','<center>Gondok vannak ezzel a blokkal.</center>');
define('_BLOCKPROBLEM2','<center>Nincs tartalom ehhez a blokkhoz.</center>');
define('_BMEM','Tagok');
define('_BMEMP','Tags�g');
define('_BON','Most online');
define('_BOVER','�sszesen');
define('_BPM','Priv�t �zenetek');
define('_BREAD','Olvasott');
define('_BREG','Regisztr�l');
define('_BROADCAST','Nyilv�nos �zenet k�zz�t�tele');
define('_BROADCASTFROM','Nyilv�nos �zenet k�ld�je:');
define('_BROKENDOWN','Hib�s let�lt�sek');
define('_BROKENLINKS','Hib�s linkek');
define('_BTD','�j a mai napon');
define('_BTT','�ssz.');
define('_BUNREAD','Olvasatlan');
define('_BVIS','L�togat�k');
define('_BVISIT','Online felhaszn�l�k');
define('_BWEL','�dv�zl�m,');
define('_BY','Szerz�:');
define('_BYD','�j a tegnapi napon');
if (!defined('_CANCEL')) define('_CANCEL','M�gse');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_COMMENTS','hozz�sz�l�s');
define('_CONTRIBUTEDBY','szerz�:');
define('_CURRENTLY','Jelenleg');
if (!defined('_DATE')) define('_DATE','D�tum');
define('_DATESTRING','%Y. %m. %d. %H:00');
define('_DATESTRING2','%Y. %m. %d.');
define('_DECEMBER','December');
define('_DELETE','T�rl�s');
define('_EDIT','Szerkeszt�s');
define('_EXPIREIN','Lej�rat ideje:');
define('_EXPIRELESSHOUR','Lej�rat: kevesebb, mint egy �ra');
define('_FEBRUARY','Febru�r');
define('_FORADMINTESTS','(Admin teszthez)');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Vissza</a> ]');
define('_GOBACK2','Vissza');
define('_GUESTS','vend�g �s');
define('_HASEXPIRED','most lej�rt.');
define('_HERE','itt');
define('_HOME','F�oldal');
define('_HOMEPROBLEM','Probl�ma: nincs kezd�lapunk!!!');
define('_HOMEPROBLEMUSER','Pillanatnyilag gondok vannak a kazd�lappal. K�rem, l�togasson vissza k�s�bb.');
define('_HOPESERVED','Rem�lem, el�gedett volt a port�l szolg�ltat�saival...');
define('_HOUR','�ra');
define('_HOURS','�ra');
define('_HREADMORE','tov�bb...');
define('_HTTPREFERERS','HTTP utal�sok');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Biztons�gi k�d hib�s...');
define('_IN','az al�bbi alatt:'); //0000960
define('_INVISIBLEMODULES','Rejtett Modulok');
define('_JANUARY','Janu�r');
define('_JOURNAL','Napl�');
define('_JULY','J�lius');
define('_JUNE','J�nius');
define('_LASTIP','Utols� felhaszn�l� IP-je:');
define('_LOGIN','Bel�p�s');
define('_LOGOUT','Kil�p�s');
define('_MARCH','M�rcius');
define('_MAY','M�jus');
define('_MEMBERS','regisztr�lt felhaszn�l� olvas benn�nket.');
define('_MENUFOR','Szem�lyes men�:');
define('_MODREQDOWN','Let�lt�sek Modul');
define('_MODREQLINKS','Linkek Modul');
define('_MODULENOTACTIVE','Sajnos ez a modul nem akt�v!');
define('_MODULESADMINS', 'Ez a modul csak <i>adminisztr�torok sz�m�ra hozz�f�rhet�.</i><br /><br />');
define('_MODULESSUBSCRIBER','Ez a modul csak <i>el�fizetett felhaszn�l�k sz�m�ra hozz�f�rhet�.</i>');
define('_MODULEUSERS', 'Ez a modul csak <i>Regisztr�lt felhaszn�l�k sz�m�ra hozz�f�rhet�.</i><br /><br />Ingyen regisztr�lhat, ha <a href="modules.php?name=Your_Account&amp;op=new_user">ide</a> kattint.<br />');
define('_MORENEWS','T�bbet a h�rek modulban');
define('_MULTILINGUALOFF','We\'re sorry but there are no language translations available. Please contact the Webmaster for further help.');
define('_MVIEWADMIN','Csak adminisztr�toroknak');
define('_MVIEWALL','Minden l�togat�nak');
define('_MVIEWANON','Csak n�vtelen l�togat�knak');
define('_MVIEWSUBUSERS','Csak el�fizetett felhaszn�l�knak');
define('_MVIEWUSERS','Csak regisztr�lt tagoknak');
define('_NEWPMSG','�j Priv�t �zenetek');
define('_NICKNAME','Felhaszn�l�n�v');
define('_NO','Nem');
define('_NOACTIVEMODULES','Inakt�v Modulok');
define('_NOBIGSTORY','A mai napnak m�g nincs \'nagy sztorija\'.');
define('_NONE','Semmi');
define('_NOTE','Megjegyz�s:');
define('_NOTSUB','Nem fizetett el� a k�vetkez� h�rlev�lre:');
define('_NOVEMBER','November');
define('_NOW','most!');
define('_OCTOBER','Okt�ber');
if (!defined('_OF')) define('_OF','/');
define('_OLDERARTICLES','R�gebbi cikkek');
define('_ON','Ideje:');
define('_OR','vagy');
define('_PAGEGENERATION','oldal gener�l�sa:');
define('_PAGESVIEWS','tal�latot kaptunk az oldal ind�t�sa �ta:');
define('_PAGINATOR_TOTALITEMS','�sszes elem');
define('_PAGINATOR_PAGE','oldal');
define('_PAGINATOR_PAGES','oldal');
define('_PAGINATOR_GO','L�p');
define('_PAGINATOR_GOTOPAGE','Ugr�s adott oldalhoz');
define('_PAGINATOR_GOTONEXT','K�vetkez� oldalhoz');
define('_PAGINATOR_GOTOPREV','El�z� oldalhoz');
define('_PAGINATOR_GOTOFIRST','Els� oldalhoz');
define('_PAGINATOR_GOTOLAST','Utols� oldalhoz');
define('_PASSWORD','Jelsz�');
define('_PASTARTICLES','Kor�bbi cikkek');
define('_PCOMMENTS','Hozz�sz�l�sok:');
define('_POLLS','Szavaz�sok');
define('_POSTEDBY','�rta:');
define('_POSTEDON','Ideje:');
define('_PRIVATEMSG','szem�lyes �zenete van.');
define('_READMYJOURNAL','Napl�m olvas�sa');
define('_READS','olvas�s');
define('_REGISTERED','Regisztr�lt');
define('_RESTRICTEDAREA', 'Egy �n el�l z�rt r�szre pr�b�lt bejutni.');
define('_RESULTS','Eredm�nyek');
define('_RN_FOOTER_CREDITS','<center><br /><font class="small">:: fisubice phpbb2 style by <a href="http://www.forumimages.com/">Daz</a> :: PHP-Nuke theme by <a href="http://www.nukemods.com">www.nukemods.com</a> ::</font></center>'.'<center><font class="small">:: fisubice Theme Recoded To 100% W3C CSS &amp; HTML 4.01 Transitional &amp; XHTML 1.0 Transitional Compliance by RavenNuke&trade; TEAM :: </font></center>'.'<center><br /><font class="small">:: <a href="http://jigsaw.w3.org/css-validator/" target="_blank" title="W3C CSS Compliance Validation"><img src="themes/fisubice/images/w3c_css.gif" width="62" height="22" border="0" alt="W3C CSS Compliance Validation" /></a> :: <a href="http://validator.w3.org/" title="W3C HTML 4.01 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xxx.gif" alt="W3C HTML 4.01 Transitional Compliance Validation" width="62" height="22" border="0" /></a> :: <a href="http://validator.w3.org/" title="W3C XHTML 1.0 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xhtml.gif" alt="W3C XHTML 1.0 Transitional Compliance Validation" width="62" height="22" border="0" /></a> ::</font></center>'.'<br />'."\n");
define('_RSSPROBLEM','Jelenleg nem m�k�dik a site tartalomszolg�ltat�sa');
define('_SBDAYS','nap');
define('_SBHOURS','�ra');
define('_SBMINUTES','perc');
define('_SBSECONDS','m�sodperc');
define('_SBYEAR','�v');
define('_SBYEARS','�v');
define('_SEARCH','Keres�s');
define('_SECONDS','m�sodperc');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Biztons�gi k�d');
define('_SELECTGUILANG','V�lasszon nyelvet:');
define('_SELECTLANGUAGE','V�lasszon nyelvet');
define('_SEPTEMBER','Szeptember');
define('_SUBEXPIRED','El�fizet�se lej�rt');
define('_SUBEXPIREIN','El�fizet�se lej�r:');
define('_SUBFROM','Feliratkozhat a k�vetkez� helyr�l ');
define('_SUBHERE','Feliratkozhat <a href="'.$subscription_url.'">innen</a>');
define('_SUBMISSIONS','J�v�hagy�sra v�r� tartalom');
define('_SUBRENEW','Ha meg akarja �j�tani az el�fizet�s�t, menjen a k�vetkez� oldalra:');
define('_SUBSCRIBER','el�fizet�');
define('_SUBSCRIPTIONAT','Ez egy automatikus �zenet a k�vetkez� weboldallal kapcsolatos el�fizet�s�r�l: ');
define('_SURVEY','Szavaz�g�p');
define('_TOPIC','T�ma');
define('_TURNOFFMSG','Nyilv�nos �zenetek kikapcsol�sa');
define('_TYPESECCODE','�rja be ide a biztons�gi k�dot:');
define('_UDOWNLOADS','Let�lt�sek');
define('_UMONTH','h�nap');
define('_UNLIMITED','Korl�tlan');
define('_USERS','Tagok');
define('_VOTE','szavazat');
define('_VOTES','szavazat');
define('_WAITINGCONT','J�v�hagy�sra v�r� tartalom');
define('_WELCOMETO','�dv�zli');
define('_WERECEIVED','�sszesen');
define('_WLINKS','J�v�hagy�sra v�r� linkek');
define('_WREVIEWS','J�v�hagy�sra v�r� ismertet�k');
define('_WRITES','k�ldte be az al�bbi cikket');
define('_YEAR','�v');
define('_YES','igen');
define('_YOUARE','�n');
define('_YOUAREANON','Jelenleg n�vtelen l�togat�. Ingyenesen regisztr�lhatja mag�t, <a href="modules.php?name=Your_Account">ide</a> kattintva');
define('_YOUARELOGGED','�dv�zl�m,');
define('_YOUHAVE','�nnek');
define('_YOUHAVEONEMSG','�nnek 1 �j priv�t �zenete van');
define('_YOUHAVEPOINTS','Pontok a tartalomk�sz�t�sben val� szerepv�llal�s�rt:');
//// Raven's User Info Block
define('_ALT_CHKPROFILE','.$lastusername be�ll�t�sainak ellen�rz�se');
define('_ALT_SEND','Gyors priv�t �zenet k�ld�se a k�vetkez� felhaszn�l�nak: ');
define('_BHITS','Tal�latok');
define('_GUESTIPS_OPTION','- Vend�g IP c�me -');
define('_HIDDEN','Rejtett');
define('_HIDDEN_ABBREV','(H)');
define('_PASSWORDLOST','Elfelejtett jelsz�');
define('_SERDT','D�tum/Id� a Szerveren:');
define('_TTL_RESENDEMAIL','Resend Email phpNuke Modul - RavenPHPScripts');
define('_WAITLINK','V�rom');
define('_YOURIP','Az �n IP c�me: ');
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