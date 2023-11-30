<?php

if(isset($_POST['submit'])) {
    // Get input values
    $animal_name = $_POST['animal_name'];
    $animals_id = $_POST['animals_id']; // Updated variable name
    $appointment_service = $_POST['appointment_service'];
    $start_event_date = $_POST['start_event_date'];
    $start_event_time = $_POST['start_event_time'];

    // Database configuration
    $host = "localhost";
    $username = "root"; // Change this to your database username
    $password = ""; // Change this to your database password
    $dbname = "pawheaven";

    // Create a database connection
    $con = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO appointment (animal_name, animals_id, appointment_service, start_event_date, start_event_time) VALUES ('$animal_name','$animals_id', '$appointment_service', '$start_event_date', '$start_event_time')";

    // Insert data into 'animals' table first
    $insertAnimalQuery = "INSERT INTO animals (animals_id, animal_name) VALUES ('$animals_id', '$animal_name')";

    if ($con->query($insertAnimalQuery) === TRUE) {
        // Now insert data into 'appointment' table
        $insertAppointmentQuery = "INSERT INTO appointment (animal_name, animals_id, appointment_service, start_event_date, start_event_time) VALUES ('$animal_name', '$animals_id', '$appointment_service', '$start_event_date', '$start_event_time')";

        if ($con->query($insertAppointmentQuery) === TRUE) {
            echo "Entry added successfully!";
            // Redirect to calendar.html
            header("Location: calendar.html");
            exit(); // Terminate the script to ensure the redirect takes effect
        } else {
            echo "Error inserting into appointment table: " . $con->error;
        }
    } else {
        echo "Error inserting into animals table: " . $con->error;
    }

    // Close the database connection
    mysqli_close($con);
} else {
    echo "Form was not submitted.";
}

?>
