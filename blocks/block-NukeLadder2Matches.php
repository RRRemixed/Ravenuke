<?php
if (eregi("block-NukeLadder2Matches.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}

global $prefix, $db;
$module_name = "NukeLadder";

/*Upcoming Matches section of block*/
/*======================*/
$max="5";
$content = "<center>::Upcoming Matches::</center><br>";
$content .= "<table width=\"100%\" border=\"0\">";
$start="1";
$result = $db->sql_query("select winner, loser, matchdate, ladder_id from ".$prefix."_challengeteam");
while(list($winner, $loser, $matchdate, $ladder_id) = $db->sql_fetchrow($result)) {
	if (($matchdate >= time()) && ($max >= $start)){
		$content .= "
		<tr>
			<td align=\"left\">
				<big>&middot;</big>
				<a href=\"modules.php?name=$module_name&op=teamprofile&teamname=$winner\">$winner</a> 
				Vs 
				<a href=\"modules.php?name=$module_name&op=teamprofile&teamname=$loser\">$loser</a>
				<br/>
				<center>
				<a href=\"modules.php?name=$module_name&op=ladderhome&sid=$ladder_id\">(View Ladder)</center>
				<br />
			</td>
		</tr>";
		$start++;
	}
}
$content .= "</table>";


/*Results section of block*/
/*===============*/

$content .= "<center>::Recent Results::</center><br>";
$content .= "<table width=\"100%\" border=\"0\">";
$result = $db->sql_query("
select game_id, winner, loser, date, game_id, map1t1, map1t2, 
map2t1, map2t2, map3t1, map3t2, laddername 
from ".$prefix."_playedgames order by game_id DESC limit 5");

while(list($game_id, $winner, $loser, $date, $game_id, 
	$map1t1, $map1t2, $map2t1, $map2t2, 
	$map3t1, $map3t2, $laddername) = $db->sql_fetchrow($result)) {

	$scorewinner = array_sum(explode(",",$map1t1)) + array_sum (explode(",",$map2t1));
	$scoreloser = array_sum(explode(",",$map1t2)) + array_sum (explode(",",$map2t2));
	$date=date("m:d:Y", $date);
    $content .= "
	<tr>
		<td align=\"left\">
			<p>
				<big>&middot;</big>
				<a href=\"modules.php?name=$module_name&op=teamprofile&teamname=$winner\">$winner ($scorewinner)</a> 
				Vs 
				<a href=\"modules.php?name=$module_name&op=teamprofile&teamname=$loser\">$loser ($scoreloser)</a>
				<br/>
				&middot;$date<br/>
				<a href=\"modules.php?name=$module_name&op=matchdetails&game_id=$game_id\">(Details)</a>
				<br/>
			</p>
		</td>
	</tr>";
}
$content .= "</table>";
?>