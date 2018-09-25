<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Additional Security and Code Cleanup for Patched 3.1                 */
/* Commited by the Nuke Patched Development Team 2005                   */
/* chatserv, Evaders99, Quake                                           */
/* http://www.nukeresources.com - Download location                     */
/* http://www.nukefixes.com - Development location                      */
/* http://sourceforge.net/projects/nukepatched/ - CVS                   */
/* Last file update: 30/07/05                                           */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
// End the transaction
if(!defined('END_TRANSACTION')) {
	define('END_TRANSACTION', 2);
}

// Get PHP Version
$phpver = phpversion();

// convert superglobals - Modified by Raven 5/12/2006 - from http://www.php.net/manual/en/language.variables.predefined.php
if (!isset($_SERVER))
{
	$_GET = &$HTTP_GET_VARS;
	$_POST = &$HTTP_POST_VARS;
	$_ENV = &$HTTP_ENV_VARS;
	$_SERVER = &$HTTP_SERVER_VARS;
	$_COOKIE = &$HTTP_COOKIE_VARS;
	$_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
}
$PHP_SELF = $_SERVER['PHP_SELF'];

// After doing those superglobals we can now use one
// and check if this file isnt being accessed directly
if (stristr(htmlentities($_SERVER['PHP_SELF']), 'mainfile.php')) {
	header('Location: index.php');
	exit();
}

if (!function_exists('floatval')) {
	function floatval($inputval) {
		return (float)$inputval;
	}
}

if ($phpver >= '4.0.4pl1' && isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'],'compatible')) {
	if (extension_loaded('zlib')) {
		@ob_end_clean();
		ob_start('ob_gzhandler');
	}
} elseif ($phpver > '4.0' && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
	if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
		if (extension_loaded('zlib')) {
			$do_gzip_compress = true;
			ob_start(array('gzhandler'));
			ob_implicit_flush(0);
			if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {
				header('Content-Encoding: gzip');
			}
		}
	}
}

if (!ini_get('register_globals')) {
	@import_request_variables('GPC', '');
}

// This block of code makes sure $admin and $user are COOKIES
if((isset($admin) && $admin != $_COOKIE['admin']) OR (isset($user) && $user != $_COOKIE['user'])) {
	die('Illegal Operation');
}

// We want to use the function stripos,
// but thats only available since PHP5.
// So we cloned the function...
if(!function_exists('stripos')) {
	function stripos_clone($haystack, $needle, $offset=0) {
		$return = strpos(strtoupper($haystack), strtoupper($needle), $offset);
		if ($return === false) {
			return false;
		} else {
			return true;
		}
	}
} else {
	// But when this is PHP5, we use the original function
	function stripos_clone($haystack, $needle, $offset=0) {
		$return = stripos($haystack, $needle, $offset);
		if ($return === false) {
			return false;
		} else {
			return true;
		}
	}
}

/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
define('GDSUPPORT', extension_loaded('gd'));
if(function_exists('imagecreatetruecolor') && function_exists('imageftbbox')) {
	define('VISUAL_CAPTCHA',true);
}

/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/

if(isset($admin) && $admin == $_COOKIE['admin'])
{
	$admin = base64_decode($admin);
	$admin = addslashes($admin);
	$admin = base64_encode($admin);
}

if(isset($user) && $user == $_COOKIE['user'])
{
	$user = base64_decode($user);
	$user = addslashes($user);
	$user = base64_encode($user);
}

// Die message for not allowed HTML tags
define('_HTMLTAGSNOTALLOWED','The html tags you attempted to use are not allowed.');
define('_MAINFILEGOBACK','Go Back');
$htmltags  = '<center><img src="images/logo.gif" alt="" /><br /><br /><b>';
$htmltags .= _HTMLTAGSNOTALLOWED.'</b><br /><br />';
$htmltags .= '[ <a href="javascript:history.go(-1)"><b>'._MAINFILEGOBACK.'</b></a> ]';

if(defined('FORUM_ADMIN')) define('INCLUDE_PATH', '../../../');
elseif(defined('INSIDE_MOD')) define('INCLUDE_PATH', '../../');
else define('INCLUDE_PATH', './');

require_once INCLUDE_PATH . 'config.php';

// Added by Raven for my RavenNuke(tm) installation
// Error reporting, to be set in rnconfig.php
// Modified by Raven 11/22/2005
// Default is error_reporting(E_ALL^E_NOTICE);
error_reporting($error_reporting);
if($display_errors) {
	@ini_set('display_errors', 1);
} else {
	@ini_set('display_errors', 0);
}

// Fail if $admin_file is not set or does not exist
define('_ADMINSET','You must set a value for admin_file in config.php');
define('_ADMINNOTEXISTS','The admin_file you defined in config.php does not exist');
if (!defined('FORUM_ADMIN')) {
	if(empty($admin_file)) {
		die (_ADMINSET);
	} elseif (!empty($admin_file) && !file_exists($admin_file.'.php')) {
		die (_ADMINNOTEXISTS);
	}
}
require_once INCLUDE_PATH . 'db/db.php';

$result = $db->sql_query("SELECT * FROM `".$prefix."_config` LIMIT 0,1");
$nuke_config = $db->sql_fetchrow($result);

require_once INCLUDE_PATH . 'includes/ipban.php';
if (file_exists(INCLUDE_PATH . 'includes/custom_files/custom_mainfile.php')) {
	include_once INCLUDE_PATH . 'includes/custom_files/custom_mainfile.php';
}

/**
 * TegoNuke Mailer added by montego for 2.20.00
 */
$tnml_asCfg = array();
$result = $db->sql_query('SELECT * FROM ' . $prefix . '_mail_config');
$row = $db->sql_fetchrow($result);
$tnml_asCfg['nm_is_active'] = intval($row['active']);
if ($tnml_asCfg['nm_is_active'] == 1) {
	define('TNML_IS_ACTIVE', true);
	include_once INCLUDE_PATH . 'includes/tegonuke/mailer/mailer.php';
}
/*
 * NOTE: NukeSentinel and NSN Groups MUST come after as both use the PHP mail() function for their operations
 *
 * end of TegoNuke Mailer add
 */
require_once INCLUDE_PATH . 'includes/nukesentinel.php';
// For RNYA to check for suspended users, TOS, etc.
require_once INCLUDE_PATH . 'modules/Your_Account/includes/mainfileend.php';

// GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
//Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
if ((isset($name) && isset($file)) && ($name == 'Forums' && $file == 'modcp')) {
} else {
	if (isset($tnsl_bUseShortLinks) && $tnsl_bUseShortLinks && file_exists(INCLUDE_PATH . 'includes/tegonuke/shortlinks/shortlinks.php')) {
		define('TNSL_USE_SHORTLINKS', TRUE);
		include_once INCLUDE_PATH . 'includes/tegonuke/shortlinks/shortlinks.php';
	}
}

/*
 * The following two lines of code were moved and commented out in RN 2.30.00 to "test the waters" on
 * finding out what old modules/blocks/hacks/etc. are still using this SQL layer that is so
 * old it should be obsoleted.  If you really need these back, uncomment them back.  We will keep this
 * code this way for one more major release as well as keep the includes/sql_layer.php script.
 */
//@require_once(INCLUDE_PATH.'includes/sql_layer.php');
//$dbi = sql_connect($dbhost, $dbuname, $dbpass, $dbname);

