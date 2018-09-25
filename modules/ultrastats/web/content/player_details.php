<?php

    require_once "../include/prepend.php";


    if ($HTTP_GET_VARS["ID"])
	{
		// GET in var
		$ID = DB_RemoveBadChars($HTTP_GET_VARS["ID"]);

		// Init Weapon Name Array
		CreateWeaponNameArray();

		// Fill general values
		$playerquery = "select *, sum($SKILL_STRING) as Skill, sum(Kills + Deaths + Suicides) as Total, sum(100 * Kills / (Kills + Deaths + Suicides)) as Effency  from ".$CFG['TBPref']."players where ID = '".$ID."' group by ID";
	    $tmparray					= READ_ALL( $playerquery ); 
		$content['MY_KILLS']			= $tmparray[0]['Kills'];
		$content['MY_DEATHS']			= $tmparray[0]['Deaths'];
		$content['MY_SUICIDES']		= $tmparray[0]['Suicides'];
		$content['MY_TEAMKILLS']		= $tmparray[0]['team_kills'];
		$content['MY_PLAYEDTIME']		= GetTimeString($tmparray[0][Time]);
		$content['MY_FLAGS_CAPT']		= $tmparray[0]['Flags_capt'];
		$content['MY_FLAGS_DEF']		= $tmparray[0]['Flags_killed'];
		$content['MY_BRIEF_CAPT']		= $tmparray[0]['Briefcases'];
		$content['MY_BRIEF_DEF']		= $tmparray[0]['Briefcases_killed'];
		$content['MY_SKILL']			= $tmparray[0]['Skill'];
		$content['MY_EFFICIENCY']		= $tmparray[0]['Efficiency'];
		$content['MY_RATIO']			= GetEfficiencyRatio($tmparray[0]['Total'], $tmparray[0]['Kills']);
		$content['MY_IMG_WIDTH']		= GetEfficiencyImageWidth($tmparray[0]['Total'], $tmparray[0]['Kills']);
		$content['MY_ID']				= $tmparray[0]['ID'];

		// SHOW ALIASES
		$query   = "select alias, alias_html, count from ".$CFG['TBPref']."aliases where player_id = '$ID' order by count desc" ;
		$content['DATA'] = READ_ALL( $query );
    
		$content['NAME']			= preg_replace("/\^\S/", "", $content['DATA'][0]['alias']);	// Remove ^x
		$content['NAME_HTML']		= $content['DATA'][0]['alias_html'];
		
		
		$content['ALIAS_COUNT']	= count($content['DATA']);
	

		$anz     = count($content['DATA']);
		for ($i=0 ; $i < 10 && $i < $anz; $i++)
		{
			$content['OTHERNAMES'] .= "<li>".$content['DATA'][$i]['alias_html']." (".$content['DATA'][$i][count]." times) </li>";
		}
   		// END SHOW ALIASES
   	 

		// SUM WEAPON KILLS 
		$sumquery   = "select sum(Kills) as TOTAL from ".$CFG['TBPref']."player_weapons where PLAYER_ID = '$ID' ";
		$result     = READ_ALL( $sumquery );
		$TOTAL 		= $result[0]['TOTAL'];
		// END SUM WEAPON KILLS

		// SHOW FAV WEAPONS
		$favquery				= "select * from ".$CFG['TBPref']."player_weapons where PLAYER_ID  = '$ID' group by WEAPON order by Kills desc" ; 
		$content['DATA_FAVWP']	= READ_ALL( $favquery );
		$needle					= array ("MOD", "_");
		$pin					= array ("", " ");
		$anz					= count($content['DATA_FAVWP']);

		for ($i=0 ; $i<$anz ; $i++)
		{
			$content['DATA_FAVWP'][$i]['WEAP_MOD'] = $content['DATA_FAVWP'][$i]['Weapon'];
			if (isset( $allweapons[ $content['DATA_FAVWP'][$i]['Weapon'] ]) )
				$content['DATA_FAVWP'][$i]['WEAP'] = $allweapons[ $content['DATA_FAVWP'][$i]['Weapon'] ];
			else
				$content['DATA_FAVWP'][$i]['WEAP'] = trim(ucwords(str_replace($needle, $pin , $content['DATA_FAVWP'][$i]['Weapon'])));

			// Efficiency Ratio
			$KILLS = $content['DATA_FAVWP'][$i]['Kills'];

			if ($KILLS > 0 )
				$IMG_WIDTH_TMP = ($KILLS * 100) / $TOTAL ;
			else 
				$IMG_WIDTH_TMP = 0;

			$content['DATA_FAVWP'][$i]['RATIO'] = sprintf("%2.2f",$IMG_WIDTH_TMP);
			$content['DATA_FAVWP'][$i]['IMG_WIDTH'] = intval ($IMG_WIDTH_TMP * 2 ); 
			// END Efficiency Ratio  
		}
		// SHOW FAV WEAPONS

/* NOT POSSIBLE AT THE MOMENT
		// SHOW WEAPONS Kills of player
		// SHOW WEAPONS Kills of player
*/

         
         // SHOW FAVORITE TARGETS
         $query3     = " SELECT distinct *, sum(Kills) as AllKills FROM ".$CFG['TBPref']."player_kills
                     WHERE ID_PLAYER = '$ID' GROUP by ID_ENEMY ORDER BY AllKills DESC limit 0, ". $CFG['LIMIT2'];
         
         $content['DATA_FAVTAR'] = READ_ALL( $query3 );
         $anz     = count($content['DATA_FAVTAR']);
         for ($i=0 ; $i<$anz ; $i++){
         
         	// Subselect 2
			$ID2 = $content['DATA_FAVTAR'][$i]['ID_ENEMY'];
			$query3a  = "select alias, alias_html from ".$CFG['TBPref']."aliases where player_id = '$ID2' order by count desc limit 0,1";
			$result3a = READ_ALL( $query3a );
			$content['DATA_FAVTAR'][$i]['ENEMY']  = preg_replace("/\^\S/", "", $result3a[0]['alias']);	// Remove ^x
			$content['DATA_FAVTAR'][$i]['ENEMY_HTML']  = $result3a[0]['alias_html'];
         	// Subselect 2
                
                // Efficiency Ratio
                $KILLS = $content['DATA_FAVTAR'][$i]['AllKills'];
                
                if ($KILLS > 0 )
                $IMG_WIDTH_TMP = ($KILLS * 100) / $TOTAL ;
                else 
                 $IMG_WIDTH_TMP = 0;
                
                $content['DATA_FAVTAR'][$i]['RATIO'] = sprintf("%2.2f",$IMG_WIDTH_TMP);
                $content['DATA_FAVTAR'][$i]['IMG_WIDTH'] = intval ($IMG_WIDTH_TMP * 2 ); 
                // END Efficiency Ratio  
         }
		// CHANGE BETWEEN MODELS 
		$content['HEADER'] = "Player Details - <b>$content[NAME_HTML]</b> <I>(Total kills: $TOTAL)</I>";
         // SHOW FAVORITE TARGETS
    }
    // Parsen und Ausgeben
    $page -> parser($content, "player_details.html");
    $page -> output(); 
?> 