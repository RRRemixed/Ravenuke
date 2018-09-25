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

if ($usergalid == "") {
    echo "<b><center>This is not a valid gallery. Please create one now <a href='modules.php?name=$module_name&op=creategal'><u>[Click Here]</u></a></b></center>";
    closetable();
    include_once("footer.php");
    die;
}

$T1 = devilcleanitup($T1);
$T2 = devilcleanitup($T2);
$T3 = devilcleanitup($T3);
$R1 = devilcleanitup($R1);
if ($usergalgaltype == "main") {
    $memup = devilcleanitup($memup);
}

if ($updategal != "" && $usergalid != "") {
    echo "<br><center><strong>Updating information for Gallery<br>\"$usergalname\"<br>";

    if ($T1 != $usergalname && $T1 != "") {
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set name='$T1' where galid='$usergalid'");
        echo "<br>Updated Gallery Name<br>";
    }
    if ($T2 != $usergaldesc && $T2 != "") {
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set desc='$T2' where galid='$usergalid'");
        echo "Updated Gallery Description<br>";
    }
    // Update alot at this point for the Gal Active Part.
    // applytosub
    // active not to sub galleries.
    if ($R1 != $usergalactive && $R1 != "" && $applytosubative != "yes") {
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set active='$R1' where galid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_files set galactive='$R1' where galid='$usergalid'");
        echo "Updated Gallery Active Status<br>";
    }
    // active to sub galleries
    if ($applytosubative == "yes" && $R1 != "") {
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set active='$R1' where galid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set active='$R1' where parentid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_files set galactive='$R1' where galid='$usergalid'");
        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$usergalid'";
        $result = mysql_query($sql);
        $num = mysql_numrows($result);
        $i = 0;
        while ($i < $num) {
            $dagalid = mysql_result($result, $i, "galid");
            $db->sql_query("update " . $user_prefix . "_reflections_files set galactive='$R1' where galid='$dagalid'");
            $i++;
        }
        echo "Updated Gallery Active Status<br>";
    }
    // End Active Status
    // Update alot at this point for the Gal member up Part.
    // applytosub
    // active not to sub galleries.
    if ($usergalgaltype == "main") {
        if ($memup != $usergalmemberupload && $memup != "" && $applytosubmemup != "yes") {
            $db->sql_query("update " . $user_prefix . "_reflections_gallery set memberupload='$memup' where galid='$usergalid'");
            echo "Updated Gallery Member Upload Status<br>";
        }
        // active to sub galleries
        if ($applytosubmemup == "yes" && $memup != "") {
            $db->sql_query("update " . $user_prefix . "_reflections_gallery set memberupload='$memup' where galid='$usergalid'");
            $db->sql_query("update " . $user_prefix . "_reflections_gallery set memberupload='$memup' where parentid='$usergalid'");
            echo "Updated Gallery Member Upload Status<br>";
        }
        // End Active Status
    }
    // Password set no subs
    if ($applytosub != "yes" && $T3 != $usergalpassword) {
        if ($T3 != "") {
            $T3 = md5($T3);
            $appleblue = $T3;
        } else {
            $appleblue = "nopassword";
        }

        $db->sql_query("update " . $user_prefix . "_reflections_gallery set password='$T3' where galid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_files set galpassword='$appleblue' where galid='$usergalid'");
        echo "Updated Gallery Password<br>";
    }
    // Password set With subs.
    if ($applytosub == "yes") {
        if ($T3 != $usergalpassword) {
            if ($T3 != "") {
                $T3 = md5($T3);
                $appleblue = $T3;
            } else {
                $appleblue = "nopassword";
            }
        } else {
            if ($T3 == "") {
                $appleblue = "nopassword";
            }
        }

        $db->sql_query("update " . $user_prefix . "_reflections_gallery set password='$T3' where galid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_gallery set password='$T3' where parentid='$usergalid'");
        $db->sql_query("update " . $user_prefix . "_reflections_files set galpassword='$appleblue' where galid='$usergalid'");

        $sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$usergalid'";
        $result = mysql_query($sql);
        $num = mysql_numrows($result);
        $i = 0;
        while ($i < $num) {
            $dagalid = mysql_result($result, $i, "galid");

            $db->sql_query("update " . $user_prefix . "_reflections_files set galpassword='$appleblue' where galid='$dagalid'");
            $i++;
        }
        echo "Updated Gallery Password<br>";
    }

    echo "End update of gallery information!<br>
	<br>
	<a href='modules.php?name=$module_name&adminarea=adminuserhome&galid=$usergalid'><u>[Click Here] To go back to gallery home.</u></a>
	<br>";

    closetable();
    include("footer.php");
    die;
}
// Show changing form...
echo "<br><center><strong>Edit information for Gallery<br>\"$usergalname\"";

