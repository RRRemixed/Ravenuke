<?php

/***************************************************************************/
/* PHP-NUKE: Advanced Content Management System						*/
/* ============================================						*/
/*														*/
/* Copyright (c) 2002 by Francisco Burzi								*/
/* http://phpnuke.org											*/
/*														*/
/* This program is free software. You can redistribute it and/or modify			*/
/* it under the terms of the GNU General Public License as published by			*/
/* the Free Software Foundation; either version 2 of the License.				*/
/***************************************************************************/
/***************************************************************************/
/* Raven - http://www.ravenphpscripts.com	http://www.ravenwebhosting.com	*/
/* 10/19/2006 - Brought up to or as near to XHTML standards as possible.			*/
/*														*/
/***************************************************************************/

define('ADMIN_FILE', true);
require_once('mainfile.php');

if(isset($aid)) {
	if($aid AND (!isset($admin) OR empty($admin)) AND $op!='login') {
		unset($aid);
		unset($admin);
		die('Access Denied');
	}
}

global $admin_file;

get_lang('admin');

function create_first($name, $url, $email, $pwd, $user_new) {
	global $prefix, $user_prefix, $db;

	$first = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_authors'));
	if ($first == 0) {
		$pwd = md5($pwd);
		$the_adm = 'God';
		$email = validate_mail($email);
		$db->sql_query('INSERT INTO '.$prefix."_authors VALUES ('$name', '$the_adm', '$url', '$email', '$pwd', '0', '1', '')");

		if ($user_new == 1) {
			$user_regdate = date('d M Y');
			$user_avatar = 'gallery/blank.gif';
			$commentlimit = 4096;
			if ($url == 'http://') { $url = ''; }
			$db->sql_query('INSERT INTO '.$user_prefix.'_users (user_id, username, user_email, user_website, user_avatar, user_regdate, user_password, theme, commentmax, user_level, user_lang, user_dateformat) '."VALUES (NULL,'$name','$email','$url','$user_avatar','$user_regdate','$pwd','$Default_Theme','$commentlimit', '2', 'english','D M d, Y g:i a')");
		}
		login();
	}
}


if (!isset($admin_file)) $admin_file = 'admin'; // montego - why do this check in every module when it can be done here!

$the_first = $db->sql_numrows($db->sql_query('SELECT * FROM '.$prefix.'_authors'));
if ($the_first == 0) {
	if (!$name) {
		include_once('header.php');
		title("$sitename: "._ADMINISTRATION);
		OpenTable();
		echo '<center><b>'._NOADMINYET.'</b></center><br /><br />'
			.'<form action="'.$admin_file.'.php" method="post">'
			.'<table border="0">'
			.'<tr><td><b>'._NICKNAME.':</b></td><td><input type="text" name="name" size="30" maxlength="25" /></td></tr>'
			.'<tr><td><b>'._HOMEPAGE.':</b></td><td><input type="text" name="url" size="30" maxlength="255" value="http://" /></td></tr>'
			.'<tr><td><b>'._EMAIL.':</b></td><td><input type="text" name="email" size="30" maxlength="255" /></td></tr>'
			.'<tr><td><b>'._PASSWORD.':</b></td><td><input type="password" name="pwd" size="11" maxlength="40" /></td></tr>'
			.'<tr><td colspan="2">'._CREATEUSERDATA.'	<input type="radio" name="user_new" value="1" checked="checked" />'._YES.'&nbsp;&nbsp;<input type="radio" name="user_new" value="0" />'._NO.'</td></tr>'
			.'<tr><td><input type="hidden" name="fop" value="create_first" />'
			.'<input type="submit" value="'._SUBMIT.'" />'
			.'</td></tr></table></form>';
		CloseTable();
		include_once('footer.php');
	}

	switch($fop) {
		case 'create_first':
			create_first($name, $url, $email, $pwd, $user_new);
			break;
	}
	die();
}

