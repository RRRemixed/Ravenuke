<?php
/********************************************************/
/* Server Rules Module for PHP-Nuke                     */
/* Version 1.0 12-13-06                                 */
/* By: Floppy (floppydrivez@hotmail.com)                */
/* http://www.clan-themes.co.uk                         */
/* Copyright © 2006 by T3 Gaming Community              */
/********************************************************/

$author_name = "Floppy";
$author_user_email = "floppydrivez@hotmail.com";
$author_homepage = "http://www.t3gamingcommunity.com";
$license = "GNU/GPL";
$download_location = "http://www.clan-themes.co.uk/downloads.html";
$module_version = "1.0";
$module_description = "Server Rules Module";


function show_copyright() {
    global $author_name, $author_user_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_user_email == "") { $author_user_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($download_location == "") { $download_location = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html>\n"
        ."<body bgcolor=\"#dedede\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n"
        ."<title>$module_name: Copyright Information</title>\n"
        ."<font size=\"1\" color=\"#000000\" face=\"Verdana, Helvetica\">\n"
        ."<center><b>Module Copyright &copy; Information</b><br>"
        ."<br><br></center>\n"
        ."<b>Module's Name:</b> $module_name<br>\n"
        ."<b>Module's Version:</b> $module_version<br>\n"
        ."<b>Module's Description:</b> $module_description<br>\n"
        ."<b>License:</b> $license<br>\n"
        ."<b>Author's Name:</b> $author_name<br>\n"
        ."<b>Author's Email:</b> $author_user_email<br><br>\n"
        ."<center>[ <a href=\"$author_homepage\" target=\"new\">Author's HomePage</a> | <a href=\"$download_location\" target=\"new\">Module's Download</a> | <a href=\"javascript:void(0)\" onClick=javascript:self.close()>Close</a> ]</center>\n"
        ."</font>\n"
        ."</body>\n"
        ."</html>";
}

show_copyright();

?>