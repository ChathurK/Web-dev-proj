<?php
// Database configuration
$servername = "inventsys-svr.mysql.database.azure.com"; // Usually "localhost"
$username = "qcsvrzgcic";        // Your MySQL username (default is "root" for XAMPP/WAMP)
$password = "r00t@azure";        // Your MySQL password (leave blank for XAMPP/WAMP)
$dbname = "ims";                // The name of your database
$portname = "3306";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname, $portname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
