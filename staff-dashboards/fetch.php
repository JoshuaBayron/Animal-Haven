<?php 
    require 'connection.php';

    //Fetch data from the "admin" table
    $user_id = 1;
    $user_sql = "SELECT username FROM admin WHERE id = $user_id"; 
    $user_result = $conn->query($user_sql);

        if ($user_result && $user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_name = $user_row['username'];
        } else {
            $user_name = "Guest";
    }

    // Fetch data from the "animal" table
    $animals_sql = "SELECT * FROM animals";
    $animals_result = $conn->query($animals_sql);

    // Fetch data from the "appointment" table
    $appointment_sql = "SELECT * FROM appointment";
    $appointment_result = $conn->query($appointment_sql);

    //Fetch data from the "customers" table
    $customer_sql = "SELECT * FROM customer";
    $customer_result = $conn ->query($customer_sql);

    //Fetch data from the "staff" table
    $staff_sql = "SELECT * FROM staff";
    $staff_result = $conn ->query($staff_sql);

    //Fetch data from the "appointment" table and the animals name in "animals" table
    $status_sql = "SELECT appointment.*, animals.animal_name
        FROM appointment
        INNER JOIN animals ON appointment.animal_id = animals.animal_id";

    $status_result = $conn->query($status_sql);

    //Fetch data from the "animals" table and the owners name in "customer" table
    $owner_sql = "SELECT animals.*, customer.lastname, customer.firsname
              FROM animals
              INNER JOIN customer ON animals.animal_id = customer.customer_id";

    $owner_result = $conn ->query($owner_sql);
    
    $conn->close();
?>