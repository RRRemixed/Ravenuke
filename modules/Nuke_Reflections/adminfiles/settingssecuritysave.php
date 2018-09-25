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
	echo "<b><center>You are not an Admin. LEAVE NOW!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}


echo "<br><bR><center><strong>This is a save settings page. Error Page<br><br>";

$errorsystem = "";

if ($comsecurity == "") {
	$errorsystem = "1";
}
if ($galsecurity == "") {
	$errorsystem = "1";
}
if ($securityup == "") {
	$errorsystem = "1";
}

if ($guestvot == "") {
	$errorsystem = "1";
}

if ($guestcom == "") {
	$errorsystem = "1";
}


if ($errorsystem == "1") {
echo "There was an Error. Please go back and see what fields was left blank.<br><br>";
closetable();
include_once("footer.php");
die;

}


$sql = "update " . $user_prefix . "_reflections_config set
commentsecurity='$comsecurity',
membersecuritycreate='$galsecurity',
membersecurityupload='$securityup',
guestvote='$guestvot',
allowguestcomment='$guestcom'
WHERE `configinfo` = 'configsys'";


            if (mysql_query($sql)) {
			echo "Updating File Information OK <img src='modules/$module_name/images/okyes.gif'>";
            } else {
			echo "Updating of File Information is NOT OK Contact Admin!<img src='modules/$module_name/images/okno.gif'>";
		echo "<bR><br>";
closetable();
include_once("footer.php");
die;
			}

header("Location: modules.php?name=$module_name&adminarea=settingssecurity&somethinggood=saveok"); /* Redirect browser */




//$comsecurity
//$galsecurity
//$securityup
//$guestvot
//$guestcom

closetable();
include_once("footer.php");
die;
?>




