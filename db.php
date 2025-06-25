<?php
$host = "localhost";
$user = "root";       // Default username in XAMPP
$password = "";       // No password by default
$dbname = "results_db";  // This is the database we’ll create soon

// Create connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully"; // Uncomment this line to test
?>
