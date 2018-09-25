<?php

/************************************************************************/
/* NukeJMap [Site_Map]	4.0 Pro by z3rb		                			*/
/* =================================                                    */
/*                                                                      */
/* Copyright (c) 2006 by Techgen			                			*/
/* http://www.techg3n.net                                               */
/*                                                                      */
/************************************************************************/

if (!defined('ADMIN_FILE'))
{
	die ("Access Denied");
}
global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->sql_fetchrow($db->sql_query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'"));
if ($row['radminsuper'] == 1) {

    switch ($op) {
	    case 'site_map':
            include('admin/modules/site_map.php');
        break;

    }
}

?>
