<?php
// connection.php
$host="localhost"; 				// Host name 
$username="jdenocco_root"; 		// Mysql username 
$password="root_pass"; 			// Mysql password 
$db_name="jdenocco_wedding";	// Database name 

mysql_connect("$host", "$username", "$password")or die("Connection error. Try again later");
mysql_select_db("$db_name")or die("Database connection error. Try again later");
?>