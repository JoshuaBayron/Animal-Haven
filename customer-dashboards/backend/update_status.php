<?php include 'header.php'?>

<?php

     include 'connection.php';

    // Retrieve data based on the provided ID
    if (isset($_GET['appointment_id'])) {
        $appointment_id = $_GET['appointment_id'];
        $selectQuery = "SELECT appointment_id, appointment_service, start_event_date , end_event_date,  appointment_status FROM appointment WHERE appointment_id = '$appointment_id'";
        $result = mysqli_query($conn, $selectQuery);
        $row = mysqli_fetch_assoc($result);
    }




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <style type="text/css">
        .back-button {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: #8b9b8d;
      color: #fff;
      border: none;
      padding: 8px 12px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }
    </style>
</head>


<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../img/bg.jpg');">
            <div class="wrap-login100">

            
            
                   <form action="" method="POST" id="customer" class="login100-form validate-form" enctype="multipart/form-data"> 
                <input type="hidden" name="role" value="customer">  
                <div class="container-login100-form-btn">
                     <a href="../animal-status.php">
                          <button type = "button" class="back-button" >
                              <span class="arrow">&#9664;</span>
                          </button>
                    </a>
                </div>
                    <span class="login100-form-logo">
                        <i class="zmd"><img src="images/logo.png" alt="" width="100%" height="auto"></i>
                    </span> 

                  
                    <span class="login100-form-title p-b-34 p-t-27" style="color: black; font-weight: bold;">
                        Update Status
                    </span>
                    <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>" ><br>
                    <div class="form-container">
                        
                        <!-- <div class="wrap-input100 validate-input" data-validate = "image">
                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" class="input100">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                        </div> -->
                    </div>
                     <div class="form-container">
                        
                        <div class="wrap-input100 validate-input" data-validate="Gender">
                            <label class = "input100" for="appointment_service" style="color: black; font-weight: bold;">&#x23F0;Appointment Service:</label>
                            <select class = "input100" class="form-control" id="appointment_service" name="appointment_service" style=" font-weight: bold;">
                                    <option value="<?php echo $row['appointment_service']; ?>"><?php echo $row['appointment_service']; ?></option>
                                    <option value="Vaccination" style="color:black">Vaccination</option>
                                    <option value="Consultation" style="color:black">Consultation</option>
                                    <option value="Surgery" style="color:black">Surgery</option>
                                    <option value="Treatment" style="color:black">Treatment</option>
                                    <option value="Grooming" style="color:black">Grooming</option>
                            </select>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Gender">
                            <label class = "input100" for="start_event_date" style="color: black; font-weight: bold;">&#x1F4C5;Start Date:</label>
                             <input class="input100" type="datetime-local" id="start_event_date" name="start_event_date" value="<?php echo $row['start_event_date']; ?>" required style="width: 100%;  font-weight: bold;">
                            

                        
                        </div>


                    </div>
                    

 <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" style="background-color: green; width:50px">
                            <i class="fas fa-check" style="color:white"></i> 
                        </button>
                        <a href="../animal-status.php">
                            <button type="button" class="login100-form-btn" style="background-color: green">
                                <i class="fas fa-times" style="color:white"></i> 
                            </button>
                        </a>
                    </div>
                </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        
           // Get the current time plus 30 minutes in the format required by datetime-local input
        function getCurrentDateTime() {
            const now = new Date();
            now.setMinutes(now.getMinutes() + 30);
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        // Set the min attribute of the input to the current time plus 30 minutes
        document.getElementById('start_event_date').min = getCurrentDateTime();

        // Update the min attribute dynamically as the current time changes
        setInterval(() => {
            document.getElementById('start_event_date').min = getCurrentDateTime();
        }, 60000); // Update every minute (adjust as needed)
    </script>
            </div>
        </div>
    </div>
</body>
</html>
 <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Handle the update here
        $appointment_id = $_POST['appointment_id'];
        $appointment_service = $_POST['appointment_service'];
        $start_event_date = $_POST['start_event_date'];
    

        $updateQuery = "UPDATE appointment SET appointment_service = '$appointment_service', start_event_date = '$start_event_date' WHERE appointment_id = '$appointment_id'";

        if ($conn->query($updateQuery) === TRUE) {
            //echo "Record updated successfully";
            // header('Location: ../animal-info.php');
       echo "<script>
                Swal.fire({
                    title: 'Pet Information Updated Successfully!',
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
            echo "Error updating record: " . mysqli_error($conn);
         echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to Update.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-status.php'; // Redirect to desired page after error
                    }
                });
            </script>";
        }
    }

 
    
    ?>

 <style>
    .container-login100-form-btn {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.login100-form-btn {
  font-family: Poppins-Medium;
  font-size: 16px;
  color: #555555;
  line-height: 1.2;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  min-width: 120px;
  height: 50px;
  border-radius: 25px;

  background: #9152f8;
  background: -webkit-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: -o-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: -moz-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: linear-gradient(bottom, #ffff00, #4C3D3D);
  position: relative;
  z-index: 1;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: #fff;
  top: 0;
  left: 0;
  opacity: 1;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn[type="submit"]::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: green;

  top: 0;
  left: 0;
  opacity: 1;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn[type="button"]::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: red;

  top: 0;
  left: 0;
  opacity: 1;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn:hover {
  color: #fff;
}

.login100-form-btn:hover:before {
  opacity: 0;
}
 </style>
 <?php include 'footer.php'
  
  ?>