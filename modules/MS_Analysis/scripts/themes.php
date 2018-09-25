<?php

// Determine Default Theme
$result = $db->sql_query( "select Default_Theme from ".$prefix."_config" );
list( $Default_Theme ) = $db->sql_fetchrow( $result );

// Read Installed Themes
$handle = opendir( "themes" );
while( $file = readdir( $handle ) ) {
   if( ( !ereg("[.]", $file ) AND file_exists( "themes/$file/theme.php" ) ) ) { $themelist .= "$file "; }
}
closedir( $handle );
$themelist = explode( " ", $themelist );
sort( $themelist );

// Determine Amount of Themes
$totalentries = 0;
for( $i = 0; $i < sizeof( $themelist ); $i++ ) { if($themelist[$i]!="") { $totalentries += 1; } }

// Overview of Installed Theme's
echo "<div align=\"center\">\n";
echo "<center>\n";
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"50%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr>\n";
echo "<td width=\"100%\" colspan=\"2\" bgcolor=\"$bgcolor2\"><p align=\"center\"><b>$totalentries "._MSA_MENUNUKEINSTTHEMES."</b></td>\n";
echo "</tr>\n";
for( $i = 0; $i < sizeof( $themelist ); $i++ ) {
   if( $themelist[ $i ] != "" ) {
      echo "<tr>\n";
      echo "<td width=\"60%\">".$themelist[ $i ]."</td>\n";
      if( $themelist[ $i ] == $Default_Theme ) { echo "<td width=\"40%\"><b>"._MSA_MENUNUKEDEFTHEME."</b></td>\n"; }
      else echo "<td width=\"40%\"><b>.</b></td>\n";
      echo "</tr>\n";
   }
}
echo "</table>\n";
echo "</center>\n";
echo "</div><br>\n";

// Show Theme selection Overview ==> Users versus selected Theme
echo "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" width=\"100%\" bgcolor=\"$bgcolor1\">\n";
echo "<tr><td width=\"100%\" colspan=\"3\" align=\"center\" height=\"30\" bgcolor=\"$bgcolor2\"><b>"._MSA_MENUNUKESELECTEDTHEMES."</b></td></tr>\n";
echo "<tr><td width=\"10%\" bgcolor=\"$bgcolor2\"><p align=\"center\">&nbsp;</td>\n";
echo "<td width=\"60%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_NAME."</b></td>\n";
echo "<td width=\"30%\" bgcolor=\"$bgcolor2\"><p align=\"center\"><font class=\"content\"><b>"._MSA_MENUNUKEUSERTHEMES."</b></td></tr>\n";

// Show Info of Themes selected by user's
$MSATheme = array();
$MSATheme[$Default_Theme] = 0;
// Initialize array
for( $i = 0; $i < sizeof( $themelist ); $i++ ) { if( $themelist[ $i ] != "" ) { $MSATheme[ $themelist[ $i ] ] = 0; } }

// Determine which themes are selected by users
$result = $db->sql_query( "select theme from ".$user_prefix."_users" );
while( $MSArow = $db->sql_fetchrow( $result ) ) {
   if( $MSArow[theme] != "" ) $MSATheme[ $MSArow[theme] ] += 1;
   else $MSATheme[$Default_Theme] += 1;
}
// Display Info
foreach( $MSATheme as $key=>$value ) {
   if( $key <> "" ) {
      $counter += 1;
      echo "<tr><td width=\"10%\"><p align=\"center\">$counter.</td>\n";
      if( $key == $Default_Theme ) echo "<td width=\"60%\"><p align=\"left\"><font class=\"content\"><b>".$key." ("._MSA_MENUNUKEDEFTHEME.")</b></td>\n";
      else echo "<td width=\"60%\"><p align=\"left\"><font class=\"content\"><b>".$key."</b></td>\n";
      echo "<td width=\"30%\"><p align=\"center\"><font class=\"content\"><b>".$value."</b></td></tr>\n";
   }
}
echo "</table>\n";
unset( $MSATheme );

?>
