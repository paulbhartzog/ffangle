<?php
/**
 * Interface Observer
 * is used for Observing system events
 * @package    Site
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    2.0.0
 * @since      File available since Release 2.0.0
 * @todo       Optimize: something was here
 */
interface Observer { 
	function update(Observable $observable); 
}
?>
