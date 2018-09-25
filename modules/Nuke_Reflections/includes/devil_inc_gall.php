<?php

function getlastfivemain()
{
    global $prefix, $sql, $module_name;
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='main' AND active='1' AND password='' ORDER BY rawtime DESC LIMIT 5";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");

        if ($dathumb == "") {
        	$dathumb = "asdasds.asdasda";
        }

        $checkthumb = "modules/$module_name/files/maingallery/$dafolder/$dathumb";
        if (!file_exists($checkthumb)) {
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='modules/$module_name/images/nodefault.gif' height='100' width='100'></a><br>
<u>Gallery Name</u><br>
<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><br>
<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
        } else {
            $imgSize = wdresizeinfo($checkthumb, 100);
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'></a><br>
			<u>Gallery Name</u><br>
			<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><br>
			<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
        }
        $i++;
    }

    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
        while ($x < 5) {
            if ($ajinfo[$x] == "") {
                $ajinfo[$x] = "<img src='modules/$module_name/images/pixel.gif' height='100' width='100'><br><img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
            }
            $x++;
        } // while
    }
    return $ajinfo;
}

function getlastfivemem()
{
    global $prefix, $sql, $module_name, $db;
    $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='member' AND active='1' AND password='' ORDER BY rawtime DESC LIMIT 5";
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
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a><br>
								<u>Gallery Name</u><br>
								<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a>
								<br><img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
            } else {
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'></a><br>
					<u>Gallery Name</u><br>
					<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><br>
					<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
            }
        } else {
            // Check the next option in the database
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$daid' AND approved='1' AND galpassword='nopassword' ORDER BY rawtime ASC"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 100);
                    $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'></a><br>
								<u>Gallery Name</u><br>
								<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><br>
								<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
                } else {
                    $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'></a><br>
					<u>Gallery Name</u><br>
					<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><br>
					<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
                }
            } else {
                $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=showgal&galid=$daid'><img src='modules/$module_name/images/nodefault.gif' height='100' width='100'></a><br>
					<u>Gallery Name</u><br>
					<a href='modules.php?name=$module_name&op=showgal&galid=$daid'>$daname</a><bR>
					<img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
            }
        }
        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
        while ($x < 5) {
            if ($ajinfo[$x] == "") {
                $ajinfo[$x] = "<img src='modules/$module_name/images/pixel.gif' height='100' width='100'><br><img src='modules/$module_name/images/pixel.gif' height='1' width='100'>";
            }
            $x++;
        } // while
    }

    return $ajinfo;
}

function getrandfiveimages($maxsize = 0, $typeof)
{
    global $prefix, $sql, $module_name, $db;
    if ($maxsize == "0") {
        $maxsize = "100";
    }
    $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galpassword='nopassword' AND approved='1' AND galactive='1' ORDER BY RAND() LIMIT 5";
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $picid = mysql_result($result, $i, "picid");
        $galid = mysql_result($result, $i, "galid");
        $filename = mysql_result($result, $i, "filename");
        $folder = mysql_result($result, $i, "infolder");
        $picname = mysql_result($result, $i, "picname");
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
        $galtype = $row['galtype'];
        $galtype = $row['galtype'];
        if ($galtype == "member") {
            $typefolder = "memgallery";
        } else {
            $typefolder = "maingallery";
        }
        if ($picid != "") {
            $checkit = "modules/$module_name/files/$typefolder/$folder/$typeof/$filename";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, $maxsize);
            } else {
                $checkit = "modules/$module_name/images/imageerror.gif";
                $imgSize[0] = "100";
                $imgSize[1] = "100";
                // imagefilegone
            }
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img src='$checkit' height='$imgSize[1]' width='$imgSize[0]'></a><br>
					<u>Name of File</u><br>
					$picname";
        }

        $i++;
    }

    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
        while ($x < 5) {
            if ($ajinfo[$x] == "") {
                $ajinfo[$x] = "<img src='modules/$module_name/images/pixel.gif' height='100' width='100'>";
            }
            $x++;
        } // while
    }

    return $ajinfo;
}

