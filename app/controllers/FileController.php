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
	 * view function for FileController
	 * @package    FFangle
	 * @param    URI
	 * @todo     Optimize: add error page defaults
	 * @todo     Optimize: remove app_request
	 */
	function view($request = NULL){
		//debug($request);
		//debug($request->request_array);
		$data = $this->model->read_by_name($request->request_array[1]);
		//debug($data);

		$this->app_request = $request->uri;
		$access_log = new LogAccess(LOG_ACCESS);
		$this->attach($access_log);
		$this->notify();

		// always include response type in returned array
		$data['type'] = $data[0]['type'];
		return $data;
	}
}
