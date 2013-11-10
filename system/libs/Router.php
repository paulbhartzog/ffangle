<?php
/**
 * Class Router
 * is used for building routes from request parts
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation
 */
class Router {

	// at present the only route is controller/action/id
	/*
	GET	/controller						display a list of all nodes
	GET	/controller/add					return an HTML form for creating a new node
	GET	/controller/view/[id]				display a specific node
	GET	/controller/edit/[id]				return an HTML form for editing a node
	GET	/controller/delete/[id]			return an HTML form for editing a node
	*/

	public $controller = APPLICATION_DEFAULT_CONTROLLER;
	public $method = APPLICATION_DEFAULT_METHOD;
	public $id = APPLICATION_DEFAULT_ID;
	public $crud = APPLICATION_DEFAULT_CRUD;

	/**
	 * constructor
	 * @package    FFangle
	 */
	public function __construct()  
	{
		// nothing for now
		//debug($this);
	}
	
	public function do_route($route = NULL){
		// if route[0] matches a controller then try it
		$controller = NULL;
		if(!empty($route[0])){
			$controller = $route[0];
			debug("found in url: " . $controller);
		} else {
			$controller = $this->controller;
		}
		$controller_class = $controller . SYSTEM_CONTROLLER_SUFFIX;
		// the second parameter 'false' for class_exists tells it to NOT use the autoloader
		// which will generate errors if you try to use it here
		if(class_exists($controller_class, false)){
			debug( 'found ' . $controller_class );
			$this->controller = $controller;
			// if the controller exists and the url has more data
			// then find out if the url data matches a real method
			$method = NULL;
			if(!empty($route[1])){
				$method = $route[1];
				debug("found in url: " . $method);
			} else {
				$method = $this->method;
			}
			$controller_instance = new $controller_class;
			//debug($controller_instance);
			if(method_exists($controller_instance, $method)){
				debug( 'found ' . $controller_class . "." . $method);
				//debug($this->method);
				// if controller and method exist
				// then set route using id if exists on incoming url
				$id = NULL;
				if(!empty($route[2])){
					$id = $route[2];
					debug("found in url: " . $id);
					$this->id = (int)$id;
				} else {
					$id = $this->id;
				}
				debug($this->id);
			}
			$this->method = $method;
		}
		debug($this->controller);
		// if url is something else then check the clean urls table
		// not implemented
		
		// otherwise the proper route is to a 404 page
		/*
		if ($page_response->do_404 == TRUE) {
			$page_response = new PageResponse('/404.html', $this->language, $this->model);
			$actual_response = "/404.html";
		}
		*/
		
		
		debug($this);
		
		// we return the actual controller/method/id to use to fulfill the request
		// i.e. we have turned an url into a REAL route
		return $this;
	}

}

