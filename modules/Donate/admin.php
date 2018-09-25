<?php
/********************************************************/
/* Donations for PHP-Nuke                               */
/* Version Universal 3.0  06-06                         */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2006 by Codezwiz                    */
/********************************************************/
if (!eregi("modules.php", $_SERVER['SCRIPT_NAME'])) {
    	die ("You can't access this file directly...");
}

$module_name = basename(dirname(__FILE__));
require_once("mainfile.php");
get_lang($module_name);
if (is_admin($admin)) {
    	if(!is_array($admin)) {
        	$adm = base64_decode($admin);
        	$adm = explode(":", $adm);
        	$aname = "$adm[0]";
    	} else {
        	$aname = "$admin[0]";
    	}
}
$adm = $db->sql_fetchrow($db->sql_query("SELECT * FROM {$prefix}_authors WHERE aid='$aname'"));
if ($adm['radminsuper']==1) {

/*********************************************************/
/* Index                                                 */
/*********************************************************/

function donmenu(){
    	global  $bgcolor1, $bgcolor2, $textcolor1, $module_name;
    	OpenTable();
    	echo "<center>\n<table width='60%' cellpadding='2' cellspacing='1' bgcolor='$textcolor1'>\n";
    	echo "<tr bgcolor='$bgcolor2'><td align='center' colspan='2' class='option'><strong>"._DONMAINMENU."</strong></td></tr>\n";
    	echo "<tr bgcolor='$bgcolor2' align='center'>\n";
    	echo "<td width='50%'><a href='modules.php?name=$module_name&file=admin&op=donatorsstats'>"._DONSTATS."</a></td>\n";
    	echo "<td width='50%'><a href='modules.php?name=$module_name&file=admin&op=donatorsconfig'>"._DONCONFIG."</a></td>\n";
    	echo "<tr bgcolor='$bgcolor2' align='center'>\n";
    	echo "<td width='50%'><a href='modules.php?name=$module_name&file=admin&op=donators'>"._DONATIONS."</a></td>\n";
    	echo "<td width='50%'><a href='modules.php?name=$module_name&file=admin&op=donatorsvalues'>"._DONVALSET."</a></td>\n";
    	echo "</tr>\n</table><br />[ <a href='admin.php'>"._DONBACKTOMAIN."</a> ]\n</center>\n";
    	CloseTable();
    	echo "<br />";
}

function num_donators() {
    	global $prefix, $db;
    	$sql = "SELECT COUNT(*) FROM {$prefix}_donators";
    	list($numrows) = $db->sql_fetchrow($db->sql_query($sql));
    	return $numrows;
}

function sum_donations() {
    	global $prefix, $db;
    	$sql = "SELECT SUM(donated) FROM {$prefix}_donators";
    	list($sum) = $db->sql_fetchrow($db->sql_query($sql));
    	return $sum;
}

function admdonators() {
    	global $admin, $bgcolor2, $prefix, $db, $sitename;
    	include ("header.php");
    	title("$sitename Donations");
    	donmenu();
    	include("footer.php");
}



function donators($m, $y) {
    	global $admin, $bgcolor2, $prefix, $db, $sitename, $module_name, $pagenum;
    	$donnum = 10;
    	if ($pagenum == "") { $pagenum = 1; }
    	$offset = ($pagenum-1) * $donnum;
    	include ("header.php");
    	title("$sitename Donations");
    	donmenu();
      if (!isset($m)) { $m = date("m"); } else { $m = check_html($m, "nohtml"); }
      if (!isset($y)) { $y = date("Y"); } else { $y = check_html($y, "nohtml"); }
    	$result = $db->sql_query("SELECT * FROM {$prefix}_donators WHERE donmonth='$m' AND donyear='$y' ORDER BY id DESC LIMIT $offset, $donnum");
    	$num = $db->sql_numrows($result);
      OpenTable();
    	echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">"
		."<tr bgcolor=\"$bgcolor2\"><td width='30%'><strong>"._DONSELECTMONTHTOVIEW."</strong></td><td width='70%'>\n";
      echo "<select name='jump' onChange='top.location.href=this.options[this.selectedIndex].value'>\n";
	echo "<option value=''> ----------------------------- </option>";
      $result_dons = $db->sql_query("SELECT SUM(donated) AS donated, donyear, donmonth FROM {$prefix}_donators GROUP BY donmonth, donyear ORDER BY donyear, donmonth ASC");
	while ($row_dons = $db->sql_fetchrow($result_dons)) {
      	$sel = "";
            if ( ($row_dons['donmonth'] == $m) AND ($row_dons['donyear'] == $y) ) { $sel = "selected"; }
		echo "<option value='modules.php?name=$module_name&amp;file=admin&amp;op=donators&amp;m=".$row_dons['donmonth']."&amp;y=".$row_dons['donyear']."' $sel> ".$row_dons['donmonth']." - ".$row_dons['donyear']." ("._DONTOTALDROP.": ".$row_dons['donated'].") </option>";
      }
	echo "</select></td>\n</tr>\n";
	echo "</table>\n";
	CloseTable();
	echo "<br />\n";
    	if ($num > 0) {
    		OpenTable();
    		echo "<table width=\"100%\" cellpadding=\"1\" cellspacing=\"0\" border=\"0\">"
			."<tr bgcolor=\"$bgcolor2\"><td width='10%'>"._DONNAME."</td><td width='35%'>"._DONEMAIL."</td><td width='15%'>"._DONAMOUNT."</td><td width='20%'>"._DONDATE."</td><td width='20%' align='center'>"._DONACTION."</td></tr>";
    		while ($row = $db->sql_fetchrow($result)) {
			$id = intval($row['id']);
			$uname = $row['uname'];
      		$fname = $row['fname'];
      		$email = $row['email'];
      		if ($uname == "") {
      			$donator = "$fname";
      		} else {
      			$donator = "$uname"; 
      		}
			$donated = $row['donated'];
			$dondate = $row['dondate'];
			echo "<tr><td colspan=5><hr></td></tr><tr><td><strong>$donator</strong></td><td>\n";
      		echo "<strong><a href=\"mailto:$email\">$email</a></strong></td>";
      		echo "<td><strong>$donated</strong></td>";
      		echo "<td><strong>$dondate</strong></td>";
      		echo "<td align='center'>[ <a href=\"modules.php?name=$module_name&file=admin&op=donatorsedit&amp;id=$id\">"._EDIT."</a> | <a href=\"modules.php?name=$module_name&file=admin&op=donatorsdel&amp;id=$id&amp;ok=0\">"._DELETE."</a> ]</td></tr>";
   		}
      	echo "<tr><td colspan=5><hr>";
      	echo "</td></tr></table><br />";
		$numdons = $db->sql_numrows($db->sql_query("SELECT * FROM {$prefix}_donators WHERE donmonth='$m' AND donyear='$y'"));
		$numpages = ceil($numdons / $donnum);
		if ($numpages > 1) {
			opentable();
			echo "<center>$numdons Donator(s) ($numpages page(s), $donnum per page)<br>";
			if ($pagenum > 1) {
				$prevpage = $pagenum - 1;
				$leftarrow = "modules/$module_name/images/left.gif";
				echo "<a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=donators&amp;pagenum=$prevpage\">";
				echo "<img src=\"$leftarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";
			}
			echo "[ ";
			for ($i=1; $i < $numpages+1; $i++) {
				if ($i == $pagenum) {
					echo "<strong>$i</strong>";
				} else {
					echo "<a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=donators&amp;pagenum=$i\">$i</a>";
				}
				if ($i < $numpages) { echo " | "; } else { echo " ]"; }
			}
			if ($pagenum < $numpages) {
				$nextpage = $pagenum + 1;
				$rightarrow = "modules/$module_name/images/right.gif";
				echo "<a href=\"modules.php?name=$module_name&amp;file=admin&amp;op=donators&amp;pagenum=$nextpage\">";
				echo "<img src=\"$rightarrow\" align=\"absmiddle\" border=\"0\" hspace=\"10\"></a>";
			}
			echo "</center>";
			closetable();
            	echo "<br />"; 
		}
    		CloseTable();
  	} else {
    		OpenTable();
    		echo "<center><strong>"._NODONATIONSYET."</strong><br /><br />"._GOBACK."</center>\n";
    		CloseTable();
  	}
	$db->sql_freeresult($result);
    	include("footer.php");
}

function donatorsedit($id) {
    	global $admin, $bgcolor2, $prefix, $db, $sitename, $module_name;
    	$id = intval($id); 
    	include ("header.php");
    	title("$sitename Donations");
    	donmenu();
    	$sql = "SELECT * FROM {$prefix}_donators where id='$id'";
    	$result = $db->sql_query($sql);
    	$row = $db->sql_fetchrow($result);
	$id = intval($row['id']);
	$uname = check_html($row['uname'], "nohtml");
	$fname = check_html($row['fname'], "nohtml");
	$lname = check_html($row['lname'], "nohtml");
	$email = check_html($row['email'], "nohtml");
      $donated = $row['donated'];
      $dondate = $row['dondate'];
      $donshow = intval($row['donshow']);
      $uip = $row['uip'];
    	OpenTable();
    	echo "<center><font class=\"option\"><strong>"._DONEDITDON."</strong></font></center>"
	  	."<form action='modules.php?name=$module_name' method='post'>\n"
	  	."<input type='hidden' name='file' value='admin'>\n"
	  	."<input type=\"hidden\" name=\"id\" value=\"$id\">"
	  	."<table border=\"0\" width=\"100%\">"
	  	."<tr><td>$sitename "._DONUSERNAME.":</td><td><input type=\"text\" name=\"uname\" size=\"31\" value=\"$uname\"></td></tr>"
	  	."<tr><td>"._DONFIRSTNAME."</td><td><input type=\"text\" name=\"fname\" size=\"31\" value=\"$fname\"></td></tr>"
	  	."<tr><td>"._DONLASTNAME."</td><td><input type=\"text\" name=\"lname\" size=\"31\" value=\"$lname\"></td></tr>"
	  	."<tr><td>"._DONEMAIL."</td><td><input type=\"text\" name=\"email\" size=\"31\" value=\"$email\"></td></tr>"
	  	."<tr><td>"._DONIP."</td><td><input type=\"text\" name=\"uip\" size=\"31\" value=\"$uip\">"
	  	."</td></tr>"
	  	."<tr><td>"._DONDATE."</td><td><input type=\"text\" name=\"dondate\" size=\"31\" value=\"$dondate\"></td></tr>";
    	if ($donshow == 1) {
        	$sel1 = "checked";
        	$sel2 = "";
    	} elseif ($donshow == 0) {
        	$sel1 = "";
        	$sel2 = "checked";
    	}
    	echo "<tr><td>"._DONSHOWUSER."</td><td><input type=\"radio\" name=\"donshow\" value=\"1\" $sel1>&nbsp;"._YES." &nbsp;&nbsp;"
        	."<input type=\"radio\" name=\"donshow\" value=\"0\" $sel2>&nbsp;"._NO."</td></tr>"
	  	."<tr><td>"._DONAMOUNTDON."</td><td><input type=\"text\" name=\"donated\" size=\"31\" value=\"$donated\">"
	  	."</td></tr>"
        	."</table><br>"                                                                                                                                               
	  	."<input type=\"hidden\" name=\"op\" value=\"donatorssave\">"
	  	."<input type=\"submit\" value=Update> "._GOBACK.""
	  	."</form>";
    	CloseTable();
    	include("footer.php");
}

function donatorssave($id, $uname, $fname, $lname, $email, $donated, $dondate, $donshow, $uip) {
    	global $prefix, $db, $module_name;
    	$donok = intval($donok);
    	$id = intval($id);
	$uname = check_words(check_html(addslashes($uname), "nohtml"));
	$fname = check_words(check_html(addslashes($fname), "nohtml"));
	$lname = check_words(check_html(addslashes($lname), "nohtml"));
	$email = check_words(check_html(addslashes($email), "nohtml"));
	$uip = check_words(check_html(addslashes($uip), "nohtml"));
      $donated = intval($donated);
      $donshow = intval($donshow);
    	$db->sql_query("UPDATE {$prefix}_donators SET uname='$uname', fname='$fname', lname='$lname', email='$email', donated='$donated', dondate='$dondate', donshow='$donshow', uip='$uip' WHERE id='$id'");
    	Header("Location: modules.php?name=$module_name&file=admin&op=donators");
}


function donatorsdel($id, $ok=0) {
    	global $prefix, $db, $sitename, $module_name;
    	$id = intval($id);
   	$ok = intval($ok);
    	if ($ok == 1) {
      	$db->sql_query("DELETE FROM {$prefix}_donators WHERE id='$id'");
		Header("Location: modules.php?name=$module_name&file=admin&op=donators");
    	} else {
		include("header.php");
      	title("$sitename Donations");
      	donmenu();
		OpenTable();
		echo "<br><center><strong>"._DONDELETEDON."</strong><br><br>";
	echo "[ <a href=\"modules.php?name=$module_name&file=admin&op=donatorsdel&amp;id=$id&amp;ok=1\">"._YES."</a> | <a href=\"modules.php?name=$module_name&file=admin&op=donators\">"._NO."</a> ]</center><br><br>";
		CloseTable(); 
   		include("footer.php");
    	}
}

function donatorsvalues() {
     	global $bgcolor2, $prefix, $db, $sitename, $textcolor1, $module_name;
    	include ("header.php");
    	title("$sitename Donations Value Setting's");
    	donmenu();
    	$avalues = $db->sql_fetchrow($db->sql_query("SELECT * FROM {$prefix}_donators_settings"));
    	OpenTable();
    	echo "<center><font class=\"option\"><strong>"._DONEDITVALUES."</strong></font></center>\n"
	  	."<form action='modules.php?name=$module_name' method='post'>\n"
	  	."<input type='hidden' name='file' value='admin'>\n"
		."<center><table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"400\" bgcolor='$textcolor1'>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Default Value:</td><td width='60%'>$ <input type=\"text\" name=\"mval\" size=\"10\" value=\"".$avalues['mval']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 1:</td><td width='60%'>$ <input type=\"text\" name=\"val1\" size=\"10\" value=\"".$avalues['val1']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 2:</td><td width='60%'>$ <input type=\"text\" name=\"val2\" size=\"10\" value=\"".$avalues['val2']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 3:</td><td width='60%'>$ <input type=\"text\" name=\"val3\" size=\"10\" value=\"".$avalues['val3']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 4:</td><td width='60%'>$ <input type=\"text\" name=\"val4\" size=\"10\" value=\"".$avalues['val4']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 5:</td><td width='60%'>$ <input type=\"text\" name=\"val5\" size=\"10\" value=\"".$avalues['val5']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 6:</td><td width='60%'>$ <input type=\"text\" name=\"val6\" size=\"10\" value=\"".$avalues['val6']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 7:</td><td width='60%'>$ <input type=\"text\" name=\"val7\" size=\"10\" value=\"".$avalues['val7']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 8:</td><td width='60%'>$ <input type=\"text\" name=\"val8\" size=\"10\" value=\"".$avalues['val8']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 9:</td><td width='60%'>$ <input type=\"text\" name=\"val9\" size=\"10\" value=\"".$avalues['val9']."\"></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>Value 10:</td><td width='60%'>$ <input type=\"text\" name=\"val10\" size=\"10\" value=\"".$avalues['val10']."\"></td></tr>\n"
      	."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONAPPLYCHANGE."</td><td width='60%'>\n"                                                                                                                                               
		."<input type=\"hidden\" name=\"op\" value=\"donatorsvaluessave\">\n"
		."<input type=\"submit\" value=\""._SUBMIT."\"></td></tr></table>\n"
		."</form>\n<br />\n<center>"._GOBACK."</center>\n";
   	CloseTable();
    	include("footer.php");
}

function donatorsvaluessave($mval, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10) {
    	global $prefix, $db, $module_name;
    	$db->sql_query("UPDATE {$prefix}_donators_settings SET mval='".check_html($mval, "nohtml")."', val1='".check_html($val1, "nohtml")."', val2='".check_html($val2, "nohtml")."', val3='".check_html($val3, "nohtml")."', val4='".check_html($val4, "nohtml")."', val5='".check_html($val5, "nohtml")."', val6='".check_html($val6, "nohtml")."', val7='".check_html($val7, "nohtml")."', val8='".check_html($val8, "nohtml")."', val9='".check_html($val9, "nohtml")."', val10='".check_html($val10, "nohtml")."'");
    	Header("Location: modules.php?name=$module_name&file=admin&op=donatorsvalues");
}

function return_month($id) {
	if ($id == '01') {
		$month = _JANUARY;
	} elseif ($id == '02') {
		$month = _FEBRUARY;
	} elseif ($id == '03') {
		$month = _MARCH;
	} elseif ($id == '04') {
		$month = _APRIL;
	} elseif ($id == '05') {
		$month = _MAY;
	} elseif ($id == '06') {
		$month = _JUNE;
	} elseif ($id == '07') {
		$month = _JULY;
	} elseif ($id == '08') {
		$month = _AUGUST;
	} elseif ($id == '09') {
		$month = _SEPTEMBER;
	} elseif ($id == '10') {
		$month = _OCTOBER;
	} elseif ($id == '11') {
		$month = _NOVEMBER;
	} elseif ($id == '12') {
		$month = _DECEMBER;
	} 
	return $month;
}
 
switch($op) {

    	case "donatorsstats";
    	include("header.php");
    	$czdmconf = array();
    	$result = $db->sql_query("SELECT * FROM {$prefix}_donators_config");
    	while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
		$czdmconf[$config_name] = $config_value;
    	}
    	//Currency
    	if (($czdmconf['dcurrcode'] == "USD") OR ($czdmconf['dcurrcode'] == "AUD") OR ($czdmconf['dcurrcode'] == "CAD")) { 
      	$currsymbol = "$";
    	} elseif ($czdmconf['dcurrcode'] == "EUR") { 
      	$currsymbol = "€";
    	} elseif ($czdmconf['dcurrcode'] == "GBP") { 
      	$currsymbol = "£";
    	} elseif ($czdmconf['dcurrcode'] == "JPY") {
      	$currsymbol = "¥";
    	} else {
      	$currsymbol = "$";
    	}
    	title("$sitename Donation Stat's");
    	donmenu();
    	if (num_donators() > 0){
    		opentable();
    		echo "<center><table width=\"95%\" cellpadding=\"2\" bgcolor=\"$textcolor1\" cellspacing=\"0\" border=\"0\">"
	  		."<tr bgcolor=\"$bgcolor2\"><td width='50%'>"._DONTOTALDONS." $sitename</td><td width='50%'>"._DONTOTALAMT." $sitename</td></tr></table>";
    		echo "<br /><table width=\"95%\" cellpadding=\"2\" cellspacing=\"0\" border=\"0\">";
    		echo "<tr bgcolor=\"$bgcolor1\"><td width='50%'><strong>".num_donators()."</a></strong>";
    		echo "</td><td width='50%'><strong>".$currsymbol."".sum_donations()."</strong></td></tr>";
    		echo "</table><br /><br />";
    		echo "<table width=\"100%\" cellpadding=\"2\" cellspacing=\"1\" border=\"0\" bgcolor=\"$textcolor1\">"
			."<tr bgcolor=\"$bgcolor2\"><td width='100%' colspan='3' align='center'><strong>"._DONMONTHLYBREAKDOWN."</strong></td></tr>\n"
			."<tr bgcolor=\"$bgcolor2\"><td width='33%'><strong>Month</strong></td><td width='33%'><strong>Year</strong></td><td width='33%'><strong>Amount</strong></td></tr>\n";
      	$result_dons = $db->sql_query("SELECT SUM(donated) AS donated, donyear, donmonth FROM {$prefix}_donators GROUP BY donmonth, donyear ORDER BY donyear, donmonth ASC");
		while ($row_dons = $db->sql_fetchrow($result_dons)) {
			echo "<tr bgcolor=\"$bgcolor2\"><td width='33%'>".return_month($row_dons['donmonth'])."</td><td width='33%'>".$row_dons['donyear']."</td><td width='33%'>".$currsymbol."".$row_dons['donated']."</td></tr>";
      	}
		echo "</table>\n";
    		echo "<br /><br /><center>"._GOBACK."</center>";
    		closetable(); 
    	} else {
    		opentable();
    		echo "<center><strong>"._NODONATIONSYET."</strong><br /><br />"._GOBACK."</center>\n";
    		closetable();
    	}
    	include("footer.php");
    	break;

    	case "donatorsconfig";
    	include("header.php");
    	title("$sitename Donations Configuration");
    	donmenu();
    	OpenTable();
    	$daconf = array();
    	$sql = "SELECT * FROM {$prefix}_donators_config";
    	$result = $db->sql_query($sql);
     	while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
	    	$daconf[$config_name] = $config_value;
    	}
    	echo "<br /><br />\n";
    	//Currency
    	if (($daconf['dcurrcode'] == "USD") OR ($daconf['dcurrcode'] == "AUD") OR ($daconf['dcurrcode'] == "CAD")) { 
      	$currsymbol = "$";
    	} elseif ($daconf['dcurrcode'] == "EUR") { 
      	$currsymbol = "€";
    	} elseif ($daconf['dcurrcode'] == "GBP") { 
      	$currsymbol = "£";
    	} elseif ($daconf['dcurrcode'] == "JPY") {
      	$currsymbol = "¥";
    	} else {
      	$currsymbol = "$";
    	}
      echo "<center><table width='90%' bgcolor='$textcolor1' cellspacing='1' cellpadding='2'>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='100%' colspan='2' align='center'><strong>"._DONGENSETTINGS."</strong></td></tr>\n"
		."<form action='modules.php?name=$module_name' method='post'>\n"
		."<input type='hidden' name='file' value='admin'>\n"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONPAYPALAD."</td><td width='60%'>\n"
		."<input type='text' size='40' name='ppemail' value='".$daconf['ppemail']."'></td></tr>\n"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONNUMDONATORS."</td><td width='60%'>\n"
		."<input type='text' size='40' name='toshow' value='".$daconf['toshow']."'></td></tr>\n"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONITEMNAME."</td><td width='60%'>\n"
		."<input type='text' size='40' name='dname' value='".$daconf['dname']."'></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONITEMNUMBER."</td><td width='60%'>\n"
		."<input type='text' size='40' name='dnum' value='".$daconf['dnum']."'></td></tr>\n"
		."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONIMAGEBUTTON."</td><td width='60%'>\n"
		."<input type='text' size='40' name='dbutton' value='".$daconf['dbutton']."'></td></tr>\n"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONCURRENCY."<br /><small>"._DONCURRENCYEXPL."</small></td><td width='60%'>\n"
		."<input type='text' size='10' name='dcurrcode' value='".$daconf['dcurrcode']."'>&nbsp;$currsymbol</td></tr>\n"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONSHOWAMOUNT."</td><td width='60%'>\n"
		."&nbsp;&nbsp;&nbsp;\n";
	if($daconf['dshowpay'] == "1"){
		$sm1 = "CHECKED";
		$sm2 = "";
	} else {
		$sm1 = "";
		$sm2 = "CHECKED";
	}
	echo "<input type='radio' name='dshowpay' value='1' ".$sm1.">&nbsp;"._YES."&nbsp;&nbsp;&nbsp;\n"
		."<input type='radio' name='dshowpay' value='0' ".$sm2.">&nbsp;"._NO."</td></tr>\n";
      if ($daconf['dshowamount'] == 0) {
        	$sel1 = "selected";
        	$sel2 = "";
        	$sel3 = "";
    	} elseif ($daconf['dshowamount'] == 1) {
        	$sel1 = "";
        	$sel2 = "selected";
        	$sel3 = "";
    	} elseif ($daconf['dshowamount'] == 2) {
        	$sel1 = "";
        	$sel2 = "";
        	$sel3 = "selected";
    	}  
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._DONBLOCKPRESENT."</td><td width='60%'><select name='dshowamount'>";
      echo "<option value='0' $sel1>"._DONJUSTBUTTON."</option>";
      echo "<option value='1' $sel2>"._DONINPUTBOX."</option>";
      echo "<option value='2' $sel3>"._DONPRESETDROP."</option>";
      echo "</select></td></tr>"
            ."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONUSEMETER."</td><td width='60%'>\n"
		."&nbsp;&nbsp;&nbsp;\n";
	if ($daconf['dusemeter'] == 1){
		$smu1 = "CHECKED";
		$smu2 = "";
	} else {
		$smu1 = "";
		$smu2 = "CHECKED";
	}
	echo "<input type='radio' name='dusemeter' value='1' ".$smu1.">&nbsp;"._YES."&nbsp;&nbsp;&nbsp;\n"
		."<input type='radio' name='dusemeter' value='0' ".$smu2.">&nbsp;"._NO."</td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='100%' colspan='2' align='center'><strong>"._DONGOALSETTINGS."</strong></td></tr>\n";
	echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._JANUARY.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='djanuary' value='".number_format($daconf['january'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._FEBRUARY.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dfebruary' value='".number_format($daconf['february'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._MARCH.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dmarch' value='".number_format($daconf['march'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._APRIL.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dapril' value='".number_format($daconf['april'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._MAY.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dmay' value='".number_format($daconf['may'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._JUNE.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='djune' value='".number_format($daconf['june'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._JULY.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='djuly' value='".number_format($daconf['july'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._AUGUST.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='daugust' value='".number_format($daconf['august'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._SEPTEMBER.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dseptember' value='".number_format($daconf['september'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._OCTOBER.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='doctober' value='".number_format($daconf['october'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._NOVEMBER.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='dnovember' value='".number_format($daconf['november'], 2)."'></td></tr>\n";
      echo "<tr bgcolor='$bgcolor2'><td width='40%'>"._DECEMBER.":</td><td width='60%'>\n";
	echo "$currsymbol <input type='text' size='10' name='ddecember' value='".number_format($daconf['december'], 2)."'></td></tr>\n";
      echo "</tr>";
      echo "</table><br />";
      echo "<center><br /><table width='90%' bgcolor='$textcolor1' cellspacing='1' cellpadding='2'>"
      	."<tr bgcolor='$bgcolor2'><td width='40%'>"._DONAPPLYCHANGE."</td><td>\n"
		."<input type='hidden' name='op' value='donatorsconfigsave'>\n"
		."&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' value='"._SUBMIT."'>\n"
		."&nbsp;&nbsp;&nbsp;<input type='reset' value='"._RESET."'></td></tr>";
		
    	echo "</form></table></center>\n";
    	CloseTable();
    	include("footer.php");
    	break;

    	case "donatorsconfigsave":
    	$newdaconfig = array();
    	$newdaconfig['ppemail'] = check_words(check_html(addslashes($ppemail), "nohtml"));
    	$newdaconfig['toshow'] = intval($toshow);
    	$newdaconfig['dname'] = check_words(check_html(addslashes($dname), "nohtml"));
    	$newdaconfig['dnum'] = check_words(check_html(addslashes($dnum), "nohtml"));
    	$newdaconfig['dbutton'] = check_words(check_html(addslashes($dbutton), "nohtml"));
    	$newdaconfig['dcurrcode'] = check_words(check_html(addslashes($dcurrcode), "nohtml"));
    	$newdaconfig['dshowpay'] = intval($dshowpay);
    	$newdaconfig['dshowamount'] = intval($dshowamount);
    	$newdaconfig['january'] = check_words(check_html(addslashes($djanuary), "nohtml"));
    	$newdaconfig['february'] = check_words(check_html(addslashes($dfebruary), "nohtml"));
    	$newdaconfig['march'] = check_words(check_html(addslashes($dmarch), "nohtml"));
    	$newdaconfig['april'] = check_words(check_html(addslashes($dapril), "nohtml"));
    	$newdaconfig['may'] = check_words(check_html(addslashes($dmay), "nohtml"));
    	$newdaconfig['june'] = check_words(check_html(addslashes($djune), "nohtml"));
    	$newdaconfig['july'] = check_words(check_html(addslashes($djuly), "nohtml"));
    	$newdaconfig['august'] = check_words(check_html(addslashes($daugust), "nohtml"));
    	$newdaconfig['september'] = check_words(check_html(addslashes($dseptember), "nohtml"));
    	$newdaconfig['october'] = check_words(check_html(addslashes($doctober), "nohtml"));
    	$newdaconfig['november'] = check_words(check_html(addslashes($dnovember), "nohtml"));
    	$newdaconfig['december'] = check_words(check_html(addslashes($ddecember), "nohtml"));
    	$newdaconfig['dusemeter'] = intval($dusemeter);
    	$result = $db->sql_query("SELECT * FROM {$prefix}_donators_config");
    	while(list($config_name, $config_value) = $db->sql_fetchrow($result)){
    		$db->sql_query("UPDATE {$prefix}_donators_config SET config_value='".$newdaconfig[$config_name]."' WHERE config_name='".$config_name."'");
  	}
    	header("Location: modules.php?name=$module_name&file=admin&op=donatorsconfig");
    	break;

    	case "donatorsdel":
    	donatorsdel($id, $ok);
    	break;

    	case "donatorsedit":
    	donatorsedit($id);
    	break; 

    	case "donatorssave":
    	donatorssave($id, $uname, $fname, $lname, $email, $donated, $dondate, $donshow, $uip);
    	break;
    
    	case "donatorsapprove":
    	donatorsapprove($id, $ok);
    	break;

    	case "donatorsvalues":
    	donatorsvalues();
    	break;

    	case "donatorsvaluessave":
    	donatorsvaluessave($mval, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10);
    	break;

    	case "donators":
    	donators($m, $y);
    	break;

    	default:
    	admdonators();
    	break;
}

} else {
    	$pagetitle = "CZ Donators: ERROR";
    	include("header.php");
    	title("$pagetitle");
    	OpenTable();
    	echo "<center><strong>"._DONSUPERMODS."</strong><center>\n";
    	CloseTable();
    	include("footer.php");
}

?>