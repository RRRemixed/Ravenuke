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

/*************************************/
/* MSA v2.2 New Language definitions */
/*************************************/
define("_MSA_UPDATEERROR","Error: Could not update the MSA tables");

/*************************************/
/* MSA v2.1 New Language definitions */
/*************************************/
define("_MSA_SUNDAY","Sunday");
define("_MSA_MONDAY","Monday");
define("_MSA_TUESDAY","Tuesday");
define("_MSA_WEDNESDAY","Wednesday");
define("_MSA_THURSDAY","Thursday");
define("_MSA_FRIDAY","Friday");
define("_MSA_SATURDAY","Saturday");
define("_MSA_TOTALVISITSHOURS","Total Page Visits per Hour");
define("_MSA_TOTALVISITSWEEKDAYS","Total Page Visits per WeekDay" );
define("_MSA_TOTALVISITSMONTHS","Total Page Visits per Month");
define("_MSA_GENAVERAGES","Averages" );
define("_MSA_DAYS","Day" );
define("_MSA_VISITSDAYS","Page Visits per day" );
define("_MSA_POINTS","Points" );
define("_MSA_ADMINFUNCTIONS","User Administration" );
define("_MSA_MSAEDITUSER","Edit User" );
define("_MSA_MSASUSPENDUSER","Suspend User" );
define("_MSA_MSADELETEUSER","Delete User" );
define("_MSA_MSADELETEUSERS","Delete Users" );
define("_MSA_MENUNUKETHEMES","Themes" );
define("_MSA_MENUNUKEDEFTHEME","Default Theme" );
define("_MSA_MENUNUKEINSTTHEMES","Installed Theme(s)" );
define("_MSA_MENUNUKESELECTEDTHEMES","Theme Selection Overview" );
define("_MSA_MENUNUKEUSERTHEMES","Users who selected this theme" );
define("_MSA_ENDISABLE","Enable/Disable the MS-Analysis Module" );
define("_MSA_ENABLED","Enabled" );
define("_MSA_DISABLED","Disabled" );
define("_MSA_DELETEINACTIVEUSR","Delete Inactive Users" );
define("_MSA_DELETEALLINACTIVEUSR1","Delete ALL selected Inactive Users from MSA Users Table" );
define("_MSA_DELETEALLINACTIVEUSR2","Delete ALL selected Inactive Users from MSA <u>AND</u> PHP-Nuke Users Table" );
define("_MSA_SELECTEDINACTIVEUSR","Selected Users" );
define("_MSA_SHOWINACTIVEUSR","Show Users who didn't visit this site since:" );
define("_MSA_INACTIVEUSR","Users who didn't visit this site since:" );
define("_MSA_SEARCHINACTIVEUSR","Search" );
define("_MSA_CLOSE","Close" );
define("_MSA_PAGE1","Page" );
define("_MSA_PAGE2","Select Page" );
define("_MSA_PAGE3","of" );
define("_MSA_PAGE4","Pages" );
define("_MSA_DELINACTIVEMSA","Delete only from MSA Users Table" );
define("_MSA_CDELINACTIVEMSA","Are you sure you want to delete the following User <u>ONLY</u> from the MSA Users Table:" );
define("_MSA_DELINACTIVEMSAPHP","Delete from MSA <u>AND</u> PHP-Nuke Users Table" );
define("_MSA_CDELINACTIVEMSAPHP","Are you sure you want to delete the following User from the MSA <u>AND</u> PHP-Nuke Users Table:" );
define("_MSA_CDELINACTIVESMSA","Are you sure you want to delete <u>ALL</u> selected Users <u>ONLY</u> from the MSA Users Table" );
define("_MSA_CDELINACTIVESMSAPHP","Are you sure you want to delete <u>ALL</u> selected Users from the MSA <u>AND</u> PHP-Nuke Users Table" );

