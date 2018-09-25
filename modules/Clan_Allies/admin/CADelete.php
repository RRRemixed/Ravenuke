<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_id = intval($site_id);
$pagetitle = ": "._ADMINMAIN." - "._DELETESITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("select `site_name`, `site_url` from `".$prefix."_clan_allies_sites` where `site_id`='$site_id'");
list($site_name, $site_url) = $db->sql_fetchrow($result);
include("header.php");
title(_ADMINMAIN." - "._DELETESITE);
camenu();
echo "<br>\n";
OpenTable();
echo "<center>"._YOUDELETE." <a href='$site_url' target='blank'><b>$site_name</b></a><br><br>";
echo ""._SURE2DELETE."<br><br></center>";
echo "<center><table><tr>\n";
echo "<form action='".$admin_file.".php?op=CADeleteConfirm' method='post'>\n";
echo "<input type='hidden' name='site_id' value='$site_id'>\n";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<td align='center'><input type='submit' value=' "._YES." '><br>\n";
echo ""._GOBACK."</td>\n";
echo "</form>\n";
echo "</tr></table></center>\n";
CloseTable();
include("footer.php");

?>