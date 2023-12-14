<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php 
//phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\vendor\autoload.php';

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'pet.haven.lt@gmail.com');
define('SMTP_PASSWORD', 'dpezmgtegzyparsi');
define('SENDER_EMAIL', 'pet.haven.lt@gmail.com');
define('SENDER_NAME', 'Animal Haven Veterinary Clinic');

// send email
function sendEmailVerify($fname, $lname, $email, $verify_token)
{
    $fullname = $fname . " " . $lname;
    $mail = new PHPMailer(true);

    // Add the image
    $mail->addEmbeddedImage(__DIR__ . '/../assets/img/logo.png', 'logo');

    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email content
    $mail->setFrom(SENDER_EMAIL, SENDER_NAME);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Account Registration';
    $email_body = "
        <img src='cid:logo' alt='Animal Haven Veterinary Clinic Logo' style='display: block; margin: 0 auto; width:20%; height:auto'>
        <h2>Dear $fullname,</h2>
        <h3>Your account has been added in <b>PawPointment Platform</b> of <i>Animal Haven Veterinary Clinic</i></h3>
        <h5>Verify your email address to Login with the below given link </h5>
        <br><br>
        <a href='http://localhost/PawPointment-Final/Pawpointment/admin-dashboard/backend/verify-email.php?token=$verify_token'>
        <button type='button' style='background-color:#4C3D3D; border-radius:50px; display: block; margin: 0 auto; color:white'>Verify Account</button>
        </a>
    ";
    $mail->Body = $email_body;

    try {
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error)
        return false;
    }
}

function sendEmailUpdated($fname, $lname, $email, $ID)
{
    $fullname = $fname . " " . $lname;
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(SENDER_EMAIL, SENDER_NAME);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $resetLink = 'http://localhost/PawPointment-Final/Pawpointment/logins/password-change-for-staff.php?id=' . $ID;

        $email_body = "
            <img src='cid:logo' alt='Animal Haven Veterinary Clinic Logo' style='display: block; margin: 0 auto; width:20%; height:auto'>
            <h2>Dear $fullname,</h2>
            <h3>We received an email for resetting your password in <b>PawPointment Platform</b> of <i>Animal Haven Veterinary Clinic</i></h3>
            <br><br>
            <a href='$resetLink'>
                <button type='button' style='background-color:#4C3D3D; color:white; border: 2px solid #f2f2f2; margin: 0 auto;'>It was me</button>
            </a>
            <a href=''>
            <button type='button' style='background-color: white; color:black; border: 2px solid #f2f2f2; margin: 0 auto;'>That's not me</button>
            </a>
        ";

        $mail->Body = $email_body;

        // Add the image
        $mail->addEmbeddedImage(__DIR__ . '/../assets/img/logo.png', 'logo');

        $mail->send();

        return true;
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error)
        return false;
    }
}

function sendEmailToCustomer($animalName, $customerEmail, $service, $status, $start_date, $end_date)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(SENDER_EMAIL, SENDER_NAME);
        $mail->addAddress($customerEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Animal Status/Checkup';
        $email_body = "
            <img src='cid:logo' alt='Animal Haven Veterinary Clinic Logo' style='display: block; margin: 0 auto; width:20%; height:auto'>
            <h2>Dear Customer,</h2>
            <h3>Your Pet named " . htmlspecialchars($animalName) . " has " . htmlspecialchars($service) . " and is " . htmlspecialchars($status) . ". It was scheduled on " . htmlspecialchars($start_date) . ". Please go to the clinic exactly at " . htmlspecialchars($end_date) . ".</h3>
            <h5>Please click the button below to log into your account or register a new account</h5>
            <br><br>
            <a href='http://localhost/PawPointment-Final/Pawpointment/index.php'>
                <button type='button' style='background-color:#4C3D3D; border-radius:50px; display: block; margin: 0 auto; color:white;'>Click Here!</button>
            </a>
        ";
        $mail->Body = $email_body;

        // Add the image
        $mail->AddEmbeddedImage('../assets/img/logo.png', 'logo');

        $mail->send();

        return true;
    } catch (Exception $e) {
        // Handle the exception (e.g., log the error)
        return false;
    }
}

