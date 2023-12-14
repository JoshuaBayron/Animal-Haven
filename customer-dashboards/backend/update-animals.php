<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
include 'connection.php';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
    if($role === "update-animal"){
        $animalID = $_POST["animals_id"];
        $animalName = $_POST["animalName"];
        $animalQuantity = $_POST["quantity"];
        $animalGender = $_POST["sex"];
        $animalAge = $_POST["age"];
        $animalBirthdate = $_POST["birthdate"];
        $animalSpecies = $_POST["species"];
        $animalBreed = $_POST["breed"];

        $animals_query = "UPDATE animals SET animal_name = ?, species = ?, breed = ?, quantity = ?, gender = ?, age = ?, birthdate = ? WHERE animals_id = ?";
        $animal_stmt = $conn->prepare($animals_query);
        $animal_stmt->bind_param("sssisisi", $animalName, $animalSpecies, $animalBreed, $animalQuantity, $animalGender, $animalAge, $animalBirthdate, $animalID);
        if ($animal_stmt->execute()) {
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "SUCCESS",
                    text: "Your request has been completed successfully",
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
            echo '<script>
            setTimeout(function() {
                swal({
                    title: "FAILED",
                    text: "We regret to inform you that the following action could not be completed successfully",
                    type: "error",
                    timer: 5000,
                    showCancelButton: false,
                    showConfirmButton: false
                    }, function() {
                        window.location = "../animal-info.php";
                    });
                });
            </script>';
        }
    }
}
    
 $conn->close();
?>