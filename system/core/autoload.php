<?php
/**
 * File level comments for FFangle autoload.php
 * @todo       Optimize: verify documentation
*/

/* ------------------------------------------------------------------------------------------------- */
// autoloader
/* ------------------------------------------------------------------------------------------------- */
/**
 * Autoloader
 * @package    FFangle
 * @param      the class to be autoloaded
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function __autoload($class) {
	$class_file = SYSTEM_LIB_DIR . DS . "class." . $class . SYSTEM_PHP_FILE_EXTENSION;
    if(file_exists($class_file)) {
	    require_once $class_file;
    } else {
		$interface_file = SYSTEM_LIB_DIR . DS . "interface." . $class . SYSTEM_PHP_FILE_EXTENSION;
	    require_once $interface_file;
	}
}


/**
 * autoload all system libs
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadSystemLibs() {
	$libs_array = array();
	if ($handle = opendir(SYSTEM_LIB_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once SYSTEM_LIB_DIR . DS . $file;
				array_push($libs_array, $file);
			}
		}
		closedir($handle);
		//debug($libs_array);
	}
}

/**
 * autoload all system helpers
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadSystemHelpers() {
	$helpers_array = array();
	if ($handle = opendir(SYSTEM_HELPER_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once SYSTEM_HELPER_DIR . DS . $file;
				array_push($helpers_array, $file);
			}
		}
		closedir($handle);
		//debug($helpers_array);
	}
}


/**
 * autoload all application libs
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadApplicationLibs() {
	$libs_array = array();
	if ($handle = opendir(APPLICATION_LIB_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once APPLICATION_LIB_DIR . DS . $file;
				array_push($libs_array, $file);
			}
		}
		closedir($handle);
		//debug($libs_array);
	}
}


/**
 * autoload all application helpers
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadApplicationHelpers() {
	$helpers_array = array();
	if ($handle = opendir(APPLICATION_HELPER_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once APPLICATION_HELPER_DIR . DS . $file;
				array_push($helpers_array, $file);
			}
		}
		closedir($handle);
		//debug($helpers_array);
	}
}


/**
 * autoload all application controllers
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadApplicationControllers($controller_names_array = NULL){
	$controllers_array = array();
	if ($handle = opendir(APPLICATION_CONTROLLER_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once APPLICATION_CONTROLLER_DIR . DS . $file;
				array_push($controllers_array, $file);
			}
		}
		closedir($handle);
		//debug($controllers_array);
	}
}


/**
 * autoload all application models
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadApplicationModels(){
	$models_array = array();
	if ($handle = opendir(APPLICATION_MODEL_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once APPLICATION_MODEL_DIR . DS . $file;
				array_push($models_array, $file);
			}
		}
		closedir($handle);
		//debug($models_array);
	}
}

/**
 * autoload all application views
 * @package    FFangle
 * @todo       Optimize: change this into spl_autoload_register() http://php.net/manual/en/function.spl-autoload-register.php
 */
function autoloadApplicationViews(){
	$views_array = array();
	if ($handle = opendir(APPLICATION_VIEW_DIR)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				require_once APPLICATION_VIEW_DIR . DS . $file;
				array_push($views_array, $file);
			}
		}
		closedir($handle);
		//debug($views_array);
	}
}

autoloadSystemLibs();
autoloadSystemHelpers();
autoloadApplicationLibs();
autoloadApplicationHelpers();
autoloadApplicationControllers();
autoloadApplicationModels();
autoloadApplicationViews();

