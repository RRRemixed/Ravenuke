<?php
// ----------------------------------------------------------------------
// Internet TV 
// Copyright (C) 2002 by eduangi telecom Team.
// http://www.eduangi.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------

if (!eregi("modules.php", $PHP_SELF)) {
        die ("You can't access this file directly...");
    }

/* Internet TV 
Credits to Eduardo Collado -- http://www.eduangi.com/  */

$ModName = basename( dirname( __FILE__ ) ); 

/*
Now all we have to do is change the module name in the links through-out the script to $ModName
and you should be able to change than name of the directory to whatever you want, and the links will change with it.
This is done for our non-english speaking friends, and idiots like me that just change the name of things to
be "original"
*/

    include ('header.php');


OpenTable();
echo "

<a href=\"/modules.php?name=$ModName&amp;file=tvg\">tvg</a>


El_Tiempo&amp;file=index&amp;
";

CloseTable();


    include ('footer.php');


?>
?>



