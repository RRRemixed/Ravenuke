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
title("Matches");
echo "<table align=center width=100%>
<tr>
<td align=center width=4%><b>ID</b><hr></td>
<td align=center width=24%><b>Round/Match</b><hr></td>
<td align=center width=24%><b>Winner/Loser</b><hr></td>
<td align=center width=24%><b>Name/Date</b><hr></td>
<td align=center width=24%><b>Comment</b><hr></td>
</tr></table>";

$sql = "SELECT * FROM mpt_matches order by id DESC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$round=mysql_result($result,$i,"round");
$tmatch=mysql_result($result,$i,"tmatch");
$winner=mysql_result($result,$i,"winner");
$loser=mysql_result($result,$i,"loser");
$uname=mysql_result($result,$i,"uname");
$date=mysql_result($result,$i,"date");
$comment=mysql_result($result,$i,"comment");

echo "<table align=center width=100%><tr>
<td align=center width=4%>$id</td>
<td align=center width=24%>$round<br>$tmatch</td>
<td align=center width=24%>$winner<br>$loser</td>
<td align=center width=24%>$uname<br>$date</td>
<td align=center width=24%>$comment</td>
</tr>
</table><hr>";

$i++;
}
CloseTable();

include("by.php");
include("footer.php");
?>
