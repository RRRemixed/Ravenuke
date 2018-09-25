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
title("Edit Settings");

?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditSettings">
<?

$mptnews = $_POST["mptnews"];
$mptrules = $_POST["mptrules"];
$currtourn = $_POST["currtourn"];
$nexttourn = $_POST["nexttourn"];
$prevtourn = $_POST["prevtourn"];
$currwin1 = $_POST["currwin1"];
$currwin2 = $_POST["currwin2"];
$currwin3 = $_POST["currwin3"];
$prevwin1 = $_POST["prevwin1"];
$prevwin2 = $_POST["prevwin2"];
$prevwin3 = $_POST["prevwin3"];
$nextinfo = $_POST["nextinfo"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_settings");
while($row=mysql_fetch_array($result))
 {
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

 }
}

if($_GET["cmd"]=="updatemptnews")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_settings SET mptnews = '$mptnews'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>News</b><br>has been updated!</center>";
}

if($_GET["cmd"]=="updatemptrules")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_settings SET mptrules = '$mptrules'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Rules</b><br>have been updated!</center>";
}

if($_GET["cmd"]=="updatecurrwin")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_settings SET currwin1 = '$currwin1', currwin2 = '$currwin2', currwin3 = '$currwin3'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Current Winners</b><br>have been updated!</center>";
}

if($_GET["cmd"]=="updateprevwin")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_settings SET prevwin1 = '$prevwin1', prevwin2 = '$prevwin2', prevwin3 = '$prevwin3'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Previous Winners</b><br>have been updated!</center>";
}

if($_GET["cmd"]=="updatetourneys")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_settings SET currtourn = '$currtourn', nexttourn = '$nexttourn', prevtourn = '$prevtourn', nextinfo = '$nextinfo'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Tournaments</b><br>have been updated!</center>";
}

CloseTable();

include("ver.php");
include("footer.php");
?>
