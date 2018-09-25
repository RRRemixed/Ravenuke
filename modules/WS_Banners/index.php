<?php
/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*            ..::Advertisement Module::..                      */
/****************************************************************/
if ($op == "wsclick" AND isset($bid)) {
	$bid = intval($bid);
	$sql = "SELECT clickurl FROM ".$prefix."_ws_banners WHERE bid='$bid'";
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);
	$db->sql_query("UPDATE ".$prefix."_ws_banners SET clicks=clicks+1 WHERE bid='$bid'");
	update_points(21);
	Header("Location: $row[clickurl]");	
	die();
}
if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$pagetitle ="WS_Banners";
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
include("header.php");
include("./ws_core/class/cleaninput.class.php");
require("./ws_core/inc/upload.inc.php");
$cid=addslashes($cid);
$login=addslashes($login);
function Adstext(){
global $module_name;
OpenTable();
//echo "<center><a href='modules.php?name=$module_name'>"._WSSMAIN."</a>  |  <a href='modules.php?name=$module_name&ws=AdsPlans'>"._WSPLANS."</a>  |  <a href='modules.php?name=$module_name&ws=tos'>"._WSTOS."</a>  |  <a href='modules.php?name=$module_name&ws=login'>"._WSCLOG."</a><br><br><img src='modules/$module_name/images/cards.gif' border='0'><img src='modules/$module_name/images/payp.gif' border='0'></center>";
$ttxt ='ZWNobyAiPGNlbnRlcj48YSBocmVmPSdtb2R1bGVzLnBocD9uYW1lPSRtb2R1bGVfbmFtZSc+Ii5fV1NTTUFJTi4iPC9hPiAgfCAgPGEgaHJlZj0nbW9kdWxlcy5waHA/bmFtZT0kbW9kdWxlX25hbWUmd3M9QWRzUGxhbnMnPiIuX1dTUExBTlMuIjwvYT4gIHwgIDxhIGhyZWY9J21vZHVsZXMucGhwP25hbWU9JG1vZHVsZV9uYW1lJndzPXRvcyc+Ii5fV1NUT1MuIjwvYT4gIHwgIDxhIGhyZWY9J21vZHVsZXMucGhwP25hbWU9JG1vZHVsZV9uYW1lJndzPWxvZ2luJz4iLl9XU0NMT0cuIjwvYT48YnI+PGJyPjxpbWcgc3JjPSdtb2R1bGVzLyRtb2R1bGVfbmFtZS9pbWFnZXMvY2FyZHMuZ2lmJyBib3JkZXI9JzAnPjxpbWcgc3JjPSdtb2R1bGVzLyRtb2R1bGVfbmFtZS9pbWFnZXMvcGF5cC5naWYnIGJvcmRlcj0nMCc+PC9jZW50ZXI+Ijs=';
eval(base64_decode($ttxt));
CloseTable();
}
function AdsTop(){
global $module_name, $ws;
OpenTable();
if($ws ==""){
echo "<center><span id=\"alImg6\" style=\"width:218px;height:92px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/submain.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/submain.png\" width=\"218\" height=\"92\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="AdsPlans"){
echo "<center><span id=\"alImg7\" style=\"width:218px;height:92px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/adsplan.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/adsplan.png\" width=\"218\" height=\"92\" border=\"0\" alt=\"\"></span></center>";
}
elseif($ws =="tos"){
echo "<center><span id=\"alImg8\" style=\"width:95px;height:97px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/$module_name/images/subtos.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/$module_name/images/subtos.png\" width=\"95\" height=\"97\" border=\"0\" alt=\"\"></span></center>";
}

CloseTable();
echo "<br>";
}

