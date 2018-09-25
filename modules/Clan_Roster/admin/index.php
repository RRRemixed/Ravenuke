<?php

if ( !defined( "ADMIN_FILE" ) )
{
    exit( "Access Denied" );
}
global $db, $prefix, $admin_file;
$module_name = "Clan_Roster";
include( "header.php" );
include( "modules/{$module_name}/admin/files/functions.php" );
include( "modules/{$module_name}/admin/files/includes.php" );
$copyright = "modules/{$module_name}/copyright.php";
$filesize = filesize( $copyright );
if ( file_exists( $copyright ) && 2815 <= $filesize )
{
    navigation( );
    switch ( $op )
    {
        case "CRMain" :
            include( "modules/{$module_name}/admin/files/crmain.php" );
            break;
        case "CRConfig" :
            configmenu( );
            break;
        case "CRCGeneral" :
            include( "modules/{$module_name}/admin/files/crcgeneral.php" );
            break;
        case "CRCColors" :
            include( "modules/{$module_name}/admin/files/crccolors.php" );
            break;
        case "CRCUsers" :
            include( "modules/{$module_name}/admin/files/crcusers.php" );
            break;
        case "CRCHardware" :
            include( "modules/{$module_name}/admin/files/crchardware.php" );
            break;
        case "CRCGames" :
            include( "modules/{$module_name}/admin/files/crcgames.php" );
            break;
        case "CRCRanks" :
            include( "modules/{$module_name}/admin/files/crcranks.php" );
            break;
        case "CRCRibbons" :
            include( "modules/{$module_name}/admin/files/crcribbons.php" );
            break;
        case "CRRanks" :
            include( "modules/{$module_name}/admin/files/crranks.php" );
            break;
        case "CRRanksdb" :
            include( "modules/{$module_name}/admin/files/crranksdb.php" );
            break;
        case "CRRanksdbdel" :
            include( "modules/{$module_name}/admin/files/crranksdbdel.php" );
            break;
        case "CRRanksdbedit" :
            include( "modules/{$module_name}/admin/files/crranksdbedit.php" );
            break;
        case "CRRibbons" :
            include( "modules/{$module_name}/admin/files/crribbons.php" );
            break;
        case "CRRibbonsdb" :
            include( "modules/{$module_name}/admin/files/crribbonsdb.php" );
            break;
        case "CRRibbonsdbedit" :
            include( "modules/{$module_name}/admin/files/crribbonsdbedit.php" );
            break;
        case "CRRibbonsdbdel" :
            include( "modules/{$module_name}/admin/files/crribbonsdbdel.php" );
            break;
        case "CRGametypes" :
            include( "modules/{$module_name}/admin/files/crgametypes.php" );
            break;
        case "CRGametypesdb" :
            include( "modules/{$module_name}/admin/files/crgametypesdb.php" );
            break;
        case "CRGametypesdbdel" :
            include( "modules/{$module_name}/admin/files/crgametypesdbdel.php" );
            break;
        case "CRGametypesdbedit" :
            include( "modules/{$module_name}/admin/files/crgametypesdbedit.php" );
            break;
        case "CRAddmember" :
            include( "modules/{$module_name}/admin/files/craddmember.php" );
            break;
        case "CRAddmemberp2" :
            include( "modules/{$module_name}/admin/files/craddmemberp2.php" );
            break;
        case "CRUserribbons" :
            include( "modules/{$module_name}/admin/files/cruserribbons.php" );
            break;
        case "CREditusers" :
            include( "modules/{$module_name}/admin/files/editusers.php" );
            break;
        case "CRDeleteuser" :
            include( "modules/{$module_name}/admin/files/deleteuser.php" );
            break;
        case "CREdithardware" :
            include( "modules/{$module_name}/admin/files/edithardware.php" );
            break;
        case "CRHexcolors" :
            opentable( );
            colors( );
            closetable( );
    }
    crcopy( );
}
else
{
    opentable( );
    echo "<center><font color='red'>ERROR!</font><br />The copyright.php file is missing from the Clan Roster module folder or the filesize has been altered.  You will have to restore it to use this module.</center>";
    closetable( );
}
include( "footer.php" );
?>
