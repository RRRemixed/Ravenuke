<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$membercount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members"));
$activemembercount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active = '1'"));
OpenTable();
//Active Members
if($membercount == 0){
echo "<center>Be sure to read through all the configurations carefully before adding members<br /><br />[&nbsp;<a href='".$admin_file.".php?op=CRConfig'>Go to Configuration</a>&nbsp;]</center>";
}else{
if($activemembercount >= 1){		
$colcount = 5;
if($crfig['cgames'] == 1){
$colcount = $colcount+1;}
if($crfig['cranks'] == 1){
$colcount = $colcount+1;}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='$colcount' class='option'><b><font color='$crfig[hcolor]'>Active Members</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td align='center' nowrap>User ID</td><td align='center'>Username</td><td align='center'>Clan Username</td>";
if($crfig['cgames'] == 1){
echo "<td align='center'>Game</td>";
}
if($crfig['cranks'] == 1){
echo "<td align='center'>Clan Rank</td>";
}
echo "<td align='center'>Join Date</td><td align='center'>Options</td>";
echo "</tr>";
$sql = "SELECT * FROM ".$prefix."_croster_members where active = '1'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$gid = intval($row['gid']);
$rid = intval($row['rid']);
$username = $row['username'];
$cusername = $row['cusername'];
$jdate = $row['jdate'];
$jdate = date("m-d-Y",$jdate);
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle = $row2['gtitle'];
$gabbrev = $row2['gabbrev'];
$gimage = $row2['gimage'];
if($crfig['ugimg'] == 1){
$gout = "<img src='$crfig[gamepath]/$gimage' alt='$gtitle'>";
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
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td align='center'>$uid</td><td align='center'>$username</td><td align='center'>$crfig[ctag]$cusername</td>";
if($crfig['cgames'] == 1){
echo "<td align='center'>$gout</td>";
}
if($crfig['cranks'] == 1){
echo "<td align='center'>$rout</td>";
}
echo "<td align='center'>$jdate</td>";
echo "<td align='center'><a href='".$admin_file.".php?op=CREditusers&amp;uid=$uid&amp;username=$username&amp;edit=0' title='edit user profile'><img src='modules/$module_name/images/edituser.gif' border='0'></a>&nbsp;";
$hardcountmem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members_hardware where uid=$uid"));
if($crfig[uhard] == 1 && $hardcountmem == 1){ 
echo "<a href='".$admin_file.".php?op=CREdithardware&amp;uid=$uid&amp;username=$username&amp;edit=0' title='edit hardware profile'><img src='modules/$module_name/images/edithardware.gif' border='0'></a>&nbsp;";
}
$ribbons = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
if($crfig[cribbons] == 1 && $ribbons >= 1){ 
echo "<a href='".$admin_file.".php?op=CRUserribbons&amp;uid=$uid&amp;username=$username' title='edit ribbons'><img src='modules/$module_name/images/editribbons.gif' alt='edit users ribbons' border='0'></a>";
}
echo "&nbsp;<a href='".$admin_file.".php?op=CRDeleteuser&amp;uid=$uid&amp;username=$username&amp;deleteuser=0' title='delete user'><img src='modules/$module_name/images/deleteuser.gif' border='0'></a></td>";
echo "</tr>";
}
echo"</table></center";
}else{
echo "<center>There are no Active Members</center>";
}
CloseTable();
//InActive Members
OpenTable();
$membercount2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members WHERE active = '0'"));
if($membercount2 == 0){
echo "<center>There are no inactive members</center>";
}else{	
$colcount = 5;
if($crfig['cgames'] == 1){
$colcount = $colcount+1;}
if($crfig['cranks'] == 1){
$colcount = $colcount+1;}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='$colcount' class='option'><b><font color='$crfig[hcolor]'>Inactive Members</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td align='center' nowrap>User ID</td><td align='center'>Username</td><td align='center'>Clan Username</td>";
if($crfig['cgames'] == 1){
echo "<td align='center'>Game</td>";
}
if($crfig['cranks'] == 1){
echo "<td align='center'>Clan Rank</td>";
}
echo "<td align='center'>Join Date</td><td align='center'>Options</td>";
echo "</tr>";
$sql = "SELECT * FROM ".$prefix."_croster_members where active = '0'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$gid = intval($row['gid']);
$rid = intval($row['rid']);
$username = $row['username'];
$cusername = $row['cusername'];
$jdate = $row['jdate'];
$jdate = date("m-d-Y",$jdate);
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle = $row2['gtitle'];
$gabbrev = $row2['gabbrev'];
$gimage = $row2['gimage'];
if($crfig['ugimg'] == 1){
$gout = "<img src='$crfig[gamepath]/$gimage' alt='$gtitle'>";
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
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td align='center'>$uid</td><td align='center'>$username</td><td align='center'>$crfig[ctag]$cusername</td>";
if($crfig['cgames'] == 1){
echo "<td align='center'>$gout</td>";
}
if($crfig['cranks'] == 1){
echo "<td align='center'>$rout</td>";
}
echo "<td align='center'>$jdate</td>";
echo "<td align='center'><a href='".$admin_file.".php?op=CREditusers&amp;uid=$uid&amp;username=$username&amp;edit=0'><img src='modules/$module_name/images/edituser.gif' alt='edit users profile' border='0'></a>&nbsp;";
$hardcountmem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members_hardware where uid=$uid"));
if($crfig[uhard] == 1 && $hardcountmem == 1){ 
echo "<a href='".$admin_file.".php?op=CREdithardware&amp;uid=$uid&amp;username=$username&amp;edit=0'><img src='modules/$module_name/images/edithardware.gif' alt='edit users hardware profile' border='0'></a>&nbsp;";
}
$ribbons = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons"));
if($crfig[cribbons] == 1 && $ribbons >= 1){ 
echo "<a href='".$admin_file.".php?op=CRUserribbons&amp;uid=$uid&amp;username=$username'><img src='modules/$module_name/images/editribbons.gif' alt='edit users ribbons' border='0'></a>";
}
echo "&nbsp;<a href='".$admin_file.".php?op=CRDeleteuser&amp;uid=$uid&amp;username=$username&amp;deleteuser=0'><img src='modules/$module_name/images/deleteuser.gif' alt='delete user' border='0'></a></td>";
echo "</tr>";
}
echo"</table></center";
}
}
CloseTable();
?>
