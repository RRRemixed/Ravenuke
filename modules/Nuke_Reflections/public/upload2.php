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









if ($reflecnick == "Guest" && !is_admin($admin)) {
    echo "<b><center>You must be an admin or a registered and logged in user to make a gallery!! Please login!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($allowmemberupload == "0" && !is_admin($admin)) {
    echo "<b><center>Member upload has been turned off by the admin. Sorry.</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

//get main gal information
if ($uploadmain != "") {
    if ($maingalidselect != "") {
        // upload main no sub
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$maingalidselect'"));
    } else {
        echo "<b><center>There was no selected gallery to upload to! Please try again.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // Contenue after checks
    $galid = $row['galid'];
    $parentid = $row['parentid'];
    $galtype = $row['galtype'];
    $name = $row['name'];
    $desc = $row['desc'];
    $thumb = $row['thumb'];
    $folder = $row['folder'];
    $date = $row['date'];
    $time = $row['time'];
    $rawtime = $row['rawtime'];
    $active = $row['active'];
    $password = $row['password'];
    $creator = $row['creator'];
    $memberupload = $row['memberupload'];
    $totalview = $row['totalview'];
    // check gallery to valid fields.
    if ($memberupload != "1" && $galid == "") {
        echo "<b><center>$name is not a valid gallery for you to upload to.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // done can goto the upload section now.
}
//end get main gal information


//start membergal information
if ($uploadmember != "") {
    if ($damemid != "" && $subgallerymemselect == "none") {
        // upload member no sub
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$damemid' AND parentid='0'"));
    } else if ($damemid != "" && $subgallerymemselect != "none" && $subgallerymemselect != "") {
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$subgallerymemselect' AND parentid='$damemid'"));
        // upload member w/ sub
    } else {
        echo "<b><center>There was no selected gallery to upload to! Please try again.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // Contenue after checks
    $galid = $row['galid'];
    $parentid = $row['parentid'];
    $galtype = $row['galtype'];
    $name = $row['name'];
    $desc = $row['desc'];
    $thumb = $row['thumb'];
    $folder = $row['folder'];
    $date = $row['date'];
    $time = $row['time'];
    $rawtime = $row['rawtime'];
    $active = $row['active'];
    $password = $row['password'];
    $creator = $row['creator'];
    $memberupload = $row['memberupload'];
    $totalview = $row['totalview'];
    // check gallery to valid fields.
    if ($galid == "" && $creator != "$cookie[1]") {
        echo "<b><center>$name is not a valid gallery for you to upload to.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // done can goto the upload section now.
}

//end member gal information





echo "<center><span class='deviltitle'>Select file to upload to gallery \"$name\"</center><br>";



//upload form
$uploadboxes = devilcleanitup($uploadboxes);
if ($uploadboxes == "" || $uploadboxes == "0") {
$uploadboxes = "1";
}
if ($allowmembermulti == "0") {
$uploadboxes = "1";
} else {
if ($membermultilimit <= $uploadboxes) {
	$uploadboxes = "$membermultilimit";
}
}
?>
<form name="form1" enctype="multipart/form-data" method="post" action="modules.php?name=<? echo $module_name; ?>&op=uploadprocess">
  <?
  // start of dynamic form
  $uploadNeed = $uploadboxes;
  for($x=0;$x<$uploadNeed;$x++){
  ?>
	<strong>Upload Box #<? echo $x + 1; ?></strong><br>
    <input name="userfile<? echo $x;?>" type="file" id="userfile<? echo $x;?>" size="60"><br>
File Description<br><input type="text" name="fileinfo<? echo $x;?>" size="60">(optional) <br>
Name for file<br><input type="text" name="filename<? echo $x;?>" size="60">(optional - Filename will be used if blank!) <br>
<hr>
  <?
  // end of for loop
  }
  ?>
  <p>
<?
echo "
<input name=\"upgalid\" type=\"hidden\" value=\"$galid\">
<input name=\"uploadNeed\" type=\"hidden\" value=\"$uploadNeed\">
<div id='deviltag1' class='deviltag1hidden'>
<center>System Uploading now. Please wait.....<br>
<img src='modules/$module_name/images/58911.gif' height='10' width='400'>
</centeR>
</div>";


if ($membersecurityupload == "1") {


	echo "<strong>Security Code<br>";
srand(time());
$apple = rand(1111, 9999);
$apple2 = rand(1111, 9999);
$apple3 = rand(1111, 9999);
$apple4 = rand(1111, 9999);
$maincode = rand(1, 4);
echo "<table border=\"1\" width=\"250\" id=\"table1\">";
echo "	<tr>";
echo "		<td bgcolor=\"#0000FF\" align=\"center\"><b>";
echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple</font></b></td>";
echo "		<td bgcolor=\"#008000\" align=\"center\"><b>";
echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple2</font></b></td>";
echo "		<td bgcolor=\"#FF0000\" align=\"center\"><b>";
echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple3</font></b></td>";
echo "		<td bgcolor=\"yellow\" align=\"center\"><b>";
echo "		<font color=\"black\" face=\"Arial\">$apple4</font></b></td>";
echo "	</tr>";
echo "</table>";
$apple = md5($apple);
$apple2 = md5($apple2);
$apple3 = md5($apple3);
$apple4 = md5($apple4);
if ($maincode == "1") {
    $green = $apple;
    $color1 = "Blue";
}
if ($maincode == "2") {
    $green = $apple2;
    $color1 = "Green";
}
if ($maincode == "3") {
    $green = $apple3;
    $color1 = "Red";
}
if ($maincode == "4") {
    $green = $apple4;
    $color1 = "Yellow";
}
echo "<input type=\"hidden\" name=\"securitycode\" size=\"80\" value=\"$green\">";
echo "Please re-enter code in the \"<b>$color1</b>\" Box <br><input type=\"text\" name=\"securitycode1\" size=\"6\">";
echo "<br><br>";
}






echo "<input type=\"submit\" name=\"uploadfiles\" onclick=\"deviltag1();\" value=\"Upload\">
<input type=\"reset\" onclick=\"deviltag1();\" value=\"Reset\" name=\"B2\">
  </p>
</form>



";







//end upload form


closetable();
include("footer.php");

?>