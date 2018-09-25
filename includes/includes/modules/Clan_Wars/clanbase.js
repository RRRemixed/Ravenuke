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
var win_count = 0;
var loss_count = 0;
var draw_count = 0;
	
function cbjsWarPast_Start()
{
	document.write("<table border='0' cellpadding='1' cellspacing='1' width='100%' align='center'>");
	document.write("<tr>");
	document.write("<td class='td3d' height='23' class='small'><b>War Id</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Clan</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Datum</b></td>");
	document.write("<td class='td3d' height='23' class='small' colspan='2'align='center'><b>Score</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Maps</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Type</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Ladder</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Forfeit</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Demo</b></td>");
	document.write("<td class='td3d' height='23' class='small'><b>Report</b></td>");
	document.write("</tr>");
}


function cbjsWarPast_End()
{
perwins=Math.round(((win_count/count)*100));
	document.write("<tr><td colspan=6><font class='content'>Statistics: Last "+count+" wars played, "+win_count+" won, "+draw_count+" draw and "+loss_count+" lost</font></td></tr>");
	document.write("</table>");
}

function cbjsWarPast_Each(wid,clan,cid,lid,date,score1,score2,level1,level2, game,subgame,forfeit,type,hasdemo)
{	
	var mdate = date;
	var mday = mdate.substr( 8, 2 );
	var mmonth = mdate.substr( 5, 2 );
	var myear = mdate.substr( 0, 4 );
	
	switch( mmonth ) {
	case( '01' ): month = 01; maxdays=31; break;
	case( '02' ): month = 02; maxdays=28; break;
	case( '03' ): month = 03; maxdays=31; break;
	case( '04' ): month = 04; maxdays=30; break;
	case( '05' ): month = 05; maxdays=31; break;
	case( '06' ): month = 06; maxdays=30; break;
	case( '07' ): month = 07; maxdays=31; break;
	case( '08' ): month = 08; maxdays=31; break;
	case( '09' ): month = 09; maxdays=30; break;
	case( '10' ): month = 10; maxdays=31; break;
	case( '11' ): month = 11; maxdays=30; break;
	case( '12' ): month = 12; maxdays=31; break;
	default: break;
	}

	switch( mday ) {
	case( '01' ): day = 01; break;
	case( '02' ): day = 02; break;
	case( '03' ): day = 03; break;
	case( '04' ): day = 04; break;
	case( '05' ): day = 05; break;
	case( '06' ): day = 06; break;
	case( '07' ): day = 07; break;
	case( '08' ): day = 08; break;
	case( '09' ): day = 09; break;
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

	if(count >= 15)
		return;
	//	Only official matches
	//if(type!=0)
	//	return;
	//	Skip forfeit wins
	if(forfeit=='Y')
		return;
	document.write("<td class='td3d'><a href='http://www.clanbase.com/warinfo.php?wid="+wid+"' class='slink' target='bla'>"+wid+"</a></td>");
	document.write("<td class='td3d'><a href='http://www.clanbase.com/claninfo.php?cid="+cid+"' class='slink' target='bla'>"+clan+"</a></td>");
	document.write("<td class='td3d'>"+mday+"-"+mmonth+"-"+myear+"</td>");
	if(score1 > score2)
		{
		document.write("<td class='td3d' bgcolor='#3B774C'>");                                     
		win_count++;
		}		
	if (score1 == score2)
		{  
		document.write("<td class='td3d' bgcolor='#777777'>");                            
		draw_count++;
		}
			           
	if (score1 < score2)
		{
		document.write("<td class='td3d' bgcolor='#8F4545'>");        
		loss_count++;
	        }
	document.write(""+score1+"</td>");
	document.write("<td class='td3d' align='right'>"+score2+"</td>");
	document.write("<td class='td3d'><center>"+level1+"/"+level2+"</center></td>");
	document.write("<td class='td3d' align='center'>");
	if(type=='0')
		document.write("Official");
	else
		document.write("Friendly");
	document.write("</td>");
	document.write("<td class='td3d'><a href='http://www.clanbase.com/rating.php?lid="+lid+"' class='slink' target='bla'>"+game+"/"+subgame+"</a></td>");
	document.write("<td class='td3d' align='center'>"+forfeit+"</td>");
	document.write("<td class='td3d' align='center'>");
	if(hasdemo=='Y')
		document.write("<a href='http://www.clanbase.com/demolist.php?post=1&wid="+wid+"' class='slink' target='bla'><img src='http://www.clanbase.com/demo.gif' border='0'></a>");
	else
		document.write("N");
	document.write("</td>");
	document.write("<td align='center' class='td3d'><a href='http://www.clanbase.com/warrep_show.php?wid="+wid+"&cid="+cid+"' class='slink' target='bla'><img src='http://www.clanbase.com/report.gif' border='0'></a></td>");
	document.write("</td>");

	document.write("</tr>");
	count++;
}