function banners(){
AdsTop();
OpenTable();
echo "<div align='left'>"._ADSTXT."</div>";
CloseTable();
Adstext();
}
//BANNER PLANS
function AdsPlans(){
global $prefix, $dbi, $cookie, $user, $bgcolor1, $bgcolor2;
 cookiedecode($user);
 $wsuserid = $cookie[0];
 $wsuserid1 = $cookie[1];
AdsTop();
$result = sql_query("select ws_id, ban_name, ban_description, ban_cost, wsn, wsp, ban_enabled, ws_img, ws_imp, ws_trial, ws_trial_dmy,  ws_trial_lgth, ws_banpos,  ws_trialimp from ".$prefix."_ws_banplans WHERE ban_enabled='checked' ORDER BY ws_weight ASC", $dbi);
	while(list($ws_id, $ban_name, $ban_description, $ban_cost, $wsn, $wsp, $ban_enabled, $ws_img, $ws_imp, $ws_trial, $ws_trial_dmy, $ws_trial_lgth, $ws_banpos, $ws_trialimp) = sql_fetch_row($result, $dbi)) {

if($ws_imp !=""){
if($ws_imp ==0){
$trialp = _WSUNLIMITED;
}else{
$trialp = $ws_imp;
}
$trialptxt =""._WSTRTXTIMP."";

}
else{
$trialp = $wsn;
$trialp .= "  ";
$trialp .= $wsp;
$trialp .= "  (s)";
$trialptxt =""._WSADSPERIOD."";
}


	OpenTable();
	?>
	<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="<? echo"".$bgcolor1.""; ?>">
	<tr><th height="20"></th><th align="center"><? echo"<b>"._WSADNAME."</b>"; ?></th><th><? echo"<b>"._WSADDESC."</b>"; ?></th><th><? echo"<b>"._WSADPR."</b>"; ?></th><th><? echo"<b>$trialptxt</b>"; ?></th><th></th></tr>
	<tr><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "<img src='".$ws_img."' border='0'>"; ?></td><td width="20%" valign="top" align="center" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "<b>$ban_name</b>"; ?></td><td width="55%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$ban_description"; ?></td><td width="10%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>" align="center"><? echo ""._WSCURRENCY."".$ban_cost; ?></td><td width="15%" align="center" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo $trialp; ?></td>
	<td width="10%" valign="top" bgcolor="<? echo"".$bgcolor2.""; ?>">
	<form action="modules.php?name=WS_Banners&ws=Clientdetails" method="post" target="_self">
	<? 
    echo ' <input type="hidden" name="amount" value="'.$ban_cost.'">';
	echo ' <input type="hidden" name="quantity" value="1">';
	echo ' <input type="hidden" name="item_name" value="'.$ban_name.'">';
	echo ' <input type="hidden" name="item_number" value="'.$ws_banpos.'">';
	//echo ' <input type="hidden" name="item_number" value="'.$wsuserid.'">';

	echo ' <input type="hidden" name="wsimp" value="'.$ws_imp.'">';


	echo ' <input type="hidden" name="period" value="'.$wsp.'">';
	echo ' <input type="hidden" name="wsperiod" value="'.$wsn.'">'; 

	echo '<input type="hidden" name="no_shipping" value="1">';
	echo "<input class=button type=\"image\" src=\"modules/WS_Banners/images/buy_buttons.jpg\" width=\"80\" height=\"15\" border=\"0\" style=\"border:0px\">"; 
	?>
	</form>
	<?
	echo "<br>";
	if($ws_trial !=0){
	$trialform = '<form action="modules.php?name=WS_Banners&ws=trial" method="post" target="_self">';
	$trialform .= ' <input type="hidden" name="ws_banpos2" value="'.$ws_banpos.'">';//usrname
	if($ws_trialimp ==""){
	$trialform .= ' <input type="hidden" name="trial_period1" value="'.$ws_trial_lgth.'">'; //trial number
	$trialform .= ' <input type="hidden" name="trial_period2" value="'.$ws_trial_dmy.'">';  ///trial month, days, year..
	}
	else{
	$trialform .= ' <input type="hidden" name="ws_trialimp2" value="'.$ws_trialimp.'">';  ///trial impressions..
	}
	$trialform .= "<input class=button type=\"image\" src=\"modules/WS_Banners/images/freetrial.gif\" width=\"80\" height=\"15\" border=\"0\" style=\"border:0px;\">";
	$trialform .= "</form>";
	echo $trialform; 
	}
	
	
	?></td>
	</tr>
	</table>
	
	<?
	CloseTable();
	echo "<br>";
	}
	Adstext();
}
//END
function tos(){
AdsTop();
OpenTable();

include("tos.txt");


CloseTable();
echo"<br>";
Adstext();
}
function Clientdetails(){
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;
$wsperiod = requestUtils::getRequestObject('wsperiod');
$period = requestUtils::getRequestObject('period');
$cost = requestUtils::getRequestObject('amount');
$quantity = requestUtils::getRequestObject('quantity');
$itemname = requestUtils::getRequestObject('item_name');
$wsshipping = requestUtils::getRequestObject('no_shipping');
$wspos = requestUtils::getRequestObject('item_number');
$wsimpamt = requestUtils::getRequestObject('wsimp');
AdsTop();
OpenTable();
?>
<form action="adpaypal.php" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSREG.""; ?></b></th></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCONTNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="contname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCEMAIL.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="contemail" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCLOGIN.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cuserame" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCPASS.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cpass" size="25"></td></tr>
</table>
<br>
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSREGA.""; ?></b></th></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCLOGIN.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsusername" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCPASS.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wspass" size="25"></td></tr>
</table>
<br>
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSBAN.""; ?></b></th></tr>
<tr><td height="30" width="50%" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANTYPE.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><select name="bantype"><option value="">---<?= ""._WSSELONE."";  ?>---</option><option value="1"><?= ""._WSFLASH.""; ?></option><option value="2"><?= ""._WSIMG.""; ?></option><option value="3"><?= ""._WSTXTAD.""; ?></option></select></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbaname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANLOC.""; ?><br><?= ""._WSBANLOCTXT.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbanloc" size="35"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANLOCUP.""; ?><br><?= ""._WSBANLOCUPTXT.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input type="file" name="myupload"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCURL.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbanurl" size="35"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSDESC.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><textarea name="wsdesc" cols="35" rows="5"></textarea>
<input type="hidden" name="wsperiod" value="<?= "".$wsperiod.""; ?>">
<input type="hidden" name="MAX_FILE_SIZE" value="1024">
<input type="hidden" name="period" value="<?= "".$period.""; ?>">
<input type="hidden" name="quantity" value="<?= "".$quantity.""; ?>">
<input type="hidden" name="amount" value="<?= "".$cost.""; ?>">
<input type="hidden" name="itemname" value="<?= "".$itemname.""; ?>">
<input type="hidden" name="wsshipping" value="<?= "".$wsshipping.""; ?>">
<input type="hidden" name="wspos" value="<?= "".$wspos.""; ?>">
<input type="hidden" name="wsimpamt" value="<?= "".$wsimpamt.""; ?>">
</td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" colspan="2" align="center"><input type="submit" value="<?= ""._WSSUBMIT.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
Adstext();
}
//WS TRIAL
function trial(){
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;
$banpos1 = requestUtils::getRequestObject('ws_banpos2');
$trialp1 = requestUtils::getRequestObject('trial_period1');
$trialp2 = requestUtils::getRequestObject('trial_period2');
$timp = requestUtils::getRequestObject('ws_trialimp2');
AdsTop();
OpenTable();
?>
<form action="modules.php?name=WS_Banners&ws=trialadd" method="post" enctype="multipart/form-data">
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSREGC.""; ?></b></th></tr>
<tr><td height="30" width="50%" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCONTNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="contname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCEMAIL.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="contemail" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCLOGIN.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cuserame" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCPASS.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="cpass" size="25"></td></tr>
</table>
<br>
<table border="0" cellpadding="2" cellspacing="1" width="80%" align="center" bgcolor="<?= "".$bgcolor1.""; ?>">
<tr><th colspan="2" height="30"><b><?= ""._WSBAN.""; ?></b></th></tr>
<tr><td height="30" width="50%" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANTYPE.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><select name="bantype"><option value="">---<?= ""._WSSELONE."";  ?>---</option><option value="1"><?= ""._WSFLASH.""; ?></option><option value="2"><?= ""._WSIMG.""; ?></option><option value="3"><?= ""._WSTXTAD.""; ?></option></select></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBNAME.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbaname" size="25"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANLOC.""; ?><br><?= ""._WSBANLOCTXT.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbanloc" size="35"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSBANLOCUP.""; ?><br><?= ""._WSBANLOCUPTXT.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input type="file" name="myupload"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSCURL.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><input name="wsbanurl" size="35"></td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>"><?= ""._WSDESC.""; ?></td><td bgcolor="<?= "".$bgcolor2.""; ?>"><textarea name="wsdesc" cols="35" rows="5"></textarea>
<input type="hidden" name="banpos1" value="<?= "".$banpos1.""; ?>">
<input type="hidden" name="MAX_FILE_SIZE" value="1024">
<input type="hidden" name="trialp1" value="<?= "".$trialp1.""; ?>">
<input type="hidden" name="trialp2" value="<?= "".$trialp2.""; ?>">
<input type="hidden" name="timp" value="<?= "".$timp.""; ?>">
</td></tr>
<tr><td height="30" bgcolor="<?= "".$bgcolor2.""; ?>" colspan="2" align="center"><input type="submit" value="<?= ""._WSSUBMIT.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
Adstext();
}
function trialadd(){
global $prefix, $db;
$banpos1 = requestUtils::getRequestObject('banpos1');
$trialp1 = requestUtils::getRequestObject('trialp1');
$trialp2 = requestUtils::getRequestObject('trialp2');
$timp = requestUtils::getRequestObject('timp');
$cname = requestUtils::getRequestObject('cname');
$contname = requestUtils::getRequestObject('contname');
$contemail = requestUtils::getRequestObject('contemail');
$cuserame = requestUtils::getRequestObject('cuserame');
$cpass = requestUtils::getRequestObject('cpass');
$bantype = requestUtils::getRequestObject('bantype');
$wsbaname = requestUtils::getRequestObject('wsbaname');
$wsbanloc = requestUtils::getRequestObject('wsbanloc');
$wsbanurl = requestUtils::getRequestObject('wsbanurl');
$wsdesc = requestUtils::getRequestObject('wsdesc');
//Start checking for blank fields
$EmptyWS ="";
if($cname ==""){
$EmptyWS .= ""._WSERR1."<br>";
}
if($contname ==""){
$EmptyWS .= ""._WSERR2."<br>";
}
if($contemail ==""){
$EmptyWS .= ""._WSERR3."<br>";
}
if($cuserame ==""){
$EmptyWS .= ""._WSERR4."<br>";
}
if($cpass ==""){
$EmptyWS .= ""._WSERR5."<br>";
}
if($bantype ==""){
$EmptyWS .= ""._WSERR6."<br>";
}
if($wsbaname ==""){
$EmptyWS .= ""._WSERR7."<br>";
}
if($wsbanloc ==""){
$EmptyWS .= ""._WSERR8."<br>";
}
if($wsbanurl ==""){
$EmptyWS .= ""._WSERR9."<br>";
}
if($wsdesc ==""){
$EmptyWS .= ""._WSERR10."<br>";
}
if($EmptyWS !=""){
OpenTable();
echo $EmptyWS;
echo "<br><br>";
echo ""._GOBACK."";
CloseTable();
exit();
}

	$sql = "SELECT cid FROM ".$prefix."_ws_bannerclient WHERE login='$cuserame'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
	if($row[cid] ==""){
	if($wsbanloc =="" AND $bantype !="3"){
	  $myUploadobj = new UPLOAD; //creating instance of file.
$upload_dir= $_SERVER['DOCUMENT_ROOT']."/modules/WS_Banners/adimages/";
		// use function to upload file.
		$file=$myUploadobj->upload_file($upload_dir,'myupload',true,true,0,"jpg|jpeg|gif|png|swf"); 
		if($file==false)
			echo $myUploadobj->error;
		else
			$wsmyloc ="modules/WS_Banners/adimages/".$file;	
}else{
$wsmyloc = $wsbanloc;
}
	//Insert user and plan since they are not a client
$db->sql_query("INSERT INTO ".$prefix."_ws_bannerclient VALUES('', '$cname', '$contname', '$contemail', '$cuserame', '$cpass')");//Add client
	$sql2 = "SELECT cid FROM ".$prefix."_ws_bannerclient WHERE login='$cuserame' AND passwd='$cpass'";
    $result2 = $db->sql_query($sql2);
    $row2 = $db->sql_fetchrow($result2);
	$db->sql_query("INSERT INTO ".$prefix."_ws_banners VALUES('', '$row2[cid]', '$timp', '1', '', '$wsmyloc', '$wsbanurl', '$wsdesc', '', '', '$bantype', '1', '$banpos1', '1')");//Add client to trial
	} else {
	OpenTable();
	echo ""._ERRORTXT1."";
	CloseTable();
	exit();
	}
}
/********************************************/
/* Function to display banners in all pages */
/********************************************/
//ADD NEW CLIENT TO DATABASE
function WSaddClient($wsname, $contact, $email, $login, $passwd, $extrainfo){
global $prefix, $dbi, $module_name;
OpenTable();
if($wsname == "" ){
	echo "Please enter your name";
	echo ""._GOBACK."";
	}
   else if($contact == "" ){
	echo "Please enter contact name";
	echo ""._GOBACK."";
	}
	else if($email == "" ){
	echo "Please enter email";
	echo ""._GOBACK."";
	}
    else if($login == "" ){
	echo "Please enter login name";
	echo ""._GOBACK."";
	}
	else if($passwd == "" ){
	echo "Please enter password";
	echo ""._GOBACK."";
	}
	else {
    sql_query("insert into ".$prefix."_ws_bannerclient values (NULL, '$wsname', '$contact', '$email', '$login', '$passwd', '$extrainfo')", $dbi);
    Header("Location: modules.php?name=$module_name&ws=login");
	}
	CloseTable();
}

