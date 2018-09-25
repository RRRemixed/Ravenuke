<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
//(C) Jonathan Pilborough 2005 Part of superiplog

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

	/*********************************************************/
	/* Admin functions                                       */
	/*********************************************************/

	function superipmenu() {
		global $bgcolor2, $prefix, $db, $admin_file;
		include ("header.php");
		GraphicAdmin();
		OpenTable();
		echo "<center><font class=\"title\"><b>Super IP Log Administration menu</b></font></center>";
		CloseTable();
		OpenTable();
		echo '<p align="center">';
		echo '<a href="'.$admin_file.'.php?op=accesslog">Access log</a> | ';
		echo '<a href="'.$admin_file.'.php?op=requestsperip">Requests per IP</a> | ';
		echo '<a href="'.$admin_file.'.php?op=requestsperpage">Requests per page</a> | ';
		echo '<a href="'.$admin_file.'.php?op=clearlog">Clear log</a>';
		echo '</p>';
		CloseTable();
		
	}
	
	function accesslog() {
		global $prefix, $db, $admin_file;
		OpenTable();
		$result = $db->sql_query("SELECT count(id)as rowcount FROM ".$prefix."_superiplog");
		$row = $db->sql_fetchrow($result);
		$numrows = $row['rowcount'];
		if($numrows > 100) $start = $numrows - 100; 
		else {
		$start = 0;}
		$end = $numrows;
		if($_GET['start']) $start = $_GET['start'];
		if($_GET['end']) $end = $_GET['end'];
		echo "<form name=\"form1\"><input type=\"hidden\" name=\"op\" value=\"accesslog\"><p>Start <input type=\"text\" name=\"start\" size=\"3\" value=\"$start\"> $prefix &nbsp;End <input type=\"text\" name=\"end\" size=\"3\" value=\"$end\"> Max: $numrows <input type=\"submit\" value=\"Show\" action=\"".$admin_file.".php?op=accesslog\"></p></form>";
		echo "<table border=\"1\" align=\"center\"><tr><th>IP</th><th>Time</th><th>Page Title</th><th>User Agent</th>";
		$range = $end - $start;
		$result = $db->sql_query("SELECT ip, accesstime, pagetitle, useragent FROM ".$prefix."_superiplog ORDER BY accesstime LIMIT $start,$range");
		while($row = $db->sql_fetchrow($result))
		{
			echo "<tr><td>".$row['ip']."</td><td>".$row['accesstime']."</td><td>".$row['pagetitle']."</td><td>".$row['useragent']."</td></tr>";
		}
		echo "</table>";
		CloseTable();
	}

	function perip() {
		global $prefix, $db;
		echo "<table border=\"1\" align=\"center\"><th>IP</th><th>Hits</th>";
		$result = $db->sql_query("SELECT DISTINCT ip, count(ip) as count FROM ".$prefix."_superiplog GROUP BY ip ORDER BY count DESC");
		while($row = $db->sql_fetchrow($result))
		{
			echo "<tr><td>".$row['ip']."</td><td>".$row['count']."</td></tr>";
		}
	}

function perpage() {
		global $prefix, $db;
		echo "<table border=\"1\" align=\"center\"><th>Page Title</th><th>Hits</th>";
		$result = $db->sql_query("SELECT DISTINCT pagetitle, count(pagetitle) as count FROM ".$prefix."_superiplog GROUP BY pagetitle ORDER BY count DESC");
		while($row = $db->sql_fetchrow($result))
		{
			echo "<tr><td>".$row['pagetitle']."</td><td>".$row['count']."</td></tr>";
		}
	}

	function clearlog() {
		OpenTable();
		global $admin_file;
		echo "Are you sure you want to delete all IP Logs?";
		echo " <a href=\"".$admin_file.".php?op=confirmclearlog\">Yes</a>";
		echo " <a href=\"".$admin_file.".php?op=superiplog\">No</a>";
		CloseTable();
	}
	
	function doclearlog() {
		global $prefix, $db, $admin_file;
		$db->sql_query("delete from " . $prefix . "_superiplog");
		Header("Location: ".$admin_file.".php?op=adminMain");
	}
      superipmenu();

	switch($op) {

		case "superiplog":
		case "accesslog":
				accesslog();
				break;
		case "requestsperip":
				perip();
				break;
		case "requestsperpage":
				perpage();
				break;
		case "confirmclearlog":
				doclearlog();
				break;
		case "clearlog":
				clearlog();
				break;
		default:
				break;
	}

	include ("footer.php");
} else {
	echo "Access Denied";
}
?>