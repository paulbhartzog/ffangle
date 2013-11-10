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
	public $is_valid_system_url = FALSE;

	/**
	 * constructor
	 * @package    FFangle
	 */
	public function __construct()  
	{
		// nothing for now
		//debug($this);
	}
	
	/**
	 * creates route object
	 * @package    FFangle
	 */
	public function do_route($request_array = NULL, $url = NULL){
		//debug($request_array);
		$controller = NULL;
		if(!empty($request_array[0])){
			$controller = $request_array[0];
			//debug("found in url: " . $controller);

			$controller_class = $controller . SYSTEM_CONTROLLER_SUFFIX;
			// if $request_array[0] matches an available controller then try it
			// the second parameter 'false' for class_exists tells it to NOT use the autoloader
			// which will generate errors if you try to use it here
			if(class_exists($controller_class, false)){
				//debug( 'found ' . $controller_class );
				$is_valid_system_url = TRUE;
				$this->controller = $controller;
				// if the controller exists and the url has more data
				// then find out if the url data matches a real method
				$method = NULL;
				if(!empty($request_array[1])){
					$method = $request_array[1];
					//debug("found in url: " . $method);
				} else {
					$method = $this->method;
				}
				$controller_instance = new $controller_class;
				//debug($controller_instance);
				if(method_exists($controller_instance, $method)){
					//debug( 'found ' . $controller_class . "." . $method);
					//debug($this->method);
					// if controller and method exist
					// then set route using id if exists on incoming url
					$id = NULL;
					if(!empty($request_array[2])){
						$id = $request_array[2];
						//debug("found in url: " . $id);
						if(is_numeric($id)){
							$this->id = (int)$id;
						} else {
							$this->do_clean_url($url);
						}
					} else {
						$id = $this->id;
					}
					//debug($this->id);
				} else {
					$this->do_clean_url($url);
				}
				$this->method = $method;
			} else {
				$this->do_clean_url($url);
			}

		} else {
			$controller = $this->controller;
		}
		//debug($this->controller);
		//debug($this);
		// we return the actual controller/method/id to use to fulfill the request
		// i.e. we have turned an url into a REAL route
		return $this;
	}
	
	/**
	 * creates route out of clean url
	 * @package    FFangle
	 */
	public function do_clean_url($url = NULL){
		$this->url = $url;
		// if url is something else then check the clean urls table
		// not implemented
		// use clean url model to talk to clean_urls in DB
		$db = new Database();
		//debug($db);
		$column = "url";
		$sql = "SELECT * from clean_urls WHERE $column = '" . $this->url . "'";
		//debug($sql);
		$result = $db->db_exec($sql);
		if(!empty($result)){
			//debug($result);
			$item_array = $result[0];
			//debug($item_array);
			$this->controller = $item_array["controller"];
			$this->method = $item_array["method"];
			$this->id = $item_array["item_id"];
		} else {
			// otherwise the proper route is to a 404 page
			$this->do_404();
		}
		debug($this);
		exit;
	}

	/**
	 * creates route out of clean url
	 * @package    FFangle
	 * @todo turn this into a view
	 */
	public function do_404(){
		/*
		if ($page_response->do_404 == TRUE) {
			$page_response = new PageResponse('/404.html', $this->language, $this->model);
			$actual_response = "/404.html";
		}
		*/
		$fake_404 = "404 bad url";
		echo $fake_404;
		exit;
	}

}

