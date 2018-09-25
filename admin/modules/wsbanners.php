<?php
/****************************************************************/
/*                  COPYRIGHT NOTICE!                           */
/*This script is designed by Western Studios and is copyrighted */
/*2004-2020. All rights reserved. Please do not claim this      */
/*      script as yours.DO NOT RE-DISTRIBUTE.                   */
/*          http://www.westernstudios.net                       */
/****************************************************************/
/*             ..::Advertisement Module::..                     */
/****************************************************************/


if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
$result = sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'", $dbi);
list($radminsuper) = sql_fetch_row($result, $dbi);
if ($radminsuper==1) {
global $prefix, $db, $bgcolor1;
include("paginator.php");
require("./ws_core/inc/upload.inc.php");
function ws_banadmin(){
OpenTable();
?>
<center>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="380" height="250" id="ws_ads" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="modules/WS_Banners/images/ws_ads.swf" />
<param name="quality" value="high" />
<param name="bgcolor" value="#ffffff" />
<param name="wmode" value="transparent">
<embed src="modules/WS_Banners/images/ws_ads.swf" quality="high" bgcolor="#ffffff" width="380" height="250" name="ws_ads" align="middle" allowScriptAccess="sameDomain" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</center>
<?
CloseTable();
}
function ws_banneradmin(){
global $textcolor1, $bgcolor1, $bgcolor2, $prefix, $dbi;
include("header.php");
ws_banadmin();	

include("footer.php");
}
//BANNER PLANS
function ws_bannerplans(){
global $textcolor1, $bgcolor1, $bgcolor2, $prefix, $dbi;
include("header.php");
ws_banadmin();
//DISPLAY BANNER PLANS
OpenTable();
	
	?>
	<table width="100%" align="center" cellpadding="1" cellspacing="1" border="0" bgcolor="<? echo "".$bgcolor1.""; ?>">
	<tr><td colspan="11" align="center" bgcolor="<? echo "".$bgcolor2.""; ?>"><? echo "<b>"._WSBANPL."</b>"; ?><br><br></td></tr>
	<tr><th></th><th width="20%" height="20"><b><? echo""._WSSUBNAME.""; ?></b></th><th width="20%"><b><? echo""._WSADTYPE.""; ?></b></th><th width="7%" align="center" ><b><? echo""._WSSUBCOST.""; ?></b></th><th width="10%" align="center" ><b><? echo""._WSSUBPD.""; ?></b></th><th width="10%" align="center" ><b><? echo""._WSADIMP.""; ?></b></th><th width="10%" align="center" ><b><? echo""._WSTPERIOD.""; ?></b></th><th width="10%" align="center" ><b><? echo""._WSTIMP.""; ?></b></th><th width="7%" align="center" ><b><? echo""._WSSUBENB.""; ?></b></th><th width="6%" align="center"><b><? echo ""._WSWEIGHT.""; ?></b></th><th width="10%" align="center"><b><? echo""._WSSUBUPD.""; ?></b></th></tr>
	<?
function adpos($ws_banpos){
if($ws_banpos ==1){
	echo ""._WSADPOS1."";
	}
if($ws_banpos ==2){
	echo ""._WSADPOS2."";
	}
if($ws_banpos ==3){
	echo ""._WSADPOS3."";
	}
if($ws_banpos ==4){
	echo ""._WSADPOS4."";
	}
if($ws_banpos ==5){
	echo ""._WSADPOS5."";
	}
if($ws_banpos ==6){
	echo ""._WSADPOS6."";
	}
if($ws_banpos ==7){
	echo ""._WSADPOS7."";
	}
if($ws_banpos ==8){
	echo ""._WSADPOS8."";
	}
if($ws_banpos ==9){
	echo ""._WSADPOS9."";
	}
if($ws_banpos ==10){
	echo ""._WSADPOS10."";
	}
if($ws_banpos ==11){
	echo ""._WSADPOS11."";
	}
if($ws_banpos ==12){
	echo ""._WSADPOS12."";
	}
}
$bancrow = $db->sql_fetchrow($db->sql_query("SELECT ban_count FROM ".$prefix."_ws_adconfig"));
	$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_banplans"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit($bancrow[ban_count]);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
	$result = sql_query("select ws_id, ban_name, ban_description, ban_cost, wsn, wsp, ban_enabled, ws_weight, ws_img, ws_trial, ws_trial_dmy, ws_trial_lgth, ws_banpos, ws_imp, ws_trialimp from ".$prefix."_ws_banplans ORDER BY ws_weight ASC LIMIT $limit1, $limit2", $dbi);
	while(list($ws_id, $ban_name, $ban_description, $ban_cost, $wsn, $wsp, $ban_enabled, $ws_weight, $ws_img, $ws_trial, $ws_trial_dmy, $ws_trial_lgth, $ws_banpos, $ws_imp, $ws_trialimp) = sql_fetch_row($result, $dbi)) {
if($ban_enabled !=""){
$suben ="<span id=\"alImg4\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/able.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/able.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
}
else{
$suben ="<span id=\"alImg3\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/nable.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/nable.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
}
if($ws_trialimp =="0"){
$trimp = _WSUNLIMITED;
}else{
$trimp = $ws_trialimp;
}
if($ws_imp =="0"){
$baimp = _WSUNLIMITED;
}else{
$baimp = $ws_imp;
}

	?>
		<tr><td bgcolor="<? echo "".$bgcolor2.""; ?>"><?= "<span id=\"alImg5\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/subs.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/subs.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" height="20"><? echo"<a href='#' title='$ban_description'>$ban_name</a>"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>"><? adpos($ws_banpos); ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo""._CURR." $ban_cost"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"$wsn  $wsp"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo $baimp; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"$ws_trial_dmy  $ws_trial_lgth"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo $trimp; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"<a href='admin.php?op=ws_adstatus&amp;ws_id=$ws_id&ban_enabled=$ban_enabled' title='"._WSACTV."'>$suben</a>"; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo $ws_weight; ?></td><td bgcolor="<? echo "".$bgcolor2.""; ?>" align="center"><? echo"<a href='admin.php?op=ws_editbannerplan&ws_id=$ws_id'><span id=\"alImg1\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/mod.png'); \">
<img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/mod.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a><a href='admin.php?op=ws_delbannerplan&ws_id=$ws_id'><span id=\"alImg2\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/del.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/del.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a>"; ?> </td></tr>
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
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_bannerplans&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_bannerplans&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_bannerplans&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_bannerplans&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				  echo "<br>";
				  CloseTable();
				  echo "<br>";
				  //END	
//add plans form
 OpenTable();
	echo "<table border='0' width='70%' align='center'>";
    echo"<tr><td colspan='2' align='center'><font class=\"option\"><b>"._ADDWSBAN."</b><br><br>
	<form action=\"admin.php?op=ws_addbannerplan\" method=\"post\"></td></tr><tr><td width='30%' valign='top' bgcolor='".$bgcolor2."'>
	"._WSSUBNAME.":</td><td bgcolor='".$bgcolor2."'>";
	echo '<input type="text" name="sub_name" size="25" maxlength="60">';
	echo "<br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top' bgcolor='".$bgcolor1."'>
	"._WSSUBDESC.":</td><td bgcolor='".$bgcolor1."'>";
	
	echo "<textarea name=\"sub_description\" cols=\"35\" rows=\"6\">".$gdesc."</textarea><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td valign='top'>"._WSSUBCOST.": </td><td><input type=\"text\" name=\"sub_cost\" size=\"15\" maxlength=\"60\" value=\"0.00\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td valign='top'>"._WSADTYPE.": </td><td><select name='wsadtype'><option value=''>--Select One--</option>";
	
	echo "<option value='1'>"._WSADPOS1."</option>";
	echo "<option value='2'>"._WSADPOS2."</option>";
	echo "<option value='3'>"._WSADPOS3."</option>";
	echo "<option value='4'>"._WSADPOS4."</option>";
	echo "<option value='5'>"._WSADPOS5."</option>";
	echo "<option value='6'>"._WSADPOS6."</option>";
	echo "<option value='7'>"._WSADPOS7."</option>";
	echo "<option value='8'>"._WSADPOS8."</option>";
	echo "<option value='9'>"._WSADPOS9."</option>";
	echo "<option value='10'>"._WSADPOS10."</option>";
	echo "<option value='11'>"._WSADPOS11."</option>";
	echo "<option value='12'>"._WSADPOS12."</option>";
	
	echo "</select><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td valign='top'>"._WSSUBPD.": </td><td><select name='wsn'><option value=''>--</option<option value='1'>1</option>
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
    <option value='30'>30</option></select>       <select name='wsp'><option value=''>----</option><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>"._WSIMP.":<br>"._WSIMPTXT."</td><td><input type=\"text\" name=\"ws_imp\" size=\"15\" maxlength=\"60\"><br>"._WSIMPTXT2."</td></tr>
	</td></tr>
	<tr bgcolor='".$bgcolor2."'><td width='30%' valign='top'>"._WSTRIAL.":</td><td> <input name='ws_trial1' type='checkbox' value='1'>"._ON."/"._OFF."&nbsp;&nbsp;&nbsp;<select name='ws_trial_lgth1'><option value=''>--</option><option value='1'>1</option>
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
    <option value='30'>30</option></select>       <select name='ws_trial_dmy1'><option value=''>----</option><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select>"._OR."<input type=\"text\" name=\"ws_trimp\" size=\"15\" maxlength=\"60\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>
	"._WSWEIGHT.":</td><td> <input type=\"text\" name=\"wsweigh\" size=\"5\" maxlength=\"11\" value=\"0\"><br><br></td></tr><tr bgcolor='".$bgcolor2."'><td width='30%' valign='top'>
	"._WSIMAGE.":</td><td> <input type=\"text\" name=\"wsimage\" size=\"50\" maxlength=\"255\" value=\"modules/WS_Banners/images/adimg.jpg\"><br><br></td></tr><tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>"._WSSUBENB.":</td><td> <input name='sub_enabled' type='checkbox' value='checked' checked><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td><input type=\"hidden\" name=\"op\" value=\"ws_addbannerplan\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
include("footer.php");
}
//ADD BANNER PLAN TO DATABASE
function ws_addbannerplan($sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1, $wsadtype, $ws_imp, $ws_trimp){
global $prefix, $dbi, $admin;
include("header.php");
OpenTable();
if($wsn !="" AND $ws_imp !=""){
echo "You cannot have values for both impressions and time period. "._GOBACK."";
exit();
}
if($ws_trial_lgth1 !="" AND $ws_trimp !="" AND $ws_trial1 !=""){
echo "You cannot have values for both impressions and time trial period. "._GOBACK."";
exit();
}
if($sub_name ==""){
echo "Please enter banner name.   "._GOBACK."";
exit();
}
else if($sub_description ==""){
echo "Please enter a description.   "._GOBACK."";
exit();
}
else if($sub_cost ==""){
echo "Enter the cost per period.   "._GOBACK."";
exit();
}
else{
if (is_admin($admin)) {
    sql_query("insert into ".$prefix."_ws_banplans values (NULL, '$sub_name', '$sub_description', '$sub_cost', '$wsn', '$wsp', '$sub_enabled', '$wsweigh', '$wsimage', '$ws_trial1', '$ws_trial_dmy1', '$ws_trial_lgth1', '$wsadtype', '$ws_imp', '$ws_trimp')", $dbi);
	}else{
	echo"Access Denied";
	}
    Header("Location: admin.php?op=ws_bannerplans");
}
CloseTable();
include("footer.php");
}
//END
//DELETE BANNER PLANS
function ws_delbannerplan($ws_id){
global $prefix, $dbi, $admin;
include("header.php");
if (is_admin($admin)) {
sql_query("DELETE from ".$prefix."_ws_banplans where ws_id='$ws_id'", $dbi);
Header("Location: admin.php?op=ws_bannerplans");
}
else {
OpenTable();
echo "Access Denied";
CloseTable();
}
include("footer.php");
}
//EDIT BANNERS PLANS
function ws_editbannerplan($ws_id){
global $prefix, $db;
include("header.php");
ws_banadmin();
 $sql = "SELECT * FROM ".$prefix."_ws_banplans WHERE ws_id='$ws_id'";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
OpenTable();
	echo "<table border='0' width='70%' align='center'>";
    echo"<tr><td colspan='2' align='center'><font class=\"option\"><b>"._EDITWSBAN."</b><br><br>
	<form action=\"admin.php?op=ws_editbannerplan_edit\" method=\"post\"></td></tr><tr><td width='30%' valign='top'>
	"._WSSUBNAME.":</td><td> <input type=\"text\" name=\"ban_name\" size=\"30\" maxlength=\"60\" value=\"$row[ban_name] \" ><br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top'>
	"._WSSUBDESC.":</td><td> <textarea name=\"ban_description\" cols=\"35\" rows=\"6\">$row[ban_description]</textarea><br><br></td></tr>
		<tr bgcolor='".$bgcolor1."'><td valign='top'>"._WSADTYPE.": </td><td><select name='wsadtype'>";
		
if($row['ws_banpos'] ==1){
	$adp = ""._WSADPOS1."";
	}
if($row['ws_banpos'] ==2){
	$adp = ""._WSADPOS2."";
	}
if($row['ws_banpos'] ==3){
	$adp = ""._WSADPOS3."";
	}
if($row['ws_banpos'] ==4){
	$adp = ""._WSADPOS4."";
	}
if($row['ws_banpos'] ==5){
	$adp = ""._WSADPOS5."";
	}
if($row['ws_banpos'] ==6){
	$adp = ""._WSADPOS6."";
	}
if($row['ws_banpos'] ==7){
	$adp = ""._WSADPOS7."";
	}
if($row['ws_banpos'] ==8){
	$adp = ""._WSADPOS8."";
	}
if($row['ws_banpos'] ==9){
	$adp = ""._WSADPOS9."";
	}
if($row['ws_banpos'] ==10){
	$adp = ""._WSADPOS10."";
	}
if($row['ws_banpos'] ==11){
	$adp = ""._WSADPOS11."";
	}
if($row['ws_banpos'] ==12){
	$adp = ""._WSADPOS12."";
	}		
		
		echo "<option value='$row[ws_banpos]'>$adp</option>";
		
		
		
		echo "<option value=''>--Select One--</option>";
	
	echo "<option value='1'>"._WSADPOS1."</option>";
	echo "<option value='2'>"._WSADPOS2."</option>";
	echo "<option value='3'>"._WSADPOS3."</option>";
	echo "<option value='4'>"._WSADPOS4."</option>";
	echo "<option value='5'>"._WSADPOS5."</option>";
	echo "<option value='6'>"._WSADPOS6."</option>";
	echo "<option value='7'>"._WSADPOS7."</option>";
	echo "<option value='8'>"._WSADPOS8."</option>";
	echo "<option value='9'>"._WSADPOS9."</option>";
	echo "<option value='10'>"._WSADPOS10."</option>";
	echo "<option value='11'>"._WSADPOS11."</option>";
	echo "<option value='12'>"._WSADPOS12."</option>";
	
	echo "</select><br><br></td></tr>
	<tr><td valign='top'>"._WSSUBCOST.": </td><td><input type=\"text\" name=\"ban_cost\" size=\"15\" maxlength=\"60\" value=\"$row[ban_cost]\"><br><br></td></tr>
	<tr><td valign='top'>";
	echo ""._WSSUBPD.": </td><td><select name='wsn'>
	<option value='$row[wsn]'>$row[wsn]</option>
	<option value=''>---</option>
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
    <option value='30'>30</option></select>       <select name='wsp'><option value='$row[wsp]'>$row[wsp]</option><option value=''>----</option><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select><br><br></td></tr>
	</td></tr>
	<tr bgcolor='".$bgcolor1."'><td width='30%' valign='top'>"._WSIMP.":<br>"._WSIMPTXT."</td><td><input type=\"text\" name=\"ws_imp\" size=\"15\" maxlength=\"60\" value='$row[ws_imp]'><br>"._WSIMPTXT2."</td></tr>
	<tr><td width='30%' valign='top'>";
	if($row[ws_trial] ==1){$wscheck ="checked";}
	echo ""._WSTRIAL.":</td><td> <input name='ws_trial1' type='checkbox' value='1' $wscheck>"._ON."/"._OFF."&nbsp;&nbsp;&nbsp;<select name='ws_trial_lgth1'>";
	if($row[ws_trial] !=0 AND $row[ws_trial_lgth] !=""){
	echo "<option value='$row[ws_trial_lgth]'>$row[ws_trial_lgth]</option>";
	}
	echo "<option value=''>--</option>";
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
	echo "<option value=''>----</option>";
	echo "<option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select>"._OR."<input type=\"text\" name=\"ws_trimp\" size=\"15\" maxlength=\"60\" value='$row[ws_trialimp]'><br><br></td></tr>
	<tr><td width='30%' valign='top'>
	"._WSWEIGHT.":</td><td> <input type='text' name='wsweigh' value='$row[ws_weight]' size='5'><br><br></td></tr>
	<tr><td width='30%' valign='top'>
	"._WSIMAGE.":</td><td> <input type='text' name='wsimage' value='$row[ws_img]' size='50' maxlenght='255'><br><br></td></tr>
	</td></tr><tr><td width='30%' valign='top'>";
	if($row[ban_enabled] =="checked"){$wscheck2 ="checked";}
	echo ""._WSSUBENB.":</td><td> <input name='ban_enabled' type='checkbox' value='checked' $wscheck2><br><br></td></tr>
	<tr><td><input type=\"hidden\" name=\"op\" value=\"ws_editbannerplan_edit\"><input type=\"hidden\" name=\"ws_id\" value=\"$ws_id\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
	include("footer.php");

}
//END
//ADD EDITED BANNER PLANS TO DB
function ws_editbannerplan_edit($ws_id, $ban_name, $ban_description, $ban_cost, $wsn, $wsp, $ban_enabled, $wsweigh, $wsimage, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1, $wsadtype, $ws_imp, $ws_trimp){
global $prefix, $dbi,$admin;
include("header.php");
OpenTable();
if($wsn !="" AND $ws_imp !=""){
echo "You cannot have values for both impressions and time period. "._GOBACK."";
exit();
}
if($ws_trial_lgth1 !="" AND $ws_trimp !="" AND $ws_trial1 !=""){
echo "You cannot have values for both impressions and time trial period. "._GOBACK."";
exit();
}
if($ban_name ==""){
echo "Please enter Banner name.   "._GOBACK."";
exit();
}
else if($ban_description ==""){
echo "Please enter a description.   "._GOBACK."";
exit();
}
else if($ban_cost ==""){
echo "Enter the cost per period.   "._GOBACK."";
exit();
}
else{
if (is_admin($admin)) {
if($ws_trial1 ==""){$wstrial1 ="0";} else{$wstrial1 ="1";}
sql_query("update ".$prefix."_ws_banplans set ban_name='$ban_name', ban_description='$ban_description', ban_cost='$ban_cost', wsn='$wsn', wsp='$wsp', ban_enabled='$ban_enabled', ws_weight='$wsweigh', ws_img='$wsimage',  ws_trial='$wstrial1',  ws_trial_dmy='$ws_trial_dmy1',  ws_trial_lgth='$ws_trial_lgth1', ws_banpos='$wsadtype', ws_imp='$ws_imp', ws_trialimp='$ws_trimp'  where ws_id='$ws_id'", $dbi);
}else{
echo"Access Denied";
}
     Header("Location: admin.php?op=ws_bannerplans");
}
CloseTable();
include("footer.php");
}
//END
//EARNINGS
function ws_adsearnings(){
global $prefix, $dbi, $admin, $user_prefix, $db, $bgcolor1, $bgcolor2;
include("header.php");
ws_banadmin();
list($total1, $total2) = $db->sql_fetchrow($db->sql_query("SELECT SUM(payment_gross), SUM(payment_fee) FROM ".$prefix."_ws_adpaypal_ipn"));
$tgross ="$total1"-"$total2";
OpenTable();
?>
<table width="98%" border="0" align="center" cellpadding="1">
<tr><td align="center" colspan="5"><?= "<h3>"._WSEARNINGS."</h3>"; ?></td><td><?= "<b>"._WSTOTAL.":  $$tgross</b>"; ?></td></tr>
<tr><th width="15"><?= "<b>"._ID."</b>"; ?></th><th><?= "<b>"._WSSUBNAME."</b>"; ?></th><th><?= "<b>"._PAYPALEMAIL."</b>"; ?></th><th><?= "<b>"._WSPACK."</b>"; ?></th><th><?= "<b>"._WSGROSS."</b>"; ?></th><th><?= "<b>"._DATE."</b>"; ?></th></tr>

<?
$ppalcrow = $db->sql_fetchrow($db->sql_query("SELECT ppal_count FROM ".$prefix."_ws_adconfig"));
$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_adpaypal_ipn"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit($ppalcrow[ppal_count]);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
$result = sql_query("SELECT  paypal_ipn_id,  first_name,  last_name,  payer_email, date_added, item_name, payment_gross, payment_fee FROM ".$prefix."_ws_adpaypal_ipn ORDER BY paypal_ipn_id DESC LIMIT $limit1, $limit2", $dbi);
while(list($paypal_ipn_id, $first_name, $last_name, $payer_email, $date_added, $item_name, $payment_gross, $payment_fee) = sql_fetch_row($result, $dbi)) {
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
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_adsearnings&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_adsearnings&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_adsearnings&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_adsearnings&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				  CloseTable();
include("footer.php");
}
//Configuration
function ws_adsconfig(){
global $prefix, $db, $bgcolor1, $bgcolor2, $textcolor1;
include("header.php");
ws_banadmin();
$sql = "SELECT * FROM ".$prefix."_ws_adconfig";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
//Auto process selected
	OpenTable();
	?>
	<form action="admin.php?op=ws_upadsconfig" method="post">
	<table width="95%" border="0" cellpadding="1" cellspacing="1" align="center" bgcolor="<? echo $bgcolor1; ?>">
	<tr><td align="center" colspan="2" valign="middle"><?= "<h3>"._WSCONFIG."</h3>"; ?><br></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSSBOX."</b><br><i>"._WSSBOXDSC."</i>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="radio" name="wspaypal" value="1" <? if($row['ws_paypal'] ==1){ echo "checked"; } ?>><?= ""._WSON.""; ?> <input type="radio" name="wspaypal" value="0" <? if($row['ws_paypal'] ==0){ echo "checked"; } ?>><?= ""._OFF.""; ?></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSBANPAGE."</b>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="text" name="autoprocess" value="<?= $row['ban_count'];  ?>" size="5"></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor1; ?>"><?= "<b>"._WSPAYP."</b>"; ?></td><td valign="top" bgcolor="<?= $bgcolor1; ?>"><input type="text" name="wssbox" value="<?= $row['ppal_count'];  ?>" size="5"></td></tr>
	<tr><td width="50%" bgcolor="<?= $bgcolor2; ?>"><?= "<b>"._WSCL."</b>"; ?></td><td valign="top" bgcolor="<?= $bgcolor2; ?>"><input type="text" name="wsnsn" value="<?= $row['cl_count'];  ?>" size="5"></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Change"></td></tr>
	</table>
	</form>
	<?
	CloseTable();
include("footer.php");
}
//END
//UPDATE CONFIG VALUES
function ws_upadsconfig($autoprocess, $wssbox, $wsnsn, $wspaypal){
global $prefix, $dbi, $admin;
if (is_admin($admin)) {
sql_query("update ".$prefix."_ws_adconfig set  ban_count='$autoprocess',  ppal_count='$wssbox',  cl_count='$wsnsn', ws_paypal='$wspaypal'", $dbi);
Header("Location: admin.php?op=ws_adsconfig");
}
else{
echo "Access Denied"; 
}
}
//END	
//SETUP PAYPAL
function ws_adpaypalsetup(){
global $prefix, $dbi, $db, $bgcolor1, $bgcolor2;
include("header.php");
	ws_banadmin();
	   $sql = "SELECT id, paypal_email, paypal_bg_color, paypal_currency FROM ".$prefix."_ws_adpaypal";
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
	<form action=\"admin.php?op=ws_adpaypalsetupadd\" method=\"post\"></td></tr><tr bgcolor='".$bgcolor2."'><td width='30%'>
	"._PAYPALEMAIL.":</td><td> <input type=\"text\" name=\"paypal_email\" size=\"30\" maxlength=\"60\" value=\"$row[paypal_email]\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td>"._PAYPALCOLOR.": </td><td><input type=\"text\" name=\"paypal_bg_color\" size=\"15\" maxlength=\"60\" value=\"W\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor2."'><td>"._PAYPALCURC.": </td><td><input type=\"text\" name=\"paypal_currency\" size=\"15\" maxlength=\"60\" value=\"USD\"><br><br></td></tr>
	<tr bgcolor='".$bgcolor1."'><td><input type=\"hidden\" name=\"op\" value=\"ws_adpaypalsetupadd\">
	</td><td><input type=\"submit\" value=\"Submit\">
	</form></td></tr>";
	echo "</table>";
	CloseTable();
include("footer.php");
}
//END
//PAYPAL ADD
function ws_adpaypalsetupadd($paypal_email, $paypal_bg_color, $paypal_currency){
global $prefix, $dbi, $admin;
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
		$wscountem = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_adpaypal"));
			if ($wscountem != 0) {
			if (is_admin($admin)) {
				sql_query("update ".$prefix."_ws_adpaypal set paypal_email='$paypal_email', paypal_bg_color='$paypal_bg_color', paypal_currency='$paypal_currency'", $dbi);
				}else{
				echo"Access Denied";
				}
				Header("Location: admin.php?op=ws_adpaypalsetup");
		}
			else{
			if (is_admin($admin)) {
    sql_query("insert into ".$prefix."_ws_adpaypal values (NULL, '$paypal_email', '$paypal_bg_color', '$paypal_currency')", $dbi);
	}else{
	echo"Access Denied";
	}
    Header("Location: admin.php?op=ws_adpaypalsetup");
	}
}
CloseTable();
include("footer.php");
}
//END
//WS BANNER CLIENTS
function ws_adsclients(){
global $textcolor1, $bgcolor1, $bgcolor2, $prefix, $dbi, $db;
include("header.php");
ws_banadmin();
/* Clients List */
    OpenTable();
    echo "<center><font class=\"option\"><b>" . _ADVERTISINGCLIENTS . "</b></font></center><br>"
	."<table width=\"100%\" border=\"0\"><tr>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CLIENTNAME . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _ACTIVEBANNERS2 . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _INACTIVEBANNERS . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CONTACTNAME . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CONTACTEMAIL . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td><tr>";
$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_bannerclient"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit(10);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2(); 
    $result3 = $db->sql_query("SELECT cid, name, contact, email from " . $prefix . "_ws_bannerclient order by cid LIMIT $limit1, $limit2");
    while ($row3 = $db->sql_fetchrow($result3)) {
    $cid = intval($row3['cid']);
    $name = $row3['name'];
    $contact = $row3['contact'];
    $email = $row3['email'];
        $result4 = $db->sql_query("SELECT cid from " . $prefix . "_ws_banners WHERE cid='$cid' AND active='1'");
        $numrows = $db->sql_numrows($result4);
        $row4 = $db->sql_fetchrow($result4);
        $rcid = intval($row4['cid']);
        $numrows2 = $db->sql_numrows($db->sql_query("SELECT cid from " . $prefix . "_ws_banner WHERE cid='$cid' AND active='0'"));
	echo "<td bgcolor=\"$bgcolor2\" align=\"center\">$name</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\">$numrows</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\">$numrows2</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\">$contact</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\"><a href=\"mailto:$email\">$email</a></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=\"center\" nowrap>&nbsp;[ <a href=\"admin.php?op=ws_banclientedit&amp;cid=$cid\">" . _EDIT . "</a> | <a href=\"admin.php?op=ws_banclientdel&amp;cid=$cid\">" . _DELETE . "</a> ]&nbsp;</td></tr>";
    }
    echo "</td></tr></table>";
    CloseTable();
echo "<br>";
OpenTable();
if($a->getCurrent()==1)
		         {
		         $first = "First | ";
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_adsclients&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_adsclients&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_adsclients&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_adsclients&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				 
				  CloseTable();
 echo "<br>";
/* Add Client */
    OpenTable();
	echo "<form action=\"admin.php?op=ws_clientadd\" method=\"post\">";
	echo "<table border='0' cellspacing='0' cellpadding='0' align='center'>";
	echo "<tr><th colspan='2'><font class=\"option\"><b>" . _ADDCLIENT . "</b></font></th></tr>";
	echo "<tr><td>" . _CLIENTNAME . ":</td><td> <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"60\"></td></tr>";
	echo "<tr><td>" . _CONTACTNAME . ": </td><td><input type=\"text\" name=\"contact\" size=\"20\" maxlength=\"60\"></td></tr>";
	echo "<tr><td>" . _CONTACTEMAIL . ": </td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"60\"></td></tr>";
	echo "<tr><td>" . _CLIENTLOGIN . ":</td><td> <input type=\"text\" name=\"login\" size=\"12\" maxlength=\"10\"></td></tr>";
	echo "<tr><td>" . _CLIENTPASSWD . ": </td><td><input type=\"text\" name=\"passwd\" size=\"12\" maxlength=\"10\"><input type=\"hidden\" name=\"op\" value=\"ws_clientadd\"></td></tr>";
	echo "<tr><td colspan='2' align='center' height='25'><input type=\"submit\" value=\"" . _ADDCLIENT2 . "\"></td></tr></table>
	</form>";
    CloseTable();

include("footer.php");

}
//BANNER STATS
function ws_adstats(){
global $prefix, $db, $bgcolor2;
include("header.php");
ws_banadmin();
 OpenTable();
    echo "<center><font class=\"title\"><b>" . _BANNERSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
/* Banners List */
    echo "<a name=\"top\">";
    OpenTable();
    echo "<center><font class=\"option\"><b>" . _ACTIVEBANNERS . "</b></font></center><br>"
	."<table width=100% border=0><tr>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CLIENTNAME . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _IMPRESSIONS . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _IMPLEFT . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CLICKS . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSSDATE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSEDATE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _TYPE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSADTYPE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td><tr>";
$num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_banners WHERE active='1'"));
$a =& new Paginator($_GET['page'],$num_rows);
$a->set_Limit(10);
$a->set_Links(3);
$limit1 = $a->getRange1();  
$limit2 = $a->getRange2();
    $result = $db->sql_query("SELECT bid, cid, imptotal, impmade, clicks, imageurl, date, dateend, type, active, position, ws_trial, ws_banname from " . $prefix . "_ws_banners WHERE active='1' order by type,bid LIMIT $limit1, $limit2");
    while ($row = $db->sql_fetchrow($result)) {
	$bid = intval($row['bid']);
	$cid = intval($row['cid']);
	$imptotal = intval($row['imptotal']);
	$impmade = intval($row['impmade']);
	$clicks = intval($row['clicks']);
	$imageurl = $row['imageurl'];
	$date = $row['date'];
	$type = $row['type'];
	$dateend = $row['dateend'];
	$position = intval($row['position']);
	$ws_trial = intval($row['ws_trial']);
	$ws_banname = $row['ws_banname'];
	$active = intval($row['active']);
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_ws_bannerclient where cid='$cid'"));
        $cid = intval($row2['cid']);
        $name = trim($row2['name']);
	if($impmade==0) {
	    $percent = 0;
	} else {
	    $percent = substr(100 * $clicks / $impmade, 0, 5);
	}
	if($imptotal==0 AND $dateend==0) {
	    $left = _UNLIMITED;
	}elseif($imptotal==0 AND $dateend!=0){
	$left = "";
	}
	else {
	    $left = $imptotal-$impmade;
	}
	if ($type == 1) {
	    $type = _WSFLASH;
	} elseif ($type == 2) {
	    $type = _WSIMG;
	} 
	else {
	    $type = _WSTXTAD;
	}
	if($position == 1){
	$apos = _WSADPOS1;
	} elseif($position == 2){
	$apos = _WSADPOS2;
	}elseif($position == 3){
	$apos = _WSADPOS3;
	}elseif($position == 4){
	$apos = _WSADPOS4;
	}elseif($position == 5){
	$apos = _WSADPOS5;
	}elseif($position == 6){
	$apos = _WSADPOS6;
	}elseif($position == 7){
	$apos = _WSADPOS7;
	}elseif($position == 8){
	$apos = _WSADPOS8;
	}elseif($position == 9){
	$apos = _WSADPOS9;
	}elseif($position == 10){
	$apos = _WSADPOS10;
	}elseif($position == 11){
	$apos = _WSADPOS11;
	}elseif($position == 12){
	$apos = _WSADPOS12;
	}
	if ($active == 1) {
	    $t_active = _ACTIVE;
	    $c_active = _DEACTIVATE;
		$suben ="<span id=\"alImg4\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/able.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/able.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";

	} else {
	    $t_active = "<i>" . _INACTIVE . "</i>";
	    $c_active = _ACTIVATE;
		
$suben ="<span id=\"alImg3\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/nable.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/nable.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
	}
	$sDate = date('Y-m-d',$date);
	if($dateend =="0"){
	$eDate ="";
	}else{
	$eDate = date('M j, Y, g:i a',$dateend);
	}
	
	echo "<td bgcolor=\"$bgcolor2\" align=left><a href=\"$imageurl\" target=\"new\">$name</a></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$impmade</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$left</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$clicks</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$sDate</td>"
		."<td bgcolor=\"$bgcolor2\" align=center>$eDate</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=left>$type</td>"
		."<td bgcolor=\"$bgcolor2\" align=left>$apos</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center><a href=\"admin.php?op=ws_ban_edit&amp;bid=$bid\"><span id=\"alImg1\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/mod.png'); \">
<img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/mod.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a><a href=\"admin.php?op=ws_bannerstatus&amp;bid=$bid&status=$active\">$suben</a><a href=\"admin.php?op=ws_ban_del&amp;bid=$bid\"><span id=\"alImg2\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Subscription/images/del.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/del.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a></td><tr>";
    }
    echo "</td></tr></table><br>";
	
if($a->getCurrent()==1)
		         {
		         $first = "First | ";
		         } else { $first="<a href=\"" .  $a->getPageName() . "?op=ws_adstats&page=" . $a->getFirst() . "\">First</a> |"; }  
					 //check to see that getPrevious() is returning a value. If not there will be no link.
		       if($a->getPrevious())
		         {
		         $prev = "<a href=\"" .  $a->getPageName() . "?op=ws_adstats&page=" . $a->getPrevious() . "\">Prev</a> | ";
		         } else { $prev="Prev | "; }
		       //check to see that getNext() is returning a value. If not there will be no link.
	         if($a->getNext())
		         {
		         $next = "<a href=\"" . $a->getPageName() . "?op=ws_adstats&page=" . $a->getNext() . "\">Next</a> | ";
		         } else { $next="Next | "; }
		
		       //check to see that getLast() is returning a value. If not there will be no link.
		       if($a->getLast())
		         {
		         $last = "<a href=\"" . $a->getPageName() . "?op=ws_adstats&page=" . $a->getLast() . "\">Last</a> | ";
		         } else { $last="Last | "; }
						 //since these will always exist just print out the values.  Result will be
						 //something like 1 of 4 of 25
		          echo $a->getFirstOf() . " of " .$a->getSecondOf() . " of " . $a->getTotalItems() . " ";
							//print the values determined by the if statements above.
		          echo $first . " " . $prev . " " . $next . " " . $last;
				 
				  
 echo "<br>";
	echo "<center><font class=\"option\"><b>" . _INACTIVEBANNERS . "</b></font></center><br>"
	."<table width=100% border=0><tr>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CLIENTNAME . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _IMPRESSIONS . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _IMPLEFT . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _CLICKS . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSSDATE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSEDATE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _TYPE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _WSADTYPE . "</b></td>"
	."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>" . _FUNCTIONS . "</b></td><tr>";
    $result = $db->sql_query("SELECT bid, cid, imptotal, impmade, clicks, imageurl, date, dateend, type, active, position, ws_trial, ws_banname from " . $prefix . "_ws_banners WHERE active='0' order by type,bid");
    while ($row = $db->sql_fetchrow($result)) {
	$bid = intval($row['bid']);
	$cid = intval($row['cid']);
	$imptotal = intval($row['imptotal']);
	$impmade = intval($row['impmade']);
	$clicks = intval($row['clicks']);
	$imageurl = $row['imageurl'];
	$date = $row['date'];
	$type = $row['type'];
	$dateend = $row['dateend'];
	$position = intval($row['position']);
	$ws_trial = intval($row['ws_trial']);
	$ws_banname = $row['ws_banname'];
	$active = intval($row['active']);
        $row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_ws_bannerclient where cid='$cid'"));
        $cid = intval($row2['cid']);
        $name = trim($row2['name']);
	if($impmade==0) {
	    $percent = 0;
	} else {
	    $percent = substr(100 * $clicks / $impmade, 0, 5);
	}
	if($imptotal==0 AND $dateend==0) {
	    $left = _UNLIMITED;
	}elseif($imptotal==0 AND $dateend!=0){
	$left = "";
	}
	else {
	    $left = $imptotal-$impmade;
	}
	if ($type == 1) {
	    $type = _WSFLASH;
	} elseif ($type == 2) {
	    $type = _WSIMG;
	} 
	else {
	    $type = _WSTXTAD;
	}
	if ($active == 1) {
	    $t_active = _ACTIVE;
	    $c_active = _DEACTIVATE;
		$suben ="<span id=\"alImg4\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/able.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/able.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
	} else {
	    $t_active = "<i>" . _INACTIVE . "</i>";
	    $c_active = _ACTIVATE;
		$suben ="<span id=\"alImg3\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/nable.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/nable.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span>";
	}
	if($position == 1){
	$apos = _WSADPOS1;
	} elseif($position == 2){
	$apos = _WSADPOS2;
	}elseif($position == 3){
	$apos = _WSADPOS3;
	}elseif($position == 4){
	$apos = _WSADPOS4;
	}elseif($position == 5){
	$apos = _WSADPOS5;
	}elseif($position == 6){
	$apos = _WSADPOS6;
	}elseif($position == 7){
	$apos = _WSADPOS7;
	}elseif($position == 8){
	$apos = _WSADPOS8;
	}elseif($position == 9){
	$apos = _WSADPOS9;
	}elseif($position == 10){
	$apos = _WSADPOS10;
	}elseif($position == 11){
	$apos = _WSADPOS11;
	}elseif($position == 12){
	$apos = _WSADPOS12;
	}
	$swsDate = date('Y-m-d',$date);
	if($dateend =="0"){
	$ewsDate ="";
	}else{
	$ewsDate = date('M j, Y, g:i a',$dateend);
	}
	echo "<td bgcolor=\"$bgcolor2\" align=center><a href=\"$imageurl\" target=\"new\">$name</a></td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$impmade</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$left</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$clicks</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=center>$swsDate</td>"
		."<td bgcolor=\"$bgcolor2\" align=center>$ewsDate</td>"
	    ."<td bgcolor=\"$bgcolor2\" align=left>$type</td>"
		."<td bgcolor=\"$bgcolor2\" align=left>$apos</td>"
		
	    ."<td bgcolor=\"$bgcolor2\" align=center><a href=\"admin.php?op=ws_ban_edit&amp;bid=$bid\"><span id=\"alImg1\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/mod.png'); \">
<img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/mod.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a><a href=\"admin.php?op=ws_bannerstatus&amp;bid=$bid&status=$active\">$suben</a><a href=\"admin.php?op=ws_ban_del&amp;bid=$bid\"><span id=\"alImg2\" style=\"width:16px;height:16px; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='modules/WS_Banners/images/del.png'); \"><img style=\"filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0); cursor: hand;\" src=\"modules/WS_Banners/images/del.png\" width=\"16\" height=\"16\" border=\"0\" alt=\"\"></span></a></td><tr>";
    }
    echo "</td></tr></table>";
    
    CloseTable();
    echo "<br>";
	/* Add Banner */
    $result5 = $db->sql_query("select * from ".$prefix."_ws_bannerclient");
    $numrows3 = $db->sql_numrows($result5);
    if($numrows3>0) {
	OpenTable();
	 echo "<form action=\"admin.php?op=ws_addbanner_db\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<table cellpadding='1' cellspacing='1' border='0' align='center'>";
	echo "<tr><th colspan='2'><font class=\"option\"><b>"._ADDNEWBANNER."</b></font></center></th></tr>";
	echo "<tr><td>" . _CLIENTNAME . ": </td><td>"
	    ."<select name=\"cid\">";
    $result6 = $db->sql_query("SELECT cid, name from " . $prefix . "_ws_bannerclient ORDER BY name");
    while ($row6 = $db->sql_fetchrow($result6)) {
	$cid = intval($row6['cid']);
	$name = $row6['name'];
	    echo "<option value=\"$cid\">$name</option>";
	}
	echo "</select></td></tr>"
    ."<tr><td>"
	.""._WSNAMETXT." :</td><td> <input type=\"text\" name=\"wsbanname\" size=\"17\"></td></tr>";
			echo "<tr><td valign='top'>"._WSSUBPD.": </td><td><select name='wsn'><option value=''>--</option<option value='1'>1</option>
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
    <option value='30'>30</option></select>       <select name='wsp'><option value=''>----</option><option value='day'>"._WSDAYS."</option>
	<option value='week'>"._WSWEEKS."</option>
	<option value='month'>"._WSMONTHS."</option>
	<option value='year'>"._WSYEARS."</option></select></td></tr>";
	echo "<tr><td>" . _PURCHASEDIMPRESSIONS . ": </td><td><input type=\"text\" name=\"imptotal\" size=\"12\" maxlength=\"11\"> 0 = " . _UNLIMITED . "</td></tr>"
	."<tr><td>"._WSADTYPE.": </td><td>";
	echo "<select name='wsadtype'><option value=''>--Select One--</option>";
	
	echo "<option value='1'>"._WSADPOS1."</option>";
	echo "<option value='2'>"._WSADPOS2."</option>";
	echo "<option value='3'>"._WSADPOS3."</option>";
	echo "<option value='4'>"._WSADPOS4."</option>";
	echo "<option value='5'>"._WSADPOS5."</option>";
	echo "<option value='6'>"._WSADPOS6."</option>";
	echo "<option value='7'>"._WSADPOS7."</option>";
	echo "<option value='8'>"._WSADPOS8."</option>";
	echo "<option value='9'>"._WSADPOS9."</option>";
	echo "<option value='10'>"._WSADPOS10."</option>";
	echo "<option value='11'>"._WSADPOS11."</option>";
	echo "<option value='12'>"._WSADPOS12."</option>";
	
	echo "</select></td></tr>"
 ."<tr><td>" . _TYPE . ": </td><td><select name=\"bantype\"><option value=\"\">---"._WSSELONE."---</option><option value=\"1\">"._WSFLASH."</option><option value=\"2\">"._WSIMG."</option><option value=\"3\">"._WSTXTAD."</option></select></td></tr>"
	    ."<tr><td>" . _IMAGEURL2 . ": </td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\"></td></tr>"
		."<tr><td>" . _IMAGEURL3 . ": </td><td><input type=\"file\" name=\"myupload\" size=\"50\" maxlength=\"100\"></td></tr>"
	    ."<tr><td>" . _CLICKURL . ": </td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\"></td></tr>"
	    ."<tr><td>" . _ALTTEXT . ": </td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\"></td></tr>"
	    ."<tr><td>" . _ACTIVATE . ": </td><td><input type=\"radio\" name=\"active\" value=\"1\">" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\">" . _NO . "</td></tr><tr><td colspan='2' align='center'>"
	    ."<input type=\"hidden\" name=\"op\" value=\"ws_addbanner_db\">"
	    ."<input type=\"submit\" value=\"" . _ADDBANNER . "\"></td></tr></table>"
	    ."</form>";
	CloseTable();
	echo "<br>";
    }
	include("footer.php");
}
//ADD NEW BANNER TO DATABASE
function ws_addbanner_db($cid, $wsbanname, $wsn, $wsp, $imptotal, $wsadtype, $bantype, $imageurl, $clickurl, $alttext, $active, $myupload){
global $prefix, $dbi, $admin;
include("header.php");
OpenTable();
if($wsn !="" AND $imptotal !=""){
echo ""._WSIMPERR1." "._GOBACK."";
exit();
}
if($wsbanname ==""){
echo ""._WSIMPERR3."   "._GOBACK."";
exit();
}
else if($alttext ==""){
echo ""._WSIMPERR4."   "._GOBACK."";
exit();
}
if (is_admin($admin)) {
$tdate = time();
if($wsn !=""){
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
      $wsperiod = $wsn * $wstime;
	  $wsenddate= $wsperiod + time();
}else{
$wsenddate ="";
}
if($imageurl =="" AND $bantype !="3"){
	  $myUploadobj = new UPLOAD; //creating instance of file.
$upload_dir= $_SERVER['DOCUMENT_ROOT']."/modules/WS_Banners/adimages/";
		// use function to upload file.
		$file=$myUploadobj->upload_file($upload_dir,'myupload',true,true,0,"jpg|jpeg|gif|png|swf"); 
		if($file==false)
			echo $myUploadobj->error;
		else
			$wsmyloc ="modules/WS_Banners/adimages/".$file;	
}else{
$wsmyloc = $imageurl;
}
    sql_query("insert into ".$prefix."_ws_banners values (NULL, '$cid', '$imptotal', '1', '', '$wsmyloc', '$clickurl', '$alttext', '$tdate', '$wsenddate', '$bantype', '$active', '$wsadtype', '', '$wsbanname')", $dbi);
	}else{
	echo"Access Denied";
	exit();
	}
    Header("Location: admin.php?op=ws_adstats");
CloseTable();
include("footer.php");
}
//END
//EDIT BANNERS
function ws_ban_edit($bid) {
    global $prefix, $db;
    include("header.php");
ws_banadmin();
    OpenTable();
    echo "<center><font class=\"title\"><b>" . _BANNERSADMIN . "</b></font></center>";
    CloseTable();
    echo "<br>";
	$bid = intval($bid);
	$row = $db->sql_fetchrow($db->sql_query("SELECT cid, imptotal, impmade, clicks, imageurl, clickurl, alttext, date, dateend, type, active, position, ws_banname from " . $prefix . "_ws_banners where bid='$bid'"));
	$cid = intval($row['cid']);
	$imptotal = intval($row['imptotal']);
	$impmade = intval($row['impmade']);
	$clicks = intval($row['clicks']);
	$imageurl  = $row['imageurl'];
	$clickurl = $row['clickurl'];
	$alttext = $row['alttext'];
	$type = $row['type'];
	$date = $row['date'];
	$dateend = $row['dateend'];
	$position = $row['position'];
	$ws_banname = $row['ws_banname'];
	$active = intval($row['active']);
	$enDate = date('M j, Y, g:i a',$dateend);
    OpenTable();
    echo"<center><b>" . _EDITBANNER . "</b><br><br></center>";
		if($type == 1){
	echo "<center>";
	?>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="480" height="60">
      <param name="movie" value="<?=  $imageurl; ?>">
      <param name="quality" value="high">
      <embed src="<?=  $imageurl; ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="480" height="60"></embed>
    </object>
	<?
	echo "</center><br><br>";
	}
	elseif($type == 2){
	echo "<center><img src=\"$imageurl\" border=\"1\" alt=\"\"></center><br><br>";
	}else{
	echo "<center><a href='$clickurl' title='$alttext'>$ws_banname</a></center><br><br>";
	}
	
	echo "<form action=\"admin.php?op=ws_updatebplan\" method=\"post\" enctype=\"multipart/form-data\">";
	echo "<table border='0' cellspacing='1' cellpadding='1'>";
	echo "<tr><td>" . _CLIENTNAME . ": </td><td>"
	."<select name=\"cid\">";
	$row2 = $db->sql_fetchrow($db->sql_query("SELECT cid, name from " . $prefix . "_ws_bannerclient where cid='$cid'"));
	$cid = intval($row2['cid']);
	$name = $row2['name'];
    echo "<option value=\"$cid\" selected>$name</option>";
    echo "</select>";
		if($imptotal==0 AND $dateend==0) {
	    $impressions = _UNLIMITED;
	}elseif($imptotal==0 AND $dateend!=0){
	$impressions = _WSNONE;
	}
	else {
	    $impressions = $imptotal-$impmade;
	}
	if ($type == 1) {
	$sel1 = "selected";
	$sel2 = "";
	$sel3 = "";
		
	} elseif ($type == 2) {
	$sel1 = "";
	$sel2 = "selected";
	$sel3 = "";
		
	} 
	else {
	$sel1 = "";
	$sel2 = "";
	$sel3 = "selected";		
	}
	if($position == 1){
	$apos = _WSADPOS1; 
	$possel1 = "selected";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	} elseif($position == 2){
	$apos = _WSADPOS2;
	$possel1 = "";
	$possel2 = "selected";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 3){
	$apos = _WSADPOS3;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "selected";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 4){
	$apos = _WSADPOS4;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "selected";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 5){
	$apos = _WSADPOS5;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "selected";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 6){
	$apos = _WSADPOS6;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "selected";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 7){
	$apos = _WSADPOS7;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "selected";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 8){
	$apos = _WSADPOS8;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "selected";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 9){
	$apos = _WSADPOS9;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "selected";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 10){
	$apos = _WSADPOS10;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "selected";
	$possel11 = "";
	$possel12 = "";
	}elseif($position == 11){
	$apos = _WSADPOS11;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "selected";
	$possel12 = "";
	}elseif($position == 12){
	$apos = _WSADPOS12;
	$possel1 = "";
	$possel2 = "";
	$possel3 = "";
	$possel4 = "";
	$possel5 = "";
	$possel6 = "";
	$possel7 = "";
	$possel8 = "";
	$possel9 = "";
	$possel10 = "";
	$possel11 = "";
	$possel12 = "selected";
	}
	
    if ($active == 1) {
	$check1 = "checked";
	$check2 = "";
    } else {
	$check1 = "";
	$check2 = "checked";
    }
    echo "</td></tr>";
	echo "<tr><td>". _WSNAMETXT  . ": </td><td><input type=\"text\" name=\"ban_name\" size=\"15\"  value=\"$ws_banname\"></td></tr>";
	if($imptotal >"0"){
	echo "<tr><td>" . _ADDIMPRESSIONS . ": </td><td><input type=\"text\" name=\"impadded\" size=\"12\" maxlength=\"11\"> " . _PURCHASED . ": <b>$impressions</b> " . _MADE . ": <b>$impmade</b></td></tr>";
	
	echo "<tr><td>". _WSSUBIMP  . ": </td><td><input type=\"text\" name=\"impsubt\" size=\"12\" maxlength=\"11\"></td></tr>";
	}else{
	echo "<tr><td>". _WSEDATE  . ": </td><td>$enDate</td></tr><tr><td>"._WSADDDATE."</td><td><input type=\"text\" name=\"add_days\" size=\"12\" maxlength=\"11\"></td></tr>";
		echo "<tr><td>". _WSMINUSDATE  . ": </td><td><input type=\"text\" name=\"minus_days\" size=\"12\" maxlength=\"11\"></td></tr>";
	}
   echo "<tr><td>"._WSADTYPE.":</td><td><select name='wsadtype'>";
	
	echo "<option value='1' $possel1>"._WSADPOS1."</option>";
	echo "<option value='2' $possel2>"._WSADPOS2."</option>";
	echo "<option value='3' $possel3>"._WSADPOS3."</option>";
	echo "<option value='4' $possel4>"._WSADPOS4."</option>";
	echo "<option value='5' $possel5>"._WSADPOS5."</option>";
	echo "<option value='6' $possel6>"._WSADPOS6."</option>";
	echo "<option value='7' $possel7>"._WSADPOS7."</option>";
	echo "<option value='8' $possel8>"._WSADPOS8."</option>";
	echo "<option value='9' $possel9>"._WSADPOS9."</option>";
	echo "<option value='10' $possel10>"._WSADPOS10."</option>";
	echo "<option value='11' $possel11>"._WSADPOS11."</option>";
	echo "<option value='12' $possel12>"._WSADPOS12."</option>";
	
	echo "</select></td></tr>";
	echo "<tr><td>" . _TYPE . ": </td><td><select name=\"type\">"
	."<option name=\"type\" value=\"1\" $sel1>" . _WSFLASH . "</option>"
	."<option name=\"type\" value=\"2\" $sel2>" . _WSIMG . "</option>"
	."<option name=\"type\" value=\"3\" $sel3>" . _WSTXTAD . "</option>"
	."</select></td></tr>";
	echo "<tr><td>" . _IMAGEURL2 . ": </td><td><input type=\"text\" name=\"imageurl\" size=\"50\" maxlength=\"100\" value=\"$imageurl\"></td></tr>"
	."<tr><td>" . _IMAGEURL3 . ": </td><td><input type=\"file\" name=\"myupload\" size=\"50\" maxlength=\"100\"></td></tr>"
	."<tr><td>" . _CLICKURL . ": </td><td><input type=\"text\" name=\"clickurl\" size=\"50\" maxlength=\"200\" value=\"$clickurl\"></td></tr>"
	."<tr><td>" . _ALTTEXT . ": </td><td><input type=\"text\" name=\"alttext\" size=\"50\" maxlength=\"255\" value=\"$alttext\"></td></tr>"
	."<tr><td>" . _ACTIVATE . ": </td><td><input type=\"radio\" name=\"active\" value=\"1\" $check1>" . _YES . "&nbsp;&nbsp;<input type=\"radio\" name=\"active\" value=\"0\" $check2>" . _NO . "</td></tr>"
	."<tr><td colspan='2' align='center'><input type=\"hidden\" name=\"bid\" value=\"$bid\">"
	."<input type=\"hidden\" name=\"imptotal\" value=\"$imptotal\">"
	."<input type=\"hidden\" name=\"edatend\" value=\"$dateend\">"
	."<input type=\"hidden\" name=\"op\" value=\"ws_updatebplan\">" 
	."<input type=\"submit\" value=\"" . _SAVECHANGES . "\"></td></tr></table>"
	."</form>";
    CloseTable();
    include("footer.php");
}
//ADD WS UPDATE BANNER PLAN
function ws_updatebplan($bid, $cid, $impadded, $impmade, $imptotal, $impsubt, $add_days, $minus_days, $wsadtype, $type, $imageurl, $clickurl, $alttext, $active, $ban_name, $edatend, $myupload) {
    global $prefix, $db;
	if($impadded !="" AND $impsubt !=""){
echo ""._WSIMPERR1X." "._GOBACK."";
exit();
}
	if($add_days !="" AND $minus_days !=""){
echo ""._WSIMPERR2X." "._GOBACK."";
exit();
}
if($ban_name ==""){
echo ""._WSIMPERR3."   "._GOBACK."";
exit();
}
else if($alttext ==""){
echo ""._WSIMPERR4."   "._GOBACK."";
exit();
}
if($impadded !=""){  
      $wsimp_ad = "imptotal=imptotal+$impadded,";
	  }elseif($impsubt !=""){
	  $wsimp_ad = "imptotal=imptotal-$impsubt,";
	  }
else{
$wsimp_ad ="";
}
$wsdtime ="86400";
	if($add_days !=""){  
      $wsperiod = $add_days * $wsdtime;
	  $wsper ="dateend=dateend+$wsperiod,";
	  }elseif($minus_days !=""){
	  $wsperiod = $minus_days * $wsdtime;
	  $wsper ="dateend=dateend-$wsperiod,";
	  }
else{
$wsper ="";
}
	if($imageurl =="" AND $bantype !="3"){
	  $myUploadobj = new UPLOAD; //creating instance of file.
$upload_dir= $_SERVER['DOCUMENT_ROOT']."/modules/WS_Banners/adimages/";
		// use function to upload file.
		$file=$myUploadobj->upload_file($upload_dir,'myupload',true,true,0,"jpg|jpeg|gif|png|swf"); 
		if($file==false)
			echo $myUploadobj->error;
		else
			$wsmyloc ="modules/WS_Banners/adimages/".$file;	
}else{
$wsmyloc = $imageurl;
}
$wsstime = time();
if($wsstime < $edatend){
    $db->sql_query("UPDATE " . $prefix . "_ws_banners SET $wsimp_ad imageurl='$wsmyloc', clickurl='$clickurl', alttext='$alttext', $wsper type='$type', active='$active', position='$wsadtype', ws_banname='$ban_name' WHERE bid='$bid'");
	}else{

$db->sql_query("UPDATE " . $prefix . "_ws_banners SET $wsimp_ad imageurl='$wsmyloc', clickurl='$clickurl', alttext='$alttext', date='$wsstime', $wsper type='$type', active='$active', position='$wsadtype', ws_banname='$ban_name' WHERE bid='$bid'");
	}
	
	
    Header("Location: admin.php?op=ws_adstats");
}
//BANNER STATUS
function ws_bannerstatus($bid, $status) {
    global $prefix, $db;
    if ($status == 1) {
	$active = 0;
    } else {
	$active = 1;
    }
    $bid = intval($bid);
    $db->sql_query("update " . $prefix . "_ws_banners set active='$active' WHERE bid='$bid'");
    Header("Location: admin.php?op=ws_adstats");
}
//DELETE BANNERS
function ws_ban_del($bid) {
    global $prefix, $db;
    $bid = intval($bid);
$db->sql_query("delete from " . $prefix . "_ws_banners where bid='$bid'");
	Header("Location: admin.php?op=ws_adstats");
}
//EDIT BANNER CLIENTS
function ws_banclientedit($cid) {
    global $prefix, $db;
    include("header.php");
    ws_banadmin();
    $cid = intval($cid);
    $row = $db->sql_fetchrow($db->sql_query("SELECT name, contact, email, login, passwd from " . $prefix . "_ws_bannerclient where cid='$cid'"));
    $name = $row['name'];
    $contact = $row['contact'];
    $email = $row['email'];
    $login = $row['login'];
    $passwd = $row['passwd'];
    OpenTable();
	echo "<form action=\"admin.php?op=ws_banclientch\" method=\"post\">";
	echo "<table border='0' cellspacing='0' cellpadding='0' align='center' width='55%'>";
	echo "<tr><th colspan='2'>";
    echo "<center><font class=\"option\"><b>" . _EDITCLIENT . "</b></font></center></th></tr>"
	."<tr><td valign='top'>" . _CLIENTNAME . ":</td><td> <input type=\"text\" name=\"name\" value=\"$name\" size=\"30\" maxlength=\"60\"><br><br></td></tr>"
	."<tr><td valign='top'>" . _CONTACTNAME . ":</td><td> <input type=\"text\" name=\"contact\" value=\"$contact\" size=\"30\" maxlength=\"60\"><br><br></td></tr>"
	."<tr><td valign='top'>" . _CONTACTEMAIL . ":</td><td> <input type=\"text\" name=\"email\" size=30 maxlength=\"60\" value=\"$email\"><br><br></td></tr>"
	."<tr><td valign='top'>" . _CLIENTLOGIN . ":</td><td> <input type=\"text\" name=\"login\" size=12 maxlength=\"10\" value=\"$login\"><br><br></td></tr>"
	."<tr><td valign='top'>" . _CLIENTPASSWD . ": </td><td><input type=\"text\" name=\"passwd\" size=12 maxlength=\"10\" value=\"$passwd\"><br><br></td></tr><tr><td colspan='2'>"
	."<input type=\"hidden\" name=\"cid\" value=\"$cid\">"
	."<input type=\"hidden\" name=\"op\" value=\"ws_banclientch\"></td></tr>"
	."<tr><td colspan='2' align='center'><input type=\"submit\" value=\"" . _SAVECHANGES . "\"></td></tr></table>"
	."</form>";
    CloseTable();
    include("footer.php");
}
//END
//CHANGE CLIENTS
function ws_banclientch($cid, $name, $contact, $email, $login, $passwd) {
    global $prefix, $db;
    $cid = intval($cid);
    $db->sql_query("update ".$prefix."_ws_bannerclient set name='$name', contact='$contact', email='$email', login='$login', passwd='$passwd' where cid='$cid'");
    Header("Location: admin.php?op=ws_adsclients");
}
//DELETE BANNER CLIENTS
function ws_banclientdel($cid) {
    global $prefix, $db;
    $cid = intval($cid);
	$db->sql_query("delete from " . $prefix . "_ws_banners where cid='$cid'");
	$db->sql_query("delete from " . $prefix . "_ws_bannerclient where cid='$cid'");
	Header("Location: admin.php?op=ws_adsclients");
    }
	//END
//STATS FORS WINDOW
function ws_adsstats(){
global $prefix, $db, $sitename, $dbi, $user, $cookie, $group_id, $user_prefix, $admin;
//if(is_admin($admin)){
list($total1, $total2) = $db->sql_fetchrow($db->sql_query("SELECT SUM(payment_gross), SUM(payment_fee) FROM ".$prefix."_ws_adpaypal_ipn"));
$tgross ="$total1"-"$total2";
$rString ="";
 $rString .= "&total=$".$tgross;
 $num_rows = $db->sql_numrows($db->sql_query("SELECT * FROM ".$prefix."_ws_bannerclient"));
$nuserss = "$num_rows";
$rString .= "&memb=".$nuserss;
$result = sql_query("SELECT  name FROM ".$prefix."_ws_bannerclient ORDER BY name DESC LIMIT 0, 2", $dbi);
$nrows = mysql_num_rows($result);
$rString .= "&n=".$nrows;
for ($i=0; $i < $nrows; $i++) {
$row = mysql_fetch_array($result);
$rString .= "&newmb".$i."=".$row['name'];
}
echo $rString;
}
//ADD WS CLIENT
function ws_clientadd($name, $contact, $email, $login, $passwd) {
    global $prefix, $db;
	include("header.php");
	ws_banadmin();
	OpenTable();
	if($name ==""){
	echo _WSNAMEERR._GOBACK;
	exit();
	}elseif($contact ==""){
	echo _WSCONTERR._GOBACK;
	exit();
	}elseif($email ==""){
	echo _WSRMAILERR._GOBACK;
	exit();
	}elseif($login ==""){
	echo _WSLOGINERR._GOBACK;
	exit();
	}elseif($passwd ==""){
	echo _WSPASSERR._GOBACK;
	exit();
	}
    $db->sql_query("insert into " . $prefix . "_ws_bannerclient values (NULL, '$name', '$contact', '$email', '$login', '$passwd')");
    Header("Location: admin.php?op=ws_adsclients");
	CloseTable();
	include("footer.php");
}
function ws_adstatus($ws_id, $ban_enabled) {
    global $prefix, $db;
    if ($ban_enabled == "checked") {
	$active = "";
    } else {
	$active = "checked";
    }
    $ws_id = intval($ws_id);
    $db->sql_query("update " . $prefix . "_ws_banplans set  ban_enabled='$active' WHERE ws_id='$ws_id'");
    Header("Location: admin.php?op=ws_bannerplans");
}
require("adswitches.php");
}
else{
echo "Access Denied";
}
?>