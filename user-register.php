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
	$user_id = "";
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
	$user_id = "";
	$password = "";
	
	
	
	$dbconn = db_connect();
	
	$enrol_date = date("Y-m-d");
	
	$last_access = date("Y-m-d");
	
	$user_type = "i";
	
	$error = false;
	
	
	$first_name = ($_POST['first_name']);
	//$first_name = sanitize($first_name);
	$first_name = sanitize($first_name);

	
	$last_name = ($_POST['last_name']);
	$last_name = sanitize($last_name);
	
	$birth_date = ($_POST['birth_date']);
	
	
	$user_id = ($_POST['user_id']);
	$user_id = sanitize($user_id);
	
	$email = ($_POST['email_address']);
	$email = sanitize($email);

	$password = ($_POST['password']);
	$password = sanitize($password);

	$confirm_password = ($_POST['confirm_password']);
	$confirm_password = sanitize($password);

	
	
	//user_id validation
	if (empty($user_id))
	{
		$error = true;
		echo "<br/>Please enter a username.";
	}
	else if (((strlen($user_id) < MIN_CHAR_USER)== true) || ((strlen($user_id) > MAX_CHAR_USER)==true))
	{
		$error = true;
		//$user_id_error = "user_id must be between 6 and 20 characters long.";
		echo "<br/>Username must be within 6 and 20 characters";
	}
	else if (!preg_match("/^[a-zA-Z]+$/",$user_id))
	{
		$error = true;
		echo  "<br/>Username must be alphabetic";
	}
	else if (is_user_id($user_id) == true)
	{
		$error = true;
		echo "<br/>Username already exists";
	}
	else
	{
		//$query = "SELECT user_id FROM users WHERE user_id=$1";
		//$result = pg_query($dbconn,);
		//$count = pg_num_rows($result);

		$result = pg_execute($dbconn,'user_find_by_id',[$user_id]);
		$count = pg_num_rows($result);
		if($count!=0)
		{
			$error = true;
			$user_id_error = $user_id . " is already in use.";
			$user_id = "";
		}
	}

	//basic email validation
	if (!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$error = true;
		echo "<br/>Please enter valid email address.";
	}
	else
	{
		//check email exist or not
		//$query = "SELECT email_address FROM users WHERE email_address='$email'";
		//$result = pg_query($query);

		$email_result = pg_execute($dbconn,'check_email',[$email]);
		$email_count = pg_num_rows($email_result);

		//$email_count = pg_num_rows($result);
		if($email_count!=0)
		{
			$error = true;
			echo "<br/>Email address already in use.";
		}
	}
	
	
	if (calculateAge($birth_date) < MIN_AGE_USER)
	{
		$error = true;
		echo "<br/>Users must be 18+ years old to join!";
	}
	
	//password validation
	if (empty($password))
	{
		$error = true;
		echo "<br/>Please enter password.";
	}
	else if(((strlen($password) < MIN_PASS_USER) == true)|| ((strlen($password) > MAX_PASS_USER) == true))
	{
		$error = true;
		echo "<br/>password must have atleast 6 characters.";
	}
	else if ($password != $confirm_password)
	{
		$error = true;
		echo "<br/>password and confirm password do not match!";
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
		
	$password = $password . SALT;
		
	$password = hash("md5",$password);


		$_SESSION['message'] = "You have successfully signed up for HeartHome, try logging in";

		
		$query = pg_prepare($dbconn, 'create_user', "INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) 
			      VALUES($1,$2,$3,$4, $5, $6, $7, $8,$9)");

		$new_user = pg_execute($dbconn, 'create_user', array($user_id,$password,$user_type,$email,$first_name,$last_name, $birth_date, $enrol_date,$last_access));

		//session_start();

		//echo $_SESSION['message'];

		
		
		header("Location: user-login.php");
		
	}
}



?>

<p>New to the site? Enter your information below to register:</p>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
	<p>
	User ID:<br/>
	<input name="user_id" type="text" value="<?php echo $user_id; ?>"/>
	<br/>
	
	Password:<br/>
	<input name="password" type="password" value=""/>
	<br/>

	Confirm Password:<br/>
	<input name="confirm_password" type="password" value=""/>
	<br/>
	
	Email Address:<br/>
	<input name="email_address" type="text" value="<?php echo $email;  ?>"/>
	<br/>
	
	First Name:<br/>
	<input name="first_name" type="text" value="<?php echo $first_name ?>"/>
	<br/>
	
	Last Name:<br/>
	<input name="last_name" type="text" value="<?php echo $last_name ?>"/>
	<br/>
	
	Date of Birth:<br/>
	<input name="birth_date" type="date" value=""/>
	<br/>
	
	
	<input name="Register" type="submit" value="Register"/>
</p>
	</form>

<?php include 'footer.php'; ?>


