<?php

    require_once "../include/prepend.php";

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
		// CHANGE BETWEEN MODELS 
		$content['HEADER'] = "Hit Location Details - <b>$content[NAME_HTML]</b> <I>(Total kills: $TOTAL)</I>";

	// Hit location list from bg_public.h
	// HL_NONE			0x00000000	// 0
	// HL_FOOT_RT		0x00000001
	// HL_FOOT_LT		0x00000002
	// HL_LEG_UPPER_RT	0x00000004
	// HL_LEG_UPPER_LT	0x00000008
	// HL_LEG_LOWER_RT	0x00000010	// 5

	// HL_LEG_LOWER_LT	0x00000020
	// HL_HAND_RT		0x00000040
	// HL_HAND_LT		0x00000080
	// HL_ARM_RT		0x00000100
	// HL_ARM_LT		0x00000200	// 10

	// HL_HEAD			0x00000400
	// HL_WAIST			0x00000800
	// HL_BACK_RT		0x00001000
	// HL_BACK_LT		0x00002000
	// HL_BACK			0x00004000	// 15

	// HL_CHEST_RT		0x00008000
	// HL_CHEST_LT		0x00010000
	// HL_CHEST			0x00020000
	// HL_NECK			0x00040000
	// HL_DEBUG			0x00080000	// 20
	
    function moveitup ($var)
    {
       if ($var < 100 && $var >= 90)
          		$nvar = 90;
       else if ($var < 90 && $var >= 80)
           		$nvar = 80;    
       else if ($var < 80 && $var >= 70)
           		$nvar = 70; 
       else if ($var < 70 && $var >= 60)
       			$nvar = 60; 
       else if ($var < 60 && $var >= 50)
       			$nvar = 50; 
       else if ($var < 50 && $var >= 40)
       			$nvar = 40; 
       else if ($var < 40 && $var >= 30)
       			$nvar = 30; 
       else if ($var < 30 && $var >= 20)
       			$nvar = 20;            	
       else if ($var < 20 && $var >= 10)
       			$nvar = 10;            	       		
       else if ($var < 10 && $var >= 0)
       			$nvar = 10;      
       return $nvar;  			
       			
    }
    
    function filltherest ()
    {
    	global $content , $CFG ;
    	
    	$fill_query = "SELECT ID FROM ".$CFG['TBPref']."hitlocations";
    	$tmp_result = READ_ALL( $fill_query );
    	$anz		= count($tmp_result);

    	for ($i=0 ; $i < $anz; $i++)
		{
    	    $tmpname = "NAME_". $tmp_result[$i]['ID'];
    	    if (!$content[$tmpname])
    	      $content[$tmpname] = 0;
    	}
    }
         // SHOW HITLOCATIONS

/*		$query4 = "SELECT HIT_LOCATION, sum(KILLS) as TREFFER, BODYPART
				FROM ".$CFG['TBPref']."player_kills a , ".$CFG['TBPref']."hitlocations b
				WHERE ID_PLAYER = '$ID' 
				AND b.ID = a.HIT_LOCATION 
				GROUP BY HIT_LOCATION
				ORDER BY TREFFER DESC";
*/		 
		$query4 = "SELECT HIT_LOCATION, sum(KILLS) as TREFFER, BODYPART
				FROM ".$CFG['TBPref']."player_kills a , ".$CFG['TBPref']."hitlocations b
				WHERE ID_PLAYER = '$ID' 
				AND b.ID = a.HIT_LOCATION 
				GROUP BY HIT_LOCATION
				ORDER BY TREFFER DESC";

		$content['DATA_HITL'] = READ_ALL( $query4 );
		$anz     = count($content['DATA_HITL']);
                
		$NEW_TOTAL = $TOTAL - $content['DATA_HITL'][0]['TREFFER'];
                
        for ($i=0 ; $i<$anz ; $i++)
		{
			// ARRANGE HITLOCATION RATIO
			$KILLS = $content['DATA_HITL'][$i]['TREFFER'];

			//echo $content['DATA_HITL'][$i]['HIT_LOCATION'];

			if ($NEW_TOTAL > 0 )
			{
				$NEW_RATIO = (($KILLS * 3) * 100) / $NEW_TOTAL ;
				$tmp_name  = "NAME_".$content['DATA_HITL'][$i]['HIT_LOCATION'];
				$tmp_ratio = intval($NEW_RATIO);
				
				$content[$tmp_name] = moveitup ($tmp_ratio);
			}
		}
		filltherest ();
		// SHOW HITLOCATIONS
         
		// CHANGE BETWEEN MODELS   
    	if ($HTTP_GET_VARS['MODEL']){
       		$content['MODELNUMBER'] = DB_RemoveBadChars($HTTP_GET_VARS['MODEL']);
 }   	else {
          	$content['MODELNUMBER'] = 1;  
        
  	

    }
    // Parsen und Ausgeben
    $page -> parser($content, "hitlocations.html");
    $page -> output(); 
?> 