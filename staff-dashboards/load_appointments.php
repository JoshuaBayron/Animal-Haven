<?php
$selectedDate = $_POST['selectedDate'];

$sql = "SELECT appointment_service FROM appointment WHERE start_event_date = '$selectedDate'";

$result = $conn->query($sql);

echo "<ul>";
while ($row = $result->fetch_assoc()) {
    $appointment_service = $row['appointment_service'];
    echo "<li>$appointment_service</li>";
}
echo "</ul>";
?>
