<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Video Stream Module for PHP-Nuke with many features                  */
/*                                                                      */
/* Copyright (c) 2006 by Scott Cariss (Brady)                           */
/* http://PHPNuke-Downloads.com                                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $admin_file;
if (!eregi("".$admin_file.".php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
if ($radminsuper==1) {
    adminmenu("".$admin_file.".php?op=video_stream", "Video Stream", "video_stream.gif");
}

?>