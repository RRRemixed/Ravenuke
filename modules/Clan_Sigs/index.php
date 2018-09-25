<?php 
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/* Clan Sigs Module for PHP-Nuke                                        */
/* Version 1.0 18-01-07                                                 */
/* By: Ped (ped@phpnuke-downloads.com)                                      */
/* http://www.phpnuke-downloads.com                                         */
/************************************************************************/
 
if (!stristr($_SERVER['SCRIPT_NAME'], "modules.php")) {
    die ("You can't access this file directly...");
}
	
require_once("mainfile.php");

$module_name = basename(dirname(__FILE__));


$pagetitle = "- Clan Sig's";
$index = 0;
include("header.php");

	
global $user, $module_name;
if(!is_array($user)) {
$user_get = base64_decode($user);
$user_get = explode(":", $user_get);
$user_name = "$user_get[1]";
} else {
$user_name = $user[1];
}

$host = $_SERVER['HTTP_HOST'];
$name = $_SERVER['SCRIPT_NAME'];
$name = ereg_replace("/modules.php", "", $name);



$url = "$host$name";

OpenTable();
echo "<center><img src=\"modules/$module_name/logo.gif\"><br><br>Cut and paste the code below the respective image and use it as your dynamic forum signature</center>";
CloseTable();

OpenTable();
echo "<table width=\"100%\" border=\"0\" align=\"center\"><tr><td align=\"center\">
<b>Signature One</b><br><br>
<img src=\"modules/$module_name/image.png\"><BR><BR>
<table border=\"0\" cellpadding=\"0\">
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>Forum Code</B></legend>[URL=http://$url][IMG]http://$url/modules/$module_name/image.png[/IMG][/URL]</fieldset></td>
</tr>
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>HTML Code</B></legend>&lt;a href=\"http://$url\"&gt;&lt;img src=\"http://$url/modules/$module_name/image.png\" border=\"0\"&gt;&lt;/a&gt;</fieldset></td>
</tr>
</table><BR><BR><BR>
<b>Signature Two</b><br><br>
<img src=\"modules/$module_name/image1.png\"><BR><BR>
<table border=\"0\" cellpadding=\"0\">
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>Forum Code</B></legend>[URL=http://$url][IMG]http://$url/modules/$module_name/image1.png[/IMG][/URL]</fieldset></td>
</tr>
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>HTML Code</B></legend>&lt;a href=\"http://$url\"&gt;&lt;img src=\"http://$url/modules/$module_name/image1.png\" border=\"0\"&gt;&lt;/a&gt;</fieldset></td>
</tr>
</table><BR><BR><BR>
<b>Signature Three</b><br><br>
<img src=\"modules/$module_name/image2.png\"><BR><BR>
<table border=\"0\" cellpadding=\"0\">

<tr>
<td><fieldset style=\"padding: 5\"><legend><B>Forum Code</B></legend>[URL=http://$url][IMG]http://$url/modules/$module_name/image2.png[/IMG][/URL]</fieldset></td>
</tr>
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>HTML Code</B></legend>&lt;a href=\"http://$url\"&gt;&lt;img src=\"http://$url/modules/$module_name/image2.png\" border=\"0\"&gt;&lt;/a&gt;</fieldset></td>
</tr>

</table><BR><BR><BR>
<b>Signature Four</b><br><br>
<img src=\"modules/$module_name/image3.png\"><BR><BR>
<table border=\"0\" cellpadding=\"0\">
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>Forum Code</B></legend>[URL=http://$url][IMG]http://$url/modules/$module_name/image3.png[/IMG][/URL]</fieldset></td>
</tr>
<tr>
<td><fieldset style=\"padding: 5\"><legend><B>HTML Code</B></legend>&lt;a href=\"http://$url\"&gt;&lt;img src=\"http://$url/modules/$module_name/image3.png\" border=\"0\"&gt;&lt;/a&gt;</fieldset></td>
</tr>
</table>";
echo "</td></tr></table>";
CloseTable();
    echo " <script type=\"text/javascript\">";
    echo " <!--";
    echo " function openwindow(){";
    echo " 	window.open (\"modules/$module_name/copyright.php\",\"Block_Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\");";
    echo " }";
    echo " //-->";
    echo " </SCRIPT>";
    echo " <div align=\"right\"><a href=\"javascript:openwindow()\">Clan Sigs &copy;</a></div>";
	
include("footer.php");


?>
