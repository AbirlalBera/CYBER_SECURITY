<?php
$servername = "localhost";  // Usually localhost for local setup
$username = "root";         // Default XAMPP user
$password = "";             // Default XAMPP password (empty)
$dbname = "test";       // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>