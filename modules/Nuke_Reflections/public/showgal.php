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








global $cookie;
if ($galid == "") {
	echo "<br><b><center>No Gallery id was selected.</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($sortby == "") {
    $sortby = "rawtime";
}
if ($orderby == "") {
    $orderby = "DESC";
}
if ($screen == "") {
    $screen = "0";
}

$sortby = devilcleanitup($sortby);
$orderby = devilcleanitup($orderby);
$screen = devilcleanitup($screen);

$galid = devilcleanitup($galid);
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
$usergalcreator1 = $row['creator'];
$usergalmemberupload = $row['memberupload'];
$usergaltotalview = $row['totalview'];
$usergalextra1 = $row['extra1'];
$usergalextra2 = $row['extra2'];
$usergalextra3 = $row['extra3'];
$usergalextra4 = $row['extra4'];
$usergallastseen = $row['extra5'];

if ($usergalid == "") {
	echo "<br><b><center>This was not a valid gallery. Please choose one that is!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($usergallastseen == "" && $usergaltotalview != "0") {
	$usergallastseen = "Guest";
} else if ($usergallastseen == "" && $usergaltotalview == "0") {
		$usergallastseen = "None Yet";
} else if ($usergallastseen != "" && $usergaltotalview != "0") {
$usergallastseen = "<a href='modules.php?name=Your_Account&op=userinfo&username=$usergallastseen'><u>$usergallastseen</u></a>";
}

if (!is_admin($admin)) {
if (strtolower($cookie[1]) != strtolower($usergalcreator)) {
if ($usergalactive = "0") {
	echo "<br><b><center>Gallery not active. You either need to be an admin or the creator to view!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}
}
}

if (!is_admin($admin) && strtolower($cookie[1]) != strtolower($usergalcreator) && $usergalgaltype != "main") {
    if ($usergalpassword != "") {
        $row222 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_logins WHERE galid='$usergalid' AND galpassword='$usergalpassword' AND username='$cookie[1]'"));
        $checkpassstatus = $row222['id'];

        if ($checkpassstatus != "") {
            // ok
        } else {
            // show login form!
            Header("Location: modules.php?name=$module_name&op=login&galid=$usergalid");
        }
    }
} else if (!is_admin($admin) && $usergalgaltype == "main") {
    if ($usergalpassword != "") {
        $row222 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_logins WHERE galid='$usergalid' AND galpassword='$usergalpassword' AND username='$cookie[1]'"));
        $checkpassstatus = $row222['id'];

        if ($checkpassstatus != "") {
            // ok
        } else {
            // show login form!
            Header("Location: modules.php?name=$module_name&op=login&galid=$usergalid");
        }
    }
}

//Lets do a View Count now..
    $counttimer = round(5 * 60);
    $past = time() - $counttimer;
    $sql = "DELETE FROM " . $prefix . "_reflections_galviewcounts WHERE rawtime < $past";
    $db->sql_query($sql);
    $useripaddy = getenv("REMOTE_ADDR");
    if (is_user($user)) {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_galviewcounts where nick='$cookie[1]' AND galid='$usergalid'"));
        $supergreat = "$cookie[1]";
    } else {
        $row6 = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $user_prefix . "_reflections_galviewcounts where ipaddy='$useripaddy' AND galid='$usergalid'"));
        $supergreat = "$useripaddy";
    }
    $viewcountcheck = $row6['rawtime'];
    if ($viewcountcheck == "0" || $viewcountcheck == "") {
        // update
        if ($usergaltotalview == "") {
            $usergaltotalview = "1";
        } else {
            $usergaltotalview = $usergaltotalview + 1;
        }

        $db->sql_query("update " . $prefix . "_reflections_gallery set totalview='$usergaltotalview', extra5='$cookie[1]' WHERE galid='$usergalid'");
        $cooltime = time();
        $sql9 = "INSERT INTO `" . $user_prefix . "_reflections_galviewcounts` (`id`, `galid`, `nick`, `ipaddy`, `rawtime`) VALUES ('', '$usergalid', '$cookie[1]', '$useripaddy', '$cooltime')";
        mysql_query($sql9);
    } else {
        // dont update
    }

