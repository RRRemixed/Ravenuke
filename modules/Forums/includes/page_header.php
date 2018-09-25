<?php
/***************************************************************************
 *                              page_header.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: page_header.php,v 1.106.2.25 2005/10/30 15:17:14 acydburn Exp $
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

if (!defined('IN_PHPBB'))
{
   die("Hacking attempt");
}
define('HEADER_INC', TRUE);

global $name, $sitename, $is_inline_review, $prefix, $db;

$sql = "SELECT custom_title from ".$prefix."_modules where title='$name'";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
if ($row['custom_title'] == "") {
    $mod_name = ereg_replace("_", " ", $name);
} else {
    $mod_name = $row['custom_title'];
}
if (!$is_inline_review & $mod_name != "Private Messages") {
    title("$sitename: $mod_name");
}
OpenTable();

//
// gzip_compression
//
$do_gzip_compress = FALSE;
if ($board_config['gzip_compress'])
{
    $phpver = phpversion();

    $useragent = (isset($HTTP_SERVER_VARS['HTTP_USER_AGENT'])) ? $HTTP_SERVER_VARS['HTTP_USER_AGENT'] : getenv('HTTP_USER_AGENT');

    if ($phpver >= '4.0.4pl1' && (strstr($useragent,'compatible') || strstr($useragent,'Gecko')))
    {
        if (extension_loaded('zlib'))
        {
            ob_start('ob_gzhandler');
        }
    }
    else if ($phpver > '4.0')
    {
    if (strstr($HTTP_SERVER_VARS['HTTP_ACCEPT_ENCODING'], 'gzip'))
        {
            if (extension_loaded('zlib'))
            {
                $do_gzip_compress = TRUE;
                ob_start();
                ob_implicit_flush(0);

                header('Content-Encoding: gzip');
            }
        }
    }
}

//
// Parse and show the overall header.
//
$template->set_filenames(array(
    'overall_header' => ( empty($gen_simple_header) ) ? 'overall_header.tpl' : 'simple_header.tpl')
);

//
// Generate logged in/logged out status
//
if ($userdata['session_logged_in'])
{
    $u_login_logout = 'modules.php?name=Your_Account&amp;op=logout&amp;redirect=Forums';
    $l_login_logout = $lang['Logout'] . ' [ ' . $userdata['username'] . ' ]';
}
else
{
    $u_login_logout = 'modules.php?name=Your_Account&amp;redirect=index';
    $l_login_logout = $lang['Login'];
}

$s_last_visit = ($userdata['session_logged_in']) ? create_date($board_config['default_dateformat'], $userdata['user_lastvisit'], $board_config['board_timezone']) : '';

//
// Get basic (usernames + totals) online
// situation
//
$logged_visible_online = 0;
$logged_hidden_online = 0;
$guests_online = 0;
$online_userlist = '';
$l_online_users = '';
if (defined('SHOW_ONLINE'))
{

    $user_forum_sql = ( !empty($forum_id) ) ? "AND s.session_page = " . intval($forum_id) : '';
    $sql = "SELECT u.username, u.user_color_gc, u.user_id, u.user_allow_viewonline, u.user_level, s.session_logged_in, s.session_ip
            FROM ".USERS_TABLE." u, ".SESSIONS_TABLE." s
            WHERE u.user_id = s.session_user_id
            AND s.session_time >= ".( time() - 300 ) . "
                $user_forum_sql
            ORDER BY u.username ASC, s.session_ip ASC";
        if(!($result = $db->sql_query($sql)))
        {
            message_die(GENERAL_ERROR, 'Could not obtain user/online information', '', __LINE__, __FILE__, $sql);
        }

        $userlist_ary = array();
        $userlist_visible = array();

        $prev_user_id = 0;
        $prev_user_ip = $prev_session_ip = '';

        while($row = $db->sql_fetchrow($result))
        {
        // User is logged in and therefor not a guest
        if ($row['session_logged_in'])
            {
                // Skip multiple sessions for one user
                if ($row['user_id'] != $prev_user_id)
                {
                    $style_color = '';
                    if ($row['user_level'] == ADMIN)
                {
                    $row['username'] = '<b>' . $row['username'] . '</b>';
                    $style_color = 'style="color:#' . $theme['fontcolor3'] . '"';
                }
                else if ($row['user_level'] == MOD)
                {
                    $row['username'] = '<b>' . $row['username'] . '</b>';
                    $style_color = 'style="color:#' . $theme['fontcolor2'] . '"';
                }
				$row['username'] = CheckUsernameColor($row['user_color_gc'], $row['username']);

                if ($row['user_allow_viewonline'])
                {
                    $user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '" ' . $style_color .'>' . $row['username'] . '</a>';
                    $logged_visible_online++;
                }
                else
                {
                    $user_online_link = '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $row['user_id']) . '" ' . $style_color .'><i>' . $row['username'] . '</i></a>';
                    $logged_hidden_online++;
                }

                if ($row['user_allow_viewonline'] || $userdata['user_level'] == ADMIN || $userdata['user_level'] == MOD)
                {
                    $online_userlist .= ( $online_userlist != '' ) ? ', ' . $user_online_link : $user_online_link;
                }
            }

            $prev_user_id = $row['user_id'];
            }
            else
            {
                // Skip multiple sessions for one user
                if ($row['session_ip'] != $prev_session_ip)
                {
                    $guests_online++;
                }
            }

            $prev_session_ip = $row['session_ip'];
        }

        if (empty($online_userlist))
        {
            $online_userlist = $lang['None'];
        }
        $online_userlist = ((isset($forum_id)) ? $lang['Browsing_forum'] : $lang['Registered_users']) . ' ' . $online_userlist;

        $total_online_users = $logged_visible_online + $logged_hidden_online + $guests_online;

        if ($total_online_users > $board_config['record_online_users'])
        {
            $board_config['record_online_users'] = $total_online_users;
            $board_config['record_online_date'] = time();

            $sql = "UPDATE " . CONFIG_TABLE . "
                    SET config_value = '$total_online_users'
                    WHERE config_name = 'record_online_users'";
            if (!$db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, 'Could not update online user record (nr of users)', '', __LINE__, __FILE__, $sql);
            }

            $sql = "UPDATE " . CONFIG_TABLE . "
                    SET config_value = '" . $board_config['record_online_date'] . "'
                    WHERE config_name = 'record_online_date'";
            if (!$db->sql_query($sql))
            {
                message_die(GENERAL_ERROR, 'Could not update online user record (date)', '', __LINE__, __FILE__, $sql);
            }
        }

        if ($total_online_users == 0)
        {
            $l_t_user_s = $lang['Online_users_zero_total'];
        }
        else if ($total_online_users == 1)
        {
            $l_t_user_s = $lang['Online_user_total'];
        }
        else
        {
            $l_t_user_s = $lang['Online_users_total'];
        }

        if ($logged_visible_online == 0)
        {
            $l_r_user_s = $lang['Reg_users_zero_total'];
        }
        else if ($logged_visible_online == 1)
        {
            $l_r_user_s = $lang['Reg_user_total'];
        }
        else
        {
            $l_r_user_s = $lang['Reg_users_total'];
        }

        if ($logged_hidden_online == 0)
        {
            $l_h_user_s = $lang['Hidden_users_zero_total'];
        }
        else if ($logged_hidden_online == 1)
        {
            $l_h_user_s = $lang['Hidden_user_total'];
        }
        else
        {
            $l_h_user_s = $lang['Hidden_users_total'];
        }

        if ($guests_online == 0)
        {
            $l_g_user_s = $lang['Guest_users_zero_total'];
        }
        else if ($guests_online == 1)
        {
            $l_g_user_s = $lang['Guest_user_total'];
        }
        else
        {
            $l_g_user_s = $lang['Guest_users_total'];
        }

    $l_online_users = sprintf($l_t_user_s, $total_online_users);
    $l_online_users .= sprintf($l_r_user_s, $logged_visible_online);
    $l_online_users .= sprintf($l_h_user_s, $logged_hidden_online);
    $l_online_users .= sprintf($l_g_user_s, $guests_online);
}

$year=create_date('Y', time(), $board_config['board_timezone']); 

//
// Obtain number of new private messages
// if user is logged in
//
if (($userdata['session_logged_in']) && (empty($gen_simple_header)))
{
      // see if user has or have had birthday, also see if greeting are enabled 
	$year=create_date('Y', time(), $board_config['default_timezone']);
	if ($userdata['user_birthday']!=999999 && $board_config['birthday_greeting'] && create_date('Ymd', time(), $board_config['default_timezone']) >= $userdata['user_next_birthday_greeting'].realdate ('md',$userdata['user_birthday'])) 
    { 
        $sql = "UPDATE " . USERS_TABLE . " 
                SET user_next_birthday_greeting = " . ($year+1) . " 
                WHERE user_id = " . $userdata['user_id'];
        if(!$status = $db->sql_query($sql)) 
        { 
            message_die(GENERAL_ERROR, "Could not update next_birthday_greeting for user.", "", __LINE__, __FILE__, $sql); 
        } 
		$db->sql_freeresult($status);
        $greeting_flag=1; 
        } else $greeting_flag=0;//Sorry user shall not have a greeting this year
            if ($userdata['user_new_privmsg'])
            {
                $l_message_new = ($userdata['user_new_privmsg'] == 1) ? $lang['New_pm'] : $lang['New_pms'];
                $l_privmsgs_text = sprintf($l_message_new, $userdata['user_new_privmsg']);

                    if ($userdata['user_last_privmsg'] > $userdata['user_lastvisit'])
                    {
                        $sql = "UPDATE " . USERS_TABLE . "
                                SET user_last_privmsg = " . $userdata['user_lastvisit'] . "
                                WHERE user_id = " . $userdata['user_id'];
                        if (!$db->sql_query($sql))
                        {
                            message_die(GENERAL_ERROR, 'Could not update private message new/read time for user', '', __LINE__, __FILE__, $sql);
                        }

                $s_privmsg_new = 1;
                $icon_pm = $images['pm_new_msg'];
            }
            else
            {
                $s_privmsg_new = 0;
                $icon_pm = $images['pm_new_msg'];
            }
        }
        else
        {
            $l_privmsgs_text = $lang['No_new_pm'];

            $s_privmsg_new = 0;
            $icon_pm = $images['pm_no_new_msg'];
        }

        if ($userdata['user_unread_privmsg'])
        {
            $l_message_unread = ($userdata['user_unread_privmsg'] == 1) ? $lang['Unread_pm'] : $lang['Unread_pms'];
            $l_privmsgs_text_unread = sprintf($l_message_unread, $userdata['user_unread_privmsg']);
        }
        else
        {
            $l_privmsgs_text_unread = $lang['No_unread_pm'];
        }
    }
    else
    {
    $icon_pm = $images['pm_no_new_msg'];
    $l_privmsgs_text = $lang['Login_check_pm'];
    $l_privmsgs_text_unread = '';
    $s_privmsg_new = 0;
}

//
// Generate HTML required for Mozilla Navigation bar
//
if (!isset($nav_links))
{
    $nav_links = array();
}

$nav_links_html = '';
$nav_link_proto = '<link rel="%s" href="%s" title="%s" />' . "\n";
while (list($nav_item, $nav_array) = @each($nav_links))
{
    if (!empty($nav_array['url']))
    {
        $nav_links_html .= sprintf($nav_link_proto, $nav_item, append_sid($nav_array['url']), $nav_array['title']);
    }
    else
    {
        // We have a nested array, used for items like <link rel='chapter'> that can occur more than once.
        while(list(,$nested_array) = each($nav_array))
        {
            $nav_links_html .= sprintf($nav_link_proto, $nav_item, $nested_array['url'], $nested_array['title']);
        }
    }
}

// Format Timezone. We are unable to use array_pop here, because of PHP3 compatibility
$l_timezone = explode('.', $board_config['board_timezone']);
$l_timezone = (count($l_timezone) > 1 && $l_timezone[count($l_timezone)-1] != 0) ? $lang[sprintf('%.1f', $board_config['board_timezone'])] : $lang[number_format($board_config['board_timezone'])];

#======================================================================= |
#==== Start: == Advanced Username Color ================================ |
#==== v1.0.5 =========================================================== |
#====
	define('COLORS', $prefix .'_bbadvanced_username_color');
	$q = "SELECT *
		  FROM ". COLORS ."
		  WHERE group_id > '0'
		  ORDER BY group_weight ASC";
	$r			= $db->sql_query($q);
	$coloring	= $db->sql_fetchrowset($r);
	
	for ($a = 0; $a < count($coloring); $a++)
		{
		if ($coloring[$a]['group_id'])
			{
		    $template->assign_block_vars('colors', array(
			    'GROUPS'	=> '&nbsp;[&nbsp;<a href="'. append_sid('auc_listing.'. $phpEx .'?id='. $coloring[$a]['group_id']) .'"><span class="genmed" style="color:#'. $coloring[$a]['group_color'] .'">'. $coloring[$a]['group_name'] .'</span></a>&nbsp;]&nbsp;')
		    );
			}
		else
			break;
		}
#======================================================================= |
#==== Author: aUsTiN [austin@phpbb-amod.com] [http://phpbb-tweaks.com] = |
#==== End: ==== Advanced Username Color ================================ |	
#======================================================================= |

// Start add - Complete banner MOD
$time_now=time();
$hour_now=create_date('Hi',$time_now,$board_config['board_timezone']);
$date_now=create_date('Ymd',$time_now,$board_config['board_timezone']);
$week_now=create_date('w',$time_now,$board_config['board_timezone']);
$sql_level= ($userdata['user_id']==ANONYMOUS) ? ANONYMOUS : (($userdata['user_level']==ADMIN) ? MOD : (($userdata['user_level']==MOD) ? ADMIN : $userdata['user_level'])); 
$sql = "SELECT DISTINCT banner_id, banner_name, banner_spot, banner_description, banner_forum, banner_type, banner_width, banner_height, banner_filter FROM ".BANNERS_TABLE ."
		WHERE banner_active
		AND IF(banner_level_type,IF(banner_level_type=1,".intval($sql_level)."<=banner_level,IF(banner_level_type=2,".intval($sql_level).">=banner_level,".intval($sql_level)."<>banner_level)),banner_level=".intval($sql_level).")
		AND (banner_timetype=0 
		OR (( $hour_now BETWEEN time_begin AND time_end) AND ((banner_timetype=2
		OR (( $week_now BETWEEN date_begin AND date_end) AND banner_timetype=4)
		OR (( $date_now BETWEEN date_begin AND date_end) AND banner_timetype=6)
		)))) ORDER BY banner_spot,banner_weigth*SUBSTRING(RAND(),6,2) DESC";
if (!($result = $db->sql_query($sql)))
{
	message_die(GENERAL_ERROR, "Couldn't get banners data", "", __LINE__, __FILE__, $sql);
} 
$banners = array();
$i=0;
while ($banners[$i] = $db->sql_fetchrow($result))
{
	$cookie_name = $board_config['cookie_name'] . '_b_' . $banners[$i]['banner_id'];
	if (!($HTTP_COOKIE_VARS[$cookie_name] && $banners[$i]['banner_filter']))
	{
		$banner_spot=$banners[$i]['banner_spot'];
		if ($banner_spot<>$last_spot  AND ($banners[$i]['banner_forum']==$forum_id || empty($banners[$i]['banner_forum'])))
		{
			$banner_size = ($banners[$i]['banner_width'] && $banners[$i]['banner_height']) ? '"width="'.$banners[$i]['banner_width'].'" height="'.$banners[$i]['banner_height'].'"' : '';
			switch ($banners[$i]['banner_type'])
			{
				case 6 :
					// swf file
					$template->assign_vars(array('BANNER_'.$banner_spot.'_IMG' => '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,23,0" id=macromedia '.$banner_size.' align="abscenter"><param name=movie value="'.$banners[$i]['banner_name'].'"><param name=quality value=high><embed src="'.$banners[$i]['banner_name'].'" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" autostart="true" /><noembed><a href="modules.php?name=Forums&amp;file=redirect&amp;banner_id='.$banners[$i]['banner_id'].'" target="_blank">'.$banners[$i]['banner_description'].'</a></noembed></object>')); 
					break;
				case 4 :
					// custom code
					$template->assign_var('BANNER_'.$banner_spot.'_IMG', $banners[$i]['banner_name']);
					break;
				case 2 :
					// Text link
					$banner_example = '<a href="modules.php?name=Forums&amp;file=redirect&amp;banner_id='.$banners[$i]['banner_id'].'" target="_blank">'.$banners[$i]['banner_name'].'</a>';
					break;
				case 0 :
				default: 
					$template->assign_var('BANNER_'.$banner_spot.'_IMG', '<a href="modules.php?name=Forums&amp;file=redirect&amp;banner_id='.$banners[$i]['banner_id'].'" target="_blank"><img src="'.$banners[$i]['banner_name'].'" '.$banner_size.' border="0" alt="'.$banners[$i]['banner_description'].'" title="'.$banners[$i]['banner_description'].'" /></a>');
			}
			$banner_show_list.= ', '.$banners[$i]['banner_id'];
		}
		$last_spot = ($banners[$i]['banner_forum']==$forum_id || empty($banners[$i]['banner_forum'])) ? $banner_spot : $last_spot;
	}
	$i++;
}
// End add - Complete banner MOD

//
// The following assigns all _common_ variables that may be used at any point
// in a template.
//
$template->assign_vars(array(
    'SITENAME' => $board_config['sitename'],
    'SITE_DESCRIPTION' => $board_config['site_desc'],
    'PAGE_TITLE' => $page_title,
    'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
    'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], time(), $board_config['board_timezone'])),
    'TOTAL_USERS_ONLINE' => $l_online_users,
    'LOGGED_IN_USER_LIST' => $online_userlist,
    'RECORD_USERS' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
    'PRIVATE_MESSAGE_INFO' => $l_privmsgs_text,
    'PRIVATE_MESSAGE_INFO_UNREAD' => $l_privmsgs_text_unread,
    'PRIVATE_MESSAGE_NEW_FLAG' => $s_privmsg_new,
    'GREETING_FLAG' => $greeting_flag, 

    'PRIVMSG_IMG' => $icon_pm,

	'I_COURTHOUSE' => $images['icon_mini_justice'],

    'L_USERNAME' => $lang['Username'],
    'L_PASSWORD' => $lang['Password'],
    'L_LOGIN_LOGOUT' => $l_login_logout,
    'L_LOGIN' => $lang['Login'],
    'L_LOG_ME_IN' => $lang['Log_me_in'],
    'L_AUTO_LOGIN' => $lang['Log_me_in'],
    'L_INDEX' => sprintf($lang['Forum_Index'], $board_config['sitename']),
    'L_REGISTER' => $lang['Register'],
    'L_PROFILE' => $lang['Profile'],
    'L_SEARCH' => $lang['Search'],
    'L_PRIVATEMSGS' => $lang['Private_Messages'],
    'L_WHO_IS_ONLINE' => $lang['Who_is_Online'],
    'L_MEMBERLIST' => $lang['Memberlist'],
	'L_COURTHOUSE' => $lang['Cell_courthouse'],
    'L_FAQ' => $lang['FAQ'],
    'L_CALENDAR' => $lang['View_calendar'],
	'L_LOTTERY' => $lang['lottery'],
    'L_USERGROUPS' => $lang['Usergroups'],
    'L_SEARCH_NEW' => $lang['Search_new'],
    'L_SEARCH_UNANSWERED' => $lang['Search_unanswered'],
	'L_SEARCH_DAILY' => $lang['Search_daily'],
    'L_SEARCH_SELF' => $lang['Search_your_posts'],
    'L_WHOSONLINE_ADMIN' => sprintf($lang['Admin_online_color'], '<span style="color:#' . $theme['fontcolor3'] . '">', '</span>'),
    'L_WHOSONLINE_MOD' => sprintf($lang['Mod_online_color'], '<span style="color:#' . $theme['fontcolor2'] . '">', '</span>'),

    'U_SEARCH_UNANSWERED' => append_sid('search.'.$phpEx.'?search_id=unanswered'),
	'U_SEARCH_DAILY' => append_sid('getdaily.'.$phpEx),
    'U_SEARCH_SELF' => append_sid('search.'.$phpEx.'?search_id=egosearch'),
    'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=newposts'),
    'U_INDEX' => append_sid('index.'.$phpEx),
    'U_REGISTER' => append_sid('profile.'.$phpEx.'?mode=register'),
    'U_PROFILE' => append_sid('profile.'.$phpEx.'?mode=editprofile'),
    'U_PRIVATEMSGS' => append_sid('privmsg.'.$phpEx.'?folder=inbox'),
    'U_PRIVATEMSGS_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=newpm&popup=1',true),
    'U_GREETING_POPUP' => append_sid('privmsg.'.$phpEx.'?mode=birthday'),
    'U_SEARCH' => append_sid('search.'.$phpEx),
	'U_CALENDAR' => append_sid('mycalendar.'.$phpEx),
    'U_MEMBERLIST' => append_sid('memberlist.'.$phpEx),
	'U_COURTHOUSE' => append_sid('courthouse.'.$phpEx),
    'U_MODCP' => append_sid('modcp.'.$phpEx),
    'U_FAQ' => append_sid('faq.'.$phpEx),
	'U_LOTTERY' => append_sid('lottery.'.$phpEx),
    'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
    'U_LOGIN_LOGOUT' => append_sid($u_login_logout),
    'U_MEMBERSLIST' => append_sid('memberlist.'.$phpEx),
    'U_GROUP_CP' => append_sid('groupcp.'.$phpEx),
    'U_STAFF' => append_sid('staff.'.$phpEx),
	'L_STAFF' => $lang['Staff'],


    'S_CONTENT_DIRECTION' => $lang['DIRECTION'],
    'S_CONTENT_ENCODING' => $lang['ENCODING'],
    'S_CONTENT_DIR_LEFT' => $lang['LEFT'],
    'S_CONTENT_DIR_RIGHT' => $lang['RIGHT'],
    'S_TIMEZONE' => sprintf($lang['All_times'], $l_timezone),
    'S_LOGIN_ACTION' => append_sid('login.'.$phpEx),

    'T_HEAD_STYLESHEET' => $theme['head_stylesheet'],
    /*
    'T_BODY_BACKGROUND' => $theme['body_background'],
    'T_BODY_BGCOLOR' => '#'.$theme['body_bgcolor'],
    'T_BODY_TEXT' => '#'.$theme['body_text'],
    'T_BODY_LINK' => '#'.$theme['body_link'],
    'T_BODY_VLINK' => '#'.$theme['body_vlink'],
    'T_BODY_ALINK' => '#'.$theme['body_alink'],
    'T_BODY_HLINK' => '#'.$theme['body_hlink'],
    */
    'T_TR_COLOR1' => '#'.$theme['tr_color1'],
    'T_TR_COLOR2' => '#'.$theme['tr_color2'],
    'T_TR_COLOR3' => '#'.$theme['tr_color3'],
    'T_TR_CLASS1' => $theme['tr_class1'],
    'T_TR_CLASS2' => $theme['tr_class2'],
    'T_TR_CLASS3' => $theme['tr_class3'],
    'T_TH_COLOR1' => '#'.$theme['th_color1'],
    'T_TH_COLOR2' => '#'.$theme['th_color2'],
    'T_TH_COLOR3' => '#'.$theme['th_color3'],
    'T_TH_CLASS1' => $theme['th_class1'],
    'T_TH_CLASS2' => $theme['th_class2'],
    'T_TH_CLASS3' => $theme['th_class3'],
    'T_TD_COLOR1' => '#'.$theme['td_color1'],
    'T_TD_COLOR2' => '#'.$theme['td_color2'],
    'T_TD_COLOR3' => '#'.$theme['td_color3'],
    'T_TD_CLASS1' => $theme['td_class1'],
    'T_TD_CLASS2' => $theme['td_class2'],
    'T_TD_CLASS3' => $theme['td_class3'],
    'T_FONTFACE1' => $theme['fontface1'],
    'T_FONTFACE2' => $theme['fontface2'],
    'T_FONTFACE3' => $theme['fontface3'],
    'T_FONTSIZE1' => $theme['fontsize1'],
    'T_FONTSIZE2' => $theme['fontsize2'],
    'T_FONTSIZE3' => $theme['fontsize3'],
    'T_FONTCOLOR1' => '#'.$theme['fontcolor1'],
    'T_FONTCOLOR2' => '#'.$theme['fontcolor2'],
    'T_FONTCOLOR3' => '#'.$theme['fontcolor3'],
    'T_SPAN_CLASS1' => $theme['span_class1'],
    'T_SPAN_CLASS2' => $theme['span_class2'],
    'T_SPAN_CLASS3' => $theme['span_class3'],

    'NAV_LINKS' => $nav_links_html)
);

