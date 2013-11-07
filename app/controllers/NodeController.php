<?php
/**
 * Class NodeController
 * parses requests and tries to respond
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation and implementation
 */
class NodeController extends Controller implements Observable {
	/**
	 * constructor for AppController
	 */
	function __construct() {
		parent::__construct();
	}

	function attach(Observer $observer) { 
		$this->observers[] = $observer; 
	} 
	function detach(Observer $observer) { 
		$newobservers = array(); 
		foreach ($this->observers as $obs) { 
			if (($obs !== $observer)) { 
				$newobservers[] = $obs; 
			} 
		} 
		$this->observers = $newobservers; 
	} 
	function notify() { 
		foreach ($this->observers as $observer) { 
			$observer->update($this); 
		} 
	}
	
	function render($id = NULL){
		return "node data from node model id " . $id . " here";
	}
}
?>