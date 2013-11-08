<?php
/**
 * Class LogSystem
 * implements Observer
 * is used for logging observed events
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: add useragent
 */
class LogSystem implements Observer {
	private $log_file;

	/**
	 * initializer for LogSystem
	 * @param      logfile
	 */
	function __construct($logfile) {
		$this->log_file = $logfile;
	}

	/**
	 * is used for logging observed events
	 * @param      Observable $observable describe me
	 */
	function update(Observable $observable) {
		if (is_writable($this->log_file)) {
			if (!$handle = fopen($this->log_file, 'a')) {
				echo "Cannot open log file ($this->log_file)";
				exit;
			}
/*
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				//check ip from share internet{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				//to check ip is pass from proxy{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
			$requestor_formatted = $ip;
			$requestor_formatted = $_SERVER['REMOTE_ADDR'];
*/
			$request_method_formatted = $_SERVER['REQUEST_METHOD'];
			$server_protocol_formatted = $_SERVER['SERVER_PROTOCOL'];
			$requested_url = $observable->app_request;
			$request_formatted = $request_method_formatted . " " . $requested_url . " " . $server_protocol_formatted;
			$now_formatted = strftime('%d/%b/%Y:%H:%M:%S %z');
			$useragent = "";
			$status = "200"; // will always be 200 for a web app like this

			$log_entry = "[" . $now_formatted . "] \"" . $request_formatted . "\" " . $status . "\r\n";

			//write
			if (fwrite($handle, $log_entry) === FALSE) {
				echo "Cannot write to file ($this->log_file)";
				exit;
			}
			fclose($handle);
		}
	}
	
}
?>