//send sms
function sendSms($contactNumber, $fullname, $end_date, $animalName, $service, $status) {
    $url = 'https://api.semaphore.co/api/v4/messages';

    // Replace this with your actual API key
    $apiKey = 'c62fdd9c2f75a3332871a56516e32daf';

    // Prepare data for sending SMS
    $number = $contactNumber; 
    $message = 'Hello ' . $fullname . ', Animal Haven Veterinary Clinic is reminding you that ' .
    $animalName . '\'s ' . $service . ' status is ' . $status . '. ';

    if (stripos($status, 'Consultation') !== false) {
        $message .= 'Please attend the consultation exactly at ' . $end_date . '.';
    } elseif (stripos($status, 'Admitted') !== false) {
        $message .= 'Please visit exactly at ' . $end_date . ' as your pet has been admitted.';
    } elseif (stripos($status, 'Done') !== false) {
        $message .= 'The procedure has been completed. Please come for further instructions exactly at ' . $end_date . '.';
    } else {
        $message .= 'Please come exactly at ' . $end_date . '.';
    }

    $data = [
        'apikey'  => $apiKey,
        'number'  => $number,
        'message' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Send SMS
    $response_sms = curl_exec($ch);
    
    if ($response_sms === false) {
        // Log the error for debugging purposes
        error_log('Error sending SMS: ' . curl_error($ch));
    } else {
        echo '<script>alert("SMS sent successfully"); 
        window.location.href = "../services.php";</script>';
    }
    curl_close($ch);
}

//alert notifications and prompt
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
  
function errorMessage($message, $location) {
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
          window.location = '<?php echo $location; ?>';
        });
      });
    </script>
    <?php
  }

function deleteWarning() {
    ?>
    <script>
       setTimeout(function() {
        Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete this. Do you want to continue?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
        }).then((result) => {
            if (result.isConfirmed) {
            
            setTimeout(function() {
                        swal({
                            title: "SUCCESS",
                            text: "Successfully Deleted",
                            type: "success",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                            }, function() {
                                window.location.href = "staff.php";
                            });
                        });
            }
        });
        });
    </script>
    <?php
  }

//function add
function functionAdminContact($conn){
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $adminID = 1;
    $contact = $_POST["contact"];

    $description = "$actlog_position ADDED an Admin contact $contact at $currentDateTime";

    if(!empty($contact)){
        $add_contact_query = "INSERT INTO `admin_contacts_infos` (`admin_id`, `contacts`) VALUES (?, ?)";
        $contact_stmt = $conn->prepare($add_contact_query);
        $contact_stmt->bind_param("is", $adminID, $contact);

        $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
        $add_activitylog_stmt = $conn->prepare($sql_activitylog);

         $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

        if ($contact_stmt->execute() && $add_activitylog_stmt->execute()) {
            successMessage("Contact Added successfully", "../login-form/contact.php");
        } else {
            errorMessage("Contact Added Unsuccessfully", "../login-form/contact.php");
        }
    }else{
        errorMessage("Contact field must not empty", "../login-form/contact.php");
    }                 
}

function functionAddStaff($conn) {
    do {
        $staff_id = mt_rand(100000000, 999999999); // Adjust the range
    } while (checkStaffIdExists($conn, $staff_id));

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");


    $lname = $_POST["lname"];
    $fname = $_POST["fname"];
    $mname = $_POST["mname"];
    $email = $_POST["email"];
    $retypedPassword = $_POST["retypepassword"];
    $password = $_POST["password"];
    $position = $_POST["position"];
    
    $description = "$actlog_position ADDED a staff named $lname $fname at $currentDateTime";

    $otherPosition = ($position === "Other") ? $_POST["otherPosition"] : $position;

    $verify_token = bin2hex(random_bytes(16));

    if ($password == $retypedPassword) {
        $hashedpassword = password_hash($_POST["password"], PASSWORD_BCRYPT);

        $sql = "INSERT INTO staff (staff_id, firstname, lastname, MI, position, email, pass, verify_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $add_staff_stmt = $conn->prepare($sql);


        $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
        $add_activitylog_stmt = $conn->prepare($sql_activitylog);

        if (!$add_staff_stmt && !$add_activitylog_stmt) {
            errorMessage("Prepare failed: (" . $conn->errno . ") " . $conn->error, "../staff.php");
        }

        $add_staff_stmt->bind_param("isssssss", $staff_id, $fname, $lname, $mname, $otherPosition, $email, $hashedpassword, $verify_token);
        
        $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);
        if ($add_staff_stmt->execute() && $add_activitylog_stmt->execute()) {
            
            successMessage("Please Notify them to Verify their Email!", "../staff.php");
            sendEmailVerify($fname, $lname, $email, $verify_token);
        } else {
            errorMessage("Staff Added Unsuccessfully", "../login-form/add-staff.php");
        }
    } else {
        errorMessage("Password Not Matched", "../login-form/add-staff.php");
    }
}


