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

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
$pagetitle = "- "._COMMUNITY."";

function worldmap() {
    global $module_name, $cid, $admin;
    $the_map = "<br><center><img src=\"modules/$module_name/images/nukedworld.gif\" border=\"0\"><br>";
    $the_map .= "<img src=\"modules/$module_name/images/world.gif\" width=\"88\" height=\"58\" border=\"0\" usemap=\"#map\">";
    $the_map .= "<map name=\"map\">";
    $the_map .= "<area shape=\"rect\" coords=\"1,3,22,56\" HREF=\"modules.php?name=$module_name&amp;op=show&amp;cid=1\" title=\"Americas\">";
    $the_map .= "<area shape=\"rect\" coords=\"25,3,52,18\" HREF=\"modules.php?name=Community&amp;op=show&amp;cid=2\" title=\"Europe\">";
    $the_map .= "<area shape=\"poly\" coords=\"25,21,39,21,39,34,52,34,52,56,25,56\" HREF=\"modules.php?name=$module_name&amp;op=show&amp;cid=3\" title=\"Africa\">";
    $the_map .= "<area shape=\"rect\" coords=\"42,21,52,31\" HREF=\"modules.php?name=$module_name&amp;op=show&amp;cid=4\" title=\"Middle East\">";
    $the_map .= "<area shape=\"rect\" coords=\"55,3,87,39\" HREF=\"modules.php?name=$module_name&amp;op=show&amp;cid=5\" title=\"Asia\">";
    $the_map .= "<area shape=\"rect\" coords=\"55,42,87,56\" HREF=\"modules.php?name=$module_name&amp;op=show&amp;cid=6\" title=\"Oceania\">";
    $the_map .= "</map><br><br>";
    $the_map .= "<form action=\"modules.php?name=$module_name\" method=\"post\">";
    $the_map .= "<select name=\"cid\" onChange=\"submit()\">";
    if ($cid == 1) { $sel1 = "selected"; }
    if ($cid == 2) { $sel2 = "selected"; }
    if ($cid == 3) { $sel3 = "selected"; }
    if ($cid == 4) { $sel4 = "selected"; }
    if ($cid == 5) { $sel5 = "selected"; }
    if ($cid == 6) { $sel6 = "selected"; }
    $the_map .= "<option value=\"1\" $sel1>"._AMERICAS."</option>";
    $the_map .= "<option value=\"2\" $sel2>"._EUROPE."</option>";
    $the_map .= "<option value=\"3\" $sel3>"._AFRICA."</option>";
    $the_map .= "<option value=\"4\" $sel4>"._MIDDLEEAST."</option>";
    $the_map .= "<option value=\"5\" $sel5>"._ASIA."</option>";
    $the_map .= "<option value=\"6\" $sel6>"._OCEANIA."</option>";
    $the_map .= "</select><input type=\"hidden\" name=\"op\" value=\"show\"></form>";
    if (is_admin($admin)) {
	$the_map .= "[ <a href=\"modules.php?name=$module_name&amp;op=add_site&amp;cid=$cid\">"._ADDCOMMUNITY."</a> ]";
    }
    echo "$the_map";
}

function cont() {
    global $module_name, $admin, $prefix, $dbi;
    include("header.php");
    title("PHP-Nuke Community");
    OpenTable();
    echo "<center><b>"._SELECTCONT."</b><br><br>";
    worldmap();
    echo "<br><br>"._LISTCOOLSITES."<br><br><br><br>"
	."<table border=\"0\" width=\"100%\" cellspacing=\"20\">";
    $a = 0;
    $result = sql_query("select id, name, description, maintainer, hits from ".$prefix."_community_cool order by name", $dbi);
    while (list($id, $name, $description, $maintainer, $hits) = sql_fetch_row($result, $dbi)) {
	if (is_admin($admin)) {
	    $adm = "<br>[ <a href=\"modules.php?name=$module_name&op=edit_cool&id=$id\">"._EDIT."</a> | <a href=\"modules.php?name=$module_name&op=delete_cool&id=$id\">"._DELETE."</a> ]";
	}
	if ($a == 0) {
	    echo "<tr>";
	}
    	echo "<td width=\"50%\" valign=\"top\"><img src=\"modules/$module_name/images/star.gif\" border=\"0\">&nbsp;&nbsp;<a href=\"modules.php?name=$module_name&op=goto&id=$id\" target=\"blank\"><b>$name</b></a><br>"
	    ."<b>"._DESCRIPTION."</b> $description<br>"
	    ."<b>"._MAINTAINER."</b> $maintainer<br>"
	    ."<b>"._HITS."</b> $hits$adm</td>";
	$a++;
	if ($a == 2) {
	    echo "</tr><tr><td height=\"10\" colspan=\"2\">&nbsp;</td></tr>";
	    $a = 0;
	}
    }
    if ($a == 0) {
	echo "</table>";
    } else {
	echo "</tr></table>";
    }
    if (is_admin($admin)) {
	echo "<br><br><br><center>[ <a href=\"modules.php?name=$module_name&op=add_cool_site\">"._ADDCOOLSITE."</a> ]</center>";
    }
    CloseTable();
    include("footer.php");
}

