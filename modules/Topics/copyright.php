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

$orig_author_name = "Francisco Burzi";
$orig_author_email = "";
$orig_author_homepage = "http://phpnuke.org";
$curr_author_name = "Gaylen Fraley (aka Raven)";
$curr_author_email = "raven@ravenphpscripts.com";
$curr_author_homepage = "http://www.ravenphpscripts.com";
$license = "GNU/GPL";
$download_location = "http://www.ravenphpscripts.com";
$module_version = "2.0";
$module_description = "All topics are shown in this module with some useful information. This topics module is an edited version of the PHP-Nuke 6.5 topics module. Edits were made by VJ Demsky and Gaylen Fraley (Raven).  It appears that VJ Demsky's support site is no longer available.  Ravenphpscripts will continue to support this in the RavenNuke&trade; distros.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $orig_author_name, $orig_author_email, $orig_author_homepage, $curr_author_name, $curr_author_email, $curr_author_homepage,$license, $download_location, $module_version, $module_description;
    if ($orig_author_name == "") { $orig_author_name = "N/A"; }
    if ($orig_author_email == "") { $orig_author_email = "N/A"; }
    if ($orig_author_homepage == "") { $orig_author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html>\n"
	."<body bgcolor=\"#F6F6EB\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">\n"
	."<title>$module_name: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#363636\" face=\"Verdana, Helvetica\">\n"
	."<center><b>Module Copyright &copy; Information</b><br />"
	."$module_name module for <a href=\"http://www.ravenphpscripts.com\" target=\"new\">RavenNuke76&trade;</a><br /><br /></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Name:</b> $module_name<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Version:</b> $module_version<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Module's Description:</b> $module_description<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>License:</b> $license<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Original Author's Name:</b> $orig_author_name<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Original Author's Email:</b> $orig_author_email<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Original Author's HomePage</b> <a href=\"$orig_author_homepage\" target=\"_blank\">http://phpnuke.org</a><br /><br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Current Author's Name:</b> $curr_author_name<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Current Author's Email:</b> $curr_author_email<br />\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\" alt=\"\" />&nbsp;<b>Current Author's HomePage:</b> <a href=\"$curr_author_homepage\" target=\"_blank\">http://www.ravenphpscripts.com</a><br /><br />\n"
	."<center>[ <a href=\"$download_location\" target=\"_blank\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>