<?php

/********************************************************/
/* Hall of Shame                                     	*/
/* By: Troy Moore (Duck@mrc.clanservers.com)			*/
/* http://mrc.clanservers.com                           */
/* Copyright � 2006-2011 by JesStep Enterprises         */
/********************************************************/
/* Hall of Shame                                        */
/* For PHP-Nuke 6.5+                                    */
/* By Troy Moore - http://mrc.clanservers.com        	*/
/********************************************************/


if ( !defined('ADMIN_FILE') ) {
	die("Illegal Admin File Access");
}


$pagetitle = " - "._HoS_HALLOFSHAME.": "._HoS_ADDMEMBER;
@include("header.php");
adminheader(_HoS_HALLOFSHAME.": "._HoS_ADDMEMBER);
echo "<br>\n";
OpenTable();
echo "<table align='center' border='0' cellpadding='2' cellspacing='2'>\n";
echo "<form action='".$admin_file.".php' method='POST'>\n";
echo "<input type='hidden' name='op' value='HoSMember_Add_Save'>\n";
echo "<tr><td bgcolor='$bgcolor2'><b>"._HoS_MEMBERNAME.":</b></td>\n";
echo "<td><input type='text' name='membername' size='54' maxlength='120'></td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='checkbox' name='another' value='1'>"._HoS_ADDANOTHERMEMBER."</td></tr>\n";
echo "<tr><td align='center' colspan='2'><input type='submit' value='"._HoS_ADDMEMBER."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";
CloseTable();
@include("footer.php");

?>