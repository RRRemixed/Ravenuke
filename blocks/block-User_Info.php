<?php
/************************************************************************/
/* Heavily Modified by Gaylen Fraley (aka Raven)                        */
/* Support and Only Authorized Download Site: http://www.ravenphpscripts.com*/
/* Version: 2.2.3                                                       */
/* Change History: See File CHANGES                                     */
/* (C) 2002-2009 RavenWebServices                                       */
/* All rights beyond the GPL are reserved                               */
/*                                                                      */
/* Please give a link back to my site somewhere in your own             */
/************************************************************************/
/* 2.2.5                                                                */
/* Result of Mantis issue # 0001460: DNSStuff IP look ups no longer FREE*/
/*   with current link structure. Just a tweak to the $whoisServerString*/
/*   from www.dnsstuff.com/tools/whois.ch/?ip=                          */
/*   to   www.dnsstuff.com/tools/whois/?ip=                             */
/*   Credit Warren-The-Ape & SexyCoder                                  */
/*   http://www.ravenphpscripts.com/postx17793-0-0.html                 */
/* Version number changed  _rnSIB_VERSION_ 2.2.5                        */
/* 2.2.4                                                                */
/* Result of Mantis issue # 0001223: UserInfoAddOns Delete user link    */
/*   throws blank page                                                  */
/* Version number changed  _rnSIB_VERSION_ 2.2.4                        */
/* Removed the module UserInfoAddons  which only this block was using   */
/* Incorporated new logic to use DHTML to display New Today/Yesterday   */
/*   drop down display                                                  */
/* Dropped the Delete User functionality as RNYA should be used         */
/* Added the send email functionality to the User Name link             */
/* Dropped the display of the Date Added as you now know that when you  */
/*   click on the link                                                  */
/* 2.2.3                                                                */
/* Version number changed                                               */
/* Dropped all references to $patchLevelGE30                            */
/* Fixed Mantis issue 0001176: Site Info Block - Latest Member name not */
/*   showing if just logged in as admin and not user                    */
/* Added define('_rnSIB_VERSION_','2.2.3');  for potential future use   */
/*   (rnSIB stands for RavenNuke Site Info Block                        */
/* 2.2.2                                                                */
/* Tweaked $whoisServerString to www.dnsstuff.com from dnsstuff.com     */
/* Corrected $patchLevelGE29 to $patchLevelGE30 - reported by Montego   */
/* Added Captcha code to RavenNuke v2.10.00                             */
/* Added $nameMaxLength check to $lastusername - reported by Hitwalker  */
/* Fixed errant / that appeared at the bottom of the block by Guest's   */
/* Made fully XHTML Compliant                                           */
/* Changed all $user_prefix to $prefix                                  */
/* 2.2.1  (2.2.0 was Internal)                                          */
/*  Released:3/12/2006                                                  */
/*  Because new features have been added version is changed from 2.1.2  */
/*  Added formatting to numeric fields                                  */
/*  Added code to allow for DST in date calculations.                   */
/*  Fixed bug in $nameMaxLength logic as reported by Darrel3831 in      */
/*    http://www.ravenphpscripts.com/postt7246.html                     */
/*  Added $showHidden setting to allow/notAllow viewing of Hidden member*/
/*    totals to everyone.  Setting this to TRUE will only allow admins  */
/*    to see the counts.  Setting this to FALSE will allow all to see it*/
/* 2.1.2                                                                */
/*  Modified block to not show Anonymous users anything except Login and*/
/*    Register links.                                                   */
/* 2.1.0:                                                               */
/*  Because of all the changes since v2.0, I bumped the version to 2.1.0*/
/*  Modified code to always show the IP of who's visiting.              */
/*  Added title property for the admin to show IP when mouseing over the*/
/*    index number of the people online now.                            */
/*  Modified the member online number to not include hidden when logged */
/*    in as admin.  Hidden should be a separate total.                  */
/*  Fixed the bug that was dropping the first guest IP from the list.   */
/************************************************************************/

