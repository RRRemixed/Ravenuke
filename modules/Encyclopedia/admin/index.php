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
#########################################################################
#
# nukeWYSIWYG Copyright (c) 2005 Kevin Guske    http://nukeseo.com
# kses developed by Ulf Harnhammar              http://kses.sf.net
# kses ideas contributed by sixonetonoffun      http://netflake.com
# FCKeditor by Frederico Caldeira Knabben       http://fckeditor.net
# Original FCKeditor for PHP-Nuke by H.Theisen  http://phpnuker.de
#
#########################################################################

if ( !defined('ADMIN_FILE') )
{
    die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Encyclopedia'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
    if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
        $auth_user = 1;
    }
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {

/*********************************************************/
/* Sections Manager Functions                            */
/*********************************************************/

function alpha($eid) {
    global $module_name, $prefix, $db, $admin_file;
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
                       "N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $num = count($alphabet) - 1;
    echo "<center>[ ";
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
        $result = $db->sql_query("select * from ".$prefix."_encyclopedia_text where eid='$eid' AND UPPER(title) LIKE '$ltr%'");
        if ($db->sql_numrows($result) > 0) {
            echo "<a href=\"".$admin_file.".php?op=encyclopedia_terms&eid=$eid&ltr=$ltr\">$ltr</a>";
        } else {
            echo "$ltr";
        }
        if ( $counter == round($num/2) ) {
            echo " ]\n<br />\n[ ";
        } elseif ( $counter != $num ) {
            echo "&nbsp;|&nbsp;\n";
        }
        $counter++;
    }
    echo " ]</center><br /><br />\n\n\n";
}

