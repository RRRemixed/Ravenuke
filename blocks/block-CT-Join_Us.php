<?php
if ( !defined('BLOCK_FILE') ) {
    Header('Location: ../index.php');
    die();
}

$link = "http://www.clanthemes.com"; //add your prefered link between the " and "
    
$content = "<div style='text-align:center'><a href='$link' target='_blank' rel='nofollow'><img src='themes/COD_Black_Ops/images/joinus.gif' alt='Join Us Today !' /></a></div>";

?>