/*********************************************************************************************************/
/* Setup - Use these settings to control how some of the user info block displays to users/admins.       */
/*********************************************************************************************************/
$showGuests              = false; //Allow/notAllow displaying of guest ip's partial or otherwise.
$showGuestsAdmin         = true; //Allow/notAllow displaying of guest ip's partial or otherwise to Admins.
$showServerDateTime      = true; //Allow/notAllow displaying of Server Date/Time.
$showServerDateTimeAdmin = true; //Allow/notAllow displaying of Server Date/Time to Admins.
$whoisServerString       = 'www.dnsstuff.com/tools/whois/?ip=';
$nameMaxLength           = 13; //Max length for username display.  Will truncate with ....
$showHidden              = false; //Allow/notAllow displaying of Hidden counts. false=Admin Only  true=ALL
/*********************************************************************************************************/
/* You should not need to modify anything below this line                                                */
/*********************************************************************************************************/
define('_rnSIB_VERSION_','2.2.5');
function convertIP ($xip) {
	global $admin;
	if (is_admin($admin)) return $xip;
	$xipx = explode('.',$xip);
	for ($i=2;$i<count($xipx);$i++) {
		$xipx[$i] = preg_replace ('/(0|1|2|3|4|5|6|7|8|9)/', 'x', $xipx[$i]);
	}
	return implode('.',$xipx);
}

$content = '';
if (!isset($lastUserNameModified)) $lastUserNameModified = '';

global $db, $nukeurl, $startdate, $user, $cookie, $prefix, $user_prefix, $anonymous, $admin, $gfx_chk;

/*** Not needed with new Captcha
 global $mode, $t, $f, $redirect, $random_num, $gfx_chk;
 mt_srand ((double)microtime()*1000000);
 $maxran = 1000000;
 $random_num = mt_rand(0, $maxran);
 $datekey = date('F j');
 $rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $sitekey . $random_num . $datekey));
 $code = substr($rcode, 2, 10);
 ***/

cookiedecode($user);
if (count($cookie)<2) $uname='';
else $uname = $cookie[1];

// Get the last user added to the database and the total users, minus anonymous
$sql = 'SELECT username,user_id FROM '.$user_prefix.'_users ORDER BY user_id DESC LIMIT 0,1';
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
$lastusername = $row['username'];
$lastuser = $row['user_id'];
$numrows = $db->sql_fetchrow($db->sql_query('SELECT count(user_id) user_id FROM '.$user_prefix.'_users'));
$numrows = $numrows['user_id'];
$numrows1 = $numrows-1;

$sql = 'SELECT SQL_NO_CACHE s.host_addr, u.user_id, u.username, u.user_allow_viewonline FROM '.$prefix.'_session s,'.$user_prefix.'_users u WHERE s.guest=0 AND u.username=s.uname ORDER BY u.username';
$result = $db->sql_query($sql);
$member_online_num = $db->sql_numrows($result);
$who_online_now = '';
$i = 1;
$hiddenTotal = 0;
while ($member_result = $db->sql_fetchrow($result)) {
	if ($i < 10) $zi = "0$i";
	else $zi = $i;
	if (is_admin($admin)) {
		$zi = '<a href="http://'.$whoisServerString.$member_result['host_addr'].'" title="'.$member_result['host_addr'].'" target="_blank">'.$zi.'</a>';
	}
	$sessionNameModified = strlen($member_result['username'])<$nameMaxLength?$member_result['username']:substr($member_result['username'],0,$nameMaxLength).'...'; // 2.2.0
	$lastUserNameModified = strlen($lastusername)<$nameMaxLength?$lastusername:substr($lastusername,0,$nameMaxLength).'...'; // 2.2.0
	if (!$member_result['user_allow_viewonline'] AND !is_admin($admin)) {
		$hiddenTotal++;
	}
	elseif (!$member_result['user_allow_viewonline'] AND is_admin($admin)) {
		$hiddenTotal++;
		$who_online_now .= $zi.':&nbsp;<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$member_result['username'].'"><img src="images/blocks/icon_mini_profile.gif" border="0" alt="'._ALT_CHKPROFILE.$member_result['username'].'" title="'._ALT_CHKPROFILE.$member_result['username'].'" /></a>&nbsp;<a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$member_result['user_id'].'"><img src="images/blocks/nopm.gif" border="0" alt="'._ALT_SEND.$member_result['username'].'" title="'._ALT_SEND.$member_result['username'].'" /></a>&nbsp;<a title="'._ALT_CHKPROFILE.$member_result['username'].'" href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$member_result['user_id'].'">'.$sessionNameModified.'</a>'._HIDDEN_ABBREV.'<br />'."\n";
		$who_online_now .= ($i != $member_online_num ? '  ' : '');
		$i++;
	}
	else {
		$who_online_now .= $zi.':&nbsp;<a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$member_result['username'].'"><img src="images/blocks/icon_mini_profile.gif" border="0" alt="'._ALT_CHKPROFILE.$member_result['username'].'" title="'._ALT_CHKPROFILE.$member_result['username'].'" /></a>&nbsp;<a href="modules.php?name=Private_Messages&amp;mode=post&amp;u='.$member_result['user_id'].'"><img src="images/blocks/nopm.gif" border="0" alt="'._ALT_SEND.$member_result['username'].'" title="'._ALT_SEND.$member_result['username'].'" /></a>&nbsp;<a title="'._ALT_CHKPROFILE.$member_result['username'].'" href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$member_result['user_id'].'">'.$sessionNameModified.'</a><br />'."\n";
		$who_online_now .= ($i != $member_online_num ? '  ' : '');
		$i++;
	}
}
$member_online_num = $member_online_num - $hiddenTotal;
$sql = 'SELECT SQL_NO_CACHE uname, guest FROM '.$prefix.'_session  WHERE guest=1';
$result = $db->sql_query($sql);
$guest_online_num = $db->sql_numrows($result);
$gwho_online_now = '';
$gArray = Array();
while ($session = $db->sql_fetchrow($result)) {
	//    if (isset($session['guest']) and $session['guest'] == 1) {
	$gArray[] = convertIP($session['uname']);
	//  }
}
sort($gArray,SORT_NUMERIC);
for ($j=0;$j<count($gArray);$j++) {
	if ($i < 10) $zi = "0$i";
	else $zi = $i;
	if ($j==0) $gwho_online_now .= '<option selected="selected">'._GUESTIPS_OPTION.'</option>'."\n";
	$gwho_online_now .= '<option value="http://'.$whoisServerString.$gArray[$j].'">'.$zi.': '.$gArray[$j].'</option>'."\n";
	$i++;
}

