<?php
/**
 * Class Request
 * is used for requests
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation
 * @todo       Optimize: improve QUERY_STRING and GET and POST handling
 * @todo       Optimize: scrub GET and POST vars
 */
class Request implements Observable {
	public $uri = NULL;
	public $domain = NULL;
	public $this_file = NULL;
	public $method = NULL;
	public $protocol = NULL;
	public $getvars = NULL;
	public $postvars = NULL;
	public $request_array =  array();
	
	/**
	 * @package    FFangle
	 * @todo     Optimize: remove app_request
	 */
	public function __construct(){
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->domain = $_SERVER['SERVER_NAME'];
		$this->this_file = $_SERVER['PHP_SELF'];
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->protocol = $_SERVER['SERVER_PROTOCOL'];

		// scrub this
		$this->getvars = $_GET;
		// scrub this
		$this->postvars = $_POST;

		if(!empty($this->getvars)){
			// remove slashes from beginning of getvars
			$uri_without_slashes = ltrim($this->getvars['url'], "/");
			// remove slashes from end of getvars
			$uri_without_slashes = rtrim($uri_without_slashes, "/");
			// load parts into array
			$this->request_array = explode("/", $uri_without_slashes);
		} else {
			$this->getvars['url'] = "";
		}
		//debug($this);

		// Request parses the url into parts
		// Request DOES NOT interpret those parts into a route
		// Routes does that
		$router = new Router();
		//debug($router);
		//debug($this->request_array);
		$this->route = $router->do_route($this->request_array, $this->getvars['url']);
		//debug($this->route);

		$this->app_request = $this->uri;
		$syslog = new LogSystem(LOG_SYSTEM);
		$this->attach($syslog);
		$this->notify();
		//debug($this);
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
	

}