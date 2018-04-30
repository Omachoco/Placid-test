<?php
require_once("../../includes/subject.php");
require_once("../../includes/functions.php");
?>
<?php
$message = "";
if (isset($_POST['submit'])){
  
  $subject_name =  trim($_POST['subjectname']);
  
   
 $newsubject = Subject::makesubject($subject_name);
  if($newsubject && $newsubject->create()){
	  $message = "New subject added.";
	  }else{
		  $message = " failed to add subject.";
		  }


}
		   
 ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Placid College</title>
</head>
<p class="message"><?php echo output_message($message); ?></p>

  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		  <table>
		    <tr>
		      <td>Enter Subject name:</td>
		      <td>
		        <input type="text" name="subjectname" maxlength="30" value="" />
		      </td>
		    </tr>
              <tr>
             <td colspan="4">
		        <input type="submit" name="submit" value="Create" />
		      </td>
		    </tr>
    
            </table>
            </form>
            
            </br />
            <p><a href="index.php">Back</a></p>
<body>
</body>
</html>