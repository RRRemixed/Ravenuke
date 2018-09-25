<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2006 by The Empire Clan                                */
/* http://thempire.com                                                  */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('MODULE_FILE')) {
	die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

/**********************************/
/* Configuration                  */
/*                                */
/* You can change this:           */
/* $index = 0; (right side off)   */
/**********************************/
$index = 1;
/**********************************/

include("header.php");
$remote_addr = getenv("REMOTE_ADDR");
$cookie[0] = intval($cookie[0]);
if ($cookie[1] != "") {
	$row = $db->sql_fetchrow($db->sql_query("SELECT name, username, user_email FROM ".$user_prefix."_users WHERE user_id='$cookie[0]'"));
	if ($row['name'] != "") {
		$gamehandle = $row['name'];
	} else {
		$gamehandle = $row['username'];
	}
	$emailaddress = $row['user_email'];
}

$form_block = "
<div align=\"center\"><p><font class=\"title\"><b>$sitename: "._RECRUITMENTTITLE."</b></font></p>
 <p><font class=\"content\">"._RECRUITMENTNOTE."</font></p>
  <form action=\"modules.php?name=$module_name\" method=\"post\">
  	<br>
    <table width=\"35%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"2\">
      <tr> 
        <td width=\"52%\">"._REALNAME.":</td>
        <td width=\"48%\"><input name=\"realname\" type=\"text\" size=\"25\" value=\"$_POST[realname]\"></td>
      </tr>
      <tr> 
        <td>"._GAMEHANDLE.":</td>
        <td><input name=\"gamehandle\" type=\"text\" size=\"25\" value=\"$gamehandle\"></td>
      </tr>
      <tr> 
        <td>"._AGE.":</td>
        <td><input name=\"age\" type=\"text\" size=\"3\" maxlength=\"2\"></td>
      </tr>
      <tr> 
        <td>"._LOCATION.":</td>
        <td><input name=\"location\" type=\"text\" size=\"25\"></td>
      </tr>
      <tr> 
        <td>"._EMAILADDRESS.":</td>
        <td><input name=\"emailaddress\" type=\"text\" size=\"25\" value=\"$emailaddress\"></td>
      </tr>
      <tr> 
        <td>"._INSTANTMESSENGER.":</td>
        <td><input name=\"im\" type=\"text\" size=\"25\"></td>
      </tr>
      <tr> 
        <td>&nbsp;</td>
        <td><p> 
            <label> 
            <input type=\"radio\" name=\"messenger\" value=\"AOL\">
            AOL</label>
            <br>
            <label> 
            <input type=\"radio\" name=\"messenger\" value=\"MSN\">
            MSN</label>
            <br>
            <label> 
            <input type=\"radio\" name=\"messenger\" value=\"Yahoo\">
            Yahoo</label>
            <br>
          </p></td>
      </tr>
      <tr> 
        <td>Hours spent online per week:</td>
        <td><input name=\"hours\" type=\"text\" size=\"4\" maxlength=\"3\"></td>
      </tr>
      <tr> 
        <td colspan=\"2\"><br> <center>If you have been in a clan before, 
            please list all of the<br>
            ones you were in and the reason why you left them.<br>
            <textarea name=\"clans\" cols=\"70\" rows=\"15\"></textarea>
          </center>
          <br></td>
      </tr>
      <tr> 
        <td>"._PRACTICE.":</td>
        <td><select name=\"practice\">
            <option selected>---------------------------------------------</option>
            <option>Yes</option>
            <option>No</option>
            <option>I will do my best to attend</option>
          </select></td>
      </tr>
      <tr> 
        <td>"._WEAPON.":</td>
        <td><select name=\"weapon\">
            <option selected>---------------------------------------------</option>
            <option>Leone 12 Gauge Super</option>
            <option>Leone YG1265 Auto Shotgun</option>
            <option>KM Submachine Gun (MP5)</option>
            <option>Schmidt Machine Pistol (TMP)</option>
            <option>ES C90 (P90)</option>
            <option>Ingram MAC-10</option>
            <option>KM UMP45</option>
            <option>Clarion 5.56</option>
            <option>IDF Defender</option>
            <option>CV-47 (AK-47)</option>
            <option>Maverick M4A1 Carbine (Colt)</option>
            <option>Bullpup (AUG)</option>
            <option>Kreig 552</option>
            <option>Schmidt Scout</option>
            <option>Magnum Sniper Rifle (AWP)</option>
            <option>Kreig 550 Commando (SG550)</option>
            <option>D3/AU-1 (G3)</option>
            <option>Machine Gun M249</option>
          </select></td>
      </tr>
      <tr> 
        <td>"._MAP.":</td>
        <td><select name=\"map\">
            <option selected>---------------------------------------------</option>
            <option>as_oilrig</option>
            <option>as_tundra</option>
            <option>cs_747</option>
            <option>cs_assault</option>
            <option>cs_backalley</option>
            <option>cs_estate</option>
            <option>cs_havana</option>
            <option>cs_italy</option>
            <option>cs_militia</option>
            <option>cs_office</option>
            <option>cs_siege</option>
            <option>cs_thunder</option>
            <option>de_aztec</option>
            <option>de_chateau</option>
            <option>de_cbble</option>
            <option>de_dust</option>
            <option>de_dust2</option>
            <option>de_inferno</option>
            <option>de_nuke</option>
            <option>de_piranesi</option>
            <option>de_prodigy</option>
            <option>de_storm</option>
            <option>de_train</option>
            <option>de_vegas</option>
            <option>de_vertigo</option>
          </select></td>
      </tr>
      <tr> 
        <td colspan=\"2\"><br> <center>Please explain a little about 
            yourself, when you are normally<br>
            online, when you can get a microphone (If you dont already have one)<br>
            and anything else you would like to inform us.<br>
            <textarea name=\"about\" cols=\"70\" rows=\"15\"></textarea>
          </center>
          <br></td>
      </tr>
      <tr> 
        <td>"._PAY.":</td>
        <td><select name=\"pay\">
            <option selected>---------------------------------------------</option>
            <option>Yes</option>
            <option>No</option>
          </select></td>
      </tr>
      <tr> 
        <td colspan=\"2\"><br> <center>Where did you hear about our 
            clan.<br>
            <textarea name=\"where\" cols=\"70\" rows=\"15\"></textarea>
          </center>
          <br></td>
      </tr>
    </table>
	<br>
	<input type=\"hidden\" name=\"op\" value=\"ds\">
    <input type=\"submit\" name=\"Submit\" value=\"Submit Recruitment Form\">
  </form>
</div>";

OpenTable();
if ($_POST[op] != "ds") {
	echo "$form_block";
} else if ($_POST[op] == "ds") {
	if ($_POST[realname] == "") {
		$realname_err = "<div align=\"center\"><p>"._ENTERNAME."</p></div>";
		$send = "no";
	}
	if ($_POST[emailaddress] == "") {
		$emailaddress_err = "<div align=\"center\"><p>"._ENTEREMAIL."</p></div>";
		$send = "no";
	}
	if ($send != "no") {
		$msg = "New Recruit\n\n";
		$msg .= "Real Name: $_POST[realname]\n";
		$msg .= "Game Handle: $_POST[gamehandle]\n";
		$msg .= "Age: $_POST[age]\n";
		$msg .= "Location: $_POST[location]\n";
		$msg .= "Email Address: $_POST[emailaddress]\n";
		$msg .= "Instant Messenger: $_POST[im]\n";
		$msg .= "Messenger Type: $_POST[messenger]\n";
		$msg .= "Hours spent online per week: $_POST[hours]\n";
		$msg .= "Other Clans: $_POST[clans]\n";
		$msg .= "Would you be able to attend practice?: $_POST[practice]\n";
		$msg .= "Favorite Weapon: $_POST[weapon]\n";
		$msg .= "Favorite Map: $_POST[map]\n";
		$msg .= "About Yourself: $_POST[about]\n";
		$msg .= "Would you help pay for a server?: $_POST[pay]\n";
		$msg .= "Where did you hear about our clan?: $_POST[where]\n\n";
		$msg .= "Recruits IP Address: $remote_addr\n\n";
		$to = "$adminmail";
		$subject = "I Would Like to Join Your Clan";
		$mailheaders = "From: $_POST[realname] <$_POST[emailaddress]>\n";
		$mailheaders .= "Reply-To: $_POST[emailaddress]\n";
		mail($to, $subject, $msg, $mailheaders);
		echo "<div align=\"center\"><p>"._MAILSENT."</p></div>";
		echo "<div align=\"center\"><p>"._THANKSFORCONTACT."</p></div>";
	} else if ($send == "no") {
		OpenTable2();
		echo "$realname_err";
		echo "$emailaddress_err";
		CloseTable2();		
		echo "<br><br>";
		echo "$form_block";
	}
}

echo "<div align=\"center\"><p>"._IPADDRESS.": $remote_addr</p></div>";
CloseTable();
include("footer.php");

?>