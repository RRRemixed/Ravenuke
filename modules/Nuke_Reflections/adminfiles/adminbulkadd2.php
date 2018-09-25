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

if ($Submit == "Submit" && $totalfilestoadd != "") {
    if ($galid == "") {
        echo "<center><br><b>Error. You must select a Gallery!<br>";
        echo "<a href=\"javascript:history.go(-1);\"><u>Go Back</u></a><br><br><hr>";
        closetable();
        include_once("footer.php");
    }



    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
    $galfolder = $row['folder'];
    $galpassword = $row['password'];
    $galactive = $row['active'];
    $galname = $row['name'];
    $galtype = $row['galtype'];

    if ($galtype == "member") {
        $galtype = "memgallery";
    } else if ($galtype == "main") {
        $galtype = "maingallery";
    }

    echo "<br><strong>Adding to Gallery :: $galname<br>Image Sizes were reduced for previewing only.<br>If you see a thumbnail and fullsize image in each spot then all is good!! :)</strong><br>";

    $i = 1;

    while ($i <= $totalfilestoadd) {
        if ($_POST['bulk' . $i] != "") {
            $dainfo = $_POST['bulk' . $i];
            $filedesc1 = $_POST['filedesc' . $i];
            $fileinfo = devilcleanitup($filedesc1);
            $filename = $_POST['filename' . $i];
            $oldfullpath = $_POST['bulk' . $i];
            // add files with this area
            // Make new filenames
            $zufall = rand(1, 99);
            $fupl = "$zufall";
            $zufall2 = rand(111, 999);
            $fupl2 = "$zufall2";
            $realname = strtolower($filename);
            $realname = $fupl . $fupl2 . $realname;
            $superman = "modules/$module_name/files/$galtype/$galfolder/fullsize/$realname";
            if (! rename("$oldfullpath", "$superman")) {
                echo "could not copy. $oldfullpath and modules/$module_name/files/$galtype/$galfolder/fullsize/$realname ";
            }

            $bigfilepathwname = "modules/$module_name/files/$galtype/$galfolder/fullsize/$realname";
            $thumbfilepathwname = "modules/$module_name/files/$galtype/$galfolder/thumbs/$realname";
            $imgSize = wdresizeinfo("$bigfilepathwname", "$config_thumbsize");
            $oldwidth = $imgSize[2];
            $oldheight = $imgSize[3];
            $origionalpic = "$bigfilepathwname";
            $thumbnailpic = "$thumbfilepathwname";
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

            $imgSizethumb = wdresizeinfo($thumbfilepathwname, 100);
            $imgSizefull = wdresizeinfo($bigfilepathwname, 100);

            echo "Thumbnail Image File :: $realname <img src='$thumbfilepathwname' width='$imgSizethumb[0]' height='$imgSizethumb[1]'> <br>Fullsize Image File :: $realname<img src='$bigfilepathwname' width='$imgSizefull[0]' height='$imgSizefull[1]'><br>";
   echo "<hr>";

            // Lets put all the info into the database!!
            $ip1 = $_SERVER["REMOTE_ADDR"];
            $dadate = date('y-m-d');
            $datime = date('H:i:s');
            $rawtime1 = time();

            $approvalonpic = "1";

            $dafilesize = filesize($bigfilepathwname);

            if ($cookie[1] == "") {
                $danick = "Guest";
            } else {
                $danick = "$cookie[1]";
            }

            $sql = "INSERT INTO " . $prefix . "_reflections_files (`picid`, `galid`, `picname`, `picdesc`, `filename`, `upnick`, `ip`, `date`, `time`, `rawtime`, `approved`, `galactive`, `galpassword`, `infolder`, `galtype`, `size`, `width`, `height`) VALUES ('', '$galid', '$realname', '$fileinfo', '$realname', '$danick', '$ip1', '$dadate', '$datime', '$rawtime1', '$approvalonpic', '$galactive', '$galpassword', '$galfolder', '$galtype', '$dafilesize', '$oldwidth', '$oldheight')";
            mysql_query($sql) or die ('There was an error inserting into database');
            // Stop Adding files.
        }

        $i++;
    } // while
} else {
    echo "<center><br><b>Error. No files in the bulk add folder.<br>";
    echo "<a href=\"javascript:history.go(-1);\"><u>Go Back</u></a><br><br><hr>";
    closetable();
    include_once("footer.php");
}

closetable();
include("footer.php");
die;

?>