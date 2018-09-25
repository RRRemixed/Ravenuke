<?php
//#####################################################################
// PHP-NUKE: Advanced Content Management System
// ============================================
//
// Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
// http://phpnuke.org
//
// This module is to configure the main options for your site
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//#####################################################################
if (stristr(htmlentities($_SERVER['PHP_SELF']), 'config.php')) {
	Header('Location: index.php');
	die();
}
//#####################################################################
// Database & System Config
//
// dbhost:            SQL Database Hostname
// dbuname:           SQL Username
// dbpass:            SQL Password
// dbname:            SQL Database Name
// $prefix:           Your Database table prefix
// $user_prefix:      Your Users' Database table prefix (To share it)
// $dbtype:           Your Database Server type. DO NOT CHANGE as only MySQL
//                      is now supported.
// $sitekey:          Security Key. DO CHANGE this from the default so that hackers
//                      do not know your key.  Change it to whatever you want, as long
//                      as you want. Just do not use quotes.
// $gfx_chk:          Controls the graphic security code on every login screen (requires
//                      the GD extension with FreeType support):
//                      0: No check
//                      1: Administrators login only
//                      2: Users login only
//                      3: New users registration only
//                      4: Both, users login and new users registration only
//                      5: Administrators and users login only
//                      6: Administrators and new users registration only
//                      7: Everywhere on all login options (Admins and Users)
//                      NOTE: if you are unsure what to set it to, just leave it at the
//                      default value of '7' for the highest security level.
// $subscription_url: If you manage subscriptions on your site, you must write here the url
//                      of the subscription information/renewal page. This will be sent by
//                      email if set.
// $admin_file:       Administration panel filename. The default of 'admin' is for the
//                      standard admin.php script name.  If NukeSentinel(tm) is configured
//                      properly, there is no need to rename the admin.php script.  If you should
//                      decide to do so, be sure to modify this setting to the new name.
// $tipath:           Path to where the topic images are stored.  Very few sites need to change this.
// $display_errors:   Debug control to see PHP generated errors.
//                      false: Do not show errors (use this for a production site))
//                      true: See all errors (error levels are controlled by $error_reporting setting
//                        within rnconfig.php)
//#####################################################################
$dbhost = 'localhost';
$dbuname = 'root';
$dbpass = '';
$dbname = 'ravennuke';
$prefix = 'nuke';
$user_prefix = 'nuke';
$dbtype = 'MySQL';
$sitekey = 'SdFk*fa2rnv21076~v28367-dm52?6w69.3a2fDS+e9';
$gfx_chk = 7;
$subscription_url = '';
$admin_file = 'admin';
$tipath = 'images/topics/';
$display_errors = false;  //This should only be used (set to "true") when testing locally and not in a production environment
//#####################################################################
// You are done with the key database/system settings.  Continue with
// the rest of the Installation Guide steps.  The rest of the settings
// are optional configuration settings which drive specific RavenNuke(tm)
// features.
//#####################################################################
// DO NOT TOUCH ANYTHING BELOW THIS LINE UNTIL YOU KNOW WHAT YOU'RE DOING
//#####################################################################
$reasons = array('As Is','Offtopic','Flamebait','Troll','Redundant','Insightful','Interesting','Informative','Funny','Overrated','Underrated');
$badreasons = 4;
$AllowableHTML = array('b'=>1,'i'=>1,'u'=>1,'div'=>2,'a'=>2,'em'=>1,'br'=>1,'strong'=>1,'blockquote'=>1,'tt'=>1,'li'=>1,'ol'=>1,'ul'=>1);
$CensorList = array('fuck','cunt','fucker','fucking','pussy','cock','c0ck','cum','twat','clit','bitch','fuk','fuking','motherfucker');
// Nuke Patched 3.2 (modified by the RavenNuke Team)
// Further enhanced by Raven at http://www.ravenphpscripts.com
/*********************************************************************
 * Additional configuration options are available within the rnconfig.php
 * script to further control RavenNuke(tm) operational features.
 *********************************************************************/
if (defined('INCLUDE_PATH') && file_exists(INCLUDE_PATH . 'rnconfig.php')) require_once INCLUDE_PATH . 'rnconfig.php';
else {
	echo <<< ERROR
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Impossible de trouver le fichier de configuration RN CONFIG/title>
	</head>
	<body>
		Impossible de localiser le fichier RavenNuke&trade; configuration file - rnconfig.php<br />
		<br />

		Il pourrait être absent ou non lisible. S'il vous plaît vérifier que le fichier existe bien et qu'il soit lisible dans le dossier racine.<br />
		<br />
		Cela peut aussi être causé par un tiers module/script qui tente d'inclure le fichier config.php directement plutôt que d'inclure mainfile.php et laisser la charge config.php, ou autrement ne pas suivre les normes RavenNuke(tm) sur la façon dont la constante INCLUDE_PATH est défini (cela se fait dans mainfile.php, et dépend d'autres constantes).
	</body>
</html>
ERROR;
}
?>
