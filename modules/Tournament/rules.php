<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright � 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
include("mptmenu.php");
$index=1;

$row = $db->sql_fetchrow($db->sql_query("SELECT mptrules FROM mpt_settings"));
$mptrules = $row['mptrules'];

OpenTable();
title("Rules");
echo "$mptrules";
CloseTable();

include("by.php");
include("footer.php");
?>
