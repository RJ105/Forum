
<?php
 
 include "dbconnect.php";


 if(isset($_POST['submit']))
 {
 	$email = $_POST['email'];
 	$password = $_POST['password'];

 	$existsql = "select * from `User` where user_email = '$email'";
 	$result = mysqli_query($conn,$existsql);
	$numrows = mysqli_num_rows($result);


 	if($numrows==1)
 	{
 		$row = mysqli_fetch_assoc($result);
 		if(password_verify($password, $row['user_password']))
 		{
 			session_start();
 			$_SESSION['user_id'] = $row['user_id'];
 			$_SESSION['username'] = $row['user_name'];
 			$_SESSION['email'] = $row['user_email'];
 			echo $_SESSION['username'];
 			echo $_SESSION['email'];
 			header("Location:/forumajax/index.php?login=1");

 		}
 		else
 		{
 			header("Location:/forumajax/index.php?login=2");
 		}
 	}
 	else
 	{
 		header("Location:/forumajax/index.php?login=3");

 	}
 }


?>
