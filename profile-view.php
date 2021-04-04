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

$date_of = date('Y-m-d');

if(isset($_SESSION["user"])) {
	
	
	$user_type = trim($_SESSION['user']['user_type']);
	$user_id = $_SESSION['user']['user_id'];







	if($user_type == INCOMPLETE)
	{
		header("Location: profile-create.php");	
	}
	
}
else
{
	header("Location: user-register.php");
}


if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	$match_id = $_SESSION['match_user_info']['user_id'];

    	if(isset($_POST['ENABLE']))
    	{

    			//$user_able = $_SESSION['match_user_info'];

    			

    		if(isset($_SESSION['match_user_info']))
    		{


    			$user_resource = pg_execute($dbconn, 'update_user_type', array($match_id,CLIENT));

    			header("Location: profile-view.php?value=" . $match_id);

    		}

    	}
    	elseif(isset($_POST['DISABLE']))
    	{

    		if(isset($_SESSION['match_user_info']))
    		{

    			$user_resource = pg_execute($dbconn, 'update_user_type', array($match_id,DISABLED_CLIENT));

    			$close_offenses = pg_execute($dbconn,'update_offensive',array($match_id,CLOSED));

    			$remove_interest = pg_execute($dbconn, 'remove_interest', array($user_id,$match_id));

    			$remove_like = pg_execute($dbconn, 'remove_interest', array($match_id,$user_id));

    			header("Location: profile-view.php?value=" . $match_id);

    		}
    	}
    	elseif(isset($_POST['UNOFFENSIVE']))
    	{

    		if(isset($_SESSION['match_user_info']))
    		{

    			//$user_resource = pg_execute($dbconn, 'update_user_type', array($match_id,DISABLED_CLIENT));

    			//echo $match_id;

    			$close_offenses = pg_execute($dbconn,'update_offensive',array($match_id,CLOSED));

    			header("Location: profile-view.php?value=" . $match_id);

    		}
    	}
    	elseif(isset($_POST['INTERESTED']))
    	{

    		if(isset($_SESSION['match_user_info']))
    		{

    			$user_resource = pg_execute($dbconn, 'show_interest', array($user_id,$match_id,$date_of));

    			header("Location: profile-view.php?value=" . $match_id);

    		}
    	}
    	elseif(isset($_POST['UNINTERESTED']))
    	{

    		if(isset($_SESSION['match_user_info']))
    		{

    			$user_resource = pg_execute($dbconn, 'remove_interest', array($user_id,$match_id));

    			header("Location: profile-view.php?value=" . $match_id);

    		}
    	}
    	elseif(isset($_POST['OFFENDED']))
    	{

    		if(isset($_SESSION['match_user_info']))
    		{


    			$user_resource = pg_execute($dbconn, 'offended_by', array($user_id,$match_id,$date_of,OPEN));

    			header("Location: profile-view.php?value=" . $match_id);

    		}
    	}










    }


elseif($_SERVER["REQUEST_METHOD"] == "GET")
    {

    	$match_id = ($_GET['value']);

    	$image = "";

	$resource = pg_execute($dbconn, 'user_find_by_profile', [$match_id]);

	$profile_info = pg_fetch_assoc($resource);

	$_SESSION['match_profile_info'] = $profile_info;

	$user_resource = pg_execute($dbconn, 'user_find_by_id', [$match_id]);

	$profile_user_info = pg_fetch_assoc($user_resource);

	//echo $profile_info['images'];

	$profilepic = "images/profilepics/" . $match_id . "/" . $match_id;

	//echo $profilepic;

	$_SESSION['match_user_info'] = $profile_user_info;

	$profile_user_type = trim($profile_user_info['user_type']);

	if(isset($_SESSION['profile']))
	{
		$profile = $_SESSION['profile'];

		if($match_id == $profile['user_id'])
		{
			echo "<strong>" . $match_id . ", This is how your profile looks to others on HeartHome<br/><br/></strong>";
		}


	if(isset($_SESSION['user']))
	{
		$user = $_SESSION['user'];

		$match_id = $_SESSION['match_user_info']['user_id'];


		$match_resources = pg_execute($dbconn,'check_interest', array($user_id,$match_id));

		$check_interest = pg_num_rows($match_resources);

		$offense_resources = pg_execute($dbconn,'check_offense', array($user_id,$match_id));

		$check_offense = pg_num_rows($offense_resources);

		$user_type = trim($user['user_type']);


			if ($user_type == ADMIN)
			{


				echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >
				<p>';

				if($check_offense > 0)
				{
					echo '<input name="UNOFFENSIVE" type="submit" value="DEEM UNOFFENSIVE"/>';
				}


				if($profile_user_type == DISABLED_CLIENT || $profile_user_type == DISABLED_ADMIN)
				{
					echo '<input name="ENABLE" type="submit" value="ENABLE USER"/>';
				}
				else
				{
					echo '<input name="DISABLE" type="submit" value="DISABLE USER"/>';
				}
				
				echo
				'</p>
				</form>';

			}


	}







	}	

	echo "<table>";

	foreach ($profile_info as $key => $value) {

			if($key == 'images')
			{



				if ($profile_info['images'] > 0)
				{
					for ($i=1; $i <= $profile_info['images']; $i++) { 


						$image .='<img src="'.$profilepic. $i. ".jpg?". time() .'" alt="Profile_Picture height="84" width="84">';

						$value = $image;
						
					}
				}
				else
				{
					$value = "No Image Available";
				}

				
				
			}
			else{

				$value = is_numeric($value) ? get_property($key,$value) : $value;

			}
			
			echo "<tr>";
			
			echo "<td>" . ucfirst(str_replace('_', ' ', $key)) . "</td> <td> ". $value . "</td>";

			echo "</tr>";


		}

	echo "</table>";


	if(isset($_SESSION['user']))
	{
		//$user_id = $_SESSION['user'];

		/*$match_id = $_SESSION['match_user_info']['user_id'];


		$match_resources = pg_execute($dbconn,'check_interest', array($user_id,$match_id));

		$check_interest = pg_num_rows($match_resources);

		$offense_resources = pg_execute($dbconn,'check_offense', array($user_id,$match_id));

		$check_offense = pg_num_rows($offense_resources);*/

		//echo $check_interest;


			

				echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >
				<p>';

					if($check_interest <= 0)
					{
						echo '<input name="INTERESTED" type="submit" value="SHOW INTEREST"/>';
					}
					else
					{
						echo '<input name="UNINTERESTED" type="submit" value="REMOVE INTEREST"/>';
						echo '<br/><strong>You have previously shown interest in this profile</strong>';
					}


					

					if($check_offense <= 0)
					{
						echo '<input name="OFFENDED" type="submit" value="REPORT PROFILE"/>';
					}
					else
					{
						echo '<br/><strong>You have previously reported this profile</strong>';
					}

					


				
				echo
				'</p>
				</form>';

			


	}





	}




	
	
?>










<?php include 'footer.php'; ?>