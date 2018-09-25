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

/*
if (!defined('ADMIN_FILE'))
{
    die ("Access Denied");
}
*/

global $admin_file;
if (!eregi("".$admin_file.".php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }

switch($op) {

    case "activate":
    case "activate_go":
    include("admin/modules/activate.php");
    break;

}

?>
