<?php
include 'connection.php';

$sqlAppointment = "SELECT t1.*, t2.* FROM appointment t1
                  JOIN animals t2 ON t1.animals_id = t2.animals_id
                  ";
$resultAppointment = $conn->query($sqlAppointment);

if (!$resultAppointment) {
    die("Query failed: " . $conn->error);
}

if (isset($_POST['update'])) {
    $newAppointmentStatus = $_POST['new_appointment_status'];
    $appointmentId = $_POST['appointment_id'];
    $updateQuery = "UPDATE appointment SET appointment_status = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newAppointmentStatus, $appointmentId);

    if ($stmt->execute()) {
        // Update successful
        // Redirect or display a success message
    } else {
        // Update failed, handle the error
        echo "Update failed: " . $stmt->error;
    }
    $stmt->close();
}

// Handle appointment deletions
if (isset($_POST['delete'])) {
    $appointmentId = $_POST['appointment_id'];

    // Delete the appointment from the database
    $deleteQuery = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        // Deletion successful
        // Redirect or display a success message
    } else {
        // Deletion failed, handle the error
        echo "Deletion failed: " . $stmt->error;
    }
    $stmt->close();
}
?>