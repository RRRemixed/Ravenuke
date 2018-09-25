<?php

####################################################################### 
# Block for PHP-Nuke 
#------------------------- 
# HTTP Video Stream Latest 10
#------------------------- 
#
# Version 1.0
# Copyright (c) 2005 by:
# Brady
# http://www.scottswebsite.co.uk
#
#  
# Shows Latest 10 videos posted to the module HTTP_Video_Stream
#
######################################################################


if (eregi("block-HTTP_Video_Stream.php",$_SERVER['PHP_SELF'])) { 
    Header("Location: ../index.php"); 
    die();
}


global $db, $prefix, $currentlang;

if ($currentlang) {
	if (file_exists("modules/Video_Stream/lang-block/lang-$currentlang.php")) { 
		include_once("modules/Video_Stream/lang-block/lang-$currentlang.php");
	} else {
		include_once("modules/Video_Stream/lang-block/lang-english.php");
	}
} else {
	include_once("modules/Video_Stream/lang-block/lang-english.php");
}

$settings = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$srow = $db->sql_fetchrow($settings);
$ratingshow = $srow['ratingV'];

$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream WHERE request=0 ORDER BY id DESC LIMIT 0,10");
$content = "<marquee behavior='scroll' direction='up' height='200'scrollamount='2' scrolldelay='20' onmouseover='this.stop()' onmouseout='this.start()'>";
while($row = $db->sql_fetchrow($result)) {
$content .= "<a href=\"modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."\">".$row['vidname']."</a><br>";
$content .= "<p>"._BBY.": ".$row['user']."<br>";
$date = $row['date'];
$date = substr($date, 9);
$content .= ""._BBON.": ".$date."<br>";
$content .= ""._BVIEWS.": ".$row['views']."";
if ($ratingshow = 1) {
	$content .= "<br>"._BRATING.": ".@number_format(($row['rating'] / $row['rates']), 2)." "._BTVOTES.": ".$row['rates']."";
}
$content .= "</p>";
}
$content .= "</marquee>";


?>