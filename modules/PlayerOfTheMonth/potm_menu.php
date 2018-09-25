<?php

/************************************************************************/
/*                     www.Clan-Themes.co.uk                            */
/*                  ===========================                         */
/*                    Making Clans Look Good!                           */
/************************************************************************/
/*                Player Of The Month Module V1.0                       */
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

/************************************************************************/
/*                                                                      */
/* PLEASE DO NOT TOUCH THE CODE BELOW, UNLESS YOU KNOW WHAT YOUR DOING  */
/*                                                                      */
/************************************************************************/
if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}
title("$sitename - Player Of The Month");
get_lang($module_name);
$mainlink="name=PlayerOfTheMonth";

OpenTable();
echo "<hr width=75%><table align=center width=75%>
<tr>
<td align=center width=12.5%><a href=modules.php?name=PlayerOfTheMonth>"._POTM_MAIN."</a></td>
<td align=center width=12.5%><a href=modules.php?name=PlayerOfTheMonth&file=awards>"._POTM_AWARD_DESCRIPTION."</a></td>
<td align=center width=12.5%><a href=modules.php?name=PlayerOfTheMonth&file=players>"._POTM_FAME."</a></td>
</tr></table><hr width=75%>";

if (is_admin($admin)) {
echo"<center>[ <a href = admin.php?op=PlayerOfTheMonthMain>"._POTM_ADMIN_MAIN."</a> ]</center>";
}
CloseTable();
?>
