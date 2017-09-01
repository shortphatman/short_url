<?php
/**
 * UrlShortner
 *
 * Class to perform all url shortning operations
 *
 * @author	Felipe Velasco <felipevelasco@hotmail.com>
 */

class UrlShortner{
	public $conn_obj; // Allows access to all DB Connection methods
	
	/**
	 * Class constructor
	 * 
	 */
	function __construct(){
		$this->conn_obj = new Connection();
	}
	
	/**
	 * Function to get all URLs from database
	 * 
	 * @return array $results -> returns all records from short_urls table
	 */
	public function getAllUrls(){
		$query = 'SELECT * FROM short_urls';
		$results = $this->conn_obj->dbQuery($query);
		return $results;
	}
	
	/**
	 * Function to check if short_url exists
	 *
	 * @param string $random_string -> random url string
	 * @return array of short url values if string exists, boolean false if it does not
	 */
	public function getShortUrl($random_string){
		$query = 'SELECT * FROM short_urls
					WHERE short_url = ?';
		$variable = array('s' => $random_string);
		$results = $this->conn_obj->dbQuery($query,$variable);
		if(is_array($results)){
			return $results;
		}else{
			return false;
		}
	}
	
	/**
	 * Function to keep track of the clicks on used on the short URL
	 *
	 * @param string $random_url -> random url string
	 */
	 public function updateClick($random_url){
		$query = "UPDATE short_urls
					SET clicks = clicks + 1
					WHERE short_url = ?";
		$this->conn_obj->dbQuery($query,array('s' => $random_url),false);
	 }
	
	/**
	 * Function to set the short url in the short_urls table
	 * date is set to now() and clicks is set to 0
	 */
	public function setNewShortUrl($random_string,$url){
		$query = 'INSERT INTO short_urls 
									(short_url,long_url,create_date)
									VALUES
									(?,?,now())';
		 $this->conn_obj->dbQuery($query,array('s1' => $random_string,'s2' => $url),false);
	}
	
	/**
	 * Function to create random url
	 *
	 * @param int $length -> optional parameter to set the size of the random string
	 * @return string randomString -> 6 letters and numbers to form the new URL
	 */
	 public function createRandomString($length = 6){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	 }
}


?>