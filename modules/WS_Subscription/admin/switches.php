<?
switch($op) {
case "ws_subscr":
ws_subscr();
break;
//SETUP SUBSCRIPTION
case "ws_addsubscrtype":
ws_addsubscrtype();
break;
//SUBSCRIPTION ADD
case"ws_addsubscrtype_add":
ws_addsubscrtype_add($sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $gid, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1);
break;
//EDIT SUBSCRIPTION TYPE
case"ws_editsubtype":
ws_editsubtype($ws_id);
break;
//SAVE EDIT SUBSCRIPTION
case"ws_editsubtype_edit":
ws_editsubtype_edit($ws_id, $sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $gid, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1);
break;
//DELETE SUBSCRIPTION
case "ws_subscrdel":
ws_subscrdel($ws_id);
break;
//PAYPAL SETUP PAGE
case "ws_paypalsetup":
ws_paypalsetup();
break;
//PAYPAL ADD SETUP PAGE
case "ws_paypalsetupadd":
ws_paypalsetupadd($paypal_email, $paypal_bg_color, $paypal_currency);
break;
//SUBSCRIPTION MEMBERS
case "ws_submemb":
ws_submemb();
break;
//SUBSCRIPTION MEMBERS UPDATE
case "ws_submembupd":
ws_submembupd($user_id, $wsaddsub, $wsminsub, $wsfunc);
break;
//ADD MEMBERS TO NUKE
case "ws_subuseradd":
ws_subuseradd($userid, $lname, $fname, $datetime, $rest, $wsem, $subexp, $wsaid, $sub_id, $sub_type);
break;
//ADD SUBSCRIBER
case "ws_subuseradddb":
ws_subuseradddb($userid, $subexp, $lname, $fname, $datetime, $rest, $wsem, $status, $comments, $wsnotify, $addcom, $wsaid, $sub_id, $sub_type);
break;
//ADMIN ADD SUBSCRIBER
case "ws_submembuser_add":
ws_submembuser_add($wsnuser, $wsn, $wsp);
break;
//WS CONFIGURATION
case "ws_config":
ws_config();
break;
//WS UPDATE USERS
case "ws_submembuser_addall":
ws_submembuser_addall($wsaddsuball, $wsminussuball);
break;
//EARNINGS REPORT
case "ws_earnings":
ws_earnings();
break;
//UPDATE CONFIG FILE
case "ws_upconfig":
ws_upconfig($autoprocess, $wssbox, $wsnsn, $wsnuser, $wssubscrcount, $wsusersubct, $wsearnct);
break;
case "ws_stats":
ws_stats();
break;
case "ws_searchuser":
ws_searchuser();
break;
case "ws_substatus":
ws_substatus($ws_id, $sub_enabled);
break;
}

?>