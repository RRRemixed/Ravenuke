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
	echo "<b><center>You are not an Admin. LEAVE NOW!</b></center>";
    closetable();
    include_once("footer.php");
    die;
}
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&adminarea=settingsemailsave\">";
echo "<Br><br><center><strong>Security Settings Page</centeR></strong><br><bR>";

if ($somethinggood != "") {
	echo "<center><strong><hr>New settings have been saved ok.<hr></center></strong><br><br>";
}


echo "<table border=\"0\" width=\"100%\"";
echo "<tr>";

echo "<td colspan=\"3\" align=\"center\"><strong>General Security Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Use security code on Comments
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";
$applecheckit0 = "";
$applecheckit1 = "";
if ($commentsecurity == "0") {
	$applecheckit0 = "checked";
} else if ($commentsecurity == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"comsecurity\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"comsecurity\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
User security Code when a member creates a gallery
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($membersecuritycreate == "0") {
	$applecheckit0 = "checked";
} else if ($membersecuritycreate == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"galsecurity\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"galsecurity\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
User Security Code on members upload page
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($membersecurityupload == "0") {
	$applecheckit0 = "checked";
} else if ($membersecurityupload == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"securityup\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"securityup\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";







echo "<td colspan=\"3\" align=\"center\"><bR><strong>Guest Security Settings</strong></td></tr><tr>";




echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Can a Guest Vote
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($guestvote == "0") {
	$applecheckit0 = "checked";
} else if ($guestvote == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"guestvot\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"guestvot\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Allow guest to comment on a file
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($allowguestcomment == "0") {
	$applecheckit0 = "checked";
} else if ($allowguestcomment == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"guestcom\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"guestcom\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";



echo "<td colspan=\"3\" align=\"center\"><strong><br>
<input type='submit' value='Save New Settings' name='savenew'>
<input type='reset' value='Reset' name='reset'>
</strong></td></tr><tr>";




echo "</tr>";
echo "</table>";

echo "</form>";


closetable();
include_once("footer.php");
die;
?>