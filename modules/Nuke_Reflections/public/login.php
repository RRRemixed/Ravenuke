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











$galid = devilcleanitup($galid);
if ($galid == "") {
	echo "<br><b><center>You didn't specify an id.</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if (!is_user($user)) {
	echo "<br><b><center>You are not logged in as a member of this site. You cannot use the password option.</b></center>";
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
    echo "<br><b><center>This is not a valid ID. Please try again!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}

if ($usergalactive != "1") {
    echo "<br><b><center>This gallery or Image is not active. You are not allowed to login to it.</b></center>";
    closetable();
    include_once("footer.php");
    die;

}




if ($usergalgaltype == "member") {


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
} else if ($usergalgaltype == "main") {




if ($usergalthumb == "") {
	$usergalthumb = "asdasda.sadsd";
}
echo "<center>";
   $checkthumb = "modules/$module_name/files/maingallery/$usergalfolder/$usergalthumb";
        if (!file_exists($checkthumb)) {
            echo "<img border='1' src='modules/$module_name/images/nodefault.gif' height='150' width='150'>";
        } else {
            $imgSize = wdresizeinfo($checkthumb, 150);
            echo "<img border='1' src='$checkthumb' width='$imgSize[0]' height='$imgSize[1]'>";
        }

echo "</center>";






}

if ($B1 != "" && $securitycode1 != "" && $securitycode != "") {


	$T1 = devilcleanitup($T1);
	$securitycode = devilcleanitup($securitycode);
	$securitycode1 = devilcleanitup($securitycode1);
	$securitycode1 = md5($securitycode1);

	if ($securitycode == $securitycode1) {
//security code is ok.

if (md5($T1) == $usergalpassword) {

	//all ok now put into logins.
$darawtime = time();
$sql = "INSERT INTO " . $prefix . "_reflections_logins (`id`, `username`, `galid`, `galpassword`, `rawtime`) VALUES ('', '$cookie[1]', '$usergalid', '$usergalpassword', '$darawtime')";
mysql_query($sql);


      if ($loginkilltime < 60) {
            $timeleft1 = $loginkilltime . " seconds";
        } else {
            $loginkilltime = round($loginkilltime / 60);
            if ($loginkilltime < 60)
                $timeleft1 = $loginkilltime . " minutes";
            else {
                $loginkilltime = round($loginkilltime / 60);
                if ($loginkilltime < 24)
                    $timeleft1 = $loginkilltime . " hours";
                else {
                    $loginkilltime = round($loginkilltime / 24);
                    if ($loginkilltime < 7)
                        $timeleft1 = $loginkilltime . " days";
                    else {
                        $loginkilltime = round($loginkilltime / 7);
                        $timeleft1 = $loginkilltime . " weeks";
                    }
                }
            }
        }




    echo "<br><b><center>You are now granted access the the gallery and it's images.
	<br>Your session will timeout ".$timeleft1." of no activity in the gallery pages.
	<br>Thank you!<br>
	<br>
	<a href=\"modules.php?name=$module_name&op=showgal&galid=$galid\">[Click Here]</a> To goto the gallery you have access to.<br>
	<br>
	</b></center>";
    closetable();
    include_once("footer.php");
    die;




} else {
//badpassword show the form again
title("Password is Incorrect");

}




	} else {
title("Security Code is WRONG. Please retry!");
	}



}















// end get gal thumb
echo "<center><strong><br>Gallery Image<br>$ajinfo<br><strong>You have selected an Image or Gallery that is Locked with a password.<br>
To View it you need to enter a password.<br>
If you selected an image then you will need the gallery password that the image is inside of.
<br><br>";
    echo "<form method=\"POST\" action=\"modules.php?name=$module_name&op=login&galid=$usergalid\">";
    echo "Please enter password<br><input type=\"text\" name=\"T1\" size=\"30\">";
 echo "<br>Security Code<br>";
            srand(time());
        $apple = rand(1111, 9999);
        $apple2 = rand(1111, 9999);
        $apple3 = rand(1111, 9999);
        $apple4 = rand(1111, 9999);
        $maincode = rand(1, 4);
        echo "<table border=\"1\" width=\"250\" id=\"table1\">";
        echo "	<tr>";
        echo "		<td bgcolor=\"#0000FF\" align=\"center\"><b>";
        echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple</font></b></td>";
        echo "		<td bgcolor=\"#008000\" align=\"center\"><b>";
        echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple2</font></b></td>";
        echo "		<td bgcolor=\"#FF0000\" align=\"center\"><b>";
        echo "		<font color=\"#FFFFFF\" face=\"Arial\">$apple3</font></b></td>";
        echo "		<td bgcolor=\"yellow\" align=\"center\"><b>";
        echo "		<font color=\"black\" face=\"Arial\">$apple4</font></b></td>";
        echo "	</tr>";
        echo "</table>";
        $apple = md5($apple);
        $apple2 = md5($apple2);
        $apple3 = md5($apple3);
        $apple4 = md5($apple4);
        if ($maincode == "1") {
            $green = $apple;
            $color1 = "Blue";
        }
        if ($maincode == "2") {
            $green = $apple2;
            $color1 = "Green";
        }
        if ($maincode == "3") {
            $green = $apple3;
            $color1 = "Red";
        }
                if ($maincode == "4") {
            $green = $apple4;
            $color1 = "Yellow";
        }
        echo "<input type=\"hidden\" name=\"securitycode\" size=\"80\" value=\"$green\">";
        echo "Please re-enter code in the \"<b>$color1</b>\" Box <br><input type=\"text\" name=\"securitycode1\" size=\"6\">";
    echo "<br><input type=\"submit\" value=\"Submit\" name=\"B1\">";
    echo "<input type=\"reset\" value=\"Reset\" name=\"B2\">";
    echo "</form>";






closetable();
include("footer.php");

?>