function encyclopedia() {
    global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;
    include_once("header.php");
    GraphicAdmin();
    title(""._ENCYCLOPEDIAMANAGER."");
    OpenTable();
    echo "<table border=\"0\" width=\"100%\"><tr>"
        ."<td bgcolor=\"$bgcolor2\"><b>"._TITLE."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._TERMS."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._CURRENTSTATUS."</b></td><td align=\"center\" bgcolor=\"$bgcolor2\"><b>"._FUNCTIONS."</b></td></tr>";
    $result = $db->sql_query("select * from ".$prefix."_encyclopedia order by eid");
    while($ency = $db->sql_fetchrow($result)) {
        $num = $db->sql_numrows($db->sql_query("select * from ".$prefix."_encyclopedia_text WHERE eid='".intval($ency['eid'])."'"));
        if ($ency['active'] == 1) {
            $status = _ACTIVE;
            $status_chng = _DEACTIVATE;
            $active = 1;
        } else {
            $status = "<i>"._INACTIVE."</i>";
            $status_chng = _ACTIVATE;
            $active = 0;
        }
        echo "<tr><td><a href=\"modules.php?name=Encyclopedia&op=list_content&eid=".intval($ency['eid'])."\">".$ency['title']."</a></td><td align=\"center\">$num</td><td align=\"center\">$status</td><td align=\"center\">[ <a href=\"".$admin_file.".php?op=encyclopedia_edit&eid=".intval($ency['eid'])."\">"._EDIT."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_change_status&eid=".intval($ency['eid'])."&active=$active\">$status_chng</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_delete&eid=".intval($ency['eid'])."\">"._DELETE."</a> ]</td></tr>";
    }
    echo "</table>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><b>"._ADDNEWENCYCLOPEDIA."</b></center><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<b>"._TITLE.":</b><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" /><br /><br />"
        ."<b>"._DESCRIPTION.":</b><br />";
    wysiwyg_textarea("desc", "", "PHPNukeAdmin", "60", "10");
    echo "<br /><br />";
    if ($multilingual == 1) {
        echo "<br /><b>"._LANGUAGE.": </b>"
            ."<select name=\"elanguage\">";
        $handle=opendir('language');
        $languageslist = '';
        while ($file = readdir($handle)) {
            if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(" ", $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
            if(!empty($languageslist[$i])) {
                echo "<option value=\"$languageslist[$i]\" ";
                if($languageslist[$i]==$language) echo "selected";
                echo ">".ucfirst($languageslist[$i])."</option>\n";
            }
        }
        echo "</select><br /><br />";
    } else {
        echo "<input type=\"hidden\" name=\"elanguage\" value=\"$language\" />";
    }
    echo "<b>"._ACTIVATEPAGE."</b><br />"
        ."<input type=\"radio\" name=\"active\" value=\"1\" checked=\"checked\" />&nbsp;"._YES."&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" />&nbsp;"._NO."<br /><br />"
        ."<input type=\"hidden\" name=\"op\" value=\"encyclopedia_save\" />"
        ."<input type=\"submit\" value=\""._SEND."\" />"
        ."</form>";
    CloseTable();
    $result = $db->sql_query("select eid, title from ".$prefix."_encyclopedia");
    if ($db->sql_numrows($result) > 0) {
        echo "<br />";
        OpenTable();
        echo "<center><b>"._ADDNEWENCYTERM."</b></center><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            ."<b>"._TITLE.":</b><br />"
            ."<input type=\"text\" name=\"title\" size=\"50\" /><br /><br />"
            ."<b>"._TERMTEXT.":</b><br />"._PAGEBREAK."<br />";
        wysiwyg_textarea("text", "", "PHPNukeAdmin", "60", "20");
        echo "<br /><br />";
        if ($multilingual == 1) {
            $languageslist = "";
            echo "<br /><b>"._LANGUAGE.": </b>"
                ."<select name=\"elanguage\">";
            $handle=opendir('language');
            while ($file = readdir($handle)) {
                if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
                        $langFound = $matches[1];
                    $languageslist .= "$langFound ";
                }
            }
            closedir($handle);
            $languageslist = explode(" ", $languageslist);
            sort($languageslist);
            for ($i=0; $i < sizeof($languageslist); $i++) {
                if(!empty($languageslist[$i])) {
                        echo "<option value=\"$languageslist[$i]\" ";
                        if($languageslist[$i]==$language) echo "selected";
                    echo ">".ucfirst($languageslist[$i])."</option>\n";
                }
            }
            echo "</select><br /><br />";
        } else {
            echo "<input type=\"hidden\" name=\"elanguage\" value=\"$language\" />";
        }
        echo "<b>"._ENCYCLOPEDIA.":</b><br /><select name=\"eid\">";
        while(list($eid, $title) = $db->sql_fetchrow($result)) {
        $eid = intval($eid);
            echo "<option value=\"$eid\">$title</option>";
        }
        echo "</select><br /><br />"
            ."<input type=\"hidden\" name=\"op\" value=\"encyclopedia_text_save\" />"
            ."<input type=\"submit\" value=\""._ADD."\" />"
            ."</form>";
        CloseTable();

    }
    $result = $db->sql_query("select eid, title from ".$prefix."_encyclopedia");
    $result2 = $db->sql_query("select eid, title from ".$prefix."_encyclopedia");
    if ($db->sql_numrows($result) > 1) {
        echo "<br />";
        OpenTable();
        echo "<center><b>"._MOVETERMS."</b><br /><br />"
            ."<form action=\"".$admin_file.".php\" method=\"post\">"
            .""._MOVEALLTERMSFROM.": <select name=\"eid\">";
        while(list($eid, $title) = $db->sql_fetchrow($result)) {
        $eid = intval($eid);
            echo "<option value=\"$eid\">$title";
        }
        echo "</select> "._TO.": <select name=\"new_eid\">";
        while(list($eid, $title) = $db->sql_fetchrow($result2)) {
        $eid = intval($eid);
            echo "<option value=\"$eid\">$title";
        }
        echo "</select>&nbsp;&nbsp;"
            ."<input type=\"hidden\" name=\"op\" value=\"move_terms\" />"
            ."<input type=\"submit\" value=\""._SAVECHANGES."\" />"
            ."</form></center>";
        CloseTable();
    }
    include_once("footer.php");
}

