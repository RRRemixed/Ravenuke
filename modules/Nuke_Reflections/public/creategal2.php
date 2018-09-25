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


if ($membersecuritycreate == "1") {

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





if ($allowmembergalleries == "0" && !is_admin($admin)) {
		echo "<b><center>Member Gallery creation has been turned off by the admin. Sorry.</b></center>";
        closetable();
        include_once("footer.php");
        die;
}



if ($createsubmainadmin != "") {
    if (is_admin($admin)) {
    } else {
        echo "<b><center>You are NOT an admin LEAVE NOW!!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }


    $T1 = devilcleanitup($T1);
    $desc = devilcleanitup($desc);
    $T3 = devilcleanitup($T3);
    // Check fields if empty stop and give error!!
    if ($T1 == "" || $desc == "") {
        echo "<b><center>Error. Name or Description is empty please go back and fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // check database to see if name is already in it.
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE name='$T1'"));
    $checkdb = $row['name'];
    if ($checkdb != "") {

        echo "<b><center>Error. That Gallery Name is already in the system. Please goback and Fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }


    if ($mainid == "" || $mainid == "---- Select ----") {
    	        echo "<b><center>Error. You didn't select a main gallery to make into!! Please goback and Fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }


    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$mainid'"));
    $getfolder = $row['folder'];
    $mainpass = $row['password'];
    $mainactive = $row['active'];

    if ($getfolder == "") {
    	echo "<b><center>Error. That gallery id is not valid!! Please goback and Fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }

$getfolder = $getfolder."sub";

$i = "1";
$safetycheck = "modules/$module_name/files/maingallery/$getfolder" . $i;
while( file_exists($safetycheck) == true ){
$i++;
$safetycheck = "modules/$module_name/files/maingallery/$getfolder" . $i;
} // while


    $foldername = "$getfolder".$i;



   if (!mkdir("modules/$module_name/files/maingallery/$foldername")) {
        $ajerror = "1";
    } else {
        // echo "Created Gallery Folder Named = $foldername<br>";
        if (!mkdir("modules/$module_name/files/maingallery/$foldername/fullsize")) {
            $ajerror = "1";
        } else {
            // echo "Created Gallery Fullsize folder = $foldername/fullsize<br>";
            if (!mkdir("modules/$module_name/files/maingallery/$foldername/thumbs")) {
                $ajerror = "1";
            } else {
                // echo "Created Gallery Thumb folder = $foldername/thumbs<br><br>";
            }
        }
    }
    $truepath = getcwd();
    $file = "/modules/$module_name/files/maingallery/$foldername";

    if (! chmod ("$truepath$file", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/thumbs", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/fullsize", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    // check and see if there was an error. If not we will upload if one was made....
    if ($ajerror != "1") {
        if ($F1 != "") {
            if ($_FILES['F1']['name']) {
                $sys1 = $HTTP_POST_FILES['F1']['name'];
                $sys1 = substr($sys1, -3);
                if (strtolower($sys1) == "gif" || strtolower($sys1) == "jpg" || strtolower($sys1) == "jpeg") {
                    $uploadDir = "modules/$module_name/files/maingallery/$foldername/";
                    $uploadFile = $uploadDir . basename($_FILES['F1']['name']);
                    move_uploaded_file($_FILES['F1']['tmp_name'], $uploadFile);
                    if (! chmod ("$uploadFile", 0777)) {
                        echo ("<hr><hr>Permission Error on thumbnail!<hr><hr>");
                    }
                    // get reduced size for gallery.
                    $imgSize = wdresizeinfo("$uploadFile", "200");
                    $origionalpic = "$uploadFile";
                    $thumbnailpic = "$uploadFile";
                    // wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);
                    wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);
                    $thumbnailname = $_FILES['F1']['name'];
                } else {
                    echo "Bad filetype for uploaded image. Will use default No image for now. Sorry Only .jpg, .jpeg, .gif are allowed<br>";
                    $thumbnailname = "";
                }
            }
        }
    }
    // End upload
    if ($thumbnailname == "") {
        $thumbnailname = "";
    }
    // set time and date and encode the password
    $dadate = date('y-m-d');
    $datime = date('H:i:s');



    if ($T3 != "") {
        $newpassword = md5($T3);
    }
    $rawtime1 = time();
    // need to add to database is all that is left to do.
    $sql = "INSERT INTO " . $prefix . "_reflections_gallery (`galid`, `parentid`, `galtype`, `name`, `desc`, `thumb`, `folder`, `date`, `time`, `rawtime`, `active`, `password`, `creator`, `memberupload`, `totalview`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`) VALUES ('', '$mainid', 'main', '$T1', '$desc', '$thumbnailname', '$foldername', '$dadate', '$datime', '$rawtime1', '$R1', '$newpassword', '$cookie[1]', '$R2', '0', '', '', '', '', '')";
    mysql_query($sql) or die ('There was an error inserting into database');
    echo "<center><b>New Gallery Created<br>";
    if ($thumbnailname != "") {
        echo "<img src='$uploadFile'>";
    } else {
        echo "<img src='modules/$module_name/images/nodefault.gif'>";
    }
    if ($newpassword != "") {
        echo "<img src='modules/$module_name/images/lock.gif'>";
    }
    echo "<br>Name :: $T1<br>
Description :: $desc<br>
";
    if ($R2 == "1") {
        echo "Members can upload<bR>";
    } else {
        echo "Members can not upload<bR>";
    }
    if ($R1 == "1") {
        echo "Gallery is Active<br>";
    } else {
        echo "Gallery is not Active<br>";
    }
    echo "Folder name is $foldername<br>
<br>
<a href='javascript:history.back(-2)'><u><b>Please go back</u></b></a><br></b></center>";

    closetable();
    include_once("footer.php");
    die;
    // $F1
}

//End create sub main admin

























if ($createmainadmin != "") {
    if (is_admin($admin)) {
    } else {
        echo "<b><center>You are NOT an admin LEAVE NOW!!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }

    $foldername = devilcleanitup($foldername);
    $T1 = devilcleanitup($T1);
    $desc = devilcleanitup($desc);
    $T3 = devilcleanitup($T3);
    // Check fields if empty stop and give error!!
    if ($T1 == "" || $desc == "" || $foldername == "") {
        echo "<b><center>Error. Name, Description, or Foldername is empty please go back and fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // check database to see if name is already in it.
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE name='$T1'"));
    $checkdb = $row['name'];
    if ($checkdb != "") {

        echo "<b><center>Error. That Gallery Name is already in the system. Please goback and Fix!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    // Now create a folder from the name.
    $foldername = str_replace(" ", "_", $foldername);
    $foldername = str_replace("\"", "_", $foldername);
    $foldername = str_replace("'", "_", $foldername);
    $foldername = str_replace(".", "_", $foldername);
    $foldername = str_replace(",", "_", $foldername);
    $foldername = substr($foldername, 0, 25);
    $foldername = strtolower($foldername);

    $filename = "modules/$module_name/files/maingallery/$foldername";

    if (file_exists($filename)) {
        $rennumber = rand(1111111, 9999999);
        $newfoldername = "$foldername$rennumber";
        echo "The folder \"$foldername\" is already in use. Using \"$newfoldername\"";
        $foldername = $newfoldername;
    } else {
    }

    if (!mkdir("modules/$module_name/files/maingallery/$foldername")) {
        $ajerror = "1";
    } else {
        // echo "Created Gallery Folder Named = $foldername<br>";
        if (!mkdir("modules/$module_name/files/maingallery/$foldername/fullsize")) {
            $ajerror = "1";
        } else {
            // echo "Created Gallery Fullsize folder = $foldername/fullsize<br>";
            if (!mkdir("modules/$module_name/files/maingallery/$foldername/thumbs")) {
                $ajerror = "1";
            } else {
                // echo "Created Gallery Thumb folder = $foldername/thumbs<br><br>";
            }
        }
    }
    $truepath = getcwd();
    $file = "/modules/$module_name/files/maingallery/$foldername";

    if (! chmod ("$truepath$file", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/thumbs", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/fullsize", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    // check and see if there was an error. If not we will upload if one was made....
    if ($ajerror != "1") {
        if ($F1 != "") {
            if ($_FILES['F1']['name']) {
                $sys1 = $HTTP_POST_FILES['F1']['name'];
                $sys1 = substr($sys1, -3);
                if (strtolower($sys1) == "gif" || strtolower($sys1) == "jpg" || strtolower($sys1) == "jpeg") {
                    $uploadDir = "modules/$module_name/files/maingallery/$foldername/";
                    $uploadFile = $uploadDir . basename($_FILES['F1']['name']);
                    move_uploaded_file($_FILES['F1']['tmp_name'], $uploadFile);
                    if (! chmod ("$uploadFile", 0777)) {
                        echo ("<hr><hr>Permission Error on thumbnail!<hr><hr>");
                    }
                    // get reduced size for gallery.
                    $imgSize = wdresizeinfo("$uploadFile", "200");
                    $origionalpic = "$uploadFile";
                    $thumbnailpic = "$uploadFile";
                    // wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);
                    wdcreatetgalhumb($origionalpic, $thumbnailpic, $imgSize[0], $imgSize[1]);
                    $thumbnailname = $_FILES['F1']['name'];
                } else {
                    echo "Bad filetype for uploaded image. Will use default No image for now. Sorry Only .jpg, .jpeg, .gif are allowed<br>";
                    $thumbnailname = "";
                }
            }
        }
    }
    // End upload
    /*
`galid` INT( 255 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` TEXT NOT NULL ,
`desc` TEXT NOT NULL ,
`thumb` VARCHAR( 255 ) NOT NULL ,
`folder` VARCHAR( 255 ) NOT NULL ,
`date` DATE NOT NULL ,
`time` TIME NOT NULL ,
`active` VARCHAR( 2 ) NOT NULL ,
`password` VARCHAR( 255 ) NOT NULL ,
`creator` VARCHAR( 255 ) NOT NULL ,
`memberupload` VARCHAR( 2 ) NOT NULL ,
`totalview` INT( 255 ) NOT NULL ,
`guestgal` VARCHAR( 2 ) NOT NULL ,
`extra1` VARCHAR( 255 ) NOT NULL ,
`extra2` VARCHAR( 255 ) NOT NULL ,
`extra3` VARCHAR( 255 ) NOT NULL ,
`extra4` VARCHAR( 255 ) NOT NULL ,
`extra5` VARCHAR( 255 ) NOT NULL
*/
    if ($thumbnailname == "") {
        $thumbnailname = "";
    }
    // set time and date and encode the password
    $dadate = date('y-m-d');
    $datime = date('H:i:s');
    if ($T3 != "") {
        $newpassword = md5($T3);
    }
    $rawtime1 = time();
    // need to add to database is all that is left to do.
    $sql = "INSERT INTO " . $prefix . "_reflections_gallery (`galid`, `parentid`, `galtype`, `name`, `desc`, `thumb`, `folder`, `date`, `time`, `rawtime`, `active`, `password`, `creator`, `memberupload`, `totalview`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`) VALUES ('', '0', 'main', '$T1', '$desc', '$thumbnailname', '$foldername', '$dadate', '$datime', '$rawtime1', '$R1', '$newpassword', '$cookie[1]', '$R2', '0', '', '', '', '', '')";
    mysql_query($sql) or die ('There was an error inserting into database');
    echo "<center><b>New Gallery Created<br>";
    if ($thumbnailname != "") {
        echo "<img src='$uploadFile'>";
    } else {
        echo "<img src='modules/$module_name/images/nodefault.gif'>";
    }
    if ($newpassword != "") {
        echo "<img src='modules/$module_name/images/lock.gif'>";
    }
    echo "<br>Name :: $T1<br>
Description :: $desc<br>
";
    if ($R2 == "1") {
        echo "Members can upload<bR>";
    } else {
        echo "Members can not upload<bR>";
    }
    if ($R1 == "1") {
        echo "Gallery is Active<br>";
    } else {
        echo "Gallery is not Active<br>";
    }
    echo "Folder name is $foldername<br>
<br>
<a href='javascript:history.back(-2)'><u><b>Please go back</u></b></a><br></b></center>";

    closetable();
    include_once("footer.php");
    die;
    // $F1
}


if ($creatememadmin != "") {
    // check required fields.

    if (is_admin($admin)) {
    	if ($username == "") {
    	echo "<center><strong>System Error! Username field was left empty!! Please go back and Fix!!</strong></center>";
        closetable();
        include("footer.php");
        die;
    	}
    } else {
		$username = $cookie[1];
		}


    if ($T1 == "" || $T2 == "") {

        echo "<center><strong>System Error! You need to fill out the Name or the Description Field</strong></center>";
        closetable();
        include("footer.php");
        die;
    }
    // clean up the text fields in case of hack or other stuff!!
    $T1 = devilcleanitup($T1);
    $T2 = devilcleanitup($T2);
    $T3 = devilcleanitup($T3);
    $R1 = devilcleanitup($R1);
    // Create the folders and chmod em!!
    $filename = "modules/$module_name/files/memgallery/$username<br>";
echo "<strong>Creating folders Now. Main folder name will be $username<bR></strong>";
    if (file_exists($filename)) {
        // do nothing
    } else {
        // create
        if (!mkdir("modules/$module_name/files/memgallery/$username")) {
            $ajerror = "1";
        } else {
            // echo "Created Gallery Folder Named = $foldername<br>";
            if (!mkdir("modules/$module_name/files/memgallery/$username/fullsize")) {
                $ajerror = "1";
            } else {
                // echo "Created Gallery Fullsize folder = $foldername/fullsize<br>";
                if (!mkdir("modules/$module_name/files/memgallery/$username/thumbs")) {
                    $ajerror = "1";
                } else {
                    // echo "Created Gallery Thumb folder = $foldername/thumbs<br><br>";
                }
            }
        }
            $truepath = getcwd();
            $file = "/modules/$module_name/files/memgallery/$username";

    if (! chmod ("$truepath$file", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/thumbs", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/fullsize", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
		//end create
    }
    echo "<strong>Done Making folders<bR></strong>";
        // End Create folders
    //Lets put stuff into the database....

    // set time and date and encode the password
    $dadate = date('y-m-d');
    $datime = date('H:i:s');
    if ($T3 != "") {
        $newpassword = md5($T3);
    }
    $rawtime1 = time();
    // need to add to database is all that is left to do.
    if ($ajerror == "1") {
	echo "<center><strong>There was an error! Not inserting into database!!<br></strong></center>";
	} else {
		echo "<strong>Inserting into the database!<bR></strong>";
$foldername = "$username";
    $sql = "INSERT INTO " . $prefix . "_reflections_gallery (`galid`, `parentid`, `galtype`, `name`, `desc`, `thumb`, `folder`, `date`, `time`, `rawtime`, `active`, `password`, `creator`, `memberupload`, `totalview`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`) VALUES ('', '0', 'member', '$T1', '$T2', '$thumbnailname', '$foldername', '$dadate', '$datime', '$rawtime1', '$R1', '$newpassword', '$username', '0', '0', '', '', '', '', '')";
    mysql_query($sql) or die ('There was an error inserting into database');
		echo "<strong>Done with Database Insert!<bR></strong>";
}

echo "<br><strong><a href='modules.php?name=$module_name&op=userhome'><u>Goto the personal gallery page now.</u></a></strong>";
    //end database input


    closetable();
    include("footer.php");
    die;
}




//memsubcreategal adnub
if ($creatememsub != "") {
    // check required fields.




	    $memmainid = devilcleanitup($memmainid);
if ($memmainid != "") {
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_reflections_gallery WHERE galid='$memmainid' AND galtype='member'"));
$validcheck = $row['galid'];
$mainactive = $row['active'];
$mainpassword = $row['password'];
$username = $row['creator'];
if ($validcheck == "") {
        echo "<center><strong>System Error! Gallery was not valid!!</strong></center>";
        closetable();
        include("footer.php");
        die;
}
} else {
        echo "<center><strong>System Error! There was no main member id supplied!!</strong></center>";
        closetable();
        include("footer.php");
        die;
}


$i = "1";
$safetycheck = "modules/$module_name/files/memgallery/$username" . $i;
while( file_exists($safetycheck) == true ){
$i++;
$safetycheck = "modules/$module_name/files/memgallery/$username" . $i;
} // while





    if ($T1 == "" || $T2 == "") {

        echo "<center><strong>System Error! You need to fill out the Name or the Description Field</strong></center>";
        closetable();
        include("footer.php");
        die;
    }
    // clean up the text fields in case of hack or other stuff!!
    $T1 = devilcleanitup($T1);
    $T2 = devilcleanitup($T2);
    $T3 = devilcleanitup($T3);
    $R1 = devilcleanitup($R1);
    // Create the folders and chmod em!!
    $filename = "modules/$module_name/files/memgallery/$username".$i."<br>";
echo "<strong>Creating folders Now. Sub folder name will be $username".$i."<bR></strong>";
    if (file_exists($filename)) {
        // do nothing
    } else {
        // create
        if (!mkdir("modules/$module_name/files/memgallery/$username".$i."")) {
            $ajerror = "1";
        } else {
            // echo "Created Gallery Folder Named = $foldername<br>";
            if (!mkdir("modules/$module_name/files/memgallery/$username".$i."/fullsize")) {
                $ajerror = "1";
            } else {
                // echo "Created Gallery Fullsize folder = $foldername/fullsize<br>";
                if (!mkdir("modules/$module_name/files/memgallery/$username".$i."/thumbs")) {
                    $ajerror = "1";
                } else {
                    // echo "Created Gallery Thumb folder = $foldername/thumbs<br><br>";
                }
            }
        }
            $truepath = getcwd();
            $file = "/modules/$module_name/files/memgallery/$username".$i."";

    if (! chmod ("$truepath$file", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/thumbs", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
    if (! chmod ("$truepath$file/fullsize", 0777)) {
        $ajerror = "1";
        echo ("<hr><hr>Permission Error!<hr><hr>");
    }
		//end create
    }
    echo "<strong>Done Making folders<bR></strong>";
        // End Create folders
    //Lets put stuff into the database....

    // set time and date and encode the password
    $dadate = date('y-m-d');
    $datime = date('H:i:s');



    if ($T3 != "") {
        $mainpassword = md5($T3);
    } else {
	$mainpassword = "";
	}
    $rawtime1 = time();
    // need to add to database is all that is left to do.
    if ($ajerror == "1") {
	echo "<center><strong>There was an error! Not inserting into database!!<br></strong></center>";
	} else {
		echo "<strong>Inserting into the database!<bR></strong>";
$foldername = "$username".$i."";
    $sql = "INSERT INTO " . $prefix . "_reflections_gallery (`galid`, `parentid`, `galtype`, `name`, `desc`, `thumb`, `folder`, `date`, `time`, `rawtime`, `active`, `password`, `creator`, `memberupload`, `totalview`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`) VALUES ('', '$memmainid', 'member', '$T1', '$T2', '$thumbnailname', '$foldername', '$dadate', '$datime', '$rawtime1', '$mainactive', '$mainpassword', '$username', '0', '0', '', '', '', '', '')";
    mysql_query($sql) or die ('There was an error inserting into database');
		echo "<strong>Done with Database Insert!<bR></strong>";
}

echo "<br><strong><a href='modules.php?name=$module_name&op=userhome'><u>Goto the personal gallery page now.</u></a></strong>";
    //end database input


    closetable();
    include("footer.php");
    die;
}
//end mem sub create!!























closetable();
include("footer.php");

?>