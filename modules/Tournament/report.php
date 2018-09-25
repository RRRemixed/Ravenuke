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

$cookie[0] = intval($cookie[0]);
if ($cookie[1] != "") {
    $row = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
$submitter = $row['username'];
}else{
$submitter = "Not Registered";
}

$ip   = getenv('REMOTE_ADDR');
$date=date("m-d-y G:i:s");

OpenTable();
title("Report Match");

echo "<center>
<form action='modules.php?name=Tournament&file=submit-match&cmd=addmatch' method=post>
<table>
<tr>
<td><input type=hidden name=uname value='$submitter'></td>
<td><input type=hidden name=ip value='$ip'></td>
<td><input type=hidden name=date value='$date'></td>
</tr>
<tr>
<td align=left><b>Round:&nbsp</b></td>
<td align=right><select name=round>
<option value='Round 1'>Round 1</option>
<option value='Round 2'>Round 2</option>
<option value='Round 3'>Round 3</option>
<option value='Final Round'>Final Round</option></td>
</tr>
<tr>
<td align=left><b>Match:&nbsp</b></td>
<td align=right><select name=tmatch>
<option value='Match 1'>Match 1</option>
<option value='Match 2'>Match 2</option>
<option value='Match 3'>Match 3</option>
<option value='Match 4'>Match 4</option>
<option value='Match 5'>Match 5</option>
<option value='Match 6'>Match 6</option>
<option value='Match 7'>Match 7</option>
<option value='Match 8'>Match 8</option>
<option value='Final Match'>Final Match</option></td>
</tr>
<tr>
<td align=left><b>Winner:&nbsp</b></td>
<td align=right><select name=winner>";

$sql = "SELECT * FROM mpt_teams order by tname";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$winner=mysql_result($result,$i,"tname");
echo "<option value='$winner'>$winner</option>";

$i++;
}

echo "</select></td>
</tr>
<tr>
<td align=left><b>Loser:&nbsp</b></td>
<td align=right><select name=loser>";

$sql = "SELECT * FROM mpt_teams order by tname";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$loser=mysql_result($result,$i,"tname");
echo "<option value='$loser'>$loser</option>";
$i++;
}

echo "</select></td>
</tr>
<tr>
<td align=left><b>Comment:&nbsp</b></td>
<td align=right><textarea maxlength=20 name=comment></textarea></td>
</tr>
</table>
<hr width=200><input type=submit value=Submit><br><br>$submitter [$ip]
</form></center>";

CloseTable();

include("by.php");
include("footer.php");
?>
