/************************************************************************/
/* PHP-NUKE: Clanwars Package                                           */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Dick Snel                                      */
/* http://www.fvgaming.com	     	                                */
/* webmaster@fvgaming.com						*/
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/* 									*/
/* Enjoy!								*/
/************************************************************************/

// This script comes from www.clanbase.com, but edited for the block by me.

var count2 = 0;

function cbjsWarUpcoming_Start()
{
//	Do nothing !
}

function cbjsWarUpcoming_End()
{
//	Do nothing !
}

function cbjsWarUpcoming_Each(wid,clan,cid,lid,date,level1,level2,game,subgame,type)
{
	if(count2 >= 1) // Edit to the number of upcoming wars you wish to be shown
		return;
	//	Note: the date is GMT
	//	Converting this date to localtime is left as an excercise for the reader :-)
	document.write("<center>War Vs <a href='http://www.clanbase.com/claninfo.php?cid="+cid+"' class='slink' target='bla'>"+clan+"</a><br>");
	document.write(" "+date+"");
	document.write(" <a href='http://www.clanbase.com/rating.php?lid="+lid+"' class='slink' target='bla'>"+game+"/"+subgame+"</a><br>");
	document.write(" <a href='http://www.clanbase.com/warinfo.php?wid="+wid+"' class='slink' target='bla'>More Details...</a></center>");
	count2++;
}