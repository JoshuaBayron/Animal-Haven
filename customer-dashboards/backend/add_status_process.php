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
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\vendor\autoload.php'; 

       function sendemail_verify($firstname,$Appointment_service,$Start_event_date,$admin_email,$username)
{
    $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'pet.haven.lt@gmail.com'; // Your sender email address
        $mail->Password = 'dpezmgtegzyparsi'; // Your sender email password

        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->SMTPSecure = "tls";
        $mail->Port = 587; // TCP port to connect to

        // Email content
        $mail->setFrom($username, $firstname);
        $mail->addAddress($admin_email); // User's email

        $mail->isHTML(true);
        $mail->Subject = 'Client Appointment';
        $email_body = "
                    <h2> New Appointment Added</h2>
                    <h4> A customer named $firstname have scheduled an appointment for $Appointment_service from $Start_event_date . Thank you </h4><br>
                    <br><br>
                 

                    ";
        $mail->Body=$email_body;
        //$mail->Body = 'Thank you for registering, ' . $username . '!';    
    try {
        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}
    $url = 'https://api.semaphore.co/api/v4/messages';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {




    $admin_email = 'pet.haven.lt@gmail.com';

    $username = $_SESSION['email'];
     $customer_id = $_SESSION["customer_id"];
     $firstname = $_SESSION['firstname'];
    $Animals_id = $_POST["animals_id"];
    $Staff_id = $_POST["staff_id"];
    $Appointment_service = $_POST["appointment_service"];
    $Start_event_date = $_POST["start_event_date"];
    $appoint_status = 0;
    $Appointment_status = 'To Be scheduled';
    // Prepare SQL statement to insert data into the database


        // Retrieve data from the POST request
    $apiKey = 'c62fdd9c2f75a3332871a56516e32daf';
    $number = '09462502911';
    $message = 'Hello Hello World';
    $sendername = 'Pawheaven';

    $message = "A customer named $firstname have scheduled an appointment for $Appointment_service from $Start_event_date . Thank you!";

    $data = http_build_query([
        'apikey' => $apiKey,
        'number' => $number,
        'message' => $message,
        'sender_name' => 'Pawheaven',

    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $sql = "INSERT INTO appointment (appointment_service, appointment_status, start_event_date, animals_id, staff_id, customer_id, appoint_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sql_appoint = $conn->prepare($sql);

    if ($sql_appoint === false) {
        die('Error in SQL query: ' . $conn->error);
    }

    $sql_appoint->bind_param("ssssssi", $Appointment_service, $Appointment_status, $Start_event_date, $Animals_id, $Staff_id, $customer_id, $appoint_status);

    if ($sql_appoint->execute()) {
         // $response_sms = curl_exec($ch);
         sendemail_verify("$firstname","$Appointment_service","$Start_event_date","$admin_email","$username");
         echo "<script>
                Swal.fire({
                    title: 'Appointment added successfull!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
        
        
        
    } else {
             echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to Add.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after error
                    }
                });
            </script>";
        // $response = array('success' => false);
    }


    // echo json_encode($response);
    curl_close($ch);
    // Close the database connection
    $conn->close();
}
?>
