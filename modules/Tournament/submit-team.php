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
<meta http-equiv="REFRESH" content="3;url=modules.php?name=Tournament&file=teams">
<?

$uname = $_POST["uname"];
$ip = $_POST["ip"];
$date = $_POST["date"];
$tname = $_POST["tname"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_teams");
while($row=mysql_fetch_array($result))
 {
$uname = $row['uname'];
$ip = $row['ip'];
$date = $row['date'];
$tname = $row['tname'];
 }
}

if($_GET["cmd"]=="addteam")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "INSERT INTO mpt_teams VALUES ('','$tname','$uname','$ip','$date')";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
title("Signup");
echo "<center><b>$tname</b><br>have been signed up<center>";
}

CloseTable();

include("by.php");
include("footer.php");
?>
