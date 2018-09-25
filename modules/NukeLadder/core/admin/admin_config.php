<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.nukeladder.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################

function configmanager(){
	if(X1_useconfigpanel){
		$filename=X1_plugpath."/config.php";
		if (is_writable($filename)) {
			$c = XL_aconfig_configfile."<font color='".X1_Yescolor."'>".XL_aconfig_writable."</font>\n<br />\n";
		$fp = fopen ($filename, "r");
		$content = fread( $fp, filesize( $filename ) );
		fclose ($fp);
		$c .= "
		<form method='post' action='".X1_adminpostfile."' style='".X1_formstyle."'>\n
			<textarea name='newconfig' cols='55' rows='20' class=none>$content</textarea></br>\n
			<input type='submit' value='".XL_save."'>\n
			<input type='hidden' name='".X1_actionoperator."' value='updateconfigfile'>\n
		</form>";
		}else{
			$c =  XL_aconfig_configfile."<font color='".X1_Nocolor."'>".XL_aconfig_notwritable."</font>\n";
		}
		return X1plugin_output($c, 1);
	}
	
}

function updateconfigfile(){
	if(X1_useconfigpanel){
		$filename=X1_plugpath."/config.php";
		$content  = stripslashes($_POST['newconfig']);
		$fp = fopen($filename, "w");
		$fw = fwrite( $fp, $content );
		fclose( $fp );
		$c  = x1_admin("config");
		$c .= "<br />";
		if(!$fw) {
			$c .= XL_aconfig_error;
		}else {
			$c .= XL_aconfig_updated;
		}
		return X1plugin_output($c);
	}
}
?>