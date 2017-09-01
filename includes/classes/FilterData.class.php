<?php
/**
 * FilterData
 *
 * Class used to filter/clean any type of data
 *
 * @author	Felipe Velasco <felipevelasco@hotmail.com>
 */
 
abstract class FilterData {
	/** 
	 * Function to remove any characters not accepted by URLs
	 * @param string $url
	 * @return string $filter_url
	 */
	public static function filterUrl($url){
		$filtered_url = filter_var($url,FILTER_SANITIZE_URL);
		return $filtered_url;
	}
	
	/** 
	 * Function to remove any characters not accepted by a normal php string
	 * @param string $str
	 * @return string $filter_str
	 */
	public static function filterStr($str){
		$filtered_str = filter_var($str,FILTER_SANITIZE_STRING);
		return $filtered_str;
	}
	
	/* Here different kinds of filters can be added
	* int, float, etc
	*/
}