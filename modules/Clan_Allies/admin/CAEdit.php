<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$site_id = intval($site_id);
$pagetitle = ": "._ADMINMAIN." - "._EDITSITE;
$comefrom = $_SERVER['HTTP_REFERER'];
$result = $db->sql_query("select * from `".$prefix."_clan_allies_sites` where `site_id`='$site_id'");
$site_row = $db->sql_fetchrow($result);
include("header.php");
camenu();
echo "<br>\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<form action='".$admin_file.".php?op=CAEditSave' method='post' enctype='multipart/form-data'>";
echo "<input type='hidden' name='site_id' value='".$site_row['site_id']."'>";
echo "<input type='hidden' name='old_image' value='".$site_row['site_image']."'>";
echo "<input type='hidden' name='user_id' value='".$site_row['user_id']."'>";
echo "<tr><td><b>"._SITEID.":</b></td><td><b>".$site_row['site_id']."</b></tr></td>";
echo "<tr><td><b>"._NAME.":</b></td><td><input type='text' name='site_name' size='30' value='".$site_row['site_name']."'></tr></td>";
echo "<tr><td><b>"._URL.":</b></td><td><input type='text' name='site_url' size='60' value='".$site_row['site_url']."'></tr></td>";
echo "<tr><td valign='top'><b>"._IMAGE.":</b></td><td><input type='file' name='new_image' size='30'><br>".$site_row['site_image']."</tr></td>";
echo "<tr><td><b>"._ADDED.":</b></td><td><input type='text' name='site_date' size='30' value='".$site_row['site_date']."'></tr></td>";
echo "<tr><td valign='top'><b>"._DESCRIPTION.":</b></td><td><textarea $textrowcol name='site_description'>".$site_row['site_description']."</textarea></tr></td>";
echo "<tr><td><b>"._SERVERNAME.":</b></td><td><input type='text' name='server_name' size='30' value='".$site_row['server_name']."'></tr></td>";
echo "<tr><td><b>"._SERVERIP.":</b></td><td><input type='text' name='server_ip' size='30' value='".$site_row['server_ip']."'></tr></td>";
echo "<tr><td><b>"._SERVERPORT.":</b></td><td><input type='text' name='server_port' size='30' value='".$site_row['server_port']."'></tr></td>";
echo "<tr><td><b>"._SERVERSLOTS.":</b></td><td><input type='text' name='server_slots' size='30' value='".$site_row['server_slots']."'></tr></td>";
echo "<tr><td><b>"._USERNAME.":</b></td><td><input type='text' name='user_name' size='30' value='".$site_row['user_name']."'></tr></td>";
echo "<tr><td><b>"._USEREMAIL.":</b></td><td><input type='text' name='user_email' size='30' value='".$site_row['user_email']."'></tr></td>";
echo "<tr><td><b>"._USERIP."</b></td><td>".$site_row['user_ip']."</tr></td>";
echo "<input type='hidden' name='comefrom' value='$comefrom'>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._EDIT."'></td></tr>";
echo "</form></table>";
CloseTable();
include("footer.php");

?>