echo "

<form method='POST' name='post' action='modules.php?name=$module_name&adminarea=admingaledit&galid=$usergalid'>
	<table border='0' width='100%' id='table112323'>
		<tr>
			<td align='right'><b>Name of Gallery</b></td>
			<td><input name='T1' value='$usergalname' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Description of Gallery</b></td>
			<td><input name='T2' value='$usergaldesc' size='20' style='font-weight: 700'></td>
		</tr>";

if ($usergalgaltype == "main") {
    echo "					<tr>
			<td align='right'><b>Allow Member Uploads</b></td>
			<td>";

    if ($usergalmemberupload == "1") {
        echo "Yes <input type='radio' value='1' checked name='memup' style='font-weight: 700'> No <input type='radio' name='memup' value='0' style='font-weight: 700'>";
    } else {
        echo "Yes <input type='radio' value='1' name='memup' style='font-weight: 700'> No <input type='radio' checked name='memup' value='0' style='font-weight: 700'>";
    }

    echo "</td>

		</tr>";

    if ($usergalparentid == "0") {
        echo "<tr>
		<td width='50%' align='right'>
		<strong>Apply Member Upload status to Sub Galleries?</strong>
		</td>
		<td>
		<input type='checkbox' name='applytosubmemup' value='yes'>
		</td>
		</tr>";
    }
}

echo "		<tr>
			<td align='right'><b>Gallery Active</b></td>
			<td>";

if ($usergalactive == "1") {
    echo "Yes <input type='radio' value='1' checked name='R1' style='font-weight: 700'> No <input type='radio' name='R1' value='0' style='font-weight: 700'>";
} else {
    echo "Yes <input type='radio' value='1' name='R1' style='font-weight: 700'> No <input type='radio' checked name='R1' value='0' style='font-weight: 700'>";
}

echo "</td>	</tr>";

if ($usergalparentid == "0") {
    echo "<tr>
		<td width='50%' align='right'>
		<strong>Apply Active status to Sub <br>Galleries and there files?</strong>
		</td>
		<td>
		<input type='checkbox' name='applytosubative' value='yes'>
		</td>
		</tr>";
}
echo "<tr>
			<td align='right'><b>Gallery Password <br></td>
			<td valign='top'><input name='T3' value='$usergalpassword' size='20' style='font-weight: 700'></td>
		</tr>";

if ($usergalparentid == "0") {
    echo "<tr>
		<td width='50%' align='right'>
		<strong>Apply Password status <br>to Sub Galleries and there files?</strong>
		</td>
		<td>
		<input type='checkbox' name='applytosub' value='yes'>
		</td>
		</tr>";
}
echo "<tr>
		<td colspan='2' align='center'>
		<i>(PASSWORD optional Enter only if you want to password protect from other members)<br>
		NOTES :: If you do not want a password then leave blank.<br>
		If you have a password and want it to be the same then leave it alone<br>
		It is md5 encoded so it will not look right to you but it is.<br>
		To change the password just choose a new one. It will be md5 encoded when saved<br>
		so it cannot be retreived just changed.<br>
		All images in this gallery will be affected.</i>
		</td>
		</tr>";

echo "<tr>
			<td colspan='2'>
			<p align='center'>
			<input type='submit' value='Submit' name='updategal' style='font-weight: 700'><input type='reset' value='Reset' name='B2' style='font-weight: 700'></td>
		</tr>
	</table>
</form>
";

closetable();
include("footer.php");

?>