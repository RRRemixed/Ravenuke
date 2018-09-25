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

$latestversion = "http://devil-modz.us/versions/nrversion.txt";
if(@file($latestversion)){
versioncheck();
}

echo "<center><strong>Nuke Reflections Main Admin Page</strong></center><bR>";



echo "<table border=\"0\" width=\"100%\">";
echo "<tr><td align=\"center\" colspan=\"2\">";
echo "<strong><u>Current Reflections Stats</u></strong><br><br>";
echo "</td></tr>";

echo "<tr><td><strong><u>Galleries Information</u></strong></td>";
echo "<td><strong><u>Images Information</u></strong></td>";
echo "</tr><tr>";
echo "<td>";
$sql20 = "SELECT * FROM " . $user_prefix . "_reflections_gallery";
    $result20 = mysql_query($sql20);
    $num20 = mysql_numrows($result20);
echo "<strong>Total Galleries in System :: $num20</strong></td>";


$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
echo "<td><strong>Total Images in System :: $num90</strong></td>";

echo "</tr><tr>";

$sql20 = "SELECT * FROM " . $user_prefix . "_reflections_gallery where galtype='main' AND parentid='0'";
    $result20 = mysql_query($sql20);
    $num20 = mysql_numrows($result20);
echo "<td><strong>Total Main Galleries in System :: $num20</strong></td>";

$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where galtype='main'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
echo "<td><strong>Total Images in main Galleries :: $num90</strong></td>";
echo "</tr><tr>";


$sql20 = "SELECT * FROM " . $user_prefix . "_reflections_gallery where galtype='main' AND parentid!='0'";
    $result20 = mysql_query($sql20);
    $num20 = mysql_numrows($result20);
echo "<td><strong>Total Main Sub Galleries in System :: $num20</strong></td>";
$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where galtype='member'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
echo "<td><strong>Total Images in Member Galleries :: $num90</strong></td>";
echo "</tr><tr>";
$sql20 = "SELECT * FROM " . $user_prefix . "_reflections_gallery where galtype='member' AND parentid='0'";
    $result20 = mysql_query($sql20);
    $num20 = mysql_numrows($result20);
echo "<td><strong>Total Member Galleries in System :: $num20</strong></td>";

$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where approved!='1'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
echo "<td><strong>Total Unapproved Images in System :: $num90</strong></td>";
echo "</tr><tr>";

$sql20 = "SELECT * FROM " . $user_prefix . "_reflections_gallery where galtype='member' AND parentid!='0'";
    $result20 = mysql_query($sql20);
    $num20 = mysql_numrows($result20);
echo "<td><strong>Total Member Sub Galleries in System :: $num20</strong></td>";

$sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where totalreports!='0'";
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);
echo "<td><strong>Total Images Reported in System :: $num90</strong></td>";

echo "</tr><tr>";
echo "<td colspan=\"2\">";
echo "<strong><u><br>Misc Information</u></strong>";
echo "</td>";
echo "</tr><tr>";
    $sql = "SELECT * FROM " . $user_prefix . "_reflections_files where totalvote!='0'";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $appleblue="0";
    $i = 0;
  while ($i < $num) {
        $totalvote = mysql_result($result, $i, "totalvote");
        $appleblue = $appleblue + $totalvote;
        $i++;
    }
echo "<td colspan=\"2\"><strong>Total Votes in System :: $appleblue</strong></td></tr>";

    $sql = "SELECT * FROM " . $user_prefix . "_reflections_files where totalcomments!='0'";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $appleblue="0";
    $i = 0;
   while ($i < $num) {
        $totalvote = mysql_result($result, $i, "totalcomments");
        $appleblue = $appleblue + $totalvote;
        $i++;
    }
echo "<tr><td colspan=\"2\"><strong>Total Comments in System :: $appleblue</strong></td";


echo "</tr></table>";





















closetable();
include("footer.php");



?>