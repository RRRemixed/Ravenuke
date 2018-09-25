<?php
/************************************************************************/
/* OFxVideo BLOCK v1.0 -         An addon Block for the PHP-Nuke Module */
/* =====================                                                */
/*  PHP-Nuke OFxVideo Block v1.0 for PHP-Nuke v6.5+                     */
/*  By Gregory "OFxLedzeplin" Jones OFxLedzeplin@OFxClan.com            */
/*  http://www.ofxgamer.com                                             */
/*                                                                      */
/* Use as you wish, please add these sites to your weblinks - PEACE     */
/* www.OFxGamer.com - www.OFxClan.com - www.OFxGaming.com               */
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 or a newer version.   */
/************************************************************************/
/* USAGE: Modify the settings in the User Edited Settings below.        */
/*        Save file, and upload to the blocks folder.                   */
/*        Proceed to Blocks Administration, to 'Add a New Block'.       */
/*        Type in the desired 'Title' for your block.                   */
/*        Select OFxVideo from 'filename' list, click 'Create Block'.   */
/************************************************************************/
/* BEGINNNING USER EDITED SETTINGS                                    */
/************************************************************************/

# This is basic selection instruction
$selection = "- Select Video -";

# Must be set to number of videos on list (maximum 10)
$num_videos=0;

# Set width and height the video should be displayed (must fit in block)
$vid_width = "140";
$vid_height = "105";

# Should controls be displayed?
$showcontrols = "1";  # 0 = no 1 = yes

# Should video start automatically?
# (Note: If showcontrols=0, autostart=1 by default irregardless)
$autostart = "1";  # 0 = no 1 = yes

# Video 1
$video1url="";
$video1title="";

# Video 2
$video2url="";
$video2title="";

# Video 3
$video3url="";
$video3title="";

# Video 4
$video4url="";
$video4title="";

# Video 5
$video5url="";
$video5title="";

# Video 6
$video6url="";
$video6title="";

# Video 7
$video7url="";
$video7title="";

# Video 8
$video8url="";
$video8title="";

# Video 9
$video9url="";
$video9title="";

# Video 10
$video10url="";
$video10title="";