if ($usergalcreator == "Guest" || $usergalcreator == "") {
	$usergalcreator == "Guest";
} else {
$usergalcreator = "<a href='modules.php?name=Your_Account&op=userinfo&username=$usergalcreator'><u>$usergalcreator</u></a>";
}








$dacurrentpage = $screen + 1;

if (is_admin($admin)) {
    $sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where galid='$usergalid'";
} else {
    $sql90 = "SELECT * FROM " . $user_prefix . "_reflections_files where galid='$usergalid' AND approved='1'";
}
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);


if ($usergalparentid != "0") {
echo "<a href=\"modules.php?name=$module_name&op=showgal&galid=$usergalparentid\"><centeR><strong>Back to Gallery Root</centeR></strong></a>";
}

echo "<table border='1' width='100%'>";




echo "<tr><td height=\"1\" width=\"1\" align=\"center\">";

if ($usergalgaltype == "main") {
if ($usergalthumb == "") {
	$usergalthumb = "asdasda.sadsd";
}
   $checkthumb = "modules/$module_name/files/maingallery/$usergalfolder/$usergalthumb";
        if (!file_exists($checkthumb)) {
            echo "<img border='1' src='modules/$module_name/images/nodefault.gif' height='150' width='150'>";
        } else {
            $imgSize = wdresizeinfo($checkthumb, 150);
            echo "<img border='1' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'>";
        }
} else {
$ajsapple = getmemthumb($usergalid, $usergalfolder);
echo $ajsapple;

}

if (is_admin($admin)) {
echo "<br><br><a href='modules.php?name=$module_name&adminarea=adminchangedefault&galid=$usergalid'>Change Default<br>Gallery Image<bR></a>";
} else if (strtolower($usergalcreator1) == strtolower($cookie[1]) && $usergalgaltype != "main") {
echo "<br><Br><a href='modules.php?name=$module_name&op=changedefault&galid=$usergalid'>Change Default<br>Gallery Image<br></a>";
}
echo "</td>";
echo "<td valign='top'><strong>Gallery Name :: $usergalname<br>
Gallery Description :: $usergaldesc<br>
Created by :: $usergalcreator<br>
Total Views :: $usergaltotalview - Last Seen by :: $usergallastseen <br>
";


if (is_admin($admin)) {
	echo "<u>Admin Options</u><br><a href=\"modules.php?name=$module_name&adminarea=admingaledit&galid=$usergalid\"><img border=\"0\" src=\"modules/$module_name/images/edit.png\"></a> ||
	 <a href=\"modules.php?name=$module_name&adminarea=admindeletegallery&galid=$usergalid\"><img border=\"0\" src=\"modules/$module_name/images/delete.gif\"></a>";
} else if (strtolower($cookie[1]) == strtolower($usergalcreator1) && $usergalgaltype != "main") {
	echo "<u>Owner Options</u><br><a href=\"modules.php?name=$module_name&op=galedit&galid=$usergalid\"><img border=\"0\" src=\"modules/$module_name/images/edit.png\"></a> ||
	 <a href=\"modules.php?name=$module_name&op=deletegallery&galid=$usergalid\"><img border=\"0\" src=\"modules/$module_name/images/delete.gif\"></a>";

} else {
//user options
}






echo "<hr></td></tr>
";




//start sub gal list
if ($usergalparentid == "0") {

//function in self
$ajinfo2 = getsubgalbyid($usergalid, $usergalgaltype);

if ($ajinfo2 != "") {


echo "<tr><td colspan='2'><a name='alaslakl2' onclick='deviltag2();'><strong><u><center>[Show Sub Galleries + ]</center></u></a><br>";
echo "<div id='deviltag2' class='deviltag2hidden'>";

echo "<center><strong>Sub Galleries below</strong></center>";
echo "<table border=\"0\" width=\"100%\"><tr>";
$tr1=0;
$x=0;
while($ajinfo2[$x] != ""){
if ($tr1 == "4") {
	echo "</tr><tr>";
	$tr1 = "1";
} else {
$tr1++;
}
	echo "<td align=\"center\" valign=\"bottom\">".$ajinfo2[$x]."<hr></td>";
	$x++;


} // while

echo "</tr></table>";
echo "</div>";
echo "</strong></td></tr>";
}
}

//end sub gal list


