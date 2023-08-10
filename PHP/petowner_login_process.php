<?php
session_start(); // Start session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection parameters
    $host = 'localhost';
    $user = 'root';
    $passwordDb = '';
    $database = 'pawpointment';

    // Create a database connection
    $conn = new mysqli($host, $user, $passwordDb, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user exists
    $sql = "SELECT CustomerID, UserName,Password FROM customertbl WHERE UserName='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            // Password is correct, set session variables
            $_SESSION['Customerid'] = $row['CustomerID'];
            $_SESSION['UserName'] = $row['username'];
            header("Location: ../customer-dashboard/index.php"); // Redirect to dashboard or home page
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>