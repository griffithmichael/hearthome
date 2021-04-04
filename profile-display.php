<?php
/*
Group 16
WEBD3201
*/ 
	$fileName="index.php";
	$date="07/21/2016";
	$description="home page";
	$title="Home";
	$banner="Heart Home";
?>

<?php include 'header.php'; ?>
   
    
<?php


	if(isset($_SESSION["user"])) {
	
	
	$user_id = $_SESSION['user']['user_id'];
					
		
		$update_resource = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);
	 
		
		$profile = pg_fetch_assoc($update_resource);

		//print_r($profile);

		
		if(empty($profile)){
			 
			$_SESSION['user']['user_type'] = "i";

			header("Location: profile-create.php");

		}

		echo "How your profile appears to others:" . "<br/>". "<br/>";


		profile_preview($user_id);


}

else
{
	header("Location: user-register.php");
}


?>







<?php include 'footer.php'; ?>
