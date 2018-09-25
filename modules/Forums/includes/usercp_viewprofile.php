<?php
/***************************************************************************
 *                           usercp_viewprofile.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   Id: usercp_viewprofile.php,v 1.5.2.5 2005/07/19 20:01:16 acydburn Exp
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
 *
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
	exit;
}

if ( empty($HTTP_GET_VARS[POST_USERS_URL]) || $HTTP_GET_VARS[POST_USERS_URL] == ANONYMOUS )
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}
$profiledata = get_userdata($HTTP_GET_VARS[POST_USERS_URL]);
if (!$profiledata)
{
	message_die(GENERAL_MESSAGE, $lang['No_user_id_specified']);
}

$sql = "SELECT *
	FROM " . RANKS_TABLE . "
	ORDER BY rank_special, rank_min";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
}

$ranksrow = array();
while ( $row = $db->sql_fetchrow($result) )
{
	$ranksrow[] = $row;
}
$db->sql_freeresult($result);

//
// Output page header and profile_view template
//
$template->set_filenames(array(
	'body' => 'profile_view_body.tpl')
);
if (is_active("Forums")) {
    make_jumpbox('viewforum.'.$phpEx);
}
//
// Calculate the number of days this user has been a member ($memberdays)
// Then calculate their posts per day
//
$regdate = $profiledata['user_regdate'];
$nukedate = strtotime($regdate);
$memberdays = max(1, round( ( time() - $nukedate ) / 86400 ));
$posts_per_day = $profiledata['user_posts'] / $memberdays;

// Get the users percentage of total posts
if ( $profiledata['user_posts'] != 0  )
{
	$total_posts = get_db_stat('postcount');
	$percentage = ( $total_posts ) ? min(100, ($profiledata['user_posts'] / $total_posts) * 100) : 0;
}
else
{
	$percentage = 0;
}

if ( $board_config['cell_allow_display_celleds'] && $profiledata['user_cell_celleds'] ) 
{
	$template->assign_block_vars('celleds', array());
}

$avatar_img = '';
if ( $profiledata['user_avatar_type'] && $profiledata['user_allowavatar'] )
{
	switch( $profiledata['user_avatar_type'] )
	{
		case USER_AVATAR_UPLOAD:
			$avatar_img = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars']) ? '<div style="position:absolute;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:1;"><IMG src="' . $board_config['avatar_path'] . '/' . $profiledata['user_avatar'] . '" border=0 width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div><div style="position:relative;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:2;"><IMG src="modules/Forums/images/cell.gif" border=0 STYLE="filter:alpha(opacity=65)" width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div>' : $avatar_img ;
			break;
		case USER_AVATAR_REMOTE:
			$avatar_img = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<div style="position:absolute;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:1;"><IMG src="' . $profiledata['user_avatar'] . '" border=0 width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div><div style="position:relative;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:2;"><IMG src="modules/Forums/images/cell.gif" border=0 STYLE="filter:alpha(opacity=65)" width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div>' : $avatar_img ;
			break;
		case USER_AVATAR_GALLERY:
			$avatar_img = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" alt="" border="0" />' : '';
			$avatar_img = ( ($profiledata['user_cell_time'] > 0) && $board_config['cell_allow_display_bars'] ) ? '<div style="position:absolute;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:1;"><IMG src="' . $board_config['avatar_gallery_path'] . '/' . $profiledata['user_avatar'] . '" border=0 width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div><div style="position:relative;padding:0px;width:'.$board_config['avatar_max_width'].'px;height:'.$board_config['avatar_max_height'].'px;z-index:2;"><IMG src="modules/Forums/images/cell.gif" border=0 STYLE="filter:alpha(opacity=65)" width="'.$board_config['avatar_max_width'].'" height="'.$board_config['avatar_max_height'].'"></div>' : $avatar_img ;
			break;
	}
}

$poster_rank = '';
$rank_image = '';
if ( $profiledata['user_rank'] )
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_rank'] == $ranksrow[$i]['rank_id'] && $ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}
else
{
	for($i = 0; $i < count($ranksrow); $i++)
	{
		if ( $profiledata['user_posts'] >= $ranksrow[$i]['rank_min'] && !$ranksrow[$i]['rank_special'] )
		{
			$poster_rank = $ranksrow[$i]['rank_title'];
			$rank_image = ( $ranksrow[$i]['rank_image'] ) ? '<img src="' . $ranksrow[$i]['rank_image'] . '" alt="' . $poster_rank . '" title="' . $poster_rank . '" border="0" /><br />' : '';
		}
	}
}

$temp_url = append_sid("privmsg.$phpEx?mode=post&amp;" . POST_USERS_URL . "=" . $profiledata['user_id']);
if (is_active("Private_Messages")) {
$pm_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_pm'] . '" alt="' . $lang['Send_private_message'] . '" title="' . $lang['Send_private_message'] . '" border="0" /></a>';
// FLAGHACK-start
$location = ( $profiledata['user_from'] ) ? $profiledata['user_from'] : '&nbsp;' ;
$flag = ( !empty($profiledata['user_from_flag']) ) ? "&nbsp;<img src=\"images/flags/" . $profiledata['user_from_flag'] . "\" alt=\"" . $profiledata['user_from_flag'] . "\">" : "";
$location .= $flag ;
// FLAGHACK-end
$pm = '<a href="' . $temp_url . '">' . $lang['Send_private_message'] . '</a>';
}

if ( !empty($profiledata['user_viewemail']) || $userdata['user_level'] == ADMIN )
{
	$email_uri = ( $board_config['board_email_form'] ) ? append_sid("profile.$phpEx?mode=email&amp;" . POST_USERS_URL .'=' . $profiledata['user_id']) : 'mailto:' . $profiledata['user_email'];

	$email_img = '<a href="' . $email_uri . '"><img src="' . $images['icon_email'] . '" alt="' . $lang['Send_email'] . '" title="' . $lang['Send_email'] . '" border="0" /></a>';
	$email = '<a href="' . $email_uri . '">' . $lang['Send_email'] . '</a>';
}
else
{
	$email_img = '&nbsp;';
	$email = '&nbsp;';
}
if (( $profiledata['user-website'] == "http:///") || ( $profiledata['user_website'] == "http://")){
    $profiledata['user_website'] =  "";
}
if (($profiledata['user_website'] != "" ) && (substr($profiledata['user_website'],0, 7) != "http://")) {
    $profiledata['user_website'] = "http://".$profiledata['user_website'];
}
$www_img = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_blank"><img src="' . $images['icon_www'] . '" alt="' . $lang['Visit_website'] . '" title="' . $lang['Visit_website'] . '" border="0" /></a>' : '&nbsp;';

$www = ( $profiledata['user_website'] ) ? '<a href="' . $profiledata['user_website'] . '" target="_blank">' . $profiledata['user_website'] . '</a>' : '&nbsp;';

$fb_img = ( $profiledata['user_fb'] ) ? '<a href="' . $profiledata['user_fb'] . '" target="_blank"><img src="' . $images['icon_fb'] . '" alt="' . $lang['Visit_fb'] . '" title="' . $lang['Visit_fb'] . '" border="0" /></a>' : '&nbsp;';
$fb = ( $profiledata['user_fb'] ) ? '<a href="' . $profiledata['user_fb'] . '" target="_blank">' . $profiledata['user_fb'] . '</a>' : '&nbsp;';

$tw_img = ( $profiledata['user_tw'] ) ? '<a href="' . $profiledata['user_tw'] . '" target="_blank"><img src="' . $images['icon_tw'] . '" alt="' . $lang['Visit_tw'] . '" title="' . $lang['Visit_tw'] . '" border="0" /></a>' : '&nbsp;';

$tw = ( $profiledata['user_tw'] ) ? '<a href="' . $profiledata['user_tw'] . '" target="_blank">' . $profiledata['user_tw'] . '</a>' : '&nbsp;';

$skype_img = ( $profiledata['user_skype'] ) ? '<a href="' . $profiledata['user_skype'] . '" target="_blank"><img src="' . $images['icon_skype'] . '" alt="' . $lang['Visit_skype'] . '" title="' . $lang['Visit_skype'] . '" border="0" /></a>' : '&nbsp;';

$skype = ( $profiledata['user_skype'] ) ? '<a href="' . $profiledata['user_skype'] . '" target="_blank">' . $profiledata['user_skype'] . '</a>' : '&nbsp;';

$steam_img = ( $profiledata['user_steam'] ) ? '<a href="' . $profiledata['user_steam'] . '" target="_blank"><img src="' . $images['icon_steam'] . '" alt="' . $lang['Visit_steam'] . '" title="' . $lang['Visit_steam'] . '" border="0" /></a>' : '&nbsp;';

$steam = ( $profiledata['user_steam'] ) ? '<a href="' . $profiledata['user_steam'] . '" target="_blank">' . $profiledata['user_steam'] . '</a>' : '&nbsp;';

$temp_url = append_sid("search.$phpEx?search_author=" . urlencode($profiledata['username']) . "&amp;showresults=posts");
$search_img = '<a href="' . $temp_url . '"><img src="' . $images['icon_search'] . '" alt="' . $lang['Search_user_posts'] . '" title="' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '" border="0" /></a>';
$search = '<a href="' . $temp_url . '">' . sprintf($lang['Search_user_posts'], $profiledata['username']) . '</a>';

// Start add - Gender MOD
if ( !empty($profiledata['user_gender'])) 
{ 
           switch ($profiledata['user_gender']) 
           { 
                      case 1: $gender=$lang['Male'];break; 
                      case 2: $gender=$lang['Female'];break; 
                      default:$gender=$lang['No_gender_specify']; 
           } 
} else $gender=$lang['No_gender_specify']; 
// End add - Gender MOD

//
// Generate page
//
$page_title = $lang['Viewing_profile'];
include("modules/Forums/includes/page_header.php");
display_upload_attach_box_limits($profiledata['user_id']);
$profiledata['user_from'] = str_replace(".gif", "", $profiledata['user_from']);
if (function_exists('get_html_translation_table'))
{
	$u_search_author = urlencode(strtr($profiledata['username'], array_flip(get_html_translation_table(HTML_ENTITIES))));
}
else
{
	$u_search_author = urlencode(str_replace(array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;'), array('&', "'", '"', '<', '>'), $profiledata['username']));
}

$template->assign_vars(array(
#======================================================================= |
#==== Start: == Advanced Username Color ================================ |
#==== v1.0.5 =========================================================== |
#====
	'USERNAME' => CheckUsernameColor($profiledata['user_color_gc'], $profiledata['username']),
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
#==== End: ==== Advanced Username Color ================================ |	
#======================================================================= |
        'JOINED' => $profiledata['user_regdate'],
	'POSTER_RANK' => $poster_rank,
	'RANK_IMAGE' => $rank_image,
	'POSTS_PER_DAY' => $posts_per_day,
	'POSTS' => $profiledata['user_posts'],
        'PERCENTAGE' => $percentage . '%',
        'POST_DAY_STATS' => sprintf($lang['User_post_day_stats'], $posts_per_day),
        'POST_PERCENT_STATS' => sprintf($lang['User_post_pct_stats'], $percentage),

	'SEARCH_IMG' => $search_img,
	'SEARCH' => $search,
	'PM_IMG' => $pm_img,
	'PM' => $pm,
	'EMAIL_IMG' => $email_img,
	'EMAIL' => $email,
	'WWW_IMG' => $www_img,
	'WWW' => $www,
	'FB_IMG' => $fb_img,
	'FB' => $fb,
	'TW_IMG' => $tw_img,
	'TW' => $tw,
	'SKYPE_IMG' => $skype_img,
	'SKYPE' => $skype,
	'STEAM_IMG' => $steam_img,
	'STEAM' => $steam,
	'CELLEDS' => $profiledata['user_cell_celleds'],
// FLAGHACK-start
	'LOCATION' => $location,
// FLAGHACK-end
	'OCCUPATION' => ( $profiledata['user_occ'] ) ? $profiledata['user_occ'] : '&nbsp;',
	'INTERESTS' => ( $profiledata['user_interests'] ) ? $profiledata['user_interests'] : '&nbsp;',
	'BIRTHDAY' => ($profiledata['user_birthday']!=999999) ? $poster_birthday=realdate($lang['DATE_FORMAT'], $profiledata['user_birthday']) : $poster_birthday=$lang['No_birthday_specify'], 
	// Start add - Gender MOD
	'GENDER' => $gender, 
	// End add - Gender MOD
	'AVATAR_IMG' => $avatar_img,

#======================================================================= |
#==== Start: == Advanced Username Color ================================ |
#==== v1.0.5 =========================================================== |
#====
	'L_VIEWING_PROFILE' => sprintf($lang['Viewing_user_profile'], CheckUsernameColor($profiledata['user_color_gc'], $profiledata['username'])), 
#====
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
#==== End: ==== Advanced Username Color ================================ |	
#======================================================================= |
        'L_ABOUT_USER' => sprintf($lang['About_user'], $profiledata['username']),
        'L_AVATAR' => $lang['Avatar'],
        'L_POSTER_RANK' => $lang['Poster_rank'],
        'L_JOINED' => $lang['Joined'],
        'L_TOTAL_POSTS' => $lang['Total_posts'],
        'L_SEARCH_USER_POSTS' => sprintf($lang['Search_user_posts'], $profiledata['username']),
	'L_CONTACT' => $lang['Contact'],
	'L_EMAIL_ADDRESS' => $lang['Email_address'],
	'L_EMAIL' => $lang['Email'],
	'L_PM' => $lang['Private_Message'],
	'L_WEBSITE' => $lang['Website'],
	'L_FB' => $lang['FB'],
	'L_TW' => $lang['TW'],
	'L_SKYPE' => $lang['SKYPE'],
	'L_STEAM' => $lang['STEAM'],
	'L_CELLEDS' => $lang['Celleds_time'],
	'L_LOCATION' => $lang['Location'],
	'L_OCCUPATION' => $lang['Occupation'],
	'L_INTERESTS' => $lang['Interests'],
	'L_BIRTHDAY' => $lang['Birthday'], 
	// Start add - Gender MOD
	'L_GENDER' => $lang['Gender'], 
	// End add - Gender MOD
	'L_ARCADE' => $lang['lib_arcade'],
	'URL_STATS' => '<a class="genmed" href="' . append_sid("statarcade.$phpEx?uid=" . $profiledata['user_id'] ) . '">' . $lang['statuser'] . '</a> ',

	'U_SEARCH_USER' => append_sid("search.$phpEx?search_author=" . $u_search_author),
	'U_CELLEDS' => append_sid("courthouse.$phpEx?from=celleds_list"),

	'S_PROFILE_ACTION' => append_sid("profile.$phpEx"))
);

$template->pparse('body');

include("modules/Forums/includes/page_tail.php");

?>
