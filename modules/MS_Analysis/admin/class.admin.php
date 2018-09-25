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

class msa_admin
{
   var $modulename;

   /******************************************************************************/
   /* Constructor for this Class                                                 */
   /******************************************************************************/
   function msa_admin( $module_name )
   {
      $this->modulename = $module_name;
   }

   /******************************************************************************/
   /* Draw Admin Menu                                                            */
   /******************************************************************************/
   function admin_menu( )
   {
      global $prefix, $db, $bgcolor1, $bgcolor2;

      $module_name = $this->modulename;
      include( "modules/".$this->modulename."/scripts/title.php" );
      echo "<center><font color=\"FB0000\"><h5>"._MSA_ADMIN."</font></h5></center>\n";

      OpenTable();
      echo "<div align=\"center\"><center>\n";
      echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" height=\"25\" width=\"80%\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" bgcolor=\"$bgcolor1\">\n";
      echo "<tr><td width=\"100%\" colspan=\"6\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"></a><b>" . _MSA_ADMINOPTIONS . "</b></td></tr>\n";

      echo "<tr><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/edit.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=1\">"._MSA_GENSETTINGS."</td></a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td>\n";
      echo "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/exclude.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=2\">"._MSA_EXCLUDEIP."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td></tr>\n";

      echo "<tr><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/exclude.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=3\">"._MSA_EXCLUDEUSERS."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td>\n";
      echo "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/edit.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=4\">"._MSA_DEFSE."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td></tr>\n";

      echo "<tr><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/tablemain.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=5\">"._MSA_TABLEMAIN."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td>\n";
      echo "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/delete.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=6\">"._MSA_STATSRESET."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td></tr>\n";

      // Check if Auto Pruning is enabled
      $result = $db->sql_query( "select allow_pruning, nbrdays, begindate from ".$prefix."_msanalysis_admin where id='1'" );
      list( $allow_pruning, $nbrdays, $begindate ) = $db->sql_fetchrow( $result );
      if( $allow_pruning == 0 ) { $pruning_message = _MSA_PRUNINGMESSAGE1; }
      else {
         require_once( "modules/".$this->modulename."/include/class.general.php" );
         $msa = new msanalysis();
         $ResetInDays = $nbrdays - ( $msa->DaysOld( $begindate ) % $nbrdays );
         $pruning_message = _MSA_PRUNINGMESSAGE2 . " $ResetInDays " . _MSA_PRUNINGMESSAGE3;
      }

      echo "<tr><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/tablemain.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=7\">"._MSA_TABLEPRUNING."<br>($pruning_message)</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td>\n";
      echo "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/user-info.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=8\">"._MSA_USERINFO."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td></tr>\n";

      echo "<tr><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/user-info.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=9\">"._MSA_DELETEINACTIVEUSR."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td>\n";
      echo "<td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/nukestats/www.gif\" border=\"0\" align=\"bottom\"></td><td width=\"30%\">&nbsp;<a href=modules.php?name=".$this->modulename."&amp;file=index>"._MSA_MSAVERSION."</a></td><td width=\"10%\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/down.gif\" border=\"0\" align=\"bottom\"></td></tr>\n";

      echo "<tr><td width=\"50%\" colspan=\"6\" height=\"25\" align=\"center\" bgcolor=\"$bgcolor1\"><img src=\"modules/".$this->modulename."/images/backup.gif\" border=\"0\" align=\"bottom\">&nbsp;<a href=\"modules.php?name=".$this->modulename."&amp;file=admin&amp;which_function=10\">"._MSA_BACKUP."</a></td></tr>\n";
      echo "</table></center></div>\n";
      CloseTable();
   }

   /******************************************************************************/
   /* Check Permission                                                           */
   /******************************************************************************/
   function check_permission()
   {
      global $prefix, $db, $admin;

      if( !is_array( $admin ) ) {
         $adm = base64_decode( $admin );
         $adm = explode( ":", $adm );
         $aname = "$adm[0]";
      } else { $aname = "$admin[0]"; }

      $result = $db->sql_query( "select radminsuper from ".$prefix."_authors where aid='$aname'" );
      list( $radminsuper ) = $db->sql_fetchrow( $result );
      if( $radminsuper == 1 ) { return ( 1 ); } else { return( 0 ); }
   }

