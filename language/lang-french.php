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
if(!defined('_RNINSTALLFILESFOUND')) { define('_RNINSTALLFILESFOUND','<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><title>RavenNuke&trade; Setup/Configuration Tool</title><meta name="rating" content="general"><meta name="generator" content="PHP Web Host - Quality Web Hosting For All PHP Applications - Copyright (c) 2002-2009 by http://www.ravenphpscripts.com"></head><body><br /><br /><center><a href="http://www.ravenphpscripts.com" title="Raven Web Service: Quality Web Hosting And Web Support"><img src="images/RavenWebServices_Banner.gif" border="0" alt="" /></a>&trade;<br /><br /><table width="75%" border="1"><tr><td align="center" style="color:blue;font-weight:bold;">INSTALLATION folder detected - To continue would expose your site to damage.<br /><br />Either delete the INSTALLATION folder or rename it in order to proceed.</td></tr></table></center>'); }
// for Anagram, Milo and Karate theme support (header)
if(!defined('_TOPICS')) { define('_TOPICS','Topics'); }
if(!defined('_ALLTOPICS')) { define('_ALLTOPICS','All Topics'); }
if(!defined('_HELLO')) { define('_HELLO','Bonjour'); }
// for fisubice
define('_FSIADMINMENU','Admin Menu');
define('_FSIYOURACCOUNT','Votre compte');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED','Accès refusé');
define('_ACTIVEBUTNOTSEE','(Lien actif mais invisible)');
define('_ADD','Ajouté');
define('_ADDAHOME','Ajouter un module dans Home');
define('_ADDITIONALYGRP','En outre, ce module appartient au groupe Utilisateurs');
define('_ADMIN','Admin:');
define('_ADMNOTSUB','Utilisateur NON abonnés');
define('_ADMSUB','Utilisateur abonnés!');
define('_ADMSUBEXPIREIN','Abonnement Expire dans:');
define('_ALLCATEGORIES','Toutes les catégories');
define('_ALLOWEDHTML','HTML autorisé:');
define('_APRIL','Avril');
define('_AREYOUSURE','Etes-vous sûre d\'inclure une URL ? Avez-vous verifié la typo. ?');
define('_ASREGISTERED','Vous n\'avez pas encore de compte?<br /><a href="modules.php?name=Your_Account">Enregistrez vous !</a><br />En tant que membre enregistré, vous béficierez de privilèges tels que: changer le thème de l\'interface, modifier la disposition des commentaires, signer vos interventions, ...');
define('_ASSOTOPIC','Sujets associés');
define('_AUGUST','Août');
define('_BANTHIS','IP Interdite');
define('_BBFORUMS','Forums');
define("_BBFORUM_TOTTHREAD","Thread :: Post ");
define("_BBFORUM_TOTTOPICS","Topics ");
define("_BBFORUM_TOTPOSTS","Posts ");
define("_BBFORUM_TOTVIEWS","Views ");
define("_BBFORUM_TOTREPLIES","Total Replies ");
define("_BBFORUM_TOTMEMBERS","Members ");
define("_BBFORUM_POSTER","Posted by");
define("_BBFORUM_VIEWS","Views");
define("_BBFORUM_REPLIES","Replies");
define("_BBFORUM_LASTPOSTER","Last Post");
define('_BIGSTORY','Aujourd\'hui, l\'article le plus lu est:');
define('_BLATEST','Dernier');
define('_BLOCKPROBLEM','<center>Il y a un probleme avec ce bloc.</center>');
define('_BLOCKPROBLEM2','<center>Il n\'y a rien dans ce block.</center>');
define('_BMEM','Membres');
define('_BMEMP','Inscription');
define('_BON','Vous êtes a présent en ligne');
define('_BOVER','Total');
define('_BPM','Messages Privés');
define('_BREAD','Lu(s)');
define('_BREG','S\'enregistré');
define('_BROADCAST','Broadcast Public Message');
define('_BROADCASTFROM','Public Message from');
define('_BROKENDOWN','Broken Downloads');
define('_BROKENLINKS','Broken Links');
define('_BTD','Aujourdh\'hui');
define('_BTT','Total');
define('_BUNREAD','Non lu(s)');
define('_BVIS','Visiteurs');
define('_BVISIT','En ligne');
define('_BWEL','Bienvenue');
define('_BY','par');
define('_BYD','Hier');
if (!defined('_CANCEL')) define('_CANCEL', 'Annuler');
if (!defined('_CATEGORY')) define('_CATEGORY','Cat&eacute;gorie');
define('_COMMENTS','commentaires');
define('_CONTRIBUTEDBY','Contributed by');
define('_CURRENTLY','Il y a pour le moment');
if (!defined('_DATE')) define('_DATE','Date');
define('_DATESTRING','%d %B %Y &agrave; %H:%M:%S %Z ');
define('_DATESTRING2','%A, %d %B %Y');
define('_DECEMBER','Décembre');
define('_DELETE','Supprimer');
define('_EDIT','Editer');
define('_EXPIREIN','Expiration dans');
define('_EXPIRELESSHOUR','Expiration: Moins d\'une heure');
define('_FEBRUARY','Février');
define('_FORADMINTESTS','(Pour des tests administratifs)');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Retour</a> ]');
define('_GOBACK2','Retour');
define('_GUESTS','invité(s) et');
define('_HASEXPIRED','has now expired.');
define('_HERE','here');
define('_HOME','Home');
define('_HOMEPROBLEM','There is a big problem here: we do not have a Homepage!!!');
define('_HOMEPROBLEMUSER','There is a problem right now on the Homepage. Please check back later.');
define('_HOPESERVED','Hope to have served you with satisfaction...');
define('_HOUR','Heure');
define('_HOURS','heures');
define('_HREADMORE','suite...');
define('_HTTPREFERERS','R&eacute;f&eacute;rants HTTP');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Security Code is incorrect, Please go back and type it exactly as given ...');
define('_IN','dans le');
define('_INVISIBLEMODULES','Invisible Modules');
define('_JANUARY','Janvier');
define('_JOURNAL','Journal');
define('_JULY','Juillet');
define('_JUNE','Juin');
define('_LASTIP','Last user IP:');
define('_LOGIN',' Identification ');
define('_LOGOUT','Sortie');
define('_MARCH','Mars');
define('_MAY','Mai');
define('_MEMBERS','membre(s) en ligne.');
define('_MENUFOR','Menu de');
define('_MODREQDOWN','Mod. Downloads');
define('_MODREQLINKS','Mod. Links');
define('_MODULENOTACTIVE','Désolé, ce module n\'est pas activé');
define('_MODULESADMINS','Nous sommes désolé mais cette section de notre site est réservée aux <i>administrateurs seulement</i><br /><br />');
define('_MODULESSUBSCRIBER','We are Sorry but this section of our site is for <i>Subscribed Users Only.</i>');
define('_MODULEUSERS','Nous sommes désolé mais cette section de notre site est pour les <i>utilisateurs enregistrés seulement</i><br /><br />Vous pouvez vous enregistrer gratuitement en cliquant <a href="modules.php?name=Your_Account&amp;op=new_user">ici</a>, puis vous pouvez<br />accéder à cette section sans réstriction. Merci.<br /><br />');
define('_MORENEWS','More in News Section');
define('_MULTILINGUALOFF','We\'re sorry but there are no language translations available. Please contact the Webmaster for further help.');
define('_MVIEWADMIN','Visualisation: Administrateurs seulement');
define('_MVIEWALL','Visualisation: Tous les visiteurs');
define('_MVIEWANON','Visualisation: Utilisateurs anonymes seulement');
define('_MVIEWSUBUSERS','Visualisation: Abonnés seulement');
define('_MVIEWUSERS','Visualisation: Utilisateurs enregistr&eacute;s seulement');
define('_NEWPMSG','New Private Messages');
define('_NICKNAME','Surnom / Pseudo');
define('_NO','Non');
define('_NOACTIVEMODULES','Modules inactifs');
define('_NOBIGSTORY','Il n\'y a pas encore d\'article-phare aujourd\'hui.');
define('_NONE','Aucun');
define('_NOTE','Note:');
define('_NOTSUB','Vous n\'êtes pas un abonné de');
define('_NOVEMBER','Novembre');
define('_NOW','now!');
define('_OCTOBER','Octobre');
if (!defined('_OF')) define('_OF','of');
define('_OLDERARTICLES','Archives');
define('_ON','le');
define('_OR','ou');
define('_PAGEGENERATION','Page Generation:');
define('_PAGESVIEWS','pages vues depuis');
define('_PAGINATOR_TOTALITEMS','total items');
define('_PAGINATOR_PAGE','Page');
define('_PAGINATOR_PAGES','Pages');
define('_PAGINATOR_GO','Go');
define('_PAGINATOR_GOTOPAGE','Aller à la page');
define('_PAGINATOR_GOTONEXT','Aller à la page suivante');
define('_PAGINATOR_GOTOPREV','Aller à la page précédente');
define('_PAGINATOR_GOTOFIRST','Aller à la première page');
define('_PAGINATOR_GOTOLAST','Aller à la dernière page');
define('_PASSWORD','Mot de Passe');
define('_PASTARTICLES','Articles pr&eacute;c&eacute;dents');
define('_PCOMMENTS','Commentaires:');
define('_POLLS','Sondages');
define('_POSTEDBY','Transmis par');
define('_POSTEDON','Posté le');
define('_PRIVATEMSG','message(s) privé(s).');
define('_READMYJOURNAL','Lire mon Journal');
define('_READS','lectures');
define('_REGISTERED','Enregistrée');
define('_RESTRICTEDAREA','Vous essayez d\'accéder à un espace réservé.');
define('_RESULTS','R&eacute;sultats');
define('_RN_FOOTER_CREDITS','<center><br /><font class="small">:: PHP-Nuke theme by cRANK ::</font></center>'.'<center><font class="small">:: BlackOps Theme codé à 100% by cRANK ::');
define('_RSSPROBLEM','La manchette de ce site n\'est pas disponible pour le moment.');
define('_SBDAYS','jours');
define('_SBHOURS','heures');
define('_SBMINUTES','minutes');
define('_SBSECONDS','secondes');
define('_SBYEAR','année');
define('_SBYEARS','années');
define('_SEARCH','Recherche');
define('_SECONDS','Secondes');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Security Code');
define('_SELECTGUILANG','Selectionnez la langue de l\'interface:');
define('_SELECTLANGUAGE','Selectionnez la langue');
define('_SEPTEMBER','Septembre');
define('_SUBEXPIRED','Votre abonnement a expiré');
define('_SUBEXPIREIN','Votre abonnement expire dans:');
define('_SUBFROM','Vous pouvez vous abonner à partir de');
define('_SUBHERE','Vous pouvez vous abonner à nos services de <a href="'.$subscription_url.'">ici</a>');
define('_SUBMISSIONS','Propositions');
define('_SUBRENEW','Si vous souhaitez renouveler votre abonnement s\'il vous plaît consulter le site:');
define('_SUBSCRIBER','abonné');
define('_SUBSCRIPTIONAT','Ceci est un message automatique pour vous informer que votre abonnement à');
define('_SURVEY','Sondage');
define('_TOPIC','Sujet');
define('_TURNOFFMSG','Désactiver les messages publics');
define('_TYPESECCODE','Entré Code de Sécurité');
define('_UDOWNLOADS','Téléchargements');
define('_UMONTH','Mois');
define('_UNLIMITED','Illimitées');
define('_USERS','Utilisateurs');
define('_VOTE','Vote');
define('_VOTES','Votes');
define('_WAITINGCONT','Contenu en attente');
define('_WELCOMETO','Bienvenue sur');
define('_WERECEIVED','Nous avons eu');
define('_WLINKS','Liens en attente');
define('_WREVIEWS','Comptes rendus en attente');
define('_WRITES','a écrit :');
define('_YEAR','Année');
define('_YES','Oui');
define('_YOUARE','Vous êtes');
define('_YOUAREANON','Vous &ecirc;tes un visiteur anonyme. Vous pouvez vous enregistrer gratuitement en cliquant <a href="modules.php?name=Your_Account">ici</a>.');
define('_YOUARELOGGED','Vous &ecirc;tes connect&eacute; en tant que');
define('_YOUHAVE','Vous avez');
define('_YOUHAVEONEMSG','Vous avez 1 nouveau message privé');
define('_YOUHAVEPOINTS','Points que vous avez eu en participant sur le contenu du site\'s:');
//// Raven's User Info Block
define('_ALT_CHKPROFILE','Voir le profil de '.$lastusername);
define('_ALT_SEND','Envoyer un message privé rapide à ');
define('_BHITS','Hits');
define('_GUESTIPS_OPTION','- Visiteur IP\'s -');
define('_HIDDEN','Invisible');
define('_ANONYME','Anonymes');
define('_HIDDEN_ABBREV','(H)');
define('_ANONYME_ABBREV','(A)');
define('_PASSWORDLOST','Mot de passe oublié');
define('_SERDT','Server Date/Heure');
define('_TTL_RESENDEMAIL','Resend Email phpNuke Module at RavenPHPScripts');
define('_WAITLINK','En attente');
define('_YOURIP','Votre IP: ');
define('_GCALENDAR_EVENTS', 'Events Calendrier');

