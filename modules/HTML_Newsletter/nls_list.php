<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* HTML Newsletter 1.0 module for PHP-Nuke 6.5 - 7.6                    */
/* By: NukeWorks (webmaster@nukeworks.biz)                              */
/* http://www.nukeworks.com                                             */
/* Copyright � 2004 by NukeWorks                                        */
/* License: GNU/GPL                                                     */
/************************************************************************/
/************************************************************************
* HTML Newsletter 1.1 - 1.2 module for PHP-Nuke 6.5 - 7.6
* By: NukeWorks (mangaman@nukeworks.biz & montego@montegoscripts.com)
* http://www.nukeworks.biz
* Copyright � 2004, 2005 by NukeWorks
* License: GNU/GPL
************************************************************************/
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    01.03.03
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright � 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
if (!defined('MSNL_LOADED')) {
	die('Illegal File Access');
}
/************************************************************************
* Start displaying module content
************************************************************************/
@include_once('header.php');
$msnl_giHeadersSent = 1;
msnl_fPrintHTML('BEGIN');
@require_once('modules/' . $msnl_sModuleNm . '/javascript.php');
echo '<div id="msnl_div_title">';
opentable();
echo '<p ' . $msnl_asCSS['BLOCK_center'] . '>'
	. '<span class="title">'
	. _MSNL_NLS_LST_LAB_ARCHTITL
	. '</span>';
//Show link to administration if an admin is logged on
if (is_admin($admin)) {
	echo '<br />'
		. '[ <a href="' . $admin_file . '.php?op=msnl_admin" title="' . _MSNL_NLS_LST_LNK_ADMNLS
		. '">' . _MSNL_NLS_LST_LAB_ADMNLS . '</a> ]';
}
echo '</p>';
closetable();
echo '<br /></div>' . "\n";
opentable();
/************************************************************************
* Get Newsletter List
************************************************************************/
$sql = 'SELECT `nid`, nl.`cid`, `topic`, `sender`, `datesent`, `view`, `groups`, '
	. '`hits`, `ctitle`, `cblocklimit`, `filename`  FROM `'
	. $prefix . '_hnl_newsletters` nl, `'
	. $prefix . '_hnl_categories` nc '
	. 'WHERE nl.`cid` = nc.`cid` ORDER BY `ctitle` ASC, `datesent` DESC';
$result = msnl_fSQLCall($sql);
/************************************************************************
* If call was successful, list the newsletters.
************************************************************************/
if (!$result) { //Bad SQL call
	msnl_fRaiseAppError(_MSNL_NLS_LST_MSG_NONLS);
} else { //Successful SQL call
	echo '<div id="msnl_div_listnls">';
	opentable();
	$idx_tot_nls = 0; //Index for total number of newsletters displayed
	$idx_nl_nbr = 1; //Index for number of newsletters displayed within a category
	$prev_category = ''; //For determining category breaks
	while ($row = $db->sql_fetchrow($result)) {
		$nid = intval($row['nid']);
		$cid = intval($row['cid']);
		$topic = stripslashes($row['topic']);
		$sender = stripslashes($row['sender']);
		$datesent = $row['datesent'];
		$view = intval($row['view']);
		$groups = stripslashes($row['groups']);
		$hits = intval($row['hits']);
		$ctitle = stripslashes($row['ctitle']);
		$cblocklimit = intval($row['cblocklimit']);
		$filename = stripslashes($row['filename']);
		if (msnl_fIsViewable($view, $cid, $groups)) { //Is the newsletter viewable by the user?
			if ($ctitle != $prev_category) { //Do we need to write out a new category heading?
				if ($idx_nl_nbr != 1) {
					CloseTable();
					echo '<br />';
					OpenTable();
				}
				echo '<p ' . $msnl_asCSS['BLOCK_center'] . '><strong>' . $ctitle . '</strong></p>';
				$prev_category = $ctitle;
				$idx_nl_nbr = 1;
			} //End of show new category title
			$mod_row = msnl_fGetBlockRow($idx_nl_nbr, $nid, $topic, $sender, $hits, $datesent, $filename);
			if (!empty($mod_row)) {
				echo '<p>' . $mod_row . '</p>';
				$idx_nl_nbr++;
				$idx_tot_nls++;
			}
		} //End of msnl_fIsViewable IF

	} //End of while loop for list of newsletters
	if ($idx_tot_nls == 0) {
		echo _MSNL_NLS_LST_MSG_NONLS;
	}
	CloseTable();
	echo '</div>' . "\n";
} //End If of check for successful DB call
CloseTable();
msnl_fPrintHTML('END');
@include_once('footer.php');

?>