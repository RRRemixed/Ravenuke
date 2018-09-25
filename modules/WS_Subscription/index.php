<?php
/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*               ..::WS Subscription::..                        */
/****************************************************************/

if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$pagetitle ="Subscribe";
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("includes/cleaninput.class.php");
/**********************************/
$index = 0;
/**********************************/
	   //check user name
	   function userCheck($username2, $user_email) {
    global $stop, $user_prefix, $db;
    if ((!$user_email) || ($user_email=="") || (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$user_email))) $stop = "<center>"._ERRORINVEMAIL."</center><br>";
    if (strrpos($user_email,' ') > 0) $stop = "<center>"._ERROREMAILSPACES."</center>";
    if ((!$username2) || ($username2=="") || (ereg("[^a-zA-Z0-9_-]",$username2))) $stop = "<center>"._ERRORINVNICK."</center><br>";
    if (strlen($username2) > 25) $stop = "<center>"._NICK2LONG."</center>";
    if (eregi("^((root)|(adm)|(linux)|(webmaster)|(admin)|(god)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anónimo)|(operator))$",$username2)) $stop = "<center>"._NAMERESERVED."</center>";
    if (strrpos($username2,' ') > 0) $stop = "<center>"._NICKNOSPACES."</center>";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE username='$username2'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users_temp WHERE username='$username2'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users_temp WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br>";
    return($stop);
	}
//END
function Subtext(){
global $module_name;
OpenTable();
echo "<center><a href='modules.php?name=WS_Subscription'>"._WSSMAIN."</a>  |  <a href='modules.php?name=WS_Subscription&ws=SubPlans'>"._WSPLANS."</a>  |  <a href='modules.php?name=WS_Subscription&ws=tos'>"._WSTOS."</a><br><br><img src='modules/$module_name/images/cards.gif' border='0'><img src='modules/$module_name/images/payp.gif' border='0'></center>";
CloseTable();
}
function SubTop(){
global $module_name, $ws;
OpenTable();
if($ws ==""){
echo "<center><span id=\"alImg6\" style=\"width:218px;height:92px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/submain.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/submain.png\" width=\"218\" height=\"92\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="SubPlans"){
echo "<center><span id=\"alImg7\" style=\"width:175px;height:101px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/subplans.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/subplans.png\" width=\"175\" height=\"101\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="tos"){
echo "<center><span id=\"alImg8\" style=\"width:95px;height:97px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/subtos.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/subtos.png\" width=\"95\" height=\"97\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="trial_userdetails"){
echo "<center><span id=\"alImg9\" style=\"width:95px;height:95px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/userlog.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/userlog.png\" width=\"95\" height=\"95\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="userdetails"){
echo "<center><span id=\"alImg10\" style=\"width:95px;height:95px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/userlog.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/userlog.png\" width=\"95\" height=\"95\" border=\"0\" alt=\"\"></span></center>";
}

CloseTable();
echo "<br>";
}

function Subscribe(){
include("header.php");
SubTop();
OpenTable();
include("subtext.txt");
CloseTable();
echo "<br>";
Subtext();
include("footer.php");
}

