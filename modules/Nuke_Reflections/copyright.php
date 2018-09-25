<?php
// *************************************************
// This file is Part of Nuke_Reflections V1 Module by
// White_Devil of http://devil-modz.us
// E-Mail arleighesq@gmail.com

// Please do not remove any copyright notices
// Or modify beyond the main parts of this script

// Everything is pretty much Explained.
// *************************************************


$module_name = basename(dirname(__FILE__));
$mod_name = "Devil Modz - Nuke Reflections V2&trade;";
$author_email = "arleighesq@gmail.com";
$author_homepage = "http://www.devil-modz.us/";
$author_name = "<a href=\"$author_homepage\" target=\"new\">Devil Modz for Nuke</a>";
$license = "Copyright &copy; 2006-2006 Devil Modz for Nuke&trade;";
$download_location = "http://devil-modz.us/";
$module_version = "2.0";
$release_date = "10-28-07";
$module_description = "A Nuke Native Gallery Module.";
$mod_cost = "Free";
if ($mod_name == "") { $mod_name = eregi_replace("_", " ", $module_name); }

echo "<html>\n";
echo "<head>\n";
echo "<title>$mod_name: Copyright Information</title>\n";
echo "<style type=\"text/css\">\n";
echo "<!--\n";
echo "body{\n";
echo "FONT-FAMILY:Verdana,Helvetica; FONT-SIZE:11px;\n";
echo "SCROLLBAR-3DLIGHT-COLOR:#000000;\n";
echo "SCROLLBAR-ARROW-COLOR:#e7e7e7;\n";
echo "SCROLLBAR-FACE-COLOR:#414141;\n";
echo "SCROLLBAR-DARKSHADOW-COLOR:#000000;\n";
echo "SCROLLBAR-HIGHLIGHT-COLOR:#9d9d9d;\n";
echo "SCROLLBAR-SHADOW-COLOR:#9d9d9d;\n";
echo "SCROLLBAR-TRACK-COLOR:#e7e7e7;\n";
echo "}\n";
echo "-->\n";
echo "</style>\n";
echo "</head>\n";
echo "<body bgcolor=\"#FFFFFF\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">\n";
echo "<center><b>Module Copyright &copy; Information</b><br>";
echo "$mod_name module</center>\n<hr>\n";
echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Name:</b> $mod_name<br>\n";
if ($module_version != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Version:</b> $module_version<br>\n"; }
if ($release_date != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Release Date:</b> $release_date<br>\n"; }
if ($mod_cost != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Cost:</b> $mod_cost<br>\n"; }
if ($license != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>License:</b> $license<br>\n"; }
if ($author_name != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Author's Name:</b> $author_name<br>\n"; }
if ($author_email != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Author's Email:</b> <a href=\"mailto:$author_email\">$author_email</a><br>\n"; }
if ($module_description != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Description:</b> $module_description<br>\n"; }
if ($download_location != "") { echo "<img src=\"images/arrow.gif\" border=\"0\">&nbsp;<b>Module's Download:</b> <a href=\"$download_location\" target=\"new\">Download</a><br>\n"; }
echo "<hr>\n";
echo "<center>[<a href=\"#\" onClick=javascript:self.close()>Close Window</a>]</center>\n";
echo "</body>\n";
echo "</html>";

?>