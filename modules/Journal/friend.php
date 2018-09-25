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
/************************************************************************/
/* Additional security checking code 2003 by chatserv                   */
/* http://www.nukefixes.com -- http://www.nukeresources.com             */
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
if (!isset($send)) $send = 0;
$pagetitle = '- ' . _USERSJOURNAL;
include_once('header.php');
include_once('modules/' . $module_name . '/functions.php');
startjournal();
echo '<br />';
if (!is_user($user)) {
	OpenTable();
	echo '<div align="center">' . _YOUMUSTBEMEMBER . '<br /></div>';
} else {
	getusrinfo($user);
	$username = $userinfo['username'];
	$user_id = intval($userinfo['user_id']);
	$sql = 'select title from ' . $prefix . '_journal where jid=\'' . $jid . '\'';
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$jtitle = $row['title'];
	if ($send == 1) {
		csrf_check();
		$fname = removecrlf($fname);
		$fmail = validate_mail(removecrlf($fmail));
		$yname = removecrlf($yname);
		$ymail = validate_mail(removecrlf($ymail));
		title(_SENDJFRIEND);
		OpenTable();
		if (empty($fname) or empty($fmail) or empty($yname) or empty($ymail)) {
			echo '<center><strong>' . _YOUMUSTFILLFIELDS . '</strong></center><br />';
			echo '<center>' . _GOBACK . '</center>';
		} else {
			$subject = _INTERESTING . ' ' . $sitename;
			$message = _HELLO . ' ' . $fname . ':' . "\n\n" . _YOURFRIEND . ' ' . $yname . ' ' . _CONSIDERED . "\n\n"
				. $jtitle . "\n" . _URL . ':' . $nukeurl . '/modules.php?name=' . $module_name . '&file=display&jid=' . $jid . "\n\n"
				. _AREMORE . "\n\n" . '---' . "\n" . $sitename . "\n" . $nukeurl;
			/*
			 * TegoNuke Mailer added by montego for 2.20.00
			 */
			$mailsuccess = false;
			if (defined('TNML_IS_ACTIVE')) {
				$to = array(array($fmail, $fname));
				$mailsuccess = tnml_fMailer($to, $subject, $message, $ymail, $yname);
			} else {
				$mailsuccess = mail($fmail, $subject, $message, "From: $yname <$ymail>\r\nReply-To: $ymail\r\nX-Mailer: PHP/" . phpversion());
			}
			if ($mailsuccess) {
				echo '<center>' . _FSENT . '<br /><br />[ <a href="modules.php?name=' . $module_name . '&amp;file=display&amp;jid=' . $jid . '">'
					. _RETURNJOURNAL2 . '</a> ]</center>';
			} else {
				echo '<center><b>' . _ANERROR . '</b></center>';
			}
	//		@mail($fmail, $subject, $message, "From: $yname <$ymail>\r\nReply-To: $ymail\r\nX-Mailer: PHP/" . phpversion());
			/*
			 * end of TegoNuke Mailer add
			 */
		}
	} else {
		title(_SENDJFRIEND);
		OpenTable();
		echo '<p align="center"><b>' . $jtitle . '</b><br />' . _YOUSENDJOURNAL . '</p>'
			. '<form action="modules.php?name=' . $module_name . '&amp;file=friend" method="post">'
			. '<input type="hidden" name="send" value="1" /><input type="hidden" name="jid" value="' . $jid . '" />'
			. '<table align="center" border="0">';
		$sql = 'select name, username, user_email from ' . $user_prefix . '_users where user_id = \'' . $user_id . '\'';
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$yn = check_html($row['name'], 'nohtml');
		$yun = check_html($row['username'], 'nohtml');
		$ye = check_html($row['user_email'], 'nohtml');
		if (empty($yn)) {
			$yn = $yun;
		}
		echo '<tr><td align="right"><b>' . _FYOURNAME . '</b>: </td><td align="left"><input type="text" name="yname" value="' . $yn . '" /></td></tr>'
			. '<tr><td align="right"><b>' . _FYOUREMAIL . '</b>: </td><td align="left"><input type="text" name="ymail" value="' . $ye . '" size="40" /></td></tr>'
			. '<tr><td align="right"><b>' . _FFRIENDNAME . '</b>: </td><td align="left"><input type="text" name="fname" /></td></tr>'
			. '<tr><td align="right"><b>' . _FFRIENDEMAIL . '</b>: </td><td align="left"><input type="text" name="fmail" size="40" /></td></tr>'
			. '</table><br /><center><input type="submit" value="' . _SEND . '" /></center>'
			. '</form>';
	}
}
closeTable();
echo '<br />';
journalfoot();
?>