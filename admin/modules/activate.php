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
/////3.1 yada 3.2 yamasý varsa aþaðýdan /* ve */ yazan yerleri ve   "if (!eregi("".$admin_file.".php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }   "  yazan yeri silin.

/*  ///yama yüklüyse bu satýr silinecek.
if ( !defined('ADMIN_FILE') )
{
    die ("Access Denied");
}
*/ //yama yüklüseyse burasý silinecek....
global $prefix, $db, $admin_file;

if (!eregi("".$admin_file.".php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }   //yama yüklüyse burasý silinecek.

$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {


/*********************************************************/
/* Sections Manager Functions                            */
/*********************************************************/

function activate() {
    global $prefix, $db, $admin_file;
    include("header.php");
    GraphicAdmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>"._ACTIVATE."</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<table border=\"0\" width=\"100%\">";
    $hresult = $db->sql_query("select user_id, username, user_regdate, check_num from ".$prefix."_users_temp");
    while(list($user_id, $username, $user_regdate, $check_num) = $db->sql_fetchrow($hresult)) {
	echo "<tr><td bgcolor=\"$bgcolor2\"><font class=\"content\">$user_id</td><td bgcolor=\"$bgcolor2\">"
	."<font class=\"content\">$username</td><td bgcolor=\"$bgcolor2\"><font class=\"content\">$user_regdate</td>"
	    ."<td bgcolor=\"$bgcolor2\"><font class=\"content\">"
		."<a href=\"".$admin_file.".php?op=activate_go&username=$username&check_num=$check_num\">Activate</a></td></tr>";
    }
    echo "</table>";
    CloseTable();
    include("footer.php");
}

function activate_go($username, $check_num) {
    global $db, $user_prefix, $admin_file;
    $past = time()-86400;
    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE time < $past");
    $sql = "SELECT * FROM ".$user_prefix."_users_temp WHERE username='$username' AND check_num='$check_num'";
    $result = $db->sql_query($sql);
    if ($db->sql_numrows($result) == 1) {
	$row = $db->sql_fetchrow($result);
	if ($check_num == $row[check_num]) {
	    $db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_password, user_avatar, user_regdate, user_lang) VALUES (NULL, '$row[username]', '$row[user_email]', '$row[user_password]', 'gallery/blank.gif', '$row[user_regdate]', '$language')");
	    $db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE username='$username' AND check_num='$check_num'");
		activate();
	    die();
	}
	}
}


switch ($op) {

    case "activate_go":
    activate_go($username, $check_num);
    break;

    case "activate":
    activate();
    break;
}

} else {
    echo "Access Denied";
}

?>