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

$pagetitle = _GR_ADMIN . ': ' . _GR_GROUPSEMAIL;

include_once ('header.php');

title($pagetitle);
NSNGroupsAdmin();
echo '<br />';
OpenTable();
echo '<center><form method="post" action="' . $admin_file . '.php">';
echo '<b>' . _GR_TYPE . ':</b> <select name="etype">';
echo '<option value="0">' . _GR_TEXT . '</option>' . '<option value="1">' . _GR_HTML . '</option>';
echo '</select><br /><br />';
echo '<b>' . _GR_FROMA . ':</b> ' . $aname . '<br /><br />';
echo '<b>' . _GR_TO . ':</b> <select name="gid[]" multiple="multiple">';
echo '<option value="0">' . _GR_ALLGR . '</option>';

$result = $db->sql_query('SELECT `gid`, `gname` FROM `' . $prefix . '_nsngr_groups` ORDER BY `gname`');
while (list($gid, $gname) = $db->sql_fetchrow($result)) {
	echo '<option value="' . $gid . '">' . $gname . '</option>';
}

echo '</select><br /><br />';
echo '<b>' . _GR_SUB . ':</b> <input type="text" name="gsubject" size="50" /><br /><br />';
echo '<b>' . _GR_MES . ':</b><br /><textarea name="gcontent" ' . $textrowcol . '></textarea><br /><br />';
echo '<input type="hidden" name="aname" value="' . $aname . '" />';
echo '<input type="hidden" name="amail" value="' . $amail . '" />';
echo '<input type="hidden" name="op" value="NSNGroupsUsersEmailSend" />';
echo '<input type="submit" value="' . _GR_SEND . '" />';
echo '</form></center>';
CloseTable();

include_once ('footer.php');

?>