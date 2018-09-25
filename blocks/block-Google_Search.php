<?php

if (eregi("block-Google_Block.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}
$content  =  "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/ flash/swflash.cab#version=6,0,29,0\" width=\"350\" height=\"100\">";
$content  .= "<param name=\"movie\" value=\"Google.swf\">";
$content  .= "<param name=quality value=high>";
$content  .= "<embed src=\"Google.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"160\" height=\"120\">";
$content  .= "</embed>";
$content  .= "</object>";
?>