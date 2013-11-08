<?php
/**
 * Class NodeView
 * parses requests and tries to respond
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation and implementation
 */
class NodeView extends View implements Observable {

	/**
	 * @package    FFangle
	 */
	function __construct($controller) {
		parent::__construct();
		$this->controller = $controller;
	}

	/**
	 * @package    FFangle
	 */
	function attach(Observer $observer) { 
		$this->observers[] = $observer; 
	} 

	/**
	 * @package    FFangle
	 */
	function detach(Observer $observer) { 
		$newobservers = array(); 
		foreach ($this->observers as $obs) { 
			if (($obs !== $observer)) { 
				$newobservers[] = $obs; 
			} 
		} 
		$this->observers = $newobservers; 
	} 

	/**
	 * @package    FFangle
	 */
	function notify() { 
		foreach ($this->observers as $observer) { 
			$observer->update($this); 
		} 
	}
	
	/**
	 * @package    FFangle
	 */
	function render($data) { 
		$template_name = $data[0]['data'];
		//var_dump($template_name);
		$template = DEFAULT_THEME_DIR . DS . $template_name . ".php";
		ob_start();
		//$return = file_get_contents($template);
		require_once($template);
		$return = ob_get_clean();
		return $return;
	}
	


}
