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
$errormsg = '';
include_once 'header.php';
$ya_username = check_html($ya_username, 'nohtml');
ya_userCheck($ya_username);
$stop = str_replace('<center>', '', $stop);
$stop = str_replace('</center>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
$user_viewemail = '0';
$ya_user_email = strtolower(check_html($ya_user_email, 'nohtml'));
if ($ya_config['userealname'] < '2') {
	$ya_realname = '';
}
if ($ya_realname == '' && $ya_config['userealname'] == 3) {
	$errormsg .= _YA_NOREALNAME . '<br />';
}
if ($ya_config['doublecheckemail'] == 0) {
	$ya_user_email2 == $ya_user_email;
} else {
	$ya_user_email2 = strtolower($ya_user_email2);
	if ($ya_user_email != $ya_user_email2) {
		$errormsg .= _EMAILDIFFERENT . '<br />';
	}
}
ya_mailCheck($ya_user_email);
$stop = str_replace('<center>', '', $stop);
$stop = str_replace('</center>', '', $stop);
$stop = str_replace('<br />', '', $stop);
$stop = str_replace('ERROR:', '', $stop);
if (!empty($stop)) {
	$errormsg .= $stop . '<br />';
}
$datekey = date('F j');
// fkelly 6/11/2008 took random num out and put check for gfx_chk being set in
// not sure where random num is supposed to be posted from and gfx check will throw an error if it is not set
$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $datekey));
// $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $_POST['random_num'] . $datekey));
$code = substr($rcode, 2, $ya_config['codesize']);
/*
 * montego - usegfxcheck is not configurable for RN and only the RN captcha security
 * code should be used.  Therefore, to avoid conflicts, following code is being commented out.
 *
if (isset($gfx_check)) {
	if (extension_loaded('gd') AND $code != $gfx_check AND ($ya_config['usegfxcheck'] == 1 OR $ya_config['usegfxcheck'] == 3)) {
		$errormsg .= _SECCODEINCOR . '<br />';
	}
}
*/
if ($user_password == '' AND $user_password2 == '') {
	$user_password = YA_MakePass();
} elseif ($user_password != $user_password2) {
	$errormsg .= _PASSDIFFERENT . '<br />';
} elseif ($user_password == $user_password2 AND (strlen($user_password) < $ya_config['pass_min'] OR strlen($user_password) > $ya_config['pass_max'])) {
	$errormsg .= _YA_PASSLENGTH . '<br />';
}
$result = $db->sql_query('SELECT * FROM ' . $user_prefix . '_users_fields WHERE need = \'3\' ORDER BY pos');
while ($sqlvalue = $db->sql_fetchrow($result)) {
	$t = $sqlvalue['fid'];
	if (trim($nfield[$t]) == '') {
		$name_exit = ya_GetCustomFieldDesc($sqlvalue['name']);
		$errormsg .= _YA_FILEDNEED1 . $name_exit . _YA_FILEDNEED2 . '<br />';
	}
}
if (empty($errormsg)) {
	if ($ya_config['requireadmin'] == 1) {
		$ncTitle = _USERAPPLOGIN;
		$ncNext = _USERAPPFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _WAITAPPROVAL;
	} elseif ($ya_config['useactivate'] == 1) {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '<strong>' . _NOTE . '</strong> ' . _YOUWILLRECEIVE;
	} else {
		$ncTitle = _USERREGLOGIN;
		$ncNext = _USERFINALSTEP;
		$ncNote = '';
	}
	title($ncTitle);
	OpenTable();
	echo '<center><strong>' . $ncNext . '</strong><br /><br />' . $ya_username . ', ' . _USERCHECKDATA . '</center><br />';
	echo '<table align="center" border="0">';
	echo '<tr><td width="50%"><strong>' . _USERNAME . ':</strong></td><td align="left">' . $ya_username . '<br /></td></tr>';
	if ($ya_config['userealname'] > 1) echo '<tr><td width="50%"><strong>' . _UREALNAME . ':</strong></td><td align="left">' . $ya_realname . '<br /></td></tr>';
	echo '<tr><td width="50%"><strong>' . _EMAIL . ':</strong></td><td align="left">' . $ya_user_email . '</td></tr>';
	echo '</table><br /><br />';
	echo '<center>' . $ncNote;
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	echo security_code(array(3, 4, 6, 7) , 'stacked');
	if (isset($nfield)) {
		if (count($nfield) > 0) {
			foreach($nfield as $key => $var) {
				echo '<input type="hidden" name="nfield[' . $key . ']" value="' . $var . '" />';
			}
		}
	}
	echo '<input type="hidden" name="random_num" value="' . $random_num . '" />';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" />';
	echo '<input type="hidden" name="ya_realname" value="' . $ya_realname . '" />';
	echo '<input type="hidden" name="ya_user_email" value="' . $ya_user_email . '" />';
	echo '<input type="hidden" name="user_password" value="' . $user_password . '" />';
	if ($ya_config['requireadmin'] == 0 AND $ya_config['useactivate'] == 0) {
		if (isset($femail)) echo '<input type="hidden" name="femail" value="' . htmlspecialchars($femail, ENT_QUOTES) . '" />';
		if (isset($user_website)) echo '<input type="hidden" name="user_website" value="' . htmlspecialchars($user_website, ENT_QUOTES) . '" />';
		if (isset($user_fb)) echo '<input type="hidden" name="user_fb" value="' . htmlspecialchars($user_fb, ENT_QUOTES) . '" />';
		if (isset($user_tw)) echo '<input type="hidden" name="user_tw" value="' . htmlspecialchars($user_tw, ENT_QUOTES) . '" />';
		if (isset($user_skype)) echo '<input type="hidden" name="user_skype" value="' . htmlspecialchars($user_skype, ENT_QUOTES) . '" />';
		if (isset($user_steam)) echo '<input type="hidden" name="user_steam" value="' . htmlspecialchars($user_steam, ENT_QUOTES) . '" />';
		if (isset($user_from)) echo '<input type="hidden" name="user_from" value="' . htmlspecialchars($user_from, ENT_QUOTES) . '" />';
		if (isset($user_occ)) echo '<input type="hidden" name="user_occ" value="' . htmlspecialchars($user_occ, ENT_QUOTES) . '" />';
		if (isset($user_interests)) echo '<input type="hidden" name="user_interests" value="' . htmlspecialchars($user_interests, ENT_QUOTES) . '" />';
		if (isset($newsletter)) echo '<input type="hidden" name="newsletter" value="' . intval($newsletter) . '" />';
		if (isset($user_viewemail)) echo '<input type="hidden" name="user_viewemail" value="' . htmlspecialchars($user_viewemail, ENT_QUOTES) . '" />';
		if (isset($user_allow_viewonline)) echo '<input type="hidden" name="user_allow_viewonline" value="' . intval($user_allow_viewonline) . '" />';
		if (isset($user_timezone)) echo '<input type="hidden" name="user_timezone" value="' . htmlspecialchars($user_timezone, ENT_QUOTES) . '" />';
		if (isset($user_dateformat)) echo '<input type="hidden" name="user_dateformat" value="' . htmlspecialchars($user_dateformat, ENT_QUOTES) . '" />';
		if (isset($user_sig)) echo '<input type="hidden" name="user_sig" value="' . htmlspecialchars($user_sig, ENT_QUOTES) . '" />';
		if (isset($bio)) echo '<input type="hidden" name="bio" value="' . htmlspecialchars($bio, ENT_QUOTES) . '" />';
	}
	echo '<input type="hidden" name="op" value="new_finish" /><br /><br />';
	echo '<input type="submit" value="' . _FINISH . '" /> &nbsp;&nbsp;' . _GOBACK . '</form></center>';
	CloseTable();
} else {

	$errormsg = htmlentities($errormsg);
	OpenTable();
	echo '<form action="modules.php?name=' . $module_name . '&amp;op=new_user" method="post">';
	echo '<center><font class="title"><strong>' . _ERRORREG . '</strong></font></center><br /><br />';
              echo '' . $errormsg . '';
	echo '<input type="hidden" name="errormsg" value="' . $errormsg . '" /><br />';
	echo '<input type="hidden" name="op" value="new_user" /><br />';
	echo '<input type="hidden" name="ya_username" value="' . $ya_username . '" /><br />';
	echo '<input type="hidden" name="ya_user_email" value="' . $ya_user_email . '" /><br />';
	echo '<input type="hidden" name="ya_user_email2" value="' . $ya_user_email2 . '" /><br />';
	echo '<input type="hidden" name="ya_realname" value="' . $ya_realname . '" /><br />';
	echo '<input type="hidden" name="user_password" value="' . $user_password . '" /><br />';
	echo '<input type="hidden" name="user_password2" value="' . $user_password2 . '" /><br />';
	echo '<center><input type="submit" name="submit" value="' . _YA_GOBACK . '" /></center>';
	echo '</form>';
	CloseTable();
}
include_once 'footer.php';
?>
