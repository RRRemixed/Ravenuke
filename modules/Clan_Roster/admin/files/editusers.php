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
if($deleteimage == 1){
$db->sql_query("update ".$prefix."_croster_members set mimage='' where mimage='$mimage'");
unlink($crfig[amempath]."/".$mimage);
unlink($crfig[amemthbpath]."/".$mimage);
Header("Location: $admin_file.php?op=CRMain");
}	
if($edit == 1){
$uid = $_POST['uid'];
$sql = "SELECT * FROM ".$prefix."_croster_members where uid='$uid'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
if($cgid == ""){
$cgid = intval($row['gid']);
}
if($crid == ""){
$crid = intval($row['rid']);
}
if($fid == ""){
$fid = $row['fid'];
}
if($joinday == "" || $joinmonth == "" || $joinyear == ""){
$jdate = $row['jdate'];
}else{
$jdate = mktime(0,0,0,$joinday,$joinmonth,$joinyear);
}
if($birthday == "" || $birthmonth == "" || $birthyear == ""){
$birthday = $row['birthday'];
$birthmonth = $row['birthmonth'];
$birthyear = $row['birthyear'];
}
$hardcountmem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members_hardware where uid=$uid"));
if($hardprofile == 1 && $hardcountmem == 0){
$sql2 = $db->sql_query("INSERT INTO ".$prefix."_croster_members_hardware (hid,uid,username)values(NULL,'$uid','$username')") OR die("Could Not Insert SQL");	
}elseif($hardprofile == 0 && $hardcountmem == 1){	
$sql2 = $db->sql_query("DELETE FROM ".$prefix."_croster_members_hardware WHERE uid='$uid'") OR die("Could Not Delete SQL");	
}
$interests = strip_tags($interests);
$ogames = strip_tags($ogames);
}
$jpeg = 'image/jpeg';
$jpg = 'image/pjpeg';
$gif = 'image/gif';
$png = 'image/png';
//CHECK THE IMAGE
if ($_FILES["image"]["size"] > 0){
$image_name = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_size = $_FILES['image']['size'];
$temp_file_name = $_FILES['image']['tmp_name'];
if ($image_name != '' && ($image_type != $jpg && $image_type != $jpeg && $image_type != $gif && $image_type != $png)){
OpenTable();
echo '<center>('.$image_name.') Your Extension is not Allowed</b></center><br/>';
echo '<center><b>'._GOBACK.'</b></center><br/>';
CloseTable();
crcopy();
include("footer.php");
die();
}else{
if($image_type == $jpg){$file_ext = "jpg";}
if($image_type == $jpeg){$file_ext = "jpg";}
if($image_type == $gif){$file_ext = "gif";}
if($image_type == $png){$file_ext = "png";}
$filename = $username.time().".".$file_ext;
$filename = str_replace(' ', '_', $filename);
$target_path = "$crfig[amempath]/$filename";
//RETURN ERROR IF THE FILE CANNOT BE RENAMED AND MOVED PROPERLY
if(!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
OpenTable();
echo '<center><span class="title">Sorry there was an error</span><br \>Be Sure Your Image Directory is chmod 777 and your image is the correct file type</center><br /><br />';
echo '<center><b>'._GOBACK.'</b></center><br/>';
CloseTable();
crcopy();
include("footer.php");
die();
}
thumb_img($filename, $file_ext, $crfig[amempath], $crfig[amemthbpath]);
$db->sql_query("update ".$prefix."_croster_members set gid='$cgid',rid='$crid',fid='$fid',cusername='$cusername',mimage='$filename',location='$location',interests='$interests',ogames='$ogames',email='$email',fb='$fb',tw='$tw',skype='$skype',steam='$steam',jdate='$jdate',birthmonth='$birthmonth',birthday='$birthday',birthyear='$birthyear',active='$active',website='$website' where uid='$uid'") OR die("Could not update user");
Header("Location: ".$admin_file.".php?op=CRMain");
 }
} else {
$db->sql_query("update ".$prefix."_croster_members set gid='$cgid',rid='$crid',fid='$fid',cusername='$cusername',location='$location',interests='$interests',ogames='$ogames',email='$email',fb='$fb',tw='$tw',skype='$skype',steam='$steam',jdate='$jdate',birthday='$birthday',birthmonth='$birthmonth',birthyear='$birthyear',active='$active',website='$website' where uid='$uid'") OR die("Could not update user");
Header("Location: ".$admin_file.".php?op=CRMain");
$filename = '';
}
}else{
$uid = $_GET['uid'];
$sql = "SELECT * FROM ".$prefix."_croster_members where uid='$uid'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$gid = intval($row['gid']);
$rid = intval($row['rid']);
$fid = intval($row['fid']);
$flags = "SELECT fname FROM ".$prefix."_croster_flags where fid='$fid'";
$flags2 = $db->sql_query($flags);
while($flags3 = $db->sql_fetchrow($flags2)){
$fname2 = $flags3['fname'];
}
$username = $row['username'];
$cusername = $row['cusername'];
$mimage = $row['mimage'];
$location = $row['location'];
$birthday = $row['birthday'];
$birthmonth = $row['birthmonth'];
$birthyear = $row['birthyear'];
$age = $birthday."-".$birthmonth."-".$birthyear;
$interests = $row['interests'];
$ogames = $row['ogames'];
$email = $row['email'];
$fb = $row['fb'];
$tw = $row['tw'];
$skype = $row['skype'];
$steam = $row['steam'];
$jdate = $row['jdate'];
$jdate = date("m-d-Y",$jdate);
$website = $row['website'];
$active = intval($row['active']);
$sql2 = "SELECT * FROM ".$prefix."_croster_games WHERE cgid='$gid'";
$result2 = $db->sql_query($sql2);
$row2 = $db->sql_fetchrow($result2);
$gtitle2 = $row2['gtitle'];
$gimage2 = $row2['gimage'];
$sql3 = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$rid'";
$result3 = $db->sql_query($sql3);
$row3 = $db->sql_fetchrow($result3);
$rtitle2 = $row3['rtitle'];
$rimage2 = $row3['rimage'];
}
echo "<form action='".$admin_file.".php?op=CREditusers&amp;edit=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Edit Member</font></b></td></tr>\n";
if($active == 1){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Set this user to active?</center></td>\n";
echo "<td width='50%'>Yes&nbsp;<input type='radio' name='active' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='active' value='0' ".$cr2."></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>User ID</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='uid' value='$uid' readonly><br \>Read Only</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>UserName</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='username' value='$username' readonly><br \>Read Only</td>\n";
echo "</tr>";
if ($crfig[cgames] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Game Selection 1</center></td>\n";
echo "<td width='50%'><select name='cgid'>";
echo "<option value=''>------</option>\n";
$sql = "SELECT cgid, gtitle FROM ".$prefix."_croster_games";
$result = $db->sql_query($sql);
while(list($cgid, $gtitle) = $db->sql_fetchrow($result)){
echo "<option value='$cgid'>$gtitle</option>\n";
}	
echo "</select><br \><b>Current</b>&nbsp;$gtitle2</td>";
echo "</tr>";
}
if ($crfig[cranks] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Clan Rank Selection</center></td>\n";
echo "<td width='50%'><select name='crid'>";
echo "<option value=''>------</option>\n";
$sql = "SELECT * FROM ".$prefix."_croster_ranks";
$result = $db->sql_query($sql);
while(list($crid, $rtitle, $rimg) = $db->sql_fetchrow($result)){
echo "<option value='$crid'>$rtitle</option>\n";
}	
echo "</select><br \><b>Current</b>&nbsp;$rtitle2</td>";
echo "</tr>";
}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Clan UserName</center></td>\n";
echo "<td width='50%'>$crfig[ctag]<input type='text' size='35' name='cusername' value='$cusername'></td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Join Date</center></td>\n";
echo "<td width='50%'>";
echo "<select name='joinday'>";
echo "<option value=\"\">--------</option>";
        $i = 1;
        while ($i <= 31) {
            $k = $i * 1;
            echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>&nbsp;&nbsp;";
echo "<select name='joinmonth'>";
echo "<option value=\"\">------------</option>";
echo "<option value=\"01\">JANUARY</option>";
echo "<option value=\"02\">FEBRUARY</option>";
echo "<option value=\"03\">MARCH</option>";
echo "<option value=\"04\">APRIL</option>";
echo "<option value=\"05\">MAY</option>";
echo "<option value=\"06\">JUNE</option>";
echo "<option value=\"07\">JULY</option>";
echo "<option value=\"08\">AUGUST</option>";
echo "<option value=\"09\">SEPTEMBER</option>";
echo "<option value=\"10\">OCTOBER</option>";
echo "<option value=\"11\">NOVEMBER</option>";
echo "<option value=\"12\">DECEMBER</option>";
echo "</select>&nbsp;&nbsp;";
echo "<select name='joinyear'>";
echo "<option value=\"\">--------</option>";
        $i = date("Y")-5;
        $y = date("Y");
        while ($i <= $y) {
            $k = $i * 1;
            echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>";
echo "<br \><b>Current</b>&nbsp;$jdate</td>\n";
echo "</tr>";
if ($crfig[uhard] == 1){
$hardcountmem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_croster_members_hardware where uid=$uid"));
if($hardcountmem == 1){            
		$cr1 = "CHECKED";
		$cr2 = "";
	} else {
		$cr1 = "";
		$cr2 = "CHECKED";
	}	
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Allow this user to have hardware profile?</center></td>\n";
echo "<td width='50%'>Yes&nbsp;<input type='radio' name='hardprofile' value='1' ".$cr1.">&nbsp;No&nbsp;<input type='radio' name='hardprofile' value='0' ".$cr2."></td>\n";
echo "</tr>";}
if($crfig[amemscreens] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Member Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font>";
if($mimage != ""){
echo "<br /><b>Current</b>&nbsp;$mimage&nbsp;[&nbsp;<a href='".$admin_file.".php?op=CREditusers&amp;mimage=$mimage&amp;deleteimage=1'>Delete</a>&nbsp;]";
}
echo "</td>\n";
echo "</tr>";}
if($crfig[aloc] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Member Location</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='location' value='$location'></td>\n";
echo "</tr>";}
if($crfig[aflags] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Country</center></td>\n";
echo "<td width='50%'>";
echo "<select name='fid'>";
echo "<option value=\"\">------------</option>";
$sql = "SELECT * FROM ".$prefix."_croster_flags";
$result = $db->sql_query($sql);
while(list($fid, $fname, $fimage) = $db->sql_fetchrow($result)){
echo "<option value='$fid'>$fname</option>\n";
}
echo "</select><br /><b>Current</b>&nbsp;$fname2</td></tr>";
}	
if($crfig[aage] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Birthday</center></td>\n";
echo "<td width='50%'>";
echo "<select name='birthday'>";
echo "<option value=\"\">--------</option>";
        $i = 1;
        while ($i <= 31) {
            $k = $i * 1;
echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>&nbsp;&nbsp;";
echo "<select name='birthmonth'>";
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
echo "<select name='birthyear'>";
echo "<option value=\"\">--------</option>";
        $i = date("Y")-99;
        $y = date("Y");
        while ($i <= $y) {
            $k = $i * 1;
            echo "<option value='$k'>$k</option>\n";
            $i++;
        }
echo "</select>";
echo "<br /><b>Current</b>&nbsp;$age</td>\n";
echo "</tr>";}
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Interests</center></td>\n";
echo "<td width='50%'><textarea name='interests' rows='5' cols='32'>$interests</textarea><br />No html allowed</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Other Games you play?</center></td>\n";
echo "<td width='50%'><textarea name='ogames' rows='5' cols='32'>$ogames</textarea><br />No html allowed</td>\n";
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
echo "</table><br \>";
echo "<input type='submit' value='Update Member'></center>";
}
CloseTable();
?>
