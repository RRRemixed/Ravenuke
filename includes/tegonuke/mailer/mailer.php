<?php
/**
 * TegoNuke Mailer: Replaces Native PHP Mail
 *
 * Inspired by Nuke-Evolution and PHPNukeMailer.  Uses PHPNukeMailer for
 * the administration of the mailer functions and Swift Mailer library
 * of classes to perform the actual mail functions.
 *
 * Will be used to replace PHP mail() function throughout RavenNuke(tm) /
 * PHP-Nuke.  This has become necessary as Hosts have started locking down
 * access to the mail() function and requiring SMTP authentication.
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
$tnml_asCfg['mailer'] = intval($row['mailer']);
$tnml_asCfg['smtp_host'] = $row['smtp_host'];
$tnml_asCfg['smtp_port'] = intval($row['smtp_port']);
$tnml_asCfg['smtp_helo'] = $row['smtp_helo'];
$tnml_asCfg['smtp_auth'] = intval($row['smtp_auth']);
$tnml_asCfg['smtp_uname'] = $row['smtp_uname'];
$tnml_asCfg['smtp_passw'] = $row['smtp_passw'];
$tnml_asCfg['sendmail_path'] = $row['sendmail_path'];
//$tnml_asCfg['qmail_path'] = $row['qmail_path'];
/*
 * Load needed Swift Mailer scripts
 */
require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift.php';
require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift/Address.php';
//	require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift/Connection/Multi.php'; // will address multi-connections in a future release
/*
 * Only functions below this line
 */
function tnml_fMailer(&$to, $subject, $body, $from, $fromname='', $params='', $cc=null, $bcc=null, $attachment=null) {
	global $tnml_asCfg;
	if (empty($to)) return false;
	/*
	* Validate to and from information and build Swift Address objects
	*/
	if (!is_array($to)) {
		$oRecipients = new Swift_Address($to);
	} elseif (count($to) == 1) {
		$oRecipients = new Swift_Address(
			(is_array($to[0])) ? $to[0][0] : $to[0],
			(is_array($to[0]) && isset($to[0][1])) ? $to[0][1] : null
		);
	} else {
		$oRecipients =& new Swift_RecipientList();
		foreach($to as $recipient) {
			$oRecipients->addTo(
				(is_array($recipient) && isset($recipient[0])) ? $recipient[0] : $recipient,
				(is_array($recipient) && isset($recipient[1])) ? $recipient[1] : null
			);
		}
	}
	if (!empty($fromname)) {
		$oFrom = new Swift_Address($from, $fromname);
	} else {
		$oFrom = new Swift_Address($from);
	}
	/*
	* $tnml_asCfg['mailer'] controls the method of send as follows:
	* 1 = Native mail() function
	* 2 = SMTP
	* 3 = Sendmail
	*/
	if ($tnml_asCfg['mailer'] == 1) {
		require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift/Connection/NativeMail.php';
		$swift =& new Swift(new Swift_Connection_NativeMail());
	} elseif ($tnml_asCfg['mailer'] == 2) {
		require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift/Connection/SMTP.php';
		if ($tnml_asCfg['smtp_auth'] == 1) {
			$smtp =& new Swift_Connection_SMTP($tnml_asCfg['smtp_host'], $tnml_asCfg['smtp_port']);
			$smtp->setUsername($tnml_asCfg['smtp_uname']);
			$smtp->setpassword($tnml_asCfg['smtp_passw']);
			$swift =& new Swift($smtp);
		} else {
			$swift =& new Swift(new Swift_Connection_SMTP($tnml_asCfg['smtp_host'], $tnml_asCfg['smtp_port']));
		}
	} elseif ($tnml_asCfg['mailer'] == 3) {
		require_once INCLUDE_PATH . 'includes/tegonuke/mailer/Swift/Connection/Sendmail.php';
		if (empty($tnml_asCfg['sendmail_path'])) { // Try and get from php.ini file
			$tnml_asCfg['sendmail_path'] = @ini_get('sendmail_path');
		}
		if (function_exists('proc_open') && !empty($sendmail_path)) {
			$swift =& new Swift(new Swift_Connection_Sendmail($tnml_asCfg['sendmail_path']));
		} else {
			return false;
		}
	} elseif ($tnml_asCfg['mailer'] == 4) {
		// Currently have nothing for Qmail
		return false;
	} else {
		return false;
	}
	$message =& new Swift_Message($subject, $body, (isset($params['html']) and $params['html'] == 1) ? 'text/html' : 'text/plain');
	if (isset($params['batch']) and $params['batch'] == 1 and is_a($oRecipients, "Swift_RecipientList")) {
		$sent = $swift->batchSend($message, $oRecipients, $oFrom);
	} else {
		$sent = $swift->send($message, $oRecipients, $oFrom);
	}
	$swift->disconnect();
	return $sent;
}
?>