if (isset($aid) && (ereg('[^a-zA-Z0-9@_.]',trim($aid)))) {
	header('Location: '.$admin_file.'.php');
	die();
}

if (isset($aid)) { $aid = substr($aid, 0,25);}
if (isset($pwd)) { $pwd = substr($pwd, 0,40);}
if ((isset($aid)) && (isset($pwd)) && (isset($op)) && ($op == 'login')) {
	/*****[BEGIN]******************************************
	 [ Base:		GFX Code													 v1.0.0 ]
	 ******************************************************/
	if (!isset($gfx_check)) {$gfx_check = '';}
	if (!security_code_check($gfx_check, array(1,5,6,7))) {
		/*****[END]********************************************
		 [ Base:		GFX Code													 v1.0.0 ]
		 ******************************************************/
		Header('Location: '.$admin_file.'.php');
		die();
	}
	if(!empty($aid) AND !empty($pwd)) {
		$pwd = md5($pwd);
		$result = $db->sql_query('SELECT pwd, admlanguage FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\'');
		list($rpwd, $admlanguage) = $db->sql_fetchrow($result);
		$admlanguage = addslashes($admlanguage);

		if($rpwd == $pwd) {
			$admin = base64_encode("$aid:$pwd:$admlanguage");
			setcookie('admin',$admin,time()+2592000);
			unset($op);
		}
	}
}

$admintest = 0;

if(isset($admin) && !empty($admin)) {
	$admin = addslashes(base64_decode($admin));
	$admin = explode(':', $admin);
	$aid = addslashes($admin[0]);
	$pwd = $admin[1];
	$admlanguage = $admin[2];
	if (empty($aid) OR empty($pwd)) {
		$admintest=0;
		$alert = '<html>'."\n";
		$alert .= '<title>'._A_INTRUDER_MSG.'</title>'."\n";
		$alert .= '<body bgcolor="#FFFFFF" text="#000000">'."\n\n".'<br /><br /><br />'."\n\n";
		$alert .= '<center><img src="images/eyes.gif" border="0" /><br /><br />'."\n";
		$alert .= '<font face="Verdana" size="+4"><b>'._A_GETOUT.'</b></font></center>'."\n";
		$alert .= '</body>'."\n";
		$alert .= '</html>'."\n";
		die($alert);
	}
	$aid = substr("$aid", 0,25);
	$result2 = $db->sql_query('SELECT name, pwd FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\'');
	if (!$result2) {
		die('Selection from database failed!');
	} else {
		list($rname, $rpwd) = $db->sql_fetchrow($result2);
		if($rpwd == $pwd && !empty($rpwd)) {
			$admintest = 1;
		}
	}
}

$ops = array('mod_authors', 'modifyadmin', 'UpdateAuthor', 'AddAuthor', 'deladmin2', 'deladmin', 'assignstories', 'deladminconf'); // Raven: 10-23-2006
if(!isset($op) || empty($op)) {
	$op = 'adminMain';
} elseif(in_array($op, $ops) AND $rname != 'God') {
	die('Illegal Operation');
}

$pagetitle = '- '._ADMINMENU;

/***********************************************************/
/* Login Function									*/
/***********************************************************/

function login() {
	global $gfx_chk, $admin_file;
	include_once('header.php');
	OpenTable();
	echo '<center><font class="title"><b>'._ADMINLOGIN.'</b></font></center>';
	CloseTable();
	echo '<br />';
	OpenTable();
	echo '<form action="'.$admin_file.'.php" method="post">'
		.'<table border="0">'
		.'<tr><td>'._ADMINID.'</td>'
		.'<td><input type="text" name="aid" size="20" maxlength="25" /></td></tr>'
		.'<tr><td>'._PASSWORD.'</td>'
		.'<td><input type="password" name="pwd" size="20" maxlength="40" /></td></tr>';
	/*****[BEGIN]******************************************
	 [ Base:		GFX Code					 v1.0.0 ]
	 ******************************************************/
	echo security_code(array(1,5,6,7), 'normal');
	/*****[END]********************************************
	 [ Base:		GFX Code					 v1.0.0 ]
	 ******************************************************/
	echo '<tr><td><input type="hidden" name="op" value="login" />'
		.'<input type="submit" value="'._LOGIN.'" />'
		.'</td></tr></table>'
		.'</form>';
	CloseTable();
	include_once('footer.php');
}

