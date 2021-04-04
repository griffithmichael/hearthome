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

<?php include 'header.php'; ?>

<?php 

global $dbconn;

if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$user_id = $_SESSION['user']['user_id'];
		
		foreach($_POST as $key => $value){

			

			if($value == "Remove Like")
			{
				$remove_resource = pg_execute($dbconn,'remove_interest',array($user_id,$key));
			}
			elseif($value == "Not Interested")
			{
   				$remove_resource = pg_execute($dbconn,'remove_interest',array($key,$user_id));
   			}
	}
}

	if(isset($_SESSION['user']))
	{
		$user_type = trim($_SESSION['user']['user_type']);
		$user_id = $_SESSION['user']['user_id'];


		if($user_type == CLIENT || $user_type == ADMIN)
		{


			$interest_resource = pg_execute($dbconn,'interest_in',[$user_id]);

			$interest_in_num = pg_num_rows($interest_resource);

			if($interest_in_num > 0)

			{
				$interest_in= pg_fetch_all($interest_resource);

			echo "<h1>You are interested in the following users:<br/></h1>";

			foreach ($interest_in as $key => $value) {
				foreach ($value as $key => $value) {


					echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >
					<p>';

					echo '<table><tr><td>' .  profile_preview($value) . '</td></td>';

					echo '<input name="'. $value.'" type="submit" value="Remove Like"/> </p>';
					//echo '<input type="hidden" name="dislike_user" id="'.$value.'">';



				}
			}
			}
			else
			{
				echo '<strong><br/>You have currently expressed no interest in other HeartHome users</strong>';
			}







			$from_resource = pg_execute($dbconn,'interest_from',[$user_id]);

			$interest_from_num = pg_num_rows($from_resource);

			if($interest_from_num > 0)

			{
				$interest_from= pg_fetch_all($from_resource);

			echo "<h1>The following users are interested in you:<br/></h1>";

			foreach ($interest_from as $key => $value) {
				foreach ($value as $key => $value) {


					echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >
					<p>';

					echo '<table><tr><td>' .  profile_preview($value) . '</td></td>';

					echo '<input name="'. $value.'" type="submit" value="Not Interested"/> </p>';
					//echo '<input type="hidden" name="dislike_user" id="'.$value.'">';



				}
			}
			}
			else
			{
				echo '<br/><strong>No users have shown an interest in you...<i>yet!</i></strong>';
			}


			$mutual_resource = pg_execute($dbconn,'mutual_interest',[$user_id]);

			$mutual_resource_num = pg_num_rows($mutual_resource);

			if($mutual_resource_num > 0)

			{
				$mutual_interests= pg_fetch_all($mutual_resource);

			echo "<h1>You and the following users are mutually interested in one another:<br/></h1>";

			foreach ($mutual_interests as $key => $value) {
				foreach ($value as $key => $value) {


					echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >
					<p>';

					echo '<table><tr><td>' .  profile_preview($value) . '</td></td>';

					//echo '<input name="'. $value.'" type="submit" value="Remove Like"/> </p>';
					//echo '<input type="hidden" name="dislike_user" id="'.$value.'">';



				}
			}
			}
			else
			{
				echo '<br/><strong>You have no mutual likes...<i>yet!</i></strong>';
			}
			







		}
		else
		{
			header("Location: index.php");
		}
	}






?>




<?php include 'footer.php'; ?>




