<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
include("mptmenu.php");
$index=1;

OpenTable();
title("Teams");

echo "<table align=center width=75%>
<tr>
<td align=center width=50%><b>Team</b><hr></td>
<td align=center width=50%><b>Joined</b><hr></td>
</tr></table>";

$sql = "SELECT * FROM mpt_teams order by date ASC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$tname=mysql_result($result,$i,"tname");
$date=mysql_result($result,$i,"date");

echo "<table align=center width=75%><tr>
<td align=center width=50%>$tname</td>
<td align=center width=50%>$date</td>
</tr>
</table>";

$i++;
}

CloseTable();

include("by.php");
include("footer.php");
?>