define('NUKE_FILE', true);
//$result = $db->sql_query('SELECT * FROM '.$prefix.'_config');
//$row = $db->sql_fetchrow($result);
$sitename = $nuke_config['sitename'];
$nukeurl = $nuke_config['nukeurl'];
$site_logo = $nuke_config['site_logo'];
$slogan = $nuke_config['slogan'];
$startdate = $nuke_config['startdate'];
$adminmail = stripslashes($nuke_config['adminmail']);
$anonpost = $nuke_config['anonpost'];
$Default_Theme = $nuke_config['Default_Theme'];
$foot1 = $nuke_config['foot1'];
$foot2 = $nuke_config['foot2'];
$foot3 = $nuke_config['foot3'];
$commentlimit = intval($nuke_config['commentlimit']);
$anonymous = $nuke_config['anonymous'];
$minpass = intval($nuke_config['minpass']);
$pollcomm = intval($nuke_config['pollcomm']);
$articlecomm = intval($nuke_config['articlecomm']);
$broadcast_msg = intval($nuke_config['broadcast_msg']);
$my_headlines = intval($nuke_config['my_headlines']);
$top = intval($nuke_config['top']);
$storyhome = intval($nuke_config['storyhome']);
$user_news = intval($nuke_config['user_news']);
$oldnum = intval($nuke_config['oldnum']);
$banners = intval($nuke_config['banners']);
$backend_title = $nuke_config['backend_title'];
$backend_language = $nuke_config['backend_language'];
$language = $nuke_config['language'];
$locale = $nuke_config['locale'];
$multilingual = intval($nuke_config['multilingual']);
$useflags = intval($nuke_config['useflags']);
$notify = intval($nuke_config['notify']);
$notify_email = $nuke_config['notify_email'];
$notify_subject = $nuke_config['notify_subject'];
$notify_message = $nuke_config['notify_message'];
$notify_from = $nuke_config['notify_from'];
$moderate = intval($nuke_config['moderate']);
$admingraphic = intval($nuke_config['admingraphic']);
$CensorMode = intval($nuke_config['CensorMode']);
$CensorReplace = $nuke_config['CensorReplace'];
$copyright = $nuke_config['copyright'];
// $Version_Num = floatval($row['Version_Num']);
$Version_Num = htmlentities(strip_tags($nuke_config['Version_Num']));
$domain = str_replace('http://', '', $nukeurl);
$mtime = microtime();
$mtime = explode(' ',$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;
$pagetitle = '';

/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/
include_once INCLUDE_PATH . 'includes/gfx_check.php';
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/

if (!defined('FORUM_ADMIN')) {
	$ThemeSel = get_theme();
	include_once 'themes/' . $ThemeSel . '/theme.php';
	if (($multilingual == 1) AND isset($newlang) AND !stristr($newlang,'.')) {
		$newlang = check_html($newlang, 'nohtml');
		if (file_exists('language/lang-' . $newlang . '.php')) {
			setcookie('lang', $newlang, time()+31536000);
			include_once 'language/lang-' . $newlang . '.php';
			$currentlang = $newlang;
		} else {
			setcookie('lang', $language, time()+31536000);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} elseif (($multilingual == 1) AND isset($lang) AND !stristr($lang, '.')) {
		$lang = check_html($lang, 'nohtml');
		if (file_exists('language/lang-' . $lang . '.php')) {
			setcookie('lang', $lang, time()+31536000);
			include_once 'language/lang-' . $lang . '.php';
			$currentlang = $lang;
		} else {
			setcookie('lang', $language, time()+31536000);
			include_once 'language/lang-' . $language . '.php';
			$currentlang = $language;
		}
	} else {
		setcookie('lang', $language, time()+31536000);
		include_once 'language/lang-' . $language . '.php';
		$currentlang = $language;
	}
}

// NSN Groups
// This must come after $currentlang is defined
require_once INCLUDE_PATH . 'modules/Groups/includes/nsngr_func.php';

/**
 * CSRF Protection for POST/GET forms and potentially "dangerous" links
 */
require_once INCLUDE_PATH . 'includes/csrf-magic.php';

// Added by Raven for my RavenNuke(tm) installation
if (isset($bypassInstallationFolderCheck) AND !$bypassInstallationFolderCheck AND file_exists('INSTALLATION/')) die(_RNINSTALLFILESFOUND);

if(!function_exists('themepreview')) {
	function themepreview($title, $hometext, $bodytext = '', $notes = '') {
		echo '<b>' . $title . '</b><br /><br />' . $hometext;
		if (!empty($bodytext)) {
			echo '<br /><br />' . $bodytext;
		}
		if (!empty($notes)) {
			echo '<br /><br /><b>' . _NOTE . '</b> <i>' . $notes . '</i>';
		}
	}
}

if(!function_exists('themecenterbox')) {
	function themecenterbox($title, $content) {
		OpenTable();
		echo '<center><font class="option"><b>' . $title . '</b></font></center><br />' . $content;
		CloseTable();
		echo '<br />';
	}
}

if (!defined('ADMIN_FILE') && !file_exists('includes/nukesentinel.php')) {
	$postString = '';
	foreach ($_POST as $postkey => $postvalue) {
		if ($postString > '') {
			$postString .= '&'.$postkey.'='.$postvalue;
		} else {
			$postString .= $postkey.'='.$postvalue;
		}
	}
	str_replace('%09', '%20', $postString);
	$postString_64 = base64_decode($postString);
	if ((!isset($admin) OR (isset($admin) AND !is_admin($admin))) AND (stristr($postString,'%20union%20') OR stristr($postString,'*/union/*') OR      stristr($postString,' union ') OR stristr($postString_64,'%20union%20') OR stristr($postString_64,'*/union/*') OR stristr($postString_64,' union ') OR stristr($postString_64,'+union+') OR stristr($postString,'http-equiv') OR stristr($postString_64,'http-equiv') OR stristr($postString,'alert(') OR stristr($postString_64,'alert(') OR stristr($postString,'javascript:') OR stristr($postString_64,'javascript:') OR stristr($postString,'document.cookie') OR stristr($postString_64,'document.cookie') OR stristr($postString,'onmouseover=') OR stristr($postString_64,'onmouseover=') OR stristr($postString,'document.location') OR stristr($postString_64,'document.location'))) {
		header('Location: index.php');
		die();
	}
}


/*****[BEGIN]******************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/

if (isset($gfx)){
	switch($gfx) {
		case 'gfx':
			include_once INCLUDE_PATH . 'includes/gfx.php';
			break;
	}
}
/*****[END]********************************************
 [ Base:    GFX Code                           v1.0.0 ]
 ******************************************************/

/**
 * The following section of code is used to create the legal docs
 * menu and set it in a constant so that the constant may be
 * used anywhere within *nuke to show the legal menu links.
 *
 * @version     1.1.0
 *
 * Examples of usage:
 *
 * echo LGL_MENU_HTML;
 * $s = LGL_MENU_HTML;
 * echo $s;
 */
$lgl_legalMenu = '';
if (is_active('Legal')) {
	include_once NUKE_CLASSES_DIR . 'class.legal_doctypes.php';
	$objDocTypes = new Legal_DocTypes('', $lgl_langS);
	$objDocTypes->setShowContact();
	$lgl_legalMenu = '<div class="lgl_menu">' . $objDocTypes->html() . '</div>';
}
if (!defined('LGL_MENU_HTML')) define('LGL_MENU_HTML', $lgl_legalMenu);

//Check programmed news
automated_news();
/***********************************************************************************
 Since PHP compiles all the functions first, placing all the functions at the end of
 the logic helps to better organize the code
 ***********************************************************************************/
/*
 * get_lang function modified by montego to actually return the language that was
 * finally found to be "used".
 */
function get_lang($module) {
	global $currentlang, $language;
	$lang = 'french';
	if ($module == 'admin') {
		if (file_exists('admin/language/lang-' . $currentlang . '.php')) {
			include_once 'admin/language/lang-' . $currentlang . '.php';
			$lang = $currentlang;
		} elseif (file_exists('admin/language/lang-' . $language . '.php')) {
			include_once 'admin/language/lang-' . $language . '.php';
			$lang = $language;
		} else {  // fall back to french
			include_once 'admin/language/lang-french.php';
		}
	} else {
		if (file_exists('modules/' . $module . '/language/lang-' . $currentlang . '.php')) {
			include_once 'modules/' . $module . '/language/lang-' . $currentlang . '.php';
			$lang = $currentlang;
		} elseif (file_exists('modules/' . $module . '/language/lang-' . $language . '.php')) {
			include_once 'modules/' . $module . '/language/lang-' . $language . '.php';
			$lang = $language;
		} elseif (file_exists('modules/' . $module . '/language/lang-french.php')) {  // fall back to french
			include_once 'modules/' . $module . '/language/lang-french.php';
		}
	}
	return $lang;
}

function is_admin($admin) {
	if (!$admin) { return 0; }
	static $adminSave;
	if (isset($adminSave)) return $adminSave;
	if (!is_array($admin)) {
		$admin = base64_decode($admin);
		$admin = addslashes($admin);
		$admin = explode(':', $admin);
	}
	$aid=$pwd='';
	if (isset($admin[0])) $aid = $admin[0];
	if (isset($admin[1])) $pwd = $admin[1];
	$aid = substr(addslashes($aid), 0, 25);
	if (!empty($aid) && !empty($pwd)) {
		global $prefix, $db;
		$sql = 'SELECT pwd FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\'';
		$result = $db->sql_query($sql);
		$pass = $db->sql_fetchrow($result);
		if ($pass[0] == $pwd && !empty($pass[0])) {
			return $adminSave = 1;
		}
	}
	return $adminSave = 0;
}

function is_user($user) {
	if (!$user) { return 0; }

	static $userSave;
	if (isset($userSave)) return $userSave;
	if (!is_array($user)) {
		$user = base64_decode($user);
		$user = addslashes($user);
		$user = explode(':', $user);
	}
	$uid = $user[0];
	$pwd = $user[2];
	$uid = intval($uid);
	if (!empty($uid) AND !empty($pwd)) {
		global $db, $user_prefix;
		$sql = 'SELECT user_password FROM ' . $user_prefix . '_users WHERE user_id=\''.$uid.'\'';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		if ($row[0] == $pwd && !empty($row[0])) {
			return $userSave = 1;
		}
	}
	return $userSave = 0;
}

function is_group($user, $name) {
	global $prefix, $db, $user_prefix, $cookie, $user;
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$uid = intval($cookie[0]);
		} else {
			$uid = intval($user[0]);
		}
		$result = $db->sql_query('SELECT points FROM ' . $user_prefix . '_users WHERE user_id=\'' . $uid . '\'');
		list($points) = $db->sql_fetchrow($result);
		$points = intval($points);
		$result2 = $db->sql_query('SELECT mod_group FROM ' . $prefix . '_modules WHERE title=\'' . $name . '\'');
		list($mod_group) = $db->sql_fetchrow($result2);
		$mod_group = intval($mod_group);
		$result3 = $db->sql_query('SELECT points FROM ' . $prefix . '_groups WHERE id=\'' . $mod_group . '\'');
		list($rpoints) = $db->sql_fetchrow($result3);
		$grp = intval($rpoints);
		if (($points >= 0 AND $points >= $grp) OR $mod_group == 0) {
			return 1;
		}
	}
	return 0;
}

function update_points($id) {
	global $user_prefix, $prefix, $db, $user;
	if (is_user($user)) {
		if(!is_array($user)) {
			$cookie = cookiedecode($user);
			$username = trim($cookie[1]);
		} else {
			$username = trim($user[1]);
		}
		if ($db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_groups')) > '0') {
			$id = intval($id);
			$result = $db->sql_query('SELECT points FROM ' . $prefix . '_groups_points WHERE id=\'' . $id . '\'');
			list($points) = $db->sql_fetchrow($result);
			$rpoints = intval($points);
			$db->sql_query('UPDATE ' . $user_prefix.'_users SET points=points+' . $rpoints . ' WHERE username=\'' . $username . '\'');
		}
	}
}

function title($text) {
	OpenTable();
	echo '<center><span class="title">' . $text . '</span></center>';
	CloseTable();
	echo '<br />';
}

