<?php
session_start();
require_once('db-connect.php');

// Set the timezone to Taipei
date_default_timezone_set('Asia/Taipei');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\vendor\autoload.php'; 

function sendemail_verify($firstname,$lastname,$appointmentService,$doctorname,$formattedStartEventDate,$admin_email,$username,$petname,$currentDateTime)
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
                            <h4> A customer named $firstname $lastname has scheduled an appointment for $appointmentService with Doctor $doctorname for pet $petname on $formattedStartEventDate. This appointment was scheduled today $currentDateTime. Thank you! </h4><br>
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


//Data for Email and SMS
$username = $_SESSION['email'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$admin_email = 'pet.haven.lt@gmail.com';
 $currentDateTime = date("Y-m-d h:i A");


// Data for Other Column
$customer_id = $_SESSION["customer_id"];
$appointment_status = 'Pending';
$appoint_status = 0;
$end_event_date = '0000-00-00 00:00:00';

// Get data from the AJAX request
$animalsId = $_POST['animalsId'];  // Update with the actual ID key
$staffId = $_POST['staffId'];      // Update with the actual ID key
$appointmentService = $_POST['appointmentService'];  // Update with the actual service key
$startEventDatetime = $_POST['startEventDatetime'];
$startEventDate = $_POST['startEventDate'];
$startEventTime = $_POST['startEventTime'];


$combinedDateTime = $startEventDate . ' ' . $startEventTime;
$formattedStartEventDatetime = date('Y-m-d H:i:s', strtotime($combinedDateTime));

// Retrieve data from the animals table
        $sqlAnimals = "SELECT * FROM animals WHERE animals_id = $animalsId";
        $resultAnimals = $conn->query($sqlAnimals);

        // Retrieve data from the staff table
        $sqlStaff = "SELECT * FROM staff WHERE staff_id = $staffId";
        $resultStaff = $conn->query($sqlStaff);

        // Check if data is found in the animals table
        if ($resultAnimals->num_rows > 0) {
            $rowAnimals = $resultAnimals->fetch_assoc();
            $petname = $rowAnimals['animal_name'];
        } else {
            $petname = "Unknown Pet";
        }

        // Check if data is found in the staff table
        if ($resultStaff->num_rows > 0) {
            $rowStaff = $resultStaff->fetch_assoc();
            $doctorname = $rowStaff['firstname'];
        } else {
            $doctorname = "Unknown Doctor";
        }


       // Retrieve data from the POST request
    $apiKey = 'c62fdd9c2f75a3332871a56516e32daf';
    $number = '09462502911';
    $message = 'Hello Hello World';
    $sendername = 'Pawheaven';

    $message = "A customer named $firstname $lastname has scheduled an appointment for $appointmentService with Doctor $doctorname for pet $petname on $formattedStartEventDate. This appointment was scheduled today $currentDateTime. Thank you!";

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




      // Insert event into the database
    $sql = "INSERT INTO appointment (animals_id, staff_id, appointment_service, start_event_date,appointment_status,customer_id,appoint_status,end_event_date) VALUES ('$animalsId', '$staffId', '$appointmentService', '$formattedStartEventDatetime', '$appointment_status','$customer_id','$appoint_status','$end_event_date')";
    $save = $conn->query($sql);
     if($save){
                    // $response_sms = curl_exec($ch);
                    // sendemail_verify("$firstname","$lastname","$Appointment_service","$doctorname","$formattedStartEventDate","$admin_email","$username","$petname","$currentDateTime");
                    echo "<script> console.log('Schedule Successfully Saved.'); location.replace('./') </script>";
                }else{
                    echo "<pre>";
                    echo "An Error occured.<br>";
                    echo "Error: ".$conn->error."<br>";
                    echo "SQL: ".$sql."<br>";
                    echo "</pre>";
                }


$conn->close();
?>