function show($cid) {
    global $prefix, $dbi, $module_name, $admin, $sitename;
    include("header.php");
    if ($cid == 1) { $reg = _AMERICAS; $reg1 = "<img src=\"modules/$module_name/images/globew.gif\" border=\"0\"><br>"; }
    if ($cid == 2) { $reg = _EUROPE; $reg1 = "<img src=\"modules/$module_name/images/globex.gif\" border=\"0\"><br>"; }
    if ($cid == 3) { $reg = _AFRICA; $reg1 = "<img src=\"modules/$module_name/images/globex.gif\" border=\"0\"><br>"; }
    if ($cid == 4) { $reg = _MIDDLEEAST; $reg1 = "<img src=\"modules/$module_name/images/globey.gif\" border=\"0\"><br>"; }
    if ($cid == 5) { $reg = _ASIA; $reg1 = "<img src=\"modules/$module_name/images/globey.gif\" border=\"0\"><br>"; }
    if ($cid == 6) { $reg = _OCEANIA; $reg1 = "<img src=\"modules/$module_name/images/globez.gif\" border=\"0\"><br>"; }
    title("$reg1 $reg $sitename "._COMMUNITYSITES."<br><font class=\"content\">[ <a href=\"modules.php?name=$module_name\">"._COMMUNITYHOME."</a> ]</font>");
    OpenTable();
    worldmap();
    CloseTable();
    $result = sql_query("select id, name, region, country, description, maintainer, flag, hits from ".$prefix."_community where region='$cid' order by country", $dbi);
    while (list($id, $name, $region, $country, $description, $maintainer, $flag, $hits) = sql_fetch_row($result, $dbi)) {
	echo "<br>";
	OpenTable();
	echo "<table border=\"0\" width=\"100%\"><tr><td colspan=\"3\" align=\"right\">"
	    ."<font class=\"title\"><b>$country</b></font></td></tr><tr><td>"
	    ."<img src=\"modules/$module_name/images/flags/$flag\" border=\"0\"></td><td>&nbsp;</td><td valign=\"top\" width=\"100%\">"
	    ."<b>"._SITENAME."</b> $name<br>"
	    ."<b>"._COUNTRY."</b> $country<br>"
	    ."<b>"._SITEMAINTAINER."</b> $maintainer<br>"
	    ."<b>"._DESCRIPTION."</b> $description<br><br>"
	    ."<img src=\"images/arrow.gif\" border=\"0\">&nbsp;&nbsp;<b><a href=\"modules.php?name=$module_name&amp;op=go&amp;id=$id\" target=\"blank\">"._GOTO." $name</a></b> ($hits "._HITSN.") ";
	if (is_admin($admin)) {
	    echo " [ <a href=\"modules.php?name=$module_name&amp;op=edit&amp;id=$id\">"._EDIT."</a> | "
		."<a href=\"modules.php?name=$module_name&amp;op=delete&amp;id=$id\">"._DELETE."</a> ]";
	}
	echo "</td></tr></table>";
	CloseTable();
    }
    include("footer.php");
}

function go($id) {
    global $prefix, $dbi;
    $result = sql_query("select url from ".$prefix."_community where id='$id'", $dbi);
    list($url) = sql_fetch_row($result, $dbi);
    sql_query("UPDATE ".$prefix."_community set hits=hits+1 where id='$id'", $dbi);
    Header("Location: $url");
}

function goto($id) {
    global $prefix, $dbi;
    $result = sql_query("select url from ".$prefix."_community_cool where id='$id'", $dbi);
    list($url) = sql_fetch_row($result, $dbi);
    sql_query("UPDATE ".$prefix."_community_cool set hits=hits+1 where id='$id'", $dbi);
    Header("Location: $url");
}

