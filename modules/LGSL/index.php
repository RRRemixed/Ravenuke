<?php

//------------------------------------------------------------------------------------------------------------+

  defined("MODULE_FILE") or die("DIRECT ACCESS NOT ALLOWED");

  require_once "mainfile.php";

  require "header.php";

  opentable();

//------------------------------------------------------------------------------------------------------------+

  $output = "";

  if (isset($_GET['s']) && is_numeric($_GET['s']))
  {
    require "modules/LGSL/lgsl_files/lgsl_details.php";
  }
  elseif (isset($_GET['s']) && $_GET['s'] == "add")
  {
    require "modules/LGSL/lgsl_files/lgsl_add.php";
  }
  else
  {
    require "modules/LGSL/lgsl_files/lgsl_list.php";
  }

  echo $output;

  unset($output);

//------------------------------------------------------------------------------------------------------------+

  closetable();

  require "footer.php";

//------------------------------------------------------------------------------------------------------------+

?>