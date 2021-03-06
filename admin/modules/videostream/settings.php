<?php
/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Video Stream Module for PHP-Nuke with many features                  */
/*                                                                      */
/* Copyright (c) 2006 by Scott Cariss (Brady)                           */
/* http://PHPNuke-Downloads.com                                    */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

LinkAdmin();
VideoStreamMenu();
OpenTable();
if($_POST['AVSubmit']) {
	$result = $db->sql_query("UPDATE ".$prefix."_video_stream_settings SET avmaxwidth='".$_POST['avmaxwidth']."', avmaxheight='".$_POST['avmaxheight']."' WHERE id=1");
}

$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_settings WHERE id=1");
$row = $db->sql_fetchrow($result);
echo "<div align=\"center\" class=\"title\">"._VS_AVCONTROL."</div><br />";
echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">"._AVMAXWITHIE." ";
echo "<input name=\"avmaxwidth\" type=\"text\" id=\"avmaxwidth\" size=\"4\" maxlength=\"3\" value=\"".$row['avmaxwidth']."\" />";
echo " / <input name=\"avmaxheight\" type=\"text\" id=\"avmaxheight\" size=\"4\" maxlength=\"3\" value=\"".$row['avmaxheight']."\" />";
echo "<br><br><input type=\"submit\" name=\"AVSubmit\" value=\""._SAVESETTINGS."\" /></form>";
CloseTable();

echo "<br>";
OpenTable();

if($_POST['PSSubmit']) {
	foreach ($_POST['pointsp'] as $pointsp) {
		if($roundcount == "") {$roundcount = 1;}
		$result = $db->sql_query("UPDATE ".$prefix."_video_stream_points SET points='$pointsp' WHERE id=$roundcount");
		$roundcount ++;
	}
	$roundcount = "";
}

$result = $db->sql_query("SELECT * FROM ".$prefix."_video_stream_points");
while($row = $db->sql_fetchrow($result)) {
	$points[] = $row['points'];
}
echo "<div align=\"center\" class=\"title\">"._POINTSSYS."</div><br />";
echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">
<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">
  <tr>
    <td nowrap=\"nowrap\"><div align=\"center\"><b>"._VS_NAME."</b></div></td>
    <td width=\"100%\"><div align=\"center\"><b>"._DESCRIPTION."</b></div></td>
    <td nowrap=\"nowrap\"><div align=\"center\"><b>"._VS_POINTS."</b></div></td>
  </tr>
  <tr>
    <td nowrap=\"nowrap\">"._VVIEW."</td>
    <td>"._POINTSFORVIEW."</td>
    <td nowrap=\"nowrap\"><input name=\"pointsp[]\" type=\"text\" value=\"".$points[0]."\" size=\"4\" maxlength=\"3\" /></td>
  </tr>
  <tr>
    <td nowrap=\"nowrap\">"._COMMENTPOINT."</td>
    <td>"._POINTSFORCOMMENT."</td>
    <td nowrap=\"nowrap\"><input name=\"pointsp[]\" type=\"text\" value=\"".$points[1]."\" size=\"4\" maxlength=\"3\" /></td>
  </tr>
  <tr>
    <td nowrap=\"nowrap\">"._SENDTOFRIEND."</td>
    <td>"._POINTSFORSENDTOFRIEND."</td>
    <td nowrap=\"nowrap\"><input name=\"pointsp[]\" type=\"text\" value=\"".$points[2]."\" size=\"4\" maxlength=\"3\" /></td>
  </tr>
  <tr>
    <td nowrap=\"nowrap\">"._SUBMITVIDS."</td>
    <td>"._POINTSFORSUBMITVIDEO."</td>
    <td nowrap=\"nowrap\"><input name=\"pointsp[]\" type=\"text\" value=\"".$points[3]."\" size=\"4\" maxlength=\"3\" /></td>
  </tr>
  <tr>
    <td nowrap=\"nowrap\">"._RATING."</td>
    <td>"._POINTSFORRATEVIDEO."</td>
    <td nowrap=\"nowrap\"><input name=\"pointsp[]\" type=\"text\" value=\"".$points[4]."\" size=\"4\" maxlength=\"3\" /></td>
  </tr>
  <tr>
    <td colspan=\"3\" nowrap=\"nowrap\"><div align=\"right\">
      <input type=\"submit\" name=\"PSSubmit\" value=\""._SAVESETTINGS."\" />
    </div></td>
    </tr>
</table>
</form>";
unset($points);
CloseTable();
?>