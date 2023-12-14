<?php
// Establish a MySQLi connection (Update these values with your actual database credentials)
$mysqli = new mysqli("localhost", "root", "", "id21596882_pawheaven");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch existing appointments from the database
$query = "SELECT start_event_date FROM appointment";
$result = $mysqli->query($query);

if ($result) {
    $existingAppointments = [];
    while ($row = $result->fetch_assoc()) {
        $existingAppointments[] = $row['start_event_date'];
    }
    echo json_encode($existingAppointments);
} else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}

// Close the MySQLi connection
$mysqli->close();
?>
