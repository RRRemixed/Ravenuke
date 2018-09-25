<?php

/***************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/***************************************************************************/
/* block--digiclock.php by Norbert Lange - http://langehome.de 13. Januar  2003  */
/***************************************************************************/


if (eregi("block-digiclock.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

    
                                 $content .= "<center><OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\"WIDTH=70 HEIGHT=22><PARAM NAME=movie VALUE=\"images/digiclock.swf\"><PARAM NAME=quality VALUE=high><PARAM NAME=bgcolor VALUE=#ffffff><PARAM NAME=menu VALUE=false><EMBED src=\"digiclock.swf\" base=\".\" quality=high bgcolor=#CACACA  WIDTH=70 HEIGHT=22 TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" menu=\"false\"></EMBED></OBJECT>\n";

                            
?>