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
/********************************************************/
/* Forum Messages V1.0.0                                */
/* By: Telli (telli@codezwiz.com)                       */
/* http://www.codezwiz.com                              */
/* Copyright � 2002-2004 by Codezwiz.com                */
/********************************************************/
if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
if ($radminsuper==1) {
    adminmenu("admin.php?op=fmessages", "Forum Messages", "messages.gif");
}

?>