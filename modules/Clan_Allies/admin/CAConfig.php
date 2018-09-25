<?php
/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/
if ( !defined('ADMIN_FILE') )
{
	die ("Access Denied");
}

$pagetitle = ": "._CONFIGMAIN." ".$ca_config['version_number'];
include("header.php");
title(_CONFIGMAIN." ".$ca_config['version_number']);
camenu();
echo "<br>\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php?op=CAConfigSave' method='post'>\n";
echo "<tr><td><b>"._REQUIREUSER.":</b></td>\n<td>";
$chk1 = $chk2 = $chk3 = $chk4 ="";
if($ca_config['require_user']==0) { $chk1 = " checked"; } else { $chk2 = " checked"; }
echo "<input type='radio' name='require_user' value='0'$chk1>"._NO." &nbsp;";
echo "<input type='radio' name='require_user' value='1'$chk2>"._YES."</td></tr>\n";
echo "<tr><td><b>"._IMAGETYPE.":</b></td>\n<td>";
if($ca_config['image_type']==0) {  $chk3 = " checked"; } else { $chk4 = " checked"; }
echo "<input type='radio' name='image_type' value='0'$chk3>"._LINKED." &nbsp;";
echo "<input type='radio' name='image_type' value='1'$chk4>"._UPLOAD."</td></tr>\n";
echo "<tr><td><b>"._MAXWIDTH.":</b></td>\n";
echo "<td><input type='text' name='max_width' value='".$ca_config['max_width']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td><b>"._MAXHEIGHT.":</b></td>\n";
echo "<td><input type='text' name='max_height' value='".$ca_config['max_height']."' size='5' maxlength='4'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._SAVECHANGES."'></td></tr>\n";
echo "</form></table>";
CloseTable();
include("footer.php");

?>