//
// Login box?
//
if (!$userdata['session_logged_in'])
{
    $template->assign_block_vars('switch_user_logged_out', array());
    //
    // Allow autologin?
    //
    if (!isset($board_config['allow_autologin']) || $board_config['allow_autologin'])
    {
        $template->assign_block_vars('switch_allow_autologin', array());
        $template->assign_block_vars('switch_user_logged_out.switch_allow_autologin', array());
    }
}
else
{
    $template->assign_block_vars('switch_user_logged_in', array());

    if (!empty($userdata['user_popup_pm']))
    {
        $template->assign_block_vars('switch_enable_pm_popup', array());
    }
    if(date('Y') == $userdata['user_next_birthday_greeting'])
        $template->assign_block_vars('switch_enable_greeting_popup', array());
}

// Add no-cache control for cookies if they are set
//$c_no_cache = (isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_sid']) || isset($HTTP_COOKIE_VARS[$board_config['cookie_name'] . '_data'])) ? 'no-cache="set-cookie", ' : '';

// Work around for "current" Apache 2 + PHP module which seems to not
// cope with private cache control setting
if (!empty($HTTP_SERVER_VARS['SERVER_SOFTWARE']) && strstr($HTTP_SERVER_VARS['SERVER_SOFTWARE'], 'Apache/2'))
{
    header ('Cache-Control: no-cache, pre-check=0, post-check=0');
}
else
{
    header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
}
header ('Expires: 0');
header ('Pragma: no-cache');

if ($userdata['user_cell_time'] > 0 && !defined('CELL') && $userdata['session_logged_in'] && $userdata['user_level'] != ADMIN && $userdata['user_cell_punishment'] == 1)
{
    $header_location = (@preg_match("/Microsoft|WebSTAR|Xitami/", $_SERVER["SERVER_SOFTWARE"])) ? "Refresh: 0; URL=" : "Location: ";
    header($header_location . append_sid("cell.$phpEx", true));
    exit;
}

$template->pparse('overall_header');

?>
