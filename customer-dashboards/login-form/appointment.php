<?php include 'include/header.php'; ?>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
            <div class="wrap-login100">

                <span class="login100-form-title p-b-34 p-t-27">
                    Appointment
                </span>
                <a href="../animal-info.php" class="wrap-logout"><i class="fas fa-sign-out-alt" style="font-size: 24px; position: absolute; top: 10px; right: 10px; color:red"></i></a>

                <?php 
                $conn = mysqli_connect("localhost", "root", "", "pawheaven");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $animalName = ""; // Initialize the variable

                if (isset($_GET['animal_id']) && !empty($_GET['animal_id'])) {
                    $animal_id = intval($_GET['animal_id']);
                    $sql = "SELECT *, a.*, s.*, o.* FROM appointment as app
                            INNER JOIN animals as a ON app.animals_id = a.animals_id
                            INNER JOIN staff as s ON app.staff_id = s.staff_id
                            INNER JOIN customers as o ON app.customer_id = o.customer_id
                            WHERE a.animals_id = $animal_id";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $animalName = $row['animal_name'];
                            $customerID = $row['customer_id'];

                        }
                        mysqli_free_result($result);
                    }

                    // Fetch options for service and status
                    $serviceOptions = array("CheckUp", "Deworming", "Vaccine", "Groom", "Surgery"); // Replace with actual service options
                    
                }
                ?>

                <form action="../backend/add.php" method="POST" id="admin" class="login100-form validate-form" enctype="multipart/form-data">
                    <input type="hidden" name="role" value="add-appointment">
                    <input type="hidden" name="animals_id" value="<?php echo $animal_id ?>">
                    <input type="hidden" name="customer_id" value="<?php echo $customerID ?>">
                    <div class="form-container">
                        <div class="wrap-input100">
                            <h1 class="input100">Animal Identifier Number: <?php echo $animal_id ?></h1>     
                            <span class="focus-input100" ></span>
                        </div>
                        <div class="wrap-input100">
                            <h1 class="input100">Customer Identifier: <?php echo $customerID?></h1>     
                            <span class="focus-input100" ></span>
                        </div>
                    </div>
                    
                    <div class="form-container">
                        <div class="wrap-input100 " style="width:40%">
                            <label for="animalName" class="focus-input100 input100" style="top:-30%; left:-3%">Animal Name:</label>
                            <input class="input100" type="text" name="animalName" value="<?php echo $animalName; ?>" readonly>     
                            <span class="focus-input100" ></span>
                        </div>

                        <div class="wrap-input100 " style="width:40%">
                            <label for="service" class="focus-input100 input100" style="top:-30%; left:-10%">Service:</label>
                            <select class="input100-select" name="service">
                                <option value="" selected disabled>Select Service</option>
                                <?php
                                foreach ($serviceOptions as $option) {
                                     echo '<option value="' . $option . '" style="color:black;">' . $option . '</option>';
                                }
                                ?>
                            </select>
                            <span class="focus-input100"></span>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="wrap-input100 " style="width:40%">
                            <label for="date-start" class="focus-input100 input100" style="top:-30%; left:-10%">Start Date and Time:</label>
                            <input class="input100" type="date" name="date-start" id="date-start">
                            <input class="input100" type="time" name="time-start" id="time-start">     
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 " style="width:40%">
                            <label for="date-end" class="focus-input100 input100" style="top:-30%; left:-10%">End Date and Time:</label>
                            <input class="input100" type="date" name="date-end" id="date-end">
                            <input class="input100" type="time" name="time-end" id="time-end">     
                            <span class="focus-input100"></span>
                        </div>
                    </div>
                    
                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" style="background-color: green">
                            <i class="fas fa-check" style="color:white"></i> 
                        </button>
                    </div>
                </form>
                <br>
                <?php include 'appointment-table.php'?>
            </div>
        </div>
    </div>

    <?php include 'include/footer.php'; ?>
    <script>
	  // Get the current date and time
	  const currentDate = new Date();
	  
	  // Format the date as "YYYY-MM-DD" for the date input
	  const formattedDate = currentDate.toISOString().slice(0, 10);
	  
	  // Format the time as "HH:MM" for the time input
	  const formattedTime = currentDate.toTimeString().slice(0, 5);
	  
	  // Set the values of the date and time inputs
	  document.getElementById('date-start').value = formattedDate;
	  document.getElementById('time-start').value = formattedTime;
	  document.getElementById('date-end').value = formattedDate;
	  document.getElementById('time-end').value = formattedTime;
	</script>
</body>
</html>