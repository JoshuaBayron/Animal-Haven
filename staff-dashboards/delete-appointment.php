<?php
// Create a PDO database connection (replace with your actual database credentials)
try {
    $db = new PDO("mysql:host=localhost;dbname=id21596882_pawheaven", "id21596882_root", "Animal@123");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error connecting to the database: " . $e->getMessage();
    exit;
}

// Get the appointment ID from the POST request
$appointmentId = $_POST['appointmentId'];

// Attempt to delete the appointment from the database
try {
    $sql = "DELETE FROM appointment WHERE appointment_id = :appointmentId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":appointmentId", $appointmentId, PDO::PARAM_INT);
    $stmt->execute();

    // Check if the deletion was successful
    $deleted = $stmt->rowCount() > 0;

    if ($deleted) {
        // Return a success response
        echo "Appointment deleted successfully";
    } else {
        // Return a failure response if no records were affected
        echo "Appointment not found or couldn't be deleted.";
    }
} catch (PDOException $e) {
    // Handle any errors that occurred during the deletion
    echo "Error deleting the appointment: " . $e->getMessage();
}
?>
