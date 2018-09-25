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
// NOTE: in $download_location PLEASE give the direct download link to the file!!!

$author_name = "Aric Bolf (SuperCat)";
$module_other = "Updated For <strong>Ravennuke&trade;</strong>";
$author_email = "webmaster (at) ourscripts (dot) net";
$author_homepage = "http://www.ourscripts.net";
$license = "GNU/GPL";
$download_location = "http://www.ourscripts.net";
$module_version = "8.5.3";
$module_description = "Let the visitors to your site speak up! The block is very easy to use, the shout history module lets everyone see and search all previous shouts. The admin area controls it all. Compatability for browsers including Firefox, Opera, NS, IE, Safari, Konquerer, and Mozilla make this a cross platform application. This ensures a great user experience! What a great way to let others build content on your site! Administration area to control what people can say and do. Add your own smilies too! Censor words people find offensive. Uses the PHP-Nuke SQL abstraction layer. Auto scrolls with mouseover scroller controls. Includes both .sql and .php SQL installers, SQL repair tool, Setup and Security monitor, full URL support, anonymous nicks censoring, no cloning registered nicknames, spam/flood protection, error reporting, ban users by IP or nickname, uses theme CSS, server time offset, history uses forum avatars, and more!";
// DO NOT TOUCH THE FOLLOWING COPYRIGHT CODE. YOU'RE JUST ALLOWED TO CHANGE YOUR "OWN"
// MODULE'S DATA (SEE ABOVE) SO THE SYSTEM CAN BE ABLE TO SHOW THE COPYRIGHT NOTICE
// FOR YOUR MODULE/ADDON. PLAY FAIR WITH THE PEOPLE THAT WORKED CODING WHAT YOU USE!!
// YOU ARE NOT ALLOWED TO MODIFY ANYTHING ELSE THAN THE ABOVE REQUIRED INFORMATION.
// AND YOU ARE NOT ALLOWED TO DELETE THIS FILE NOR TO CHANGE ANYTHING FROM THIS FILE IF
// YOU'RE NOT THIS MODULE'S AUTHOR.

function show_copyright() {
    global $author_name, $module_other, $author_email, $author_homepage, $license, $download_location, $module_version, $module_description;
    if (empty($author_name)) { $author_name = "N/A"; }
	if (empty($author_name2)) { $author_name = "N/A"; }
    if (empty($author_email)) { $author_email = "N/A"; }
    if (empty($author_homepage)) { $author_homepage = "N/A"; }
    if (empty($license)) { $license = "N/A"; }
    if (empty($download_location)) { $download_location = "N/A"; }
    if (empty($module_version)) { $module_version = "N/A"; }
    if (empty($module_description)) { $module_description = "N/A"; }
    $module_name = basename(dirname(__FILE__));
    $module_name = eregi_replace("_", " ", $module_name);
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n";
	echo '<html xmlns="http://www.w3.org/1999/xhtml">' . "\n";
	echo '<head>' . "\n";
	echo '<title>'.$module_name.': Copyright Information</title>' . "\n";
	echo '</head>' . "\n";
	echo '<body bgcolor="#F6F6EB" link="#363636" alink="#363636" vlink="#363636">' . "\n";
	echo '<div align="center"><font style="font-size: 12px;color: #363636; font-family:Verdana, Arial, Helvetica, sans-serif;">' . "\n";
	echo '<strong>Module Copyright &copy; Information</strong><br />'.$module_name.' module for <a href="http://phpnuke.org" target="new">PHP-Nuke</a><br /><br /></font></div>' . "\n";
	echo '<div align="left"><font style="font-size: 12px;color: #363636; font-family:Verdana, Arial, Helvetica, sans-serif;">' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Module\'s Name:</strong> '.$module_name.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Module\'s Version:</strong> '.$module_version.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Module\'s Other:</strong> '.$module_other.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Module\'s Description:</strong> '.$module_description.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>License:</strong> '.$license.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Author\'s Name:</strong> '.$author_name.'<br />' . "\n";
	echo '<img src="../../images/arrow.gif" border="0" alt="Arrow" />&nbsp;<strong>Author\'s Email:</strong> '.$author_email.'<br /><br />' . "\n";
	echo '</font></div>' . "\n";
	echo '<div align="center"><font style="font-size: 12px;color: #363636; font-family:Verdana, Arial, Helvetica, sans-serif;">' . "\n";
	echo '[ <a href="'.$author_homepage.'" target="new">Author\'s HomePage</a> | <a href="'.$download_location.'" target="_blank">Module\'s Download</a> | <a href="javascript:void(0)" onclick="javascript:self.close()">Close</a> ]' . "\n";
	echo '</font></div>' . "\n";
	echo '</body>' . "\n";
	echo '</html>' . "\n";
}

show_copyright();

?>
