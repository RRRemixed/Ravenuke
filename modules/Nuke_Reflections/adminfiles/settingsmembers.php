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
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&adminarea=settingsmemberssave\">";
echo "<Br><br><center><strong>Member Settings Page</centeR></strong><br><bR>";

if ($somethinggood != "") {
	echo "<center><strong><hr>New settings have been saved ok.<hr></center></strong><br><br>";
}


echo "<table border=\"0\" width=\"100%\"";
echo "<tr>";

echo "<td colspan=\"3\" align=\"center\"><strong>General Member Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Allow Members to Upload into the System at all<br>
If on they can upload into there galleries<br>
and Member allowed uploaded galleries.
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";
$applecheckit0 = "";
$applecheckit1 = "";
if ($allowmemberupload == "0") {
	$applecheckit0 = "checked";
} else if ($allowmemberupload == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"allowmemup\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"allowmemup\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Can members have there own galleries.<br>
This does not erase already created<br>
galleries. You have to do that.
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($allowmembergalleries == "0") {
	$applecheckit0 = "checked";
} else if ($allowmembergalleries == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"allowmemgal\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"allowmemgal\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Allow members to use Multi Upload<br>
box's when they upload?
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($allowmembermulti == "0") {
	$applecheckit0 = "checked";
} else if ($allowmembermulti == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"allowmemmulti\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"allowmemmulti\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Members Max upload box's they can use<br>
On Multi Upload system</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"multiuploadmax\" value=\"$membermultilimit\" size=\"10\">
</strong></td>";
echo "</tr><tr>";




echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Restrict how much space the members<br>
are allowed to use. This only affects there<br>
own galleries and not when uploading into<br>
main galleries
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($memberlimit == "0") {
	$applecheckit0 = "checked";
} else if ($memberlimit == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"memlimitonoff\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"memlimitonoff\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Max size in bytes members are allowed<br>
to use when the setting is turned on</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"memmax\" value=\"$membermaxsize\" size=\"10\">
</strong></td>";
echo "</tr><tr>";




echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Uploads by members require Admin Approval before<br>
they can be displayed?
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($requireapproval == "0") {
	$applecheckit0 = "checked";
} else if ($requireapproval == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"requireapprov\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"requireapprov\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Allow members to delete comments<br>
on the images they uploaded?
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($allowmemberdelcomment == "0" || $allowmemberdelcomment == "") {
	$applecheckit0 = "checked";
} else if ($allowmemberdelcomment == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"allowdelcom\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"allowdelcom\" value=\"1\" $applecheckit1><br>";

echo "</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Allow Members to see and copy <br>bbcode/html links on the big page?
</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
";
$applecheckit0 = "";
$applecheckit1 = "";
if ($showbbcodesystem == "0" || $showbbcodesystem == "") {
	$applecheckit0 = "checked";
} else if ($showbbcodesystem == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"allowbbcodes\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"allowbbcodes\" value=\"1\" $applecheckit1><br>";

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