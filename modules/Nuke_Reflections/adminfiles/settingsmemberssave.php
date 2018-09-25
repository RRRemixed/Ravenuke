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

if ($allowmemup == "") {
	$errorsystem = "1";
}
if ($allowmemgal == "") {
	$errorsystem = "1";
}
if ($allowmemmulti == "") {
	$errorsystem = "1";
}
if ($multiuploadmax == "" && $allowmemmulti == "1") {
	$multierror = "1";
}
if ($memlimitonoff == "") {
	$errorsystem = "1";
}
if ($memmax == "" && $memlimitonoff == "1") {
	$memerror = "1";
}
if ($requireapprov == "") {
	$errorsystem = "1";
}
if ($allowdelcom == "") {
	$errorsystem = "1";
}
if ($allowbbcodes == "") {
	$errorsystem = "1";
}




if ($errorsystem == "1") {
echo "There was an Error. Please go back and see what fields was left blank.<br><br>";
closetable();
include_once("footer.php");
die;

}

if ($memerror == "1") {
echo "There was an Error. You must have a Max size allowed limit if you<br>
have member limits on!!<br><br>";
closetable();
include_once("footer.php");
die;

}
if ($multierror == "1") {
echo "There was an Error. You must have a Max box allowed limit if you<br>
have Multi Upload on!!<br><br>";
closetable();
include_once("footer.php");
die;

}

$sql = "update " . $user_prefix . "_reflections_config set
allowmemberupload='$allowmemup',
allowmembergalleries='$allowmemgal',
allowmembermulti='$allowmemmulti',
membermultilimit='$multiuploadmax',
memberlimit='$memlimitonoff',
membermaxsize='$memmax',
requireapproval='$requireapprov',
allowmemberdelcomment='$allowdelcom',
allowbbcode='$allowbbcodes'
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

header("Location: modules.php?name=$module_name&adminarea=settingsmembers&somethinggood=saveok"); /* Redirect browser */




//$allowmemup
//$allowmemgal
//$allowmemmulti
//$multiuploadmax
//$memlimitonoff
//$memmax
//$requireapprov
//$allowdelcom


closetable();
include_once("footer.php");
die;
?>