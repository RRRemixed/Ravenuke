<?php

/********************************************************/
/* NukeSentinel(tm)                                     */
/* By: NukeScripts(tm) (http://www.nukescripts.net)     */
/* Copyright � 2000-2008 by NukeScripts(tm)             */
/* See CREDITS.txt for ALL contributors                 */
/********************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_EXCLUDEDDELETE;
include("header.php");
OpenTable();
OpenMenu(_AB_EXCLUDEDDELETE);
mastermenu();
CarryMenu();
excludedmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABExcludedDeleteSave" />'."\n";
echo '<input type="hidden" name="ip_lo" value="'.$ip_lo.'" />'."\n";
echo '<input type="hidden" name="ip_hi" value="'.$ip_hi.'" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" class="content">'._AB_EXCLUDEDDELETES.' '.long2ip($ip_lo).' to '.long2ip($ip_hi).'?</td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_EXCLUDEDDELETE.'" /></td></tr>'."\n";
echo '<tr><td align="center">'._GOBACK.'</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>