function encyclopedia_edit($eid) {
    global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;
    include_once("header.php");
    GraphicAdmin();
    title(""._ENCYCLOPEDIAMANAGER."");
    $result = $db->sql_query("select * from ".$prefix."_encyclopedia WHERE eid='$eid'");
    $ency = $db->sql_fetchrow($result);
        if ($ency['active'] == 1) {
            $sel1 = "checked";
            $sel2 = "";
        } else {
            $sel1 = "";
            $sel2 = "checked";
        }
    OpenTable();
    echo "<center><b>"._EDITENCYCLOPEDIA."</b></center><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<b>"._TITLE.":</b><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" value=\"".$ency['title']."\" /><br /><br />"
        ."<b>"._DESCRIPTION.":</b><br />";
    wysiwyg_textarea("desc", $ency['description'], "PHPNukeAdmin", "60", "10");
    echo "<br /><br />";
    if ($multilingual == 1) {
        echo "<br /><b>"._LANGUAGE.": </b>"
            ."<select name=\"elanguage\">";
        $handle=opendir('language');
        $languageslist = '';
        while ($file = readdir($handle)) {
            if (preg_match("/^lang\-(.+)\.php/", $file, $matches)) {
                $langFound = $matches[1];
                $languageslist .= "$langFound ";
            }
        }
        closedir($handle);
        $languageslist = explode(" ", $languageslist);
        sort($languageslist);
        for ($i=0; $i < sizeof($languageslist); $i++) {
                if(!empty($languageslist[$i])) {
                echo "<option value=\"$languageslist[$i]\" ";
                if($languageslist[$i]==$language) echo "selected";
                echo ">".ucfirst($languageslist[$i])."</option>\n";
            }
        }
        echo "</select><br /><br />";
    } else {
        echo "<input type=\"hidden\" name=\"elanguage\" value=\"".$ency['elanguage']."\" />";
    }
    echo "<b>"._ACTIVATEPAGE."</b><br />"
        ."<input type=\"radio\" name=\"active\" value=\"1\" $sel1 />&nbsp;"._YES."&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" $sel2 />&nbsp;"._NO."<br /><br />"
        ."<input type=\"hidden\" name=\"eid\" value=\"".$ency['eid']."\" />"
        ."<input type=\"hidden\" name=\"op\" value=\"encyclopedia_save_edit\" />"
        ."<input type=\"submit\" value=\""._SAVECHANGES."\" />"
        ."</form>";
    CloseTable();
    echo "<br />";
    OpenTable();
    echo "<center><b>"._ENCYTERMSEDIT."</b></center><br /><br />";
    alpha($eid);
    CloseTable();
    include_once("footer.php");
}

function encyclopedia_terms($eid, $ltr) {
    global $prefix, $db, $admin_file;
    include_once("header.php");
    $eid = intval($eid);
    GraphicAdmin();
    title(""._ENCYCLOPEDIAMANAGER."");
    $result = $db->sql_query("select title from ".$prefix."_encyclopedia where eid='$eid' AND UPPER(title) LIKE '%$ltr%'");
    list($title) = $db->sql_fetchrow($result);
    title("$title");
    OpenTable();
        echo "<center>"._SELECTONETERM."</center><br /><br />"
            ."<table border=\"0\" align=\"center\">";
        $result = $db->sql_query("select tid, title from ".$prefix."_encyclopedia_text WHERE UPPER(title) LIKE '$ltr%' AND eid='$eid'");
        if ($db->sql_numrows($result) == 0) {
            echo "<center><i>"._NOCONTENTFORLETTER." $ltr.</i></center>";
        }
        while(list($tid, $title) = $db->sql_fetchrow($result)) {
        $tid = intval($tid);
            echo "<tr><td><a href=\"".$admin_file.".php?op=encyclopedia_text_edit&tid=$tid\">$title</a></td></tr>";
        }
        echo "</table><br /><br />";
        alpha($eid);
        echo "<center>"._GOBACK."</center>";
    CloseTable();
    include_once("footer.php");
}

