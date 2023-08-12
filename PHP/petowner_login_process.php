<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pawpointment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM customertbl WHERE UserName = '$username' AND Password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $_SESSION['username'] = $username;
    header("Location: ../customer-dashboard/user.php");
} else {
    echo "Login failed. Please check your username and password.";
}

$conn->close();
?>


 <!-- Check if the user exists
         $sql = "SELECT CustomerID, UserName,Password FROM customertbl WHERE UserName='$username'";
         $result = $conn->query($sql);

         if ($result->num_rows === 1) {
             $row = $result->fetch_assoc();
             if (password_verify($password, $row['Password'])) {
                 // Password is correct, set session variables
                 $_SESSION['Customerid'] = $row['CustomerID'];
             $_SESSION['UserName'] = $row['username'];
               header("Location: ../customer-dashboard/user.php"); // Redirect to dashboard or home page
            } else {
                 echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }-->