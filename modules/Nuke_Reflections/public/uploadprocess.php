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











if ($membersecurityupload == "1") {

	if ($securitycode1 != "" && $securitycode != "") {
    $securitycode1 = md5($securitycode1);
    if ($securitycode == $securitycode1) {
    //security code ok. Let it go through
    } else {
		echo "<b><center>You entered an incorrect security code! Go back and try again.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
} else {
		echo "<b><center>You entered an incorrect security code! Go back and try again.</b></center>";
        closetable();
        include_once("footer.php");
        die;
}

}


if ($reflecnick == "Guest" && !is_admin($admin)) {
    echo "<b><center>You must be an admin or a registered and logged in user to make a gallery!! Please login!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($allowmemberupload == "0" && !is_admin($admin)) {
    echo "<b><center>Member upload has been turned off by the admin. Sorry.</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($upgalid == "") {
    echo "<b><center>Gallery ID Not valid. Go back and fix! Sorry..</b></center>";
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

    if ($galtype == "member" && strtolower($creator) != strtolower($cookie[1])) {
        echo "<b><center>$name is not a valid gallery for you to upload to.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    if ($galtype == "main" && $memberupload != "1") {
        echo "<b><center>$name is not a valid gallery for you to upload to.</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // done can goto the upload section now.
}
// end get main gal information
$uploadNeed = $_POST['uploadNeed'];
$uploadNeed = devilcleanitup($uploadNeed);
if ($uploadNeed == "" || $uploadNeed == "0") {
    $uploadNeed = "1";
}
if ($allowmembermulti == "0") {
    $uploadNeed = "1";
} else {
    if ($membermultilimit <= $uploadNeed) {
        $uploadNeed = "$membermultilimit";
    }
}

if ($galtype == "member") {
    $mainfolder1 = "memgallery";
} else if ($galtype == "main") {
    $mainfolder1 = "maingallery";
}
// Uploading Proccess start
for($x = 0;$x < $uploadNeed;$x++) {


global $notify_email;

$fh = fopen($HTTP_POST_FILES['userfile' . $x]['tmp_name'], 'r');
$theData = fread($fh, filesize($HTTP_POST_FILES['userfile' . $x]['tmp_name']));
fclose($fh);
$pos = strpos($theData, "php");
if ($pos != "") {

$to = "$notify_email";
$subject = "Hack Attempt On Nuke Reflections Module!";
$body = "There was a hack attempt at your site. File was NOT uploaded
with php hack code! \n User name is $cookie[1] .. User IP is ".$_SERVER['REMOTE_ADDR']." \n Please take note of this. Upload was Stopped!!";
if (mail($to, $subject, $body)) {
  echo("<p>Message successfully sent!</p>");
 } else {
  echo("<p>Message delivery failed...</p>");
 }

    echo "<center><Strong><h1>Hack Attempt!!!<br>
    YOU ARE NO LONGER WELCOMED HERE!! Info Sent to admin!!</h1></strong></center>";
    closetable();
include_once("footer.php");
    die;
}



    $imgSize[0] = "";
    $imgSize[1] = "";
    $damainnumber = $x + 1;
    $realname1232 = $_FILES['userfile' . $x]['name'];
if ($realname1232 != "") {
    echo "<center><strong>Upload file #$damainnumber....</center>";
}
    if ($_POST['fileinfo' . $x] != "") {
        $dainfo = $_POST['fileinfo' . $x];
    } else {
        $dainfo = "";
    }
    $danick = $cookie[1];
    // Lets clean up the areas we got!!
    $dainfo = devilcleanitup($dainfo);
    $danick = devilcleanitup($danick);



       //check amount of disk space the user has used
    $mainsize = '0';
    $sql1 = "SELECT * FROM " . $prefix . "_reflections_files WHERE galtype='member' AND upnick='$cookie[1]'";
    $result1 = mysql_query($sql1);
    $num1 = mysql_numrows($result1);
    $i1 = 0;
    while ($i1 < $num1) {
    $dasize = mysql_result($result1, $i1, "size");
    $mainsize = $mainsize + $dasize;
    $i1++;
    }
$realname123 = $_FILES['userfile' . $x]['name'];
if ($realname123 != "") {

	if ($galtype == "member" && $memberlimit == "1" && $membermaxsize <= $mainsize) {
		        echo "<br><b>You have reached your max limit for a user gallery. Used = $mainsize :: Max = $membermaxsize</b><br><BR><hr>";

	} else {
echo "Used = $mainsize :: Max = $membermaxsize<br>";

}
    //end check



    // Lets to a flood/refresh test.
    $counttimer = round(5 * 60);
    $realname = $_FILES['userfile' . $x]['name'];
    $realsize = $_FILES['userfile' . $x]['size'];
    $past = time() - $counttimer;
    $sql = "DELETE FROM " . $prefix . "_reflections_antirepetup WHERE rawtime < $past";
    $db->sql_query($sql);

	$useripaddy = getenv("REMOTE_ADDR");
    if (is_user($user)) {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_antirepetup where nick='$cookie[1]' AND filename='$realname' AND size='$realsize'"));
        $supergreat = "$cookie[1]";
    } else {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_antirepetup where ipaddy='$useripaddy' AND filename='$realname' AND size='$realsize'"));
        $supergreat = "$useripaddy";
    }

    $uploadcheck = $row6['rawtime'];
    if ($uploadcheck != "") {
    if ($realname != "") {
        echo "<br><b>Possible Re-Upload or refresh button was detected. Stopping this upload for 5 minutes!!</b><br><BR><hr>";
    }
	    // stop error!!
        // dont update
    } else {
        // ok to upload
        $cooltime = time();
        $sql9 = "INSERT INTO `" . $user_prefix . "_reflections_antirepetup` (`id`, `filename`, `nick`, `ipaddy`, `size`, `rawtime`) VALUES ('', '$realname', '$cookie[1]', '$useripaddy', '$realsize', '$cooltime')";
        mysql_query($sql9);
        // end refresh/flood test.




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

                        // Lets put all the info into the database!!
                        $ip1 = $_SERVER["REMOTE_ADDR"];
                        $dadate = date('y-m-d');
                        $datime = date('H:i:s');
                        $rawtime1 = time();

                        if ($requireapproval == "1") {
                            $approvalonpic = "0";
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
    }
}
} // end of loop
// end the loop
// end upload process
closetable();
include("footer.php");

?>