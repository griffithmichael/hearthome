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




if(isset($_SESSION['message']))
{

	$message = $_SESSION['message'];

	//session_unset($_SESSION['password_change']);
    //	session_destroy(); 

		unset($_SESSION['message']);



}
else
{
	$message = "";
}




$user_id = "";

if(isset($_SESSION["user"])) {
	
	
	$user_id = $_SESSION['user']['user_id'];
	$email_address = $_SESSION['user']['email_address'];
	$first_name = $_SESSION['user']['first_name'];
	$last_name = $_SESSION['user']['last_name'];
	$birth_date = $_SESSION['user']['birth_date'];
	$enrol_date = $_SESSION['user']['enrol_date'];
	$last_access = $_SESSION['user']['last_access'];
	//$user_type = trim($_SESSION['user']['user_type']);

	$check_type = $update_resource = pg_execute($dbconn, 'user_find_by_id', [$user_id]);

	$profile = pg_fetch_assoc($check_type);

	$user_type = trim($profile['user_type']);

	$_SESSION['user']['user_type'] = $user_type;


	if($user_type == ADMIN)
		{
			header("Location: admin.php");
		}

	

		//echo $user_type;
					
		
		$update_resource = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);
	 
		
		$profile = pg_fetch_assoc($update_resource);

		
		if(empty($profile)){
			 
			$_SESSION['user']['user_type'] = "i";

			header("Location: profile-create.php");

		}

		else
		{
			$_SESSION['profile'] = $profile;
		}
		
		
		
	
	
	
}



else {
    
	header("Location: user-login.php");
	}
	
	
?>

<p><?php echo $message ?></p>


<p> Hey  <?php echo $first_name . " " . $last_name . "!"; ?><br/>Welcome back to HeartHome, begin searching for matches!<br/>

	You last logged in on: <?php echo $last_access; ?>


 </p>








<?php include 'footer.php'; ?>