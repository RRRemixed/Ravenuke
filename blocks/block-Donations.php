<?php
/********************************************************/
/* Donations Block for PHP-Nuke                         */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2003 by Codezwiz                    */
/********************************************************/
if (eregi("block-Donations.php",$_SERVER['SCRIPT_NAME'])) {
    	Header("Location: ../../");
    	exit;
}
//Use table instead of graphic (will go into config next version)
$usegraphic = 1;
//Table colors (will go into config next version)
$bgcolor = '#FFFFFF';
$used_bgcolor = '#990000';

	define('CZMETER', true);
    	get_lang("Donate"); 
    	global $sitename, $prefix, $db, $cookie, $nukeurl, $user, $czdconf, $textcolor1;
    	$czdconf = array();
    	$result_config = $db->sql_query("SELECT * FROM {$prefix}_donators_config");
    	while(list($config_name, $config_value) = $db->sql_fetchrow($result_config)){
		$czdconf[$config_name] = $config_value;
    	}
    	$did = $cookie[0];
    	$dip = $_SERVER['REMOTE_ADDR'];
    	//Currency
    	if (($czdconf['dcurrcode'] == "USD") OR ($czdconf['dcurrcode'] == "AUD") OR ($czdconf['dcurrcode'] == "CAD")) { 
      	$currsymbol = "$";
    	} elseif ($czdconf['dcurrcode'] == "EUR") { 
      	$currsymbol = "€";
    	} elseif ($czdconf['dcurrcode'] == "GBP") { 
      	$currsymbol = "£";
    	} elseif ($czdconf['dcurrcode'] == "JPY") {
      	$currsymbol = "¥";
    	} else {
      	$currsymbol = "$";
    	}
    	$content = "<font class=\"content\"><center>"._DONTOPWELCOME."</font></center><br /><br />\n";
	if ($czdconf['dusemeter'] == 1) {  
      	list($total_donated_this_month) = $db->sql_fetchrow($db->sql_query("SELECT SUM(donated) FROM {$prefix}_donators WHERE donmonth='".date("m")."' AND donyear='".date("Y")."'"));
		$total_needed_graph = $czdconf[strtolower(date("F"))] / 10;
		$table_height = '150'; 
		$amount_still_needed = number_format($czdconf[strtolower(date("F"))] - $total_donated_this_month, 2);
      	$content .= "<style type=\"text/css\">\n";
    		$content .= "<!--\n";
    		$content .= ".small_font {\n";
    		$content .= "	font-family: Arial, Helvetica, sans-serif;\n";
    		$content .= "	font-size: 9px;\n";
    		$content .= "	color: $textcolor1;\n";
    		$content .= "}\n";
    		$content .= "-->\n";
    		$content .= "</style>\n";
      	$content .= "<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">\n";
      	$content .= "<tr><td width=\"100%\" align=\"center\"><strong>".date("F")."'s "._DONGOAL.": ".$currsymbol."".number_format($czdconf[strtolower(date("F"))], 2)."</strong><br /><br />\n";
		if ($usegraphic) {
      		$content .= "<table border=\"0\" width=\"80%\" align=\"center\">\n";
      		$content .= "<tr><td align=\"center\">\n";
      		$content .= "<table border='0' height='$table_height' width='30' cellspacing='1' cellpadding='0'>\n";
 			for( $i = $czdconf[strtolower(date("F"))]; $i >= 0; $i -= $total_needed_graph ) { 
				$content .= "<tr><td valign='top' nowrap='nowrap'><font class='small_font'>$ ".number_format($i, 2)."</font></td></tr>\n";
			}
			$content .= "<tr><td valign='top' nowrap='nowrap'>&nbsp;</td></tr>\n";
			$content .= "<tr><td valign='top' nowrap='nowrap'>&nbsp;</td></tr>\n";
			$content .= "<tr><td valign='top' nowrap='nowrap'>&nbsp;</td></tr>\n";
      		$content .= "</table>\n";
      		$content .= "</td><td>\n";
      		$content .= "<table border='0' height='$table_height' width='45' cellspacing='1' cellpadding='0'>\n";
      		$content .= "<tr><td><img src=\"modules.php?name=Donate&amp;op=meter\"></td></tr>\n";
      		$content .= "</table>\n";
      		$content .= "</td></tr></table><br />\n";
		} else {
			$filled_height = ($total_donated_this_month / $czdconf[strtolower(date("F"))]) * $table_height; 
			$empty_height = $table_height - $filled_height;
      		$content .= "<table border='0' width='70' cellspacing='0' cellpadding='1'>\n";
      		$content .= "<tr><td>\n";
      		$content .= "<table border='0' bgcolor='#000000' height='$table_height' width='30' cellspacing='1' cellpadding='0'>\n";
      		$content .= "<tr bgcolor='$bgcolor'><td height='$empty_height' bgcolor='$bgcolor'></td></tr>\n";
      		$content .= "<tr bgcolor='$used_bgcolor'><td height='$filled_height' bgcolor='$used_bgcolor'></td></tr>\n";
      		$content .= "</table>\n";
      		$content .= "</td><td>\n";
      		$content .= "<table border='0' height='".($table_height + 10)."' width='40' cellspacing='0' cellpadding='0'>\n";  
      		$count = 1;
 			for( $i = $czdconf[strtolower(date("F"))]; $i >= 0; $i -= $total_needed_graph ) { 
            		if ($count == 1) { 
                  		$valign = "top";
            		} elseif ($count == 11) {
                  		$valign = "bottom";
            		} else {
                  		$valign = "middle";
            		}   
      			$content .= "<tr><td valign='$valign' nowrap='nowrap'><font class='small_font'>- $ ".number_format($i, 2)."</font></td></tr>\n";
           			$count++;
			}
      		$content .= "</table>\n";
      		$content .= "</td></tr></table><br />\n";
		}
		if ($total_donated_this_month >= $czdconf[strtolower(date("F"))]) {
			$content .= _DONREACHEDGOAL;
		} else {
      		$content .= _DONCOLLECTED." ".$currsymbol."".number_format($total_donated_this_month, 2)." "._DONOURGOAL."\n";
		}
		$content .= "</td></tr></table>\n";
	} 
	$content .= "<center><form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
    	if ($czdconf['dshowamount'] == 1) {
    		$value_settings = $db->sql_fetchrow($db->sql_query("SELECT * FROM {$prefix}_donators_settings"));
    		$content .= "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
    		$content .= "<tr bgcolor=\"$bgcolor2\">\n";
    		$content .= "<td width='100%' align='center'>"._DONAMOUNT.":</td></tr>\n";
    		$content .= "<tr><td width='100%' align='center'>\n";
    		$content .= "$currsymbol <input type=\"text\" name=\"amount\" size=\"6\" value=\"".$value_settings['mval']."\"><br /><small>"._DONAMOUNTEXPTYPE."</small></td></tr>\n";
    		$content .= "</table><br />\n";
  	} elseif ($czdconf['dshowamount'] == 2) {
    		$value_settings = $db->sql_fetchrow($db->sql_query("SELECT * FROM {$prefix}_donators_settings"));
    		$content .= "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
    		$content .= "<tr bgcolor=\"$bgcolor2\">\n";
    		$content .= "<td width='100%' align='center'>"._DONAMOUNT.":</td></tr>\n";
    		$content .= "<tr><td width='100%' align='center'>\n";
    		$content .= "$currsymbol <select name=\"amount\">\n";
    		$content .= "<option value='".$value_settings['mval']."'>".$value_settings['mval']."</option>\n";
    		$content .= "<option value='".$value_settings['val1']."'>".$value_settings['val1']."</option>\n";
    		$content .= "<option value='".$value_settings['val2']."'>".$value_settings['val2']."</option>\n";
    		$content .= "<option value='".$value_settings['val3']."'>".$value_settings['val3']."</option>\n";
    		$content .= "<option value='".$value_settings['val4']."'>".$value_settings['val4']."</option>\n";
    		$content .= "<option value='".$value_settings['val5']."'>".$value_settings['val5']."</option>\n";
    		$content .= "<option value='".$value_settings['val6']."'>".$value_settings['val6']."</option>\n";
    		$content .= "<option value='".$value_settings['val7']."'>".$value_settings['val7']."</option>\n";
    		$content .= "<option value='".$value_settings['val8']."'>".$value_settings['val8']."</option>\n";
    		$content .= "<option value='".$value_settings['val9']."'>".$value_settings['val9']."</option>\n";
    		$content .= "<option value='".$value_settings['val10']."'>".$value_settings['val10']."</option>\n";
    		$content .= "</select><br />\n";
    		$content .= "<small>"._DONAMOUNTEXPSELECT."</small></td></tr>\n";
    		$content .= "</table><br />\n";
  	} 
    	$content .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">";
    	$content .= "<input type=\"hidden\" name=\"business\" value=\"".$czdconf['ppemail']."\">";
    	$content .= "<input type=\"hidden\" name=\"item_name\" value=\"".$czdconf['dname']."\">";
    	$content .= "<input type=\"hidden\" name=\"item_number\" value=\"".$czdconf['dnum']."\">";
    	$content .= "<input type=\"hidden\" name=\"no_shipping\" value=\"1\">";
    	$content .= "<input type=\"hidden\" name=\"custom\" value=\"$dip\">\n";
    	if (is_user($user)) {
    		$content .= "<input type=\"hidden\" name=\"on0\" value=\"ID\">\n";
    		$content .= "<input type=\"hidden\" name=\"os0\" value=\"$did\">\n";
    		$content .= "<input type=\"hidden\" name=\"notify_url\" value=\"$nukeurl/ipn_don.php\">\n";
    		$content .= "<input type=\"hidden\" name=\"return\" value=\"$nukeurl/modules.php?name=Donate&op=received&uid=$did\">";
    	} else {
    		$content .= "<input type=\"hidden\" name=\"on0\" value=\"ID\">\n";
    		$content .= "<input type=\"hidden\" name=\"os0\" value=\"Guest\">\n";
    		$content .= "<input type=\"hidden\" name=\"notify_url\" value=\"$nukeurl/ipn_don.php\">\n";
    		$content .= "<input type=\"hidden\" name=\"return\" value=\"$nukeurl/modules.php?name=Donate&op=received&uid=Guest\">";
    	}
    	$content .= "<input type=\"hidden\" name=\"no_note\" value=\"1\">";
    	$content .= "<input type=\"hidden\" name=\"currency_code\" value=\"".$czdconf['dcurrcode']."\">";
    	$content .= "<input type=\"hidden\" name=\"tax\" value=\"0\">";
    	if (is_user($user)) {
    		$content .= _DONSHOWDONATION."<br /><br />";
    		$content .= "<input type=\"hidden\" name=\"on1\" value=\""._DONSHOWSHORT."\">\n";
    		$content .= "<input type=\"radio\" name=\"os1\" value=\"1\" checked> "._YES."";
    		$content .= "&nbsp;&nbsp;<input type=\"radio\" name=\"os1\" value=\"0\"> "._NO."<br /><br />";
    	}
    	$content .= "<input type=\"image\" style=\"cursor:hand; border:0;\" src=\"".$czdconf['dbutton']."\" name=\"submit\" alt=\""._PPBUTTONALT."\">";
    	$content .= "</form></center>";
    	$dons = "";
    	$i = 1;
    	$result = $db->sql_query("SELECT uid, uname, fname, donated, dondate FROM {$prefix}_donators WHERE donshow='1' AND donmonth='".date("m")."' AND donyear='".date("Y")."' ORDER by id DESC LIMIT 0, ".$czdconf['toshow']);
    	$num = $db->sql_numrows($result);
	if ($num > 0) {
    		$content .= "<hr>&nbsp;<strong><u>"._DONRECENT.":</strong></u><br />\n";
    		while ($row = $db->sql_fetchrow($result)) {
    			if ($i < 10) $czi = "0$i"; else $czi = $i;
    			$uname = check_html($row['uname'], "nohtml");
    			$uname = ucfirst(strtolower($uname));
    			$fname = check_html($row['fname'], "nohtml");
    			$uid = intval($row['uid']);
    			if ($czdconf['dshowpay'] == 1) {
    				$donated = " - ".$currsymbol."".$row['donated'];
    			} else { 
    				$donated = ""; 
    			}
    			$dondate = $row['dondate'];
    			$dondate = substr($dondate, 0, 5);
       		if ($uname == "Guest") {
           			$donator = "Guest";
       		} else {
           			$donator = "<a href='modules.php?name=Your_Account&amp;op=userinfo&amp;username=$uname'>$uname</a>"; 
       		}
    			$dons .= "&nbsp;$czi.&nbsp;$donator <small>(".$dondate."".$donated.")</small><br />\n";
    		$i++;
    		}
    		$content .= $dons;
	} 
	$db->sql_freeresult($result);
	$db->sql_freeresult($result_config);
?>