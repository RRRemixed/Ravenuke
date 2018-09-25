<?php 
// ------------------------------------------------------------------------- //
// This program is free software; you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License, or        //
// (at your option) any later version.                                      //
// ------------------------------------------------------------------------- //

//----------------------------------------//
//Random video block by Q @ www.3c0x1.net //
//----------------------------------------//

if ( !defined('BLOCK_FILE') ) {
    Header("Location: ../index.php");
    die();
}
define('NO_HEADER', true);
global $prefix, $prefix, $db;
$limit = 1;
$content = "<p align=\"center\">";
$result = $db->sql_query("SELECT * FROM " .$prefix. "_video_stream GROUP BY id ORDER BY RAND() DESC LIMIT $limit");
while ($row = $db->sql_fetchrow($result)) {
  $imsrc = $row['imgurl'];
        if ($row['vidname'] != '') {
            $thumb_title = $row['vidname'];
        } else {
            $thumb_title = substr($row['imgurl'], 0, -4);
        } 
		//$content .= "<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id'].">".$row['vidname']."</a><br>";
		$content .="<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id']."><img src=".$row['imgurl']." border=\"0\" width=145 alt=".$row['vidname']."></a>\n";
		$content .= "<a href=modules.php?name=Video_Stream&amp;page=watch&amp;id=".$row['id'].">".$row['vidname']."</a><br>";

} 