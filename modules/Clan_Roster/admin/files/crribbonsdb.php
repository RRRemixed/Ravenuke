<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $db, $prefix, $admin_file, $module_name;
$module_name = "$module_name";
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
if ($ribtitle == ""){
OpenTable();
echo "<center>A Ribbon Title is Required<br \><br \>"._GOBACK."</center>";
CloseTable();
}else{
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
} else {
if($image_type == $jpg){$file_ext = "jpg";}
if($image_type == $jpeg){$file_ext = "jpg";}
if($image_type == $gif){$file_ext = "gif";}
if($image_type == $png){$file_ext = "png";}
$filename = $ribtitle.time().".".$file_ext;
$filename = str_replace(' ', '_', $filename);
$target_path = "$crfig[ribbonpath]/$filename";
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
 }
} else {
$filename = '';
}
CloseTable();
$ribtitle = stripslashes($ribtitle);
$ribdes = stripslashes($ribdesc);
$sql = $db->sql_query("INSERT INTO ".$prefix."_croster_ribbons values (NULL,'$ribtitle','$filename', '$ribdesc')");
$sql3 = "SELECT * FROM ".$prefix."_croster_ribbons where ribtitle='$ribtitle'";
$result3 = $db->sql_query($sql3);
if( !($result3 = $db->sql_query($sql3)) )
{
echo "<H3>ERROR - 1 - DATA ERROR</H3><br>";
exit();
}
$row3 = $db->sql_fetchrow($result3);
$cribid = intval($row3['cribid']);
$ribtitle2 = $row3['ribtitle'];
$ribprefix = "rib";
$sql2 = $db->sql_query("CREATE TABLE ".$prefix."_croster_ribbons_".$ribprefix."".$cribid." (cribid2 int(11) NOT NULL AUTO_INCREMENT, cribid int(11) NULL, uid int(11) NULL, username varchar(255) NULL, PRIMARY KEY (cribid2))") OR die("Could not create ribbon table");
header("Location: $admin_file.php?op=CRRibbons");
}
break;
?>