define('_RWS_WIW_UNABLECONNECTSERVER','Impossible de se connecter au serveur. ');
define('_RWS_WIW_UNABLECONNECTDB','Impossible de se connecter à la base de données. ');
define('_RWS_WIW_UNABLETOREMOVE','Impossible de supprimer.');
define('_RWS_WIW_UNABLETOINSERT','Impossible d\'insérer');
define('_RWS_WIW_MYSQLSAID','MySQL dit');
define('_RWS_WIW_TITLE','Qui est où');
define('_RWS_WIW_GUESTSONLINE','Visiteur(s) Online');
define('_RWS_WIW_GUESTS','visiteur(s)');
define('_RWS_WIW_HOME','Home');
define('_RWS_WIW_USERSONLINE','User(s) Online');
define('_RWS_WIW_REFRESH','sec. rafraîchissement');
define("_MODULEC","Cr&eacute;ation de Module");
define("_BLOCKC","Cr&eacute;ation de Bloc");
define("_HTMLC","HTML vers PHP");
define("_EDITORC","Editeur HTML en Ligne");
define("_POPUP","Cr&eacute;ation de Popup");
define("_SCROLLC","Cr&eacute;ation de Scrollbar");
define("_HEXC","Couleurs Hexadécimales");
define("_METAC","Cr&eacute;ation de Meta Tags");
define("_HTMLASP","HTML vers ASP");
define("_HTMLJS","HTML vers Javascript");
define("_HTMLJSP","HTML vers JSP");
define("_HTMLPERL","HTML vers Perl");
define("_HTMLSWS","HTML vers SWS");
define("_PREVIEWER","Aperçu");
define("_SCODER","Codeur Source");
define("_HTMLCODER","Codeur HTML");
define("_URLCODER","Codeur URL");
define("_EMAILCODER","Codeur Email");
define("_ROTCODER","Codeur Rot-13");
define("_WSORDERCOMPLETE", "Votre commande a été complété avec succès. L'admin vous avisera si votre abonnement a été approuvé.");
define("_WSORDERCOMPLETE2", "Votre commande a été complété avec succès. Vous pouvez maintenant accéder à votre compte et voir les détails de votre abonnement.");
define("_WSORDERCON", "Votre commande a été annulée");
define("_ERRORTXT2", "Vous ne pouvez pas avoir les deux informations de connexion et enregistrer de nouveaux champs de texte. S'il vous plaît connectez-vous ou inscrivez-vous, pas les deux.");
define("_ERRORTXT3", "S\'il vous plaît, entrez votre adresse email.");
define("_ERRORTXT4", "S\'il vous plaît entrer votre mot de passe.");
define("_ERRORTXT5", "S\'il vous plaît re-saisir votre mot de passe.");
define("_ERRORTXT6", "Vos mots de passe ne correspondent pas. S\'il vous plaît vérifier les champs soigneusement.");
define("_ERRORINVEMAIL","ERREUR: Email Invalide"._GOBACK."");
define("_ERROREMAILSPACES","ERREUR: Les adresses Email ne contiennent pas d'espaces"._GOBACK."");
define("_ERRORINVNICK","ERREUR: Pseudo invalide"._GOBACK."");
define("_NICK2LONG","Pseudo trop long. Il doit être inférieure à 25 caractères"._GOBACK."");
define("_NAMERESERVED","ERREUR: Ce nom est réservé"._GOBACK."");
define("_NICKNOSPACES","ERREUR: Il ne peut y avoir des espaces dans le Pseudo"._GOBACK."");
define("_NICKTAKEN","ERREUR: Pseudo déjà utilisé"._GOBACK."");
define("_EMAILREGISTERED","ERREUR: Adresse email déjà utilisé"._GOBACK."");

