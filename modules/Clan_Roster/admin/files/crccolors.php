<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
Configmenu();
if($update==1) {
$newcrfig = array();
$newcrfig['bcolor'] = $bcolor;
$newcrfig['rcolor'] = $rcolor;
$newcrfig['hcolor'] = $hcolor;
$sql = "SELECT * FROM ".$prefix."_croster_config WHERE config_name='bcolor' OR config_name='rcolor' OR config_name='hcolor'";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$db->sql_query("update ".$prefix."_croster_config set config_value='".$newcrfig[$config_name]."' WHERE config_name='".$config_name."'");	
}
Header("Location: ".$admin_file.".php?op=CRCColors");
} else {
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
echo "<form action='".$admin_file.".php?op=CRCColors&amp;update=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Clan Roster Colors</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Border Color</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='bcolor' value=".$crfig[bcolor]."><br /><a href='".$admin_file.".php?op=CRHexcolors'>Hex Colors List</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Row Color</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='rcolor' value=".$crfig[rcolor]."><br /><a href='".$admin_file.".php?op=CRHexcolors'>Hex Colors List</a></center></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='50%'><center>Text Heading Color</center></td>\n";
echo "<td width='50%'><center><input type='text' size='35' name='hcolor' value=".$crfig[hcolor]."><br /><a href='".$admin_file.".php?op=CRHexcolors'>Hex Colors List</a></center></td>\n";
echo "</tr>";
echo "</table><br>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
