<?php
/*
WEBD3201
Group 16
*/ 
	$fileName="admin.php";
	$description="Welcome page for admin";
	$title="Welcome Page";
	$banner="Welcome Page";
?>


<?php include 'header.php'; ?>

<?php

if(isset($_SESSION['message']))
{
	//echo $message;

	$message = $_SESSION['message'];


	//echo $message;
		unset($_SESSION['message']);


}
else
{
	$message = "";
}




	if(isset($_SESSION["user"])) {

		$user_type = trim($_SESSION['user']['user_type']);

		
		if($user_type != ADMIN)
		{
			header("Location: index.php");
		}
		else
		{
			$user_id = $_SESSION['user']['user_id'];
			$email_address = $_SESSION['user']['email_address'];
			$first_name = $_SESSION['user']['first_name'];
			$last_name = $_SESSION['user']['last_name'];
			$birth_date = $_SESSION['user']['birth_date'];
			$enrol_date = $_SESSION['user']['enrol_date'];
			$last_access = $_SESSION['user']['last_access'];
			$user_type = trim($_SESSION['user']['user_type']);

			$update_resource = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);
	 
		
			$profile = pg_fetch_assoc($update_resource);


			$resource = pg_query($dbconn,"SELECT * FROM offenses WHERE status <> 'C'");

			 $disabled_users = pg_fetch_all($resource);

			 $diabled_num = pg_num_rows($resource);

			 
			 if($diabled_num > 0)
			 {
			 	 foreach ($disabled_users as $key => $record) {
			 	//echo "<tr>";

			 	 echo "<table border='1'>";

			 	foreach ($record as $key => $value) {


			 		echo "<tr><td>" . ucfirst(str_replace('_', ' ', $key)) . "</td>";

			 		if($key == "offended_by" || $key == "user_id")
			 		{
			 			echo "<td><a href='profile-view.php?value=".$value."'>" . $value. "</a></td>";
			 		}
			 		else
			 		{
			 			echo "<td>" . $value . "</td></tr>";
			 		}



			 		
			 	}
			 	//echo "</tr>";
			 	echo "</table>";
			 	echo "<br/>";
			 }
			 }


			

			

			 

		
			if(empty($profile)){
			 
				$_SESSION['user']['user_type'] = "i";

				header("Location: profile-create.php");

			}

			else
			{
				$_SESSION['profile'] = $profile;
			}






		}
	}
	else
	{
		header("Location: index.php");
	}

?>


<p> Hey  <?php echo $first_name . " " . $last_name . $message."!"; ?><br/>Welcome back site administrator!<br/>

	You last logged in on: <?php echo $last_access; ?>


 </p>






<?php include 'footer.php'; ?>