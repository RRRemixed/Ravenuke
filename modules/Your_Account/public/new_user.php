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
include_once 'header.php';
$next = '';
if ($ya_config['requireadmin'] == 1) {
	title(_USERAPPLOGIN);
	$next = _WAITAPPROVAL . '<br /><br />';
} else {
	title(_USERREGLOGIN);
	if ($ya_config['useactivate'] == 1) $next = _YOUWILLRECEIVE . '<br /><br />';
}
OpenTable();
echo '<form id="newUser" class="cmxform" action="modules.php?name=' . $module_name . '" method="post">';
if (!empty($errormsg)) {
	echo '<p><b>Input Errors:</b> ' . $errormsg . '</p>';
} else {
	$ya_username = '';
	$ya_realname = '';
	$ya_user_email = '';
	$ya_user_email2 = '';
	$user_password2 = '';
	$user_password = '';
}
echo '<fieldset><legend><b>' . _REGNEWUSER . '</b></legend>';
echo '<p><b>* = ' . _REQUIRED . '</b></p>';
echo '<p><label for="ya_username">' . _NICKNAME . ': *</label>';
echo '<input type="text" id="ya_username" name="ya_username" size="15" maxlength="' . $ya_config['nick_max'] . '" value="' . $ya_username . '" />';
echo '<font class="tiny"><span id="userAvailability"></span></font>';
echo '<br /><label for="ya_nicklength">&nbsp;</label><input id="ya_nicklength" name="ya_nicklength" type="hidden" />';
echo '<font class="tiny">(' . _YA_NICKLENGTH . ')</font>';
echo '</p>';
if ($ya_config['userealname'] > 1) {
	echo '<p><label for="ya_realname">' . _UREALNAME . ':';
	if ($ya_config['userealname'] == 3) {
		echo ' *';
	}
	echo '</label><input type="text" id="ya_realname" name="ya_realname" size="40" maxlength="60"  value="' . $ya_realname . '" /></p>';
}
echo '<p><label for="ya_user_email">' . _EMAIL . ': *</label><input type="text" id="ya_user_email" name="ya_user_email" size="40" maxlength="255" value="' . $ya_user_email . '" />
	 <span id="emailAvailability" class="error"></span></p>';
if ($ya_config['doublecheckemail'] == 1) {
	echo '<p><label for="ya_user_email2">' . _RETYPEEMAIL . ': *</label><input type="text" id="ya_user_email2" name="ya_user_email2" size="40" maxlength="255" value="' . $ya_user_email2 . '" /></p>';
} else {
	echo '<input type="hidden" name="ya_user_email2" value="ya_user_email" />';
}
echo $ya_CustomFields['HTML'];
$pass_size = intval($ya_config['pass_max']) +3;
echo '<p><label for="user_password">' . _PASSWORD . ':</label><input id="user_password" name="user_password" type="password" size="' . $pass_size . '" maxlength="' . $ya_config['pass_max'] . '" value="' . $user_password . '" /></p>';
//echo '<label for="ya_passlength">&nbsp;</label><input id="ya_passlength" name="ya_passlength" type="hidden" />';
echo '<script type="text/javascript">
	jQuery(\'#user_password\').pstrength({minChar: '.$ya_config['pass_min'].', minCharText: \''._YA_PASSLENGTH.' ('._BLANKFORAUTO.')\',
	verdicts: [\'Weak\', \'Not Bad\', \'OK\', \'Strong\', \'Very Strong\']
	});
	</script>';
