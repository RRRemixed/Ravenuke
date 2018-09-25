<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Based on Atomic Journal                                              */
/* Copyright (c) by Trevor Scott                                        */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Journal 2.0 Enhanced and Debugged 2004                               */
/* by sixonetonoffun -- http://www.netflake.com --                      */
/* Images Created by GanjaUK -- http://www.GanjaUK.com                  */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, bug fixes, and   */
/* W3C XHTML compliance fixes by Montego - http://montegoscripts.com.   */
/************************************************************************/
if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (!isset($jid) or !is_numeric($jid) or empty($jid)) {
	die('No journal specified.');
} else {
	$jid = intval($jid);
}
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
include_once('modules/' . $module_name . '/functions.php');
if (is_user($user)) {
	getusrinfo($user);
	$username = $userinfo['username'];
	define('JOURNAL_ISUSER', true);
} else {
	$username = '';
}
startjournal();
echo '<br />';
OpenTable();
$sql = 'SELECT j.jid, j.aid, j.title, j.pdate, j.ptime, j.mdate, j.mtime, j.bodytext, j.status, j.mood, u.user_id, u.username FROM ' . $prefix . '_journal j, ' . $user_prefix . '_users u WHERE u.username=j.aid and j.jid = \'' . $jid . '\'';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	$owner = check_html($row['aid'], 'nohtml');
	$status = check_html($row['status'], 'nohtml');
	$jaid = check_html($row['aid'], 'nohtml');
	if (($status == 'no') && ($jaid != $username)) {
		echo '<center><br />' . _ISPRIVATE . '<br /></center>';
		CloseTable();
		echo '<br />';
		journalfoot();
		die();
	}
	$row['title'] = check_html($row['title'], 'nohtml');
	$jmood = check_html($row['mood'], 'nohtml');
	if (!empty($jmood)) {
		printf('<br /><div align="center"><img src="' . $jsmiles . '/%s" alt="%s" title="%s" /></div>', $jmood, $jmood, $jmood);
	}
	$title = check_html($row['title'], 'nohtml');
	printf('<div class="title" align="center">%s</div>', $title);
	$jid = intval($row['jid']);
	$pdate = check_html($row['pdate'], 'nohtml');
	$ptime = check_html($row['ptime'], 'nohtml');
	printf('<div align="center">' . _BY . ': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $jaid . '">%s</a></div>', $jaid, $jaid);
	printf('<div align="center" class="tiny">' . _POSTEDON . ': %s @ %s</div>', $pdate, $ptime);
	CloseTable();
	echo '<br />';
	OpenTable();
	$jbodytext = $row['bodytext'];
	$jbodytext = check_html($jbodytext, '');
	printf('<div>%s</div>', $jbodytext);
	CloseTable();
	printf('<br /><br /><div class="tiny" align="center">' . _LASTUPDATED . ' %s @ %s</div><br />', $row['mdate'], $row['mtime']);
	printf('<div class="tiny" align="center">[ <a href="modules.php?name=' . $module_name . '&amp;file=friend&amp;jid=%s">' . _SENDJFRIEND . '</a> ]</div>', $row['jid']);
	echo '<br />';
	OpenTable();
	echo '<table width="100%" align="center"><tr>';
	if (defined('JOURNAL_ISUSER') and $owner == $username) {
		echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=modify&amp;jid=' . $jid . '"><img src="modules/' . $module_name . '/images/edit.gif" border="0" alt="' . _EDIT . '" title="' . _EDIT . '" /><br />' . _EDIT . '</a></td>';
		echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=delete&amp;jid=' . $jid . '&amp;forwhat=' . $jid . '"><img src="modules/' . $module_name . '/images/trash.gif" border="0" alt="' . _DELETE . '" title="' . _DELETE . '" /><br />' . _DELETE . '</a></td>';
	} elseif (is_admin($admin)) {
		echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=modify&amp;jid=' . $jid . '"><img src="modules/' . $module_name . '/images/edit.gif" border="0" alt="' . _EDIT . '" title="' . _EDIT . '" /><br />' . _EDIT . '</a></td>';
		echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=delete&amp;jid=' . $jid . '&amp;forwhat=' . $jid . '"><img src="modules/' . $module_name . '/images/trash.gif" border="0" alt="' . _DELETE . '" title="' . _DELETE . '" /><br />' . _DELETE . '</a></td>';
	}
	if (!empty($username)) {
		echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=comment&amp;onwhat=' . $jid . '"><img src="modules/' . $module_name . '/images/write.gif" border="0" alt="' . _WRITECOMMENT . '" title="' . _WRITECOMMENT . '" /><br />' . _WRITECOMMENT . '</a></td>';
	}
	echo '<td align="center" width="15%"><a href="modules.php?name=' . $module_name . '&amp;file=search&amp;bywhat=aid&amp;forwhat=' . $row['aid'] . '"><img src="modules/' . $module_name . '/images/binocs.gif" border="0" alt="' . _VIEWMORE . '" title="' . _VIEWMORE . '" /><br />' . _VIEWMORE . '</a></td>';
	echo '<td align="center" width="15%"><a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=' . $owner . '"><img src="modules/' . $module_name . '/images/nuke.gif" border="0" alt="' . _USERPROFILE . '" title="' . _USERPROFILE . '" /><br />' . _USERPROFILE . '</a></td>';
	if ($username != '' AND is_active('Private_Messages')) {
		echo '<td align="center" width="15%"><a href="modules.php?name=Private_Messages&amp;mode=post&amp;u=' . $row['user_id'] . '"><img src="modules/' . $module_name . '/images/chat.gif" border="0" alt="' . _SENDMESSAGE . '" title="' . _SENDMESSAGE . '" /><br />' . _SENDMESSAGE . '</a></td>';
	}
	if (empty($username)) {
		echo '<td align="center" width="15%"><a href="modules.php?name=Your_Account"><img src="modules/' . $module_name . '/images/folder.gif" border="0" alt="Create an account" title="Create an account" /><br />' . _CREATEACCOUNT . '</a></td>';
	}
	echo '</tr></table>';
}
closeTable();
$commentheader = 'no';
$sql = 'SELECT j.cid, j.rid, j.aid, j.comment, j.pdate, j.ptime, u.user_id FROM ' . $prefix . '_journal_comments j, ' . $user_prefix . '_users u WHERE j.aid=u.username and j.rid = \'' . $jid . '\'';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	$row['cid'] = intval($row['cid']);
	$row['rid'] = check_html($row['rid'], 'nohtml');
	$row['aid'] = check_html($row['aid'], 'nohtml');
	$row['comment'] = check_html($row['comment'], '');
	$pdate = check_html($row['pdate'], 'nohtml');
	$ptime = check_html($row['ptime'], 'nohtml');
	$row['user_id'] = intval($row['user_id']);
	if ($row == 0) {
		$commentheader = 'yes';
	} else {
		if ($commentheader == 'no') {
			opentable();
			echo '<div align="center" class="title">' . _POSTEDCOMMENTS . '</div>';
			if ($username == '' OR $username == $anonymous) {
				echo '<br /><div align="center" class="tiny">' . _REGUSERSCOMM . '</div>';
			}
			closetable();
			$commentheader = 'yes';
		} elseif ($commentheader = 'yes') {
		}
	}
	openTable();
	printf('<strong>' . _COMMENTBY . ':</strong> <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username=%s">%s</a> <div class="tiny">(' . _POSTEDON . ' ' . $pdate . ' @ ' . $ptime . ')</div><br />', $row['aid'], $row['aid'], $pdate, $ptime);
	printf('<strong>' . _UCOMMENTS . ':</strong><br />%s', $row['comment']);
	if (defined('JOURNAL_ISUSER') and $owner == $username) {
		printf('<br /><div align="center"><form action="modules.php?name=' . $module_name . '&amp;file=commentkill&amp;onwhat=%s&amp;ref=' . $jid . '" method="post"><input type="submit" value="' . _DELCOMMENT . '" /></form></div>', $row['cid'], $jid);
	} elseif (is_admin($admin)) {
		printf('<br /><div align="center"><form action="modules.php?name=' . $module_name . '&amp;file=commentkill&amp;onwhat=%s&amp;ref=' . $jid . '" method="post"><input type="submit" value="' . _DELCOMMENT . '" /></form></div>', $row['cid'], $jid);
	}
	closeTable();
}
echo '<br />';
journalfoot();
?>