function add_site($cid) {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	include("header.php");
	title("$sitename "._COMMADMIN."");
	OpenTable();
	echo "<b>"._ADDNEWSITE."</b><br><br>"
	    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"add_new\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<b>"._SITENAME."</b></td><td><input type=\"text\" name=\"sname\" size=\"30\"></tr></td><tr><td>"
	    ."<b>"._CONTINENTREG."</b></td><td><select name=\"region\">";
	if ($cid == 1) { $sel1 = "selected"; }
	if ($cid == 2) { $sel2 = "selected"; }
	if ($cid == 3) { $sel3 = "selected"; }
	if ($cid == 4) { $sel4 = "selected"; }
	if ($cid == 5) { $sel5 = "selected"; }
	if ($cid == 6) { $sel6 = "selected"; }
	echo "<option value=\"1\" $sel1>"._AMERICAS."</option>"
	    ."<option value=\"2\" $sel2>"._EUROPE."</option>"
	    ."<option value=\"3\" $sel3>"._AFRICA."</option>"
	    ."<option value=\"4\" $sel4>"._MIDDLEEAST."</option>"
	    ."<option value=\"5\" $sel5>"._ASIA."</option>"
	    ."<option value=\"6\" $sel6>"._OCEANIA."</option>"
	    ."</select></td></tr><tr><td>"
	    ."<b>"._COUNTRY."</b></td><td><input type=\"text\" name=\"country\" size=\"30\"></tr></td><tr><td>"
	    ."<b>"._SITEMAINTAINER."</b></td><td><input type=\"text\" name=\"maintainer\" size=\"30\"></tr></td><tr><td>"
	    ."<b>"._DESCRIPTION."</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"description\"></textarea></tr></td><tr><td>"
	    ."<b>"._HOMEURL."</b></td><td><input type=\"text\" name=\"url\" size=\"60\" value=\"http://\"></tr></td><tr><td>"
	    ."<b>"._CFLAG."</b></td><td><select name=\"flag\">";
	$path = "modules/$module_name/images/flags/";
	$handle=opendir($path);
	while ($file = readdir($handle)) {
	    if ( (ereg("^([0-9a-z]+)([.]{1})([a-z0-9]{3})$",$file)) ) {
		$tlist .= "$file ";
	    }
	}
	closedir($handle);
	$tlist = explode(" ", $tlist);
	sort($tlist);
	for ($i=0; $i < sizeof($tlist); $i++) {
	    if($tlist[$i]!="") {
		echo "<option name=\"flag\" value=\"$tlist[$i]\">$tlist[$i]</option>\n";
	    }
	}
	echo "</select></td></tr></table><br><br>"
	    ."<input type=\"submit\" value=\""._SADDSITE."\">"
	    ."</form>";
	CloseTable();
	include("footer.php");
    }
}

function edit($id) {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	$result = sql_query("select id, name, region, country, maintainer, description, url, flag from ".$prefix."_community where id='$id'", $dbi);
	list($id, $sname, $region, $country, $maintainer, $description, $url, $flag) = sql_fetch_row($result, $dbi);
	include("header.php");
	title("$sitename "._COMMADMIN."");
	OpenTable();
	echo "<b>Edit a Site</b><br><br>"
	    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"edit_save\">"
	    ."<input type=\"hidden\" name=\"id\" value=\"$id\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<b>"._SITENAME."</b></td><td><input type=\"text\" name=\"sname\" size=\"30\" value=\"$sname\"></tr></td><tr><td>"
	    ."<b>"._CONTINENTREG."</b></td><td><select name=\"region\">";
	if ($region == 1) { $sel1 = "selected"; }
	if ($region == 2) { $sel2 = "selected"; }
	if ($region == 3) { $sel3 = "selected"; }
	if ($region == 4) { $sel4 = "selected"; }
	if ($region == 5) { $sel5 = "selected"; }
	if ($region == 6) { $sel6 = "selected"; }
	echo "<option value=\"1\" $sel1>"._AMERICAS."</option>"
	    ."<option value=\"2\" $sel2>"._EUROPE."</option>"
	    ."<option value=\"3\" $sel3>"._AFRICA."</option>"
	    ."<option value=\"4\" $sel4>"._MIDDLEEAST."</option>"
	    ."<option value=\"5\" $sel5>"._ASIA."</option>"
	    ."<option value=\"6\" $sel6>"._OCEANIA."</option>"
	    ."</select></td></tr><tr><td>"
	    ."<b>"._COUNTRY."</b></td><td><input type=\"text\" name=\"country\" size=\"30\" value=\"$country\"></tr></td><tr><td>"
	    ."<b>"._SITEMAINTAINER."</b></td><td><input type=\"text\" name=\"maintainer\" size=\"30\" value=\"$maintainer\"></tr></td><tr><td>"
	    ."<b>"._DESCRIPTION."</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"description\">$description</textarea></tr></td><tr><td>"
	    ."<b>"._HOMEURL."</b></td><td><input type=\"text\" name=\"url\" size=\"60\" value=\"$url\"></tr></td><tr><td>"
	    ."<b>"._CFLAG."</b></td><td><select name=\"flag\">";
	$path = "modules/$module_name/images/flags/";
	$handle=opendir($path);
	while ($file = readdir($handle)) {
	    if ( (ereg("^([0-9a-z]+)([.]{1})([a-z0-9]{3})$",$file)) ) {
		$tlist .= "$file ";
	    }
	}
	closedir($handle);
	$tlist = explode(" ", $tlist);
	sort($tlist);
	for ($i=0; $i < sizeof($tlist); $i++) {
	    if($tlist[$i]!="") {
		if ($tlist[$i] == $flag) {
		    $sel = "selected";
		} else {
		    $sel = "";
		}
		echo "<option name=\"flag\" value=\"$tlist[$i]\" $sel>$tlist[$i]</option>\n";
	    }
	}
	echo "</select></td></tr></table><br><br>"
	    ."<input type=\"submit\" value=\""._SAVESITE."\">"
	    ."</form>";
	CloseTable();
	include("footer.php");
    }
}

