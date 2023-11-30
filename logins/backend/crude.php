<?php
require_once 'connection.php';
include 'functions.php';

function confirmLogout($details) {
    echo <<<EOD
        <script>
            Swal.fire({
                title: 'WARNING',
                text: '$details',
                icon: 'warning',
                confirmButtonColor: 'green',
                confirmButtonText: 'Okay'
            }).then(({ isConfirmed }) => isConfirmed && (window.location.href = '../../index.php#about'));
        </script>
EOD;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["pass"] ?? '';

    $username = trim($username);
    $password = trim($password);

    if (!empty($username) && !empty($password)) {
        // Use prepared statement to prevent SQL injection
        $sql = "SELECT `user`, `pass` FROM `admins` WHERE `user` = ? AND `pass` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password); // Replace with hashed password
        $stmt->execute();
        $result = $stmt->get_result();

        // Assuming you want to do something with the result here, otherwise, this part can be removed.
        if ($result->num_rows > 0) {
            admin($conn, $username, $password);
        } else {
            $roles = $_POST["role"] ?? '';

            switch ($roles) {
                case "customer":
                    customer($conn, $username, $password); // Replace with hashed password
                    break;

                case "staff":
                    staff($conn, $username, $password); // Replace with hashed password
                    break;

                case "customer_reg":
                    registerCustomer($conn, $username, $password); // Replace with hashed password
                    break;

                default:
                    confirmLogout("Credentials Not Found or Roles are not Selected!");
                    break;
            }
        }

    } else {
        confirmLogout("Username and password are empty!"); 
    }
} else {
    confirmLogout("Server request failed!");
}

$conn->close();
?>