/********************************************/
/* Function to redirect the clicks to the   */
/* correct url and add 1 click              */
/********************************************/

function clickbanner($bid) {
    global $prefix, $db;
    $sql = "SELECT clickurl FROM ".$prefix."_ws_banners WHERE bid='$bid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $db->sql_query("UPDATE ".$prefix."_ws_banners SET clicks=clicks+1 WHERE bid='$bid'");
    Header("Location: $row[clickurl]");
}

/********************************************/
/* Function to let your client login to see */
/* the stats                                */
/********************************************/

function clientlogin() {
global $bgcolor1, $bgcolor2, $textcolor1, $textcolor2;
AdsTop();
OpenTable();

    echo"
    <html>
    <body bgcolor=\"".$bgcolor1."\" text=\"#000000\" link=\"#006666\" vlink=\"#006666\">
    <center><br>
    <table width=\"80%\" cellpadding=\"0\" cellspacing=\"1\" border=\"0\"><tr><td>
    <table width=\"100%\" cellpadding=\"5\" cellspacing=\"1\" border=\"0\"><tr><td bgcolor=\"".$bgcolor2."\">
    <center><b>Advertising Client Log-in</b></center>
    </td></tr><tr><td bgcolor=\"".$bgcolor1."\">
    <form action=\"modules.php?name=WS_Banners\" method=\"post\">
    Login name: &nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"login\" size=\"18\" maxlength=\"10\"><br><br>
    Password: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"password\" name=\"pass\" size=\"18\" maxlength=\"10\"><br><br>
    <input type=\"hidden\" name=\"ws\" value=\"account\">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Login\">
    </td></tr><tr><td bgcolor=\"".$bgcolor2."\">
    <font class=\"content\">
    <center>Please type your client information</center>
    </font></form>
    </td></tr></table></td></tr></table><br><br>
    </body>
    </html>
    ";
	CloseTable();
	echo "<br>";
	Adstext();
}

