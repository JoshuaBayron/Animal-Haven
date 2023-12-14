<?php
// Destroy the session data
session_start();
session_unset();
session_destroy();
// Redirect to the login page or any other desired page
header("Location: ../../../index.php"); // Replace with the appropriate URL
exit();
?>