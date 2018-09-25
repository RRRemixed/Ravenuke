<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'footer.php')) {
	Header('Location: index.php');
	die();
}

define('NUKE_FOOTER', true);

function footmsg($echoit = true) {
	global $foot1, $foot2, $foot3, $copyright, $total_time, $start_time, $footmsg;
	$mtime = microtime();
	$mtime = explode(' ',$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$end_time = $mtime;
	$total_time = ($end_time - $start_time);
	$total_time = _PAGEGENERATION.' '.substr($total_time,0,4).' '._SECONDS;
	$footmsg = '<div class="footmsg">';
	if (!empty($foot1)) {
		$footmsg .= $foot1.'<br />';
	}
	if (!empty($foot2)) {
		$footmsg .= $foot2.'<br />';
	}
	if (!empty($foot3)) {
		$footmsg .= $foot3.'<br />';
	}
	// DO NOT REMOVE THE FOLLOWING COPYRIGHT LINE. YOU'RE NOT ALLOWED TO REMOVE NOR EDIT THIS.
	// IF YOU REALLY NEED TO REMOVE IT AND HAVE MY WRITTEN AUTHORIZATION CHECK: http://phpnuke.org/modules.php?name=Commercial_License
	// PLAY FAIR AND SUPPORT THE DEVELOPMENT, PLEASE!
	$footmsg .= $copyright.'<br />'.$total_time.'<br /></div>';
	if ($echoit) {
		echo $footmsg; }
}

function foot() {
	global $prefix, $user_prefix, $db, $index, $user, $cookie, $storynum, $user, $cookie, $Default_Theme, $foot1, $foot2, $foot3, $foot4, $home, $name, $admin;
	if(defined('HOME_FILE')) {
		blocks('Down');
	}
	if (!isset($commercial__license)) $commercial_license = '';
	if (basename($_SERVER['PHP_SELF']) != 'index.php' AND defined('MODULE_FILE') AND file_exists('modules/'.$name.'/copyright.php') && $commercial_license != 1) {
		$cpname = str_replace('_', ' ', $name);
		echo '<div align="right"><a href="javascript:openwindow()">'.$cpname.' &copy;</a></div>';
	}
	if (basename($_SERVER['PHP_SELF']) != 'index.php' AND defined('MODULE_FILE') AND (file_exists('modules/'.$name.'/admin/panel.php') && is_admin($admin))) {
		echo '<br />';
		OpenTable();
		include_once('modules/'.$name.'/admin/panel.php');
		CloseTable();
	}
	themefooter();
	if (file_exists('includes/custom_files/custom_footer.php')) {
		include_once('includes/custom_files/custom_footer.php');
	}

	// GT-NExtGEn 0.4/0.5 by Bill Murrin (Audioslaved) http://gt.audioslaved.com (c) 2004
	//Modified by montego from http://montegoscripts.com for RavenNUke76
	global $tnsl_bUseShortLinks, $tnsl_bAutoTapBlocks, $tnsl_bAutoTapLinks, $tnsl_bDebugShortLinks, $tnsl_sGTFilePath;
	if (defined('TNSL_USE_SHORTLINKS')) {
		tnsl_fPageTapFinish();
	}
	writeBODYJS();

	// This code was contributed by emilacosta and adapted for use with RavenNuke(tm) v2.40.00 by Raven
	global $loglevel;
	if ($loglevel==3||$loglevel==4) {
		$total_query = ' DB Queries: ' . $db->num_queries_1;
		$all_queries = $db->all_queries;
		if (is_admin($admin))
		{
			echo '<br /><br /><br /><br />';
			echo '<div id="queries" style="text-align:left;background-color:white;">';
			echo $total_query;
			echo '<br /><br />';
			echo $all_queries;
			echo '</div>';
		}
	}

	echo '</body>'."\n".'</html>';
	/* See Mantis issue 0001059: This page is not Valid XHTML 1.0 Transitional! as to why the next line is commented out */
	//ob_end_flush();
	die();
}

// MS-Analysis Entry
require( "modules/MS_Analysis/mstrack.php" );
foot();

?>