/*********************************************/
/* Function to display the banners stats for */
/* each client                               */
/*********************************************/

function account() {
    global $prefix, $db, $dbi, $sitename, $bgcolor1, $textcolor1;
	$login = requestUtils::getRequestObject('login');
	$pass = requestUtils::getRequestObject('pass');
	AdsTop();
	$sql = "SELECT cid, name, passwd FROM ".$prefix."_ws_bannerclient WHERE login='$login'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $cid = $row[cid];
	$cid = intval($cid);
    $name = $row[name];
    $passwd = $row[passwd];
    if($login=="" AND $pass=="" OR $pass=="") {
	OpenTable();
	echo "<center><br>"._WSLOGINC."<br><br><a href=\"javascript:history.go(-1)\">"._WSLOGINC1."</a></center>";
	CloseTable();
    } else {
    
    if ($pass==$passwd) {
    OpenTable();
    echo"
    <html>
    <body>
    <center>
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"1\"><tr><td>
    <table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\"><tr><td>
    <font class=\"option\">
    <center><b>"._WSCURBAN." $name</b></center><br>
    </font>";
    
    $sql = "SELECT bid, imptotal, impmade, clicks, date, dateend FROM ".$prefix."_ws_banners WHERE cid='$cid' AND active='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$bid = $row[bid];
	$bid = intval($bid);
	$imptotal = $row[imptotal];
        $imptotal = intval($imptotal);
	$impmade = $row[impmade];
        $impmade = intval($impmade);
	$clicks = $row[clicks];
        $clicks = intval($clicks);
	$date = $row[date];
	$sDate = date('Y-m-d',$date);
	$dateend = $row[dateend];
	$eDate = date('Y-m-d',$dateend);
	
        if($impmade==0) {
    	    $percent = 0;
        } else {
    	    $percent = substr(100 * $clicks / $impmade, 0, 5);
        }
        if($imptotal==0) {
    	    $left = "Unlimited";
        } else {
    	    $left = $imptotal-$impmade;
        }
		
        echo "
		<table width=\"100%\" border=\"0\"><tr>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._ID."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPMADE."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPTOTAL."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPLEFT."</b></td>
		<td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b> "._DATESTART."</b></td>
	<td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b> "._DATEEND."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._CLICKS."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>% "._CLICKS."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._FUNC."</b></td><tr>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$bid</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$impmade</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$imptotal</td>
	<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$left</td>
			<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$sDate</td>
		<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$eDate</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$clicks</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$percent%</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\"><a href=\"modules.php?name=WS_Banners&ws=EmailStats&login=$login&cid=$cid&bid=$bid\">E-mail Stats</a></td><tr><tr><td colspan='9' align='center'>";
		echo "<form action=\"adpaypal.php\" method=\"post\">";
	if($dateend >0){
	$queryws = "wsp !=''";   	 
	}else{
	$queryws = "wsp =''";
	}
	echo '<select name="pack"><option value="">'._WSSELONE1.'</option>';
	$resultx2 = sql_query("select ws_id, ban_name, ban_cost from ".$prefix."_ws_banplans WHERE ban_enabled='checked' AND $queryws ORDER BY ws_weight ASC", $dbi);
	while(list($ws_id, $ban_name, $ban_cost) = sql_fetch_row($resultx2, $dbi)) {
	
	echo "<option value='".$ws_id."'>$ban_name - "._WSCURRENCY."$ban_cost</option>";
	}
	echo '</select><br><br>';
	echo "<input type=\"hidden\" name=\"bid\" value=\"$bid\"><input type=\"hidden\" name=\"renew\" value=\"1\">
	<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
	echo "<input class=button type=\"image\" src=\"modules/WS_Banners/images/renew_button.jpg\" width=\"80\" height=\"15\" border=\"0\" style=\"border:0px\"></form>";
		echo "</td></tr>";
		  echo "
    </table>";
	
  }
   echo" <center><br><br>
    Following are your running Banners in Western Studios<br><br>";
    $sql = "SELECT bid, imageurl, clickurl, alttext FROM ".$prefix."_ws_banners WHERE cid='$cid' AND active='1'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$bid = $row[bid];
	$bid = intval($bid);
	$imageurl = $row[imageurl];
	$clickurl = $row[clickurl];
	$alttext = $row[alttext];

	$numrows = $db->sql_numrows($result);
	if ($numrows>1) {
	    echo "<hr noshade width=\"80%\"><br>";
	}

	echo "
	<font class=\"content\">Banner ID: $bid<br>
	Send <a href=\"modules.php?name=WS_Banners&ws=EmailStats&login=$login&cid=$cid&bid=$bid\">E-Mail Stats</a> for this Banner<br><br>
	
	<br>
	This Banners points to <a href=\"$clickurl\">this URL</a><br><br>
	<form action=\"modules.php?name=WS_Banners\" method=\"post\">
	Change URL: <input type=\"text\" name=\"url\" size=\"50\" maxlength=\"200\" value=\"$clickurl\"><br><br>
	Change Text: <input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\" value=\"$alttext\"><br><br>
	<input type=\"hidden\" name=\"login\" value=\"$login\">
	<input type=\"hidden\" name=\"bid\" value=\"$bid\">
	<input type=\"hidden\" name=\"pass\" value=\"$pass\">
	<input type=\"hidden\" name=\"cid\" value=\"$cid\">
	<input type=\"submit\" name=\"ws\" value=\"Change\"></form></font>";
   }
    echo "
    </td></tr></table></td></tr></table>
    ";
 
CloseTable();
/* Finnished Banners */ 
echo "<br>";
OpenTable();
    echo "
    <center><br>
    <table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"1\"><tr><td>
    <table border=\"0\" width=\"100%\" cellpadding=\"8\" cellspacing=\"1\"><tr><td>
    <font class=\"option\">
    <center><b>Banners Finished/Inactive for $name</b></center><br>
    </font>
    <table width=\"100%\" border=\"0\"><tr>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._ID."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPMADE."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPTOTAL."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._IMPLEFT."</b></td>
		<td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b> "._DATESTART."</b></td>
	<td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b> "._DATEEND."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._CLICKS."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>% "._CLICKS."</b></td>
    <td bgcolor=\"".$bgcolor1."\"><font color=\"".$textcolor1."\"><center><b>"._FUNC."</b></td><tr>";
    $sql = "SELECT bid, impmade, clicks, imageurl, date, dateend FROM ".$prefix."_ws_banners WHERE cid='$cid' AND active='0'";
    $result = $db->sql_query($sql);
    while ($row = $db->sql_fetchrow($result)) {
	$bid = $row[bid];
	$bid = intval($bid);
	$impmade = $row[impmade];
        $impmade = intval($impmade);
	$clicks = $row[clicks];
        $clicks = intval($clicks);
	$imageurl = $row[imageurl];
	$date = $row[date];
	$dateend = $row[dateend];
	$sDate = date('Y-m-d',$date);
	$eDate = date('Y-m-d',$dateend);
        $percent = substr(100 * $clicks / $impmade, 0, 5);
	echo "
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$bid</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$impmade</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$imptotal</td>
	<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$left</td>
			<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$sDate</td>
		<td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$eDate</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$clicks</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\"><font color=\"".$textcolor1."\">$percent%</td>
        <td bgcolor=\"".$bgcolor1."\" align=\"center\">";
		echo "<form action=\"adpaypal.php\" method=\"post\">";
	if($dateend >0){
	$queryws = "wsp !=''";   	 
	}else{
	$queryws = "wsp =''";
	}
	echo '<select name="pack"><option value="">'._WSSELONE1.'</option>';
	$result = sql_query("select ws_id, ban_name, ban_cost from ".$prefix."_ws_banplans WHERE ban_enabled='checked' AND $queryws ORDER BY ws_weight ASC", $dbi);
	while(list($ws_id, $ban_name, $ban_cost) = sql_fetch_row($result, $dbi)) {
	
	echo "<option value='".$ws_id."'>$ban_name - "._WSCURRENCY."$ban_cost</option>";
	}
	echo '</select><br><br>';
	echo "<input type=\"hidden\" name=\"bid\" value=\"$bid\"><input type=\"hidden\" name=\"renew\" value=\"1\"><input type=\"hidden\" name=\"dateender\" value=\"1\">
	<input type=\"hidden\" name=\"cid\" value=\"$cid\">";
	echo "<input class=button type=\"image\" src=\"modules/WS_Banners/images/renew_button.jpg\" width=\"80\" height=\"15\" border=\"0\" style=\"border:0px\"></form>";
		echo "</td><tr>";
    }
	
echo "
</table></td></tr></table></td></tr></table>";
CloseTable();
echo "<br>
</body>
</html>
";
    
    } else {
	echo "<center><br>Login Incorrect!!!<br><br><a href=\"javascript:history.go(-1)\">Back to Login Screen</a></center>";
    }
}
Adstext();
}

