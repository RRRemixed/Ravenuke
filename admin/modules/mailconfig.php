<?php
/**
 * TegoNuke Mailer: Replaces Native PHP Mail
 *
 * This add-on provides the ability for RavenNuke/PHP-Nuke email functions to
 * work properly even if the resident Host has disabled the PHP mail() function.
 * Additional code clean-up, XHTML compliance, and speed improvements were
 * made along the way.
 *
 * This add-on is a combination of PHPNukeMailer (see credits below) and Swift
 * Mailer all integrated into one package for RavenNuke(tm) / PHP-Nuke.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: GNU/GPL 2
 *
 * @package     TegoNuke(tm)
 * @subpackage  Mailer
 * @category    "Plumbing"
 * @author      Rob Herder (aka: montego) <montego@montegoscripts.com>
 * @copyright   2007 - 2008 by Montego Scripts
 * @license     http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GNU/GPL 2
 * @version     1.0.1
 * @link        http://montegoscripts.com
*/
/*****************************************************/
/* PhpNukeMailer v1.0.9 (Apr-11-2007)                */
/* By: Jonathan Estrella (kiedis.axl@gmail.com)      */
/* http://www.slaytanic.tk                           */
/* Copyright © 2004-2007 by Jonathan Estrella        */
/*****************************************************/
if (!defined('ADMIN_FILE')) {
	die('Access Denied');
}
if (!defined('NUKE_LANGUAGE_DIR')) define('NUKE_LANGUAGE_DIR', './language/');
global $admin_file, $currentlang, $language;
if (file_exists(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $currentlang . '.php')) {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $currentlang . '.php');
} elseif (file_exists(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $language . '.php')) {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-' . $language . '.php');
} else {
	include_once(NUKE_LANGUAGE_DIR . 'tegonuke/mailer/lang-english.php');
}
$ver = '1.0.1';
$aid = addslashes(substr("$aid", 0,25));
$row = $db->sql_fetchrow($db->sql_query('SELECT radminsuper FROM ' . $prefix . '_authors WHERE aid=\''.$aid.'\''));
if ($row['radminsuper'] == 1) {
	TableCheck();
	switch ($op) {
		case 'MailConfig':
			MailConfig();
			break;
		case 'PNMAbout':
			PNMAbout();
			break;
		case 'MailConfigSave':
			csrf_check();
			global $prefix, $db, $admin_file;
			$xpnm_is_active = intval($xpnm_is_active);
			$xmailer = intval($xmailer);
			$xsmtp_host = addslashes(check_html($xsmtp_host, 'nohtml'));
			$xsmtp_helo = addslashes(check_html($xsmtp_helo, 'nohtml'));
			$xsmtp_port = intval($xsmtp_port);
			$xsmtp_auth = intval($xsmtp_auth);
			$xsmtp_uname = addslashes(check_html($xsmtp_uname, 'nohtml'));
			$xsmtp_passw = addslashes(check_html($xsmtp_passw, 'nohtml'));
			$xsendmail_path = addslashes(check_html($xsendmail_path, 'nohtml'));
//			$xqmail_path = addslashes(check_html($xqmail_path, 'nohtml'));
			$result = $db->sql_query('UPDATE ' . $prefix . '_mail_config SET active=\'' . $xpnm_is_active
				. '\', mailer=\'' . $xmailer . '\', smtp_host=\'' . $xsmtp_host . '\', smtp_helo=\'' . $xsmtp_helo
				. '\', smtp_port=\'' . $xsmtp_port . '\', smtp_auth=\'' . $xsmtp_auth . '\', smtp_uname=\''
				. $xsmtp_uname . '\', smtp_passw=\'' . $xsmtp_passw . '\', sendmail_path=\'' . $xsendmail_path
				. '\''
				);
			Header('Location: ' . $admin_file . '.php?op=MailConfig');
			break;
	}
} else {
	echo 'Access Denied';
}
die();
/*
 * Only functions defined after this point
 */

/*********************************************************/
/* Configuration to Setup the PHPMailer Class            */
/*********************************************************/

