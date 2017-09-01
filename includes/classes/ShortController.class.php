<?php
/**
 * ShortController
 *
 * Class to control all url shortnening operations
 * Allows access to all functionality
 *
 * @author	Felipe Velasco <felipevelasco@hotmail.com>
 */
 
include 'includes/configure.php';
include 'includes/classes/Connection.class.php';
include 'includes/classes/FilterData.class.php';
include 'includes/classes/UrlShortner.class.php';
 
class ShortController{	
	public $short; // Allows access to all UrlShortner methods
	
	/**
	 * Class constructor
	 * 
	 */
	function __construct(){
		$this->short = new UrlShortner();
	}
}
?>