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
// To have the Copyright window work in your module just fill the following
// required information and then copy the file "copyright.php" into your
// module's directory. It's all, as easy as it sounds ;)
/************************************************************************/
/* Original module by Francisco Burzi http://phpnuke.org                */
/* Some code cleansing by VinDSL http://www.lenon.com/                  */
/*                                                                      */
/* Present code is now the product of the RavenNuke(tm) Team            */
/*       http://www.ravenphpscripts.com  http://www.ravenwebhosting.com         */
/************************************************************************/
$author_name = 'RavenNuke(tm)';
$author_user_email = 'raven@ravenphpscripts.com';
$author_homepage = 'http://www.ravenphpscripts.com';
$license = 'GNU/GPL';
$download_location = '';
$module_version = '2.0';
$module_description = 'Enhanced Feedback Module';

// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if ($author_name == '') { $author_name = 'N/A'; }
    if ($author_email == '') { $author_email = 'N/A'; }
    if ($author_homepage == '') { $author_homepage = 'N/A'; }
    if ($license == '') { $license = 'N/A'; }
    if ($download_location == '') { $download_location = 'N/A'; }
    if ($module_version == '') { $module_version = 'N/A'; }
    if ($module_description == '') { $module_description = 'N/A'; }
    $module_name = basename(dirname(__FILE__));
    $module_name = ucfirst(str_replace('_', ' ', $module_name));
  echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"'
  .'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd>'
	.'<html xmlns="http://www.w3.org/1999/xhtml">'
	.'<head><title>'.$module_name.': Copyright Information</title></head>'
	.'<body bgcolor="#F6F6EB" link="#363636" alink="#363636" vlink="#363636">'
	.'<center>'
	.'<font size="2" color="#363636" face="Verdana, Helvetica">'
	.'<b>Module Copyright &copy; Information</b><br />'
	.$module_description.' for <a href="http://www.ravenphpscripts.com" target="_blank">RavenNuke(tm)</a><br /><br />'
	.'</font>'
	.'</center>'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>Module\'s Name:</b> '.$module_name.'<br />'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>Module\'s Version:</b> '.$module_version.'<br />'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>Module\'s Description:</b> '.$module_description.'<br />'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>License:</b> '.$license.'<br />'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>Author\'s Name:</b> '.$author_name.'<br />'
	.'<img src="../../images/arrow.gif" border="0" alt="" />&nbsp;<b>Author\'s Email:</b> '.$author_email.'<br /><br />'
	.'<center>'
	.'<font size="2" color="#363636" face="Verdana, Helvetica">'
	.'[ <a href="'.$author_homepage.'" target="_blank">Author\'s HomePage</a> | '
//	.'<a href="'.$download_location.'" target="_blank">Module\'s Download</a> |'
	.'<a href="javascript:void(0)" onClick=javascript:self.close()>Close</a> ]'
	.'</font>'
	.'</center>'
	.'</body>'
	.'</html>';
}
show_copyright();
?>
