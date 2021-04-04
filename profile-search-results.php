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



	if(isset($_SESSION['matches']))
	{

		 $amount_matches = $_SESSION['matches']['amount'];

		 $matching_profiles = $_SESSION['matches']['profiles'];

		 $amount_pages = ceil($amount_matches/MATCHES_PER_PAGE);

		//echo $amount_pages;

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


						makeNavBar("profile-search-results.php",$matches_on_page,$amount_pages);






				


					








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

   			makeNavBar("profile-search-results.php",$matches_on_page,$amount_pages);
	}

	else
	{
		header("Location: profile-city-select.php");
	}





?>




<?php include 'footer.php'; ?>




