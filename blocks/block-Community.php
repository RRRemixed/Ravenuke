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

if (eregi("block-Community.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $dbi;
get_lang("Community");

$content = "<br><center><img src=\"modules/Community/images/nukedworld.gif\" border=\"0\"><br>";
$content .= "<img src=\"modules/Community/images/world.gif\" width=\"88\" height=\"58\" border=\"0\" usemap=\"#map\">";
$content .= "<map name=\"map\">";
$content .= "<area shape=\"rect\" coords=\"1,3,22,56\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=1\" title=\""._AMERICAS."\">";
$content .= "<area shape=\"rect\" coords=\"25,3,52,18\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=2\" title=\""._EUROPE."\">";
$content .= "<area shape=\"poly\" coords=\"25,21,39,21,39,34,52,34,52,56,25,56\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=3\" title=\""._AFRICA."\">";
$content .= "<area shape=\"rect\" coords=\"42,21,52,31\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=4\" title=\""._MIDDLEEAST."\">";
$content .= "<area shape=\"rect\" coords=\"55,3,87,39\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=5\" title=\""._ASIA."\">";
$content .= "<area shape=\"rect\" coords=\"55,42,87,56\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=6\" title=\""._OCEANIA."\">";
$content .= "</map><br><br>";
$content .= "<form action=\"modules.php?name=Community\" method=\"post\" onChange=\"submit()\">";
$content .= "<select name=\"cid\">";
$content .= "<option value=\"1\">"._AMERICAS."</option>";
$content .= "<option value=\"2\">"._EUROPE."</option>";
$content .= "<option value=\"3\">"._AFRICA."</option>";
$content .= "<option value=\"4\">"._MIDDLEEAST."</option>";
$content .= "<option value=\"5\">"._ASIA."</option>";
$content .= "<option value=\"6\">"._OCEANIA."</option>";
$content .= "</select><input type=\"hidden\" name=\"op\" value=\"show\"></form>";
$content .= ""._QUICKLINKS."<br>";
$content .= "<form action=\"modules.php?name=Community\" method=\"get action\">";
$content .= "<select name=\"id\" size=\"5\" onChange=\"top.location.href=this.options[this.selectedIndex].value\">";
$result = sql_query("select id, name from ".$prefix."_community order by name", $dbi);
while (list($id, $name) = sql_fetch_row($result, $dbi)) {
    $content .= "<option value=\"modules.php?name=Community&op=go&id=$id\">$name</option>";
}
$content .= "<option>------------------------</option>";
$result = sql_query("select id, name from ".$prefix."_community_cool order by name", $dbi);
while (list($id, $name) = sql_fetch_row($result, $dbi)) {
    $content .= "<option value=\"modules.php?name=Community&op=goto&id=$id\">$name</option>";
}
$content .= "</select></form>";
$content .= "[ <a href=\"modules.php?name=Community\">"._COMMUNITYHOME."</a> ]</center><br>";

?>