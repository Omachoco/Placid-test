<?php 
 require_once("database.php");
require_once("database_object.php");

class Subject extends DatabaseObject{
	protected static $table_name = "subject";

	public $id;
	public $subject_name;
	
	
   public static function makesubject($subject_name){  
    if(!empty($subject_name)) {
		$subject = new Subject();
	     $subject->subject_name =  $subject_name;
		return $subject;
		} else {
			return false;
		}
	}
	

	
  public function create() {
		global $database;
	
	  $sql = "INSERT INTO ".self::$table_name." (";
		$sql .= "subject_name";
	  $sql .= ") VALUES ('";
		$sql .= $database->escape_value($this->subject_name) ."')";
	  if($database->query($sql)) {
	    $this->id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

  
	  public static function find_all(){
		return self::find_by_sql("SELECT * FROM subject");
		}
		
	
    public static function find_student_subjects_by_student_id_arr($student_id=0) {
    return self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE student_id={$student_id} ");
	
  }		

public static function prep_statement($sql="", $student_id, $subject_name) {
    global $database;
	if($database->prep_statement_sql($sql, $student_id, $subject_name) && mysqli_affected_rows($database->get_connection()) > 0){
	return true;
	}else{
		return false;
		}
		
    }



}
		
	
	

?>