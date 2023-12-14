<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'clear_all_data') {
    try {
        // Assuming 'your_table' is the name of your table
        $query = "TRUNCATE TABLE appointmentactivitylog"; // Use TRUNCATE TABLE for a complete deletion
        $stmt = $conn->prepare($query);
        $stmt->execute();

        echo 'Data cleared successfully. Page will be refreshed.';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request';
}
?>
