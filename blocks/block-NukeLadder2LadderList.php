<?php
if (eregi("block-NukeLadder2LadderList.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}
function cut20($str,$max){ 
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
$result = $db->sql_query("select game, title, sid from ".$prefix."_ladders order by game DESC");
while(list($game, $title, $sid) = $db->sql_fetchrow($result)) {
$name2 = cut20($title,12);
$content .= "&middot;<a href=\"modules.php?name=$module_name&op=ladderhome&sid=$sid\">$name2</a><br>";
}
?>