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
title("Edit Bracket");

?>
<meta http-equiv="REFRESH" content="3;url=admin.php?op=EditBracket">
<?

$r1t1 = $_POST["r1t1"];
$r1t2 = $_POST["r1t2"];
$r1t3 = $_POST["r1t3"];
$r1t4 = $_POST["r1t4"];
$r1t5 = $_POST["r1t5"];
$r1t6 = $_POST["r1t6"];
$r1t7 = $_POST["r1t7"];
$r1t8 = $_POST["r1t8"];
$r1t9 = $_POST["r1t9"];
$r1t10 = $_POST["r1t10"];
$r1t11 = $_POST["r1t11"];
$r1t12 = $_POST["r1t12"];
$r1t13 = $_POST["r1t13"];
$r1t14 = $_POST["r1t14"];
$r1t15 = $_POST["r1t15"];
$r1t16 = $_POST["r1t16"];
$r2t1 = $_POST["r2t1"];
$r2t2 = $_POST["r2t2"];
$r2t3 = $_POST["r2t3"];
$r2t4 = $_POST["r2t4"];
$r2t5 = $_POST["r2t5"];
$r2t6 = $_POST["r2t6"];
$r2t7 = $_POST["r2t7"];
$r2t8 = $_POST["r2t8"];
$r3t1 = $_POST["r3t1"];
$r3t2 = $_POST["r3t2"];
$r3t3 = $_POST["r3t3"];
$r3t4 = $_POST["r3t4"];
$r4t1 = $_POST["r4t1"];
$r4t2 = $_POST["r4t2"];

$cmd = $_GET["cmd"];

if(!isset($cmd))
{
$result = mysql_query("select * from mpt_bracket");
while($row=mysql_fetch_array($result))
 {
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

 }
}

if($_GET["cmd"]=="updatebracket")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_bracket SET r1t1 = '$r1t1', r1t2 = '$r1t2', r1t3 = '$r1t3', r1t4 = '$r1t4', r1t5 = '$r1t5', r1t6 = '$r1t6', r1t7 = '$r1t7', r1t8 = '$r1t8', r1t9 = '$r1t9', r1t10 = '$r1t10', r1t11 = '$r1t11', r1t12 = '$r1t12', r1t13 = '$r1t13', r1t14 = '$r1t14', r1t15 = '$r1t15', r1t16 = '$r1t16', r2t1 = '$r2t1', r2t2 = '$r2t2', r2t3 = '$r2t3', r2t4 = '$r2t4', r2t5 = '$r2t5', r2t6 = '$r2t6', r2t7 = '$r2t7', r2t8 = '$r2t8', r3t1 = '$r3t1', r3t2 = '$r3t2', r3t3 = '$r3t3', r3t4 = '$r3t4', r4t1 = '$r4t1', r4t2 = '$r4t2'";
$sql = @mysql_query($query) or die('Could not update: '.mysql_error());
echo "<center><b>Bracket</b><br>has been updated!<center>";
}

if($_GET["cmd"]=="clearbracket")
{
$serverid = mysql_connect($dbhost, $dbuname, $dbpass) or die ("Cannot connect to database!");
if (!mysql_select_db($dbname)) {
    echo mysql_error($serverid);
}
$query = "UPDATE mpt_bracket SET r1t1 = '', r1t2 = '', r1t3 = '', r1t4 = '', r1t5 = '', r1t6 = '', r1t7 = '', r1t8 = '', r1t9 = '', r1t10 = '', r1t11 = '', r1t12 = '', r1t13 = '', r1t14 = '', r1t15 = '', r1t16 = '', r2t1 = '', r2t2 = '', r2t3 = '', r2t4 = '', r2t5 = '', r2t6 = '', r2t7 = '', r2t8 = '', r3t1 = '', r3t2 = '', r3t3 = '', r3t4 = '', r4t1 = '', r4t2 = ''";
$sql = @mysql_query($query) or die('Could not clear: '.mysql_error());
echo "<center><b>Bracket</b><br>has been cleared!</center>";
}

CloseTable();

include("ver.php");
include("footer.php");
?>