/***********************************************************/
/* Administration Menu Function						*/
/***********************************************************/

function adminmenu($url, $title, $image) {
	global $counter, $admingraphic, $Default_Theme;
	$ThemeSel = get_theme();
	if (file_exists('themes/'.$ThemeSel.'/images/admin/'.$image)) {
		$image = 'themes/'.$ThemeSel.'/images/admin/'.$image;
	} else {
		$image = 'images/admin/'.$image;
	}
	if ($admingraphic == 1) {
		$img = '<img src="'.$image.'" border="0" alt="'.$title.'" title="'.$title.'" /></a><br />';
		$close = '';
	} else {
		$img = '';
		$close = '</a>';
	}
	echo '<td align="center" valign="top" width="16%"><font class="content"><a href="'.$url.'">'."$img<b>$title</b>$close".'<br /><br /></font></td>';
	if ($counter == 5) {
		echo '</tr><tr>';
		$counter = 0;
	} else {
		$counter++;
	}
}

function GraphicAdmin() {
	global $aid, $admingraphic, $language, $admin, $prefix, $db, $counter, $admin_file, $usenukeNAV, $showAdminMenu;
	$newsubs = $db->sql_numrows($db->sql_query('SELECT qid FROM '.$prefix.'_queue'));
	$row = $db->sql_fetchrow($db->sql_query('SELECT name, radminsuper FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\''));
	$radminsuper = intval($row['radminsuper']);
	if ($radminsuper == 1 && ($usenukeNAV == 0 || ($usenukeNAV > 0 && $showAdminMenu))) {
		OpenTable();
		echo '<center><a href="'.$admin_file.'.php"><font class="title">'._ADMINMENU.'</font></a>';
		echo '<br /><br /></center>';
		echo'<table align="center" border="0" width="100%" cellspacing="1"><tr>';
		$linksdir = dir('admin/links');
		$menulist = '';
		while($func=$linksdir->read()) {
			if(substr($func, 0, 6) == 'links.') {
				 if ('God'!==$row['name'] && substr($func, 6, 10) == 'editadmins') continue;
				$menulist .= "$func ";
			}
		}
		closedir($linksdir->handle);
		$menulist = explode(' ', $menulist);
		sort($menulist);
		for ($i=0; $i < sizeof($menulist); $i++) {
			if(!empty($menulist[$i])) {
				$sucounter = 0;
				include_once($linksdir->path."/$menulist[$i]");
			}
		}
		adminmenu($admin_file.'.php?op=logout',_ADMINLOGOUT, 'logout.gif');
		if ($counter==0) echo '<td></td>';	//Added by Raven 7/1/2007 to fix a warning in xhtml
		echo'</tr></table>';
		$counter = '';
		CloseTable();
		echo '<br />';
	}
	OpenTable();
	echo '<center><a href="'.$admin_file.'.php"><font class="title">'._MODULESADMIN.'</font></a>';
	echo '<br /><br />';
	echo'<table border="0" width="100%" cellspacing="1"><tr>';
	$result = $db->sql_query('SELECT title, admins FROM '.$prefix.'_modules ORDER BY title ASC');
	$row2 = $db->sql_fetchrow($db->sql_query('SELECT name FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\''));
	while ($row = $db->sql_fetchrow($result)) {
		$admins = explode(',', $row['admins']);
		$auth_user = 0;
		for ($i=0; $i < sizeof($admins); $i++) {
			if ($row2['name'] == $admins[$i]) {
				$auth_user = 1;
			}
		}
		if ($radminsuper == 1 OR $auth_user == 1) {
			if (file_exists('modules/'.$row['title'].'/admin/index.php') AND file_exists('modules/'.$row['title'].'/admin/links.php') AND file_exists('modules/'.$row['title'].'/admin/case.php')) {
				include_once('modules/'.$row['title'].'/admin/links.php');
			}
		}
	}
	adminmenu($admin_file.'.php?op=logout', _ADMINLOGOUT, 'logout.gif');
	if ($counter==0) echo '<td></td>';	//Added by Raven 7/1/2007 to fix a warning in xhtml
	echo'</tr></table></center>';
	CloseTable();
	echo '<br />';
}

