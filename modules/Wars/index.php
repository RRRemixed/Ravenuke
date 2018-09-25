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


if (!defined('MODULE_FILE')) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));

function WarsIndex($orderby) {
    global $prefix, $db, $sitename, $bgcolor1, $bgcolor2, $bgcolor4;
    include("header.php");
OpenTable();
//calculate wins, loses, draws...
$result = $db->sql_query("SELECT wid FROM " . $prefix . "_wars ");
        $nrwars = $db->sql_numrows($result);

            $result_win = $db->sql_query("SELECT wid FROM " . $prefix . "_wars WHERE our_score > opp_score");
            $win = $db->sql_numrows($result_win);

            $result_lose = $db->sql_query("SELECT wid FROM " . $prefix . "_wars WHERE opp_score > our_score");
            $lose = $db->sql_numrows($result_lose);

            $draw = $nrwars - ($win + $lose);
			

		echo "<br><center><font class=\"option\"><b>Wars</b></font><br><br></center>";
		echo "<div align=\"center\">Order by&nbsp;:&nbsp;<a href=\"modules.php?name=Wars\">Date</a>&nbsp;|&nbsp;<a href=\"modules.php?name=Wars&amp;orderby=game,\">Game</a>&nbsp;|&nbsp;<a href=\"modules.php?name=Wars&amp;orderby=opp_name, opp_tag,\">Opponent</a>&nbsp;|&nbsp;<a href=\"modules.php?name=Wars&amp;orderby=style,\">Style</a>&nbsp;|&nbsp;<a href=\"modules.php?name=Wars&amp;orderby=gametype,\">Gametype</a></div><br>";
		echo"<center><table width=100% border=0 cellpadding=3 bgcolor=$bgcolor4 cellspacing=1><tr>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Date</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Opponent</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Style</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Gametype</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Results</b></td>"
		."<td bgcolor=\"$bgcolor4\" align=\"center\" nowrap=\"nowrap\"><b>Report</b></td><tr>";
		$result = $db->sql_query("SELECT wid, status, game, day, month, year, opp_tag, opp_name, opp_url, opp_country, style, gametype, our_score, opp_score from " . $prefix . "_wars order by $orderby year DESC, month DESC, day DESC");
		while ($row = $db->sql_fetchrow($result)) {
			$wid = $row['wid'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$style = $row['style'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$game = $row['game'];
			$gametype = $row['gametype'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
 						
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
			
			echo"<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\">$day/$month/$year</td>"
			."<td bgcolor=\"$bg\" nowrap=\"nowrap\">&nbsp;<img src=\"images/flags/$opp_country.gif\" alt=\"$opp_country\"/>&nbsp;";
			
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
			
			echo"<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\">$style</td>"
			."<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\">$gametype</td>";
			
			 if ($our_score > $opp_score) {
			echo "<td bgcolor=\"#009900\" align=center nowrap=\"nowrap\">";}
			else if ($our_score < $opp_score) {
			echo "<td bgcolor=\"#990000\" align=center nowrap=\"nowrap\">";}
			else {
			echo "<td bgcolor=\"#3333FF\" align=center nowrap=\"nowrap\">";}
			echo "<b>$our_score/$opp_score</b></td>";
			
			echo"<td bgcolor=\"$bg\" align=center nowrap=\"nowrap\"><a href=\modules.php?name=Wars&op=view_war&wid=$wid><img src=\"modules/Wars/images/report.gif\" alt=\"Report\"/></a></td><tr>";
		}
		$j=0;
		echo "</td></tr></table>";
		
		echo "<br><b>$nrwars</b> Wars : 
<b><font color=\"#009900\">$win</font></b> Won 
- <b><font color=\"#990000\">$lose</font></b> Lost 
- <b><font color=\"#3333FF\">$draw</font></b> Draw";
		echo "</center>";
		CloseTable();
    include("footer.php");
}



function view_war($wid) {
global $prefix, $db, $bgcolor4, $bgcolor1, $bgcolor2, $admin_file;
			include("header.php");
		OpenTable();
		$result = $db->sql_query("SELECT wid, status, game, day, month, year, time, opp_tag, opp_name, opp_url, opp_country, style, gametype, first_map, second_map, third_map, our_score, opp_score, report, report_url from " . $prefix . "_wars where wid='$wid'");
		while ($row = $db->sql_fetchrow($result)) {
			$wid = $row['wid'];
			$day = $row['day'];
			$month = $row['month'];
			$year = $row['year'];
			$style = $row['style'];
			$opp_tag = $row['opp_tag'];
			$opp_name = $row['opp_name'];
			$opp_url = $row['opp_url'];
			$opp_country = $row['opp_country'];
			$game = $row['game'];
			$gametype = $row['gametype'];
			$our_score = $row['our_score'];
			$opp_score = $row['opp_score'];
			$status = $row['status'];
			$time = $row['time'];
			$first_map = $row['first_map'];
			$second_map = $row['second_map'];
			$third_map = $row['third_map'];
			$report = $row['report'];
			$report_url = $row['report_url'];
			}
	echo "<center>
<table border=\"0\" cellspacing=\"3\" cellpadding=\"0\" width=\"310\">
	<tr>
		<td valign=\"top\">
	
	<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
	  <tr>
        <td bgcolor=\"$bgcolor4\" colspan=\"2\"><div align=\"center\"><b>Opponent</b></div></td>
      </tr>
	  <tr>
        <td bgcolor=\"$bgcolor2\">Name</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$opp_tag";
		if($opp_tag !="" ){
			if($opp_name !=""){
			echo"&nbsp;-&nbsp;";}
			}	
		echo "$opp_name</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\">Country</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\"><img src=\"images/flags/$opp_country.gif\" />&nbsp;$opp_country</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\">Url</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\"><a href=\"http://$opp_url\" target=\"_blank\">$opp_url</a></td>
      </tr>
    </table>
	
	
		</td><td valign=\"top\">
	
	
	<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
      <tr>
        <td bgcolor=\"$bgcolor4\" colspan=\"2\"><div align=\"center\"><b>Other</b></div></td>
      </tr>
	  <tr>
        <td bgcolor=\"$bgcolor2\">Status</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$status</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\">Date</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$day/$month/$year";
		 if($time !=""){echo "&nbsp;$time";}
	echo "</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\">Result</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\"><font color=\"#009900\"><b>$our_score</b></font> - <font color=\"#990000\"><b>$opp_score</b></font></td>
      </tr>
    </table>

</td></tr><tr><td colspan=\"2\">


<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">
      <tr>
        <td bgcolor=\"$bgcolor4\" colspan=\"4\"><div align=\"center\"><b>Match</b></div></td>
      </tr>
	  <tr>
        <td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">Game</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">";
	$result_icon = $db->sql_query("SELECT name, icon_url FROM " . $prefix . "_wars_games WHERE gid = '$game'");
                        list($name, $icon_url) = $db->sql_fetchrow($result_icon);
                        $name = stripslashes($name);
                        $name = htmlentities($name);
		echo "<img src=\"$icon_url\">&nbsp;$name</td>
		<td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">First Map </td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$first_map</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">Style</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$style</td>
		<td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">Second Map </td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$second_map</td>
      </tr>
      <tr>
        <td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">Gametype</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$gametype</td>
		<td bgcolor=\"$bgcolor2\" nowrap=\"nowrap\">Third Map</td>
        <td bgcolor=\"$bgcolor1\" nowrap=\"nowrap\">$third_map</td>
      </tr>
    </table>
</td></tr>";

$result = $db->sql_query("SELECT screen_id FROM " . $prefix . "_wars_screenshots where wid='$wid'");
        $screens = $db->sql_numrows($result);
if($screens > 0) {
echo "<tr><td colspan=\"2\">
<center>
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" width=\"310\" >
<tr><td bgcolor=\"$bgcolor4\"><div align=\"center\"><b>Screenshots</b></div></td></tr>
<tr><td bgcolor=\"$bgcolor1\" align=\"center\">";

$result = $db->sql_query("SELECT screen_name, screen_url, screen_id from " . $prefix . "_wars_screenshots where wid='$wid'");
		while ($row = $db->sql_fetchrow($result)) {
$screen_url = $row['screen_url'];

echo "<a href=\"#\" onclick=\"javascript:window.open('$screen_url','screen_url','toolbar=0,location=0,directories=0,status=0,scrollbars=1,resizable=1,copyhistory=0,menuBar=0,width=800,height=600,top=30,left=0');return(false)\">
<img src=\"$screen_url\" width=\"150\" height=\"120\" /></a>";}

echo"</td></tr></table>
</center>
</td></tr>";}
echo "</table>";
if (is_admin($admin)) {
echo "<br>[&nbsp;Admin: <a href=\"".$admin_file.".php?op=WarEdit&amp;wid=$wid\">Edit</a>&nbsp;|&nbsp;<a href=\"".$admin_file.".php?op=WarDelete&amp;wid=$wid&amp;ok=0\">Delete</a>&nbsp]";}

		CloseTable();
			include("footer.php");
		}
		
switch ($op) {

    default:
    WarsIndex($orderby);
    break;

	case "view_war":
	view_war($wid);
	break;

}

?>