function delete($id, $ok=0) {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	$result = sql_query("select name, region, url from ".$prefix."_community where id='$id'", $dbi);
	list($sname, $region, $url) = sql_fetch_row($result, $dbi);
	if ($ok == 0) {
	    include("header.php");
	    title("$sitename "._COMMADMIN."");
	    OpenTable();
	    echo "<center><b>"._DELETESITE."</b><br><br>"
		.""._YOUDELETE." <a href=\"$url\" target=\"blank\"><b>$sname</b></a><br><br>"
		.""._SURE2DEL."<br><br>"
		."[ <a href=\"modules.php?name=$module_name&amp;op=delete&amp;id=$id&amp;ok=1\">"._YES."</a> | <a href=\"modules.php?name=$module_name&amp;op=show&amp;cid=$region\">"._NO."</a> ]"
		."</center>";
    	    CloseTable();
	    include("footer.php");
	} elseif ($ok == 1) {
	    sql_query("delete from ".$prefix."_community where id='$id'", $dbi);
	    Header("Location: modules.php?name=$module_name&op=show&cid=$region");
	}
    }
}

function add_new($sname, $region, $country, $maintainer, $description, $url, $flag) {
    global $prefix, $dbi, $admin, $module_name;
    if (is_admin($admin)) {
	sql_query("INSERT INTO ".$prefix."_community values (NULL, '$sname', '$region', '$country', '$description', '$maintainer', '$url', '$flag', '0')", $dbi);
    }
    Header("Location: modules.php?name=$module_name&op=show&cid=$region");
}

function edit_save($id, $sname, $region, $country, $maintainer, $description, $url, $flag) {
    global $prefix, $dbi, $admin, $module_name;
    if (is_admin($admin)) {
	$result = sql_query("UPDATE ".$prefix."_community SET name='$sname', region='$region', country='$country', description='$description', maintainer='$maintainer', url='$url', flag='$flag' where id='$id'", $dbi);
    }
    Header("Location: modules.php?name=$module_name&op=show&cid=$region");
}

function add_cool_site() {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	include("header.php");
	title("$sitename "._COMMADMIN."");
	OpenTable();
	echo "<b>"._ADDCOOLSITE."</b><br><br>"
	    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"add_cool_new\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<b>"._SITENAME."</b></td><td><input type=\"text\" name=\"sname\" size=\"30\"></tr></td><tr><td>"
	    ."<b>"._SITEMAINTAINER."</b></td><td><input type=\"text\" name=\"maintainer\" size=\"30\"></tr></td><tr><td>"
	    ."<b>"._DESCRIPTION."</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"description\"></textarea></tr></td><tr><td>"
	    ."<b>"._HOMEURL."</b></td><td><input type=\"text\" name=\"url\" size=\"60\" value=\"http://\"></tr></td><tr><td>"
	    ."</td></tr></table><br><br>"
	    ."<input type=\"submit\" value=\""._ADDSITE."\">"
	    ."</form>";
	CloseTable();
	include("footer.php");
    }
}

