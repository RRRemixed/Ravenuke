<?php
/************************************************************************/
/* Pc-Nuke! Systems -  Advanced Content Management System               */
/* ============================================                         */
/*    Php based web portal systems & more...                            */
/*    Put together by PcNuke.com                                        */
/*    http://www.pcnuke.com          www.max.pcnuke.com                 */
/*                                                                      */ 
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

if (stristr($_SERVER['PHP_SELF'], "block-GCAdmin.php") || stristr($_SERVER['SCRIPT_NAME'], "block-GCAdmin.php")) { Header("Location: index.php"); }

if (eregi("block-Administration.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}

global $admin, $redirect, $mode, $f, $t, $sitekey, $nukeurl, $user, $cookie, $prefix, $user_prefix, $db, $anonymous, $gfx_chk;


    mt_srand ((double)microtime()*1000000);
    $maxran = 1000000;
    $random_num = mt_rand(0, $maxran);
    
if (is_admin($admin)) {

/*THIS IS WHERE THE CHECK SCRIPTS GO*/
//Waiting Downloads
$newdownloads = "0";
$newdownloads = $db->sql_numrows($db->sql_query("select * from ".$user_prefix."_downloads_newdownloads"));
$totalnewdownloads = number_format($newdownloads, 0);
//Mod Downloads
$moddownloads = "0";
$moddownloads = $db->sql_numrows($db->sql_query("select * from ".$user_prefix."_downloads_modrequest"));
$totalmoddownloads = number_format($moddownloads, 0);

//Waiting Links
$newlinks = "0";
$newlinks = $db->sql_numrows($db->sql_query("select * from ".$user_prefix."_links_newlink"));
$totalnewlinks = number_format($newlinks, 0);
//Mod Links
$modlinks = "0";
$modlinks = $db->sql_numrows($db->sql_query("select * from ".$user_prefix."_links_modrequest"));
$totalmodlinks = number_format($modlinks, 0);


/*END OF CHECKS*/

/*What the admin sees*/
$content  =  "<center>";
$content  .= "<a href=\"admin.php\"><b>Administration Panel</b></a><br>";
$content  .= "<a href=\"admin.php?op=BlocksAdmin\">Blocks</a>&nbsp;";
$content  .= "<a href=\"admin.php?op=modules\"> Modules</a><br>";
$content  .= "<a href=\"admin.php?op=optimize\">Optimize DB</a><br>";
$content  .= "<a href=\"admin.php?op=adminStory\">Post New Story</a><br>";
$content  .= "<a href=\"admin.php?op=create\">Create New Survey</a><br>";
$content  .= "<a href=\"index.php\">Homepage</a>&nbsp;";
$content  .= "<a href=\"admin.php?op=logout\"><font color=\"#800000\"> Logout</font></a>";
$content  .= "</center>";


} else {

//Admin Login
$content  =  "<center>";
$content  .= "<form action=\"admin.php\" method=\"post\">";
$content  .= "<table border=\"0\">";
$content  .= "<td><input type=\"text\" NAME=\"aid\" VALUE=\"Admin ID\" SIZE=\"20\" MAXLENGTH=\"25\"></td></tr>";
$content  .= "<td><input type=\"password\" NAME=\"pwd\" VALUE=\"Admin PW\" SIZE=\"20\" MAXLENGTH=\"18\"></td></tr>";
    if (extension_loaded("gd") AND ($gfx_chk == 1 OR $gfx_chk == 5 OR $gfx_chk == 6 OR $gfx_chk == 7)) {
$content .=""._SI_CODE.": <img src='index.php?gfx=gfx&random_num=$random_num' border='1' height='20' width='77' alt='"._SI_CODE."' title='"._SI_CODE."'><br>\n";
$content .=""._SI_TYPE.": <input type=\"text\" NAME=\"gfx_check\" SIZE=\"10\" MAXLENGTH=\"10\"><br>\n";
    }
$content  .= "<tr><td>";
$content  .= "<input type=\"hidden\" NAME=\"random_num\" value=\"$random_num\">";
$content  .= "<input type=\"hidden\" NAME=\"op\" value=\"login\">";
$content  .= "<center><input type=\"submit\" VALUE=\""._LOGIN."\"></center>";
$content  .= "</td></tr></table>";
$content  .= "</form>";
$content  .= "</center>";
}

?>
