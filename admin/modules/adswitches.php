<?
switch($op) {
case "ws_banneradmin":
ws_banneradmin();
break;
case "ws_bannerplans":
ws_bannerplans();
break;
case "ws_addbannerplan":
ws_addbannerplan($sub_name, $sub_description, $sub_cost, $wsn, $wsp, $sub_enabled, $wsweigh, $wsimage, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1, $wsadtype, $ws_imp, $ws_trimp);
break;
case "ws_delbannerplan":
ws_delbannerplan($ws_id);
break;
case "ws_editbannerplan":
ws_editbannerplan($ws_id);
break;
case "ws_editbannerplan_edit":
ws_editbannerplan_edit($ws_id, $ban_name, $ban_description, $ban_cost, $wsn, $wsp, $ban_enabled, $wsweigh, $wsimage, $ws_trial1, $ws_trial_lgth1, $ws_trial_dmy1, $wsadtype, $ws_imp, $ws_trimp);
break;
case "ws_adsearnings":
ws_adsearnings();
break;
case "ws_adsconfig":
ws_adsconfig();
break;
case "ws_upadsconfig":
ws_upadsconfig($autoprocess, $wssbox, $wsnsn, $wspaypal);
break;
case "ws_adpaypalsetup":
ws_adpaypalsetup();
break;
case "ws_adpaypalsetupadd":
ws_adpaypalsetupadd($paypal_email, $paypal_bg_color, $paypal_currency);
break;
case "ws_adsclients":
ws_adsclients();
break;
case "ws_clientadd":
ws_clientadd($name, $contact, $email, $login, $passwd);
break;
case "ws_addbanner_db":
ws_addbanner_db($cid, $wsbanname, $wsn, $wsp, $imptotal, $wsadtype, $bantype, $imageurl, $clickurl, $alttext, $active, $myupload);
break;
case "ws_adstats":
ws_adstats();
break;
case "ws_bannerstatus":
ws_bannerstatus($bid, $status);
break;
case "ws_ban_del":
ws_ban_del($bid);
break;
case "ws_ban_edit":
ws_ban_edit($bid);
break;
case "ws_updatebplan":
ws_updatebplan($bid, $cid, $impadded, $impmade, $imptotal, $impsubt, $add_days, $minus_days, $wsadtype, $type, $imageurl, $clickurl, $alttext, $active, $ban_name, $edatend, $myupload);
break;
case "ws_banclientedit":
ws_banclientedit($cid);
break;
case "ws_banclientch":
ws_banclientch($cid, $name, $contact, $email, $login, $passwd);
break;
case "ws_banclientdel":
ws_banclientdel($cid);
break;
case "ws_adsstats":
ws_adsstats();
break;
case "ws_adstatus":
ws_adstatus($ws_id, $ban_enabled);
break;
}

?>