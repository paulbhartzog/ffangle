<?php
/**
 * Class Model
 * abstract class available for extension by other model classes
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation
 */
abstract class Model {
	
	/**
	 * @package    FFangle
	 */
	public function __construct(){
		// ?
	}

	/**
	 * @package    FFangle
	 */
	public function create(){
		return "create Model Data";
	}	

	/**
	 * @package    FFangle
	 */
	public function read(){
		return "read Model Data";
	}	

	/**
	 * @package    FFangle
	 */
	public function update(){
		return "update Model Data";
	}	

	/**
	 * @package    FFangle
	 */
	public function delete(){
		return "delete Model Data";
	}	

}