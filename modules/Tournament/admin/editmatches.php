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
title("Edit Matches");

echo"<table align=center width=98%><tr>
<td align=left width=3%><b>ID</b></td>
<td align=center width=20%><b>Match</b></td>
<td align=left width=25%><b>Teams</b></td>
<td align=left width=15%><b>Submitter</b></td>
<td align=left width=11%><b>Date</b></td>
<td align=left width=20%><b>Comments</b></td>
<td align=left width=10%>&nbsp</td>
</tr></table>";

$sql = "SELECT * FROM mpt_matches ORDER BY id DESC";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$round=mysql_result($result,$i,"round");
$tmatch=mysql_result($result,$i,"tmatch");
$uname=mysql_result($result,$i,"uname");
$ip=mysql_result($result,$i,"ip");
$date=mysql_result($result,$i,"date");
$winner=mysql_result($result,$i,"winner");
$loser=mysql_result($result,$i,"loser");
$comment=mysql_result($result,$i,"comment");

echo "<hr><table align=center width=98%>
<form action=admin.php?op=UpdateMatch&cmd=updatematch&id=$id method=post>
<tr>
<td align=left width=3%>$id</td>
<td align=right width=20%>
<select name=round><option value='$round'>*$round*</option>
<option value='Round 1'>Round 1</option><option value='Round 2'>Round 2</option>
<option value='Round 3'>Round 3</option><option value='Final Round'>Final Round</option>
</select>
<br>
<select name=tmatch><option value='$tmatch'>*$tmatch*&nbsp</option>
<option value='Match 1'>Match 1</option><option value='Match 2'>Match 2</option>
<option value='Match 3'>Match 3</option><option value='Match 4'>Match 4</option>
<option value='Match 5'>Match 5</option><option value='Match 6'>Match 6</option>
<option value='Match 7'>Match 7</option><option value='Match 8'>Match 8</option>
<option value='Final Match'>Final Match</option>
</select>
</td>
<td width=25%><input type=text name=winner value='$winner'><br><br><input type=text name=loser value='$loser'></td>
<td align=center width=15%>$uname<br><br>$ip</td>
<td align=center width=10%>$date</td>
<td width=20%><textarea name=comment>$comment</textarea></td>
<td align=center width=10%><input type=Submit value=Update></form>
<form action=admin.php?op=DeleteMatch&cmd=deletematch&id=$id method=post>
<input type=Submit value=Delete></td>
</form>
</tr></table>";

$i++;
}

echo "<hr><table align=right>
<tr>
<form action=admin.php?op=DeleteMatches&cmd=deletematches method=post>
<td align=center><input type=Submit value='Delete All Matches'></td>
</form>
</tr>
</table>";
CloseTable();

include("ver.php");
include("footer.php");
?>