function MailConfig() {
	global $prefix, $db, $admin_file, $textcolor1, $bgcolor2;
	include_once ('header.php');
?>
<script type="text/javascript" language="JavaScript">
function showSendOpts(val) {
	switch (val) {
		default:
			document.getElementById('tnml_DivSMTP').style.visibility = 'hidden';
			document.getElementById('tnml_DivSMTP').style.display = 'none';
			document.getElementById('tnml_DivSendMail').style.visibility = 'hidden';
			document.getElementById('tnml_DivSendMail').style.display = 'none';
			break;
		case '1':
			document.getElementById('tnml_DivSMTP').style.visibility = 'hidden';
			document.getElementById('tnml_DivSMTP').style.display = 'none';
			document.getElementById('tnml_DivSendMail').style.visibility = 'hidden';
			document.getElementById('tnml_DivSendMail').style.display = 'none';
			break;
		case '2':
			document.getElementById('tnml_DivSMTP').style.visibility = 'visible';
			document.getElementById('tnml_DivSMTP').style.display = 'inline';
			document.getElementById('tnml_DivSendMail').style.visibility = 'hidden';
			document.getElementById('tnml_DivSendMail').style.display = 'none';
			break;
		case '3':
			document.getElementById('tnml_DivSMTP').style.visibility = 'hidden';
			document.getElementById('tnml_DivSMTP').style.display = 'none';
			document.getElementById('tnml_DivSendMail').style.visibility = 'visible';
			document.getElementById('tnml_DivSendMail').style.display = 'inline';
			break;
	}
}
</script>
<?php
	$result = $db->sql_query('SELECT * FROM ' . $prefix . '_mail_config');
	$row = $db->sql_fetchrow($result);
	$pnm_is_active = intval($row['active']);
	$mailer = intval($row['mailer']);
	$smtp_host = $row['smtp_host'];
	$smtp_port = intval($row['smtp_port']);
	$smtp_helo = $row['smtp_helo'];
	$smtp_auth = intval($row['smtp_auth']);
	$smtp_uname = $row['smtp_uname'];
	$smtp_passw = $row['smtp_passw'];
	$sendmail_path = $row['sendmail_path'];
//	$qmail_path = $row['qmail_path'];
	$styleRowHdr = 'style="font-weight:bold;vertical-align:middle;width:30%;color:' . $textcolor1 . ';background-color:' . $bgcolor2 . ';"';
	$styleRowData = 'style="font-weight:none;vertical-align:middle;width:70%;"';
	OpenTable();
	echo '<center><p class="title">' . _TNML_MNU_MAILCFG_LAB . '</p>'
		. '[ <a href="' . $admin_file . '.php">' . _TNML_MNU_BACK2ADM_LAB . '</a> | '
		. '<a href="' . $admin_file . '.php?op=PNMAbout">' . _TNML_MNU_PNMABOUT_LAB . '</a> ]</center><br />'
		. '<hr /><br />';
	tnml_fShowHelpLegend();
	echo '<form action="' . $admin_file . '.php" method="post">';
	echo '<table width="70%" cellpadding="3" cellspacing="1" align="center">';
	echo '<tr>';
	echo '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_PNMACTIVATE_HLP, _TNML_PNMACTIVATE_LAB) . _TNML_PNMACTIVATE_LAB . '</td>';
	echo '<td ' . $styleRowData . '>';
	if ($pnm_is_active == 1) {
		echo '<input type="radio" name="xpnm_is_active" value="1" checked="checked" />' . _YES . ' &nbsp;';
		echo '<input type="radio" name="xpnm_is_active" value="0" />' . _NO;
	} else {
		echo '<input type="radio" name="xpnm_is_active" value="1" />' . _YES . ' &nbsp;';
		echo '<input type="radio" name="xpnm_is_active" value="0" checked="checked" />' . _NO;
	}
	echo '</td></tr>';
	echo '<tr>';
	echo '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SENDMETHOD_HLP, _TNML_SENDMETHOD_LAB) . _TNML_SENDMETHOD_LAB . '</td>';
	echo '<td ' . $styleRowData . '>';
	echo '<select name="xmailer" onchange="showSendOpts(this.value);">';
	$mailer1 = $mailer2 = $mailer3 = $mailer4 = '';
	$style1 = $style2 = $style3 = $style4 = ' style="display:none;visibility:hidden;"';
	if ($mailer == 1) {
		$mailer1 = ' selected="selected"';
		$style1 = ' style="display:inline;visibility:visible;"';
	} elseif ($mailer == 2) {
		$mailer2 = ' selected="selected"';
		$style2 = ' style="display:inline;visibility:visible;"';
	} elseif ($mailer == 3) {
		$mailer3 = ' selected="selected"';
		$style3 = ' style="display:inline;visibility:visible;"';
	}/* elseif ($mailer == 4) {
		$mailer4 = ' selected="selected"';
		$style4 = ' style="display:inline;visibility:visible;"';
	}*/
	echo '<option value="1"' . $mailer1 . '>Mail()</option>';
	echo '<option value="2"' . $mailer2 . '>SMTP</option>';
	echo '<option value="3"' . $mailer3 . '>SendMail</option>';
//	echo '<option value="4"' . $mailer4 . '>Qmail</option>';
	echo '</select>';
	echo '</td></tr></table>';
	/**
	 * SMTP ONLY Settings
	 */
	$innerHTMLSMTP = '';
	$innerHTMLSMTP .= '<table width="70%" cellpadding="3" cellspacing="1" align="center">';
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPHOST_HLP, _TNML_SMTPHOST_LAB) . _TNML_SMTPHOST_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	$innerHTMLSMTP .= '<input type="text" name="xsmtp_host" value="' . $smtp_host . '" size="30" />';
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPHELO_HLP, _TNML_SMTPHELO_LAB) . _TNML_SMTPHELO_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	$innerHTMLSMTP .= '<input type="text" name="xsmtp_helo" value="' . $smtp_helo . '" size="30" />';
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPPORT_HLP, _TNML_SMTPPORT_LAB) . _TNML_SMTPPORT_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	$innerHTMLSMTP .= '<input type="text" name="xsmtp_port" value="' . $smtp_port . '" size="4" maxlength="4" />';
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPAUTH_HLP, _TNML_SMTPAUTH_LAB) . _TNML_SMTPAUTH_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	if ($smtp_auth == 1) {
		$innerHTMLSMTP .= '<input type="radio" name="xsmtp_auth" value="1" checked="checked" />' . _YES
			. ' &nbsp;<input type="radio" name="xsmtp_auth" value="0" />' . _NO;
	} else {
		$innerHTMLSMTP .= '<input type="radio" name="xsmtp_auth" value="1" />' . _YES
		. ' &nbsp;<input type="radio" name="xsmtp_auth" value="0" checked="checked" />' . _NO;
	}
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPUSER_HLP, _TNML_SMTPUSER_LAB) . _TNML_SMTPUSER_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	$innerHTMLSMTP .= '<input type="text" name="xsmtp_uname" value="' . $smtp_uname . '" size="30" />';
	$innerHTMLSMTP .= '<tr>';
	$innerHTMLSMTP .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SMTPPASS_HLP, _TNML_SMTPPASS_LAB) . _TNML_SMTPPASS_LAB . '</td>';
	$innerHTMLSMTP .= '<td ' . $styleRowData . '>';
	$innerHTMLSMTP .= '<input type="text" name="xsmtp_passw" value="' . $smtp_passw . '" size="15" />';
	$innerHTMLSMTP .= '</table>';
	echo '<div id="tnml_DivSMTP"' . $style2 . '></div>';
	/**
	 * SendMail ONLY Settings
	 */
	$innerHTMLSendMail = '';
	$innerHTMLSendMail .= '<table width="70%" cellpadding="3" cellspacing="1" align="center">';
	$innerHTMLSendMail .= '<tr>';
	$innerHTMLSendMail .= '<td ' . $styleRowHdr . '>' . tnml_fShowHelp(_TNML_SENDMAIL_HLP, _TNML_SENDMAIL_LAB) . _TNML_SENDMAIL_LAB . '</td>';
	$innerHTMLSendMail .= '<td ' . $styleRowData . '>';
	$innerHTMLSendMail .= '<input type="text" name="xsendmail_path" value="' . $sendmail_path . '" size="30" />';
	$innerHTMLSendMail .= '</table>';
	echo '<div id="tnml_DivSendMail"' . $style3 . '></div>';
