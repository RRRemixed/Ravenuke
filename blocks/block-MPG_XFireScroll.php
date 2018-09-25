<?php
/***********************************************************
-Begin- Block Config (edit if needed)
***********************************************************/
$scrolldirection = "up"; //up-down-left-right Default:up
$scrollbehavior = "scroll"; //scroll-slide-alternate Default:scroll
$scrollheight = "200"; //The height of the scroll and the block. Default:200
$scrolldelay = "100"; //The delay in the scroll. Default:100
$scrollamount = "3"; //The amount of each scroll. Default:3
$numtoshow = "25"; //The amount of XFires to list. Default:25
/***********************************************************
-End- Block Config (don't edit below)
***********************************************************/

global $prefix, $db;
$getxfirecfg = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfirecfg");
$xfirecfg = mysql_fetch_array($getxfirecfg);
$getallxfires = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE xfire!='' 
ORDER BY $xfirecfg[xfiresorderby] $xfirecfg[xfiresorder] LIMIT $numtoshow");
while(list($id) = mysql_fetch_row($getallxfires)){
$getxfire = $db->sql_query("SELECT * FROM ".$prefix."_mpg_xfires WHERE id='$id'");
$xfire = mysql_fetch_array($getxfire);
$allxfires = $allxfires."<A HREF='http://profile.xfire.com/$xfire[xfire]' TARGET=_blank>
<IMG SRC='http://miniprofile.xfire.com/bg/$xfirecfg[xfiresskin]/type/3/$xfire[xfire].png' BORDER=0><BR><BR>";}
$content = "<CENTER>
<MARQUEE ID=xfscroller DIRECTION=$scrolldirection ALIGN=center SCROLLDELAY=$scrolldelay SCROLLAMOUNT=$scrollamount 
HEIGHT=$scrollheight BEHAVIOR=$scrollbehavior onMouseOver=\"document.all.xfscroller.stop()\" 
onMouseOut=\"document.all.xfscroller.start()\">
$allxfires</MARQUEE></CENTER>";
?>