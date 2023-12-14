<?php 
session_start();
require_once('db-connect.php');

// Set the timezone to Taipei
date_default_timezone_set('Asia/Taipei');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\vendor\autoload.php'; 

       function sendemail_verify($firstname,$lastname,$Appointment_service,$doctorname,$formattedStartEventDate,$admin_email,$username,$petname,$currentDateTime)
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
                            <h4> A customer named $firstname $lastname has scheduled an appointment for $Appointment_service with Doctor $doctorname for pet $petname on $formattedStartEventDate. This appointment was scheduled today $currentDateTime. Thank you! </h4><br>
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
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);



$allday = isset($allday);
$admin_email = 'pet.haven.lt@gmail.com';
$customer_id = $_SESSION["customer_id"];
$username = $_SESSION['email'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$Animals_id = $_POST["animals_id"];
$Staff_id = $_POST["staff_id"];
$Appointment_service = $_POST["appointment_service"];
$appoint_status = 0;
$Appointment_status = 'Pending';

 $Start_event_date = $_POST['start_event_date'];
 $formattedStartEventDate = date("Y-m-d h:i A", strtotime($Start_event_date));
  $currentDateTime = date("Y-m-d h:i A");

 // Retrieve data from the animals table
        $sqlAnimals = "SELECT * FROM animals WHERE animals_id = $Animals_id";
        $resultAnimals = $conn->query($sqlAnimals);

        // Retrieve data from the staff table
        $sqlStaff = "SELECT * FROM staff WHERE staff_id = $Staff_id";
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

    $message = "A customer named $firstname $lastname has scheduled an appointment for $Appointment_service with Doctor $doctorname for pet $petname on $formattedStartEventDate. This appointment was scheduled today $currentDateTime. Thank you!";

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


 // Check if the selected date and time are within the allowed range
    $sql_check = "SELECT * FROM appointment
            WHERE '$formattedStartEventDate' BETWEEN start_event_date AND end_event_date";
    $result_check = $conn->query($sql_check);


    if ($result_check->num_rows > 0) {
        echo "<script>alert('Sorry, the selected date and time are not available. Please choose another.');location.replace('./')</script>";
        
    } else {
        if(empty($id)){
                $sql = "INSERT INTO `appointment` (`appointment_service`,`appointment_status`,`start_event_date`,`animals_id`,`staff_id`,`customer_id`,`appoint_status`) VALUES ('$Appointment_service','$Appointment_status','$formattedStartEventDate','$Animals_id','$Staff_id','$customer_id','$appoint_status')";
                $save = $conn->query($sql);
                if($save){
                    // $response_sms = curl_exec($ch);
                    // sendemail_verify("$firstname","$lastname","$Appointment_service","$doctorname","$formattedStartEventDate","$admin_email","$username","$petname","$currentDateTime");
                    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
                }else{
                    echo "<pre>";
                    echo "An Error occured.<br>";
                    echo "Error: ".$conn->error."<br>";
                    echo "SQL: ".$sql."<br>";
                    echo "</pre>";
                }
            }else{
                $sql = "UPDATE `schedule_list` set `title` = '{$title}', `description` = '{$description}', `start_datetime` = '{$start_datetime}', `end_datetime` = '{$end_datetime}' where `id` = '{$id}'";
            }
    }



$conn->close();
?>