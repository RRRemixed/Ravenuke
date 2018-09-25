<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2004 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
global $prefix, $db, $admin_file;
$aid = substr($aid, 0, 25);
$row = $db->sql_fetchrow($db->sql_query('SELECT radminsuper FROM ' . $prefix . '_authors WHERE aid=\'' . $aid . '\''));
if ($row['radminsuper'] == 1) {
	switch ($op) {
		case 'ipban':
			main_ban($ip);
			break;
		case 'save_banned':
			csrf_check();
			save_banned($ip1, $ip2, $ip3, $ip4, $reason);
			break;
		case 'ipban_delete':
			csrf_check();
			if (!isset($ok)) $ok = 0;
			ipban_delete($id, $ok);
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/*********************************************************/
/* IP Ban Functions                                      */
/*********************************************************/
function main_ban($ip = 0) {
	global $prefix, $db, $bgcolor2, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<center><span class="title"><b>' . _IPBANSYSTEM . '</b></span></center>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<center><b>' . _BANNEWIP . '</b><br /><br />';
	echo '<form action="' . $admin_file . '.php" method="post">';
	if ($ip != 0) {
		$ip = explode('.', $ip);
		echo '<input type="text" name="ip1" size="4" maxlength="3" value="' . $ip[0] . '" /> . '
			. '<input type="text" name="ip2" size="4" maxlength="3" value="' . $ip[1] . '" /> . '
			. '<input type="text" name="ip3" size="4" maxlength="3" value="' . $ip[2] . '" /> . '
			. '<input type="text" name="ip4" size="4" maxlength="3" value="' . $ip[3] . '" />';
	} else {
		echo '<input type="text" name="ip1" size="4" maxlength="3" /> . '
			. '<input type="text" name="ip2" size="4" maxlength="3" /> . '
			. '<input type="text" name="ip3" size="4" maxlength="3" /> . '
			. '<input type="text" name="ip4" size="4" maxlength="3" />';
	}
	echo '<br /><br /><b>' . _REASON . '</b><br /><input type="text" name="reason" size="50" maxlength="255" />'
		. '<br /><br /><input type="hidden" name="op" value="save_banned" /><input type="submit" value="Ban this IP" />';
	echo '</form></center>';
	CloseTable();
	$numrows = $db->sql_numrows($db->sql_query('SELECT * from ' . $prefix . '_banned_ip'));
	if ($numrows != 0) {
		echo '<br />';
		OpenTable();
		echo '<center><span class="title"><b>' . _IPBANNED . '</b></span><br /><br /></center>'
			. '<table border="0" align="center">'
			. '<tr><td bgcolor="' . $bgcolor2 . '" align="left">&nbsp;<b>' . _IPBANNED . '</b>&nbsp;</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="left">&nbsp;<b>' . _REASON . '</b>&nbsp;</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center">&nbsp;<b>' . _BANDATE . '</b>&nbsp;</td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center">&nbsp;<b>' . _FUNCTIONS . '</b>&nbsp;</td></tr>';
		$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banned_ip ORDER BY date DESC');
		while ($row = $db->sql_fetchrow($result)) {
			echo '<tr><td bgcolor="' . $bgcolor2 . '" align="left">&nbsp;' . $row['ip_address'] . '</td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="left">&nbsp;' . $row['reason'] . '&nbsp;</td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center">&nbsp;' . $row['date'] . '&nbsp;</td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><a class="rn_csrf" href="' . $admin_file
				. '.php?op=ipban_delete&amp;id=' . intval($row['id']) . '&amp;ok=0">' . _UNBAN . '</a></td></tr>';
		}
		echo '</table>';
		CloseTable();
	}
	include_once('footer.php');
}

function save_banned($ip1, $ip2, $ip3, $ip4, $reason) {
	global $prefix, $db;
	$reason = check_html($reason, 'nohtml');
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<center><span class="title"><b>' . _IPBANSYSTEM . '</b></span></center>';
	CloseTable();
	echo '<br />';
	OpenTable();
	if (substr($ip2, 0, 2) == 00) {
		$ip2 = ereg_replace('00', '', $ip2);
	}
	if (substr($ip3, 0, 2) == 00) {
		$ip3 = ereg_replace('00', '', $ip3);
	}
	if (substr($ip4, 0, 2) == 00) {
		$ip4 = ereg_replace('00', '', $ip4);
	}
	$ip = $ip1 . '.' . $ip2 . '.' . $ip3 . '.' . $ip4;
	if (empty($ip1) OR empty($ip2) OR empty($ip3) OR empty($ip4)) {
		echo '<center><b>' . _ERROR . '</b> ' . _IPOUTRANGE . '<br /><br />' . _IPENTERED . ' <b>' . $ip . '</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	if (!is_numeric($ip1) && !empty($ip1) OR !is_numeric($ip2) && !empty($ip2) OR !is_numeric($ip3) && !empty($ip3) OR !is_numeric($ip4) && !empty($ip4) && $ip4 != '*') {
		echo '<center><b>' . _ERROR . '</b> ' . _IPNUMERIC . '<br /><br />' . _IPENTERED . ' <b>' . $ip . '</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	if ($ip1 > 255 OR $ip2 > 255 OR $ip3 > 255 OR $ip4 > 255 && $ip4 != '*') {
		echo '<center><b>' . _ERROR . '</b> ' . _IPOUTRANGE . '<br /><br />' . _IPENTERED . ' <b>' . $ip . '</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	if (substr($ip1, 0, 1) == 0) {
		echo '<center><b>' . _ERROR . '</b> ' . _IPSTARTZERO . '<br /><br />' . _IPENTERED . ' <b>' . $ip . '</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	if ($ip == '127.0.0.1') {
		echo '<center><b>' . _ERROR . '</b> ' . _IPLOCALHOST . '<br /><br />' . _IPENTERED . ' <b>127.0.0.1</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	$my_ip = $_SERVER['REMOTE_ADDR'];
	if ($ip == $my_ip) {
		echo '<center><b>' . _ERROR . '</b> ' . _IPYOURS . '<br /><br />' . _IPENTERED . ' <b>' . $ip . '</b><br /><br />' . _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
		die();
	}
	$date = date('Y-m-d');
	$db->sql_query('INSERT INTO ' . $prefix . '_banned_ip VALUES (NULL, \'' . $ip . '\', \'' . $reason . '\', \'' . $date . '\')');
	echo '<center>' . _SUCCESS . '<br /><br />' . _THEIP . ' <b>' . $ip . '</b> ' . _HASBEENBANNED . '</center>';
	CloseTable();
	include_once('footer.php');
}

function ipban_delete($id, $ok) {
	global $prefix, $db, $admin_file;
	$id = intval($id);
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banned_ip WHERE id=\'' . $id . '\''));
	if ($ok == 0) {
		include_once('header.php');
		GraphicAdmin();
		OpenTable();
		echo '<center><span class="title"><b>' . _IPBANSYSTEM . '</b></span></center>';
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<center>' . _SURETOBANIP . ' <b>' . $row['ip_address'] . '</b><br /><br />[ <a class="rn_csrf" href="' . $admin_file
			. '.php?op=ipban_delete&amp;id=' . $id . '&amp;ok=1">' . _YES . '</a> | <a href="' . $admin_file
			. '.php?op=ipban">' . _NO . '</a> ]</center>';
		CloseTable();
		include_once('footer.php');
	} elseif ($ok == 1) {
		$db->sql_query('DELETE FROM ' . $prefix . '_banned_ip WHERE id=\'' . $id . '\'');
		Header('Location: ' . $admin_file . '.php?op=ipban');
	}
}
?>