function is_active($module) {
	global $prefix, $db;
	static $save;
	if (is_array($save)) {
		if (isset($save[$module])) return ($save[$module]);
		return 0;
	}
	$sql = 'SELECT title FROM '.$prefix.'_modules WHERE active=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$save[$row[0]] = 1;
	}
	if (isset($save[$module])) return ($save[$module]);
	return 0;
}

function render_blocks($side, $blockfile, $title, $content, $bid, $url) {
	if(!defined('BLOCK_FILE')) {
		define('BLOCK_FILE', true);
	}
	if (empty($url)) {
		if (empty($blockfile)) {
			// GT-NExtGEn 0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
			//Modified by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
			global $tnsl_bAutoTapBlocks;
			if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
				$content = tnsl_fShortenBlockURLs('', $content);
			}
			//End of GT-NExtGEn / ShortURLs
			if ($side == 'c') {
				themecenterbox($title, $content);
			} elseif ($side == 'd') {
				themecenterbox($title, $content);
			} else {
				themesidebox($title, $content);
			}
		} else {
			if ($side == 'c') {
				blockfileinc($title, $blockfile, 1);
			} elseif ($side == 'd') {
				blockfileinc($title, $blockfile, 1);
			} else {
				blockfileinc($title, $blockfile);
			}
		}
	} else {
		if ($side == 'c' OR $side == 'd') {
			headlines($bid,1);
		} else {
			headlines($bid);
		}
	}
}

function blocks($side) {
	global $storynum, $prefix, $multilingual, $currentlang, $db, $admin, $user;
	if ($multilingual == 1) {
		$querylang = 'AND (blanguage=\''.$currentlang.'\' OR blanguage=\'\')';
	} else {
		$querylang = '';
	}
	if (strtolower($side[0]) == 'l') {
		$pos = 'l';
	} elseif (strtolower($side[0]) == 'r') {
		$pos = 'r';
	}  elseif (strtolower($side[0]) == 'c') {
		$pos = 'c';
	} elseif  (strtolower($side[0]) == 'd') {
		$pos = 'd';
	}
	$side = $pos;
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_blocks WHERE bposition=\''.$pos.'\' AND active=1 '.$querylang.' ORDER BY weight ASC');
	while($row = $db->sql_fetchrow($result)) {
		$groups = $row['groups'];
		$bid = intval($row['bid']);
		$title = stripslashes(check_html($row['title'], 'nohtml'));
		$content = stripslashes($row['content']);
		$url = stripslashes($row['url']);
		$blockfile = $row['blockfile'];
		$view = intval($row['view']);
		$expire = intval($row['expire']);
		$action = $row['action'];
		$action = substr("$action", 0,1);
		$now = time();
		$sub = intval($row['subscription']);
		if ($sub == 0 OR ($sub == 1 AND !paid())) {
			if ($expire != 0 AND $expire <= $now) {
				if ($action == 'd') {
					$db->sql_query('UPDATE '.$prefix.'_blocks SET active=0, expire=\'0\' WHERE bid=\''.$bid.'\'');
					return;
				} elseif ($action == 'r') {
					$db->sql_query('DELETE FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\'');
					return;
				}
			}
			if ($row['bkey'] == 'admin') {
				adminblock();
			} elseif ($row['bkey'] == 'userbox') {
				userblock();
			} elseif (empty($row['bkey'])) {
				if ($view == 0) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 1 AND is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 2 AND is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view == 3 AND !is_user($user) || is_admin($admin)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				} elseif ($view > 3 AND in_groups($groups)) {
					render_blocks($side, $blockfile, $title, $content, $bid, $url);
				}
			}
		}
	}
}

function message_box() {
	global $bgcolor1, $bgcolor2, $user, $admin, $cookie, $textcolor2, $prefix, $multilingual, $currentlang, $db, $admin_file;
	if ($multilingual == 1) {
		$querylang = 'AND (mlanguage=\''.$currentlang.'\' OR mlanguage=\'\')';
	} else {
		$querylang = '';
	}
	$result = $db->sql_query('SELECT * FROM '.$prefix.'_message WHERE active=1 '.$querylang);
	if ($numrows = $db->sql_numrows($result) == 0) {
		return;
	} else {
		while ($row = $db->sql_fetchrow($result)) {
			$groups = $row['groups'];
			$mid = intval($row['mid']);
			$title = stripslashes(check_html($row['title'], 'nohtml'));
			$content = stripslashes($row['content']);
			$mdate = $row['date'];
			$expire = intval($row['expire']);
			$view = intval($row['view']);
			if (!empty($title) && !empty($content)) {
				if ($expire == 0) {
					$remain = _UNLIMITED;
				} else {
					$etime = (($mdate+$expire)-time())/3600;
					$etime = (int)$etime;
					if ($etime < 1) {
						$remain = _EXPIRELESSHOUR;
					} else {
						$remain = _EXPIREIN.' '.$etime.' '._HOURS;
					}
				}
				if ($view > 5 AND in_groups($groups)) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n";
					echo '<div class="content">'.$content.'</div>'."\n";
					if (is_admin($admin)) {
						echo '<br /><br /><center><font class="content">[ '._MVIEWGROUPS.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>'."\n";
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 5 AND paid()) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n"
					.'<div class="content">'.$content.'</div>'."\n";
					if (is_admin($admin)) {
						echo '<br /><br /><center><font class="content">[ '._MVIEWSUBUSERS.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 4 AND is_admin($admin)) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n"
					.'<div class="content">'.$content.'</div>'."\n"
					.'<br /><br /><center><font class="content">[ '._MVIEWADMIN.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>';
					CloseTable();
					echo '<br />';
				} elseif ($view == 3 AND is_user($user) || is_admin($admin)) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n"
					.'<div class="content">'.$content.'</div>'."\n";
					if (is_admin($admin)) {
						echo '<br /><br /><center><font class="content">[ '._MVIEWUSERS.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 2 AND !is_user($user) || is_admin($admin)) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n"
					.'<div class="content">'.$content.'</div>'."\n";
					if (is_admin($admin)) {
						echo '<br /><br /><center><font class="content">[ '._MVIEWANON.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>';
					}
					CloseTable();
					echo '<br />';
				} elseif ($view == 1) {
					OpenTable();
					echo '<center><font class="option" color="'.$textcolor2.'"><b>'.$title.'</b></font></center><br />'."\n"
					.'<div class="content">'.$content.'</div>'."\n";
					if (is_admin($admin)) {
						echo '<br /><br /><center><font class="content">[ '._MVIEWALL.' - '.$remain.' - <a href="'.$admin_file.'.php?op=editmsg&amp;mid='.$mid.'">'._EDIT.'</a> ]</font></center>';
					}
					CloseTable();
					echo '<br />';
				}
				if ($expire != 0) {
					$past = time()-$expire;
					if ($mdate < $past) {
						$db->sql_query('UPDATE '.$prefix.'_message SET active=0 WHERE mid=\''.$mid.'\'');
					}
				}
			}
		}
	}
}

function online() {
	global $nsnst_const, $user, $cookie, $prefix, $db;
	if(!defined('NUKESENTINEL_IS_LOADED')) {
		$ip = $_SERVER['REMOTE_ADDR'];
		if(!validIP($ip)) $ip = 'none'; //RN0000991 + tightened it up some with new validIP() function in mainfile.php
	} else {
		$ip = (!isset($nsnst_const['remote_ip'])) ? 'none' : $nsnst_const['remote_ip']; //RN0000991
	}
	$guest = 0;
	if (is_user($user)) {
		cookiedecode($user);
		$uname = $cookie[1];
		if (!isset($uname)) {
			$uname = $ip;
			$guest = 1;
		}
	} else {
		$uname = $ip;
		$guest = 1;
	}
	$uname = addslashes($uname);
	$past = time()-3600;
	$sql = 'DELETE FROM '.$prefix.'_session WHERE time < \''.$past.'\'';
	$db->sql_query($sql);
	$sql = 'SELECT time FROM '.$prefix.'_session WHERE uname=\''.$uname.'\'';
	$result = $db->sql_query($sql);
	$ctime = time();
	if (!empty($uname)) {
		$uname = substr($uname, 0,25);
		$row = $db->sql_fetchrow($result);
		if ($row) {
			$db->sql_query('UPDATE '.$prefix.'_session SET uname=\''.$uname.'\', time=\''.$ctime.'\', host_addr=\''.$ip.'\', guest=\''.$guest.'\' WHERE uname=\''.$uname.'\'');
		} else {
			$db->sql_query('INSERT INTO '.$prefix.'_session (uname, time, host_addr, guest) VALUES (\''.$uname.'\', \''.$ctime.'\', \''.$ip.'\', \''.$guest.'\')');
		}
	}
}

function blockfileinc($title, $blockfile, $side=0) {
	$blockfiletitle = $title;
	$file = file_exists('blocks/'.$blockfile);
	if (!$file) {
		$content = _BLOCKPROBLEM;
	} else {
		include_once('blocks/'.$blockfile);
	}
	if (empty($content)) {
		$content = _BLOCKPROBLEM2;
	} else { //Added by montego from http://montegoscripts.com for TegoNuke(tm) ShortLinks
		global $tnsl_bAutoTapBlocks;
		if (defined('TNSL_USE_SHORTLINKS') && isset($tnsl_bAutoTapBlocks) && $tnsl_bAutoTapBlocks) {
			$content = tnsl_fShortenBlockURLs($blockfile, $content);
		}
	}
	//End of TegoNuke(tm) ShortLinks

	if ($side == 1) {
		themecenterbox($blockfiletitle, $content);
	} elseif ($side == 2) {
		themecenterbox($blockfiletitle, $content);
	} else {
		themesidebox($blockfiletitle, $content);
	}
}

