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

include ("mainfile.php");
global $prefix, $db, $nukeurl;
header ("Content-Type: text/xml");

$result = $db->sql_query("SELECT lid, title, hits FROM ".$prefix."_downloads_downloads ORDER BY hits DESC LIMIT 0,10");

$btitle ="$sitename - Top Downloads";

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n\n";
echo "<!DOCTYPE rss PUBLIC \"-//Netscape Communications//DTD RSS 0.91//EN\"\n";
echo " \"http://my.netscape.com/publish/formats/rss-0.91.dtd\">\n\n";
echo "<rss version=\"0.91\">\n\n";
echo "<channel>\n";
echo "<title>".htmlspecialchars($sitename)."</title>\n";
echo "<link>$nukeurl</link>\n";
echo "<description>".htmlspecialchars($btitle)."</description>\n";
echo "<language>$backend_language</language>\n\n";

while ($row = $db->sql_fetchrow($result)) {
 	$title2 = ereg_replace("_"," ", $row['title']);
    $transfertitle = str_replace(" ", "_", $row[title]);
    echo "<item>\n";
    echo "<title>".htmlspecialchars($title2)."</title>\n";
    echo "<link>$nukeurl/modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$row[lid]</link>\n";
    echo "</item>\n\n";
}

echo "</channel>\n";
echo "</rss>";

?>