function newest5ups($maxsize = 0, $typeof)
{
    global $prefix, $sql, $module_name, $db;
    if ($maxsize == "0") {
        $maxsize = "100";
    }
    $sql1 = "SELECT * FROM " . $prefix . "_reflections_files WHERE galpassword='nopassword' AND approved='1' AND galactive='1' ORDER BY rawtime DESC LIMIT 5";
    $result1 = mysql_query($sql1);
    $num1 = mysql_numrows($result1);
    $i = 0;
    while ($i < $num1) {
        $picid = mysql_result($result1, $i, "picid");
        $galid = mysql_result($result1, $i, "galid");
        $filename = mysql_result($result1, $i, "filename");
        $folder = mysql_result($result1, $i, "infolder");
        $picname = mysql_result($result1, $i, "picname");
        $dapassword = mysql_result($result1, $i, "galpassword");
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
        $galtype = $row2['galtype'];

        if ($dapassword != "nopassword") {
            $dapassword = "<img src='modules/$module_name/images/lock.gif'>";
        } else {
            $dapassword = "";
        }
        if ($galtype == "member") {
            $typefolder = "memgallery";
        } else {
            $typefolder = "maingallery";
        }
        if ($picid != "") {
            $checkit = "modules/$module_name/files/$typefolder/$folder/$typeof/$filename";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, $maxsize);
            } else {
                $checkit = "modules/$module_name/images/imageerror.gif";
                $imgSize[0] = "100";
                $imgSize[1] = "100";
                // imagefilegone
            }
            $ajinfo[$i] = "<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img src='$checkit' height='$imgSize[1]' width='$imgSize[0]'></a><br>
					<u>Name of File</u>$dapassword<br>
					$picname";
        }

        $i++;
    }

    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
        while ($x < 5) {
            if ($ajinfo[$x] == "") {
                $ajinfo[$x] = "<img src='modules/$module_name/images/pixel.gif' height='100' width='100'>";
            }
            $x++;
        } // while
    }

    return $ajinfo;
}

function newestbygal($maxsize = 0, $typeof, $galid = '', $limit = '5')
{
    global $prefix, $op, $sql, $module_name, $admin, $adminarea, $db;
    if ($maxsize == "0") {
        $maxsize = "100";
    }

    if (is_admin($admin) && $op != "changedefault" && $adminarea != "adminchangedefault") {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' ORDER BY rawtime DESC LIMIT $limit";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' AND approved='1' ORDER BY rawtime DESC LIMIT $limit";
    }

    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $picid = mysql_result($result, $i, "picid");
        $galid = mysql_result($result, $i, "galid");
        $filename = mysql_result($result, $i, "filename");
        $folder = mysql_result($result, $i, "infolder");
        $picname = mysql_result($result, $i, "picname");
        $galpassword = mysql_result($result, $i, "galpassword");
        $galactive = mysql_result($result, $i, "galactive");
        $fileapproved = mysql_result($result, $i, "approved");
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
        $galtype = $row['galtype'];
        if ($galtype == "member") {
            $typefolder = "memgallery";
        } else {
            $typefolder = "maingallery";
        }
        if ($galpassword != "nopassword") {
            $galpassword = "<img src='modules/$module_name/images/lock.gif'>";
        } else {
            $galpassword = "";
        }

        if ($galactive == "0") {
            $galactive = "Image Not Active<br>";
        } else {
            $galactive = "";
        }
        if ($picid != "") {
            $checkit = "modules/$module_name/files/$typefolder/$folder/$typeof/$filename";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, $maxsize);
            } else {
                $checkit = "modules/$module_name/images/imageerror.gif";
                $imgSize[0] = "100";
                $imgSize[1] = "100";
                // imagefilegone
            }
            if ($adminarea != "") {
                $placefile = "&adminarea=adminfileedit";
            } else {
                $placefile = "&op=fileedit";
            }

            if ($adminarea != "") {
                $placefile1 = "&adminarea=admindeletefile";
            } else {
                $placefile1 = "&op=deletefile";
            }
            if (is_admin($admin)) {
                if ($fileapproved == "1") {
                    $fileapproved = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$picid&setstat=dissapprove'><img src='modules/$module_name/images/disapprove.gif' border='0'></a> || ";
                } else {
                    $fileapproved = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$picid&setstat=approve'><img src='modules/$module_name/images/approve.gif' border='0'></a> || ";
                }
            } else {
                $fileapproved = "";
            }
            $ajinfo[$i] = "<strong>$galactive<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img border='0' src='$checkit' height='$imgSize[1]' width='$imgSize[0]'></a><br>
					$picname</strong>$galpassword<br>
