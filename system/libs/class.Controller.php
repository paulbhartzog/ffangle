<?php
/**
 * Class Controller
 * is used for building responses to requests
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    2.0.0
 * @since      File available since Release 2.0.0
 * @todo       Optimize:  /images into themes dir
 * @todo       Optimize: setup Response object by type
 * @todo       Optimize: setup Controllers per Request and Response
 * @todo       Optimize: verify documentation
 */
abstract class Controller {
	/*
	 * constructor
	 * @abstract
	*/
	public function __construct()  
	{ 
		//echo __CLASS__;
	} 
} 
?>