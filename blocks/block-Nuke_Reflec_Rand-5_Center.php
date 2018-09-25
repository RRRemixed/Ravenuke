<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// Config Fallowing Line if Different Folder.
$module_name1 = "Nuke_Reflections";
$sizeinblock = "150";
// End Config stuff

 //Nuke Platinum
/*if ( !defined('BLOCK_FILE') ) {
        die("Illegal Block File Access");
}  */
//Nuke Evolution
/*if(!defined('NUKE_EVO')) exit;     */

//phpnuke
if (eregi("block-Nuke_Reflec_Rand-5_Center.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

global $user, $cookie, $prefix, $db, $user_prefix;
$configlocationfile = "modules/$module_name1/reflectionconfig.php";
include_once("$configlocationfile");
include_once("modules/$module_name1/includes/devil_includes.php");


$content .= "<center><marquee direction=left scrollamount=1 scrolldelay=1 behavior=scroll onMouseOver=this.stop() onMouseOut=this.start()>";


$sql="SELECT * FROM ".$user_prefix."_reflections_files WHERE approved='1' AND galactive='1' AND galpassword='nopassword' ORDER BY RAND() LIMIT 5";
$result=mysql_query($sql);
$num=mysql_numrows($result);
$i=0;
$content .= "<table border=\"0\" width=\"100%\" id=\"table1\">";
$content .= "<tr>";

while ($i < $num) {

$picid=mysql_result($result,$i,"picid");
$infolder=mysql_result($result,$i,"infolder");
$galtype=mysql_result($result,$i,"galtype");
$filename=mysql_result($result,$i,"filename");
$totalvote=mysql_result($result,$i,"totalvote");
$totalcomments=mysql_result($result,$i,"totalcomments");
$advarage=mysql_result($result,$i,"advarage");
$galid=mysql_result($result,$i,"galid");

if ($galtype == "main") {
        $galtype = "maingallery";
} else if ($galtype == "member") {
        $galtype = "memgallery";
}

if ($picid != "") {
        $checkit = "modules/$module_name1/files/$galtype/$infolder/thumbs/$filename";
if (file_exists($checkit)) {
        $content .= "<td valign=\"bottom\">";
        $imgSize = wdresizeinfo($checkit, $sizeinblock);
        $content .= "<center>";
        $content .= "<a href=\"modules.php?name=$module_name1&op=viewbig&picid=$picid\"><img src=\"$checkit\" width=\"$imgSize[0]\" border=\"0\" height=\"$imgSize[1]\"></a>";

 //   $row = $db->sql_fetchrow($db->sql_query("SELECT * FROM " . $prefix . "_reflections_gallery WHERE galid='$filemaingalid'"));
 //   $galtype = $row['galtype'];



$content .= "<bR>$totalvote Vote(s) :: Rating $advarage<br>
<a href=\"modules.php?name=$module_name1&op=viewbig&picid=$picid\">$totalcomments Comment(s)</a> || <a href=\"modules.php?name=$module_name1&op=showgal&galid=$galid\">More...</a>";
$content .= "<hr>";
$content .= "</td>";
}
}






$i++;
}




$content .= "</tr>";
$content .= "</table>";
$content .= "</marquee></center>";






?>
