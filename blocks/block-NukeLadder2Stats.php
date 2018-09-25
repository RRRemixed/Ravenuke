<?php
if (eregi("block-NukeLadder2Stats.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $multilingual, $currentlang, $db;

if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = "";
}
$sql="SELECT * FROM ".$prefix."_games";
$result= $db->sql_query($sql);
$numgames = $db->sql_numrows($result);
$sql="SELECT * FROM ".$prefix."_ladders";
$result= $db->sql_query($sql);
$numladder = $db->sql_numrows($result);
$sql="SELECT * FROM ".$prefix."_laddermaplist";
$result= $db->sql_query($sql);
$nummaps = $db->sql_numrows($result);
$sql="SELECT * FROM ".$prefix."_teams";
$result= $db->sql_query($sql);
$numteams = $db->sql_numrows($result);
$sql="SELECT * FROM ".$prefix."_userteams";
$result= $db->sql_query($sql);
$numplayers = $db->sql_numrows($result);
$sql="SELECT * FROM ".$prefix."_playedgames";
$result= $db->sql_query($sql);
$nummatches = $db->sql_numrows($result);
	
$content = "
<li>($numgames) Total Games
<li>($numladder) Total Ladders
<li>($numteams) Total Teams
<li>($numplayers) Total Players
<li>($nummatches) Total Matches
<li>($nummaps) Total Maps
";
?>
