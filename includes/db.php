<?php
//include 'sql/value-only.sql';
function db_connect(){
	//sprintf %s 
	
	
	
	$db = pg_connect("host=localhost dbname=hearthome_db user=griffithm password= ");
//	$db = pg_connect(DB_HOST . " " . DB_NAME . " " . DB_USER . " " . DB_PASSWORD);


	
		return $db;
		
}	
$dbconn = db_connect();

$stmt1 = pg_prepare($dbconn, 'user_find_by_id', 'SELECT * FROM users WHERE user_id= $1');
$stmt2 = pg_prepare($dbconn, 'user_id_and_email', 'SELECT * FROM users WHERE user_id= $1 and email_address = $2');
$stmt3 = pg_prepare($dbconn, 'user_find_by_profile', 'SELECT * FROM profiles WHERE user_id= $1');

$stmt4 = pg_prepare($dbconn, 'profile_preview', 'SELECT user_id, headline, self_description, match_description 
		FROM profiles WHERE user_id= $1');


$stmt5 = pg_prepare($dbconn,'profile_create', 'INSERT INTO profiles(user_id, gender, gender_sought, city, images, headline, self_description, match_description, bilingual, drinker, eye_colour, hair_colour, highest_education, religious, smoker, want_children, coffee_tea) 

			      VALUES($1,$2, $3,$4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17)'); 
		

$stmt6 = pg_prepare($dbconn,'profile_update', 'UPDATE profiles SET gender = $2, gender_sought = $3, city = $4, images = $5, 
	headline = $6, self_description = $7, match_description = $8, bilingual = $9, drinker = $10, eye_colour = $11, hair_colour = $12, highest_education = $13, religious = $14, smoker = $15, want_children = $16, coffee_tea = $17

		WHERE user_id = $1'

	);


$stmt7 = pg_prepare($dbconn, 'complete_user', "UPDATE users SET user_type = 'c' WHERE user_id = $1");

$stmt8 = pg_prepare($dbconn, 'change_password', "UPDATE users SET password = $1 WHERE user_id = $2");

$stmt9 = pg_prepare($dbconn, 'confirm_password', 'SELECT password FROM users WHERE user_id= $1 and password = $2');

//$stmt4 = pg_prepare($dbconn, 'users_complete', 'UPDATE users SET user_type = c');

$stmt10 = pg_prepare($dbconn, 'create_user', "INSERT INTO users(user_id, password, user_type, email_address, first_name, last_name, birth_date, enrol_date, last_access) 
			      VALUES($1,$2,$3,$4, $5, $6, $7, $8,$9)");


$stmt11 = pg_prepare($dbconn, 'update_user', "UPDATE users SET email_address = $2, first_name = $3, last_name = $4, birth_date = $5 
			      

			      WHERE user_id = $1" );


$stmt12 = pg_prepare($dbconn, 'update_pictures', "UPDATE profiles SET images = $2 WHERE user_id = $1" );

$stmt13 = pg_prepare($dbconn, 'check_email', "SELECT email_address FROM users WHERE email_address=$1");

$stmt15 = pg_prepare($dbconn, 'update_user_type', "UPDATE users SET user_type = $2 WHERE user_id = $1" );


$stmt16 = pg_prepare($dbconn,'show_interest', 'INSERT INTO interests(user_id, interested_in, date_of)

					VALUES ($1, $2, $3)');

$stmt19 = pg_prepare($dbconn,'remove_interest', 'DELETE FROM interests WHERE

					user_id = $1 and interested_in = $2');

$stmt17 = pg_prepare($dbconn,'offended_by', 'INSERT INTO offenses(user_id, offended_by, date_of,status)

					VALUES ($1, $2, $3,$4)');

$stmt18 = pg_prepare($dbconn,'check_interest', 'SELECT * FROM interests where user_id = $1 and interested_in =$2');

$stmt18 = pg_prepare($dbconn,'check_offense', "SELECT * FROM offenses where user_id = $1 and offended_by =$2 AND status <> 'C'");

$stmt19 = pg_prepare($dbconn, 'find_by_type', 'SELECT * FROM users WHERE user_type= $1');

$stmt20 = pg_prepare($dbconn, 'update_offensive', "UPDATE offenses SET status = $2 WHERE offended_by = $1" );

$stmt21 = pg_prepare($dbconn,'interest_in', 'SELECT interested_in FROM interests where user_id = $1');

$stmt22 = pg_prepare($dbconn,'interest_from', 'SELECT user_id FROM interests where interested_in =$1');

$stmt22 = pg_prepare($dbconn,'mutual_interest', 'SELECT c2.user_id FROM interests c1
        																INNER JOIN
																	    interests c2 
																	    ON c1.interested_in = c2.user_id
																	    AND c2.interested_in = c1.user_id
																	    WHERE c1.user_id=$1');





function is_user_id($user_id){
			
		$dbconn = db_connect();	
		$sql = "SELECT *
				FROM users
				WHERE user_id='" . $user_id . "'";
				
		$resource = pg_query($dbconn, $sql);
		
		if(pg_num_rows($resource) !=0)
		{
			return true;
		}
		else
		{
			return false;
		}
	
}


function remove_quotes($name){


	$name = str_replace("'", "", $name);

	return $name;


}



	
	
	
	 function build_dropdown($table, $selected)
{	
	global $dbconn;

$sql = "SELECT property, value from "  . $table;
		
		$result = pg_query($dbconn, $sql);
		
		// Return wether or not the data exists within the database

		echo '<select name="' . $table . '">';
	while($row = pg_fetch_array($result)){


		 			if ($row['value'] == $selected)
 			{
 				echo '<option value="' .$row['value'].'" selected="selected" >' .$row['property'].' </option>';
 			}
 			else
 			{
 				echo '<option value="'.$row['value'].'">' .$row['property'].' </option>';
 			}


		

	}
	echo "</select>";
		
		
	//	return $result;
		

		
	}


	 function build_radio($table, $selected)
{	
	global $dbconn;

	$isselected = "";

$sql = "SELECT property, value from "  . $table;
		
		$result = pg_query($dbconn, $sql);
		


		
	//	return $result;


 		while($row = pg_fetch_array($result)){


 			if ($row['value'] == $selected)
 			{
 				echo '<input type="radio" name="'.$table.'" value="'.$row['value'].'" checked="checked" />' .$row['property'].' <br/>';
 			}
 			else
 			{
 				echo '<input type="radio" name="'.$table.'" value="'.$row['value'] . '" />' .$row['property'].' <br/>';
 			}

 				
 		}
		

		
	}


function build_checkbox($table, $selected = "")
{	
	global $dbconn;

	$isselected = "";
	$selected = (is_numeric($selected)) ? (int)$selected : "";
	$sql = "SELECT property, value from "  . $table;
		
		$result = pg_query($dbconn, $sql);


	//	return $result;


 		while($row = pg_fetch_array($result)){


 			//dump($row);

 			if ($row['value'] != 0)
	 		{
	 			//echo "row: |" . $row['value'] . "| selected: |" . $selected . "| row and selected: |" . ($row['value'] & $selected) . "|<br/>";
	 			//echo $row['value'];
				//dump($selected);
				if ($row['value'] & $selected)
				{

					echo '<input type="checkbox" name="'.$table. '[]'.'"value="'.$row['value'].'" checked="checked" >' .$row['property'].' <br/>';
				}
				else
				{
					echo '<input type="checkbox" name="'.$table. '[]'.'"value="'.$row['value'] . '">' .$row['property'].' <br/>';
				}

			}
 				
 		}
		

		
	}
	





function get_property($table, $value)
{
	global $dbconn;

	$sql = "SELECT * FROM " . $table . " WHERE value = " . $value;
	$result = pg_query($dbconn, $sql);
	$row = pg_fetch_assoc($result);
	return $row['property'];
}






	
	
	
	
		 function create_array($table, $column, $text)
{	
	$created_array = array();


	$db_conn = db_connect();

$sql = "SELECT " . $table . "." . $column . ", " . $table . "." . $text . "
					FROM " . $table;
		
		$result = pg_query($db_conn, $sql);
		

	while($row = pg_fetch_array($result)){
		$created_array[] = $row[$text];
	}
		
		
		return $created_array;
		

		
	}
	
	
		 function value_array($table, $column)
{	
	$value_array = array();


	$db_conn = db_connect();

$sql = "SELECT "  . $table . "." . $column . " 
					FROM " . $table;
		
		$result = pg_query($db_conn, $sql);
		

		
	while($row = pg_fetch_array($result)){


			if ($row['value'] != 0){

				$value_array[] = $row[$column];

			}



	}
		
		return $value_array;
				
}
	
	
	
	
	
	
	
	
	
	
function random_entry($array)
{
	
	$random_key;
	$random_element = 0;
	
$random_key = array_rand($array);

$random_element = $array[$random_key];

return $random_element;
}	
	


function profile_preview($user_id)
{

	$dbconn = db_connect();	
		$sql = 'SELECT user_id, images, headline, self_description, match_description 
		FROM profiles WHERE user_id='. "'" . $user_id .  "'";

		$profilepic = "images/profilepics/" . $user_id . "/" . $user_id . "1";
				
		$resource = pg_query($dbconn, $sql);
		
		
		$profile_preview = pg_fetch_assoc($resource);

				$headline = $profile_preview['headline'];
				$self_description = $profile_preview['self_description'];
				$match_description = $profile_preview['match_description'];
				$images = $profile_preview['images'];


				//echo $headline;

				echo	"<table >";
				echo	"<tbody>";



				echo		"<tr>";
				echo			"<td>". "<a href='profile-view.php?value=".$user_id."'>" . $user_id. "</a> </td>";
				

				echo			"<td>" . $headline . "</td>";

				echo		"</tr>";


				echo		"<tr>";
				

				if ($images > 0)
				{

						echo '<img src="'.$profilepic.".jpg?". time() .  '" alt="Profile_Picture height="84" width="84">';						
					
				}
				else
				{
					echo			'<td> <img src="images/image_unavailable.png" alt="NoImageFound" /> </td>';
				}













				
				



				echo			"<td>" . $self_description . "</td>";
				echo		"</tr>";

				echo	"</tbody>";
				echo "</table>";
				echo "<br/>";


}






	
	
	
?>
