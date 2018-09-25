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
if(!defined('_RNINSTALLFILESFOUND')) { define('_RNINSTALLFILESFOUND','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>RavenNuke&trade; Strumento di Setup/Configurazione</title><meta name="rating" content="general"><meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2009 by http://www.ravenphpscripts.com"></head><body><br /><br /><center><a href="http://www.ravenphpscripts.com" title="Raven Web Service: Quality Web Hosting And Web Support"><img src="images/RavenWebServices_Banner.gif" border="0" alt="" /></a>&trade;<br /><br /><table width="75%" border="1"><tr><td align="center" style="color:blue;font-weight:bold;">E\' stata trovata la cartella INSTALLATION - Il continuare in questo modo ti esporr&#224; a possibili attacchi esterni.<br /><br />Per poter continuare devi cancellare la cartella INSTALLATION oppure rinominarla.</td></tr></table></center>'); }
// for Anagram, Milo and Karate theme support (header)
if(!defined('_TOPICS')) { define('_TOPICS','Argomenti'); }
if(!defined('_ALLTOPICS')) { define('_ALLTOPICS','Tutti gli argomenti'); }
if(!defined('_HELLO')) { define('_HELLO','Hello'); }
// for fisubice
define('_FSIADMINMENU','Menu Amministrazione');
define('_FSIYOURACCOUNT','Tuo Account');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED', 'Accesso vietato');
define('_ACTIVEBUTNOTSEE','(Link attivo ma invisibile)');
define('_ADD','Aggiungi');
define('_ADDAHOME','Aggiungi un modulo nella tua Homepage');
define('_ADDITIONALYGRP','Inoltre questo modulo appartiene al Gruppo Utenti');
define('_ADMIN','Amministratore:');
define('_ADMNOTSUB','Utente NON iscritto');
define('_ADMSUB','Utente iscritto!');
define('_ADMSUBEXPIREIN','L\'iscrizione scadr&#224; tra:');
define('_ALLCATEGORIES','Tutte le categorie');
define('_ALLOWEDHTML','Allowed HTML:');
define('_APRIL','Aprile');
define('_AREYOUSURE','(If you included any URLs, be sure to validate and test them for typos.)');
define('_ASREGISTERED','Non hai ancora un account? Puoi <a href="modules.php?name=Your_Account&amp;op=new_user">crearne uno</a>. Come uttente registrato avrai alcuni vantaggi quali la gestione dei temi, la configurazione dei commenti e potrai scrivere commenti con il tuo nome.');
define('_ASSOTOPIC','Argomenti associati');
define('_AUGUST','Agosto');
define('_BANTHIS','Escludi questo IP dal sito');
define('_BBFORUMS','Forum');
define('_BIGSTORY','L\'articolo pi&#249; letto di oggi &#232;:');
define('_BLATEST','Ultimo');
define('_BLOCKPROBLEM','<center>C\'&#232; un problema con questo blocco.</center>');
define('_BLOCKPROBLEM2','<center>Al momento non c\'&#232; nessun contenuto per questo blocco.</center>');
define('_BMEM','Iscritti');
define('_BMEMP','Iscrizione');
define('_BON','Online ora');
define('_BOVER','Complessivi');
define('_BPM','Messaggi privati');
define('_BREAD','Letti');
define('_BREG','Registrati');
define('_BROADCAST','Invia un messaggio pubblico');
define('_BROADCASTFROM','Messaggio pubblico da');
define('_BROKENDOWN','Download errati');
define('_BROKENLINKS','Link errati');
define('_BTD','Nuovi oggi');
define('_BTT','Totali');
define('_BUNREAD','Non letti');
define('_BVIS','Visitatori');
define('_BVISIT','Persone Online');
define('_BWEL','Benvenuto');
define('_BY','da');
define('_BYD','Nuovi ieri');
if (!defined('_CANCEL')) define('_CANCEL','Cancel');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_COMMENTS','commenti');
define('_CONTRIBUTEDBY','Contribuito da');
define('_CURRENTLY','Ci sono attualmente,');
if (!defined('_DATE')) define('_DATE','Data');
define('_DATESTRING','%A, %d %B %Y ore %H:%M:%S %Z');
define('_DATESTRING2','%A, %d %B %Y');
define('_DECEMBER','Dicembre');
define('_DELETE','Cancella');
define('_EDIT','Modifica');
define('_EXPIREIN','Scadenza in');
define('_EXPIRELESSHOUR','Scadenza: meno di un\'ora');
define('_FEBRUARY','Febbraio');
define('_FORADMINTESTS','(per test amministrativi)');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Ritorna</a> ]');
define('_GOBACK2','Ritorna');
define('_GUESTS','ospite(i) e');
define('_HASEXPIRED','&#232; scaduto ora.');
define('_HERE','Qui');
define('_HOME','Home');
define('_HOMEPROBLEM','C\'&#232; un grosso problema qui: non abbiamo una Homepage!!!');
define('_HOMEPROBLEMUSER','C\'&#232; un problema ora sulla Homepage. Per favore controlla pi&#249; tardi.');
define('_HOPESERVED','Speriamo di esserti stato utile...');
define('_HOUR','Ora');
define('_HOURS','Ore');
define('_HREADMORE','leggi ancora...');
define('_HTTPREFERERS','Referenti HTTP');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Codice di sicurezza errato, Per favore torna indietro e riscrivilo esattamente come lo leggi ...');
define('_IN','in'); //0000960
define('_INVISIBLEMODULES','Moduli invisibili');
define('_JANUARY','Gennaio');
define('_JOURNAL','Journal');
define('_JULY','Luglio');
define('_JUNE','Giugno');
define('_LASTIP','IP dell\'ultimo utente:');
define('_LOGIN','Login');
define('_LOGOUT','Logout');
define('_MARCH','Marzo');
define('_MAY','Maggio');
define('_MEMBERS','membri(o) che sono online.');
define('_MENUFOR','Menu per');
define('_MODREQDOWN','Mod. Download');
define('_MODREQLINKS','Mod. Link');
define('_MODULENOTACTIVE','Spiacente, questo modulo non &#232; attivo!');
define('_MODULESADMINS', 'Siamo spiacenti ma questa sezione del nostro sito &#232; <i>solamente per amministratori.</i><br /><br />');
define('_MODULESSUBSCRIBER','Siamo spiacenti ma questa sezione del nostro sito &#232; <i>solamente per utenti iscritti.</i>');
define('_MODULEUSERS', 'Siamo spiacenti ma questa sezione del nostro sito &#232; <i>solamente per utenti registrati.</i><br /><br />Puoi registrarti gratuitamente seguendo questo link <a href="modules.php?name=Your_Account&amp;op=new_user">qui</a>, poi puoi <br />accedere a questa sezione senza restrizioni. Grazie.<br /><br />');
define('_MORENEWS','Altro nella sezione Notizie');
define('_MULTILINGUALOFF','Siamo spiacenti ma non ci sono traduzioni disponibili. Per favore contatta il Webmaster per ulteriore aiuto.');
define('_MVIEWADMIN','Accesso: solo Amministratori');
define('_MVIEWALL','Accesso: tutti i visitatori');
define('_MVIEWANON','Accesso: solo utenti anonimi');
define('_MVIEWSUBUSERS','Accesso: solo utenti iscritti');
define('_MVIEWUSERS','Accesso: solo utenti registrati');
define('_NEWPMSG','Nuovi messaggi privati');
define('_NICKNAME','Nickname');
define('_NO','No');
define('_NOACTIVEMODULES','Moduli non attivi');
define('_NOBIGSTORY','Ancora nessun articolo per oggi.');
define('_NONE','Nessuna');
define('_NOTE','Nota:');
define('_NOTSUB','Non sei iscritto su');
define('_NOVEMBER','Novembre');
define('_NOW','ora!');
define('_OCTOBER','Ottobre');
if (!defined('_OF')) define('_OF','di');
define('_OLDERARTICLES','Articoli meno recenti');
define('_ON','su');
define('_OR','o');
define('_PAGEGENERATION','Generazione pagina:');
define('_PAGESVIEWS','pagine viste dal');
define('_PAGINATOR_TOTALITEMS','oggetti totali');
define('_PAGINATOR_PAGE','Pagina');
define('_PAGINATOR_PAGES','Pagine');
define('_PAGINATOR_GO','Vai');
define('_PAGINATOR_GOTOPAGE','Vai a pagina');
define('_PAGINATOR_GOTONEXT','Vai ala pagina successiva');
define('_PAGINATOR_GOTOPREV','Vai alla pagina precedente');
define('_PAGINATOR_GOTOFIRST','Vai alla prima pagina');
define('_PAGINATOR_GOTOLAST','Vai all\'ultima pagina');
define('_PASSWORD','Password');
define('_PASTARTICLES','Vecchi articoli');
define('_PCOMMENTS','Commenti:');
define('_POLLS','Votazioni');
define('_POSTEDBY','Postato da');
define('_POSTEDON','Postato il');
define('_PRIVATEMSG','messaggio(i) privato(i).');
define('_READMYJOURNAL','Read My Journal');
define('_READS','reads');
define('_REGISTERED','Registered');
define('_RESTRICTEDAREA', 'Stai tentando di accedere ad un\'area riservata.');
define('_RESULTS','Risultati');
define('_RN_FOOTER_CREDITS','<center><br /><font class="small">:: fisubice phpbb2 style by <a href="http://www.forumimages.com/">Daz</a> :: PHP-Nuke theme by <a href="http://www.nukemods.com">www.nukemods.com</a> ::</font></center>'.'<center><font class="small">:: fisubice Theme Recoded To 100% W3C CSS &amp; HTML 4.01 Transitional &amp; XHTML 1.0 Transitional Compliance by RavenNuke&trade; TEAM :: </font></center>'.'<center><br /><font class="small">:: <a href="http://jigsaw.w3.org/css-validator/" target="_blank" title="W3C CSS Compliance Validation"><img src="themes/fisubice/images/w3c_css.gif" width="62" height="22" border="0" alt="W3C CSS Compliance Validation" /></a> :: <a href="http://validator.w3.org/" title="W3C HTML 4.01 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xxx.gif" alt="W3C HTML 4.01 Transitional Compliance Validation" width="62" height="22" border="0" /></a> :: <a href="http://validator.w3.org/" title="W3C XHTML 1.0 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xhtml.gif" alt="W3C XHTML 1.0 Transitional Compliance Validation" width="62" height="22" border="0" /></a> ::</font></center>'.'<br />'."\n");
define('_RSSPROBLEM','Problema momentaneo con i Titoli di questo sito');
define('_SBDAYS','giorni');
define('_SBHOURS','ore');
define('_SBMINUTES','minuti');
define('_SBSECONDS','secondi');
define('_SBYEAR','anno');
define('_SBYEARS','anni');
define('_SEARCH','Cerca');
define('_SECONDS','Secondi');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Codice di sicurezza');
define('_SELECTGUILANG','Seleziona la linguad\'interfaccia:');
define('_SELECTLANGUAGE','Seleziona la lingua');
define('_SEPTEMBER','Settembre');
define('_SUBEXPIRED','Il tuo periodo di iscrizione &egrave; terminato');
define('_SUBEXPIREIN','La tua iscrizione terminer&agrave; tra:');
define('_SUBFROM','Puoi iscriverti da');
define('_SUBHERE','Puoi chiedere l\'iscrizione ai nostri servizi da <a href="'.$subscription_url.'">qui</a>');
define('_SUBMISSIONS','Articoli');
define('_SUBRENEW','Se vuoi rinnovare la tua iscrizione, prego vai a:');
define('_SUBSCRIBER','iscritto');
define('_SUBSCRIPTIONAT','Questo &egrave; un messaggio automatico per farti sapere che il tuo periodo d\'iscrizione su');
define('_SURVEY','Sondaggio');
define('_TOPIC','Argomento');
define('_TURNOFFMSG','Togli Messaggi Pubblici');
define('_TYPESECCODE','Scrivi il codice di sicurezza');
define('_UDOWNLOADS','Download');
define('_UMONTH','Mese');
define('_UNLIMITED','Illimitato');
define('_USERS','Utenti');
define('_VOTE','Voto');
define('_VOTES','Voti');
define('_WAITINGCONT','Contenuti in attesa');
define('_WELCOMETO','Benvenuto su');
define('_WERECEIVED','Abbiamo ricevuto');
define('_WLINKS','Link in attesa');
define('_WREVIEWS','Recensioni in attesa');
define('_WRITES','scrive');
define('_YEAR','Anno');
define('_YES','Si');
define('_YOUARE','Sei');
define('_YOUAREANON','<font color=\"red\">Non ci conosciamo ancora? Registrati gratuitamente <a href="modules.php?name=Your_Account&amp;op=new_user">Qui</a></font>');
define('_YOUARELOGGED','Sei registrato come');
define('_YOUHAVE','Hai');
define('_YOUHAVEONEMSG','Hai un nuovo messaggio privato');
define('_YOUHAVEPOINTS','Punti che hai partecipando ai contenuti del sito:');
//// Raven's User Info Block
define('_ALT_CHKPROFILE','Controlla il profilo di '.$lastusername);
define('_ALT_SEND','Manda un messaggio privato veloce a ');
define('_BHITS','Hit');
define('_GUESTIPS_OPTION','- Indirizzo IP dell\'ospite -');
define('_HIDDEN','Nascosto');
define('_HIDDEN_ABBREV','(N)');
define('_PASSWORDLOST','Password perduta');
define('_SERDT','Data/Orario del server');
define('_TTL_RESENDEMAIL','Modulo phpNuke Resend Email su RavenPHPScripts');
define('_WAITLINK','In attesa');
define('_YOURIP','Il tuo IP: ');
define('_GCALENDAR_EVENTS', 'Calendario degli Eventi');

define('_RWS_WIW_UNABLECONNECTSERVER','Non riesco a connettermi al Server. ');
define('_RWS_WIW_UNABLECONNECTDB','Non riesco a connettermi al Database. ');
define('_RWS_WIW_UNABLETOREMOVE','Non riesco a cancellare.');
define('_RWS_WIW_UNABLETOINSERT','Non riesco ad inserire');
define('_RWS_WIW_MYSQLSAID','Frase di MySQL');
define('_RWS_WIW_TITLE','Who is Where');
define('_RWS_WIW_GUESTSONLINE','Ospite(i) Online');
define('_RWS_WIW_GUESTS','ospite(i)');
define('_RWS_WIW_HOME','Home');
define('_RWS_WIW_USERSONLINE','Utenti Online');
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