<?php

    require_once "../include/prepend.php";

	// Copy to template array	
	$content['MINIMUM_PLAYING_TIME']	= $CFG['MINIMUM_PLAYING_TIME'];
	$content['MINKILLS']				= $CFG['MINKILLS'];

	// Get GET vars
	if ( isset($_GET['begin']) )
		$content['PAGEBEGIN'] = DB_RemoveBadChars($_GET['begin']);
	else
		$content['PAGEBEGIN'] = 0;

	if ( isset($_GET["order"]) )
	{
		$content['ORDER'] = DB_RemoveBadChars($_GET['order']);
	}
	else
		$content['ORDER'] = "";
	// --- End General Informations

	
	// --- First of all count how many maps were played to generate the PAGES Links
    $query = "select Time, Kills from ".$CFG['TBPref']."players where Time > ". $CFG['MINIMUM_PLAYING_TIME'] ." and Kills > ". $CFG['MINKILLS'];
	$content['PLAYERCOUNT']	= GET_ROWCOUNT( $query );
	$pagenumbers = $content['PLAYERCOUNT'] / $CFG['LIMIT1'];
	
	// Fix for now of the list exceeds $CFG['MAX_PAGES_COUNT'] pages
	if ($pagenumbers > $CFG['MAX_PAGES_COUNT'])
	{
		$content['MORESTRING'] = "*(More then ".$CFG['MAX_PAGES_COUNT']." pages found)";
		$pagenumbers = $CFG['MAX_PAGES_COUNT'];
	}
	else
		$content['MORESTRING'] = "";

    for ($i=0 ; $i < $pagenumbers ; $i++)
	{
		$content['PAGES'][$i]['BEGINPAGE'] = ($i * $CFG['LIMIT1']);

		if ($content['PAGEBEGIN'] == $content['PAGES'][$i]['BEGINPAGE'])
			$content['PAGES'][$i]['PAGENUMBER'] = "<B>-".($i+1)."-</B>";
		else
			$content['PAGES'][$i]['PAGENUMBER'] = $i+1;
	}
	// ---


    // SHOW TOP 50 PLAYERS - DEFAULT VIEW
    if (strlen($content['ORDER']) == 0)
	{
		$query   = "select *, sum($SKILL_STRING) as Skill , sum(Kills + Deaths + Suicides) as Total
                  , sum(100 * Kills / (Kills + Deaths + Suicides))  as Effency 
                  from ".$CFG['TBPref']."players 
                  where Time > ". $CFG['MINIMUM_PLAYING_TIME'] ."
                  and Kills > ". $CFG['MINKILLS'] ."
                  group by ID order by KILLS desc limit ".$content['PAGEBEGIN'].", ". $CFG['LIMIT1'];  
      
		// Overwrite Header 
		$content[HEADER] = "Top <U>".($content['PAGEBEGIN']+1)."</U> to <U>".($content['PAGEBEGIN']+1+$CFG['LIMIT1'])."</U> - Order by <B>KILLS</b>";
    }
    else
	{
	    // ORDER BY SELECTED COLOUMN  
		$P_ORDER = ucwords (ereg_replace("_", " " , $content['ORDER']));
		$query   = "select *, sum($SKILL_STRING) as Skill , sum(Kills + Deaths + Suicides) as Total 
      	          , sum(100 * Kills / (Kills + Deaths + Suicides))  as Effency
                  from ".$CFG['TBPref']."players 
                  where Time > ". $CFG['MINIMUM_PLAYING_TIME'] ."
                  and Kills > ". $CFG['MINKILLS'] ."
                  group by ID order by ".$content['ORDER']." desc limit ".$content['PAGEBEGIN'].", ". $CFG['LIMIT1'];   
      
		// Overwrite Header 
		$content[HEADER] = "Top ".($content['PAGEBEGIN']+1)." to ".($content['PAGEBEGIN']+1+$CFG['LIMIT1'])." - Order by <b>". $P_ORDER . "</b>";
    }
     
    $content['DATA'] = READ_ALL( $query ); 
    $anz     = count($content['DATA']);
    for ($i=0 ; $i<$anz ; $i++)
	{
		// Only for first page
		if ($content['PAGEBEGIN'] == 0)
		{
			// GO FOR GOLD 
			if ($i == 0)
				$content['DATA'][$i][MEDAL] = "gold.gif";
			if ($i == 1) 
				$content['DATA'][$i][MEDAL] = "silber.gif";
			if ($i == 2)
				$content['DATA'][$i][MEDAL] = "bronze.gif";
			 // END GO FOR GOLD 
		}

		//Set Positionnumber for display
		$content['DATA'][$i][POSCOUNTER] = ($content['PAGEBEGIN']+$i+1);

         // Efficiency Ratio
		$content['DATA'][$i]['RATIO']			= GetEfficiencyRatio($content['DATA'][$i]['Total'], $content['DATA'][$i]['Kills']);
		$content['DATA'][$i]['IMG_WIDTH']		= GetEfficiencyImageWidth($content['DATA'][$i]['Total'], $content['DATA'][$i]['Kills']);
		// END Efficiency Ratio  
		
		// New - define which gametype items will be displayed 
		if ($CFG['ShowFlags'] == 1)
			$content['DATA'][$i]['GT_FLAGCAPT'] = true;
		if ($CFG['ShowFlagKill'] == 1)
			$content['DATA'][$i]['GT_FLAGKILL'] = true;
		if ($CFG['ShowBriefcases'] == 1)
			$content['DATA'][$i]['GT_BRIEFCAPT'] = true;
		if ($CFG['ShowBriefcaseKill'] == 1)
			$content['DATA'][$i]['GT_BRIEFKILL'] = true;
           
		// Get Time         
		$content['DATA'][$i][NEWTIME] = GetTimeString($content['DATA'][$i][Time]);
                     
		$ID    = $content['DATA'][$i][ID];  
		// Subselect 
		$query2   = "select alias, alias_html from ".$CFG['TBPref']."aliases where player_id = '$ID' order by count desc limit 0,1";
		$result2 = READ_ALL( $query2 );
		$content['DATA'][$i][NAME]  = preg_replace("/\^\S/", "", $result2[0][alias]);	// Remove ^x
		$content['DATA'][$i][NAME_HTML]  = $result2[0][alias_html];
		
    }
    // END SHOW TOP100 PLAYERS 
   
    // Parsen und Ausgeben
    $page -> parser($content, "players.html");
    $page -> output(); 
?> 