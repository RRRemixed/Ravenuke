<?php

/*****************************************************************
**MP Tournament Module By: Major Playing (cablemp@insightbb.com)**
**http://mp.rocknrollranchhouse.com                             **
**Copyright © 2005 by Major Playing                             **
*****************************************************************/

if (!eregi("admin.php", $_SERVER['SCRIPT_NAME'])) { die ("Access Denied"); }



switch($op) {

    case "TournamentMain":
    include("modules/Tournament/admin/index.php");
    case "EditBracket":
    include("modules/Tournament/admin/editbracket.php");
    case "UpdateBracket":
    case "ClearBracket":
    include("modules/Tournament/admin/update-bracket.php");
    case "EditSettings":
    include("modules/Tournament/admin/editsettings.php");
    case "UpdateMPTNews":
    include("modules/Tournament/admin/update-settings.php");
    case "UpdateMPTRules":
    include("modules/Tournament/admin/update-settings.php");
    case "UpdatePrevwin":
    include("modules/Tournament/admin/update-settings.php");
    case "UpdateCurrwin":
    include("modules/Tournament/admin/update-settings.php");
    case "UpdateTourneys":
    include("modules/Tournament/admin/update-settings.php");
    case "EditTeams":
    include("modules/Tournament/admin/editteams.php");
    case "UpdateTeam":
    include("modules/Tournament/admin/update-teams.php");
    case "DeleteTeam":
    include("modules/Tournament/admin/update-teams.php");
    case "DeleteTeams":
    include("modules/Tournament/admin/update-teams.php");
    case "EditMatches":
    include("modules/Tournament/admin/editmatches.php");
    case "UpdateMatch":
    case "DeleteMatch":
    case "DeleteMatches":
    include("modules/Tournament/admin/update-matches.php");
    break;

}

?>
