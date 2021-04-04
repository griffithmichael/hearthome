<?php
/*
WEBD3201
Group 16
*/ 
	$fileName="welcome.php";
	$description="Welcome page for registered users";
	$title="Welcome Page";
	$banner="Welcome Page";
?>



<?php include 'header.php'; ?>


<?php

global $dbconn;

if(isset($_SESSION["user"])) {
	
	
	$user_id = $_SESSION['user']['user_id'];
	$user_type = trim($_SESSION['user']['user_type']);

	//echo $user_type;
	
}



else {
    
	header("Location: user-login.php");
	}


if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$current_password = "";
	$new_password = "";
	$confirm_password = "";

}


elseif($_SERVER["REQUEST_METHOD"] == "POST")
{



	$current_password = $_POST['current_password'];
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];


		

		$error = false;
		$empty = false;




		if(empty($new_password))
			{
				echo "<br/>Enter a new password";
				$empty = true;

			}

		if(empty($confirm_password))
			{
				echo "<br/>Enter a confirm password";
				$empty = true;

			}

		if(empty($current_password))
			{
				echo "<br/>Enter a current password";
				$empty = true;

			}


		if($empty == false)
		{

			if($new_password != $confirm_password)
			{
				echo "New Password and Confirm Password do not match!";
				$error = true;
			}
		else
			{
				$new_password = $confirm_password;
			}

		

		if(((strlen($new_password) < MIN_PASS_USER) == true)|| ((strlen($new_password) > MAX_PASS_USER) == true))
			{
				echo "<br/>Password must be atleast 6 characters in length.";
				$error = true;
			}




		$current_password = $current_password . SALT;
		
		$current_password = hash(HASH_TYPE,$current_password);


		$check_password = pg_execute($dbconn, 'confirm_password', array($user_id,$current_password));



		$correct_password = pg_fetch_row($check_password);

		$correct_password = $correct_password[0];


		//echo "new password is: " . $new_password . "<br/>";

		$new_password = $new_password . SALT;
		
		$new_password = hash(HASH_TYPE,$new_password);




		if($correct_password != $current_password)
		{
			echo "Current password incorrect!";
			$error = true;
		}


		if ($new_password == $correct_password)
		{
			echo "New password cannot be the same as current!";
			$error = true;
		}


	}

		if($empty == false)
			{
			if ($error == false)
			{

							
							$update_user_password = pg_execute($dbconn, 'change_password', array($new_password,$user_id));

							//echo $new_password;

							//echo $user_id;

							$_SESSION['message'] = " your password has been updated";

							//echo $_SESSION['message'];

							if($user_type == ADMIN)
							{
								header("Location: admin.php");
							}
							else
							{
								header("Location: user-dashboard.php");
							}


							

							

						}
					}


}


						





		
	





?>





<p> 
Hey <?php echo $user_id . "!"; ?> <br/>
Can't remember your password?<br/>
Click below to reset it! <br/>

</p>





<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<p>

	Current Password:<br/>
	<input name="current_password" type="password" value=""/>
	<br/>
	
	Password:<br/>
	<input name="new_password" type="password" value=""/>
	<br/>

	Confirm Password:<br/>
	<input name="confirm_password" type="password" value=""/>
	<br/>
	
	
	<input name="Update_Password" type="submit" value="Update Password"/>
</p>
	</form>







<?php include 'footer.php'; ?>