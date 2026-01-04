<!-- conn.php (Database Connection) -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";  // Use your existing DB

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