/*********************************************/
/* Function to let the client E-mail his     */
/* banner Stats                              */
/*********************************************/

function EmailStats($login, $cid, $bid, $pass) {
    global $prefix, $db, $sitename, $name;
    $sql = "SELECT name, email FROM ".$prefix."_ws_bannerclient WHERE cid='$cid'";
    $rsult = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $name = $row[name];
    $email = $row[email];
    if ($email=="") {
	echo "
	<html>
	<body bgcolor=\"#AA9985\" text=\"#000000\" link=\"#006666\" vlink=\"#006666\">
	<center><br><br><br>
	<b>Statistics for Banner No. $bid can't be send because<br>
	there isn't an email associated with client $name<br>
	Please contact the Administrator<br><br></b>
	<a href=\"javascript:history.go(-1)\">Back to Banners Stats</a>
	";
    } else {
	$sql2 = "SELECT bid, imptotal, impmade, clicks, imageurl, clickurl, date FROM ".$prefix."_ws_banners WHERE bid='$bid' AND cid='$cid'";
	$result2 = $db->sql_query($sql2);
	$row2 = $db->sql_fetchrow($result2);
	$bid = $row2[bid];
	$bid = intval($bid);
	$imptotal = $row2[imptotal];
        $imptotal = intval($imptotal);
	$impmade = $row2[impmade];
        $impmade = intval($impmade);
	$clicks = $row2[clicks];
        $clicks = intval($clicks);
	$imageurl = $row2[imageurl];
	$clickurl = $row2[clickurl];
	$date = $row2[date];
        if($impmade==0) {
    	    $percent = 0;
        } else {
    	    $percent = substr(100 * $clicks / $impmade, 0, 5);
        }
        if($imptotal==0) {
    	    $left = "Unlimited";
	    $imptotal = "Unlimited";
        } else {
    	    $left = $imptotal-$impmade;
        }
	$fecha = date("F jS Y, h:iA.");
	$subject = "Your Banner Statistics at $sitename";
	$message = "Following are the complete stats for your advertising investment at $sitename:\n\n\nClient Name: $name\nBanner ID: $bid\nBanner Image: $imageurl\nBanner URL: $clickurl\n\nImpressions Purchased: $imptotal\nImpressions Made: $impmade\nImpressions Left: $left\nClicks Received: $clicks\nClicks Percent: $percent%\n\n\nReport Generated on: $fecha";
	$from = "$sitename";
	mail($email, $subject, $message, "From: $from\nX-Mailer: PHP/" . phpversion());
	echo "
	<html>
	<body bgcolor=\"#AA9985\" text=\"#000000\" link=\"#006666\" vlink=\"#006666\">
	<center><br><br><br>
	<b>Statistics for Banner No. $bid has been send to<br>
	<i>$email</i> of $name<br><br></b>
	<a href=\"javascript:history.go(-1)\">Back to Banners Stats</a>
	";
    }
}

