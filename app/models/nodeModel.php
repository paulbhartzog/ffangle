<?php
/**
 * Class NodeModel
 * is used for responding to data requests from the controller
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: verify documentation
 */
class NodeModel extends Model {
	
	/**
	 * database
	 * @package    FFangle
	 */
	private $db;

	/**
	 * data
	 * @package    FFangle
	 */
	public $data;
	
	/**
	 * table
	 * @package    FFangle
	 */
	public $table =  "nodes";
	
	/**
	 * constructor
	 * @package    FFangle
	 */
	public function __construct(){
		$this->db = new Database();
	}
	
	/**
	 * @package    FFangle
	 */
	public function read($url = 'node/0'){
		$this->data = $this->db->db_fetch_array("SELECT * FROM $this->table");
		//var_dump($this->data);
		return $this->data;
	}

}
?>
