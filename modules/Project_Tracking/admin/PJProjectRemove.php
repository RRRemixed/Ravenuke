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

if (!defined('ADMIN_FILE')) {
	die ('Access Denied');
}

$pagetitle = ': ' . _PJ_TITLE . ': ' . _PJ_PROJECTS . ': ' . _PJ_DELETEPROJECT;

include('header.php');

$project = pjproject_info($project_id);

pjadmin_menu(_PJ_PROJECTS . ': ' . _PJ_DELETEPROJECT);
echo '<br />'."\n";

OpenTable();
echo '<form method="post" action="' . $admin_file . '.php">'."\n";
echo '<table align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center"><b>' . _PJ_PROJECTCONFIRMDELETE . '</b></td></tr>'."\n";
echo '<tr><td align="center"><b><i>' . $project['project_name'] . ':</i></b></td></tr>'."\n";
echo '<tr><td align="center"><i>' . $project['project_description'] . '</i></td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="' . _PJ_DELETEPROJECT . '" />'."\n";
echo '<input type="hidden" name="op" value="PJProjectDelete" />'."\n";
echo '<input type="hidden" name="project_id" value="' . $project_id . '" />'."\n";
echo '</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();

pj_copy();

include('footer.php');

?>