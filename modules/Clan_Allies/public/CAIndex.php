<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

$pagetitle = _CLANALLIES;
include("header.php");

OpenTable();
echo "<center><img src= modules/Clan_Allies/images/logo.gif><br><br>";
if(is_admin($admin)) { echo "[ <a href='".$admin_file.".php?op=CAMain'>"._GOTOADMIN."</a> ]\n"; }
if($ca_config['require_user'] == 0 || is_user($user)) { echo "[ <a href='modules.php?name=$module_name&amp;op=CASubmit'>"._BESUPPORTER."</a> ]\n"; }
echo "</center>";
echo "<br>";
CloseTable();
OpenTable();
$a = 0;
$result = $db->sql_query("SELECT `site_id`, `site_name`, `site_url`, `site_image`, `site_date`, `site_description`, `server_name`, `server_ip`, `server_port`, `server_slots`, `site_hits` FROM `".$prefix."_clan_allies_sites` WHERE `site_status`='1' ORDER BY `site_name`");
$numrows = $db->sql_numrows($result);
if($numrows > 0) {
  echo "<table border='0' cellpadding='2' cellspacing='5' width='100%'>";
  while(list($site_id, $site_name, $site_url, $site_image, $site_date, $site_description, $server_name, $server_ip, $server_port, $server_slots, $site_hits) = $db->sql_fetchrow($result)) {
    if($a == 0) { echo "<tr>"; }
    echo "<td width='50%' valign='top'>";
    OpenTable2();
    echo "<table border='0' width='100%'>";
    echo "<tr><td align='center' valign='top' rowspan='8'>";
    list($width, $height, $type, $attr) = getimagesize($site_image);
    if($width > $ca_config['max_width']) { $width = $ca_config['max_width']; }
    if($height > $ca_config['max_height']) { $height = $ca_config['max_height']; }
    echo "<a href='modules.php?name=$module_name&op=CAGo&site_id=$site_id' target='_blank'><img src='$site_image' border='0' alt='$site_name' title='$site_name' height='$height' width='$width'></a>";
    if(is_admin($admin)) {
      echo " <a href='".$admin_file.".php?op=CADeactivate&amp;site_id=$site_id'><img src='modules/$module_name/images/deactivate.png' border='0' alt='"._DEACTIVATE."' title='"._DEACTIVATE."'></a>";
      echo " <a href='".$admin_file.".php?op=CAEdit&amp;site_id=$site_id'><img src='modules/$module_name/images/edit.png' border='0' alt='"._EDIT."' title='"._EDIT."'></a>";
      echo " <a href='".$admin_file.".php?op=CADelete&amp;site_id=$site_id'><img src='modules/$module_name/images/delete.png' border='0' alt='"._DELETE."' title='"._DELETE."'></a>";
    }
    echo "</td>\n<td width='100%' valign='top'><b>"._NAME.":</b> $site_name</td></tr>";
	echo "<tr><td valign='top'><b>"._ADDED.":</b> $site_date</td></tr>";
    echo "<tr><td valign='top'><b>"._DESCRIPTION."</b>: $site_description</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERNAME."</b>: $server_name</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERIP."</b>: $server_ip</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERPORT."</b>: $server_port</td></tr>";
	echo "<tr><td valign='top'><b>"._SERVERSLOTS."</b>: $server_slots</td></tr>";
    echo "<tr><td valign='top'><b>"._VISITS."</b>: $site_hits</td></tr>";
    echo "</table>";
  CloseTable2();
    echo "</td></tr><td><hr></td><tr>";
    $a++;
    if($a == 2) { echo "</tr>"; $a = 0; }
  }
  if($a ==1) { echo "<td width='50%'>&nbsp;</td></tr></table>"; } else { echo "</tr></table>"; }
} else {
OpenTable2();
echo "<center>"._NOSUBMITTEDSITES."</center><br><br>";            
CloseTable2();			
        }
CloseTable();
	
    include("footer.php");

?>