<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
global $admin_file, $prefix, $db;
$crfig = array();
$sql = "SELECT * FROM ".$prefix."_croster_config";
$result = $db->sql_query($sql);
while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
$crfig[$config_name] = $config_value;
}
$crid = intval($crid);
if($edit==1) {
if ($rtitle == ""){
OpenTable();
echo "<center>A Rank Title is Required<br \><br \>"._GOBACK."</center>";
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
$filename = $rtitle.time().".".$file_ext;
$filename = str_replace(' ', '_', $filename);
$target_path = "$crfig[rankpath]/$filename";
if(!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)){
OpenTable();
echo '<center><span class="title">Sorry there was an error</span><br \>Be Sure Your Image Directory is chmod 777 and your image is the correct file type</center><br /><br />';
echo '<center><b>'._GOBACK.'</b></center><br/>';
CloseTable();
crcopy();
include("footer.php");
die();
}
$db->sql_query("update ".$prefix."_croster_ranks set rtitle='$rtitle',rimage='$filename' where crid='$crid'");
Header("Location: ".$admin_file.".php?op=CRRanks");
 }
} else {
$filename = '';
$db->sql_query("update ".$prefix."_croster_ranks set rtitle='$rtitle' where crid='$crid'");
Header("Location: ".$admin_file.".php?op=CRRanks");
}
}
} else {
OpenTable();
$sql = "SELECT * FROM ".$prefix."_croster_ranks WHERE crid='$crid'"; 
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
$crid = intval($row['crid']);
$rtitle =	$row['rtitle'];
$rimage = $row['rimage'];
}
echo "<form action='".$admin_file.".php?op=CRRanksdbedit&amp;crid=$crid&amp;edit=1' ENCTYPE='multipart/form-data' method='POST'>";
echo "<center><table width='85%' cellpadding='2' cellspacing='1' bgcolor='$crfig[bcolor]'>\n";
echo "<tr><td align='center' colspan='2' class='option'><b><font color='$crfig[hcolor]'>Edit Rank</font></b></td></tr>\n";
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Rank Title</center></td>\n";
echo "<td width='50%'><input type='text' size='35' name='rtitle' value='$rtitle'></td>\n";
echo "</tr>";
if($crfig[urimg] == 1){
echo "<tr bgcolor='$crfig[rcolor]'>\n";
echo "<td width='50%'><center>Rank Image</center></td>\n";
echo "<td width='50%'><input type='file' size='29' name='image'><br /><font color='red'>Allowed File types are .jpg, .gif, and .png.</font><br /><b>Current:</b>&nbsp;$rimage</td>\n";
echo "</tr>";}
echo "</table><br \>";
echo "<input type='submit' name='submit' value='Save Edit'></center>";
echo "</form>";
} 
CloseTable();
?>
