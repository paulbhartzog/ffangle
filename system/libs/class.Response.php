<?php
/**
 * Class Response
 * is used for responses
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation
 */
class Response {
    /**
	 * HTTP status code
     * @var status int
     */
    protected $status;

    /**
	 * HTTP response body
     * @var body string
     */
    protected $body;

    /**
	 * HTTP response codes
     * @var response_code array
     */
    protected static $response_codes = array(
        //Informational 1xx
        100 => '100 Continue',
        101 => '101 Switching Protocols',
        //Successful 2xx
        200 => '200 OK',
        201 => '201 Created',
        202 => '202 Accepted',
        203 => '203 Non-Authoritative Information',
        204 => '204 No Content',
        205 => '205 Reset Content',
        206 => '206 Partial Content',
        //Redirection 3xx
        300 => '300 Multiple Choices',
        301 => '301 Moved Permanently',
        302 => '302 Found',
        303 => '303 See Other',
        304 => '304 Not Modified',
        305 => '305 Use Proxy',
        306 => '306 (Unused)',
        307 => '307 Temporary Redirect',
        //Client Error 4xx
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        402 => '402 Payment Required',
        403 => '403 Forbidden',
        404 => '404 Not Found',
        405 => '405 Method Not Allowed',
        406 => '406 Not Acceptable',
        407 => '407 Proxy Authentication Required',
        408 => '408 Request Timeout',
        409 => '409 Conflict',
        410 => '410 Gone',
        411 => '411 Length Required',
        412 => '412 Precondition Failed',
        413 => '413 Request Entity Too Large',
        414 => '414 Request-URI Too Long',
        415 => '415 Unsupported Media Type',
        416 => '416 Requested Range Not Satisfiable',
        417 => '417 Expectation Failed',
        422 => '422 Unprocessable Entity',
        423 => '423 Locked',
        //Server Error 5xx
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
        505 => '505 HTTP Version Not Supported'
    );

	/**
	 * Constructor
	 * @param   string             $response_body       The HTTP response body
	 * @param   int                $status     The HTTP response status
	 * @todo    Optimize: extend to other headers and responses
	*/
	public function __construct($response = NULL, $type = "html") {
		if($type=="html"){
			$this->HTTP_Response($response);
		}
		if($type=="pdf"){
			$this->PDF_Response($response);
		}
	}

	function HTTP_Response($response, $status = 200){
		// status will always be 200 within the web application
		// other statuses are handled by the web server, not this application
		if($status==200){
			// start output buffering
			ob_start();
			echo $response[0];
			// end output buffering
			$response = ob_get_clean();
			echo $response;
		}
	}
	
	function PDF_Response($data){
		$file_name = $data[0]['name'];
		$file = APPLICATION_FILE_DIR . DS . $file_name;
		//var_dump($file);
		header('Content-type: application/pdf');
		header('Content-Length: ' . filesize($file));
		readfile($file);
	}

}