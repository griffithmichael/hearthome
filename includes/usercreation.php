<?php
require_once(includes/names.php)

$ucount = 100;
$dbconn = db_connect();

//array_rand()
//array_splice();

while($ucount){


if ($ucount % 2 === 0){

	$first_name = array_splice($female_names, 
		array_rand($female_names),
		1
	);
}else{
	first_name = array_splice($male_names,array_rand($male_names),1);
}

	last_name = array_splice(
		$last_names,
		array_rand($last_names),
		1
	);


$id = $last_name . $first_name[0];

$email = $id . "@websitename.com"

$params = [
'id' => $id,
'first_name' => $first_name,
'last_name' => $last_name,
'email' => $email,
'phone' => $phone,
'password' => $password,
]
?>

