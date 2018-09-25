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

if ($galid == "") {
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='member' AND parentid='0' AND creator='$cookie[1]'"));
    $galid = $row['galid'];
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

if ($usergalid == "") {
    echo "<b><center>This is not a valid gallery. Please create one now <a href='modules.php?name=$module_name&op=creategal'><u>[Click Here]</u></a></b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($usergalactive == "1") {
    $activestatus = "Gallery is Active";
} else {
    $activestatus = "Gallery is not Active";
}

if ($usergalgaltype == "main") {
    if ($usergalmemberupload == "1") {
        $usergalmemberupload = "Member Upload On";
    } else {
        $usergalmemberupload = "Member Upload Off";
    }
}

echo "<br><center><strong>Gallery View/Edit Page</center></strong><br>";
// Reset count here....
if ($resetgaltotal == "yes") {
    $db->sql_query("update " . $user_prefix . "_reflections_gallery set totalview='0' where galid='$usergalid'");
    $usergaltotalview = "0";
    echo "<br><center><strong>Gallery Total Reset Done</strong></center><bR><hr><br>";
}

if ($usergalgaltype == "main") {
    if ($usergalthumb == "") {
        $usergalthumb = "asdasdasdasdasd.adsa";
    }

    $checkthumb = "modules/$module_name/files/maingallery/$usergalfolder/$usergalthumb";
    if (!file_exists($checkthumb)) {
        $ajinfo = "<img border='0' src='modules/$module_name/images/nodefault.gif' height='200' width='200'>";
    } else {
        $imgSize = wdresizeinfo($checkthumb, 200);
        $ajinfo = "<img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'>";
    }
    // end get main thumb
} else if ($usergalgaltype == "member") {
    // get gal thumb
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$usergalid'"));
    $thumbfromfiles = $row['filename'];
    if ($thumbfromfiles != "") {
        // check it and show if possible
        $checkit = "modules/$module_name/files/memgallery/$usergalfolder/thumbs/$thumbfromfiles";
        if (file_exists($checkit)) {
            $imgSize = wdresizeinfo($checkit, 200);
            $ajinfo = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
        } else {
            $ajinfo = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'>";
        }
    } else {
        // Check the next option in the database
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$usergalid' AND approved='1' ORDER BY rawtime ASC"));
        $thumbfromfiles = $row['filename'];
        if ($thumbfromfiles != "") {
            $checkit = "modules/$module_name/files/memgallery/$usergalfolder/thumbs/$thumbfromfiles";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, 200);
                $ajinfo = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
            } else {
                $ajinfo = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'>";
            }
        } else {
            $ajinfo = "<img src='modules/$module_name/images/nodefault.gif' height='100' width='100'>";
        }
    }

    // end get gal thumb
}
    if ($usergalpassword != "") {
        $usergalpassword1 = "<img src='modules/$module_name/images/lock.gif'>";
    } else {
        $usergalpassword1 = "";
    }
if ($usergalparentid != "0") {
    echo "<center><strong><a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$usergalparentid'><u>[Back To Main User Home]</u></a></strong></center><br>";
}
echo "<table border='1' width='100%'>";

echo "<tr>";
echo "<td valign='top' width='200'>";
echo "<center>
<strong>Gallery Thumbnail Image<br>
$ajinfo<br>
<a href='modules.php?name=$module_name&adminarea=adminchangedefault&galid=$usergalid'><u>Change Default<br>
Gallery Image</u></a>
";
echo "</center><hr>
<u>Gallery Name</u>$usergalpassword1<br>
$usergalname<br>
<u>Gallery Description</u><br>
$usergaldesc<br>
<u>Active Status</u><br>
$activestatus<br>";
if ($usergalgaltype == "main") {
    echo "<u>Member Upload Status</u><br>
$usergalmemberupload<br>";
}

echo "<u>Viewed</u><br>
$usergaltotalview Times || <img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'><a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$usergalid&resetgaltotal=yes'><u>Reset</u></a><img src='modules/$module_name/images/reset.gif' height='10' width='10' border='0'><br>
<u>Gallery Options</u><br>
<a href='modules.php?name=$module_name&adminarea=admingaledit&galid=$usergalid'><img src='modules/$module_name/images/edit.png' border='0'></a> || <a href='modules.php?name=$module_name&adminarea=admindeletegallery&galid=$usergalid'><img height='16' width='16' src='modules/$module_name/images/delete.gif' border='0'></a>

