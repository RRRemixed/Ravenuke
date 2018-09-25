<?php

/*
|-----------------------------------------------------------------------
|	COPYRIGHT (c) 2016 by lonestar-modules.com
|	AUTHOR 				:	Lonestar	
|	COPYRIGHTS 			:	lonestar-modules.com
|	PROJECT 			:	Clan Manager
|	VERSION 			:	1.0.2
|----------------------------------------------------------------------
*/
require_once('mainfile.php');
include_once(NUKE_BASE_DIR.'header.php');

$module_name = 'Clan_Manager';

define('_CLAN_MANAGER_AWARDS',		$prefix.'_clanmanager_awards');
define('_CLAN_MANAGER_AWARDSD',		$prefix.'_clanmanager_awards_data');
define('_CLAN_MANAGER_COUNTRIES',	$prefix.'_clanmanager_countries');
define('_CLAN_MANAGER_DIVISIONS',	$prefix.'_clanmanager_divisions');
define('_CLAN_MANAGER_FORMS', 		$prefix.'_clanmanager_forms');
define('_CLAN_MANAGER_FORMSQ', 		$prefix.'_clanmanager_forms_questions');
define('_CLAN_MANAGER_FORMSR', 		$prefix.'_clanmanager_forms_requests');
define('_CLAN_MANAGER_GAMES', 		$prefix.'_clanmanager_games');
define('_CLAN_MANAGER_GAMESD', 		$prefix.'_clanmanager_games_data');
define('_CLAN_MANAGER_MEMBERS', 	$prefix.'_clanmanager_members');
define('_CLAN_MANAGER_RANKS', 		$prefix.'_clanmanager_ranks');
define('_CLAN_MANAGER_RIBBONS',		$prefix.'_clanmanager_ribbons');
define('_CLAN_MANAGER_RIBBONSD',	$prefix.'_clanmanager_ribbons_data');
define('_CLAN_MANAGER_SETTINGS', 	$prefix.'_clanmanager_settings');
define('_CLAN_MANAGER_THEMES', 		$prefix.'_clanmanager_themes');

define('_CLAN_MANAGER_VERSION',		'1.0.2');

define('_MODNAME', 'clanmanager');

define('_HEADER', 'Clan Manager Installer');
define('_INSTALL_COMPLETE', 'Install/Update Complete');
define('_INSTALL_COMPLETE_MSG', 'Thank you for your purchase of Clan Manager<br /><br />The install/update is now complete <br /><br /> You can now visit the <a style="text-decoration: none;" href="admin.php?op='._MODNAME.'&action=settings">module settings</a><br /><br />To configure the module for each individual theme you have installed');
define('_INSTALL_COMPLETE_MSG_WARN', 'With the install now complete you can delete this file from you\'re site');

define('_INSTALL_UPDATE_COMPLETE_MSG', 'Update of Clan Manager is now complete. <br /><br /> You can now visit the <a style="text-decoration: none;" href="admin.php?op='._MODNAME.'&action=settings">module settings</a>');

define('_INSTALL_OPTIONS', '---- Install Options ----');
define('_INSTALL_WARNING', 'Be Sure to back-up all database tables before going ahead<br />There should not be a problem, But sometimes they just can\'t be helped<br /><br />If you feel there could be a problem<br />Contact me at my website and i can help you out with the update');
define('_NEW_INSTALL','New Install');
define('_THANKS', 'Thank you for purchasing Clan Manager from <a style="text-decoration:none;" target="_BLANK" href="http://lonestar-modules.com"><span style="color: orange;">Lonestar Modules</span></a>');
define('_WELCOME', 'Welcome '.$userinfo['username']);
define('_WELCOME_MSG', 'Congratulations<br/><br/>You are going to install <strong>Clan Manager v'._CLAN_MANAGER_VERSION.'</strong>');

