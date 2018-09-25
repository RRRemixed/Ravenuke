<?php
// *************************************************
// This file is Part of Nuke_Reflections V1 Module by
// White_Devil of http://devil-modz.us
// E-Mail arleighesq@gmail.com

// Please do not remove any copyright notices
// Or modify beyond the main parts of this script

// Everything is pretty much Explained.
// *************************************************
if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
    die ("You can't access this file directly...");
}





$module_name = basename(dirname(__FILE__));

require_once("mainfile.php");






if ($adminarea == "" && $op == "") {
    $op = "index";
}

include_once("modules/$module_name/reflectionconfig.php");

if ($NRVersion == "") {
	title("Nuke Reflections Error! Database was not imported correctly since I cannot find the correct information!!!!");
die;
}



include_once("modules/$module_name/reflectionheader.php");
include_once("modules/$module_name/includes/devil_inc_gall.php");
include_once("modules/$module_name/includes/deviltooltipsys.php");
include_once("modules/$module_name/includes/devil_includes.php");
include_once("modules/$module_name/includes/deviljava.php");

$checkremovallogins = checkremovallogins1();



if ($adminarea != "") {
    if (is_admin($admin)) {
    } else {
        echo "<b><center>You are not and admin. Please leave now!</b></center>";
        closetable();
        include_once("footer.php");
        die;
    }
    include_once("modules/$module_name/adminfiles/reflecadminhead.php");
}
// User Area
switch ($op) {
    case "index":
        include("modules/$module_name/public/index.php");
        break;

    case "creategal":
        include("modules/$module_name/public/creategal.php");
        break;

    case "creategal2":
        include("modules/$module_name/public/creategal2.php");
        break;

    case "upload":
        include("modules/$module_name/public/upload.php");
        break;

    case "upload2":
        include("modules/$module_name/public/upload2.php");
        break;

    case "uploadprocess":
        include("modules/$module_name/public/uploadprocess.php");
        break;

    case "userhome":
        include("modules/$module_name/public/userhome.php");
        break;

    case "fileedit":
        include("modules/$module_name/public/fileedit.php");
        break;

    case "changedefault":
        include("modules/$module_name/public/changedefault.php");
        break;

            case "deletefile":
        include("modules/$module_name/public/deletefile.php");
        break;

                    case "galedit":
        include("modules/$module_name/public/galedit.php");
        break;

                    case "deletegallery":
        include("modules/$module_name/public/deletegallery.php");
        break;
                    case "viewbig":
        include("modules/$module_name/public/viewbig.php");
        break;
                    case "voteit":
        include("modules/$module_name/public/voteit.php");
        break;
                            case "gallistpub":
        include("modules/$module_name/public/gallistpub.php");
        break;

                            case "login":
        include("modules/$module_name/public/login.php");
        break;
                                    case "viewall":
        include("modules/$module_name/public/viewall.php");
        break;

                                            case "showgal":
        include("modules/$module_name/public/showgal.php");
        break;
                                            case "reportfile":
        include("modules/$module_name/public/reportfile.php");
        break;
                                                    case "reportfileprocess":
        include("modules/$module_name/public/reportfileprocess.php");
        break;

                                                            case "sonsystem":
        include("modules/$module_name/public/sonsystem.php");
        break;


}
// End User Area
// Admin Area
switch ($adminarea) {
    case "adminmain":
        include("modules/$module_name/adminfiles/adminmain.php");
        break;

            case "adminbulkadd1":
        include("modules/$module_name/adminfiles/adminbulkadd1.php");
        break;

            case "adminbulkadd2":
        include("modules/$module_name/adminfiles/adminbulkadd2.php");
        break;


    case "adminup":
        include("modules/$module_name/adminfiles/adminup.php");
        break;

    case "adminup2":
        include("modules/$module_name/adminfiles/adminup2.php");
        break;

    case "adminupprocess":
        include("modules/$module_name/adminfiles/adminupprocess.php");
        break;

    case "admincreategal":
        include("modules/$module_name/adminfiles/admincreategal.php");
        break;

    case "admincreategal2":
        include("modules/$module_name/adminfiles/admincreategal2.php");
        break;

        case "adminfileedit":
        include("modules/$module_name/adminfiles/adminfileedit.php");
        break;

                case "adminuserhome":
        include("modules/$module_name/adminfiles/adminuserhome.php");
        break;


                case "gallist":
        include("modules/$module_name/adminfiles/gallist.php");
        break;


                case "adminchangedefault":
        include("modules/$module_name/adminfiles/adminchangedefault.php");
        break;

                case "admindeletegallery":
        include("modules/$module_name/adminfiles/admindeletegallery.php");
        break;

                case "admindeletefile":
        include("modules/$module_name/adminfiles/admindeletefile.php");
        break;

                        case "admingaledit":
        include("modules/$module_name/adminfiles/admingaledit.php");
        break;

                        case "adminapproveprocess":
        include("modules/$module_name/adminfiles/adminapproveprocess.php");
        break;
                        case "approvalpage":
        include("modules/$module_name/adminfiles/approvalpage.php");
        break;
                                case "reportpage":
        include("modules/$module_name/adminfiles/reportpage.php");
        break;
                                case "settingsmain":
        include("modules/$module_name/adminfiles/settingsmain.php");
        break;
                                        case "settingsmainsave":
        include("modules/$module_name/adminfiles/settingsmainsave.php");
        break;



                                                case "settingsmembers":
        include("modules/$module_name/adminfiles/settingsmembers.php");
        break;
                                                case "settingsmemberssave":
        include("modules/$module_name/adminfiles/settingsmemberssave.php");
        break;

                                                case "settingssecurity":
        include("modules/$module_name/adminfiles/settingssecurity.php");
        break;
                                                case "settingssecuritysave":
        include("modules/$module_name/adminfiles/settingssecuritysave.php");
        break;

                                                case "settingsemail":
        include("modules/$module_name/adminfiles/settingsemail.php");
        break;
                                                case "settingsemailsave":
        include("modules/$module_name/adminfiles/settingsemailsave.php");
        break;
                                                        case "commentslist":
        include("modules/$module_name/adminfiles/commentslist.php");
        break;

}
// End Admin Area
echo "<center><strong><br>That is not a valid command please try again with the right one!!<br></center></strong>";
closetable();
include("footer.php");

?>