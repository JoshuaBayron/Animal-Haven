<?php
include 'backend/connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the date from the query parameters
$date = $_GET['date'];

// Fetch existing entries for the selected date
$sql = "SELECT start_event_date FROM appointment WHERE DATE(start_event_date) = '$date'";
$result = $conn->query($sql);

if ($result) {
    $existingEntries = [];

    // Collect existing datetimes into an array
    while ($row = $result->fetch_assoc()) {
        $existingEntries[] = $row['start_event_date'];
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($existingEntries);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
