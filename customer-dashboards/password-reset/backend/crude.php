<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</body>
</html>
<?php
require_once 'connection.php';
include 'functions.php';

$username = $_POST["username"];
$password = $_POST["pass"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $roles = $_POST["role"];

    switch ($roles) {
        case "admin":
            admin($conn, $username, $password);
            break;

        case "customer":
            customer($conn, $username, $password);
            break;

        case "staff":
            staff($conn, $username, $password);
            break;

        case "customer_reg":
            registerCustomer($conn, $username, $password);
            break;

        default:
            errorMessage("Invalid Role!");
            break;
    }
} else {
    errorMessage("Invalid Request!");
}

$conn->close();
?>