/*
 * The following lines of code were moved and commented out in RN 2.40.00 .  This is/was an unussed funtion.
 * RN has a block file that does the same thing.  This function should not be here becuase it is loaded on every page even if it isn't needed.
 * If you really need this function back, uncomment it.  We will keep this
 * code this way for one more major release.
 */
/*
 function selectlanguage() {
 global $useflags, $currentlang;
 if ($useflags == 1) {
 $title = _SELECTLANGUAGE;
 $content = '<center><font class="content">'._SELECTGUILANG.'<br /><br />';
 $langdir = dir('language');
 while($func=$langdir->read()) {
 if(substr($func, 0, 5) == 'lang-') {
 $menulist .= "$func ";
 }
 }
 closedir($langdir->handle);
 $menulist = explode(' ', $menulist);
 sort($menulist);
 for ($i=0; $i < sizeof($menulist); $i++) {
 if($menulist[$i]!='') {
 $tl = str_replace('lang-','',$menulist[$i]);
 $tl = str_replace('.php','',$tl);
 $altlang = ucfirst($tl);
 $content .= '<a href="index.php?newlang='.$tl.'"><img src="images/language/flag-'.$tl.'.png" border="0" alt="'.$altlang.'" title="'.$altlang.'" hspace="3" vspace="3" /></a> ';
 }
 }
 $content .= '</font></center>';
 themesidebox($title, $content);
 } else {
 $title = _SELECTLANGUAGE;
 $content = '<center><font class="content">'._SELECTGUILANG.'<br /><br /></font>';
 $content .= '<form action="index.php" method="get"><select name="newlanguage" onchange="top.location.href=this.options[this.selectedIndex].value">';
 $handle=opendir('language');
 while ($file = readdir($handle)) {
 if (preg_match('/^lang\-(.+)\.php/', $file, $matches)) {
 $langFound = $matches[1];
 $languageslist .= "$langFound ";
 }
 }
 closedir($handle);
 $languageslist = explode(' ', $languageslist);
 sort($languageslist);
 for ($i=0; $i < sizeof($languageslist); $i++) {
 if($languageslist[$i]!='') {
 $content .= '<option value="index.php?newlang='.$languageslist[$i].'" ';
 if($languageslist[$i]==$currentlang) {
 $content .= ' selected="selected"';
 }
 $content .= '>'.ucfirst($languageslist[$i]).'</option>';
 }
 }
 $content .= '</select></form></center>'."\n";
 themesidebox($title, $content);
 }
 }*/

function cookiedecode($user) {
	global $cookie, $db, $user_prefix;
	static $pass;
	if(!is_array($user)) {
		$user = base64_decode($user);
		$user = addslashes($user);
		$cookie = explode(':', $user);
	} else {
		$cookie = $user;
	}
	if (!isset($pass) AND isset($cookie[1])) {
		$sql = 'SELECT user_password FROM '.$user_prefix.'_users WHERE username=\''.$cookie[1].'\'';
		$result = $db->sql_query($sql);
		list($pass) = $db->sql_fetchrow($result);
	}
	if (isset($cookie[2]) AND ($cookie[2] == $pass) AND (!empty($pass))) { return $cookie; }
}

function getusrinfo($user) {
	global $user_prefix, $db, $userinfo, $cookie;
	if (!$user OR empty($user)) {
		return NULL;
	}
	cookiedecode($user);
	$user = $cookie;
	if (isset($userrow) AND is_array($userrow)) {
		if ($userrow['username'] == $user[1] && $userrow['user_password'] == $user[2]) {
			return $userrow;
		}
	}
	$sql = 'SELECT * FROM '.$user_prefix.'_users WHERE username=\''.$user[1].'\' AND user_password=\''.$user[2].'\'';
	$result = $db->sql_query($sql);
	if ($db->sql_numrows($result) == 1) {
		static $userrow;
		$userrow = $db->sql_fetchrow($result);
		return $userinfo = $userrow;
	}
	unset($userinfo);
}

// Speed up this function with stripos_clone and str_replace
function FixQuotes ($what = '') {
	$what = str_replace("'","''",$what);
	while (stripos_clone($what, "\\\\'")) {
		$what = str_replace("\\\\'","'",$what);
	}
	return $what;
}

/*********************************************************/
/* text filter                                           */
/*********************************************************/

function check_words($Message) {
	global $CensorMode, $CensorReplace, $EditedMessage, $CensorList;
	include_once(INCLUDE_PATH.'config.php');
	$EditedMessage = $Message;
	if ($CensorMode != 0) {
		if (is_array($CensorList)) {
			$Replace = $CensorReplace;
			if ($CensorMode == 1) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("$CensorList[$i]([^a-zA-Z0-9])","$Replace\\1",$EditedMessage);
				}
			} elseif ($CensorMode == 2) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("(^|[^[:alnum:]])$CensorList[$i]","\\1$Replace",$EditedMessage);
				}
			} elseif ($CensorMode == 3) {
				for ($i = 0; $i < count($CensorList); $i++) {
					$EditedMessage = eregi_replace("$CensorList[$i]","$Replace",$EditedMessage);
				}
			}
		}
	}
	return $EditedMessage;
}

function delQuotes($string) {
	/* no recursive function to add quote to an HTML tag if needed */
	/* and delete duplicate spaces between attribs. */
	$tmp='';    // string buffer
	$result=''; // result string
	$i=0;
	$attrib=-1; // Are us in an HTML attrib ?   -1: no attrib   0: name of the attrib   1: value of the atrib
	$quote=0;   // Is a string quote delimited opened ? 0=no, 1=yes
	$len = strlen($string);
	while ($i<$len) {
		switch($string[$i]) { // What car is it in the buffer ?
			case '"':          // a quote.
				if ($quote==0) {
					$quote=1;
				} else {
					$quote=0;
					if (($attrib>0) && ($tmp != '')) { $result .= "=\"$tmp\""; }
					$tmp='';
					$attrib=-1;
				}
				break;
			case '=':           // an equal - attrib delimiter
				if ($quote==0) {  // Is it found in a string ?
					$attrib=1;
					if ($tmp!='') $result.=" $tmp";
					$tmp='';
				} else $tmp .= '=';
				break;
			case ' ':           // a blank ?
				if ($attrib>0) {  # add it to the string, if one opened.
					$tmp .= $string[$i];
				}
				break;
			default:            // Other
				if ($attrib<0)    // If we weren't in an attrib, set attrib to 0
				$attrib=0;
				$tmp .= $string[$i];
				break;
		}
		$i++;
	}
	if (($quote!=0) && ($tmp != '')) {
		if ($attrib==1) { $result .= '='; }  // If it is the value of an atrib, add the '='
		$result .= "\"$tmp\"";  // Add quote if needed (the reason of the function ;-)
	}
	return $result;
}

###############################################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske            http://nukeseo.com
# kses developed by Ulf Harnhammar                      http://kses.sf.net
# kses enhancement ideas contributed by sixonetonoffun  http://netflake.com
# FCKeditor by Frederico Caldeira Knabben               http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen          http://phpnuker.de
#
###############################################################################
/**
 * montego - extended capability to skip the final html check.
 * This is used to allow for content that is posted by an admin to pass through unabated.
 * However, in order to help ensure XHTML compliance, the kses_no_null, kses_js_entities and
 * kses_normalize_entities functions are very useful.
 */
function check_html ($string, $allowed_html = '', $allowed_protocols = array('http', 'https', 'ftp', 'news', 'nntp', 'gopher', 'mailto'))
{
	$stop = FALSE;
	if(!function_exists('kses_no_null')) {
		@include_once(INCLUDE_PATH.'includes/kses/kses.php');
	}
	if (get_magic_quotes_gpc() == 1) {
		$string = stripslashes($string);
	}
	$string = kses_no_null($string);
	$string = kses_js_entities($string);
	$string = kses_normalize_entities($string);
	$string = kses_hook($string);
	if (stripos_clone($allowed_html, 'nocheck') === true) {
		return $string;
	} else {
		if (stripos_clone($allowed_html, 'nohtml') === false) {
			global $AllowableHTML;
			$allowed_html = $AllowableHTML;
		} else {
			$allowed_html = array('<null>');
		}
		$allowed_html_fixed = kses_array_lc($allowed_html);
		return kses_split($string, $allowed_html_fixed, $allowed_protocols);
	}
}

function wysiwyg_textarea($name, $value, $config = 'NukeUser', $cols = 50, $rows = 10)
{
	global $advanced_editor, $admin;
	// Don't waste bandwidth by loading WYSIWYG editor for crawlers
	if ($advanced_editor == 0 or !isset($_COOKIE))
	{
		echo '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$value.'</textarea>';
	} else {
		@include_once(INCLUDE_PATH.'includes/fckeditor/fckeditor.php');
		$rows = $rows + 2;  // Add extra space for toolbars
		$oFCKeditor = new FCKeditor($name) ;
		$oFCKeditor->BasePath = './includes/fckeditor/' ; // 2.6
		$oFCKheight = $rows * 20;
		$oFCKeditor->Height = $oFCKheight;
		$oFCKeditor->ToolbarSet = $config;
		if (is_admin($admin))
		{
			$oFCKeditor->Config['LinkBrowser'] = true;
			$oFCKeditor->Config['ImageBrowser'] = true;
			$oFCKeditor->Config['FlashBrowser'] = true;
			$oFCKeditor->Config['LinkUpload'] = true;
			$oFCKeditor->Config['ImageUpload'] = true;
			$oFCKeditor->Config['FlashUpload'] = true;
		}
		$oFCKeditor->Value = $value;
		$oFCKeditor->Create();
	}
}

