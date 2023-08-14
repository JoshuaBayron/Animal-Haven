<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    // Retrieve form data
    $name = $_POST["name"];
    $species = $_POST["species"];
    $breed = $_POST["breed"];
    $sex = $_POST["sex"];
    $age = $_POST["age"];
    $date = $_POST["date"];
    
    // Database connection (replace with your own credentials)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "pawpointment";
    
    $conn = new mysqli($host, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Insert data into database
    $sql = "INSERT INTO petstbl (PetName, PetSex, PetSpecies,PetAge,PetBreed,PetBirthDay) VALUES ('$name', '$sex','$species','$age','$breed','$date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