function add_cool_new($sname, $maintainer, $description, $url) {
    global $prefix, $dbi, $admin, $module_name;
    if (is_admin($admin)) {
	sql_query("INSERT INTO ".$prefix."_community_cool values (NULL, '$sname', '$description', '$maintainer', '$url', '0')", $dbi);
    }
    Header("Location: modules.php?name=$module_name");
}

function edit_cool($id) {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	$result = sql_query("select id, name, description, maintainer, url from ".$prefix."_community_cool where id='$id'", $dbi);
	list($id, $sname, $description, $maintainer, $url) = sql_fetch_row($result, $dbi);
	include("header.php");
	title("$sitename "._COMMADMIN."");
	OpenTable();
	echo "<b>"._EDITSITE."</b><br><br>"
	    ."<form action=\"modules.php?name=$module_name\" method=\"post\">"
	    ."<input type=\"hidden\" name=\"op\" value=\"edit_cool_save\">"
	    ."<input type=\"hidden\" name=\"id\" value=\"$id\">"
	    ."<table border=\"0\"><tr><td>"
	    ."<b>"._SITENAME."</b></td><td><input type=\"text\" name=\"sname\" size=\"30\" value=\"$sname\"></tr></td><tr><td>"
	    ."<b>"._SITEMAINTAINER."</b></td><td><input type=\"text\" name=\"maintainer\" size=\"30\" value=\"$maintainer\"></tr></td><tr><td>"
	    ."<b>"._DESCRIPTION."</b></td><td><textarea rows=\"5\" cols=\"50\" name=\"description\">$description</textarea></tr></td><tr><td>"
	    ."<b>"._HOMEURL."</b></td><td><input type=\"text\" name=\"url\" size=\"60\" value=\"$url\"></tr></td><tr><td>"
	    ."</td></tr></table><br><br>"
	    ."<input type=\"submit\" value=\""._SAVESITE."\">"
	    ."</form>";
	CloseTable();
	include("footer.php");
    }
}

function edit_cool_save($id, $sname, $maintainer, $description, $url) {
    global $prefix, $dbi, $admin, $module_name;
    if (is_admin($admin)) {
	$result = sql_query("UPDATE ".$prefix."_community_cool SET name='$sname', description='$description', maintainer='$maintainer', url='$url' where id='$id'", $dbi);
    }
    Header("Location: modules.php?name=$module_name");
}

function delete_cool($id, $ok=0) {
    global $prefix, $dbi, $admin, $module_name, $sitename;
    if (is_admin($admin)) {
	$result = sql_query("select name, url from ".$prefix."_community_cool where id='$id'", $dbi);
	list($sname, $url) = sql_fetch_row($result, $dbi);
	if ($ok == 0) {
	    include("header.php");
	    title("$sitename "._COMMADMIN."");
	    OpenTable();
	    echo "<center><b>"._DELETESITE."</b><br><br>"
		.""._YOUDELETE." <a href=\"$url\" target=\"blank\"><b>$sname</b></a><br><br>"
		.""._SURE2DEL."<br><br>"
		."[ <a href=\"modules.php?name=$module_name&amp;op=delete_cool&amp;id=$id&amp;ok=1\">"._YES."</a> | <a href=\"modules.php?name=$module_name\">"._NO."</a> ]"
		."</center>";
    	    CloseTable();
	    include("footer.php");
	} elseif ($ok == 1) {
	    sql_query("delete from ".$prefix."_community_cool where id='$id'", $dbi);
	    Header("Location: modules.php?name=$module_name");
	}
    }
}

switch ($op) {

    default:
    cont();
    break;
    
    case "show":
    show($cid);
    break;

    case "go":
    go($id);
    break;

    case "goto":
    goto($id);
    break;

    case "add_site":
    add_site($cid);
    break;

    case "edit":
    edit($id);
    break;
    
    case "delete":
    delete($id, $ok);
    break;

    case "add_new":
    add_new($sname, $region, $country, $maintainer, $description, $url, $flag);
    break;

    case "edit_save":
    edit_save($id, $sname, $region, $country, $maintainer, $description, $url, $flag);
    break;

    case "add_cool_site":
    add_cool_site();
    break;

    case "add_cool_new":
    add_cool_new($sname, $maintainer, $description, $url);
    break;

    case "edit_cool":
    edit_cool($id);
    break;
    
    case "delete_cool":
    delete_cool($id, $ok);
    break;

    case "edit_cool_save":
    edit_cool_save($id, $sname, $maintainer, $description, $url);
    break;

}

?>