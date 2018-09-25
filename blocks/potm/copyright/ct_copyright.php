<?php
/************************************************************************/
/*                     www.Clan-Themes.co.uk                            */
/*                  ===========================                         */
/*                    Making Clans Look Good!                           */
/************************************************************************/
/*                   Clan Wallpaper Block V1.0                          */
/*                 Copyright (c) 2007 by Scorpion                       */
/*            Downloaded from http://www.Clan-Themes.co.uk.             */
/*                                                                      */
/*         The Power of the Nuke! - Without the Radiation!              */
/*        =================================================             */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

/************************************************************************/
/*         Always Backup your file system and database before           */
/*      doing any type of installation or changes such as these.        */
/*      Failure to do so may end up costing you much repair time        */
/************************************************************************/

// To have the Copyright window work in your block just fill the following
// required information and then copy the file "ct_copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
// NOTE: in $download_location PLEASE give the direct link to your downloads!!!

$author_name = "Clan Themes";
$author_email = "admin@clan-themes.co.uk";
$author_homepage = "http://www.clan-themes.co.uk";
$license = "Clan Themes";
$download_location = "http://www.clan-themes.co.uk";
$block_name = "Player Of The Month";
$block_version = "1.0";
$block_description = "Broadcast to the world the latest news. This Block is an addon for 'Player Of The Month' Module.";

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// BLOCK'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR BLOCK/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS BLOCK'S AUTHOR.

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $block_name, $block_version, $block_description, $stylesheet;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($block_name == "") { $block_name = "N/A"; }
    if ($block_version == "") { $block_version = "N/A"; }
    if ($block_description == "") { $block_description = "N/A"; }
    echo "<html><head></head>"
	."<body bgcolor=\"#a9b6bc\" link=\"#363636\" alink=\"#363636\" vlink=\"#363636\">"
	."<img src=\"clanthemes.gif\" border=\"0\">"
	."<title>$block_name: Copyright Information</title>"
	."<font size=\"2\" color=\"#000000\" face=\"Arial, Verdana, Helvetica\">"
	."<center><b>Block Copyright &copy; Information</b><br>"
	."$block_name for <a href=\"http://phpnuke.org\" target=\"new\" onClick = \"window.close()\">PHP-Nuke</a><br><br></center>"
	."<img src=\"arrow.gif\" border=\"0\">&nbsp;<b>Block's Name:</b> $block_name<br>"
	."<img src=\"arrow.gif\" border=\"0\">&nbsp;<b>Block's Version:</b> $block_version<br>"
	."<div align=\"justify\"><img src=\"arrow.gif\" border=\"0\">&nbsp;<b>Block's Description:</b> $block_description</div><br>"
	."<img src=\"arrow.gif\" border=\"0\">&nbsp;<b>License:</b> $license<br>"
	."<img src=\"arrow.gif\" border=\"0\">&nbsp;<b>Author's Name:</b> $author_name<br>"
	."<img src=\"arrow.gif\" border=\"0\">&nbsp;<b>Author's Email:</b> <a href=\"mailto:$author_email\">$author_email</a><br><br><br>"
	."<center>[ <a href=\"$author_homepage\" target=\"new\" onClick = \"window.close()\">Author's HomePage</a> ] - [ <a href=\"$download_location\" target=\"new\" onClick = \"window.close()\">Block's Download</a> ] - [ <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center><br>"
	."<center><b>* Special thanks to Floppy & Ped *</b></center>"
	."</font>"
	."</body>"
	."</html>";
}
show_copyright();

?>