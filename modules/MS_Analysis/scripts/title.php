<?php

/************************************************************************************/
/*                                                                                  */
/* Maty Scripts Analysis for PHP-Nuke 6.5-7.9                                       */
/* v2.3                                                                             */
/*                                                                                  */
/* Copyright © 2002-2005 by: Maty Scripts (webmaster@matyscripts.com)               */
/* http://www.matyscripts.com                                                       */
/*                                                                                  */
/* This program is free software. You can redistribute it and/or modify             */
/* it under the terms of the GNU General Public License as published by             */
/* the Free Software Foundation; either version 2 of the License.                   */
/*                                                                                  */
/************************************************************************************/

echo "<br><center><img src=\"modules/$module_name/images/msanalysis.gif\" border=\"0\" align=\"absbottom\" alt=\"MS-Analysis\" title=\"MS-Analysis\"><br>\n";
echo "<span style=\"FONT-SIZE: 8px; LINE-HEIGHT: normal\">";

$result = $db->sql_query( "select staticupdate, version from ".$prefix."_msanalysis_admin where id='1'" );
list( $staticupdate, $version ) = $db->sql_fetchrow( $result );
if( $staticupdate ) echo "<b><a href=\"http://www.matyscripts.com\">$version</a></b>&nbsp;-&nbsp;" . _MSA_UPDATESTATIC . "\n";
else echo "<b><a href=\"http://www.matyscripts.com\">$version</a></b>&nbsp;-&nbsp;" . _MSA_UPDATEDYNAMIC . "\n";

echo "</center></span></font></p>";

?>
