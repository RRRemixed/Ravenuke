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
if ($ya_config['expiring'] != 0) {
	$past = time() - $ya_config['expiring'];
	$res = $db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users_temp WHERE time < \'' . $past . '\'');
	while (list($uid) = $db->sql_fetchrow($res)) {
		$uid = intval($uid);
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp WHERE user_id = \'' . $uid . '\'');
		$db->sql_query('DELETE FROM ' . $user_prefix . '_users_temp_field_values WHERE uid = \'' . $uid . '\'');
	}
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp_field_values');
	$db->sql_query('OPTIMIZE TABLE ' . $user_prefix . '_users_temp');
}
$username = isset($username) ? addslashes(trim(check_html($username, 'nohtml'))) : '';
$check_num = isset($check_num) ? addslashes(trim(check_html($check_num, 'nohtml'))) : '';
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_temp WHERE username=\'' . $username . '\' AND check_num=\'' . $check_num . '\'');
if ($db->sql_numrows($result) == 1) {
	$row = $db->sql_fetchrow($result);
	$ya_username = $row['username'];
	$ya_realname = $row['name'];
	$ya_useremail = $row['user_email'];
	$ya_uid = $row['user_id'];
	$ya_time = $row['time'];
	$lv = time();
	include_once 'header.php';
	title(_PERSONALINFO);
	OpenTable();
	echo '<form name="Register" action="modules.php?name=' . $module_name . '" method="post">';
	echo '<table class="forumline" cellpadding="3" cellspacing="3" border="0" width="100%">';
	echo '<tr><td align="center" colspan="2"><b>' . _FORACTIVATION . '</b>:</td></tr>';
	echo '<tr><td>' . _USRNICKNAME . ':</td><td>' . $ya_username . '</td></tr>';
	if ($ya_config['userealname'] >= '1') {
		echo '<tr><td>' . _UREALNAME . ':';
		if ($ya_config['userealname'] == '3') echo '<br />' . _REQUIRED;
		echo '</td><td>';
		echo '<input type="text" name="realname" value="' . $ya_realname . '" size="50" maxlength="60" /></td></tr>';
	}
	echo '<tr><td>' . _UREALEMAIL . ':</td>';
	echo '<td>' . $ya_useremail . '</td></tr>';
	if ($ya_config['usefakeemail'] >= '1') {
		echo '<tr><td>' . _UFAKEMAIL . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="femail" value="" size="50" maxlength="255" /><br />' . _EMAILPUBLIC . '</td></tr>';
	}
	if ($ya_config['usewebsite'] >= '1') {
		echo '<tr><td>' . _YOURHOMEPAGE . ':<br />';
		if ($ya_config['usewebsite'] == '3') echo _REQUIRED;
		else echo _OPTIONAL;
		echo '</td><td>';
		echo '<input type="text" name="user_website" value="" size="50" maxlength="255" /></td></tr>';
	}
	$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need <> "0" ORDER BY pos');
	while ($sqlvalue = $db->sql_fetchrow($result)) {
		$t = (int)$sqlvalue['fid'];
		list($value) = $db->sql_fetchrow($db->sql_query('SELECT value FROM ' . $user_prefix . '_users_temp_field_values WHERE fid =\'' . $t . '\' AND uid = \'' . $ya_uid . '\''));
		$value2 = explode('::', $sqlvalue['value']);
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		echo '<tr><td>' . $name_exit . '<br />';
		if (($sqlvalue['need']) == 3) echo _REQUIRED;
		else echo _OPTIONAL;
		echo '</td><td>';
		if (count($value2) == 1) {
			$size = 60;
			if ($sqlvalue['size'] < 57) $size = $sqlvalue['size']+3;
			echo '<input type="text" name="nfield[' . $t . ']" value="' . htmlspecialchars($value) . '" id="nfield' . $t . '" size="' . $size . '" maxlength="' . $sqlvalue['size'] . '" />';
		} else {
			echo '<select name="nfield[' . $t . ']">';
			$j = count($value2);
			for ($i = 0;$i < $j;++$i) {
				if (trim($value) == trim($value2[$i])) $sel = ' selected="selected"';
				else $sel = '';
				echo '<option value="' . trim($value2[$i]) . '"' . $sel . '>' . $value2[$i] . '</option>';
			}
			echo '</select>';
		}
		echo '</td></tr>';
	}
	if ($ya_config['usefb'] >= '1') {
		echo '<tr><td>' . _YFB . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_fb" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['usetw'] >= '1') {
		echo '<tr><td>' . _YTW . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_tw" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useskype'] >= '1') {
		echo '<tr><td>' . _YSKYPE . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_skype" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['usesteam'] >= '1') {
		echo '<tr><td>' . _YSTEAM . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_steam" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['uselocation'] >= '1') {
		echo '<tr><td>' . _YLOCATION . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_from" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useoccupation'] >= '1') {
		echo '<tr><td>' . _YOCCUPATION . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_occ" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['useinterests'] >= '1') {
		echo '<tr><td>' . _YINTERESTS . ':<br />' . _OPTIONAL . '</td>';
		echo '<td><input type="text" name="user_interests" value="" size="30" maxlength="100" /></td></tr>';
	}
	if ($ya_config['usenewsletter'] >= '1') {
		echo '<tr><td>' . _RECEIVENEWSLETTER . ':</td><td><select name="newsletter">';
		echo '<option value="1">' . _YES . '</option><option value="0" selected="selected">' . _NO . '</option></select></td></tr>';
	}
	if ($ya_config['useviewemail'] >= '1') {
		echo '<tr><td>' . _ALLOWUSERS . ':</td><td><select name="user_viewemail">';
		echo '<option value="1">' . _YES . '</option><option value="0" selected="selected">' . _NO . '</option></select></td></tr>';
	}
	if ($ya_config['usehideonline'] >= '1') {
		echo '<tr><td>' . _HIDEONLINE . ':</td><td><select name="user_allow_viewonline">';
		echo '<option value="0" selected="selected">' . _YES . '</option><option value="1">' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td>' . _REPLYNOTIFY . ':</td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _REPLYNOTIFYMSG . '</td></tr>';
	echo '<tr><td>' . _PMNOTIFY . ':</td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_notify_pm'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_notify_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _POPPM . ':</td><td>';
	if ($userinfo['user_popup_pm'] == 1) {
		$ck1 = ' selected="selected"';
		$ck2 = '';
	} else {
		$ck1 = '';
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_popup_pm"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select><br />' . _POPPMMSG . '</td></tr>';
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td>' . _ATTACHSIG . ':</td><td>';
		$ck1 = $ck2 = '';
		if ($userinfo['user_attachsig'] == 1) {
			$ck1 = ' selected="selected"';
		} else {
			$ck2 = ' selected="selected"';
		}
		echo '<select name="user_attachsig"><option value="1"' . $ck1 . '>' . _YES . '</option>';
		echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	}
	echo '<tr><td>' . _ALLOWBBCODE . '</td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowbbcode'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowbbcode"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _ALLOWHTMLCODE . '</td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowhtml'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowhtml"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _ALLOWSMILIES . '</td><td>';
	$ck1 = $ck2 = '';
	if ($userinfo['user_allowsmile'] == 1) {
		$ck1 = ' selected="selected"';
	} else {
		$ck2 = ' selected="selected"';
	}
	echo '<select name="user_allowsmile"><option value="1"' . $ck1 . '>' . _YES . '</option>';
	echo '<option value="0"' . $ck2 . '>' . _NO . '</option></select></td></tr>';
	echo '<tr><td>' . _FORUMSTIME . '</td><td><select name="user_timezone">';
	$utz = date('Z');
	$utz = round($utz/3600);
	for ($i = -12;$i < 13;$i++) {
		if ($i == 0) {
			$dummy = 'GMT';
		} else {
			if (!ereg('-', $i)) {
				$i = '+' . $i;
			}
			$dummy = 'GMT ' . $i . ' ' . _HOURS;
		}
		if ($utz == $i) {
			echo '<option value="' . $i . '" selected="selected">' . $dummy . '</option>';
		} else {
			echo '<option value="' . $i . '">' . $dummy . '</option>';
		}
	}
	echo '</select></td></tr>';
	echo '<tr><td>' . _FORUMSDATE . ':<br />' . _FORUMSDATEMSG . '</td><td>';
	echo '<input type="text" name="user_dateformat" value="l d F Y H:i" size="15" maxlength="14" /></td></tr>';
	// montego - $userinfo array cannot possibly be valued at this point, so removed references to these below
	if ($ya_config['usesignature'] >= '1') {
		echo '<tr><td>' . _SIGNATURE . ':<br />' . _OPTIONAL . '<br />' . _NOHTML . '</td>';
		echo '<td><textarea cols="50" rows="5" name="user_sig"></textarea><br />' . _255CHARMAX . '</td></tr>';
	}
	if ($ya_config['useextrainfo'] >= '1') {
		echo '<tr><td>' . _EXTRAINFO . ':<br />' . _OPTIONAL . '<br />' . _NOHTML . '</td>';
		echo '<td><textarea cols="50" rows="5" name="bio"></textarea><br />' . _CANKNOWABOUT . '</td></tr>';
	}
	echo '<tr><td colspan="2" align="center"><input type="submit" value="' . _SAVECHANGES . '" /></td></tr>';
	echo '</table>';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" />';
	echo '<input type="hidden" name="check_num" value="' . $check_num . '" />';
	echo '<input type="hidden" name="ya_time" value="' . $ya_time . '" />';
	echo '<input type="hidden" name="op" value="saveactivate" />';
	echo '</form>';
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
