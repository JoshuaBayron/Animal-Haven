<?php


include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $staff_id = $_GET["staff_id"];

    // Delete the record with the specified ID
    $sql = "DELETE FROM staff WHERE staff_id =$staff_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully.";
        header("Location: dashboard.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
