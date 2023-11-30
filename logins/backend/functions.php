<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
</body>
</html>
<?php

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

function admin($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT * FROM admins WHERE user = ? AND pass = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $_SESSION['user'] = $row['user'];
    
      successMessage("Welcome Admin", "../../admin-dashboard/staff.php");
    } else {
      errorMessage("Invalid Credentials please try again or ask the PawHeaven Administrator");
    }
    
    $stmt->close();
}

function customer($conn, $username, $password) {
    $email = $_POST['username'];
    $verify_status = '1';
    $sql = "SELECT * FROM customers WHERE email = ? AND verify_status = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $verify_status  );
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $userId = $row["customer_id"];
        $first_name = $row["firstname"];
        $last_name = $row["lastname"];
        $Middle_name = $row["MI"];
        $email = $row["email"];
        $hashedPassword = $row["pass"];
    
        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["customer_id"] = $userId;
            $_SESSION["firstname"] = $first_name;
            $_SESSION["lastname"] = $last_name;
            $_SESSION["MI"] = $Middle_name;
            $_SESSION["email"] = $email;
            $_SESSION["pass"] = $hashedPassword;
    
            successMessage("Account Successfully login", "../../customer-dashboards/user.php");
        } else {
            errorMessage("Wrong Credentials Please Try Again!");
        }
    } else {
        errorMessage("Account Not Found or Email not Verified Please Try Again!");
    }
}

function staff($conn, $username, $password) {
  $sql = "SELECT * FROM `staff` WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["pass"];
      if (password_verify($password, $hashedPassword)) {
        session_start();
            $_SESSION['staff_id'] = $row['staff_id'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
          successMessage("Account Successfully login", "../../staff-dashboards/animal-status.php");
      } else {
          errorMessage("Wrong Credentials Please Try Again!");
      }
  } else {
      errorMessage("Account Not Found Please Try Again!");
  }
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function registerCustomer($conn, $username, $password){

      // require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\phpmailer\vendor\autoload.php'; // Adjust the path to autoload.php
      require 'C:\Users\Acer\OneDrive\Documents\GitHub\thesis\PHPMailer-master\src\Exception.php';
      require 'C:\Users\Acer\OneDrive\Documents\GitHub\thesis\PHPMailer-master\src\PHPMailer.php';
      require 'C:\Users\Acer\OneDrive\Documents\GitHub\thesis\PHPMailer-master\src\SMTP.php';

        function sendemail_verify($fname,$username,$verify_token)
    {
        $mail = new PHPMailer(true);
        try {
    $mail->isSMTP();

          $emailDomain = explode('@', $username)[1]; // Extract domain from the email address

          // Set SMTP settings based on the email domain
          if ($emailDomain === 'gmail.com') {
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPSecure = 'tls';
              $mail->SMTPAuth = true;
              $mail->Username = 'pet.haven.lt@gmail.com'; // Your sender email address
              $mail->Password = 'dpezmgtegzyparsi';// Your sender email password
              $mail->Port = 587;
          } elseif ($emailDomain === 'yahoo.com') {
              $mail->Host = 'smtp.mail.yahoo.com';
               $mail->SMTPAuth   = true;
              $mail->Username   = 'bague.janreimar25@yahoo.com'; // Your Yahoo address
              $mail->Password   = 'kdramaislife11223'; // Your Yahoo password
              $mail->SMTPSecure = 'ssl';
              $mail->Port = 465;
          } else {
              // Handle other email domains or set default settings
              // You may want to provide an error message or fallback to a default SMTP configuration
             errorMessage("Unsupported email domain");
              throw new Exception("Unsupported email domain: $emailDomain");
          }

           

          $mail->setFrom('pet.haven.lt@gmail.com', 'Pet_Haven');
          $mail->addAddress($username); // User's email

          $mail->isHTML(true);
          $mail->Subject = 'Account Registration';

          $email_body = "
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
                      <div class='container'>
                          <div class='header'>
                              <div class='logo'>
                                  
                              </div>
                          </div>
                          <div class='content'>
                            <h2>Thank You For Registering , $fname</h2>
                            <h5>Verify if your email address to Login with the below given link </h5>
                            <br><br>
                            <a href='http://localhost//Pawpointment-Final/PawPointment/logins/backend/verify-email.php?token=$verify_token' style='display: inline-block; padding: 10px 20px; background-color: #FFFF00; color: #fff; text-decoration: none; border-radius: 5px; color: black'>Verify Account</a>
                          </div>
                      </div>
                        </body>
                        </html>";
          
          $mail->Body = $email_body;
          $mail->send();

          // echo "Email sent successfully!";
      } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

      $imageName = "noprofile.jpg";

      $lname = $_POST["lname"];
      $fname = $_POST["fname"];
      $mname = $_POST["mname"];
      $gender = $_POST["gender"];
      $contact_number = $_POST["contact_number"];
      $address = $_POST['address'];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $verify_token = md5(rand());
      $customer_id = strtoupper(mysqli_escape_string($conn, $lname) . substr($fname, 0, 2));

      $sql = "INSERT INTO customers (customer_id, firstname, lastname, MI, gender,Address, email, pass, verify_token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $add_cust_stmt = $conn->prepare($sql);
      $add_cust_stmt->bind_param("sssssssss", $customer_id, $fname, $lname, $mname, $gender,$address, $username, $hashedPassword, $verify_token);
      
      $sql_profil = "INSERT INTO customer_profile_infos (customer_id,image) VALUES (?,?)";
      $add_cust_profile = $conn->prepare($sql_profil);
      $add_cust_profile->bind_param("ss", $customer_id,$imageName);

      $sql_contact = "INSERT INTO customer_contact_infos (contact_number, customer_id) VALUES (?, ?)";
      $add_cust_contacts = $conn->prepare($sql_contact);
      $add_cust_contacts->bind_param("ss", $contact_number, $customer_id );

      if ($add_cust_stmt->execute() && $add_cust_profile->execute() && $add_cust_contacts->execute()) {
          sendemail_verify("$fname","$username","$verify_token");
          successMessage("Account Successfully Registered", "../../index.php#about");    
      } else {
          errorMessage("Register Unsuccessful please try again!");
      }
  
}

?>