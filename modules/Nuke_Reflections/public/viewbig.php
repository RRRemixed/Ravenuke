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




$fileid = devilcleanitup($picid);

if ($fileid == "") {
    echo "<b><center>Error File id was not selected to be Viewed!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}
if ($vote != "") {
    $vote = devilcleanitup($vote);
    include_once("modules/$module_name/public/voteit.php");
    global $arleighdaman;
}
// Load java gallsystem

?>

<link rel="stylesheet" type="text/css" href="modules/<?php echo $module_name;
?>/includes/gallerystyle2.css" />

<!-- Do not edit IE conditional style below -->
<!--[if gte IE 5.5]>
<style type="text/css">
#motioncontainer {
width:expression(Math.min(this.offsetWidth, maxwidth)+'px');
}
</style>
<![endif]-->
<!-- End Conditional Style -->

<script type="text/javascript" src="modules/<?php echo $module_name;
?>/includes/motiongallery2.js">

/***********************************************
* CMotion Image Gallery- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
* This notice must stay intact for legal use
* Modified by Jscheuer1 for autowidth and optional starting positions
***********************************************/

</script>




<?php
// end load java gal system
// get file info and make sure the user is the owner.
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
    $usergalcreator = $row['creator'];

    if ($filepicid == "") {
        echo "<b><center>Error File id does not exist!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // check for password and present login form!

if (!is_admin($admin) && strtolower($cookie[1]) != strtolower($usergalcreator)) {
    if ($filepassword != "nopassword") {
        $row222 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_logins WHERE galid='$filemaingalid' AND galpassword='$filepassword' AND username='$cookie[1]'"));
        $checkpassstatus = $row222['id'];

        if ($checkpassstatus != "") {
            // ok
        } else {
            // show login form!
            Header("Location: modules.php?name=$module_name&op=login&galid=$filemaingalid");
        }
    }
}
	// end check for password!
    if ($fileapproved == "0" && !is_admin($admin)) {
        echo "<b><center>This file has not been approved by the admin yet!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }

    if ($deletecomid != "") {
        if ($fileupnick == "$cookie[1]" || is_admin($admin)) {
            if (is_admin($admin) || $allowmemberdelcomment == "1") {
                $deletecomid = devilcleanitup($deletecomid);
                $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_comments WHERE comid='$deletecomid'"));
                $checkcomid1 = $row['picid'];
                if ($checkcomid1 != $filepicid) {
                    $arleighdaman = "Error. That comment ID Does not belong to this file. Sorry!";
                } else {
                    $arleighdaman = "Comment id #$deletecomid Deleted";
                    $filetotalcomments = $filetotalcomments - 1;
                    $db->sql_query("update " . $user_prefix . "_reflections_files set totalcomments='$filetotalcomments' where picid='$filepicid'");
                    $sql = "DELETE FROM " . $user_prefix . "_reflections_comments WHERE `comid` = $deletecomid";
                    mysql_query($sql);
                }
            }
        }
    }

    if ($galtype == "main") {
        $subfolder = "maingallery";
    } else {
        $subfolder = "memgallery";
    }

    if ($filetotalvote != "0" && $filetotalvote != "") {
        $avaragescore = round($filetotalscore / $filetotalvote, 1);
    } else {
        $avaragescore = "0";
    }

    if ($filepicdesc == "") {
        $filepicdesc = "No Description Yet";
    }
    // Add comments to the system
    if ($B1 != "" && $T1 != "" && $picid != "") {
        $T1 = devilcleanitup($T1);
        $picid = devilcleanitup($picid);
        include_once("modules/$module_name/public/commentit.php");
        global $arleighdaman;
    }
    // end comments add to the system
    if ($filelastvotenick == "Guest") {
        $lastvoter = "Guest";
    } else if ($filelastvotenick != "") {
        $lastvoter = "<a href='modules.php?name=Your_Account&op=userinfo&username=$filelastvotenick'><u>$filelastvotenick</u></a>";
    } else {
        $lastvoter = "None Yet!";
    }

    $counttimer = round(5 * 60);

    $past = time() - $counttimer;
    $sql = "DELETE FROM " . $prefix . "_reflections_viewcounts WHERE rawtime < $past";
    $db->sql_query($sql);

    $filecode = $filepicid;

    $useripaddy = getenv("REMOTE_ADDR");
    if (is_user($user)) {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_viewcounts where nick='$cookie[1]' AND picid='$filecode'"));
        $supergreat = "$cookie[1]";
    } else {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_viewcounts where ipaddy='$useripaddy' AND picid='$filecode'"));
        $supergreat = "$useripaddy";
    }
    $viewcountcheck = $row6['rawtime'];

    if ($viewcountcheck == "0" || $viewcountcheck == "") {
        // update
        if ($filetotalview == "") {
            $filetotalview = "1";
        } else {
            $filetotalview = $filetotalview + 1;
        }

        $db->sql_query("update " . $prefix . "_reflections_files set totalview='$filetotalview', lastseennick='$cookie[1]' WHERE picid='$filecode'");
        $cooltime = time();
        $sql9 = "INSERT INTO `" . $user_prefix . "_reflections_viewcounts` (`id`, `picid`, `nick`, `ipaddy`, `rawtime`) VALUES ('', '$fileid', '$cookie[1]', '$useripaddy', '$cooltime')";
        mysql_query($sql9);
    } else {
        // dont update
    }

    if ($newthumb == "create") {
        $bigfilepathwname = "modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";
        $thumbfilepathwname = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename";
        $imgSize = wdresizeinfo("$bigfilepathwname", "$config_thumbsize");

        $origionalpic = "$bigfilepathwname";
        $thumbnailpic = "$thumbfilepathwname";
        // wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);
        wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);

        if ($watermark == "1") {
            $bluegone = "$bigfilepathwname";
            $greenyellow1 = makewatermark($bluegone, $watermark_text1, $watermark_text2);
            $bluegone = "$thumbfilepathwname";
            $greenyellow1 = makewatermark($bluegone, $watermark_text1, $watermark_text2);
        } else if ($watermark == "2") {
            $bluegone = "$bigfilepathwname";
            $greenyellow1 = makewatermark1($bluegone, $watermark_text1, $watermark_text2, "fullsize");
            $bluegone = "$thumbfilepathwname";
            $greenyellow1 = makewatermark1($bluegone, $watermark_text1, $watermark_text2, "thumbnail");
        } else if ($watermark == '3' AND $watermarkimage != "") {
            $checkit = "$watermarkimage";
            if (file_exists($checkit)) {
                // proccess watermarking
                waterMarkimage($bigfilepathwname, $watermarkimage);
                waterMarkimage($thumbfilepathwname, $watermarkimage);
            } else {
                echo "<br><STRONG><I><center>Watermark image is set wrong. Please fix!!</STRONG></I></center><br>";
            }
        }

        echo "<br><center><strong>Thumbnail regeneration complete!</strong></center><br><hr><br>";
    }
    // end new thumb creation
    if ($arleighdaman != "") {
        title($arleighdaman);
    }

    echo "<table border='2' width='100%'><tr><td colspan='2'>";

    if (is_admin($admin)) {
        if ($fileapproved == "0") {
            $ajblue = "<br>~~~~~~~~~~~~~ File has NOT Been approved by an admin yet! ~~~~~~~~~~~~~ ";
        } else {
            $ajblue = "";
        }
echo "<a href=\"modules.php?name=$module_name&op=showgal&galid=$filemaingalid\"><strong><u>Go to Image Gallery</u></strong></a>";
        echo "<center><strong>Admin View of file id #$filepicid $ajblue</strong></center>";
    } else {
        echo "<center><strong>User View of file id #$filepicid</strong></center>";
    }
    echo "</td></tr><tr><td align='center' valign='top'>
<strong>Thumbnail</strong><br>";
    // check the thumb and show if availible!!
    $checkit = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename";
    if (file_exists($checkit)) {
        $imgSize = wdresizeinfo($checkit, "200");
        echo "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
    } else {
        $checkit = "modules/$module_name/images/thumbmissing.gif";
        $imgSize = wdresizeinfo($checkit, "200");
        echo "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'><br>
<a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid&newthumb=create'><u><strong>
Click here to generate<bR>
A new one if the main<br>
image is still live!</u></strong></a><br>
";
    }
    echo "<br><br><hr>";
    if ($filelastseennick == "") {
        $filelastseennick = "None";
    }

    $checkit = "modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";
    if (file_exists($checkit)) {
        $system = explode(".", $checkit);
        if (preg_match("/jpg|JPG|JPEG|jpeg/", $system[1])) {
            $src_img = imagecreatefromjpeg($checkit);
        }
        if (preg_match("/gif|GIF/", $system[1])) {
            $src_img = imagecreatefromgif($checkit);
        }
        $old_x = imageSX($src_img);
        $old_y = imageSY($src_img);
    }

    echo "
<p align='left'>
<b>Filename :: $filefilename</b><br>
<b><u>Name on file</u></b><br>$filepicname<br>
<b><u>Description</u></b><br>$filepicdesc<br>
</p>



<hr>

<table id='fileinfo1' name='fileinfo1' width='100%' border='0'>
<tr><td colspan='2' align='center'><strong><u>Image Information</u></strong></td></tr>
<tr><td align='right'>
Image WxH </td><td>:: " . $old_x . "x" . $old_y . "
</td></tr><tr><td align='right'>";

    $checkit = "modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";
    if (file_exists($checkit)) {
        $dafilesize = filesize($checkit);
        if ($dafilesize >= 1000 && $dafilesize < 1000000) {
            $dafilesize = round($dafilesize / 1000, 2);
            $amount1 = "kb's";
        } else if ($dafilesize >= 1000000) {
            $dafilesize = round($dafilesize / 1000, 2);
            $dafilesize = round($dafilesize / 1000, 2);
            $amount1 = "mb's";
        }

        echo "File Size </td><td>:: $dafilesize $amount1";
    } else {
        echo "File Size </td><td>:: 00000 bytes";
    }

    echo "</td></tr><tr><td align='right'>
Total Views </td><td>:: $filetotalview </td>
</tr><tr><td align='right'>
Last Seen by </td><td>:: $filelastseennick</td>
</tr>
<tr><td colspan=\"2\" align=\"center\">
<a href=\"modules.php?name=$module_name&op=reportfile&fileid=$picid\"><strong>[ Report File ]</strong></a>
</td></tr>";

global $nukeurl;
if ($showbbcodesystem == "1" && is_user($user)) {
$thumpath = "$nukeurl/modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename";
$fullpath = "$nukeurl/modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";
echo "

<tr><td colspan=\"2\" align=\"center\"><hr>
bbcode<br><input style='font-size:10; font-weight: 700' size=\"20\" type=\"text\" name=\"bbcodebox\" value=\"[url=$fullpath][img]".$thumpath."[/img][/url]\" /><br>
html code<br><input style='font-size:10; font-weight: 700' size=\"20\" type=\"text\" name=\"htmlcodebox\" value=\"<a href=&quot;$fullpath&quot;><img src=&quot;$thumpath&quot;></a>\" /><br>
</td></tr>";


}


echo "</table>";

    if (is_user($user) && strtolower($cookie[1]) == strtolower($fileupnick)) {
        echo "<hr><strong><u>Owner Options</strong></u><br>";
        echo "


<a href='modules.php?name=$module_name&op=fileedit&fileid=$picid'><img src='modules/$module_name/images/edit.png' border='0'></a> || <a href='modules.php?name=$module_name&op=deletefile&fileid=$picid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a> ";
if ($SoNTransferallow == "1") {
echo " || <a href='modules.php?name=$module_name&op=sonsystem&picid=$picid'><img src='modules/$module_name/images/transfer.jpg' height='16' width='16' border='0'></a>";
}


echo "<br>";
    }

    if (is_admin($admin)) {
        echo "<hr><strong><u>Admin Options</strong></u><br>";
        if ($fileapproved == "1") {
            $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=dissapprove'><img src='modules/$module_name/images/disapprove.gif' border='0'></a> || ";
        } else {
            $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=approve'><img src='modules/$module_name/images/approve.gif' border='0'></a> || ";
        }
        echo "

$approvedicon<a href='modules.php?name=$module_name&adminarea=adminfileedit&fileid=$picid'><img src='modules/$module_name/images/edit.png' border='0'></a> || <a href='modules.php?name=$module_name&adminarea=admindeletefile&fileid=$picid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a> || <a href='modules.php?name=$module_name&op=sonsystem&picid=$picid'><img src='modules/$module_name/images/transfer.jpg' height='16' width='16' border='0'></a>


<br>";
    }

    echo "</td>";

    echo "<td align='center' valign='top'>
<strong>Reduced Fullsize Image</strong><br><i>Click image for new window Full Size</i><br>
";
    $checkit = "modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";
    if (file_exists($checkit)) {
        $imgSize = wdresizeinfo($checkit, "500");
        echo "<a href='$checkit' target='_blank'><img src='$checkit' width='$imgSize[0]' height='$imgSize[1]' border='0'></a>";
    } else {
        echo "<strong>System Error. Big file is missing for this file.</strong>";
    }

    echo "</td>";

    echo "</tr>";
    // get 5 images before and after this image.
    global $javapicname, $javapicid;
    $javapicid = getimagesforjava($filepicid, $filemaingalid, "1", "0");
    $javapicname = getimagesforjava($filepicid, $filemaingalid, "0", "1");
    echo "<tr><td colspan='2'><center><b>Others from this gallery<br>";

    $i90 = 0;

    ?>
<div id="motioncontainer" style="position:relative;overflow:hidden;">
<div id="motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;">
<nobr id="trueContainer">
<?php

    while ($i90 != 7) {
        if ($javapicname[$i90] != "") {
            if ($javapicid[$i90] == $filepicid) {
            $dafile1 = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$javapicname[$i90]";
                $imgSize10 = wdresizeinfo("$dafile1", "120");
                echo "<img src=\"modules/$module_name/files/$subfolder/$filefolder/thumbs/" . $javapicname[$i90] . "\" border=\"3\" height=\"$imgSize10[1]\" width=\"$imgSize10[0]\">";
            echo "<img src=\"modules/$module_name/images/pixel.gif\" border=\"0\" height=\"121\" width=\"3\">";
            } else {
                $dafile1 = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$javapicname[$i90]";
                $imgSize10 = wdresizeinfo("$dafile1", "100");
                echo "<a href=\"modules.php?name=$module_name&op=viewbig&picid=" . $javapicid[$i90] . "\"><img src=\"modules/$module_name/files/$subfolder/$filefolder/thumbs/" . $javapicname[$i90] . "\" border=\"0\" height=\"$imgSize10[1]\" width=\"$imgSize10[0]\"></a>";
            echo "<img src=\"modules/$module_name/images/pixel.gif\" border=\"0\" height=\"121\" width=\"3\">";

            }
        } else {
            echo "<img src=\"modules/$module_name/images/pixel.gif\" border=\"0\" height=\"121\" width=\"1\">";
        }
        $i90++;
    } // while

    ?>
</nobr>
</div>
</div>

<?php

    echo "</td></tr>";

    if ($guestvote == "1" || is_user($user) || is_admin($admin)) {
        $superman123 = "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=01'><img src='modules/$module_name/images/rate1.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=02'><img src='modules/$module_name/images/rate2.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=03'><img src='modules/$module_name/images/rate3.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=04'><img src='modules/$module_name/images/rate4.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=05'><img src='modules/$module_name/images/rate5.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=06'><img src='modules/$module_name/images/rate6.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=07'><img src='modules/$module_name/images/rate7.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=08'><img src='modules/$module_name/images/rate8.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=09'><img src='modules/$module_name/images/rate9.gif' border='0'></a>";
        $superman123 = $superman123 . "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&vote=10'><img src='modules/$module_name/images/rate10.gif' border='0'></a>";
        echo "<tr><td colspan='2'><center><b>Rate this file.<br>
$superman123
";
        echo "</td></tr>";
    }

    if ($filetotalvote != "" && $filetotalvote != "0") {
        $filetotal = $filetotalvote;
        echo "<tr><td colspan='2'><center><b>Current Rating Table<br>
	<table width=\"100%\" height=\"150\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
        echo "<tr valign=\"bottom\">";
        $tall = number_format(($fileone / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"1 :: $fileone out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"1 :: $fileone out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filetwo / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"2 :: $filetwo out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"2 :: $filetwo out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filethree / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"3 :: $filethree out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"3 :: $filethree out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filefour / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"4 :: $filefour out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"4 :: $filefour out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filefive / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"5 :: $filefive out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"5 :: $filefive out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filesix / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"6 :: $filesix out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"6 :: $filesix out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($fileseven / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"7 :: $fileseven out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"7 :: $fileseven out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($fileeight / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"8 :: $fileeight out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"8 :: $fileeight out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($filenine / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"9 :: $filenine out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"9 :: $filenine out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        $tall = number_format(($fileten / $filetotal) * 150, 0);
        if ($tall != 0) {
            echo "<td align=\"center\" valign\"bottom\" title=\"10 :: $fileten out of $filetotal\"><img src=\"modules/$module_name/images/rate.gif\" height=\"$tall\" width=\"10\"></td>";
        } else {
            echo "<td align=\"center\" valign\"bottom\" title=\"10 :: $fileten out of $filetotal\"><img src=\"modules/$module_name/images/pixel.gif\" height=\"2\" width=\"10\"></td>";
        }
        echo "</tr>";
        echo "<tr>";
        echo "<td align=\"center\"><b>1</b></td>";
        echo "<td align=\"center\"><b>2</b></td>";
        echo "<td align=\"center\"><b>3</b></td>";
        echo "<td align=\"center\"><b>4</b></td>";
        echo "<td align=\"center\"><b>5</b></td>";
        echo "<td align=\"center\"><b>6</b></td>";
        echo "<td align=\"center\"><b>7</b></td>";
        echo "<td align=\"center\"><b>8</b></td>";
        echo "<td align=\"center\"><b>9</b></td>";
        echo "<td align=\"center\"><b>10</b></td>";
        echo "</tr>";
        echo "</table><center>

File Rating :: $avaragescore || Last Voted By :: $lastvoter || Last Rated at :: $filelastvote


	</centeR>";

        echo "</td></tr>	";
    } else {
        echo "<tr><td colspan='2'><strong><center>No Ratings on this file</strong></center></td></tr>";
    }

    echo "<tr><td colspan='2'><strong>";

    if ($allowguestcomment == "1" || is_user($user) || is_admin($admin)) {
        echo "<form method=\"POST\" action=\"modules.php?name=$module_name&op=viewbig&picid=$fileid\">";
        echo "Comment :: <input type=\"text\" name=\"T1\" size=\"80\"><bR>";

if ($commentsecurity != "1") {
} else {

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
            $color1 = "<img src=\"modules/$module_name/images/blue.gif\">";
        }
        if ($maincode == "2") {
            $green = $apple2;
            $color1 = "<img src=\"modules/$module_name/images/green.gif\">";
        }
        if ($maincode == "3") {
            $green = $apple3;
            $color1 = "<img src=\"modules/$module_name/images/red.gif\">";
        }
                if ($maincode == "4") {
            $green = $apple4;
            $color1 = "<img src=\"modules/$module_name/images/yellow.gif\">";
        }
        echo "<input type=\"hidden\" name=\"securitycode\" size=\"80\" value=\"$green\">";
        echo "Please re-enter code in the $color1 box to submit your comment.<br><input type=\"text\" name=\"securitycode1\" size=\"6\"><br>";





}

        echo "<br><input type=\"submit\" value=\"Submit\" name=\"B1\">";
        echo "<input type=\"reset\" value=\"Reset\" name=\"B2\">";
        echo "</form>";
    }

    echo "Comments on this file <i>(Newest from Top to Bottom)</i><hr>";

    $sql = "SELECT * FROM " . $user_prefix . "_reflections_comments where picid='$filepicid' order by rawtime DESC";

    $result = mysql_query($sql) or die ('SQL Select Failed!!');

    $num = mysql_numrows($result);

    $i = 0;

    while ($i < $num) {
        $comid = mysql_result($result, $i, "comid");

        $picid = mysql_result($result, $i, "picid");

        $galid = mysql_result($result, $i, "galid");

        $comment = mysql_result($result, $i, "comment");

        $date = mysql_result($result, $i, "date");

        $time = mysql_result($result, $i, "time");

        $rawtime = mysql_result($result, $i, "rawtime");

        $bynick = mysql_result($result, $i, "bynick");

        $byipaddy = mysql_result($result, $i, "byipaddy");

        if ($bynick != "Guest" && $bynick != "") {
            $bynick = "<a href='modules.php?name=Your_Account&op=userinfo&username=$bynick'><u>$bynick</u></a>";
        }

        echo "</strong>Comment :: <strong>$comment</strong><br><br>

	Left by :: <strong>$bynick</strong> - On $date";

        if (is_admin($admin)) {
            echo " - Ip Address :: $byipaddy - <a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&deletecomid=$comid'>Delete Comment</a>";
        } else if ($fileupnick == $cookie[1] && is_user($user) && $allowmemberdelcomment == "1") {
            echo " - <a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid&deletecomid=$comid'>Delete Comment</a>";
        }

        echo "<br>------------------------------------------------------------------------------------------<br>";

        $i++;
    }

    if ($num == "") {
        echo "</strong><strong><center>No Comments Yet!</center></strong><br>";
    }

    echo "</strong></td></tr>";

    echo "</table>";

    closetable();
    include("footer.php");
    $i++;
}

?>