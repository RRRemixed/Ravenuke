<?php

/***********************************************************/
/* NukeScripts Network (webmaster@nukescripts.net) 			*/
/* http://www.nukescripts.net 						*/
/* Copyright © 2000-2005 by NukeScripts Network 			*/
/***********************************************************/
/*"Iñtërnâtiônàlizætiøn"							*/
/* Project Tracking 					 			*/
/* http://www.ravennuke.com	 						*/
/* Copyright © 2009 by RavenNuke™		 			*/
/* Author: Palbin (matt@phpnuke-guild.org)					*/
/* Description of changes: Made 100% XHTML 1.0 Transitional	*/
/*	Compliant.  Bugs fixes and major code formating changes	*/
/***********************************************************/

if(!defined('BLOCK_FILE')) {
	die("Illegal Access Detected!!!");
}

global $prefix, $db, $bgcolor2;

$module_name = 'Project_Tracking';

include_once('modules/' . $module_name . '/includes/nsnpj_func.php');

$content = '<table align="center" border="1" cellpadding="2" cellspacing="0" width="100%">'."\n";
$content .= '<tr>'."\n";
$content .= '<td bgcolor="' . $bgcolor2 . '" colspan="2" width="100%"><b>' . _PJ_PROJECTNAME . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_SITE . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_TASKS . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_REPORTS . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_REQUESTS . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_STATUS . '</b></td>'."\n";
$content .= '<td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _PJ_PROGRESSBAR . '</b></td>'."\n";
$content .= '</tr>'."\n";

$projectresult = $db->sql_query('SELECT project_id FROM ' . $prefix . '_nsnpj_projects WHERE featured ="1" ORDER BY weight');
while(list($project_id) = $db->sql_fetchrow($projectresult)) {
	$project = pjprojectpercent_info($project_id);
	$projectstatus = pjprojectstatus_info($project['status_id']);
	$pjimage = pjimage('project.png', $module_name);
	$content .= '<tr><td align="center"><img src="' . $pjimage . '" alt="" title="" /></td>'."\n";
	$content .= '<td width="100%"><a href="modules.php?name=' . $module_name . '&amp;op=PJProject&amp;project_id=' . $project_id . '">' . $project['project_name'] . '</a></td>'."\n";

	if($project['project_site'] > '') {
		$pjimage = pjimage('demo.png', $module_name);
		$demo = ' <a href="' . $project['project_site'] . '" target="_blank"><img src="' . $pjimage . '" border="0" alt="' . $project['project_name'] . '" ' . _PJ_SITE . ' title="' . $project['project_name'] . '" ' . _PJ_SITE . ' /></a>';
	} else {
		$demo = '&nbsp;';
	}

	$content .= '<td align="center">' . $demo . '</td>'."\n";
	$numtasks = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_tasks WHERE project_id=' . $project_id));

	if(!$numtasks) {
		$numtasks = 0;
	}

	$content .= '<td align="center">' . $numtasks . '</td>'."\n";

	if($project['allowreports'] > 0) {
		$numreports = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_reports WHERE project_id=' . $project_id));
		
		if(!$numreports) {
			$numreports = 0;
		}
    
		$content .= '<td align="center">' . $numreports . '</td>'."\n";
	} else {
		$content .= '<td align="center">----</td>'."\n";
	}

	if($project['allowrequests'] > 0) {
		$numrequests = $db->sql_numrows($db->sql_query('SELECT * FROM ' . $prefix . '_nsnpj_requests WHERE project_id=' . $project_id));
		
		if(!$numrequests) {
			$numrequests = 0;
		}
    
		$content .= '<td align="center">' . $numrequests . '</td>'."\n";
	} else {
		$content .= '<td align="center">----</td>'."\n";
	}

	if($projectstatus['status_name'] == "") {
		$projectstatus['status_name'] = _PJ_NA;
	}

	$content .= '<td align="center">' . $projectstatus['status_name'] . '</td>'."\n";
	$pjimage = pjimage('bar_left.png', $module_name);
	$content .= '<td nowrap="nowrap"><img src="' . $pjimage . '" height="7" width="1" alt="" title="" />';

	if($project['project_percent'] == 0){
		$pjimage = pjimage('bar_center_red.png', $module_name);
		$content .= '<img src="' . $pjimage . '" height="7" width="100" alt="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="0' . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
	} else {

		if($project['project_percent'] > 100) {
			$project_percent = 100;
		} else {
			$project_percent = $project['project_percent'];
		}

		$pjimage = pjimage('bar_center_grn.png', $module_name);
		$content .= '<img src="' . $pjimage . '" height="7" width="' . $project_percent . '" alt="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
    
		if($project_percent < 100){
			$percent_incomplete = 100 - $project_percent;
			$pjimage = pjimage('bar_center_red.png', $module_name);
			$content .= '<img src="' . $pjimage . '" height="7" width="' . $percent_incomplete . '" alt="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" title="' . $project_percent . _PJ_PERCENT . ' ' . _PJ_COMPLETED . '" />';
		}
	}
  
  $pjimage = pjimage('bar_right.png', $module_name);
  $content .= '<img src="' . $pjimage . '" height="7" width="1" alt="" title="" /></td>'."\n";
  $content .= '</tr>'."\n";
}

$content .=  '</table>'."\n";

?>