//echo '</p>';
echo '<p><label for="user_password2">' . _RETYPEPASSWORD . ':</label><input id="user_password2" name="user_password2" type="password" size="' . $pass_size . '" maxlength="' . $ya_config['pass_max'] . '" value="' . $user_password2 . '" /></p>';
if ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
	if ($ya_config['usefakeemail'] >= '1') echo '<p><label for="femail">' . _UFAKEMAIL . ':</label><input type="text" name="femail" size="40" maxlength="255" /><br />' . _EMAILPUBLIC . '</p>';
	if ($ya_config['usewebsite'] >= '1') echo '<p><label for="user_website">' . _YOURHOMEPAGE . ':</label><input type="text" name="user_website" size="40" maxlength="255" /></p>';
	if ($ya_config['usefb'] >= '1') echo '<p><label for="user_fb">' . _YFB . ':</label><input type="text" name="user_fb" size="30" maxlength="255" /></p>';
	if ($ya_config['usetw'] >= '1') echo '<p><label for="user_tw">' . _YTW . ':</label><input type="text" name="user_tw" size="30" maxlength="255" /></p>';
	if ($ya_config['useskype'] >= '1') echo '<p><label for="user_skype">' . _YSKYPE . ':</label><input type="text" name="user_skype" size="30" maxlength="255" /></p>';
	if ($ya_config['usesteam'] >= '1') echo '<p><label for="user_steam">' . _YSTEAM . ':</label><input type="text" name="user_steam" size="30" maxlength="255" /></p>';
	if ($ya_config['uselocation'] >= '1') echo '<p><label for="user_from">' . _YLOCATION . ':</label><input type="text" name="user_from" size="30" maxlength="100" /></p>';
	if ($ya_config['useoccupation'] >= '1') echo '<p><label for="user_occ">' . _YOCCUPATION . ':</label><input type="text" name="user_occ" size="30" maxlength="100" /></p>';
	if ($ya_config['useinterests'] >= '1') echo '<p><label for="user_interests">' . _YINTERESTS . ':</label><input type="text" name="user_interests" size="30" maxlength="100" /></p>';
	if ($ya_config['usenewsletter'] >= '1') echo '<p><label for="newsletter">' . _RECEIVENEWSLETTER . ': *</label><select name="newsletter"><option value="1" selected="selected">' . _YES . '</option><option value="0">' . _NO . '</option></select></p>';
	if ($ya_config['useviewemail'] >= '1') echo '<p><label for="user_viewemail">' . _ALWAYSSHOWEMAIL . ': *</label><select name="user_viewemail"><option value="1" selected="selected">' . _YES . '</option><option value="0">' . _NO . '</option></select></p>';
	if ($ya_config['usehideonline'] >= '1') echo '<p><label for="user_allow_viewonline">' . _HIDEONLINE . ': *</label><select name="user_allow_viewonline"><option value="0" selected="selected">' . _YES . '</option><option value="1">' . _NO . '</option></select></p>';
	echo '<p><label for="ya_realname">' . _FORUMSTIME . ' *</label><select name="user_timezone">';
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
	echo '</select></p>';
	echo '<p><label for="ya_realname">' . _FORUMSDATE . ': *<br />' . _FORUMSDATEMSG . '</label><input type="text" name="user_dateformat" value="Y-m-d, H:i:s" size="15" maxlength="14" /></p>';
	if ($ya_config['usesignature'] >= '1') echo '<p><label for="ya_realname">' . _SIGNATURE . ':<br />' . _NOHTML . '</label><textarea cols="50" rows="5" name="user_sig"></textarea><br />' . _255CHARMAX . '</p>';
	if ($ya_config['useextrainfo'] >= '1') echo '<p><label for="ya_realname">' . _EXTRAINFO . ':<br />' . _NOHTML . '</label><textarea cols="50" rows="5" name="bio"></textarea><br />' . _CANKNOWABOUT . '</p>';
}
echo '<input type="hidden" name="op" value="new_confirm" />';
echo '<p align="center"><input type="submit" value="' . _YA_CONTINUE . '" /></p>';
echo '</fieldset></form>';
echo '<br />';
echo $next;
echo '<p>' . _COOKIEWARNING . '</p>';
if ($ya_config['useasreguser'] == '1') {
	echo _ASREGUSER . '<br />';
	echo '<ul>';
	echo '<li>' . _ASREG1 . '</li>';
	echo '<li>' . _ASREG2 . '</li>';
	echo '<li>' . _ASREG3 . '</li>';
	echo '<li>' . _ASREG4 . '</li>';
	echo '<li>' . _ASREG5 . '</li>';
	$handle = opendir('themes');
	$thmcount = 0;
	while ($file = readdir($handle)) {
		if ((!ereg('[.]', $file) AND file_exists('themes/' . $file . '/theme.php'))) {
			$thmcount++;
		}
	}
	closedir($handle);
	if ($thmcount > 1) {
		echo '<li>' . _ASREG6 . '</li>';
	}
	$sql = 'SELECT custom_title FROM ' . $prefix . '_modules WHERE active=\'1\' AND view=\'1\' AND inmenu=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$custom_title = $row['custom_title'];
		if ($custom_title != '') {
			echo '<li>' . _ACCESSTO . ' ' . $custom_title . '</li>';
		}
	}
	$sql = 'SELECT title FROM ' . $prefix . '_blocks WHERE active=\'1\' AND view=\'1\'';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		$b_title = $row['title'];
		if ($b_title != '') {
			echo '<li>' . _ACCESSTO . ' ' . $b_title . '</li>';
		}
	}
	if (is_active('Journal')) {
		echo '<li>' . _CREATEJOURNAL . '</li>';
	}
	if ($my_headlines == 1) {
		echo '<li>' . _READHEADLINES . '</li>';
	}
	echo '<li>' . _ASREG7 . '</li>';
	echo '</ul>';
}
echo _REGISTERNOW . '<br />';
echo _WEDONTGIVE . '<br /><br />';
echo '<center><font class="content">[ <a href="modules.php?name=' . $module_name . '" >' . _USERLOGIN . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=pass_lost" >' . _PASSWORDLOST . '</a> ]</font></center>';
CloseTable();
include_once 'footer.php';
?>
