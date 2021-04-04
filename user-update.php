<?php
/*
WEBD3201
Group 16

TODO: THIS PAGE IS AHEAD OF LAB1 - DOES NOT CURRENTLY VALIDATE WILL FIX LATER

*/ 
	$fileName="register.php";
	$description="Page for users to register to site";
	$title="Registeration Page";
	$banner="Registration";
?>

<?php include 'header.php';?>


<?php 





if($_SERVER["REQUEST_METHOD"] == "GET")
{
//users table

	if(!isset($_SESSION['user']))
	{
		header("Location: index.php");
	}
	else
	{
		$user_id = $_SESSION['user']['user_id'];

		$user_find = pg_execute($dbconn, 'user_find_by_id', [$user_id]);

		$user_info = pg_fetch_assoc($user_find);

	//	print_r($user_info);

		$current_email = $user_info['email_address'];
		$current_first = $user_info['first_name'];
		$current_last = $user_info['last_name'];
		$current_dob = $user_info['birth_date'];
		$user_type = trim($user_info['user_type']);

		if($user_type == DISABLED_CLIENT)
		{
			header("Location: index.php");
		}



	}





	$password = "";
	$user_type = "";
	$email = "";
	$enrol_date = "";
	$last_access = "";

	$confirm_password = "";
	
//people table

	$first_name = "";
	$last_name = "";
	$birth_date = "";

	
	$user_id_error = "";
	$password_error = "";
	$email_error = "";
	
	$error = false;
}


elseif($_SERVER["REQUEST_METHOD"] == "POST")
{
	$user_id = $_SESSION['user']['user_id'];
	
	
	
	global $dbconn;

	$error = false;
	
	
	$first_name = ($_POST['first_name']);
	//$first_name = sanitize($first_name);
	$first_name = sanitize($first_name);

	
	$last_name = ($_POST['last_name']);
	$last_name = sanitize($last_name);
	
	$birth_date = ($_POST['birth_date']);
	
	
	$email = ($_POST['email_address']);
	$email = sanitize($email);


		$current_email = $email;
		$current_first = $first_name;
		$current_last = $last_name;
		$current_dob = $birth_date;




	//basic email validation

	if(empty($email))
	{
		echo "<br/>Please enter an email address";
	}

	else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$error = true;
		echo "<br/>Please enter valid email address.";
	}
	/*else
	{
		//check email exist or not

		$result = pg_execute($dbconn, 'check_email',[$email]);
		$count = pg_num_rows($result);
		if($count!=0)
		{
			$error = true;
			echo "<br/>Email address already in use.";
		}
	}*/
	
	
	if (empty($birth_date))
	{
		echo "<br/>Please enter a date of birth.";
	}

	else if (calculateAge($birth_date) < MIN_AGE_USER)
	{
		$error = true;
		echo "<br/>Users must be 18+ years old to join!";
	}
	
	
	
	
	//First Name validation
		if (empty($first_name))
	{
		$error = true;
		echo "<br/>Please enter a first name.";
	}
	else if((strlen($first_name) > MAX_NAME_USER) == true)
	{
		$error = true;
		echo "<br/>First name must be shorter than 20 characters long.";
	}
	
	
	//Last Name validation
		if (empty($last_name))
	{
		$error = true;
		echo "<br/>Please enter a last name.";
	}
	else if((strlen($last_name) > MAX_NAME_USER) == true)
	{
		$error = true;
		echo "<br/>Last name must be shorter than 20 characters long.";
	}

	


	// if there's no error, continue to signup
	if($error == false)
	{

				

				$update_user = pg_execute($dbconn, 'update_user', array($user_id,$email,$first_name,$last_name, $birth_date));
		



		
		//header("Location: user-dashboard.php");
		
	}
}



?>



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<p>

	Email Address:<br/>
	<input name="email_address" type="text" value="<?php echo $current_email;  ?>"/>
	<br/>
	
	First Name:<br/>
	<input name="first_name" type="text" value="<?php echo $current_first ?>"/>
	<br/>
	
	Last Name:<br/>
	<input name="last_name" type="text" value="<?php echo $current_last ?>"/>
	<br/>
	
	Date of Birth:<br/>
	<input name="birth_date" type="date" value="<?php echo $current_dob ?>"/>
	<br/>
	
	
	<input name="Update" type="submit" value="Update"/>
</p>
	</form>

<?php include 'footer.php'; ?>


