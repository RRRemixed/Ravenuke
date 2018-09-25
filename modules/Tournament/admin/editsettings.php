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

$row = $db->sql_fetchrow($db->sql_query("SELECT * FROM mpt_settings"));
$mptnews = $row['mptnews'];
$mptrules = $row['mptrules'];
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
title("Edit Settings");
echo "
<table align=center width=75%>
<tr>
<td align=center><b>Change the News</b><hr width=75%>
<form action=admin.php?op=UpdateMPTNews&cmd=updatemptnews method=post>
<textarea cols=50 rows=15 name=mptnews>$mptnews</textarea><br>
<input type=Submit value=Update></form>
</td>
<td align=center><b>Change the Rules</b><hr width=75%>
<form action=admin.php?op=UpdateMPTRules&cmd=updatemptrules method=post>
<textarea cols=50 rows=15 name=mptrules>$mptrules</textarea><br>
<input type=Submit value=Update></form>
</td>
</tr>
</table>
<table align=center width=75%>
<tr>
<td align=center><b>Previous Winners</b><hr width=75%>
<form action=admin.php?op=UpdatePrevwin&cmd=updateprevwin method=post>
1st Place<br><input type=text name=prevwin1 value='$prevwin1'><br><br>
2nd Place<br><input type=text name=prevwin2 value='$prevwin2'><br><br>
3rd Place<br><input type=text name=prevwin3 value='$prevwin3'><br><br>
<input type=Submit value=Update></form><br>&nbsp<br>&nbsp<br>&nbsp
</td>
<td align=center><b>Change Tournaments</b><hr width=75%>
<form action=admin.php?op=UpdateTourneys&cmd=updatetourneys method=post>
Current Tournament<br><input type=text name=currtourn value='$currtourn'><br><br>
Next Tournament<br><input type=text name=nexttourn value='$nexttourn'><br><br>
Previous Tournament<br><input type=text name=prevtourn value='$prevtourn'><br><br>
Next Tournament Info<br><textarea name=nextinfo>$nextinfo</textarea><br><br>
<input type=Submit value=Update></form>
</td>
<td align=center><b>Current Winners</b><hr width=75%>
<form action=admin.php?op=UpdateCurrwin&cmd=updatecurrwin method=post>
1st Place<br><input type=text name=currwin1 value='$currwin1'><br><br>
2nd Place<br><input type=text name=currwin2 value='$currwin2'><br><br>
3rd Place<br><input type=text name=currwin3 value='$currwin3'><br><br>
<input type=Submit value=Update></form><br>&nbsp<br>&nbsp<br>&nbsp
</td>
</tr>
</table>";

CloseTable();

include("ver.php");
include("footer.php");
?>
