<?php
#################################################################
## Mod Title:mycalendar Mod w/selected forum integration
## Mod Version: 2.2.7
## Author: marksten
## Author: mojavelinux <dan@mojavelinux.com>
## Description: Enables users to add events to the calendar
##              through a chosen forum.
#################################################################

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}
if ($popup != "1"){
    $module_name = basename(dirname(__FILE__));
    require("modules/".$module_name."/nukebb.php");
}
else
{
    $phpbb_root_path = 'modules/Forums/';
}

define('IN_PHPBB', true);

include_once $phpbb_root_path . 'extension.inc';
include_once $phpbb_root_path . 'common.'.$phpEx;
include_once 'includes/bbcode.'.$phpEx;

// Start session management
$userdata = session_pagestart($user_ip, PAGE_MYCALENDAR, $nukeuser);
init_userprefs($userdata);

// determine the information for the current date
list($today['year'], $today['month'], $today['day']) = explode('-', create_date('Y-m-d', time(), $board_config['board_timezone']));

// get the month/year offset from the get variables, or else use first day of this month
if (isset($HTTP_GET_VARS['month']) && isset($HTTP_GET_VARS['year'])) {
    $view_isodate = sprintf('%04d', $HTTP_GET_VARS['year']) . '-' . sprintf('%02d', $HTTP_GET_VARS['month']) . '-01 00:00:00';
} 
// get the first day of the month as an isodate
else {
    $view_isodate = $today['year'] . '-' . $today['month'] . '-01 00:00:00';
}

// setup the current view information
$query = "SELECT
             MONTHNAME('$view_isodate') as monthName,
             DATE_FORMAT('$view_isodate', '%m') as month,
             YEAR('$view_isodate') as year,
             DATE_FORMAT(CONCAT(YEAR('$view_isodate'), '-', MONTH('$view_isodate' + INTERVAL 1 MONTH), '-01') - INTERVAL 1 DAY, '%e') as numDays,
             WEEKDAY('$view_isodate') as offset";
$result = $db->sql_query($query);
$monthView = $db->sql_fetchrow($result);
$monthView['monthName'] = $lang['datetime'][$monthView['monthName']];

// [*] is this going to give us a negative number ever?? [*]
if (!$lang['Calendar_start_monday']) {
    $monthView['offset']++;
}

// set the page title and include the page header
$page_title = $lang['View_calendar'];
include ('includes/page_header.'.$phpEx);

$template->set_filenames(array(
    'body' => 'mycalendar_body.tpl')
);

