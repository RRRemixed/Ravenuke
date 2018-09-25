<?php
/********************************************************/
/* Donations for PHP-Nuke                               */
/* Version Universal 3.0  06-06                         */
/* By: Telli (telli@codezwiz.com)                       */
/* http://codezwiz.com/                                 */
/* Copyright © 2000-2006 by Codezwiz                    */
/********************************************************/
require_once("config.php");
require_once("db/db.php");
$daconf = array();
$result = $db->sql_query("SELECT * FROM {$prefix}_donators_config");
while(list($config_name, $config_value) = $db->sql_fetchrow($result)) {
	$daconf[$config_name] = $config_value;
}
$main_email = $daconf['ppemail']; 

// Start PayPal IPN
// read the post FROM PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

if (phpversion() <= '4.0.6') {
    $_SERVER = ($HTTP_SERVER_VARS);
    $_POST = ($HTTP_POST_VARS);
}
foreach ($HTTP_POST_VARS as $key => $value) {
  $value = urlencode(stripslashes($value));
  $req .= "&$key=$value";
}


// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= 'Content-Length: ' . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

// assign posted variables to local variables
$item_name = $HTTP_POST_VARS['item_name'];
$item_number = $HTTP_POST_VARS['item_number'];
$custom = $HTTP_POST_VARS['custom'];
$option_name1 = $HTTP_POST_VARS['option_name1'];
$option_selection1 = $HTTP_POST_VARS['option_selection1'];
$option_name2 = $HTTP_POST_VARS['option_name2'];
$option_selection2 = $HTTP_POST_VARS['option_selection2'];
$business = urldecode($HTTP_POST_VARS['business']);
$receiver_email = urldecode($HTTP_POST_VARS['receiver_email']);
$payment_status = $HTTP_POST_VARS['payment_status'];
$pending_reason = $HTTP_POST_VARS['pending_reason'];
$txn_type = $HTTP_POST_VARS['txn_type'];
$donated = $HTTP_POST_VARS['mc_gross'];

$first_name = $HTTP_POST_VARS['first_name'];
$last_name = $HTTP_POST_VARS['last_name'];
$address_street = $HTTP_POST_VARS['address_street'];
$address_city = $HTTP_POST_VARS['address_city'];
$address_state = $HTTP_POST_VARS['address_state'];
$address_zip = $HTTP_POST_VARS['address_zip'];
$address_country = $HTTP_POST_VARS['address_country'];
$address_status = $HTTP_POST_VARS['address_status'];
$payer_email = $HTTP_POST_VARS['payer_email'];
$payer_id = $HTTP_POST_VARS['payer_id'];


########################
# Start IPN Validator
########################
if (!$fp) {
  	echo "Problem: Error Number: $errno Error String: $errstr";
  	exit;
} else {
  	fputs($fp, $header . $req);
  	while(!feof($fp)) {
    		$res = fgets($fp, 1024);
    		$res = trim($res);
    		if (strcasecmp($res, "VERIFIED") == 0) {
      		if ($business == $main_email) {
        			if ($payment_status == "Completed" AND $txn_type != "reversal") {
          				$timestamp = time();
          				$dondate = date("m-d-Y",$timestamp);
          				if ($option_selection1 != "Guest") {  
          					$uinfo = $db->sql_fetchrow($db->sql_query("SELECT * FROM {$user_prefix}_users WHERE user_id='".intval($option_selection1)."'"));  
          					$db->sql_query("INSERT INTO {$prefix}_donators VALUES (NULL, '$option_selection1', '$uinfo[username]', '$first_name', '$last_name', '$payer_email', '$donated', '$dondate', '$option_selection2', '$custom', '1', '".date("m")."', '".date("Y")."')");
						//$db->sql_query("UPDATE {$user_prefix}_users SET user_donator='1' WHERE user_id='".intval($option_selection1)."'");
          				} else {
          					$db->sql_query("INSERT INTO {$prefix}_donators VALUES (NULL, '0', 'Guest', '$first_name', '$last_name', '$payer_email', '$donated', '$dondate', '1', '$custom', '1', '".date("m")."', '".date("Y")."')");
          				}
					$db->sql_query("OPTIMIZE TABLE {$prefix}_donators");
        			}
      		}
   		} else if (strcasecmp($res, "INVALID") == 0) {
    		// log for manual investigation
    		}
  	}
  	fclose($fp);
}
?>