/***********************************************************/
/* Administration Main Function						*/
/***********************************************************/

function adminMain() {
	global $language, $admin, $aid, $prefix, $user_prefix, $file, $db, $sitename, $admin_file, $bgcolor1;
	include_once('header.php');
	//Executing SQL For Today and Yesterday
	$userCount	= 0;
	$userCount2 = 0;
	$todayDST = date('I',time())*3600;	// 2.2.0
	$yesterdayDST = date('I',time()-86400)*3600; // 2.2.0
	$Today = date('d M Y',time()-$todayDST); // 2.2.0
	$Yesterday = date('d M Y',time()-86400-$yesterdayDST); // 2.2.0
	$sql = 'SELECT user_regdate, COUNT(user_regdate) FROM '.$user_prefix.'_users where user_regdate IN(\''.$Today.'\', \''.$Yesterday.'\') GROUP BY user_regdate LIMIT 0,2';
	$result = $db->sql_query($sql);
	while ($row = $db->sql_fetchrow($result)) {
		if ($row[0]==$Today) $userCount = $row[1];
		elseif ($row[0]==$Yesterday) $userCount2 = $row[1];
	}
	GraphicAdmin();
	$aid = substr("$aid", 0,25);
	$row = $db->sql_fetchrow($db->sql_query('SELECT radminsuper, admlanguage FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\''));
	$radminsuper = intval($row['radminsuper']);
	$admlanguage = addslashes($row['admlanguage']);
	$result = $db->sql_query('SELECT admins FROM '.$prefix.'_modules WHERE title=\'News\'');
	$result2 = $db->sql_query('SELECT name FROM '.$prefix.'_authors WHERE aid=\''.$aid.'\'');
	list($aidname) = $db->sql_fetchrow($result2);
	$radminarticle = 0;
	while (list($admins) = $db->sql_fetchrow($result)) {
		$admins = explode(',', $admins);
		$auth_user = 0;
		for ($i=0; $i < sizeof($admins); $i++) {
			if ($aidname == $admins[$i]) {
				$auth_user = 1;
			}
		}
		if ($auth_user == 1) {
			$radminarticle = 1;
		}
	}
	if (!empty($admlanguage)) {
		$queryalang = 'WHERE alanguage=\''.$admlanguage.'\'';
	} else {
		$queryalang = '';
	}
	list($main_module) = $db->sql_fetchrow($db->sql_query('SELECT main_module from '.$prefix.'_main'));
	OpenTable();
	echo '<center><b>'."$sitename".': '._DEFHOMEMODULE.'</b><br /><br />'
		._MODULEINHOME.' <b>'."$main_module".'</b><br />[ <a href="'.$admin_file.'.php?op=modules">'._CHANGE.'</a> ]</center>';
	CloseTable();
	echo '<br />';
	OpenTable();
	$guest_online_num = intval($db->sql_numrows($db->sql_query('SELECT uname FROM '.$prefix.'_session WHERE guest=1')));
	$member_online_num = intval($db->sql_numrows($db->sql_query('SELECT uname FROM '.$prefix.'_session WHERE guest=0')));
	$who_online_num = $guest_online_num + $member_online_num;
	$who_online = '<center><font class="option">'._WHOSONLINE.'</font><br /><br /><font class="content">'._CURRENTLY." $guest_online_num "._GUESTS." $member_online_num "._MEMBERS.'<br />';
	echo $who_online.'<br />'
		._BTD.': <b>'.$userCount.'</b> - '._BYD.': <b>'.$userCount2.'</b></font></center>';
	CloseTable();
	if (is_active('News')) {
		echo '<br />';
		OpenTable();
		echo '<center><b>'._AUTOMATEDARTICLES.'</b></center><br />';
		$count = 0;
		$result5 = $db->sql_query('SELECT anid, aid, title, time, alanguage FROM '.$prefix.'_autonews '.$queryalang.' ORDER BY time ASC');
		while (list($anid, $aid, $listtitle, $time, $alanguage) = $db->sql_fetchrow($result5)) {
			$anid = intval($anid);
			$said = substr($aid, 0,25);
			$title = $listtitle;
			if (empty($alanguage)) {
				$alanguage = _ALL;
			}
			if (!empty($anid)) {
				if ($count == 0) {
					echo '<table border="1" width="100%">';
					$count = 1;
				}
				$time = str_replace(' ', '@', $time);
				if (($radminarticle==1) OR ($radminsuper==1)) {
					if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
						echo '<tr><td nowrap="nowrap">&nbsp;(<a href="'.$admin_file.'.php?op=autoEdit&amp;anid='.$anid.'">'._EDIT.'</a>-<a class="rn_csrf" href="'.$admin_file.'.php?op=autoDelete&amp;anid='.$anid.'">'._DELETE.'</a>)&nbsp;</td><td width="100%">&nbsp;'.$title.'&nbsp;</td><td align="center">&nbsp;'.$alanguage.'&nbsp;</td><td nowrap="nowrap">&nbsp;'.$time.'&nbsp;</td></tr>'; /* Multilingual Code : added column to display language */
					}else {
					echo '<tr><td>&nbsp;('._NOFUNCTIONS.')&nbsp;</td><td width="100%">&nbsp;'.$title.'&nbsp;</td><td align="center">&nbsp;'.$alanguage.'&nbsp;</td><td nowrap="nowrap">&nbsp;'.$time.'&nbsp;</td></tr>'; /* Multilingual Code : added column to display language */
					}
				} else {
					echo '<tr><td width="100%">&nbsp;'.$title.'&nbsp;</td><td align="center">&nbsp;'.$alanguage.'&nbsp;</td><td nowrap="nowrap">&nbsp;'.$time.'&nbsp;</td></tr>'; /* Multilingual Code : added column to display language */
				}
			}
		}

		if ((empty($anid)) AND ($count == 0)) {
			echo '<center><i>'._NOAUTOARTICLES.'</i></center>';
		}
		if ($count == 1) {
			echo '</table>';
		}
		CloseTable();
		echo '<br />';
		OpenTable();
		echo '<center><b>'._LAST.' 20 '._ARTICLES.'</b></center><br />';
		$result6 = $db->sql_query('SELECT sid, aid, title, time, topic, informant, alanguage, topicname FROM '.$prefix.'_stories left join ' .$prefix.'_topics ON topicid=topic '. $queryalang.' ORDER BY time DESC LIMIT 0,20');
		$numarticles = $db->sql_numrows($result6);
		if ($numarticles > 0) {
			echo '<center><table border="1" width="100%" bgcolor="'.$bgcolor1.'">';
			while ($row = $db->sql_fetchrow($result6)) {
				$sid = intval($row['sid']);
				$said = substr($row['aid'], 0,25);
				if ((empty($row['alanguage']))) {
					$alanguage = _ALL;
				} else {
					$alanguage = $row['alanguage'];
				}

				formatTimestamp($row['time']);

				echo '<tr><td align="right"><b>'.$sid.'</b>'
					.'</td><td align="left" width="100%"><a href="modules.php?name=News&amp;file=article&amp;sid='.$sid.'">'.$row['title'].'</a>'
					.'</td><td align="center">'.$alanguage
					.'</td><td align="right">'.$row['topicname'];
				if ($radminarticle == 1 OR $radminsuper == 1) {
					if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
						echo '</td><td align="right" nowrap="nowrap">(<a href="'.$admin_file.'.php?op=EditStory&amp;sid='.$sid.'">'._EDIT.'</a>-<a href="'.$admin_file.'.php?op=RemoveStory&amp;sid='.$sid.'">'._DELETE.'</a>)'
							.'</td></tr>';
					} else {
						echo '</td><td align="right" nowrap="nowrap"><font class="content"><i>('._NOFUNCTIONS.')</i></font>'
							.'</td></tr>';
					}
				} else {
					echo '</td></tr>';
				}
			}
			echo '</table></center>';
		}
		if (($radminarticle==1) OR ($radminsuper==1)) {
			echo '<center>'
				.'<form action="'.$admin_file.'.php" method="post">'
				.'<table><tr><td>'
				._STORYID.': <input type="text" name="sid" size="10" /></td>'
				.'<td><select name="op">'
				.'<option value="EditStory" selected="selected">'._EDIT.'</option>'
				.'<option value="RemoveStory">'._DELETE.'</option>'
				.'</select></td>'
				.'<td><input type="submit" value="'._GO.'" /></td></tr></table>'
				.'</form></center>';
		}
		CloseTable();
	}
	if (is_active('Surveys')) {
		list($pollID, $pollTitle) = $db->sql_fetchrow($db->sql_query('SELECT pollID, pollTitle FROM '.$prefix.'_poll_desc WHERE artid=0 ORDER BY pollID DESC LIMIT 1'));
		$pollID = intval($pollID);
		echo '<br />';
		OpenTable();
		echo '<center><b>'._CURRENTPOLL.':</b> '.$pollTitle.' [ <a href="'.$admin_file.'.php?op=polledit&amp;pollID='.$pollID.'">'._EDIT.'</a> | <a href="'.$admin_file.'.php?op=create">'._ADD.'</a> ]</center>';
		CloseTable();
	}
	unset($title);
	include_once('footer.php');
}

