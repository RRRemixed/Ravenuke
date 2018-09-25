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
	echo 'you fluffed';
	//  header('Location: ../../../index.php');
	die();
}
// set some constants up front to stop notice errors
if (!defined('username')) define('username', 'username');
if (!defined('user_password')) define('user_password', 'user_password');
if (!defined('theme')) define('theme', 'theme');
// set some vars up front to stop notice errors
if (!isset($themelist)) $themelist = '';
getusrinfo($user);
if ((is_user($user)) AND (strtolower($userinfo['username']) == strtolower($cookie[1])) AND ($userinfo['user_password'] == $cookie[2])) {
	include_once 'header.php';
	title(_THEMESELECTION);
	OpenTable();
	nav();
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<div align="center">';
	echo '<form action="modules.php?name=' . $module_name . '" method="post">';
	echo '<p><strong>' . _SELECTTHEME . '</strong></p>';
	echo '<select name="theme">';
	$themelist = '';
	$handle = opendir('themes');
	while (($file = readdir($handle)) !== false) {
		if ((!ereg('[.]', $file) AND file_exists('themes/' . $file . '/theme.php'))) {
			$themelist .= $file . ' ';
		}
	}
	closedir($handle);
	$themelist = explode(' ', $themelist);
	sort($themelist);
	natcasesort($themelist);
	reset($themelist);
	while ( list($id, $themename) = each($themelist) ) {
		if (((empty($userinfo['theme'])) && ($themename == $Default_Theme)) || ($userinfo['theme'] == $themename)) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}
		if ($themename != '') {
			echo '<option value="' . $themename . '"' . $sel . '>' . $themename . '</option>';
		}
	}
	if (empty($userinfo['theme'])) $userinfo['theme'] = $Default_Theme;
	echo '</select><p>';
	echo _THEMETEXT1 . '<br />';
	echo _THEMETEXT2 . '<br />';
	echo _THEMETEXT3 . '</p>';
	echo '<input type="hidden" name="user_id" value="' . $userinfo['user_id'] . '" />';
	echo '<input type="hidden" name="op" value="savetheme" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" />';
	echo '</form></div>';
	CloseTable();
	include_once 'footer.php';
} else {
	mmain($user);
}
?>