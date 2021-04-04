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

if(isset($_SESSION["user"])) {

	header("Location: user-dashboard.php");

}


	if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$user_id = "";
		$email_address = "";
		$random_password = "";
	}
	
	
	elseif($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		
		global $dbconn;
		$empty = false;
		$user_id = sanitize($_POST['user_id']);
		$email_address = sanitize($_POST['email_address']);


		if(empty($user_id))
		{
			echo "Please enter a user id <br/>";
			$user_id = "";
			$empty = true;
		}
		if(empty($email_address))
		{
			echo "Please enter a email address <br/>";
			$email_address = "";
			$empty = true;
		}

		if($empty == false)
		{
			

			$user_found = pg_execute($dbconn, 'user_find_by_id', [$user_id]);
			
			

			$user_found = pg_fetch_assoc($user_found);

			if (!$user_found)
			{
				echo "Invalid user id";
			}

			else
			{
				$email_found = pg_execute($dbconn, 'user_id_and_email', array($user_id, $email_address));

				$real_user = pg_fetch_assoc($email_found);

				if (!$real_user)
				{
					echo "Email address does not match one on file";
				}
				else
				{

					$random_password = random_password(8);


					//pg_execute($dbconn, 'change_password', array($random_password,$user_id));
		

					$hash_password = $random_password . SALT;
		
					$hash_password = hash(HASH_TYPE,$hash_password);

					pg_execute($dbconn, 'change_password', array($hash_password,$user_id));

					/*$to = $real_user['email_address'];
					$subject = 'Heart Home - Request change of password';
					$message = 'Hello, ' . $real_user['user_id'] . ' you have requested a change of password for your account, to access your account please use the temporary password provided; ' . $random_password . ' once logged on be sure to change your password. Click the link provided to login:'
					. '<a href="http://opentech2.durhamcollege.org/webd3201/group04/user-login.php">HeartHome Login Page</a> '
					$headers = 'From: admin@hearthome.com' . "\r\n" .
					 'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $message, $headers);*/

					$_SESSION['message'] = 'Your password has been changed, check the email address you provided for your temporary password';

					header("Location: user-login.php");











				}




			}

		}
	}



?>


<form  method="post" action='<?php echo $_SERVER['PHP_SELF']; ?>' >
	<p> Can't remember your password? <br/>
		Enter your user id and email below to request one
	
	
	


	<table >
		<tbody>
			<tr>
				<td>User ID: </td>
				<td><input name="user_id" type="text" value="<?php echo $user_id ?>"/></td>
			</tr>
			<tr>
				<td>Email Address: </td>
				<td><input name="email_address" type="text" value="<?php echo $email_address ?>"/> </td>
			</tr>
			<tr>
				<td> </td>
				<td><input name="request_password" type="submit" value="Request Password"/> </td>
			</tr>
		</tbody>
	</table>







	</p>
	</form>






<?php include 'footer.php'; ?>