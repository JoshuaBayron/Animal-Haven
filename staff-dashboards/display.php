<?php
// Establish a database connection (you might need to customize these parameters)
$conn = mysqli_connect("localhost", "username", "password", "pawheaven");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve appointments
$sql = "SELECT animals_id, start_event_date, start_event_time, appointment_service FROM appointment";
$result = mysqli_query($conn, $sql);

// Initialize an array to store appointment data
$appointment = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add each appointment to the array
        $appointment[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);

// Return the appointment data as JSON
echo json_encode($appointment);
?>
