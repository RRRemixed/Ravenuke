<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

title("Tournament Admin");

OpenTable();
echo "<hr width=75%><table align=center width=75%>
<tr>
<td align=center width=20%><a href=admin.php?op=TournamentMain>Main</a></td>
<td align=center width=20%><a href=admin.php?op=EditSettings>Edit Settings</a></td>
<td align=center width=20%><a href=admin.php?op=EditTeams>Edit Teams</a></td>
<td align=center width=20%><a href=admin.php?op=EditMatches>Edit Matches</a></td>
<td align=center width=20%><a href=admin.php?op=EditBracket>Edit Bracket</a></td>
</tr></table><hr width=75%>
";
CloseTable();

?>
