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









if (!is_user($user) || !is_admin($admin)) {
	    echo "<b><center>Error... you must be a logged in member or an admin to report a file.</b></center>";
    closetable();
    include_once("footer.php");
    die;
}


echo "<center><strong><br>Report an Image Page<br><bR></strong></center>";

if ($fileid == "") {
    echo "<b><center>Error File id was not selected to be Reported!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($securitycode != md5($securitycode1)) {
    echo "<b><center>Error... You did not enter a correct Security Code!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}




$sql = "SELECT * FROM " . $user_prefix . "_reflections_files where picid='$fileid' LIMIT 1";
$result = mysql_query($sql) or die ('SQL Select Failed!!');
$num = mysql_numrows($result);
$i = 0;
while ($i < $num) {
    $filepicid = mysql_result($result, $i, "picid");
    $filemaingalid = mysql_result($result, $i, "galid");
    $filepicname = mysql_result($result, $i, "picname");
    $filepicdesc = mysql_result($result, $i, "picdesc");
    $filefilename = mysql_result($result, $i, "filename");
    $fileupnick = mysql_result($result, $i, "upnick");
    $fileip = mysql_result($result, $i, "ip");
    $filedate = mysql_result($result, $i, "date");
    $filetime = mysql_result($result, $i, "time");
    $filerawtime = mysql_result($result, $i, "rawtime");
    $fileapproved = mysql_result($result, $i, "approved");
    $fileone = mysql_result($result, $i, "one");
    $filetwo = mysql_result($result, $i, "two");
    $filethree = mysql_result($result, $i, "three");
    $filefour = mysql_result($result, $i, "four");
    $filefive = mysql_result($result, $i, "five");
    $filesix = mysql_result($result, $i, "six");
    $fileseven = mysql_result($result, $i, "seven");
    $fileeight = mysql_result($result, $i, "eight");
    $filenine = mysql_result($result, $i, "nine");
    $fileten = mysql_result($result, $i, "ten");
    $filetotalvote = mysql_result($result, $i, "totalvote");
    $fileadvarage = mysql_result($result, $i, "advarage");
    $filelastvote = mysql_result($result, $i, "lastvote");
    $filetotalscore = mysql_result($result, $i, "totalscore");
    $filelastvotenick = mysql_result($result, $i, "lastvotenick");
    $filetotalcomments = mysql_result($result, $i, "totalcomments");
    $filetotalview = mysql_result($result, $i, "totalview");
    $filegalactive = mysql_result($result, $i, "galactive");
    $filetotalreports = mysql_result($result, $i, "totalreports");
    $filekeywords = mysql_result($result, $i, "keywords");
    $filelastseennick = mysql_result($result, $i, "lastseennick");
    $fileextra1 = mysql_result($result, $i, "extra1");
    $fileextra2 = mysql_result($result, $i, "extra2");
    $filepassword = mysql_result($result, $i, "galpassword");
    $filefolder = mysql_result($result, $i, "infolder");
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$filemaingalid'"));
    $galtype = $row['galtype'];



$i++;
}
echo "<center><strong>";

    if ($filepicid == "") {
        echo "<b><center>Error File id does not exist!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }


$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_reports WHERE picid='$filepicid' AND reportby='$reflecnick'"));
$reportby = $row['reportby'];
if ($reportby != "" && !is_admin($admin)) {
        echo "<b><center>Error You already reported this file. You can only report it Once!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
}
	$useripaddy = getenv("REMOTE_ADDR");
	$cooltime = time();
$sql9 = "INSERT INTO `" . $user_prefix . "_reflections_reports`
(`reportid`, `galid`, `picid`, `reportby`, `reportbyip`, `rawtime`)
 VALUES
('', '$filemaingalid', '$filepicid', '$reflecnick', '$useripaddy', '$cooltime')";
            if (mysql_query($sql9)) {
			echo "Report of File is OK <img src='modules/$module_name/images/okyes.gif'>";
            } else {
			echo "Report of File is NOT OK Contact Admin!<img src='modules/$module_name/images/okno.gif'>";
			}


$filetotalreports = $filetotalreports + 1;

echo "<br>";
$sql = "update " . $user_prefix . "_reflections_files set totalreports='$filetotalreports' WHERE `picid` = $filepicid";


            if (mysql_query($sql)) {
			echo "Updating File Information OK <img src='modules/$module_name/images/okyes.gif'>";
            } else {
			echo "Updating of File Information is NOT OK Contact Admin!<img src='modules/$module_name/images/okno.gif'>";
			}





if ($killfilereportedonmax == "1" && $filereportmax <= $filetotalreports) {
$sql = "update " . $user_prefix . "_reflections_files set approved='0' WHERE `picid` = $filepicid";
mysql_query($sql);

            if (mysql_query($sql)) {
			echo "<br>File is now Admin only Viewing. <img src='modules/$module_name/images/okyes.gif'>";
            }
}


echo "<br><BR>";


closetable();
include("footer.php");

?>