function wysiwyg_textarea_html($name, $value, $config = 'NukeUser', $cols = 50, $rows = 10)
{
	global $advanced_editor, $admin;
	// Don't waste bandwidth by loading WYSIWYG editor for crawlers
	if ($advanced_editor == 0 or !isset($_COOKIE))
	{
		echo '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$value.'</textarea>';
	} else {
		@include_once(INCLUDE_PATH.'includes/fckeditor/fckeditor.php');
		$rows = $rows + 2;  // Add extra space for toolbars
		$oFCKeditor = new FCKeditor($name);
		$oFCKeditor->BasePath = './includes/fckeditor/';
		$oFCKheight = $rows * 20;
		$oFCKeditor->Height = $oFCKheight;
		$oFCKeditor->ToolbarSet = $config;
		if (is_admin($admin))
		{
			$oFCKeditor->Config['LinkBrowser'] = true;
			$oFCKeditor->Config['ImageBrowser'] = true;
			$oFCKeditor->Config['FlashBrowser'] = true;
			$oFCKeditor->Config['LinkUpload'] = true;
			$oFCKeditor->Config['ImageUpload'] = true;
			$oFCKeditor->Config['FlashUpload'] = true;
		}
		$oFCKeditor->Value = $value;
		$wysiwygHTML = $oFCKeditor->CreateHtml() ;
		return $wysiwygHTML;
	}
}

function filter_text($Message, $strip='') {
	global $EditedMessage;
	check_words($Message);
	$EditedMessage=check_html($EditedMessage, $strip);
	return $EditedMessage;
}

function filter($what, $strip="", $save="", $type="") {
	if ($strip == "nohtml") {
		$what = check_html($what, $strip);
		$what = htmlentities(trim($what), ENT_QUOTES);
		// If the variable $what doesn't comes from a preview screen should be converted
		if ($type != "preview" AND $save != 1) {
			$what = html_entity_decode($what, ENT_QUOTES);
		}
	}
	if ($save == 1) {
		$what = check_words($what);
		$what = check_html($what, $strip);
		$what = addslashes($what);
	} else {
		$what = stripslashes(FixQuotes($what));
		$what = check_words($what);
		$what = check_html($what, $strip);
	}
	return($what);
}

/*********************************************************/
/* formatting stories                                    */
/*********************************************************/

// Beta 3 code by Quake 08/19/2005
// Written for Nuke-Evolution and Nuke Patched
function formatTimestamp($time) {
	global $datetime, $locale;

	static $localeSet;     // setlocale() can be expensive to call; only need to call it once
	if (!isset($localeSet)) {
		setlocale(LC_TIME, $locale);
		$localeSet = 1;
	}

	if (!is_numeric($time)) {
		preg_match('/([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})/', $time, $datetime);
		$time = gmmktime($datetime[4],$datetime[5],$datetime[6],$datetime[2],$datetime[3],$datetime[1]);
	}
	$time -= date('Z');
	$datetime = strftime(_DATESTRING, $time);
	$datetime = ucfirst($datetime);
	return $datetime;
}

function get_author($aid) {
	global $prefix, $db;
	static $users;
	if (isset($users[$aid]) AND is_array($users[$aid])) {
		$row = $users[$aid];
	} else {
		$sql = 'SELECT url, email FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\'';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$users[$aid] = $row;
	}
	$aidurl = stripslashes($row['url']);
	$aidmail = encode_mail(stripslashes($row['email']));
	if (!empty($aidurl) && isset($aidurl) && $aidurl != 'http://') {
		$aid = '<a href="'.$aidurl.'">'.$aid.'</a>';
	} elseif (!empty($aidmail) && isset($aidmail)) {
		$aid = '<a href="mailto:'.$aidmail.'">'.$aid.'</a>';
	} else {
		$aid = $aid;
	}
	return $aid;
}

function formatAidHeader($aid) {
	$AidHeader = get_author($aid);
	echo $AidHeader;
}