$fileapproved<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img src='modules/$module_name/images/view.gif' border='0'></a> || <a href='modules.php?name=$module_name$placefile&fileid=$picid'><img src='modules/$module_name/images/edit.png' border='0'></a> || <a href='modules.php?name=$module_name$placefile1&fileid=$picid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a>
					<br><br>";
        }

        $i++;
    }

    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
        while ($x < $limit) {
            if ($ajinfo[$x] == "") {
                $ajinfo[$x] = "<img src='modules/$module_name/images/pixel.gif' height='100' width='100'>";
            }
            $x++;
        } // while
    }

    return $ajinfo;
}

function getsubgalbymember($galid)
{
    global $prefix, $sql, $module_name, $db, $cookie, $adminarea;
    if ($adminarea != "") {
        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$galid' ORDER BY rawtime DESC";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$galid' AND galtype='member' ORDER BY rawtime DESC";
    }
    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $daid = mysql_result($result, $i, "galid");
        $daname = mysql_result($result, $i, "name");
        $dafolder = mysql_result($result, $i, "folder");
        $dathumb = mysql_result($result, $i, "thumb");
        $dausername = mysql_result($result, $i, "creator");
        $dapassword = mysql_result($result, $i, "password");
        $active = mysql_result($result, $i, "active");
        $galtype1 = mysql_result($result, $i, "galtype");
        // check for a image as a default?
        if ($active == "0") {
            $active = "Gallery Not Active<br>";
        } else {
            $active = "";
        }

        if ($adminarea != "" && $galtype1 == "main") {
            if ($dathumb == "") {
                $dathumb = "asdasdasdasdasd.adsa";
            }

            $checkthumb = "modules/$module_name/files/maingallery/$dafolder/$dathumb";
            if (!file_exists($checkthumb)) {
                $ajinfo[$i] = "<img border='0' src='modules/$module_name/images/thumbmissing.gif' height='200' width='200'>";
            } else {
                $imgSize = wdresizeinfo($checkthumb, 100);
                $ajinfo[$i] = "<img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'>";
            }
        } else {
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$daid'"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                // check it and show if possible
                $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 100);
                    $ajinfo[$i] = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
                } else {
                    $ajinfo[$i] = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'>";
                }
            } else {
                // Check the next option in the database
                $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$daid' AND approved='1' ORDER BY rawtime ASC"));
                $thumbfromfiles = $row['filename'];
                if ($thumbfromfiles != "") {
                    $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                    if (file_exists($checkit)) {
                        $imgSize = wdresizeinfo($checkit, 100);
                        $ajinfo[$i] = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
                    } else {
                        $ajinfo[$i] = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'>";
                    }
                } else {
                    $ajinfo[$i] = "<img src='modules/$module_name/images/nodefault.gif' height='100' width='100'>";
                }
            }
        }

        if ($dapassword != "") {
            $dapassword = "<img src='modules/$module_name/images/lock.gif'>";
        } else {
            $dapassword = "";
        }

        if ($adminarea != "") {
            $filelocation = "&adminarea=adminuserhome";
        } else {
            $filelocation = "&op=userhome";
        }

        $ajinfo[$i] = "<strong>$active</strong><a href='modules.php?name=$module_name$filelocation&galid=$daid'>" . $ajinfo[$i] . "</a><br><u>Gallery Name</u>$dapassword<br>$daname<br>";
        $i++;
    }
    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
    }

    return $ajinfo;
}

