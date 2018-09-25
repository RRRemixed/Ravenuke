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

var count = 0;

function cbjsWarUpcoming_Start()
{
	document.write("<table border='0' cellpadding='1' cellspacing='1' width='100%' align='center'>");
	document.write("<tr>");
	document.write("<td class='td3d' height='23' class='small'><b>War Id</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Clan</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Date</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Maps</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Type</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Ladder</b></td>");
	document.write("</tr>");
}

function cbjsWarUpcoming_End()
{
	document.write("</table>");
}

function cbjsWarUpcoming_Each(wid,clan,cid,lid,date,level1,level2,game,subgame,type)
{
var mdate = date;

	var mday = mdate.substr( 8, 2 );
	var mmonth = mdate.substr( 5, 2 );
	var myear = mdate.substr( 0, 4 );
	var mtime = mdate.substr( 11, 5 );
	var mhour = mtime.substr(0, 2);
	var mmin = mtime.substr(3, 2);

	switch( mmonth ) {
	case( '01' ): month = 1; maxdays=31; break;
	case( '02' ): month = 2; maxdays=28; break;
	case( '03' ): month = 3; maxdays=31; break;
	case( '04' ): month = 4; maxdays=30; break;
	case( '05' ): month = 5; maxdays=31; break;
	case( '06' ): month = 6; maxdays=30; break;
	case( '07' ): month = 7; maxdays=31; break;
	case( '08' ): month = 8; maxdays=31; break;
	case( '09' ): month = 9; maxdays=30; break;
	case( '10' ): month = 10; maxdays=31; break;
	case( '11' ): month = 11; maxdays=30; break;
	case( '12' ): month = 12; maxdays=31; break;
	default: break;
	}

	switch( mday ) {
	case( '01' ): day = 1; break;
	case( '02' ): day = 2; break;
	case( '03' ): day = 3; break;
	case( '04' ): day = 4; break;
	case( '05' ): day = 5; break;
	case( '06' ): day = 6; break;
	case( '07' ): day = 7; break;
	case( '08' ): day = 8; break;
	case( '09' ): day = 9; break;
	case( '10' ): day = 10; break;
	case( '11' ): day = 11; break;
	case( '12' ): day = 12; break;
	case( '13' ): day = 13; break;
	case( '14' ): day = 14; break;
	case( '15' ): day = 15; break;
	case( '16' ): day = 16; break;
	case( '17' ): day = 17; break;
	case( '18' ): day = 18; break;
	case( '19' ): day = 19; break;
	case( '20' ): day = 20; break;
	case( '21' ): day = 21; break;
	case( '22' ): day = 22; break;
	case( '23' ): day = 23; break;
	case( '24' ): day = 24; break;
	case( '25' ): day = 25; break;
	case( '26' ): day = 26; break;
	case( '27' ): day = 27; break;
	case( '28' ): day = 28; break;
	case( '29' ): day = 29; break;
	case( '30' ): day = 30; break;
	case( '31' ): day = 31; break;
	default: break;
	}

	switch(mhour){
	case( '01' ): hour = 1 + 2; break;
	case( '02' ): hour = 2 + 2; break;
	case( '03' ): hour = 3 + 2; break;
	case( '04' ): hour = 4 + 2; break;
	case( '05' ): hour = 5 + 2; break;
	case( '06' ): hour = 6 + 2; break;
	case( '07' ): hour = 7 + 2; break;
	case( '08' ): hour = 8 + 2; break;
	case( '09' ): hour = 9 + 2; break;
	case( '10' ): hour = 10 + 2; break;
	case( '11' ): hour = 11 + 2; break;
	case( '12' ): hour = 12 + 2; break;
	case( '13' ): hour = 13 + 2; break;
	case( '14' ): hour = 14 + 2; break;
	case( '15' ): hour = 15 + 2; break;
	case( '16' ): hour = 16 + 2; break;
	case( '17' ): hour = 17 + 2; break;
	case( '18' ): hour = 18 + 2; break;
	case( '19' ): hour = 19 + 2; break;
	case( '20' ): hour = 20 + 2; break;
	case( '21' ): hour = 21 + 2; break;
	case( '22' ): hour = 22 + 2; break;
	case( '23' ): hour = 23 + 2; break;
	case( '24' ): hour = 24 + 2; break;
	case( '0' ): hour = 0 + 2; break;
	default: break;
	}
	if(hour > 24)
	{
	day=day+1;
	hour = hour-24;
	if(day > maxdays)
	{
	 day = day - maxdays;
	 month=month+1
	 }
	}

	switch( month ) {
	case( 1 ): mmonth = 'Januari'; break;
	case( 2 ): mmonth = 'Februari'; break;
	case( 3 ): mmonth = 'Maart'; break;
	case( 4 ): mmonth = 'April'; break;
	case( 5 ): mmonth = 'Mei'; break;
	case( 6 ): mmonth = 'Juni'; break;
	case( 7 ): mmonth = 'Juli'; break;
	case( 8 ): mmonth = 'Augustus'; break;
	case( 9 ): mmonth = 'September'; break;
	case( 10 ): mmonth = 'Oktober'; break;
	case( 11 ): mmonth = 'November'; break;
	case( 12 ): mmonth = 'December'; break;
	default: break;
	}
	
	if(count >= 5)
	return;
	document.write("<tr>");
	document.write("<td class='td3d'><a href='http://www.clanbase.com/warinfo.php?wid="+wid+"' class='slink' target='bla'>"+wid+"</a></td>");
	document.write("<td class='td3d'><a href='http://www.clanbase.com/claninfo.php?cid="+cid+"' class='slink' target='bla'>"+clan+"</a></td>");
	document.write("<td class='td3d'>"+day+" "+mmonth+" om "+hour+":"+mmin+" uur</td>");
	document.write("<td class='td3d'>"+level1+"/"+level2+"</td>");
	document.write("<td class='td3d'>");
	if(type=='0')
			document.write("Official");
		else
			document.write("Friendly");
	document.write("<td class='td3d'><a href='http://www.clanbase.com/rating.php?lid="+lid+"' class='slink' target='bla'>"+game+"/"+subgame+"</a></td>");
	document.write("</tr>");
	count++;
}