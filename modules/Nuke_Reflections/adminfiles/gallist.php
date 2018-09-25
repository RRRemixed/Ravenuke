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

echo "<br><center><strong>Gallery list below</strong></center><br>";
$ajinfo = getmain1();

echo "<table border='0' width='100%'>";
if ($ajinfo[0] == "NONYET") {
    echo "<tr><td><strong><center><hr>List of Main Galleries<hr></center></strong></td></tr>";
    echo "<tr><td><strong><center><br>No main galleries.<br><br><hr></center></strong></td>";
} else {
    echo "<tr><td colspan='4'><strong><center><hr>List of Main Galleries<hr></center></strong></td></tr>";
echo "<tr>";
    $x = 0;
    $tr = 0;
	while ($ajinfo[$x] != "") {

    if ($tr == "4") {
    	echo "</tr><tr>";
    	$tr = 1;
    } else {
	$tr++;
	}

        echo "<td><strong><center>" . $ajinfo[$x] . "</strong></center></td>";
        $x++;
    } // while
}
echo "</tr></table><br><center><strong><hr>End Of Main Galleries List</center></strong><hr>";


$ajinfo1 = getmem();
echo "<br><table border='0' width='100%'>";
if ($ajinfo1[0] == "NONYET") {
    echo "<tr><td><strong><center><hr>List of Member Galleries<hr></center></strong></td></tr>";
    echo "<tr><td><strong><center><br>No Member galleries.<br><br><hr></center></strong></td>";

} else {
    echo "<tr><td colspan='4'><strong><center><hr>List of Member Galleries<hr></center></strong></td></tr>";
    echo "<tr>";
	    $x1 = 0;

    $x1 = 0;
    $tr = 0;
	while ($ajinfo1[$x1] != "") {

    if ($tr == "4") {
    	echo "</tr><tr>";
    	$tr = 1;
    } else {
	$tr++;
	}


        echo "<td><strong><center>" . $ajinfo1[$x1] . "</strong></center></td>";
        $x1++;
    } // while
}
echo "</tr></table><br><hr><center><strong>End of Members Gallery<hr></strong></center><br>";


















closetable();
include("footer.php");


function getmain1()
{
    global $prefix, $sql, $module_name;
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='main' AND parentid='0' ORDER BY rawtime DESC";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");

        if ($dathumb == "") {
        	$dathumb = "adsadasd.adsasd";
        }
        
        $checkthumb = "modules/$module_name/files/maingallery/$dafolder/$dathumb";
        if (!file_exists($checkthumb)) {
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='modules/$module_name/images/nodefault.gif' height='100' width='100'></a><br>
<u>Gallery Name</u><br>
$daname<br>
<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
        } else {

            $imgSize = wdresizeinfo($checkthumb, 100);
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'></a><br>
			<u>Gallery Name</u><br>
			$daname<br>
			<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
        }

        $sql1 = "SELECT * FROM " . $prefix . "_reflections_gallery where galtype='main' AND parentid='$daid'";
$result1 = mysql_query($sql1);
$num4 = mysql_numrows($result1);

$sql1 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$daid'";
$result1 = mysql_query($sql1);
$num1 = mysql_numrows($result1);


$ajinfo[$i] = $ajinfo[$i] . "<br>$num4 Sub Galleries<br>$num1 Files</strong><br><img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";




        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    }
    return $ajinfo;
}



function getmem()
{
    global $prefix, $sql, $module_name, $db;
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='member' AND parentid='0' ORDER BY creator ASC";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);

    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");
        $dausername = mysql_result($result, $i, "creator");
        // check for a image as a default?
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$daid'"));
        $thumbfromfiles = $row['filename'];
        if ($thumbfromfiles != "") {
            // check it and show if possible
            $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, 100);
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'><br>
								</a><strong><u>Gallery Owner</u><br>
								$dausername";
            } else {
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'><br>
					</a><strong><u>Gallery Owner</u><br>
					$dausername";
            }
        } else {
            // Check the next option in the database
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$daid' AND approved='1' ORDER BY rawtime ASC"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 100);
                    $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'><br>
								</a><strong><u>Gallery Owner</u><br>
								$dausername";
                } else {
                    $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'><br>
					</a><strong><u>Gallery Owner</u><br>
					$daname";
                }
            } else {
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$daid'><img border='0' src='modules/$module_name/images/nodefault.gif' height='100' width='100'><br>
					</a><strong><u>Gallery Owner</u><br>
					$dausername";
            }
        }

$sql2 = "SELECT * FROM " . $prefix . "_reflections_gallery where galtype='member' AND parentid='$daid'";
$result2 = mysql_query($sql2);
$num2 = mysql_numrows($result2);

$sql1 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$daid'";
$result1 = mysql_query($sql1);
$num1 = mysql_numrows($result1);




$ajinfo[$i] = $ajinfo[$i] . "<br>$num2 Sub Galleries<br>$num1 Files</strong><br><img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";


        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    }
    return $ajinfo;
}
















?>