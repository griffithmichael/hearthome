<?php 

function dd($value) { die(var_dump($value)); }


function display_copyright(){


	$todayDate = date("d-m-Y", time()); 
//append these host= dbname user= password=
	echo "©GRIFFITH || DEIGHTON || WHITAKER ||" . $todayDate;
}	


function dump($arg){

	echo "<pre>";

	print_r($arg);

	echo "</pre>";

}

function sanitize($field){

	htmlspecialchars(strip_tags(trim($field)));

	return $field;
}

function calculateAge($dateOfBirth){

	$today = date("Y-m-d");

	$diff = date_diff(date_create($dateOfBirth), date_create($today));
	$current_age = $diff->format('%y');

	return $current_age;


//function made in reference to https://www.codexworld.com/how-to/calculate-age-from-date-of-birth-php/


}



//function to validate postal code of canada
function is_valid_postal_code($postal_code)
{
//function by Roshan Bhattara(http://roshanbh.com.np)
	if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$postal_code))

		return true;

	else

		return false;
}


function random_password($length)
{
	$length = $length/2;

	$rand = "";

	$i = 1;

	while ($i <= $length) {

		$rand .= substr(uniqid('', true), -1);

		$rand .= chr(64+rand(0,26)); 

		$i++; 

	}

	return $rand;

}
















function display_phone_number($phoneNumber)
{
	define (PHONE_NUMBER_LENGTH, 10);
	define (EXTENSION, 14);


	if (strlen($phoneNumber) == PHONE_NUMBER_LENGTH)
	{
		$phoneNumber = "(".substr($phoneNumber, 0, 3).")".substr($phoneNumber,3, 3). "=".substr($data,6);
	}
	else if (strlen($phoneNumber) == EXTENSION)
	{
		$phoneNumber = "(".substr($phoneNumber, 0, 3).")".substr($phoneNumber,3, 3). "=".substr($data,6, 10)." ext".substr($data,10) ;
	}
	else
	{
		$phoneNumber = " Invalid phone number";
	}
	return $phoneNumber;
}

/*
this function should be passed a integer power of 2, and any decimal number,
it will return true (1) if the power of 2 is contain as part of the decimal argument
*/
function isBitSet($power, $decimal) {
	if((pow(2,$power)) & ($decimal)) 
		return 1;
	else
		return 0;
} 

/*
this function can be passed an array of numbers (like those submitted as 
part of a named[] check box array in the $_POST array).
*/
function sumCheckBox($array)
{
	$num_checks = count($array); 
	$sum = 0;
	for ($i = 0; $i < $num_checks; $i++)
	{
		$sum += $array[$i]; 
	}
	return $sum;
}



function sum_values($number)
{
//$value[] = array();

	for($i = 0;$i <= $number;)
	{

		if(isBitSet($i,$number))
		{
			$value[] = pow(2,$i);
		}

		$i++;
	}

	return $value;

}

function countFolder($dir) {

	if(is_dir($dir))
	{
		return (count(scandir($dir)) - 2);
	}


}
//Taken from w3guy.com, Author: Collins Agbonghama


function nav_bar($amount_pages,$last_page)
{

	echo'<table >';
	echo'<tbody>';
	echo	'<tr>';
	echo		'<td>Page:</td>';


	if (isset($_GET['value']))
	{

		if($_GET['value'] != 1)
		{

			echo'<td><p><a href="profile-search-results.php?value=1"> << </a></p></td>';
			echo'<td><p><a href="profile-search-results.php?value='.($_GET['value'] -1).'"> < </a></p></td>';
		}



	}


	foreach ($amount_pages as $key => $value) {


		echo'<td><p><a href="profile-search-results.php?value='.$key.'">'.$key.'</a></p></td>';


	}


	if (isset($_GET['value']))
	{

		if($_GET['value'] != $last_page)
		{			      				
			echo'<td><p><a href="profile-search-results.php?value='.($_GET['value'] +1).'"> > </a></p></td>';
			echo'<td><p><a href="profile-search-results.php?value='.$last_page.'"> >> </a></p></td>';
		}



	}

//echo'</td>';
	echo	'</tr>';
	echo'</tbody>';
	echo'</table>';
}


function makeNavBar($page_name,$amount_pages,$last_page)
{

	echo'<table >';
	echo'<tbody>';
	echo	'<tr>';
	echo		'<td>Page:</td>';


	if (isset($_GET['value']))
	{

		if($_GET['value'] != 1)
		{

			echo'<td><p><a href="'.$page_name.'?value=1"> << </a></p></td>';
			echo'<td><p><a href="'.$page_name.'?value='.($_GET['value'] -1).'"> < </a></p></td>';
		}



	}


	foreach ($amount_pages as $key => $value) {


		echo'<td><p><a href="'.$page_name.'?value='.$key.'">'.$key.'</a></p></td>';


	}


	if (isset($_GET['value']))
	{

		if($_GET['value'] != $last_page)
		{			      				
			echo'<td><p><a href="'.$page_name.'?value='.($_GET['value'] +1).'"> > </a></p></td>';
			echo'<td><p><a href="'.$page_name.'?value='.$last_page.'"> >> </a></p></td>';
		}



	}

//echo'</td>';
	echo	'</tr>';
	echo'</tbody>';
	echo'</table>';
}



//at this point you should update the profiles table to set the images
//field back to zero (0) for the user_id you just deleted

/**
* function will allow Apache to recurisvie delete files and, if applicable, sub-folders recursively
* @param String $target - the file/directory 
* @return bool whether the recursive delete occurred or not 
*/
function recursiveDelete($target) {
if (!file_exists($target)){ //no target, implies nothing to delete, function is done
	return true;
}
if (!is_dir($target)) {  //target is a file, not a directory, delete it with unlink() function
return unlink($target); //will return false is Apache does not have write permissions in $target
}

$directoryContents = scandir($target); //target is a directory, get a list of files and directories inside the specified path as an array

foreach ($directoryContents as $file) { //loop through the target's files and sub-directories
//echo "<br/>File/folder to be deleted: " . $file;
if ($file == '..' || $file == '.') { //ignore parent and current diectories in file listing
	continue;
}
if (!recursiveDelete($target. "/" . $file)) {  //delete items, and sub-directories recursively
	return false;
}
}
return rmdir($target); //delete the original target, now empty
}






?>