//Executing SQL For Today and Yesterday
$userCount  = 0;
$userCount2 = 0;
$todayDST = date('I',time())*3600;  // 2.2.0
$yesterdayDST = date('I',time()-86400)*3600; // 2.2.0
$Today = date('M d, Y',time()-$todayDST); // 2.2.0
$Yesterday = date('M d, Y',time()-86400-$yesterdayDST); // 2.2.0
$sql = 'SELECT user_regdate, COUNT(user_regdate) FROM '.$user_prefix.'_users where user_regdate IN(\''.$Today.'\', \''.$Yesterday.'\') GROUP BY user_regdate LIMIT 0,2';
$result = $db->sql_query($sql);
while ($row = $db->sql_fetchrow($result)) {
	if ($row[0]==$Today) $userCount = $row[1];
	elseif ($row[0]==$Yesterday) $userCount2 = $row[1];
}

$who_online_num = $guest_online_num + $member_online_num;
if (is_admin($admin) OR $showHidden) $who_online_num = $who_online_num + $hiddenTotal; // 2.2.0

$sql = 'SELECT username FROM '.$user_prefix.'_users_temp';
$result = $db->sql_query($sql);
$waiting = $db->sql_numrows($result);

$content .= '<form action="modules.php?name=Your_Account" method="post">';
if     (getenv('HTTP_CLIENT_IP'))       $onlyip = getenv('HTTP_CLIENT_IP');
elseif (getenv('HTTP_X_FORWARDED_FOR')) $onlyip = getenv('HTTP_X_FORWARDED_FOR');
elseif (getenv('HTTP_X_FORWARDED'))     $onlyip = getenv('HTTP_X_FORWARDED');
elseif (getenv('HTTP_FORWARDED_FOR'))   $onlyip = getenv('HTTP_FORWARDED_FOR');
elseif (getenv('HTTP_FORWARDED'))       $onlyip = getenv('HTTP_FORWARDED');
else                                    $onlyip = $_SERVER['REMOTE_ADDR'];
if (!validIP($onlyip)) $onlyip = ''; // Ensure the IP address is valid
if (is_user($user)) {
	$sqlp = 'SELECT user_avatar, user_avatar_type, user_id AS uid, user_posts AS posts FROM '.$user_prefix.'_users WHERE username = \''.$uname.'\'';
	$result = $db->sql_query($sqlp);
	$row = $db->sql_fetchrow($result);
	$posts = $row['posts'];
	$uid = $row['uid'];
	$user_avatar = $row['user_avatar'];
	$user_avatar_type = $row['user_avatar_type']; //Add by Qdog to support different avatar paths
	$content .= '<center><b>'._YOURIP.$onlyip.'</b></center>';
	if ($result) {
		////////////////Add by Qdog to support different avatar paths/////////
		////////////////SQL & code modified by Raven for efficiency  /////////
		$sql = 'SELECT config_name, config_value FROM '.$prefix.'_bbconfig WHERE config_name IN(\'avatar_path\',\'avatar_gallery_path\') LIMIT 0,2';
		$result = $db->sql_query($sql);
		while ( $row = $db->sql_fetchrow($result) ) {
			$board_config[$row['config_name']] = $row['config_value'];
		}
		if     ($user_avatar_type == 1) $user_avatar = $board_config['avatar_path'].'/'.$user_avatar;
		elseif ($user_avatar_type != 2) $user_avatar = $board_config['avatar_gallery_path'].'/'.$user_avatar;
		$content .= '<center><img alt="" src="'.$user_avatar.'" /></center>';
		////////////////End Avatar Path Mod/////////////////////////////////////
	}
	if ($posts>0) $content .= '<br /><center>'.intval($posts).' post(s)</center>'."\n";
	$content .= '<br /><img src="images/blocks/group-4.gif" height="14" width="17" alt="" /> '._BWEL.', <b>'.$uname.'</b><br />'."\n\n";
	$content .= '<a href="modules.php?name=Your_Account&amp;op=logout"><img src="images/blocks/arrow-blk.gif" width="17" border="0" alt="" />&nbsp;'._LOGOUT."</a>\n<hr />\n";
	$sql = 'SELECT privmsgs_type pmType, count(privmsgs_type) pmCount'
	. ' FROM '.$prefix.'_bbprivmsgs'
	. ' WHERE privmsgs_to_userid='.intval($uid).''
	. ' AND privmsgs_type IN(0,1,5)'
	. ' GROUP BY privmsgs_type'
	. ' LIMIT 0 , 3';
	$result = $db->sql_query($sql);
	$newpms = 0;
	$oldpms = 0;
	while ($row = $db->sql_fetchrow($result)) {
		if ($row[0]==0) $oldpms += $row[1];
		else $newpms += $row[1];
	}
	$content .= '<img src="images/blocks/email-y.gif" height="10" width="14" alt="" /> <a href="modules.php?name=Private_Messages"><b>'._BPM.'</b></a><br />'."\n";
	$content .= '<img src="images/blocks/email-r.gif" height="10" width="14" alt="" /> '._BUNREAD.': <b>'.$newpms.'</b><br />'."\n";
	$content .= '<img src="images/blocks/email-g.gif" height="10" width="14" alt="" /> '._BREAD.': <b>'.$oldpms.'</b><br />'."\n<hr />\n";
} else {
	$content .= '<center><b>'._YOURIP.$onlyip.'</b></center><br />';
	$content .= '<img src="images/blocks/group-4.gif" height="14" width="17" alt="" /> '._BWEL.', <b>'.$anonymous."</b>\n<hr />";
	$content .= '<table><tr><td>'._NICKNAME.'</td><td><input type="text" name="username" size="10" maxlength="25" /></td></tr>';
	$content .= '<tr><td>'._PASSWORD.'</td><td><input type="password" name="user_password" size="10" maxlength="20" /></td></tr></table>';
	/*****[BEGIN]******************************************
	 [ Base:    GFX Code                           v1.0.0 ]
	 ******************************************************/
	$content .= security_code(array(2,4,5,7), 'stacked');
	/*****[END]********************************************
	 [ Base:    GFX Code                           v1.0.0 ]
	 ******************************************************/
	$content .= '<input type="hidden" name="op" value="login" />';
	$content .= '<input type="submit" value="'._LOGIN.'" />'."\n".'<br /><a href="modules.php?name=Your_Account&amp;op=new_user">&middot;&nbsp;'._BREG.'</a><br />';
	$content .= '<a href="modules.php?name=Your_Account&amp;op=pass_lost">&middot;&nbsp;'._PASSWORDLOST.'</a><hr />';
}
if (is_user($user) OR is_admin($admin)) {
	$lUNM = !empty($lastUserNameModified) ? '<b>'.$lastUserNameModified.'</b>' : $lastusername;  //2.3.0
	$content .= '<img src="images/blocks/group-2.gif" height="14" width="17" alt="" /> <b><u>'._BMEMP.':</u></b><br />'."\n";
	$content .= '<img src="images/blocks/ur-moderator.gif" height="14" width="17" alt="" /> '._BLATEST.': <a href="modules.php?name=Your_Account&amp;op=userinfo&amp;username='.$lastusername.'"><img src="images/blocks/icon_mini_profile.gif" border="0" title="'._ALT_CHKPROFILE.$lastusername.'" alt="'._ALT_CHKPROFILE.$lastusername.'" /></a>&nbsp;<a href="modules.php?name=Forums&amp;file=profile&amp;mode=viewprofile&amp;u='.$lastuser.'">'.$lUNM.'</a><br />'."\n"; //

	// Code below this line is a result from/of Mantis issue 0001223: UserInfoAddOns Delete user link throws blank page
	if (is_admin($admin)) {
		$sql = 'SELECT username, user_regdate, user_email, user_website FROM '.$user_prefix.'_users where user_regdate IN (\''.date('M d, Y',time()).'\', \''.date('M d, Y',time()-86400).'\') order by user_regdate DESC, username';
		$result = $db->sql_query($sql);
		$displayT = $displayY = '<table border="1" align="center">'."\n"
		.	'<tr class="boxtitle"><td>Name</td><td>URL</td></tr>'."\n";
		while ($userinfo = $db->sql_fetchrow($result)) {
			if (empty($userinfo['username'])) continue;
			if (empty($userinfo['user_website']) OR $userinfo['user_website']=='http://') $userinfo['user_website']='&nbsp;';
			else $userinfo['user_website'] = '<a href="'.$userinfo['user_website'].'" target="_blank">'.$userinfo['user_website'].'</a>';
			if ($userinfo['user_regdate']==date('d M Y',time())) $displayT .= '<tr><td><a href="mailto:'.$userinfo['user_email'].'" title="Email User '.$userinfo['username'].'">&nbsp;<b>'.$userinfo['username'].'</b></a></td><td>'.$userinfo['user_website']."</td></tr>\n";
			elseif ($userinfo['user_regdate']==date('d M Y',time()-86400)) $displayY .= '<tr><td><a href="mailto:'.$userinfo['user_email'].'" title="Email User '.$userinfo['username'].'">&nbsp;<b>'.$userinfo['username'].'</b></a></td><td>'.$userinfo['user_website']."</td></tr>\n";
		}
		if (ereg('href', $displayT)) $displayT .= '</table>'; else $displayT = '';
		if (ereg('href', $displayY)) $displayY .= '</table>'; else $displayY = '';
		$btdLink = _BTD . ': <b>'.$userCount.'</b>';
		$bydLink = _BYD . ': <b>'.$userCount2.'</b>';
		if ($userCount>0)
		$btdLink = '<a href="javascript:hideshow(document.getElementById(\'newToday\'))">'._BTD.'</a>'.': <b>'.$userCount.'</b>'
		.'<div id="newToday" style="display: none;">'.$displayT.'</div>';
		if ($userCount2>0)
		$bydLink = '<a href="javascript:hideshow(document.getElementById(\'newYesterday\'))">'._BYD.'</a>'.': <b>'.$userCount2.'</b>'
		.'<div id="newYesterday" style="display: none;">'.$displayY.'</div>';
	}
	else {
		$btdLink = _BTD;
		$bydLink = _BYD;
	}
	$content .= '<img src="images/blocks/ur-author.gif" height="14" width="17" alt="" /> '.$btdLink.'<br />'."\n";
	$content .= '<img src="images/blocks/ur-admin.gif" height="14" width="17" alt="" /> '.$bydLink.'<br />'."\n";
	// Code above this line is a result from/of Mantis issue 0001223: UserInfoAddOns Delete user link throws blank page

	if (is_admin($admin) AND @file_exists('modules/Resend_Email/index.php')) $waitLink = '<a href="modules.php?name=Resend_Email" title="'._TTL_RESENDEMAIL.'">'._WAITLINK.'</a>';
	else $waitLink = _WAITLINK;
	$content .= '<img src="images/blocks/ur-member.gif" height="14" width="17" alt="" /> '.$waitLink.': <b>'.$waiting.'</b><br />'."\n";
	$content .= '<img src="images/blocks/ur-guest.gif" height="14" width="17" alt="" /> '._BOVER.': <b>'.number_format($numrows1,0).'</b><br />'."\n<hr />\n";
	//}
	$content .= '<img src="images/blocks/group-3.gif" height="14" width="17" alt="" /> <b><u>'._BVISIT.':</u></b>'."\n".'<br />'."\n";
	$content .= '<img src="images/blocks/ur-anony.gif" height="14" width="17" alt="" /> '._BVIS.': <b>'.$guest_online_num.'</b><br />'."\n";
	$content .= '<img src="images/blocks/ur-member.gif" height="14" width="17" alt="" /> '._BMEM.': <b>'.$member_online_num.'</b><br />'."\n";
	//if (is_user($user) OR is_admin($admin)) {
	if (is_admin($admin) OR $showHidden) { // 2.2.0
		$content .= '<img src="images/blocks/ur-hiddenmember.gif" height="14" width="17" alt="" /> '._HIDDEN.': <b>'.$hiddenTotal.'</b><br />'."\n";
	}
	$content .= '<img src="images/blocks/ur-registered.gif" height="14" width="17" alt="" /> '._BTT.': <b>'.$who_online_num.'</b><br />'."\n".'<hr noshade="noshade" />'."\n";
	if ($member_online_num > 0 OR is_admin($admin)) {
		$content .= '<img src="images/blocks/group-1.gif" height="14" width="17" align="middle" alt="" /> <b><u>'._BON.':</u></b><br />'.$who_online_now;
		$hr = "\n".'<hr noshade="noshade" />'."\n";
	}
	if ($guest_online_num > 0 AND ($showGuests OR ($showGuestsAdmin AND is_admin($admin)))) {
		$content .= '<br /><select style="width:140px" name="name1" onchange="gotoURL(this)">'."\n$gwho_online_now\n".'</select>';
		$hr = "\n".'<hr noshade="noshade" />'."\n";
	}
	$content .= '<hr />';

	/* Hits for Today */
	$t_time = time()-$todayDST; // 2.2.0
	$t_year = date('Y', $t_time);
	$t_month = date('n', $t_time);
	$t_date = date('j', $t_time);
	$result = $db->sql_query('SELECT hits FROM '.$prefix.'_stats_date WHERE year='.$t_year.' AND month='.$t_month.' AND date='.$t_date);
	list($today) = $db->sql_fetchrow($result);
	if (is_admin($admin)) {
		/* Hits for Yesterday */
		$y_time = $t_time - 86400 - $yesterdayDST; // 2.2.0
		$y_year = date('Y', $y_time);
		$y_month = date('n', $y_time);
		$y_date = date('j', $y_time);
		$result = $db->sql_query('SELECT hits FROM '.$prefix.'_stats_date WHERE year='.$y_year.' AND month='.$y_month.' AND date='.$y_date);
		list($yesterday) = $db->sql_fetchrow($result);
	}

	/* Hits in Total */
	$totalhits = 0;
	$result = $db->sql_query('SELECT sum(hits) FROM '.$prefix.'_stats_year');
	list($totalhits) = $db->sql_fetchrow($result);
	$content .= '<center><small>'._WERECEIVED.'</small><br />'."\n";
	$content .= '<b>'.number_format($totalhits,0).'</b><br />'."\n";
	$content .= '<small>'._PAGESVIEWS.'<br />'.$startdate.'</small></center>';
	$content .= '<hr noshade="noshade" />';
	$content .= '<center>'._BHITS.' '._BTD.': <b>'.number_format($today,0).'</b><br />';
	if (is_admin($admin)) $content .= _BHITS.' '._BYD.': <b>'.number_format($yesterday,0).'</b><br />';
	$content .= '</center>';
}
if ($showServerDateTime OR ($showServerDateTimeAdmin AND is_admin($admin))) {
	if (is_user($user) OR is_admin($admin)) {
		$content .= '<hr noshade="noshade" />';
	}
	$sdt = date('d/m/Y'."\n".'H:i:s');
	$zone = date('Z')/3600;
	if ($zone >= 0) {
		$zone = '+'.$zone;
	}
	$content .= '<center>'._SERDT.'<br />'.$sdt.' (GMT '.$zone.')</center>';
}
else {
	$hr = "\n".'<hr noshade="noshade" />'."\n";
	$content .= $hr;
}
$content .= '</form>';

?>
