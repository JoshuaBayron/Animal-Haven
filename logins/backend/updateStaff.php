<?php 
require_once 'connection.php';

$roles = $_POST["roles"] ?? '';
switch($roles){
	case "updateStaffPassword":
		updateStaffPassword($conn);
		break;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($get_email) {
    require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\phpmailer\vendor\autoload.php';
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pet.haven.lt@gmail.com'; 
    $mail->Password = 'dpezmgtegzyparsi';
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom('pet.haven.lt@gmail.com', 'Pet_Haven');
    $mail->addAddress($get_email); 

    $mail->isHTML(true);
    $mail->Subject = 'Password Updated';
    $email_body = "<img src='cid:logo' alt='Animal Haven Veterinary Clinic Logo' style='display: block; margin: 0 auto; width:20%; height:auto'>
        <h2>Dear Staff</h2>
        <h3>Your password's account has been Updated in <b>PawPointment Platform</b> of <i>Animal Haven Veterinary Clinic</i></h3>
        <br><br>
        <a href='http://localhost/PawPointment-Final/Pawpointment/index.php#about'>
            <button type='button' style='background-color:#4C3D3D; border-radius:50px; display: block; margin: 0 auto; color:white'>Login Account Here</button>
        </a>";
    $mail->Body = $email_body;

    try {
        $mail->send();
        successMessage("Email Sent", "../../index.php#about");
    } catch (Exception $e) {
        errorMessage("Email Does not Sent", "../../index.php#about");
    }
}

function successMessage($message, $location) {
    ?>
    <script>
      setTimeout(function() {
        swal({
          title: 'SUCCESS',
          text: '<?php echo $message; ?>',
          type: 'success',
          timer: 2000,
          showCancelButton: false,
          showConfirmButton: false
        }, function() {
          window.location = '<?php echo $location; ?>';
        });
      });
    </script>
    <?php
  }
  
  function errorMessage($message) {
    ?>
    <script>
      setTimeout(function() {
        swal({
          title: 'FAILED',
          text: '<?php echo $message; ?>',
          type: 'error',
          timer: 5000,
          showCancelButton: false,
          showConfirmButton: false
        }, function() {
          window.location = '../../index.php';
        });
      });
    </script>
    <?php
  }

function updateStaffPassword($conn) {
    // Retrieve values from POST data
    $staffID = $_POST["staffID"];
    $email = $_POST["email"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($new_password == $confirm_password) {
        // Hash the new password
        $password = password_hash($new_password, PASSWORD_BCRYPT);

        // Prepare and execute the SQL query to update the staff password
        $staff_query = "UPDATE staff SET `pass`=? WHERE staff_id = ?";
        $staff_stmt = $conn->prepare($staff_query);

        if (!$staff_stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        // Bind parameters and execute the statement
        $staff_stmt->bind_param("si", $password, $staffID);

        if ($staff_stmt->execute()) {
            sendEmail($email);
        } else {
            errorMessage("Staff Updated Unsuccessfully", "../../index.php#about");
        }

        // Close the statement
        $staff_stmt->close();
    } else {
        echo '<script>setTimeout(function() { window.location.href = "../../index.php#about"; }, 1000);</script>';
    }
}
?>