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

$galid = devilcleanitup($galid);
// get gallery information here....
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
$usergalid = $row['galid'];
$usergalparentid = $row['parentid'];
$usergalgaltype = $row['galtype'];
$usergalname = $row['name'];
$usergaldesc = $row['desc'];
$usergalthumb = $row['thumb'];
$usergalfolder = $row['folder'];
$usergaldate = $row['date'];
$usergaltime = $row['time'];
$usergalrawtime = $row['rawtime'];
$usergalactive = $row['active'];
$usergalpassword = $row['password'];
$usergalcreator = $row['creator'];
$usergalmemberupload = $row['memberupload'];
$usergaltotalview = $row['totalview'];
$usergalextra1 = $row['extra1'];
$usergalextra2 = $row['extra2'];
$usergalextra3 = $row['extra3'];
$usergalextra4 = $row['extra4'];
$usergalextra5 = $row['extra5'];
if ($usergalgaltype == "main") {
    $dafilefolder = "maingallery";
} else {
    $dafilefolder = "memgallery";
}

if ($usergalid == "") {
    echo "<b><center>This is not a valid gallery. Please create one now <a href='modules.php?name=$module_name&op=creategal'><u>[Click Here]</u></a></b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($confirm == "yes") {
    echo "<br><center><strong>Gallery Delete Page<br>
Gallery Name :: $usergalname - Gallery Owner :: $usergalcreator</center><br><br>
";
    $galidstokill[] = $usergalid;
    echo "Looking for files and Database Entries in $usergalname";
    $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$usergalid' ORDER BY rawtime DESC";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $picid = mysql_result($result, $i, "picid");
        $picfilename = mysql_result($result, $i, "filename");
        $infolder = mysql_result($result, $i, "infolder");
        $picidstokill[] = $picid;
        $i++;
    }


        if ($usergalgaltype == "main") {
        if ($usergalthumb != "") {
                $dir = "modules/$module_name/files/$dafilefolder/$usergalfolder/";
                        $dafile[] = "$dir$usergalthumb";
        }

    }



    $dir = "modules/$module_name/files/$dafilefolder/$usergalfolder/fullsize/";
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file == ".") {
                } else if ($file == "..") {
                } else {
                    $dafile[] = "$dir$file";
                }
            }
            closedir($dh);
        }
    }



    $dir = "modules/$module_name/files/$dafilefolder/$usergalfolder/thumbs/";
    $foldertokill[] = $usergalfolder;
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if ($file == ".") {
                } else if ($file == "..") {
                } else {
                    $dafile[] = "$dir$file";
                }
            }
            closedir($dh);
        }
    }

    if ($parentid != "0") {
        $sql1 = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$usergalid'";
        $result1 = mysql_query($sql1);
        $num1 = mysql_numrows($result1);
        $i1 = 0;
        while ($i1 < $num1) {
            $dagalid = mysql_result($result1, $i1, "galid");
            $subfolder = mysql_result($result1, $i1, "folder");

            $foldertokill[] = $subfolder;

            $sql5 = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$dagalid' ORDER BY rawtime DESC";
            $result5 = mysql_query($sql5);
            $num5 = mysql_numrows($result5);
            $i5 = 0;
            echo "Database Entries<br>";
            while ($i5 < $num5) {
                $picid = mysql_result($result5, $i5, "picid");
                $picidstokill[] = $picid;
                $i5++;
            }

            $galidstokill[] = $dagalid;



        if ($usergalgaltype == "main") {
        $subthumb = mysql_result($result1, $i1, "thumb");
        if ($subthumb != "") {
               $dir = "modules/$module_name/files/$dafilefolder/$subfolder/";
                        $dafile[] = "$dir$subthumb";
        }

    }



            $dir = "modules/$module_name/files/$dafilefolder/$subfolder/fullsize/";

            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file == ".") {
                        } else if ($file == "..") {
                        } else {
                            $dafile[] = "$dir$file";
                        }
                    }
                    closedir($dh);
                }
            }

            $dir = "modules/$module_name/files/$dafilefolder/$subfolder/thumbs/";

            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    while (($file = readdir($dh)) !== false) {
                        if ($file == ".") {
                        } else if ($file == "..") {
                        } else {
                            $dafile[] = "$dir$file";
                        }
                    }
                    closedir($dh);
                }
            }

            $i1++;
        }
        // Delete from disk and database section and output!!
        echo "<hr>Delete Information from database tables.<br>";
        $s = "0";
        while ($galidstokill[$s] != "") {
            echo "Start Delete from Reports Table - #" . $s . "<br>";
            $sql = "DELETE FROM " . $user_prefix . "_reflections_reports WHERE `galid` = $galidstokill[$s]";
            if (mysql_query($sql)) {
                echo "<img src='modules/$module_name/images/okyes.gif'>";
            } else {
                echo "<img src='modules/$module_name/images/okno.gif'>";
                $datatableerror = "error";
            }
            echo "Done with Delete from Reports table - #" . $s . "<br>";

            echo "Start Delete from Files Table - #" . $s . "<br>";
            $sql = "DELETE FROM " . $user_prefix . "_reflections_files WHERE `galid` = $galidstokill[$s]";
            if (mysql_query($sql)) {
                echo "<img src='modules/$module_name/images/okyes.gif'>";
            } else {
                echo "<img src='modules/$module_name/images/okno.gif'>";
                $datatableerror = "error";
            }
            echo "Done with Delete from Files table - #" . $s . "<br>";

            echo "Start Delete from Comments Table - #" . $s . "<br>";
            $sql = "DELETE FROM " . $user_prefix . "_reflections_comments WHERE `galid` = $galidstokill[$s]";
            if (mysql_query($sql)) {
                echo "<img src='modules/$module_name/images/okyes.gif'>";
            } else {
                echo "<img src='modules/$module_name/images/okno.gif'>";
                $datatableerror = "error";
            }
            echo "Done with Delete from Comments table - #" . $s . "<br>";

            echo "Start Delete from Gallery Table - #" . $s . "<br>";
            $sql = "DELETE FROM " . $user_prefix . "_reflections_gallery WHERE `galid` = $galidstokill[$s]";
            if (mysql_query($sql)) {
                echo "<img src='modules/$module_name/images/okyes.gif'>";
            } else {
                echo "<img src='modules/$module_name/images/okno.gif'>";
                $datatableerror = "error";
            }
            echo "Done with Delete from Gallery table - #" . $s . "<br>";

            $s++;
        } // while
        echo "Done Deleting Information from database tables.";

        if ($datatableerror == "") {
            echo "<img src='modules/$module_name/images/okyes.gif'>";
        } else {
            echo "<img src='modules/$module_name/images/okno.gif'>";
        }

        echo "<br>";

        echo "<hr>Starting File Deleting Now<br>";
        $w = "0";
        while ($dafile[$w] != "") {
            $filedelete = $dafile[$w];
            if (unlink($filedelete)) {
                echo "Deleted file $dafile[$w] OK.. <img src='modules/$module_name/images/okyes.gif'><br>";
            } else {
                echo "Could Not delete file $dafile[$w] Error.. <img src='modules/$module_name/images/okno.gif'><br>";
                $deletefileerror = "fileerror";
            }
            $w++;
        } // while
        echo "Done With File Deleting..";
        if ($deletefileerror != "") {
            echo "<img src='modules/$module_name/images/okno.gif'>";
        } else {
            echo "<img src='modules/$module_name/images/okyes.gif'>";
        }
        echo " <br>";

        echo "<hr>Starting Folder Deleting Now<br>";
        $x = "0";
        while ($foldertokill[$x] != "") {
            $path1 = "modules/$module_name/files/$dafilefolder/$foldertokill[$x]/fullsize";
            $path2 = "modules/$module_name/files/$dafilefolder/$foldertokill[$x]/thumbs";
            $path3 = "modules/$module_name/files/$dafilefolder/$foldertokill[$x]";

            if (rmdir($path1)) {
                echo "Deleted folder $path1 OK.. <img src='modules/$module_name/images/okyes.gif'><br>";
            } else {
                echo "Could Not delete folder $path1 Error.. <img src='modules/$module_name/images/okno.gif'><br>";
                $deletefoldererror = "fileerror";
            }

            if (rmdir($path2)) {
                echo "Deleted folder $path2 OK.. <img src='modules/$module_name/images/okyes.gif'><br>";
            } else {
                echo "Could Not delete folder $path2 Error.. <img src='modules/$module_name/images/okno.gif'><br>";
                $deletefoldererror = "fileerror";
            }

            if (rmdir($path3)) {
                echo "Deleted folder $path3 OK.. <img src='modules/$module_name/images/okyes.gif'><br>";
            } else {
                echo "Could Not delete folder $path3 Error.. <img src='modules/$module_name/images/okno.gif'><br>";
                $deletefoldererror = "fileerror";
            }

            $x++;
        } // while
        echo "Done With Folder Deleting..";
        if ($deletefoldererror != "") {
            echo " <img src='modules/$module_name/images/okno.gif'>";
        } else {
            echo "<img src='modules/$module_name/images/okyes.gif'>";
        }
        echo " <br>";
    }

    if ($datatableerror != "" || $deletefoldererror != "" || $deletefileerror != "") {
        echo "<HR><br><br>";

        if ($datatableerror != "") {
            echo "Database Removal Error! - This is not a serious error. As long as there is a green dot on the files and gallery tables it is fine.<br>";
        }
        if ($deletefileerror != "") {
            echo "File Removal Error! - If you had any red dots on the files deleting area more then likely<br>
		the file was not removed or already missing. If Folder delete's didn't error your fine.<br>
		If not you probly had a permission error on the folders or files.<br>";
        }

        if ($deletefoldererror != "") {
            echo "Folder Removal Error! - If you had any red dots on folder removals then there is probly a permission error or a file didnt get deleted<br>
		if you had red dots on the files deleting then see file removal error above.<br>";
        }

        echo "<br>Please Contact the admin about these error's. It is best to copy and past into an email body the above information.<br>
Thanks<br><br>";
    } else {
        echo "<HR><br><br> Everything looked like it went ok. Have a good one!!<br>
		Thanks<br><br>";
    }
    // $datatableerror
    // $deletefoldererror
    // $deletefileerror
    closetable();
    include("footer.php");
    die;
}
// Notice This is a main gallery!!!!
if ($usergalparentid == "0") {
    echo "<br><center><strong>Gallery Delete Page<br>
Gallery Name :: $usergalname - Gallery Owner :: $usergalcreator</center><br><br>
Notice This is a root gallery for your user gallery.<br>
If you delete this gallery then all sub galleries and<br>
all files under them will also be deleted!!!<br>
<bR>
Are you sure you want to Delete?<br>
<br>
<a href='modules.php?name=$module_name&adminarea=admindeletegallery&galid=$usergalid&confirm=yes'><u>[Yes]</u></a> || <a href='modules.php?name=$module_name&op=userhome&galid=$usergalid'><u>[No Go Back]</u></a><br>
";
}
// Notice This is a sub gallery!!!!
if ($usergalparentid != "0") {
    echo "<br><center><strong>Gallery Delete Page<br>
Gallery Name :: $usergalname - Gallery Owner :: $usergalcreator</center><br><br>
Notice This is a sub gallery for your user gallery.<br>
If you delete this gallery then all files will be<br>
deleted under it as well.<br>
<bR>
Are you sure you want to Delete?<br>
<br>
<a href='modules.php?name=$module_name&adminarea=admindeletegallery&galid=$usergalid&confirm=yes'><u>[Yes]</u></a> || <a href='modules.php?name=$module_name&op=userhome&galid=$usergalid'><u>[No Go Back]</u></a><br>
";
}

closetable();
include("footer.php");

?>