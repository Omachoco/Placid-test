<?php
require_once("../../includes/functions.php");
require_once("../../includes/session.php");
require_once("../../includes/database.php");
require_once("../../includes/admin.php");
?>
<?php
if (!$session->is_logged_in_admin()){
	redirect_to("adminlogin.php");
	}
	?>

<?php
if (isset($_POST['submit'])){
  
  $username =  trim($_POST['username']);
  $password =  trim($_POST['password']);
  $first_name =  trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  
   
 $newadmin = Admin::makeadmin($username, $password,  $first_name, $last_name);
  if($newadmin && $newadmin->create()){
	  $message = "New admin added";
	  redirect_to("adminlogin.php");
	  }else{
		  $message = "admin creation failed.";
		  }
}

		   
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Placid college</title>
</head>

<body>
<p class="message"><?php echo output_message($message); ?></p>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value=""/>
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
             <td colspan="4">
		        <input type="submit" name="submit" value="Create" />
		      </td>
		    </tr>
    
		  </table>
		</form>
</body>
</html>
