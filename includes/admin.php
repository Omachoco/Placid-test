<?php


require_once("database.php");
require_once("database_object.php");




class Admin extends DatabaseObject{
	protected static $table_name = "admins";
    
		
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	
	
  public static function authenticate($username="", $password="") {
    global $database;
    $username = $database->escape_value($username);
    $password = $database->escape_value($password);

    $sql  = "SELECT * FROM admins ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self:: find_by_sql_arr($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	   public static function makeadmin($username, $password, $first_name, $last_name){  
    if (  !empty($username) && !empty($password) && !empty($first_name) && !empty($last_name)) {
		$admin = new Admin();
	    $admin->username = $username;
	    $admin->password = $password;
	    $admin->first_name = $first_name;
	    $admin->last_name = $last_name;
		
		return $admin;
		} else {
			return false;
		}
	}
	
	
	public function create() {
		global $database;
	
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= "username, password, first_name, last_name";
	  $sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->username) ."', '";
		$sql .= $database->escape_value($this->password) ."', '";
		$sql .= $database->escape_value($this->first_name) ."', '";
		$sql .= $database->escape_value($this->last_name) ."')";
		
	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	
	}
		
	
}

?>