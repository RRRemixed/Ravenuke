<?php
/*=======================================================================
 Nuke-Evolution Basic: Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

if (!defined('ADMIN_FILE')) {
    die ('Illegal File Access');
}

$module_name = basename(dirname(dirname(__FILE__)));

switch($op) {

    case "RottNAudio":
    case "RottNAudio-Configuration":
    case "RottNAudio-Configuration-submit":
    case "RottNAudio-Add_Track":
    case "RottNAudio-Add_Track-submit":
    case "RottNAudio-Edit_Tracks":
    case "RottNAudio-Edit_Tracks-submit":
    case "RottNAudio-Delete_Tracks":
    case "RottNAudio-Track_Order":
    case "RottNAudio-Flashvars":
    case "RottNAudio-Color_Palette";
        include(NUKE_MODULES_DIR.$module_name.'/admin/index.php');
    break;

}

?>