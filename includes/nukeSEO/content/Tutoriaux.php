<?php
/************************************************************************/
/* nukeFEED
/* http://www.nukeSEO.com
/* Copyright © 2007 by Kevin Guske
/************************************************************************/
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (stristr(htmlentities($_SERVER['PHP_SELF']), 'Tutoriaux.php')) {
    Header('Location: ../../../index.php');
    die();
}

class seoTutoriaux extends seocontentclass 
{
	function seoTutoriaux ()
  {
		global $prefix;
		$this->name                  = 'Tutoriaux';
		$this->sql_col_id            = 'did';
		$this->sql_col_title         = 'tuto';
		$this->sql_col_desc          = 'comment';
		$this->sql_col_desc2         = '';
		$this->sql_col_time          = 'time';
		$this->sql_col_catid         = 'cid';
		$this->sql_col_author        = 'username';
		$this->sql_table_with_prefix = $prefix.'_tuto_infos';
		$this->sql_where_cols        = array
                                   (
                                      'tuto', 
                                      'comment'
                                   );
    // Pending links are stored in the _links_newlinks table - all links in the _links_links table are active
    $this->activeWhere           = 'active = 1';
		$this->orderArray            = array
                                   (
                                      'recent' => 'recent',
                                      'popular' => 'popular'
                                   );
		$this->orderSQLArray         = array
                                   (
                                      'recent' => 'did DESC',
                                      'popular' => 'counter DESC'
                                   );
		$this->levelArray            = array
                                   (
                                      'category' => 'category'
                                   );
		$this->levelSQLArray         = array(
                                      'category' => 'cid'
                                   );
  }
	function getLink($id, $catid)
  {
		return getNukeURL().'modules.php?name=Tutoriaux&rop=tutoriaux&did='.$id;
  }
}
?>