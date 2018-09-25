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




if (!is_admin($admin)) {
    echo "<b><center>You are not an admin. LEAVE NOW!</b></center>";
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
    if ($galid == "") {
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
    if ($memgalidselect != "") {
        // upload main no sub
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$memgalidselect'"));
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
    if ($galid == "") {
        echo "<b><center>$name is not a valid gallery for you to upload to.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // done can goto the upload section now.
}

//end member gal information





echo "<br><center><strong>Select file to upload to gallery \"$name\"</center><br>";



//upload form
$uploadboxes = devilcleanitup($uploadboxes);
if ($uploadboxes == "" || $uploadboxes == "0") {
$uploadboxes = "1";
}

?>
<form name="form1" enctype="multipart/form-data" method="post" action="modules.php?name=<? echo $module_name; ?>&adminarea=adminupprocess">
  <?
  // start of dynamic form
  $uploadNeed = $uploadboxes;
  for($x=0;$x<$uploadNeed;$x++){
  ?>
	<strong>Upload Box #<? echo $x + 1; ?></strong><br>
    <input name="userfile<? echo $x;?>" type="file" id="userfile<? echo $x;?>" size="60"><br>
File Description<br><input type="text" name="fileinfo<? echo $x;?>" size="60">(optional) <br>
Name for file<br><input type="text" name="filename<? echo $x;?>" size="60">(optional - Filename will be used if blank!) <br>

<?
if ($galtype == "member") {
?>
Nickname to use for upload<br><input type="text" name="danick<? echo $x;?>" value='<? echo $creator; ?>' size="60"><br>
<?
} else {
?>
Nickname to use for upload<br><input type="text" name="danick<? echo $x;?>" value='<? echo $reflecnick; ?>' size="60"><br>
<?
}
?>

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
</div>
    <input type=\"submit\" name=\"uploadfiles\" onclick=\"deviltag1();\" value=\"Upload\">
<input type=\"reset\" onclick=\"deviltag1();\" value=\"Reset\" name=\"B2\">
  </p>
</form>



";







//end upload form


closetable();
include("footer.php");

?>