<?php

class Session {
	private $logged_in=false;
	public $id;
	public $message;
	public $student_id;
	

	
	function __construct() {
		session_start();
		$this->check_login();
		$this->check_message();
    if($this->logged_in) {
      // actions to take right away if user is logged in
    } else {
      // actions to take right away if user is not logged in
    }
	}
	
	
	
  public function is_logged_in_admin() {
    return $this->logged_in;
  }
  
  	
  public function is_logged_in_student() {
    return $this->logged_in;
  }
  
	public function login($user) {
    // database should find user based on username/password
    if($user){
     $_SESSION['user']= array();
	 $this->id = $_SESSION['user']['id'] = $user->id;
	$this->student_id= $_SESSION['user']['student_id'] = $user->student_id;
	
      $this->logged_in = true;
    }
  }
  
  public function get_studentId(){
	  if($this->student_id){
	  return $this->student_id;
	  }
  }
  
  public function logout() {
    unset($_SESSION['user']);
    session_destroy($_SESSION['user']);
    unset($this->id);
    $this->logged_in = false;
  }


	private function check_login() {
    if(isset($_SESSION['user']['id'])) {
      $this->id = $_SESSION['user']['id'];
      $this->logged_in = true;
    } else {
      unset($this->id);
      $this->logged_in = false;
    }
  }
  
  
	public function message($msg="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	  } else {
	    // then this is "get message"
			return $this->message;
	  }
	}
  
  function check_message(){
	  // Is there a message stored in the session?
		if(isset($_SESSION['message'])) {
			// Add it as an attribute and erase the stored version
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
    }
	  
	  }
}

$session = new Session();
$message = $session->message();
?>

