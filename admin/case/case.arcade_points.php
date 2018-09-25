<?php
/********************************************************/
/* Arcade Points                                        */
/* By: Telli (telli@codezwiz.com)                       */
/* http://www.codezwiz.com                              */
/* Copyright © 2002-2004 by Codezwiz.com                */
/********************************************************/
if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

switch($op) {

    case "CZArcadePoints":
    case "czarcade_points_update":
    case "czarcade_points_install":  
    include("admin/modules/arcade_points.php");
    break;

}

?>