<?php
if (!defined('MODULE_FILE')) { die ("You can't access this file directly..."); } 
global $db, $prefix, $admin_file, $cookie;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>$crfig[ctag]&nbsp;Clan Roster</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center' valign='middle'>\n";
echo "<td width='50%' valign='middle'><center>";
echo "<br /><form action='modules.php?name=$module_name&amp;op=dosort' method='post'>";
echo "<select name='sort'>";
echo "<option value='cusername'>Member Name</option>";
$gamecount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_games"));
if($crfig['cgames'] == 1 && $gamecount != 1){
echo "<option value='gid'>Game</option>";
}
if($crfig['cranks'] == 1){
echo "<option value='rid'>Rank</option>";
}
echo "<option value='jdate'>Join Date</option>";
if($crfig['aage'] == 1){
echo "<option value='birthyear'>Age</option>";
}
if($crfig['cnactive'] == 1 && $crfig['cstatus'] == 1){
echo "<option value='active'>Status</option>";
}
if($crfig['aflags'] == 1 && $crfig['cflags'] == 1){
echo "<option value='fid'>Country</option>";
}
echo "</select>&nbsp;<select name='order'>";
echo "<option value='ASC'>Ascending</option>";
echo "<option value='DESC'>Descending</option>";
echo "</select>";
echo "&nbsp;<input type='submit' value='Sort'>";
echo "</form>";
echo "</center></td>\n";
echo "<td width='50%' valign='middle'><center>";
echo "<br /><form action='modules.php?name=$module_name&amp;op=dosearch' method='post'>";
echo "<input type='text' size='30' name='crmsearch'>&nbsp;";
echo "<input type='submit' value='Search For Member'>";
echo "</form>";
echo "</center></td>\n";
echo "</tr>";
echo "</table>";
if($crfig[cgames] == 1 && $gamecount > 1){
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";	
echo "<tr><td align='center' colspan='$gamecount' class='option'></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center' valign='middle'>\n";	
$sql2 = "SELECT * FROM ".$prefix."_croster_games ORDER BY cgid ASC";
$result2 = $db->sql_query($sql2);
while(list($cgid, $gtitle, $gabbrev, $gimage) = $db->sql_fetchrow($result2)){
if($crfig['ugimg'] == 1){
$gout = "<img src='$crfig[gamepath]/$gimage' alt='$gtitle' border='0'>";
}elseif($crfig['ugabbrev'] == 1){
$gout = $gabbrev;
}else{
$gout = $gtitle;
}
if($crfig['cnactive'] == 1){
$gamecountpergame = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE gid='$cgid'"));
}else{	
$gamecountpergame = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE gid='$cgid' AND active='1'"));
}
if($gamecountpergame >= 1){
echo "<td valign='middle'><center><a href='modules.php?name=$module_name&amp;op=dosortgame&amp;cgid=$cgid'>$gout</a><br /><b>Members</b>&nbsp;$gamecountpergame</center></td>";
}else{
echo "<td valign='middle'><center>$gout<br /><b>Members</b>&nbsp;$gamecountpergame</center></td>";
}
}
echo "</tr></table>";
}
?>
