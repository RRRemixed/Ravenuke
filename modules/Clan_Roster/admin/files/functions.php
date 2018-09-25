<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
$module_name="Clan_Roster";
function Navigation() {
global $db, $prefix, $admin_file;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRMain\">Clan Roster Admin</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRConfig\">Roster Configuration</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRGametypes\">Manage Games</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRRanks\">Manage Roster Ranks</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRRibbons\">Manage Roster Ribbons</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRAddmember\">Add Member</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRHexcolors\">Hex Colors</a></center></td>\n";
echo "<td width='50%'><center></center></td>\n";
echo "</tr>";
echo "</table>";
echo "<br \>[ <a href='".$admin_file.".php'>Site Administration</a> ]</center>\n";
echo "<br \>";
$latestversion = "http://www.t3gamingcommunity.com/versions/crversion.txt";
if(@file($latestversion)){
versioncheck();
}
CloseTable();
}

function Configmenu() {
global $db, $prefix, $admin_file;
$modulename = "Clan_Roster";
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Configuration Menu</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCGeneral&amp;update=0\">General Configuration</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCColors&amp;update=0\">Color Configuration</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCUsers&amp;update=0\">User Profile Configuration</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCHardware&amp;update=0\">Hardware Profile Configuration</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCGames&amp;update=0\">Game Types Configuration</a></center></td>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCRanks&amp;update=0\">Ranks Configuration</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center><a href=\"".$admin_file.".php?op=CRCRibbons&amp;update=0\">Ribbons Configuration</a></center></td>\n";
echo "<td width='50%'><center></center></td>\n";
echo "</tr>";
echo "</table>";
CloseTable();
}

