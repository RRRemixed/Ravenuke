<?php
/*      Content Plus for RavenNuke(tm): /copyright.php
 *      Copyright 2004 - 2009 Jonathan Estrella <jestrella04@gmail.com>
 * 		Join me at http://slaytanic.sourceforge.net
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 */

$module_name = basename(dirname(__FILE__));
$mod_name = 'Content Plus';
$author_email = 'jestrella04 (at) gmail (dot) com';
$author_homepage = 'http://slaytanic.sourceforge.net';
$author_name = '<a href="'.$author_homepage.'" target="new">Jonathan Estrella</a>';
$license = 'GNU/GPL';
$download_location = 'http://slaytanic.sourceforge.net/modules.php?name=Downloads&amp;op=getit&amp;lid=1';
$module_version = '2.2.2';
$release_date = '';
$module_description = 'Revamped Content Module';
$mod_cost = '';
if (empty($mod_name)) { $mod_name = eregi_replace('_', ' ', $module_name); }

echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'.PHP_EOL;
echo '<html xmlns="http://www.w3.org/1999/xhtml">'.PHP_EOL;
echo '<head>'.PHP_EOL;
echo '<title>'.$mod_name.': Copyright Information</title>'.PHP_EOL;
echo '<style type="text/css">'.PHP_EOL;
echo '	body{ margin: 0.5em; padding: 0; font: 70%/1.5 Verdana, Tahoma, Arial, Helvetica, sans-serif; }'.PHP_EOL;
echo '</style>'.PHP_EOL;
echo '</head>'.PHP_EOL;
$bullet = '<img src="images/icons/accepted_48.png" alt="-" border="0" width="16" style="vertical-align: middle; margin-right: 0.3em;" />';
echo '<body bgcolor="#FFFFFF" link="#000000" alink="#000000" vlink="#000000">'.PHP_EOL;
echo '<center><b>Module Copyright &copy; Information</b><br />'.PHP_EOL;
echo $mod_name.' module for PHP-Nuke &amp; Derivatives</center><hr />'.PHP_EOL;
echo $bullet.'<b>Module\'s Name:</b> '.$mod_name.'<br />'.PHP_EOL;
if (!empty($module_version)) { echo $bullet.'<b>Module\'s Version:</b> '.$module_version.'<br />'.PHP_EOL; }
if (!empty($release_date)) { echo $bullet.'<b>Release Date:</b> '.$release_date.'<br />'.PHP_EOL; }
if (!empty($mod_cost)) { echo $bullet.'<b>Module\'s Cost:</b> '.$mod_cost.'<br />'.PHP_EOL; }
if (!empty($license)) { echo $bullet.'<b>License:</b> '.$license.'<br />'.PHP_EOL; }
if (!empty($author_name)) { echo $bullet.'<b>Author\'s Name:</b> '.$author_name.'<br />'.PHP_EOL; }
if (!empty($author_email)) { echo $bullet.'<b>Author\'s Email:</b> '.$author_email.'<br />'.PHP_EOL; }
if (!empty($module_description)) { echo $bullet.'<b>Module\'s Description:</b> '.$module_description.'<br />'.PHP_EOL; }
if (!empty($download_location)) { echo $bullet.'<b>Module\'s Download:</b> <a href="'.$download_location.'" target="new">Download</a><br />'.PHP_EOL; }
echo '<hr />'.PHP_EOL;
echo '<center>[ <a href="#" onclick="javascript:self.close()">Close Window</a> ]</center>'.PHP_EOL;
echo '</body>'.PHP_EOL;
echo '</html>'.PHP_EOL;
?>