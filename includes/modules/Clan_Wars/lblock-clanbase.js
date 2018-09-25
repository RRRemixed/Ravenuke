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

var count = 0;

function cbjsWarPast_Start()
{
}


function cbjsWarPast_End()
{
}

function cbjsWarPast_Each(wid,clan,cid,lid,date,score1,score2,level1,level2, game,subgame,forfeit,type,hasdemo)
{	
	if(count >= 5) // Edit to the number of upcoming wars you wish to be shown
	return;
	document.write("- <a href='http://www.clanbase.com/claninfo.php?cid="+cid+"' class='slink' target='bla'>"+clan+"</a>");
document.write(" [ ");

if (score1 >= score2) {
document.write("<font color='green'>");
document.write(""+score1+"");
document.write("</font>");
document.write(" - ");
document.write(""+score2+"");
}

if (score1 <= score2) {
document.write("<font color='red'>");
document.write(""+score1+"");
document.write("</font>");
document.write(" - ");
document.write(""+score2+"");
}

document.write(" ] ");
document.write("<a href='http://www.clanbase.com/warrep_show.php?wid="+wid+"&cid="+cid+"' class='slink' target='bla'><img src='http://www.clanbase.com/report.gif' border='0'></a>");
document.write("<br>");
	count++;	
}