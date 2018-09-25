<?php

/************************************************************************/
/*                     www.Clan-Themes.co.uk                            */
/*                  ===========================                         */
/*                    Making Clans Look Good!                           */
/************************************************************************/
/*                 Player Of The Month Block V1.0                       */
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

if (eregi("block-PlayerOfTheMonth.php",$PHP_SELF)) {
   Header("Location: index.php");
    die();
}
if (file_exists("blocks/potm/copyright/ct_copyright.php")) {

global  $db;
$row = $db->sql_fetchrow($db->sql_query("SELECT potm_clantag, potm_img_url, potm_photo FROM nuke_potm_settings"));
$potm_clantag = $row['potm_clantag'];
$potm_img_url = $row['potm_img_url'];
$potm_photo = $row['potm_photo'];

$row2 = "SELECT * FROM nuke_potm_players ORDER BY date ASC";
$result = $db->sql_query($row2);
$num = mysql_numrows($result);
$i=0;
while ($i < $num) {
$pname = mysql_result($result,$i,"pname");
$i++;
}
$date=date("F");

$content = "
<center>for $date is<br><br>$potm_clantag $pname<center><br>
<img name=\"potm_img\" src=\"$potm_img_url/$potm_photo\" width=\"100\" height=\"130\"  border=\"0\">
<center><a href=modules.php?name=PlayerOfTheMonth>Click here to view</a><center><br>

";

//COPYRIGHT PLEASE DO NOT REMOVE! I SPENT ALOT OF TIME CREATING THIS BLOCK, THANK YOU 
$content .= "<hr width=\"90%\"><div align=\"right\"><a href=\"javascript:openwindowctpotmb()\">Clan-Themes &copy;</a></div>";
$content .= "<script type=\"text/javascript\">\n";
$content .= "<!--\n";
$content .= "function openwindowctpotmb(){\n";
$content .= "	window.open (\"blocks/potm/copyright/ct_copyright.php\",\"Block_Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,copyhistory=no,width=400,height=350\");\n";
$content .= "}\n";
$content .= "//-->\n";
$content .= "</SCRIPT>\n\n";
} else {
$content .= "
<center>Opps, you forgot to upload the ct_copyright.php file!<br><br>
<img src=\"blocks/potm/copyright/ct_no_copyright.png\" alt=\"No Copyright\" width=\"130\" height=\"130\" border=\"1\"><br><br>
Go and upload it or this image will not go away!</center>";
}
?>
