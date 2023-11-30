<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php 
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST["role"];
     if($role === "add-appointment"){
     	$animalID = $_POST['animals_id'];
     	$customerID = $_POST['customer_id'];
     	$service = $_POST['service'];
     	$sdate = $_POST['date-start'];
     	$stime = $_POST['time-start'];
     	$edate = $_POST['date-end'];
     	$etime = $_POST['time-end'];

     	$sql = "INSERT INTO `appointment`(`animals_id`, `customer_id`, `appointment_service`, `start_event_date`, `end_event_date`, `start_event_time`, `end_event_time`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $add_appointment_stmt = $conn->prepare($sql);
        $add_appointment_stmt->bind_param("iisssss", $animalID, $customerID, $service, $sdate, $edate, $stime, $etime);

        if ($add_appointment_stmt->execute()) {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "SUCCESS",
                        text: "Your request has been completed successfully",
                        type: "success",
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                        }, function() {
                            window.location = "../animal-info.php";
                        });
                    });
                </script>';
        } else {
            echo '<script>
                setTimeout(function() {
                    swal({
                        title: "FAILED",
                        text: "We regret to inform you that the following action could not be completed successfully",
                        type: "error",
                        timer: 5000,
                        showCancelButton: false,
                        showConfirmButton: false
                        }, function() {
                            window.location = "../animal-info.php";
                        });
                    });
                </script>';
        }
     }else {
        echo '<script>
        setTimeout(function() {
            swal({
                title: "FAILED",
                text: "Invalid Role!",
                type: "error",
                timer: 2000,
                showCancelButton: false,
                showConfirmButton: false
                }, function() {
                    window.location = "../animal-info.php";
                });
            });
        </script>';
    }
 }else {
	echo '<script>
	setTimeout(function() {
	    swal({
	        title: "FAILED",
	        text: "Invalid Request!",
	        type: "error",
	        timer: 2000,
	        showCancelButton: false,
	        showConfirmButton: false
	        }, function() {
	            window.location = "../animal-info.php";
	        });
	    });
	</script>';
}

$conn->close();
?>
