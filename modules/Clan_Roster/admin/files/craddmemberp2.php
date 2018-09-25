<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
OpenTable();
global $db, $prefix, $admin_file, $module_name;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
if($update == 1){
$uid = $_POST['uid'];
if($crfig[cgames] == 1 && $gid == 0){
echo "<center><b>You must select a game</b><br />"._GOBACK."</center>";
}elseif($crfig[cranks] == 1 && $rid == 0){
echo "<center><b>You must select a rank</b><br />"._GOBACK."</center>";
}elseif($month == "" || $day == "" || $year == ""){
echo "<center><b>You must select a join date</b><br />"._GOBACK."</center>";
}else{	
$jdate = mktime(0,0,0,$month,$day,$year);
$sql = $db->sql_query("INSERT INTO ".$prefix."_croster_members (mid,uid,gid,rid,cusername,username,jdate,active,email,fb,tw,skype,steam,website)values(NULL,'$uid','$gid','$rid','$uname','$cusername','$jdate','$active','$email','$fb','$tw','$skype','$steam','$website')") OR die("Could Not Insert SQL");
if($hardprofile == 1){
$sql2 = $db->sql_query("INSERT INTO ".$prefix."_croster_members_hardware (hid,uid,username)values(NULL,'$uid','$uname')") OR die("Could Not Insert SQL");	
}
if ($addanother == 1){
Header("Location: ".$admin_file.".php?op=CRAddmember");
}else{
Header("Location: ".$admin_file.".php?op=CRMain");
}
}
}else{
$uid = $_GET['uid'];
$result = $db->sql_query("SELECT username, user_email, user_website, user_fb, user_tw, user_skype, user_steam FROM ".$user_prefix."_users WHERE user_id='$uid'");
$row = $db->sql_fetchrow($result);
$uname = $row['username'];
$email = $row['user_email'];
$fb = $row['user_fb'];
$tw = $row['user_tw'];
$skype = $row['user_skype'];
$steam = $row['user_steam'];
$website = $row['user_website'];

echo "<form action='".$admin_file.".php?op=CRAddmemberp2&amp;update=1' method='post'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Add Member</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>User ID</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='uid' value='$uid' readonly><br \>Read Only</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>UserName</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='uname' value='$uname' readonly><br \>Read Only</td>\n";
echo "</tr>";
if ($crfig[cgames] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Game Selection 1</center></td>\n";
echo "<td width='50%'><select name='gid'>";
echo "<option value=''>------</option>\n";
$sql = "SELECT cgid, gtitle FROM ".$prefix."_croster_games";
$result = $db->sql_query($sql);
while(list($cgid, $gtitle) = $db->sql_fetchrow($result)){
echo "<option value='$cgid'>$gtitle</option>\n";
}	
echo "</select></td>";
echo "</tr>";
}
if ($crfig[cranks] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Clan Rank Selection</center></td>\n";
echo "<td width='50%'><select name='rid'>";
echo "<option value=''>------</option>\n";
$sql = "SELECT * FROM ".$prefix."_croster_ranks";
$result = $db->sql_query($sql);
while(list($crid, $rtitle, $rimg) = $db->sql_fetchrow($result)){
echo "<option value='$crid'>$rtitle</option>\n";
}	
echo "</select></td>";
echo "</tr>";
}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Clan UserName</center></td>\n";
echo "<td width='50%'>$crfig[ctag]<input type='text' size='35' name='cusername' value='$uname'></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Join Date</center></td>\n";
echo "<td width='50%'>";
echo "<select name='day'>";
echo "<option value=\"\">--------</option>";
        $i = 1;
        while ($i <= 31) {
            $k = $i * 1;
            echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>&nbsp;&nbsp;";
echo "<select name='month'>";
echo "<option value=\"\">------------</option>";
echo "<option value=\"01\">JANVIER</option>";
echo "<option value=\"02\">FEVRIER</option>";
echo "<option value=\"03\">MARS</option>";
echo "<option value=\"04\">AVRIL</option>";
echo "<option value=\"05\">MAI</option>";
echo "<option value=\"06\">JUIN</option>";
echo "<option value=\"07\">JUILLET</option>";
echo "<option value=\"08\">AOUT</option>";
echo "<option value=\"09\">SEPTEMBRE</option>";
echo "<option value=\"10\">OCTOBRE</option>";
echo "<option value=\"11\">NOVEMBRE</option>";
echo "<option value=\"12\">DECEMBRE</option>";
echo "</select>&nbsp;&nbsp;";
echo "<select name='year'>";
echo "<option value=\"\">--------</option>";
        $i = date("Y")-5;
        $y = date("Y");
        while ($i <= $y) {
            $k = $i * 1;
            echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>";
echo "</td>\n";
echo "</tr>";
if($crfig[aemail] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Email Contact</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='email' value='$email'></td>\n";
echo "</tr>";}
if($crfig[afb] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Facebook</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='fb' value='$fb'></td>\n";
echo "</tr>";}
if($crfig[atw] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Tweeter</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='tw' value='$tw'></td>\n";
echo "</tr>";}
if($crfig[askype] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Skype</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='skype' value='$skype'></td>\n";
echo "</tr>";}
if($crfig[asteam] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Steam</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='steam' value='$steam'></td>\n";
echo "</tr>";}
if($crfig[asite] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Website</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='website' value='$website'></td>\n";
echo "</tr>";}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Set this user to active?</center></td>\n";
echo "<td width='50%'>Yes&nbsp;<input type='radio' name='active' value='1' CHECKED>&nbsp;No&nbsp;<input type='radio' name='active' value='0'></td>\n";
echo "</tr>";
if ($crfig[uhard] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Allow this user to have hardware profile?</center></td>\n";
echo "<td width='50%'>Yes&nbsp;<input type='radio' name='hardprofile' value='1' CHECKED>&nbsp;No&nbsp;<input type='radio' name='hardprofile' value='0'></td>\n";
echo "</tr>";}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Add Another Member After this one?</center></td>\n";
echo "<td width='50%'>Yes&nbsp;<input type='radio' name='addanother' value='1'>&nbsp;No&nbsp;<input type='radio' name='addanother' value='0'></td>\n";
echo "</tr>";
echo "</table>";
echo "<br \><input type='submit' value='ADD MEMBER'></form></center>";
}
CloseTable();
?>
