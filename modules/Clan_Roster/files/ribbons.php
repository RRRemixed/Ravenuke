<?php
if (!defined('MODULE_FILE')) { die ("You can't access this file directly..."); } 
global $db, $prefix, $admin_file, $nukeurl;
$module_name = "Clan_Roster";
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$colcount = 2;
if($crfig[uribimg] == 1){
$colcount = $colcount+1;
}
if($crfig[uribdesc] == 1){
$colcount = $colcount+1;
}	
$ribboncount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
if($crfig[cribbons] == 1 && $ribboncount > 0){
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='$colcount' class='option'><center><b><font color='$crfig[hcolor]'>$crfig[ctag] Rubans/R&eacute;compense</font></b></center></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'><td width='20%'>Titre</td>";
if($crfig[uribimg] == 1){
echo "<td width='20%'>Image</td>";
}
if($crfig[uribdesc] == 1){
echo "<td width='30%'>Description</td>";}
echo "<td width='30%'>Utilisateurs r&eacute;compens&eacute;</td>";
echo "</tr>";
echo "<tr><td align='center' colspan='$colcount' class='option'><center></td></tr>\n";
$sql2 = "SELECT * FROM ".$prefix."_croster_ribbons ORDER BY cribid ASC";
$result2 = $db->sql_query($sql2);
while(list($cribid, $ribtitle, $ribimage, $ribdesc) = $db->sql_fetchrow($result2)){
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='20%'>$ribtitle</td>";
if ($crfig[uribimg] == 1) {
$ribimage2 = "<img src='$crfig[ribbonpath]/$ribimage' alt='not found'>";
if($ribimage != ""){	
echo "<td width='20%'><center>$ribimage2</center></td>\n";
}else{
echo "<td width='20%'><center>Pas d\'image</center></td>\n";
}	
}
if($crfig[uribdesc] == 1){
echo "<td width='30%'>$ribdesc</td>";
}
$ribprefix = "rib";
$i = 1;
$sql3 = "SELECT username FROM ".$prefix."_croster_ribbons_".$ribprefix."".$cribid."";
$result3 = $db->sql_query($sql3) OR die("Could not fetch users");
echo "<td width='20%' align='left'>";
$usercount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons_".$ribprefix."".$cribid.""));
if($usercount < 6){
echo "<div style=\"border: 1pt none; width: 98%; height: 75px; overflow-x: hidden; overflow-y: hidden;\">";
}else{
echo "<div style=\"border: 1pt none; width: 98%; height: 75px; overflow-x: hidden; overflow-y: scroll;\">";
}
while(list($username) = $db->sql_fetchrow($result3)){
$sql4 = "SELECT uid, username, cusername FROM ".$prefix."_croster_members where username='$username'";
$result4 = $db->sql_query($sql4) OR die("Could not fetch users");
$row4 = $db->sql_fetchrow($result4);
$uid = intval($row4['uid']);
$username = $row4['username'];
$cusername = $row4['cusername'];
if($i < 10){
$i = "0".$i;
}
echo "$i: <a href='modules.php?name=$module_name&amp;op=profile&amp;uid=$uid&amp;username=$username'>$crfig[ctag]$cusername</a><br />";
$i++;
}
echo "</div";
echo "</td></tr>\n";
}
echo "<tr><td align='center' colspan='$colcount' class='option'><center></td></tr>\n";
echo "</table>";
}
?>
