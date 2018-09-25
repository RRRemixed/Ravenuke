<?php
/************************************************************************/
/* CT XML Block
/* http://www.clanthemes.com
/* Copyright © 2009
/************************************************************************/
if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
$content  =  "<div align=\"center\">\n";
$content  .=  " <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"530\" height=\"330\"> ";
$content  .= " <param name=\"movie\" value=\"includes/clanthemes_xml_block/XML_Banner.swf\" /> ";
$content  .= " <param name=\"quality\" value=\"high\" /> ";
$content  .= " <param name=\"wmode\" value=\"transparent\" />";
$content  .= " <param name=\"menu\" value=\"false\" /> ";
$content  .= " <param name=\"swfversion\" value=\"8.0.35.0\" /> ";
$content  .= " <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. --> ";
$content  .= " <param name=\"expressinstall\" value=\"themes/COD_Black_Ops/style/expressInstall.swf\" /> ";
$content  .= " <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> ";
$content  .= " <!--[if !IE]>--> ";
$content  .= " <object type=\"application/x-shockwave-flash\" data=\"includes/clanthemes_xml_block/XML_Banner.swf\" width=\"530\" height=\"330\"> ";
$content  .= "   <!--<![endif]--> ";
$content  .= "   <param name=\"quality\" value=\"high\" /> ";
$content  .= "   <param name=\"wmode\" value=\"transparent\" />";
$content  .= "<param name=\"menu\" value=\"false\" /> ";
$content  .= "   <param name=\"swfversion\" value=\"8.0.35.0\" /> ";
$content  .= "   <param name=\"expressinstall\" value=\"themes/COD_Black_Ops/style/expressInstall.swf\" /> ";
$content  .= "   <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. --> ";
$content  .= "   <div> ";
$content  .= "     <h4>Content on this page requires a newer version of Adobe Flash Player.</h4> ";
$content  .= "     <p><a href=\"http://www.adobe.com/go/getflashplayer\"><img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" width=\"120\" height=\"88\" /></a></p> ";
$content  .= "   </div> ";
$content  .= "   <!--[if !IE]>--> ";
$content  .= " </object> ";
$content  .= " <!--<![endif]--> ";
$content  .= "</object>";
$content  .= "</div>";
?>