//WS BANNERS MODULE
define("_WSADSORDERCOMPLETE", "Your order has been successful. You can now log into your clients account to see the changes.");
define("_WSADSERR1", "You have not selected an advertisement plan from the drop box.");

//IF YOU ARE ALREADY USING THE WS SUBSCRIPTION MODULE THEN YOU DO NOT NEED TO ADD THE FOLLOWING TEXT.
define("_WSORDERCON", "Your order has been cancelled");
define("_ERRORTXT2", "You cannot have both login details and register new fields with text. Please either log-in or register, not both.");
define("_ERRORTXT3", "Please enter your email address.");
define("_ERRORTXT4", "Please enter your password.");
define("_ERRORTXT5", "Please re-enter your password.");
define("_ERRORTXT6", "Your passwords do not match. Please check both fields carefully.");
define("_ERRORINVEMAIL","ERROR: Invalid Email"._GOBACK."");
define("_ERROREMAILSPACES","ERROR: Email addresses do not contain spaces"._GOBACK."");
define("_ERRORINVNICK","ERROR: Invalid Nickname"._GOBACK."");
define("_NICK2LONG","Nickname is too long. It must be less than 25 characters"._GOBACK."");
define("_NAMERESERVED","ERROR: This Name is Reserved"._GOBACK."");
define("_NICKNOSPACES","ERROR: There cannot be any spaces in the Nickname"._GOBACK."");
define("_NICKTAKEN","ERROR: Nickname already taken"._GOBACK."");
define("_EMAILREGISTERED","ERROR: Email address already registered"._GOBACK."");
define('_FSIYOURACCOUNT','Your Account');

/*****************************************************/
/* Pour le module PHP-Nuke Tools 3.00                */
/*****************************************************/

define("_MODULEC","Cr&eacute;ation de Module");
define("_BLOCKC","Cr&eacute;ation de Bloc");
define("_HTMLC","HTML vers PHP");
define("_EDITORC","Editeur HTML en Ligne");
define("_POPUP","Cr&eacute;ation de Popup");
define("_SCROLLC","Cr&eacute;ation de Scrollbar");
define("_HEXC","Couleurs Hexadécimales");
define("_METAC","Cr&eacute;ation de Meta Tags");
define("_HTMLASP","HTML vers ASP");
define("_HTMLJS","HTML vers Javascript");
define("_HTMLJSP","HTML vers JSP");
define("_HTMLPERL","HTML vers Perl");
define("_HTMLSWS","HTML vers SWS");

define("_PREVIEWER","Apercu");
define("_SCODER","Codeur Source");
define("_HTMLCODER","Codeur HTML");
define("_URLCODER","Codeur URL");
define("_EMAILCODER","Codeur Email");
define("_ROTCODER","Codeur Rot-13");
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