";
if ($usergalgaltype == "main") {
    if ($usergalparentid == "0") {
        $upgalid = "&showmainsub=yes&mainvis=yes&maingalidselect=" . $usergalid;
    } else {
        $upgalid = "&showmainsub=yes&mainvis=yes&maingalidselect=" . $usergalparentid;
    }
} else {
    if ($usergalparentid == "0") {
        $upgalid = "&showmemsub=yes&uservis=yes&memgalidselect=" . $usergalid;
    } else {
        $upgalid = "&showmemsub=yes&uservis=yes&memgalidselect=" . $usergalparentid;
    }
}

echo "</td>";
echo "<td align='center' valign='top'>";
$ajinfo = newestbygal('100', 'thumbs', $usergalid, '9');
echo "<center><strong>Last 9 Images Uploaded in this Gallery || <a href='modules.php?name=$module_name&adminarea=adminup$upgalid'><u>Upload More</u></a></center>";
if ($ajinfo[0] == "NONYET") {
    echo "<br><center><strong>No Images in this gallery yet!!</strong></center><br>";
} else {
    echo "<table width='100%' border='0' cellspacing='1' cellpadding='1'>
  <tr>
    <td align='center' valign='middle'>$ajinfo[0]</td>
    <td align='center' valign='middle'>$ajinfo[1]</td>
    <td align='center' valign='middle'>$ajinfo[2]</td>
  </tr>
  <tr>
    <td align='center' valign='middle'>$ajinfo[3]</td>
    <td align='center' valign='middle'>$ajinfo[4]</td>
    <td align='center' valign='middle'>$ajinfo[5]</td>
  </tr>
  <tr>
    <td align='center' valign='middle'>$ajinfo[6]</td>
    <td align='center' valign='middle'>$ajinfo[7]</td>
    <td align='center' valign='middle'>$ajinfo[8]</td>
  </tr>
</table>
";
}

echo "</td>";
echo "</tr>";

if ($usergalparentid == "0") {
    echo "<tr>";
    echo "<td colspan='2'>";
    echo "<center><strong>Sub Galleries Below || <a href='modules.php?name=$module_name&op=creategal'><u>Create New Sub Gallery</u></a></center>";
    $ajinfo = getsubgalbymember($usergalid);
    if ($ajinfo[0] == "NONYET") {
        echo "<br><center><strong>No sub galleries yet!!</strong></center><br>";
    } else {
        $i = "0";
        $trset = "0";
        echo "<table border='0' width='100%'><tr>";
        while ($ajinfo[$i] != "") {
            if ($trset == "4") {
                echo "</tr><tr>";
                $trset = "1";
            } else {
                $trset++;
            }

            echo "<td align='center' valign='bottom'><strong>" . $ajinfo[$i] . "</strong></td>";
            $i++;
        } // while
        echo "</tr></table>";
    }
    echo "</td></tr>";
}

echo "<tr>";
echo "<td colspan='2'>";
echo "<center><strong>Images in this Gallery || <a href='modules.php?name=$module_name&adminarea=adminup$upgalid'><u>Upload More</u></a></center>";

$ajinfo = getallbygal($usergalid);

if ($ajinfo[0] == "NONYET") {
    echo "<br><center><strong>No Images in this gallery yet!!</strong></center><br>";
} else {
    $i = "0";
    $trset = "0";
    echo "<table border='0' width='100%'><tr>";
    while ($ajinfo[$i] != "") {
        if ($trset == "4") {
            echo "</tr><tr>";
            $trset = "1";
        } else {
            $trset++;
        }
        echo "<td align='center' valign='bottom'><strong>" . $ajinfo[$i] . "</strong></td>";
        $i++;
    } // while
    echo "</tr></table>";
}

echo "</td></tr>";

echo "</table>";

closetable();
include("footer.php");

?>