// prepare the loops for running through the calendar for the current month
$numRows = ceil(($monthView['numDays'] + $monthView['offset']) / 7);
$day = 1;
$eventStack = array();
$topicCache = array();
foreach(range(1, $numRows) as $row) {

    $template->assign_block_vars('date_row', array());
    foreach (range(1, 7) as $weekIndex) {
        // we are before the first date
        if ( ($row == 1 && $weekIndex <= $monthView['offset']) ) {
            if ( $weekIndex == 1 ) {
                $template->assign_block_vars('date_row.date_cell', array(
                    'BLANK_COLSPAN' => $monthView['offset'])
                );
                $template->assign_block_vars('date_row.date_cell.switch_blank_cells', array());
            }
        }
        // we are after the last date
        elseif ($day > $monthView['numDays']) {

            if ($day == ($monthView['numDays'] + 1)) {
                $template->assign_block_vars('date_row.date_cell', array(
                    'BLANK_COLSPAN' => ($row * 7) - ($monthView['numDays'] + $monthView['offset']))
                );
                $template->assign_block_vars('date_row.date_cell.switch_blank_cells', array());

                // We have to now increment the day so that we don't repeat this cell
                $day++;
            }
        }
        // we are on a date
        else {
            $template->assign_block_vars('date_row.date_cell', array(
                'TODAY_STYLE' => $today_style, 
                'DATE_CLASS' => ($row % 2) ? 'row2' : 'row3',
                'DATE' => $day)
            );
            $template->assign_block_vars('date_row.date_cell.switch_date_cells', array());

            // allow the template to handle how to treat the day
            if ($today['day'] == $day && $today['month'] == $monthView['month'] && $today['year'] == $monthView['year']) {
                $template->assign_block_vars('date_row.date_cell.switch_date_cells.switch_date_today', array());
            }
            else {
                $template->assign_block_vars('date_row.date_cell.switch_date_cells.switch_date_otherday', array());
            }

            // set the isodate for our current mark in the calendar (padding day appropriately)
            $current_isodate = $monthView['year'] . '-' . $monthView['month'] . '-' . sprintf('%02d', $day) . ' 00:00:00';

            $query = "SELECT
                          c.*,
                          t.topic_title,
                          pt.post_text,
                          pt.bbcode_uid,
                          t.topic_views,
                          t.topic_replies,
                          f.forum_name,
                          f.auth_read,
                          (cal_interval_units = 'DAY' && cal_interval = 1 && '$current_isodate' = INTERVAL (cal_interval * (cal_repeat - 1)) DAY + cal_date) as block_end
                      FROM
                          " . MYCALENDAR_TABLE . " as c,
                          " . TOPICS_TABLE . " as t,
                          " . FORUMS_TABLE . " as f,
                          " . POSTS_TEXT_TABLE . " as pt
                      WHERE
                          c.forum_id = f.forum_id 
                          AND
                          c.topic_id = t.topic_id 
                          AND
                          f.events_forum > 0 
                          AND
                          pt.post_id = t.topic_first_post_id
                          AND
                          '$current_isodate' >= cal_date
                          AND 
                          (
                              # If the repeat is forever just continue here
                              cal_repeat = 0 
                              OR
                              (
                                  # If the repeat is limited, then make sure we are not past the end
                                  cal_repeat > 0 
                                  AND 
                                  (
                                      (cal_interval_units = 'DAY' AND ('$current_isodate' <= INTERVAL (cal_interval * (cal_repeat - 1)) DAY + cal_date))
                                      OR
                                      (cal_interval_units = 'WEEK' AND ('$current_isodate' <= INTERVAL ((cal_interval * (cal_repeat - 1)) * 7) DAY + cal_date))
                                      OR
                                      (cal_interval_units = 'MONTH' AND ('$current_isodate' <= INTERVAL (cal_interval * (cal_repeat - 1)) MONTH + cal_date))
                                      OR
                                      (cal_interval_units = 'YEAR' AND ('$current_isodate' <= INTERVAL (cal_interval * (cal_repeat - 1)) YEAR + cal_date))
                                  )
                              )
                          )
                          AND 
                          (
                              (
                                  cal_interval_units = 'DAY' 
                                  AND 
                                  (TO_DAYS('$current_isodate') - TO_DAYS(cal_date)) % cal_interval = 0
                              ) 
                              OR 
                              (
                                  cal_interval_units = 'WEEK' 
                                  AND
                                  (TO_DAYS('$current_isodate') - TO_DAYS(cal_date)) % (7 * cal_interval) = 0
                              )
                              OR 
                              (
                                  cal_interval_units = 'MONTH' 
                                  AND
                                  DAYOFMONTH(cal_date) = DAYOFMONTH('$current_isodate') 
                                  AND
                                  PERIOD_DIFF(DATE_FORMAT('$current_isodate', '%Y%m'), DATE_FORMAT(cal_date, '%Y%m')) % cal_interval = 0
                              )
                              OR 
                              (
                                  cal_interval_units = 'YEAR' 
                                  AND
                                  DATE_FORMAT(cal_date, '%m%d') = DATE_FORMAT('$current_isodate', '%m%d') 
                                  AND
                                  (YEAR('$current_isodate') - YEAR(cal_date)) % cal_interval = 0
                              )
                          )
                      ORDER BY
                          cal_interval_units ASC,
                          cal_date ASC,
                          cal_repeat DESC";
            if (!$result = $db->sql_query($query)) {
                message_die(GENERAL_ERROR, 'Error querying dates for calendar.');
            }

            $numEvents = 0;
            while ($topic = $db->sql_fetchrow($result)) {

                $is_auth = array();
                $is_auth = auth(AUTH_ALL, $topic['forum_id'], $userdata);
                if ( $is_auth['auth_read'] ) { 
                    $topic_id = $topic['topic_id'];
                    // prepare the first post text if it has not already been cached
                    if (!isset($topicCache[$topic_id])) {
                        $post_text = $topic['post_text'];
                        // if we are spilling over, reduce size...[!] should be configurable [!]
                        if (strlen($post_text) > 200) {
                            $post_text = substr($post_text, 0, 199) . '...';
                        }
                        $post_text = bbencode_second_pass($post_text, $topic['bbcode_uid']);
                        $post_text = smilies_pass($post_text); 
                        $post_text = preg_replace("/[\n\r]{1,2}/", '<br />', $post_text);

                        // prepare the popup text, escaping quotes for javascript
                        $title_text = '<b>' . $lang['Topic'] . ':</b> ' . $topic['topic_title'] . '<br /><b>' . $lang['Forum'] . ':</b> <i>' . $topic['forum_name'] . '</i><br /><b>' . $lang['Views'] . ':</b> ' . $topic['topic_views'] . '<br /><b>' . $lang['Replies'] . ':</b> ' . $topic['topic_replies'];
                        // tack on the interval and repeat if this is a repeated event
                        if ($topic['cal_repeat'] != 1) {
                            $title_text .= '<br /><b>' . $lang['Calendar_interval'] . ':</b> ' . $topic['cal_interval'] . ' ' . (($topic['cal_interval'] == 1) ? $lang['interval'][strtolower($topic['cal_interval_units'])] : $lang['interval'][strtolower($topic['cal_interval_units']) . 's']). '<br /><b>' . $lang['Calendar_repeat'] . ':</b> ' . ($topic['cal_repeat'] ? $topic['cal_repeat'] . 'x' : 'always');
                        }

                        $title_text .= '<br />' . $post_text;
                        $title_text = str_replace('\'', '\\\'', htmlspecialchars($title_text));
                        // make the url for the topic
                        $topic_url = append_sid('viewtopic.' . $phpEx . '?' . POST_TOPIC_URL . '=' . $topic_id);
                        $topicCache[$topic_id] = array(
                            'first_post' => $title_text,
                            'topic_url'  => $topic_url,
                        );
                    }

                    // if we have a block event running (interval = 1 day) with this topic ID, then output our line
                    if (isset($eventStack[$topic_id])) {
                        $first_date = '';
                        if ($topic['block_end']) {
                            $arrowEnd = '<img src="' . $images['event_block_end'] . '" border="0" height="12" width="12" />';
                        }
                        else {
                            $arrowEnd = '<img src="' . $images['event_block_arrow'] . '" border="0" height="12" width="12" />';
                        }
                        $topic_text = '<div style="background: url(' . $images['event_block_bar'] . ') repeat-x center center; text-align: right;">' . $arrowEnd . '</div>';
                        // we have to determine if we are in the right row...which is the value
                        // in the eventStack array
                        $offset = $eventStack[$topic_id] - $numEvents;
                        // if this block was running in a position other than the first, we need
                        // to correct the offset so the line keeps running along the same axis..
                        // even though the upper block has stopped.  We are going to get a 
                        // cascading effect from this until all overlapping block events stop
                        if ($offset > 0) {
                            foreach (range(1, $offset) as $offsetCount) {
                                $template->assign_block_vars('date_row.date_cell.switch_date_cells.date_event', array(
                                    'U_EVENT' => '<br />')
                                );
                                
                            }
                        }
                    }
                    // this is either a single day event or the start of a new block event
                    else {
                        $first_date = '<span style="line-height: 16px; font-size: 16px; font-weight: bolder; vertical-align: middle;">&middot;</span> ';
                        $topic_text = strlen($topic['topic_title']) > 18 ? substr($topic['topic_title'], 0, 17) . '...' : $topic['topic_title'];
                    }

                    $template->assign_block_vars('date_row.date_cell.switch_date_cells.date_event', array(
                        'U_EVENT' => "$first_date<a href=\"" . $topicCache[$topic_id]['topic_url'] . "\" onmouseover=\"domTT_activate(event, 'content', '" . $topicCache[$topic_id]['first_post'] . "');\" class=\"gensmall\">$topic_text</a>")
                    );
                    $numEvents++;

                    // Here I use a stack of sorts to keep track of block events which are
                    // still running...I sort the block start dates by date, so the overlaps
                    // will always appear in the same order...if a block ends while a lower block
                    // continues, I keep a place holder so that the line continues along the same
                    // path

                    // we are at the end of a block event
                    if ($topic['block_end']) {
                        unset($eventStack[$topic_id]);
                    }
                    // we place an entry in the event stack, key as the topic, value as the row
                    // number the event should fall in, for visual block events (interval = 1 day)
                    elseif (!isset($eventStack[$topic_id]) && $topic['cal_interval_units'] == 'DAY' && $topic['cal_interval'] == 1) {
                        $eventStack[$topic_id] = empty($eventStack) ? 0 : sizeof($eventStack);
                    }
                }
            }

            // Increment the day
            $day++;
        }
    }
}

