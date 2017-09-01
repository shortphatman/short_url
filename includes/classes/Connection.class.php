<?php
/**
 * Connection
 *
 * Class used to create DB connection and perform CRUD operations
 *
 * @author	Felipe Velasco <felipevelasco@hotmail.com>
 */

class Connection{
	private $conn; // Connection object can only be access through the class
	private $prep_stmt; // variable that holds prepared statement result
	private $type_arr = array( // possible types for mysql variables
								'i', //integer
								'd', //double
								's', //string
								'b'); //blob
	
	/**
	 * Instantiating the class will create a mysql connection
	 * Variables can be changed in config file
	 */
	function __construct(){
		$this->conn = new mysqli(HOST, DBUSER, DBPASSWORD, DATABASE);
		if (mysqli_connect_errno($this->conn)) {
			die("Failed to connect to MySQL: (" . $this->conn->connect_errno . ") " . mysqli_connect_error());
		}
	}
	
	/**
	 * function to perform a database query
	 * will work with all CRUD queries
	 * has prepared statements to avoid sql injection
	 * 
	 * @param string $query -> query to be used (? used as variable placeholder)
	 * @param array $variable -> array used to hold values on of variables and type in the query
	 * @param boolean $select -> lets function know if this is a select statement and a return variable is necessary
	 * @return array $query_arr -> only returns array of results if the query is a select statement
	 */
	public function dbQuery($query,$variable = array(),$select = true){
		/* Using prepared statments with bound variables to prevent SQL injection */
		$this->dbPrepare($query);
		/* Bind and execute the query */
		$this->dbBindExecute($query,$variable);
		$query_rsc = $this->prep_stmt->get_result();
		// If query is a select statement then return array of results
		if($select){
			if(!$query_rsc){
				die("Failed to run query: (" . $this->conn->errno . ") " . $this->conn->error);
			}else{
				while($row = $query_rsc->fetch_assoc()){
					$query_arr[] = $row;
				}
				if(empty($query_arr)){
					return false;
				}else{
					return $query_arr;
				}				
			}
		}
	}
	
	/**
	 * Function to prepare query for binding and execution
	 * dies if there is an issue witht he prepared statments
	 * sets class statement object $prep_stmt
	 */
	private function dbPrepare($query){
		$this->prep_stmt = $this->conn->prepare($query);
		if(!($this->prep_stmt)){
			die("Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error);
		}
	}
	
	/**
	 * Function to bind and execute query
	 * used to avoid sql injection
	 * makes sure query is ready to run in function dbQuery
	 *
	 * @param string $query -> query to be used with ? as a wildcard variable
	 * @param array $variable -> holds type of variable and value 
	 */
	private function dbBindExecute($query,$variable){
		// If there are varibles in the query then bind them before executing
		if(!empty($variable)){
			$type_string = '';
			$vars_string = '';
			foreach($variable as $type=>$value){
				$no_num_type = preg_replace('/[0-9]+/', '', $type);
				if(!in_array($no_num_type,$this->type_arr)){
					die('Wrong type given for variable in query');
				}else{
					$type_string .= $no_num_type;
					$vars_string .= ',$variable["' . $type . '"]';					
				}
			}
			$bind_string = '$this->prep_stmt->bind_param("' . $type_string . '"' . $vars_string . ');';
			eval($bind_string);
		}
		// Execute the query or die on error
		if(!$this->prep_stmt->execute()){
			die("Execute failed: (" . $this->prep_stmt->errno . ") " . $this->prep_stmt->error);
		}		
	}	
}
?>