echo "<tr><td colspan='2'>
<center>
<strong>Images in this Gallery - Total $num90 Images<br>

<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalview&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalview&orderby=DESC'>Viewed</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalview&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>
 ::
<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=advarage&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=advarage&orderby=DESC'>Rating</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=advarage&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>
 ::
<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalvote&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalvote&orderby=DESC'>Total Votes</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalvote&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>
 ::
Page = $dacurrentpage
 ::
<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=rawtime&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=rawtime&orderby=DESC'>Newest</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=rawtime&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>
 ::
<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalcomments&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalcomments&orderby=DESC'>Comments</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=totalcomments&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>
 ::
<a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=size&orderby=DESC'><img src='modules/$module_name/images/down.gif' border='0'></a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=size&orderby=DESC'>Size</a> <a href='modules.php?name=$module_name&op=showgal&galid=$usergalid&screen=$screen&sortby=size&orderby=ASC'><img src='modules/$module_name/images/up.gif' border='0'></a>

<br><br>";

echo "<table border='0' width='100%'>";
echo "<tr>";













$filesforthisgal = getfilesforgal($usergalid, $screen, $sortby, $orderby);

$i=0;
$trset=0;
while($filesforthisgal[$i] != ""){
if ($trset == "4") {
	echo "</tr><tr>";
	$trset = "1";
} else {
$trset++;
}
echo "<td valign='bottom' align='center'>";
echo $filesforthisgal[$i] . "<br>";
echo "</td>";

	$i++;
} // while


echo "</tr>";
echo "</table>";





echo "<br>";

$apple123blue = getpagenumbers($usergalid, $screen, $sortby, $orderby, "0");

echo $apple123blue;

echo "</center>

</td></tr>
</table>

";



closetable();
include_once("footer.php");



function getfilesforgal($galid, $screen, $sortby, $orderby){

    global $cookie, $maxperpage, $prefix, $sql, $module_name, $admin, $db, $maxthumbsizegal;






$rows_per_page = $maxperpage;
$start = $screen * $rows_per_page;

    if (is_admin($admin)) {
if ($sortby == "advarage") {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' ORDER BY `totalvote` $orderby, `$sortby` $orderby LIMIT $start, $rows_per_page";
} else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' ORDER BY `$sortby` $orderby LIMIT $start, $rows_per_page";

}
   } else {

   if ($sortby == "advarage") {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' AND approved='1' ORDER BY `totalvote` $orderby, `$sortby` $orderby LIMIT $start, $rows_per_page";

} else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' AND approved='1' ORDER BY `$sortby` $orderby LIMIT $start, $rows_per_page";

}

   }
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
	$mainlocation = "maingallery";
} else {
$mainlocation = "memgallery";
}

if ($filefilename == "") {
	$filefilename = "asdasdasdasdasdasdasd.asd";
}

$checkit = "modules/$module_name/files/$mainlocation/$filefolder/thumbs/$filefilename";

if (file_exists($checkit)) {

$imgSize = wdresizeinfo($checkit, $maxthumbsizegal);
	$filewpath = $checkit;
	$error1 = "";
} else {
$imgSize = wdresizeinfo("modules/$module_name/images/thumbmissing.gif", $maxthumbsizegal);
$filewpath = "modules/$module_name/images/thumbmissing.gif";
$error1 = "1";
}

if ($fileapproved == "0") {
	$fileapprovalneeded = "<strong>Approval Needed!</strong><br>";
} else {
	$fileapprovalneeded = "";
}

if ($cookie[1] == $fileupnick) {
$editlinkimage = "|| <a href='modules.php?name=$module_name&op=fileedit&fileid=$filepicid'><img src='modules/$module_name/images/edit.png' border='0'></a>";
} else if (is_admin($admin)) {
$editlinkimage = "|| <a href='modules.php?name=$module_name&adminarea=adminfileedit&fileid=$filepicid'><img src='modules/$module_name/images/edit.png' border='0'></a>";
} else {
$editlinkimage = "";
}

$viewlinkimage = "<a href='modules.php?name=$module_name&op=viewbig&picid=$filepicid'><img src='modules/$module_name/images/view.gif' border='0'></a>";

