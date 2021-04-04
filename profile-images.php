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









$radio = "";
$image = "";
$checkbox = "";



if(isset($_SESSION["user"])) {

	$user_id = $_SESSION["user"]["user_id"];
	$user_type = trim($_SESSION["user"]["user_type"]);

	$user_type = trim($user_type);

	if($user_type != ADMIN && $user_type != CLIENT)
	{
//echo $user_type;
		header("Location: profile-create.php");
	}


	if(isset($_SESSION['image_message']))
	{
//echo $message;

		$image_message =  $_SESSION['image_message'];


//echo $message;
		unset($_SESSION['image_message']);


	}
	else
	{
		$image_message = "";
	}








	if(isset($_SESSION["profile"])) {

		$resource = pg_execute($dbconn, 'user_find_by_profile', [$user_id]);

		$result = pg_fetch_assoc($resource);

		$picture_amount = $result['images'];

		$dir = "images/profilepics/" . $user_id ;

		$amnt_pics_folder = countFolder($dir);

		$int_pics_folder = (int)$amnt_pics_folder;

//echo $int_pics_folder;

		$update_resource = pg_execute($dbconn, 'update_pictures', array($user_id,$int_pics_folder));







		if($amnt_pics_folder != 0)
		{

			$pictures = range(1, $amnt_pics_folder);


			if(is_dir($dir))
			{
				foreach ($pictures as $key) {

					if($key == 1)
					{
						$radio = '<td>  Profile Main </td>';
					}
					else
					{
						$radio .= '<td> <input type="radio" name="main_val" value="'.$user_id.$key.'"> </td>' ;

					}

					$checkbox .= '<td> <input type="checkbox" name="delete_val[]" value="'.$user_id.$key.'"> </td>' ;

					$image .= '<td><img src="'.$dir. '/' . $user_id. $key.".jpg?". time() .'" alt="Profile_Picture height="84" width="84""> </td>';
//echo '<br/>';


				}

				echo '<form  method="post" action="'. $_SERVER["PHP_SELF"] .'" >'.

				'<table >
				<tbody>
				<tr>' . $radio . '</tr>'
				.'<tr>' . $image . '</tr>'
				. '<tr>' .$checkbox . '</tr>'

				.'</tbody>
				</table>'

				. '<input name ="delete" type = "submit" value="Delete" >'
				. '<input name ="main" type = "submit" value="Make Main Picture" >'
				. '</form>';

			}
			else
			{
//echo $dir;
				echo "Error retrieving user images";
			}

		}
		else
		{
			recursiveDelete($dir);
		}


		if($_SERVER["REQUEST_METHOD"] == "GET")
		{

		}


		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
//print_r($_POST);


			if(isset($_FILES['fileToUpload']))
			{

				if($_FILES['fileToUpload']['error'] != 0)
				{
					$_SESSION['image_message'] = "<h2>Problem uploading your file.</h2><br/>";
				}
else if($_FILES['fileToUpload']['size'] > MAX_PHOTO) //size in bytes
{
	$_SESSION['image_message'] = "<h2>File selected is too big. File</h2><br/>";
}
else if($_FILES['fileToUpload']['type'] != "image/jpeg" && $_FILES['fileToUpload']['type'] != "image/pjpeg")
{
	$_SESSION['image_message'] = "<h2>Your profile pictures must be of type JPEG.</h2><br/>";
}
else
{ 
	if(is_dir($dir) == false)
	{
		mkdir($dir);
	}


	move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $dir  . '/' .$user_id . ($amnt_pics_folder+1) . '.jpg');


}

}


if(isset($_POST['main']) && isset($_POST['delete_val']))
{
	$_SESSION['image_message'] = "Checkboxes used for deleting only, radio button used to make main profile picture<br/>";
}
elseif(isset($_POST['main_val']) && isset($_POST['delete']))
{
	$_SESSION['image_message'] = "Checkboxes used for deleting only, radio button used to make main profile picture<br/>";
}

else
{

	if(isset($_POST['main_val']))
	{
		$make_main = $_POST['main_val'];
//echo $make_main;


		$check_main = $make_main . '.jpg';

		if(is_dir($dir))
		{
			$dir_contents = array_diff( scandir($dir), array(".", "..") );
		}



//print_r($dir_contents);
		$i = 2;
		foreach ($dir_contents as  $value) {

			if($value == $check_main)
			{
				rename( $dir.'/'.$value, $dir.'/'.'temp'.$user_id.'1.jpg');
			}
			else
			{
				rename( $dir.'/'.$value, $dir.'/'.'temp'.$user_id.$i.'.jpg');
				$i++;
			}

		}

		if(is_dir($dir))
		{
			$temp_files = array_diff( scandir($dir), array(".", "..") );
		}


		$i = 1;
		foreach ($temp_files as  $value) {

			rename( $dir.'/'.$value, $dir.'/'.$user_id.$i.'.jpg');

			$i++;


		}

	}

	if(isset($_POST['delete_val']))
	{
		$delete_pics = $_POST['delete_val'];

		foreach ($delete_pics as $key => $value) {

			unlink($dir .'/'.$value .'.jpg');

		}


		$dir_contents = array_diff( scandir($dir), array(".", "..") );

//print_r($dir_contents);
		$i = 1;
		foreach ($dir_contents as  $value) {

			rename( $dir.'/'.$value, $dir.'/'.$user_id.$i.'.jpg');

			$i++;


		}


	}

	header("Location: profile-images.php");

}

}

if($amnt_pics_folder == MAXIMUM_PROFILE_IMAGES)
{
	$_SESSION['image_message'] = "You have reached the profile picture limit.<br/> You must delete pictures before adding more!<br/>";
	$upload_form = "";


}
else
{
	if($amnt_pics_folder == 0)
	{
		$_SESSION['image_message'] = "You currently have no profile pictures! Try uploading some below:<br/>";
	}	

	$upload_form = '<p> Hey '.$user_id .'!<br/>'. $image_message .'
	Users with profile pictures are more likely to get matches.  <br/>
	<br/> Add some below:

	<form  method="post" action="'.$_SERVER["PHP_SELF"].'" enctype="multipart/form-data">
	<input name ="fileToUpload" type ="file" id="fileToUpload">
	<input name ="submit" type ="submit" value ="Submit" >
	</form></p>';
}



}

}



else {

	header("Location: user-login.php");
}


?>

<?php echo $upload_form; ?>








<?php include 'footer.php'; ?>