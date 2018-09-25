<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

require_once("mainfile.php");
include("header.php");
include("mptamenu.php");
$index=1;

OpenTable();
title("Edit Bracket");

echo "<table align=center><form><tr><td><b>Team List: </b><select>";
$sql = "SELECT * FROM mpt_teams order by tname";
$result = $db->sql_query($sql);
$num=mysql_numrows($result);
$i=0;
while ($i < $num) {
$id=mysql_result($result,$i,"id");
$tname=mysql_result($result,$i,"tname");
echo "<option>$tname</option>";

$i++;
}

echo "</select></td></tr></form></table>";

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM mpt_bracket"));
$r1t1 = $row['r1t1'];
$r1t2 = $row['r1t2'];
$r1t3 = $row['r1t3'];
$r1t4 = $row['r1t4'];
$r1t5 = $row['r1t5'];
$r1t6 = $row['r1t6'];
$r1t7 = $row['r1t7'];
$r1t8 = $row['r1t8'];
$r1t9 = $row['r1t9'];
$r1t10 = $row['r1t10'];
$r1t11 = $row['r1t11'];
$r1t12 = $row['r1t12'];
$r1t13 = $row['r1t13'];
$r1t14 = $row['r1t14'];
$r1t15 = $row['r1t15'];
$r1t16 = $row['r1t16'];
$r2t1 = $row['r2t1'];
$r2t2 = $row['r2t2'];
$r2t3 = $row['r2t3'];
$r2t4 = $row['r2t4'];
$r2t5 = $row['r2t5'];
$r2t6 = $row['r2t6'];
$r2t7 = $row['r2t7'];
$r2t8 = $row['r2t8'];
$r3t1 = $row['r3t1'];
$r3t2 = $row['r3t2'];
$r3t3 = $row['r3t3'];
$r3t4 = $row['r3t4'];
$r4t1 = $row['r4t1'];
$r4t2 = $row['r4t2'];

echo "<form action=admin.php?op=UpdateBracket&cmd=updatebracket method=post><table>
<tr>
       <td><div align=center><b>Round 1</b><hr></div></td>
       <td></td>
       <td><div align=center><b>Round 2</b><hr></div></td>
       <td></td>
       <td><div align=center><b>Round 3</b><hr></div></td>
       <td></td>
       <td><div align=center><b>Final Round</b><hr></div></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 1</div><INPUT type=text NAME=r1t1 WIDTH=25 VALUE='$r1t1'><br><INPUT type=text NAME=r1t2 VALUE='$r1t2'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td><div align=center>Match 1</div><INPUT type=text NAME=r2t1 VALUE='$r2t1'><br><INPUT type=text NAME=r2t2 VALUE='$r2t2'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 2</div><INPUT type=text NAME=r1t3 VALUE='$r1t3'><br><INPUT type=text NAME=r1t4 VALUE='$r1t4'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td><div align=center>Match 1</div><INPUT type=text NAME=r3t1 VALUE='$r3t1'><br><INPUT type=text NAME=r3t2 VALUE='$r3t2'></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 3</div><INPUT type=text NAME=r1t5 VALUE='$r1t5'><br><INPUT type=text NAME=r1t6 VALUE='$r1t6'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td><div align=center>Match 2</div><INPUT type=text NAME=r2t3 VALUE='$r2t3'><br><INPUT type=text NAME=r2t4 VALUE='$r2t4'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 4</div><INPUT type=text NAME=r1t7 VALUE='$r1t7'><br><INPUT type=text NAME=r1t8 VALUE='$r1t8'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td><div align=center>Final Match</div><INPUT type=text NAME=r4t1 VALUE='$r4t1'><br><INPUT type=text NAME=r4t2 VALUE='$r4t2'></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 5</div><INPUT type=text NAME=r1t9 VALUE='$r1t9'><br><INPUT type=text NAME=r1t10 VALUE='$r1t10'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td><div align=center>Match 3</div><INPUT type=text NAME=r2t5 VALUE='$r2t5'><br><INPUT type=text NAME=r2t6 VALUE='$r2t6'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 6</div><INPUT type=text NAME=r1t11 1 VALUE='$r1t11'><br><INPUT type=text NAME=r1t12 VALUE='$r1t12'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td><div align=center>Match 2</div><INPUT type=text NAME=r3t3 VALUE='$r3t3'><br><INPUT type=text NAME=r3t4 VALUE='$r3t4'></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Match 7</div><INPUT type=text NAME=r1t13 VALUE='$r1t13'><br><INPUT type=text NAME=r1t14 VALUE='$r1t14'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td></td>
       <td></td>
       <td><div align=center>Match 4</div><INPUT type=text NAME=r2t7 VALUE='$r2t7'><br><INPUT type=text NAME=r2t8 VALUE='$r2t8'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td><div align=center>Game 8</div><INPUT type=text NAME=r1t15 VALUE='$r1t15'><br><INPUT type=text NAME=r1t16 VALUE='$r1t16'></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
</tr>
<tr>
       <td align=center><hr><input type=Submit value=Update></form><form action=admin.php?op=ClearBracket&cmd=clearbracket method=post><input type=Submit value=Clear></form></td>
</tr>
</table></form>";

CloseTable();

include("ver.php");
include("footer.php");
?>
