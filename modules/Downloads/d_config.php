<?php

//#####################################################################
// PHP-NUKE: Web Portal System
// ===========================
//
// Copyright (c) 2000 by Francisco Burzi (fbc@mandrakesoft.com)
// http://phpnuke.org
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//#####################################################################


//#####################################################################
// Downloads Preferences (Some variables are valid also for Downloads)
//
// $anonwaitdays:                    Number of days anonymous users need to wait to vote on a download
// $anonweight:                      How many Unregistered User vote per 1 Registered User Vote?
// $blockunregmodify:                Block unregistered users from suggesting downloads changes? (1=Yes 0=No)
// $detailvotedecimal:               Let Detailed Vote Summary Decimal out to N places. (no max)
// $downloads_anonadddownloadlock:   Lock Unregistered users from Suggesting New Downloads? (1=Yes 0=No)
// $downloadsresults:                How many downloads to display on each search result page?
// $downloadvotemin:                 Number votes needed to make the 'top 10' list
// $featurebox:                      1 to Show Feature Download Box on downloads Main Page? (1=Yes 0=No)
// $mainvotedecimal:                 Let Main Vote Summary Decimal show out to N places. (max 4)
// $mostpopdownloads:                Either # of downloads OR percentage to show (percentage as whole number. #/100)
// $mostpopdownloadspercentrigger:   1 to Show Most Popular Downloads as a Percentage (else # of downloads)
// $newdownloads:                    How many downloads to display in the New Downloads Page?
// $outsidewaitdays:                 Number of days outside users need to wait to vote on a download (checks IP)
// $outsideweight:                   How many Outside User vote per 1 Registered User Vote?
// $perpage:                         How many downloads to show on each page?
// $popular:                         How many hits need a download to be listed as popular?
// $show_links_num:                  Show the number of links for each category? (1=Yes 0=No)
// $topdownloads:                    Either # of downloads OR percentage to show (percentage as whole number. #/100)
// $topdownloads:                    How many downloads to display in The Best Downloads Page? (Most Popular)
// $topdownloadspercentrigger:       1 to Show Top Downloads as a Percentage (else # of downloads)
// $useoutsidevoting:                Allow Webmasters to put vote downloads on their site (1=Yes 0=No)
// $user_adddownload:                Used to show the "Add Download" link (1=Show 0=Do not show)
//#####################################################################

$anonwaitdays = 1;
$anonweight = 10;
$blockunregmodify = 1;
$detailvotedecimal = 2;
$downloads_anonadddownloadlock = 1;
$downloadsresults = 10;
$downloadvotemin = 5;
$featurebox = 1;
$mainvotedecimal = 1;
$mostpopdownloads = 25;
$mostpopdownloadspercentrigger = 0;
$newdownloads = 10;
$outsidewaitdays = 1;
$outsideweight = 20;
$perpage = 10;
$popular = 1000;
$show_links_num = 0;
$topdownloads = 25;
$topdownloadspercentrigger = 0;
$useoutsidevoting = 1;
$user_adddownload = 0;

?>