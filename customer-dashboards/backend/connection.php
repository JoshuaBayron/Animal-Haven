<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "id21596882_pawheaven";
$username = "id21596882_root";
$password = "Animal@123";
$dbname = "id21596882_pawheaven";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



?>