<?php
// Include your database connection configuration here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pawheaven";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected date from the AJAX request
if (isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Query to fetch appointments for the selected date (adjust your database schema accordingly)
    $sql = "SELECT * FROM appointment WHERE start_event_date = '$selectedDate'";

    // Execute the query
    $result = $conn->query($sql);

    // Fetch and format the appointment data
    $appointments = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment = array(
                'animals_id' => $row['animals_id'],
                'animal_name' => $row['animal_name'],
                'start_event_time' => $row['start_event_time'],
                // Add other appointment details as needed
            );
            $appointments[] = $appointment;
        }
    }

    // Close the database connection
    $conn->close();

    // Return the appointments data as JSON
    echo json_encode($appointments);
} else {
    // Handle the case where 'date' is not provided in the AJAX request
    echo json_encode(array('error' => 'Date parameter missing'));
}
?>
