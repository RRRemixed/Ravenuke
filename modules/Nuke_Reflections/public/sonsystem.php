<?php
// *************************************************
// This file is Part of Nuke_Reflections V1 Module by
// White_Devil of http://devil-modz.us
// E-Mail arleighesq@gmail.com

// Please do not remove any copyright notices
// Or modify beyond the main parts of this script

// Everything is pretty much Explained.
// *************************************************
if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

echo "<br><center><strong>System Transfer to Sexy or Not Module</strong></center>";


if ($reflecnick == "Guest" && !is_admin($admin)) {
	    echo "<b><center>You must be an admin or a registered and logged in user to use Sexy or Not intagration system!! Please login!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
}

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_sexyornot_config WHERE config='sysconfig'"));
$SoNname = $row['sysname'];
$SoNversion = $row['version'];
$SoNPicfolder = $row['pic_folder'];
$thumbnail_size = $row['thumbnail_size'];



if ($SoNversion > "5.0") {
$SoNfolder = $row['modulefolderSoN'];
} else {
	    echo "<b><center><br><br>Sexy or Not Module by Devil Modz is NOT up to date. Please Upgrade. Sorry</b></center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}


if ($SoNname == "") {
	    echo "<b><center><br><br>Sexy or Not Module by Devil Modz was not found. Sorry</b></center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}

if ($SoNfolder == "") {
	    echo "<b><center><br><br>Sexy or Not Module by Devil Modz folder location was not found. <br>Please run Sexy or Not after your upgrade to set it. This will only work on Version 6.0+</b></center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}

if ($SoNTransferallow != "1" && !is_admin($admin)) {
	    echo "<b><center><br><br>Transfer to Sexy or Not is not allowed. Sorry.</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}

if ($picid == "") {
		echo "<b><center><br><br>No picture was selected to transfer!!</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}








$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_files WHERE picid='$picid'"));
$picid = $row['picid'];
$galid = $row['galid'];
$picname = $row['picname'];
$picdesc = $row['picdesc'];
$filename = $row['filename'];
$upnick = $row['upnick'];
$ip = $row['ip'];
$date = $row['date'];
$time = $row['time'];
$rawtime = $row['rawtime'];
$approved = $row['approved'];
$one = $row['one'];
$two = $row['two'];
$three = $row['three'];
$four = $row['four'];
$five = $row['five'];
$six = $row['six'];
$seven = $row['seven'];
$eight = $row['eight'];
$nine = $row['nine'];
$ten = $row['ten'];
$totalvote = $row['totalvote'];
$advarage = $row['advarage'];
$lastvote = $row['lastvote'];
$totalscore = $row['totalscore'];
$lastvotenick = $row['lastvotenick'];
$totalcomments = $row['totalcomments'];
$totalview = $row['totalview'];
$galactive = $row['galactive'];
$totalreports = $row['totalreports'];
$keywords = $row['keywords'];
$lastseennick = $row['lastseennick'];
$extra1 = $row['extra1'];
$extra2 = $row['extra2'];
$extra3 = $row['extra3'];
$extra4 = $row['extra4'];
$extra5 = $row['extra5'];
$galpassword = $row['galpassword'];
$infolder = $row['infolder'];
$thumbforgalid = $row['thumbforgalid'];
$galtype = $row['galtype'];
$size = $row['size'];
$width = $row['width'];
$height = $row['height'];

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
$usergalid = $row['galid'];
$usergalparentid = $row['parentid'];
$usergalgaltype = $row['galtype'];
$usergalname = $row['name'];
$usergaldesc = $row['desc'];
$usergalthumb = $row['thumb'];
$usergalfolder = $row['folder'];
$usergaldate = $row['date'];
$usergaltime = $row['time'];
$usergalrawtime = $row['rawtime'];
$usergalactive = $row['active'];
$usergalpassword = $row['password'];
$usergalcreator = $row['creator'];
$usergalcreator1 = $row['creator'];
$usergalmemberupload = $row['memberupload'];
$usergaltotalview = $row['totalview'];
$usergalextra1 = $row['extra1'];
$usergalextra2 = $row['extra2'];
$usergalextra3 = $row['extra3'];
$usergalextra4 = $row['extra4'];
$usergallastseen = $row['extra5'];

if ($filename == "") {
		echo "<b><center><br><br>That is not a valid file ID. Sorry.</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}

if (!is_admin($admin)) {

if (strtolower($cookie[1]) != strtolower($upnick)) {
			echo "<b><center><br><br>You need to be the admin or the owner of this file!!</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}
}


if (!is_admin($admin)) {

	if ($approved != "1") {
				echo "<b><center><br><br>That file has not been approved yet!!</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
	}


}


if ($usergalgaltype == "member") {
	$galtype = "memgallery";
} else if ($usergalgaltype == "main") {
	$galtype = "maingallery";
}








if ($Submit == "") {
echo "<strong><center>";
echo "<br><img src=\"modules/$module_name/files/$galtype/$usergalfolder/thumbs/$filename\">";
echo "<br>Please select a Sexy or Not Category<br>";
echo "<form id='form134' name='form123' method='post' action='modules.php?name=$module_name&op=sonsystem&picid=$picid'>";
echo "<select size=\"1\" name=\"filewhere\">";
$sql = "";
$result = "";
$num = "";
$sql="SELECT * FROM ".$prefix."_sexyornot_cat";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$cat_list_id=mysql_result($result,$i,"cat_id");
$cat_list_title=mysql_result($result,$i,"cat_title");
$cat_list_info=mysql_result($result,$i,"cat_info");
$cat_list_path=mysql_result($result,$i,"cat_path");
$cat_list_visible=mysql_result($result,$i,"cat_visible");

if (is_admin($admin)) {
echo "<option value=\"$cat_list_id\">$cat_list_title</option>";
} else {

if ( $cat_list_visible == "1" ) {
echo "<option value=\"$cat_list_id\">$cat_list_title</option>";
}
}

$i++;
}
echo "</select>";
echo "<br><br><input type='submit' name='Submit' value='Transfer' />";


echo "</form>";
}




if ($Submit != "") {

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_sexyornot_cat WHERE cat_id='$filewhere'"));
$soncatpath = $row['cat_path'];
$soncatvis = $row['cat_visible'];



if ($soncatpath == "") {
			echo "<b><center><br><br>Invalid Category ID Sorry!!!</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
}

if (!is_admin($admin)) {
	if ($soncatvis != "1") {
				echo "<b><center><br><br>That Sexy or Not category is not Active. Sorry!!</center><Br><br>";
        closetable();
        include_once("footer.php");
        die;
	}
}

echo "<br><br><center><strong>Starting Transfer to Sexy or Not...";




$origionalpic = "modules/$module_name/files/$galtype/$usergalfolder/fullsize/$filename";
$thumbnailpic = "modules/$SoNfolder/$SoNPicfolder/$soncatpath/thumbs/$filename";
createthumb($origionalpic, $thumbnailpic, $thumbnail_size, $thumbnail_size);


$file = "modules/$module_name/files/$galtype/$usergalfolder/fullsize/$filename";
$newfile = "modules/$SoNfolder/$SoNPicfolder/$soncatpath/fullsize/$filename";

if (!copy($file, $newfile)) {
    echo "failed to copy $file...<br>";
}

if (file_exists($thumbnailpic) && file_exists($newfile)) {
	echo "File transfer sucessfull.<br>";
	$allgood = "1";
}


if ($allgood = "1") {


$dadate = date('m/d/y');
$datime = date('h:i a');

$daname = $reflecnick;


$ip = $_SERVER["REMOTE_ADDR"];
$sql = "INSERT INTO " . $prefix . "_sexyornot_files (`file_id`, `file_cat`, `file_name`, `file_comment`, `file_member`, `file_last_rate`, `file_score`, `file_total_votes`, `file_one`, `file_two`, `file_three`, `file_four`, `file_five`, `file_six`, `file_seven`, `file_eight`, `file_nine`, `file_ten`, `file_ip_addy`, `file_date`, `file_time`, `file_rating`, `file_approve`, `file_cat_vis`) VALUES ('', '$filewhere', '$filename', '$picdesc', '$picname', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '$ip', '$dadate', '$datime', '0', '1', '$soncatvis')";

mysql_query($sql);
} else {
echo "Cannot finish transfer to Sexy or Not. Please check for errors above. May be a permission Error!";
}


}










closetable();
include("footer.php");


function createthumb($name, $filename, $new_w, $new_h)
{
    $system = explode(".", $name);
    if (preg_match("/jpg|JPG|JPEG|jpeg/", $system[1])) {
        $src_img = imagecreatefromjpeg($name);
    }
    if (preg_match("/gif|GIF/", $system[1])) {
        $src_img = imagecreatefromgif($name);
    }
    $old_x = imageSX($src_img);
    $old_y = imageSY($src_img);
    if ($old_x > $old_y) {
        $thumb_w = $new_w;
        $thumb_h = $old_y * ($new_h / $old_x);
    }
    if ($old_x < $old_y) {
        $thumb_w = $old_x * ($new_w / $old_y);
        $thumb_h = $new_h;
    }
    if ($old_x == $old_y) {
        $thumb_w = $new_w;
        $thumb_h = $new_h;
    }
    $dst_img = ImageCreateTrueColor($thumb_w, $thumb_h);
    imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $old_x, $old_y);
    if (preg_match("/gif/", $system[1])) {
        imagegif($dst_img, $filename);
    } else {
        imagejpeg($dst_img, $filename);
    }
    imagedestroy($dst_img);
    imagedestroy($src_img);
}


?>