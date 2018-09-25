<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$pagetitle = ": "._ADMINMAIN." - "._INACTIVESITES;
include("header.php");
title(_ADMINMAIN." - "._INACTIVESITES);
camenu();
echo "<br>\n";
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT * FROM `".$prefix."_clan_allies_sites` WHERE `site_status`='-1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while($site_row = $db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable2();
    list($width, $height, $type, $attr) = getimagesize($site_row['site_image']);
    if($width > $ca_config['max_width']) { $width = $ca_config['max_width']; }
    if($height > $ca_config['max_height']) { $height = $ca_config['max_height']; }
    echo "<table border='0' width='100%'>";
    echo "<tr><td width='25%' align='center' valign='top' rowspan='8'>";
    echo "<a href='modules.php?name=$modname&op=CAGo&site_id=".$site_row['site_id']."' target='_blank'><img src='".$site_row['site_image']."' border='0' alt='".$site_row['site_name']."' title='".$site_row['site_name']."' height='$height' width='$width'></a>";
    echo " <a href='".$admin_file.".php?op=CAActivate&amp;site_id=".$site_row['site_id']."'><img src='modules/$modname/images/activate.png' border='0' alt='"._ACTIVATE."' title='"._ACTIVATE."'></a>";
    echo " <a href='".$admin_file.".php?op=CAEdit&amp;site_id=".$site_row['site_id']."'><img src='modules/$modname/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>";
    echo " <a href='".$admin_file.".php?op=CADelete&amp;site_id=".$site_row['site_id']."'><img src='modules/$modname/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    echo "</td>\n<td width='75%' valign='top'><b>"._ADDED.":</b> ".$site_row['site_date']."</td></tr>";
    echo "<tr><td valign='top'><b>"._DESCRIPTION."</b>: ".$site_row['site_description']."</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERNAME."</b>: ".$site_row['server_name']."</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERIP."</b>: ".$site_row['server_ip']."</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERPORT."</b>: ".$site_row['server_port']."</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERSLOTS."</b>: ".$site_row['server_slots']."</td></tr>";
    echo "<tr><td valign='top'><b>"._VISITS."</b>: ".$site_row['site_hits']."</td></tr>";
    echo "</table>";
    CloseTable2();
    echo "</td></tr><td><hr></td><tr>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
} else {
OpenTable2();
echo "<center>"._NOINACTIVESITES."</center><br><br>";            
CloseTable2();			
        }
CloseTable();
	
    include("footer.php");

?>