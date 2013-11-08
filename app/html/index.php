<?php
/**
 * File level comments for FFangle index.php
 * 
 * @todo       Optimize: verify documentation
*/

/* ------------------------------------------------------------------------------------------------- */
// start session
/* ------------------------------------------------------------------------------------------------- */
session_start();

/* ------------------------------------------------------------------------------------------------- */
// without a config file we can't do anything
/* ------------------------------------------------------------------------------------------------- */

/**
 * @package    FFangle
 */
define('DS', DIRECTORY_SEPARATOR);

/**
 * @package    FFangle
 */
define('APP_DIR', dirname(dirname(__FILE__)));

/**
 * @package    FFangle
 */
define('APP_CONFIG_DIR', APP_DIR . DS . 'config');

/**
 * @package    FFangle
 */
define('APP_CONFIG_FILE', APP_CONFIG_DIR . DS . 'config.php');

require_once APP_CONFIG_FILE;

/* ------------------------------------------------------------------------------------------------- */
// bootstrap the system
/* ------------------------------------------------------------------------------------------------- */

require_once SYSTEM_CORE_FILE;
//var_dump(get_defined_constants());


/* ------------------------------------------------------------------------------------------------- */
// call Request object to handle the incoming request
/* ------------------------------------------------------------------------------------------------- */

$request = new Request();
//var_dump($request);

// look for request match in routes db or file
// so that urls don't have to match actual controller names
// if using clean urls, also use matching

/* ------------------------------------------------------------------------------------------------- */
// Application handles request into response
/* ------------------------------------------------------------------------------------------------- */

$controller_name = ucwords($request->controller . "Controller");
$controller = new $controller_name;

$response = '<head>
<link rel="shortcut icon" href="/2013_code/2013_ffangle/html/images/favicon.png" type="image/x-icon" />
</head>' . "\n\n";

$response .= $controller->render($request);


/* ------------------------------------------------------------------------------------------------- */
// call Response object to handle the outgoing response (includes output buffer)
/* ------------------------------------------------------------------------------------------------- */

new Response($response);

?>