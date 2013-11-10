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
class NodeController extends Controller {

	/**
	 * @package    FFangle
	 */
	function __construct() {
		parent::__construct();
        $this->model = new NodeModel();
        $this->view = new NodeView($this);
	}

	/**
	 * view function for NodeController
	 * @package    FFangle
	 * @param    URI
	 */
	function view($route = NULL){
		// route has already been turned into controller/method/id
		//debug($route);
		$data = $this->model->read_by_id($route->id);
		//debug($data);
		//debug($this->view);
		$return[0] = $this->view->view($data);
		return $return;
	}
}

	/*
	public function view($request)
	{
		
		$page_response = new PageResponse($this->app_request, $this->language, $this->model);
		$this->title = $page_response->title;
	}
*/
