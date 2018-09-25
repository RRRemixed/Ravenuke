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
$db->sql_query("update ".$prefix."_croster_members_hardware set hardimage='' where hardimage='$hardimage'");
unlink($crfig[uhardpath]."/".$hardimage);
unlink($crfig[uhardthbpath]."/".$hardimage);
Header("Location: ".$admin_file.".php?op=CRMain");
}	
if($edit == 1){
$uid = $_POST['uid'];
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
$target_path = "$crfig[uhardpath]/$filename";
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
thumb_img($filename, $file_ext, $crfig[uhardpath], $crfig[uhardthbpath]);
$db->sql_query("update ".$prefix."_croster_members_hardware set hardimage='$filename',motherboard='$motherboard',processor='$processor',monitor='$monitor',primhd='$primhd',sechd='$sechd',graphics='$graphics',ram='$ram',mouse='$mouse',keyboard='$keyboard',casing='$casing' where uid='$uid'");
Header("Location: ".$admin_file.".php?op=CRMain");
 }
} else {
$db->sql_query("update ".$prefix."_croster_members_hardware set motherboard='$motherboard',processor='$processor',monitor='$monitor',primhd='$primhd',sechd='$sechd',graphics='$graphics',ram='$ram',mouse='$mouse',keyboard='$keyboard',casing='$casing' where uid='$uid'");
Header("Location: ".$admin_file.".php?op=CRMain");
$filename = '';
}
}else{
$uid = $_GET['uid'];
$sql = "SELECT * FROM ".$prefix."_croster_members_hardware where uid='$uid'";
$result = $db->sql_query($sql);
while($row = $db->sql_fetchrow($result)){
$uid = intval($row['uid']);
$username = $row['username'];
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
}
echo "<form action='".$admin_file.".php?op=CREdithardware&amp;edit=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Edit $username's Hardware Profile</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>User ID</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='uid' value='$uid' readonly><br \>Read Only</td>\n";
echo "</tr>";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>UserName</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='username' value='$username' readonly><br \>Read Only</td>\n";
echo "</tr>";
if($crfig[uhardscreens] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Hardware Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font>";
if($hardimage != ""){
echo "<br /><b>Current</b>&nbsp;$hardimage&nbsp;[&nbsp;<a href='".$admin_file.".php?op=CREdithardware&amp;hardimage=$hardimage&amp;deleteimage=1'>Delete</a>&nbsp;]";
}
echo "</td>\n";
echo "</tr>";}
if($crfig[uboard] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Motherboard</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='motherboard' value='$motherboard'></td>\n";
echo "</tr>";}
if($crfig[uproc] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Processor</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='processor' value='$processor'></td>\n";
echo "</tr>";}
if($crfig[umon] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Monitor</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='monitor' value='$monitor'></td>\n";
echo "</tr>";}
if($crfig[uprimhd] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Primary Hard Drive</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='primhd' value='$primhd'></td>\n";
echo "</tr>";}
if($crfig[usechd] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Secondary Hard Drive</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='sechd' value='$sechd'></td>\n";
echo "</tr>";}
if($crfig[ugraph] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Graphics Card</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='graphics' value='$graphics'></td>\n";
echo "</tr>";}
if($crfig[uram] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Ram</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='ram' value='$ram'></td>\n";
echo "</tr>";}
if($crfig[umouse] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Mouse</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='mouse' value='$mouse'></td>\n";
echo "</tr>";}
if($crfig[ukey] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Keyboard</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='keyboard' value='$keyboard'></td>\n";
echo "</tr>";}
if($crfig[ucase] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Computer Case</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='casing' value='$casing'></td>\n";
echo "</tr>";}
echo "</table><br \>";
echo "<input type='submit' value='Update Member'></center>";
}
CloseTable();
?>
