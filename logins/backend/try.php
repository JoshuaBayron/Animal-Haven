<?php
require_once 'connection.php';
include 'functions.php';

function confirmLogout($details) {
    echo <<<EOD
        <script>
            Swal.fire({
                title: 'WARNING',
                text: '$details',
                icon: 'warning',
                confirmButtonColor: 'green',
                confirmButtonText: 'Okay'
            }).then(({ isConfirmed }) => isConfirmed && (window.location.href = '../../index.php#about'));
        </script>
EOD;
}
// Get POST data
$username = $_POST['username'];
$password = $_POST['pass'];

// Check the customer table
$sql = "SELECT * FROM customers WHERE email = '$username'";
$result = $conn->query($sql);

if ($result === false) {
    // Query failed
    die("Error in query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Customer found
    $row = $result->fetch_assoc();
    $hashedPassword = $row['pass'];

    // Verify the hashed password
    if (password_verify($password, $hashedPassword)) {
        customer($conn, $username, $password); 
        exit();
    }
}

// Check the staff table
$sql = "SELECT * FROM staff WHERE email = '$username'";
$result = $conn->query($sql);

if ($result === false) {
    // Query failed
    die("Error in query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Staff found
    $row = $result->fetch_assoc();
    $hashedPassword = $row['pass'];

    // Verify the hashed password
    if (password_verify($password, $hashedPassword)) {
        staff($conn, $username, $password); 
        exit();
    }
}

// Check the admin table
$sql = "SELECT * FROM `admins` WHERE user = '$username' AND pass = '$password'";
$result = $conn->query($sql);

if ($result === false) {
    // Query failed
    die("Error in query: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Admin found
    admin($conn, $username, $password);
    exit();
}

// User not found or incorrect password
header('HTTP/1.1 401 Unauthorized');
confirmLogout("Credentials Not Found!");

// Close the connection
$conn->close();
?>
