<?php
session_start();

if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];

    // echo "" . $_SESSION["username"];
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $id = $_GET["id"];

        include 'connection.php';
        
        $query = "DELETE FROM appointment WHERE appointment_id = ? AND customer_id = ?";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Preparation failed: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "is", $id,$customer_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Pet data deleted successfully.";
            header("Location: ../animal-status.php");
        } else {
            echo "Error deleting pet data: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
} else {
    echo "You need to be logged in to delete pet data.";
}
?>
