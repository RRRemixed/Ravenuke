<?php

/********************************************************/
/* NukeProject(tm)                                      */
/* By: NukeScripts Network (webmaster@nukescripts.net)  */
/* http://www.nukescripts.net                           */
/* Copyright � 2000-2005 by NukeScripts Network         */
/********************************************************/

if(!defined('NSNPJ_ADMIN')) { die("Illegal Access Detected!!!"); }
$pagetitle = ": "._PJ_TITLE.": "._PJ_REQUESTS.": "._PJ_DELETESTATUS;
$status_id = intval($status_id);
if($status_id < 1) { header("Location: ".$admin_file.".php?op=PJRequestStatusList"); }
include("header.php");
$statusresult = $db->sql_query("SELECT `status_name` FROM `".$prefix."_nsnpj_requests_status` WHERE `status_id`='$status_id'");
list($status_name) = $db->sql_fetchrow($statusresult);
pjadmin_menu(_PJ_REQUESTS.": "._PJ_DELETESTATUS);
echo "<br />";
OpenTable();
echo "<form method='post' action='".$admin_file.".php'>";
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>";
echo "<tr><td align='center'><b>"._PJ_SWAPREQUESTSTATUS."</b></td></tr>";
echo "<tr><td align='center'>$status_name -> <select name='swap_status_id'>";
echo "<option value='-1'>"._PJ_NA."</option>\n";
$statuslist = $db->sql_query("SELECT `status_id`, `status_name` FROM `".$prefix."_nsnpj_requests_status` WHERE `status_id` != '$status_id' AND `status_id` > 0 ORDER BY `status_weight`");
while(list($s_status_id, $s_status_name) = $db->sql_fetchrow($statuslist)){
  echo "<option value='$s_status_id'>$s_status_name</option>";
}
echo "</select></td></tr>\n";
echo "<tr><td align='center'>\n";
echo "<input type='hidden' name='op' value='PJRequestStatusDelete' />\n";
echo "<input type='hidden' name='status_id' value='$status_id' />\n";
echo "<input type='submit' value='"._PJ_DELETESTATUS."' />\n";
echo "</td></tr>\n";
echo "</table>\n";
echo "</form>\n";
CloseTable();
pj_copy();
include("footer.php");

?>