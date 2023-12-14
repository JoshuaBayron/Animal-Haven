
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
include 'connection.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['appointment_id'])) {
    $appointment_id = $_GET['appointment_id'];

    // Fetch the pet data based on the provided ID
    $sql_select = "SELECT * FROM appointment WHERE appointment_id = $appointment_id";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        // Fetch the data
        $appontment_data = $result_select->fetch_assoc();

        // Insert the data into the archive_pets table
        $sql_insert = "INSERT INTO appointment_archive (appointment_service, appointment_status, start_event_date,end_event_date,remarks,animals_id,staff_id,customer_id,referral_no,appoint_status) VALUES ('" . $appontment_data['appointment_service'] . "','" . $appontment_data['appointment_status'] . "','" . $appontment_data['start_event_date'] . "','" . $appontment_data['end_event_date'] . "','" . $appontment_data['remarks'] . "','" . $appontment_data['animals_id'] . "','" . $appontment_data['staff_id'] . "','" . $appontment_data['customer_id'] . "','" . $appontment_data['referral_no'] . "','" . $appontment_data['appoint_status'] . "')";
        $conn->query($sql_insert);

        // Delete the pet from the pets table
        $sql_delete = "DELETE FROM appointment WHERE appointment_id = $appointment_id ";
        $conn->query($sql_delete);

        // echo "Pet deleted and archived successfully.";
        // header("Location: ../animal-info.php");
         echo "<script>
                Swal.fire({
                    title: 'Sent to Trash',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
    } else {
        // echo "Pet not found.";
         echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Appointment not found',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after error
                    }
                });
            </script>";
    }
} else {
    // echo "Invalid request.";
     echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Pet not found',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after error
                    }
                });
            </script>";
}

// Close the database connection
$conn->close();
?>
