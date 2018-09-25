<?php

/************************************************************************************/
/*                                                                                  */
/* Maty Scripts Analysis for PHP-Nuke 6.5-7.9                                       */
/* v2.3                                                                             */
/*                                                                                  */
/* Copyright © 2002-2005 by: Maty Scripts (webmaster@matyscripts.com)               */
/* http://www.matyscripts.com                                                       */
/*                                                                                  */
/* This program is free software. You can redistribute it and/or modify             */
/* it under the terms of the GNU General Public License as published by             */
/* the Free Software Foundation; either version 2 of the License.                   */
/*                                                                                  */
/************************************************************************************/
/*                                                                                  */
/* Special thanks to < Madman > for providing this script                           */
/* http://gp4tweaker.vadertrophy.com/                                               */
/*                                                                                  */
/* This script makes sure that MSA is not 'linking files' of its own files.         */
/* There are security scripts which check for this!                                 */
/*                                                                                  */
/************************************************************************************/

if( isset( $targetscript ) && eregi( "^[a-z0-9_-]+$", $targetscript ) ) {
   $module_name = basename( dirname( __FILE__ ) );
   if( $targetscript == "userinfo" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "excludeip" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "excludeuser" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "gensettings" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "inactive" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "pruning" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "reset" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "searchengines" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else if( $targetscript == "tables" ) {
      $target = "modules/" . $module_name . "/admin/" . $targetscript . ".php";
   } else {
      $target = "modules/" . $module_name . "/scripts/" . $targetscript . ".php";
   }
   if( file_exists( $target ) ) {
      @(include( $target ) ) OR die( "Such file doesn't exists" );
   } else {
      die( "such file doesn't exists" );
  }
} else {
   die( "You cannot run this file directly" );
}

?>