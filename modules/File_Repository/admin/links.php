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
adminmenu("".$admin_file.".php?op=File_Repository#admin_top", ""._FILEREPOSITORY."", "file_repository.gif");
?>