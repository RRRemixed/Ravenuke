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






if ($galid != "") {
$galid = devilcleanitup($galid);
} else {
    echo "<b><center>This is not a valid gallery. Please create one now <a href='modules.php?name=$module_name&op=creategal'><u>[Click Here]</u></a></b></center>";
    closetable();
    include_once("footer.php");
    die;
}



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

if ($usergalgaltype == "member" && strtolower($usergalcreator) != strtolower($cookie[1]) && !is_admin($admin)) {
    echo "<b><center>This is not your gallery. Please leave now!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($usergalgaltype == "main") {
    echo "<b><center>This is not your gallery. Please leave now!!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}


//galthumbupdatehere. This will be the set one
//galid=$galid&picid=$picid&system=set
if ($usergalid != "" && $picid != "" && $system == "set") {
	//check to see if pic is owned by the gallery
$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_files WHERE approved='1' AND picid='$picid'"));
$checkgalid1 = $row['galid'];
if ($checkgalid1 == $usergalid) {
//Run the save ...
        $db->sql_query("update " . $user_prefix . "_reflections_files set thumbforgalid='' where thumbforgalid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_files set thumbforgalid='$usergalid' where picid='$picid'");

    echo "<br><b><center>Default Gallery Image has been updated. Thanks</b></center><br><hr>";
} else {
//Notifiy user this is a bad id for this gallery.
    echo "<br><b><center>This pic either does not belong to this gallery or is not approved yet! Sorry.</b></center><br><hr>";
}
}

if ($set == "firstpic" && $usergalid != "") {
	$db->sql_query("update " . $user_prefix . "_reflections_files set thumbforgalid='' where thumbforgalid='$usergalid'");
    echo "<br><b><center>Default Gallery Image has been updated to First Pick of approved image in this gallery. Thanks</b></center><br><hr>";
}


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
$ajinfo2 = "firstpick";
        } else {
            $ajinfo = "<img src='modules/$module_name/images/thumbmissing.gif' height='100' width='100'>";
        }
    } else {
        $ajinfo = "<img src='modules/$module_name/images/nodefault.gif' height='100' width='100'>";
    }
}
if ($usergalpassword != "") {
	$usergalpassword = "<img src='modules/$module_name/images/lock.gif'>";
} else {
$usergalpassword = "";
}

// end get gal thumb
echo "<br><center><strong>Change Default Image for Gallery \"$usergalname\"<br><br>Current Default Image<br>
$ajinfo<br>";
if ($ajinfo2 == "firstpick") {
echo "This is the first approved image from this gallery that was uploaded.<br>";
} else {
echo "You set this image as the default gallery image.<br>";
}
echo "<hr>Options Below<br>";
echo "<a href='modules.php?name=$module_name&op=changedefault&set=firstpic&galid=$usergalid'><u>[Click Here]</u></a> To set as first pick from gallery that is approved?";
echo "<hr>OR<hr>";
echo "Click an image below to set it as a default<br>
<i>Notice only approved files will show</i><br>";

$ajinfo = getallbygal($usergalid, "notapproved");

if ($ajinfo[0] == "NONYET") {
	echo "<br><center><strong>No Images in this gallery yet!!</strong></center><br>";
} else {
$i = "0";
$trset = "0";
echo "<table border='0' width='100%'><tr>";
while($ajinfo[$i] != ""){
if ($trset == "4") {
	echo "</tr><tr>";
	$trset = "1";
} else {
$trset++;
}
echo "<td align='center' valign='bottom'><strong>".$ajinfo[$i]."</strong></td>";
$i++;
} // while
echo "</tr></table>";

}



closetable();
include("footer.php");

?>