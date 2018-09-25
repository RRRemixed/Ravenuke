<?php
/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*             ..::Subscription Module::..                      */
/****************************************************************/


if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
global $prefix, $db, $bgcolor1;
$result = $db->sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'");
list($radminsuper) = $db->sql_fetchrow($result);
if ($radminsuper==1) {

include("paginator.php");
function ws_adminsubscr(){
global $textcolor1, $bgcolor1, $bgcolor2;
	//GraphicAdmin();
	OpenTable();
	echo "<center><a href='admin.php'><b>"._NUKEADMIN."</b></a><br></center>";
	CloseTable();
	echo "<br>";
	OpenTable();
?>
<center>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="380" height="250" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="movie" value="modules/WS_Subscription/admin/ws_subscr.swf" />
  <param name="quality" value="high" />
  <param name="bgcolor" value="#ffffff" />
  <param name="wmode" value="transparent">
  <embed src="modules/WS_Subscription/admin/ws_subscr.swf" width="380" height="250" align="middle" quality="high" bgcolor="#ffffff" wmode="transparent" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</center>
<?
	CloseTable();
	echo "<br>";
}
function ws_subscr(){
global $textcolor1, $bgcolor1, $bgcolor2, $prefix, $db;
include("header.php");
	ws_adminsubscr();
	$wscountpend = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_subscriptions_pend"));
	if($wscountpend >=1){
	OpenTable();
	
	?>
	<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="<? echo"".$bgcolor2.""; ?>">
	<tr><td colspan="7" bgcolor="<? echo"".$bgcolor2.""; ?>" height="20"><b><? echo""._WSPENDMEMB.""; ?></b></td></tr>
	<tr><td bgcolor="<? echo"".$bgcolor1.""; ?>"></td><td height="20" bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSUSERID.""; ?></b></td><td bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSMEMFNAME.""; ?></b></td><td bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSMEMLNAME.""; ?></b></td><td bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSDATEADD.""; ?></b></td><td bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSSUBPD.""; ?></b></td><td bgcolor="<? echo"".$bgcolor1.""; ?>" align="center"><b><? echo""._WSSUBUPD.""; ?></b></td></tr>
	<?
$result = $db->sql_query("SELECT id, userid, subscription_expire, fname, lname, datetime, ws_email, sub_id, sub_type FROM ".$prefix."_ws_subscriptions_pend ORDER BY id ASC");
while(list($id, $userid, $subscription_expire, $fname, $lname, $datetime, $ws_email, $sub_id, $sub_type) = $db->sql_fetchrow($result)) {
//Caculate expire date
	$diff = $subscription_expire;
		$yearDiff = floor($diff/60/60/24/365);
		$diff -= $yearDiff*60*60*24*365;
		if ($yearDiff < 1) {
			$diff = $subscription_expire;
		}
		$daysDiff = floor($diff/60/60/24);
		$diff -= $daysDiff*60*60*24;
		$hrsDiff = floor($diff/60/60);
		$diff -= $hrsDiff*60*60;
		$minsDiff = floor($diff/60);
		$diff -= $minsDiff*60;
		$secsDiff = $diff;
		if ($yearDiff < 1) {
			$rest = "$daysDiff "._SBDAYS."";
		} elseif ($yearDiff == 1) {
			$rest = "$yearDiff "._SBYEAR."";
		} elseif ($yearDiff > 1) {
			$rest = "$yearDiff "._SBYEARS."";
		}
	
	?>
	<form action="admin.php?op=ws_subuseradd" method="post">
	<input type="hidden" name="wsem" value="<? echo"$ws_email"; ?>">
	<input type="hidden" name="userid" value="<? echo"$userid"; ?>">
	<input type="hidden" name="sub_id" value="<? echo"$sub_id"; ?>">
	<input type="hidden" name="sub_type" value="<? echo"$sub_type"; ?>">
	<input type="hidden" name="fname" value="<? echo"$fname"; ?>">
	<input type="hidden" name="lname" value="<? echo"$lname"; ?>">
	<input type="hidden" name="datetime" value="<? echo"$datetime"; ?>">
	<input type="hidden" name="rest" value="<? echo"$rest"; ?>">
	<input type="hidden" name="subexp" value="<? echo"$subscription_expire"; ?>">
	<input type="hidden" name="wsaid" value="<? echo"$id"; ?>">
	
	
	<tr><td valign="middle" align="center" bgcolor="<? echo"".$bgcolor2.""; ?>"><img src="modules/WS_Subscription/images/ws_d.gif"></td><td height="20" bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$userid"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo"$fname"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo"$lname"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo"$datetime"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$rest"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>" align="center"><? echo "<input  type=\"image\" src=\"modules/WS_Subscription/images/p_edit.gif\" border='0' style='border:0px'>"; ?></td></tr>
	
	</form>
	<?
	
	}
	
	?>
	</table>
	<br><br>
	<?
	CloseTable();
	}
include("footer.php");
}
//ADD SUBSCRIBER TO NUKE
function ws_subuseradd($userid, $lname, $fname, $datetime, $rest, $wsem, $subexp, $wsaid, $sub_id, $sub_type){
global $prefix, $db;
include("header.php");
	ws_adminsubscr();
	OpenTable();
	?>
	<form action="admin.php?op=ws_subuseradddb" method="post">
	<input type="hidden" name="wsem" value="<? echo"$wsem"; ?>">
	<input type="hidden" name="userid" value="<? echo"$userid"; ?>">
	<input type="hidden" name="fname" value="<? echo"$fname"; ?>">
	<input type="hidden" name="lname" value="<? echo"$lname"; ?>">
	<input type="hidden" name="sub_id" value="<? echo"$sub_id"; ?>">
	<input type="hidden" name="sub_type" value="<? echo"$sub_type"; ?>">
	<input type="hidden" name="datetime" value="<? echo"$datetime"; ?>">
	<input type="hidden" name="rest" value="<? echo"$rest"; ?>">
	<input type="hidden" name="subexp" value="<? echo"$subexp"; ?>">
	<input type="hidden" name="wsaid" value="<? echo"$wsaid"; ?>">
	<table width="90%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr><td colspan="2"></td></tr>
	<tr><td width="20%" height="20"><b><? echo""._WSUSERID.":"; ?></b></td><td align="left"><b><? echo"$userid"; ?></b></td></tr>
	<tr><td height="20"><b><? echo""._WSMEMFNAME.":"; ?></b></td><td align="left"><? echo"$fname"; ?></td></tr>
	<tr><td height="20"><b><? echo""._WSMEMLNAME.":"; ?></b></td><td align="left"><? echo"$lname"; ?></td></tr>
	<tr><td height="20"><b><? echo""._WSSUBPD.":"; ?></b></td><td align="left"><? echo"$rest"; ?></td></tr>
	<?
	if($sub_type =="NSN"){
	?>
	<tr><td height="20"><b><? echo""._WSNSN.":"; ?></b></td><td align="left"><? echo"($sub_id)$sub_type"; ?></td></tr>
	<?
	}
	?>
	
	<tr><td height="20"><b><? echo""._WSSTATUS.":"; ?></b></td><td align="left"><select name="status">
    <option value="approve"><? echo""._WSOPAPR.""; ?></option>
    <option value="deny"><? echo""._WSOPDNY.""; ?></option>
  </select></tr>
    <tr><td valign="top"><b><? echo""._WSCOMM.":"; ?></b></td><td><textarea name="comments" cols="30" rows="5"></textarea></td></tr>
	<tr><td height="20" colspan="2"><b><? echo""._WSNOTIFY.":"; ?></b><input type="checkbox" name="wsnotify" value="1" checked><b><? echo""._WSADDCOMM.":"; ?></b><input type="checkbox" name="addcom" value="2" checked></td></tr>
	<tr><td height="20"></td><td align="left"><input type="submit" name="submit" value="Update"></td></tr>
	</table>
	</form>
	<?
	CloseTable();
	include("footer.php");
}
//END
//ADD SUBSCRIBERS
function ws_subuseradddb($userid, $subexp, $lname, $fname, $datetime, $rest, $wsem, $status, $comments, $wsnotify, $addcom, $wsaid, $sub_id, $sub_type){
global $prefix, $user_prefix, $db, $admin;
    if($status =="deny"){
	if (is_admin($admin)) {
$db->sql_query("DELETE from ".$prefix."_ws_subscriptions_pend where id='$wsaid'");
if($wsnotify !=""){
	$msg = "$sitename "._SUBSCR."\n\n";
	$msg .= ""._SUBMAINCAN."\n\n";
	if($addcom !=""){
	$msg .= ""._WSADMINNOTE.": $comments\n\n";
	}
	$to = $wsem;
	$mailheaders = "From: $sitename <Subscription>\n";
	$mailheaders .= "Reply-To: $adminmail\n\n";
	mail($to, $subject, $msg, $mailheaders);
}
}else{
echo"Access Denied";
}
Header("Location: admin.php?op=ws_subscr");
	}
	
	if($status =="approve"){
	if (is_admin($admin)) {
$row = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='$userid'"));
if ($row['userid'] != "" AND $sub_type=="Nuke") {
$wsexpnew = $subexp;
				$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire+$wsexpnew WHERE userid='$userid'");
				}
				elseif($row['userid'] == "" AND $sub_type=="Nuke"){
$wsexpnew1 = $subexp+time();
    $db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$userid', '$wsexpnew1')");
}

list($wsnsngid, $wsnsnid) = $db->sql_fetchrow($db->sql_query("SELECT gid, uid FROM ".$prefix."_nsngr_users WHERE uid='$userid' AND gid='$sub_id'"));
if($wsnsngid !="" AND $sub_type=="NSN"){
$wsexpnew = $subexp;
$db->sql_query("update ".$prefix."_nsngr_users set  edate= edate+$wsexpnew WHERE uid='$userid' AND gid='$sub_id'");
}
elseif($wsnsngid =="" AND $sub_type=="NSN"){
$ntime = time();
$wsexpnew1 = $subexp+time();
list($nsnuname) = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='$userid'"));
$db->sql_query("insert into ".$prefix."_nsngr_users values ('$sub_id', '$userid', '$nsnuname', '', '', '$ntime', '$wsexpnew1')");
}
if($wsnotify !=""){
	$msg = "$sitename "._SUBSCR."\n\n";
	$msg .= ""._SUBMAINACC."\n\n";
	if($addcom !=""){
	$msg .= ""._WSADMINNOTE.": $comments\n\n";
	}
	$to = $wsem;
	$mailheaders = "From: $sitename <Subscription>\n";
	$mailheaders .= "Reply-To: $adminmail\n\n";
	mail($to, $subject, $msg, $mailheaders);
}
$db->sql_query("DELETE from ".$prefix."_ws_subscriptions_pend where id='$wsaid'");
}else{
echo"Access Denied";
}
Header("Location: admin.php?op=ws_subscr");
	}
	}
//WS CONFIGURATION
function ws_config(){
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;
include("header.php");
	ws_adminsubscr();
$sql = "SELECT * FROM ".$prefix."_ws_subconfig";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
//Auto process selected
	OpenTable();
	?>
	<form action="admin.php?op=ws_upconfig" method="post">
	<table width="95%" border="0" cellpadding="1" cellspacing="1" align="center" bgcolor="<? echo $bgcolor1; ?>">
	<tr><td align="center" colspan="2" valign="middle"><?= "<h3>"._WSCONFIG."</h3>"; ?><br></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSAUTOPROCESS."</b><br><i><font color='".$textcolor1."'>("._WSAUTOPROCESSDSC.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="radio" name="autoprocess" value="0" <? if($row['app_memb'] ==0){ echo "checked"; } ?>><? echo ""._WSON.""; ?> <input type="radio" name="autoprocess" value="1" <? if($row['app_memb'] ==1){ echo "checked"; } ?>><?= ""._OFF.""; ?></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor1; ?>"><?= "<b>"._WSSBOX."</b><br><i><font color='".$textcolor1."'>("._WSSBOXDSC.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor1; ?>"><input type="radio" name="wssbox" value="1" <? if($row['ws_sbox'] ==1){ echo "checked"; } ?>><?= ""._WSON.""; ?> <input type="radio" name="wssbox" value="0" <? if($row['ws_sbox'] ==0){ echo "checked"; } ?>><?= ""._OFF.""; ?></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSNSN."</b><br><i><font color='".$textcolor1."'>("._WSNSNDSC.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="radio" name="wsnsn" value="1" <? if($row['ws_nsn'] ==1){ echo "checked"; } ?>><?= ""._WSON.""; ?> <input type="radio" name="wsnsn" value="0" <? if($row['ws_nsn'] ==0){ echo "checked"; } ?>><?= ""._OFF.""; ?></td></tr>
<tr><td width="50%" bgcolor="<?= $bgcolor1; ?>"><?= "<b>"._WSNUSER."</b><br><i><font color='".$textcolor1."'>("._WSNUSERTXT.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor1; ?>"><input type="radio" name="wsnuser" value="1" <? if($row['ws_usersup'] ==1){ echo "checked"; } ?>><?= ""._WSON.""; ?> <input type="radio" name="wsnuser" value="0" <? if($row['ws_usersup'] ==0){ echo "checked"; } ?>><?= ""._OFF.""; ?></td></tr>
<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSSUBDCOUNT."</b><br><i><font color='".$textcolor1."'>("._WSSUBDCOUNTTXT.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="text" name="wssubscrcount" value="<?= $row['ws_subscrcount']; ?>" size="5"></td></tr>
<tr><td width="50%" bgcolor="<?= $bgcolor1; ?>"><?= "<b>"._WSSUBUCOUNT."</b><br><i><font color='".$textcolor1."'>("._WSSUBUCOUNTTXT.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor1; ?>"><input type="text" name="wsusersubct" value="<?= $row['ws_usersubct']; ?>" size="5"></td></tr>
<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSEARCOUNT."</b><br><i><font color='".$textcolor1."'>("._WSEARCOUNTTXT.")</font></i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="text" name="wsearnct" value="<?= $row['ws_earnct']; ?>" size="5"></td></tr>
	
	<tr><td colspan="2" align="center"><input type="submit" value="Change"></td></tr>
	</table>
	</form>
	<?
	CloseTable();
include("footer.php");
}
//END
//UPDATE CONFIG VALUES
function ws_upconfig($autoprocess, $wssbox, $wsnsn, $wsnuser, $wssubscrcount, $wsusersubct, $wsearnct){
global $prefix, $db, $admin;
if (is_admin($admin)) {
$db->sql_query("update ".$prefix."_ws_subconfig set app_memb='$autoprocess', ws_sbox='$wssbox', ws_nsn='$wsnsn', ws_usersup='$wsnuser', ws_subscrcount='$wssubscrcount', ws_usersubct='$wsusersubct', ws_earnct='$wsearnct'");
Header("Location: admin.php?op=ws_config");
}
else{
echo "Access Denied"; 
}
}
//END	
//SETUP SUBSCRIPTION
function ws_addsubscrtype(){
global $prefix, $db, $bgcolor1, $bgcolor2;
include("header.php");
	ws_adminsubscr();

	OpenTable();
	
	?>
	<table width="100%" align="center" cellpadding="1" cellspacing="1" border="0" bgcolor="<? echo "".$bgcolor1.""; ?>">
	<tr><td colspan="8" align="center" bgcolor="<? echo "".$bgcolor2.""; ?>"><? echo "<b>"._WSSUBSET."</b>"; ?><br><br></td></tr>
	<tr><th></th><th width="20%" height="20"><b><? echo""._WSSUBNAME.""; ?></b></th><th width="40%"><b><? echo""._WSSUBDESC.""; ?></b></th><th width="7%" align="center" ><b><? echo""._WSSUBCOST.""; ?></b></th><th width="10%" align="center" ><b><? echo""._WSSUBPD.""; ?></b></th><th width="7%" align="center" ><b><? echo""._WSSUBENB.""; ?></b></th><th width="6%" align="center"><b><? echo ""._WSWEIGHT.""; ?></b></th><th width="10%" align="center"><b><? echo""._WSSUBUPD.""; ?></b></th></tr>
	<?
	$wssubisplay = $db->sql_fetchrow($db->sql_query("SELECT ws_subscrcount FROM ".$prefix."_ws_subconfig"));
	$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_subscription"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit($wssubisplay[ws_subscrcount]);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
list($wsnsngrsc) = $db->sql_fetchrow($db->sql_query("SELECT ws_nsn FROM ".$prefix."_ws_subconfig"));
if($wsnsngrsc !=0){
$gthan =">=0";
}
else{
$gthan ="=0";
}
	$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_subscription WHERE ws_nsngr$gthan"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit($wssubisplay[ws_subscrcount]);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
	$result = $db->sql_query("select ws_id, sub_name, sub_description, sub_cost, wsn, wsp, sub_enabled, ws_weight, ws_nsngr, ws_trial, ws_trial_dmy, ws_trial_lgth from ".$prefix."_ws_subscription WHERE ws_nsngr$gthan ORDER BY ws_weight ASC LIMIT $limit1, $limit2");
	while(list($ws_id, $sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $ws_weight, $ws_nsngr, $ws_trial, $ws_trial_dmy, $ws_trial_lgth) = $db->sql_fetchrow($result)) {
if($sub_enabled !=""){
$suben ="<span id=\"alImg4\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/able.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/able.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
}
else{
$suben ="<span id=\"alImg3\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/nable.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/nable.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
}
	?>
		<tr><td bgcolor="<? echo "".$bgcolor2.""; ?>"><?= "<span id=\"alImg5\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/subs.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/subs.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" height="20"><? echo"$sub_name"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>"><? echo"$sub_description"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo""._CURR."$sub_cost"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"$wsn  $wsp"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"<a href='admin.php?op=ws_substatus&amp;ws_id=$ws_id&sub_enabled=$sub_enabled' title='"._WSACTV."'>$suben</a>"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo $ws_weight; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"<a href='admin.php?op=ws_editsubtype&ws_id=$ws_id'><span id=\"alImg1\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/mod.png'); \">
<img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/mod.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a><a href='admin.php?op=ws_subscrdel&ws_id=$ws_id'><span id=\"alImg2\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/del.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/del.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a>"; ?> </td></tr>
		<?
		}
		?>
	</table>
	<br><br><br>
	<?
	CloseTable();
	echo "<br>";
OpenTable();
if($a->getCurrent()==1)
		         {
		         $first = "First | ";
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_addsubscrtype&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_addsubscrtype&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_addsubscrtype&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_addsubscrtype&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				  CloseTable();
		list($wsnsngr) = $db->sql_fetchrow($db->sql_query("SELECT ws_nsn FROM ".$prefix."_ws_subconfig"));
	if($wsnsngr !=0){
				  echo "<br>";
				  OpenTable();
				  ?>
	<form name="form1" action="admin.php?op=ws_addsubscrtype" method="post">
	<table width="70%" border="0" cellpadding="0" align="center">
	<tr><th colspan="2"><?= ""._WSNSN.""; ?></th></tr>
	<tr><td width="30%" bgcolor="<? echo "".$bgcolor2.""; ?>"><?= ""._WSNSN.""; ?></td><td align="left" bgcolor="<? echo "".$bgcolor2.""; ?>"><? 
	echo '<select name="sub_namex" onChange="document.form1.submit()">'
        .'<option value="">'._WSSELECT.'</option>';
	$resultx = $db->sql_query("SELECT `gid`, `gname` FROM `".$prefix."_nsngr_groups` ORDER BY `gname`");
	while(list($gidx, $gnamex) = $db->sql_fetchrow($resultx)) {
	echo '<option value="'.$gidx.'">'.$gnamex.'</option>';
	}
	echo "</select><br><i>"._WSSELECTDSC."</i>";
	?></td></tr>
	</table>
	</form>
				  <?
				  CloseTable();
				  }
				  echo "<br>";
				  OpenTable();
	echo "<table border='0' width='70%' align='center'>";
    echo"<tr><td colspan='2' align='center'><font class=\"option\"><b>"._ADDWSSUB."</b><br><br>
	<form action=\"admin.php?op=ws_addsubscrtype_add\" method=\"post\"></td></tr><tr><td width='30%' valign='top' bgcolor='".$bgcolor2."'>
	"._WSSUBNAME.":</td><td bgcolor='".$bgcolor2."'>";
	$mpost = $_POST['sub_namex'];
	list($gid, $gname, $gdesc) = $db->sql_fetchrow($db->sql_query("SELECT `gid`, `gname`, `gdesc` FROM `".$prefix."_nsngr_groups` WHERE gid='$mpost'"));
	echo '<input type="text" name="sub_name" size="15" maxlength="60" value="'.$gname.'">';
	echo '<input type="hidden" name="gid" value="'.$gid.'">';
	echo "<br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top' bgcolor='".$bgcolor1."'>
	"._WSSUBDESC.":</td><td bgcolor='".$bgcolor1."'>";
	
	echo "<textarea name=\"sub_description\" cols=\"35\" rows=\"6\">".$gdesc."</textarea><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td valign='top'>"._WSSUBCOST.": </td><td><input type=\"text\" name=\"sub_cost\" size=\"15\" maxlength=\"60\" value=\"0.00\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td valign='top'>"._WSSUBPD.": </td><td><select name='wsn'><option>--</option<option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option></select>       <select name='wsp'><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	</td></tr>
	<tr bgcolor='".$bgcolor2."'><td width='30%' valign='top'>"._WSTRIAL.":</td><td> <input name='ws_trial1' type='checkbox' value='1'>"._ON."/"._OFF."&nbsp;&nbsp;&nbsp;<select name='ws_trial_lgth1'><option>--</option><option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option></select>       <select name='ws_trial_dmy1'><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>
	"._WSWEIGHT.":</td><td> <input type=\"text\" name=\"wsweigh\" size=\"5\" maxlength=\"11\" value=\"0\"><br><br></td></tr><tr bgcolor='".$bgcolor2."'><td width='30%' valign='top'>
	"._WSIMAGE.":</td><td> <input type=\"text\" name=\"wsimage\" size=\"50\" maxlength=\"255\" value=\"modules/WS_Subscription/images/subimg.jpg\"><br><br></td></tr><tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>"._WSSUBENB.":</td><td> <input name='sub_enabled' type='checkbox' value='checked' checked><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td><input type=\"hidden\" name=\"op\" value=\"ws_addsubscrtype_add\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
include("footer.php");
}
function ws_addsubscrtype_add($sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $gid, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1){
global $prefix, $db, $admin;
include("header.php");
OpenTable();
if($sub_name ==""){
echo "Please enter subscription name.   "._GOBACK."";
}
else if($sub_description ==""){
echo "Please enter a description.   "._GOBACK."";
}
else if($sub_cost ==""){
echo "Enter the cost per period.   "._GOBACK."";
}
else{
if (is_admin($admin)) {
    $db->sql_query("insert into ".$prefix."_ws_subscription values (NULL, '$sub_name', '$sub_description', '$sub_cost', '$wsn', '$wsp', '$sub_enabled', '$wsweigh', '$wsimage', '$gid', '$ws_trial1', '$ws_trial_dmy1', '$ws_trial_lgth1')");
	}else{
	echo"Access Denied";
	}
    Header("Location: admin.php?op=ws_addsubscrtype");
}
CloseTable();
include("footer.php");
}
//EDIT SUBSCRIPTION TYPE
function ws_editsubtype($ws_id){
global $prefix, $db;
include("header.php");
ws_adminsubscr();
 $sql = "SELECT * FROM ".$prefix."_ws_subscription WHERE ws_id='$ws_id'";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
OpenTable();
	echo "<table border='0' width='70%' align='center'>";
    echo"<tr><td colspan='2' align='center'><font class=\"option\"><b>"._EDITWSSUB."</b><br><br>
	<form action=\"admin.php?op=ws_editsubtype_edit\" method=\"post\"></td></tr><tr><td width='30%' valign='top'>
	"._WSSUBNAME.":</td><td><input type='hidden' name='gid' value='$row[ws_nsngr]'> <input type=\"text\" name=\"sub_name\" size=\"30\" maxlength=\"60\" value=\"$row[sub_name] \" ><br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top'>
	"._WSSUBDESC.":</td><td> <textarea name=\"sub_description\" cols=\"35\" rows=\"6\">$row[sub_description]</textarea><br><br></td></tr>
	<tr><td valign='top'>"._WSSUBCOST.": </td><td><input type=\"text\" name=\"sub_cost\" size=\"15\" maxlength=\"60\" value=\"$row[sub_cost]\"><br><br></td></tr>
	<tr><td valign='top'>";
	echo ""._WSSUBPD.": </td><td><select name='wsn'>
	<option value='$row[wsn]'>$row[wsn]</option>
	<option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option></select>       <select name='wsp'><option value='$row[wsp]'>$row[wsp]</option><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	</td></tr>
	<tr><td width='30%' valign='top'>";
	if($row[ws_trial] ==1){$wscheck ="checked";}
	echo ""._WSTRIAL.":</td><td> <input name='ws_trial1' type='checkbox' value='1' $wscheck>"._ON."/"._OFF."&nbsp;&nbsp;&nbsp;<select name='ws_trial_lgth1'>";
	if($row[ws_trial] ==0 AND $row[ws_trial_lgth] ==""){
	echo "<option>--</option>";
	}else{
	echo "<option value='$row[ws_trial_lgth]'>$row[ws_trial_lgth]</option>";
	}
	echo "<option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option></select><select name='ws_trial_dmy1'>";
	if($row[ws_trial_dmy] !=""){
	echo "<option value='$row[ws_trial_dmy]'>$row[ws_trial_dmy]</option>";
	}
	echo "<option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	<tr><td width='30%' valign='top'>
	"._WSWEIGHT.":</td><td> <input type='text' name='wsweigh' value='$row[ws_weight]' size='5'><br><br></td></tr>
	<tr><td width='30%' valign='top'>
	"._WSIMAGE.":</td><td> <input type='text' name='wsimage' value='$row[ws_img]' size='50' maxlenght='255'><br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top'>";
	if($row[sub_enabled] =="checked"){$wscheck2 ="checked";}
	echo ""._WSSUBENB.":</td><td> <input name='sub_enabled' type='checkbox' value='$row[sub_enabled]' $wscheck2><br><br></td></tr>
	<tr><td><input type=\"hidden\" name=\"op\" value=\"ws_editsubtype_edit\"><input type=\"hidden\" name=\"ws_id\" value=\"$ws_id\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
	include("footer.php");

}
//END
//ADD EDITED SUBSCRIPTIONS
function ws_editsubtype_edit($ws_id, $sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $gid, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1){
global $prefix, $db, $admin;
include("header.php");
OpenTable();
if($sub_name ==""){
echo "Please enter subscription name.   "._GOBACK."";
}
else if($sub_description ==""){
echo "Please enter a description.   "._GOBACK."";
}
else if($sub_cost ==""){
echo "Enter the cost per period.   "._GOBACK."";
}
else{
if (is_admin($admin)) {
if($ws_trial1 ==""){$wstrial1 ="0";} else{$wstrial1 ="1";}
$db->sql_query("update ".$prefix."_ws_subscription set sub_name='$sub_name', sub_description='$sub_description', sub_cost='$sub_cost', wsn='$wsn', wsp='$wsp', sub_enabled='$sub_enabled', ws_weight='$wsweigh', ws_img='$wsimage',  ws_nsngr='$gid', ws_trial='$wstrial1',  ws_trial_dmy='$ws_trial_dmy1',  ws_trial_lgth='$ws_trial_lgth1'  where ws_id='$ws_id'");
}else{
echo"Access Denied";
}
     Header("Location: admin.php?op=ws_addsubscrtype");
}
CloseTable();
include("footer.php");
}
//Delete SUBSCRIPTION
function ws_subscrdel($ws_id){
global $prefix, $db, $admin;
include("header.php");
if (is_admin($admin)) {
$db->sql_query("DELETE from ".$prefix."_ws_subscription where ws_id='$ws_id'");
Header("Location: admin.php?op=ws_addsubscrtype");
}
else {
OpenTable();
echo "Access Denied";
CloseTable();
}
include("footer.php");
}
//SETUP PAYPAL
function ws_paypalsetup(){
global $prefix, $db, $bgcolor1, $bgcolor2;
include("header.php");
	ws_adminsubscr();
	   $sql = "SELECT id, paypal_email, paypal_bg_color, paypal_currency FROM ".$prefix."_ws_paypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	OpenTable();
	?>
	<table width="90%" align="center" cellpadding="1" cellspacing="1" border="0" >
	<tr><td colspan="3" align="center"><?="<b>"._PAYPALDETAILS."</b>"; ?></td></tr>
	<tr><th align="center" bgcolor="<?="".$bgcolor1.""; ?>" height="20"><?="<b>"._PAYPALEMAIL."</b>"; ?></th><th align="center" bgcolor="<?="".$bgcolor1.""; ?>"><?="<b>"._PAYPALCOLOR."</b>"; ?></th><th align="center" bgcolor="<?="".$bgcolor1.""; ?>"><?="<b>"._PAYPALCURC."</b>"; ?></th></tr>
	<tr><td width="33%" valign="middle" align="center" height="25" bgcolor="<?="".$bgcolor2.""; ?>"><?="$row[paypal_email]"; ?></td><td width="33%" valign="middle" align="center" bgcolor="<?="".$bgcolor2.""; ?>"><?="".$row['paypal_bg_color'].""; ?></td><td width="33%" valign="middle" align="center" bgcolor="<?="".$bgcolor2.""; ?>"><?="".$row['paypal_currency'].""; ?></td></tr>
</table>
	<?
	CloseTable();
	echo "<br>";
	OpenTable();
	echo "<table border='0' width='70%' align='center'>";
    echo"<tr><td colspan='2' align='center'><font class=\"option\"><b>"._ADDPAYPAL."</b><br><br>
	<form action=\"admin.php?op=ws_paypalsetupadd\" method=\"post\"></td></tr><tr bgcolor='".$bgcolor2."'><td width='30%'>
	"._PAYPALEMAIL.":</td><td> <input type=\"text\" name=\"paypal_email\" size=\"30\" maxlength=\"60\" value=\"$row[paypal_email]\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td>"._PAYPALCOLOR.": </td><td><input type=\"text\" name=\"paypal_bg_color\" size=\"15\" maxlength=\"60\" value=\"W\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td>"._PAYPALCURC.": </td><td><input type=\"text\" name=\"paypal_currency\" size=\"15\" maxlength=\"60\" value=\"USD\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td><input type=\"hidden\" name=\"op\" value=\"ws_paypalsetupadd\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
include("footer.php");
}
//END
//PAYPAL ADD
function ws_paypalsetupadd($paypal_email, $paypal_bg_color, $paypal_currency){
global $prefix, $db, $admin;
include("header.php");
OpenTable();
if($paypal_email ==""){
echo "Please enter your paypal email.   "._GOBACK."";
}
else if($paypal_bg_color ==""){
echo "Please enter a background color for your paypal page.   "._GOBACK."";
}
else if($paypal_currency ==""){
echo "Please enter a Currency.   "._GOBACK."";
}
else{
		$wscountem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_paypal"));
			if ($wscountem != 0) {
			if (is_admin($admin)) {
				$db->sql_query("update ".$prefix."_ws_paypal set paypal_email='$paypal_email', paypal_bg_color='$paypal_bg_color', paypal_currency='$paypal_currency'");
				}else{
				echo"Access Denied";
				}
				Header("Location: admin.php?op=ws_paypalsetup");
		}
			else{
			if (is_admin($admin)) {
    $db->sql_query("insert into ".$prefix."_ws_paypal values (NULL, '$paypal_email', '$paypal_bg_color', '$paypal_currency')");
	}else{
	echo"Access Denied";
	}
    Header("Location: admin.php?op=ws_paypalsetup");
	}
}
CloseTable();
include("footer.php");
}
//END
//SUBSCRIBERS MEMBERS
function ws_searchuser(){
global $prefix, $user_prefix, $db;
echo "<body bgcolor=\"#ffffff\" text=\"#666666\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
?>
<style type="text/css">
/* Form elements */

FONT	{FONT-FAMILY: Verdana,Helvetica; FONT-SIZE: 10px}
input,textarea, select {
	color : #000000;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	border:1px solid; border-color:#999999 #999999 #999999 #999999; BACKGROUND: #F0F0F0;
}

/* The text input fields background colour */
input.post, textarea.post, select {
	background-color : #F0F0F0;
}

input { text-indent : 2px; }

/* The buttons used for bbCode styling in message post */
input.button {
	color : #000000;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	border:1px solid; border-color:#999999 #999999 #999999 #999999; BACKGROUND: #F0F0F0;
}

/* The main submit button option */
input.mainoption {
	color : #000000;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	border:1px solid; border-color:#999999 #999999 #999999 #999999; BACKGROUND: #F0F0F0;
}

/* None-bold submit button */
input.liteoption {
	color : #000000;
	font: normal 11px Verdana, Arial, Helvetica, sans-serif;
	border:1px solid; border-color:#999999 #999999 #999999 #999999; BACKGROUND: #F0F0F0;
}
</style>
<form name="form1" id="form1" method="post" action="<? $php_self ?>">
<table width="100%" border="0" cellspacing="1" cellpadding="2">
<tr>
<td style="text-align: center;">
<input name="search" type="text" id="search" />
</td>
</tr>
<tr>
<td style="text-align: center;">
<input name="submit" type="submit" id="submit" value="Search!" />
</td>
</tr>
</table>
</form>

<?
$search = htmlspecialchars(addslashes($_POST['search']), ENT_QUOTES);
if(isset($_POST['submit'])) {
if(!$search) {
echo ""._WSNOSEARCH."";
}
else {
$query = mysql_query("SELECT * FROM ".$user_prefix."_users WHERE username LIKE '%$search%'");
$resultnum = mysql_num_rows($query); // Just print $resultnum if you want to show how many results returned

if($resultnum>0) { // Echos out matches if anything was found

while($row=mysql_fetch_array($query)) { // Starts spitting out the data

echo ""._WSUEXIST."";

}
}
else{
echo ""._WSUNOEXIST."";
}
}
}
else {
echo "<p>"._WSSEARCHSOME."</p>";
}
}
function ws_submemb(){
global $prefix, $user_prefix, $db, $bgcolor1, $bgcolor2;
include("header.php");
ws_adminsubscr();
OpenTable();
?>
<form action="admin.php?op=ws_submembuser_add" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="<?= $bgcolor1; ?>">
<tr><td align="center" colspan="3"><?= "<b><h4>"._WSADDUSER."</h4></b>"; ?></td></tr>
<tr><th bgcolor="<?= $bgcolor2; ?>" height="18"><?= "<b>"._WSNICKNAME."</b>"; ?> 

</th><th bgcolor="<?= $bgcolor2; ?>" align="center"><?= "<b>"._WSSUBPD."</b>"; ?></th><th bgcolor="<?= $bgcolor2; ?>" align="center"><?= "<b>"._WSSUBUPD."</b>"; ?></th></tr>
<tr><td bgcolor="<?= $bgcolor2; ?>" height="18" align="center"><input type="text" name="wsnuser" size="20"><a a href="admin.php?op=ws_searchuser" onclick="window.open('admin.php?op=ws_searchuser','Search User','width=350,height=180,left=50,top=50,toolbar=no,status=no,scrollbars=yes,resizable=no ,menubar=no,location=no');return false;"><?= _WSSUSER; ?></a></td><td bgcolor="<?= $bgcolor2; ?>" align="center"><select name='wsn'><option>--</option><option value='1'>1</option>
    <option value='2'>2</option>
    <option value='3'>3</option>
    <option value='4'>4</option>
    <option value='5'>5</option>
    <option value='6'>6</option>
    <option value='7'>7</option>
    <option value='8'>8</option>
    <option value='9'>9</option>
    <option value='10'>10</option>
    <option value='11'>11</option>
    <option value='12'>12</option>
    <option value='13'>13</option>
    <option value='14'>14</option>
    <option value='15'>15</option>
    <option value='16'>16</option>
    <option value='17'>17</option>
    <option value='18'>18</option>
    <option value='19'>19</option>
    <option value='20'>20</option>
    <option value='21'>21</option>
    <option value='22'>22</option>
    <option value='23'>23</option>
    <option value='24'>24</option>
    <option value='25'>25</option>
    <option value='26'>26</option>
    <option value='27'>27</option>
    <option value='28'>28</option>
    <option value='29'>29</option>
    <option value='30'>30</option></select>       <select name='wsp'><option value='day'><? echo ""._WSDAYS.""; ?></option>
	<option value='week'><? echo ""._WSWEEKS.""; ?></option>
	<option value='month'><? echo ""._WSMONTHS.""; ?></option>
	<option value='year'><? echo ""._WSYEARS.""; ?></option></select></td><td bgcolor="<? echo $bgcolor2; ?>" align="center"><input type="submit" value="<? echo ""._WSAU.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
echo "<br>";
OpenTable();
?>
<form action="admin.php?op=ws_submembuser_addall" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="<?= $bgcolor1; ?>" align="center">
<tr><td align="center" height="18" colspan="3"><?= "<b>"._WSUPDATESUB."</b>"; ?></td></tr>
<tr><th bgcolor="<?= $bgcolor2; ?>" height="17"><?= "<b>"._WSADDDAYS."</b>"; ?></th><th bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSMDAYS."</b>"; ?></th><th bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSSUBUPD."</b>"; ?></th></tr>
<tr><td bgcolor="<?= $bgcolor2; ?>" align="center"><input name="wsaddsuball" size="12"></td><td bgcolor="<?= $bgcolor2; ?>" align="center"><input name="wsminussuball" size="12" ></td><td bgcolor="<?= $bgcolor2; ?>" align="center"><input type="submit" value="<?= ""._UPDATE.""; ?>"></td></tr>
</table>
</form>
<?
CloseTable();
echo "<br>";
$wscountsubscr = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_subscriptions"));
if($wscountsubscr >=1){
OpenTable();
//paging
include("paginator_html.php");
$wssubydisplay = $db->sql_fetchrow($db->sql_query("SELECT ws_usersubct FROM ".$prefix."_ws_subconfig"));
$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_subscriptions"));
$a =& new Paginator($_GET['page'],$num_rows);
$a =& new Paginator_html($_GET['page'],$num_rows);
$a->set_Limit($wssubydisplay[ws_usersubct]);
$a->set_Links(3);
$limit1 = $a->getRange1();
$limit2 = $a->getRange2();
?>

<table cellpadding="1" cellspacing="1" border="0" width="100%" bgcolor="<? echo"".$bgcolor1.""; ?>">
<tr bgcolor="<? echo"".$bgcolor1.""; ?>"><td colspan="7"><form name="form1" id="form1" method="post" action="<? $php_self ?>">
<table width="30%" border="0" cellspacing="1" cellpadding="2" align="right">
<tr>
<td style="text-align: center;">
<input name="searchuid" type="text" id="searchuid" />
</td>
<td style="text-align: center;">
<input name="submit" type="submit" id="submit" value="Search!" />
</td>
</tr>
</table>
</form></td></tr>
<tr><th height="25" bgcolor="<? echo"".$bgcolor1.""; ?>" width="20"><b><? echo""._WSUSERID1.""; ?></b></th><th bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSNICKNAME.""; ?></b></th><th bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._PAYPALEMAIL.""; ?></b></th><th bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSEXPIRES.""; ?></b></th><th bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSADDDAYS.""; ?></b></th><th bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSMDAYS.""; ?></b></th><th align="center" bgcolor="<? echo"".$bgcolor1.""; ?>"><b><? echo""._WSSUBUPD.""; ?></b></th></tr>
<?
//ADD SEARCH
$searchuid = htmlspecialchars(addslashes($_POST['searchuid']), ENT_QUOTES);
if(isset($_POST['submit'])) {
if(!$searchuid) {
$wheresearch ="";
}
else {

$wheresearch = "WHERE u.username LIKE '%$searchuid%'";

}
}
else {
$wheresearch ="";
}

//ENDSEARCH
$result = $db->sql_query("SELECT s.userid, s.subscription_expire, u.user_id, u.username, name, user_email, user_viewemail FROM ".$prefix."_subscriptions AS s LEFT JOIN ".$user_prefix."_users AS u ON s.userid = u.user_id $wheresearch ORDER BY s.subscription_expire  ASC LIMIT $limit1, $limit2");
while(list($userid, $mysubscription_expire, $user_id, $username, $name, $user_email, $user_viewemail ) = $db->sql_fetchrow($result)) {
//Caculate expire date
	$mydiff = $mysubscription_expire-time();
		$myyearDiff = floor($mydiff/60/60/24/365);
		$mydiff -= $myyearDiff*60*60*24*365;
		if ($myyearDiff < 1) {
			$mydiff = $mysubscription_expire-time();
		}
		$mydaysDiff = floor($mydiff/60/60/24);
		$mydiff -= $mydaysDiff*60*60*24;
		$myhrsDiff = floor($mydiff/60/60);
		$mydiff -= $myhrsDiff*60*60;
		$myminsDiff = floor($mydiff/60);
		$mydiff -= $myminsDiff*60;
		$mysecsDiff = $mydiff;
		if ($myyearDiff < 1) {
			$myrest = "$mydaysDiff "._SBDAYS.", $myhrsDiff "._SBHOURS."";
		} elseif ($myyearDiff == 1) {
			$myrest = "$myyearDiff "._SBYEAR.", $mydaysDiff "._SBDAYS."";
		} elseif ($myyearDiff > 1) {
			$myrest = "$myyearDiff "._SBYEARS.", $mydaysDiff "._SBDAYS."";
		}
?>
<form action="admin.php?op=ws_submembupd" method="post">
<tr><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$user_id"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$username"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>" align="center"><? echo "<a href=\"mailto:$user_email\"><span id=\"alImg4\" style=\"width:20px;height:20px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/email.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Subscription/images/email.png\" width=\"20\" height=\"20\" border=\"0\" alt=\"\"></span></a>"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><? echo "$myrest"; ?></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><input name="wsaddsub" size="12"></td><td bgcolor="<? echo"".$bgcolor2.""; ?>"><input name="wsminsub" size="12"></td><td align="center" bgcolor="<? echo"".$bgcolor2.""; ?>"><select name="wsfunc">
    <option value="1"><? echo ""._MODIFY.""; ?></option>
    <option value="0"><? echo ""._DEL.""; ?></option>
  </select>  
  <?
  echo "<input type=\"hidden\" name=\"user_id\" value=\"$user_id\">";
  echo "<input type=\"hidden\" name=\"op\" value=\"ws_submembupd\">";
  ?>
  <input type="submit" value="<? echo ""._UPDATE.""; ?>"></td></tr>
  </form>
<?

}
?>
</table>

<?
echo "<br>";
CloseTable();
echo "<br>";
OpenTable();
$a->previousNext();
CloseTable();
}
else{
OpenTable();
echo"<center>"._WSNOUSER."</center>";
CloseTable();
}
include("footer.php");
}
function ws_submembupd($user_id, $wsaddsub, $wsminsub, $wsfunc){
global $prefix, $admin, $db;
if (is_admin($admin)) {
if($wsfunc ==0){
$db->sql_query("DELETE from ".$prefix."_subscriptions where userid='$user_id'");
Header("Location: admin.php?op=ws_submemb");
}
if($wsaddsub !="" AND $wsfunc ==1){
$wsaddsubamt = $wsaddsub * 86400;
$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire+$wsaddsubamt where userid=$user_id");
				Header("Location: admin.php?op=ws_submemb");
}
if($wsminsub !="" AND $wsfunc ==1){
$wsminsubamt = $wsminsub * 86400;
$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire-$wsminsubamt where userid=$user_id");
				Header("Location: admin.php?op=ws_submemb");
}
}else{
echo "Access Denied";
}
}
function ws_submembuser_add($wsnuser, $wsn, $wsp){
global $prefix, $admin, $user_prefix, $db;
include("header.php");

ws_adminsubscr();
OpenTable();
list($wsunam) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='$wsnuser'"));
if($wsunam ==""){
echo "<center>"._WSNOUSER1."</center>";
}
else{
list($wsud) = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='$wsunam'"));
if($wsud !=""){
echo "<center>"._WSUSEREX."</center>";
}
else{
	  if($wsp =="day"){
	  $wstime ="86400";
	  }
	  elseif($wsp =="week"){
	  $wstime ="604800";
	  }
	  elseif($wsp =="month"){
	  $wstime ="2629743.83";
	  }
	  elseif($wsp =="year"){
	  $wstime ="31556926";
	  }
      $wsperiod = $wstime * $wsn;
	  
$wsexpnew = $wsperiod+time();
    $db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$wsunam', '$wsexpnew')");
	Header("Location: admin.php?op=ws_submemb");
}
}
CloseTable();
include("footer.php");
}
//END
//UPDATE ALL USERS
function ws_submembuser_addall($wsaddsuball, $wsminussuball){
global $prefix, $admin, $user_prefix, $db;
include("header.php");
if (is_admin($admin)) {
ws_adminsubscr();
OpenTable();
if($wsaddsuball !=""){
$wsaddsubamt = $wsaddsuball * 86400;
$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire+$wsaddsubamt");
				Header("Location: admin.php?op=ws_submemb");
}
if($wsminussuball !=""){
$wsminsubamt = $wsminussuball * 86400;
$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire-$wsminsubamt");
				Header("Location: admin.php?op=ws_submemb");
}

CloseTable();
}else{
echo "Access Denied";
}
include("footer.php");
}
function ws_earnings(){
global $prefix, $admin, $user_prefix, $db, $bgcolor1, $bgcolor2;
include("header.php");
ws_adminsubscr();
list($total1, $total2) = $db->sql_fetchrow($db->sql_query("SELECT SUM(payment_gross), SUM(payment_fee) FROM ".$prefix."_ws_paypal_ipn"));
$tgross ="$total1"-"$total2";
OpenTable();
?>
<table width="98%" border="0" align="center" cellpadding="1">
<tr><td align="center" colspan="5"><?= "<h3>"._WSEARNINGS."</h3>"; ?></td><td><?= "<b>"._WSTOTAL.":  $$tgross</b>"; ?></td></tr>
<tr><th width="15"><?= "<b>"._ID."</b>"; ?></th><th><?= "<b>"._WSSUBNAME."</b>"; ?></th><th><?= "<b>"._PAYPALEMAIL."</b>"; ?></th><th><?= "<b>"._WSPACK."</b>"; ?></th><th><?= "<b>"._WSGROSS."</b>"; ?></th><th><?= "<b>"._DATE."</b>"; ?></th></tr>

<?
$wseardisplay = $db->sql_fetchrow($db->sql_query("SELECT ws_earnct FROM ".$prefix."_ws_subconfig"));
$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_paypal_ipn"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit($wseardisplay[ws_earnct]);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
$result = $db->sql_query("SELECT  paypal_ipn_id,  first_name,  last_name,  payer_email, date_added, item_name, payment_gross, payment_fee FROM ".$prefix."_ws_paypal_ipn ORDER BY paypal_ipn_id DESC LIMIT $limit1, $limit2");
while(list($paypal_ipn_id, $first_name, $last_name, $payer_email, $date_added, $item_name, $payment_gross, $payment_fee) = $db->sql_fetchrow($result)) {
$wsgross = "$payment_gross"-"$payment_fee";
?>
<tr bgcolor="<?= $bgcolor2; ?>">
<td width="21" height="21"><?= $paypal_ipn_id; ?></td>
<td><?= "$first_name  $last_name"; ?></td>
<td><?= $payer_email; ?></td>
<td><?= $item_name; ?></td>
<td><?= ""._CURR."$wsgross"; ?></td>
<td><?= $date_added; ?></td>
</tr>
<?
}
?>
</table>
<?
CloseTable();
echo "<br>";
OpenTable();
if($a->getCurrent()==1)
		         {
		         $first = "First | ";
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_earnings&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_earnings&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_earnings&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_earnings&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				  CloseTable();
include("footer.php");
}
function ws_substatus($ws_id, $sub_enabled) {
    global $prefix, $db;
    if ($sub_enabled == "checked") {
	$active = "";
    } else {
	$active = "checked";
    }
    $ws_id = intval($ws_id);
    $db->sql_query("update " . $prefix . "_ws_subscription set  sub_enabled='$active' WHERE ws_id='$ws_id'");
    Header("Location: admin.php?op=ws_addsubscrtype");
}
function ws_stats(){
global $prefix, $db, $sitename, $user, $cookie, $group_id, $user_prefix, $admin;
//if(is_admin($admin)){
list($total1, $total2) = $db->sql_fetchrow($db->sql_query("SELECT SUM(payment_gross), SUM(payment_fee) FROM ".$prefix."_ws_paypal_ipn"));
$tgross ="$total1"-"$total2";
 $rString = "&total="._CURR."".$tgross;
 $num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_subscriptions"));
 list($wsnsngrsc) = $db->sql_fetchrow($db->sql_query("SELECT ws_nsn FROM ".$prefix."_ws_subconfig"));
if($wsnsngrsc !=0){
$num_rows4 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_nsngr_users"));
$nuserss = "$num_rows4"+"$num_rows";
$result3ws = $db->sql_query("SELECT uname FROM ".$prefix."_nsngr_users ORDER BY uname DESC LIMIT 0, 3");
$trows = mysql_num_rows($result3ws);
$rString .= "&t=".$trows;
for ($i=0; $i < $trows; $i++) {
$row2 = mysql_fetch_array($result3ws);
$rString .= "&newnsnmb".$i."=".$row2['uname'];
}
$rString .= "&nsntitle=Latest NSN:";
}else{
$nuserss = $num_rows;
$rString .= "&nsntitle=";
}

$rString .= "&memb=".$nuserss;
 $num_rows2 = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_subscriptions_pend"));
 $rString .= "&membpend=".$num_rows2;
$result = $db->sql_query("SELECT s.id, s.userid, u.user_id, u.username FROM ".$prefix."_subscriptions AS s LEFT JOIN ".$user_prefix."_users AS u ON s.userid = u.user_id ORDER BY s.id DESC LIMIT 0, 3");
$nrows = mysql_num_rows($result);
$rString .= "&n=".$nrows;
for ($i=0; $i < $nrows; $i++) {
$row = mysql_fetch_array($result);
$rString .= "&newmb".$i."=".$row['username'];
}
 
 echo $rString;
}
include("switches.php");
}
else{
echo "Access Denied";
}
?>