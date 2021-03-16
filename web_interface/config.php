<?php
/* Place your username and password for phpMyAdmin*/
/*define('DB_SERVER', 'classmysql.engr.oregonstate.edu');
define('DB_USERNAME', 'cs340_shifflej');
define('DB_PASSWORD', '');
define('DB_NAME', 'cs340_shifflej');
 */

//Stuff for local testing.
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'CS340_testing');


/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Check connection
if($link === false){
    echo "<script>console.log('Issue with link');</script>";
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
