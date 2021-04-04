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


$sql = "SELECT profiles.user_id FROM profiles, users WHERE 1 = 1" ;




        if(isset($_COOKIE['cities']))
    	{
      		$city = $_COOKIE['cities'];

      		$search_message = "Searching for matches in: ";


	      		$cities_selected =  sum_values($city);

	      		$sql_city = "profiles.city = " . $cities_selected[0];
	      		$search_message .= get_property("city",$cities_selected[0]) . " ";

	      		if (count($cities_selected > 1))
	      		{

		      		for ($i=1; $i < count($cities_selected) ; $i++) { 

		      			$search_message .= get_property("city",$cities_selected[$i]) . " ";

		      			$sql_city .= " OR profiles.city = " . $cities_selected[$i];

		      		}
	      		}

	      		if ($city == ALL_LOCATIONS)
      			{
      			$search_message = "Searching for matches in: All available locations";	
      			}



      		}
      		else
      		{

      			header("Location: profile-city-select");

      			$_SESSION['redirect_message'] = "You must select a city before looking for matches";

      		}

      		




    		





    if($_SERVER["REQUEST_METHOD"] == "GET")
    {

    		$eye_colour = isset($_COOKIE['eye_colour']) ? $eye_colour = $_COOKIE['eye_colour'] : "";
      		$highest_education = isset($_COOKIE['highest_education']) ? $highest_education = $_COOKIE['highest_education'] : "";
      		$religious = isset($_COOKIE['religious']) ? $religious = $_COOKIE['religious'] : "";
      		
      		$smoker = isset($_COOKIE['smoker']) ? $smoker = $_COOKIE['smoker'] : "";
      		$want_children = isset($_COOKIE['want_children']) ? $want_children = $_COOKIE['want_children'] : "";
	   		$hair_colour = isset($_COOKIE['hair_colour']) ? $hair_colour = $_COOKIE['hair_colour'] : "";
	   		
	   		$bilingual = isset($_COOKIE['bilingual']) ? $bilingual = $_COOKIE['bilingual'] : "";
	   		$drinker = isset($_COOKIE['drinker']) ? $drinker = $_COOKIE['drinker'] : "";
	   		$coffee_tea = isset($_COOKIE['coffee_tea']) ? $coffee_tea = $_COOKIE['coffee_tea'] : "";

	   		$gender = isset($_COOKIE['gender']) ? $gender = $_COOKIE['gender'] : "";
	   		$gender_sought = isset($_COOKIE['gender_sought']) ? $gender_sought = $_COOKIE['gender_sought'] : "";

    	$error = false;






   	}
   else if($_SERVER["REQUEST_METHOD"] == "POST")
   	{

   		/*$eye_colour = "";
   		$hair_colour = "";
   		$highest_education = "";
   		$religious = "";
   		$smoker = "";
   		$want_children = "";
   		$coffee_tea = "";
   		$gender_sought = $_POST['gender_sought'];
   		$gender = $_POST['gender'];

   		$bilingual = "";
   		$drinker = "";*/

   			$eye_colour = isset($_POST['eye_colour']) ? $eye_colour = sumCheckBox($_POST['eye_colour']) : "";
      		$highest_education = isset($_POST['highest_education']) ? sumCheckBox($highest_education = $_POST['highest_education']) : "";
      		$religious = isset($_POST['religious']) ? sumCheckBox($religious = $_POST['religious']) : "";
      		
      		$smoker = isset($_POST['smoker']) ? $smoker = sumCheckBox($_POST['smoker']) : "";
      		$want_children = isset($_POST['want_children']) ? sumCheckBox($want_children = $_POST['want_children']) : "";
	   		$hair_colour = isset($_POST['hair_colour']) ? sumCheckBox($hair_colour = $_POST['hair_colour']) : "";
	   		
	   		$bilingual = isset($_POST['bilingual']) ? sumCheckBox($bilingual = $_POST['bilingual']) : "";
	   		$drinker = isset($_POST['drinker']) ? sumCheckBox($drinker = $_POST['drinker']) : "";
	   		$coffee_tea = isset($_POST['coffee_tea']) ? sumCheckBox($coffee_tea = $_POST['coffee_tea']) : "";

	   		$gender = isset($_POST['gender']) ? $gender = $_POST['gender'] : "";
	   		$gender_sought = isset($_POST['gender_sought']) ? $gender_sought = $_POST['gender_sought'] : "";	

	   		setcookie('eye_colour', $eye_colour, time() + COOKIE_EXPIRY);
	   		setcookie('highest_education', $highest_education, time() + COOKIE_EXPIRY);
	   		setcookie('religious', $religious, time() + COOKIE_EXPIRY);
	   		setcookie('smoker', $smoker, time() + COOKIE_EXPIRY);
	   		setcookie('want_children', $want_children, time() + COOKIE_EXPIRY);
	   		setcookie('hair_colour', $hair_colour, time() + COOKIE_EXPIRY);
	   		setcookie('bilingual', $bilingual, time() + COOKIE_EXPIRY);
	   		setcookie('drinker', $drinker, time() + COOKIE_EXPIRY);
	   		setcookie('coffee_tea', $coffee_tea, time() + COOKIE_EXPIRY);
	   		setcookie('gender', $gender, time() + COOKIE_EXPIRY);
	   		setcookie('gender_sought', $gender_sought, time() + COOKIE_EXPIRY);




   		//dump($_POST);
   		foreach($_POST as $key => $value){
   			$value = is_array($value) ? sumCheckBox($value) : $value;

   			
   		

   			//echo "Key: " .  $key . " and value: " .$value . "<br/>";

   			if ($key != "search")
   			{

   				setcookie($key, $value, time() + COOKIE_EXPIRY);

   				//print_r($_COOKIE);


   				$selections = sum_values($value);

   				if($key == "gender")
   				{
   					
   					$key = "gender_sought";
   				}
   				else
   				{

   					if($key == "gender_sought")
   					{
   					$key = "gender";

   					}


   				}
   				



   				$sql .= " AND (" .$key . " = " . $selections[0];

	      		if (count($selections > 1))
	      		{

		      		for ($i=1; $i < count($selections) ; $i++) { 

		      			$sql .= " OR " . $key . " = " . $selections[$i];



		      			//echo $sql_eye;

		      		}
	      		}
	      		$sql .= ")";





   			}	
   		}

   		$sql .= " AND users.user_id = profiles.user_id AND users.user_type <> 'dc'
	ORDER BY users.last_access DESC LIMIT " .MAX_USERS;


		//$one_sql = "SELECT user_id FROM users where user_id = 'griffm'";

   		//echo $sql;

		//	echo $sql;

   			$query = pg_query($dbconn, $sql);

   			$matching_profiles = pg_fetch_all($query);

   			$amount_matches = pg_num_rows($query);




   			if($amount_matches == 0)
			{
				echo "Sorry, no matches found! Try broadening your search criteria";
			}
			elseif ($amount_matches == 1) 
			{
				

				foreach ($matching_profiles as $key => $value) {
			
				$match_id = $value['user_id'];

				}

				//echo $match_id;

				header("Location: profile-view.php?value=".$match_id."");
				

			}
			elseif ($amount_matches > 1)
			{
				

				$_SESSION['matches']['profiles'] = $matching_profiles;

   				$_SESSION['matches']['amount'] = $amount_matches;	

   				header("Location: profile-search-results.php?value=1");

			}

				//print_r($_SESSION['matches']['profiles']);




			}






   		


    	



	     

	      






    

   
   ?>  

