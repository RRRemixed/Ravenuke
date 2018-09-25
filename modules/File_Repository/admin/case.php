<?php

/************************************************************************/
/* File Repository                                                      */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2008 by MJ Hufford                                     */
/* http://www.GuitarVoice.com                                           */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

global $admin_file;
if (!eregi("".$admin_file.".php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }
include_once("modules/File_Repository/admin/language/lang-".$currentlang.".php");

switch($op) {
    case "File_Repository":
    include("modules/File_Repository/admin/index.php");
    break;
}
?>