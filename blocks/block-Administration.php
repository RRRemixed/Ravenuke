<?php
/************************************************************************/
/*                                                                      */
/* Copyright (c) 2001-2002 by DutchGame                                 */
/* http://www.dutchgame.nl                                              */
/*                                                                      */
/* author: Robert Seelen aka B3rt                                       */
/*                                                                      */
/* Please let us know what you think of this script                     */
/* at http://www.dutchgame.nl/modules.php?name=XForum                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/* i have the block modified, now show bad links/downloads in           */
/* center-blocks.                                                       */
/* date: 11-06-2002 (info@ffx69.de) - http://www.shareware-base.de      */
/************************************************************************/

include("config.php");
$languagefile = "admin/language/lang-" . "$language" . ".php";
include("$languagefile"); 

if (eregi("block-Administration.php", $PHP_SELF)) {
    Header("Location: index.php");
    die();
}
$content = "<center><a href=\"admin.php\">Administration</a>&nbsp;|&nbsp;<a href=\"admin.php?op=adminStory\">Add new Story</a>&nbsp;|&nbsp;<a href=\"admin.php?op=create\">Change Survey</a>&nbsp;|&nbsp;<a href=\"admin.php?op=content\">Content</a>&nbsp;|&nbsp;<a href=\"admin.php?op=logout\">Logout</a><br>";
global $admin, $prefix, $dbi;
$result = sql_query("select * from ".$prefix."_queue", $dbi);
$num = sql_num_rows($result, $dbi);
$result = sql_query(
"select title, content from ".$prefix."_blocks where bkey='admin'", $dbi);
        $content = "<font class=\"content\">$content</font>";
        $content = "<center><a href=\"admin.php\">Administration</a>&nbsp;|&nbsp;<a href=\"admin.php?op=adminStory\">Add new Story</a>&nbsp;|&nbsp;<a href=\"admin.php?op=create\">Change Survey</a>&nbsp;|&nbsp;<a href=\"admin.php?op=content\">Content</a>&nbsp;|&nbsp;<a href=\"admin.php?op=logout\">Logout</a><br><br>";
        $content .= "<font class=\"content\">";
        $content .= "<center>&nbsp;<a href=\"admin.php?op=submissions\">"._SUBMISSIONS."</a>: $num&nbsp;&nbsp;";
        $result = sql_query("select * from ".$prefix."_reviews_add", $dbi);
        $num = sql_num_rows($result, $dbi);
        $content .= "&nbsp;<a href=\"admin.php?op=reviews\">"._WREVIEWS."</a>: $num&nbsp;&nbsp;";
        $result = sql_query("select * from ".$prefix."_links_newlink", $dbi);
        $num = sql_num_rows($result, $dbi);
        $content .= "&nbsp;<a href=\"admin.php?op=Links\">"._WLINKS."</a>: $num&nbsp;&nbsp;";
        $result = sql_query("select * from ".$prefix."_downloads_newdownload", $dbi);
        $num = sql_num_rows($result, $dbi);
        $content .= "&nbsp;<a href=\"admin.php?op=downloads\">"._UDOWNLOADS."</a>: $num</font><hr>";
	$result = sql_query("select * from ".$prefix."_downloads_modrequest where brokendownload=1", $dbi);
	$num = sql_num_rows($result, $dbi);
	$content .= "&nbsp;<a href=\"admin.php?op=DownloadsListBrokenDownloads\">"._BROKENDOWNLOADSREP."</a>: $num&nbsp;&nbsp;";
	$result2 = sql_query("select * from ".$prefix."_downloads_modrequest where brokendownload=0", $dbi);
	$num = sql_num_rows($result2, $dbi);
	$content .= "&nbsp;<a href=\"admin.php?op=DownloadsListModRequests\">"._DOWNLOADMODREQUEST."</a>: $num&nbsp;&nbsp;<br>";
	$result = sql_query("select * from ".$prefix."_links_modrequest where brokenlink=1", $dbi);
	$num = sql_num_rows($result, $dbi);
	$content .= "&nbsp;<a href=\"admin.php?op=LinksListBrokenLinks\">"._BROKENLINKSREP." </a>: $num&nbsp;&nbsp;";
	$result2 = sql_query("select * from ".$prefix."_links_modrequest where brokenlink=0", $dbi);
	$num = sql_num_rows($result2, $dbi);
	$content .= "&nbsp;<a href=\"admin.php?op=LinksListModRequests\">"._LINKMODREQUEST."</a>: $num</font>";

?>
