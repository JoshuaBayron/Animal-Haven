<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    </head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
</body>
</html>



<?php
session_start();
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $contact_number = $_POST['contact'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $middle_initial = $_POST['middle_initial'];
    $email = $_POST['email'];
    // $password = $_POST['password'];
    $address = $_POST['address'];

    // Assuming you have a 'users' table with 'first_name', 'last_name', 'email' columns
    // and you want to update based on a user ID (replace 123 with the actual user ID)
    $customer_id = $_SESSION['customer_id'];

    // $sql = "UPDATE customers SET firstname = '$fname', lastname = '$lname', email = '$email', pass = '$password' WHERE customer_id = '$customer_id'";

    $sql = "UPDATE customers
        INNER JOIN customer_contact_infos ON customers.customer_id = customer_contact_infos.customer_id
        SET customers.firstname = '$fname',
            customers.lastname = '$lname',
            customers.email = '$email',
            customers.MI = '$middle_initial',
            customers.Address = '$address',
            customer_contact_infos.contact_number = '$contact_number'
        WHERE customers.customer_id = '$customer_id'";



    if ($conn->query($sql) === TRUE) {
        // echo "Profile updated successfully.";
        // header('Location: ../user.php');
         echo "<script>
                Swal.fire({
                    title: 'Profile updated successfull!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../user.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
    } else {
        echo "Error updating profile: " . $conn->error;
          echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to Update.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../user.php'; // Redirect to desired page after error
                    }
                });
            </script>";
    }
}

$conn->close();
?>
