<?php include 'constants.php';

function db_connect(){
	//sprintf %s 
	
	$db = pg_connect("host=localhost dbname=group16_db user=griffithm password=100400546");
		return $db;
}	

?>