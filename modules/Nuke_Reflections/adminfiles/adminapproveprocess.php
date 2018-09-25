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
    echo "<br><b><center>You are not an admin. LEAVE NOW!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

$fileid = devilcleanitup($fileid);
$setstat = devilcleanitup($setstat);
$goback = devilcleanitup($goback);
if ($fileid == "") {
	    echo "<br><b><center>The file id is not valid. Please go back!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($setstat == "") {
		    echo "<br><b><center>The file id is not valid. Please go back!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}



if ($setstat == "dissapprove") {
	$db->sql_query("update " . $user_prefix . "_reflections_files set approved='0' where picid='$fileid'");

		    echo "<br><br><b><center>File has been Admin Unapproved.</b></center><br><br>";
    closetable();
    include_once("footer.php");
    die;
}






if ($setstat == "approve") {
	$db->sql_query("update " . $user_prefix . "_reflections_files set approved='1' where picid='$fileid'");

		    echo "<br><br><b><center>File has been Admin Approved.</b></center><br><br>";
  if ($goback == "approval") {
	header("Location: modules.php?name=$module_name&adminarea=approvalpage&somethinggood=beenapproved"); /* Redirect browser */
}

    closetable();
    include_once("footer.php");
    die;
}










?>