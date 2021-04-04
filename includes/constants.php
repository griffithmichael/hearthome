<?php 

//DB CONSTANTS

 define('DB_HOST', 'host=localhost' );
 define('DB_NAME', 'dbname=group04_db');
 define('DB_USER', 'user=group04_admin');

 define('DB_PASSWORD', 'password=purple1');

 //PASSWORDS

define('HASH_TYPE', 'md5');
define('SALT', 'QxLUF1bgIAdeQX' );

define ("COOKIE_EXPIRY", 2592000 );  //60*60*24*30

//CLIENT-DEFINE

define ("MIN_CHAR_USER", 6 );
define ("MAX_CHAR_USER", 20 );
define ("MIN_AGE_USER", 18 );
define ("MIN_PASS_USER", 8 );
define ("MAX_PASS_USER", 20 );
define ("MAX_PER_PAGE", 10);
define ("MAX_PHOTO", 3000000);

define ("MAX_NAME_USER", 20 );

define ("ALL_LOCATIONS", 127 );

define ("MAX_USERS", 200 );

define("MATCHES_PER_PAGE", 10);

define("MAXIMUM_PROFILE_IMAGES",4);


//CLIENT-TYPE

define("ADMIN","a");
define("CLIENT", "c");
define("INCOMPLETE","i");
define("DISABLED_CLIENT","dc");
define("DISABLED_ADMIN","da");




define("E","email");
define("T","phone");
define("M","posted_mail");

define("OPEN","O");
define("CLOSED","C");





?>
