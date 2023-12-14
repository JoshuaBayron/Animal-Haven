<?php
// Include your database connection file
include('connection.php');

if (isset($_POST['customer_id'])) {
    $customerId = $_POST['customer_id'];

    $updateQuery = "UPDATE customers SET verify_status = 1 WHERE customer_id = $customerId";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo 'Account verified successfully';
    } else {
        echo 'Error verifying account';
    }
} else {
    echo 'Invalid request';
}
