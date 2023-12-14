<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
	session_start();
	include('connection.php');
	if(isset($_GET['token']))
	{
		$token = $_GET['token'];
		$verify_query = "SELECT verify_token,verify_status FROM customers WHERE verify_token='$token' LIMIT 1";
		$verify_query_run = mysqli_query($conn, $verify_query);

		if(mysqli_num_rows($verify_query_run) > 0)
		{
			$row = mysqli_fetch_array($verify_query_run);
			// echo $row['verify_token'];
			if($row['verify_status'] == "0")
			{
				$clicked_token = $row['verify_token'];
				$update_query = "UPDATE customers SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
				$update_query_run = mysqli_query($conn, $update_query);

				if($update_query_run)
				{
					$_SESSION['status'] = "Your Account has been verified Successfully.! ";
					//header("Location: ../customer-log.php");
					           echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "Your Account has been verified Successfully.!",
                                text: "Registration Successfull",
                                type: "success",
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                                }, function() {
                                    window.location = "../../index.php";
                                });
                            });
                        </script>';
					exit(0);
				}
				else
				{
					$_SESSION['status'] = "Verification Failed";
					//header("Location: ../customer-log.php");
					         echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "Verification Failed! ",
                                text: "We regret to inform you that the following action could not be completed successfully",
                                type: "error",
                                timer: 5000,
                                showCancelButton: false,
                                showConfirmButton: false
                                }, function() {
                                    window.location = "../customer-reg.php";
                                });
                            });
                        </script>';
					exit(0);
				}
			}
			else
			{
				$_SESSION['status'] = "Email already Verified. Please Login";
				//header("Location: ../customer-log.php");
				         echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "Email already verified. Please Login!",
                                text: "We regret to inform you that the following action could not be completed successfully",
                                type: "error",
                                timer: 5000,
                                showCancelButton: false,
                                showConfirmButton: false
                                }, function() {
                                    window.location = "../../index.php";
                                });
                            });
                        </script>';
				exit(0);
			}
		}
		else
		{
			$_SESSION['status'] = "This token does not exist";
			//header("Location: ../customer-log.php");
			         echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "This token does no exist",
                                text: "We regret to inform you that the following action could not be completed successfully",
                                type: "error",
                                timer: 5000,
                                showCancelButton: false,
                                showConfirmButton: false
                                }, function() {
                                    window.location = "../customer-reg.php";
                                });
                            });
                        </script>';
		}
	}
	else
	{
		$_SESSION['status'] = "Not Allowed";
		         echo '<script>
                        setTimeout(function() {
                            swal({
                                title: "Not Allowed",
                                text: "We regret to inform you that the following action could not be completed successfully",
                                type: "error",
                                timer: 5000,
                                showCancelButton: false,
                                showConfirmButton: false
                                }, function() {
                                    window.location = "customer-log.php";
                                });
                            });
                        </script>';
		//header("Location: ../customer-log.php");
	}


?>