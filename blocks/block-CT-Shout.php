<?php
/************************************************************/
/* CTShout Block - For PHP-Nuke                             */
/* By: Admin (admin@clan-themes.co.uk)                      */
/* http://www.clanthemes.com                                */
/* Copyright © 2009 by Clan Themes                          */
/************************************************************/
if (eregi("block-CT-Shout.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $ThemeSel;

if (file_exists("themes/$ThemeSel/images/CTShout.swf")) {
$content  =  "<div align=\"center\">\n";
$content  .=  " <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"170\" height=\"330\"> ";
$content  .= " <param name=\"movie\" value=\"themes/$ThemeSel/images/CTShout.swf\" /> ";
$content  .= " <param name=\"quality\" value=\"high\" /> ";
$content  .= " <param name=\"wmode\" value=\"transparent\" />";
$content  .= " <param name=\"menu\" value=\"false\" /> ";
$content  .= " <param name=\"swfversion\" value=\"8.0.35.0\" /> ";
$content  .= " <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. --> ";
$content  .= " <param name=\"expressinstall\" value=\"themes/$ThemeSel/style/expressInstall.swf\" /> ";
$content  .= " <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --> ";
$content  .= " <!--[if !IE]>--> ";
$content  .= " <object type=\"application/x-shockwave-flash\" data=\"themes/$ThemeSel/images/CTShout.swf\" width=\"170\" height=\"330\"> ";
$content  .= "   <!--<![endif]--> ";
$content  .= "   <param name=\"quality\" value=\"high\" /> ";
$content  .= "   <param name=\"wmode\" value=\"transparent\" />";
$content  .= "<param name=\"menu\" value=\"false\" /> ";
$content  .= "   <param name=\"swfversion\" value=\"8.0.35.0\" /> ";
$content  .= "   <param name=\"expressinstall\" value=\"themes/$ThemeSel/style/expressInstall.swf\" /> ";
$content  .= "   <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. --> ";
$content  .= "   <div> ";
$content  .= "     <h4>Content on this page requires a newer version of Adobe Flash Player.</h4> ";
$content  .= "     <p><a href=\"http://www.adobe.com/go/getflashplayer\"><img src=\"http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif\" alt=\"Get Adobe Flash player\" width=\"112\" height=\"33\" /></a></p> ";
$content  .= "   </div> ";
$content  .= "   <!--[if !IE]>--> ";
$content  .= " </object> ";
$content  .= " <!--<![endif]--> ";
$content  .= "</object>";
$content  .= "</div>";
} else {
$content  =  "<div align=\"center\" style=\"color:#FF0000;\">\n";
$content  .=  "Make sure you have uploaded the purchased themes 'images' folder correctly to themes/$ThemeSel/images/ <br />it wont work other wise !";
$content  .= "</div>";	
}

?>