<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/one-page-wonder.css" /> 
	<link rel="stylesheet" type="text/css" href="css/one-page-wonder.min.css" /> 

	<title><?php echo $title; ?></title><!-- THE <title> WILL COME FROM A PHP VARIABLE TOO -->
	</head>
	<body>
		<div id="container">
			<div id="header">
				<img src="images/hearthomelogo.png" alt="group16_logo" />
				<h1>
					<?php echo $banner ?> 

					<!--		<a href="user-logout.php" style="float: right;" style="color:red"  font>Logout</a> -->

				</h1>	</div>
				<?php require "includes/constants.php"; require "includes/functions.php"; require "includes/db.php";?>
				<?php session_start();
				error_reporting(-1);
				ini_set('display_errors', 'On');

				?>






				<div id="sites">
					<ul>
						<li><a href="./index.php">Home Page</a></li>

						<?php

						if(isset($_SESSION["user"])) { 

							$user_type = trim($_SESSION["user"]["user_type"]);

							echo '<li><a href="./user-logout.php">Logout</a></li>' ;

							echo '<li><a href="./profile-display.php">View Profile</a></li>' ;

							echo '<li><a href="./profile-city-select.php">Search Profiles</a></li>' ;

							echo '<li><a href="./profile-search-results.php?value=1">Search Results</a></li>' ;

							echo '<li><a href="./user-password-change.php">Change Password</a></li>' ;

							echo '<li><a href="./profile-images.php">Profile Picture</a></li>' ;

							

							echo '<li><a href="./user-update.php">User Update</a></li>';

							if($user_type == ADMIN)
							{
								echo '<li><a href="./admin.php">Admin</a></li>';

								echo '<li><a href="./disabled-users.php?value=1">Disabled Users</a></li>';
							}
							else
							{
								echo '<li><a href="./user-dashboard.php">Dashboard</a></li>';
							}

							if($user_type == ADMIN || $user_type == CLIENT )

								echo '<li><a href="./interests.php">View Your Matches</a></li>' ;



							if($user_type == INCOMPLETE)
							{
								echo '<li><a href="./profile-create.php">Create a Profile</a></li>' ;
							}

								

							else{

								echo '<li><a href="./profile-create.php">Update Profile</a></li>' ;
							}








						}else{

							echo '<li><a href="./user-login.php">Login</a></li>' ;

							echo '<li><a href="./user-register.php">Register User</a></li>';

							echo '<li><a href="./user-password-request.php">Forgot Your Password?</a></li>';

							echo '<li><a href="./profile-city-select.php">Search Profiles</a></li>' ;

						}




						?>






					</ul>
				</div>


				<div id="content-container">

					<div id="content">