<?php

/************************************************************************************/
/*                                                                                  */
/* Maty Scripts Analysis for PHP-Nuke 6.5-7.9                                       */
/* v2.3                                                                             */
/*                                                                                  */
/* Copyright © 2002-2005 by: Maty Scripts (webmaster@matyscripts.com)               */
/* http://www.matyscripts.com                                                       */
/*                                                                                  */
/* This program is free software. You can redistribute it and/or modify             */
/* it under the terms of the GNU General Public License as published by             */
/* the Free Software Foundation; either version 2 of the License.                   */
/*                                                                                  */
/************************************************************************************/
/* PHP-NUKE: Web Portal System                                                      */
/* ===========================                                                      */
/*                                                                                  */
/* Copyright (c) 2002 by Francisco Burzi                                            */
/* http://phpnuke.org                                                               */
/*                                                                                  */
/* Enhanced with NukeStats Module Version 1.0                                       */
/* ==========================================                                       */
/* Copyright ©2002 by Harry Mangindaan (sens@indosat.net) and                       */
/*                    Sudirman (sudirman@akademika.net)                             */
/* http://www.nuketest.com                                                          */
/*                                                                                  */
/************************************************************************************/

$index = 0;
$module_name = explode( "/scripts", str_replace( "\\", "/", dirname( __FILE__ ) ) );
$module_name = basename( $module_name[0] );

if( !stristr( $_SERVER['SCRIPT_NAME'], "modules.php" ) ) {
   die( "You can't access this file directly..." );
}

require_once( "mainfile.php" );
@(require_once( "modules/$module_name/include/class.general.php" )) OR die ("File class.general.php can not be found" );
get_lang( $module_name );

$ThemeSel = get_theme();
$msa = new msanalysis();
$now = $msa->MSLogDate( 1 );
$dot = explode ("-",$now);
$nowdate = $dot[2];
$nowmonth = $dot[1];
$nowyear = $dot[0];

function MSAnalysisStats($total) {
    global $hlpfile,$nowyear,$nowmonth,$nowdate,$nowhour, $sitename, $startdate, $prefix, $db, $now, $module_name, $admin;
    $msa = new msanalysis();
    include ("header.php");
    @(include( "modules/$module_name/scripts/title.php" ) ) OR die ("File title.php can not be found" );

    OpenTable();
    OpenTable();
    // Total amount of downloads
    $download_info = explode("|", $msa->TotalDownloads( ) );
    // Total Hits
    $total = $msa->TotalVisits( );
    echo "<center><font class=\"option\"><b>$sitename "._MSA_STATS."</b></font><br><br>"._MSA_WERECEIVED." <b>$total</b> "._MSA_PAGESVIEWS." <b>$startdate</b>".
    "<br>"._MSA_DOWNLOADS1. " <a href=modules.php?name=Downloads>".$download_info[ 0 ]. "</a> "._MSA_DOWNLOADS2. " ".$download_info[ 1 ]. " "._MSA_DOWNLOADS3."<br>"._MSA_TODAYIS." <b>".date( "j F Y\nH:i:s T" )."</b><br><br>";
    // Most visited Month, Day and Hour
    echo $msa->MostMonth();
    echo $msa->MostDay();
    echo $msa->MostHour();
	echo "<br>[ <a href=\"modules.php?name=$module_name\">"._MSA_RETURNBASICSTATS."</a> ]</center>";

    CloseTable();
    echo "<br><br>";
    MSAnalysisShowYearStats($nowyear);
    echo "<BR><BR>";
    MSAnalysisShowMonthStats($nowyear,$nowmonth);
    echo "<BR><BR>";
    MSAnalysisShowDailyStats($nowyear,$nowmonth,$nowdate);
    echo "<BR><BR>";
    MSAnalysisShowHourlyStats($nowyear,$nowmonth,$nowdate);
    echo "<br><br><center>[ <a href=\"modules.php?name=$module_name\">"._MSA_RETURNBASICSTATS."</a> ]</center><br><br>";
    CloseTable();
    include ("footer.php");
}

function MSAnalysisYearlyStats($year){
    global $hlpfile,$nowyear,$nowmonth,$nowdate, $sitename, $module_name, $admin, $prefix, $db;
    include ("header.php");
    @(include( "modules/$module_name/scripts/title.php" ) ) OR die ("File title.php can not be found" );
    opentable();
    MSAnalysisShowMonthStats($year,$nowmonth);
    echo "<BR>";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._MSA_BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\">"._MSA_BACKTODETSTATS."</a> ]</center>";
    closetable();
    include ("footer.php");
}

