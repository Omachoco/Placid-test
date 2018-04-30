<?php

require_once("database.php");

 class DatabaseObject{
	 
	  public static function find_all(){
		return static::find_by_sql("SELECT * FROM ".static::$table_name);
		}
		
	
	  public static function get_count(){
		return static::find_by_sql("SELECT MAX(student_id) AS max FROM ".static::$table_name);
		}
			
	/// to get select multi-select subjects from daatabase	    
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    return $result_set;
	}
    
  
  
	 
   public static function find_all_arr(){
		return static::find_by_sql_arr("SELECT * FROM ".static::$table_name);
		}
		
		
		
		
	public static function find_by_sql_arr($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = static::instantiate($row);
    }
    return $object_array;
  }

  
  
    public static function find_by_id_arr($id=0) {
    $result_array = static::find_by_sql_arr("SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
		
		      
		
		
   private static function instantiate($record) {
		// Could check that $record exists and is an array
 //$object = new static;
	$call_class = get_called_class();
	$object = new $call_class;
		
	
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	
	private function has_attribute($attribute) {
	  $object_vars = get_object_vars($this);
	
	  return array_key_exists($attribute, $object_vars);
	}	  

	 }

?>