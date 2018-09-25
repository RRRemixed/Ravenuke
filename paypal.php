<?php

/*  PHP Paypal IPN Integration Class 
 *  4.16.2005 - Micah Carrick, email@micahcarrick.com
 *
 *  This file demonstrates the usage of paypal.class.php, a class designed  
 *  to aid in the interfacing between your website, paypal, and the instant
 *  payment notification (IPN) interface.  This single file serves as 4 
 *  virtual pages depending on the "action" varialble passed in the URL. It's
 *  the processing page which processes form data being submitted to paypal, it
 *  is the page paypal returns a user to upon success, it's the page paypal
 *  returns a user to upon canceling an order, and finally, it's the page that
 *  handles the IPN request from Paypal.
 *
 *  I tried to comment this file, aswell as the acutall class file, as well as
 *  I possibly could.  Please email me with questions, comments, and suggestions.
 *  See the header of paypal.class.php for additional resources and information.
 *  EDITED BY WESTERN STUDIOS...HTTP://WWW.WESTERNSTUDIOS.NET
*/


// Setup class
include("mainfile.php");
require_once('paypal.class.php');
$p = new paypal_class; 
global $prefix, $db;
	  $sql2 = "SELECT ws_sbox FROM ".$prefix."_ws_subconfig";
       $result2 = $db->sql_query($sql2);
       $row2 = $db->sql_fetchrow($result2);
	if($row2[ws_sbox] ==1){//fix by Santiago   
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
}
else{
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if (empty($_GET['action'])) $_GET['action'] = 'process';  

switch ($_GET['action']) {
    
   case 'process': 
      global $prefix, $db, $user_prefix;
	  include("modules/WS_Subscription/includes/cleaninput.class.php");
	   //check user name
	   function userCheck($username2, $user_email) {
    global $stop, $user_prefix, $db;
    if ((!$user_email) || ($user_email=="") || (!eregi("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$",$user_email))) $stop = "<center>"._ERRORINVEMAIL."</center><br>";
    if (strrpos($user_email,' ') > 0) $stop = "<center>"._ERROREMAILSPACES."</center>";
    if ((!$username2) || ($username2=="") || (ereg("[^a-zA-Z0-9_-]",$username2))) $stop = "<center>"._ERRORINVNICK."</center><br>";
    if (strlen($username2) > 25) $stop = "<center>"._NICK2LONG."</center>";
    if (eregi("^((root)|(adm)|(linux)|(webmaster)|(admin)|(god)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anónimo)|(operator))$",$username2)) $stop = "<center>"._NAMERESERVED."</center>";
    if (strrpos($username2,' ') > 0) $stop = "<center>"._NICKNOSPACES."</center>";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE username='$username2'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT username FROM ".$user_prefix."_users_temp WHERE username='$username2'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br>";
    if ($db->sql_numrows($db->sql_query("SELECT user_email FROM ".$user_prefix."_users_temp WHERE user_email='$user_email'")) > 0) $stop = "<center>"._EMAILREGISTERED."</center><br>";
    return($stop);
	}
	  //get configurations
	   $sql2 = "SELECT  ws_usersup FROM ".$prefix."_ws_subconfig";
       $result2 = $db->sql_query($sql2);
       $row2 = $db->sql_fetchrow($result2);
	   if($row2[ws_usersup] ==1){
	$item_numberws = requestUtils::getRequestObject('item_number');
if($item_numberws !=""){//PROCESS PAYPAL PAYMENT IMMEDIATELY
	  $period = requestUtils::getRequestObject('period');
	  $wperiod = requestUtils::getRequestObject('wsperiod');
	  if($period =="day"){
	  $wstime ="86400";
	  }
	  elseif($period =="week"){
	  $wstime ="604800";
	  }
	  elseif($period =="month"){
	  $wstime ="2629743.83";
	  }
	  elseif($period =="year"){
	  $wstime ="31556926";
	  }
      $wsperiod = $wstime * $wperiod;
	  //RUN QUERY TO GET PAYPAL DATA
	  $sql = "SELECT * FROM ".$prefix."_ws_paypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	   $stype = requestUtils::getRequestObject('ws_nsngr');
	   if($stype ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
	   $iname = requestUtils::getRequestObject('item_name');
	   $inum = requestUtils::getRequestObject('item_number');
	   $amoun = requestUtils::getRequestObject('amount');
	   $quan = requestUtils::getRequestObject('quantity');
	   $nship = requestUtils::getRequestObject('no_shipping');
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $iname);
	  $p->add_field('item_number', $inum);
	  $p->add_field('amount', $amoun);
	  $p->add_field('quantity', $quan);
	  $p->add_field('no_shipping', $nship);
	  $p->add_field('custom', $wsperiod); 
	  $p->add_field('on0', 'Subscription type'); 
	  $p->add_field('os0', $subtyp);  
	  $p->add_field('on1', 'Sub_id'); 
	  $p->add_field('os1', $stype);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();
exit();
}
$amount = requestUtils::getRequestObject('amount');
$quantity = requestUtils::getRequestObject('quantity');
$item_name = requestUtils::getRequestObject('item_name');

$period = requestUtils::getRequestObject('period');
$wsperiod = requestUtils::getRequestObject('wsperiod');
$ws_nsngr = requestUtils::getRequestObject('ws_nsngr');
$no_shipping = requestUtils::getRequestObject('no_shipping');

$username2 = requestUtils::getRequestObject('username');
$user_email = requestUtils::getRequestObject('user_email');
$user_password = requestUtils::getRequestObject('user_password');
$user_password2 = requestUtils::getRequestObject('user_password2');
$gfx_check = requestUtils::getRequestObject('gfx_check');
$random_num = requestUtils::getRequestObject('random_num');

$wsusername = requestUtils::getRequestObject('wsusername');
$wspass = requestUtils::getRequestObject('wspass');

//END
if($wsusername !=="" AND $username2 ==""){
//
//
$ws_pass = md5($wspass);
$ucheck = $db->sql_query("SELECT user_id  FROM ".$user_prefix."_users WHERE username='$wsusername' AND user_password ='$ws_pass'");
list($wsuser_id) = $db->sql_fetchrow($ucheck);
if($wsuser_id ==""){
include("header.php");
OpenTable();
echo "user does not exist "._GOBACK."";
CloseTable();
include("footer.php");
}else{
	  if($period =="day"){
	  $wstime ="86400";
	  }
	  elseif($period =="week"){
	  $wstime ="604800";
	  }
	  elseif($period =="month"){
	  $wstime ="2629743.83";
	  }
	  elseif($period =="year"){
	  $wstime ="31556926";
	  }
      $ws_period = $wstime * $wsperiod;
	  $sql = "SELECT * FROM ".$prefix."_ws_paypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);

	   if($ws_nsngr ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $item_name);
	  $p->add_field('item_number', $wsuser_id);
	  $p->add_field('amount', $amount);
	  $p->add_field('quantity', $quantity);
	  $p->add_field('no_shipping', $no_shipping);
	  $p->add_field('custom', $ws_period); 
	  $p->add_field('on0', 'Subscription type'); 
	  $p->add_field('os0', $subtyp);  
	  $p->add_field('on1', 'Sub_id'); 
	  $p->add_field('os1', $ws_nsngr);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();
	  
}
//include("footer.php");
} elseif($username2 !="" AND $wsusername ==""){//ADD USER TO DATABASE
if($user_email ==""){
include("header.php");
OpenTable();
echo ""._ERRORTXT3.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password == ""){
include("header.php");
OpenTable();
echo ""._ERRORTXT4.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password2 ==""){
include("header.php");
OpenTable();
echo ""._ERRORTXT5.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if($user_password2 != "$user_password"){
include("header.php");
OpenTable();
echo ""._ERRORTXT6.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
//Check user
userCheck($username2, $user_email);
if ($stop) {
include'header.php';
OpenTable();
	echo $stop;
CloseTable();
include'footer.php';
	} elseif(!$stop){//USER CHECKS OUT FINE...ADD HIM/HER
mt_srand ((double)microtime()*1000000);
$maxran = 1000000;
$check_num = mt_rand(0, $maxran);
$check_num = md5($check_num);
$time = time();
$user_regdate = date("M d, Y");
$new_password = md5($user_password2);
$result = $db->sql_query("INSERT INTO ".$user_prefix."_users_temp (user_id, username, user_email, user_password, user_regdate, check_num, time) VALUES (NULL, '$username2', '$user_email', '$new_password', '$user_regdate', '$check_num', '$time')");
if(!$result) {
	    echo ""._ERROR."<br>";
	} else {
 if($period =="day"){
	  $wstime ="86400";
	  }
	  elseif($period =="week"){
	  $wstime ="604800";
	  }
	  elseif($period =="month"){
	  $wstime ="2629743.83";
	  }
	  elseif($period =="year"){
	  $wstime ="31556926";
	  }
      $ws_period = $wstime * $wsperiod;
	  $sql = "SELECT * FROM ".$prefix."_ws_paypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);

	   if($ws_nsngr ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $item_name);
	  $p->add_field('item_number', $username2);
	  $p->add_field('amount', $amount);
	  $p->add_field('quantity', $quantity);
	  $p->add_field('no_shipping', $no_shipping);
	  $p->add_field('custom', $ws_period); 
	  $p->add_field('on0', 'Subscription type'); 
	  $p->add_field('os0', $subtyp);  
	  $p->add_field('on1', 'id'); 
	  $p->add_field('os1', $ws_nsngr);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();

	}//end adding user to database
	}

}
else{
include("header.php");
OpenTable();
echo ""._ERRORTXT2.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
}
else{
	  $period = requestUtils::getRequestObject('period');
	  $wperiod = requestUtils::getRequestObject('wsperiod');
	  if($period =="day"){
	  $wstime ="86400";
	  }
	  elseif($period =="week"){
	  $wstime ="604800";
	  }
	  elseif($period =="month"){
	  $wstime ="2629743.83";
	  }
	  elseif($period =="year"){
	  $wstime ="31556926";
	  }
      $wsperiod = $wstime * $wperiod;
	  //RUN QUERY TO GET PAYPAL DATA
	  $sql = "SELECT * FROM ".$prefix."_ws_paypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	   $stype = requestUtils::getRequestObject('ws_nsngr');
	   if($stype ==0){
	   $subtyp = 'Nuke';
	   }
	   else{
	   $subtyp = 'NSN';
	   }
	   $iname = requestUtils::getRequestObject('item_name');
	   $inum = requestUtils::getRequestObject('item_number');
	   $amoun = requestUtils::getRequestObject('amount');
	   $quan = requestUtils::getRequestObject('quantity');
	   $nship = requestUtils::getRequestObject('no_shipping');
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $iname);
	  $p->add_field('item_number', $inum);
	  $p->add_field('amount', $amoun);
	  $p->add_field('quantity', $quan);
	  $p->add_field('no_shipping', $nship);
	  $p->add_field('custom', $wsperiod); 
	  $p->add_field('on0', 'Subscription type'); 
	  $p->add_field('os0', $subtyp);  
	  $p->add_field('on1', 'Sub_id'); 
	  $p->add_field('os1', $stype);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();
	  }
      //$p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success': 
   $pagetitle ="Payment Complete";
   global $prefix, $db;
include("header.php");   
OpenTable(); 
$sql = "SELECT app_memb FROM ".$prefix."_ws_subconfig";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
if($row['app_memb'] ==1){
echo "<br><br><center>"._WSORDERCOMPLETE2."</center><br><br>";
}
else{
      echo "<br><br><center>"._WSORDERCOMPLETE."</center><br><br>";
	  }
//foreach ($_POST as $key => $value) { echo "$key: $value<br>"; }
     CloseTable();  
      include("footer.php");
      break;
      
   case 'cancel':
$pagetitle ="Cancelled";  
include("header.php");
OpenTable();
echo "<h3><center><br><br><br>"._WSORDERCON."</center><br><br><br><br></h3>";
CloseTable();   
include("footer.php"); 
      break;
      
   case 'ipn':
      if ($p->validate_ipn()) {
global $prefix, $user_prefix, $db, $language;
$sql = "SELECT * FROM ".$prefix."_ws_subconfig";
$result = $db->sql_query($sql);
$row = $db->sql_fetchrow($result);
//IF APPROVE MEMBERS IS NOT ACTIVATED RUN THE FOLLOWING CODES
if($row['app_memb'] ==1){
$usersubtime = $p->ipn_data['custom']+time();

if($p->ipn_data['option_name2'] =="id"){//ADD NEW USER TO DB
//RETRIEVE USER FROM TEMP TABLE
list($ws_uname, $ws_uemail, $ws_upass, $ws_ureg, $ws_check, $ws_time) = $db->sql_fetchrow($db->sql_query("SELECT username, user_email, user_password, user_regdate, check_num, time FROM ".$user_prefix."_users_temp WHERE username='".$p->ipn_data['item_number']."'"));
//END
//ADD USER TO NUKE USER TABLE
$db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_password, user_avatar, user_avatar_type, user_regdate, user_lang) VALUES (NULL, '$ws_uname', '$ws_uemail', '$ws_upass', 'gallery/blank.gif', 3, '$ws_ureg', '$language')");
//END
//DELETE USER FROM DATABASE
$db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE username='".$p->ipn_data['item_number']."'");
//END
//GET USER ID FOR NEW SUBSCRIBER
list($ws_uid) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='".$p->ipn_data['item_number']."'"));
//END
//IF IT'S A NUKE SUBSCRIBER ADD THEM
if($p->ipn_data['option_selection1'] == "Nuke"){
$db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '$ws_uid', '$usersubtime')");
//exit();
}
//END
//ELSE IF IT IS A NSN SUBSCRIBER ADD THEM
else if($p->ipn_data['option_selection1'] == "NSN"){
$ntime = time();
$db->sql_query("insert into ".$prefix."_nsngr_users values ('".$p->ipn_data['option_selection2']."', '$ws_uid', '".$p->ipn_data['item_number']."', '', '', '$ntime', '$usersubtime')");
//exit();
}
//END
//ADD PAYPAL DETAILS
$db->sql_query("insert into ".$prefix."_ws_paypal_ipn values (NULL, '".$p->ipn_data['txn_type']."', '".$p->ipn_data['reason_code']."', '".$p->ipn_data['payment_type']."', '".$p->ipn_data['payment_status']."', '".$p->ipn_data['pending_reason']."', '".$p->ipn_data['invoice']."', '".$p->ipn_data['mc_currency']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', '".$p->ipn_data['payer_business_name']."', '".$p->ipn_data['address_name']."', '".$p->ipn_data['address_street']."', '".$p->ipn_data['address_city']."', '".$p->ipn_data['address_state']."', '".$p->ipn_data['address_zip']."', '".$p->ipn_data['address_country']."', '".$p->ipn_data['address_status']."', '".$p->ipn_data['address_owner']."', '".$p->ipn_data['payer_email']."', '".$p->ipn_data['ebay_address_id']."', '".$p->ipn_data['payer_id']."', '".$p->ipn_data['payer_status']."', '".$p->ipn_data['payment_date']."', '".$p->ipn_data['business']."', '".$p->ipn_data['receiver_email']."', '".$p->ipn_data['receiver_id']."', '".$p->ipn_data['paypal_address_id']."', '".$p->ipn_data['txn_id']."', '".$p->ipn_data['notify_version']."', '".$p->ipn_data['verify_sign']."', now(), '".$p->ipn_data['item_name']."', '".$p->ipn_data['payment_gross']."', '".$p->ipn_data['payment_fee']."')");
}
//END ADDING NEW USER TO SUBSCRIPTION
else if($p->ipn_data['option_name2'] =="Sub_id"){
//GET USER ID
list($wsuid) = $db->sql_fetchrow($db->sql_query("SELECT userid FROM ".$prefix."_subscriptions WHERE userid='".$p->ipn_data['item_number']."'"));
//END
//IF SUBSCRIBER DOES NOT EXIST ADD THEM
if($wsuid =="" AND $p->ipn_data['option_selection1'] == "Nuke"){
$db->sql_query("insert into ".$prefix."_subscriptions values (NULL, '".$p->ipn_data['item_number']."', '$usersubtime')");
//exit();
}
//END
//IF SUBSCRIBER ALREADY EXIST ADD A SUBSCRIPTION
elseif($wsuid !="" AND $p->ipn_data['option_selection1'] == "Nuke"){
$db->sql_query("update ".$prefix."_subscriptions set subscription_expire=subscription_expire+".$p->ipn_data['custom']." where userid='".$p->ipn_data['item_number']."'");
//exit();
}
//END
//IF NSN SUBSCRIPTION IS ACTIVE RUN THE FOLLOWING CODES
if($row['ws_nsn'] ==1){
$ntime = time();
//GET THE USER ID AND GROUP ID
list($wsnsngid, $wsnsnid) = $db->sql_fetchrow($db->sql_query("SELECT gid, uid FROM ".$prefix."_nsngr_users WHERE uid='".$p->ipn_data['item_number']."' AND gid='".$p->ipn_data['option_selection2']."'"));
//IF USER DOES NOT EXIST THEN ADD THEM
if($wsnsnid =="" AND $p->ipn_data['option_selection1'] == "NSN"){
list($nsnuname) = $db->sql_fetchrow($db->sql_query("SELECT username FROM ".$user_prefix."_users WHERE user_id='".$p->ipn_data['item_number']."'"));
$db->sql_query("insert into ".$prefix."_nsngr_users values ('".$p->ipn_data['option_selection2']."', '".$p->ipn_data['item_number']."', '$nsnuname', '', '', '$ntime', '$usersubtime')");
//exit();
}
//EMD
//IF NSN USER ALREADY EXIST IN THE GROUP UPDATE THEM
elseif($wsnsnid !="" AND $p->ipn_data['option_selection1'] == "NSN"){
$db->sql_query("update ".$prefix."_nsngr_users set edate=edate+".$p->ipn_data['custom']." where uid='".$p->ipn_data['item_number']."' AND gid='".$p->ipn_data['option_selection2']."'");
//exit();
}
//END
}
//END NSN CODES
//ADD PAYPAL DETAILS
$db->sql_query("insert into ".$prefix."_ws_paypal_ipn values (NULL, '".$p->ipn_data['txn_type']."', '".$p->ipn_data['reason_code']."', '".$p->ipn_data['payment_type']."', '".$p->ipn_data['payment_status']."', '".$p->ipn_data['pending_reason']."', '".$p->ipn_data['invoice']."', '".$p->ipn_data['mc_currency']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', '".$p->ipn_data['payer_business_name']."', '".$p->ipn_data['address_name']."', '".$p->ipn_data['address_street']."', '".$p->ipn_data['address_city']."', '".$p->ipn_data['address_state']."', '".$p->ipn_data['address_zip']."', '".$p->ipn_data['address_country']."', '".$p->ipn_data['address_status']."', '".$p->ipn_data['address_owner']."', '".$p->ipn_data['payer_email']."', '".$p->ipn_data['ebay_address_id']."', '".$p->ipn_data['payer_id']."', '".$p->ipn_data['payer_status']."', '".$p->ipn_data['payment_date']."', '".$p->ipn_data['business']."', '".$p->ipn_data['receiver_email']."', '".$p->ipn_data['receiver_id']."', '".$p->ipn_data['paypal_address_id']."', '".$p->ipn_data['txn_id']."', '".$p->ipn_data['notify_version']."', '".$p->ipn_data['verify_sign']."', now(), '".$p->ipn_data['item_name']."', '".$p->ipn_data['payment_gross']."', '".$p->ipn_data['payment_fee']."')");

}//END ADD SUBSCRIBER

}
//IF APPROVED MEMBERS IS ACTIVATED RUN THE FOLLOWING AND ADD THEM TO THE TEMP TABLE
else{  
 if($p->ipn_data['option_name2'] =="id"){// IF IT'S A NEW USER RUN THE FOLLOWING CODES
 //GET USER INFO FROM NUKE TEMP TABLE
 list($ws_uname, $ws_uemail, $ws_upass, $ws_ureg, $ws_check, $ws_time) = $db->sql_fetchrow($db->sql_query("SELECT username, user_email, user_password, user_regdate, check_num, time FROM ".$user_prefix."_users_temp WHERE username='".$p->ipn_data['item_number']."'"));
 //END
//ADD NUKE UDER TO NUKE_USERS TABLE
$db->sql_query("INSERT INTO ".$user_prefix."_users (user_id, username, user_email, user_password, user_avatar, user_avatar_type, user_regdate, user_lang) VALUES (NULL, '$ws_uname', '$ws_uemail', '$ws_upass', 'gallery/blank.gif', 3, '$ws_ureg', '$language')");
//END
//DELETE USER FROM TEMP TABLE
$db->sql_query("DELETE FROM ".$user_prefix."_users_temp WHERE username='".$p->ipn_data['item_number']."'");
//END
//GET ID OF NEW USER
list($ws_uid) = $db->sql_fetchrow($db->sql_query("SELECT user_id FROM ".$user_prefix."_users WHERE username='".$p->ipn_data['item_number']."'"));
//END
//ADD USER TO SUBSCRIPTION PEND TABLE
 $db->sql_query("insert into ".$prefix."_ws_subscriptions_pend values (NULL, '$ws_uid', '".$p->ipn_data['custom']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', now(), '".$p->ipn_data['payer_email']."', '".$p->ipn_data['option_selection2']."', '".$p->ipn_data['option_selection1']."')");
 //END
//ADD PAYPAL DETAILS
	$db->sql_query("insert into ".$prefix."_ws_paypal_ipn values (NULL, '".$p->ipn_data['txn_type']."', '".$p->ipn_data['reason_code']."', '".$p->ipn_data['payment_type']."', '".$p->ipn_data['payment_status']."', '".$p->ipn_data['pending_reason']."', '".$p->ipn_data['invoice']."', '".$p->ipn_data['mc_currency']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', '".$p->ipn_data['payer_business_name']."', '".$p->ipn_data['address_name']."', '".$p->ipn_data['address_street']."', '".$p->ipn_data['address_city']."', '".$p->ipn_data['address_state']."', '".$p->ipn_data['address_zip']."', '".$p->ipn_data['address_country']."', '".$p->ipn_data['address_status']."', '".$p->ipn_data['address_owner']."', '".$p->ipn_data['payer_email']."', '".$p->ipn_data['ebay_address_id']."', '".$p->ipn_data['payer_id']."', '".$p->ipn_data['payer_status']."', '".$p->ipn_data['payment_date']."', '".$p->ipn_data['business']."', '".$p->ipn_data['receiver_email']."', '".$p->ipn_data['receiver_id']."', '".$p->ipn_data['paypal_address_id']."', '".$p->ipn_data['txn_id']."', '".$p->ipn_data['notify_version']."', '".$p->ipn_data['verify_sign']."', now(), '".$p->ipn_data['item_name']."', '".$p->ipn_data['payment_gross']."', '".$p->ipn_data['payment_fee']."')"); 
 }else if($p->ipn_data['option_name2'] =="Sub_id"){//IF USER IS ALREADY A MEMBER ADD THE INFO TO THE PENDING TABLE
$db->sql_query("insert into ".$prefix."_ws_subscriptions_pend values (NULL, '".$p->ipn_data['item_number']."', '".$p->ipn_data['custom']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', now(), '".$p->ipn_data['payer_email']."', '".$p->ipn_data['option_selection2']."', '".$p->ipn_data['option_selection1']."')");
//ADD PAYPAL DETAILS
	$db->sql_query("insert into ".$prefix."_ws_paypal_ipn values (NULL, '".$p->ipn_data['txn_type']."', '".$p->ipn_data['reason_code']."', '".$p->ipn_data['payment_type']."', '".$p->ipn_data['payment_status']."', '".$p->ipn_data['pending_reason']."', '".$p->ipn_data['invoice']."', '".$p->ipn_data['mc_currency']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', '".$p->ipn_data['payer_business_name']."', '".$p->ipn_data['address_name']."', '".$p->ipn_data['address_street']."', '".$p->ipn_data['address_city']."', '".$p->ipn_data['address_state']."', '".$p->ipn_data['address_zip']."', '".$p->ipn_data['address_country']."', '".$p->ipn_data['address_status']."', '".$p->ipn_data['address_owner']."', '".$p->ipn_data['payer_email']."', '".$p->ipn_data['ebay_address_id']."', '".$p->ipn_data['payer_id']."', '".$p->ipn_data['payer_status']."', '".$p->ipn_data['payment_date']."', '".$p->ipn_data['business']."', '".$p->ipn_data['receiver_email']."', '".$p->ipn_data['receiver_id']."', '".$p->ipn_data['paypal_address_id']."', '".$p->ipn_data['txn_id']."', '".$p->ipn_data['notify_version']."', '".$p->ipn_data['verify_sign']."', now(), '".$p->ipn_data['item_name']."', '".$p->ipn_data['payment_gross']."', '".$p->ipn_data['payment_fee']."')");
}
//END

}

      }
	  
      break;
 }  
 
?>