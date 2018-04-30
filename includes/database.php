<?php
  require_once("db_cridentials.php"); 

  
 class MySQLDatabase{
	private $connection;
  
  function __construct() {
    $this->open_connection();
  }
  
  
  public function get_connection(){
	  return $this->connection;
	  }
  
   public function open_connection() {
  $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS,          DB_NAME);
    if(mysqli_connect_errno()) {
      die("Database connection failed: " . 
           mysqli_connect_error() . 
           " (" . mysqli_connect_errno() . ")"
      );
    }
  }
  
   
  public function close_connection() {
    if(isset($this->connection)) {
      mysqli_close($this->connection);
      unset($this->connection);
    }
  }
 
 
 
  public function query($sql) {
    $result = mysqli_query($this->connection, $sql);
    $this->confirm_query($result);
    return $result;
  }
  
  public function prep_statement_sql($sql, $student_id, $username, $password, $first_name, $last_name, $subject_name){
	  if($stmt = mysqli_prepare($this->connection, $sql)){
		  mysqli_stmt_bind_param($stmt, "isssss", $student_id,  $username, $password, $first_name,  $last_name, $subject_name);
		  return mysqli_stmt_execute($stmt);
		  }else{
			  echo "ERROR: could not prepare query: $sql. " . mysqli_error($this->connection);
			  }
	  }
  
  private function confirm_query($result) {
  	if (!$result) {
  		die("Database query failed.");
  	}
  }
  
  
  public function escape_value($string) {
    $escaped_string = mysqli_real_escape_string($this->connection, $string);
    return $escaped_string;
  }
  
  
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }
  
   public function insert_id() {
    // get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }
  
  

  
  }
  
  
 $database = new MySQLDatabase();
?>