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
title("Edit Matches");

?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditMatches">
<?

$id = $_GET["id"];
$round = $_POST["round"];
$tmatch = $_POST["tmatch"];
$winner = $_POST["winner"];
$loser = $_POST["loser"];
$comment = $_POST["comment"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_matches");
while($row=mysql_fetch_array($result))
 {
$id = $row["id"];
$round = $row["round"];
$tmatch = $row["tmatch"];
$winner = $row["winner"];
$loser = $row["loser"];
$comment = $row["comment"];

 }
}

if($_GET["cmd"]=="deletematch")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM mpt_matches WHERE id='$id'";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center><b>Match ID# $id</b><br>has been deleted!</center>";
}

if($_GET["cmd"]=="updatematch")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_matches SET round='$round', tmatch='$tmatch', winner='$winner', loser='$loser', comment='$comment' WHERE id=$id";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Match ID# $id</b><br>has been updated!</center>";
}

if($_GET["cmd"]=="deletematches")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "DELETE FROM mpt_matches";
$sql = @mysql_query($query) or die('Could not delete: '.mysql_error());
echo "<center><b>All matches were deleted!<b></center>";
}

CloseTable();

include("ver.php");
include("footer.php");
?>
