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

if ($upgalid == "") {
    echo "<b><center>Gallery ID No valid. Go back and fix! Sorry..</b></center>";
    closetable();
    include_once("footer.php");
    die;
}
// get main gal information
if ($uploadfiles != "") {
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$upgalid'"));
    $galid = $row['galid'];
    $parentid = $row['parentid'];
    $galtype = $row['galtype'];
    $name = $row['name'];
    $desc = $row['desc'];
    $thumb = $row['thumb'];
    $folder = $row['folder'];
    $date = $row['date'];
    $time = $row['time'];
    $rawtime = $row['rawtime'];
    $active = $row['active'];
    $password = $row['password'];
    $creator = $row['creator'];
    $memberupload = $row['memberupload'];
    $totalview = $row['totalview'];
    if ($password == "") {
    	$password = "nopassword";
    }

    // check gallery to valid fields.
    if ($galid == "") {
        echo "<b><center>Error1 $name is not a valid gallery for you to upload to.</b></center>";

        closetable();
        include_once("footer.php");
        die;
    }

    // done can goto the upload section now.
}

echo "<br><center><strong>Upload Processing Page</strong></center><br>";

// end get main gal information
$uploadNeed = $_POST['uploadNeed'];
$uploadNeed = devilcleanitup($uploadNeed);
if ($uploadNeed == "" || $uploadNeed == "0") {
    $uploadNeed = "1";
}

if ($galtype == "member") {
    $mainfolder1 = "memgallery";
} else if ($galtype == "main") {
    $mainfolder1 = "maingallery";
}
// Uploading Proccess start
for($x = 0;$x < $uploadNeed;$x++) {
    $imgSize[0] = "";
    $imgSize[1] = "";
    $damainnumber = $x + 1;
    echo "<center><strong>Upload file #$damainnumber....</center>";
    if ($_POST['fileinfo' . $x] != "") {
        $dainfo = $_POST['fileinfo' . $x];
    } else {
        $dainfo = "";
    }
    $danick = $_POST['danick' . $x];
    // Lets clean up the areas we got!!
    $dainfo = devilcleanitup($dainfo);
    $danick = devilcleanitup($danick);

        $file_name = $_FILES['userfile' . $x]['name'];
        $zufall = rand(1, 99999);
        $fupl = "$zufall";
        $file_name = $fupl . $file_name;
        // lets see if somehow random hit an already in use name and gen again.
        $checkagain = "modules/$module_name/files/$mainfolder1/$folder/fullsize/$file_name";
        if (file_exists($checkagain)) {
            $zufall = rand(111, 999);
            $fupl = "$zufall";
            $file_name = $fupl . $file_name;
        }
        if ($_POST['filename' . $x] == "") {
            $picname = "$file_name";
        } else {
            $picname = $_POST['filename' . $x];
        }
        $picname = devilcleanitup($picname);
        $dasize = $_FILES['userfile' . $x]['size'];

        if ($file_name != "") {
            $sys1 = $HTTP_POST_FILES['userfile' . $x]['name'];
            $sys1 = substr($sys1, -3);
            if (strtolower($sys1) == "gif" || strtolower($sys1) == "jpg" || strtolower($sys1) == "peg") {
                if (is_uploaded_file($HTTP_POST_FILES['userfile' . $x]['tmp_name'])) {
                    // all is well process it all!!
                    // strip file_name of slashes
                    $file_name = stripslashes($file_name);
                    $file_name = str_replace("'", "", $file_name);
                    $copy = copy($_FILES['userfile' . $x]['tmp_name'], "modules/$module_name/files/$mainfolder1/$folder/fullsize/$file_name");
                    // check if successfully copied
                    if ($copy) {
                        if (! chmod ("modules/$module_name/files/$mainfolder1/$folder/fullsize/$file_name", 0777)) {
                            echo ("Permission Error on Fullsize pic");
                        }
                        // create thumbnail here!
                        $bigfilepathwname = "modules/$module_name/files/$mainfolder1/$folder/fullsize/$file_name";
                        $thumbfilepathwname = "modules/$module_name/files/$mainfolder1/$folder/thumbs/$file_name";
                        $imgSize = wdresizeinfo("$bigfilepathwname", "$config_thumbsize");
                        $oldwidth = $imgSize[2];
                        $oldheight = $imgSize[3];
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
                        // Need to do watermarks here still!!
                        // Lets put all the info into the database!!
                        $ip1 = $_SERVER["REMOTE_ADDR"];
                        $dadate = date('y-m-d');
                        $datime = date('H:i:s');
                        $rawtime1 = time();

                        if ($requireapproval == "1") {
                            $approvalonpic = "1";
                        } else {
                            $approvalonpic = "1";
                        }

                        $sql = "INSERT INTO " . $prefix . "_reflections_files (`picid`, `galid`, `picname`, `picdesc`, `filename`, `upnick`, `ip`, `date`, `time`, `rawtime`, `approved`, `galactive`, `galpassword`, `infolder`, `galtype`, `size`, `width`, `height`) VALUES ('', '$galid', '$picname', '$dainfo', '$file_name', '$danick', '$ip1', '$dadate', '$datime', '$rawtime1', '$approvalonpic', '$active', '$password', '$folder', '$galtype', '$dasize', '$oldwidth', '$oldheight')";
                        mysql_query($sql) or die ('There was an error inserting into database');

                        echo "<a href='$origionalpic'><img src='$thumbnailpic'></a><br>Click image to fullsize View!<br>Uploaded Sucessfully!<br>";

                        echo "Filename = " . $_FILES['userfile' . $x]['name'] . " <br>";
                        echo "New Filename = $file_name <br>";
                        echo "Size of file = " . $_FILES['userfile' . $x]['size'] . " bytes <br>";
                        echo "Type of file = " . $_FILES['userfile' . $x]['type'] . " <br>";
                        if ($requireapproval == "1") {
                            echo "<b><u><i>This file Requires Approval from admin</i></b></u><br>";
                        }
                    } else {
                        echo "$file_name | could not be uploaded!<br>";
                    }
                } else {
                    echo "Possible Hacking attempt. The file is not verified as being uploaded!!";
                }
            } else {
                echo "Either empty slot or Bad file type. Only .gif .jpeg and .jpg are allowed!!";
            }
        } else {
            echo "Nothing selected for Upload slot $damainnumber";
        }
        echo "<br><hr>";


} // end of loop
// end the loop
// end upload process
closetable();
include("footer.php");

?>