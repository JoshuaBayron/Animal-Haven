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

    $sql_admin = "SELECT * FROM staff";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_staff_id = $row_admin['staff_id'];
    $actlog_position = $row_admin['position'];
    $actlog_firstname = $row_admin['firstname'];
    $actlog_lastname = $row_admin['lastname'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position named $actlog_firstname $actlog_lastname UPDATED the appointment status as $newAppointmentStatus at $currentDateTime";

    $updateQuery = "UPDATE appointment SET appointment_status = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $newAppointmentStatus, $appointmentId);

     $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,lastname,description,time_stamp) VALUES (?, ?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("isssss", $actlog_staff_id, $actlog_position, $actlog_firstname,$actlog_lastname, $description, $currentDateTime);

    if ($stmt->execute() && $add_activitylog_stmt->execute()) {
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