<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
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
		case 'Groups':
			Groups();
			break;
		case 'grp_add':
			csrf_check();
			grp_add($name, $description, $points);
			break;
		case 'grp_edit':
			grp_edit($id);
			break;
		case 'grp_edit_save':
			csrf_check();
			grp_edit_save($id, $name, $description, $points);
			break;
		case 'grp_del':
			csrf_check();
			if (!isset($ok)) $ok = 0;
			grp_del($id, $ok);
			break;
		case 'points_update':
			csrf_check();
			p_update($points);
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/*********************************************************/
/* Users Groups/Points Functions                         */
/*********************************************************/
function Groups() {
	global $bgcolor2, $bgcolor4, $prefix, $user_prefix, $db, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	title(_GROUPSADMIN);
	$grp_num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_groups'));
	if ($grp_num == 0) {
		OpenTable();
		echo '<center><span class="title"><b>' . _NOGROUPS . '</b></span></center>';
		CloseTable();
		echo '<br />';
	} else {
		OpenTable();
		echo '<center><span class="title"><b>' . _UGROUPS . '</b></span></center>'
			. '<br /><table border="1" width="100%"><tr>'
			. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _NAME . '</b></td>'
			. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _DESCRIPTION . '</b></td>'
			. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _POINTS . '</b></td>'
			. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _USERSCOUNT . '</b></td>'
			. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _FUNCTIONS . '</b></td></tr>';
		$result = $db->sql_query('SELECT id, name, description, points FROM ' . $prefix . '_groups ORDER BY points');
		while ($row = $db->sql_fetchrow($result)) {
			$id = intval($row['id']);
			$name = $row['name'];
			$description = $row['description'];
			$points = intval($row['points']);
			$users_num = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $user_prefix . '_users WHERE points>=\'' . $points . '\''));
			echo '<tr>'
				. '<td align="left" nowrap="nowrap">&nbsp;' . $name . '&nbsp;</td>'
				. '<td align="left">' . $description . '</td>'
				. '<td align="center">' . $points . '</td>'
				. '<td align="center">' . $users_num . '</td>'
				. '<td align="center" nowrap="nowrap">&nbsp;[ <a href="' . $admin_file . '.php?op=grp_edit&amp;id=' . $id . '">' . _EDIT . '</a> | <a class="rn_csrf" href="' . $admin_file . '.php?op=grp_del&amp;id=' . $id . '">' . _DELETE . '</a> ]&nbsp;</td></tr>';
		}
		echo '</table>';
		CloseTable();
		echo '<br />';
	}
	OpenTable();
	echo '<center><span class="option"><b>' . _ADDNEWGROUP . '</b></span></center><br /><br />'
		. '<form action="' . $admin_file . '.php" method="post">'
		. '<input type="hidden" name="op" value="grp_add" />'
		. '<input type="submit" value="' . _CREATEGROUP . '" />'
		. '<table border="0" width="100%">'
		. '<tr><td>' . _GTITLE . ':</td><td><input type="text" name="name" size="50" maxlength="255" /></td></tr>'
		. '<tr><td>' . _DESCRIPTION . ':</td><td><textarea name="description" cols="50" rows="10"></textarea></td></tr>'
		. '<tr><td>' . _POINTSNEEDED . ':</td><td><input type="text" name="points" size="10" maxlength="20" value="0" />&nbsp;<i>(' . _ONLYNUMVAL . ')</i></td></tr>'
		. '</table></form><br /><br />';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<center><span class="option">' . _POINTSSYSTEM . '</span></center><br /><br />'
		. '<form action="' . $admin_file . '.php" method="post">'
		. '<input type="hidden" name="op" value="points_update" />'
		. '<div align="right"><input type="submit" value="' . _UPDATE . '" /></div><br />'
		. '<table border="1" width="100%"><tr>'
		. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _NAME . '</b></td>'
		. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _DESCRIPTION . '</b></td>'
		. '<td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _POINTS . '</b></td>'
		. '</tr>';
	$result = $db->sql_query('SELECT id, points FROM ' . $prefix . '_groups_points ORDER BY id ASC');
	while ($row = $db->sql_fetchrow($result)) {
		$sID = str_pad($row['id'], 2, '0', STR_PAD_LEFT);
		$sPoints = constant('_POINTS' . $sID);
		$sDesc = constant('_DESC' . $sID);
		echo '<tr><td align="left" nowrap="nowrap">&nbsp;' . $sPoints . '&nbsp;</td>'
			. '<td align="left">' . $sDesc . '</td>'
			. '<td align="center" nowrap="nowrap">'
			. '<input type="text" value="' . $row['points'] . '" size="5" name="points[' . intval($row['id']) . ']" />'
			. '</td></tr>';
	}
	echo '</table><br /><div align="right"><input type="submit" value="' . _UPDATE . '" /></div>'
		. '</form>';
	CloseTable();
	include_once('footer.php');
}
function grp_add($name, $description, $points) {
	global $prefix, $db, $admin_file;
	if (!is_numeric($points) || ereg('-', $points)) {
		include_once('header.php');
		GraphicAdmin();
		title(_GROUPSADMIN);
		OpenTable();
		echo '<center><b>' . _GROUPADDERROR . '</b><br /><br />'
			. _NONUMVALUE . '<br /><br />'
			. _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
	} else {
		$db->sql_query('INSERT INTO ' . $prefix . '_groups VALUES (NULL, \'' . $name . '\', \'' . $description . '\', \'' . $points . '\')');
		Header('Location: ' . $admin_file . '.php?op=Groups');
	}
}
function grp_edit($id) {
	global $prefix, $db, $admin_file;
	include_once('header.php');
	GraphicAdmin();
	title(_GROUPSADMIN);
	$id = intval($id);
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_groups WHERE id=\'' . $id . '\''));
	$id = intval($row['id']);
	$name = $row['name'];
	$description = $row['description'];
	$points = intval($row['points']);
	OpenTable();
	echo '<center><font class="option"><b>' . _EDITGROUP . '</b></font></center><br /><br />'
		. '<form action="' . $admin_file . '.php" method="post">'
		. '<table border="0" width="100%">'
		. '<tr><td>' . _GTITLE . ':</td><td><input type="text" name="name" size="50" maxlength="255" value="' . $name . '" /></td></tr>'
		. '<tr><td>' . _DESCRIPTION . ':</td><td><textarea name="description" cols="50" rows="10">' . $description . '</textarea></td></tr>'
		. '<tr><td>' . _POINTSNEEDED . ':</td><td><input type="text" name="points" size="10" maxlength="20" value="' . $points . '" />&nbsp;<i>(' . _ONLYNUMVAL . ')</i></td></tr>'
		. '</table><br /><br />'
		. '<input type="hidden" name="id" value="' . $id . '" />'
		. '<input type="hidden" name="op" value="grp_edit_save" />'
		. '<input type="submit" value="' . _SAVEGROUP . '" /></form>';
	CloseTable();
	include_once('footer.php');
}
function grp_edit_save($id, $name, $description, $points) {
	global $prefix, $db, $admin_file;
	$id = intval($id);
	if (!is_numeric($points)) {
		include_once('header.php');
		GraphicAdmin();
		title(_GROUPSADMIN);
		OpenTable();
		echo '<center><b>' . _GROUPADDERROR . '</b><br /><br />'
			. _NONUMVALUE . '<br /><br />'
			. _GOBACK . '</center>';
		CloseTable();
		include_once('footer.php');
	} else {
		$db->sql_query('UPDATE ' . $prefix . '_groups SET name=\'' . $name . '\', description=\'' . $description . '\', points=\'' . $points . '\' WHERE id=\'' . $id . '\'');
		Header('Location: ' . $admin_file . '.php?op=Groups');
	}
}
function grp_del($id, $ok=0) {
	global $prefix, $db, $admin_file;
	$id = intval($id);
	if ($ok == 0) {
		include_once('header.php');
		GraphicAdmin();
		title(_GROUPSADMIN);
		OpenTable();
		$row = $db->sql_fetchrow($db->sql_query('SELECT name FROM ' . $prefix . '_groups WHERE id=\'' . $id . '\''));
		$name = $row['name'];
		echo '<center><b>' . _GROUPDELETE . '</b><br /><br />'
			. _SUREGRPDEL1 . ' <b>' . $name . '</b><br /><br />'
			. '[ <a class="rn_csrf" href="' . $admin_file . '.php?op=grp_del&amp;id=' . $id . '&amp;ok=1">' . _YES . '</a> | <a href="' . $admin_file . '.php?op=Groups">' . _NO . '</a> ]</center>';
		CloseTable();
		include_once('footer.php');
	} else {
		$db->sql_query('DELETE FROM ' . $prefix . '_groups WHERE id=\'' . $id . '\'');
		$db->sql_query('UPDATE ' . $prefix . '_modules SET mod_group=\'0\' WHERE mod_group=\'' . $id . '\'');
		Header('Location: ' . $admin_file . '.php?op=Groups');
	}
}
function p_update($points) {
	global $prefix, $db, $admin_file;
	$result = $db->sql_query('SELECT id, points FROM ' . $prefix . '_groups_points ORDER BY id ASC');
	while ($row = $db->sql_fetchrow($result)) {
		$id = intval($row['id']);
		if ($points[$id] != $row['points']) {
			$db->sql_query('UPDATE ' . $prefix . '_groups_points SET points=\'' . $points[$id] . '\' WHERE id=\'' . $id . '\'');
		}
	}
	Header('Location: ' . $admin_file . '.php?op=Groups');
}
?>