<?php 
$servername = "localhost";
$username = "id21596882_root";
$password = "Animal@123";
$dbname = "id21596882_pawheaven";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>