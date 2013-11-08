<?php
/**
 * File level comments for FFangle error_reporting.php
 * @package    FFangle
 * @todo       Optimize: verify documentation
 * @todo       Optimize: move error log
 */

/* error_reporting values
1 	 E_ERROR
2 	E_WARNING
4 	E_PARSE
8 	E_NOTICE
16 	E_CORE_ERROR
32 	E_CORE_WARNING
64 	E_COMPILE_ERROR
128 	E_COMPILE_WARNING
256 	E_USER_ERROR
512 	E_USER_WARNING
1024 	E_USER_NOTICE
2048 	E_STRICT
4096 	E_RECOVERABLE_ERROR
6143 	E_ALL
*/

if (ENVIRONMENT == "DEVELOPMENT") {
	error_reporting(E_ALL | E_NOTICE | E_STRICT);
	ini_set("display_startup_errors","On");
	ini_set('display_errors','On');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', SITEROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
}
//echo error_reporting();

//enable <?= and <? style tags
ini_set("short_open_tag",true);

ini_set("memory_limit","512M");
ini_set("max_execution_time","900");

if (ini_get('register_globals')) {
	$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
	foreach ($array as $value) {
		foreach ($GLOBALS[$value] as $key => $var) {
			if ($var === $GLOBALS[$key]) {
				unset($GLOBALS[$key]);
			}
		}
	}
}