function adminblock() {
	global $admin, $prefix, $db, $admin_file, $user_prefix;
	if (is_admin($admin)) {
		$sql = 'SELECT title, content FROM '.$prefix.'_blocks WHERE bkey=\'admin\'';
		$result = $db->sql_query($sql);
		while (list($title, $content) = $db->sql_fetchrow($result)) {
			$content = preg_replace('/\badmin.php/', $admin_file.'.php', $content); //RN6444
			$content = '<span class="content">'.$content.'</span>';
			themesidebox($title, $content);
		}
		$title = _WAITINGCONT;
		$content = '<span class="content">';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_queue'));
		if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=submissions">'._SUBMISSIONS.'</a>: '.$num.'<br />';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_reviews_add'));
		if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=reviews">'._WREVIEWS.'</a>: '.$num.'<br />';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_newlink'));
		if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=Links">'._WLINKS.'</a>: '.$num.'<br />';
		$modreql = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_modrequest WHERE brokenlink=0'));
		if ($modreql > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=LinksListModRequests">'._MODREQLINKS.'</a>: '.$modreql.'<br />';
		$brokenl = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_links_modrequest WHERE brokenlink=1'));
		if ($brokenl > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=LinksListBrokenLinks">'._BROKENLINKS.'</a>: '.$brokenl.'<br />';
		$num = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_newdownload'));
		if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=downloads">'._UDOWNLOADS.'</a>: '.$num.'<br />';
		$modreqd = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE brokendownload=0'));
		if ($modreqd > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=DownloadsListModRequests">'._MODREQDOWN.'</a>: '.$modreqd.'<br />';
		$brokend = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_downloads_modrequest WHERE brokendownload=1'));
		if ($brokend > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=DownloadsListBrokenDownloads">'._BROKENDOWN.'</a>: '.$brokend.'<br />';
		$result = $db->sql_query('SELECT COUNT(*) FROM '.$prefix.'_gcal_event WHERE approved = 0');
		$row = $db->sql_fetchrow($result);
		$num = $row[0];
		if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=gcalendar">'._GCALENDAR_EVENTS.'</a>: '.$row[0].'<br />';
		// RNYA - http://www.ravennuke/admin.php?op=yaUsers
		if (file_exists('modules/Your_Account/credits.html'))
		{
		$ya_expire = 0;
		$past = 0;
		$configresult = $db->sql_query('SELECT `config_name` , `config_value` FROM `' . $user_prefix . '_users_config` WHERE `config_name`=\'expiring\'');
		$ya_config = $db->sql_fetchrow($configresult);
		$ya_expire = $ya_config['config_value'];
		if ($ya_expire != 0) {
			$past = time() - $ya_expire;
			$res = $db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users_temp WHERE time < \'' . $past . '\'');
			while (list($uid) = $db->sql_fetchrow($res)) {
				$uid = intval($uid);
				$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id = \'' . $uid . '\'');
				$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $uid . '\'');
			}
		}
			$result = $db->sql_query('SELECT COUNT(*) FROM '.$user_prefix.'_users_temp');
			$row = $db->sql_fetchrow($result);
			$num = $row[0];
			if ($num > 0) $content .= '<strong><big>&middot;</big></strong>&nbsp;<a href="'.$admin_file.'.php?op=yaUsers">'._USERS.'</a>: '.$row[0].'<br />';
		}
		$content .= '&nbsp;</span>';
		themesidebox($title, $content);
	}
}

function loginbox($gfx_check) {
	global $user, $sitekey, $gfx_chk;
	mt_srand ((double)microtime()*1000000);
	$maxran = 1000000;
	$random_num = mt_rand(0, $maxran);
	$datekey = date('F j');
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
	$code = substr($rcode, 2, 6);
	if (!is_user($user)) {
		$title = _LOGIN;
		$boxstuff = '<form action="modules.php?name=Your_Account" method="post">';
		$boxstuff .= '<center><font class="content">'._NICKNAME.'<br />';
		$boxstuff .= '<input type="text" name="username" size="8" maxlength="25" /><br />';
		$boxstuff .= _PASSWORD.'<br />';
		$boxstuff .= '<input type="password" name="user_password" size="8" maxlength="20" /><br />';
		/*****[BEGIN]******************************************
		 [ Base:    GFX Code                           v1.0.0 ]
		 ******************************************************/
		$boxstuff .= security_code(array(2,4,5,7), 'stacked');
		/*****[END]********************************************
		 [ Base:    GFX Code                           v1.0.0 ]
		 ******************************************************/
		$boxstuff .= '<input type="hidden" name="op" value="login" />';
		$boxstuff .= '<input type="submit" value="'._LOGIN.'" /></font></center></form>';
		$boxstuff .= '<center><font class="content">'._ASREGISTERED.'</font></center>';
		themesidebox($title, $boxstuff);
	}
}

function userblock() {
	global $user, $cookie, $db, $user_prefix, $userinfo;
	if(is_user($user)) {
		getusrinfo($user);
		if($userinfo['ublockon']) {
			$sql = 'SELECT ublock FROM '.$user_prefix.'_users WHERE user_id=\''.$cookie[0].'\'';
			$result = $db->sql_query($sql);
			list($ublock) = $db->sql_fetchrow($result);
			$title = _MENUFOR.' '.$cookie[1];
			themesidebox($title, $ublock);
		}
	}
}

function getTopics($s_sid) {
	global $prefix, $topicname, $topicimage, $topictext, $db;
	$sid = intval($s_sid);
	$result = $db->sql_query('SELECT t.topicname, t.topicimage, t.topictext FROM '.$prefix.'_stories s LEFT JOIN '.$prefix.'_topics t ON t.topicid = s.topic WHERE s.sid = \''.$sid.'\'');
	$row = $db->sql_fetchrow($result);
	$topicname = $row['topicname'];
	$topicimage = $row['topicimage'];
	$topictext = stripslashes(check_html($row['topictext'], 'nohtml'));
}

/************************************************************************
 * nukePIE
 * http://www.nukeSEO.com
 * Copyright 2007 by Kevin Guske
 ************************************************************************/
include_once(INCLUDE_PATH.'includes/nukeSEO/nukeSEOfunctions.php');

function headlines($bid, $cenbox=0) {
	global $prefix, $db;
	# Get Feed Information
	$bid = intval($bid);
	$result = $db->sql_query('SELECT title, url, refresh, max_rss_items FROM '.$prefix.'_blocks WHERE bid=\''.$bid.'\'');
	list($title, $url, $refresh, $maxrss) = $db->sql_fetchrow($result);
	$title = stripslashes(check_html($title, 'nohtml'));
	$refresh = intval($refresh);
	$maxrss = intval($maxrss);
	$content = seoReadFeed($url, $maxrss, $refresh);
	$siteurl = ereg_replace('http://','',$url);
	$siteurl = explode('/',$siteurl);
	$content .= '<br /><table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td><a href="http://'.$siteurl[0].'" title="'.$title.'" target="blank"><b>'._HREADMORE.'</b></a></td><td align="right"><a href="http://nukeseo.com" title="nukePIE (c) nukeSEO.com">&copy;</a></td></tr></table>';
	if ($cenbox == 0) {
		themesidebox($title, $content);
	} else {
		themecenterbox($title, $content);
	}
}

function seoReadFeed ($url = '', $maxrss = 20, $refresh = 3600) {
	global $useBoxoverWithnukePIE;
	if (!defined('_CHARSET')) define('_CHARSET','ISO-8859-1');
	include_once(INCLUDE_PATH.'includes/SimplePie/simplepie.inc');
	include_once(INCLUDE_PATH.'includes/SimplePie/idn/idna_convert.class.php');
	// Create a new instance of the SimplePie object
	$feed = new SimplePie();
	if ($maxrss == 0) $maxrss = 20;
	// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, etc.
	$feed->set_feed_url($url);
	$feed->set_output_encoding(_CHARSET);
	$feed->set_cache_duration($refresh);
	$feed->init();
	$feed->handle_content_type();
	$content = '<font class="content">';
	if (isset($feed->error)) {
		// If errors, display it.
		$content .= htmlspecialchars($feed->error);
	}
	else
	{
		foreach($feed->get_items(0,$maxrss) as $item) {
			$content .= '&middot;';
			// If the item has a permalink back to the original post, link the item's title to it.
			if ($item->get_permalink())
			{
				$content .= '<a href="' . $item->get_permalink() . '" title="';
				$item_desc = $item->get_description();
				if ($useBoxoverWithnukePIE)
				{
					if ($item_desc == check_html($item_desc, 'nohtml')) $item_desc = nl2br($item_desc);
					$content .= 'cssbody=[nukePIEbody] cssheader=[nukePIEhdr] header=['.encodeBoxover(check_html($item->get_title(), 'nohtml')).'] body=['.encodeBoxover(xmlentities($item_desc)).'] singleclickstop=[On] ';
				}
				else
				{
					$content .= check_html($item_desc, 'nohtml');
				}
				$content .= '">';
			}
			$content .= check_html($item->get_title(), 'nohtml');
			if ($item->get_permalink()) $content .= '</a>';
			// Check for enclosures.  If an item has any, set the first one to the $enclosure variable.
			/*        if ($enclosure = $item->get_enclosure(0)) {
			# Use the embed() method to embed the enclosure into the page inline.
			$content .= '<div align="center">';
			$content .= '<p>' . $enclosure->embed(array(
			'audio' => './for_the_demo/place_audio.png',
			'video' => './for_the_demo/place_video.png',
			'alt' => '<img src="./for_the_demo/mini_podcast.png" class="download" border="0" title="Download the Podcast (' . $enclosure->get_extension() . '; ' . $enclosure->get_size() . ' MB)" />',
			'altclass' => 'download'
			)) . '</p>';
			$content .= '<p class="footnote" align="center">(' . $enclosure->get_type() . '; ' . $enclosure->get_size() . ' MB)</p>';
			$content .= '</div>';
			}
			*/        $content .= '<br />'.chr(10);
		}
	}
	$content .= '&nbsp;</font>';
	return $content;
}

function automated_news() {
	global $prefix, $multilingual, $currentlang, $db;
	if ($multilingual == 1) {
		$querylang = 'WHERE (alanguage=\''.$currentlang.'\' OR alanguage=\'\')'; /* the OR is needed to display stories who are posted to ALL languages */
	} else {
		$querylang = '';
	}
	$today = getdate();
	$day = $today['mday'];
	if ($day < 10) {
		$day = '0'.$day;
	}
	$month = $today['mon'];
	if ($month < 10) {
		$month = '0'.$month;
	}
	$year = $today['year'];
	$hour = $today['hours'];
	$min = $today['minutes'];
	$sec = '00';
	$result = $db->sql_query('SELECT anid, time FROM '.$prefix.'_autonews '.$querylang);
	while (list($anid, $time) = $db->sql_fetchrow($result)) {
		ereg ('([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})', $time, $date);
		if (($date[1] <= $year) AND ($date[2] <= $month) AND ($date[3] <= $day)) {
			if (($date[4] < $hour) AND ($date[5] >= $min) OR ($date[4] <= $hour) AND ($date[5] <= $min)) {
				$result2 = $db->sql_query('SELECT * FROM '.$prefix.'_autonews WHERE anid=\''.$anid.'\'');
				while ($row2 = $db->sql_fetchrow($result2)) {
					$title = stripslashes(FixQuotes(check_html($row2['title'], 'nohtml')));
					$hometext = stripslashes(FixQuotes($row2['hometext']));
					$bodytext = stripslashes(FixQuotes($row2['bodytext']));
					$notes = stripslashes(FixQuotes($row2['notes']));
					$catid2 = intval($row2['catid']);
					$aid2 = $row2['aid'];
					$time2 = $row2['time'];
					$topic2 = $row2['topic'];
					$informant2 = $row2['informant'];
					$ihome2 = intval($row2['ihome']);
					$alanguage2 = $row2['alanguage'];
					$acomm2 = intval($row2['acomm']);
					$associated2 = $row2['associated'];
					$num = $db->sql_numrows($db->sql_query('SELECT sid FROM '.$prefix.'_stories WHERE title=\''.$title.'\''));
					if ($num == 0) {
						$db->sql_query('DELETE FROM '.$prefix.'_autonews WHERE anid=\''.$anid.'\'');
						$db->sql_query('INSERT INTO '.$prefix.'_stories VALUES (NULL, \''.$catid2.'\', \''.$aid2.'\', \''.$title.'\', \''.$time2.'\', \''.$hometext.'\', \''.$bodytext.'\', 0, 0, \''.$topic2.'\', \''.$informant2.'\', \''.$notes.'\', \''.$ihome2.'\', \''.$alanguage2.'\', \''.$acomm2.'\', 0, 0, 0, 0, \''.$associated2.'\')');
					}
				}
			}
		}
	}
}

function public_message() {
	global $prefix, $user_prefix, $db, $user, $admin, $p_msg, $cookie, $broadcast_msg;
	if ($broadcast_msg == 1) {
		if (is_user($user)) {
			cookiedecode($user);
			$result = $db->sql_query('SELECT broadcast FROM '.$user_prefix.'_users WHERE username=\''.$cookie[1].'\'');
			$row = $db->sql_fetchrow($result);
			$upref = intval($row['broadcast']);
			if ($upref == 1) {
				$t_off = '<br /><p align="right">[ <a href="modules.php?name=Your_Account&amp;op=edithome">';
				$t_off .= '<font size="2">'._TURNOFFMSG.'</font></a> ]</p>';
				$pm_show = 1;
			} else {
				$pm_show = 0;
			}
		} else {
			$t_off = '';
		}
		if (!is_user($user) OR (is_user($user) AND ($pm_show == 1))) {
			$c_mid = base64_decode($p_msg);
			$c_mid = addslashes($c_mid);
			$c_mid = intval($c_mid);
			$result2 = $db->sql_query('SELECT mid, content, date, who FROM '.$prefix.'_public_messages WHERE mid > '.$c_mid.' ORDER BY date ASC LIMIT 1');
			$row2 = $db->sql_fetchrow($result2);
			$mid = intval($row2['mid']);
			$content = $row2['content'];
			$tdate = $row2['date'];
			$who = $row2['who'];
			if ((!isset($c_mid)) OR ($c_mid = $mid)) {
				$public_msg = '<br /><table width="90%" border="1" cellspacing="2" cellpadding="0" bgcolor="#FFFFFF" align="center"><tr><td>';
				$public_msg .= '<table width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#FF0000"><tr><td align="left">';
				$public_msg .= '<font color="#FFFFFF" size="3"><b>'._BROADCASTFROM.' <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$who.'"><i>'.$who.'</i></a>: "'.$content.'"</b></font>';
				$public_msg .= $t_off;
				$public_msg .= '</td></tr></table>';
				$public_msg .= '</td></tr></table>';
				$ref_date = $tdate+600;
				$actual_date = time();
				if ($actual_date >= $ref_date) {
					$public_msg = '';
					$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_public_messages'));
					if ($numrows == 1) {
						$db->sql_query('DELETE FROM '.$prefix.'_public_messages');
						$mid = 0;
					} else {
						$db->sql_query('DELETE FROM '.$prefix.'_public_messages WHERE mid=\''.$mid.'\'');
					}
				}
				if ($mid == 0 OR empty($mid)) {
					setcookie('p_msg');
				} else {
					$mid = base64_encode($mid);
					$mid = addslashes($mid);
					setcookie('p_msg',$mid,time()+600);
				}
			}
		}
	} else {
		$public_msg = '';
	}
	if (empty($public_msg)) { $public_msg = ''; }
	return $public_msg;
}

function get_theme() {
	global $user, $db, $prefix, $user_prefix, $Default_Theme;
	static $theme = false;
	if ($theme) return $theme;
	$theme = (isset($_COOKIE['theme'])) ? base64_decode($_COOKIE['theme']) : false;
	if (isset($_POST['themeprev']) && $theme != $_POST['themeprev'] && file_exists('themes/'.$_POST['themeprev'].'/theme.php')) {
		$theme = $_POST['themeprev'];
		setcookie('theme',base64_encode($theme), 0);
		if (is_user($user)) {
			$user2 = explode(':', base64_decode(addslashes($user)));
			$user_id = intval($user2[0]);
			$info = base64_encode("$user2[0]:$user2[1]:$user2[2]:$user2[3]:$user2[4]:$user2[5]:$user2[6]:$user2[7]:$user2[8]:$theme:$user2[10]");
			setcookie('user', $info, time()+2592000);
			$db->sql_query('UPDATE '.$user_prefix.'_users SET theme=\''.$theme.'\' WHERE user_id=\''.$user_id.'\'');
		}
		return $theme;
	} elseif ($theme && file_exists('themes/'.$theme.'/theme.php')) {
		return $theme;
	}
	if (!is_user($user)) {
		$theme = $Default_Theme;
		return $theme;
	}
	$user = addslashes($user);
	$user2 = base64_decode($user);
	$user2 = explode(':', $user2);
	if($user2[9]) {
		if(!file_exists('themes/'.$user2[9].'/theme.php')) {
			$theme = $Default_Theme;
		} else $theme = $user2[9];
	} else $theme = $Default_Theme;
	return $theme;
}

function removecrlf($str) {
	// Function for Security Fix by Ulf Harnhammar, VSU Security 2002
	// Looks like I don't have so bad track record of security reports as Ulf believes
	// He decided to not contact me, but I'm always here, digging on the net
	return strtr($str, "\015\012", ' ');
}

function validate_mail($email) {
	if(strlen($email) < 7 || !preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
		// These next 3 lines have been commented out by Raven on 1/14/2007.
		// Reason being, this function should only validate the email and return to the calling script.
		// The calling script should handle the validation results.
		//        OpenTable();
		//        echo _ERRORINVEMAIL;
		//        CloseTable();
		return false;
	} else {
		return $email;
	}
}
#
/**
 * Validate various forms of IP address but initially
 * it will only be used to validate simple ipv4.
 * @param string $ip IP address to validate
 * @param string $type eventually will drive what IP format to validate
 * @return boolean will be "true" if a valid IP and "false" otherwise
 */
function validIP($ip, $type='') {
	if (empty($type)) {
		if (defined('REGEX_IPV4')) { // From NukeSentinel(tm)
			$regex = REGEX_IPV4;
		} else {
			$regex = "/^(1?\d{1,2}|2([0-4]\d|5[0-5]))(\.(1?\d{1,2}|2([0-4]\d|5[0-5]))){3}$/";
		}
	} else return false;
	return (preg_match($regex, $ip) == 1) ? true : false;
}

/*****[BEGIN]******************************************
 [ Base:    function validateEmailFormat ($email) ]
 ******************************************************/
// Copyright (C) 2001 Ron Harwood and L. Patrick Smallwood
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
//
// File: functions/validateemailformat.php
//
// Added by Raven 1/14/2007
//
function validateEmailFormat ($email)
{
	// This is based on page 295 of the book 'Mastering Regular Expressions' - the most
	// definitive RFC-compliant email regex.

	// Some shortcuts for avoiding backslashitis
	$esc        = '\\\\';
	$Period      = '\.';
	$space      = '\040';
	$tab         = '\t';
	$OpenBR     = '\[';
	$CloseBR     = '\]';
	$OpenParen  = '\(';
	$CloseParen  = '\)';
	$NonASCII   = '\x80-\xff';
	$ctrl        = '\000-\037';
	$CRlist     = '\n\015';  // note: this should really be only \015.

	// Items 19, 20, 21 -- see table on page 295 of 'Mastering Regular Expressions'
	$qtext = "[^$esc$NonASCII$CRlist\"]";              // for within "..."
	$dtext = "[^$esc$NonASCII$CRlist$OpenBR$CloseBR]"; // for within [...]
	$quoted_pair = " $esc [^$NonASCII] ";              // an escaped character

	// Items 22 and 23, comment.
	// Impossible to do properly with a regex, I make do by allowing at most
	// one level of nesting.
	$ctext = " [^$esc$NonASCII$CRlist()] ";

	// $Cnested matches one non-nested comment.
	// It is unrolled, with normal of $ctext, special of $quoted_pair.
	$Cnested = "";
	$Cnested .= "$OpenParen";                     // (
	$Cnested .= "$ctext*";                        //       normal*
	$Cnested .= "(?: $quoted_pair $ctext* )*";    //       (special normal*)*
	$Cnested .= "$CloseParen";                    //                         )

	// $comment allows one level of nested parentheses
	// It is unrolled, with normal of $ctext, special of ($quoted_pair|$Cnested)
	$comment = "";
	$comment .= "$OpenParen";                     //  (
	$comment .= "$ctext*";                        //     normal*
	$comment .= "(?:";                            //       (
	$comment .= "(?: $quoted_pair | $Cnested )";  //         special
	$comment .= "$ctext*";                        //         normal*
	$comment .= ")*";                             //            )*
	$comment .= "$CloseParen";                    //                )

	// $X is optional whitespace/comments
	$X = "";
	$X .= "[$space$tab]*";                  // Nab whitespace
	$X .= "(?: $comment [$space$tab]* )*";  // If comment found, allow more spaces


	// Item 10: atom
	$atom_char = "[^($space)<>\@,;:\".$esc$OpenBR$CloseBR$ctrl$NonASCII]";
	$atom = "";
	$atom .= "$atom_char+";    // some number of atom characters ...
	$atom .= "(?!$atom_char)"; // ... not followed by something that
	//     could be part of an atom

	// Item 11: doublequoted string, unrolled.
	$quoted_str = "";
	$quoted_str .= "\"";                            // "
	$quoted_str .= "$qtext *";                      //   normal
	$quoted_str .= "(?: $quoted_pair $qtext * )*";  //   ( special normal* )*
	$quoted_str .= "\"";                            //        "


	// Item 7: word is an atom or quoted string
	$word = "";
	$word .= "(?:";
	$word .= "$atom";        // Atom
	$word .= "|";            // or
	$word .= "$quoted_str";  // Quoted string
	$word .= ")";

	// Item 12: domain-ref is just an atom
	$domain_ref = $atom;

	// Item 13: domain-literal is like a quoted string, but [...] instead of "..."
	$domain_lit = "";
	$domain_lit .= "$OpenBR";                        // [
	$domain_lit .= "(?: $dtext | $quoted_pair )*";   //   stuff
	$domain_lit .= "$CloseBR";                       //         ]

	// Item 9: sub-domain is a domain-ref or a domain-literal
	$sub_domain = "";
	$sub_domain .= "(?:";
	$sub_domain .= "$domain_ref";
	$sub_domain .= "|";
	$sub_domain .= "$domain_lit";
	$sub_domain .= ")";
	$sub_domain .= "$X"; // optional trailing comments

	// Item 6: domain is a list of subdomains separated by dots
	$domain = "";
	$domain .= "$sub_domain";
	$domain .= "(?:";
	$domain .= "$Period $X $sub_domain";
	$domain .= ")*";

	// Item 8: a route. A bunch of "@ $domain" separated by commas, followed by a colon.
	$route = "";
	$route .= "\@ $X $domain";
	$route .= "(?: , $X \@ $X $domain )*"; // additional domains
	$route .= ":";
	$route .= "$X"; // optional trailing comments

	// Item 5: local-part is a bunch of $word separated by periods
	$local_part = "";
	$local_part .= "$word $X";
	$local_part .= "(?:";
	$local_part .= "$Period $X $word $X"; // additional words
	$local_part .= ")*";

	// Item 2: addr-spec is local@domain
	$addr_spec = "$local_part \@ $X $domain";

	// Item 4: route-addr is <route? addr-spec>
	$route_addr = "";
	$route_addr .= "< $X";
	$route_addr .= "(?: $route )?"; // optional route
	$route_addr .= "$addr_spec";    // address spec
	$route_addr .= ">";

	// Item 3: phrase........
	$phrase_ctrl = '\000-\010\012-\037'; // like ctrl, but without tab

	// Like atom-char, but without listing space, and uses phrase_ctrl.
	// Since the class is negated, this matches the same as atom-char plus space and tab
	$phrase_char = "[^()<>\@,;:\".$esc$OpenBR$CloseBR$NonASCII$phrase_ctrl]";

	// We've worked it so that $word, $comment, and $quoted_str to not consume trailing
	// $X because we take care of it manually.
	$phrase = "";
	$phrase .= "$word";                            // leading word
	$phrase .= "$phrase_char *";                   // "normal" atoms and/or spaces
	$phrase .= "(?:";
	$phrase .= "(?: $comment | $quoted_str )";     // "special" comment or quoted string
	$phrase .= "$phrase_char *";                   //  more "normal"
	$phrase .= ")*";

	// Item 1: mailbox is an addr_spec or a phrase/route_addr
	$mailbox = "";
	$mailbox .= "$X";                    // optional leading comment
	$mailbox .= "(?:";
	$mailbox .= "$addr_spec";            // address
	$mailbox .= "|";                     // or
	$mailbox .= "$phrase  $route_addr";  // name and address
	$mailbox .= ")";

	// test it and return results
	$isValid = preg_match("/^$mailbox$/xS",$email);

	// Added by Raven 1/14/2007
	if ($isValid) return $email;
	else return $isValid;
} // END validateEmailFormat
/*****[END]********************************************
 [ Base:    function validateEmailFormat ($email) ]
 ******************************************************/

function encode_mail($email) {
	// From RavenPHPScripts
	$strEncodedEmail = '';
	for ($i=0; $i < strlen($email); ++$i) {
		$n = rand(0,1);
		if ($n) $strEncodedEmail .= '&#x'. sprintf("%X",ord($email{$i})) . ';';
		else    $strEncodedEmail .= '&#' . ord($email{$i}) . ';';
	}
	return $strEncodedEmail;
}

function paid() {
	global $db, $user, $cookie, $adminmail, $sitename, $nukeurl, $subscription_url, $user_prefix, $prefix;
	if (is_user($user)) {
		if (!empty($subscription_url)) {
			$renew = _SUBRENEW.' '.$subscription_url;
		} else {
			$renew = '';
		}
		cookiedecode($user);
		$sql = 'SELECT * FROM '.$prefix.'_subscriptions WHERE userid=\''.$cookie[0].'\'';
		$result = $db->sql_query($sql);
		$numrows = $db->sql_numrows($result);
		$row = $db->sql_fetchrow($result);
		if ($numrows == 0) {
			return 0;
		} elseif ($numrows != 0) {
			$time = time();
			if ($row['subscription_expire'] <= $time) {
				$db->sql_query('DELETE FROM '.$prefix.'_subscriptions WHERE userid=\''.$cookie[0].'\' AND id=\''.intval($row['id']).'\'');
				$from = $sitename.' <'.$adminmail.'>';
				$subject = $sitename.': '._SUBEXPIRED;
				$body = _HELLO." $cookie[1]:\n\n"._SUBSCRIPTIONAT.' '.$sitename.' '._HASEXPIRED."\n$renew\n\n"._HOPESERVED."\n\n$sitename "._TEAM."\n$nukeurl";
				$row = $db->sql_fetchrow($db->sql_query('SELECT user_email, username FROM '.$user_prefix.'_users WHERE user_id=\''.$cookie[0].'\' AND nickname=\''.$cookie[1].'\' AND password=\''.$cookie[2].'\''));
				/*
				 * TegoNuke Mailer added by montego for 2.20.00
				 */
				$mailsuccess = false;
				if (defined('TNML_IS_ACTIVE')) {
					$to = array(array($row['user_email'], $row['username']));
					$mailsuccess = tnml_fMailer($to, $subject, $body, $adminmail, $sitename);
				} else {
					$mailsuccess = mail($row['user_email'], $subject, $body, "From: $from\r\nX-Mailer: PHP/" . phpversion());
				}
				//                mail($row['user_email'], $subject, $body, "From: $from\r\nX-Mailer: PHP/" . phpversion());
				/*
				* end of TegoNuke Mailer add
				*/
			}
			return 1;
		}
	} else {
		return 0;
	}
}

/***************************************************************
 Added for Advertizing module from v7.8
 ****************************************************************/
function makePass() {
	$cons = "bcdfghjklmnpqrstvwxyz";
	$vocs = "aeiou";
	for ($x=0; $x < 6; $x++) {
		mt_srand ((double) microtime() * 1000000);
		$con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
		$voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
	}
	mt_srand((double)microtime()*1000000);
	$num1 = mt_rand(0, 9);
	$num2 = mt_rand(0, 9);
	$makepass = $con[0] . $voc[0] .$con[2] . $num1 . $num2 . $con[3] . $voc[3] . $con[4];
	return($makepass);
}

function ads($position) {
	global $prefix, $db, $admin, $sitename, $adminmail, $nukeurl;
	$position = intval($position);
	if (paid()) {
		return;
	}
	$numrows = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_banner WHERE position='.$position.' AND active=\'1\''));
	/* Get a random banner if exist any. */
	if ($numrows > 1) {
		$numrows = $numrows-1;
		mt_srand((double)microtime()*1000000);
		$bannum = mt_rand(0, $numrows);
	} else {
		$bannum = 0;
	}
	$sql = 'SELECT bid, impmade, imageurl, clickurl, alttext FROM '.$prefix.'_banner WHERE position='.$position.' AND active=1 LIMIT '.$bannum.',1';
	$result = $db->sql_query($sql);
	list($bid, $impmade, $imageurl, $clickurl, $alttext) = $db->sql_fetchrow($result);
	$bid = intval($bid);
	$db->sql_query('UPDATE '.$prefix.'_banner SET impmade=impmade+1 WHERE bid=\''.$bid.'\'');
	if($numrows > 0) {
		$sql2 = 'SELECT cid, imptotal, impmade, clicks, date, ad_class, ad_code, ad_width, ad_height FROM '.$prefix.'_banner WHERE bid=\''.$bid.'\'';
		$result2 = $db->sql_query($sql2);
		list($cid, $imptotal, $impmade, $clicks, $date, $ad_class, $ad_code, $ad_width, $ad_height) = $db->sql_fetchrow($result2);
		/* Check if this impression is the last one and print the banner */
		if (($imptotal <= $impmade) AND ($imptotal != 0)) {
			$db->sql_query('UPDATE '.$prefix.'_banner SET active=0 WHERE bid=\''.$bid.'\'');
			$sql3 = 'SELECT name, contact, email FROM '.$prefix.'_banner_clients WHERE cid=\''.$cid.'\'';
			$result3 = $db->sql_query($sql3);
			list($c_name, $c_contact, $c_email) = $db->sql_fetchrow($result3);
			if (!empty($c_email)) {
				$from = "$sitename <$adminmail>";
				$to = "$c_contact <$c_email>";
				$message = _HELLO." $c_contact:\n\n";
				$message .= _THISISAUTOMATED."\n\n";
				$message .= _THERESULTS."\n\n";
				$message .= _TOTALIMPRESSIONS." $imptotal\n";
				$message .= _CLICKSRECEIVED." $clicks\n";
				$message .= _IMAGEURL." $imageurl\n";
				$message .= _CLICKURL." $clickurl\n";
				$message .= _ALTERNATETEXT." $alttext\n\n";
				$message .= _HOPEYOULIKED."\n\n";
				$message .= _THANKSUPPORT."\n\n";
				$message .= "- $sitename "._TEAM."\n";
				$message .= "$nukeurl";
				$subject = "$sitename: "._BANNERSFINNISHED;
				/*
				 * TegoNuke Mailer added by montego for 2.20.00
				 */
				$mailsuccess = false;
				if (defined('TNML_IS_ACTIVE')) {
					$to2 = array(array($c_email, $c_contact));
					$mailsuccess = tnml_fMailer($to2, $subject, $body, $adminmail, $sitename);
				} else {
					$mailsuccess = mail($to, $subject, $message, 'From: '."$from\r\n".'X-Mailer: PHP/'.phpversion());
				}
				//                mail($to, $subject, $message, 'From: '."$from\r\n".'X-Mailer: PHP/'.phpversion());
				/*
				* end of TegoNuke Mailer add
				*/
			}
		}
		if ($ad_class == 'code') {
			$ads = '<center>'.$ad_code.'</center>';
		} elseif ($ad_class == 'flash') {
			$ads = '<center>
					 <object type="application/x-shockwave-flash" data="'.$imageurl.'" name="'.$bid.'" width="'.$ad_width.'" height="'.$ad_height.'">
				<param name="movie" value="'.$imageurl.'" />
			 //  <img src="noflash.gif" width="200" height="100" alt="" />
				<param name="quality" value="high" />
				<param name="loop" value="true" />
				<param name="menu" value="false" />
				</object>
					 </center>';

		} else {
			$ads = '<center><a href="index.php?op=ad_click&amp;bid='.$bid.'" target="_blank"><img src="'.$imageurl.'" border="0" alt="'.$alttext.'" title="'.$alttext.'" /></a></center>';
		}
	} else {
		$ads = '';
	}
	return $ads;
}
/*
 * functions added to support dynamic and ordered loading of CSS and JS in <HEAD> and before </BODY>
 */
