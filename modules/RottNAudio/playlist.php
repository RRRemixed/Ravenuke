<?php

/************************************************************************
               RottNAudio
   ============================================
   Copyright (c) 2008 RottNResources.com & JeroenWijering.com

   Module Author : RottNKorpse (www.RottNResources.com)
   Flash Author  : Jeroen Wijering (www.JeroenWijering.com)
   Edited for Standard/Ravens Nuke : Ped (ped@clanthemes.com)
************************************************************************/

include_once('database.php');

$sql             = "SELECT * FROM ".$prefix."_rottnaudio_config";
$result          = mysql_query($sql) or die('Query failed: ' . mysql_error());
$song_order_sql  = mysql_fetch_assoc($result);
$song_order      = $song_order_sql['song_order'];

$playlist_sql = mysql_query("SELECT * FROM ".$prefix."_rottnaudio_songs ORDER BY ".$song_order." ASC") or die('Query failed: ' . mysql_error());

// the playlist is built in an xspf format
header("content-type:text/xml;charset=utf-8");

echo "<playlist version='1' xmlns='http://xspf.org/ns/0/'>\n";
echo "	<title>RottNAudio Playlist</title>\n";
echo "	<info>provided by www.RottNResources.com</info>\n";
echo "	<trackList>\n";

while($row = mysql_fetch_array($playlist_sql)) {
	echo "		<track>\n";
	echo "			<title>".$row['song_name']."</title>\n";
	echo "			<creator>".$row['artist_name']."</creator>\n";
	echo "			<location>".$row['song_url']."</location>\n";
	echo "			<info>".$row['download_url']."</info>\n";
	echo "			<image>".$row['album_cover']."</image>\n";
	echo "			<identifier>".$row['song_id']."</identifier>\n";
	echo "		</track>\n";
}
 
echo "	</trackList>\n";
echo "</playlist>\n";

?>