function SubPlans(){
global $prefix, $db, $cookie, $user, $bgcolor1, $bgcolor2;
include("header.php");
 cookiedecode($user);
 $wsuserid = $cookie[0];
 $wsuserid1 = $cookie[1];
SubTop();
list($wsnsngrsc) = $db->sql_fetchrow($db->sql_query("SELECT ws_nsn FROM ".$prefix."_ws_subconfig"));
if($wsnsngrsc !=0){
$gthan ="AND ws_nsngr>=0";
}
else{
$gthan ="AND ws_nsngr=0";
}
$result = $db->sql_query("select ws_id, sub_name, sub_description, sub_cost, wsn, wsp, sub_enabled, ws_img, ws_nsngr, ws_trial, ws_trial_dmy,  ws_trial_lgth from ".$prefix."_ws_subscription WHERE sub_enabled='checked' $gthan ORDER BY ws_weight ASC");
	while(list($ws_id, $sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $ws_img, $ws_nsngr, $ws_trial, $ws_trial_dmy, $ws_trial_lgth) = $db->sql_fetchrow($result)) {
	
	OpenTable();
	?>
	<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="<? echo"".$bgcolor1.""; ?>">
	<tr><th height="20"></th><th align="center"><? echo"<b>"._WSSUBNAME."</b>"; ?></th><th><? echo"<b>"._WSSUBDESC."</b>"; ?></th><th><? echo"<b>"._WSSUBCOST."</b>"; ?></th><th><? echo"<b>"._WSSUBPERIOD."</b>"; ?></th><th></th></tr>
	<tr><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "<img src='$ws_img' border='0'>"; ?></td><td width="20%" valign="top" align="center" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "<b>$sub_name</b>"; ?></td><td width="55%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$sub_description"; ?></td><td width="5%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo ""._CURR."$sub_cost"; ?></td><td width="10%" align="center" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$wsn $wsp(s)"; ?></td>
	<?
	if(is_user($user)){
	?>
	<td width="10%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>">
	<form action="paypal.php" method="post" target="_self">
	<? 
    echo ' <input type="hidden" name="amount" value="'.$sub_cost.'">';
	echo ' <input type="hidden" name="quantity" value="1">';
	echo ' <input type="hidden" name="item_name" value="'.$sub_name.'">';
	echo ' <input type="hidden" name="item_number" value="'.$wsuserid.'">';
	echo ' <input type="hidden" name="period" value="'.$wsp.'">';
	echo ' <input type="hidden" name="wsperiod" value="'.$wsn.'">'; 
	echo ' <input type="hidden" name="ws_nsngr" value="'.$ws_nsngr.'">'; 
	echo '<input type="hidden" name="no_shipping" value="1">';
	echo "<input type=\"image\" src=\"modules/WS_Subscription/images/subscr.gif\" border=\"0\" style=\"border:0px\">"; 
	?>
	</form>
	<?
	echo "<br>";
	if($ws_trial !=0){
	$trialform = '<form action="modules.php?name=WS_Subscription&ws=trial" method="post" target="_self">';
	$trialform .= ' <input type="hidden" name="trial_username" value="'.$wsuserid1.'">';//usrname
	$trialform .= ' <input type="hidden" name="trial_user" value="'.$wsuserid.'">'; //userid
	$trialform .= ' <input type="hidden" name="trial_period1" value="'.$ws_trial_lgth.'">'; //trial number
	$trialform .= ' <input type="hidden" name="trial_period2" value="'.$ws_trial_dmy.'">';  ///trial month, days, year..
	$trialform .= ' <input type="hidden" name="trial_groupid" value="'.$ws_nsngr.'">'; 
	$trialform .= "<input class=button type=\"image\" src=\"modules/WS_Subscription/images/freetrial.gif\" border=\"0\" style=\"border:0px;\">";
	$trialform .= "</form>";
	echo $trialform; 
	}
	
	
	?></td>
	<?
	}
	else{
	list($ws_usersup) = $db->sql_fetchrow($db->sql_query("SELECT  ws_usersup FROM ".$prefix."_ws_subconfig"));
	if($ws_usersup == 1){
	?>
	<td width="10%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>">
	<form action="modules.php?name=WS_Subscription&ws=userdetails" method="post" target="_self">
	<? 
    echo ' <input type="hidden" name="amount" value="'.$sub_cost.'">';
	echo ' <input type="hidden" name="quantity" value="1">';
	echo ' <input type="hidden" name="item_name" value="'.$sub_name.'">';
	//echo ' <input type="hidden" name="item_number" value="'.$wsuserid.'">';
	echo ' <input type="hidden" name="period" value="'.$wsp.'">';
	echo ' <input type="hidden" name="wsperiod" value="'.$wsn.'">'; 
	echo ' <input type="hidden" name="ws_nsngr" value="'.$ws_nsngr.'">'; 
	echo '<input type="hidden" name="no_shipping" value="1">';
	echo "<input class=button type=\"image\" src=\"modules/WS_Subscription/images/subscr.gif\" border=\"0\" style=\"border:0px\">"; 
	?>
	</form>
	<?
	echo "<br>";
	if($ws_trial !=0){
	$trialform = '<form action="modules.php?name=WS_Subscription&ws=trial_userdetails" method="post" target="_self">';
	$trialform .= ' <input type="hidden" name="trial_period1" value="'.$ws_trial_lgth.'">'; //trial number
	$trialform .= ' <input type="hidden" name="trial_period2" value="'.$ws_trial_dmy.'">';  ///trial month, days, year..
	$trialform .= ' <input type="hidden" name="trial_groupid" value="'.$ws_nsngr.'">'; 
	$trialform .= "<input class=button type=\"image\" src=\"modules/WS_Subscription/images/freetrial.gif\" border=\"0\" style=\"border:0px;\">";
	$trialform .= "</form>";
	echo $trialform; 
	}
	
	
	?></td>
	<?
	} else{
	?>
	<td width="10%" valign="middle" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "<a href='modules.php?name=Your_Account'><img src=\"modules/WS_Subscription/images/nouser.gif\" border=\"0\" title='"._WSLOGTXT."' ></a>"; ?></td>
	<?
	}
	}
	?>
	</tr>
	</table>
	
	<?
	CloseTable();
	echo "<br>";
	}
	Subtext();
include("footer.php");
}
function userdetails(){
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;
$amount = requestUtils::getRequestObject('amount');
$quantity = requestUtils::getRequestObject('quantity');
$item_name = requestUtils::getRequestObject('item_name');
//$item_number = requestUtils::getRequestObject('item_number');
$period = requestUtils::getRequestObject('period');
$wsperiod = requestUtils::getRequestObject('wsperiod');
$ws_nsngr = requestUtils::getRequestObject('ws_nsngr');
$no_shipping = requestUtils::getRequestObject('no_shipping');
include("header.php");
SubTop();
OpenTable();
	echo "<form action=\"paypal.php\" method=\"post\">\n"
	    ."<table cellpadding=\"1\" cellspacing=\"1\" border=\"0\" width='80%' align='center' bgcolor='$bgcolor1'>\n"
		."<tr><th colspan='2'>"._WSREG."</th></tr>"
	    ."<tr><td bgcolor='$bgcolor2' width='35%'>"._WSNICKNAME.":</td><td bgcolor='$bgcolor2'><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"25\"></td></tr>\n"
    	    ."<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td bgcolor='$bgcolor2'><input type=\"text\" name=\"user_email\" size=\"30\" maxlength=\"255\"></td></tr>\n"
	    ."<tr><td bgcolor='$bgcolor2'>"._WSPASSWORD.":</td><td bgcolor='$bgcolor2'><input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"40\"></td></tr>\n"
	    ."<tr><td bgcolor='$bgcolor2'>"._WSRETYPEPASSWORD.":</td><td bgcolor='$bgcolor2'><input type=\"password\" name=\"user_password2\" size=\"11\" maxlength=\"40\"></td></tr>\n";
	if (extension_loaded("gd") AND ($gfx_chk == 3 OR $gfx_chk == 4 OR $gfx_chk == 6 OR $gfx_chk == 7)) {
	    echo "<tr><td bgcolor='$bgcolor2'>"._SECURITYCODE.":</td><td bgcolor='$bgcolor2'><img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>\n"
	        ."<tr><td bgcolor='$bgcolor2'>"._TYPESECCODE.":</td><td bgcolor='$bgcolor2'><input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\"></td></tr>\n"
	        ."<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">\n";
	}
	echo "</td></tr></table>\n";
?>
<br>
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSREGA.""; ?></b></th></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" width="35%"><?= ""._WSNICKNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsusername" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSPASSWORD.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wspass" size="25"></td></tr><tr><td colspan="2">
<input type="hidden" name="amount" value="<?= "".$amount.""; ?>">
<input type="hidden" name="quantity" value="<?= "".$quantity.""; ?>">
<input type="hidden" name="item_name" value="<?= "".$item_name.""; ?>">

<input type="hidden" name="period" value="<?= "".$period.""; ?>">
<input type="hidden" name="wsperiod" value="<?= "".$wsperiod.""; ?>">
<input type="hidden" name="ws_nsngr" value="<?= "".$ws_nsngr.""; ?>">
<input type="hidden" name="no_shipping" value="<?= "".$no_shipping.""; ?>">
</td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" colspan="2" align="center"><input type="submit" value="<?= ""._WSCONT.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
Subtext();
include("footer.php");
}
function trial_userdetails(){//Check user and add to database
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1, $module_name;
$trial_period1 = requestUtils::getRequestObject('trial_period1');
$trial_period2 = requestUtils::getRequestObject('trial_period2');
$trial_groupid = requestUtils::getRequestObject('trial_groupid');

include("header.php");
SubTop();
OpenTable();
	echo "<form action=\"modules.php?name=$module_name&ws=trial_adduser\" method=\"post\">\n"
	    ."<table cellpadding=\"1\" cellspacing=\"1\" border=\"0\" width='80%' align='center' bgcolor='$bgcolor1'>\n"
		."<tr><th colspan='2'>"._WSREG."</th></tr>"
	    ."<tr><td bgcolor='$bgcolor2' width='35%'>"._WSNICKNAME.":</td><td bgcolor='$bgcolor2'><input type=\"text\" name=\"username\" size=\"30\" maxlength=\"25\"></td></tr>\n"
    	    ."<tr><td bgcolor='$bgcolor2'>"._EMAIL.":</td><td bgcolor='$bgcolor2'><input type=\"text\" name=\"user_email\" size=\"30\" maxlength=\"255\"></td></tr>\n"
	    ."<tr><td bgcolor='$bgcolor2'>"._WSPASSWORD.":</td><td bgcolor='$bgcolor2'><input type=\"password\" name=\"user_password\" size=\"11\" maxlength=\"40\"></td></tr>\n"
	    ."<tr><td bgcolor='$bgcolor2'>"._WSRETYPEPASSWORD.":</td><td bgcolor='$bgcolor2'><input type=\"password\" name=\"user_password2\" size=\"11\" maxlength=\"40\"></td></tr>\n";
	if (extension_loaded("gd") AND ($gfx_chk == 3 OR $gfx_chk == 4 OR $gfx_chk == 6 OR $gfx_chk == 7)) {
	    echo "<tr><td bgcolor='$bgcolor2'>"._SECURITYCODE.":</td><td bgcolor='$bgcolor2'><img src='?gfx=gfx&random_num=$random_num' border='1' alt='"._SECURITYCODE."' title='"._SECURITYCODE."'></td></tr>\n"
	        ."<tr><td bgcolor='$bgcolor2'>"._TYPESECCODE.":</td><td bgcolor='$bgcolor2'><input type=\"text\" NAME=\"gfx_check\" SIZE=\"7\" MAXLENGTH=\"6\"></td></tr>\n"
	        ."<input type=\"hidden\" name=\"random_num\" value=\"$random_num\">\n";
	}
	echo "</td></tr></table>\n";
?>
<br>
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSREGA.""; ?></b></th></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" width="35%"><?= ""._WSNICKNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsusername" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSPASSWORD.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wspass" size="25"></td></tr><tr><td colspan="2">
<input type="hidden" name="trial_period1x" value="<?= "".$trial_period1.""; ?>">
<input type="hidden" name="trial_period2x" value="<?= "".$trial_period2.""; ?>">
<input type="hidden" name="trial_groupidx" value="<?= "".$trial_groupid.""; ?>">
</td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" colspan="2" align="center"><input type="submit" value="<?= ""._WSCONT.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
Subtext();
include("footer.php");
}
//ADD TRIAL USERS
function trial_adduser(){
global $prefix, $user_prefix, $db, $sitename, $module_name, $stop;
//include("header.php");
$trial_period1x = requestUtils::getRequestObject('trial_period1x');
$trial_period2x = requestUtils::getRequestObject('trial_period2x');
$trial_groupidx = requestUtils::getRequestObject('trial_groupidx');
$wsusername = requestUtils::getRequestObject('wsusername');
$wspass = requestUtils::getRequestObject('wspass');
$username2 = requestUtils::getRequestObject('username');
$user_email = requestUtils::getRequestObject('user_email');
$user_password = requestUtils::getRequestObject('user_password');
$user_password2 = requestUtils::getRequestObject('user_password2');
$gfx_check = requestUtils::getRequestObject('gfx_check');
$random_num = requestUtils::getRequestObject('random_num');
////////////////////////////////////////////////////////////
//CEHCK IF USE EXISTS
if($wsusername !=="" AND $username2 ==""){//1
//
$ws_pass = md5($wspass);
$ucheck = $db->sql_query("SELECT user_id  FROM ".$user_prefix."_users WHERE username='$wsusername' AND user_password ='$ws_pass'");
list($wsuser_id) = $db->sql_fetchrow($ucheck);
if($wsuser_id ==""){//2
include("header.php");
OpenTable();
echo "user does not exist "._GOBACK."";
CloseTable();
include("footer.php");
die();
}//2
else{//3
$sip = $_SERVER['REMOTE_ADDR'];
list($ws_tid) = $db->sql_fetchrow($db->sql_query("SELECT ws_tid FROM ".$prefix."_ws_trialusers WHERE ws_tid='$trial_groupidx' AND(ws_uid='$wsusername' OR ws_ip='$sip')"));
if($ws_tid !=""){//4
include("header.php");
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXT."$sitename</center>";
CloseTable();
include("footer.php");	
exit();
}//4
else{//5
$stype = $trial_groupidx;
	   if($stype ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
 if($trial_period2x =="day"){
	  $wstime ="86400";
	  }
	  elseif($trial_period2x =="week"){
	  $wstime ="604800";
	  }
	  elseif($trial_period2x =="month"){
	  $wstime ="2419200";
	  }
	  else{
	  $wstime ="29030400";
	  }
      $wsperiod = $wstime * $trial_period1x;
	  
$usersubtime = $wsperiod+time();
list($wsuid) = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='$wsuser_id'"));
if($wsuid =="" AND $subtyp == "Nuke"){//7
$db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$wsuser_id', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trial_groupidx', '$wsusername', '$wsuser_id', '$sip')");
Header("Location: modules.php?name=Your_Account");
}//7
$ntime = time();
list($wsnsngid, $wsnsnid) = $db->sql_fetchrow($db->sql_query("SELECT gid, uid FROM ".$prefix."_nsngr_users WHERE uid='$wsuser_id' AND gid='$trial_groupidx'"));
if($wsnsnid =="" AND $subtyp == "NSN"){//9
$db->sql_query("insert into ".$prefix."_nsngr_users values ('$trial_groupidx', '$wsuser_id', '$wsusername', '', '', '$ntime', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trial_groupidx', '$wsusername', '$wsuser_id', '$sip')");
Header("Location: modules.php?name=Your_Account");
}//9
else{//10
include("header.php");
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXTWS2."$sitename</center>";
CloseTable();
include("footer.php");	
exit();
}//10
}//5
}//3
}//1
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
elseif($username2 !="" AND $wsusername ==""){//ADD USER TO DATABASE
if($user_email ==""){
include("header.php");
OpenTable();
echo ""._ERRORTXT3.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password == ""){
include("header.php");
OpenTable();
echo ""._ERRORTXT4.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password2 ==""){
include("header.php");
OpenTable();
echo ""._ERRORTXT5.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password2 != "$user_password"){
include("header.php");
OpenTable();
echo ""._ERRORTXT6.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
//Check user
userCheck($username2, $user_email);
if ($stop) {
include'header.php';
OpenTable();
	echo $stop;
CloseTable();
include'footer.php';
die();
	} elseif(!$stop){//USER CHECKS OUT FINE...ADD HIM/HER
$user_regdate = date("M d, Y");
$new_password = md5($user_password2);
$result = $db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_password, user_avatar, user_avatar_type, user_regdate, user_lang) VALUES (NULL, '$username2', '$user_email', '$new_password', 'gallery/blank.gif', 3, '$user_regdate', '$language')");
if(!$result) {
	    echo ""._ERROR."<br>";
		die();
	} else {
	list($wsx_uid) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$username2'"));
	$sip = $_SERVER['REMOTE_ADDR'];
list($ws_tid) = $db->sql_fetchrow($db->sql_query("SELECT ws_tid FROM ".$prefix."_ws_trialusers WHERE ws_tid='$trial_groupidx' AND(ws_uid='$wsx_uid' OR ws_ip='$sip')"));
if($ws_tid !=""){//4
include("header.php");
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXT."$sitename</center>";
CloseTable();
include("footer.php");	
exit();
}//4
else{//5
$stype = $trial_groupidx;
	   if($stype ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
 if($trial_period2x =="day"){
	  $wstime ="86400";
	  }
	  elseif($trial_period2x =="week"){
	  $wstime ="604800";
	  }
	  elseif($trial_period2x =="month"){
	  $wstime ="2419200";
	  }
	  else{
	  $wstime ="29030400";
	  }
      $wsperiod = $wstime * $trial_period1x;
	  
$usersubtime = $wsperiod+time();
list($wsuid) = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='$wsx_uid'"));
if($wsuid =="" AND $subtyp == "Nuke"){//7
$db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$wsx_uid', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trial_groupidx', '$username2', '$wsx_uid', '$sip')");
Header("Location: modules.php?name=Your_Account");
}//7
$ntime = time();
list($wsnsngid, $wsnsnid) = $db->sql_fetchrow($db->sql_query("SELECT gid, uid FROM ".$prefix."_nsngr_users WHERE uid='$wsx_uid' AND gid='$trial_groupidx'"));
if($wsnsnid =="" AND $subtyp == "NSN"){//9
$db->sql_query("insert into ".$prefix."_nsngr_users values ('$trial_groupidx', '$wsx_uid', '$username2', '', '', '$ntime', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trial_groupidx', '$username2', '$wsx_uid', '$sip')");
Header("Location: modules.php?name=Your_Account");
}//9
else{//10
include("header.php");
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXTWS2."$sitename</center>";
CloseTable();
include("footer.php");	
exit();
}//10
}
	//ADD WHAT THE USER WILL SEE
	}
	}
	}
	else{
include("header.php");
OpenTable();
echo ""._ERRORTXT2.""._GOBACK."";
CloseTable();
include("footer.php");
die();

}
//END.....
}
//END
function tos(){
include("header.php");
SubTop();
OpenTable();

include("tos.txt");


CloseTable();
echo"<br>";
Subtext();
include("footer.php");
}
function trial(){
global $prefix, $user_prefix, $db, $sitename, $module_name;
include("header.php");
$trailus = requestUtils::getRequestObject('trial_user');
$trialgid = requestUtils::getRequestObject('trial_groupid');
$trialp2 = requestUtils::getRequestObject('trial_period2');
$trialp1 = requestUtils::getRequestObject('trial_period1');
$trialun = requestUtils::getRequestObject('trial_username');
if($trailus ==""){
Header("Location: modules.php?name=WS_Subscription");
exit();
} 
$sip = $_SERVER['REMOTE_ADDR'];
list($ws_tid) = $db->sql_fetchrow($db->sql_query("SELECT ws_tid FROM ".$prefix."_ws_trialusers WHERE ws_tid='$trialgid' AND(ws_uid='$trailus' OR ws_ip='$sip')"));

if($ws_tid !=""){
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXT."$sitename</center>";
CloseTable();
include("footer.php");	
exit();
}
$stype = $trialgid;
	   if($stype ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
 if($trialp2 =="day"){
	  $wstime ="86400";
	  }
	  elseif($_POST['period'] =="week"){
	  $wstime ="604800";
	  }
	  elseif($_POST['period'] =="month"){
	  $wstime ="2419200";
	  }
	  elseif($_POST['period'] =="year"){
	  $wstime ="29030400";
	  }
      $wsperiod = $wstime * $trialp1;
	  
$usersubtime = $wsperiod+time();
list($wsuid) = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='$trailus'"));
if($wsuid =="" AND $subtyp == "Nuke"){
$db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$trailus', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trialgid', '$trialun', '$trailus', '$sip')");
Header("Location: modules.php?name=Your_Account");
}
$ntime = time();
list($wsnsngid, $wsnsnid) = $db->sql_fetchrow($db->sql_query("SELECT gid, uid FROM ".$prefix."_nsngr_users WHERE uid='$trailus' AND gid='$trialgid'"));
if($wsnsnid =="" AND $subtyp == "NSN"){
$db->sql_query("insert into ".$prefix."_nsngr_users values ('$trialgid', '$trailus', '$trialun', '', '', '$ntime', '$usersubtime')");
$db->sql_query("insert into ".$prefix."_ws_trialusers values ('$trialgid', '$trialun', '$trailus', '$sip')");
Header("Location: modules.php?name=Your_Account");
}
else{
OpenTable();
echo "<center><span id=\"alImg9\" style=\"width:80px;height:80px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/stop.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/stop.png\" width=\"80\" height=\"80\" border=\"0\" alt=\"\"></span>";
echo "<br>"._ERRORTXTWS2."$sitename</center>";
CloseTable();
include("footer.php");	
}
include("footer.php");	   
}
switch($ws) {
default:
Subscribe();
break;
case "SubPlans":
SubPlans();
break;
case "tos":
tos();
break;
case "trial":
trial();
break;
case "trial_adduser":
trial_adduser();
break;
case "trial_userdetails":
trial_userdetails();
break;
case "userdetails":
userdetails();
break;
case "userCheck";
userCheck($username2, $user_email);
break;
}
?>