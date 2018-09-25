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
$date=date("m-d-y");

OpenTable();
title("Signup");
echo "<table align=center>
<form action='modules.php?name=Tournament&file=submit-team&cmd=addteam' method=post>
<tr>
<td><input type=text size=25 maxlength=25 name=tname value='Insert Team Name'></td>
<td><input type=hidden name=uname value='$submitter'></td>
<td><input type=hidden name=ip value='$ip'></td>
<td><input type=hidden name=date value='$date'></td>
<td><input type=submit value=Submit></td>
</tr>
</form>
</table>
<center>$submitter [$ip]</center>";
CloseTable();

include("by.php");
include("footer.php");
?>
