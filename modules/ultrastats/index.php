<?php
/************************************************************************/
/* UNOFFICIAL UltraStats Module v1.0					*/
/* =================================					*/
/* by RevBubba http://fragoholics.net					*/
/* UltraStats by DeltaRay and Zak - built on VODstats skeleton by CJ	*/
/* DEMO - http://www.fragoholics.net/modules.php?name=ultrastats1/	*/
/* DISTRIBUTION: v1.00a 09/07/04 - INITIAL RELEASE (*iframe version*)	*/
/************************************************************************/
if (!eregi("modules.php", $PHP_SELF)) {
   die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
/* DO NOT CHANGE THE '$index = 0;' BELOW!!! */
$index = 0;
OpenTable();
/* EDIT THE NEXT 4 LINES TO FIT YOUR SERVERNAME, FONTCOLORS, AND FILEPATH */
echo"      <h1 align=\"center\"><font size=\"4\" color=\"#000000\">YOUR SERVER NAME HERE<br></font></h1>"
  . "      <h1 align=\"center\"><font size=\"4\" color=\"#CC0000\">PLAYER STATS<br></font></h1>"
  . "      <iframe align=\"center\" src=\"modules/ultrastats/web/content/index.php\" scrolling=\"auto\" width=\"100%\" height=\"800\" frameborder=\"0\">Your browser doesn't support IFRAMES</iframe><br>" 
  . "      <h1 align=\"center\"><font size=\"3\" color=\"#000000\">If this page does not appear correctly, click <a target=\"_blank\" href=\"modules/ultrastats/web/content/index.php\"><font size=\"3\" color=\"CC0000\">HERE</a><font color=\"#000000\">.</font></font><br></h1>";
CloseTable();
include("footer.php");
?>