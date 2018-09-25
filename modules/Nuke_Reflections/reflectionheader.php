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



$module_name = basename(dirname(__FILE__));

require_once("mainfile.php");
define('NO_EDITOR', 1);
include_once("header.php");

echo "<LINK href=\"modules/$module_name/includes/devil.css\" rel=\"stylesheet\" type=\"text/css\">";




if (is_user($user)) {
$reflecnick = "$cookie[1]";
} else {
$reflecnick = "Guest";
}

opentable();
echo "<center>";

echo "<a href='modules.php?name=$module_name'><img src='modules/$module_name/images/reflections.png' border='0'></a><br>";


if (is_admin($admin)) {
echo "<a href='modules.php?name=$module_name&adminarea=adminmain'><u>Admin Page</u></a>";

$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where approved!='1'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
    if ($num90 != "0") {
    echo "  ||  <a href='modules.php?name=$module_name&adminarea=approvalpage'><strong><u>Images Need Approved :: $num90</u></strong></a>";

    }



$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where totalreports!='0'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
if ($num90 != "0") {
echo "  || <a href='modules.php?name=$module_name&adminarea=reportpage'><u><strong>Reported Images :: $num90</strong></u></a>";

}




echo "<br>";
$adminnote = " and as Admin";
}
if ($reflecnick == "Guest") {
echo "You are a Guest";
} else {
echo "You are logged in as \"$reflecnick\"$adminnote";
}



if ($op != "" && $adminarea == "") {

echo "<hr>";

if (is_user($user) || is_admin($admin)) {
echo "<a href='modules.php?name=$module_name&op=userhome'>My Home</a> || ";
}
if (is_user($user) || is_admin($admin)) {
echo "<a href='modules.php?name=$module_name&op=upload'>Upload Files</a> || ";
}


echo "<a href='modules.php?name=$module_name&op=gallistpub'>Gallery List</a> || ";
echo "<a href='modules.php?name=$module_name&op=viewall&galllookup=main'>Gallery List Main</a> || ";
echo "<a href='modules.php?name=$module_name&op=viewall&galllookup=member'>Gallery List Members</a>";

}




echo "</center><hr>";




?>