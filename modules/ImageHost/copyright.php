<?php
/******************************************************************/
/* Description: Allows site members to upload  					*/
/* and host images on your website.            					*/
/*																*/
/*This program comes with ABSOLUTELY NO WARRANTY. 				*/
/*This is free software, and you are welcome to 				*/
/*redistribute it under certain conditions; 					*/
/*please refer to the GNU General Public License for details.	*/
/****************************************************************/

$author_name = "Jhon Doe";
$author_email = "";
$author_homepage = "http://jhondoe.no-ip.org";
$license = "MACONDO <a href=\"http://www.gnu.org/licenses/lgpl.txt\" target=_new>GNU/GPL</a>";
$module_version = "2.5";
$download_location= "http://jhondoe.no-ip.org";

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $module_version,$download_location;
    if ($author_name == "") { $author_name = "N/A"; }
    if ($author_email == "") { $author_email = "N/A"; }
    if ($author_homepage == "") { $author_homepage = "N/A"; }
    if ($license == "") { $license = "N/A"; }
    if ($module_version == "") { $module_version = "N/A"; }
     if ($download_location == "") { $download_location = "N/A"; }
    if ($module_description == "") { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo "<html>\n"
	."<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n"
	."<title>$module_name: Copyright Information</title>\n"
	."<font size=\"2\" color=\"#000000\" face=\"Verdana, Helvetica\">\n"
	."<center><b>Module Copyright &copy; Information</b><br>"
	."$module_name module for <a href=\"http://www.phpnuke.org\" target=\"_blank\">PHP-Nuke</a><br><br></center>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Name:</b> $module_name<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Version:</b> $module_version<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>License:</b> $license<br>\n"
	."<img src=\"../../images/arrow.gif\" border=\"0\">&nbsp;<b>Author's :</b> $author_name<br>\n"
	."<center>[ <a href=\"$download_location\" target=\"_blank\">Download Location</a> |<a href=\"$author_homepage\" target=\"_blank\">Author's HomePage</a> | <a href=\"javascript:void(0)\" onClick=self.close()>Close</a> ]</center>\n"
	."</font>\n"
	."</body>\n"
	."</html>";
}

show_copyright();

?>