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

// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
// NOTE: in $download_location PLEASE give the direct download link to the file!!!



$author_name = "Clan Themes";
$author_email = "admin@clanthemes.com";
$author_homepage = "http://www.clanthemes.com";
$download_location = "http://clanthemes.com/shop.html";
$module_version = "v1";
$module_description = "A complete flash shout block and module with admin security.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description, $stylesheet;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html><head></head>"
	."<body bgcolor=\"#a9b6bc\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">"
	."<title>$module_name: Copyright Information</title>"
	."<font size=\"1\" color=\"#000000\" face=\"Arial, Verdana, Helvetica\">"
	."<center><b>Module Copyright &copy; Information</b><br />"
	."$module_name module for <a href=\"http://phpnuke.org\" target=\"new\" onClick = \"window.close()\">PHP-Nuke</a><br /><br /></center>"
	."<img src=\"images/arrow.gif\" border=\"0\" />&nbsp;<b>Name:</b>$module_name<br />"
	."<img src=\"images/arrow.gif\" border=\"0\" />&nbsp;<b>Version:</b> $module_version<br />"
	."<img src=\"images/arrow.gif\" border=\"0\" />&nbsp;<b>Description:</b> $module_description<br />"
	."<img src=\"images/arrow.gif\" border=\"0\" />&nbsp;<b>Author's Name:</b> $author_name<br />"
	."<img src=\"images/arrow.gif\" border=\"0\" />&nbsp;<b>Author's Email:</b> $author_email<br /><br /><br />"
	."<center>[ <a href=\"$author_homepage\" target=\"new\" onClick = \"window.close()\">Author's HomePage</a> ] - [ <a href=\"$download_location\" target=\"new\" onClick = \"window.close()\">Module's Download</a> ] - [ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>"
	."</font>"
	."</body>"
	."</html>";
}

show_copyright();

?>