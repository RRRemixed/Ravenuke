<?php
/**************************************************************************/
/* RN Your Account: Advanced User Management for RavenNuke
/* =======================================================================*/
/*
/* Copyright (c) 2008-2009, RavenPHPScripts.com	http://www.ravenphpscripts.com
/*
/* This program is free software. You can redistribute it and/or modify it
/* under the terms of the GNU General Public License as published by the
/* Free Software Foundation, version 2 of the license.
/*
/**************************************************************************/
/* RN Your Account is the based on:
/*  CNB Your Account http://www.phpnuke.org.br
/*  NSN Your Account by Bob Marion, http://www.nukescripts.net
/**************************************************************************/
if (!defined('RNYA')) {
	header('Location: ../../../index.php');
	die();
}
$ya_username = isset($ya_username) ? addslashes(trim(check_html($ya_username, 'nohtml'))) : '';
$check_num = isset($check_num) ? addslashes(trim(check_html($check_num, 'nohtml'))) : '';
$ya_time = isset($ya_time) ? intval($ya_time) : '';
if ($forceLowerCaseUserName) $ya_username = strtolower($ya_username); //Added by Raven 7/3/2005  Modified for RN v2.10.00
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp WHERE username=\'' . $ya_username . '\' AND check_num=\'' . $check_num . '\' AND time=\'' . $ya_time . '\'');
if ($db->sql_numrows($result) == 1) {
	$row = $db->sql_fetchrow($result);
	$username = $row['username'];
	$realname = $row['name'];
	$user_email = $row['user_email'];
	$user_regdate = $row['user_regdate'];
	$user_password = $row['user_password'];
	if (isset($realname) && empty($realname)) {
		$realname = $username;
	}
	// montego - modified to remove ya_fixtext and use RN's check_html() function instead
	//$user_sig = str_replace('<br />', "\r\n", $user_sig);
	// Start - Added to allow bbcode encoding to remain upon saving user  - RN v2.40.00
	$resultbc = $db->sql_query('SELECT * FROM ' . $prefix . '_bbconfig WHERE config_name = "allow_html" OR config_name = "allow_html_tags" OR config_name = "allow_bbcode" OR config_name = "allow_smilies" OR config_name = "smilies_path" OR config_name = "rand_seed"');
	while ($rowbc = $db->sql_fetchrow($resultbc)) {
		$board_config[$rowbc['config_name']] = $rowbc['config_value'];
	}
	define('IN_PHPBB', TRUE);
	include_once('./modules/' . $module_name . '/includes/phpbb_bbstuff.php');
	include_once('./modules/Forums/includes/bbcode.php');
	include_once('./modules/Forums/includes/functions_post.php');
	$user_sig_bbcode_uid = make_bbcode_uid();
	$user_sig = prepare_message($user_sig, $board_config['allow_html'], $board_config['allow_bbcode'], $board_config['allow_smilies'], $user_sig_bbcode_uid);
	// End
	$user_sig = addslashes(check_html($user_sig, ''));
	$user_email = addslashes(check_html($user_email, 'nohtml'));
	$femail = addslashes(check_html($femail, 'nohtml'));
	// montego - following $user_website code from original secured RN
	$user_website = check_html($user_website, 'nohtml');
	if (!preg_match('#^http[s]?:\/\/#i', $user_website)) {
		$user_website = 'http://' . $user_website;
	}
	if (!preg_match('#^http[s]?\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $user_website)) {
		$user_website = '';
	}
	$user_website = addslashes($user_website);
	//$bio = str_replace('<br />', "\r\n", $bio);
	$bio = addslashes(check_html($bio, 'nohtml'));
	$user_fb = addslashes(check_html($user_fb, 'nohtml'));
	$user_tw = addslashes(check_html($user_tw, 'nohtml'));
	$user_skype = addslashes(check_html($user_skype, 'nohtml'));
	$user_steam = addslashes(check_html($user_steam, 'nohtml'));
	$user_occ = addslashes(check_html($user_occ, 'nohtml'));
	$user_from = addslashes(check_html($user_from, 'nohtml'));
	$user_interests = addslashes(check_html($user_interests, 'nohtml'));
	$user_dateformat = addslashes(check_html($user_dateformat, 'nohtml'));
	$newsletter = intval($newsletter);
	$user_viewemail = intval($user_viewemail);
	$user_allow_viewonline = intval($user_allow_viewonline);
	$user_timezone = intval($user_timezone);
	$lv = time();
	$sql = 'INSERT INTO ' . $user_prefix . '_users '
		. '(user_id, user_avatar, user_avatar_type, user_lang, user_lastvisit, lastsitevisit, umode, '
		. 'username, name, user_email, femail, user_website, user_fb, user_tw, user_skype, user_steam, '
		. 'user_from, user_occ, user_interests, newsletter, user_viewemail, '
		. 'user_allow_viewonline, user_timezone, user_dateformat, user_sig, user_sig_bbcode_uid, bio, user_password, '
		. 'user_regdate, agreedtos) VALUES (NULL, \'gallery/blank.gif\', \'3\', \'' . $language . '\', \'' . $lv . '\', \'' . $lv . '\', \'nested\', '
		. '\'' . $username . '\', \'' . $realname . '\', \'' . $user_email . '\', \'' . $femail . '\', \''
		. $user_website . '\', \'' . $user_fb . '\', \'' . $user_tw . '\', \'' . $user_skype . '\', \'' . $user_steam . '\', \''
		. $user_from . '\', \'' . $user_occ . '\', \'' . $user_interests . '\', \'' . $newsletter . '\', \''
		. $user_viewemail . '\', \'' . $user_allow_viewonline . '\', \'' . $user_timezone . '\', \'' . $user_dateformat . '\', \''
		. $user_sig . '\', \'' . $user_sig_bbcode_uid . '\', \'' . $bio . '\', \'' . $user_password . '\', \'' . $user_regdate . '\', \'1\')';
	$db->sql_query($sql);
	$new_uid = $db->sql_nextid();
	if ($new_uid !== false && $new_uid != 0) {;
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE username=\'' . $username . '\'');
		$res = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $row['user_id'] . '\'');
		while ($sqlvalue = $db->sql_fetchrow($res)) {
			$db->sql_query('INSERT INTO ' . $user_prefix . '_users_field_values (uid, fid, value) VALUES (\'' . $new_uid . '\', \'' . $sqlvalue['fid'] . '\', \'' . $sqlvalue['value'] . '\')');
		}
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid=\'' . $row['user_id'] . '\'');
		$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp_field_values');
		$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp');
	}
	include_once 'header.php';
	title(_ACTIVATIONYES);
	OpenTable();
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE username=\'' . $username . '\' AND user_password=\'' . $user_password . '\'');
	if ($db->sql_numrows($result) == 1) {
		$userinfo = $db->sql_fetchrow($result);
		yacookie($userinfo['user_id'], $userinfo['username'], $userinfo['user_password'], $userinfo['storynum'], $userinfo['umode'], $userinfo['uorder'], $userinfo['thold'], $userinfo['noscore'], $userinfo['ublockon'], $userinfo['theme'], $userinfo['commentmax']);
		// CurtisH (clh@curtishancock.com <clh@curtishancock.com>)
		//echo "<META HTTP-EQUIV=\"refresh\" content=\"2;URL=$nukeurl\">";
		//echo "<center><b>$row[username]:</b> "._ACTMSG2."</center>";
		// montego - remove the META refresh as it is not compliant.  I see little value in refreshing
		// especially when there is a link to the user's home page.
		//echo '<META HTTP-EQUIV="refresh" content="modules.php?name=Your_Account">';
		echo '<center><b>' . $row['username'] . ':</b> ' . _ACTMSG . '</center>';
	} else {
		echo '<center>' . _SOMETHINGWRONG . '</center><br />';
	}
	CloseTable();
	include_once 'footer.php';
	die();
} else {
	include_once 'header.php';
	title(_ACTIVATIONERROR);
	OpenTable();
	echo '<center>' . _ACTERROR . '</center>';
	CloseTable();
	include_once 'footer.php';
	die();
}
?>
