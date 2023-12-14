<?php
session_start();
require 'connection.php';
include 'functions.php';

// Query the database for appointments that match the criteria
$sql = $conn->prepare("SELECT a.*, c.firstname, c.lastname, cc.contact_number, aa.animal_name
        FROM appointment a
        JOIN customers c ON a.customer_id = c.customer_id
        JOIN customer_contact_infos cc ON c.customer_id = cc.customer_id
        JOIN animals aa ON a.animals_id = aa.animals_id 
        WHERE DATE(a.start_event_date) = DATE(DATE_ADD(CURDATE(), INTERVAL 1 DAY))");

$sql->execute();
$result = $sql->get_result();

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $url = 'https://api.semaphore.co/api/v4/messages';

        // Prepare data for sending SMS
        $apiKey = 'c62fdd9c2f75a3332871a56516e32daf';
        $number = $row['contact_number']; 
        $message = 'Hello ' . $row['firstname'] . ' ' . $row['lastname'] . ', Animal Haven Veterinary Clinic reminding you that '.$row['animal_name'].' has an '.$row['appointment_service'].' tomorrow ('.$row['start_event_date'].').';

        $data = http_build_query([
            'apikey' => $apiKey,
            'number' => $number,
            'message' => $message,
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Send SMS
        $response_sms = curl_exec($ch);

        if ($response_sms === false) {
            // Log the error for debugging purposes
            error_log('Error sending SMS: ' . curl_error($ch));
        } else {
            echo '<script>alert("SMS sent successfully"); 
            window.location.href = "../services.php";</script>';
        }
        curl_close($ch);
    }
} else {
    // No appointments tomorrow
    echo '<script>alert("There are no appointments tomorrow"); 
            window.location.href = "../services.php";</script>';
}

$conn->close();
?>
