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
if ($crfig[cgames] == 1) {
echo "<form action='".$admin_file.".php?op=CRGametypesdb' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Add Gametype</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Game Title</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='gtitle'><br \><font color='red'>REQUIRED</font></td>\n";
echo "</tr>";
if ($crfig[ugabbrev] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Game Abbreviation</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='gabbrev'></td>\n";
echo "</tr>";}
if ($crfig[ugimg] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Game Icon Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><b>Suggested</b> Scaling your images to 24x24 pixels<br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font></td>\n";
echo "</tr>";}
echo "</table><br \>";
echo "<input type='submit' name='submit' value='Add Game'></center>";
echo "</form>"; 
CloseTable();
OpenTable();
$gamescount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_games"));
if($gamescount >= 1){
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='4' class='option'><b><font color='$crfig[hcolor]'>Current Games</font></b></td></tr>\n";
$sql2 = "SELECT * FROM ".$prefix."_croster_games ORDER BY cgid ASC";
$result2 = $db->sql_query($sql2);
while(list($cgid, $gtitle, $gabbrev, $gimage) = $db->sql_fetchrow($result2)){
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td width='33%'><center>$gtitle</td>\n";
if ($crfig[ugabbrev] == 1){
echo "<td width='33%'><center>$gabbrev</td>\n";
}else{
echo "<td width='33%'><center>Disabled</center></td>\n";
}
if ($crfig[ugimg] == 1){
echo "<td width='33%'><center><img src='$crfig[gamepath]/$gimage' alt='no image'></center></td>\n";
}else{
echo "<td width='33%'><center>Disabled</center></td>\n";
}
echo "<td width='33%'><center>[&nbsp;<a href='".$admin_file.".php?op=CRGametypesdbedit&amp;cgid=$cgid&amp;edit=0'>Edit</a>&nbsp;-&nbsp;<a href='".$admin_file.".php?op=CRGametypesdbdel&amp;cgid=$cgid&amp;ok=0'>Delete</a>&nbsp;]</center></td>\n";
echo "</tr>";
}
echo "</table></center>";
}else{
echo "<center><b>No Games have been added</b></center>";
}
}else{
echo "<center><font color='red'><b>ERROR!</b></font><br \>You Must Enable Game Types in the Roster Configuration<br \><br \><b>[&nbsp;<a href='".$admin_file.".php?op=CRCGames'>Games Configuration Menu</a>&nbsp;]</b></center>";
}
CloseTable();
?>
