<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
</body>
</html>
<?php
session_start();

if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];

    // echo "" . $_SESSION["username"];
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["appointment_id"])) {
        $appointment_id = $_GET["appointment_id"];

        // Perform database delete using a prepared statement
       include 'connection.php';

        $query = "DELETE FROM appointment_archive WHERE appointment_id = ? AND customer_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Preparation failed: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "is", $appointment_id,$customer_id);

        if (mysqli_stmt_execute($stmt)) {
            // echo "Pet data deleted successfully.";
            // header("Location: ../animal-status.php");
             echo "<script>
                Swal.fire({
                    title: 'Appointment deleted successfully',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../appointment_archive.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
        } else {
            // echo "Error deleting pet data: " . mysqli_stmt_error($stmt);
              echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Error deleting Appointment:',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../appointment_archive.php'; // Redirect to desired page after error
                    }
                });
            </script>";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
    echo "You need to be logged in to delete pet data.";
}
?>