function colors(){
global $db, $prefix, $admin_file, $module_name;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' class='option'><b><font color='$crfig[hcolor]'>Hex Colors</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'><td>\n";	
echo " <table width=\"90%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\" bordercolorlight=\"#787878\" bordercolordark=\"#787878\" style=\"border-collapse: collapse\" bordercolor=\"#787878\">"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#eeeeee\"><font color=\"#000000\">#EEEEEE</font></td>"
  . "        <td bgcolor=\"#dddddd\"><font color=\"#000000\">#DDDDDD</font></td>"
  . "        <td bgcolor=\"#cccccc\"><font color=\"#000000\">#CCCCCC</font></td>"
  . "        <td bgcolor=\"#bbbbbb\"><font color=\"#000000\">#BBBBBB</font></td>"
  . "        <td bgcolor=\"#aaaaaa\"><font color=\"#000000\">#AAAAAA</font></td>"
  . "        <td bgcolor=\"#999999\"><font color=\"#ffffff\">#999999</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#888888\"><font color=\"#ffffff\">#888888</font></td>"
  . "        <td bgcolor=\"#777777\"><font color=\"#ffffff\">#777777</font></td>"
  . "        <td bgcolor=\"#666666\"><font color=\"#ffffff\">#666666</font></td>"
  . "        <td bgcolor=\"#555555\"><font color=\"#ffffff\">#555555</font></td>"
  . "        <td bgcolor=\"#444444\"><font color=\"#ffffff\">#444444</font></td>"
  . "        <td bgcolor=\"#333333\"><font color=\"#ffffff\">#333333</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#222222\"><font color=\"#ffffff\">#222222</font></td>"
  . "        <td bgcolor=\"#111111\"><font color=\"#ffffff\">#111111</font></td>"
  . "        <td bgcolor=\"#000000\"><font color=\"#ffffff\">#000000</font></td>"
  . "        <td bgcolor=\"#ff0000\"><font color=\"#ffffff\">#FF0000</font></td>"
  . "        <td bgcolor=\"#ee0000\"><font color=\"#ffffff\">#EE0000</font></td>"
  . "        <td bgcolor=\"#dd0000\"><font color=\"#ffffff\">#DD0000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc0000\"><font color=\"#ffffff\">#CC0000</font></td>"
  . "        <td bgcolor=\"#bb0000\"><font color=\"#ffffff\">#BB0000</font></td>"
  . "        <td bgcolor=\"#aa0000\"><font color=\"#ffffff\">#AA0000</font></td>"
  . "        <td bgcolor=\"#990000\"><font color=\"#ffffff\">#990000</font></td>"
  . "        <td bgcolor=\"#880000\"><font color=\"#ffffff\">#880000</font></td>"
  . "        <td bgcolor=\"#770000\"><font color=\"#ffffff\">#770000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#660000\"><font color=\"#ffffff\">#660000</font></td>"
  . "        <td bgcolor=\"#550000\"><font color=\"#ffffff\">#550000</font></td>"
  . "        <td bgcolor=\"#440000\"><font color=\"#ffffff\">#440000</font></td>"
  . "        <td bgcolor=\"#330000\"><font color=\"#ffffff\">#330000</font></td>"
  . "        <td bgcolor=\"#220000\"><font color=\"#ffffff\">#220000</font></td>"
  . "        <td bgcolor=\"#110000\"><font color=\"#ffffff\">#110000</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ffffff\"><font color=\"#000000\">#FFFFFF</font></td>"
  . "        <td bgcolor=\"#ffffcc\"><font color=\"#000000\">#FFFFCC</font></td>"
  . "        <td bgcolor=\"#ffff99\"><font color=\"#000000\">#FFFF99</font></td>"
  . "        <td bgcolor=\"#ffff66\"><font color=\"#000000\">#FFFF66</font></td>"
  . "        <td bgcolor=\"#ffff33\"><font color=\"#000000\">#FFFF33</font></td>"
  . "        <td bgcolor=\"#ffff00\"><font color=\"#000000\">#FFFF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ccffff\"><font color=\"#000000\">#CCFFFF</font></td>"
  . "        <td bgcolor=\"#ccffcc\"><font color=\"#000000\">#CCFFCC</font></td>"
  . "        <td bgcolor=\"#ccff99\"><font color=\"#000000\">#CCFF99</font></td>"
  . "        <td bgcolor=\"#ccff66\"><font color=\"#000000\">#CCFF66</font></td>"
  . "        <td bgcolor=\"#ccff33\"><font color=\"#000000\">#CCFF33</font></td>"
  . "        <td bgcolor=\"#ccff00\"><font color=\"#000000\">#CCFF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#99ffff\"><font color=\"#000000\">#99FFFF</font></td>"
  . "        <td bgcolor=\"#99ffcc\"><font color=\"#000000\">#99FFCC</font></td>"
  . "        <td bgcolor=\"#99ff99\"><font color=\"#000000\">#99FF99</font></td>"
  . "        <td bgcolor=\"#99ff66\"><font color=\"#000000\">#99FF66</font></td>"
  . "        <td bgcolor=\"#99ff33\"><font color=\"#000000\">#99FF33</font></td>"
  . "        <td bgcolor=\"#99ff00\"><font color=\"#000000\">#99FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66ffff\"><font color=\"#000000\">#66FFFF</font></td>"
  . "        <td bgcolor=\"#66ffcc\"><font color=\"#000000\">#66FFCC</font></td>"
  . "        <td bgcolor=\"#66ff99\"><font color=\"#000000\">#66FF99</font></td>"
  . "        <td bgcolor=\"#66ff66\"><font color=\"#000000\">#66FF66</font></td>"
  . "        <td bgcolor=\"#66ff33\"><font color=\"#000000\">#66FF33</font></td>"
  . "        <td bgcolor=\"#66ff00\"><font color=\"#000000\">#66FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#33ffff\"><font color=\"#000000\">#33FFFF</font></td>"
  . "        <td bgcolor=\"#33ffcc\"><font color=\"#000000\">#33FFCC</font></td>"
  . "        <td bgcolor=\"#33ff99\"><font color=\"#000000\">#33FF99</font></td>"
  . "        <td bgcolor=\"#33ff66\"><font color=\"#000000\">#33FF66</font></td>"
  . "        <td bgcolor=\"#33ff33\"><font color=\"#000000\">#33FF33</font></td>"
  . "        <td bgcolor=\"#33ff00\"><font color=\"#000000\">#33FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00ffff\"><font color=\"#000000\">#00FFFF</font></td>"
  . "        <td bgcolor=\"#00ffcc\"><font color=\"#000000\">#00FFCC</font></td>"
  . "        <td bgcolor=\"#00ff99\"><font color=\"#000000\">#00FF99</font></td>"
  . "        <td bgcolor=\"#00ff66\"><font color=\"#000000\">#00FF66</font></td>"
  . "        <td bgcolor=\"#00ff33\"><font color=\"#000000\">#00FF33</font></td>"
  . "        <td bgcolor=\"#00ff00\"><font color=\"#000000\">#00FF00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ffccff\"><font color=\"#000000\">#FFCCFF</font></td>"
  . "        <td bgcolor=\"#ffcccc\"><font color=\"#000000\">#FFCCCC</font></td>"
  . "        <td bgcolor=\"#ffcc99\"><font color=\"#000000\">#FFCC99</font></td>"
  . "        <td bgcolor=\"#ffcc66\"><font color=\"#000000\">#FFCC66</font></td>"
  . "        <td bgcolor=\"#ffcc33\"><font color=\"#000000\">#FFCC33</font></td>"
  . "        <td bgcolor=\"#ffcc00\"><font color=\"#000000\">#FFCC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ccccff\"><font color=\"#000000\">#CCCCFF</font></td>"
  . "        <td bgcolor=\"#cccccc\"><font color=\"#000000\">#CCCCCC</font></td>"
  . "        <td bgcolor=\"#cccc99\"><font color=\"#000000\">#CCCC99</font></td>"
  . "        <td bgcolor=\"#cccc66\"><font color=\"#000000\">#CCCC66</font></td>"
  . "        <td bgcolor=\"#cccc33\"><font color=\"#000000\">#CCCC33</font></td>"
  . "        <td bgcolor=\"#cccc00\"><font color=\"#000000\">#CCCC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#99ccff\"><font color=\"#000000\">#99CCFF</font></td>"
  . "        <td bgcolor=\"#99cccc\"><font color=\"#000000\">#99CCCC</font></td>"
  . "        <td bgcolor=\"#99cc99\"><font color=\"#000000\">#99CC99</font></td>"
  . "        <td bgcolor=\"#99cc66\"><font color=\"#000000\">#99CC66</font></td>"
  . "        <td bgcolor=\"#99cc33\"><font color=\"#000000\">#99CC33</font></td>"
  . "        <td bgcolor=\"#99cc00\"><font color=\"#000000\">#99CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#66ccff\"><font color=\"#000000\">#66CCFF</font></td>"
  . "        <td bgcolor=\"#66cccc\"><font color=\"#000000\">#66CCCC</font></td>"
  . "        <td bgcolor=\"#66cc99\"><font color=\"#000000\">#66CC99</font></td>"
  . "        <td bgcolor=\"#66cc66\"><font color=\"#000000\">#66CC66</font></td>"
  . "        <td bgcolor=\"#66cc33\"><font color=\"#000000\">#66CC33</font></td>"
  . "        <td bgcolor=\"#66cc00\"><font color=\"#000000\">#66CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#33ccff\"><font color=\"#000000\">#33CCFF</font></td>"
  . "        <td bgcolor=\"#33cccc\"><font color=\"#000000\">#33CCCC</font></td>"
  . "        <td bgcolor=\"#33cc99\"><font color=\"#000000\">#33CC99</font></td>"
  . "        <td bgcolor=\"#33cc66\"><font color=\"#000000\">#33CC66</font></td>"
  . "        <td bgcolor=\"#33cc33\"><font color=\"#000000\">#33CC33</font></td>"
  . "        <td bgcolor=\"#33cc00\"><font color=\"#000000\">#33CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00ccff\"><font color=\"#000000\">#00CCFF</font></td>"
  . "        <td bgcolor=\"#00cccc\"><font color=\"#000000\">#00CCCC</font></td>"
  . "        <td bgcolor=\"#33cc66\"><font color=\"#000000\">#33CC66</font></td>"
  . "        <td bgcolor=\"#33cc33\"><font color=\"#000000\">#33CC33</font></td>"
  . "        <td bgcolor=\"#00cc99\"><font color=\"#000000\">#00CC99</font></td>"
  . "        <td bgcolor=\"#00cc66\"><font color=\"#000000\">#00CC66</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00cc33\"><font color=\"#000000\">#00CC33</font></td>"
  . "        <td bgcolor=\"#00cc00\"><font color=\"#000000\">#00CC00</font></td>"
  . "        <td bgcolor=\"#ff99ff\"><font color=\"#000000\">#FF99FF</font></td>"
  . "        <td bgcolor=\"#ff99cc\"><font color=\"#000000\">#FF99CC</font></td>"
  . "        <td bgcolor=\"#ff9999\"><font color=\"#000000\">#FF9999</font></td>"
  . "        <td bgcolor=\"#ff9966\"><font color=\"#000000\">#FF9966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff9933\"><font color=\"#ffffff\">#FF9933</font></td>"
  . "        <td bgcolor=\"#ff9900\"><font color=\"#ffffff\">#FF9900</font></td>"
  . "        <td bgcolor=\"#cc99ff\"><font color=\"#ffffff\">#CC99FF</font></td>"
  . "        <td bgcolor=\"#cc99cc\"><font color=\"#ffffff\">#CC99CC</font></td>"
  . "        <td bgcolor=\"#cc9999\"><font color=\"#ffffff\">#CC9999</font></td>"
  . "        <td bgcolor=\"#cc9966\"><font color=\"#ffffff\">#CC9966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc9933\"><font color=\"#ffffff\">#CC9933</font></td>"
  . "        <td bgcolor=\"#cc9900\"><font color=\"#ffffff\">#CC9900</font></td>"
  . "        <td bgcolor=\"#9999ff\"><font color=\"#ffffff\">#9999FF</font></td>"
  . "        <td bgcolor=\"#9999cc\"><font color=\"#ffffff\">#9999CC</font></td>"
  . "        <td bgcolor=\"#999999\"><font color=\"#ffffff\">#999999</font></td>"
  . "        <td bgcolor=\"#999966\"><font color=\"#ffffff\">#999966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#999933\"><font color=\"#ffffff\">#999933</font></td>"
  . "        <td bgcolor=\"#999900\"><font color=\"#ffffff\">#999900</font></td>"
  . "        <td bgcolor=\"#6699ff\"><font color=\"#ffffff\">#6699FF</font></td>"
  . "        <td bgcolor=\"#6699cc\"><font color=\"#ffffff\">#6699CC</font></td>"
  . "        <td bgcolor=\"#669999\"><font color=\"#ffffff\">#669999</font></td>"
  . "        <td bgcolor=\"#669966\"><font color=\"#ffffff\">#669966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#669933\"><font color=\"#ffffff\">#669933</font></td>"
  . "        <td bgcolor=\"#669900\"><font color=\"#ffffff\">#669900</font></td>"
  . "        <td bgcolor=\"#3399ff\"><font color=\"#ffffff\">#3399FF</font></td>"
  . "        <td bgcolor=\"#3399cc\"><font color=\"#ffffff\">#3399CC</font></td>"
  . "        <td bgcolor=\"#339999\"><font color=\"#ffffff\">#339999</font></td>"
  . "        <td bgcolor=\"#339966\"><font color=\"#ffffff\">#339966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#339933\"><font color=\"#ffffff\">#339933</font></td>"
  . "        <td bgcolor=\"#339900\"><font color=\"#ffffff\">#339900</font></td>"
  . "        <td bgcolor=\"#0099ff\"><font color=\"#ffffff\">#0099FF</font></td>"
  . "        <td bgcolor=\"#0099cc\"><font color=\"#ffffff\">#0099CC</font></td>"
  . "        <td bgcolor=\"#009999\"><font color=\"#ffffff\">#009999</font></td>"
  . "        <td bgcolor=\"#009966\"><font color=\"#ffffff\">#009966</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#009933\"><font color=\"#ffffff\">#009933</font></td>"
  . "        <td bgcolor=\"#009900\"><font color=\"#ffffff\">#009900</font></td>"
  . "        <td bgcolor=\"#ff66ff\"><font color=\"#ffffff\">#FF66FF</font></td>"
  . "        <td bgcolor=\"#ff66cc\"><font color=\"#ffffff\">#FF66CC</font></td>"
  . "        <td bgcolor=\"#ff6699\"><font color=\"#ffffff\">#FF6699</font></td>"
  . "        <td bgcolor=\"#ff6666\"><font color=\"#ffffff\">#FF6666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff6633\"><font color=\"#ffffff\">#FF6633</font></td>"
  . "        <td bgcolor=\"#ff6600\"><font color=\"#ffffff\">#FF6600</font></td>"
  . "        <td bgcolor=\"#cc66ff\"><font color=\"#ffffff\">#CC66FF</font></td>"
  . "        <td bgcolor=\"#cc66cc\"><font color=\"#ffffff\">#CC66CC</font></td>"
  . "        <td bgcolor=\"#cc6699\"><font color=\"#ffffff\">#CC6699</font></td>"
  . "        <td bgcolor=\"#cc6666\"><font color=\"#ffffff\">#CC6666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc6633\"><font color=\"#ffffff\">#CC6633</font></td>"
  . "        <td bgcolor=\"#cc6600\"><font color=\"#ffffff\">#CC6600</font></td>"
  . "        <td bgcolor=\"#9966ff\"><font color=\"#ffffff\">#9966FF</font></td>"
  . "        <td bgcolor=\"#9966cc\"><font color=\"#ffffff\">#9966CC</font></td>"
  . "        <td bgcolor=\"#996699\"><font color=\"#ffffff\">#996699</font></td>"
  . "        <td bgcolor=\"#996666\"><font color=\"#ffffff\">#996666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#996633\"><font color=\"#ffffff\">#996633</font></td>"
  . "        <td bgcolor=\"#996600\"><font color=\"#ffffff\">#996600</font></td>"
  . "        <td bgcolor=\"#6666ff\"><font color=\"#ffffff\">#6666FF</font></td>"
  . "        <td bgcolor=\"#6666cc\"><font color=\"#ffffff\">#6666CC</font></td>"
  . "        <td bgcolor=\"#666699\"><font color=\"#ffffff\">#666699</font></td>"
  . "        <td bgcolor=\"#666666\"><font color=\"#ffffff\">#666666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#666633\"><font color=\"#ffffff\">#666633</font></td>"
  . "        <td bgcolor=\"#666600\"><font color=\"#ffffff\">#666600</font></td>"
  . "        <td bgcolor=\"#3366ff\"><font color=\"#ffffff\">#3366FF</font></td>"
  . "        <td bgcolor=\"#0063F7\"><font color=\"#ffffff\">#3366CC</font></td>"
  . "        <td bgcolor=\"#336699\"><font color=\"#ffffff\">#336699</font></td>"
  . "        <td bgcolor=\"#336666\"><font color=\"#ffffff\">#336666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#336633\"><font color=\"#ffffff\">#336633</font></td>"
  . "        <td bgcolor=\"#336600\"><font color=\"#ffffff\">#336600</font></td>"
  . "        <td bgcolor=\"#0066ff\"><font color=\"#ffffff\">#0066FF</font></td>"
  . "        <td bgcolor=\"#0066cc\"><font color=\"#ffffff\">#0066CC</font></td>"
  . "        <td bgcolor=\"#006699\"><font color=\"#ffffff\">#006699</font></td>"
  . "        <td bgcolor=\"#006666\"><font color=\"#ffffff\">#006666</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#006633\"><font color=\"#ffffff\">#006633</font></td>"
  . "        <td bgcolor=\"#006600\"><font color=\"#ffffff\">#006600</font></td>"
  . "        <td bgcolor=\"#ff33ff\"><font color=\"#ffffff\">#FF33FF</font></td>"
  . "        <td bgcolor=\"#ff33cc\"><font color=\"#ffffff\">#FF33CC</font></td>"
  . "        <td bgcolor=\"#ff3399\"><font color=\"#ffffff\">#FF3399</font></td>"
  . "        <td bgcolor=\"#ff3366\"><font color=\"#ffffff\">#FF3366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff3333\"><font color=\"#ffffff\">#FF3333</font></td>"
  . "        <td bgcolor=\"#ff3300\"><font color=\"#ffffff\">#FF3300</font></td>"
  . "        <td bgcolor=\"#cc33ff\"><font color=\"#ffffff\">#CC33FF</font></td>"
  . "        <td bgcolor=\"#cc33cc\"><font color=\"#ffffff\">#CC33CC</font></td>"
  . "        <td bgcolor=\"#cc3399\"><font color=\"#ffffff\">#CC3399</font></td>"
  . "        <td bgcolor=\"#cc3366\"><font color=\"#ffffff\">#CC3366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc3333\"><font color=\"#ffffff\">#CC3333</font></td>"
  . "        <td bgcolor=\"#cc3300\"><font color=\"#ffffff\">#CC3300</font></td>"
  . "        <td bgcolor=\"#9933ff\"><font color=\"#ffffff\">#9933FF</font></td>"
  . "        <td bgcolor=\"#9933cc\"><font color=\"#ffffff\">#9933CC</font></td>"
  . "        <td bgcolor=\"#993399\"><font color=\"#ffffff\">#993399</font></td>"
  . "        <td bgcolor=\"#993366\"><font color=\"#ffffff\">#993366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#993333\"><font color=\"#ffffff\">#993333</font></td>"
  . "        <td bgcolor=\"#993300\"><font color=\"#ffffff\">#993300</font></td>"
  . "        <td bgcolor=\"#6633ff\"><font color=\"#ffffff\">#6633FF</font></td>"
  . "        <td bgcolor=\"#6633cc\"><font color=\"#ffffff\">#6633CC</font></td>"
  . "        <td bgcolor=\"#663399\"><font color=\"#ffffff\">#663399</font></td>"
  . "        <td bgcolor=\"#663366\"><font color=\"#ffffff\">#663366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#663333\"><font color=\"#ffffff\">#663333</font></td>"
  . "        <td bgcolor=\"#663300\"><font color=\"#ffffff\">#663300</font></td>"
  . "        <td bgcolor=\"#3333ff\"><font color=\"#ffffff\">#3333FF</font></td>"
  . "        <td bgcolor=\"#3333cc\"><font color=\"#ffffff\">#3333CC</font></td>"
  . "        <td bgcolor=\"#333399\"><font color=\"#ffffff\">#333399</font></td>"
  . "        <td bgcolor=\"#333366\"><font color=\"#ffffff\">#333366</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#333333\"><font color=\"#ffffff\">#333333</font></td>"
  . "        <td bgcolor=\"#333300\"><font color=\"#ffffff\">#333300</font></td>"
  . "        <td bgcolor=\"#0033ff\"><font color=\"#ffffff\">#0033FF</font></td>"
  . "        <td bgcolor=\"#ff3333\"><font color=\"#ffffff\">#FF3333</font></td>"
  . "        <td bgcolor=\"#0033cc\"><font color=\"#ffffff\">#0033CC</font></td>"
  . "        <td bgcolor=\"#003399\"><font color=\"#ffffff\">#003399</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#003366\"><font color=\"#ffffff\">#003366</font></td>"
  . "        <td bgcolor=\"#003333\"><font color=\"#ffffff\">#003333</font></td>"
  . "        <td bgcolor=\"#003300\"><font color=\"#ffffff\">#003300</font></td>"
  . "        <td bgcolor=\"#ff00ff\"><font color=\"#ffffff\">#FF00FF</font></td>"
  . "        <td bgcolor=\"#ff00cc\"><font color=\"#ffffff\">#FF00CC</font></td>"
  . "        <td bgcolor=\"#ff0099\"><font color=\"#ffffff\">#FF0099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#ff0066\"><font color=\"#ffffff\">#FF0066</font></td>"
  . "        <td bgcolor=\"#ff0033\"><font color=\"#ffffff\">#FF0033</font></td>"
  . "        <td bgcolor=\"#ff0000\"><font color=\"#ffffff\">#FF0000</font></td>"
  . "        <td bgcolor=\"#cc00ff\"><font color=\"#ffffff\">#CC00FF</font></td>"
  . "        <td bgcolor=\"#cc00cc\"><font color=\"#ffffff\">#CC00CC</font></td>"
  . "        <td bgcolor=\"#cc0099\"><font color=\"#ffffff\">#CC0099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#cc0066\"><font color=\"#ffffff\">#CC0066</font></td>"
  . "        <td bgcolor=\"#cc0033\"><font color=\"#ffffff\">#CC0033</font></td>"
  . "        <td bgcolor=\"#cc0000\"><font color=\"#ffffff\">#CC0000</font></td>"
  . "        <td bgcolor=\"#9900ff\"><font color=\"#ffffff\">#9900FF</font></td>"
  . "        <td bgcolor=\"#9900cc\"><font color=\"#ffffff\">#9900CC</font></td>"
  . "        <td bgcolor=\"#990099\"><font color=\"#ffffff\">#990099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#990066\"><font color=\"#ffffff\">#990066</font></td>"
  . "        <td bgcolor=\"#990033\"><font color=\"#ffffff\">#990033</font></td>"
  . "        <td bgcolor=\"#990000\"><font color=\"#ffffff\">#990000</font></td>"
  . "        <td bgcolor=\"#6600ff\"><font color=\"#ffffff\">#6600FF</font></td>"
  . "        <td bgcolor=\"#6600cc\"><font color=\"#ffffff\">#6600CC</font></td>"
  . "        <td bgcolor=\"#660099\"><font color=\"#ffffff\">#660099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#660066\"><font color=\"#ffffff\">#660066</font></td>"
  . "        <td bgcolor=\"#660033\"><font color=\"#ffffff\">#660033</font></td>"
  . "        <td bgcolor=\"#660000\"><font color=\"#ffffff\">#660000</font></td>"
  . "        <td bgcolor=\"#3300ff\"><font color=\"#ffffff\">#3300FF</font></td>"
  . "        <td bgcolor=\"#3300cc\"><font color=\"#ffffff\">#3300CC</font></td>"
  . "        <td bgcolor=\"#330099\"><font color=\"#ffffff\">#330099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#330066\"><font color=\"#ffffff\">#330066</font></td>"
  . "        <td bgcolor=\"#330033\"><font color=\"#ffffff\">#330033</font></td>"
  . "        <td bgcolor=\"#330000\"><font color=\"#ffffff\">#330000</font></td>"
  . "        <td bgcolor=\"#0000ff\"><font color=\"#ffffff\">#0000FF</font></td>"
  . "        <td bgcolor=\"#0000cc\"><font color=\"#ffffff\">#0000CC</font></td>"
  . "        <td bgcolor=\"#000099\"><font color=\"#ffffff\">#000099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000066\"><font color=\"#ffffff\">#000066</font></td>"
  . "        <td bgcolor=\"#000033\"><font color=\"#ffffff\">#000033</font></td>"
  . "        <td bgcolor=\"#00ff00\"><font color=\"#000000\">#00FF00</font></td>"
  . "        <td bgcolor=\"#00ee00\"><font color=\"#000000\">#00EE00</font></td>"
  . "        <td bgcolor=\"#00dd00\"><font color=\"#000000\">#00DD00</font></td>"
  . "        <td bgcolor=\"#00cc00\"><font color=\"#000000\">#00CC00</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#00bb00\"><font color=\"#ffffff\">#00BB00</font></td>"
  . "        <td bgcolor=\"#00aa00\"><font color=\"#ffffff\">#00AA00</font></td>"
  . "        <td bgcolor=\"#009900\"><font color=\"#ffffff\">#009900</font></td>"
  . "        <td bgcolor=\"#008800\"><font color=\"#ffffff\">#008800</font></td>"
  . "        <td bgcolor=\"#007700\"><font color=\"#ffffff\">#007700</font></td>"
  . "        <td bgcolor=\"#006600\"><font color=\"#ffffff\">##006600</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#005500\"><font color=\"#ffffff\">#005500</font></td>"
  . "        <td bgcolor=\"#004400\"><font color=\"#ffffff\">#004400</font></td>"
  . "        <td bgcolor=\"#003300\"><font color=\"#ffffff\">#003300</font></td>"
  . "        <td bgcolor=\"#002200\"><font color=\"#ffffff\">#002200</font></td>"
  . "        <td bgcolor=\"#001100\"><font color=\"#ffffff\">#001100</font></td>"
  . "        <td bgcolor=\"#0000ff\"><font color=\"#ffffff\">#0000FF</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#0000ee\"><font color=\"#ffffff\">#0000EE</font></td>"
  . "        <td bgcolor=\"#0000dd\"><font color=\"#ffffff\">#0000DD</font></td>"
  . "        <td bgcolor=\"#0000cc\"><font color=\"#ffffff\">#0000CC</font></td>"
  . "        <td bgcolor=\"#0000bb\"><font color=\"#ffffff\">#0000BB</font></td>"
  . "        <td bgcolor=\"#0000aa\"><font color=\"#ffffff\">#0000AA</font></td>"
  . "        <td bgcolor=\"#000099\"><font color=\"#ffffff\">#000099</font></td></tr>"
  . "        <tr align=\"center\">"
  . "        <td bgcolor=\"#000088\"><font color=\"#ffffff\">#000088</font></td>"
  . "        <td bgcolor=\"#000077\"><font color=\"#ffffff\">#000077</font></td>"
  . "        <td bgcolor=\"#000055\"><font color=\"#ffffff\">#000055</font></td>"
  . "        <td bgcolor=\"#000044\"><font color=\"#ffffff\">#000044</font></td>"
  . "        <td bgcolor=\"#000022\"><font color=\"#ffffff\">#000022</font></td>"
  . "        <td bgcolor=\"#000011\"><font color=\"#ffffff\">#000011</font></td></tr></table><br \>"
  ."<CENTER>Hex Colors v2&nbsp;by&nbsp;<a href=\"http://www.lenon.com\">VinDSL</a><br \>"
  ."<CENTER>Minor Modifications&nbsp;by&nbsp;<a href=\"http://www.t3gamingcommunity.com\">Floppy</a>";
echo "</td></tr></td></tr></table>";  
}
?>
