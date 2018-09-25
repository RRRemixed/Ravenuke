<?php

if ( !defined('MODULE_FILE') ) {
    die ('You can\'t access this file directly...');
}

define('RN_MODULE_CSS', 'mysql-html.css');
if (!isset($page)) $page = '';
//define('INDEX_FILE', true); //comment this out to hide right blocks
if (defined('INDEX_FILE')) { $index = 1; } else {$index = 0; } // auto set right blocks for pre patch 3.1 compatibility
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include_once("header.php");

// We initialize the array, to avoid attacks based on poisoning the
// PHP global variable space. Thanks to waraxe for pointing this out!
// See http://www.waraxe.us
//

$ACCEPT_FILE = array();

$ACCEPT_FILE['backup-and-recovery.html'] = 'backup-and-recovery.html';
$ACCEPT_FILE['connectors-apis.html'] = 'connectors-apis.html';
$ACCEPT_FILE['data-types.html'] = 'data-types.html';
$ACCEPT_FILE['error-handling.html'] = 'error-handling.html';
$ACCEPT_FILE['extending-mysql.html'] = 'extending-mysql.html';
$ACCEPT_FILE['faqs.html'] = 'faqs.html';
$ACCEPT_FILE['functions.html'] = 'functions.html';
$ACCEPT_FILE['ha-overview.html'] = 'ha-overview.html';
$ACCEPT_FILE['images'] = 'images';
$ACCEPT_FILE['index.html'] = 'index.html';
$ACCEPT_FILE['index.php'] = 'index.php';
$ACCEPT_FILE['information-schema.html'] = 'information-schema.html';
$ACCEPT_FILE['installing.html'] = 'installing.html';
$ACCEPT_FILE['internationalization-localization.html'] = 'internationalization-localization.html';
$ACCEPT_FILE['introduction.html'] = 'introduction.html';
$ACCEPT_FILE['ix01.html'] = 'ix01.html';
$ACCEPT_FILE['language-structure.html'] = 'language-structure.html';
$ACCEPT_FILE['mem-introduction.html'] = 'mem-introduction.html';
$ACCEPT_FILE['news.html'] = 'news.html';
$ACCEPT_FILE['optimization.html'] = 'optimization.html';
$ACCEPT_FILE['partitioning.html'] = 'partitioning.html';
$ACCEPT_FILE['preface.html'] = 'preface.html';
$ACCEPT_FILE['programs.html'] = 'programs.html';
$ACCEPT_FILE['replication.html'] = 'replication.html';
$ACCEPT_FILE['restrictions.html'] = 'restrictions.html';
$ACCEPT_FILE['server-administration.html'] = 'server-administration.html';
$ACCEPT_FILE['sql-syntax.html'] = 'sql-syntax.html';
$ACCEPT_FILE['storage-engines.html'] = 'storage-engines.html';
$ACCEPT_FILE['stored-programs-views.html'] = 'stored-programs-views.html';
$ACCEPT_FILE['tutorial.html'] = 'tutorial.html';
                              
     


OpenTable();

$php_ver = phpversion();
$php_ver = explode(".", $php_ver);
$phpver = "$php_ver[0]$php_ver[1]";
if ($phpver >= 41) {
	if (!empty($_GET['page'])){
    $page = $_GET['page'];
	} else {
	$page = '';
	}
} else {
    $page = $HTTP_GET_VARS['page'];
}

if (!empty($page)) {
$pagename = $ACCEPT_FILE[$page];
}

if (!isset($pagename)) $pagename = "index.html";
include_once("modules/MySQL51_Manual/$pagename");
CloseTable();

include_once("footer.php");
?>                               