   /******************************************************************************/
   /* FUNCTION: save_no_logging                                                  */
   /*                                                                            */
   /* which: 0  ==> add IP address                                               */
   /* which: 1  ==> add User name                                                */
   /* which: 2  ==> delete IP Address                                            */
   /* which: 3  ==> delete User name                                             */
   /* what:  Delete which entry                                                  */
   /******************************************************************************/
   function save_no_logging( $nipuser, $which, $what )
   {
      include( "modules/".$this->modulename."/include/nologging.php" );

      if( $nipuser == "" ) { $this->disp_error( _MSA_ENTERVALUE ); }
      else {
         // Write new nologging file
         $MSAwrite = @fopen( "modules/".$this->modulename."/include/nologging.php", 'w' );
         if( !$MSAwrite ) { $this->disp_error( _MSA_WRITEERROR ); }
         else {
            fputs( $MSAwrite, "<?php\n" );

            if( $which == 0 OR $which == 2 ) {
               fputs( $MSAwrite, "\$MSIgnoreIP = Array\n" );
               fputs( $MSAwrite, "(\n" );
               if( $which == 0 ) { foreach( $MSIgnoreIP as $key ) { fputs( $MSAwrite, "'" . $key . "',\n" ); } fputs( $MSAwrite, "'" . $nipuser . "'\n" ); }
               if( $which == 2 ) {
   	            unset( $MSIgnoreIP[ $what ] );
                   $counter = count( $MSIgnoreIP );
                   $i = 1;
   	            foreach( $MSIgnoreIP as $key ) {
   		           if( $i != $counter ) fputs( $MSAwrite, "'" . $key . "',\n" ); else fputs( $MSAwrite, "'" . $key . "'\n" );
   		           $i += 1;
   		        }
   	        }
               fputs( $MSAwrite, ");\n" );

               fputs( $MSAwrite, "\$MSIgnoreUNAME = Array\n" );
               fputs( $MSAwrite, "(\n" );
               $i = 1;
               $counter = count( $MSIgnoreUNAME );
               foreach( $MSIgnoreUNAME as $key ) {
                  if( $i != $counter ) fputs( $MSAwrite, "'" . $key . "',\n" ); else fputs( $MSAwrite, "'" . $key . "'\n" );
                  $i += 1;
               }
               fputs( $MSAwrite, ");\n" );
            }

            if( $which == 1 OR $which == 3 ) {
               fputs( $MSAwrite, "\$MSIgnoreIP = Array\n" );
               fputs( $MSAwrite, "(\n" );
               $i = 1;
               $counter = count( $MSIgnoreIP );
               foreach( $MSIgnoreIP as $key ) {
                  if( $i != $counter ) fputs( $MSAwrite, "'" . $key . "',\n" ); else fputs( $MSAwrite, "'" . $key . "'\n" );
                  $i += 1;
               }
               fputs( $MSAwrite, ");\n" );

               fputs( $MSAwrite, "\$MSIgnoreUNAME = Array\n" );
               fputs( $MSAwrite, "(\n" );
               if( $which == 1 ) { foreach( $MSIgnoreUNAME as $key ) { fputs( $MSAwrite, "'" . $key . "',\n" ); } fputs( $MSAwrite, "'" . $nipuser . "'\n" ); }
               if( $which == 3 ) {
   	           unset( $MSIgnoreUNAME[ $what ] );
                  $counter = count( $MSIgnoreUNAME );
                  $i = 1;
   	           foreach( $MSIgnoreUNAME as $key ) {
   		          if( $i != $counter ) fputs( $MSAwrite, "'" . $key . "',\n" ); else fputs( $MSAwrite, "'" . $key . "'\n" );
   		          $i += 1;
   		       }
   		    }
               fputs( $MSAwrite, ");\n" );
            }

            fputs( $MSAwrite, "?>\n" );
            fclose( $MSAwrite );
         }
      }
   }

   /******************************************************************************/
   /* FUNCTION: MSAnalysisSaveSearchEngines                                      */
   /*                                                                            */
   /* which: 0  ==> add Search Engine                                            */
   /* which: 1  ==> delete Search Engine                                         */
   /* what:  Delete which entry                                                  */
   /******************************************************************************/
   function save_searchengines( $nse, $nseq, $which, $what )
   {
      include( "modules/".$this->modulename."/include/searchengines.php" );

      if( $nse == "" OR $nseq == "" ) { $this->disp_error( _MSA_ENTERVALUE ); }
      else {
         // Write new SearchEngine file
         $MSAwrite = @fopen( "modules/".$this->modulename."/include/searchengines.php", 'w' );
         if( !$MSAwrite ) { $this->disp_error( _MSA_WRITEERROR ); }
         else {
            fputs( $MSAwrite, "<?php\n" );

            fputs( $MSAwrite, "\$MSSearchEngines = Array\n" );
            fputs( $MSAwrite, "(\n" );
            if( $which == 0 ) { foreach( $MSSearchEngines as $key=>$value ) { fputs( $MSAwrite, "'" . $key . "' => '" . $value . "',\n" ); } fputs( $MSAwrite, "'" . $nse . "' => '" . $nseq . "'\n" ); }
            if( $which == 1 ) {
               unset( $MSSearchEngines[ $what ] );
               $counter = count( $MSSearchEngines );
               $i = 1;
	       foreach( $MSSearchEngines as $key=>$value ) {
	          if( $i != $counter ) fputs( $MSAwrite, "'" . $key . "' => '" . $value . "',\n" ); else fputs( $MSAwrite, "'" . $key . "' => '" . $value . "'\n" );
	          $i += 1;
               }
	    }
            fputs( $MSAwrite, ");\n" );
            fputs( $MSAwrite, "?>\n" );
            fclose( $MSAwrite );
         }
      }
   }

   /******************************************************************************/
   /* Display Error Message                                                      */
   /******************************************************************************/
   function disp_error( $errormessage )
   {
      include( "header.php" );
      OpenTable();
      echo "<h4 align=center><b>".$errormessage."</b></h4>\n";
      CloseTable(); echo "<br>";
      echo "<center>[ <a href=\"javascript:history.go( -1 )\">"._MSA_GOBACK."</a> ]</center>\n";
      include( "footer.php" );
   }

}

?>