/************************************************************************/
/* END USER EDITED SETTINGS                                             */
/* DO NOT EDIT BELOW UNLESS YOU KNOW WHAT YOUR DOING                    */
/************************************************************************/
if (eregi("block-OFxVideo.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}
if($num_videos!=0) {
$a=explode('&', $_SERVER["QUERY_STRING"]);
$i=0;
while ($i<count($a)){
	$b=split('=',$a[$i]);
       if(htmlspecialchars(urldecode($b[0]))=="videonum"){$videonum=htmlspecialchars(urldecode($b[1]));}
       $i++;
}
$ofxvideotitle = $video1title;
$ofxvideourl = $video1url;
if ($videonum=="1") {
	$ofxvideotitle = $video1title;
	$ofxvideourl = $video1url;
}
if ($videonum=="2") {
	$ofxvideotitle = $video2title;
	$ofxvideourl = $video2url;
}
if ($videonum=="3") {
	$ofxvideotitle = $video3title;
	$ofxvideourl = $video3url;
}
if ($videonum=="4") {
	$ofxvideotitle = $video4title;
	$ofxvideourl = $video4url;
}
if ($videonum=="5") {
	$ofxvideotitle = $video5title;
	$ofxvideourl = $video5url;
}
if ($videonum=="6") {
	$ofxvideotitle = $video6title;
	$ofxvideourl = $video6url;
}
if ($videonum=="7") {
	$ofxvideotitle = $video7title;
	$ofxvideourl = $video7url;
}
if ($videonum=="8") {
	$ofxvideotitle = $video8title;
	$ofxvideourl = $video8url;
}
if ($videonum=="9") {
	$ofxvideotitle = $video9title;
	$ofxvideourl = $video9url;
}
if ($videonum=="10") {
	$ofxvideotitle = $video10title;
	$ofxvideourl = $video10url;
}
if ($ofxvideourl == "") {
	$ofxvideotitle = $video1title;
	$ofxvideourl = $video1url;
}
if ($vid_width == "") { $vid_width = "150"; }
if ($vid_height == "") { $vid_height = "151"; }
if ($showcontrols=="0") { if ($autostart=="0") { $autostart="1"; } }
$content = "<table width=\"100%\" border=\"0\" cellspacing=\"7\" cellpadding=\"0\"><tr><td align=\"center\"><font size=\"1\" face=\"verdana\" color=\"#000000\">\n";
$content .= "<center>You are watching:<br>".$ofxvideotitle."</a><br><br>\n";
$content .= "<OBJECT ID='Player' HEIGHT='".$vid_height."' WIDTH='".$vid_width."' classid='CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95' codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112' standby='Loading Microsoft® Windows® Media Player components...' type='application/x-oleobject'>\n";
$content .= "   <PARAM NAME='Filename' value='".$ofxvideourl."'>\n";
if ($showcontrols == "1") { $content .= "   <PARAM NAME='ShowControls' VALUE='true'>\n"; } else { $content .= "   <PARAM NAME='ShowControls' VALUE='false'>\n"; }
$content .= "   <PARAM NAME='ShowStatusBar' VALUE='false'>\n";
if ($autostart == "1") { $content .= "   <PARAM NAME='Autostart' VALUE='true'>\n"; } else { $content .= "   <PARAM NAME='Autostart' VALUE='false'>\n"; }
$content .= "   <PARAM NAME='ShowPositionControls' value='False'>\n";
$content .= "   <PARAM NAME='ShowTracker' value='False'>\n";
$content .= "   <EMBED type='application/x-mplayer2' pluginspage = 'http://www.microsoft.com/Windows/MediaPlayer/' SRC='".$ofxvideourl."' name='Player' width='".$vid_width."' height='".$vid_height."'";
if ($autostart == "1") { $content .= "    AutoStart='true' "; } else { $content .= "    AutoStart='false' "; }
if ($showcontrols == "1") { $content .= "   	showcontrols='true' "; } else { $content .= "   	showcontrols='false' "; }
$content .= "    showstatusbar='' showdisplay=''></EMBED>\n";
$content .= "   <noembed><a href='".$ofxvideourl."'>Play ".$ofxvideotitle."</a></noembed>\n";
$content .= "</OBJECT><br><br><form name=\"form\" method=\"get\" action=\"\"><select name=\"videonum\" onchange=\"form.submit()\">\n";
$content .= "<option value=\"1\">".$selection."</option>\n";
if ($num_videos >= "1") { $content .= "<OPTION VALUE=\"1\">".$video1title."</option>\n"; }
if ($num_videos >= "2") { $content .= "<OPTION VALUE=\"2\">".$video2title."</option>\n"; }
if ($num_videos >= "3") { $content .= "<OPTION VALUE=\"3\">".$video3title."</option>\n"; }
if ($num_videos >= "4") { $content .= "<OPTION VALUE=\"4\">".$video4title."</option>\n"; }
if ($num_videos >= "5") { $content .= "<OPTION VALUE=\"5\">".$video5title."</option>\n"; }
if ($num_videos >= "6") { $content .= "<OPTION VALUE=\"6\">".$video6title."</option>\n"; }
if ($num_videos >= "7") { $content .= "<OPTION VALUE=\"7\">".$video7title."</option>\n"; }
if ($num_videos >= "8") { $content .= "<OPTION VALUE=\"8\">".$video8title."</option>\n"; }
if ($num_videos >= "9") { $content .= "<OPTION VALUE=\"9\">".$video9title."</option>\n"; }
if ($num_videos == "10") { $content .= "<OPTION VALUE=\"10\">".$video10title."</option>\n"; }
$content .= "</select></form></center></font></td></tr></table>\n";
} else {
$content =  "<center><br><br>";
$content .= "No Videos<br><br>";
$content .= "are<br><br>";
$content .= "Queued<br><br>";
}
?>