if ($monthView['month'] == '12') {
    $nextmonth = 1;
    $nextyear = $monthView['year'] + 1; 
} 
else {
    $nextmonth = sprintf('%02d', $monthView['month'] + 1);
    $nextyear = $monthView['year'];
}

if ($monthView['month'] == '01') {
    $previousmonth = '12';
    $previousyear = $monthView['year'] - 1;
} 
else {
    $previousmonth = sprintf('%02d', $monthView['month'] - 1); 
    $previousyear = $monthView['year'];
}

// prepare images and links for month navigation
$image_prev_month = "<img src=\"" . $images['icon_left_arrow'] . "\" align=\"middle\" border=\"0\" title=\"{$lang['View_previous_month']}\" alt=\"" . $lang['View_previous_month'] . "\" />";
$image_next_month = "<img src=\"" . $images['icon_right_arrow'] . "\" align=\"middle\" border=\"0\" title=\"{$lang['View_next_month']}\" alt=\"" . $lang['View_next_month'] . "\" />";
$url_prev_month = append_sid('mycalendar.' . $phpEx . "?month=$previousmonth&amp;year=$previousyear");
$url_next_month = append_sid('mycalendar.' . $phpEx . "?month=$nextmonth&amp;year=$nextyear");

$image_prev_year = "<img src=\"" . $images['icon_double_left_arrow'] . "\" align=\"middle\" border=\"0\" title=\"{$lang['View_previous_year']}\" alt=\"" . $lang['View_previous_year'] . "\" />";
$image_next_year = "<img src=\"" . $images['icon_double_right_arrow'] . "\" align=\"middle\" border=\"0\" title=\"{$lang['View_next_year']}\" alt=\"" . $lang['View_next_year'] . "\" />";
$url_prev_year = append_sid('mycalendar.' . $phpEx . '?month=' . $monthView['month'] . '&amp;year=' . ($monthView['year'] - 1));
$url_next_year = append_sid('mycalendar.' . $phpEx . '?month=' . $monthView['month'] . '&amp;year=' . ($monthView['year'] + 1));

