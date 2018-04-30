<?php
require_once("../includes/database.php");
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/student.php");
require_once("../includes/subject.php");



?>
<?php
if (!$session->is_logged_in_student()){
	redirect_to("login.php");
	
		}
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<title>Placid College</title>
</head>

<body class=" h-100">
<header>


<nav class="navbar navbar-expand-lg navbar-light bg-danger text-light">
  <a class="navbar-brand" href="#"><span class="text-white">Placid College</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Tour</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Courses</a>
      </li>
    </ul>
  </div>
</nav>


<div class="container-fluid">
<div class="bg-secondary row h-25">
<div class=" col-7"><h3 class=" text-right text-white my-auto">Placid College</h3></div>
<div class=" col-5"><h5 class="offset-10 w-50 my-auto"><a href="logout.php">logout</a></h5></div>
</div>
</div
</div>
</header>

<h4 class="message"><?php echo output_message($message); ?></4>

<div class="studentprofiles container mt-5">
<div class="row">

<div class="col">
<?php 

$student = Student::find_by_id_arr($session->id); 
?>
 <div class="card-header text-primary">
  Student Details:
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><span class="text-info">First Name:</span> <?php echo $student->first_name; ?></li>
    <li class="list-group-item"><span class="text-info">Last Name:</span> <?php echo $student->last_name; ?></li>
    <li class="list-group-item"><span class="text-info">Student ID:</span> <?php echo $student->student_id; ?></li>
  </ul>

</div>


<div class="col">
<?php

 ?>
 <div class="card-header text-primary">
   Your Subjects:
  </div>
  <ul class="list-group list-group-flush">
  
  
    <?php
$sql = "SELECT subject_name FROM student WHERE student_id = {$student->student_id}";

$student_subjects = Student::find_by_sql($sql);
while ($all_subjects = $database->fetch_array($student_subjects)){
	echo "<li class='list-group-item'>". $all_subjects['subject_name'] . "</li>";
}
 ?>
  </ul>

 </div>
 </div>
</div>



<script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>