/*********************************************/
/* Function to let the client to change the  */
/* url for his banner                        */
/*********************************************/

function change_banner_url_by_client($login, $pass, $cid, $bid, $url, $alttext) {
    global $prefix, $db;
    $sql = "SELECT passwd FROM ".$prefix."_ws_bannerclient WHERE cid='$cid'";
    $result = $db->sql_query($sql);
    $row = $db->sql_fetchrow($result);
    $passwd = $row[passwd];
    if (!empty($pass) AND $pass==$passwd) {
	$alttext = ereg_replace("\"", "", $alttext);
	$alttext = ereg_replace("'", "", $alttext);
	$db->sql_query("UPDATE ".$prefix."_ws_banners SET clickurl='$url', alttext='$alttext' WHERE bid='$bid'");
	echo "<br><center>";
	OpenTable();
	if ($url != "") {
	    echo "You changed the URL<br>";
	}
	if ($alttext != "") {
	    echo "You changed the Alternate Text";
	}
	echo "<br><br><a href=\"javascript:history.go(-1)\">Back to Stats Page</a></center>";
    } else {
	echo "<center><br>Your login/password doesn't match.<br><br>Please <a href=\"modules.php?name=WS_Banners?ws=login\">login again</a></center>";
    }
	CloseTable();
    
}

switch($ws) {

    case "click":
	clickbanner($bid);
	break;

    case "login":
	clientlogin();
	break;

    case "account":
	account();
	break;
	
	case "WSaddClient":
	WSaddClient($wsname, $contact, $email, $login, $passwd, $extrainfo);
	break;

    case "Change":
	change_banner_url_by_client($login, $pass, $cid, $bid, $url, $alttext);
	break;

    case "EmailStats":
	EmailStats($login, $cid, $bid, $pass);
	break;
	
	case "tos":
    tos();
    break;
	
	case "AdsPlans":
	AdsPlans();
	break;
	
	case "Clientdetails":
	Clientdetails();
	break;
	
	case "trial":
	trial();
	break;
	
	case "trialadd":
	trialadd();
	break;
	
	default:
	banners();
	break;
}
include("footer.php");
?>