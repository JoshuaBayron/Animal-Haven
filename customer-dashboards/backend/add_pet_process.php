<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    // $Username = $_POST['username'];
    // $Password = $_POST['password'];
    $customer_id = $_SESSION["customer_id"];
    // $customer_id = "REIRE";

    $Age = $_POST["age"];

    $Animal_name = $_POST["animal_name"];
    $Breed = $_POST["breed"];
    $Species = $_POST["species"];
    $Sex = $_POST["sex"];
    $Birthdate = $_POST["birthdate"];
    // $Age = $_POST["age"];
    $Quantity = $_POST["quantity"];

    // Prepare SQL statement to insert data into the database
      // Insert data into database
    $sql = "INSERT INTO animals (animal_name, breed, species, gender, birthdate, age, quantity,customer_id) VALUES ('$Animal_name','$Breed', '$Species', '$Sex', '$Birthdate', '$Age', '$Quantity','$customer_id')";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false);
    }

    echo json_encode($response);

    // Close the database connection
    $conn->close();
}
?>
