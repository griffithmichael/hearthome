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

global $dbconn;


if($_SERVER["REQUEST_METHOD"] == "GET")
{

$user_id = $_SESSION['user']['user_id']; 
$gender = 1;
$gender_sought = 1;
$city = 0;
$headline = "";
$self_description = "";
$match_description = "";
$bilingual = 0;
$drinker = 0;
$smoker = 0;
$eye_colour = 1;
$hair_colour = 1;
$highest_education = 0;
$religious = 0;
$want_children = 0;
$coffee_tea = 1;
$images = 0;

$profile_info = "";


	if(isset($_SESSION['user']))
	{

	$user_type = trim($_SESSION['user']['user_type']);

	}
	else
	{
		header("Location: user-register.php");
	}

if($user_type == CLIENT || $user_type == ADMIN)
{

	$find_profile_info = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);

	$profile_info = pg_fetch_assoc($find_profile_info);

	//print_r($profile_info);

	$gender = $profile_info['gender'];
	$gender_sought = $profile_info['gender_sought'];
	$city = $profile_info['city'];
	$headline = $profile_info['headline'];
	$self_description = $profile_info['self_description'];
	$match_description = $profile_info['match_description'];
	$bilingual = $profile_info['bilingual'];
	$drinker = $profile_info['drinker'];
	$smoker = $profile_info['smoker'];
	$eye_colour = $profile_info['eye_colour'];
	$hair_colour = $profile_info['hair_colour'];
	$highest_education = $profile_info['highest_education'];
	$religious = $profile_info['religious'];
	$want_children = $profile_info['want_children'];
	$coffee_tea = $profile_info['coffee_tea'];
	$images = $profile_info['images'];
	$error = false;



}




}


elseif($_SERVER["REQUEST_METHOD"] == "POST")
{

	

$user_id = $_SESSION['user']['user_id'];

	$find_profile_info = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);

	$profile_info = pg_fetch_assoc($find_profile_info);


$gender = ($_POST['gender']);
$gender_sought = ($_POST['gender_sought']);
$city = ($_POST['city']);
$headline = ($_POST['headline']);
$self_description = ($_POST['self_description']);
$match_description = trim($_POST['match_description']);
$bilingual = ($_POST['bilingual']);
$drinker = ($_POST['drinker']);
$smoker = ($_POST['smoker']);
$eye_colour = ($_POST['eye_colour']);
$hair_colour = ($_POST['hair_colour']);
$highest_education = ($_POST['highest_education']);
$religious = ($_POST['religious']);
$want_children = ($_POST['want_children']);
$coffee_tea = ($_POST['coffee_tea']);
$images = $profile_info['images'];
$error = false;

	


	if(strlen($headline) == 0)
	{
		echo "Please enter a profile headline<br>";
		$error = true;

	}
	if(strlen($self_description) == 0)
	{
		echo "Please enter a self description headline<br>";
		$error = true;

	}
	if(strlen($match_description) == 0)
	{
		echo "Please enter match description <br>";
		$error = true;

	}




	if ($error == false)
	{


	$profile_complete = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);

	$complete_status = pg_num_rows($profile_complete);

	 $complete_status;


		 if($complete_status != 0)
		 {
		 	//$images = 0;



		 	$resource = pg_execute($dbconn,'profile_update',array($user_id,$gender, $gender_sought,$city,$images,$headline,$self_description,$match_description,$bilingual,$drinker,$eye_colour,$hair_colour,$highest_education,$religious,$smoker,$want_children,$coffee_tea));


		 	$profile = pg_fetch_array(pg_execute($dbconn, 'user_find_by_profile', [$user_id]));

			//setcookie("profile_info",$profile, time()+constant('THIRTY_DAY_COOKIE'));

			$_SESSION['message'] = "$user_id, you have successfully updated your profile";

			if($user_type == ADMIN)
			{
				header("Location: admin.php");
			}
			else
			{
				header("Location: user-dashboard.php");
			}

			





		 }
		 else
		 {






		 	$images = 0;





			$resource = pg_execute($dbconn,'profile_create',array($user_id,$gender, $gender_sought,$city,$images,$headline,$self_description,$match_description,$bilingual,$drinker,$eye_colour,$hair_colour,$highest_education,$religious,$smoker,$want_children,$coffee_tea));


			$complete = pg_execute($dbconn, 'complete_user', [$user_id]);
			$profile = pg_fetch_array(pg_execute($dbconn, 'user_find_by_profile', [$user_id]));

			//setcookie("profile_info",$profile, time()+constant('THIRTY_DAY_COOKIE'));

			$_SESSION['message'] = "$user_id, you have successfully updated your profile";
			$_SESSION['user']['user_type'] = CLIENT; 

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
 

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">


<table >
		<tr>
			<td> Create your profile below to find matches in your area:  </td>
		</tr>


		<tr>
			<td>User ID:  <?php echo $_SESSION['user']['user_id'];?> </td>
		</tr>
		<tr>
			<td>I am a: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
				<?php build_dropdown('gender',$gender);?>  </td>
			</tr>
		<tr>
			<td>Looking for: 
				<?php build_dropdown('gender_sought',$gender_sought);?>  </td>
		</tr>
		<tr>
			<td>I reside in: </td>
		</tr>
		<tr>
			<td><?php build_radio('city',$city);?> </td>
		</tr>
		<tr>
			<td>Headline:  </td>
		</tr>
		<tr>
			<td><input name="headline" type="text" value="<?php echo $headline ?>" />  </td>
		</tr>

		<tr>
			<td>Describe Yourself:  </td>
		</tr>
		<tr>
			<td><textarea rows="4" cols="35" name="self_description"><?php echo trim($self_description); ?></textarea> </td>
		</tr>

		<tr>
			<td>Describe Your Ideal Match:  </td>
		</tr>
		<tr>
			<td><textarea rows="4" cols="35" name="match_description"><?php echo trim($match_description); ?></textarea></td>
		</tr>

		<tr>
			<td>Are you bilingual  </td>
		</tr>
		<tr>
			<td> <?php build_dropdown('bilingual',$bilingual);?>  </td>
		</tr>

		<tr>
			<td>Drinker: </td>
		</tr>
	
		<tr>
			<td><?php build_dropdown('drinker',$drinker);?></td>
		</tr>
	
		<tr>
			<td>Smoker: </td>
		</tr>
		<tr>
			<td><?php build_dropdown('smoker',$smoker);?></td>
		</tr>


		<tr>
			<td>Eye Colour: </td>
		</tr>
		<tr>
			<td><?php build_radio('eye_colour',$eye_colour);?></td>
		</tr>

		<tr>
			<td>Hair Colour: </td>
		</tr>
		<tr>
			<td><?php build_radio('hair_colour',$hair_colour);?></td>
		</tr>

		<tr>
			<td>Highest Education:</td>
		</tr>
		<tr>
			<td><?php build_dropdown('highest_education',$highest_education);?></td>
		</tr>

		<tr>
			<td>Religious:</td>
		</tr>
		<tr>
			<td><?php build_dropdown('religious',$religious);?></td>
		</tr>

		<tr>
			<td>Want Children?</td>
		</tr>
		<tr>
			<td><?php build_dropdown('want_children',$want_children);?></td>
		</tr>

		<tr>
			<td>Prefer Coffee or Tea: </td>
		</tr>
		<tr>
			<td><?php build_radio('coffee_tea',$coffee_tea);?></td>
		</tr>

		<tr>
			<td> <input name="Register" type="submit" value="Register"/> </td>
		</tr>

	</table>

</form>
 

 
 


<?php include 'footer.php'; ?>
