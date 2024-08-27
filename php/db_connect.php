<?php
// Database configuration
$servername = "localhost"; // Usually "localhost"
$username = "root";        // Your MySQL username (default is "root" for XAMPP/WAMP)
$password = "";            // Your MySQL password (leave blank for XAMPP/WAMP)
$dbname = "ims";          // The name of your database
$portname = "3306";
       // The port number of your database (default is 3306 for XAMPP/WAMP)

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname, $portname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
