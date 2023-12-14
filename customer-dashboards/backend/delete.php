<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<?php 
include 'connection.php';

if (isset($_GET['animal_id']) && !empty($_GET['animal_id'])) {
    $animal_id = intval($_GET['animal_id']);

    $sql = "DELETE FROM animals WHERE animal_id = $animal_id";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "SUCCESS",
                text: "Request is Successful",
                type: "success",
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
                }, function() {
                    window.location = "../animal-info.php";
                });
            });
        </script>';
    } else {
        // Handle the error (e.g., display an error message)
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle the case when animal_id is not provided
    echo "Invalid animal ID.";
}
 $conn->close();
?>
