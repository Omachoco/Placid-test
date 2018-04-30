<?php
require_once("../includes/functions.php");
require_once("../includes/session.php");
require_once("../includes/database.php");
require_once("../includes/student.php");

$message = "";

if($session->is_logged_in_student()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_student = Student::authenticate($username, $password);
	
  if ($found_student) {
    $session->login($found_student);
	$session->message("Welcome");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css"">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Placid College</title>
</head>

<body>
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


<h3 class="bg-secondary text-center text-white">Placid College </h3>

</header>
<h5 class="ml-4">Student Login</h5>

		
		<h3> <?php echo  output_message($message); ?></h3>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="mt-4 ml-3">
		  <div class="form-group">
          <label for="username"></label>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
         
                
<?Php if(isset($database)){$database->close_connection();}?>
 
 
 <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>  
</body>
</html>