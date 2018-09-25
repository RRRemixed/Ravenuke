<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

define('INCLUDE_PATH', '../../');
include('../../config.php');
$dbcnx = mysql_connect("$dbhost","$dbuname","$dbpass");
$dbselect = mysql_select_db("$dbname");
if ((!$dbcnx) || (!$dbselect)) { echo "Can't connect to database"; }

?>