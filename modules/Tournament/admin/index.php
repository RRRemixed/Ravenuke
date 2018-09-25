<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
include("mptamenu.php");
$index=1;

OpenTable();
title("Tournament Admin Main");

OpenTable();
echo "<center><b>Editing the News & Rules</b><br><br>To edit the news and rules you will need to know atleast some basic html codes. If you don't know any at all just do a search on google for basic html codes.</center>";
CloseTable();
OpenTable();
echo "<center><b>Editing the Bracket</b><br><br>When you edit the bracket you edit the whole thing at once. I didn't include drop down menus because, alot of times i find brackets using team tags instead of the full name. I also wanted to use text fields so it would match the theme of your site.</center>";
CloseTable();
OpenTable();
echo "<center><b>Problems, Suggestions or Bugs</b><br><br>This is a pretty simple module and i havn't found any bugs. This is only the second module i have ever put together and i plan on adding to it. If you have any problems or suggestions feel free to email me them <a href=mailto:cablemp@insightbb.com>cablemp@insightbb.com</a> or visit my site at <a href=http://geocities.com/majorplaying>geocities.com/majorplaying</a></center>";
CloseTable();

CloseTable();
GraphicAdmin();

include("ver.php");
include("footer.php");
?>
