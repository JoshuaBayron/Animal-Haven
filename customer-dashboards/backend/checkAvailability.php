<?php
include 'connection.php';

// Get the selected date and time from the AJAX request
$selectedDateTime = $_GET['dateTime'];

// Create a DateTime object from the selected date and time
$selectedDateTimeObject = new DateTime($selectedDateTime);

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to check if the selected time is available
$sql = "SELECT * FROM appointments WHERE 
        start_event_date <= '" . $selectedDateTimeObject->format('Y-m-d H:i:s') . "' AND 
        end_event_date >= '" . $selectedDateTimeObject->format('Y-m-d H:i:s') . "'";

$result = $conn->query($sql);

// Prepare the response as JSON
$response = array();
$response['available'] = ($result->num_rows == 0); // If no rows are returned, the time is available

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
