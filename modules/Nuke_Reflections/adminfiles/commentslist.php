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


echo "<br><br><center><strong><u>Admin Approval List</u></strong><br><br>";

if ($somethinggood == "beenapproved") {
	echo "<hr><strong>File Was Approved Thank you!</strong><hr><Br>";
}
if ($somethinggood == "beendeleted") {
	echo "<hr><strong>File Was Deleted Thank you!</strong><hr><Br>";
}




echo "<table border=\"1\" width=\"100%\">";
echo "<tr>";
$tr = "0";
$sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE totalcomments!='0' ORDER BY `rawtime` DESC";
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

if ($galtype == "main") {
$mainlocation = "maingallery";
} else {
$mainlocation = "memgallery";
}

if ($filefilename == "") {
	$filefilename = "asdasdasdasdasdasdasd.asd";
}
$checkitthumb = "modules/$module_name/files/$mainlocation/$filefolder/thumbs/$filefilename";
$checkitfull = "modules/$module_name/files/$mainlocation/$filefolder/fullsize/$filefilename";

if ($tr == "4") {
	echo "</tr><tr>";
$tr = "1";
} else {
$tr++;
}

echo "<td align=\"center\" valign=\"bottom\">";
if (file_exists($checkitthumb)) {
$imgSize = wdresizeinfo($checkitthumb, '150');
echo "<a href=\"$checkitfull\" target=\"_blank\"><img src=\"$checkitthumb\" width=\"$imgSize[0]\" height=\"$imgsize[1]\"></a> <br>";
} else {
echo "<a href=\"$checkitfull\" target=\"_blank\">Thumbnail is Missing.</a><br>";
}
if (file_exists($checkitfull)) {
echo "Fullsize Exists <img src='modules/$module_name/images/okyes.gif'><br>";
} else {
echo "Fullsize Exists <img src='modules/$module_name/images/okno.gif'><Br>";
}
if (file_exists($checkitthumb)) {
echo "Thumbnail Exists <img src='modules/$module_name/images/okyes.gif'><br>";
} else {
echo "Thumbnail Exists <img src='modules/$module_name/images/okno.gif'><br>";
}



echo "<a href=\"modules.php?name=$module_name&op=viewbig&picid=$filepicid\">[More Info]</a><br>";


echo "</td>";



$i++;
}
echo "</tr></table>";
closetable();
include_once("footer.php");
die;
?>