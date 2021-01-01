<?php
include 'dbconnect.php';

	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];


		$existsql = "select * from `User` where user_email = '$email'";
		$result = mysqli_query($conn,$existsql);
		// printf("error: %s\n", mysqli_error($conn));

		$numrows = mysqli_num_rows($result);

		if($numrows > 0)
		{
			$error = "Email already in use";
			header("Location:/forumajax/index.php?user already taken");

		}

		else
		{
			if($password == $cpassword)
			{
				$hash = password_hash($password, PASSWORD_DEFAULT);

				$sql = "INSERT INTO `User` (`user_name`, `user_email`, `user_password`, `user_time`) VALUES ('$name', '$email', '$hash', current_timestamp())";


				$result = mysqli_query($conn,$sql);
				// printf("error: %s\n", mysqli_error($conn));

				if($result)
				{
					header("Location:/forumajax/index.php?signup=1");
				}

			}
			else
			{
				$error = "password doesnt match";
				header("Location:/forumajax/index.php?signup=0");

			}
		}

	}


?>