/*
 * Removing Qmail option for right now as Swift Mailer does not support this natively
 *
	echo '<tr bgcolor="' . $bgcolor4 . '">';
	echo '<td valign="middle">' . tnml_fShowHelp(_TNML_QMAIL_HLP, _TNML_QMAIL_LAB) . _TNML_QMAIL_LAB . '</td>';
	echo '<td valign="middle">';
	echo '<input type="text" name="xqmail_path" value="' . $qmail_path . '" size="30" />';
*/
	echo '<br /><hr />';
	echo '<br /><center><input type="hidden" name="op" value="MailConfigSave" />';
	echo '<input type="submit" value="' . _SAVECHANGES . '" /></center>';
	echo '<br /></form>';
	CloseTable();
	$strFind = array("'", '/');
	$strReplace = array('&#039;', '\/');
	$innerHTMLSMTP = str_replace($strFind, $strReplace, $innerHTMLSMTP);
	$innerHTMLSendMail = str_replace($strFind, $strReplace, $innerHTMLSendMail);
?>
<script type="text/javascript" language="JavaScript">
//<![CDATA[
document.getElementById('tnml_DivSMTP').innerHTML = '<?php echo $innerHTMLSMTP ?>';
document.getElementById('tnml_DivSendMail').innerHTML = '<?php echo $innerHTMLSendMail ?>';
//]]>
</script>
<?php
	echo '<script type="text/javascript" language="JavaScript" src="includes/tegonuke/help/wz_tooltip.js"></script>';
	include_once ('footer.php');
}
function PNMAbout() {
	global $ver;
	include_once('header.php');
	OpenTable();
	echo '<div align="center"><span class="title">TegoNuke Mailer ' . $ver . '</span><br /><br />'
		. 'Created by Rob Herder (aka: montego)<br /><a href="http://montegoscripts.com">montegoscripts.com</a>'
		. '<br />&copy; 2008<br /><br /><br />'
		. 'TegoNuke Mailer uses the administration/setup of PHPNukeMailer<br />'
		. 'and the more robust Swift Mailer to do the mailing.<br /><br /><br />'
		. '<span class="title">Original credits</span><br />Please consider donating to these fine projects<br /><br />'
		. '<b>PHPNukeMailer 1.0.9</b><br />Created by Jonathan Estrella<br />'
		. '<a href="http://www.slaytanic.tk">www.slaytanic.tk</a> || '
		. '<a href="http://www.metalrebelde.net.tc">www.metalrebelde.net.tc</a><br />'
		. '&copy; 2004 - 2008<br /><br />'
		. '<b>Swift Mailer 3.3.3</b><br />'
		. 'Created by Chris Corbyn<br /><a href="http://www.swiftmailer.org">www.swiftmailer.org</a>'
		. '<br />&copy; 2008<br /><br /><br />'
		. 'This program is free software. You can redistribute it and/or modify it'
		. 'under the terms of the GNU General Public License (GPL) as published by the Free Software Foundation; either '
		. 'version 2 of the License.<br /><br />' . _GOBACK . '</div>';
	CloseTable();
	include_once('footer.php');
}
/**
 * Function: TableCheck
 *
 * Checks for existence of the mail config table and if not there, creates it
 *
 * @return  boolean  true = success, false = failure
 */
