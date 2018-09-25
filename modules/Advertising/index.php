<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2005 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Google Page Rank Calculation                                         */
/* Copyright 2004 by GoogleCommunity.com                                */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************/
/* Additional code clean-up, performance enhancements, and W3C and      */
/* XHTML compliance fixes by Raven and Montego.                         */
/************************************************************************/

// This system includes Google Page Rank Calculation made by GoogleCommunity.com
// Don't abuse this script. It's here for your use, to give accurate information
// about your site to your potential advertising customers. If you need the complete
// Google Page Rank Calculator script, please go to: http://www.GoogleCommunity.com
// and download the latest and stand alone release.

if (!defined('MODULE_FILE')) {
	die('You can\'t access this file directly...');
}
require_once('mainfile.php');
$module_name = basename(dirname(__FILE__));
get_lang($module_name);
if (!isset($op)) $op = '';
switch ($op) {
	default:
		theindex();
		break;
	case 'sitestats':
		sitestats();
		break;
	case 'plans':
		plans();
		break;
	case 'terms':
		terms();
		break;
	case 'client':
		client();
		break;
	case 'client_home':
		client_home();
		break;
	case 'client_valid':
		csrf_check();
		client_valid($login, $pass);
		break;
	case 'client_logout':
		client_logout();
		break;
	case 'client_report':
		client_report($cid, $bid);
		break;
	case 'view_banner':
		view_banner($cid, $bid);
		break;
}
die();
/**
 * ONLY functions beyond this point
 */