function checkStaffIdExists($conn, $staff_id) {
    $sql = "SELECT COUNT(*) FROM staff WHERE staff_id = ?";
    $check_stmt = $conn->prepare($sql);
    $check_stmt->bind_param("i", $staff_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    return $count > 0;
}

function functionAddAddress($conn){

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $adminID = 1;
    $business_address = $_POST['address'];
    $description = "$actlog_position ADDED an Address for Animal Haven $business_address at $currentDateTime";

    $sql = "INSERT INTO `admin_address_infos`(`business_address`, `admin_id`) VALUES (?, ?)";
    $add_address_stmt = $conn->prepare($sql);
    $add_address_stmt->bind_param("si", $business_address, $adminID);


    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($add_address_stmt->execute() && $add_activitylog_stmt->execute()) {
        successMessage("Address Added successfully", "../login-form/address.php");
    } else {
        errorMessage("Address Added Unsuccessfully", "../login-form/address.php");
    }
}

function functionAddConInfo($conn){
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");


    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $referral = rand(1, 10000000000);

    $description = "The $actlog_position ADDED a walk-in customer named $lname $fname with contact $contact with referral $referral at $currentDateTime";

    $sql = "INSERT INTO `walk_in_customers`(`referral_no`, `firstname`, `lastname`, `middleinitials`, `address`, `contacts`) VALUES (?, ?, ?, ?, ?, ?)";
    $add_walk_in_stmt = $conn->prepare($sql);
    $add_walk_in_stmt->bind_param("ssssss", $referral, $lname, $fname, $mname, $address,$contact);


    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($add_walk_in_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../login-form/add-appointment-p2.php?referral_no=' . $referral . '"; }, 1000);</script>';
    } else {
        errorMessage("Customer Information Not Added", "../login-form/add-appointment.php");
    }
    
}

function functionAddWalkIn($conn) {
    do {
        $referral = mt_rand(100000000, 999999999); // Generate a random referral number
    } while (checkReferralExists($conn, $referral));

    // Retrieve user input
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $address = $_POST['houseNumber'] ." ". $_POST["street"]." ". $_POST["barangay"]." ". $_POST["zipCode"];
    $contact = isset($_POST['contact']) ? str_replace(' ', '', $_POST['contact']) : null;
    $animal = $_POST['animal'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;
    $species = $_POST['species'];
    $otherSpecie = isset($_POST['otherSpecie']) ? $_POST['otherSpecie'] : null;
    $breed = isset($_POST['breed']) ? $_POST['breed'] : 'Not Available';
    $gender = isset($_POST['Animal-gender']) ? $_POST['Animal-gender'] : 'Not Available';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;
    $age = isset($_POST['age']) ? $_POST['age'] : null;
    $age_unit = isset($_POST['age_unit']) ? $_POST['age_unit'] : null;

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $description = "The $actlog_position ADDED a walk-in customer named $lname $fname with contact $contact, referral $referral, accompanied by their pet named $animal at $currentDateTime";

    // Create a PDO connection
    try {
        if ($species === 'Others') {
            $speciesValue = $otherSpecie;
        } else {
            $speciesValue = $species;
        }
        $ageString = "$age $age_unit";

        $sql = "INSERT INTO `walk_in_customers`(`referral_no`, `firstname`, `lastname`, `middleinitials`, `address`, `contacts`, `animal_name`, `gender`, `age`, `birthdate`, `quantity`, `breed`, `species`)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $add_walk_in_stmt = $conn->prepare($sql);
        $add_walk_in_stmt->bind_param("isssssssssdss", $referral, $fname, $lname, $mname, $address, $contact, $animal, $gender, $ageString, $birthdate, $quantity, $breed, $speciesValue);

        $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
        $add_activitylog_stmt = $conn->prepare($sql_activitylog);

         $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

        if ($add_walk_in_stmt->execute() && $add_activitylog_stmt->execute()) {
            echo '<script>setTimeout(function() { window.location.href = "../login-form/add-appointment-p2.php?referral_no=' . $referral . '"; }, 1000);</script>';
        } else {
            $error = $add_walk_in_stmt->error;
            echo "Error: " . $error;
        }

    } catch (Exception $e) {
        errorMessage("Appointment Added Unsuccessfully", "../login-form/add-appointment.php");
    } finally {
        $conn = null;
    }
}

function checkReferralExists($conn, $referral) {
    $sql = "SELECT COUNT(*) FROM walk_in_customers WHERE referral_no = ?";
    $checkStmt = $conn->prepare($sql);
    $checkStmt->bind_param("i", $referral);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    return $count > 0;
}

function functionaddSchedule($conn) {
    $customer_id = $_POST["referrals"];
    $staff_id = $_POST["staff"];
    $service = $_POST["services"];
    $startDate = $_POST["startdate"];
    $status = $_POST["status"];

    // Extract time and date from the datetime
    $timeOnly = date("H:i:s", strtotime($startDate));
    $dateOnly = date("Y-m-d", strtotime($startDate));

    // Check for the next available time slot
    $nextAvailableTime = getNextAvailableTime($conn, $timeOnly, $dateOnly);

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position ADDED a walk-in schedule with $service starting at $startDate scheduled at $currentDateTime";

    if ($nextAvailableTime) {
        errorMessage("Please Select Other Time Appointment",  "../login-form/add-appointment-p2.php?referral_no=$customer_id");
        echo "Debug: The time is not available";
    } else {
        // Always execute the INSERT statement for testing purposes
        $sql = "INSERT INTO `appointment`(`appointment_service`, `appointment_status`, `start_event_date`, `staff_id`, `referral_no`) VALUES (?, ?, ?, ?, ?)";
        $add_schedules = $conn->prepare($sql);
        $add_schedules->bind_param("sssss", $service, $status, $startDate, $staff_id, $customer_id);

        $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
        $add_activitylog_stmt = $conn->prepare($sql_activitylog);

        $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

        if ($add_schedules->execute() && $add_activitylog_stmt->execute()) {
            echo '<script>setTimeout(function() { window.location.href = "../walk-in.php"; }, 1000);</script>';
        } else {
            echo "Debug: Insert failed!";
            errorMessage("Schedule not added, Please Try Again",  "../login-form/add-appointment-p2.php?referral_no=$customer_id");
        }
    }
}

function getNextAvailableTime($conn, $currentTime, $date) {
    // Check if there is an appointment overlapping with the current time
    $check_sql = "SELECT COUNT(*) AS count FROM `appointment` 
                  WHERE DATE(`start_event_date`) = ? AND 
                        TIME(`start_event_date`) = ?";
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bind_param("ss", $date, $currentTime);
    $check_statement->execute();
    $check_result = $check_statement->get_result();

    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        $count = $row['count'];
        return $count > 0; // If count is greater than 0, the time is not available
    }

    return false; // No conflicting appointments found
}

function functionaddDescription($conn){
    $services_title = $_POST["services_title"];
    $services_description = $_POST["services_description"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

     $description = "The $actlog_position ADDED a new service titled $services_title at $currentDateTime";

    // Check if a file was uploaded successfully
    if (isset($_FILES["services_image"]) && $_FILES["services_image"]["error"] == UPLOAD_ERR_OK) {
        $upload_dir = "../../assets/img/";
        $file_name = $_FILES["services_image"]["name"];
        $target_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES["services_image"]["tmp_name"], $target_path)) {
            $image_path = $target_path;

            $sql = "INSERT INTO services (services_title, services_description, services_image) VALUES ('$services_title', '$services_description', '$file_name')";

                $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
                $add_activitylog_stmt = $conn->prepare($sql_activitylog);

                 $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

            if ($conn->query($sql) === TRUE) {
                $add_activitylog_stmt->execute();
                successMessage("Service Successfully Added", "../add.php");
            } else {
                errorMessage("Service not added, Please Try Again", "../add.php");
            }
        } else {
            errorMessage("Error Uploading Image, Please Try Again", "../add.php");
        }
    } else {
        errorMessage("Image not Uploaded, Please Try Again", "../add.php");
        
    }
}

