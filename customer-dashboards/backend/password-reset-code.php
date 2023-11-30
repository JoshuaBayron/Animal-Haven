
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
</head>


<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bgR.png');">
            <div class="wrap-login100">

            
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include('connection.php');
session_start();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\xampp\htdocs\PawPointment-Final\PawPointment\phpmailer\phpmailer\vendor\autoload.php';

function send_password_reset($get_name, $get_email, $token)
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
            $mail->setFrom('pet.haven.lt@gmail.com', 'Pet_Haven');
            $mail->addAddress($get_email); // User's email

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password';
            $email_body = "
                        <h2>This is an email for password reset , $get_name</h2>
                        <h5>Verify if this is your email address to reset password with the below given link </h5>
                        <br><br>
                        <a href='http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$get_email'>Click Me!</a>

                        ";
            $mail->Body=$email_body;
            //$mail->Body = 'Thank you for registering, ' . $username . '!';
            $mail->send();
            //echo "Registration successful! Confirmation email sent.";

}
if (isset($_POST['password-reset-link'])) 
{
	echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
	
	$email = $_SESSION["email"];
	$token = md5(rand());

	$check_email = "SELECT firstname, email FROM customers WHERE email = '$email' LIMIT 1 ";
	$check_email_run = mysqli_query($conn, $check_email);

	if(mysqli_num_rows($check_email_run) > 0)
	{
		$row = mysqli_fetch_array($check_email_run);
		$get_name = $row['firstname'];
		$get_email = $row['email'];

		$update_token = "UPDATE customers SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
		$update_token_run = mysqli_query($conn, $update_token);

		if($update_token_run)
		{
			send_password_reset($get_name, $get_email, $token);
			//echo "Password reset link sent to email";
    		 echo "<script>
                Swal.fire({
                    title: 'Password reset link sent to email!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../user.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";
    		//header("Location: ../password-reset.php");
			exit(0);
		}
		else
		{
			// echo "Something went wrong";
			 echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../user.php'; // Redirect to desired page after error
                    }
                });
            </script>";

			exit(0);
		}
	}
	else
	{
		// echo "no Email found";
   		echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'no Email found.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../user.php'; // Redirect to desired page after error
                    }
                });
            </script>";
		exit(0);
	}
}

if(isset($_POST['password_update']))
{
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
	$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
	$hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
	$token = mysqli_real_escape_string($conn, $_POST['password_token']);

	if(!empty($token))
	{
		if(!empty($email) && !empty($new_password) && !empty($confirm_password))
		{
			//Check if Token is valid
			$check_token = "SELECT verify_token FROM customers WHERE verify_token='$token' LIMIT 1";
			$check_token_run = mysqli_query($conn,$check_token);

			if(mysqli_num_rows($check_token_run) > 0 )
			{
				if($new_password == $confirm_password)
				{

					$sql = "UPDATE customers 
					        SET pass = ?
					        WHERE verify_token = ?";
					$upd_cust_stmt = $conn->prepare($sql);
					$upd_cust_stmt->bind_param("ss", $hashedPassword, $token);

					   if ($upd_cust_stmt->execute()) 
					   {
					   	$new_token = md5(rand())."PetHaven";
						$update_to_new_token = "UPDATE customers SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
						$check_token_run = mysqli_query($conn,$update_to_new_token);
						   	echo "<script>
				                Swal.fire({
				                    title: 'New Password Successfully updated!',
				                    icon: 'success',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = 'http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/user.php'; // Redirect to desired page after successful insert
				                    }
				                });
				            </script>";

					    } else {
					    	echo "<script>
				                Swal.fire({
				                    title: 'Error!',
				                    text: 'Did not Update Password.',
				                    icon: 'error',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = 'http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$email'; // Redirect to desired page after error
				                    }
				                });
				            </script>";
					    }

				}
				else
				{
					echo "<script>
				                Swal.fire({
				                    title: 'Error!',
				                    text: 'Password and Confirm Password does not match.',
				                    icon: 'error',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = 'http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$email'; // Redirect to desired page after error
				                    }
				                });
				            </script>";
				
				}
			}
			else
			{
			echo "<script>
				                Swal.fire({
				                    title: 'Error!',
				                    text: 'Invalid Token.',
				                    icon: 'error',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = 'http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$email'; // Redirect to desired page after error
				                    }
				                });
				            </script>";	
	
					exit(0);
			}
		}
		else
		{
					echo "<script>
				                Swal.fire({
				                    title: 'Error!',
				                    text: 'All fields are mandatory.',
				                    icon: 'error',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = '.http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$email'; // Redirect to desired page after error
				                    }
				                });
				            </script>";	
		exit(0);
		}
	}
	else
	{
		echo "<script>
				                Swal.fire({
				                    title: 'Error!',
				                    text: 'No Token Available.',
				                    icon: 'error',
				                    showConfirmButton: false,
				                    timer: 1500
				                }).then((result) => {
				                    if (result.dismiss === Swal.DismissReason.timer) {
				                        window.location.href = 'http://localhost//Pawpointment-Final/PawPointment/customer-dashboards/password-reset/password-change.php?token=$token&email=$email'; // Redirect to desired page after error
				                    }
				                });
				            </script>";

		exit(0);
	}
}
$conn->close();
?>