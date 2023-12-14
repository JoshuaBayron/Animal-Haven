<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'C:\Users\Acer\OneDrive\Documents\GitHub\thesis\phpmailer\vendor\autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);
// SMTP Configuration (use your own SMTP settings)
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'pet.haven.lt@gmail.com';
$mail->Password = 'dpezmgtegzyparsi';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Sender and recipient details
$mail->setFrom('pet.haven.lt@gmail.com', 'Pet_Haven');
$mail->addAddress('bague.janreimar25@gmail.com', 'Reimar');

// Email subject and content
$mail->isHTML(true);
$mail->Subject = 'Email Test';
$logoUrl = 'https://w7.pngwing.com/pngs/383/187/png-transparent-clinica-veterinaria-animal-welfare-dog-veterinary-medicine-veterinarian-pet-springs.png';

$mail->Body = '
<html>
<head>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #FFFF00;
            color: #fff;
            padding: 20px;
        }
        .content {
            padding: 20px;
            text-align: center; /* Center-align content */
        }
        .logo img {
            max-width: 200px;
            display: block; /* Center-align the image */
            margin: 0 auto; /* Center-align the image */

        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="logo.png" alt="Your Logo">
            </div>
        </div>
        <div class="content">
            
            <h2>Thank You For Registering, </h2>
            <h5>Verify your email address to Login with the link below:</h5>
            <br><br>
            
            <a href="http://localhost/Pawpointment-Final/PawPointment/logins/backend/verify-email.php?token="
                style="display: inline-block; padding: 10px 20px; background-color: #FFFF00; color: #fff; text-decoration: none; border-radius: 5px; color: black">Verify Account</a>


        </div>
    </div>
</body>
</html>';

if (!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
