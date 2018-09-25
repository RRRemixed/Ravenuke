<?php
###################################################
###	PND Content & News Block v1.0			###
###	Coded By Astalavista-BD				###
###	http://phpnuke-downloads.com			###
###	March 13th 2006					###
###	Copyright © 2005-2006 PHPNuke-Downloads	###
###	All Rights Reserved.				###
###								###
###################################################


if (eregi("block-PND_Content_&_News.php", $_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}

global $prefix, $db, $multilingual, $currentlang ;

$sql = "SELECT pid, title, counter FROM ".$prefix."_pages ORDER BY pid DESC LIMIT 0,10";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	$counter = $row[counter];
 	$transfertitle = str_replace(" ", "_", $row[title]);
    $CONTENT .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Content&pa=showpage&pid=$row[pid]\" title=\"$row[title]\">$row[title]</a> [$counter "._READS."]<br>";
}


$sql = "SELECT sid, title, comments, counter FROM ".$prefix."_stories $querylang ORDER BY sid DESC LIMIT 0,10";
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
    $sid = $row['sid'];
    $title = $row[title];
    $comtotal = $row[comments];
    $counter = $row[counter];
    $NEWS .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=News&file=article&sid=$row[sid]\" title=\"$title\">$title</a> [$counter "._READS."]<br>";
}


$content  .=  "<table border=\"0\" width=\"100%\" id=\"table1\" cellpadding=\"0\" cellspacing=\"0\" align=\"left\">";
$content  .= "	<tr>";
$content  .= "		<td>";
$content  .= "		<table border=\"0\" width=\"100%\" id=\"table2\" align=\"left\">";
$content  .= "			<tr align=\"left\" valign=\"middle\">";
$content  .= "				<td align=\"left\"><img src=\"images/content_block.jpg\" align=\"bottom\" alt=\"Article\">&nbsp;<b>Latest Content</b></td>";
$content  .= "				<td align=\"left\"><img src=\"images/news_block.jpg\" align=\"bottom\" alt=\"News\">&nbsp;<b>Latest News</b></td>";
$content  .= "			</tr>";
$content  .= "			<tr align=\"left\" valign=\"middle\">";
$content  .= "				<td width=\"50%\">$CONTENT</td>";
$content  .= "				<td width=\"50%\">$NEWS</td>";
$content  .= "			</tr>";
$content  .= "			<tr align=\"left\" valign=\"middle\">";
$content  .= "				<td valign=\"middle\" align=\"left\"><a href=\"newarticles.php\" title=\"RSS Content Feed\"><img src=\"images/rss.gif\" alt=\"RSS Content Feed\" align=\"middle\"></a></td>";
$content  .= "				<td valign=\"middle\" align=\"left\"><a href=\"backend.php\" title=\"RSS News Feed\"><img src=\"images/rss.gif\" alt=\"RSS News Feed\" align=\"middle\"></a>&nbsp;<a href=\"modules.php?name=Submit_News\" title=\"Submit News\"><img src=\"images/submit_news.gif\" align=\"middle\" alt=\"Submit News\"></a></td>";
$content  .= "			</tr>";
$content  .= "		</table>";
$content  .= "		</td>";
$content  .= "	</tr>";
$content  .= "</table>";


?>