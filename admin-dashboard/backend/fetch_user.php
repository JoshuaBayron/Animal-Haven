<?php 
require 'connection.php';
$user_id = 1;
$user = "SELECT `user` FROM `admins` WHERE `admin_id` = $user_id";
$user_result = $conn->query($user);

    if ($user_result && $user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_name = $user_row['user'];
    } else {
        $user_name = "Guest";
}

?>