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
title("Edit Teams");
echo"<table><tr>
<td width=5><b>ID</b></td>
<td width=100><b>Submitter</b></td>
<td width=100><b>IP Address</b></td>
<td width=150><b>Date&Time</b></td>
<td width=100><b>Team Name</b></td>
</tr></table>";

$sql = "SELECT * FROM mpt_teams ORDER BY id DESC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$tname=mysql_result($result,$i,"tname");
$uname=mysql_result($result,$i,"uname");
$ip=mysql_result($result,$i,"ip");
$date=mysql_result($result,$i,"date");

echo "<hr><table>
<tr>
<td width=5>$id</td>
<td width=100>$uname</td>
<td width=100>$ip</td>
<td width=150>$date</td>
<form action=admin.php?op=UpdateTeam&cmd=updateteam&id=$id method=post>
<td width=100><input type=text name=tname value='$tname'></td>
<td width=10><input type=Submit value=Update></td>
</form>
<form action=admin.php?op=DeleteTeam&cmd=deleteteam&id=$id method=post>
<td width=10><input type=Submit value=Delete></td>
</form>
</tr></table>";

$i++;
}

echo "<hr><table align=right>
<tr>
<form action=admin.php?op=DeleteTeams&cmd=deleteteams method=post>
<td align=center><input type=Submit value='Delete All Teams'></td>
</form>
</tr>
</table>";

CloseTable();

include("ver.php");
include("footer.php");
?>
