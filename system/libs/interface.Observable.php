<?php
/**
 * Interface Observable
 * is used for making objects Observable
 * i.e. they can have Observers attached to them
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    2.0.0
 * @since      File available since Release 2.0.0
 * @todo       Optimize: verify documentation
 */
interface Observable { 
	function attach(Observer $observer); 
	function detach(Observer $observer); 
	function notify(); 
}
?>
