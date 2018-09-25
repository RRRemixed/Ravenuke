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
	  $sql2 = "SELECT ws_paypal FROM ".$prefix."_ws_adconfig";
       $result2 = $db->sql_query($sql2);
       $row2 = $db->sql_fetchrow($result2);
	if($row2[ws_paypal] ==1){//fix by Santiago   
$p->paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; 
}
else{
$p->paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}
$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if (empty($_GET['action'])) $_GET['action'] = 'process';  


switch ($_GET['action']) {
    
   case 'process': 
      global $prefix, $db, $user_prefix, $prefix;
	  require("ws_core/class/cleaninput.class.php");
	  require("ws_core/inc/upload.inc.php");
	   //check user name
	   function userCheck($cuserame, $cpass) {
    global $stop, $prefix, $db;
    if (strrpos($cpass,' ') > 0) $stop = "<center>"._ERROREMAILSPACES."</center>";
    if ((!$cuserame) || ($cuserame=="") || (ereg("[^a-zA-Z0-9_-]",$cuserame))) $stop = "<center>"._ERRORINVNICK."</center><br>";
    if (strlen($cuserame) > 25) $stop = "<center>"._NICK2LONG."</center>";
    if (eregi("^((root)|(adm)|(linux)|(webmaster)|(admin)|(god)|(administrator)|(administrador)|(nobody)|(anonymous)|(anonimo)|(anónimo)|(operator))$",$cuserame)) $stop = "<center>"._NAMERESERVED."</center>";
    if (strrpos($cuserame,' ') > 0) $stop = "<center>"._NICKNOSPACES."</center>";
    if ($db->sql_numrows($db->sql_query("SELECT login FROM ".$prefix."_ws_bannerclient WHERE login='$cuserame'")) > 0) $stop = "<center>"._NICKTAKEN."</center><br>";
    return($stop);
	}
	  //get configurations
$renew = requestUtils::getRequestObject('renew');
if($renew =="1"){//RENEW MEMBERS PLAN
$cid = requestUtils::getRequestObject('cid');
$bid = requestUtils::getRequestObject('bid');
$pack = requestUtils::getRequestObject('pack');
if($pack ==""){
include 'header.php';
OpenTable();
echo _WSADSERR1._GOBACK;
CloseTable();
include 'footer.php';
exit();
}
	
	   $sql5 = "SELECT * FROM ".$prefix."_ws_banplans WHERE ws_id='$pack'";
       $result5 = $db->sql_query($sql5);
       $row5 = $db->sql_fetchrow($result5);
	   $wsp = $row5['wsp'];
	   $wsn = $row5['wsn'];
	   $wsim = $row5['ws_imp'];
	$dateend = requestUtils::getRequestObject('dateender');  
	if($wsp !=""){

	  if($wsp =="day"){
	  $wwstime ="86400";
	  }
	  elseif($wsp =="week"){
	  $wwstime ="604800";
	  }
	  elseif($wsp =="month"){
	  $wwstime ="2629743.83";
	  }
	  elseif($wsp =="year"){
	  $wwstime ="31556926";
	  }
      $wwsptime = $wwstime * $wsn;
	  if($dateend =="1"){
	  $plantype ="datend";
	  }else{
	  $plantype ="date";
	  }
	 
	}else{  
	  $wwsptime = $wsim;
$plantype ="impressions";
}
 
	  $sql = "SELECT * FROM ".$prefix."_ws_adpaypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $row5['ban_name']);
	  $p->add_field('item_number', $cid);
	  $p->add_field('amount', $row5['ban_cost']);
	  $p->add_field('quantity', '1');
	  $p->add_field('no_shipping', '1');
	  $p->add_field('custom', $plantype); 
	  $p->add_field('on0', $wwsptime); 
	  $p->add_field('os0', $bid);  
	  $p->add_field('on1', 'Ads Position'); 
	  $p->add_field('os1', $row5['ws_banpos']);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();



}else{
$amount = requestUtils::getRequestObject('amount');
$quantity = requestUtils::getRequestObject('quantity');
$item_name = requestUtils::getRequestObject('itemname');

$period = requestUtils::getRequestObject('period');
$wsperiod = requestUtils::getRequestObject('wsperiod');
$wspos = requestUtils::getRequestObject('wspos');
$no_shipping = requestUtils::getRequestObject('wsshipping');

$cuserame = requestUtils::getRequestObject('cuserame');
$user_email = requestUtils::getRequestObject('contemail');
$cpass = requestUtils::getRequestObject('cpass');
$cname = requestUtils::getRequestObject('cname');
$contname = requestUtils::getRequestObject('contname');


$wsusername = requestUtils::getRequestObject('wsusername');
$wspass = requestUtils::getRequestObject('wspass');

$bantype = requestUtils::getRequestObject('bantype');
$wsbaname = requestUtils::getRequestObject('wsbaname');
$wsbanloc = requestUtils::getRequestObject('wsbanloc');
$wsupload = requestUtils::getRequestObject('myupload');
$wsbanurl = requestUtils::getRequestObject('wsbanurl');
$wsdesc = requestUtils::getRequestObject('wsdesc');
$wsimpamt = requestUtils::getRequestObject('wsimpamt');

//END
if($wsusername !=="" AND $cuserame ==""){

//
$ucheck = $db->sql_query("SELECT cid  FROM ".$prefix."_ws_bannerclient WHERE login='$wsusername' AND passwd='$wspass'");
list($wslogin_id) = $db->sql_fetchrow($ucheck);
if($wslogin_id ==""){
include("header.php");
OpenTable();
echo "user does not exist "._GOBACK."";
CloseTable();
include("footer.php");
}else{
if($wsimpamt !=""){
$wsptime ="";
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
	  $wsptime =$ws_period + time();
	  }
	  $ws_ttime = time();

	  if($wsbanloc =="" AND $bantype !="3"){
	  $myUploadobj = new UPLOAD; //creating instance of file.
$upload_dir= $_SERVER['DOCUMENT_ROOT']."/modules/WS_Banners/adimages/";
		// use function to upload file.
		$file=$myUploadobj->upload_file($upload_dir,'myupload',true,true,0,"jpg|jpeg|gif|png|swf"); 
		if($file==false)
			echo $myUploadobj->error;
		else
			$wsmyloc ="modules/WS_Banners/adimages/".$file;	
}else{
$wsmyloc = $wsbanloc;
}

sql_query("insert into ".$prefix."_ws_banners values (NULL, '$wslogin_id', '$wsimpamt', '1', '', '$wsmyloc', '$wsbanurl', '$wsdesc', '$ws_ttime', '$wsptime', '$bantype', '0', '$wspos', '', '$wsbaname')", $dbi);
	  $sql1 = "SELECT bid FROM ".$prefix."_ws_banners WHERE cid='$wslogin_id' AND ws_banname='$wsbaname' AND active='0' ";
       $result1 = $db->sql_query($sql1);
       $row1 = $db->sql_fetchrow($result1);
	   
	  $sql = "SELECT * FROM ".$prefix."_ws_adpaypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $item_name);
	  $p->add_field('item_number', $wslogin_id);
	  $p->add_field('amount', $amount);
	  $p->add_field('quantity', $quantity);
	  $p->add_field('no_shipping', $no_shipping);
	  $p->add_field('custom', 'new'); 
	  $p->add_field('on0', 'Bid'); 
	  $p->add_field('os0', $row1['bid']);  
	  $p->add_field('on1', 'Ads Position'); 
	  $p->add_field('os1', $wspos);
	  $p->add_field('no_note', '1');  
      $p->add_field('currency_code', $row['paypal_currency']);
      $p->submit_paypal_post();
	  
}
//include("footer.php");
} elseif($cuserame !="" AND $wsusername ==""){//ADD USER TO DATABASE
if($cname == ""){
include("header.php");
OpenTable();
echo ""._ERRORTXT4.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
if(contname ==""){
include("header.php");
OpenTable();
echo ""._ERRORTXT5.""._GOBACK."";
CloseTable();
include("footer.php");
die();
}
//Check user
userCheck($cuserame, $cpass);
if ($stop) {
include'header.php';
OpenTable();
	echo $stop;
CloseTable();
include'footer.php';
	} elseif(!$stop){//USER CHECKS OUT FINE...ADD HIM/HER

$result = $db->sql_query("INSERT INTO ".$prefix."_ws_bannerclient (cid, name, contact, email, login, passwd) VALUES (NULL, '$cname', '$contname', '$user_email', '$cuserame', '$cpass')");
if(!$result) {
	    echo ""._ERROR."<br>";
	} else {
$uclid = $db->sql_query("SELECT cid  FROM ".$prefix."_ws_bannerclient WHERE login='$cuserame' AND passwd='$cpass'");
list($wsuclid) = $db->sql_fetchrow($uclid);
if($wsimpamt !=""){
$wsptime ="";
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
	  $wsptime =$ws_period + time();
	  }
	  $ws_ttime = time();
	  	  if($wsbanloc =="" AND $bantype !="3"){
	  $myUploadobj = new UPLOAD; //creating instance of file.
$upload_dir= $_SERVER['DOCUMENT_ROOT']."/modules/WS_Banners/adimages/";
		// use function to upload file.
		$file=$myUploadobj->upload_file($upload_dir,'myupload',true,true,0,"jpg|jpeg|gif|png|swf"); 
		if($file==false)
			echo $myUploadobj->error;
		else
			$wsmyloc ="modules/WS_Banners/adimages/".$file;	
}else{
$wsmyloc = $wsbanloc;
}
sql_query("insert into ".$prefix."_ws_banners values (NULL, '$wsuclid', '$wsimpamt', '1', '', '$wsmyloc', '$wsbanurl', '$wsdesc', '$ws_ttime', '$wsptime', '$bantype', '0', '$wspos', '', '$wsbaname')", $dbi);
	  $sql1 = "SELECT bid FROM ".$prefix."_ws_banners WHERE cid='$wsuclid' AND ws_banname='$wsbaname' AND active='0' ";
       $result1 = $db->sql_query($sql1);
       $row1 = $db->sql_fetchrow($result1);
	  $sql = "SELECT * FROM ".$prefix."_ws_adpaypal";
       $result = $db->sql_query($sql);
       $row = $db->sql_fetchrow($result);
	   
      $p->add_field('business', $row['paypal_email']);
      $p->add_field('return', $this_script.'?action=success');
      $p->add_field('cancel_return', $this_script.'?action=cancel');
      $p->add_field('notify_url', $this_script.'?action=ipn');
      $p->add_field('item_name', $item_name);
	  $p->add_field('item_number', $wsuclid);
	  $p->add_field('amount', $amount);
	  $p->add_field('quantity', $quantity);
	  $p->add_field('no_shipping', $no_shipping);
	  $p->add_field('custom', 'new'); 
	  $p->add_field('on0', 'Bid'); 
	  $p->add_field('os0', $row1['bid']);  
	  $p->add_field('on1', 'Ads Position'); 
	  $p->add_field('os1', $wspos);
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

  // $p->dump_fields();      // for debugging, output a table of all the fields
      break;
      
   case 'success': 
   $pagetitle ="Payment Complete";
   global $prefix, $db;
include("header.php");   
OpenTable(); 

echo "<br><br><center>"._WSADSORDERCOMPLETE."</center><br><br>";

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
global $prefix, $user_prefix, $dbi, $db, $language;
if($p->ipn_data['custom'] =="datend"){//time over, add new date
$wtime = time();
$ntime = $p->ipn_data['option_name1'] + time();
$db->sql_query("UPDATE " . $prefix . "_ws_banners SET active='1',  date='$wtime',  dateend='$ntime' where bid='".$p->ipn_data['option_selection1']."'");
}elseif($p->ipn_data['custom'] =="date"){//add new date 
$db->sql_query("UPDATE " . $prefix . "_ws_banners SET active='1', dateend=dateend+'".$p->ipn_data['option_name1']."' where bid='".$p->ipn_data['option_selection1']."'");
}elseif($p->ipn_data['custom'] =="impressions"){//add impressions
$db->sql_query("UPDATE " . $prefix . "_ws_banners SET active='1',  imptotal= imptotal+'".$p->ipn_data['option_name1']."' where bid='".$p->ipn_data['option_selection1']."'");
}
else{
$db->sql_query("UPDATE " . $prefix . "_ws_banners SET active='1' where bid='".$p->ipn_data['option_selection1']."'");
}
sql_query("insert into ".$prefix."_ws_adpaypal_ipn values (NULL, '".$p->ipn_data['txn_type']."', '".$p->ipn_data['reason_code']."', '".$p->ipn_data['payment_type']."', '".$p->ipn_data['payment_status']."', '".$p->ipn_data['pending_reason']."', '".$p->ipn_data['invoice']."', '".$p->ipn_data['mc_currency']."', '".$p->ipn_data['first_name']."', '".$p->ipn_data['last_name']."', '".$p->ipn_data['payer_business_name']."', '".$p->ipn_data['address_name']."', '".$p->ipn_data['address_street']."', '".$p->ipn_data['address_city']."', '".$p->ipn_data['address_state']."', '".$p->ipn_data['address_zip']."', '".$p->ipn_data['address_country']."', '".$p->ipn_data['address_status']."', '".$p->ipn_data['address_owner']."', '".$p->ipn_data['payer_email']."', '".$p->ipn_data['ebay_address_id']."', '".$p->ipn_data['payer_id']."', '".$p->ipn_data['payer_status']."', '".$p->ipn_data['payment_date']."', '".$p->ipn_data['business']."', '".$p->ipn_data['receiver_email']."', '".$p->ipn_data['receiver_id']."', '".$p->ipn_data['paypal_address_id']."', '".$p->ipn_data['txn_id']."', '".$p->ipn_data['notify_version']."', '".$p->ipn_data['verify_sign']."', now(), '".$p->ipn_data['item_name']."', '".$p->ipn_data['payment_gross']."', '".$p->ipn_data['payment_fee']."')", $dbi);
      }
	  
      break;
 }    
 
?>