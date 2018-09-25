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



if (is_admin($admin)) {

} else {

	echo "<b><center>You are not an Admin. LEAVE NOW!</b></center>";

closetable();

include_once("footer.php");

die;

}





echo "<center><b><a href='modules.php?name=$module_name&adminarea=adminmain'><u>Nuke Reflections Admin Area</u></a><br>";

echo "<br>";



echo "<table align='center' id='head' name='head' width='100%' border='1'>";

echo "<tr>";



echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Click here to goto admin upload page. </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=adminup'><u><strong>Upload System</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Bulk Adding system. Please read the info before you start! </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=adminbulkadd1'><u><strong>Bulk Add System</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Create a new gallery. Go in here to create a Main or Member gallery and sub galleries. </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=admincreategal'><u><strong>Create Galleries</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Show a list of galleries to view/edit </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=gallist'><u><strong>Gallery List</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Shows the Approval Page </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=approvalpage'><u><strong>Approval List</strong></u></a></td>";

echo "</tr><tr>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Shows the Reported Images Page </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=reportpage'><u><strong>Reports List</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Edit the Main Settings </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=settingsmain'><u><strong>Main Settings</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Edit the Member Settings </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=settingsmembers'><u><strong>Member Settings</strong></u></a></td>";

echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Edit the Security Settings </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=settingssecurity'><u><strong>Security Settings</strong></u></a></td>";

//echo "<td align=\"center\" onMouseover=\"ddrivetip('<b> Edit the Email Settings </b>','green', 300)\"; onMouseout=\"hideddrivetip()\"><a href='modules.php?name=$module_name&adminarea=settingsemail'><u><strong>Email Settings</strong></u></a></td>";














echo "</tr></table></center></b>";















?>