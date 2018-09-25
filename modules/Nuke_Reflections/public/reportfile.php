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
    if ($galtype == "main") {
        $subfolder = "maingallery";
    } else {
        $subfolder = "memgallery";
    }
    if ($filepicid == "") {
        echo "<b><center>Error File id does not exist!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }

    $checkit = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename";
    if (file_exists($checkit)) {
        $imgSize = wdresizeinfo($checkit, "200");
        echo "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
    } else {
        $checkit = "modules/$module_name/images/thumbmissing.gif";
        $imgSize = wdresizeinfo($checkit, "200");
        echo "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
    }

echo "<br><br>Please verify the Above image is what you want to submit a report on.<br>
Also Please make sure it Violates the <a href=\"modules/$module_name/TOSFiles/uploadtos.html\">TOS Here</A> before submiting.<bR>
<br>";

    echo "<form method=\"POST\" action=\"modules.php?name=$module_name&op=reportfileprocess&fileid=$filepicid\">";
 echo "<br>Security Code<br>";
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
    echo "<br><br><input type=\"submit\" value=\"Report File\" name=\"B1\">";

    echo "</form>";



closetable();
include("footer.php");

?>