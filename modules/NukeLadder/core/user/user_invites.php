<?php
#################################################################
#X1plugin Competition Management
#Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
function sendinvite() {
    #Db
	global $xdb;
	#Make sure logged in
	if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
	#List info
    list ($cookieteamid, $team, $password) = cookieread();
	#create a random id
    $randid = X1plugin_randid();
    $row = $xdb->GetRow("
    SELECT * FROM ".X1_userprefix.X1_DB_userstable."
    WHERE ".X1_DB_usersidkey."=".$xdb->qstr(X1_clean($_POST['user_id'])));
    $email = $row[X1_DB_usersemailkey];
    $result = $xdb->GetAll("
    SELECT * FROM ".X1_prefix.X1_DB_teamroster."
    WHERE name=".$xdb->qstr(X1_clean($row[X1_DB_usersnamekey])));
    if (count($result) >= X1_maxjoin)return X1plugin_output($c .= displayteam("invites", XL_teaminvites_limit));
    $result = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teamroster."
    WHERE name =".$xdb->qstr(X1_clean($row[X1_DB_usersnamekey]))." 
	AND team_id =".$xdb->qstr(X1_clean($cookieteamid)) );
	if($result)return X1plugin_output($c .= displayteam("invites", XL_teaminvites_allreadyonroster));
	$row = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teams."
    WHERE team_id = ".$xdb->qstr($_POST['team_id']));
    $team = $row["name"];
	$row = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teaminvites."
    WHERE team_id = ".$xdb->qstr(X1_clean($_POST['team_id']))." 
	AND uid = ".$xdb->qstr(X1_clean($_POST['user_id'])));
	if($row)return X1plugin_output($c .= displayteam("invites", XL_teaminvites_allreadyinvited));
    $string = ereg_replace(' ','+', $team);
    if (X1_emailon){
      $content = array('team' =>  $team,
                        'link' => X1_url.X1_publicgetfile."?".X1_linkactionoperator."=confirminvite",
                        'date' => $matchdate,
                        'event' => $laddername,
                        'code' => $randid
                        );
        $c .= X1plugin_email($email, "sendinvite.tpl", $content);
    }
    modifysql("INSERT INTO", X1_DB_teaminvites, "(uid, team_id, randid)
    VALUES (
	".$xdb->qstr(X1_clean($_POST['user_id'])).",
	".$xdb->qstr(X1_clean($_POST['team_id'])).",
	".$xdb->qstr(X1_clean($randid))."
	)");
    return X1plugin_output(displayteam("invites", XL_teaminvites_sent));
}

function confirminvite() {
      global $xdb;
      $c  = X1plugin_style();
      $c .= X1plugin_title(XL_teaminvites_title);
      $c .= "
      <table class='".X1plugin_mapslist."' width='100%'>
          <thead class='".X1plugin_tablehead."'>
              <tr>
                <td>".XL_teaminvites_enterid."</td>
              </tr>
          </thead>
          <tbody class='".X1plugin_tablebody."'>
              <tr>
                  <td>
                      <form method='post' action='".X1_publicpostfile."' style='".X1_formstyle."'>
                      <input type='text' name='randid' value=''>
                      <select name='".X1_actionoperator."'>
                      <option value='acceptinvite'>".XL_teaminvites_accept."</option>
                      <option value='declineinvite'>".XL_teaminvites_decline."</option>
                      </select>
                      <input type='Submit' name='Submit' value='".XL_teaminvites_button."' >
                      </form>
                  </td>
              </tr>
          </tbody>
          <tfoot class='".X1plugin_tablefoot."'>
              <tr>
                <td>&nbsp;</td>
              </tr>
          </tfoot>
      </table>";
    return X1plugin_output($c);
}

function acceptinvite(){
    global $xdb;
    $c = X1plugin_style();
    $invite = $xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teaminvites."
    WHERE randid = ".$xdb->qstr(X1_clean($_REQUEST['randid'])));
	if (!$invite){
        $c .= XL_teaminvites_none;
    }else{
		$ui = $xdb->GetRow("
		SELECT * FROM ".X1_userprefix.X1_DB_userstable."
		WHERE ".X1_DB_usersidkey."=".$xdb->qstr(X1_clean($invite["uid"])));
		$usermail = $ui[X1_DB_usersemailkey];
		$username = $ui[X1_DB_usersnamekey];
		$uid = $ui[X1_DB_usersidkey];
        $result = $xdb->GetAll("
        SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
        WHERE name = ".$xdb->qstr(X1_clean($username)));
		$result2 = $xdb->GetAll("
		SELECT * FROM ".X1_prefix.X1_DB_teamroster." 
		WHERE name = ".$xdb->qstr(X1_clean($username))." 
		AND team_id=".$xdb->qstr(X1_clean($invite["team_id"])));
        if (count($result) >= X1_maxjoin){
            $c .= XL_teaminvites_youlimit;
            return X1plugin_output($c);
		}elseif(count($result2) >= 1){
		    $c .= XL_teaminvites_allready;
            return X1plugin_output($c); 
        }else{
            $team=$xdb->GetRow("
            SELECT * FROM ".X1_prefix.X1_DB_teams." 
            WHERE team_id = ".$xdb->qstr(X1_clean($invite["team_id"])));
            $teamname = $team["name"];
            $xdb->Execute("
            DELETE FROM ".X1_prefix.X1_DB_teamroster."
            WHERE uid = '0' OR uid=''");
            $joindate = time();
            modifysql("INSERT INTO ", X1_DB_teamroster, "(uid, team_id, name, mail, steamid, joindate)
            VALUES (
			".$xdb->qstr(X1_clean($uid)).", 
			".$xdb->qstr(X1_clean($team['team_id'])).", 
			".$xdb->qstr(X1_clean($username)).", 
			".$xdb->qstr(X1_clean($usermail)).", 
			".$xdb->qstr('none').", 
			".$xdb->qstr(time()).")");
            modifysql("DELETE FROM", X1_DB_teaminvites, " 
			WHERE randid = ".$xdb->qstr(X1_clean($_POST['randid'])));
            $c .= X1plugin_title(XL_teaminvites_accepted);
        }
    }
return X1plugin_output($c);
}

function declineinvite() {
  global $xdb;
  $c .= X1plugin_style();
    $row=$xdb->GetRow("
    SELECT * FROM ".X1_prefix.X1_DB_teaminvites."
    WHERE randid = ".$xdb->qstr(X1_clean($_POST['randid'])));
    if (!$row){
        $c .= X1plugin_title(XL_teaminvites_none);
    }else {
        modifysql("DELETE FROM", X1_DB_teaminvites, " 
		WHERE randid = ".$xdb->qstr(X1_clean($_POST['randid'])));
        $c .= X1plugin_title(XL_teaminvites_declined);
    }
    return X1plugin_output($c);
}

function removeinvite() {
    global $xdb;
    $c  = X1plugin_style();
    if(!checklogin())return X1plugin_output($c .= X1plugin_title(XL_notlogggedin));
    list ($cookieteamid, $team, $teampass) = cookieread();
    modifysql("delete from", X1_DB_teaminvites, " 
	WHERE randid=".$xdb->qstr(X1_clean($_POST['randid'])));
    return X1plugin_output(displayteam("invites", XL_teaminvites_removed));
}
?>