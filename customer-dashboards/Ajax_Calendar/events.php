<?php
date_default_timezone_set('Asia/Taipei');
include 'db-connect.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT appointment_id, appointment_service, start_event_date, end_event_date FROM appointment";
$result = $conn->query($sql);

// Fetch holidays from the holiday table
$holidaysSql = "SELECT holiday_id, holiday_name, holiday_date FROM holiday";
$holidaysResult = $conn->query($holidaysSql);

// Format events for FullCalendar
$events = array();
while ($row = $result->fetch_assoc()) {
    // Convert start_event_date to 24-hour format
    $startDateTime = new DateTime($row['start_event_date']);
    $row['start_event_date'] = $startDateTime->format('Y-m-d H:i:s');

    $events[] = array(
        'id' => $row['appointment_id'],
        'title' => $row['appointment_service'],
        'start' => $row['start_event_date'],
        'end' => $row['end_event_date'],
        'color' => 'gray', // Set the color property to white
    );
}

// Format holidays for FullCalendar
$holidays = array();
while ($row = $holidaysResult->fetch_assoc()) {
    $holidays[] = array(
        'id' => $row['holiday_id'],
        'title' => $row['holiday_name'],
        'start' => $row['holiday_date'],
        'end' => $row['holiday_date'],
        'color' => 'gray', // Set the color property to white
    );
}

// Merge events and holidays
$combinedData = array_merge($events, $holidays);

// Return events as JSON
header('Content-Type: application/json');
echo json_encode($combinedData);

$conn->close();
?>
