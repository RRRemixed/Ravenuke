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

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM mpt_settings"));
$currtourn = $row['currtourn'];
$nexttourn = $row['nexttourn'];
$prevtourn = $row['prevtourn'];
$currwin1 = $row['currwin1'];
$currwin2 = $row['currwin2'];
$currwin3 = $row['currwin3'];
$prevwin1 = $row['prevwin1'];
$prevwin2 = $row['prevwin2'];
$prevwin3 = $row['prevwin3'];
$nextinfo = $row['nextinfo'];

OpenTable();
title("Winners");

echo "<table align=center width=75%>
<tr>
<td align=center width=33%><b>Previous Tournament</b><hr></td>
<td align=center width=33%><b>Current Tournament</b><hr></td>
<td align=center width=33%><b>Upcoming Tournament</b><hr></td>
</tr>
<tr>
<td align=center width=33%>$prevtourn<hr></td>
<td align=center width=33%>$currtourn<hr></td>
<td align=center width=33%>$nexttourn<hr></td>
</tr>
<tr>
<td align=left width=33%><b>1st:&nbsp</b>$prevwin1</td>
<td align=left width=33%><b>1st:&nbsp</b>$currwin1</td>
<td align=center width=33%>$nextinfo</td>
</tr>
<tr>
<td align=left width=33%><b>2nd:&nbsp</b>$prevwin2</td>
<td align=left width=33%><b>2nd:&nbsp</b>$currwin2</td>
</tr>
<tr>
<td align=left width=33%><b>3rd:&nbsp</b>$prevwin3</td>
<td align=left width=33%><b>3rd:&nbsp</b>$currwin3</td>
</tr>
</table>";

CloseTable();

include("by.php");
include("footer.php");
?>
