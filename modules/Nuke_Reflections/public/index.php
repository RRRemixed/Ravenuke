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



echo "<center>";



echo "<table border='0' width='100%'><tr>";
echo "<td width='50%' align='center' valign='bottom'>";
echo "<strong><u>Random Image</u></strong>";
echo "</td>";
echo "<td width='50%' align='center' valign='bottom'>";
echo "<strong><u>Newest Image</u></strong>";
echo "</td>";
echo "</tr><tr>";
echo "<td align='center' valign='bottom'>";
//random image
$ajinfo = getrandfiveimages(300,"thumbs");
if ($ajinfo[0] == "NONYET") {
	echo "<br><center><strong>No Images in this spot yet!!</strong></center><br>";
} else {
echo "<strong>$ajinfo[0]</strong>";
}
echo "</td>";
echo "<td align='center' valign='bottom'>";
//newest image
$ajinfo = newest5ups(300,"thumbs");
if ($ajinfo[0] == "NONYET") {
	echo "<br><center><strong>No Images in this spot yet!!</strong></center><br>";
} else {
echo "<strong>$ajinfo[0]</strong>";
}
echo "</td>";
echo "</tr></table>";






$ajinfo = getlastfivemain();

// Newest 5 main galleries start
echo "<table border='0' width='100%'>";
echo "<tr>";
echo "<td align='center' colspan='9'><hr>";
echo "<strong>Newest Five Main Galleries || <a href='modules.php?name=$module_name&op=viewall&galllookup=main'><u>View All Main Galleries</u></a></strong><hr>";
echo "</td>";
echo "</tr><tr>";
if ($ajinfo[0] == "NONYET") {
	echo "<td><br><center><strong>No Main Galleries Yet!!</strong></center><br></td></tr></table>";
} else {
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[0]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[1]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[2]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[3]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[4]";
echo "</td>";
echo "</tr>";
echo "</table>";
}
// Newest 5 main galleries end

$ajinfo = getlastfivemem();
// Newest 5 member galleries start
echo "<table border='0' width='100%'>";
echo "<tr>";
echo "<td align='center' colspan='9'><hr>";
echo "<strong>Newest Five Member Galleries || <a href='modules.php?name=$module_name&op=viewall&galllookup=member'><u>View All Member Galleries</u></a></strong><hr>";
echo "</td>";
echo "</tr><tr>";
if ($ajinfo[0] == "NONYET") {
	echo "<td><br><center><strong>No User Galleries Yet!!</strong></center><br></td></tr></table>";
} else {
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[0]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[1]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[2]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[3]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[4]";
echo "</td>";
echo "</tr>";
echo "</table>";
}
// Newest 5 member galleries galleries end


$ajinfo = newest5ups('0','thumbs');
// Newest 5 uploads galleries start
echo "<table border='0' width='100%'>";
echo "<tr>";
echo "<td align='center' colspan='9'><hr>";
echo "<strong>Newest Five Uploads</strong><hr>";
echo "</td>";
echo "</tr><tr>";
if ($ajinfo[0] == "NONYET") {
	echo "<td><br><center><strong>No Uploads Yet!!</strong></center><br></td></tr></table>";
} else {
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[0]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[1]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[2]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[3]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[4]";
echo "</td>";
echo "</tr>";
echo "</table>";
}
// Newest 5 uploads galleries galleries end




$ajinfo = getrandfiveimages('0','thumbs');
// Random 5 images start
echo "<table border='0' width='100%'>";
echo "<tr>";
echo "<td align='center' colspan='9'><hr>";
echo "<strong>Random Five Images</strong><hr>";
echo "</td>";
echo "</tr><tr>";
if ($ajinfo[0] == "NONYET") {
	echo "<td><br><center><strong>No Uploads Yet!!</strong></center><br></td></tr></table>";
} else {
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[0]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[1]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[2]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[3]";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "<img src='modules/$module_name/images/pixel.gif' width='5'>";
echo "</td>";
echo "<td align='center' valign='bottom'>";
echo "$ajinfo[4]";
echo "</td>";
echo "</tr>";
echo "</table>";
}
// Random 5 images end




echo "</center>";


closetable();

include("footer.php");












?>