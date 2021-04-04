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


	if(isset($_COOKIE["user_id"])) {
    
	session_unset($_SESSION['user']);
    session_destroy(); 

	unset($_SESSION['user']);

	 session_start();

	$_SESSION['message'] = "You have successfully logged out! Login below ";

	
	header("Location: user-login.php");
}
	
	
	

?>







<?php include 'footer.php'; ?>




