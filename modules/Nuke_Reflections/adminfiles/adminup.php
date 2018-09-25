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

// Main Galleries system here that members are allowed to upload to.
echo "<br><center><strong>Admin Upload System</center><br>";






echo "<a name='alaslakl' onclick='deviltag1();'><u>[ Show Main Galleries ]</u></a><br><br>";
if ($showmainsub != "yes") {
$mainselected = "selected";
}
if ($mainvis == "yes") {
echo "<div id='deviltag1' class='deviltag1visible'>";
} else {
echo "<div id='deviltag1' class='deviltag1visible'>";
}
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&adminarea=adminup2\">";
echo "Select Main Gallery<br>";
echo "<select size=\"1\" name=\"maingalidselect\">";
$result7 = $db->sql_query("SELECT * from " . $prefix . "_reflections_gallery WHERE galtype='main' ORDER BY galid,name");
echo "<option $mainselected value=\"\">---- Select ----</option>";
while ($row7 = $db->sql_fetchrow($result7)) {
    $dagalid = intval($row7['galid']);
    $daname = $row7['name'];
    $daparentid = intval($row7['parentid']);
    $mainpassword = "";
    $mainpassword = intval($row7['password']);
    if ($daparentid != 0) $daname = getparent1($daparentid, $daname);
    $maingalid = $dagalid;
    $maingalname = $daname;
    if ($mainpassword != "") {
	$something = " - Locked";
}

if ($maingalid == $maingalidselect) {
            echo "<option selected value=\"$maingalid\">$maingalname $something</option>";
} else {
            echo "<option value=\"$maingalid\">$maingalname $something</option>";
}


}



echo "</select>";

echo "<br><br>How many upload boxes?<br><input type=\"text\" name=\"uploadboxes\" value=\"1\" size=\"10\"><br>";
echo "<br><input type='submit' value='Continue' name='uploadmain'>";
echo "</form><br><Br>";
echo "</div>";

// End main galleries


echo "<br>";



//Show Member Galleries
echo "<a name='alaslakl' onclick='deviltag2();'><u>[ Show User Galleries ]</u></a><br><br>";
if ($showmainsub != "yes") {
$mainselected = "selected";
}
if ($uservis == "yes") {
echo "<div id='deviltag2' class='deviltag2visible'>";
} else {
echo "<div id='deviltag2' class='deviltag2visible'>";
}
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&adminarea=adminup2\">";
echo "Select Member Gallery<br>";
echo "<select size=\"1\" name=\"memgalidselect\">";
$result7 = $db->sql_query("SELECT * from " . $prefix . "_reflections_gallery WHERE galtype='member' ORDER BY creator,rawtime ASC");
echo "<option $mainselected value=\"\">---- Select ----</option>";
while ($row7 = $db->sql_fetchrow($result7)) {
    $dagalid = intval($row7['galid']);
    $daname = $row7['name'];
    $daparentid = intval($row7['parentid']);
    $mainpassword = "";
    $mainpassword = intval($row7['password']);
    $maincreator = $row7['creator'];
    if ($daparentid != 0) $daname = getparent1($daparentid, $daname);
    $maingalid = $dagalid;
    $maingalname = $daname;

    if ($mainpassword != "") {
	$something = " - Locked";
}

if ($maingalid == $maingalidselect) {
            echo "<option selected value=\"$maingalid\">$maingalname $something</option>";
} else {
            echo "<option value=\"$maingalid\">$maincreator - $maingalname $something</option>";
}


}
echo "</select>";
echo "<br>How many upload boxes? :: <input type=\"text\" name=\"uploadboxes\" value=\"1\" size=\"10\"><br>";
echo "<br><input type='submit' value='Continue' name='uploadmember'>
</form>";
echo "</div>";


closetable();
include("footer.php");






?>