function client() {
	global $module_name, $prefix, $db, $sitename, $client;
	if (is_client($client)) {
		Header('Location: modules.php?name=' . $module_name . '&op=client_home');
	} else {
		include_once('header.php');
		title($sitename . ': ' . _ADSYSTEM);
		OpenTable();
		echo '<center><span class="title"><b>' . _CLIENTLOGIN . '</b></span></center><br />';
		echo '<form method="post" action="modules.php?name=' . $module_name . '"><table border="0" align="center" cellpadding="3">';
		echo '<tr><td align="right">' . _LOGIN . ':</td><td><input type="text" name="login" size="15" /></td></tr>';
		echo '<tr><td align="right">' . _PASSWORD . ':</td><td><input type="password" name="pass" size="15" /></td></tr>';
		echo '<tr><td>&nbsp;</td><td><input type="hidden" name="op" value="client_valid" /><input type="submit" value="' . _ENTER . '" /></td></tr></table></form>';
		CloseTable();
		themenu();
		include_once('footer.php');
	}
}
function client_home() {
	global $prefix, $db, $sitename, $bgcolor2, $module_name, $client;
	if (!is_client($client)) {
		Header('Location: modules.php?name=' . $module_name . '&op=client');
		die();
	} else {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(':', $client);
		$cid = intval($client[0]); // RN0000990
		$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\''));
		$client_name = $row['name']; // RN0000284 - avoid unnecessary future DB call
		include_once('header.php');
		title($sitename . ' ' . _ADSYSTEM);
		OpenTable();
		echo '<center>' . _ACTIVEADSFOR . ' ' . $client_name . '</center><br />' //RN0000284
			. '<table width="100%" border="1"><tr>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _NAME . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPMADE . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPTOTAL . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPLEFT . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _CLICKS . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>% ' . _CLICKS . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _TYPE . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _FUNCTIONS . '</b></td></tr>';
		$sql = 'SELECT * FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\' AND active=\'1\''; //RN0000990
		$result = $db->sql_query($sql);
		// RN0000990 - although intvals are not necessary coming out of a db with numeric fields, I just got rid of the multiple lines of code
		while ($row = $db->sql_fetchrow($result)) {
			$bid = intval($row['bid']);
			$imptotal = intval($row['imptotal']);
			$impmade = intval($row['impmade']);
			$clicks = intval($row['clicks']);
			$date = $row['date'];
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100*$clicks/$impmade, 0, 5);
				$percent = $percent . '%';
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
				$clicks = 'N/A';
				$percent = 'N/A';
			}
			if ($row['name'] == '') {
				$row['name'] = _NONE;
			}
			echo '<tr><td align="center">' . $row['name'] . '</td>'
				. '<td align="center">' . $impmade . '</td>'
				. '<td align="center">' . $imptotal . '</td>'
				. '<td align="center">' . $left . '</td>'
				. '<td align="center">' . $clicks . '</td>'
				. '<td align="center">' . $percent . '</td>'
				. '<td align="center">' . ucFirst($row['ad_class']) . '</td>'
				. '<td align="center"><a href="modules.php?name=' . $module_name . '&amp;op=client_report&amp;cid=' . $cid . '&amp;bid=' . $bid . '"><img src="images/edit.gif" border="0" alt="' . _EMAILSTATS . '" title="' . _EMAILSTATS . '" /></a>  <a href="modules.php?name=' . $module_name . '&amp;op=view_banner&amp;cid=' . $cid . '&amp;bid=' . $bid . '"><img src="images/view.gif" border="0" alt="' . _VIEWBANNER . '" title="' . _VIEWBANNER . '" /></a></td></tr>';
		}
		echo '</table>';
		echo '<br /><br /><center>' . _INACTIVEADS . ' ' . $client_name . '</center><br />' //RN0000284
			. '<table width="100%" border="1"><tr>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _NAME . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPMADE . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPTOTAL . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPLEFT . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _CLICKS . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>% ' . _CLICKS . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _TYPE . '</b></td>'
			. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _FUNCTIONS . '</b></td></tr>';
		$sql = 'SELECT * FROM ' . $prefix . '_banner WHERE cid=\'' . $cid . '\' AND active=\'0\''; //RN0000990
		$result = $db->sql_query($sql);
		$a = 0;
		// RN0000990 - although intvals are not necessary coming out of a db with numeric fields, I just got rid of the multiple lines of code
		while ($row = $db->sql_fetchrow($result)) {
			$bid = intval($row['bid']);
			$imptotal = intval($row['imptotal']);
			$impmade = intval($row['impmade']);
			$clicks = intval($row['clicks']);
			$date = $row['date'];
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100*$clicks/$impmade, 0, 5);
				$percent = $percent . '%';
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
				$clicks = 'N/A';
				$percent = 'N/A';
			}
			if ($row['name'] == '') {
				$row['name'] = _NONE;
			}
			echo '<tr><td align="center">' . $row['name'] . '</td>'
				. '<td align="center">' . $impmade . '</td>'
				. '<td align="center">' . $imptotal . '</td>'
				. '<td align="center">' . $left . '</td>'
				. '<td align="center">' . $clicks . '</td>'
				. '<td align="center">' . $percent . '</td>'
				. '<td align="center">' . ucFirst($row['ad_class']) . '</td>'
				. '<td align="center"><a href="modules.php?name=' . $module_name . '&amp;op=client_report&amp;cid=' . $cid . '&amp;bid=' . $bid . '"><img src="images/edit.gif" border="0" alt="' . _EMAILSTATS . '" title="' . _EMAILSTATS . '" /></a>  <a href="modules.php?name=' . $module_name . '&amp;op=view_banner&amp;cid=' . $cid . '&amp;bid=' . $bid . '"><img src="images/view.gif" border="0" alt="' . _VIEWBANNER . '" title="' . _VIEWBANNER . '" /></a></td></tr>';
			$a = 1;
		}
		if ($a != 1) {
			echo '<tr><td align="center" colspan="8"><i>' . _NOCONTENT . '</i></td></tr>';
		}
		echo '</table><br /><br /><center>[ <a href="modules.php?name=' . $module_name . '&amp;op=client_logout">' . _LOGOUT . '</a> ]</center>';
		CloseTable();
		themenu();
		include_once('footer.php');
	}
}
function client_logout() {
	global $module_name;
	$client = '';
	setcookie('client');
	Header('Location: modules.php?name=' . $module_name . '&op=client');
	die();
}
function client_report($cid, $bid) {
	global $prefix, $db, $module_name, $client, $sitename, $adminmail;
	if (!is_client($client)) {
		Header('Location: modules.php?name=' . $module_name . '&op=client');
		die();
	} else {
		$bid = intval($bid); // RN0000990
		$cid = intval($cid); // RN0000990
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(':', $client);
		$client_id = intval($client[0]); // RN0000990
		if ($cid != $client_id) {
			include_once('header.php');
			title($sitename . ': ' . _ADSYSTEM);
			OpenTable();
			echo '<center>' . _FUNCTIONSNOTALLOWED . '<br /><br />' . _GOBACK . '</center>';
			CloseTable();
			themenu();
			include_once('footer.php');
			die();
		} else {
			include_once('header.php');
			title($sitename . ': ' . _ADSYSTEM);
			OpenTable();
			$sql = 'SELECT name, email FROM ' . $prefix . '_banner_clients WHERE cid=\'' . $cid . '\'';
			$result = $db->sql_query($sql);
			$row = $db->sql_fetchrow($result);
			$name = htmlentities($row['name']);
			$email = $row['email'];
			if ($email == '') {
				echo '<center><br /><br />'
					. '<b>' . _STATSNOTSEND . '</b><br /><br />'
					. '<a href="javascript:history.go(-1)">' . _GOBACK . '</a></center>';
				CloseTable();
				themenu();
				include_once('footer.php');
				die();
			} else {
				$sql2 = 'SELECT bid, name, imptotal, impmade, clicks, imageurl, clickurl, date, ad_class FROM ' . $prefix . '_banner WHERE bid=\'' . $bid . '\' AND cid=\'' . $cid . '\'';
				$result2 = $db->sql_query($sql2);
				$row2 = $db->sql_fetchrow($result2);
				// RN0000990 - although intvals are not necessary coming out of a db with numeric fields, I just got rid of the multiple lines of code
				$bid = intval($row2['bid']);
				$imptotal = intval($row2['imptotal']);
				$impmade = intval($row2['impmade']);
				$clicks = intval($row2['clicks']);
				$imageurl = $row2['imageurl'];
				$clickurl = $row2['clickurl'];
				$date = $row2['date'];
				if ($impmade == 0) {
					$percent = 0;
				} else {
					$percent = substr(100*$clicks/$impmade, 0, 5);
				}
				if ($imptotal == 0) {
					$left = _UNLIMITED;
					$imptotal = _UNLIMITED;
				} else {
					$left = $imptotal-$impmade;
				}
				$fecha = date('F jS Y, h:iA.');
				$subject = _YOURSTATS . ' ' . $sitename;
				if (empty($row2['ad_class']) || $row2['ad_class'] == 'image') {
					$message = _FOLLOWINGSTATS . " $sitename:\n\n\n" . _CLIENTNAME . ": $name\n" ._BANNERID . ": $bid\n" . _BANNERNAME . ": " . $row['name'] . "\n" . _BANNERIMAGE . ": $imageurl\n" . _BANNERURL . ": $clickurl\n\n" . _IMPPURCHASED . ": $imptotal\n" . _IMPREMADE . ": $impmade\n" . _IMPRELEFT . ": $left\n" . _RECEIVEDCLICKS . ": $clicks\n" . _CLICKSPERCENT . ": $percent%\n\n\n" . _GENERATEDON . ": $fecha";
				} elseif ($row2['ad_class'] == 'flash') {
					$message = _FOLLOWINGSTATS . " $sitename:\n\n\n" . _CLIENTNAME . ": $name\n" . _BANNERID . ": $bid\n" . _BANNERNAME . ": " . $row['name'] . "\n" . _FLASHMOVIE . ": $imageurl\n\n" . _IMPPURCHASED . ": $imptotal\n" . _IMPREMADE . ": $impmade\n" . _IMPRELEFT . ": $left\n" . _RECEIVEDCLICKS . ": N/A\n" . _CLICKSPERCENT . ": N/A\n\n\n" . _GENERATEDON . ": $fecha";
				} elseif ($row2['ad_class'] == 'code') {
					$message = _FOLLOWINGSTATS . " $sitename:\n\n\n" . _CLIENTNAME . ": $name\n" . _BANNERID . ": $bid\n" . _BANNERNAME . ": " . $row['name'] . "\n\n" . _IMPPURCHASED . ": $imptotal\n" . _IMPREMADE . ": $impmade\n" . _IMPRELEFT . ": $left\n" . _RECEIVEDCLICKS . ": N/A\n" . _CLICKSPERCENT . ": N/A\n\n\n" . _GENERATEDON . ": $fecha";
				}
				$from = $adminmail; // montego: was not providing a valid "from" email address before, so changed
			/*
			 * TegoNuke Mailer added by montego for 2.20.00
			 */
			$mailsuccess = false;
			if (defined('TNML_IS_ACTIVE')) {
				$to = array(array($email, $name));
				$mailsuccess = tnml_fMailer($to, $subject, $message, $from, $sitename);
			} else {
				$mailsuccess = mail($email, $subject, $message, "From: $sitename <$from>\r\nX-Mailer: PHP/" . phpversion());
			}
			if ($mailsuccess) {
					echo '<center><br />'
						. '<b>' . _STATSSENT . ' ' . $email . '</b><br />'
						. _GOBACK . '</center>';
				} else {
					echo '<center><br />' . _STATSSENTERROR . '<br /><br />' . "\n"
						. _GOBACK . '</center>';
				}
				//mail($email, $subject, $message, "From: $from\r\nX-Mailer: PHP/" . phpversion());
				/*
				* end of TegoNuke Mailer add
				*/
				CloseTable();
				themenu();
				include_once('footer.php');
			}
		}
	}
}
function client_valid($login, $pass) {
	global $prefix, $db, $module_name, $sitename;
	$login = addslashes(check_html($login, 'nohtml'));
	$pass = addslashes(check_html($pass, 'nohtml'));
	// RN0000284 - re-wrote this code to remove an extra SQL call
	$result = $db->sql_query('SELECT cid FROM ' . $prefix . '_banner_clients WHERE login=\'' . $login . '\' AND passwd=\'' . $pass . '\'');
	$numrows = $db->sql_numrows($result);
	if ($numrows != 1) {
		include_once('header.php');
		title($sitename . ': ' . _ADSYSTEM);
		OpenTable();
		echo '<center>' . _LOGININCORRECT . '<br /><br />' . _GOBACK . '</center>';
		CloseTable();
		themenu();
		include_once('footer.php');
		die();
	} else {
		$row = $db->sql_fetchrow($result);
		$cid = intval($row['cid']);
		$info = base64_encode($cid . ':' . $login . ':' . $pass);
		setcookie('client', $info, time() +3600);
		Header('Location: modules.php?name=' . $module_name . '&op=client_home');
	}
}
function getrank($url) {
	define('GOOGLE_MAGIC', 0xE6359A60);
	$url = 'info:' . $url;
	$ch = GoogleCH(strord($url));
	$file = 'http://www.google.com/search?client=navclient-auto&amp;ch=6' . $ch . '&amp;features=Rank&amp;q=' . $url;
	$data = file($file);
	$rankarray = explode(':', $data[2]);
	$rank = $rankarray[2];
	return $rank;
}
function GoogleCH($url, $length = null, $init = GOOGLE_MAGIC) {
	if (is_null($length)) {
		$length = sizeof($url);
	}
	$a = $b = 0x9E3779B9;
	$c = $init;
	$k = 0;
	$len = $length;
	while ($len >= 12) {
		$a+=($url[$k+0]+($url[$k+1]<<8) +($url[$k+2]<<16) +($url[$k+3]<<24));
		$b+=($url[$k+4]+($url[$k+5]<<8) +($url[$k+6]<<16) +($url[$k+7]<<24));
		$c+=($url[$k+8]+($url[$k+9]<<8) +($url[$k+10]<<16) +($url[$k+11]<<24));
		$mix = mix($a, $b, $c);
		$a = $mix[0];
		$b = $mix[1];
		$c = $mix[2];
		$k+=12;
		$len-=12;
	}
	$c+=$length;
	switch($len) {
		case 11: $c+=($url[$k+10]<<24);
		case 10: $c+=($url[$k+9]<<16);
		case 9 : $c+=($url[$k+8]<<8);
		case 8 : $b+=($url[$k+7]<<24);
		case 7 : $b+=($url[$k+6]<<16);
		case 6 : $b+=($url[$k+5]<<8);
		case 5 : $b+=($url[$k+4]);
		case 4 : $a+=($url[$k+3]<<24);
		case 3 : $a+=($url[$k+2]<<16);
		case 2 : $a+=($url[$k+1]<<8);
		case 1 : $a+=($url[$k+0]);
	}
	$mix = mix($a, $b, $c);
	return $mix[2];
}
function is_client($client) {
	global $prefix, $db;
	if (!is_array($client)) {
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(':', $client);
		$cid = $client[0];
		if (isset($client[2])) {
			$pwd = $client[2];
		}
	} else {
		$cid = $client[0];
		if (isset($client[2])) {
			$pwd = $client[2];
		}
	}
	if (!empty($cid) AND !empty($pwd)) {
		$result = $db->sql_query('SELECT passwd FROM ' . $prefix . '_banner_clients WHERE cid=\'' . intval($cid) . '\''); //RN0000990
		$row = $db->sql_fetchrow($result);
		$pass = $row['passwd'];
		if (!empty($pass) AND $pass == $pwd) {
			return 1;
		}
	}
	return 0;
}
function mix($a, $b, $c) {
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,13));
  $b -= $c; $b -= $a; $b ^= ($a<<8);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,13));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,12));
  $b -= $c; $b -= $a; $b ^= ($a<<16);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,5));
  $a -= $b; $a -= $c; $a ^= (zeroFill($c,3));
  $b -= $c; $b -= $a; $b ^= ($a<<10);
  $c -= $a; $c -= $b; $c ^= (zeroFill($b,15));
  return array($a,$b,$c);
}
function plans() {
	global $module_name, $prefix, $db, $bgcolor2, $sitename;
	include_once('header.php');
	title($sitename . ': ' . _PLANSPRICES);
	OpenTable();
	// RN0000284 - re-wrote this code to remove an extra SQL call
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_banner_plans WHERE active=\'1\'');
	$numrows = $db->sql_numrows($result);
	if ($numrows > 0) {
		echo _LISTPLANS . '<br /><br />';
		echo '<table border="1" width="100%" cellpadding="3">';
		echo '<tr><td align="center" nowrap="nowrap" bgcolor="' . $bgcolor2 . '"><b>' . _PLANNAME . '</b></td><td bgcolor="' . $bgcolor2 . '">&nbsp;<b>' . _DESCRIPTION . '</b></td><td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _QUANTITY . '</b></td><td align="center" bgcolor="' . $bgcolor2 . '"><b>' . _PRICE . '</b></td><td align="center" bgcolor="' . $bgcolor2 . '" nowrap="nowrap"><b>' . _BUYLINKS . '</b></td></tr>';
		while ($row = $db->sql_fetchrow($result)) {
			if ($row['delivery_type'] == '0') {
				$delivery = _IMPRESSIONS;
			} elseif ($row['delivery_type'] == '1') {
				$delivery = _CLICKS;
			} elseif ($row['delivery_type'] == '2') {
				$delivery = _DAYS;
			} elseif ($row['delivery_type'] == '3') {
				$delivery = _MONTHS;
			} elseif ($row['delivery_type'] == '4') {
				$delivery = _YEARS;
			}
			echo '<tr><td valign="top"><b>' . $row['name'] . '</b></td><td valign="top">' . $row['description'] . '</td><td valign="top"><center>' . $row['delivery'] . '<br />' . $delivery . '</center></td><td valign="top">' . $row['price'] . '</td><td valign="top" nowrap="nowrap"><center>' . $row['buy_links']. '</center></td></tr>';
		}
		echo '</table>';
	} else {
		echo '<center>' . _ADSNOCONTENT . '<br /><br />' . _GOBACK . '</center>';
	}
	CloseTable();
	themenu();
	include_once('footer.php');
}
function sitestats() {
	global $module_name, $prefix, $db, $user_prefix, $nukeurl, $sitename;
	$url = $nukeurl;
	$result = $db->sql_query('SELECT hits FROM ' . $prefix . '_stats_year WHERE hits!=\'0\'');
	$hits = 0;
	$a = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$hits = $hits+$row['hits'];
		$a++;
	}
	$views_y = $hits/$a;
	$result = $db->sql_query('SELECT hits FROM ' . $prefix . '_stats_month WHERE hits!=\'0\'');
	$hits = 0;
	$a = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$hits = $hits+$row['hits'];
		$a++;
	}
	$views_m = $hits/$a;
	$result = $db->sql_query('SELECT hits FROM ' . $prefix . '_stats_date WHERE hits!=\'0\'');
	$hits = 0;
	$a = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$hits = $hits+$row['hits'];
		$a++;
	}
	$views_d = $hits/$a;
	$result = $db->sql_query('SELECT hits FROM ' . $prefix . '_stats_hour WHERE hits!=\'0\'');
	$hits = 0;
	$a = 0;
	while ($row = $db->sql_fetchrow($result)) {
		$hits = $hits+$row['hits'];
		$a++;
	}
	$views_h = $hits/$a;
	$views_y = round($views_y);
	$views_m = round($views_m);
	$views_d = round($views_d);
	$views_h = round($views_h);
	$row = $db->sql_fetchrow($db->sql_query('SELECT count FROM ' . $prefix . '_counter WHERE type=\'total\''));
	$views_t = $row['count'];
	$regusers = $db->sql_numrows($db->sql_query('SELECT user_id FROM ' . $user_prefix . '_users'));
	include_once('header.php');
	title($sitename . ': ' . _GENERALSTATS);
	OpenTable();
	echo _HEREARENUMBERS . '<br /><br /><br />'
		. '<table>'
		. '<tr><td>' . _TOTALVIEWS . '</td><td><b>' . $views_t . '</b></td></tr>'
		. '<tr><td>' . _VIEWSYEAR . '</td><td><b>' . $views_y . '</b></td></tr>'
		. '<tr><td>' . _VIEWSMONTH . '</td><td><b>' . $views_m . '</b></td></tr>'
		. '<tr><td>' . _VIEWSDAY . '</td><td><b>' . $views_d . '</b></td></tr>'
		. '<tr><td>' . _VIEWSHOUR . '</td><td><b>' . $views_h . '</b></td></tr>'
		. '<tr><td>' . _CURREGUSERS . '</td><td><b>' . $regusers . '</b></td></tr>'
		. '</table>';
	if ($url != 'http://--------.---') {
		//echo "<li>"._GOOGLERANK." <b>".getrank($url)."</b><br /><br />";
	}
	CloseTable();
	themenu();
	include_once('footer.php');
}
function strord($string) {
	$j = strlen($string); // RN0000284 - moved this out of the for loop for performance
	for ($i = 0;$i < $j;$i++) {
		$result[$i] = ord($string{$i});
	}
	return $result;
}
function terms() {
	global $module_name, $prefix, $db, $sitename;
	$today = getdate();
	$month = $today['mon'];
	if ($month == 1) {
		$month = _JANUARY;
	} elseif ($month == 2) {
		$month = _FEBRUARY;
	} elseif ($month == 3) {
		$month = _MARCH;
	} elseif ($month == 4) {
		$month = _APRIL;
	} elseif ($month == 5) {
		$month = _MAY;
	} elseif ($month == 6) {
		$month = _JUNE;
	} elseif ($month == 7) {
		$month = _JULY;
	} elseif ($month == 8) {
		$month = _AUGUST;
	} elseif ($month == 9) {
		$month = _SEPTEMBER;
	} elseif ($month == 10) {
		$month = _OCTOBER;
	} elseif ($month == 11) {
		$month = _NOVEMBER;
	} elseif ($month == 12) {
		$month = _DECEMBER;
	}
	$year = $today['year'];
	include_once('header.php');
	title($sitename . ': ' . _TERMSCONDITIONS);
	$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner_terms'));
	$row['country'] = htmlspecialchars($row['country']); // montego - necessary for XHTML compliance on countries with "&" in them
	$terms = eregi_replace('\[sitename\]', $sitename, $row['terms_body']);
	$terms = eregi_replace('\[country\]', $row['country'], $terms);
	OpenTable();
	echo '<center><span class="title"><b>' . $sitename . ': ' . _TERMSCONDITIONS . '</b></span></center><br /><br />'
		. '<div>' . $terms . '</div>'
		. '<p align="right">' . $row['country'] . ', ' . $month . ' ' . $year . '</p>';
	CloseTable();
	themenu();
	include_once('footer.php');
}
function theindex() {
	global $prefix, $db, $sitename;
	include_once('header.php');
	title($sitename . ' ' . _ADVERTISING);
	OpenTable();
	echo _WELCOMEADS;
	CloseTable();
	themenu();
	include_once('footer.php');
}
function themenu() {
	global $module_name, $prefix, $db, $client, $op;
	echo '<br />';
	if (is_client($client)) {
		if ($op == 'client_home') {
			$client_opt = 'My Ads';
		} else {
			$client_opt = '<a href="modules.php?name=' . $module_name . '&amp;op=client_home">' . _MYADS . '</a>';
		}
	} else {
		$client_opt = '<a href="modules.php?name=' . $module_name . '&amp;op=client">' . _CLIENTLOGIN . '</a>';
	}
	OpenTable();
	echo '<center><b>' . _ADSMENU . '</b><br /><br />[ <a href="modules.php?name=' . $module_name . '">' . _MAINPAGE . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=sitestats">' . _SITESTATS . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=terms">' . _TERMS . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=plans">' . _PLANSPRICES . '</a> | ' . $client_opt . ' ]</center>';
	CloseTable();
}
function view_banner($cid, $bid) {
	global $prefix, $db, $module_name, $client, $bgcolor2, $sitename;
	if (!is_client($client)) {
		Header('Location: modules.php?name=' . $module_name . '&op=client');
		die();
	} else {
		$cid = intval($cid); // RN0000990
		$client = base64_decode($client);
		$client = addslashes($client);
		$client = explode(':', $client);
		$client_id = intval($client[0]); // RN0000990
		if ($cid != $client_id) {
			include_once('header.php');
			title($sitename . ' ' . _ADSYSTEM);
			OpenTable();
			echo '<center>' . _ADISNTYOUR . '<br /><br />' . _GOBACK . '</center>';
			CloseTable();
			themenu();
			include_once('footer.php');
			die();
		} else {
			include_once('header.php');
			title($sitename . ' ' . _ADSYSTEM);
			OpenTable();
			$row = $db->sql_fetchrow($db->sql_query('SELECT * FROM ' . $prefix . '_banner WHERE bid=\'' . intval($bid) . '\''));
			$cid = intval($row['cid']);
			$bid = intval($row['bid']); // RN0000990
			$imptotal = intval($row['imptotal']);
			$impmade = intval($row['impmade']);
			$clicks = intval($row['clicks']);
			$imageurl = $row['imageurl'];
			$clickurl = $row['clickurl'];
			$ad_class = $row['ad_class'];
			$ad_code = $row['ad_code'];
			$ad_width = $row['ad_width'];
			$ad_height = $row['ad_height'];
			$alttext = $row['alttext'];
			$date = $row['date'];
			echo '<center><span class="title"><b>' . _YOURBANNER . ': ' . $row['name'] . '</b></span></center><br /><br />';
			if ($ad_class == 'code') {
				$ad_code = $ad_code;
				echo '<div align="center">' . $ad_code . '</div><br /><br />';
			} elseif ($ad_class == 'flash') {
				echo "<center>
					<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
					codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"
					WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\" id=\"$bid\">
					<PARAM NAME=movie VALUE=\"$imageurl\">
					<PARAM NAME=quality VALUE=high>
					<EMBED src=\"$imageurl\" quality=high WIDTH=\"$ad_width\" HEIGHT=\"$ad_height\"
					NAME=\"$bid\" ALIGN=\"\" TYPE=\"application/x-shockwave-flash\"
					PLUGINSPAGE=\"http://www.macromedia.com/go/getflashplayer\">
					</EMBED>
					</OBJECT>
					</center><br /><br />";
			} else {
				echo '<center><img src="' . $imageurl . '" border="1" alt="' . $alttext . '" title="' . $alttext . '" width="' . $ad_width . '" height="' . $ad_height . '" /></center><br /><br />';
			}
			echo '<center>Banner Information: ' . $row['name'] . '</center><br />'
				. '<table width="100%" border="1"><tr>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _NAME . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPMADE . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPTOTAL . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _IMPLEFT . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _CLICKS . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>% ' . _CLICKS . '</b></td>'
				. '<td bgcolor="' . $bgcolor2 . '" align="center"><b>' . _TYPE . '</b></td></tr>';
			if ($impmade == 0) {
				$percent = 0;
			} else {
				$percent = substr(100*$clicks/$impmade, 0, 5);
				$percent = $percent . '%';
			}
			if ($imptotal == 0) {
				$left = _UNLIMITED;
				$imptotal = _UNLIMITED;
			} else {
				$left = $imptotal-$impmade;
			}
			if ($row['ad_class'] == 'flash' || $row['ad_class'] == 'code') {
				$clicks = 'N/A';
				$percent = 'N/A';
			}
			if ($row['name'] == '') {
				$row['name'] = _NONE;
			}
			if ($row['active'] == 1) {
				$status = _ACTIVE;
			} elseif ($row['active'] == 0) {
				$status = _INACTIVE;
			}
			echo '<tr><td align="center">' . $row['name'] . '</td>'
				. '<td align="center">' . $impmade . '</td>'
				. '<td align="center">' . $imptotal . '</td>'
				. '<td align="center">' . $left . '</td>'
				. '<td align="center">' . $clicks . '</td>'
				. '<td align="center">' . $percent . '</td>'
				. '<td align="center">' . ucFirst($row['ad_class']) . '</td></tr><tr>'
				. '<td align="center" colspan="7">' . _CURRENTSTATUS . ' ' . $status . '</td></tr>'
				. '</table><br /><br />'
				. '<center>[ <a href="modules.php?name=' . $module_name . '&amp;op=client_report&amp;cid=' . $cid . '&amp;bid=' . $bid . '">' . _EMAILSTATS . '</a> | <a href="modules.php?name=' . $module_name . '&amp;op=client_logout">' . _LOGOUT . '</a> ]</center>';
			CloseTable();
			themenu();
			include_once('footer.php');
		}
	}
}
function zeroFill($a, $b) {
	$z = hexdec(80000000);
	if ($z&$a) {
		$a = ($a>>1);
		$a&=(~$z);
		$a|=0x40000000;
		$a = ($a>>($b-1));
	} else {
		$a = ($a>>$b);
	}
	return $a;
}
?>