function encyclopedia_text_edit($tid) {
    global $prefix, $db, $language, $multilingual, $bgcolor2, $admin_file;
    include_once("header.php");
    GraphicAdmin();
    title(""._ENCYCLOPEDIAMANAGER."");
    $tid = intval($tid);
    $result = $db->sql_query("select * from ".$prefix."_encyclopedia_text WHERE tid='$tid'");
    $ency = $db->sql_fetchrow($result);
    OpenTable();
    echo "<center><b>"._ENCYTERMSEDIT."</b></center><br /><br />"
        ."<form action=\"".$admin_file.".php\" method=\"post\">"
        ."<b>"._TITLE.":</b><br />"
        ."<input type=\"text\" name=\"title\" size=\"50\" value=\"".$ency['title']."\" /><br /><br />"
        ."<b>"._TERMTEXT.":</b><br />"._PAGEBREAK."<br />";
    wysiwyg_textarea("text", $ency['text'], "PHPNukeAdmin", "60", "20");
    echo "<br /><br />"
        ."<b>"._CHANGETOENCY.":</b><br />"
        ."<select name=\"eid\">";
    $result = $db->sql_query("select eid, title from ".$prefix."_encyclopedia");
    while(list($eid, $title) = $db->sql_fetchrow($result)) {
        $eid = intval($eid);
        if ($eid == $ency['eid']) {
            $sel = "selected";
        } else {
            $sel = "";
        }
        echo "<option value=\"$eid\" $sel>$title</option>";
    }
    echo "</select><br /><br />"
        ."<input type=\"hidden\" name=\"op\" value=\"encyclopedia_text_save_edit\" />"
        ."<input type=\"hidden\" name=\"tid\" value=\"$tid\" />"
        ."<input type=\"submit\" value=\""._SAVECHANGES."\" /> &nbsp;&nbsp; [ <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_text_delete&tid=$tid&ok=0\">"._DELETE."</a> ]"
        ."</form>";
    CloseTable();
    include_once("footer.php");
}

