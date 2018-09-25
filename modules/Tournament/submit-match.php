<?

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

include("config.php");
include("header.php");
include("mptmenu.php");
$index=1;

OpenTable();

?>
<meta http-equiv="REFRESH" content="3;url=modules.php?name=Tournament&file=matches">
<?

$round = $_POST["round"];
$tmatch = $_POST["tmatch"];
$uname = $_POST["uname"];
$ip = $_POST["ip"];
$winner = $_POST["winner"];
$loser = $_POST["loser"];
$comment = $_POST["comment"];
$date = $_POST["date"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_matches");
while($row=mysql_fetch_array($result))
 {
$round = $row['round'];
$tmatch = $row['tmatch'];
$uname = $row['uname'];
$ip = $row['ip'];
$winner = $row['winner'];
$loser = $row['loser'];
$comment = $row['comment'];
$date = $row['date'];
 }
}

if($_GET["cmd"]=="addmatch")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "INSERT INTO mpt_matches VALUES ('','$round','$tmatch','$uname','$ip','$winner','$loser','$comment','$date')";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
title("Report Match");
echo "<center><b>$round-$tmatch</b><br>has been reported<center>";
}

CloseTable();

include("by.php");
include("footer.php");
?>

