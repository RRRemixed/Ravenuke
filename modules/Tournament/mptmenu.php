<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

title("$sitename - Tournament");

$mainlink="name=Tournament";

OpenTable();
echo "<hr width=75%><table align=center width=75%>
<tr>
<td align=center width=12.5%><a href=modules.php?name=Tournament>Main</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=rules>Rules</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=bracket>Bracket</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=teams>Teams</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=signup>Signup</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=matches>Matches</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=report>Report</a></td>
<td align=center width=12.5%><a href=modules.php?name=Tournament&file=winners>Winners</a></td>
</tr></table><hr width=75%>
";
CloseTable();

?>
