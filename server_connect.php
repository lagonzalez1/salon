<?php

// Notes:
// When needing to deploy to real server
// Servername: will be given not assigned
// Username: Will be made if you choose to secure
// Password: Will be made if you choose to secure
// db_name: Root directory for database
// Example: client_database_2020
//            - client_upgrade -> Holds data for appointments
//            - user_login_permissions -> Hold login permissions for client


$db_servername = "localhost";
$db_username = "root"; // because using XAMPP
$db_password = "";
$db_name = "client_database_2020";


$connection = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

 if(!$connection) {
 	// Hanlde Errors via User Interface
 	die("Connection failed: " . mysqli_connect_error());
 	header("Location: error_restricted.html");
 }







    // Error was most likely tthe  closing "php >"
