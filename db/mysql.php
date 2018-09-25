<?php
/***************************************************************************
 *                                 mysql.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: mysql.php,v 1.16.2.1 2005/09/18 16:17:20 acydburn Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

if(!defined('SQL_LAYER'))
{

define('SQL_LAYER','mysql');

class sql_db
{

	var $num_queries_1 = 0; //Query Counter
	var $all_queries = ""; //Query Collector
	var $db_connect_id;
	var $query_result;
	var $row = array();
	var $rowset = array();
	var $num_queries = 0;

	//
	// Constructor
	//
	function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
	{

		$this->persistency = $persistency;
		$this->user = $sqluser;
		$this->password = $sqlpassword;
		$this->server = $sqlserver;
		$this->dbname = $database;

		if($this->persistency)
		{
			$this->db_connect_id = @mysql_pconnect($this->server, $this->user, $this->password);
		}
		else
		{
			$this->db_connect_id = @mysql_connect($this->server, $this->user, $this->password);
		}
		if($this->db_connect_id)
		{
			if($database != '')
			{
				$this->dbname = $database;
				$dbselect = @mysql_select_db($this->dbname);
				if(!$dbselect)
				{
					@mysql_close($this->db_connect_id);
					$this->db_connect_id = $dbselect;
				}
			}
			return $this->db_connect_id;
		}
		else
		{
			return false;
		}
	}

	//
	// Other base methods
	//
	function sql_close()
	{
		if($this->db_connect_id)
		{
			if($this->query_result)
			{
				@mysql_free_result($this->query_result);
			}
			$result = @mysql_close($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}

	//
	// Base query method
	//
	function sql_query($query = '', $transaction = FALSE)
	{
		global $loglevel, $querycount;
	// Remove any pre-existing queries
		unset($this->query_result);
		if($query != '')
			{
			if ($loglevel == 3 || $loglevel == 4) {
			// This code was contributed by emilacosta and adapted for use with RavenNuke(tm) v2.40.00 by Raven
				$this->num_queries_1++;
				list($usec, $sec) = explode(' ',microtime());
				$time_start = ((float)$usec + (float)$sec);
				$this->query_result = @mysql_query($query, $this->db_connect_id);
				list($usec, $sec) = explode(' ',microtime());
				$time_end = ((float)$usec + (float)$sec);
				$time = $time_end - $time_start;
				$formatted_int = number_format($time, 10, '.', '');
				$this->all_queries .= $this->num_queries_1." - $query ($formatted_int seconds) [".$this->sql_numrows($this->query_result)." results]<br /><hr /><br />";
			}
			else $this->query_result = @mysql_query($query, $this->db_connect_id);
			}
			if ($loglevel == 2 || $loglevel == 4) {
				$querycount = $querycount + 1;
				$fplog = fopen(NUKE_BASE_DIR.'rnlogs/dblog','a');
				$logvar = date("F j, Y, g:i a") . ' ' ;
				$logvar .= 'SQL was: ' . preg_replace('/\s+/', ' ', trim($query)) . "\n";
				$logvar .= 'querycount = ' . $querycount . "\n";
				fwrite($fplog, "$logvar" . "\n");
				fclose($fplog);
		}
		if($this->query_result)
		{
			unset($this->row[$this->query_result]);
			unset($this->rowset[$this->query_result]);
			return $this->query_result;
		}
		else
			{
				if ($loglevel > 0) {
					$error = $this->sql_error($query);
					$fplog = fopen(NUKE_BASE_DIR.'rnlogs/dblog','a');
					$logvar = date("F j, Y, g:i a") . ' ' ;
					$logvar .= $error['code'] . ' : ' .  $error['message'] . "\n";
					$logvar .= 'SQL was: ' . preg_replace('/\s+/', ' ', trim($query)) . "\n";
					$logvar .= ' remote addr: ' . $_SERVER['REMOTE_ADDR'];
					fwrite($fplog, "$logvar" . "\n");
					fclose($fplog);
				}
			return ( $transaction == END_TRANSACTION ) ? true : false;
		}
	}

	//
	// Other query methods
	//
	function sql_numrows($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysql_num_rows($query_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_affectedrows()
	{
		if($this->db_connect_id)
		{
			$result = @mysql_affected_rows($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_numfields($query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysql_num_fields($query_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_fieldname($offset, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysql_field_name($query_id, $offset);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_fieldtype($offset, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysql_field_type($query_id, $offset);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_fetchrow($query_id = 0, $type = MYSQL_BOTH)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$this->row[(int)$query_id] = @mysql_fetch_array($query_id, $type);
			return $this->row[(int)$query_id];
		}
		else
		{
			return false;
		}
	}
	function sql_fetchrowset($query_id = 0, $type = MYSQL_BOTH)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			unset($this->rowset[$query_id]);
			unset($this->row[$query_id]);
			while($this->rowset[$query_id] = @mysql_fetch_array($query_id, $type))
			{
				$result[] = $this->rowset[$query_id];
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_fetchfield($field, $rownum = -1, $query_id = 0)
	{
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			if($rownum > -1)
			{
				$result = @mysql_result($query_id, $rownum, $field);
			}
			else
			{
				if(empty($this->row[$query_id]) && empty($this->rowset[$query_id]))
				{
					if($this->sql_fetchrow())
					{
						$result = $this->row[$query_id][$field];
					}
				}
				else
				{
					if($this->rowset[$query_id])
					{
						$result = $this->rowset[$query_id][0][$field];
					}
					else if($this->row[$query_id])
					{
						$result = $this->row[$query_id][$field];
					}
				}
			}
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_rowseek($rownum, $query_id = 0){
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}
		if($query_id)
		{
			$result = @mysql_data_seek($query_id, $rownum);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_nextid(){
		if($this->db_connect_id)
		{
			$result = @mysql_insert_id($this->db_connect_id);
			return $result;
		}
		else
		{
			return false;
		}
	}
	function sql_freeresult($query_id = 0){
		if(!$query_id)
		{
			$query_id = $this->query_result;
		}

		if ( $query_id )
		{
			unset($this->row[$query_id]);
			unset($this->rowset[$query_id]);

			@mysql_free_result($query_id);

			return true;
		}
		else
		{
			return false;
		}
	}
	function sql_error($query_id = 0)
	{
		$result['message'] = @mysql_error($this->db_connect_id);
		$result['code'] = @mysql_errno($this->db_connect_id);

		return $result;
	}

} // class sql_db

} // if ... define

?>
