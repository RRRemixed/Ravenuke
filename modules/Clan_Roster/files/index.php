<?php

if (!defined('MODULE_FILE')) { die ("You can't access this file directly..."); } 
global $db, $prefix, $admin_file, $cookie;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$colcount = 2;
if($crfig['cgames'] == 1){
$colcount = $colcount+1;}
if($crfig['cranks'] == 1){
$colcount = $colcount+1;}
if($crfig['aage'] == 1){
$colcount = $colcount+1;}
if($crfig['aloc'] == 1 && $crfig['cloc'] == 1){
$colcount = $colcount+1;}
if($crfig['aflags'] == 1 && $crfig['cflags'] == 1){
$colcount = $colcount+1;}
if($crfig['cstatus'] == 1){
$colcount = $colcount+1;}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='$colcount' class='option'><b><font color='$crfig[hcolor]'></font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td align='".$crfig['calign']."'>Clan Username</td>\n";
if($crfig['cgames'] == 1){
echo "<td align='".$crfig['calign']."'>Game</td>\n";
}
if($crfig['cranks'] == 1){
echo "<td align='".$crfig['calign']."'>Clan Rank</td>\n";
}
echo "<td align='".$crfig['calign']."'>Join Date</td>\n";
if($crfig['aage'] == 1){
echo "<td align='".$crfig['calign']."'>Age</td>\n";
}
if($crfig['cstatus'] == 1){
echo "<td align='".$crfig['calign']."'>Status</td>\n";
}
if($crfig['aloc'] == 1 && $crfig['cloc'] == 1){
echo "<td align='".$crfig['calign']."'>Location</td>\n";
}
if($crfig['aflags'] == 1 && $crfig['cflags'] == 1){
echo "<td align='".$crfig['calign']."'>Country</td>\n";
}
echo "</tr>";
if($crfig['cnactive'] == 1){
$sql = "SELECT * FROM ".$prefix."_croster_members ORDER BY mid ASC";
}else{
$sql = "SELECT * FROM ".$prefix."_croster_members WHERE active = '1' ORDER BY mid ASC";
}
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$gid = intval($row['gid']);
$rid = intval($row['rid']);
$fid = intval($row['fid']);
$flags = "SELECT fimage FROM ".$prefix."_croster_flags where fid='$fid'";
$flags2 = $db->sql_query($flags);
while($flags3 = $db->sql_fetchrow($flags2)){
$fimage = $flags3['fimage'];
}
$username = $row['username'];
$cusername = $row['cusername'];
$mimage = $row['mimage'];
$location = $row['location'];
$birthday = $row['birthday'];
$birthmonth = $row['birthmonth'];
$birthyear = $row['birthyear'];
$age = do_age($birthday, $birthmonth, $birthyear);
$interests = $row['interests'];
$ogames = $row['ogames'];
$email = $row['email'];
$fb = $row['fb'];
$tw = $row['tw'];
$skype = $row['skype'];
$steam = $row['steam'];
$jdate = $row['jdate'];
$active = $row['active'];
$jdate = date("d-m-Y",$jdate);
$website = $row['website'];
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle = $row2['gtitle'];
$gabbrev = $row2['gabbrev'];
$gimage = $row2['gimage'];
if($crfig['ugimg'] == 1){
$gout = "<img src='$crfig[gamepath]/$gimage' alt='$gtitle' border='0'>";
}elseif($crfig['ugabbrev'] == 1){
$gout = $gabbrev;
}else{
$gout = $gtitle;
}	
$sql3 = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$rid'";
$result3 = $db->sql_query($sql3);
$row3 = $db->sql_fetchrow($result3);
$rtitle = $row3['rtitle'];
$rimage = $row3['rimage'];
if($crfig['urimg'] == 1){
$rout = "<img src='$crfig[rankpath]/$rimage' alt='$rtitle'>";
}else{
$rout = $rtitle;
}	
echo "<tr bgcolor='$crfig[rcolor]' align='center'>\n";
echo "<td align='".$crfig['calign2']."'><a href='modules.php?name=$module_name&amp;op=profile&amp;uid=$uid&amp;username=$username'>$crfig[ctag]$cusername</a></td>\n";
if($crfig['cgames'] == 1){
echo "<td align='".$crfig['calign2']."'>$gout</td>\n";
}
if($crfig['cranks'] == 1){
echo "<td align='".$crfig['calign2']."'>$rout</td>\n";
}
echo "<td align='".$crfig['calign2']."'>$jdate</td>\n";
if($crfig['aage'] == 1){
echo "<td align='".$crfig['calign2']."'>$age</td>\n";
}
if($crfig['cstatus'] == 1){
if($active == 1){
$active = "<font color='green'>Active</font>";
}else{
$active = "<font color='red'>Inactive</font>";
}	
echo "<td align='".$crfig['calign2']."'>$active</td>\n";
}
if($crfig['aloc'] == 1 && $crfig['cloc'] == 1){
echo "<td align='".$crfig['calign2']."'>$location</td>\n";
}
if($crfig['aflags'] == 1 && $crfig['cflags'] == 1){
echo "<td align='".$crfig['calign2']."'><img src='modules/$module_name/images/flags/$fimage'></td>\n";
}
echo "</tr>";
}
echo "</table>";
?>