if ($lang['Calendar_start_monday']) {
    $template->assign_block_vars('switch_sunday_end', array());
}
else {
    $template->assign_block_vars('switch_sunday_beginning', array());
}
$template->assign_vars(array(
    'L_SUNDAY' => $lang['datetime']['Sunday'],
    'L_MONDAY' => $lang['datetime']['Monday'],
    'L_TUESDAY' => $lang['datetime']['Tuesday'],
    'L_WEDNESDAY' => $lang['datetime']['Wednesday'],
    'L_THURSDAY' => $lang['datetime']['Thursday'],
    'L_FRIDAY' => $lang['datetime']['Friday'],
    'L_SATURDAY' => $lang['datetime']['Saturday'],
    'L_CURRENT_MONTH' => $monthView['monthName'],
    'L_CURRENT_YEAR' => $monthView['year'],
    'I_PREV_MONTH' => $image_prev_month,
    'I_NEXT_MONTH' => $image_next_month,
    'U_PREV_MONTH' => $url_prev_month,
    'U_NEXT_MONTH' => $url_next_month,
    'I_PREV_YEAR'  => $image_prev_year,
    'I_NEXT_YEAR'  => $image_next_year,
    'U_PREV_YEAR'  => $url_prev_year,
    'U_NEXT_YEAR'  => $url_next_year,
    )
);

$template->pparse('body');
 
include('includes/page_tail.'.$phpEx);
?>
