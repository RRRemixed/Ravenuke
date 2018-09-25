<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Martijn Willekens                              */
/* http://www.unters-designs.be.tt                                      */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}


global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT title, admins FROM ".$prefix."_modules WHERE title='Downloads'"));
$row2 = $db->sql_fetchrow($db->sql_query("SELECT name, radminsuper FROM ".$prefix."_authors WHERE aid='$aid'"));
$admins = explode(",", $row['admins']);
$auth_user = 0;
for ($i=0; $i < sizeof($admins); $i++) {
	if ($row2['name'] == "$admins[$i]" AND !empty($row['admins'])) {
		$auth_user = 1;
	}
}

if ($row2['radminsuper'] == 1 || $auth_user == 1) {


	function WarsMenu() {
		global $admin_file, $bgcolor2, $bgcolor1, $bgcolor3, $bgcolor4;

		OpenTable();
		echo "<center>
		<table bgcolor=$bgcolor4 cellspacing=1 cellpadding=3 border=0 align=center width=100%>
			<tr>
				<td bgcolor='$bgcolor2' width=15% align=center><a href=\"".$admin_file.".php?op=WarsAdmin\">Wars</a></td>
				<td rowspan=2 bgcolor='$bgcolor1' width=25% align=center><font class=\"title\"><b>Wars Admin Menu</b></font></td>
				<td bgcolor='$bgcolor2' width=15% align=center><a href=\"".$admin_file.".php?op=GamesAdmin\">Games</a></td>
			</tr>
			<tr>
				<td bgcolor='$bgcolor2' align=center><a href=\"".$admin_file.".php?op=Add_war\">Add War</a></td>
				<td bgcolor='$bgcolor2' align=center><a href=\"".$admin_file.".php?op=Add_game\">Add Game</a></td>
			</tr>
			<tr>
				<td bgcolor='$bgcolor2' align=center><a href=\"".$admin_file.".php?op=WarsMain\">Wars Admin Main</a></td>
				<td bgcolor='$bgcolor2' align=center><a href=\"".$admin_file.".php?op=WarsCredits\">Credits</a></td>
				<td bgcolor='$bgcolor2' align=center><a href=\"".$admin_file.".php\">Administration</a></td>
			</tr>		
		</table>";
		CloseTable();
		echo "<br>";
		}

function WarsCredits() {
		include ("header.php");
		WarsMenu();
		OpenTable();
		echo "<br><br><center><a href=\"http://www.unters-designs.be.tt\" target=\"_blank\" >Module Made by Untergang - Unters-Designs.be.tt</a></center><br><br>";
		CloseTable();
		include ("footer.php");
		}
	function WarsMain() {
		global $prefix, $db, $bgcolor2, $bgcolor4, $banners, $admin_file, $ad_admin_menu_main, $bgcolor1;
		include ("header.php");
		WarsMenu();
				OpenTable();
		echo "<center><font class=\"option\"><b>Latest Wars</b></font></center><br>"
		."<table width=100% border=0 bgcolor=$bgcolor4 cellspacing=1><tr>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Date</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Opponent</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Status</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>ID</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Edit</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Remove</b></td><tr>";
		$result = $db->sql_query("SELECT wid, status, game, day, month, year, time, opp_tag, opp_name, opp_url, opp_country, style, gametype, first_map, second_map, third_map, our_score, opp_score, report, report_url from " . $prefix . "_wars order by year DESC, month DESC, day DESC limit 0 , 5");
		while ($row = $db->sql_fetchrow($result)) {
			$wid = $row['wid'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$status = $row['status'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_country = $row['opp_country'];
			$opp_url = $row['opp_url'];
			$game = $row['game'];
						if ($j == 0)
                        {
                            $bg = $bgcolor2;
                            $j++;
                        } 
                        else
                        {
                            $bg = $bgcolor1;
                            $j = 0;
                        } 			
			//show game_icon
			
	$result_icon = $db->sql_query("SELECT name, icon_url FROM " . $prefix . "_wars_games WHERE gid = '$game'");
                        list($name, $icon_url) = $db->sql_fetchrow($result_icon);
                        $name = stripslashes($name);
                        $name = htmlentities($name);
			if ($icon_url != "")
                        {
			echo "<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\"><img border=\"0\" src=\"$icon_url\" alt=\"$name\" /></td>";
			}
			else
			{
			echo "<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\"></td>";
			}
			echo "<td bgcolor=\"$bg\" align=center>$day-$month-$year</td>";
			echo"<td bgcolor=\"$bg\" nowrap=\"nowrap\">&nbsp;<img src=\"images/flags/$opp_country.gif\" alt=\"$opp_country\"/>&nbsp;";
			
			if($opp_url !=""){
			echo"<a href=\"http://$opp_url\" target=\"_blank\">$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}	
			echo "$opp_name</a></td>";}
			
			else {
			echo"$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}			
			echo "$opp_name</td>";
			}
			echo"<td bgcolor=\"$bg\" align=center>$status</td>"
			."<td bgcolor=\"$bg\" align=center>$wid</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=WarEdit&amp;wid=$wid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>
</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=WarDelete&amp;wid=$wid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";
		}
				$j=0;

		echo "</td></tr></table>";

		CloseTable();
		
		echo "<br>";
		
		OpenTable();
		echo "<center><font class=\"option\"><b>Games</b></font></center><br>"
		."<center><table width=100% border=0 bgcolor=$bgcolor4 cellspacing=1 cellpadding=3><tr>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Name</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>ID</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Edit</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Remove</b></td></tr>";
		$result = $db->sql_query("SELECT gid, name, icon_url from " . $prefix . "_wars_games order by name");
		while ($row = $db->sql_fetchrow($result)) {
			$gid = $row['gid'];
			$name = $row['name'];
			$icon_url = $row['icon_url'];
						if ($j == 0)
                        {
                            $bg = $bgcolor2;
                            $j++;
                        } 
                        else
                        {
                            $bg = $bgcolor1;
                            $j = 0;
                        } 
			echo "<tr><td bgcolor=\"$bg\" align=center><img src=\"$icon_url\" /></td>"
			."<td bgcolor=\"$bg\" align=center>$name</td>"
			."<td bgcolor=\"$bg\" align=center>$gid</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=GameEdit&amp;gid=$gid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>
</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=GameDelete&amp;gid=$gid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>";
		} $j=0;

		echo "</table></center>";

		CloseTable();
		include("footer.php");
	}

	function WarsAdmin() {
		global $prefix, $db, $bgcolor2, $banners, $admin_file, $ad_admin_menu_main, $bgcolor1, $bgcolor4;
		include ("header.php");
		WarsMenu();
		echo "<a name=\"top\">";
		OpenTable();
		echo "<center><font class=\"option\"><b>Wars</b></font></center><br>"
		."<table width=100% border=0 bgcolor=$bgcolor4 cellspacing=1><tr>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Date</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Opponent</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Status</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>ID</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Edit</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Remove</b></td><tr>";
		$result = $db->sql_query("SELECT wid, status, game, day, month, year, time, opp_tag, opp_name, opp_url, opp_country, style, gametype, first_map, second_map, third_map, our_score, opp_score, report, report_url from " . $prefix . "_wars order by year DESC, month DESC, day DESC");
		while ($row = $db->sql_fetchrow($result)) {
			$wid = $row['wid'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$status = $row['status'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$game = $row['game'];
						if ($j == 0)
                        {
                            $bg = $bgcolor2;
                            $j++;
                        } 
                        else
                        {
                            $bg = $bgcolor1;
                            $j = 0;
                        } 			
			//show game_icon
			
	$result_icon = $db->sql_query("SELECT name, icon_url FROM " . $prefix . "_wars_games WHERE gid = '$game'");
                        list($name, $icon_url) = $db->sql_fetchrow($result_icon);
                        $name = stripslashes($name);
                        $name = htmlentities($name);
			if ($icon_url != "")
                        {
			echo "<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\"><img border=\"0\" src=\"$icon_url\" alt=\"$name\" /></td>";
			}
			else
			{
			echo "<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\"></td>";
			}
			echo "<td bgcolor=\"$bg\" align=center>$day-$month-$year</td>";
			echo"<td bgcolor=\"$bg\" nowrap=\"nowrap\">&nbsp;<img src=\"images/flags/$opp_country.gif\" alt=\"$opp_country\"/>&nbsp;";
			
			if($opp_url !=""){
			echo"<a href=\"http://$opp_url\" target=\"_blank\">$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}	
			echo "$opp_name</a></td>";}
			
			else {
			echo"$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}			
			echo "$opp_name</td>";
			}
			echo "<td bgcolor=\"$bg\" align=center>$status</td>"
			."<td bgcolor=\"$bg\" align=center>$wid</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=WarEdit&amp;wid=$wid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>
</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=WarDelete&amp;wid=$wid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td><tr>";
		}
		$j=0;
		echo "</td></tr></table>";

		CloseTable();
include("footer.php");
	}

function Add_war() {
		global $prefix, $db, $banners, $admin_file, $ad_admin_menu;
		include ("header.php");
		WarsMenu();
		OpenTable();
echo"<center><table><tr><td><font class=\"title\"><center>Add a War</center></font>
<form name=\"form1\" method=\"post\" action=\"".$admin_file.".php?op=WarAdd\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td>Status :</td>
    <td>
       <select name=\"status\">
          <option value=\"Finished Match\">Finished Match</option>
          <option value=\"Next Match\">Next Match</option>
       </select>
    </td>
  </tr>
  <tr>
    <td>Game :</td>
    <td>";
        
        echo "<select name=\"game\">";
		
		$sql3 = $db->sql_query("SELECT gid, name FROM " . $prefix . "_wars_games ORDER BY name");
        while (list($gid, $name) = $db->sql_fetchrow($sql3))
        {
            $name = stripslashes($name);
            $name = htmlentities($name);

            if ($gid == $game)
            {
                $checked4 = 'selected=\"selected\"';
            } 
            else
            {
                $checked4 = "";
            } 
            echo "<option value=\"" . $gid . "\" " . $checked4 . ">" . $name . "</option>\n";
        } 

        echo "</select>";
		
		
		
		
		
		
		
	echo "	
    </td>
  </tr>
  <tr>
    <td>Date (required) :</td>
    <td>
			<input type='text' name='day' value=\"dd\" size='2' maxlength='2' onFocus='value=\"\"'>
			<input type='text' name='month' value=\"mm\" size='2' maxlength='2' onFocus='value=\"\"'>
			<input type='text' name='year' value=\"yyyy\" size='4' maxlength='4' onFocus='value=\"\"'>
</td>
  </tr>
  <tr>
    <td>Time : </td>
    <td><input type='text' name='time' value=\"00:00\" size='5' maxlength='5' onFocus='value=\"\"'></td>
  </tr>
  <tr>
    <td colspan=\"2\"><br><font class=\"title\">Opponent</font></td>
  </tr>
  <tr>
    <td>Tag :</td>
    <td><input type='text' name='opp_tag' value=\"$opp_tag\" size='15' maxlength='60'></td>
  </tr>
  <tr>
    <td>Name :</td>
    <td><input type='text' name='opp_name' value=\"$opp_name\" size='15' maxlength='60'></td>
  </tr>
    <tr>
    <td>Url :</td>
    <td><input type='text' name='opp_url' value=\"$opp_url\" size='27' maxlength='100'></td>
  </tr>
    <tr>
    <td>Country</td>
    <td>
	<select name=\"opp_country\">
	<option value=\"Unknown\">Unknown</option>
	<option value=\"Albania\">Albania</option>
	<option value=\"Argentina\">Argentina</option>
	<option value=\"Australia\">Australia</option>
	<option value=\"Austria\">Austria</option>
    <option value=\"Belgium\">Belgium</option>
	<option value=\"Bosnia\">Bosnia</option>
	<option value=\"Brazil\">Brazil</option>
    <option value=\"Canada\">Canada</option>
	<option value=\"Chile\">Chile</option>
	<option value=\"China\">China</option>
	<option value=\"Croatia\">Croatia</option>
    <option value=\"czech\">czech</option>
    <option value=\"Denmark\">Denmark</option>
	<option value=\"Estonia\">Estonia</option>
    <option value=\"Finland\">Finland</option>
    <option value=\"France\">France</option>
    <option value=\"Germany\">Germany</option>
	<option value=\"Greece\">Greece</option>
    <option value=\"Hungary\">Hungary</option>
	<option value=\"Iceland\">Iceland</option>
	<option value=\"Ireland\">Ireland</option>
	<option value=\"Israel\">Israel</option>
	<option value=\"Italy\">Italy</option>
    <option value=\"Japan\">Japan</option>
	<option value=\"Mexico\">Mexico</option>
	<option value=\"Morocco\">Morocco</option>
    <option value=\"Netherlands\">Netherlands</option>
	<option value=\"New-Zealand\">New-Zealand</option>
    <option value=\"Norway\">Norway</option>
	<option value=\"Poland\">Poland</option>
	<option value=\"Portugal\">Portugal</option>
	<option value=\"Romania\">Romania</option>
	<option value=\"Russia\">Russia</option>
	<option value=\"Singapore\">Singapore</option>
	<option value=\"Slovenia\">Slovenia</option>
	<option value=\"South-Africa\">South-Africa</option>
	<option value=\"Spain\">Spain</option>
	<option value=\"Sweden\">Sweden</option>
	<option value=\"Switzerland\">Switzerland</option>
	<option value=\"Tunisia\">Tunisia</option>
	<option value=\"United-Kingdom\">United-Kingdom</option>
    <option value=\"United-States\">United-States</option>
	<option value=\"Venezuela\">Venezuela</option>
	<option value=\"Yugoslavia\">Yugoslavia</option>
  </select>
	</td>
  </tr>
   <tr>
    <td colspan=\"2\"><br><font class=\"title\">Match</font></td>
  </tr>
  <tr> 
    <td>Style :</td>
    <td><input type='text' name='style' value=\"$style\" size='15' maxlength='60'></td>
  </tr>
    <tr> 
    <td>Gametype :</td>
    <td><input type='text' name='gametype' value=\"$gametype\" size='15' maxlength='60'></td>
  </tr>
  <tr>
    <td>First map :</td>
    <td><input type='text' name='first_map' value=\"$first_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Second map :</td>
    <td><input type='text' name='second_map' value=\"$second_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Third map :</td>
    <td><input type='text' name='third_map' value=\"$third_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Our Score :</td>
    <td><input type='text' name='our_score' value=\"$our_score\" size='2' maxlength='3' /></td>
  </tr>
  <tr>
    <td>Opponent Score :</td>
    <td><input type='text' name='opp_score' value=\"$opp_score\" size='2' maxlength='3' /></td>
  </tr>
   <tr>
    <td colspan=\"2\"><br><font class=\"title\">Report</font></td>
  </tr>
  <tr>
    <td colspan=\"2\">
      <textarea name=\"report\" cols=\"50\" rows=\"6\">$report</textarea></td>
  </tr>
  <tr>
    <td>Url of Official Report :</td>
    <td><input type='text' name='report_url' value=\"$report_url\" size='27' maxlength='100' /></td>
  </tr>
</table>
<input type=\"hidden\" name=\"op\" value=\"WarAdd\">
<input type=\"submit\" value=\"Add War\">
      </form></td></tr></table></center>";
		CloseTable();
		include("footer.php");
	}
	
function WarAdd($wid, $status, $game, $day, $month, $year, $time, $opp_tag, $opp_name, $opp_url, $opp_country, $style, $gametype, $first_map, $second_map, $third_map, $our_score, $opp_score, $report, $report_url) {
		global $prefix, $db, $admin_file, $ad_admin_menu;
		$wid = intval($wid);
		$day = intval($day);
		$month = intval($month);
		$year = intval($year);
		$our_score = intval($our_score);
		$opp_score = intval($opp_score);
		$opp_url = str_replace('http://', '', $opp_url);
		$db->sql_query("insert into " . $prefix . "_wars values (NULL, '$status', '$game', '$day', '$month', '$year', '$time', '$opp_tag', '$opp_name', '$opp_url', '$opp_country', '$style', '$gametype', '$first_map', '$second_map', '$third_map', '$our_score', '$opp_score', '$report', '$report_url')");
		include("header.php");
		WarsMenu();
		OpenTable();
		echo "<br /><br /><div style=\"text-align: center;\">War succesfully added<br><br><a href=\"".$admin_file.".php?op=WarsAdmin\" target=\"_top\">Go back to the Wars Admininstation</a></div><br /><br />";
    		CloseTable();
			include("footer.php");	}

	function WarDelete($wid, $ok=0) {
		global $prefix, $db, $admin_file, $bgcolor1, $bgcolor2, $bgcolor4;
		$wid = $wid;
		if ($ok == 1) {
		
		$result = $db->sql_query("SELECT screen_url from " . $prefix . "_wars_screenshots where wid='$wid'");
		while ($row = $db->sql_fetchrow($result)) {
		$screen_url = $row['screen_url'];

$tmpfile = "/$screen_url"; 
unlink($tmpfile);
$db->sql_query("delete from " . $prefix . "_wars_screenshots where screen_url='$screen_url'");
}
$db->sql_query("delete from " . $prefix . "_wars where wid='$wid'");
			
			Header("Location: ".$admin_file.".php?op=WarsAdmin");
		} else {
			include("header.php");

			$row = $db->sql_fetchrow($db->sql_query("SELECT wid, day, month, year, opp_tag, opp_name, opp_url, opp_country, our_score, opp_score from " . $prefix . "_wars where wid='$wid'"));
			$wid = $row['wid'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
			WarsMenu();
			OpenTable();
			echo "<center><font class=\"title\"><b>Delete War</b></font><br><br>";
			echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" bgcolor=\"$bgcolor4\"><tr>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>ID<b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Date<b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Opponent<b></td>"
				."<td bgcolor=\"$bgcolor2\" align=\"center\"><b>Result<b></td></tr>";

			echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\">$wid</td>"
			."<td bgcolor=\"$bgcolor1\" align=\"center\">$day/$month/$year</td>"
			."<td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">&nbsp;<img src=\"images/flags/$opp_country.gif\" alt=\"$opp_country\"/>&nbsp;";
			
			if($opp_url !=""){
			echo"<a href=\"http://$opp_url\" target=\"_blank\">$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}	
			echo "$opp_name</a></td>";}
			
			else {
			echo"$opp_tag";
			if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}			
			echo "$opp_name</td>";
			}
			if ($our_score > $opp_score) {
			echo "<td bgcolor=\"#009900\" align=center nowrap=\"nowrap\">";}
			else if ($our_score < $opp_score) {
			echo "<td bgcolor=\"#990000\" align=center nowrap=\"nowrap\">";}
			else {
			echo "<td bgcolor=\"#3333FF\" align=center nowrap=\"nowrap\">";}
			echo "<b>$our_score/$opp_score</b></td>";
		
		echo "</tr></table><br>"
			."Are you sure you want to delete this war?<br><br>"
			."[ <a href=\"".$admin_file.".php?op=WarsAdmin\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=WarDelete&amp;wid=$wid&amp;ok=1\">" . _YES . "</a> ]</center><br>";
		CloseTable();
		include("footer.php");
	}}

	function WarEdit($wid) {
		global $prefix, $db, $admin_file, $ad_admin_menu;
		define('NO_EDITOR', true);
		include("header.php");
		WarsMenu();
		$bid = intval($bid);
		$row = $db->sql_fetchrow($db->sql_query("SELECT wid, status, game, day, month, year, time, opp_tag, opp_name, opp_url, opp_country, style, gametype, first_map, second_map, third_map, our_score, opp_score, report, report_url from " . $prefix . "_wars where wid='$wid'"));
			$wid = $row['wid'];
			$status = $row['status'];
			$game = $row['game'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$time = $row['time'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$style = $row['style'];
			$gametype = $row['gametype'];
			$first_map = $row['first_map'];
			$second_map = $row['second_map'];
			$third_map = $row['third_map'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
			$report = $row['report'];
			$report_url = $row['report_url'];
OpenTable();
echo"<center><table><tr><td><font class=\"title\"><center>Edit War</center></font>
<form name=\"form1\" method=\"post\" action=\"".$admin_file.".php?op=WarAdd\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
    <tr>
    <td colspan=\"2\"><font class=\"title\">Screenshots</font></td>
  </tr>    
  <tr>
    <td colspan=\"2\"><a href=\"".$admin_file.".php?op=Wars_add_screenshot&amp;wid=$wid\">Add/Delete Screenshots</a></td>
  </tr>
  <tr>
    <td colspan=\"2\"><br><font class=\"title\">General</font></td>
  </tr> 
  <tr>
    <td>Status :</td>
    <td>
       <select name=\"status\">
          <option value=\"$status\">$status</option>
          <option value=\"Finished Match\">Finished Match</option>
          <option value=\"Next Match\">Next Match</option>
       </select>
    </td>
  </tr>
  <tr>
    <td>Game :</td>
    <td><select name=\"game\">";
		$sql3 = $db->sql_query("SELECT gid, name FROM " . $prefix . "_wars_games ORDER BY name");
        while (list($gid, $name) = $db->sql_fetchrow($sql3))
        {
            $name = stripslashes($name);
            $name = htmlentities($name);

            if ($gid == $game)
            {
                $checked4 = 'selected=\"selected\"';
            } 
            else
            {
                $checked4 = "";
            } 
			
            echo "<option value=\"" . $gid . "\" " . $checked4 . ">" . $name . "</option>\n";
        } 

        echo "</select>
    </td>
  </tr>
  <tr>
    <td>Date :</td>
    <td>Day: 
      <input type='text' name='day' value=\"$day\" size='2' maxlength='2'>
 Month: 
 <input type='text' name='month' value=\"$month\" size='2' maxlength='2'>
 Year: 
 <input type='text' name='year' value=\"$year\" size='4' maxlength='4'>
</td>
  </tr>
  <tr>
    <td>Time : </td>
    <td><input type='text' name='time' value=\"$time\" size='5' maxlength='5'></td>
  </tr>
  <tr>
    <td colspan=\"2\"><br><font class=\"title\">Opponent</font></td>
  </tr>
  <tr>
    <td>Tag :</td>
    <td><input type='text' name='opp_tag' value=\"$opp_tag\" size='15' maxlength='60'></td>
  </tr>
  <tr>
    <td>Name :</td>
    <td><input type='text' name='opp_name' value=\"$opp_name\" size='15' maxlength='60'></td>
  </tr>
    <tr>
    <td>Url :</td>
    <td><input type='text' name='opp_url' value=\"$opp_url\" size='27' maxlength='100'></td>
  </tr>
    <tr>
    <td>Country</td>
    <td>	
	<select name=\"opp_country\">
    <option value=\"$opp_country\">$opp_country</option>
	<option value=\"Unknown\">Unknown</option>
	<option value=\"Albania\">Albania</option>
	<option value=\"Argentina\">Argentina</option>
	<option value=\"Australia\">Australia</option>
	<option value=\"Austria\">Austria</option>
    <option value=\"Belgium\">Belgium</option>
	<option value=\"Bosnia\">Bosnia</option>
	<option value=\"Brazil\">Brazil</option>
    <option value=\"Canada\">Canada</option>
	<option value=\"Chile\">Chile</option>
	<option value=\"China\">China</option>
	<option value=\"Croatia\">Croatia</option>
    <option value=\"czech\">czech</option>
    <option value=\"Denmark\">Denmark</option>
	<option value=\"Estonia\">Estonia</option>
    <option value=\"Finland\">Finland</option>
    <option value=\"France\">France</option>
    <option value=\"Germany\">Germany</option>
	<option value=\"Greece\">Greece</option>
    <option value=\"Hungary\">Hungary</option>
	<option value=\"Iceland\">Iceland</option>
	<option value=\"Ireland\">Ireland</option>
	<option value=\"Israel\">Israel</option>
	<option value=\"Italy\">Italy</option>
    <option value=\"Japan\">Japan</option>
	<option value=\"Mexico\">Mexico</option>
	<option value=\"Morocco\">Morocco</option>
    <option value=\"Netherlands\">Netherlands</option>
	<option value=\"New-Zealand\">New-Zealand</option>
    <option value=\"Norway\">Norway</option>
	<option value=\"Poland\">Poland</option>
	<option value=\"Portugal\">Portugal</option>
	<option value=\"Romania\">Romania</option>
	<option value=\"Russia\">Russia</option>
	<option value=\"Singapore\">Singapore</option>
	<option value=\"Slovenia\">Slovenia</option>
	<option value=\"South-Africa\">South-Africa</option>
	<option value=\"Spain\">Spain</option>
	<option value=\"Sweden\">Sweden</option>
	<option value=\"Switzerland\">Switzerland</option>
	<option value=\"Tunisia\">Tunisia</option>
	<option value=\"United-Kingdom\">United-Kingdom</option>
    <option value=\"United-States\">United-States</option>
	<option value=\"Venezuela\">Venezuela</option>
	<option value=\"Yugoslavia\">Yugoslavia</option>
  </select>
  </td>
  </tr>
   <tr>
    <td colspan=\"2\"><br><font class=\"title\">Match</font></td>
  </tr>
  <tr> 
    <td>Style :</td>
    <td><input type='text' name='style' value=\"$style\" size='15' maxlength='60'></td>
  </tr>
    <tr> 
    <td>Gametype :</td>
    <td><input type='text' name='gametype' value=\"$gametype\" size='15' maxlength='60'></td>
  </tr>
  <tr>
    <td>First map :</td>
    <td><input type='text' name='first_map' value=\"$first_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Second map :</td>
    <td><input type='text' name='second_map' value=\"$second_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Third map :</td>
    <td><input type='text' name='third_map' value=\"$third_map\" size='15' maxlength='60' /></td>
  </tr>
  <tr>
    <td>Our Score :</td>
    <td><input type='text' name='our_score' value=\"$our_score\" size='2' maxlength='3' /></td>
  </tr>
  <tr>
    <td>Opponent Score :</td>
    <td><input type='text' name='opp_score' value=\"$opp_score\" size='2' maxlength='3' /></td>
  </tr>
  <tr>
    <td colspan=\"2\"><br><font class=\"title\">Report</font></td>
  </tr>
  <tr>
    <td colspan=\"2\">
      <textarea name=\"report\" cols=\"50\" rows=\"6\">$report</textarea></td>
  </tr>
  <tr>
    <td>Url of Official Report :</td>
    <td><input type='text' name='report_url' value=\"$report_url\" size='27' maxlength='100' /></td>
  </tr>
</table>
			<input type=\"hidden\" name=\"wid\" value=\"$wid\">
			<input type=\"hidden\" name=\"op\" value=\"WarChange\">
			<input type=\"submit\" value=\"" . _SAVECHANGES . "\">
      </form></td></tr></table></center>";
	
	

		CloseTable();
		include("footer.php");
	}

	function WarChange($wid, $status, $game, $day, $month, $year, $time, $opp_tag, $opp_name, $opp_url, $opp_country, $style, $gametype, $first_map, $second_map, $third_map, $our_score, $opp_score, $report, $report_url) {
		global $prefix, $db, $admin_file;
		$opp_url = str_replace('http://', '', $opp_url);
		$db->sql_query("update " . $prefix . "_wars set status='$status', game='$game', day='$day', month='$month', year='$year', time='$time', opp_tag='$opp_tag', opp_name='$opp_name', opp_url='$opp_url', opp_country='$opp_country', style='$style', gametype='$gametype', first_map='$first_map', second_map='$second_map', third_map='$third_map', our_score='$our_score', opp_score='$opp_score', report='$report', report_url='$report_url' where wid='$wid'");
		Header("Location: ".$admin_file.".php?op=WarsAdmin");
	}

function Add_game() {
		global $prefix, $db, $admin_file;
		include ("header.php");
		WarsMenu();
		OpenTable();
echo"<center><table><tr><td><font class=\"title\"><center>Add Game</center></font>
<form name=\"form1\" method=\"post\" action=\"".$admin_file.".php?op=GameAdd\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <td>Name :</td>
    <td>
        <input type='text' name='name' size='15' maxlength='60'>
    </td>
  </tr>
  <tr>
    <td>Icon Url :</td>
    <td><input type='text' name='icon_url' size='27' maxlength='255'></td>
  </tr>
   </table>
<input type=\"hidden\" name=\"op\" value=\"GameAdd\">
<input type=\"submit\" value=\"Add Game\">
      </form></td></tr></table></center>";
echo "<center>All fields are required</center>";
		CloseTable();
		include("footer.php");
	}
   
   	function GamesAdmin() {
		global $prefix, $db, $bgcolor2, $admin_file, $bgcolor1, $bgcolor4;
		include ("header.php");
		WarsMenu();
		echo "<a name=\"top\">";
		OpenTable();
		echo "<center><font class=\"option\"><b>Games</b></font></center><br>"
		."<center><table border=0 bgcolor=$bgcolor4 cellspacing=1 cellpadding=3 width=100%><tr>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Name</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>ID</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Edit</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\"><b>Remove</b></td></tr>";
		$result = $db->sql_query("SELECT gid, name, icon_url from " . $prefix . "_wars_games order by gid");
		while ($row = $db->sql_fetchrow($result)) {
			$gid = $row['gid'];
			$name = $row['name'];
			$icon_url = $row['icon_url'];
						if ($j == 0)
                        {
                            $bg = $bgcolor2;
                            $j++;
                        } 
                        else
                        {
                            $bg = $bgcolor1;
                            $j = 0;
                        } 
			echo "<tr><td bgcolor=\"$bg\" align=center><img src=\"$icon_url\" /></td>"
			."<td bgcolor=\"$bg\" align=center>$name</td>"
			."<td bgcolor=\"$bg\" align=center>$gid</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=GameEdit&amp;gid=$gid\"><img src=\"images/edit.gif\" alt=\""._EDIT."\" title=\""._EDIT."\" border=\"0\" width=\"17\" height=\"17\"></a>
</td>"
			."<td bgcolor=\"$bg\" align=center><a href=\"".$admin_file.".php?op=GameDelete&amp;gid=$gid&amp;ok=0\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a>&nbsp;</td></tr>";
		}
		$j=0;
		echo "</table></center>";

		CloseTable();
include("footer.php");
	}
	
function GameAdd($game, $name, $icon_url)
    {
        global $prefix, $db, $admin_file;

        $name = addslashes($name);
		$game = intval($game);

        $db->sql_query("insert into " . $prefix . "_wars_games values (NULL, '$name', '$icon_url')");
		include("header.php");
		WarsMenu();
		OpenTable();
		echo "<br /><br /><div style=\"text-align: center;\">Game succesfully added<br><br><a href=\"".$admin_file.".php?op=WarsAdmin\" target=\"_top\">Go back to the Wars Admininstation</a></div><br /><br />";
    		CloseTable();
			include("footer.php");
} 

	function GameDelete($gid, $ok=0) {
		global $prefix, $db, $admin_file, $bgcolor1, $bgcolor2;
		$gid = $gid;
		if ($ok == 1) {
			$db->sql_query("delete from " . $prefix . "_wars_games where gid='$gid'");
			Header("Location: ".$admin_file.".php?op=GamesAdmin");
		} else {
			include("header.php");
			$row = $db->sql_fetchrow($db->sql_query("SELECT gid, name, icon_url from " . $prefix . "_wars_games where gid='$gid'"));
			$gid = $row['gid'];
			$name = $row['name'];
			$icon_url = $row['icon_url'];
			WarsMenu();
			OpenTable();
			echo "<center><font class=\"title\"><b>Delete Game</b></font><br><br>";
			echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"$bgcolor4\">";
			echo "<tr><td bgcolor=\"$bgcolor1\" align=\"center\"><img src=\"$icon_url\" /></td>";
			echo "<td bgcolor=\"$bgcolor1\" align=\"center\">$name</td>";
		
		echo "</table><br>"
			."Are you sure you want to delete this game?<br><br>"
			."[ <a href=\"".$admin_file.".php?op=GamesAdmin\">" . _NO . "</a> | <a href=\"".$admin_file.".php?op=GameDelete&amp;gid=$gid&amp;ok=1\">" . _YES . "</a> ]</center><br>";
		CloseTable();
		include("footer.php");
	}}	
	
	function GameEdit($gid) {
		global $prefix, $db, $admin_file;
		define('NO_EDITOR', true);
		include("header.php");
		WarsMenu();
		$row = $db->sql_fetchrow($db->sql_query("SELECT gid, name, icon_url from " . $prefix . "_wars_games where gid='$gid'"));
			$gid = $row['gid'];
			$name = $row['name'];
			$icon_url = $row['icon_url'];

	OpenTable();
	echo"<center><table><tr><td><font class=\"title\"><center>Edit War</center></font>
<form name=\"form1\" method=\"post\" action=\"".$admin_file.".php?op=GameChange\">
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
      <td>Name :</td>
    <td>
        <input type='text' name='name' size='15' value=\"$name\" maxlength='60'>
    </td>
  </tr>
  <tr>
    <td>Icon Url :</td>
    <td><input type='text' name='icon_url' size='27' value=\"$icon_url\" maxlength='255'></td>
  </tr>
   </table>
		<input type=\"hidden\" name=\"gid\" value=\"$gid\">
		<input type=\"hidden\" name=\"op\" value=\"GameChange\">
		<input type=\"submit\" value=\"" . _SAVECHANGES . "\">
      </form></td></tr></table></center>";
	CloseTable();
		include("footer.php");
	}

	function GameChange($gid, $name, $icon_url) {
		global $prefix, $db, $admin_file;

		$db->sql_query("update " . $prefix . "_wars_games set name='$name', icon_url='$icon_url' where gid='$gid'");
		Header("Location: ".$admin_file.".php?op=GamesAdmin");
	}
	
	function Wars_add_screenshot($wid) {
	global $db, $prefix, $bgcolor1, $bgcolor2, $bgcolor4, $admin_file;
include("header.php");
OpenTable();
echo "[&nbsp;<a href=\"".$admin_file.".php?op=WarEdit&amp;wid=$wid\"><b>Go back</b></a>&nbsp;]<br><br>";
	//Check if theres a file selected
if(isset($_FILES['bestand'])) { 
    //if  the file is bigger then 51200 bytes(500kb) , it wont be accepted 
    if($_FILES['bestand']['size'] > 512000) { 
        echo "The filesize is <b>" . $_FILES['bestand']['size'] . "</b>, maximum allowed filesize is <b>500 kB</b>"; 
    } else { 
            //check is there a new name given 
            if(empty($_POST['naam'])) { 
                $filename = $_FILES['bestand']['name']; 
				$naam = "$wid$filename";
            } else { 
                //select extension 
                $x = strrchr($_FILES['bestand']['name'], "."); 
                $filename = $_POST['naam'];
				$naam = "$wid$filename$x"; 
            } 
            //upload the file 
            move_uploaded_file($_FILES['bestand']['tmp_name'], "modules/Wars/Screenshots/" . $naam); 
			//add file to database
			$url = "modules/Wars/Screenshots/" . $naam;
			$db->sql_query("insert into " . $prefix . "_wars_screenshots values (NULL, '$naam', '$url', '$wid')");
            //chmod the file so everyine can see it 
            chmod("modules/Wars/Screenshots/" . $naam, 0777); 
           } 
} else { 
    echo ""; 
} 



echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\"> 
<b>File:</b> <input type=\"file\" name=\"bestand\"><br> 
<b>New File Name:</b> <input type=\"text\" name=\"naam\"><br>
<b>NOTE:</b> Make sure the filename is unique for each war<br> 
<input type=\"submit\" name=\"submit\" value=\"Upload\"> 
</form>";
echo "<table border=0 bgcolor=$bgcolor4 cellspacing=1 cellpadding=3 width=100%><tr>
				  <td bgcolor=$bgcolor4><b>ID</b></td>
				  <td bgcolor=$bgcolor4><b>Name</b></td>
				  <td bgcolor=$bgcolor4><b>Location</b></td>
				  <td bgcolor=$bgcolor4><b>Delete</b></td>
				</tr>";
$result = $db->sql_query("SELECT screen_name, screen_url, screen_id from " . $prefix . "_wars_screenshots where wid='$wid'");
		while ($row = $db->sql_fetchrow($result)) {
$screen_name = $row['screen_name'];
$screen_url = $row['screen_url'];
$screen_id = $row['screen_id'];
						if ($j == 0)
                        {
                            $bg = $bgcolor2;
                            $j++;
                        } 
                        else
                        {
                            $bg = $bgcolor1;
                            $j = 0;
                        }
echo "<tr bgcolor=$bg><td>$screen_id</td><td>$screen_name</td><td>$screen_url</td><td><a href=\"admin.php?op=DelScreen&amp;wid=$wid&amp;screen_id=$screen_id\"><img src=\"images/delete.gif\" alt=\""._DELETE."\" title=\""._DELETE."\" border=\"0\" width=\"17\" height=\"17\"></a></td></tr>";
$j=0;}

echo "</table><br><br>[&nbsp;<a href=\"".$admin_file.".php?op=WarEdit&amp;wid=$wid\"><b>Go back</b></a>&nbsp;]";

CloseTable();
include("footer.php");

}

function DelScreen($screen_id) 
{ 
global $db, $prefix, $admin_file;
$result = $db->sql_query("SELECT screen_name, screen_url, screen_id, wid from " . $prefix . "_wars_screenshots where screen_id='$screen_id'");
		while ($row = $db->sql_fetchrow($result)) {
$screen_name = $row['screen_name'];
$screen_url = $row['screen_url'];
$screen_id = $row['screen_id'];
$wid = $row['wid'];}

$tmpfile = "/$screen_url"; 
unlink($tmpfile);
$db->sql_query("delete from " . $prefix . "_wars_screenshots where screen_url='$screen_url'");
Header("Location: ".$admin_file.".php?op=Wars_add_screenshot&wid=$wid");
} 

	
	
if (!isset($save)) { $save = ""; }
if (!isset($terms_body)) { $terms_body = ""; }
if (!isset($country)) { $country = ""; }
if (!isset($ok)) { $ok = ""; }
if (!isset($active)) { $active = ""; }
if (!isset($new_pos)) { $new_pos = ""; }

	switch($op) {

		case "WarsMain":
		WarsMain();
		break;

		case "WarsAdmin":
		WarsAdmin();
		break;

		case "WarAdd":
		WarAdd($wid, $status, $game, $day, $month, $year, $time, $opp_tag, $opp_name, $opp_url, $opp_country, $style, $gametype, $first_map, $second_map, $third_map, $our_score, $opp_score, $report, $report_url);
		break;
		
		case "Add_war":
		Add_war();
		break;

		case "WarDelete":
		WarDelete($wid, $ok);
		break;

		case "WarEdit":
		WarEdit($wid);
		break;

		case "WarChange":
		WarChange($wid, $status, $game, $day, $month, $year, $time, $opp_tag, $opp_name, $opp_url, $opp_country, $style, $gametype, $first_map, $second_map, $third_map, $our_score, $opp_score, $report, $report_url);
		break;

		case "GamesAdmin":
		GamesAdmin();
		break;
		
		case "Add_game":
		Add_game();
		break;
		
		case "GameAdd":
		GameAdd($gid, $name, $icon_url);
		break;
		
		case "GameDelete":
		GameDelete($gid, $ok);
		break;	
			
		case "GameEdit":
		GameEdit($gid);
		break;

		case "GameChange":
		GameChange($gid, $name, $icon_url);
		break;

		case "WarsCredits":
		WarsCredits();
		break;
		
		case "Wars_add_screenshot":
		Wars_add_screenshot($wid);
		break;

		case "DelScreen":
		DelScreen($screen_id, $wid);
		break;
	}

} else {
	echo "Access Denied";
}

?>