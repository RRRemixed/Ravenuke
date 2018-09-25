<?php

if (!defined('BLOCK_FILE')) {
    Header("Location: ../index.php");
    die();
}

$WEBSITEURL="http://digital.mindz.free.fr/";	### full website url [no slash "/" at the end]
$WIDTH="370";				#### width of the player. Incase if you want to use it as a side block
$HEIGHT="180";				#### height of the player. Incase you have lots of mp3 in the list
$BACKCOLOR="000000";		#### Basic background color BEHIND the player
$BACKGROUNDCOLOR="000000";	#### player background color
$FONTCOLOR="12809C";	#### player fonts color
$LIGHTCOLOR="12809C";	#### player's light color
$SHUFFLE="false"; 		#### "true"  if you want to shuffle your song
$AUTOSTART="false"; 		#### "false" if you do not want auto start of music
$SHOWDIGITS="true"; 	#### Song timer. "true" will how timer, "false" will not
$VOLUME="100"; 			#### 1-100 100=maximum 1=minimum

$content  =  "<div align=\"center\">";
$content  .= "	<embed src=\"$WEBSITEURL/mp3player/mp3player.swf\" width=\"$WIDTH\" height=\"$HEIGHT\" bgcolor=\"$BACKCOLOR\" type=\"application/x-shockwave-flash\" ";
$content  .= "	flashvars=\"file=$WEBSITEURL/mp3player/list.xml&showdigits=$SHOWDIGITS&autostart=$AUTOSTART&showeq=true&volume=$VOLUME&repeat=list&shuffle=$SHUFFLE&lightcolor=0x$LIGHTCOLOR&backcolor=0x$BACKGROUNDCOLOR&frontcolor=0x$FONTCOLOR\" />";
$content  .= "</div>";
?>
