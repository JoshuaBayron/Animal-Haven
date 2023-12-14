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

            $roles = $_POST["role"] ?? '';

            switch ($roles) {

                case "customer_reg":
                    registerCustomer($conn, $username, $password); 
                    break;

                default:
                    confirmLogout("Roles not found!");
                    break;
            }
} else {
    confirmLogout("Server request failed!");
}

$conn->close();
?>
