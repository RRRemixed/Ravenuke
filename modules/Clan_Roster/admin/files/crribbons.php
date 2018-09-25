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
if ($crfig[cribbons] == 1) {
echo "<form action='".$admin_file.".php?op=CRRibbonsdb' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Add Ribbon</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Ribbon Title</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='ribtitle'><br \><font color='red'>REQUIRED</font></td>\n";
echo "</tr>";
if ($crfig[uribdesc] == 1) {
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Ribbon Description</center></td>\n";
echo "<td width='50%'><textarea name='ribdesc' rows='7' cols='32'></textarea></td>\n";
echo "</tr>";}
if ($crfig[uribimg] == 1) {
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Ribbon Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font></td>\n";
echo "</tr>";
}
echo "</table><br \>";
echo "<input type='submit' name='submit' value='Add Ribbon'></center>";
echo "</form>"; 
CloseTable();
OpenTable();
$ribboncount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
if($ribboncount >= 1){
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='3' class='option'><b><font color='$crfig[hcolor]'>Current Ribbons</font></b></td></tr>\n";
$sql2 = "SELECT * FROM ".$prefix."_croster_ribbons ORDER BY cribid ASC";
$result2 = $db->sql_query($sql2);
while(list($cribid, $ribtitle, $ribimage, $ribdesc) = $db->sql_fetchrow($result2)){
$ribtitle = addslashes($ribtitle);
$ribdesc = addslashes($ribdesc);
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='33%'><center><b>$ribtitle</b><br \>$ribdesc</td>\n";
if ($crfig[uribimg] == 1) {
$ribimage2 = "<img src='$crfig[ribbonpath]/$ribimage' alt='not found'>";
if($ribimage != ""){	
echo "<td width='33%'><center>$ribimage2</center></td>\n";
}else{
echo "<td width='33%'><center>No Image</center></td>\n";
}	
}else{
echo "<td width='33%'><center>Disabled</center></td>\n";	
}
echo "<td width='33%'><center>[&nbsp;<a href='".$admin_file.".php?op=CRRibbonsdbedit&amp;cribid=$cribid&amp;edit=0'>Edit</a>&nbsp;-&nbsp;<a href='".$admin_file.".php?op=CRRibbonsdbdel&amp;cribid=$cribid&amp;ok=0'>Delete</a>&nbsp;]</center></td>\n";
echo "</tr>";
}
echo "</table></center>";
}else{
echo "<center><b>No Ribbons have been added</b></center>";
}
}else{
echo "<center><font color='red'><b>ERROR!</b></font><br \>You Must Enable Clan Ribbons in the Roster Configuration<br \><br \><b>[&nbsp;<a href='".$admin_file.".php?op=CRCRibbons'>Ribbons Configuration Menu</a>&nbsp;]</b></center>";
}
CloseTable();
?>
