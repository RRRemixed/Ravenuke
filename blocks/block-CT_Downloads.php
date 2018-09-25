<?php

###################################################
###	CT Downloads Block v2.0						###
###	Coded By Clan Themes						###
###	http://www.clanthemes.com					###
###	March 13th 2009								###
###	Copyright © 2005-2009 Clan Themes			###
###	All Rights Reserved.						###
###												###
###################################################

if (eregi("block-CT_Downloads.php",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
global $prefix, $db, $query, $user, $cookie, $user_prefix, $dbi, $anonymous, $mode, $t, $f, $redirect, $random_num, $userinfo;
$result=sql_query("select * from $prefix"._downloads_downloads."", $dbi); 
    $numrows = sql_num_rows($result, $dbi); 
    $result=sql_query("select sum(filesize*hits) as serv from $prefix"._downloads_downloads."", $dbi); 
    while(list($serv) = sql_fetch_row($result, $dbi)) { 
        $served = $serv; 
    } 
    $gb = 1024*1024*1024; 
    $mb = 1024*1024; 
    $kb = 1024; 
    if ($served >= $gb){ 
        $mysizes = sprintf ("%01.2f",$served/$gb) . " Gb "; 
    } elseif ($served >= $mb) { 
        $mysizes = sprintf ("%01.2f",$served/$mb) . " Mb "; 
    } elseif ($served >= $kb) { 
        $mysizes = sprintf ("%01.2f",$served/$kb) . " Kb "; 
    } else{ 
        $mysizes = $served . " B "; 
    } 
$result = $db->sql_query("select * from ".$prefix."_downloads_downloads");
$files = $db->sql_numrows($result);
$result2 = $db->sql_query("select * from ".$prefix."_downloads_categories");
$cats = $db->sql_numrows($result2);
$result3 = $db->sql_query("select hits from ".$prefix."_downloads_downloads");
$a = 1;
while(list($hits) = $db->sql_fetchrow($result3)) {
          $total_hits = $total_hits + $hits;
                $a++;
}
$sql = "SELECT lid, title, date, hits FROM ".$prefix."_downloads_downloads ORDER BY date DESC LIMIT 0,10";
$result = $db->sql_query($sql);
for ($a = 1; $row = $db->sql_fetchrow($result); $a++) {
    $title2 = ereg_replace("_"," ", $row['title']);
    $transfertitle = str_replace(" ", "_", $row[title]);
    $newleeches .= "$a:<a href=\"modules.php?name=Downloads&amp;op=getit&amp;lid=$row[lid]\" title=\"$title2\">$title2</a>&nbsp;[$row[hits] hits]<br />";
}
$sql = "SELECT lid, title, hits FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,10";
$result = $db->sql_query($sql);
for ($a = 1; $row = $db->sql_fetchrow($result); $a++) {
    $title2 = ereg_replace("_"," ", $row['title']);
    $transfertitle = str_replace(" ", "_", $row[title]);
    $popileeches .= "$a:<a href=\"modules.php?name=Downloads&amp;op=getit&amp;lid=$row[lid]\" title=\"$title2\">$title2</a><small><span style=\"color: #FF0000;\">&nbsp;[$row[hits] hits]</span></small><br />";
}
$content .= "</b> ]</center>";
$content  =  "<table border=\"0\" width=\"100%\">";
$content  .= "	<tr>";
$content  .= "		<td>";
$content  .= "		<table border=\"0\" width=\"100%\">";
$content  .= "			<tr>";
$content  .= "				<td align=\"left\"><img src=\"images/new_downloads.png\" align=\"bottom\" alt=\"New Downloads\"><a href=\"modules.php?name=Downloads&amp;d_op=NewDownloads\"><b>Newest Downloads</b></a></td>";
$content  .= "				<td align=\"left\"><img src=\"images/popular_downloads.png\" align=\"bottom\" alt=\"Top Downloads\"><a href=\"modules.php?name=Downloads&amp;d_op=MostPopular\"><b>Popular Downloads</b></a></td>";
$content  .= "			</tr>";
$content  .= "			<tr>";
$content  .= "				<td width=\"50%\">$newleeches</td>";
$content  .= "				<td width=\"50%\">$popileeches</td>";
$content  .= "			</tr>";
$content  .= "			<tr>";
$content  .= "				<td width=\"50%\"><b>Files available:</b> $files <b>Total Downloads: </b>$total_hits</td>";
$content  .= "				<td width=\"50%\"><b>Downloads Generated:</b> $mysizes of Traffic</td>";
$content  .= "			</tr>";
$content  .= "			<tr>";
$content  .= "				<td align=\"left\"><a href=\"newdownloads.php\" title=\"RSS New Downloads Feed\" target=\"_blank\"><img src=\"images/rss.gif\" align=\"middle\" alt=\"RSS New Downloads Feed\"></a></td>";
$content  .= "				<td align=\"left\"><a href=\"topdownloads.php\" title=\"RSS Popular Downloads Feed\" target=\"_blank\"><img src=\"images/rss.gif\" align=\"middle\" alt=\"RSS Popular Downloads Feed\"></a>&nbsp;<a href=\"modules.php?name=Downloads&d_op=AddDownload\" title=\"Submit Downloads\"><img src=\"images/submit_downloads.gif\" align=\"middle\" alt=\"Submit Downloads\"></a></td>";
$content  .= "			</tr>";
$content  .= "		</table>";
$content  .= "		</td>";
$content  .= "	</tr>";
$content  .= "</table>";
$content  .= "<p style=\"text-align:right; font-size:70%;\"><a href=\"http://www.clanthemes.com\" title=\"PHP Nuke\" target=\"_blank\" >PHP Nuke</a></p>";
?>