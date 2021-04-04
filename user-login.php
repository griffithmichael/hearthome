<?php
/*
WEBD3201
Group 16
*/ 
$fileName="login.php";
$description="Login page for existing users";
$title="Login";
$banner="Login";
?>

<?php include 'header.php'; 

if(isset($_SESSION['message']))
{



	$message =  $_SESSION['message'];

	//echo "TEST";

	session_unset($_SESSION['message']);
	session_destroy(); 

	unset($_SESSION['message']);

}
else
{
	$message = "Registered Users enter login info below";
}


if($_SERVER["REQUEST_METHOD"] == "GET")
{
	$user_id = "";
	$password = "";
}


elseif($_SERVER["REQUEST_METHOD"] == "POST")
{


	global $dbconn;

	$user_id = strip_tags($_POST['user_id']);
	$password = strip_tags($_POST['password']);

	$user_id = stripslashes($user_id);
	$password = stripslashes($password);

	$password = $password . SALT;

	$password = hash(HASH_TYPE,$password);



	$resource = pg_execute($dbconn, 'user_find_by_id', [$user_id]);



	$result = pg_fetch_all($resource);





	if(!$result)
	{
		echo "Invalid username" ;
	}
	else
	{

		$user = $result[0];

//var_dump($user);


		$db_password = $user['password'];


		if ($password === $db_password){



			$db_user_id = $user['user_id'];

			setcookie("user_id",$db_user_id, time()+ COOKIE_EXPIRY);



			$last_login = date('Y-m-d');


			$update = "UPDATE users SET last_access='$last_login' WHERE user_id= $1";


			$update_query = pg_prepare($dbconn, 'update_last_access', $update);

			$update_resource = pg_execute($dbconn, 'update_last_access', [$db_user_id]);


			$_SESSION['user'] = $user;


			$user_type = trim($_SESSION['user']['user_type']);

//echo $user_type;


			if($user_type == DISABLED_CLIENT)
			{
				header("Location: aup.php");
				session_unset(); 
				session_destroy();

				session_start();

				$_SESSION['disabled_message'] = "<h1>Your account has been disabled for unacceptable use<br/>
				please review the Acceptable Use Policy below:</h1>";

//echo $_SESSION['disabled_message'];

			}
			elseif($user_type == DISABLED_ADMIN)
			{
				echo "Administrator account is currently disabled";
				session_unset(); 
				session_destroy();
			}
			elseif($user_type == ADMIN)
			{
				header("Location: admin.php");
			}
			else
			{
				header("Location: user-dashboard.php");
			}




		}else{
			echo "Invalid password";
		}



	}







}



?>




<p><?php echo $message ?></p>

<form  method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>' >
	<p>
		<input name="user_id" type="text" value="<?php echo $user_id ?>"/>
		<input name="password" type="password"/>
		<input name="login" type="submit" value="login"/>
	</p>
</form>


<p>New to the site? <a href="./register.php">Regsiter Here</a></p>




<?php include 'footer.php'; ?>




