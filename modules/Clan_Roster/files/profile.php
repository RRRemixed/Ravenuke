<?php
if (!defined('MODULE_FILE')) { die ("You can't access this file directly..."); } 
global $db, $prefix, $admin_file, $nukeurl, $cookie;
$module_name = "Clan_Roster";
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
//User Profile
$rowcount = 6;
if($crfig['cgames'] == 1){
$rowcount = $rowcount+1;}
if($crfig['cranks'] == 1){
$rowcount = $rowcount+1;}
if($crfig['aage'] == 1){
$rowcount = $rowcount+2;}
if($crfig['aloc'] == 1){
$rowcount = $rowcount+1;}
if($crfig['aflags'] == 1){
$rowcount = $rowcount+1;}
if($crfig['aemail'] == 1){
$rowcount = $rowcount+1;}
if($crfig['afb'] == 1){
$rowcount = $rowcount+1;}
if($crfig['atw'] == 1){
$rowcount = $rowcount+1;}
if($crfig['askype'] == 1){
$rowcount = $rowcount+1;}
if($crfig['asteam'] == 1){
$rowcount = $rowcount+1;}
if($crfig['astatus'] == 1){
$rowcount = $rowcount+1;}
if($crfig['asite'] == 1){
$rowcount = $rowcount+1;}
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='3' class='option'><b><font color='$crfig[hcolor]'>User Profile</font></b></td></tr>\n";
$uid = $_GET['uid'];
$sql = "SELECT * FROM ".$prefix."_croster_members where uid='$uid'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$gid = intval($row['gid']);
$rid = intval($row['rid']);
$fid = intval($row['fid']);
$username = $row['username'];
$flags = "SELECT fname FROM ".$prefix."_croster_flags where fid='$fid'";
$flags2 = $db->sql_query($flags);
while($flags3 = $db->sql_fetchrow($flags2)){
$fname = $flags3['fname'];
}
$username = $row['username'];
$cusername = $row['cusername'];
$mimage = $row['mimage'];
$location = $row['location'];
$birthday = $row['birthday'];
$birthmonth = $row['birthmonth'];
$birthyear = $row['birthyear'];
$birthday2 = $birthday."-".$birthmonth."-".$birthyear;
$age = do_age($birthday, $birthmonth, $birthyear);
if($age == 2008){
$age = "0";}
$interests = $row['interests'];
$ogames = $row['ogames'];
$email = $row['email'];
$fb = $row['fb'];
$tw = $row['tw'];
$skype = $row['skype'];
$steam = $row['steam'];
$website = $row['website'];
if($crfig[cspam] == 1){
$puid = $cookie[0];
$pusername = $cookie[1];	
$bgcolor = str_replace('#','',$crfig[bcolor]);
$tcolor = str_replace('#','',$crfig[hcolor]);
if($email != "" && $puid > 1){
$email = "<a href='mailto:$email'><img src='modules/$module_name/files/protect.php?protect_string=$email&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($email != ""){	
$email = "<img src='modules/$module_name/files/protect.php?protect_string=$email&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}
if($fb != "" && $puid > 1){
$fb = "<a href='$fb'><img src='modules/$module_name/files/protect.php?protect_string=$fb&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($fb != ""){		
$fb = "<img src='modules/$module_name/files/protect.php?protect_string=$fb&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}	
if($tw != "" && $puid > 1){
$tw = "<a href='$tw'><img src='modules/$module_name/files/protect.php?protect_string=$tw&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($tw != ""){		
$tw = "<img src='modules/$module_name/files/protect.php?protect_string=$tw&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}	
if($skype != "" && $puid > 1){
$skype = "<a href='$skype'><img src='modules/$module_name/files/protect.php?protect_string=$skype&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($skype != ""){		
$skype = "<img src='modules/$module_name/files/protect.php?protect_string=$skype&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}
if($steam != "" && $puid > 1){
$steam = "<a href='$steam'><img src='modules/$module_name/files/protect.php?protect_string=$steam&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($steam != ""){	
$steam = "<img src='modules/$module_name/files/protect.php?protect_string=$steam&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}
if($website != "" && $puid > 1){
$website = "<a href='$website'><img src='modules/$module_name/files/protect.php?protect_string=$website&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'></a>";
}else{
if($website != ""){	
$website = "<img src='modules/$module_name/files/protect.php?protect_string=$website&amp;bgcolor=$bgcolor&amp;tcolor=$tcolor' border='0'>";
}
}
}else{
$email = "<a href='mailto:$email'>$email</a>";
$fb = "<a href='$fb'</a>";
$tw = "<a href='$tw'</a>";
$skype = "<a href='$skype'</a>";
$steam = "<a href='$steam'</a>";
$website = "<a href='$website'</a>";
}	
$active = $row['active'];
if($active == 1){
$active = "Active";	
$active = "<font color='green'>$active</font>";
}else{
$active = "InActive";	
$active = "<font color='red'>$active</font>";
}	
$jdate = $row['jdate'];
$jdate = date("d-m-Y",$jdate);
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle = $row2['gtitle'];
$gabbrev = $row2['gabbrev'];
$gimage = $row2['gimage'];
$sql3 = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$rid'";
$result3 = $db->sql_query($sql3);
$row3 = $db->sql_fetchrow($result3);
$rtitle = $row3['rtitle'];
$rimage = $row3['rimage'];
if($crfig[amemscreens] == 1 && $mimage != ""){
echo "<SCRIPT LANGUAGE=\"JavaScript\">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval(\"page\" + id + \" = window.open(URL, '\" + id + \"', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600');\");
}
// End -->
</SCRIPT>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='255' style='border-top: 1px solid $crfig[bcolor];' align='center' rowspan='$rowcount'>";
echo "<A HREF=\"javascript:popUp('$crfig[amempath]/$mimage')\"><img src='$crfig[amemthbpath]/$mimage' style='border-width: 2px;  border-style: solid; border-color: $crfig[bcolor];'></a><br />Thumbnail Preview</td>";
echo "</tr>";
}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Site Username</center></td>\n";
echo "<td>$username</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Clan Username</center></td>\n";
echo "<td>$crfig[ctag]$cusername</td>\n";
echo "</tr>";
if($crfig['cgames'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Game</center></td>\n";
echo "<td>$gtitle</td>\n";
echo "</tr>";}
if($crfig['cranks'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Clan Rang</center></td>\n";
echo "<td>$rtitle</td>\n";
echo "</tr>";}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Join Date</center></td>\n";
echo "<td>$jdate</td>\n";
echo "</tr>";
if($crfig['astatus'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Status</center></td>\n";
echo "<td>$active</td>\n";
echo "</tr>";}
if($crfig['aage'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Age</center></td>\n";
echo "<td>$age</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Birthday</center></td>\n";
echo "<td>$birthday2</td>\n";
echo "</tr>";}
if($crfig['aloc'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Location</center></td>\n";
echo "<td>$location</td>\n";
echo "</tr>";}
if($crfig['aflags'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Country</center></td>\n";
echo "<td>$fname</td>\n";
echo "</tr>";}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Interests</center></td>\n";
echo "<td>$interests</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Other Games</center></td>\n";
echo "<td>$ogames</td>\n";
echo "</tr>";
if($crfig['aemail'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Email Contact</center></td>\n";
echo "<td>$email</td>\n";
echo "</tr>";}
if($crfig['afb'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Facebook</center></td>\n";
echo "<td>$fb</td>\n";
echo "</tr>";}
if($crfig['atw'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Tweeter</center></td>\n";
echo "<td>$tw</td>\n";
echo "</tr>";}
if($crfig['askype'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Skype</center></td>\n";
echo "<td>$skype</td>\n";
echo "</tr>";}
if($crfig['asteam'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Steam</center></td>\n";
echo "<td>$steam</td>\n";
echo "</tr>";}
if($crfig['asite'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Website</center></td>\n";
echo "<td>$website</td>\n";
echo "</tr>";}
}
echo "</table>";
echo "<br />";
//Ribbons
if($crfig[cribbons] == 1){
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='4' class='option'><b><font color='$crfig[hcolor]'>Ribbons/Awards</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
$i = 1;
$sql2 = "SELECT cribid, ribtitle, ribimage FROM ".$prefix."_croster_ribbons ORDER BY cribid ASC";
$result2 = $db->sql_query($sql2);
while(list($cribid, $ribtitle, $ribimage) = $db->sql_fetchrow($result2)){
$uid = $uid;
$ribprefix = "rib";
$sql3 = $db->sql_query("SELECT * FROM ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." WHERE uid='$uid' LIMIT 1") OR die("Could not do sql2");
$anumrows = $db->sql_numrows($sql3);
if ($anumrows >= 1){
$stoploop = 1;
echo "<td width='25%'><center>";
if ($crfig[uribimg] == 1) {
$ribimage2 = "<img src='$crfig[ribbonpath]/$ribimage' alt='not found'>";
if($ribimage != ""){	
echo "<center>$ribimage2\n";
}else{
echo "\n";
}	
}
echo "<br \>$ribtitle</center></td>\n";
$i++;
if($i == 5){ 
echo "</tr><tr bgcolor='$crfig[rcolor]'>"; 
$i = 1;
	}
		}
			}
//Stop Loop if stoploop is 0			
$stoploop = intval($stoploop);
if($stoploop == 0){
echo "<td><center>$crfig[ctag]$cusername has no ribbons</center></td>";	
} elseif ($i == 2) { 
echo "<td width='25%'></td>\n";
echo "<td width='25%'></td>\n";
echo "<td width='25%'></td>\n";
echo "</tr>\n"; 
} elseif ($i == 3) { 
echo "<td width='25%'></td>\n";
echo "<td width='25%'></td>\n";
echo "</tr>\n"; 
} elseif ($i == 4) { 
echo "<td width='25%'></td>"; 
} else { 
echo "</tr>";
}
echo "</table>";
echo "<br />";
}
//Hardware Profile
$rowcount = 1;
if($crfig['uboard'] == 1){
$rowcount = $rowcount+1;}
if($crfig['uproc'] == 1){
$rowcount = $rowcount+1;}
if($crfig['umon'] == 1){
$rowcount = $rowcount+2;}
if($crfig['uprimhd'] == 1){
$rowcount = $rowcount+1;}
if($crfig['usechd'] == 1){
$rowcount = $rowcount+1;}
if($crfig['ugraph'] == 1){
$rowcount = $rowcount+1;}
if($crfig['uram'] == 1){
$rowcount = $rowcount+1;}
if($crfig['umouse'] == 1){
$rowcount = $rowcount+1;}
if($crfig['ukey'] == 1){
$rowcount = $rowcount+1;}
if($crfig['ucase'] == 1){
$rowcount = $rowcount+1;}
$hardcount = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members_hardware where uid='$uid'"));
if($crfig[uhard] == 1 && $hardcount == 1){
$sqlhardcheck = "SELECT motherboard, processor FROM ".$prefix."_croster_members_hardware where uid='$uid'";
$resulthardcheck = $db->sql_query($sqlhardcheck);
$check = $db->sql_fetchrow($resulthardcheck);
$checkmother = $check['motherboard'];
$checkprocess = $check['processor'];
if($checkmother != "" || $checkprocess != ""){
echo "<center><table width='100%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='3' class='option'><b><font color='$crfig[hcolor]'>Hardware Profile</font></b></td></tr>\n";
$sqlhard = "SELECT * FROM ".$prefix."_croster_members_hardware where uid='$uid'";
$resulthard = $db->sql_query($sqlhard);
while($row = $db->sql_fetchrow($resulthard)){
$hardimage = $row['hardimage'];
$motherboard = $row['motherboard'];
$processor = $row['processor'];
$monitor = $row['monitor'];
$primhd = $row['primhd'];
$sechd = $row['sechd'];
$graphics = $row['graphics'];
$ram = $row['ram'];
$mouse = $row['mouse'];
$keyboard = $row['keyboard'];
$casing = $row['casing'];
if($crfig[uhardscreens] == 1 && $hardimage != ""){
echo "<SCRIPT LANGUAGE=\"JavaScript\">
<!-- Begin
function popUp(URL) {
day = new Date();
id = day.getTime();
eval(\"page\" + id + \" = window.open(URL, '\" + id + \"', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=800,height=600');\");
}
// End -->
</SCRIPT>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='255' style='border-top: 1px solid $crfig[bcolor];' align='center' rowspan='$rowcount'>";
echo "<A HREF=\"javascript:popUp('$crfig[uhardpath]/$hardimage')\"><img src='$crfig[uhardthbpath]/$hardimage' style='border-width: 2px;  border-style: solid; border-color: $crfig[bcolor];'></a><br />Thumbnail Preview</td>";
echo "</tr>";
}
if($crfig['uboard'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Motherboard</center></td>\n";
echo "<td>$motherboard</td>\n";
echo "</tr>";}
if($crfig['uproc'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Processor</center></td>\n";
echo "<td>$processor</td>\n";
echo "</tr>";}
if($crfig['umon'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Monitor</center></td>\n";
echo "<td>$monitor</td>\n";
echo "</tr>";}
if($crfig['uprimhd'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Primary Hard Drive</center></td>\n";
echo "<td>$primhd</td>\n";
echo "</tr>";}
if($crfig['usechd'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Secondary Hard Drive</center></td>\n";
echo "<td>$sechd</td>\n";
echo "</tr>";}
if($crfig['ugraph'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Graphics</center></td>\n";
echo "<td>$graphics</td>\n";
echo "</tr>";}
if($crfig['uram'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Ram</center></td>\n";
echo "<td>$ram</td>\n";
echo "</tr>";}
if($crfig['umouse'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Mouse</center></td>\n";
echo "<td>$mouse</td>\n";
echo "</tr>";}
if($crfig['ukey'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Keyboard</center></td>\n";
echo "<td>$keyboard</td>\n";
echo "</tr>";}
if($crfig['ucase'] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td nowrap><center>Case</center></td>\n";
echo "<td>$casing</td>\n";
echo "</tr>";}
}
echo "</table>";
}
}
?>
