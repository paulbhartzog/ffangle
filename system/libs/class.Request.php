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
class Request {
	public $uri = NULL;
	public $domain = NULL;
	public $this_file = NULL;
	public $method = NULL;
	public $protocol = NULL;
	public $getvars = NULL;
	public $postvars = NULL;
	public $request_array =  array();
	public $controller = "node";
	public $crud = "READ";
	public $id = 0;
	public $action = "view";
	
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
		}

		/*
		GET	/node					display a list of all nodes
		GET	/node/add				return an HTML form for creating a new node
		GET	/node/[id]/view			display a specific node
		GET	/node/[id]/edit			return an HTML form for editing a node
		*/
		// request_array[0] will always be the controller, or use default
		if(count($this->request_array)>0){
			$this->controller = $this->request_array[0];
		} else {
			$this->controller = APPLICATION_DEFAULT_CONTROLLER;
		}

		// request_array[1] will either be the action or the id
		if(count($this->request_array)>1){
			if($this->request_array[1] == CREATE){
				$this->crud = "CREATE";
				$this->action = "create";
			} else {
				$this->id = $this->request_array[1];
				if(count($this->request_array)>2){
					$this->action = $this->request_array[2];
				}
			}
		}

		//var_dump($this);
	}
}
?>