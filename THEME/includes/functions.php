<?php 

function dd($value) { die(var_dump($value)); }


function display_copyright(){
	
	
	$todayDate = date("d-m-Y", time()); 
	//append these host= dbname user= password=
		echo "Brennan, Griffith, McAllister, Whitaker " .  $todayDate;
}	

?>