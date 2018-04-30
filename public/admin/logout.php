<?php require_once('../../includes/session.php');?>
<?php require_once("../../includes/functions.php");?>



<?php
if (!$session->is_logged_in_admin()){
	redirect_to("adminlogin.php");
	}
?>

<?php 
if ($session->is_logged_in_admin()){

   $session->logout();
	redirect_to("adminlogin.php");
	}
?>