function MSAnalysisMonthlyStats($year,$month){
    global $sitename, $module_name, $admin, $prefix, $db;
    include ("header.php");
    @(include( "modules/$module_name/scripts/title.php" ) ) OR die ("File title.php can not be found" );
    opentable();
    MSAnalysisShowDailyStats($year,$month,$nowdate);
    echo "<BR>";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._MSA_BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\">"._MSA_BACKTODETSTATS."</a> ]</center>";
    closetable();
    include ("footer.php");
}

function MSAnalysisDailyStats($year,$month,$date){
    global $sitename, $module_name, $admin, $prefix, $db;
    include ("header.php");
    @(include( "modules/$module_name/scripts/title.php" ) ) OR die ("File title.php can not be found" );
    opentable();
    MSAnalysisShowHourlyStats($year,$month,$date);
    echo "<BR>";
    echo "<center>[ <a href=\"modules.php?name=$module_name\">"._MSA_BACKTOMAIN."</a> | <a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisStats\">"._MSA_BACKTODETSTATS."</a> ]</center>";
    closetable();
    include ("footer.php");
}


function MSAnalysisShowYearStats($nowyear){
    global $db,$prefix,$bgcolor1,$bgcolor2,$bgcolor2, $ThemeSel, $module_name;
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("select sum(hits) as TotalHitsYear from ".$prefix."_stats_year" );
    list($TotalHitsYear) = $db->sql_fetchrow($resulttotal);
    $db->sql_freeresult($resulttotal);
    $result = $db->sql_query("select year,hits from ".$prefix."_stats_year order by year");
    echo "<center><b>"._MSA_YEARLYSTATS."</b></center><br>";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._MSA_YEAR."</td><td bgcolor=\"$bgcolor2\">"._MSA_SPAGESVIEWS."</td></tr>";
    while (list($year,$hits) = $db->sql_fetchrow($result)){
	echo "<tr bgcolor=\"$bgcolor1\"><td nowrap>";
	if ($year != $nowyear) {
	    echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisYearlyStats&amp;year=$year\">$year</a>";
	} else {
        echo "<font color=\"#FF0000\">$year</font>";
	}
	echo "</td><td>";
	$WidthIMG = round(100 * $hits/$TotalHitsYear,0);
	echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=",$WidthIMG * 2," Alt=\"\">"
	    ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\"> ($hits)</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>";
}

function MSAnalysisShowMonthStats($nowyear,$nowmonth){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel, $module_name;
    $msa = new msanalysis();
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resultmonth = $db->sql_query("select sum(hits) as TotalHitsMonth from ".$prefix."_stats_month where year='$nowyear'");
    list($TotalHitsMonth) = $db->sql_fetchrow($resultmonth);
    $db->sql_freeresult($resultmonth);
    $result = $db->sql_query("select month,hits from ".$prefix."_stats_month where year='$nowyear'");
    echo "<center><b>"._MSA_MONTLYSTATS." $nowyear</b></center><br>";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._MSA_UMONTH."</td><td bgcolor=\"$bgcolor2\">"._MSA_SPAGESVIEWS."</td></tr>";
    while (list($month,$hits) = $db->sql_fetchrow($result)){
	echo "<tr bgcolor=\"$bgcolor1\"><td>";
	if ($month != $nowmonth) {
	    echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisMonthlyStats&amp;year=$nowyear&amp;month=$month\" class=\"hover_orange\">";
	    echo "".$msa->GetMonth( $month )."";
	    echo "</a>";
	} else {
        echo "<font color=\"#FF0000\">".$msa->GetMonth( $month )."</font>";
	}
	echo "</td><td nowrap>";
	$WidthIMG = round(100 * $hits/$TotalHitsMonth,0);
	echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=",$WidthIMG * 2," Alt=\"\">";
	echo "<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\"> ($hits)</td></tr>";
	echo "</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>";
}

function MSAnalysisShowDailyStats($year,$month,$nowdate){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel, $module_name;
    $msa = new msanalysis();
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("select sum(hits) as TotalHitsDate from ".$prefix."_stats_date where year='$year' and month='$month'");
    list($TotalHitsDate) = $db->sql_fetchrow($resulttotal);
    $db->sql_freeresult($resulttotal);
    $result = $db->sql_query("select year,month,date,hits from ".$prefix."_stats_date where year='$year' and month='$month' order by date");
    $total = $db->sql_numrows($result);
    echo "<center><b>"._MSA_DAILYSTATS." ";
    echo "".$msa->GetMonth( $month )."";
    echo ", $year</b></center><br>";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._MSA_DATE."</td><td bgcolor=\"$bgcolor2\">"._MSA_SPAGESVIEWS."</td></tr>";
    while (list($year,$month,$date,$hits) = $db->sql_fetchrow($result)){
	echo "<tr bgcolor=\"$bgcolor1\"><td>";
	if ($date != $nowdate) {
	    echo "<a href=\"modules.php?name=$module_name&amp;file=scripts&targetscript=visits&amp;op=MSAnalysisDailyStats&amp;year=$year&amp;month=$month&amp;date=$date\" class=\"hover_orange\">";
        echo $date;
	    echo "</a>";
	} else {
        echo "<font color=\"#FF0000\">$date</font>";
	}
	echo "</td><td nowrap>";
	if ($hits == 0) {
	    $WidthIMG = 0;
	    $d_percent = 0;
	} else {
	    $WidthIMG = round(100 * $hits/$TotalHitsDate,0);
	    $d_percent = substr(100 * $hits / $TotalHitsDate, 0, 5);
	}
	echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=",$WidthIMG * 2," Alt=\"\">"
	    ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\"> $d_percent% ($hits)</td></tr>"
	    ."</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>";
}

function MSAnalysisShowHourlyStats($year,$month,$date){
    global $prefix,$bgcolor1,$bgcolor2,$db, $ThemeSel;
    $msa = new msanalysis();
    $l_size = getimagesize("themes/$ThemeSel/images/leftbar.gif");
    $m_size = getimagesize("themes/$ThemeSel/images/mainbar.gif");
    $r_size = getimagesize("themes/$ThemeSel/images/rightbar.gif");
    $resulttotal = $db->sql_query("select sum(hits) as TotalHitsHour from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$date'");
    list ($TotalHitsHour) = $db->sql_fetchrow($resulttotal);
    $db->sql_freeresult($resulttotal);
    $nowdate = date("d-m-Y");
    $nowdate_arr = explode("-",$nowdate);
    echo "<center><b>"._MSA_HOURLYSTATS." ";
    echo  "".$msa->GetMonth( $month )." ".$date.", " .$year."</b></center><br>";
    echo "<table align=\"center\" bgcolor=\"#000000\" cellspacing=\"1\" cellpadding=\"3\" border=\"0\">";
    echo "<tr><td width=\"25%\" bgcolor=\"$bgcolor2\">"._MSA_HOUR."</td><td bgcolor=\"$bgcolor2\" width=\"70%\">"._MSA_SPAGESVIEWS."</td></tr>";
    for ($k = 0;$k<=23;$k++) {
	$result = $db->sql_query("select hour,hits from ".$prefix."_stats_hour where year='$year' and month='$month' and date='$date' and hour='$k'");
	if($db->sql_numrows($result) == 0){
	    $hits=0;
	} else {
	    list($hour,$hits) = $db->sql_fetchrow($result);
	}
	echo "<tr><td bgcolor=\"$bgcolor1\">";
	if ($k < 10) {
	    $a = "0$k";
	} else {
	    $a = $k;
	}
	echo "$a:00 - $a:59";
	$a = "";
	echo "</td><td bgcolor=\"$bgcolor1\" nowrap>";
	if ($hits == 0) {
	    $WidthIMG = 0;
	    $d_percent = 0;
	} else {
	    $WidthIMG = round(100 * $hits/$TotalHitsHour,0);
	    $d_percent = substr(100 * $hits / $TotalHitsHour, 0, 5);
	}
	echo "<img src=\"themes/$ThemeSel/images/leftbar.gif\" Alt=\"\" width=\"$l_size[0]\" height=\"$l_size[1]\"><img src=\"themes/$ThemeSel/images/mainbar.gif\" height=\"$m_size[1]\" width=",$WidthIMG * 2," Alt=\"\">"
	    ."<img src=\"themes/$ThemeSel/images/rightbar.gif\" Alt=\"\" width=\"$r_size[0]\" height=\"$r_size[1]\"> $d_percent% ($hits)</td></tr>"
	    ."</td></tr>";
    }
    $db->sql_freeresult($result);
    echo "</table>";
}

switch($op) {

    default:
       MSAnalysisStats($total);
    break;

    case "MSAnalysisStats":
       MSAnalysisStats($total);
    break;

    case "MSAnalysisYearlyStats":
       MSAnalysisYearlyStats($year);
    break;

    case "MSAnalysisMonthlyStats":
       MSAnalysisMonthlyStats($year,$month);
    break;

    case "MSAnalysisDailyStats":
       MSAnalysisDailyStats($year,$month,$date);
    break;
}

?>