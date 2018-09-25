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


if (is_admin($admin)) {
Header("Location: modules.php?name=$module_name&adminarea=adminup");

}



if ($allowmemberupload == "0" && !is_admin($admin)) {
	    echo "<b><center>Member upload has been turned off by the admin. Sorry.</b></center>";
        closetable();
        include_once("footer.php");
        die;
}



// Main Galleries system here that members are allowed to upload to.


echo "<center><strong><u> Rules and Agreement for uploads </u></strong></center>";
include_once("modules/$module_name/TOSFiles/uploadtos.html");
echo "<br><strong><center><u>If you use this form you agree to the above rules. Otherwise Leave NOW!</u></strong></center><br><hr>";
echo "<strong>The galleries you are allowed to upload to will show in the selected area's below.<br>
If the gallery you select says Locked you will be able to upload to it but not view it<br>
unless you are logged into that gallery. After you make a selection the screen will refresh<br>
and show the sub galleries IF ANY that you can select.<br><br>";


//Start member galleries show
    $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galtype='member' AND parentid='0' AND creator='$cookie[1]' ORDER BY name DESC"));
    $memgalid = $row['galid'];

    if ($memgalid == "") {
    echo "<a href='modules.php?name=$module_name&op=creategal'><u>[ You have no Galleries yet click here to make one now ]</u></a><br><br>";
    } else {
echo "<a name='alaslakl' onclick='deviltag2();'><u>[ Show Your Galleries ]</u></a><br><br>";


echo "<div id='deviltag2' class='deviltag2hidden'>";
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&op=upload2\">";
echo "Select Sub Gallery<br>";
echo "<select size=\"1\" name=\"subgallerymemselect\">";
echo "<option value=\"none\">Do Not Use Sub Gallery Use Root</option>";
$sql = "SELECT * FROM " . $prefix . "_reflections_gallery WHERE parentid='$memgalid' AND galtype='member' AND creator='$cookie[1]' ORDER BY name DESC";
$result = mysql_query($sql) or die('get error');
$num = mysql_numrows($result);
$i = 0;
while ($i < $num) {
$something = "";
    $mainsubgalid = mysql_result($result, $i, "galid");
    $mainsubgalname = mysql_result($result, $i, "name");
    $mainsubpassword = mysql_result($result, $i, "password");
if ($mainsubpassword != "") {
	$something = " - Locked";
}
            echo "<option value=\"$mainsubgalid\">$mainsubgalname $something</option>";
    $i++;
}
echo "</select>";

if ($allowmembermulti == "1") {
echo "<br>How many upload boxes? :: <input type=\"text\" name=\"uploadboxes\" value=\"1\" size=\"10\"> <i>Max is set at $membermultilimit</i><br>";

}


echo "<input type=\"hidden\" name=\"damemid\" value=\"$memgalid\" size=\"10\">";
echo "<br><input type='submit' value='Continue' name='uploadmember'>
</form>";

echo "</div>";

}
//end member galleries show




echo "<a name='alaslakl' onclick='deviltag1();'><u>[ Show Main Galleries ]</u></a><br><br>";
if ($showmainsub != "yes") {
$mainselected = "selected";
}
if ($mainvis == "yes") {
echo "<div id='deviltag1' class='deviltag1visible'>";
} else {
echo "<div id='deviltag1' class='deviltag1hidden'>";
}
echo "<form method=\"POST\" action=\"modules.php?name=$module_name&op=upload2\">";
echo "Select Main Gallery<br>";
echo "<select size=\"1\" name=\"maingalidselect\">";
$result7 = $db->sql_query("SELECT * from " . $prefix . "_reflections_gallery WHERE galtype='main' AND active='1' AND memberupload='1' AND password='' ORDER BY galid,name");
echo "<option $mainselected value=\"\">---- Select ----</option>";
while ($row7 = $db->sql_fetchrow($result7)) {
    $dagalid = intval($row7['galid']);
    $daname = $row7['name'];
    $daparentid = intval($row7['parentid']);
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

if ($allowmembermulti == "1") {
echo "<br><br>How many upload boxes?<br><input type=\"text\" name=\"uploadboxes\" value=\"1\" size=\"10\"> <i>Max is set at $membermultilimit</i><br>";
}
echo "<br><input type='submit' value='Continue' name='uploadmain'>";
echo "</form><br><Br>";
echo "</div>";

// End main galleries


closetable();
include("footer.php");





?>