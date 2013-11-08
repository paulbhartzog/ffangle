<?php
/**
 * Class FileController
 * parses requests and tries to respond
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation and implementation
 */
class FileController extends Controller implements Observable {

	/**
	 * @package    FFangle
	 */
	function __construct() {
		parent::__construct();
		$this->model = new FileModel();
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
	 * render function for PageController
	 * @package    FFangle
	 * @param    URI
	 * @todo     Optimize: add error page defaults
	 */
	function render($request = NULL){
		//var_dump($request);
		//var_dump($request->request_array);
		$data = $this->model->read_by_name($request->request_array[1]);
		//var_dump($data);

		$this->app_request = $request->uri;
		$syslog = new LogSystem(LOG_SYSTEM);
		$this->attach($syslog);
		$this->notify();

		// always include response type in returned array
		$data['type'] = $data[0]['type'];
		return $data;
	}
}
