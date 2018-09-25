<?php
/**********************************************************************/
/* PHP-NUKE: Web Portal System								*/
/* ===========================								*/
/*													*/
/* Copyright (c) 2002 by Francisco Burzi							*/
/* http://phpnuke.org										*/
/*													*/
/* This program is free software. You can redistribute it and/or modify		*/
/* it under the terms of the GNU General Public License as published by		*/
/* the Free Software Foundation; either version 2 of the License.			*/
/*********************************************************************/
/*********************************************************************/
/* WhoIsWhere by Gaylen Fraley (aka Raven) 						*/
/* http://www.ravenwebhosting.com								*/
/* http://www.ravenphpscripts.com								*/
/*********************************************************************/

isset($_POST['language']) ? $language = basename(strip_tags($_POST['language'])) : $language = 'english';
if (!defined('INCLUDE_PATH')) define('INCLUDE_PATH', '../../');
require INCLUDE_PATH . 'config.php';
include INCLUDE_PATH . 'language/lang-' . $language . '.php';

global $db, $prefix, $user_prefix;

define('_RWS_WIW_TABLE_SESSION', $prefix . '_session');
define('_RWS_WIW_TABLE_USERS', $user_prefix . '_users');
define('_RWS_WIW_TABLE_HEAP', $prefix . '_wiw_m');
define('_RWS_WIW_TABLE_CONFIG', $prefix . '_config');
define('_RWS_WIW_TABLE_MODULES', $prefix . '_modules');

$db = mysql_connect($dbhost, $dbuname, $dbpass) or die('<br />' . _RWS_WIW_UNABLECONNECTSERVER . _RWS_WIW_MYSQLSAID . ': ' . mysql_error());
mysql_select_db($dbname) or die('<br />' . _RWS_WIW_UNABLECONNECTDB . _RWS_WIW_MYSQLSAID . ': ' . mysql_error());

$sql = 'SELECT * FROM ' . _RWS_WIW_TABLE_SESSION;
$result = mysql_query($sql) or die('<br />' . _RWS_WIW_MYSQLSAID . ': ' . mysql_error());
if ($result && (mysql_num_rows($result) > 0)) {
	$registered = array();
	$guest = array();
	while ($row=mysql_fetch_row($result)) {
		if (!$row[3]) $registered[] = $row[0];
		else $guest[] = $row[0];
	}
}

echo '<b><u>' . _RWS_WIW_GUESTSONLINE . '</u></b><br />' . count($guest) . ' ' . _RWS_WIW_GUESTS;
echo '<br /><br />';
$reg = '';
$wol = '';
$regCount = count($registered);
$notHiddenCount = 0;
for ($i=0;$i<$regCount;$i++) {
	if ($i==0) {
		$comma = '';
		$lb = '';
	} else {
		$lb='<br />';
		$comma = ',';
	}
	$result2 = mysql_query('SELECT user_allow_viewonline HIDE FROM ' . _RWS_WIW_TABLE_USERS . ' WHERE username=\'' . mysql_real_escape_string($registered[$i]) . '\';');
	$row2=mysql_fetch_row($result2);
	if (!$row2[0]) continue;
	$cmd = mysql_query('SELECT mn FROM ' . _RWS_WIW_TABLE_HEAP . ' WHERE who=\'' . mysql_real_escape_string($registered[$i]) . '\'');
	$data = mysql_fetch_row($cmd);
	if (is_null($data[0])) $data[0] = _RWS_WIW_HOME;
	$reg .= $lb.'<b>' . $registered[$i] . '</b><br />&nbsp;&nbsp;' . str_replace('_',' ',$data[0]);
	$wol .= $comma . "'" . $registered[$i] . "'";
	$notHiddenCount++;
}

if (!empty($reg)) {
	$delSql = 'DELETE FROM ' . _RWS_WIW_TABLE_HEAP . ' WHERE who NOT IN (' . $wol . ')';
	mysql_query($delSql);
	if (substr($reg,0,2)==', ') $reg = substr($reg,2);
	$reg = '<b><u>' . $notHiddenCount . ' ' . _RWS_WIW_USERSONLINE . '</u></b><br />' . $reg;
	echo $reg;
	echo '<br /><br />';
}

isset($_POST['refreshRate']) ? $refreshRate = intval($_POST['refreshRate'])/1000 : $refreshRate = '60';
echo '<center>('.$refreshRate.' '._RWS_WIW_REFRESH.')</center>';
if ($result) mysql_free_result($result);
if ($result2) mysql_free_result($result2);
if ($cmd) mysql_free_result($cmd);

?>