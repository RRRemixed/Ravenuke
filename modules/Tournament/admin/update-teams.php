<?

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }

include("header.php");
include("mptamenu.php");

OpenTable();
title("Edit Teams");

?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditTeams">
<?

$id = $_GET["id"];
$tname = $_POST["tname"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_bracket");
while($row=mysql_fetch_array($result))
 {
$id = $row['id'];
$tname = $row['tname'];

 }
}

if($_GET["cmd"]=="deleteteam")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM mpt_teams WHERE id='$id'";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center><b>$tname ID# $id</b><br>has been deleted!</center>";
}

if($_GET["cmd"]=="updateteam")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_teams SET tname = '$tname' WHERE id='$id'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>$tname ID# $id</b><br>has been updated!</center>";
}

if($_GET["cmd"]=="deleteteams")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM mpt_teams";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center><b>All teams have been deleted!</b></center>";
}

CloseTable();

include("ver.php");
include("footer.php");
?>
