<?php
/***************************************************************************
 *                              page_tail.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_tail.php,v 1.27.2.4 2005/09/14 18:14:30 acydburn Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
        die('Hacking attempt');
}

// Start add - Complete banner MOD
if ($banner_show_list)
{
	$banner_show_list['0'] = ($banner_show_list) ? ' ':'';
	$sql = "UPDATE ".BANNERS_TABLE." SET banner_view=banner_view+1 where banner_id IN ($banner_show_list)"; 
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, "Couldn't update banners data", "", __LINE__, __FILE__, $sql);
	} 
}
// End add - Complete banner MOD

global $do_gzip_compress;

//
// Show the overall footer.
//
global $nukeuser, $popup;
$admin_link = ( $userdata['user_level'] == ADMIN ) ? '<a href="' . append_sid("modules/Forums/admin/index.$phpEx?admin=1") . '">' . $lang['Admin_panel'] . '</a><br /><br />' : '';

$template->set_filenames(array(
        'overall_footer' => ( empty($gen_simple_header) ) ? 'overall_footer.tpl' : 'simple_footer.tpl')
);

$template->assign_vars(array(
        'TRANSLATION_INFO' => (isset($lang['TRANSLATION_INFO'])) ? $lang['TRANSLATION_INFO'] : ((isset($lang['TRANSLATION'])) ? $lang['TRANSLATION'] : ''),
        'ADMIN_LINK' => $admin_link)
);

$template->pparse('overall_footer');
CloseTable();
//
// Close our DB connection.
//
//$db->sql_close(); // per RN0001211 - causes issues with invalid sql connection later on

//
// Compress buffered output if required and send to browser
//
if ($popup != "1") {
    include_once("footer.php");
    }
?>