<p><?php echo $search_message; ?> </p>
	
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

<table >
	<tbody>

		<tr>
			<td>I am a: </td>
			<td><?php build_radio("gender", $gender); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>

		<tr>
			<td>Looking for: </td>
			<td><?php build_radio("gender_sought", $gender_sought); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>


		<tr>
			<td>Eye Colour:</td>
			<td><?php build_checkbox("eye_colour", $eye_colour); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>



		<tr>
			<td>Hair Colour: </td>
			<td><?php build_checkbox("hair_colour", $hair_colour); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>



		<tr>
			<td>Highest Education: </td>
			<td><?php build_checkbox("highest_education", $highest_education); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>

		<tr>
			<td>Religious Preferences: </td>
			<td><?php build_checkbox("religious", $religious); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>


		<tr>
			<td>Smoker ? </td>
			<td><?php build_checkbox("smoker", $smoker); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>


		<tr>
			<td>Child Preferences </td>
			<td><?php build_checkbox("want_children", $want_children); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>




		<tr>
			<td>Coffee or Tea? </td>
			<td><?php build_checkbox("coffee_tea", $coffee_tea); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>




		<tr>
			<td>Bilingual? </td>
			<td><?php build_checkbox("bilingual", $bilingual); ?> </td>
		</tr>

		<tr>
			<td><br/> </td>
		</tr>




		<tr>
			<td>Drinker? </td>
			<td><?php build_checkbox("drinker", $drinker); ?> </td>
		</tr>




		<tr>
			<td><input name="search" type="submit" value="Search"/> </td>
		</tr>


	</tbody>
</table>

</form>



<?php include 'footer.php'; ?>
