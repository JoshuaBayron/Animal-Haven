
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
</body>
</html>

<?php
include 'connection.php';

// Check if the 'id' parameter is set in the URL
if (isset($_GET['animals_id'])) {
    $pet_id = $_GET['animals_id'];

    // Fetch the pet data based on the provided ID
    $sql_select = "SELECT * FROM animals_archive WHERE animals_id = $pet_id";
    $result_select = $conn->query($sql_select);

    if ($result_select->num_rows > 0) {
        // Fetch the data
        $pet_data = $result_select->fetch_assoc();

        // Insert the data into the archive_pets table
        $sql_insert = "INSERT INTO animals (animal_name, breed, species,gender,birthdate,age,quantity,customer_id) VALUES ('" . $pet_data['animal_name'] . "','" . $pet_data['breed'] . "','" . $pet_data['species'] . "','" . $pet_data['gender'] . "','" . $pet_data['birthdate'] . "','" . $pet_data['age'] . "','" . $pet_data['quantity'] . "','" . $pet_data['customer_id'] . "')";
        $conn->query($sql_insert);

        // Delete the pet from the pets table
        $sql_delete = "DELETE FROM animals_archive WHERE animals_id  = $pet_id";
        $conn->query($sql_delete);

        // echo "Pet deleted and archived successfully.";
        // header("Location: ../animal-info.php");
         echo "<script>
                Swal.fire({
                    title: 'restored successfully.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-info.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
    } else {
        // echo "Pet not found.";
         echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Pet not found',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../pet_archive.php'; // Redirect to desired page after error
                    }
                });
            </script>";
    }
} else {
    // echo "Invalid request.";
     echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Invalid request',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../pet_archive.php'; // Redirect to desired page after error
                    }
                });
            </script>";
}

// Close the database connection
$conn->close();
?>
