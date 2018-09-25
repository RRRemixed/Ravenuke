<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
function X1plugin_title($c){
	return "
    <table class='".X1plugin_title."' width='100%' border='0' cellspacing='1' cellpadding='6'>
        <tr>
            <td class='tcat'>
                $c
            </td>
        </tr>
    </table>";
}


function X1_clean($var, $mode=1){
	
	switch($mode){
		case 1:
			$var = utf8_decode($var);
			$var = strip_tags($var);
			$var = strtr($var, array('(' => '&#40;', ')' => '&#41;'));
			$var = htmlspecialchars($var);
		break;
		
		case 2:
			$var = utf8_decode($var);
			$var = strip_tags($var);
			$var = strtr($var, array('(' => '&#40;', ')' => '&#41;'));
		break;
		
		case 3:
			$var = utf8_decode($var);
			$var = strtr($var, array('(' => '&#40;', ')' => '&#41;'));
		break;
	}
	return $var;
	
}

function X1_edittime($t, $e=''){
    $i = getdate($t);
    $c = "<select name='month$e'>
        <option value='$i[mon]'>$i[month]</option>
        <option value='1'>January</option>
        <option value='2'>Febuary</option>
        <option value='3'>March</option>
        <option value='4'>April</option>
        <option value='5'>May</option>
        <option value='6'>June</option>
        <option value='7'>July</option>
        <option value='8'>August</option>
        <option value='9'>September</option>
        <option value='10'>October</option>
        <option value='11'>November</option>
        <option value='12'>December</option>
    </select>";
    $c .="<select name='day$e'>";
    $c .="<option value='$i[mday]'>$i[mday]</option>";
    for($a=1; $a < 32; $a++){
        $c .="<option value='$a'>$a</option>";
    }
    $c .="</select>";
    $c .="<select name='year$e'>";
    $c .="<option value='$i[year]'>$i[year]</option>";
    for($a=2006; $a < 2037; $a++){
        $c .="<option value='$a'>$a</option>";
    }
    $c .="</select>";
    $c .="<select name='hours$e'>";
    $c .="<option value='$i[hours]'>$i[hours]</option>";
    for($a=0; $a < 25; $a++){
        $c .="<option value='$a'>$a</option>";
    }
    $c .="</select>";
    $c .="<select name='mins$e'>";
    $c .="<option value='$i[minutes]'>$i[minutes]</option>";
    for($a=0; $a < 61; $a++){
        $c .="<option value='$a'>$a</option>";
    }
    $c .="</select>";
    return $c;
}


function X1_readtime($e=''){
	return date('U',mktime($_POST["hours$e"],$_POST["mins$e"], 0, $_POST["month$e"], $_POST["day$e"], $_POST["year$e"]));
}


function X1plugin_output($c='', $f=0){
	if($f==1)return $c;
	if($f==2)echo $c;
	if(X1_output=="echo"){
		echo $c;
	}else{
		return $c;
	}
}

function X1plugin_style(){
	if(X1_customstyle){
		return "<LINK REL='StyleSheet'  href='".X1_csspath."/style.css' type='text/css' media='screen' />";
	}
}

function X1plugin_email($addy, $template, $content, $subject=''){
	if(str_split(str_replace(".","",preg_replace("/[^0-9\.]+/","",phpversion())),3) > 430){
		$temp = @file_get_contents(X1_emailpath."/".$template);
	}else{
		$temp = implode("\n", file(X1_emailpath."/".$template));
	}
	if($temp){
		foreach($content AS $key=>$val){
			$temp = str_replace("<? $key ?>", $val, $temp);
		}
		$sub = (empty($subject)) ? X1_emailsubject : $subject;
		mail($addy, $sub, $temp,"From:".X1_returnmail."\nX-Mailer: PHP/" . phpversion());
		if(X1_emaildebug){
			return "Email sent to ".$addy;
		}
	}else{
		if(X1_emaildebug){
			return "Failed to load email template :: $template<br />\n";
		}
	}
}



function X1plugin_randid(){
	return mt_rand(1,99999999);
}



function X1plugin_linkback() {
	if(X1_showlinkback){
		if(X1_showversion)$ver = "<br />Version:".X1_release;
		return "
		<div align='".X1_lbalign."'>
			<a href='".X1_lblink."' target='_blank'><img src='".X1_imgpath."/linkback/".X1_lbimage."' border='0'/>$ver</a>
		</div>";
	}
}

