<?php


$servername = "localhost";  // Change to localhost
$username = "localhost";   // Change to the correct DB username
$password = ""; // Use the correct DB password
$dbname = ""; 


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    exit();
}

?>