function addCSSToHead($content, $type='file') {
	global $headCSS;
	// Duplicate external file?
	if (($type == 'file') and (count($headCSS)>0) and (in_array(array($type, $content), $headCSS))) return;
	$headCSS[] = array($type, $content);
	return;
}
function addJSToHead($content, $type='file') {
	global $headJS;
	// Duplicate external file?
	if (($type == 'file') and (count($headJS)>0) and (in_array(array($type, $content), $headJS))) return;
	$headJS[] = array($type, $content);
	return;
}
function addJSToBody($content, $type='file') {
	global $bodyJS;
	// Duplicate external file?
	if (($type == 'file') and (count($bodyJS)>0) and (in_array(array($type, $content), $bodyJS))) return;
	$bodyJS[] = array($type, $content);
	return;
}
function writeHEAD() {
	global $headCSS, $headJS;
	if (is_array($headCSS) and count($headCSS) > 0) {
		foreach($headCSS as $css) {
			if ($css[0]=='file') echo '<link rel="StyleSheet" href="'.$css[1].'" type="text/css" />'."\n";
			else echo $css[1];
		}
	}
	if (is_array($headJS) and count($headJS) > 0) {
		foreach($headJS as $js) {
			if ($js[0]=='file') echo '<script type="text/javascript" language="JavaScript" src="'.$js[1].'"></script>'."\n";
			else echo $js[1];
		}
	}
	return;
}
function writeBODYJS() {
	global $bodyJS;
	if (is_array($bodyJS) and count($bodyJS) > 0) {
		foreach($bodyJS as $js) {
			if ($js[0]=='file') echo '<script type="text/javascript" language="JavaScript" src="'.$js[1].'"></script>'."\n";
			else echo $js[1];
		}
	}
	return;
}
function readDIRtoArray($dir, $filter) {
	$files = array();
	$handle = opendir($dir);
	while (false !== ($file = readdir($handle))) {
		if (preg_match($filter, $file)) {
			$files[] = $file;
		}
	}
	closedir($handle);
	return $files;
}
?>
