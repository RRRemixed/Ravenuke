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
if ($crfig[cranks] == 1) {
echo "<form action='".$admin_file.".php?op=CRRanksdb' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Add Rank</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Rank Title</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='rtitle'><br \><font color='red'>REQUIRED</font></td>\n";
echo "</tr>";
if($crfig[urimg] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Rank Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font></td>\n";
echo "</tr>";}
echo "</table><br \>";
echo "<input type='submit' name='submit' value='Add Rank'></center>";
echo "</form>"; 
CloseTable();
OpenTable();
$rankscount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ranks"));
if($rankscount >= 1){
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='3' class='option'><b><font color='$crfig[hcolor]'>Current Ranks</font></b></td></tr>\n";
$sql2 = "SELECT * FROM ".$prefix."_croster_ranks ORDER BY crid ASC";
$result2 = $db->sql_query($sql2);
while(list($crid, $rtitle, $rimage) = $db->sql_fetchrow($result2)){
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='33%'><center>$rtitle</td>\n";
if($crfig[urimg] == 1){
echo "<td width='33%'><center><img src='$crfig[rankpath]/$rimage' alt='no image'></center></td>\n";
}else{
echo "<td width='33%'><center>Disabled</td>\n";
}
echo "<td width='33%'><center>[&nbsp;<a href='".$admin_file.".php?op=CRRanksdbedit&amp;crid=$crid&amp;edit=0'>Edit</a>&nbsp;-&nbsp;<a href='".$admin_file.".php?op=CRRanksdbdel&amp;crid=$crid&amp;ok=0'>Delete</a>&nbsp;]</center></td>\n";
echo "</tr>";
}
echo "</table></center>";
}else{
echo "<center><b>No Ranks have been added</b></center>";
}
}else{
echo "<center><b><font color='red'>ERROR!</font></b><br \>You Must Enable Clan Ranks in the Roster Configuration<br /><br /><b>[&nbsp;<a href='".$admin_file.".php?op=CRCRanks'>Ranks Configuration Menu</a>&nbsp;]</b></center>";
}
CloseTable();
?>