function TableCheck() {
	global $db, $prefix;
	$exists = $db->sql_query('SELECT 1 FROM ' . $prefix . '_mail_config LIMIT 0');
	if ($exists) {
		return true;
	} else {
		$result = $db->sql_query('CREATE TABLE '.$prefix.'_mail_config (active TINYINT(1) NOT NULL default \'0\', '
			. 'mailer TINYINT(1) NOT NULL default \'1\', smtp_host varchar(255) NOT NULL default \'\', '
			. 'smtp_helo varchar(255) NOT NULL default \'\', smtp_port INT(10) NOT NULL default \'25\', '
			. 'smtp_auth TINYINT(1) NOT NULL default \'0\', smtp_uname varchar(255) NOT NULL default \'\', '
			. 'smtp_passw varchar(255) NOT NULL default \'\', sendmail_path varchar(255) NOT NULL default \'/usr/sbin/sendmail\', '
			. 'qmail_path varchar(255) NOT NULL default \'/var/qmail/bin/sendmail\', PRIMARY KEY  (mailer)) TYPE=MyISAM'
			);
		$result = $db->sql_query('INSERT INTO '.$prefix.'_mail_config VALUES (\'0\', \'1\', \'smtp.yourdomain.tld\', '
			. '\'smtp.yourdomain.tld\', \'25\', \'0\', \'user@yourdomain.tld\', \'userpassword\', \'/usr/sbin/sendmail\', '
			. '\'/var/qmail/bin/sendmail\')'
			);
		return false;
	}
}
/**
 * Function: tnml_fShowHelp
 *
 * Displays the pop-up help text
 *
 * @param   string  $sHelpTxt is the help text to display in the pop-up
 * @param   string  $sFieldNm is the field name to display in bold text
 * @return  string  HTML code for the IMG tag to show the pop-up help icon
 */
function tnml_fShowHelp($sHelpTxt='', $sFieldNm='') {
	$sStyle = 'style="cursor:help;border:0px"';
	$sHTMLTmp = '';
	$sHTML = '&nbsp;<img ' . $sStyle . ' src="images/tegonuke/help/question.png" '
		.'height="12" width="12" alt="" '
		.'onmouseover="return escape(\'';
	if ($sFieldNm != '') {
		$sHTMLTmp .= '<strong>'.$sFieldNm.':</strong>&nbsp;';
	}
	$sHTMLTmp .= $sHelpTxt;
	$sHTMLTmp = htmlspecialchars($sHTMLTmp);
	$sHTML .= addslashes($sHTMLTmp) .'\')" />&nbsp;';
	return $sHTML;
}
/**
 * Function: tnml_fShowHelpLegend
 *
 * Shows a standard legend for use of the pop-up help icon
 *
 * @return  string  HTML code for the IMG tag to show the pop-up help icon legend
 */
function tnml_fShowHelpLegend() {
	$sHTML	= '<p align="center">' . tnml_fShowHelp( _TNML_HLP_LEGEND_HLP, '' );
	$sHTML	.= ' = ' . _TNML_HLP_LEGEND_LAB .'</p>';
	echo $sHTML;
	return;
}
?>