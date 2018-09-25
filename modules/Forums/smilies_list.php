<?php
		/***************************************************************************
		                             smilies_list.php
		                             -------------------
		    begin                : Tue February 26 2002
		    copyright            : (C) 2002 Nivisec.com
		    email                : admin@nivisec.com
		
		    $Id: smilies_list.php,v 1.1.0 2002/04/05 02:43:12 nivisec Exp $
		
		 ***************************************************************************/
		
		/***************************************************************************
		 *                                         				                                
		 *   This program is free software; you can redistribute it and/or modify  	
		 *   it under the terms of the GNU General Public License as published by  
		 *   the Free Software Foundation; either version 2 of the License, or	    	
		 *   (at your option) any later version.
		 *
		 ***************************************************************************/
if (!eregi("modules.php", $PHP_SELF)) 
    {
	die ("You can't access this file directly...");
    }
if ($popup != "1")
    {
	$module_name = basename(dirname(__FILE__));
	require("modules/".$module_name."/nukebb.php");
    }
    else
    {
	$phpbb_root_path = 'modules/Forums/';
    }
	
define('IN_PHPBB', true);
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_INDEX - 2262002, $board_config['session_length'], $nukeuser);
init_userprefs($userdata);
//
// End session management
//

include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);

$template->assign_vars(array(
"L_IMAGE" => $lang['smiley_url'],
"L_CODE" => $lang['smiley_code'],
"CLASS_1" => $theme['td_class1'],
"CLASS_2" => $theme['td_class2'],
"PAGE_NAME" => $page_title)
);

$template->set_filenames(array(
"body" => "smilies_list.tpl")
);

//
// Obtain Smilies
//
$sql = "SELECT code, smile_url, emoticon
FROM " . SMILIES_TABLE;

if (!$result = $db->sql_query($sql))
{
	message_die(GENERAL_ERROR, "Couldn't retrieve Smilie data", "", __LINE__, __FILE__, $sql);
}

//
// Sort into 2-D array indexed by image
//
while( $smilie_data = $db->sql_fetchrow($result) )
{
	$smilie_url_array[$smilie_data['smile_url']]['emoticon'] = $smilie_data['emoticon'];
	$smilie_url_array[$smilie_data['smile_url']]['code'] = ( !isset($smilie_url_array[$smilie_data['smile_url']]['code']) ) ? $smilie_data['code'] : $smilie_url_array[$smilie_data['smile_url']]['code'] . " or " . $smilie_data['code'];
}

$db->sql_freeresult($result);

//
// Assign template block vars and live happily ever after
//

$count = 0;
while ( list($key) = each($smilie_url_array) )
{
	$count++;

	$template->assign_block_vars("smilies", array(
	"URL" => '<img src="'. $board_config['smilies_path'] . '/' . $key . '" alt="' . $smilie_url_array[$key]['emoticon'] . '" border="0">',
	"EMOTICON" => $smilie_url_array[$key]['emoticon'],
	"START" => ( ($count % 2) ) ? "<tr>" : "",
	"END" => ( !($count % 2) ) ? "</tr>" : "",
	"CODE" => $smilie_url_array[$key]['code'])
	);
}

$page_title = $lang['Smilies'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->pparse("body");

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>