if (is_admin($admin)) {
        if ($fileapproved == "1") {
            $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=dissapprove'><img src='modules/$module_name/images/disapprove.gif' border='0'></a> ||";
        } else {
            $approvedicon = "<a href='modules.php?name=$module_name&adminarea=adminapproveprocess&fileid=$filepicid&setstat=approve'><img src='modules/$module_name/images/approve.gif' border='0'></a> ||";
        }
} else {
$approvedicon = "";
}



if ($cookie[1] == $fileupnick) {
$deletelinkimage = "|| <a href='modules.php?name=$module_name&op=deletefile&fileid=$filepicid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a>";
} else if (is_admin($admin)) {
$deletelinkimage = "|| <a href='modules.php?name=$module_name&adminarea=admindeletefile&fileid=$filepicid'><img src='modules/$module_name/images/delete.gif' height='16' width='16' border='0'></a>";
} else {
$deletelinkimage = "";
}



if ($filepassword != "nopassword") {
	$lockicon = "<img src=\"modules/$module_name/images/lock.gif\">";
} else {
$lockicon = "";
}



$apple[$i] = "$fileapprovalneeded<a href=\"modules.php?name=$module_name&op=viewbig&picid=$filepicid\"><img src=\"$filewpath\" height=\"$imgSize[1]\" width=\"$imgSize[0]\" border=\"0\"></a>
<br><strong>$filepicname$lockicon</strong><br>
$approvedicon $viewlinkimage $editlinkimage $deletelinkimage<hr>

";

$i++;



    }




return $apple;














}





function getsubgalbyid($galid, $galtype){
global $prefix, $sql, $module_name, $admin, $db;
    if (is_admin($admin)) {
        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$galid'";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$galid' AND active='1'";
    }
$result = mysql_query($sql) or die ('SQL Select Failed!!');
$num = mysql_numrows($result);
$i = 0;
while ($i < $num) {
    $subgalid = mysql_result($result, $i, "galid");
    $subgalname = mysql_result($result, $i, "name");
    $subgaldesc = mysql_result($result, $i, "desc");
    $subgalthumb = mysql_result($result, $i, "thumb");
    $subgalfolder = mysql_result($result, $i, "folder");
    $subgalactive = mysql_result($result, $i, "active");
    $subgalpassword = mysql_result($result, $i, "password");

        if ($galtype == "main") {
            if ($dathumb == "") {
                $dathumb = "asdasdasdasdasd.adsa";
            }

            $checkthumb = "modules/$module_name/files/maingallery/$subgalfolder/$subgalthumb";
            if (!file_exists($checkthumb)) {
                $ajinfo[$i] = "<img border='0' src='modules/$module_name/images/thumbmissing.gif' height='200' width='200' border='0'>";
            } else {
                $imgSize = wdresizeinfo($checkthumb, 100);
                $ajinfo[$i] = "<img border='0' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]' border='0'>";
            }
        } else {
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$subgalid'"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                // check it and show if possible
                $checkit = "modules/$module_name/files/memgallery/$subgalfolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 100);
                    $ajinfo[$i] = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]' border='0'>";
                } else {
                    $ajinfo[$i] = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100' border='0'>";
                }
            } else {
                // Check the next option in the database
                $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$subgalid' AND approved='1' ORDER BY rawtime ASC"));
                $thumbfromfiles = $row['filename'];
                if ($thumbfromfiles != "") {
                    $checkit = "modules/$module_name/files/memgallery/$subgalfolder/thumbs/$thumbfromfiles";
                    if (file_exists($checkit)) {
                        $imgSize = wdresizeinfo($checkit, 100);
                        $ajinfo[$i] = "<img src='$checkit' width='$imgSize[0]' height='$imgSize[1]' border='0'>";
                    } else {
                        $ajinfo[$i] = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100' border='0'>";
                    }
                } else {
                    $ajinfo[$i] = "<img src='modules/$module_name/images/nodefault.gif' height='100' width='100' border='0'>";
                }
            }
        }


if ($subgalactive == "0") {
$subgalactive = "Not Active<br>";
} else {
$subgalactive = "";
}
if ($subgalpassword != "") {
$subgalpassword = "<img src=\"modules/$module_name/images/lock.gif\"";
} else {
$subgalpassword = "";
}

