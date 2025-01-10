<?php

/**
 * Database connection script
 * 
 * This script establishes a connection to the MySQL database using the provided
 * server name, username, password, and database name.
 * 
 * Variables:
 * - $servername: The hostname of the database server (default is "localhost").
 * - $username: The username to connect to the database (default is "root").
 * - $password: The password to connect to the database (default is an empty string).
 * - $dbname: The name of the database to connect to (default is "gctu_library").
 * 
 * Functions:
 * - mysqli_connect(): Attempts to establish a connection to the MySQL database.
 * - mysqli_connect_error(): Returns a string description of the last connection error.
 * 
 * If the connection fails, the script will terminate and output an error message.
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gctu_library";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
