<?php

    require_once "../include/prepend.php";

	// Get GET vars
	if ( isset($_GET['beginkills']) )
		$content['PAGEBEGIN_KILLS'] = DB_RemoveBadChars($_GET['beginkills']);
	else
		$content['PAGEBEGIN_KILLS'] = 0;

	if ( isset($_GET["mod"]) )
		$content['ORDER'] = DB_RemoveBadChars($_GET['mod']);
	else
		$content['ORDER'] = "MOD_AK74_ASSAULT_RIFLE";		// SHOW WEAPON DETAILS  - DEFAULT AK47

	$ORDER = $content['ORDER'];
    $content['WEAPON_IMG'] = $ORDER; 
	// --- End General Informations
	
	// Get Weapon infos
    $query						= "select * from ".$CFG['TBPref']."weapons_info where ID = '".$content['ORDER']."' LIMIT 0 , 1";
	$wpresult					= READ_ALL( $query );
	$content['DISPNAME']		= $wpresult[0]['name'];
	if ($content['DISPNAME'] == "")
	{
		$P_ORDER = ucwords (ereg_replace("_", " " , $ORDER));
		$P_ORDER = ucwords (ereg_replace("MOD", " " , $P_ORDER));
		$content['DISPNAME'] = $P_ORDER;
	}
	$content['WP_DESCRIPTION'] = $wpresult[0]['description'];
	
	if ($wpresult[0]['damage'] != 0)
	{
		$content['WEAP_HAS_DETAIL'] = "true";

		$content['DATA_WPDET'][0]['DETAILNAME'] = "Ammotype";
		$content['DATA_WPDET'][0]['DETAILVALUE'] = $wpresult[0]['ammotype'];
		$content['DATA_WPDET'][1]['DETAILNAME'] = "Clipsize";
		$content['DATA_WPDET'][1]['DETAILVALUE'] = $wpresult[0]['clipsize'];
		$content['DATA_WPDET'][2]['DETAILNAME'] = "Damage";
		$content['DATA_WPDET'][2]['DETAILVALUE'] = $wpresult[0]['damage'];
		$content['DATA_WPDET'][3]['DETAILNAME'] = "Inaccuracy";
		$content['DATA_WPDET'][3]['DETAILVALUE'] = $wpresult[0]['inaccuracy'];
		$content['DATA_WPDET'][4]['DETAILNAME'] = "FireModes";
		$content['DATA_WPDET'][4]['DETAILVALUE'] = $wpresult[0]['fireModes'];
	}
	else
	{
		$content['WEAP_HAS_DETAIL'] = "false";
	}

	// --- End 


	// --- First of all count how many maps were played to generate the PAGES Links
    $query = "select PLAYER_ID, sum(Kills) as ANZAHL from ".$CFG['TBPref']."player_weapons where WEAPON = '$ORDER' group by PLAYER_ID";
	$content['PLAYERCOUNT_KILLS']	= GET_ROWCOUNT( $query );
	$pagenumbers = $content['PLAYERCOUNT_KILLS'] / $CFG['LIMIT2'];



	// Fix for now of the list exceeds $CFG['MAX_PAGES_COUNT'] pages
	if ($pagenumbers > $CFG['MAX_PAGES_COUNT'])
	{
		$pagenumbers = $CFG['MAX_PAGES_COUNT'];
		$content['MORESTRING'] = "*(More then ".$CFG['MAX_PAGES_COUNT']." pages found)";
	}
	else
		$content['MORESTRING'] = "";


    for ($i=0 ; $i < $pagenumbers ; $i++)
	{
		$content['PAGESKILLS'][$i]['BEGINPAGE'] = ($i * $CFG['LIMIT2']);

		if ($content['PAGEBEGIN_KILLS'] == $content['PAGESKILLS'][$i]['BEGINPAGE'])
			$content['PAGESKILLS'][$i]['PAGENUMBER'] = "<B>-".($i+1)."-</B>";
		else
			$content['PAGESKILLS'][$i]['PAGENUMBER'] = $i+1;
	}

	// ---


    // BEGIN SUM WEAPON KILLS 
	$sumquery				= "select *, sum(Kills) as ANZAHL 
							  from ".$CFG['TBPref']."player_weapons  
							  where WEAPON = '$ORDER' 
							  group by WEAPON order by ANZAHL desc limit 0, ". $CFG['LIMIT2'];  
    $result					= READ_ALL( $sumquery );
    $content['TOTALKILLS']	= $result[0]['ANZAHL'];
    // END SUM WEAPON KILLS
	
	// Make Headerline
    $content[HEADER] = "Weapon Details for - <b>". $content['DISPNAME'] . "</b>";

	// BEGIN WEAPON KILLS
	$query = "select *, sum(Kills) as ANZAHL from ".$CFG['TBPref']."player_weapons where WEAPON = '$ORDER' group by PLAYER_ID order by ANZAHL desc limit ".$content['PAGEBEGIN_KILLS'].", ". $CFG['LIMIT2'];

    $content['DATA']	= READ_ALL( $query );
    $anz				= count($content['DATA']);

	for ($i=0 ; $i<$anz ; $i++)
	{
         // BEGIN Efficiency Ratio
		$KILLS = $content['DATA'][$i]['Kills'];
           
		if ($KILLS > 0 )
			$IMG_WIDTH_TMP = ($KILLS * 100) / $content['TOTALKILLS'] ;
		else 
			$IMG_WIDTH_TMP = 0;
           
		$content['DATA'][$i]['RATIO'] = sprintf("%2.2f",$IMG_WIDTH_TMP);
		// * 10 more with here cazsecause tehr eis place enough
		$content['DATA'][$i]['IMG_WIDTH'] = intval ($IMG_WIDTH_TMP * 3);
		// END Efficiency Ratio  
         
		// Only for first page
		if ($content['PAGEBEGIN_KILLS'] == 0)
		{
			// GO FOR GOLD 
			if ($i == 0)
				$content['DATA'][$i]['MEDAL'] = "gold.gif";
			if ($i == 1)
				$content['DATA'][$i]['MEDAL'] = "silber.gif";
			if ($i == 2)
				$content['DATA'][$i]['MEDAL'] = "bronze.gif";
			// END GO FOR GOLD 
		}

		//
		$ID    = $content['DATA'][$i]['PLAYER_ID'];  

		// Set Positionnumber for display
		$content['DATA'][$i]['POSCOUNTER'] = ($content['PAGEBEGIN_KILLS']+$i+1);

		// Subselect 
		$query2   = "select alias, alias_html from ".$CFG['TBPref']."aliases where player_id = '$ID' order by count desc limit 0,1";
		$result2 = READ_ALL( $query2 );

		$content['DATA'][$i]['NAME']			= preg_replace("/\^\S/", "", $result2[0]['alias']);	// Remove ^x
		$content['DATA'][$i]['NAME_HTML']		= $result2[0]['alias_html'];
    }
    // END WEAPON KILLS

	
    // Parsen und Ausgeben
    $page -> parser($content, "weapon.html");
    $page -> output(); 
?> 