function expire_challenges(){
   global $xdb;
   $rows = $xdb->GetAll("SELECT * FROM ".X1_prefix.X1_DB_teamtempchallenges);
   if($rows){
      foreach($rows AS $row){
         $event = $xdb->GetRow("
         SELECT expirechalls, expirehours, expirepen, expirebon, title
         FROM ".X1_prefix.X1_DB_events."
         WHERE sid=".$xdb->qstr($row['ladder_id']));
         if($event[1]){
            $expiretime = $row['date'] + ($event[2]*3600);
            if (time() > $expiretime){
               modifysql("delete from", X1_DB_teamtempchallenges, "
               WHERE randid=".$xdb->qstr($row['randid']));
               
               modifysql("UPDATE", X1_DB_teamsevents, "
               SET points=points + $event[4], challyesno ='No',
               challenged ='".XL_challenges_expired."'
               WHERE name=".$xdb->qstr($row['winner'])."
               AND ladder_id=".$xdb->qstr($event['sid']));
               
               modifysql("UPDATE", X1_DB_teamsevents, "
               SET points=points - $event[3], challyesno ='No',
               challenged ='".XL_challenges_expired."'
               WHERE name=".$xdb->qstr($row['loser'])."
               AND ladder_id=".$xdb->qstr($event['sid']));
               
               if (X1_emailon){
                  $challenger = $xdb->GetRow("SELECT mail
                  FROM ".X1_prefix.X1_DB_teams."
                  WHERE name=".$xdb->qstr($row['loser']));
                  $challenged = $xdb->GetRow("SELECT mail
                  FROM ".X1_prefix.X1_DB_teams."
                  WHERE name=".$xdb->qstr($row['winner']));
                  $content = array(
                     'team1' =>  $row['winner'],
                     'team2' =>  $row['loser'],
                     'event' => $event['title']
                     );
                  $c .= X1plugin_email($challenger["mail"], "expire_challenger.tpl", $content);
                  $c .= X1plugin_email($challenged["mail"], "expire_challenged.tpl", $content);
               }
            }
         }
      }
   }
} 

function doteamcookie($setteamid, $setteamname, $setpass) {
	$info = base64_encode("$setteamid:$setteamname:$setpass");
	if(X1_cookiemode==0){
		setcookie(X1_cookiename,"$info",time()+X1_cookietime);
	}elseif(X1_cookiemode==1){
		$jscript = 'function setCookie(name, value, expires, path, domain, secure) {
					  var curCookie = name + "=" + escape(value) +
						  ((expires) ? "; expires=" + expires : "") +
						  ((path) ? "; path=" + path : "") +
						  ((domain) ? "; domain=" + domain : "") +
						  ((secure) ? "; secure" : "");
					  document.cookie = curCookie;
					}';
		$time = time()+X1_cookietime;
		$c = "<script type='text/javascript'>
				$jscript
				setCookie('".X1_cookiename."', '$info', $time)
				</script>";
		return X1plugin_output($c);
	}else{
		return X1plugin_output("Configure cookie mode!!");
	}
}

function cookieread(){
	if(!isset($_COOKIE[X1_cookiename]))return false;
	$teamcookie = explode(":", base64_decode($_COOKIE[X1_cookiename]));
	if(isset($teamcookie[2])){
		$id=$teamcookie[0];
		$name=$teamcookie[1];
		$password = $teamcookie[2]; 
		return array($id, $name, $password);
	}
}

function checklogin() {
	global $xdb;
	if(!isset($_COOKIE[X1_cookiename]))return false;
	$teamcookie = explode(":", base64_decode($_COOKIE[X1_cookiename]));
	$cookie = X1_userdetails();
	if (empty($teamcookie[0]))return false;
	if (empty($teamcookie[1]))return false;
	if (empty($teamcookie[2]))return false;
	if(empty($cookie[0]))return false;
	if(empty($cookie[1]))return false;
	$row = $xdb->GetRow("
	SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id =".$xdb->qstr($teamcookie[0]));
    if(strtolower($teamcookie[1]) != strtolower($row['name']))return false;
    if($teamcookie[0] !=$row['team_id'])return false;
    return true;
}


function X1_setlogin($xteam=0){
	global $xdb;
	setcookie(X1_cookiename);
	$cookie = X1_userdetails();
	$row = $xdb->GetRow("
	SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE team_id =".$xdb->qstr($xteam));
	$rows = $xdb->GetAll("
	SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
	WHERE team_id =".$xdb->qstr($xteam)." 
	AND cocaptain=1;");
	$cocaps=array();
	if($rows)foreach($rows AS $cocap)$cocaps[] = $cocap['name'];
	if($cookie[1]==$row['playerone']){
		doteamcookie($row['team_id'], $row['name'], $row['passworddb']);
		return true;
	}elseif(in_array($cookie[1], $cocaps)){
		doteamcookie($row['team_id'], $row['name'], $row['passworddb']);
		return true;
	}else{
		return false;
	}
}

function modifysql($option, $table, $info){
	global $xdb;
	$result = $xdb->Execute("$option ".X1_prefix."$table $info"); 
}

function mapinfo($ladder_id, $mapid){
	global $xdb;
	$row = $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_maps." WHERE mapid = ".$xdb->qstr($mapid));
	return array ($row["mapname"], $row["mappic"], $row["mapdl"]);
}


function teamcontacticons($team){
	global $xdb;
	$row= $xdb->GetRow("SELECT * FROM ".X1_prefix.X1_DB_teams." 
	WHERE name=".$xdb->qstr($team));
	$member = $row["playerone"];
	$mail = $row["mail"];
	$homepage = $row["homepage"];
	$ircserver = $row["ircserver"];
	$ircchannel = $row["ircchannel"];
	$row = $xdb->GetRow("SELECT * FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersnamekey."=".$xdb->qstr($member));  
	$icq = $row[X1_DB_userseicqkey];
	$msn = $row[X1_DB_usersemsnkey];
	$aim = $row[X1_DB_userseaimkey];
	$yim = $row[X1_DB_userseyimkey];
	$maillink = (empty($mail)) ? '' : "<a href='mailto:$mail'>
	<img src='".X1_imgpath."/mail.gif' width='21' height='17' border='0' title='$mail'></a>";
	$icqlink  = (empty($irc)) ? '' : "<a href='http://wwp.icq.com/$icq#pager'>
	<img src='".X1_imgpath."/icq.gif' title='$icq' width='21' height='17' border='0'></a>";
	$msnlink = (empty($msn)) ? '' : "<a href='mailto:$msn'>
	<img src='".X1_imgpath."/msn.gif' title='$msn' width='21' height='17' border='0'></a>";
	$aimlink = (empty($aim)) ? '' : "<a href='aim:addbuddy?screenname=$msn'>
	<img src='".X1_imgpath."/aim.gif' title='$aim' width='17' height='17' border='0'></a>";
	$yimlink = (empty($yim)) ? '' : "<a href='ymsgr:addfriend?+$yim'>
	<img src='".X1_imgpath."/yahoo.gif' title='$yim' width='21' height='17' border='0'></a>";
	$weblink = (empty($homepage)) ? '' : "<a href='$homepage' target='_blank'>
	<img src='".X1_imgpath."/home.gif' width='21' height='17' border='0' title=$homepage></a>";
	$irclink =(empty($ircserver)) ? '' : "<a href='irc://$ircserver/$ircchannel'>
	<img src='".X1_imgpath."/mirc.gif' title='$ircserver / $ircchannel' width='21' height='17' border='0'></a>";
	return array($maillink, $msnlink, $icqlink, $aimlink, $yimlink, $weblink, $irclink);
}

function contacticons($member, $real_mail=0){
	global $xdb;
	$row = $xdb->GetRow("SELECT * FROM ".X1_userprefix.X1_DB_userstable." 
	WHERE ".X1_DB_usersnamekey."=".$xdb->qstr($member));  
	if($row[X1_DB_usersviewemailkey]){
		$mail = ($real_mail) ? $row[X1_DB_usersemailkey] : $row[X1_DB_usersfakeemailkey];
	}
	$homepage = $row[X1_DB_usersewebkey];
	$maillink = (empty($mail)) ? '' : "<a href='mailto:$mail'>
	<img src='".X1_imgpath."/mail.gif' width='21' height='17' border='0' title='$mail'></a>";
	$weblink = (empty($homepage)) ? '' : "<a href='$homepage' target='_blank'>
	<img src='".X1_imgpath."/home.gif' width='21' height='17' border='0' title=$homepage></a>";
	return array($maillink, "", "", "", "", $weblink, "");
}

if(!function_exists('str_split')){
   function str_split($string,$split_length=1){
       $count = strlen($string); 
       if($split_length < 1){
           return false; 
       } elseif($split_length > $count){
           return array($string);
       } else {
           $num = (int)ceil($count/$split_length); 
           $ret = array(); 
           for($i=0;$i<$num;$i++){ 
               $ret[] = substr($string,$i*$split_length,$split_length); 
           } 
           return $ret;
       }     
   } 
}

function X1_mapid2names($array){
	global $xdb;
	if(is_array($array)){
		$return = array();
		foreach($array AS $mapid){
			$result = $xdb->GetRow("
				SELECT mapname 
				FROM ".X1_prefix.X1_DB_maps." 
				WHERE mapid=".$xdb->qstr($mapid));
			$return[]=$result[0];
		}
		return $return;
	}else{
		return false;
	}
}
?>