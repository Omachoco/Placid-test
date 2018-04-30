
<?php 
require_once("../../includes/session.php");
require_once("../../includes/functions.php");
require_once("../../includes/student.php");
require_once("../../includes/subject.php");
require_once("../../includes/database.php");
require_once("../../includes/functions.php");
require_once("../../includes/database_object.php");

if (!$session->is_logged_in_admin()){
	redirect_to("adminlogin.php");
	}

   $total_student = Student::get_count();
   $stdn = mysqli_fetch_array($total_student);
  $student_id = $stdn['max'] + 1;
  
 
  
  $form_errors = array();
  $passmin_len = (int)2;

 
if (isset($_POST['submit'])){		
  $username =  trim($_POST['username']);
  $password =  trim($_POST['password']);
  $first_name =  trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
	  
 
   $subjects = ( $_POST['subjects']);
/// input validations	
   if(!subj_arr_validate($subjects)){
		
	 $form_errors[] = "Select atleast a subject";
	    }

   if(!through_value($username)){
	 $form_errors[$username] = "Input username";
   }
		
   if(!through_value($first_name)){
	    $form_errors[$first_name] = "Input first name";
	     }
		 	 
    if(!through_value($last_name)){
       $form_errors[$last_name] = "Input last name";
	    }


 if(empty($form_errors)){
	 
   
	 foreach($subjects as $subject_name ){

		 
      $sql = "INSERT INTO student(student_id, username, password, first_name, last_name, subject_name) VALUES (?, ?, ?, ?, ?, ?)"; 
	  
	$newstudent = Student::prep_statement($sql, $student_id, $username,               $password, $first_name, $last_name, $subject_name);
	  
	
	 }
	 
	  if($newstudent){
	   $_SESSION['message'] = "New student Added.";
		  redirect_to("index.php");
		  }else{  $_SESSION['message'] = "Creating new student was not successful";}
	
	}
		 

 }
  


	?>
    
 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href= "../../bower_components/bootstrap/dist/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="../../bower_components/multiselect/css/multi-select.css">
<link rel="stylesheet" href="../css/main.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Placid College</title>
</head>

<body>
<header id="mainheader">
  <h1> Placid College Admin </h1>
 </header>
<h3 class=" offset-11"><a href="logout.php">logout</a></h3>

<p> <?php echo $message; ?></p>

<div class="dipaly_errors"> <?php echo form_errors($form_errors); ?></div>
<div class="new_student_form">

  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		  <table class="student_table">
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="40" value="<?php echo $username = "";?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="40" value="<?php echo $password = "";?>" />
		      </td>
		    </tr>
                <tr>
		      <td>First_name:</td>
		      <td>
		        <input type="text" name="first_name" maxlength="30" value="" />
		      </td>
		    </tr>
                <tr>
		      <td>Last_name</td>
		      <td>
		        <input type="text" name="last_name" maxlength="30" value="" />
                </td>
		    </tr>
		    
		    <tr>
             <td>Subjects:</td>
            <td>
     <select id='subjects' multiple='multiple' name="subjects[]">
 
   
  <?php 
$subjects = Subject::find_all();
while ($subject = $database->fetch_array($subjects)){
$subs = $subject['subject_name'];
	echo "<option value='{$subs}'>{$subs}</option>";
}
?>
  
</select>
		      </td>
		    </tr>
            <br />
             <tr>
             <td></td>
		      <td colspan="4">
		        <input type="submit" name="submit" value="Create" />
		      </td>
		    </tr>
    
		  </table>
		</form>
        
</div>
        <div>
        <h5> <a href="newadmin.php">Add New Admin</a></h5>
        <h5><a href="newsubject.php">Add New Subject</a></h5>
        </div>
    
<?Php if(isset($database)){$database->close_connection();}?>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../bower_components/multiselect/js/jquery.multi-select.js"></script>

<script type = "text/javascript">
   $(document).ready(function(){
  $('#subjects').multiSelect();
 // $('#subjects').multiSelect('select', String|Array);
  //$('#subjects').multiSelect('deselect', String|Array);
});
</script>

</body>
</html>