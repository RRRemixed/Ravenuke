<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $db, $prefix, $admin_file, $module_name;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
OpenTable();
$ribboncount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
if($crfig[cribbons] == 1 && $ribboncount > 0){
if ($award == 1){
$sql = "SELECT uid, username, cusername FROM ".$prefix."_croster_members WHERE username='$username'" OR die("Could not select username from Members");
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$username = $row['username'];
$cusername = $row['cusername'];
$ribprefix = "rib";
$sql = $db->sql_query("INSERT INTO ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." (cribid2,cribid,uid,username)values(NULL,'$cribid','$uid','$username')") OR die("Could Not Insert Ribbon SQL");
}
if ($sql){
echo "<center>Awarded Successfully<br \><br \>[&nbsp;<a href='".$admin_file.".php?op=CRUserribbons&amp;uid=$uid&amp;username=$username'>Go Back</a>&nbsp;]</center>";
}
}elseif($delete == 1){
$sql = "SELECT uid, username, cusername FROM ".$prefix."_croster_members WHERE username='$username'" OR die("Could not select username from Members");
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$username = $row['username'];
$cusername = $row['cusername'];
$ribprefix = "rib";
$sql = $db->sql_query("DELETE FROM ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." WHERE username='$username' AND cribid='$cribid'");
}
if ($sql){
echo "<center>Deleted Successfully<br \><br \>[&nbsp;<a href='".$admin_file.".php?op=CRUserribbons&amp;uid=$uid&amp;username=$username'>Go Back</a>&nbsp;]</center>";
}
}else{
$sql = "SELECT uid, username, cusername FROM ".$prefix."_croster_members WHERE username='$username'" OR die("Could not select username from Members");
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$uid = intval($row['uid']);
$username = $row['username'];
$cusername = $row['cusername'];	
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='3' class='option'><b><font color='$crfig[hcolor]'>".$crfig[ctag]."".$cusername."'s Ribbons Options</font></b></td></tr>\n";
$sql2 = "SELECT cribid, ribtitle, ribimage FROM ".$prefix."_croster_ribbons ORDER BY cribid ASC";
$result2 = $db->sql_query($sql2);
while(list($cribid, $ribtitle, $ribimage) = $db->sql_fetchrow($result2)){
$uid = $uid;
$username = $username;
$ribprefix = "rib";
$sql3 = $db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." WHERE username='$username'") OR die("Could not do sql2");
$anumrows = $db->sql_numrows($sql3);
if ($anumrows == 1){
$ribbonoption = "Delete Ribbon";
$ribbonoption = "<a href='".$admin_file.".php?op=CRUserribbons&amp;delete=1&amp;uid=$uid&amp;username=$username&amp;cribid=$cribid&amp;ribtitle=$ribtitle'>Delete Ribbon</a>";
}else{
$ribbonoption = "<a href='".$admin_file.".php?op=CRUserribbons&amp;award=1&amp;uid=$uid&amp;username=$username&amp;cribid=$cribid&amp;ribtitle=$ribtitle'>Award Ribbon</a>";
}	
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='33%'><center>$ribtitle</center></td>";
if ($crfig[uribimg] == 1) {
$ribimage2 = "<img src='$crfig[ribbonpath]/$ribimage' alt='not found'>";
if($ribimage != ""){	
echo "<td width='33%'><center>$ribimage2</center></td>\n";
}else{
echo "<td width='33%'><center>No Image</center></td>\n";
}
}	
echo "<td width='33%'><center>$ribbonoption</center></td>\n";
echo "</tr>";
}
echo "</table>";
}
}else{
echo "<center>Either Ribbons are disabled or You have not added any</center";
}
CloseTable();
?>