function _tablecss($w=FALSE,$a=FALSE,$c=FALSE,$cs=FALSE,$dh=FALSE)
{
	$tablecss  = ' style="';
	$tablecss .= ($dh <> FALSE) ? '' : 'height: 30px; ';
	$tablecss .= 'letter-spacing: 1px; ';
	$tablecss .= 'padding-left: 5px; ';
	$tablecss .= 'padding-right: 5px; ';
	$tablecss .= ($w <> FALSE) ? 'width: '.$w.'; max-width: 100%;  max-height: 100%;' : '';
	$tablecss .= ($a <> FALSE) ? 'text-align: '.$a.';' : '';
    $tablecss .= 'overflow: hidden; text-overflow: ellipsis;';
	$tablecss .= '"';
	$tablecss .= ($cs <> FALSE) ? ' colspan="'.$cs.'"' : '';
	$tablecss .= ($c <> FALSE) ? ' class="'.$c.'"' : '';
	return $tablecss;
}

function _backgroundColor($bgColor)
{
	global $bgcolor1, $bgcolor2;
	return ($bgColor == 1) ? ' bgcolor="'.$bgcolor1.'"' : ' bgcolor="'.$bgcolor2.'"';
}

function _border()
{
	return (!defined('NUKE_EVO')) ? 1 : 0;
}

function _delete_dir($dir) 
{ 
    foreach(glob($dir.'/*') as $file) 
    { 
        if(is_dir($file)) 
            _delete_dir($file);
        else 
            @unlink($file); 
    }
    @rmdir($dir); 
}

function _selectbox($n,$ops,$v)
{
	global $module_name, $settings;
	$select  = '<select class="uppertext-style" id="'.$n.'" name="'.$n.'"';
	$select .= ' style="';
	$select .= 'border: 1px solid;';
	$select .= 'cursor: pointer;';
	$select .= 'letter-spacing: 1px;';
	$select .= 'margin: 0px 1px 1px;';
	$select .= 'padding: 4px;';
	$select .= 'text-transform: uppercase;';
	$select .= '">';
	$select .= '<option value="" selected="selected">'._INSTALL_OPTIONS.'</option>';
	foreach($ops as $value => $option)
		$select .= '<option value="'.$value.'">'._sut($option).'</option>';
	$select .= '</select>';
	return $select;
}

function _suh($s,$f=FALSE)
{
	global $settings;
	$uppertext  = '<span class="upperhead-style" style="';
	$uppertext .= 'text-transform: uppercase;';
	if($f <> FALSE)
		$uppertext .= 'font-size:'.$f.'px';
	$uppertext .= '">'.$s.'</span>';
	return $uppertext;
}

function _sut($s,$f=FALSE,$t=FALSE)
{
	global $settings;
	$uppertext  = '<span class="uppertext-style" style="';
	$uppertext .= 'text-transform: uppercase;';
    if($t <> FALSE)
        $uppertext .= '-webkit-transform: translateY(50%);';
	if($f <> FALSE)
		$uppertext .= 'font-size:'.$f.'px';
	$uppertext .= '">'.$s.'</span>';
	return $uppertext;
}

function _submit($v,$class=FALSE)
{
	global $settings;
	$submit  = '<input type="submit" id="submit" name="submit" value="'.$v.'"';
	$submit .= ' style="';
	$submit .= 'height: 24px;';
 	$submit .= 'letter-spacing: 1px;';
 	$submit .= 'cursor: pointer;';
 	$submit .= 'border: 1px solid black;';
 	$submit .= 'text-transform: uppercase;';
 	$submit .= 'padding-left:5px;padding-right:5px;';
	$submit .= '"';
	$submit .= ' class="mainoption" />';
	return $submit;
}

function _gaming_rigs_retuned_install_header()
{
	echo '<table style="width: 100%;" border="'._border().'" cellpadding="4" cellspacing="1" class="forumline">'."\n";
	echo '	<tr'._backgroundColor(2).'>'."\n";
	echo '    <td'._tablecss(FALSE,'center','catHead',2).'>'._suh(_HEADER).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._backgroundColor(1).'>'."\n";
	echo '	  <td'._tablecss(FALSE,'center','row1',2).'>'._sut(_THANKS).'</td>'."\n";
	echo '  </tr>'."\n";
	echo '  <tr'._backgroundColor(2).'>'."\n";
	echo '	  <td'._tablecss(FALSE,FALSE,'catBottom',2).'>&nbsp;</td>'."\n";
	echo '  </tr>'."\n";
	echo '</table>'."\n";
	echo '<br />';	
}

