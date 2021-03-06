<?php
/**
 * Interface Observer
 * is used for Observing system events
 * @package    FFangle
 * @author     Original Author <PaulBHartzog@PaulBHartzog.org>
 * @copyright  2012 Paul B. Hartzog
 * @license    copyright 2012 Paul B. Hartzog
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 * @todo       Optimize: something was here
 */
interface Observer {
	/**
	 * update function for Observers
	 * @package    FFangle
	 * @param      Observable $observable the object to be observed
	 */
	function update(Observable $observable); 
}
