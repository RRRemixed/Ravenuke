<?php
if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}
$module_name = "Clan_Roster";
switch ($op) {
	case "CRMain" :
	case "CRConfig" :
	case "CRCGeneral" :
	case "CRCColors" :
	case "CRCUsers" :
	case "CRCHardware" :
	case "CRCGames" :
	case "CRCRanks" :
	case "CRCRibbons" :
	case "CRRanks" :
	case "CRRanksdb" :
	case "CRRanksdbdel" :
	case "CRRanksdbedit" :
	case "CRRibbons" :
	case "CRRibbonsdb" :
	case "CRRibbonsdbdel" :
	case "CRRibbonsdbedit" :
	case "CRGametypes" :
	case "CRGametypesdb" :
	case "CRGametypesdbdel" :
	case "CRGametypesdbedit" :
	case "CRAddmember" :
	case "CRAddmemberp2" :
	case "CRUserribbons" :
	case "CREditusers" :
	case "CRDeleteuser" :
	case "CREdithardware" :
	case "CRHexcolors" :
	include("modules/$module_name/admin/index.php");
  break;
}
?>
