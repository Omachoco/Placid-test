<?php 
 require_once("database.php");
require_once("database_object.php");

class Student extends DatabaseObject{
	protected static $table_name = "student";
  
		
	public $id;
	public $student_id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	
	
   public static function makestudent($student_id, $username, $password, $first_name, $last_name){  
    if (  !empty($username) && !empty($password) && !empty($first_name) && !empty($last_name)) {
		$student = new Student();
		$student->student_id = $student_id;
	    $student->username = $username;
	    $student->password = $password;
	    $student->first_name = $first_name;
	    $student->last_name = $last_name;
		
		return $student;
		} else {
			return false;
		}
	}
		

		
 	public function create() {
		global $database;
		
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= "student_id ,username, password, first_name, last_name";
	  $sql .= ") VALUES ('";
	  $sql .= $database->escape_value($this->student_id) ."', '";
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
		

	
	
  public static function authenticate($username="", $password="") {
    global $database;
    $username = $database->escape_value($username);
    $password = $database->escape_value($password);

    $sql  = "SELECT * FROM student ";
    $sql .= "WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self:: find_by_sql_arr($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	
			
   public function full_name() {
       if(isset($this->first_name) && isset($this->last_name)) {
         return $this->first_name . " " . $this->last_name;
           } else {
         return "";
         }
	}
	
	public static function prep_statement($sql="", $student_id, $username, $password, $first_name, $last_name, $subject_name){
    global $database;
	
	return $database->prep_statement_sql($sql, $student_id, $username, $password, $first_name, $last_name, $subject_name);
	 
	
	}
	

	
 }
  
  

         
?>