//function updates and edit
function functionUpdateAdmin($conn) {
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $recordId = 1;

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position UPDATED the Admin Account at $currentDateTime";

    if (!empty($username) || !empty($pass)) {
        $admin_query = "UPDATE admins SET user = ?, pass = ? WHERE admin_id = ?";
        $admin_stmt = $conn->prepare($admin_query);

        $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
        $add_activitylog_stmt = $conn->prepare($sql_activitylog);

        if (!$admin_stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $admin_stmt->bind_param("ssi", $username, $pass, $recordId);
         $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

        if ($admin_stmt->execute() && $add_activitylog_stmt->execute()) {
            successMessage("Your request has been completed successfully", "../login-form/index.php");
        } else {
            errorMessage("We regret to inform you that the following action could not be completed successfully", "../login-form/index.php");
        }

        $admin_stmt->close();
    } else {
        errorMessage("Some Field are empty", "../login-form/index.php");
    }
}

function approveStatus($conn){
    $appointment_no = $_GET["appointment_no"];
    $status = "Approved";

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $description = "The $actlog_position APPROVED an Apointment at $currentDateTime";


    $approvedSQL = "UPDATE `appointment` SET`appointment_status`=? WHERE `appointment_id`=?";
    $approveSTMT = $conn->prepare($approvedSQL);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if (!$approveSTMT && !$add_activitylog_stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $approveSTMT->bind_param("si", $status, $appointment_no);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($approveSTMT->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../pet-status.php"; }, 1000);</script>';
        // sendEmailUpdated($fname, $lname, $email);
    } else {
        errorMessage("Staff Updated Unsuccessfully", "../pet-status.php");
    }
    $approveSTMT->close();
}

function cancelStatus($conn){
    $appointment_no = $_GET["appointment_no"];
    $status = "Cancelled";

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $description = "The $actlog_position CANCELED an Apointment at $currentDateTime";

    $cancelSQL = "UPDATE `appointment` SET`appointment_status`=? WHERE `appointment_id`=?";
    $cancelSTMT = $conn->prepare($cancelSQL);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if (!$cancelSTMT && !$add_activitylog_stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $cancelSTMT->bind_param("si", $status, $appointment_no);

    if ($cancelSTMT->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../pet-status.php"; }, 1000);</script>';
        // sendEmailUpdated($fname, $lname, $email);
    } else {
        errorMessage("Appointment Not Cancelled, Please Try Again!", "../pet-status.php");
    }
    $cancelSTMT->close();
}

function functionEditStaff($conn){
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");



    $staff_id = $_POST["staff_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mname = $_POST["mname"];
    $position = $_POST["position"];
    $gender = $_POST["gender"];
    // $email = $_POST["email"];

    $description = "$actlog_position UPDATED a staff Information named $lname $fname at $currentDateTime";

    $staff_query = "UPDATE staff SET firstname=?, lastname=?, MI=?, gender=?, position=? WHERE staff_id = ?";
    $staff_stmt = $conn->prepare($staff_query);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if (!$staff_stmt && !$add_activitylog_stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $staff_stmt->bind_param("sssssi", $fname, $lname, $mname, $gender, $position, $staff_id);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($staff_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../staff.php"; }, 1000);</script>';
        // sendEmailUpdated($fname, $lname, $email);
    } else {
        errorMessage("Staff Updated Unsuccessfully", "../staff.php");
    }
    $staff_stmt->close();
}

function functionUpdateStatus($conn){
    $appointment_no = $_POST["appointment_no"];
    $status = $_POST["status"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $service = $_POST["service"];
    $animalName = $_POST["animalName"];
    $customerEmail = $_POST["customerEmail"];
    $staffEmail = $_POST["staffEmail"];
    $paymentStatus = $_POST["payments"];
    $comments = $_POST["comments"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position UPDATED the status as $status and the payment status as $paymentStatus for the schedule for animal $animalName at $currentDateTime";

    $status_query = "UPDATE `appointment` SET `appointment_status`=?,`start_event_date`=?,`end_event_date`=?, `payment_status`=?,`remarks`=? WHERE appointment_id = ?";
    $status_stmt = $conn->prepare($status_query);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if (!$status_stmt && !$add_activitylog_stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $status_stmt->bind_param("sssssi", $status, $start_date, $end_date, $paymentStatus, $comments, $appointment_no);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($status_stmt->execute() && $add_activitylog_stmt->execute()) {
      successMessage("Status Updated Successfully", "../pet-status.php");
      sendemailToCustomer($animalName, $customerEmail, $service, $status, $start_date, $end_date);
      // sendemailToStaff($animalName, $staffEmail, $service, $status, $start_date, $end_date);
    } else {
      errorMessage("Failed to update status", "../pet-status.php");
    }
}

function functionUpdateStatusforWalkin($conn){
    $appointment_no = $_POST["appointment_no"];
    $status = $_POST["status"];
    $end_date = $_POST["end_date"];
    
    $start_date = $_POST["start_date"];
    $service = $_POST["service"];
    $animalName = $_POST["animalName"];
    $customerNumber = $_POST["contact"];
    $fullname = $_POST["fullname"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $formattedStartEventDate = date("Y-m-d h:i A", strtotime($end_date));

    $description = "The $actlog_position UPDATED the status as $status and the date turnover as $formattedStartEventDate for the schedule for animal $animalName at $currentDateTime";

    $status_query = "UPDATE `appointment` SET `appointment_status`=?,`end_event_date`=? WHERE appointment_id = ?";
    $status_stmt = $conn->prepare($status_query);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);
    if (!$status_stmt && !$add_activitylog_stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $status_stmt->bind_param("ssi", $status, $end_date, $appointment_no);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($status_stmt->execute() && $add_activitylog_stmt->execute()) {
      successMessage("Status Updated Successfully", "../walk-in.php");
      sendSms($customerNumber, $fullname, $end_date, $animalName, $service, $status);
      
    } else {
      errorMessage("Failed to update status", "../walk-in.php");
    }
}

function functionUpdateServices($conn) {
    $servicesID = $_POST["services_ID"];
    $serviceTitle = $_POST["services_title"];
    $serviceDescription = $_POST["services_description"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position UPDATED a service titled $serviceTitle at $currentDateTime";
    if (isset($_FILES["services_image"]) && $_FILES["services_image"]["error"] == UPLOAD_ERR_OK) {
        $upload_dir = "../../assets/img/";
        $file_name = $_FILES["services_image"]["name"];
        $target_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES["services_image"]["tmp_name"], $target_path)) {
            $image_path = $file_name; // Use the file name, not the full path

            // Use prepared statements to prevent SQL injection
            $updateServices = $conn->prepare("UPDATE services SET services_title=?, services_description=?, services_image=? WHERE services_ID=?");
            $updateServices->bind_param("sssi", $serviceTitle, $serviceDescription, $image_path, $servicesID);

            $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
            $add_activitylog_stmt = $conn->prepare($sql_activitylog);

            $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

            if ($updateServices->execute() && $add_activitylog_stmt->execute()) {
                successMessage("Service Successfully Updated", "../services.php");
                // sendemail($fname, $lname, $email, $purpose);
            } else {
                errorMessage("Service not Updated, Please Try Again", "../services.php");
            }
        } else {
            errorMessage("Error Uploading Image, Please Try Again", "../services.php");
        }
    } else {
        errorMessage("Image not Uploaded, Please Try Again", "../services.php");
    }
}

function functionScheduleAppointment($conn){
    $staffID = $_POST["staff"];
    $appointment_no = $_POST["appointment_no"];
    $status = $_POST["status"];
    $end_date = $_POST["end_date"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position UPDATED an appointment where the status as $status and date turnover as $end_date at $currentDateTime";

    $status_query = "UPDATE `appointment` SET `appointment_status`=?,`end_event_date`=?, staff_id =? WHERE appointment_id = ?";
    $status_stmt = $conn->prepare($status_query);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if (!$status_stmt && !$add_activitylog_stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $status_stmt->bind_param("sssi", $status, $end_date, $staffID, $appointment_no);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($status_stmt->execute() && $add_activitylog_stmt->execute()) {
      successMessage("Status Updated Successfully", "../pet-status.php");
      
    } else {
      errorMessage("Failed to update status", "../pet-status.php");
    }
}
//Delete functions
function functionDeleteAddress($conn){
    $addressID = $_GET["address_id"];
    
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    $description = "The $actlog_position DELETED an Address at $currentDateTime";

    $delete_address_query = "DELETE FROM `admin_address_infos` WHERE address_id = ?";
    $delete_address_stmt = $conn->prepare($delete_address_query);
    $delete_address_stmt->bind_param("i", $addressID);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($delete_address_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../login-form/address.php"; }, 1000);</script>';
    } else {
        errorMessage("Status Deleted Unsuccessfully" , "../login-form/address.php");
    } 
}

function functionDeleteContact($conn){
    $contacts_id = $_GET["contacts_id"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position DELETED an Animal Haven contact at $currentDateTime";

    $delete_contact_query= "DELETE FROM `admin_contacts_infos` WHERE `contacts_id` = ?";
    $delete_contact_stmt = $conn->prepare($delete_contact_query);
    $delete_contact_stmt->bind_param("i",$contacts_id);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if($delete_contact_stmt-> execute() && $add_activitylog_stmt-> execute()){
        echo '<script>setTimeout(function() { window.location.href = "../login-form/contact.php"; }, 1000);</script>';
    } else {
        errorMessage("Contact Deleted Unsuccessfully","../login-form/contact.php");
    }
}

function functionDeleteStaff($conn){
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");
    
    $staff_id = $_GET["staff_id"];     

    $description = "The $actlog_position DELETED a staff at $currentDateTime";

    $delete_staff_query = "DELETE FROM staff WHERE staff_id = ?";
    $delete_staff_stmt = $conn->prepare($delete_staff_query);
    $delete_staff_stmt->bind_param("i", $staff_id);


    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($delete_staff_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../staff.php"; }, 1000);</script>';;
    } else {
        errorMessage("Staff Deleted Unsuccessfully", "../staff.php");
    }
}

function functionDeleteStatus($conn){
    $appointment_no = $_GET["appointment_no"];
    $referral = $_GET["referral"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position admin PERMANENTLY DELETED an appointment and a customer from walk-in schedules at $currentDateTime";

    $delete_status_query = "DELETE FROM appointment WHERE appointment_id = ?";
    $delete_owner_query = "DELETE FROM walk_in_customers WHERE referral_no = ?";

    $delete_status_stmt = $conn->prepare($delete_status_query);
    $delete_owner_stmt = $conn->prepare($delete_owner_query);


    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);


    $delete_status_stmt->bind_param("i", $appointment_no);
    $delete_owner_stmt->bind_param("i", $referral);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($delete_status_stmt->execute() && $delete_owner_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../walk-in.php"; }, 1000);</script>';
    } else {
        errorMessage("Deletion Unsuccessful", "../walk-in.php");
    }     
}

function deleteAppointment($conn){
     $appointment_no = $_GET["appointment_no"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position PERMANENTLY DELETED an online appointment named with ID $appointment_no at $currentDateTime";

    $delete_status_query = "DELETE FROM appointment_archive WHERE appointment_id = ?";
    $delete_status_stmt = $conn->prepare($delete_status_query);
    $delete_status_stmt->bind_param("i", $appointment_no);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($delete_status_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../pet-status.php"; }, 1000);</script>';
    } else {
        errorMessage("Deletion Unsuccessful", "../pet-status.php");
    }       
}

function functionDeleteServices($conn){
    $serviceId = $_GET["services_id"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position DELETED a service for Animal Haven with ID $serviceId at $currentDateTime";

    $services_query = "DELETE FROM `services` WHERE `services_id` = ?";
    $services_stmt = $conn->prepare($services_query);
    $services_stmt->bind_param("i", $serviceId);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($services_stmt->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../services.php"; }, 1000);</script>';
    } else {
        errorMessage("Services Deleted Unsuccessfully", "../services.php");
    } 
}

function unverifyEmail($conn) {
    $CustomerNo = $_GET["customer_no"];
    $CustomerEmail = $_GET["customerEmail"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position UNVERIFIED an email for $CustomerEmail at $currentDateTime";

    $UnverifyQuery = "UPDATE `customers` SET `verify_status`=0 WHERE `customer_id`=? AND `email`=?";
    $UnverifySTMT = $conn->prepare($UnverifyQuery);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if ($UnverifySTMT === false && $add_activitylog_stmt === false) {
        errorMessage("Prepare statement failed: " . $conn->error, "../customers.php");
    }
    $UnverifySTMT->bind_param("is", $CustomerNo, $CustomerEmail);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($UnverifySTMT->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../customers.php"; }, 1000);</script>';
    } else {
        errorMessage("Customer Account Not Verified", "../customers.php");
    }
    $UnverifySTMT->close();
}

function verifyEmail($conn) {
    $CustomerNo = $_GET["customer_no"];
    $CustomerEmail = $_GET["customerEmail"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position VERIFIED an email for $CustomerEmail at $currentDateTime";

    $verifyQuery = "UPDATE `customers` SET `verify_status`=1 WHERE `customer_id`=? AND `email`=?";
    $verifySTMT = $conn->prepare($verifyQuery);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    if ($verifySTMT === false && $add_activitylog_stmt === false) {
        errorMessage("Prepare statement failed: " . $conn->error, "../customers.php");
    }
    $verifySTMT->bind_param("is", $CustomerNo, $CustomerEmail);
     $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($verifySTMT->execute() && $add_activitylog_stmt->execute()) {
        echo '<script>setTimeout(function() { window.location.href = "../customers.php"; }, 1000);</script>';
    } else {
        errorMessage("Customer Account Not Verified", "../customers.php");
    }
    $verifySTMT->close();
}


function archiveAppointments($conn)
{
    $appointment_id = $_GET["appointment_no"];

    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position ARCHIVED an appointment ID $appointment_id at $currentDateTime";

    $insertSql = "INSERT INTO appointment_archive SELECT * FROM appointment WHERE `appointment_id` = $appointment_id";
    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($conn->query($insertSql) === TRUE) {

    $deleteSql = "DELETE FROM appointment WHERE `appointment_id` = $appointment_id";
    $add_activitylog_stmt->execute();

    if ($conn->query($deleteSql) === TRUE) {
        echo '<script>setTimeout(function() { window.location.href = "../services.php"; }, 1000);</script>';
    } else {
        errorMessage("Error deleting data from 'appointment' table: " . $conn->error, "../services.php");
    }
    } else {
        errorMessage("Error moving data: " . $conn->error, "../services.php");
    }
}

function generateArchiveNumber()
{
    return uniqid("archive_", true);
}

function restoreAppointments($conn)
{
    $appointment_id = $_GET["appointment_no"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "$actlog_position RESTORED an appointment with ID $appointment_id at $currentDateTime";


    $insertSql = "INSERT INTO appointment SELECT * FROM appointment_archive WHERE `appointment_id` = $appointment_id";

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);

    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($conn->query($insertSql) === TRUE) {


    $deleteSql = "DELETE FROM appointment_archive WHERE `appointment_id` = $appointment_id";
    $add_activitylog_stmt->execute();

    if ($conn->query($deleteSql) === TRUE) {
        echo '<script>setTimeout(function() { window.location.href = "../services.php"; }, 1000);</script>';
    } else {
        errorMessage("Error deleting data from 'appointment' table: " . $conn->error, "../services.php");
    }
    } else {
        errorMessage("Error moving data: " . $conn->error, "../services.php");
    }
}

function functionResetPasswordforStaff($conn){
    $staff_id = $_POST["staff_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $sql_admin = "SELECT * FROM admins";
    $result_admin = $conn->query($sql_admin);
    $row_admin = $result_admin->fetch_assoc();

    $actlog_adminid = $row_admin['admin_id'];
    $actlog_position = $row_admin['user'];
    $currentDateTime = date("Y-m-d h:i A");

    $description = "The $actlog_position SENT an email for the staff  $lname $fname for change password at $currentDateTime";

    $selectEmail = $conn->prepare("SELECT email FROM staff WHERE staff_id = ?");
    $selectEmail->bind_param("i", $staff_id);

    $sql_activitylog = "INSERT INTO appointmentactivitylog (user_id, position, firstname,description,time_stamp) VALUES (?, ?, ?, ?, ?)";
    $add_activitylog_stmt = $conn->prepare($sql_activitylog);
    $add_activitylog_stmt->bind_param("issss", $actlog_adminid, $actlog_position, $actlog_position, $description, $currentDateTime);

    if ($selectEmail->execute()) {
        $result = $selectEmail->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            echo '<script>setTimeout(function() { window.location.href = "../staff.php"; }, 1000);</script>';
            sendEmailUpdated($fname, $lname, $row["email"], $staff_id);
            $add_activitylog_stmt->execute();
        } else {
            errorMessage("Email not Sent", "../staff.php");
        }
    } else {
        errorMessage("Error executing query", "../staff.php");
    }

    $selectEmail->close();
}
?>