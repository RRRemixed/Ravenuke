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
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&adminarea=settingsmainsave\">";
echo "<Br><br><center><strong>Main Settings Page</centeR></strong><br><bR>";

if ($somethinggood != "") {
	echo "<center><strong><hr>New settings have been saved ok.<hr></center></strong><br><br>";
}


echo "<table border=\"0\" width=\"100%\"";
echo "<tr>";

echo "<td colspan=\"3\" align=\"center\"><strong>Gallery Showing Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Max images shown per page on a gallery view </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"maximagesperpage\" value=\"$maxperpage\" size=\"10\">
</strong></td>";
echo "</tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Max size of thumbnails on gallery views page in pixels </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"maxviewsize\" value=\"$maxthumbsizegal\" size=\"10\">
</strong></td>";
echo "</tr><tr>";

echo "<td colspan=\"3\" align=\"center\"><strong><br>When Uploading Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Size to use when creating Thumbnails  </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"thumbmaxsizecreate\" value=\"$config_thumbsize\" size=\"10\">

</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Watermark Style to use</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";

if ($watermark == "0") {
	$applecheckit0 = "checked";
} else if ($watermark == "1") {
	$applecheckit1 = "checked";
} else if ($watermark == "2") {
	$applecheckit2 = "checked";
} else if ($watermark == "3") {
	$applecheckit3 = "checked";
}

echo "Off <input type=\"radio\" name=\"waterstyle\" value=\"0\" $applecheckit0>";
echo "Normal Text <input type=\"radio\" name=\"waterstyle\" value=\"1\" $applecheckit1><br>";
echo "Advanced Text <input type=\"radio\" name=\"waterstyle\" value=\"2\" $applecheckit2>";
echo "Image Watermark <input type=\"radio\" name=\"waterstyle\" value=\"3\" $applecheckit3>";

echo "</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Watermark Text line 1<br>If you use only one line use number 2 </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"watertext1\" value=\"$watermark_text1\" size=\"20\">
</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Watermark Text line 2<br>Use this if you want only 1 line </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"watertext2\" value=\"$watermark_text2\" size=\"20\">
</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Watermark Image Path <br> <img border=\"1\" src=\"$watermarkimage\"></strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"waterimage\" value=\"$watermarkimage\" size=\"50\">

</strong></td>";
echo "</tr><tr>";

echo "<td colspan=\"3\" align=\"center\"><strong><br>Timmer Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Login Kill Time.<br>If a user logs into a password<br>protected gallery it will kill<br>the loggin after this many<br>seconds of inactivity<br>900sec's = 15mins </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"loginkiller\" value=\"$loginkilltime\" size=\"10\">
</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Restrict Voting on same image within<br>X number of seconds<br>300sec's = 5Mins </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"votingtimekiller\" value=\"$voterestriction\" size=\"10\">
</strong></td>";
echo "</tr><tr>";

echo "<td colspan=\"3\" align=\"center\"><strong><br>Reporting Settings</strong></td></tr><tr>";
echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Unapprove file after X reports on it.<br>The x apply's to the next option. </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";

$applecheckit0 = "";
$applecheckit1 = "";
if ($killfilereportedonmax == "0") {
	$applecheckit0 = "checked";
} else if ($killfilereportedonmax == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"unapprovekill\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"unapprovekill\" value=\"1\" $applecheckit1><br>";



echo "</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>How many reports to unapprove file </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"killonxreports\" value=\"$filereportmax\" size=\"10\">
</strong></td>";
echo "</tr><tr>";



echo "<td colspan=\"3\" align=\"center\"><strong><br>Sexy or Not Transfer System</strong></td></tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Allow Members to transfer their<br>own images to Sexy or Not?</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";

$applecheckit0 = "";
$applecheckit1 = "";
if ($SoNTransferallow == "0") {
	$applecheckit0 = "checked";
} else if ($SoNTransferallow == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"SoNTransferallowset\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"SoNTransferallowset\" value=\"1\" $applecheckit1><br>";




echo "</strong></td>";
echo "</tr><tr>";

echo "<td colspan=\"3\" align=\"center\"><strong><br>Tooltip Settings</strong></td></tr><tr>";

echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Show Larger image in a tooltip window on <br> mouse overs on some area's </strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>";

$applecheckit0 = "";
$applecheckit1 = "";
if ($tooltippic == "0") {
	$applecheckit0 = "checked";
} else if ($tooltippic == "1") {
	$applecheckit1 = "checked";
}
echo "Off <input type=\"radio\" name=\"tooltippicset\" value=\"0\" $applecheckit0>";
echo "On <input type=\"radio\" name=\"tooltippicset\" value=\"1\" $applecheckit1><br>";




echo "</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>
Tooltip Back Color <br>
You need to use a #00FF00 format<br>
or Just the color \"green\"</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"tooltipbackcolor\" value=\"$tooltipback\" size=\"10\">

</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Tooltip Font Color  <br>
You need to use a #00FF00 format<br>
or Just the color \"green\"</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"tooltiptextcolor\" value=\"$tooltiptext\" size=\"10\">

</strong></td>";
echo "</tr><tr>";


echo "<td width=\"50%\" align=\"right\" valign=\"top\"><strong>Tooltip Border Color  <br>
You need to use a #00FF00 format<br>
or Just the color \"green\"</strong></td>";
echo "<td  align=\"center\" valign=\"top\">::</td>";
echo "<td width=\"50%\" valign=\"top\"> <strong>
<input type=\"text\" name=\"tooltipborder\" value=\"$tooltipbordercolor\" size=\"10\">

</strong></td>";
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