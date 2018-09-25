<?php

if (eregi("block-CT-COD_BO_Countdown.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}
$content  =  "<div align=\"center\">\n";
$content  .=  '<object codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="510" height="225" id="countdown">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="http://countdownpage.createyourcountdown.com/?filename=0000gtcd9b5fadaff06d15a37f81c4663b0a7f26_100505191600" />
<param name="quality" value="high" />
<param name="wmode" value="transparent">
<embed src="http://countdownpage.createyourcountdown.com/?filename=0000gtcd9b5fadaff06d15a37f81c4663b0a7f26_100505191600"  name="countdown" width="510" height="225" wmode="transparent" allowScriptAccess="sameDomain" allowFullScreen="false"  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0"/></object>';
$content  .= "</div>";
?>