function encyclopedia_save($title, $description, $elanguage, $active) {
    global $prefix, $db, $admin_file;
    $title = stripslashes(FixQuotes($title));
    $description = stripslashes(FixQuotes($description));
    $db->sql_query("insert into ".$prefix."_encyclopedia values(NULL, '$title', '$description', '$elanguage', '$active')");
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

function encyclopedia_text_save($eid, $title, $text) {
    global $prefix, $db, $admin_file;
    $eid = intval($eid);
    $text = stripslashes(FixQuotes($text));
    $title = stripslashes(FixQuotes($title));
    $db->sql_query("insert into ".$prefix."_encyclopedia_text values(NULL, '$eid', '$title', '$text', '0')");
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

function encyclopedia_save_edit($eid, $title, $description, $elanguage, $active) {
    global $prefix, $db, $admin_file;
    $eid = intval($eid);
    $title = stripslashes(FixQuotes($title));
    $description = stripslashes(FixQuotes($description));
    $db->sql_query("update ".$prefix."_encyclopedia set title='$title', description='$description', elanguage='$elanguage', active='$active' where eid='$eid'");
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

function encyclopedia_text_save_edit($tid, $eid, $title, $text) {
    global $prefix, $db, $admin_file;
    $tid = intval($tid);
    $eid = intval($eid);
    $text = stripslashes(FixQuotes($text));
    $title = stripslashes(FixQuotes($title));
    $db->sql_query("update ".$prefix."_encyclopedia_text set eid='$eid', title='$title', text='$text' WHERE tid='$tid'");
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

function encyclopedia_change_status($eid, $active) {
    global $prefix, $db, $admin_file;
    $eid = intval($eid);
    if ($active == 1) {
        $new_active = 0;
    } elseif ($active == 0) {
        $new_active = 1;
    }
    $db->sql_query("update ".$prefix."_encyclopedia set active='$new_active' WHERE eid='$eid'");
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

function encyclopedia_delete($eid, $ok=0) {
    global $prefix, $db, $admin_file;
    $eid = intval($eid);
    if ($ok==1) {
        $db->sql_query("delete from ".$prefix."_encyclopedia where eid='$eid'");
        $db->sql_query("delete from ".$prefix."_encyclopedia_text where eid='$eid'");
        Header("Location: ".$admin_file.".php?op=encyclopedia");
    } else {
        include_once("header.php");
        GraphicAdmin();
        title(""._ENCYCLOPEDIAMANAGER."");
        $result = $db->sql_query("select title from ".$prefix."_encyclopedia where eid='$eid'");
        list($title) = $db->sql_fetchrow($result);
        OpenTable();
        echo "<center><b>"._DELENCYCLOPEDIA.": $title</b><br /><br />"
            .""._DELENCYCONTWARNING."<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=encyclopedia\">"._NO."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_delete&amp;eid=$eid&amp;ok=1\">"._YES."</a> ]</center>";
        CloseTable();
        include_once("footer.php");
    }
}

function encyclopedia_text_delete($tid, $ok=0) {
    global $prefix, $db, $admin_file;
    $tid = intval($tid);
    if ($ok==1) {
        $db->sql_query("delete from ".$prefix."_encyclopedia_text where tid='$tid'");
        Header("Location: ".$admin_file.".php?op=encyclopedia");
    } else {
        include_once("header.php");
        GraphicAdmin();
        title(""._ENCYCLOPEDIAMANAGER."");
        $result = $db->sql_query("select title from ".$prefix."_encyclopedia_text where tid='$tid'");
        list($title) = $db->sql_fetchrow($result);
        OpenTable();
        echo "<center><b>"._DELENCYCLOPEDIATEXT.": $title</b><br /><br />"
            .""._DELENCYTEXTWARNING."<br /><br />"
            ."[ <a href=\"".$admin_file.".php?op=encyclopedia\">"._NO."</a> | <a class=\"rn_csrf\" href=\"".$admin_file.".php?op=encyclopedia_text_delete&amp;tid=$tid&amp;ok=1\">"._YES."</a> ]</center>";
        CloseTable();
        include_once("footer.php");
    }
}

function move_terms($eid, $new_eid) {
    global $prefix, $db, $admin_file;
    $eid = intval($eid);
    $result = $db->sql_query("select tid from ".$prefix."_encyclopedia_text WHERE eid='$eid'");
    while(list($tid) = $db->sql_fetchrow($result)) {
        $db->sql_query("update ".$prefix."_encyclopedia_text set eid='$new_eid' WHERE tid='".intval($tid)."'");
    }
    Header("Location: ".$admin_file.".php?op=encyclopedia");
}

switch ($op) {
	case "encyclopedia":
		encyclopedia();
		break;

	case "move_terms":
		csrf_check();
		move_terms($eid, $new_eid);
		break;

	case "encyclopedia_terms":
		encyclopedia_terms($eid, $ltr);
		break;

	case "encyclopedia_edit":
		encyclopedia_edit($eid);
		break;

	case "encyclopedia_text_edit":
		encyclopedia_text_edit($tid);
		break;

	case "encyclopedia_delete":
		csrf_check();
		if (!isset($ok)) $ok='';
		encyclopedia_delete($eid, $ok);
		break;

	case "encyclopedia_text_delete":
		csrf_check();
		encyclopedia_text_delete($tid, $ok);
		break;

	case "encyclopedia_save":
		csrf_check();
		encyclopedia_save($title, $desc, $elanguage, $active);
		break;

	case "encyclopedia_text_save":
		csrf_check();
		encyclopedia_text_save($eid, $title, $text);
		break;

	case "encyclopedia_save_edit":
		csrf_check();
		encyclopedia_save_edit($eid, $title, $desc, $elanguage, $active);
		break;

	case "encyclopedia_text_save_edit":
		csrf_check();
		encyclopedia_text_save_edit($tid, $eid, $title, $text);
		break;

	case "encyclopedia_change_status":
		csrf_check();
		encyclopedia_change_status($eid, $active);
		break;
}

} else {
	include_once('header.php');
	GraphicAdmin();
	OpenTable();
	echo '<center><b>' . _ERROR . '</b><br /><br />You do not have administration permission for module ' . $module_name . '</center>';
	CloseTable();
	include_once('footer.php');
}

?>