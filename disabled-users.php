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

	if(isset($_SESSION['user']))
	{
		$user_type = trim($_SESSION['user']['user_type']);

		//echo $user_type;

		if($user_type != ADMIN)
		{
			header("Location: index.php");
		}



		 $resource = pg_execute($dbconn, 'find_by_type',[DISABLED_CLIENT]);

		 $matching_profiles = pg_fetch_all($resource);

		 $amount_matches = pg_num_rows($resource);


		 $amount_pages = ceil($amount_matches/MATCHES_PER_PAGE);


		 $page_no = 0;


		 foreach ($matching_profiles as $key => $value) {
			
				$match_id = $value['user_id'];

				$matches_by_page[] = $match_id;

			}


				for($i=0; $i < $amount_matches; $i++)
				{
					

					if(($i % MAX_PER_PAGE) == 0)
					{
						$page_no++ ;
					//	echo $page_no;
						
					}

					$matches_on_page[$page_no][] = $matches_by_page[$i];


				}


						makeNavBar("disabled-users.php",$matches_on_page,$amount_pages);


 if($_SERVER["REQUEST_METHOD"] == "GET")
      {



      if (isset($_GET['value']))
      {
      		$view_page = $_GET['value'];

      		foreach ($matches_on_page[$view_page] as $key => $value) {

      			profile_preview($value);


      		}
      		

      }


    
   }

   			makeNavBar("disabled-users.php",$matches_on_page,$amount_pages);
	}

	else
	{
		header("Location: index.php");
	}





?>




<?php include 'footer.php'; ?>




