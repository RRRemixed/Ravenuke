<?php
/***********************************************************/
/* NSN Groups 									*/
/* By: NukeScripts Network (webmaster@nukescripts.net) 		*/
/* http://www.nukescripts.net							*/
/* Copyright © 2000-2005 by NukeScripts Network			*/
/***********************************************************/
/***********************************************************/
/* Additional code clean-up, performance enhancements, and W3C	*/
/* and XHTML compliance fixes by Raven and Montego.		*/
/***********************************************************/

if (!defined('ADMIN_FILE') || !defined('RN_GROUPS')) {
	die ('Access Denied');
}

!isset($gid) ? $gid = 0 :$gid = intval($gid);
!isset($min) ? $min = 0 : $min = intval($min);
!isset($max) ? $max = $min+$grconfig['perpage'] : $max = intval($max);

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSUSERSVIEW;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
echo '<center><form method="post" action="' . $admin_file . '.php?op=NSNGroupsUsersView">';
echo '<table border="0" cellpadding="2" cellspacing="2">';
echo '<tr><td align="center"><select name="gid">';
echo '<option value="0"';
if ($gid == 0) {
	echo ' selected="selected"';
}
echo '>' . _GR_ALLGROUP . '</option>';

$result = $db->sql_query('SELECT gid, gname FROM ' . $prefix . '_nsngr_groups ORDER BY gname');
while (list($thisGID, $thisGNAME) = $db->sql_fetchrow($result)) {
	echo '<option value="' . $thisGID . '"';
	if ($gid == $thisGID) {
		echo ' selected="selected"';
	}
	echo '>' . $thisGNAME . '</option>';
}

echo '</select> <input type="submit" value="' . _GR_SELECTGRP . '" /></td></tr>';
echo '</table>';
echo '</form></center>';

if ($gid > 0) {
	echo '<center><a href="' . $admin_file . '.php?op=NSNGroupsUsersAdd&amp;gid=' . $gid . '">' . _GR_ADDUSRS . '</a></center>';
}

echo '<br />';

$sql = 'SELECT g.uid, g.gid, u.user_id, u.username
	FROM ' . $prefix . '_nsngr_users g, ' . $user_prefix . '_users u';
if ($gid == 0) {
	$sql .= ' WHERE u.user_id = g.uid
		ORDER BY u.username, g.gid';
} else {
	$sql .= ' WHERE g.gid = "'.$gid.'"
			AND u.user_id = g.uid 
	ORDER BY u.username';
}
$totalselected = $db->sql_numrows($db->sql_query($sql));

grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);

echo '<center><form method="post" action="' . $admin_file . '.php?op=NSNGroupsUsersExpireSave">';

if ($gid > 0) {
	echo '<input name="gid" type="hidden" value="' . $gid . '" />';
}

echo '<table border="0" cellpadding="2" cellspacing="2" bgcolor="' . $bgcolor2 . '">';
echo '<tr>';
echo '<td align="center"><b>' . _GR_USERNAME . '</b></td>';
echo '<td align="center"><b>' . _GR_GROUP . '</b></td>';
echo '<td align="center"><b>' . _GR_START . '</b></td>';
echo '<td align="center"><b>' . _GR_EXPIRES . '</b></td>';

if ($gid > 0) {
	echo '<td align="center"><b>' . _GR_EXPUSR . '</b></td>';
}

echo '<td align="center"><b>' . _FUNCTIONS . '</b></td>';
echo '</tr>';

$sql = 'SELECT g.gid, g.uid, g.sdate, g.edate, u.username, u.user_id
	FROM ' . $prefix . '_nsngr_users g, ' . $user_prefix . '_users u';
if ($gid == 0) {
	$sql .= ' WHERE u.user_id = g.uid
		ORDER BY u.username, g.gid';
} else {
	$sql .= ' WHERE g.gid = "'.$gid.'"
		AND u.user_id = g.uid 
		ORDER BY u.username';
}
$result = $db->sql_query($sql . ' LIMIT ' . $min . ',' . $grconfig['perpage']);

