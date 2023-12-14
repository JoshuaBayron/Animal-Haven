<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=id21596882_pawheaven", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
    exit;
}

// Get the appointment ID from the POST request
$appointmentId = isset($_GET['appointmentId']) ? $_GET['appointmentId'] : null;

    $sql_admin = "SELECT * FROM staff";
    $result_admin = $db->query($sql_admin);
    $row_admin = $result_admin->fetch(PDO::FETCH_ASSOC);

    $actlog_staff_id = $row_admin['staff_id'];
    $actlog_position = $row_admin['position'];
    $actlog_firstname = $row_admin['firstname'];
    $actlog_lastname = $row_admin['lastname'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position named $actlog_firstname $actlog_lastname DELETED an appointment $appointmentId at $currentDateTime";

if ($appointmentId === null) {
    echo "Appointment ID is missing.";
    exit;
}

try {
    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $appointmentId);  // Use 1 as the parameter index
    $stmt->execute();

     $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,lastname,description,time_stamp) VALUES (?, ?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $db->prepare($sql_activitylog);

    // Bind parameters and execute in a single line
    $add_activitylog_stmt->execute([$actlog_staff_id, $actlog_position, $actlog_firstname, $actlog_lastname, $description, $currentDateTime]);

    $deleted = $stmt->rowCount() > 0;
    if ($deleted) {
        header("Location: animal-status.php");
        exit;
    } else {
        echo "Appointment not found or couldn't be deleted.";
    }
} catch (PDOException $e) {
    echo "Error deleting the appointment: " . $e->getMessage();
}
?>