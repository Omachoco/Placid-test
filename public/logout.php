<?php require_once('../includes/session.php');?>
<?php require_once("../includes/functions.php");?>



<?php
if (!$session->is_logged_in_student()){
	redirect_to("login.php");
	}
?>

<?php 
if ($session->is_logged_in_student()){

   $session->logout();
	redirect_to("index.php");
	}
?>