/*************************************/
/* MSA v2.0 New Language definitions */
/*************************************/
define("_MSA_NEWSTATS","Statistics till" );
define("_MSA_SINCE","since" );
define("_MSA_DATAUPDATE","Update of all Statistics.<br><br>
                          Adviced is to choose: <i>Statically</i>. This will have the minimum impact on the
                          performance of your host.<br><br>
                          When you have e.g. the Control Panel as user interface to your host then
                          select: <i>Statically (Updates done by Cron).</i> Refer to the installation.txt file on
                          how to set it up.<br><br>
                          When your interface doesn't allow you to define Cron Jobs, choose:
                          <i>Statically (Updates done by MSA).</i> MSA will update the stats automatically every hour. This option
                          is however not advised for high traffic sites.<br><br>
                          When you still prefer to have your statistics updated after each pagevisit of a guest,
                          then choose: <i>Dynamically</i>. Remember that this may slow down your host when
                          you have a high traffic site." );
define("_MSA_UPDATESTATIC","Statically" );
define("_MSA_UPDATESTATIC1","Statically (Updates done by Cron)" );
define("_MSA_UPDATESTATIC2","Statically (Updates done by MSA)" );
define("_MSA_UPDATEDYNAMIC","Dynamically" );
define("_MSA_MSAURL","Your Site URL that should be excluded from the Referrals list" );
define("_MSA_VISITOROVERVIEWGRAPH","Visitor Stats Graphics" );
define("_MSA_SCREENTYPE","Default Page in MS-Analysis" );
define("_MSA_UP","Ascending" );
define("_MSA_DOWN","Descending" );

/*************************************/
/* MSA v1.1 New Language definitions */
/*************************************/
define("_MSA_MSAVERSION","MS-Analysis" );
define("_MSA_SORTONTIME","Time" );
define("_MSA_SEARCHIP","Search IP-Address" );
define("_MSA_NOSUCHIPADDR","This IP-Address does not exist in the MS-Analysis Database" );
define("_MSA_OVERVIEWPERIODS","Select desired Time Overview" );
define("_MSA_OVERVIEWTODAY","Today's Traffic" );
define("_MSA_OVERVIEWLASTDAYS1","Traffic Last" );
define("_MSA_OVERVIEWLASTDAYS2","Days" );
define("_MSA_OVERVIEWALL","Overall Traffic" );
define("_MSA_VISITSHOURS","Page Visits per hour for");
define("_MSA_PAGESVIEWED"," pages viewed");
define("_MSA_HOURS","Hour");
define("_MSA_VISITSMONTHS","Page Visits per month for");
define("_MSA_MONTHS","Month");
define("_MSA_VISITSYEARS","Page Visits per year");
define("_MSA_YEARS","Year");
define("_MSA_OVERVIEWTYPE","Default MS-Analysis Overview Page");
define("_MSA_TIMEZONE","System Timezone");
define("_MSA_GMTHOUR","Hour");
define("_MSA_GMTHOURS","Hours");
define("_MSA_STATSRESET","Resetting Statistics");
define("_MSA_ADMINOPTIONS","Options");
define("_MSA_SEARCHINFO","Search For User Information");
define("_MSA_RESETTODAY","Reset Today's Traffic?");
define("_MSA_RESETLASTXDATE","Reset Traffic Last X days?");
define("_MSA_USERINFO","User Information");
define("_MSA_RESETALL", "Are you sure you want to reset ALL statistics tables ? All your gathered statistics will be permanently deleted !");
define("_MSA_SOFAR","sofar");
define("_MSA_TABLEPRUNING","Pruning");
define("_MSA_PRUNINGSETTINGS","Pruning Settings");
define("_MSA_PRUNINGAUTO","Prune tables every [xx] days automatically");
define("_MSA_PRUNINGEVERY","Every");
define("_MSA_PRUNINGSTARTFROM","days starting from");
define("_MSA_PRUNINGNOAUTO","NO AUTO PRUNING OF TABLES");
define("_MSA_PRUNINGYESAUTO","AUTO PRUNING OF TABLES");
define("_MSA_PRUNINGMAX","Max");
define("_MSA_PRUNINGLINKS","Links");
define("_MSA_PRUNINGEXPLANATION","Explanation: Every [xx] days, tables with more than [defined] links will be automatically pruned. MSA will first delete links with 1 hit. If there are
                                  still more than [defined] links in the table, links with 2 hits will be deleted, etc.
                                  <br><br><b>Leave a field empty or enter '0', if the table should not be pruned eventhough Auto Pruning is set to yes</b>");
define("_MSA_PRUNINGMESSAGE1","Auto Pruning Disabled");
define("_MSA_PRUNINGMESSAGE2","Auto Pruning in");
define("_MSA_PRUNINGMESSAGE3","Days");

/*********************************/
/* MSA v1.0 Language definitions */
/*********************************/
define("_MSA_ADMIN","Administrator Settings");
define("_MSA_WIDTH","Width");
define("_MSA_HEIGHT","Height");
define("_MSA_COLORS","Colors");
define("_MSA_HITS","Hits");
define("_MSA_STATS","Access Statistics");
define("_MSA_WERECEIVED","We received");
define("_MSA_PAGESVIEWS","page views since");
define("_MSA_TODAYIS","Today is");
define("_MSA_MOSTMONTH","Busiest Month");
define("_MSA_MOSTDAY","Busiest Day");
define("_MSA_MOSTHOUR","Busiest Hour");
define("_MSA_TOP","Top");
define("_MSA_DOWNLOADS1", "There are currently");
define("_MSA_DOWNLOADS2", "downloads that have been downloaded");
define("_MSA_DOWNLOADS3", "times");
define("_MSA_GENTITLE", "General Overview");
define("_MSA_GENCOUNTRIES", "Countries");
define("_MSA_GENBROWSERS", "Browsers");
define("_MSA_GENTYPEBROWSERS", "Browsers per Type");
define("_MSA_GENOTHERBROWSERS", "Web Crawlers");
define("_MSA_GENOS", "Operating Systems");
define("_MSA_GENMODULES", "Modules");
define("_MSA_GENREFERRALS", "Referrals");
define("_MSA_GENSENGINES", "Search Engines");
define("_MSA_GENQUERIES", "Search Words");
define("_MSA_GENUSERS", "Users");
define("_MSA_GENTOTAL", "Total");
define("_MSA_GENRESOLUTION", "Screen Resolutions");
define("_MSA_MENUPAGEVISITS", "Last page Visits");
define("_MSA_MENUOVERVIEW", "Overview");
define("_MSA_MENUNUKESTATS", "PHP-Nuke Stats");
define("_MSA_ONLINETITLE1", "Last");
define("_MSA_ONLINETITLE2", "Visitors");
define("_MSA_ONLINEDATE", "Time");
define("_MSA_ONLINEUSER", "User");
define("_MSA_ONLINEMOD", "Module");
define("_MSA_ONLINECOUNTRY", "Country");
define("_MSA_ONLINEBROWSER", "Browser");
define("_MSA_ONLINEOPSYSTEM", "Op. System");
define("_MSA_ONLINEHOST", "Host");
define("_MSA_ONLINEGUEST", "Guest");
define("_MSA_DELETE", "Delete");
define("_MSA_NAME", "Name");
define("_MSA_SYMBOL", "Symbol");
define("_MSA_FLAG", "Flag");
define("_MSA_HITS", "Hits");
define("_MSA_LASTVISIT", "Last Here");
define("_MSA_GPAGESVIEWS", "Last 7 days");
define("_MSA_RESETTABLE", "Reset Table");
define("_MSA_DELETETABLE", "Are you sure you want to reset this table ? All gathered statistics for this table will be permanently deleted !");
define("_MSA_YES", "Yes");
define("_MSA_NO", "No");
define("_MSA_ON", "on");
define("_MSA_RETURNBASICSTATS","Return to Basic Statistics");
define("_MSA_BACKTODETSTATS","Back to Detailed Statistics");
define("_MSA_BACKTOMAIN","Back to Main");
define("_MSA_MOSTMONTH","Busiest Month");
define("_MSA_MOSTDAY","Busiest Day");
define("_MSA_MOSTHOUR","Busiest Hour");
define("_MSA_YEARLYSTATS","Yearly Stats");
define("_MSA_MONTLYSTATS","Montly Stats for");
define("_MSA_SPAGESVIEWS","Page Views");
define("_MSA_DAILYSTATS","Daily Stats for");
define("_MSA_HOURLYSTATS","Hourly Stats for");
define("_MSA_VIEWDETAILED","View Detailed Statistics");
define("_MSA_DATE","Date");
define("_MSA_HOUR","Hour");
define("_MSA_UMONTH","Month");
define("_MSA_YEAR","Year");
define("_MSA_JANUARY","January");
define("_MSA_FEBRUARY","February");
define("_MSA_MARCH","March");
define("_MSA_APRIL","April");
define("_MSA_MAY","May");
define("_MSA_JUNE","June");
define("_MSA_JULY","July");
define("_MSA_AUGUST","August");
define("_MSA_SEPTEMBER","September");
define("_MSA_OCTOBER","October");
define("_MSA_NOVEMBER","November");
define("_MSA_DECEMBER","December");
define("_MSA_TOTMEM"," Total Members:");
define("_MSA_REGTODAY","Registered Today");
define("_MSA_REGYESTERDAY","Registered Yesterday");
define("_MSA_ONLINE","Users Current Online");
define("_MSA_NAME","Name");
define("_MSA_MISCSTATS","Miscelaneous Site Stats");
define("_MSA_ACTIVEAUTHORS"," Active Authors: ");
define("_MSA_STORIESPUBLISHED"," Stories Published: ");
define("_MSA_SACTIVETOPICS"," Active Topics: ");
define("_MSA_SACTIVESTORIES"," Active Stories: ");
define("_MSA_SACTIVECONTENTS"," Contents Categories/Pages: ");
define("_MSA_COMMENTSPOSTED"," Comments Posted: ");
define("_MSA_ARTICLESSEC"," Articles in Sections: ");
define("_MSA_LINKSINLINKS"," Links in Web Links: ");
define("_MSA_LINKSCAT"," Categories in Links: ");
define("_MSA_NEWSWAITING"," News Waiting to be Published: ");
define("_MSA_SECTIONS"," Sections: ");
define("_MSA_REVIEWS"," Reviews: ");
define("_MSA_FAQ"," Frequently Asked Questions: ");
define("_MSA_DWNLC"," Amount of Download Categories: ");
define("_MSA_DWNLSIZE"," Mbytes data downloaded: ");
define("_MSA_PAGEVIEWS"," Page Views: ");
define("_MSA_NUKEVERSION"," PHP-Nuke Version: ");
define("_MSA_VIEW","Show User Details");
define("_MSA_USRLINE","Details of User: ");
define("_MSA_COMESFROM","This article comes from");
define("_MSA_THEURL","The URL for this overview is:");
define("_MSA_USRFN"," Full Name:");
define("_MSA_USRLN"," Login Name: ");
define("_MSA_USREMAIL"," E-Mail: ");
define("_MSA_USRWWW"," Homepage: ");
define("_MSA_USRUF"," Location: ");
define("_MSA_USRIP"," Host IP-address: ");
define("_MSA_USRRD"," User Registration Date: ");
define("_MSA_TOTHITS"," Total Pageviews since ");
define("_MSA_AMOUNTDOWNLOADS"," Downloadable Files: ");
define("_MSA_TOTALDOWNLOADS"," Total amount of Downloads: ");
define("_MSA_AVIEWS","Maximum of Data Lines on:");
define("_MSA_AITEMS","Overview Page");
define("_MSA_AVIEW","Detailed Page");
define("_MSA_AONLINE","Last Page Visits");
define("_MSA_SAVE","Save");
define("_MSA_GOBACK","Go Back" );
define("_MSA_TABLEMAIN","Table Maintenance" );
define("_MSA_SQUERY","Store search query as" );
define("_MSA_SEARCH","0 = String | 1 = Words" );
define("_MSA_SORTON","Sort on" );
define("_MSA_SORTONID","Id" );
define("_MSA_SORTONHITS","Hits" );
define("_MSA_SORTDIRASC","Ascending" );
define("_MSA_SORTDIRDESC","Descending" );
define("_MSA_BACKUP","Backup data as SQL File" );
define("_MSA_YESTERDAY","Yesterday" );
define("_MSA_DAYSAGO","Days ago" );
define("_MSA_SEARCHUSER","Search for a User" );
define("_MSA_NOSUCHUSER","This User does not exist in the MS-Analysis Database" );
define("_MSA_USERNAME","Username" );
define("_MSA_EMAIL","E-mail address" );
define("_MSA_URL","URL" );
define("_MSA_REGDATE","Registration Date" );
define("_MSA_OCC","Occupation" );
define("_MSA_INTREST","Interests" );
define("_MSA_SIG","Signature" );
define("_MSA_BROWSER","Browser" );
define("_MSA_OS","Operating System" );
define("_MSA_IP","IP-address" );
define("_MSA_COUNTRY","Country" );
define("_MSA_HOST","ISP/Host" );
define("_MSA_TIME","Last Time online" );
define("_MSA_HITS","Page Hits" );
define("_MSA_LAST10BBTOPICS","Last 10 Forum Topics started by");
define("_MSA_LAST10DOWNLOADS","Last 10 Downloads Submitted by");
define("_MSA_LAST10WEBLINKS","Last 10 Web Links Submitted by");
define("_MSA_LAST10COMMENTS","Last 10 Comments by");
define("_MSA_LAST10SUBMISSIONS","Last 10 News Submissions sent by");
define("_MSA_GENSETTINGS","General Settings");
define("_MSA_EXCLUDEIP","Exclude IP-addresses");
define("_MSA_EXCLUDEUSERS","Exclude Users");
define("_MSA_DEFSE","Define Search Engines");
define("_MSA_ADDEXCLUDEIP","Add an IP-address for exclusion");
define("_MSA_ADDEXCLUDEUSER","Add a Username for exclusion");
define("_MSA_WRITEERROR","<b>Could not write to file. Please check if directory has read and write rights !</b>" );
define("_MSA_ENTERVALUE","Please, enter a value" );
define("_MSA_QUERYID","Search Query Id" );
define("_MSA_VISITOROVERVIEW","Visitor Stats" );

define("_MSA_DELETERROR","Entry could not be deleted from the database");
define("_MSA_VIEWERROR","Please, fill out all fields" );
define("_MSA_UPATEERROR","Update Error !" );

/* Block Data */
define("_MSA_BLOCKCOUNTRY","Top-Ten Countries visiting");
define("_MSA_BLOCKONLINE","Last 10 page visits");
define("_MSA_BLOCKVIEW","View MS-Analysis");

?>
