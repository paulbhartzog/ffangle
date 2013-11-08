<?php
/**
 * Class Database
 * is used for database functions
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: rewrite Database class into proper functions
 * @todo       Optimize: verify documentation
 */
class Database {

	/**
	 * @package    FFangle
	 */
	private $database_handle = '';

	/**
	 * @package    FFangle
	 */
	private $statement_handle = '';
	
	/**
	 * @package    FFangle
	 * @todo       log db errors
	 */
	function __construct(){
		$host = DB_HOST;
		$dbname = DB_NAME;
		$user = DB_LOGIN;
		$pass = DB_PASSWORD;
		try {
			$this->database_handle = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
			$this->database_handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			echo $e->getMessage();
			//some_logging_function($ex->getMessage());
		}
	}

	/**
	 * @package    FFangle
	 */
	function db_close()	{
		$this->database_handle = NULL;
	}

	/**
	 * @package    FFangle
	 */
	function test() {
		return "Database class is accessible.";
	}
	
	/**
	 * @package    FFangle
	 * @params    sql to execute
	 * @todo       log db errors
	 */
	// this function is only for testing, DO NOT USE IN PRODUCTION
	function db_exec($sql){
		try {
			$this->statement_handle = $this->database_handle->prepare($sql);
			$this->statement_handle->execute();
			// assoc
			$result = $this->statement_handle->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			$this->db_close();
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
			//some_logging_function($ex->getMessage());
		}
	}

	/**
	 * @package    FFangle
	 * @params    sql to execute
	 * @todo       log db errors
	 */
	// this function is only for testing, DO NOT USE IN PRODUCTION
	function db_fetch_array($sql,$params = NULL){
		try {
			$this->statement_handle = $this->database_handle->prepare($sql);
			$this->statement_handle->execute();
			// assoc
			$result = $this->statement_handle->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			$this->db_close();
		} catch(PDOException $e) {
		    echo 'ERROR: ' . $e->getMessage();
			//some_logging_function($ex->getMessage());
		}
	}

}

?>
