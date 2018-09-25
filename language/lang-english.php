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
if(!defined('_HELLO')) { define('_HELLO','Hello'); }
// for fisubice
define('_FSIADMINMENU','Admin Menu');
define('_FSIYOURACCOUNT','Your Account');
//
define('_CHARSET','ISO-8859-1');
define('_MIME','text/html');
define('_ACCESSDENIED', 'Access Denied');
define('_ACTIVEBUTNOTSEE','(Active but invisible link)');
define('_ADD','Add');
define('_ADDAHOME','Add a Module in your Home');
define('_ADDITIONALYGRP','Additionally this module belongs to the Users Group');
define('_ADMIN','Admin:');
define('_ADMNOTSUB','User NOT Subscribed');
define('_ADMSUB','Subscribed User!');
define('_ADMSUBEXPIREIN','Subscription Expires in:');
define('_ALLCATEGORIES','All Categories');
define('_ALLOWEDHTML','Allowed HTML:');
define('_APRIL','April');
define('_AREYOUSURE','(If you included any URLs, be sure to validate and test them for typos.)');
define('_ASREGISTERED','Don\'t have an account yet? You can <a href="modules.php?name=Your_Account&amp;op=new_user">create one</a>. As a registered user you have some advantages like theme manager, comments configuration and post comments with your name.');
define('_ASSOTOPIC','Associated Topics');
define('_AUGUST','August');
define('_BANTHIS','Ban This IP');
define('_BBFORUMS','Forums');
define('_BIGSTORY','Today\'s most read Story is:');
define('_BLATEST','Latest');
define('_BLOCKPROBLEM','<center>There is a problem right now with this block.</center>');
define('_BLOCKPROBLEM2','<center>There isn\'t content right now for this block.</center>');
define('_BMEM','Members');
define('_BMEMP','Membership');
define('_BON','Online Now');
define('_BOVER','Overall');
define('_BPM','Private Messages');
define('_BREAD','Read');
define('_BREG','Register');
define('_BROADCAST','Broadcast Public Message');
define('_BROADCASTFROM','Public Message from');
define('_BROKENDOWN','Broken Downloads');
define('_BROKENLINKS','Broken Links');
define('_BTD','New Today');
define('_BTT','Total');
define('_BUNREAD','Unread');
define('_BVIS','Visitors');
define('_BVISIT','People Online');
define('_BWEL','Welcome');
define('_BY','by');
define('_BYD','New Yesterday');
if (!defined('_CANCEL')) define('_CANCEL','Cancel');
if (!defined('_CATEGORY')) define('_CATEGORY','Category');
define('_COMMENTS','comments');
define('_CONTRIBUTEDBY','Contributed by');
define('_CURRENTLY','There are currently,');
if (!defined('_DATE')) define('_DATE','Date');
define('_DATESTRING','%A, %B %d, %Y @ %H:%M:%S %Z');
define('_DATESTRING2','%A, %B %d, %Y');
define('_DECEMBER','December');
define('_DELETE','Delete');
define('_EDIT','Edit');
define('_EXPIREIN','Expiration in');
define('_EXPIRELESSHOUR','Expiration: Less than 1 hour');
define('_FEBRUARY','February');
define('_FORADMINTESTS','(for Admin tests)');
define('_GOBACK','[ <a href="javascript:history.go(-1)">Go Back</a> ]');
define('_GOBACK2','Go Back');
define('_GUESTS','guest(s) and');
define('_HASEXPIRED','has now expired.');
define('_HERE','here');
define('_HOME','Home');
define('_HOMEPROBLEM','There is a big problem here: we do not have a Homepage!!!');
define('_HOMEPROBLEMUSER','There is a problem right now on the Homepage. Please check back later.');
define('_HOPESERVED','Hope to have served you with satisfaction...');
define('_HOUR','Hour');
define('_HOURS','Hours');
define('_HREADMORE','read more...');
define('_HTTPREFERERS','HTTP Referers');
if (!defined('_SECCODEINCOR')) define('_SECCODEINCOR','Security Code is incorrect, Please go back and type it exactly as given ...');
define('_IN','in'); //0000960
define('_INVISIBLEMODULES','Invisible Modules');
define('_JANUARY','January');
define('_JOURNAL','Journal');
define('_JULY','July');
define('_JUNE','June');
define('_LASTIP','Last user IP:');
define('_LOGIN','Login');
define('_LOGOUT','Logout');
define('_MARCH','March');
define('_MAY','May');
define('_MEMBERS','member(s) that are online.');
define('_MENUFOR','Menu for');
define('_MODREQDOWN','Mod. Downloads');
define('_MODREQLINKS','Mod. Links');
define('_MODULENOTACTIVE','Sorry, this Module isn\'t active!');
define('_MODULESADMINS', 'We are Sorry but this section of our site is for <i>Administrators Only.</i><br /><br />');
define('_MODULESSUBSCRIBER','We are Sorry but this section of our site is for <i>Subscribed Users Only.</i>');
define('_MODULEUSERS', 'We are Sorry, but this section of our site is for <i>Registered Users Only.</i><br /><br />You can register for free by clicking <a href="modules.php?name=Your_Account&amp;op=new_user">here</a>, then you can<br />access this section without restrictions. Thanks.<br /><br />');
define('_MORENEWS','More in News Section');
define('_MULTILINGUALOFF','We\'re sorry but there are no language translations available. Please contact the Webmaster for further help.');
define('_MVIEWADMIN','View: Administrators Only');
define('_MVIEWALL','View: All Visitors');
define('_MVIEWANON','View: Anonymous Users Only');
define('_MVIEWSUBUSERS','View: Subscribed Users Only');
define('_MVIEWUSERS','View: Registered Users Only');
define('_NEWPMSG','New Private Messages');
define('_NICKNAME','Nickname');
define('_NO','No');
define('_NOACTIVEMODULES','Inactive Modules');
define('_NOBIGSTORY','There isn\'t a Biggest Story for Today, yet.');
define('_NONE','None');
define('_NOTE','Note:');
define('_NOTSUB','You are not a subscriber of');
define('_NOVEMBER','November');
define('_NOW','now!');
define('_OCTOBER','October');
if (!defined('_OF')) define('_OF','of');
define('_OLDERARTICLES','Older Articles');
define('_ON','on');
define('_OR','or');
define('_PAGEGENERATION','Page Generation:');
define('_PAGESVIEWS','page views since');
define('_PAGINATOR_TOTALITEMS','total items');
define('_PAGINATOR_PAGE','Page');
define('_PAGINATOR_PAGES','Pages');
define('_PAGINATOR_GO','Go');
define('_PAGINATOR_GOTOPAGE','Go to page');
define('_PAGINATOR_GOTONEXT','Go to next page');
define('_PAGINATOR_GOTOPREV','Go to previous page');
define('_PAGINATOR_GOTOFIRST','Go to first page');
define('_PAGINATOR_GOTOLAST','Go to last page');
define('_PASSWORD','Password');
define('_PASTARTICLES','Past Articles');
define('_PCOMMENTS','Comments:');
define('_POLLS','Polls');
define('_POSTEDBY','Posted by');
define('_POSTEDON','Posted on');
define('_PRIVATEMSG','private message(s).');
define('_READMYJOURNAL','Read My Journal');
define('_READS','reads');
define('_REGISTERED','Registered');
define('_RESTRICTEDAREA', 'You are trying to access a restricted area.');
define('_RESULTS','Results');
define('_RN_FOOTER_CREDITS','<center><br /><font class="small">:: fisubice phpbb2 style by <a href="http://www.forumimages.com/">Daz</a> :: PHP-Nuke theme by <a href="http://www.nukemods.com">www.nukemods.com</a> ::</font></center>'.'<center><font class="small">:: fisubice Theme Recoded To 100% W3C CSS &amp; HTML 4.01 Transitional &amp; XHTML 1.0 Transitional Compliance by RavenNuke&trade; TEAM :: </font></center>'.'<center><br /><font class="small">:: <a href="http://jigsaw.w3.org/css-validator/" target="_blank" title="W3C CSS Compliance Validation"><img src="themes/fisubice/images/w3c_css.gif" width="62" height="22" border="0" alt="W3C CSS Compliance Validation" /></a> :: <a href="http://validator.w3.org/" title="W3C HTML 4.01 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xxx.gif" alt="W3C HTML 4.01 Transitional Compliance Validation" width="62" height="22" border="0" /></a> :: <a href="http://validator.w3.org/" title="W3C XHTML 1.0 Transitional Compliance Validation"><img src="themes/fisubice/images/w3c_xhtml.gif" alt="W3C XHTML 1.0 Transitional Compliance Validation" width="62" height="22" border="0" /></a> ::</font></center>'.'<br />'."\n");
define('_RSSPROBLEM','Currently there is a problem with headlines from this site');
define('_SBDAYS','days');
define('_SBHOURS','hours');
define('_SBMINUTES','minutes');
define('_SBSECONDS','seconds');
define('_SBYEAR','year');
define('_SBYEARS','years');
define('_SEARCH','Search');
define('_SECONDS','Seconds');
if (!defined('_SECURITYCODE')) define('_SECURITYCODE','Security Code');
define('_SELECTGUILANG','Select Interface Language:');
define('_SELECTLANGUAGE','Select Language');
define('_SEPTEMBER','September');
define('_SUBEXPIRED','Your Subscription Has Expired');
define('_SUBEXPIREIN','Your subscription will expire in:');
define('_SUBFROM','You can subscribe from');
define('_SUBHERE','You can subscribe to our services from <a href="'.$subscription_url.'">here</a>');
define('_SUBMISSIONS','Submissions');
define('_SUBRENEW','If you want to renew your subscription please go to:');
define('_SUBSCRIBER','subscriber');
define('_SUBSCRIPTIONAT','This is an automated message to let you know that your subscription at');
define('_SURVEY','Survey');
define('_TOPIC','Topic');
define('_TURNOFFMSG','Turn Off Public Messages');
define('_TYPESECCODE','Type Security Code');
define('_UDOWNLOADS','Downloads');
define('_UMONTH','Month');
define('_UNLIMITED','Unlimited');
define('_USERS','Users');
define('_VOTE','Vote');
define('_VOTES','Votes');
define('_WAITINGCONT','Waiting Content');
define('_WELCOMETO','Welcome to');
define('_WERECEIVED','We have received');
define('_WLINKS','Waiting Links');
define('_WREVIEWS','Waiting Reviews');
define('_WRITES','writes');
define('_YEAR','Year');
define('_YES','Yes');
define('_YOUARE','You are');
define('_YOUAREANON','You are an Anonymous user. You can register for free by clicking <a href="modules.php?name=Your_Account&amp;op=new_user">here</a>');
define('_YOUARELOGGED','You are logged as');
define('_YOUHAVE','You have');
define('_YOUHAVEONEMSG','You Have 1 New Private Message');
define('_YOUHAVEPOINTS','Points you have by participating on the site\'s content:');
//// Raven's User Info Block
define('_ALT_CHKPROFILE','Check the profile of '.$lastusername);
define('_ALT_SEND','Send a quick private message to ');
define('_BHITS','Hits');
define('_GUESTIPS_OPTION','- Guest IP\'s -');
define('_HIDDEN','Hidden');
define('_HIDDEN_ABBREV','(H)');
define('_PASSWORDLOST','Lost Password');
define('_SERDT','Server Date/Time');
define('_TTL_RESENDEMAIL','Resend Email phpNuke Module at RavenPHPScripts');
define('_WAITLINK','Waiting');
define('_YOURIP','Your IP: ');
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
/* For the module PHP-Nuke Tools 3.00                */
/*****************************************************/

define("_BLOCKC","Block Creator");
define("_MODULEC","Module Creator");
define("_HTMLC","HTML to PHP");
define("_EDITORC","Online HTML Editor");
define("_POPUP","Popup Creator");
define("_SCROLLC","Scrollbar Creator");
define("_METAC","Meta Tag Creator");
define("_HTMLASP","HTML to ASP");
define("_HTMLJS","HTML to Javascript");
define("_HTMLJSP","HTML to JSP");
define("_HTMLPERL","HTML to Perl");
define("_HTMLSWS","HTML to SWS");
define("_HEXC","Hex Colors");
define("_PREVIEWER","Previewer");
define("_SCODER","Source Encoder");
define("_HTMLCODER","HTML Encoder");
define("_URLCODER","URL Encoder");
define("_EMAILCODER","Email Encoder");
define("_ROTCODER","Rot-13 Encoder");
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