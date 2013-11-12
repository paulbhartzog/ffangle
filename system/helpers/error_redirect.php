<?php
/**
 * File level comments for FFangle error_redirect.php
 * @todo       Optimize: verify documentation
*/

/**
 * debug
 * this function uses HTTP redirect method for error page
 * @package    FFangle
 */
function error_redirect(){
	if(APPLICATION_REDIRECTS_ENABLED){
		header("Location: " . APPLICATION_DEFAULT_ERROR_KEY);
	} else {
		debug(APPLICATION_DEFAULT_ERROR_KEY);
	}
	exit;
}
