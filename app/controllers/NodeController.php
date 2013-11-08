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
	 * @package    FFangle
	 */
	function __construct() {
		parent::__construct();
        $this->model = new NodeModel();
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
	 * @todo     Optimize: this should be in a VIEW
	 */
	function render($request = NULL){
		$this->app_request = $request->uri;
		$return = $this->model->read();

		$syslog = new LogSystem(LOG_SYSTEM);
		$this->attach($syslog);
		$this->notify();

		var_dump($return);
		echo "have data, process with templates/views here\n\n";
		return $return;
	}
}
?>
<?php
	/*
	public function render($request)
	{
		
		$page_response = new PageResponse($this->app_request, $this->language, $this->model);
		if (!isset($this->data)) $this->data = $page_response->data;
		$actual_response = $this->app_request;

		if ($page_response->do_404 == TRUE) {
			$page_response = new PageResponse('/404.html', $this->language, $this->model);
			$actual_response = "/404.html";
		}
		$this->title = $page_response->title;
		require_once DEFAULT_THEME_DIR . 'views/default.php';
		
		// logs
		$syslog = new LogSystem(LOG_SYSTEM);
		$devlog = new LogDevelopment(LOG_DEVELOPMENT);
		$this->attach($syslog);
		$this->attach($devlog);

		return $output;
	}
*/
?>