if (is_admin($admin)) {
    $sql90 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$subgalid'";
} else {
    $sql90 = "SELECT * FROM " . $prefix . "_reflections_files where galid='$subgalid' AND approved='1'";
}
    $result90 = mysql_query($sql90);
    $num90 = mysql_numrows($result90);

$ajinfo[$i] = "<strong>" . $subgalactive . "<a href=\"modules.php?name=$module_name&op=showgal&galid=$subgalid\">" . $ajinfo[$i] . "</a>" .
"<br><u>Gallery Name</u><br><a href=\"modules.php?name=$module_name&op=showgal&galid=$subgalid\">" . $subgalname . "</a>" . $subgalpassword . "<br>" .
"$num90 Files</strong>";










$i++;
}


return $ajinfo;



}




function getpagenumbers($galid, $screen, $sortby, $orderby, $returnwhat){
    global $maxperpage, $prefix, $sql, $module_name, $admin, $db;
    $rows_per_page = $maxperpage;
    if (is_admin($admin)) {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' order by $sortby $orderby";
    } else {
        $sql = "SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$galid' AND approved='1' order by $sortby $orderby";
    }
    $result = mysql_query($sql);
    $total_records = mysql_numrows($result);
    $pages = ceil($total_records / $rows_per_page);
    if (!isset($screen))
        $screen = 0;
    $start = $screen * $rows_per_page;


    if ($screen > 0) {
        $info1 = $screen - 1;
        $url = "modules.php?name=$module_name&op=showgal&galid=$galid&screen=$info1&sortby=$sortby&orderby=$orderby";
        $sendpageinfo = "<a href=\"$url\">Previous</a>\n";
        $nextprev[0] = "<a href=\"$url\">Previous</a> ::";
    }
    // page numbering links now

    for ($i = 0; $i < $pages; $i++) {
        $url = "modules.php?name=$module_name&op=showgal&galid=$galid&screen=" . $i . "&sortby=$sortby&orderby=$orderby";
        $something123 = $i + 1;
        if ($i == $screen) {
            $sendpageinfo = $sendpageinfo . " | <b>Current Page = $something123</b>  ";
        } else {
            $sendpageinfo = $sendpageinfo . " | <a href=\"$url\">$something123</a>  ";
        }
    }



    if ($screen + 1 < $pages) {
        $info1 = $screen + 1;
        $url = "modules.php?name=$module_name&op=showgal&galid=$galid&screen=$info1&sortby=$sortby&orderby=$orderby";
        $sendpageinfo = $sendpageinfo . " | <a href=\"$url\">Next</a>";
        $nextprev[1] = ":: <a href=\"$url\">Next</a>";
    }


if ($returnwhat == "0") {
return $sendpageinfo;
} else if ($returnwhat == "1") {
	return $nextprev;
}






}


function getmemthumb($daid, $dafolder){
    global $hiddenspecial, $showgalurl, $prefix, $sql, $module_name, $admin, $db;
        // check for a image as a default?
        $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE thumbforgalid='$daid'"));
        $thumbfromfiles = $row['filename'];

        if ($thumbfromfiles != "") {
            // check it and show if possible
            $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";

            if (file_exists($checkit)) {
                $imgSize = wdresizeinfo($checkit, 150);
                $ajinfo90 = "<img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
            } else {
                $ajinfo90 = "<img border='0' src='modules/$module_name/images/thumbmissing.gif' height='150' width='150'>";
            }
        } else {
            // Check the next option in the database
            $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE galid='$daid' AND approved='1' ORDER BY rawtime ASC"));
            $thumbfromfiles = $row['filename'];
            if ($thumbfromfiles != "") {
                $checkit = "modules/$module_name/files/memgallery/$dafolder/thumbs/$thumbfromfiles";
                if (file_exists($checkit)) {
                    $imgSize = wdresizeinfo($checkit, 150);
                    $ajinfo90 = "<img border='0' src='$checkit' width='$imgSize[0]' height='$imgSize[1]'>";
                } else {
                    $ajinfo90 = "<img border='0' src='modules/$module_name/images/thumbmissing.gif' height='150' width='150'>";
                }
            } else {
                $ajinfo90 = "<a href='$showgalurl$daid'><img border='0' src='modules/$module_name/images/nodefault.gif' height='150' width='150'></a>";
            }
        }
return $ajinfo90;

}
?>