if ($db->sql_numrows($result) > 0) {
	while (list($thisGroup, $thisUser, $sDate, $eDate, $thisName) = $db->sql_fetchrow($result)) {
		list($grpName, $grpMod) = $db->sql_fetchrow($db->sql_query('SELECT gname, muid FROM ' . $prefix . '_nsngr_groups WHERE gid=\'' . $thisGroup . '\''));
		$thisDate = time();
		if ($eDate == '0') {
			$eDate = '<i>' . _GR_NOLIMIT . '</i>';
		} elseif ($eDate < $thisDate) {
			$eDate = '<b>' . _GR_EXPIRED . '</b>';
		} else {
			$eDate = date('Y-m-d', $eDate);
		}
		echo '<tr bgcolor="' . $bgcolor1 . '" onmouseover="this.style.backgroundColor=\'' . $bgcolor2 . '\'" onmouseout="this.style.backgroundColor=\'' . $bgcolor1 . '\'">';
		echo '<td align="center">&nbsp;' . $thisName . '&nbsp;</td>';
		echo '<td align="center">&nbsp;' . $grpName . '&nbsp;</td>';
		echo '<td align="center">&nbsp;' . date('Y-m-d', $sDate) . '&nbsp;</td>';
		echo '<td align="center">&nbsp;' . $eDate . '&nbsp;</td>';
		if ($gid > 0) {
			echo '<td align="center">';
			if ($thisUser == $grpMod) {
				echo _GR_MODERATOR;
			} else {
				echo '<input name="exp_uid[]" type="checkbox" value="' . $thisUser . '" />';
			}
			echo '</td>';
		}
		echo '<td align="center">&nbsp;';
		if ($thisUser <> $grpMod) {
			echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersMove&amp;chng_uid=' . $thisUser . '&amp;gid=' . $thisGroup . '"><img src="images/groups/move.png" height="16" width="16" border="0" alt="' . _GR_MOVE . '" title="' . _GR_MOVE . '" /></a>';
			if ($gid == 0) {
				echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersExpire&amp;chng_uid=' . $thisUser . '&amp;gid=' . $thisGroup . '"><img src="images/groups/expire.png" height="16" width="16" border="0" alt="' . _GR_EXPIRE . '" title="' . _GR_EXPIRE . '" /></a>';
			}
			echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersUpdate&amp;chng_uid=' . $thisUser . '&amp;gid=' . $thisGroup . '"><img src="images/groups/edit.png" height="16" width="16" border="0" alt="' . _GR_UPDATE . '" title="' . _GR_UPDATE . '" /></a>';
			if ($gid == 0) {
				echo '<a href="' . $admin_file . '.php?op=NSNGroupsUsersDelete&amp;chng_uid=' . $thisUser . '&amp;gid=' . $thisGroup . '"><img src="images/groups/delete.png" height="16" width="16" border="0" alt="' . _GR_DELETE . '" title="' . _GR_DELETE . '" /></a>';
			}
		}
		echo '&nbsp;</td>';
		echo '</tr>';
	}
	if ($gid > 0) {
		echo '<tr bgcolor="' . $bgcolor2 . '"><td align="center" colspan="4">&nbsp;</td>';
		echo '<td align="center"><input type="submit" value="' . _GR_EXPUSR . '" /></td>';
		echo '<td>&nbsp;</td></tr>';
	}
} else {
	echo '<tr bgcolor="' . $bgcolor1 . '"><td align="center" ';
	if ($gid > 0) {
		echo 'colspan="6">';
	} else {
		echo 'colspan="5">';
	}
	if ($gid == 0) {
		echo _GR_NOUSERS;
	} else {
		echo _GR_NOUSER;
	}
	echo '</td></tr>';
}

echo '</table>';
echo '</form></center>';
grpagenums($op, $totalselected, $grconfig['perpage'], $max, $gid);
CloseTable();

include_once ('footer.php');

?>