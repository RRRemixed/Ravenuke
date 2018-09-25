<?php

/********************************************************/
/* Clan Allies Module                                   */
/* By: Clan Themes (admin@clan-themes.co.uk)  			*/
/* http://www.clan-themes.co.uk                         */
/********************************************************/

casave_config("require_user",$require_user);
casave_config("image_type",$image_type);
casave_config("max_width",$max_width);
casave_config("max_height",$max_height);
Header("Location: ".$admin_file.".php?op=CAConfig");

?>