if (is_admin($admin) || is_mod_admin('admin')) 
{
	OpenTable();
	_gaming_rigs_retuned_install_header();
	switch($_POST['action'])
	{ 
//---------------------------------------------------------------------
//	|	PLACEHOLDER NEW INSTALL
//--------------------------------------------------------------------- 
		case 'install':
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_AWARDS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_AWARDSD."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_COUNTRIES."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_DIVISIONS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_FORMS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_FORMSQ."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_FORMSR."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_GAMES."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_GAMESD."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_MEMBERS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_RANKS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_SETTINGS."`");
			$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_THEMES."`");
//---------------------------------------------------------------------
//	NEW INSTALL - RIBBONS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_AWARDS."` (
					  `rid` int(11) NOT NULL AUTO_INCREMENT,
					  `description` text NOT NULL,
					  `image` varchar(255) NOT NULL,
					  `title` varchar(255) NOT NULL,
					  PRIMARY KEY (`rid`),
					  KEY `title` (`title`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_AWARDSD."` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `mid` int(11) DEFAULT '0',
					  `rid` int(11) DEFAULT '0',
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - RIBBONS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - COUNTRIES TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_COUNTRIES."` (
					  `cid` int(11) NOT NULL AUTO_INCREMENT,
					  `country` varchar(255) NOT NULL,
					  `class` tinyint(2) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`cid`),
					  KEY `country` (`country`),
					  KEY `class` (`class`)
					) ENGINE=MyISAM AUTO_INCREMENT=262;";
			$result = $db->sql_query($sql);

			$sql = "INSERT INTO `"._CLAN_MANAGER_COUNTRIES."` (`cid`, `country`, `class`) VALUES (1, 'Abkhazia', 0), (2, 'Afghanistan', 0), (3, 'Aland', 0), (4, 'Albania', 0), (5, 'Algeria', 0), (6, 'American-Samoa', 0), (7, 'Andorra', 0), (8, 'Angola', 0), (9, 'Anguilla', 0), (10, 'Antarctica', 0), (11, 'Antigua-and-Barbuda', 0), (12, 'Argentina', 0), (13, 'Armenia', 0), (14, 'Aruba', 0), (15, 'Australia', 0), (16, 'Austria', 0), (17, 'Azerbaijan', 0), (18, 'Bahamas', 0), (19, 'Bahrain', 0), (20, 'Bangladesh', 0), (21, 'Barbados', 0), (22, 'Basque-Country', 0), (23, 'Belarus', 0), (24, 'Belgium', 0), (25, 'Belize', 0), (26, 'Benin', 0), (27, 'Bermuda', 0), (28, 'Bhutan', 0), (29, 'Bolivia', 0), (30, 'Bosnia-and-Herzegovina', 0), (31, 'Botswana', 0), (32, 'Brazil', 0), (33, 'British-Antarctic-Territory', 0), (34, 'British-Virgin-Islands', 0), (35, 'Brunei', 0), (36, 'Bulgaria', 0), (37, 'Burkina-Faso', 0), (38, 'Burundi', 0), (39, 'Cambodia', 0), (40, 'Cameroon', 0), (41, 'Canada', 0), (42, 'Canary-Islands', 0), (43, 'Cape-Verde', 0), (44, 'Cayman-Islands', 0), (45, 'Central-African-Republic', 0), (46, 'Chad', 0), (47, 'Chile', 0), (48, 'China', 0), (49, 'Christmas-Island', 0), (50, 'Cocos-Keeling-Islands', 0), (51, 'Colombia', 0), (52, 'Commonwealth', 0), (53, 'Comoros', 0), (54, 'Cook-Islands', 0), (55, 'Costa-Rica', 0), (56, 'Cote-dIvoire', 0), (57, 'Croatia', 0), (58, 'Cuba', 0), (59, 'Curacao', 0), (60, 'Cyprus', 0), (61, 'Czech-Republic', 0), (62, 'Democratic-Republic-of-the-Congo', 0), (63, 'Denmark', 0), (64, 'Djibouti', 0), (65, 'Dominica', 0), (66, 'Dominican-Republic', 0), (67, 'East-Timor', 0), (68, 'Ecuador', 0), (69, 'Egypt', 0), (70, 'El-Salvador', 0), (71, 'England', 0), (72, 'Equatorial-Guinea', 0), (73, 'Eritrea', 0), (74, 'Estonia', 0), (75, 'Ethiopia', 0), (76, 'European-Union', 0), (77, 'Falkland-Islands', 0), (78, 'Faroes', 0), (79, 'Fiji', 0), (80, 'Finland', 0), (81, 'France', 0), (82, 'French-Polynesia', 0), (83, 'French-Southern-Territories', 0), (84, 'Gabon', 0), (85, 'Gambia', 0), (86, 'Georgia', 0), (87, 'Germany', 0), (88, 'Ghana', 0), (89, 'Gibraltar', 0), (90, 'GoSquared', 0), (91, 'Greece', 0), (92, 'Greenland', 0), (93, 'Grenada', 0), (94, 'Guam', 0), (95, 'Guatemala', 0), (96, 'Guernsey', 0), (97, 'Guinea-Bissau', 0), (98, 'Guinea', 0), (99, 'Guyana', 0), (100, 'Haiti', 0), (101, 'Honduras', 0), (102, 'Hong-Kong', 0), (103, 'Hungary', 0), (104, 'Iceland', 0), (105, 'India', 0), (106, 'Indonesia', 0), (107, 'Iran', 0), (108, 'Iraq', 0), (109, 'Ireland', 0), (110, 'Isle-of-Man', 0), (111, 'Israel', 0), (112, 'Italy', 0), (113, 'Jamaica', 0), (114, 'Japan', 0), (115, 'Jersey', 0), (116, 'Jordan', 0), (117, 'Kazakhstan', 0), (118, 'Kenya', 0), (119, 'Kiribati', 0), (120, 'Kosovo', 0), (121, 'Kuwait', 0), (122, 'Kyrgyzstan', 0), (123, 'Laos', 0), (124, 'Latvia', 0), (125, 'Lebanon', 0), (126, 'Lesotho', 0), (127, 'Liberia', 0), (128, 'Libya', 0), (129, 'Liechtenstein', 0), (130, 'Lithuania', 0), (131, 'Luxembourg', 0), (132, 'Macau', 0), (133, 'Macedonia', 0), (134, 'Madagascar', 0), (135, 'Malawi', 0), (136, 'Malaysia', 0), (137, 'Maldives', 0), (138, 'Mali', 0), (139, 'Malta', 0), (140, 'Mars', 0), (141, 'Marshall-Islands', 0), (142, 'Martinique', 0), (143, 'Mauritania', 0), (144, 'Mauritius', 0), (145, 'Mayotte', 0), (146, 'Mexico', 0), (147, 'Micronesia', 0), (148, 'Moldova', 0), (149, 'Monaco', 0), (150, 'Mongolia', 0), (151, 'Montenegro', 0), (152, 'Montserrat', 0), (153, 'Morocco', 0), (154, 'Mozambique', 0), (155, 'Myanmar', 0), (156, 'NATO', 0), (157, 'Nagorno-Karabakh', 0), (158, 'Namibia', 0), (159, 'Nauru', 0), (160, 'Nepal', 0), (161, 'Netherlands-Antilles', 0), (162, 'Netherlands', 0), (163, 'New-Caledonia', 0), (164, 'New-Zealand', 0), (165, 'Nicaragua', 0), (166, 'Niger', 0), (167, 'Nigeria', 0), (168, 'Niue', 0), (169, 'Norfolk-Island', 0), (170, 'North-Korea', 0), (171, 'Northern-Cyprus', 0), (172, 'Northern-Mariana-Islands', 0), (173, 'Norway', 0), (174, 'Olympics', 0), (175, 'Oman', 0), (176, 'Pakistan', 0), (177, 'Palau', 0), (178, 'Palestine', 0), (179, 'Panama', 0), (180, 'Papua-New-Guinea', 0), (181, 'Paraguay', 0), (182, 'Peru', 0), (183, 'Philippines', 0), (184, 'Pitcairn-Islands', 0), (185, 'Poland', 0), (186, 'Portugal', 0), (187, 'Puerto-Rico', 0), (188, 'Qatar', 0), (189, 'Red-Cross', 0), (190, 'Republic-of-the-Congo', 0), (191, 'Romania', 0), (192, 'Russia', 0), (193, 'Rwanda', 0), (194, 'Saint-Barthelemy', 0), (195, 'Saint-Helena', 0), (196, 'Saint-Kitts-and-Nevis', 0), (197, 'Saint-Lucia', 0), (198, 'Saint-Martin', 0), (199, 'Saint-Vincent-and-the-Grenadines', 0), (200, 'Samoa', 0), (201, 'San-Marino', 0), (202, 'Sao-Tome-and-Principe', 0), (203, 'Saudi-Arabia', 0), (204, 'Scotland', 0), (205, 'Senegal', 0), (206, 'Serbia', 0), (207, 'Seychelles', 0), (208, 'Sierra-Leone', 0), (209, 'Singapore', 0), (210, 'Slovakia', 0), (211, 'Slovenia', 0), (212, 'Solomon-Islands', 0), (213, 'Somalia', 0), (214, 'Somaliland', 0), (215, 'South-Africa', 0), (216, 'South-Georgia', 0), (217, 'South-Korea', 0), (218, 'South-Ossetia', 0), (219, 'South-Sudan', 0), (220, 'Spain', 0), (221, 'Sri-Lanka', 0), (222, 'Sudan', 0), (223, 'Suriname', 0), (224, 'Swaziland', 0), (225, 'Sweden', 0), (226, 'Switzerland', 0), (227, 'Syria', 0), (228, 'Taiwan', 0), (229, 'Tajikistan', 0), (230, 'Tanzania', 0), (231, 'Thailand', 0), (232, 'Togo', 0), (233, 'Tokelau', 0), (234, 'Tonga', 0), (235, 'Trinidad-and-Tobago', 0), (236, 'Tunisia', 0), (237, 'Turkey', 0), (238, 'Turkmenistan', 0), (239, 'Turks-and-Caicos-Islands', 0), (240, 'Tuvalu', 0), (241, 'US-Virgin-Islands', 0), (242, 'Uganda', 0), (243, 'Ukraine', 0), (244, 'United-Arab-Emirates', 0), (245, 'United-Kingdom', 0), (246, 'United-Nations', 0), (247, 'United-States', 0), (248, 'Unknown', 0), (249, 'Uruguay', 0), (250, 'Uzbekistan', 0), (251, 'Vanuatu', 0), (252, 'Vatican-City', 0), (253, 'Venezuela', 0), (254, 'Vietnam', 0), (255, 'Wales', 0), (256, 'Wallis-And-Futuna', 0), (257, 'Western-Sahara', 0), (258, 'Yemen', 0), (259, 'Zambia', 0), (260, 'Zimbabwe', 0);";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - COUNTRIES TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - DIVISIONS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_DIVISIONS."` (
					  `did` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
					  `title` varchar(255) NOT NULL DEFAULT '',
					  `tag` varchar(255) NOT NULL DEFAULT '',
					  PRIMARY KEY (`did`),
					  KEY `name` (`title`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - DIVISIONS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - FORMS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_FORMS."` (
					  `fid` int(11) NOT NULL AUTO_INCREMENT,
					  `acceptedText` text NOT NULL,
					  `deniedText` text NOT NULL,
					  `description` text NOT NULL,
					  `email_address` varchar(255) NOT NULL DEFAULT '',
					  `notify` smallint(5) unsigned NOT NULL,
					  `forum_id` smallint(5) unsigned NOT NULL DEFAULT '0',
					  `intoForums` smallint(5) unsigned NOT NULL DEFAULT '0',
					  `status` smallint(5) unsigned NOT NULL,
					  `submissionText` text NOT NULL,
					  `title` varchar(255) NOT NULL DEFAULT '',
					  PRIMARY KEY (`fid`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_FORMSQ."` (
					  `qid` int(10) unsigned NOT NULL AUTO_INCREMENT,
					  `fid` smallint(5) unsigned NOT NULL DEFAULT '0',
					  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
					  `question` text NOT NULL,
					  `required` smallint(5) unsigned NOT NULL DEFAULT '0',
					  `element` varchar(15) NOT NULL,
					  `options` text NOT NULL,
					  PRIMARY KEY (`qid`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_FORMSR."` (
					  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
					  `fid` int(11) NOT NULL DEFAULT '0',
					  `user_id` int(11) NOT NULL DEFAULT '1',
					  `username` varchar(255) NOT NULL,
					  `apply_time` int(11) NOT NULL DEFAULT '0',
					  `application` longtext NOT NULL,
					  `title` varchar(255) NOT NULL,
					  PRIMARY KEY (`rid`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - FORMS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - GAMES TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_GAMES."` (
					  `gid` int(11) NOT NULL AUTO_INCREMENT,
					  `appid` varchar(100) NOT NULL,
					  `default` tinyint(2) NOT NULL DEFAULT '0',
					  `icon` varchar(255) NOT NULL,
					  `title` varchar(255) NOT NULL,
					  `abbr` varchar(255) NOT NULL,
					  PRIMARY KEY (`gid`),
					  KEY `title` (`title`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_GAMESD."` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `mid` int(11) DEFAULT '0',
					  `gid` int(11) DEFAULT '0',
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - GAMES TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - MEMBERS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_MEMBERS."` (
					  `mid` int(11) NOT NULL AUTO_INCREMENT,
					  `uid` int(11) DEFAULT '0',
					  `rid` int(11) DEFAULT '0',
					  `did` int(11) NOT NULL DEFAULT '0',
					  `birthdate` int(8) NOT NULL DEFAULT '0',
					  `country` varchar(255) NOT NULL,
					  `email_address` varchar(255) NOT NULL,
					  `facebook` varchar(255) NOT NULL,
					  `gaming_case` varchar(255) NOT NULL,
					  `gender` tinyint(1) DEFAULT '1',
					  `graphics` varchar(255) NOT NULL,
					  `harddrive` varchar(255) NOT NULL,
					  `harddrive2` varchar(255) NOT NULL DEFAULT '',
					  `headset` varchar(255) NOT NULL,
					  `joindate` int(8) NOT NULL DEFAULT '0',
					  `keyboard` varchar(255) NOT NULL,
					  `lastseen` int(11) NOT NULL DEFAULT '0',
					  `location` varchar(255) NOT NULL,
					  `manufacturer` varchar(255) NOT NULL DEFAULT '',
					  `memory` varchar(255) NOT NULL,
					  `operating_system` varchar(255) NOT NULL,
					  `motherboard` varchar(255) NOT NULL,
					  `mouse` varchar(255) NOT NULL,
					  `origin` varchar(255) NOT NULL,
					  `photo` varchar(255) NOT NULL,
					  `processor` varchar(255) NOT NULL,
					  `psu` varchar(255) NOT NULL,
					  `realname` varchar(255) NOT NULL,
					  `rig_image` varchar(255) NOT NULL,
					  `status` tinyint(1) DEFAULT '1',
					  `steam` varchar(255) NOT NULL,
					  `twitter` varchar(255) NOT NULL,
					  `uname` varchar(255) NOT NULL,
					  `userdata` varchar(255) NOT NULL,
					  PRIMARY KEY (`mid`),
					  KEY `uid` (`uid`),
					  KEY `uname` (`uname`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - MEMBERS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - RANKS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_RANKS."` (
					  `rid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
					  `abbr` varchar(255) NOT NULL DEFAULT '',
					  `image` varchar(255) NOT NULL DEFAULT '',
					  `position` smallint(5) NOT NULL DEFAULT '0',
					  `title` varchar(255) NOT NULL DEFAULT '',
					  PRIMARY KEY (`rid`),
					  KEY `name` (`title`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - RANKS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - SETTINGS TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_SETTINGS."` (
					  `config_name` varchar(50) NOT NULL DEFAULT '',
					  `config_value` text NOT NULL,
					  PRIMARY KEY (`config_name`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$sql = "INSERT INTO `"._CLAN_MANAGER_SETTINGS."` (`config_name`, `config_value`) VALUES ('clanname', ''),('clantag', ''),('application', '1'),('roster', '1'),('profile', '1'),('version', '"._CLAN_MANAGER_VERSION."'),('icon_height', '24'),('icon_width', '24'),('countries', '24x24'),('steam', ''),('application_access', '1'),('roster_access', '0'),('profile_access', '0'),('listings', '1'),('publicnav', '0'),('rank', '0'),('inactivity', '15'),('whosee_status', '0'),('gamertag', '{TAGS} {NAME}'),('show_status', '1');";
			$result = $db->sql_query($sql);
//---------------------------------------------------------------------
//	NEW INSTALL - SETTINGS TABLE
//---------------------------------------------------------------------
//---------------------------------------------------------------------
//	NEW INSTALL - THEMES TABLE
//---------------------------------------------------------------------
			$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_THEMES."` (
					  `theme_name` varchar(255) NOT NULL,
					  `cell` int(11) NOT NULL,
					  `columns` int(11) NOT NULL,
					  `head` int(11) NOT NULL,
					  `per_row` varchar(255) NOT NULL,
					  `show_left` int(11) NOT NULL,
					  PRIMARY KEY (`theme_name`)
					) ENGINE=MyISAM;";
			$result = $db->sql_query($sql);

			$total_themes = 0;
			$handle = opendir('themes');
		    while ($file = readdir($handle)) 
			{
		        if ((!preg_match("/[\.]/",$file) AND file_exists(NUKE_THEMES_DIR.$file.'/theme.php'))) 
				{
		            $themelist .= "$file ";
		        }
		    }
		    closedir($handle);
		    $themelist = explode(" ", $themelist);
		    sort($themelist);
			for ($i = 0; $i < sizeof($themelist); $i++) 
			{
				if(!empty($themelist[$i])) 
				{
					$db->sql_query("INSERT INTO `"._CLAN_MANAGER_THEMES."` (`theme_name`,`cell`,`columns`,`head`,`per_row`,`show_left`) VALUES ('$themelist[$i]',1,5,0,3,1)");
					$total_themes++;
				}
			}
//---------------------------------------------------------------------
//	NEW INSTALL - THEMES TABLE
//---------------------------------------------------------------------
			echo '<table style="width: 100%;" border="'._border().'" cellpadding="4" cellspacing="1" class="forumline">'."\n";
			echo '	<tr'._backgroundColor(2).'>'."\n";	
			echo '    <td'._tablecss(FALSE,'center','catHead',2).'>'._suh(_INSTALL_COMPLETE).'</td>'."\n";	
			echo '  </tr>'."\n";
			echo '	<tr'._backgroundColor(1).'>'."\n";	
			echo '    <td'._tablecss(FALSE,'center','row1',2).'><span style="color: green;">'._sut(_INSTALL_COMPLETE_MSG).'</span><br /><br /><span style="color: red;">'._sut(_INSTALL_COMPLETE_MSG_WARN).'</span></td>'."\n";	
			echo '  </tr>'."\n";
			echo '	<tr'._backgroundColor(2).'>'."\n";	
			echo '    <td'._tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";	
			echo '  </tr>'."\n";
			echo '</table>';
			break;
//---------------------------------------------------------------------
//	|	PLACEHOLDER NEW INSTALL
//--------------------------------------------------------------------- 
//---------------------------------------------------------------------
//	PLACEHOLDER - UPDATE FROM 1.0.1 TO 1.0.2
//---------------------------------------------------------------------
			case 'update101':
				// $db->sql_query("UPDATE `"._CLAN_MANAGER_SETTINGS."` SET `config_value`='1.0.2' WHERE `config_name`='version'");
				$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_DIVISIONS."` (
  						  `did` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  						  `title` varchar(255) NOT NULL DEFAULT '',
  						  `tag` varchar(255) NOT NULL DEFAULT '',
  						  PRIMARY KEY (`did`),
  						  KEY `name` (`title`)
  						) ENGINE=MyISAM;";
				$db->sql_query($sql);
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_MEMBERS."` ADD `did` int(11) NOT NULL DEFAULT '0' AFTER `rid`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_MEMBERS."` ADD `lastseen` int(11) NOT NULL DEFAULT '0' AFTER `keyboard`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_MEMBERS."` ADD `userdata` varchar(255) NOT NULL DEFAULT '' AFTER `uname`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_MEMBERS."` ADD `manufacturer` varchar(255) NOT NULL DEFAULT '' AFTER `location`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_MEMBERS."` ADD `harddrive2` varchar(255) NOT NULL DEFAULT '' AFTER `harddrive`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_RANKS."` ADD `image` varchar(255) NOT NULL DEFAULT '' AFTER `abbr`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_FORMS."` DROP COLUMN `store_data_file`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_FORMSQ."` DROP COLUMN `active`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_FORMSR."` DROP COLUMN `status`");
				$db->sql_query("ALTER TABLE `"._CLAN_MANAGER_THEMES."` ADD `columns` int(11) NOT NULL DEFAULT '0' AFTER `cell`");
				$db->sql_query("RENAME TABLE `"._CLAN_MANAGER_RIBBONS."` TO `"._CLAN_MANAGER_AWARDS."`");
				$db->sql_query("RENAME TABLE `"._CLAN_MANAGER_RIBBONSD."` TO `"._CLAN_MANAGER_AWARDSD."`");
				$db->sql_query("DROP TABLE IF EXISTS `"._CLAN_MANAGER_SETTINGS."`");
				$sql = "CREATE TABLE IF NOT EXISTS `"._CLAN_MANAGER_SETTINGS."` (
					  `config_name` varchar(50) NOT NULL DEFAULT '',
					  `config_value` text NOT NULL,
					  PRIMARY KEY (`config_name`)
					) ENGINE=MyISAM;";
				$result = $db->sql_query($sql);

				$sql = "INSERT INTO `"._CLAN_MANAGER_SETTINGS."` (`config_name`, `config_value`) VALUES ('clanname', ''),('clantag', ''),('application', '1'),('roster', '1'),('profile', '1'),('version', '"._CLAN_MANAGER_VERSION."'),('icon_height', '24'),('icon_width', '24'),('countries', '24x24'),('steam', ''),('application_access', '1'),('roster_access', '0'),('profile_access', '0'),('listings', '1'),('publicnav', '0'),('rank', '0'),('inactivity', '15'),('whosee_status', '0'),('gamertag', '{TAGS} {NAME}'),('show_status', '1');";
				$result = $db->sql_query($sql);

				echo '<table style="width: 100%;" border="'._border().'" cellpadding="4" cellspacing="1" class="forumline">'."\n";
				echo '	<tr'._backgroundColor(2).'>'."\n";	
				echo '    <td'._tablecss(FALSE,'center','catHead',2).'>'._suh(_INSTALL_COMPLETE).'</td>'."\n";	
				echo '  </tr>'."\n";
				echo '	<tr'._backgroundColor(1).'>'."\n";	
				echo '    <td'._tablecss(FALSE,'center','row1',2).'><span style="color: green;">'._sut(_INSTALL_UPDATE_COMPLETE_MSG).'</span></td>'."\n";	
				echo '  </tr>'."\n";
				echo '	<tr'._backgroundColor(2).'>'."\n";	
				echo '    <td'._tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";	
				echo '  </tr>'."\n";
				echo '</table>';
				break;
//---------------------------------------------------------------------
//	PLACEHOLDER - UPDATE FROM 1.0.1 TO 1.0.2
//---------------------------------------------------------------------
		default:
			echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
			echo '<table style="width: 100%;" border="'._border().'" cellpadding="4" cellspacing="1" class="forumline">'."\n";
			echo '	<tr'._backgroundColor(2).'>'."\n";	
			echo '    <td'._tablecss(FALSE,'center','catHead',2).'>'._suh(_WELCOME).'</td>'."\n";	
			echo '  </tr>'."\n";
			$install_array = array(
				'install' => _NEW_INSTALL, 
				// '' => '--- ------- ------- ---',
				// 'update100' => 'UPDATE FROM 1.0.0 TO 1.0.1',
				'update101' => 'UPDATE FROM 1.0.1 TO 1.0.2'
			);
			echo '  <tr'._backgroundColor(1).'>'."\n";
			echo '    <td'._tablecss(FALSE,'center','row1',2).'>'._sut(_WELCOME_MSG).'<br /><br /><span style="color: red;">'._sut(_INSTALL_WARNING).'</span><br /><br />'._selectbox('action',$install_array,'').'&nbsp;'._submit('Go').'</td>'."\n";	
			echo '  </tr>'."\n";
			echo '  <tr'._backgroundColor(2).'>'."\n";
			echo '	  <td'._tablecss(FALSE,'center','catBottom',2).'>&nbsp;</td>'."\n";
			echo '  </tr>'."\n";
			echo '</table>'."\n";
			echo '</form>';
			break;

	}		
	CloseTable();
}

include_once(NUKE_BASE_DIR.'footer.php');

?>