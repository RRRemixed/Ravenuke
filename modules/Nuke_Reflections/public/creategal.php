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


if ($reflecnick == "Guest" && !is_admin($admin)) {
	        echo "<b><center>You must be an admin or a registered and logged in user to make a gallery!! Please login!!</b></center>";
        closetable();
        include_once("footer.php");
        die;
}

if ($allowmembergalleries == "0" && !is_admin($admin)) {
		echo "<b><center>Member Gallery creation has been turned off by the admin. Sorry.</b></center>";
        closetable();
        include_once("footer.php");
        die;
}



//special show to the admin
if (is_admin($admin)) {
Header("Location: modules.php?name=$module_name&adminarea=admincreategal");
}
//end special show to the admin

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM ".$prefix."_reflections_gallery WHERE creator='$cookie[1]' AND parentid='0' AND galtype='member'"));
$checkpersonal = $row['galid'];

//Member First time Gallery Create
if ($checkpersonal == "") {
echo "<br><center><span class='deviltitle'>Member Gallery First Time</span></center>";
if ($iagree == "yes") {
	//Show form for creating since they agreed.

srand(time());
$apple = rand(1111, 9999);
$securitycode = md5($apple);
$securitycode1 = $apple;
echo "	<center><strong>Please fill out the fallowing information to use for your main member gallery</strong></center><br>";
echo "

<form method='POST' name='post' action='modules.php?name=$module_name&op=creategal2'>
	<table border='0' width='100%' id='table112323'>
		<tr>
			<td align='right'><b>Name of Gallery</b></td>
			<td><input name='T1' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Description of Gallery</b></td>
			<td><input name='T2' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Active</b></td>
			<td>
			Yes <input type='radio' value='1' checked name='R1' style='font-weight: 700'> No <input type='radio' name='R1' value='0' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Password <br><i>(optional Enter only if you <br>want to password protect <br>from other members)</i></b></td>
			<td valign='top'><input name='T3' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'>
			<input type='hidden' name='securitycode' value='$securitycode' size='20'>
			<input type='hidden' name='securitycode1' value='$securitycode1' size='20'>
			<input type='submit' value='Submit' name='creatememadmin' style='font-weight: 700'><input type='reset' value='Reset' name='B2' style='font-weight: 700'></td>
		</tr>
	</table>
</form>
";

closetable();
include("footer.php");
die;







} else {

//Show Agreement
echo "<strong><center> You do not have a personal gallery in our system yet. <br>
Please read the TOS below and if you agree you may create a personal gallery.</center>";
echo "<hr>";
include_once("modules/$module_name/TOSFiles/memgaltos.html");
echo "<hr>";
echo "<center><a href='modules.php?name=$module_name&op=creategal&iagree=yes'><u>I Agree</u></a> || <a href='index.php'><u>I Disagree</u></a></center>";
closetable();
include("footer.php");
die;
}
}
//end first time create


// Member create sub gallery system
if ($checkpersonal != "") {
echo "<br><center><span class='deviltitle'>Create Member Sub Gallery</span></center>";

echo "	<center><strong>Please fill out the fallowing information to use for your main member sub gallery</strong></center><br>";
echo "

<form method='POST' name='post' action='modules.php?name=$module_name&op=creategal2'>
	<table border='0' width='100%' id='table112323'>
		<tr>
			<td align='right'><b>Name of Gallery</b></td>
			<td><input name='T1' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Description of Gallery</b></td>
			<td><input name='T2' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Active</b></td>
			<td>
			Yes <input type='radio' value='1' checked name='R1' style='font-weight: 700'> No <input type='radio' name='R1' value='0' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td align='right'><b>Gallery Password <br><i>(optional Enter only if you <br>want to password protect <br>from other members)</i></b></td>
			<td valign='top'><input name='T3' size='20' style='font-weight: 700'></td>
		</tr>
		<tr>
			<td colspan='2'>
			<p align='center'>
			<input type='hidden' name='memmainid' size='20' value='$checkpersonal' style='font-weight: 700'>";


if ($membersecuritycreate == "1") {


	echo "<strong>Security Code<br>";
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
echo "<br><br>";
}

echo "<input type='submit' value='Submit' name='creatememsub' style='font-weight: 700'><input type='reset' value='Reset' name='B2' style='font-weight: 700'></td>
		</tr>
	</table>
</form>
";

closetable();
include("footer.php");
die;

}









closetable();
include("footer.php");





?>