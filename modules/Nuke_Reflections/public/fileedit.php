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



if ($fileid == "") {

    echo "<b><center>Error File id was not selected to be edited!!</b></center>";

    closetable();

    include_once("footer.php");

    die;

}



$fileid = devilcleanitup($fileid);

// get file info and make sure the user is the owner.

$sql = "SELECT * FROM " . $prefix . "_reflections_files where picid='$fileid' LIMIT 1";

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

    $galid = $row['galid'];

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



    if (is_admin($admin)) {

    } else {

        if (strtolower($cookie[1]) != strtolower($fileupnick)) {

            echo "<b><center>File Edit Error! You are not the owner of this file!</b></center>";

            closetable();

            include_once("footer.php");

            die;

        }

    }



    if ($deletecomid != "") {

        $deletecomid = devilcleanitup($deletecomid);

        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_comments WHERE comid='$deletecomid'"));

        $checkcomid1 = $row['picid'];

        if ($checkcomid1 != $filepicid) {

            echo "<center><strong><hr>Error. That comment ID Does not belong to this file. Sorry!</strong></center><hr>";

        } else {

            closetable();

            opentable();

            echo "<br><center><strong><hr>------------------------ Comment id #$deletecomid Deleted ------------------------</strong></center><hr><br>";

            closetable();

            opentable();

            $filetotalcomments = $filetotalcomments - 1;



            $db->sql_query("update " . $user_prefix . "_reflections_files set totalcomments='$filetotalcomments' where picid='$filepicid'");



            $sql = "DELETE FROM " . $user_prefix . "_reflections_comments WHERE `comid` = $deletecomid";

            mysql_query($sql);

        }

    }

    // deletefilesystem

    if ($deletenow != "") {

        $deletenow = devilcleanitup($deletenow);



        echo "<center><strong>Deleting file id #$filepicid</strong></center><bR>";

        // start offical deleteing now!

        $bigfile1 = "modules/$module_name/files/$subfolder/$filefolder/fullsize/$filefilename";

        $thumbfile1 = "modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename";

        echo "<strong><u>Delete File Status</u></strong><br>";

        if (unlink($bigfile1)) {

            echo "Deleted Big file \"$bigfile1\"<br>";

        } else {

            echo "Error deleting file \"$bigfile1\" either it is missing or can not be deleted. Check permissions.<br>";

        }

        if (unlink($thumbfile1)) {

            echo "Deleted Thumb file \"$thumbfile1\"<br>";

        } else {

            echo "Error deleting file \"$thumbfile1\" either it is missing or can not be deleted. Check permissions.<br>";

        }

        echo "<strong><u>Delete File Database Entries Status</u></strong><Br>";

        $sql = "DELETE FROM " . $user_prefix . "_reflections_files WHERE `picid` = $filepicid";

        mysql_query($sql);

        echo "Delete from Files Table Complete<br>";

        $sql = "DELETE FROM " . $user_prefix . "_reflections_comments WHERE `picid` = $filepicid";

        mysql_query($sql);

        echo "Delete from Comments Table Complete<br>";

        $sql = "DELETE FROM " . $user_prefix . "_reflections_reports WHERE `picid` = $filepicid";

        mysql_query($sql);

        echo "Delete from Reports Table Complete<br>";

        echo "<bR><strong><u>File has been deleted and database entries have been removed if all looks good above!</u></strong><Br><br>";



        closetable();

        include("footer.php");

        die;

    }

    // end delete file system

    // Change the name and or desc on a file!

    if ($B3 != "") {

        // check submitted info and clean for html and stuff...

        $newpicname = devilcleanitup($newpicname);

        $newpicdesc = devilcleanitup($newpicdesc);



        $db->sql_query("update " . $user_prefix . "_reflections_files set picname='$newpicname', picdesc='$newpicdesc' where picid='$filepicid'");



        echo "<br><center><strong>Name and or Description has been updated on this file!</strong></center><bR><hr><br>";



        $filepicname = $newpicname;

        $filepicdesc = $newpicdesc;

    }

    // End change of name and or desc on a file!

    // reset stuff

    if ($reset == "totalview") {

        $db->sql_query("update " . $user_prefix . "_reflections_files set totalview='0' where picid='$filepicid'");

        $filetotalview = "0";



        echo "<br><center><strong>Total View Reset Complete</strong></center><br><hr><br>";

    } else if ($reset == "rating") {

        $db->sql_query("update " . $user_prefix . "_reflections_files set one='0', two='0', three='0', four='0', five='0', six='0', seven='0', eight='0', nine='0', ten='0', totalvote='0', advarage='0', lastvote='0', totalscore='0', lastvotenick='' where picid='$filepicid'");

        $fileone = "0";

        $filetwo = "0";

        $filethree = "0";

        $filefour = "0";

        $filefix = "0";

        $filesix = "0";

        $fileseven = "0";

        $fileeight = "0";

        $filenine = "0";

        $fileten = "0";



        $filetotalvote = "0";

        $fileadvarage = "0";

        $filelastvote = "0";

        $filetotalscore = "0";

        $filelastvotenick = "None";

        $avaragescore = "0";



        echo "<center><strong>Rating on this file has been reset</strong></center>";

        closetable();

    }

    // end reset stuff

    // Newthumb creation

    // newthumb=create

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

        // need to do watermarking system in this area still.

        echo "<br><center><strong>Thumbnail regeneration complete!</strong></center><br><hr><br>";

    }

    // end new thumb creation

    echo "<a href='modules.php?name=$module_name&op=userhome&galid=$galid'><u>Go To Gallery</u></a><br><table border='2' width='100%'><tr><td colspan='2'>";



    if (is_admin($admin)) {

        if ($fileapproved == "0") {

	$ajblue = "<br>~~~~~~~~~~~~~ File has NOT Been approved by an admin yet! ~~~~~~~~~~~~~ ";

} else {

$ajblue = "";

}



        echo "<center><strong>Admin Edit of file id #$filepicid $ajblue</strong></center>";

    } else {

        echo "<center><strong>User Edit of file id #$filepicid</strong></center>";

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

    echo "<br><br><hr>$filelastseennick";

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



if (is_admin($admin)) {

	if ($fileapproved == "1") {

	$approvedicon = " || <a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=dissapprove' onMouseover=\"ddrivetip('<b> <center>Click to Admin Disapprove File </center></b>','white', 300)\"; onMouseout=\"hideddrivetip()\"><img src='modules/$module_name/images/disapprove.gif' border='0'></a>";

} else {

	$approvedicon = " || <a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=approve'onMouseover=\"ddrivetip('<b> <center>Click to Admin Approve File </center></b>','white', 300)\"; onMouseout=\"hideddrivetip()\"><img src='modules/$module_name/images/approve.gif' border='0'></a>";

}



} else {

$approvedicon = "";

}



    echo "

<form method='POST' action='modules.php?name=$module_name&op=fileedit&fileid=$filepicid'>

<p align='left'>

<b>Filename :: $filefilename</b><br>

<b><u>Name on file</u></b><br><input type='text' name='newpicname' size='20' value='$filepicname'><br>

<b><u>Description</u></b><br><input type='text' name='newpicdesc' size='20' value='$filepicdesc'>

</p>

<button name='B3' value='savenew' type='submit' onMouseover=\"ddrivetip('<b> <center>Save Changes </center></b>','white', 300)\"; onMouseout=\"hideddrivetip()\"><img src='modules/$module_name/images/save.gif'></button>

 || <button name='B3' value='reset' type='reset' onMouseover=\"ddrivetip('<b> <center>Reset the form</center> </b>','white', 300)\"; onMouseout=\"hideddrivetip()\"><img src='modules/$module_name/images/reset.gif'></button>

 || <a onclick=\"deviltag1();\" onMouseover=\"ddrivetip('<b> <center>Delete this file </center></b>','white', 300)\"; onMouseout=\"hideddrivetip()\"><img height='16' width='16' src='modules/$module_name/images/delete.gif'></a>$approvedicon

</form>



<div id='deviltag1' class='deviltag1hidden'>

";



    echo "<form method='POST' action='modules.php?name=$module_name&op=fileedit&fileid=$filepicid'>";

    echo "Are you sure you want to delete this file?<br>";

    echo "<input type='submit' value='Yes Delete Now!' name='deletenow'>";



    echo "

</div>



<hr>



<table id='fileinfo1' name='fileinfo1' width='100%' border='0'>

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

Total Views </td><td>:: $filetotalview || <a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid&reset=totalview'><img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'><u>Reset</u><img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'></a></td>

</td></tr><tr><td align='right'>

Last Seen by </td><td>:: $filelastseennick</td>

</td></tr>



</table>







";



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



File Rating :: $avaragescore || <a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid&reset=rating'><img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'> <u><b>Reset Score</u></b> <img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'></a>

 || Last Rated at :: $filelastvote





	</centeR>";



        echo "</td></tr>	";

    } else {

        echo "<tr><td colspan='2'><strong><center>No Ratings on this file</strong></center></td></tr>";

    }



    echo "<tr><td colspan='2'><strong>";

    echo "<br>Comments on this file <i>(Newest from Top to Bottom)</i><hr>";



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

            echo " - Ip Address :: $byipaddy - <a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid&deletecomid=$comid'>Delete Comment</a>";

        } else if ($allowmemberdelcomment == "1") {

            echo " - <a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid&deletecomid=$comid'>Delete Comment</a>";

        }

        echo "<br>------------------------------------------------------------------------------------------<br>";



        $i++;

    }



    echo "</strong></td></tr>";



    echo "</table>";



    closetable();

    include("footer.php");

    $i++;

}



?>