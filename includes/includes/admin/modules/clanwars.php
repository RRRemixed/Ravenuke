<?php

/************************************************************************/
/* PHP-NUKE: Clanwars Package                                           */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2003 by Dick Snel                                      */
/* http://www.fvgaming.com	     	                                    */
/* webmaster@fvgaming.com												*/
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/* 																		*/
/* Enjoy!																*/
/************************************************************************/

if (!eregi("admin.php", $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
$result = sql_query("select radminsuper from ".$prefix."_authors where aid='$aid'", $dbi);
list($radminsuper) = sql_fetch_row($result, $dbi);
if ($radminsuper==1) {

global $module_name, $dbi, $prefix;
include("header.php");
GraphicAdmin();

OpenTable();
    echo "<center><font class=\"title\"><b>Clanwars Module</b></center>";
CloseTable();


/******************************************************\
				ADD CLAN
\******************************************************/

OpenTable();
echo "<table>
	  <tr>
	  <td><form name =\"form\" method=\"POST\" action=\"\">
	  <input type=\"submit\" name=\"submit\" value=\"Add Clan\">
	  </form>
	  </td>
	  <td>
	  <form name =\"form\" method=\"POST\" action=\"\">
	  <input type=\"submit\" name=\"submit2\" value=\"Edit Clan\">
	  </form>
	  </td>
	  </tr>
	  </table>";
CloseTable();

if($_POST["submit"]) {
		OpenTable();

		echo "<form name =\"form1\" method=\"POST\" action=\"\"><body bgcolor=\"FFFFFF\" text=\"000000\">
		      <table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" >
		      <tr>
			  		<td width=\"140\"><b>Game:</b></td>
			  		<td width=\"144\"><input type=\"text\" name=\"game\" value=\"\"><br></td>
			  </tr>
		      <tr>
		      		<td width=\"140\"><b>Clan Id (cid):</b></td>
			  		<td width=\"144\"><input type=\"text\" name=\"cid\" value=\"\"><br></td>
			  </tr>
			  <tr>
			  		<td width=\"140\"><b>Ladder 1 Id (lid):</b></td>
			  		<td width=\"144\"><input type=\"text\" name=\"lid\" value=\"\"><br></td>
			  		<td width=\"140\"><b>Ladder 1 Name:</b></td>
			  		<td width=\"144\"><input type=\"text\" name=\"ladder\" value=\"\"><br></td>
			  		<td width=\"140\"><b>Ladder 1 Image Link:</b></td>
			  		<td width=\"144\"><input type=\"text\" name=\"image\" value=\"\"><br></td>
			  </tr>
		  	  <tr>
			  			  		<td width=\"140\"><b>Ladder 2 Id (lid):</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"lid1\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 2 Name:</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"ladder1\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 2 Image Link:</b></td>
			  					<td width=\"144\"><input type=\"text\" name=\"image1\" value=\"\"><br></td>
			  </tr>
			  <tr>
			  			  		<td width=\"140\"><b>Ladder 3 Id (lid):</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"lid2\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 3 Name:</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"ladder2\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 3 Image Link:</b></td>
			  					<td width=\"144\"><input type=\"text\" name=\"image2\" value=\"\"><br></td>
			  </tr>
			  <tr>
			  			  		<td width=\"140\"><b>Ladder 4 Id (lid):</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"lid3\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 4 Name:</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"ladder3\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 4 Image Link:</b></td>
			  					<td width=\"144\"><input type=\"text\" name=\"image3\" value=\"\"><br></td>
			  </tr>
			  <tr>
			  			  		<td width=\"140\"><b>Ladder 5 Id (lid):</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"lid4\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 5 Name:</b></td>
			  			  		<td width=\"144\"><input type=\"text\" name=\"ladder4\" value=\"\"><br></td>
			  			  		<td width=\"140\"><b>Ladder 5 Image Link:</b></td>
			  					<td width=\"144\"><input type=\"text\" name=\"image4\" value=\"\"><br></td>
			  </tr>
			  </table>
		  <br>
		  <input type=\"submit\" name=\"submit1\" value=\"Save\"> </form>";

		  CloseTable();
		  include("footer.php");
}

	if ($_POST["submit1"]) {

		$sql = "TRUNCATE TABLE ".$prefix."_clanwars";
		mysql_query($sql, $dbi) or die("There is an error");
		$sql1 = "INSERT INTO ".$prefix."_clanwars  (game, cid, lid, lid1, lid2, lid3, lid4, ladder, ladder1, ladder2, ladder3, ladder4, image, image1, image2, image3, image4)
		VALUES ('$game', '$cid', '$lid', '$lid1', '$lid2', '$lid3', '$lid4', '$ladder', '$ladder1', '$ladder2', '$ladder3', '$ladder4', '$image', '$image1', '$image2', '$image3', '$image4')";
		mysql_query($sql1, $dbi) or die("There is an error");

		echo "Clan Added";
	}

/******************************************************\
				EDIT CLAN
\******************************************************/

if($_POST["submit2"]) {

		$sql = "SELECT * FROM ".$prefix."_clanwars";
		$resultaat = mysql_query($sql, $dbi);
		while ($record = mysql_fetch_object($resultaat))
		{

		OpenTable();

		echo "<form name =\"form1\" method=\"POST\" action=\"\"><body bgcolor=\"FFFFFF\" text=\"000000\">
				      <table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" >
				      <tr>
					  		<td width=\"140\"><b>Game:</b></td>
					  		<td width=\"144\"><input type=\"text\" name=\"game\" value=\"$record->game\"><br></td>
			  		  </tr>
				      <tr>
				      		<td width=\"140\"><b>Clan Id (cid):</b></td>
					  		<td width=\"144\"><input type=\"text\" name=\"cid\" value=\"$record->cid\"><br></td>
					  </tr>
					  <tr>
					  		<td width=\"140\"><b>Ladder 1 Id (lid):</b></td>
					  		<td width=\"144\"><input type=\"text\" name=\"lid\" value=\"$record->lid\"><br></td>
					  		<td width=\"140\"><b>Ladder 1 Name:</b></td>
					  		<td width=\"144\"><input type=\"text\" name=\"ladder\" value=\"$record->ladder\"><br></td>
					  		<td width=\"140\"><b>Ladder 1 Image Link:</b></td>
			  				<td width=\"144\"><input type=\"text\" name=\"image\" value=\"$record->image\"><br></td>
					  </tr>
				  	  <tr>
					  			  		<td width=\"140\"><b>Ladder 2 Id (lid):</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"lid1\" value=\"$record->lid1\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 2 Name:</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"ladder1\" value=\"$record->ladder1\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 2 Image Link:</b></td>
			  							<td width=\"144\"><input type=\"text\" name=\"image1\" value=\"$record->image1\"><br></td>
					  </tr>
					  <tr>
					  			  		<td width=\"140\"><b>Ladder 3 Id (lid):</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"lid2\" value=\"$record->lid2\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 3 Name:</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"ladder2\" value=\"$record->ladder2\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 3 Image Link:</b></td>
			  							<td width=\"144\"><input type=\"text\" name=\"image2\" value=\"$record->image2\"><br></td>
					  </tr>
					  <tr>
					  			  		<td width=\"140\"><b>Ladder 4 Id (lid):</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"lid3\" value=\"$record->lid3\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 4 Name:</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"ladder3\" value=\"$record->ladder3\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 4 Image Link:</b></td>
			  							<td width=\"144\"><input type=\"text\" name=\"image3\" value=\"$record->image3\"><br></td>
					  </tr>
					  <tr>
					  			  		<td width=\"140\"><b>Ladder 5 Id (lid):</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"cid\" value=\"$record->lid4\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 5 Name:</b></td>
					  			  		<td width=\"144\"><input type=\"text\" name=\"ladder4\" value=\"$record->ladder4\"><br></td>
					  			  		<td width=\"140\"><b>Ladder 5 Image Link:</b></td>
			  							<td width=\"144\"><input type=\"text\" name=\"image4\" value=\"$record->image4\"><br></td>
					  </tr>
					  </table>
				  <br>
		  <input type=\"submit\" name=\"submit3\" value=\"Save\"> </form>";
		  CloseTable();
		  }
		  include("footer.php");
		}

	if ($_POST["submit3"]) {

		  $record->game = $_POST["game"];
		  $record->cid = $_POST["cid"];
	 	  $record->lid = $_POST["lid"];
	 	  $record->lid1 = $_POST["lid1"];
	 	  $record->lid2 = $_POST["lid2"];
		  $record->lid3 = $_POST["lid3"];
		  $record->lid4 = $_POST["lid4"];
		  $record->ladder = $_POST["ladder"];
		  $record->ladder1 = $_POST["ladder1"];
		  $record->ladder2 = $_POST["ladder2"];
		  $record->ladder3 = $_POST["ladder3"];
		  $record->ladder4 =  $_POST["ladder4"];
		  $record->image = $_POST["image"];
		  $record->image1 = $_POST["image1"];
		  $record->image2 = $_POST["image2"];
		  $record->image3 = $_POST["image3"];
		  $record->image4 = $_POST["image4"];

		$sql = "UPDATE ".$prefix."_clanwars SET game = '$record->game', cid = '$record->cid', lid = '$record->lid', lid1 = '$record->lid1', lid2 = '$record->lid2', lid3 = '$record->lid3', lid4 = '$record->lid4', ladder = '$record->ladder', ladder1 = '$record->ladder1', ladder2 = '$record->ladder2', ladder3 = '$record->ladder3', ladder4 = '$record->ladder4', image = '$record->image', image1 = '$record->image1', image2 = '$record->image2', image3 = '$record->image3', image4 = '$record->image4'";

		mysql_query($sql, $dbi) or die("There is an error");

		echo "Data edited";
	}

/******************************************************\
				LIST DATA
\******************************************************/

OpenTable();

		$sql = "SELECT * FROM ".$prefix."_clanwars";
	 	$resultaat = mysql_query($sql, $dbi);
	 	while ($record = mysql_fetch_object($resultaat))
	 	{
	 		echo "
	 		<table class=\"row2\" width=\"50%\" border=\"0\">
	 		<tr>
				<td width=\"25%\">Game:</td>
	 		</tr>
	 		<tr>
				<td width=\"25%\">$record->game</td>
	 		</tr>
	 		<tr>
	 			<td width=\"25%\">Clan Id (cid):</td>
	 		</tr>
	 		<tr>
	 			<td width=\"25%\">$record->cid</td>
	 		</tr>
	 		<tr>
	 			<td width=\"25%\">Ladders:
	 		</tr>";
	 		if ($record->lid != ''){
	 		echo "<tr>
	 			<td>$record->ladder (lid:$record->lid) <img src=\"$record->image\"></td>
	 		</tr>";
	 		}
	 		if ($record->lid1 != ''){
	 		echo "<tr>
				<td>$record->ladder1 (lid:$record->lid1) <img src=\"$record->image1\"></td>
	 		</tr>";
	 		}
	 		if ($record->lid2 != ''){
	 		echo "<tr>
				<td>$record->ladder2 (lid:$record->lid2) <img src=\"$record->image2\"></td>
	 		</tr>";
	 		}
	 		if ($record->lid3 != ''){
	 		echo "<tr>
				<td>$record->ladder3 (lid:$record->lid3) <img src=\"$record->image3\"></td>
	 		</tr>";
	 		}
	 		if ($record->lid4 != ''){
	 		echo "<tr>
				<td>$record->ladder4 (lid:$record->lid4) <img src=\"$record->image4\"></td>
	 		</tr>";
	 		}
	 		echo "</table>";
	 		}
CloseTable();
}
include("footer.php");
?>
