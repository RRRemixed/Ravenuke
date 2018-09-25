<?php
if (eregi("block-NukeLadder2NewTeams.php", $_SERVER['SCRIPT_NAME'])) {
    Header("Location: index.php");
    die();
}
function cut5($str,$max){ 
$count = strlen($str); 
if($count >= $max) { 
for ($pos=$max;$pos>0 && ord($str[$pos-1])>=127;$pos--); 
if (($max-$pos)%2 == 0) 
$str = substr($str, 0, $max) . "..."; 
else 
$str = substr($str, 0, $max+1) . "..."; 
return $str;
} 
else { 
$str = "$str"; 
return $str;
} 
}
global $prefix, $multilingual, $currentlang, $db, $nukeurl;
$module_name = "NukeLadder";
if ($multilingual == 1) {
    $querylang = "WHERE (alanguage='$currentlang' OR alanguage='')";
} else {
    $querylang = "";
}
$content = "<table width=\"100%\" border=\"0\">";
$result = $db->sql_query("select team_id, name, country from ".$prefix."_teams order by team_id DESC limit 0,10");
while(list($team_id, $name, $country) = $db->sql_fetchrow($result)){
$name2 = cut5($name,12);
    $content .= "
<tr>
	<td align=\"left\">
		<strong><big>&middot;</big></strong>
		<img src='modules/$module_name/images/flags/$country.bmp' border='0' align='absmiddle'>&nbsp;
		<a href=\"modules.php?name=$module_name&op=teamprofile&teamname=$name\">
			$name2
		</a>
	</td>
</tr>";
}
$content .= "</table>";
$content .= "<br><center>[ <a href=\"modules.php?name=$module_name&op=teamlist\">".More."</a> ]</center>";
?>