if($admintest) {
	switch($op) {
		case 'do_gfx':
			/*****[BEGIN]******************************************
			 [ Base:		GFX Code					 v1.0.0 ]
			 ******************************************************/
			gen_old_gfx();
			/*****[END]********************************************
			 [ Base:		GFX Code					 v1.0.0 ]
			 ******************************************************/
			break;

		case 'GraphicAdmin':
			GraphicAdmin();
			break;

		case 'adminMain':
			adminMain();
			break;

		case 'logout':
			setcookie('admin', false);
			$admin = '';
			include_once('header.php');
			OpenTable();
			echo '<center><font class="title"><b>'._YOUARELOGGEDOUT.'</b></font></center>';
			CloseTable();
			Header('Refresh: 3; url='.$admin_file.'.php');
			include_once('footer.php');
			break;

		case 'login';
			unset($op);

		default:
			if (!is_admin($admin)) {
				login();
			}
			$casedir = dir('admin/case');
			while($func=$casedir->read()) {
				if(substr($func, 0, 5) == 'case.') {
					include_once($casedir->path."/$func");
				}
			}
			closedir($casedir->handle);
			$result = $db->sql_query('SELECT title FROM '.$prefix.'_modules ORDER BY title ASC');
			while (list($mod_title) = $db->sql_fetchrow($result)) {
				if (file_exists('modules/'.$mod_title.'/admin/index.php') AND file_exists('modules/'.$mod_title.'/admin/links.php') AND file_exists('modules/'.$mod_title.'/admin/case.php')) {
					include_once('modules/'.$mod_title.'/admin/case.php');
				}
			}
			break;
	}

} else {
	switch($op) {
		default:
			login();
			break;
	}
}

?>
