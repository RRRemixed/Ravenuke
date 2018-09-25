<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* User Groups Module                                                   */
/* Copyright (c) 2004 David Karn                                        */
/* http://www.webdever.net/                                             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
if (stristr($_SERVER['SCRIPT_NAME'], "block-Points.php")) {
    Header("Location: ../index.php");
    die();
}
global $db, $prefix;
$query='SELECT username, user_id, points FROM '.$prefix."_users WHERE `user_id`>'1' ORDER BY `points` DESC LIMIT 10";
$result=$db->sql_query($query);
$content = "<table cellpadding=\"1\" cellspacing=\"0\" border=\"0\"><tr><td width=\"100%\" align=\"center\"><span class=\"content\"><b>Member</b></span></td><td align=\"center\"><span class=\"content\"><b>Points</b></span></td></tr>";
for($i = 1;$h = $db->sql_fetchrow($result);$i++)
{
$id = $h['user_id'];
$name = $h['username'];
$points = $h['points'];
$content .= "<tr><td align=\"left\"><span class=\"content\">$i: </span><a href=\"modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u=$id\">$name</a></td><td align=\"center\"><span class=\"content\">$points</span></td></tr>";
}
$content .= "</table><center><a href=\"modules.php?name=User_Groups\">Learn more</a><br /><a href=\"modules.php?name=User_Groups&amp;op=users\">Top 50 Users</a></center>";
?> 