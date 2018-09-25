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

	    echo "<b><center>You are not an admin. LEAVE NOW!</b></center>";

        closetable();

        include_once("footer.php");

        die;

}







if ($fileid == "") {

    echo "<b><center>Error File id was not selected to be deleted!!</b></center>";

    closetable();

    include_once("footer.php");

    die;

}

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

    if ($galtype == "main") {

        $subfolder = "maingallery";

    } else {

        $subfolder = "memgallery";

    }



    // deletefilesystem

    if ($deletenow != "") {

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





		if ($goback == "approval") {

				header("Location: modules.php?name=$module_name&adminarea=approvalpage&somethinggood=beendeleted"); /* Redirect browser */



		}

		if ($goback == "report") {

				header("Location: modules.php?name=$module_name&adminarea=reportpage&somethinggood=beendeleted"); /* Redirect browser */



		}



		        closetable();

                include("footer.php");

                die;





    } else {



	echo "<br><center><strong>Are you sure you want to delete this file?<bR>

	<a href='modules.php?name=$module_name&adminarea=admindeletefile&fileid=$filepicid&deletenow=yes'><u>YES</u></a>

	<br><br>

	<img src='modules/$module_name/files/$subfolder/$filefolder/thumbs/$filefilename'><br>

	<br>

	<a href='modules.php?name=$module_name&adminarea=admindeletefile&fileid=$filepicid&deletenow=yes'><u>YES</u></a><br>

	";













	}

    // end delete file system

    closetable();

    include("footer.php");

    $i++;

}



?>