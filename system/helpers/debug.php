<?php
/**
 * File level comments for FFangle debug.php
 * @todo       Optimize: verify documentation
*/

/**
 * debug
 * this function outputs debug statements ONLY in DEVELOPMENT mode
 * @package    FFangle
 */
function debug($incoming){
	if(APPLICATION_ENVIRONMENT=="DEVELOPMENT"){
		var_dump($incoming);
	}
}