function getallbygal($galid = '', $special = '')
{
    global $prefix, $admin, $op, $sql, $module_name, $db, $adminarea;

    if ($adminarea == "adminchangedefault") {
        $fromfile = "&adminarea=adminchangedefault";
    } else {
        $fromfile = "&op=changedefault";
    }

    if ($adminarea != "") {
        $placefile = "&adminarea=adminfileedit";
    } else {
        $placefile = "&op=fileedit";
    }

    if ($special == "notapproved") {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' AND approved='1' ORDER BY rawtime ASC";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' ORDER BY rawtime ASC";
    }

    $result = mysql_query($sql);
    $num = mysql_numrows($result);
    $i = 0;
    while ($i < $num) {
        $picid = mysql_result($result, $i, "picid");
        $galid = mysql_result($result, $i, "galid");
        $filename = mysql_result($result, $i, "filename");
        $folder = mysql_result($result, $i, "infolder");
        $picname = mysql_result($result, $i, "picname");
        $approved = mysql_result($result, $i, "approved");
        $galpassword = mysql_result($result, $i, "galpassword");
        $galactive = mysql_result($result, $i, "galactive");
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$galid'"));
        $galtype = $row['galtype'];
        if ($galtype == "member") {
            $typefolder = "memgallery";
        } else {
            $typefolder = "maingallery";
        }

        if (is_admin($admin)) {
            if ($approved == "1") {
                $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$picid&setstat=dissapprove'><img src='modules/$module_name/images/disapprove.gif' border='0'></a> || ";
            } else {
                $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$picid&setstat=approve'><img src='modules/$module_name/images/approve.gif' border='0'></a> || ";
            }
        } else {
            $approvedicon = "";
        }

        if ($approved == "0") {
            $approved = "<i>Admin Approval Needed</i><br>";
        } else {
            $approved = "";
        }

        if ($galactive == "0") {
            $galactive = "Image Not Active<br>";
        } else {
            $galactive = "";
        }

        if ($galpassword != "nopassword") {
            $galpassword = "<img src='modules/$module_name/images/lock.gif'>";
        } else {
            $galpassword = "";
        }
        if ($picid != "") {
            $checkit = "modules/$module_name/files/$typefolder/$folder/thumbs/$filename";
            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, 100);
            } else {
                $checkit = "modules/$module_name/images/imageerror.gif";
                $imgSize[0] = "100";
                $imgSize[1] = "100";
                // imagefilegone
            }

            if ($adminarea != "") {
                $placefile1 = "&adminarea=admindeletefile";
            } else {
                $placefile1 = "&op=deletefile";
            }
            if ($special == "notapproved") {
                // This is for default gallery selection.
                $ajinfo[$i] = "<a href='modules.php?name=$module_name$fromfile&galid=$galid&picid=$picid&system=set'><img src='$checkit' height='$imgSize[1]' width='$imgSize[0]' border='2'></a>";
            } else {
                // For normal showing.
                $ajinfo[$i] = "<strong>$galactive$approved<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img src='$checkit' height='$imgSize[1]' width='$imgSize[0]' border='0'></a><br>
					$picname</strong>$galpassword<br>
					$approvedicon<a href='modules.php?name=$module_name&op=viewbig&picid=$picid'><img src='modules/$module_name/images/view.gif' border='0'></a> || <a href='modules.php?name=$module_name$placefile&fileid=$picid'><img src='modules/$module_name/images/edit.png' border='0'></a> || <a href='modules.php?name=$module_name$placefile1&fileid=$picid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a>
					<hr>";
            }
        }

        $i++;
    }

    if ($ajinfo[0] == "") {
        $ajinfo[0] = "NONYET";
    } else {
    }

    return $ajinfo;
}

function getimagesforjava($currentpicid, $currentgalid, $firstpart, $secondpart)
{
    global $prefix, $sql, $user_prefix, $module_name, $db, $cookie, $adminarea;
    $sql = "SELECT * FROM " . $user_prefix . "_reflections_files where galid='$currentgalid' AND approved='1' ORDER BY rawtime";
    $result = mysql_query($sql) or die ('SQL Select Failed!! daincluide');
    $num = mysql_numrows($result);
    $i = 0;

    while ($i < $num) {
        $picid1 = mysql_result($result, $i, "picid");
        $filename1 = mysql_result($result, $i, "filename");

        if ($picid1 == $currentpicid) {

            if ($i-3 > -1) {
                $javapicid[0] = mysql_result($result, $i-3, "picid");
                $javapicname[0] = mysql_result($result, $i-3, "filename");
            }

            if ($i-2 > -1) {
                $javapicid[1] = mysql_result($result, $i-2, "picid");
                $javapicname[1] = mysql_result($result, $i-2, "filename");
            }
            if ($i-1 > -1) {
                $javapicid[2] = mysql_result($result, $i-1, "picid");
                $javapicname[2] = mysql_result($result, $i-1, "filename");
            }
            $javapicid[3] = mysql_result($result, $i, "picid");
            $javapicname[3] = mysql_result($result, $i, "filename");
            if ($i + 1 < $num) {
                $javapicid[4] = mysql_result($result, $i + 1, "picid");
                $javapicname[4] = mysql_result($result, $i + 1, "filename");
            }
            if ($i + 2 < $num) {
                $javapicid[5] = mysql_result($result, $i + 2, "picid");
                $javapicname[5] = mysql_result($result, $i + 2, "filename");
            }
            if ($i + 3 < $num) {
                $javapicid[6] = mysql_result($result, $i + 3, "picid");
                $javapicname[6] = mysql_result($result, $i + 3, "filename");
            }

        }
        $i++;
    }


if ($firstpart == "1") {
	return $javapicid;
} else {

	return $javapicname;
}











}

?>