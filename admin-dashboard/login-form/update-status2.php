<?php include 'include/header.php'?>

<head>
    <style>
        .cancel-button {
            position: absolute;
            top: 100px;
            right: 20%; 
            background-color: transparent;
            border: none;
            color: red; 
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
            <div class="wrap-login100">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "pawheaven");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $appointment_no = $_GET["appointment_no"];
                    $sql = "SELECT * FROM appointment WHERE appointment_id = $appointment_no";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                ?>

                        <form action="../backend/crude.php" method="POST" id="add-staff" class="login100-form validate-form" enctype="multipart/form-data">

						<input type="hidden" name="roles" value="schedule-appointment">	
						<input type="hidden" name="appointment_no" value="<?php echo $row["appointment_id"]; ?>">

							<span class="login100-form-logo">
								<i class="zmd"><img src="../../assets/img/logo.png" alt="" width="100%" height="auto"></i>
							</span>

							<span class="login100-form-title p-b-34 p-t-27">
								Animal Status
							</span>
							<div class="form-container">
								<div class="wrap-input100 validate-input" data-validate = "Start Date">
									<input class="input100" type="datetime-local" name="start_date" id="start_date" value="<?php echo $row["start_event_date"]; ?>" readonly>
									<span class="focus-input100" data-placeholder="&#xf207;"></span>
								</div>
								
								<div class="wrap-input100 validate-input" data-validate = "End Date">
									<input class="input100" type="datetime-local" name="end_date" id="end_date" >
									<span class="focus-input100" data-placeholder="&#xf207;"></span>
								</div>
							</div>			
							<div class="form-container">

								<div class="wrap-input100 validate-input">
									<select class="select-style input100" name="status" id="status">
										<?php $options = array("Done", "Admitted", "Consultation"); ?>
										<option value="<?php echo $row["appointment_status"]; ?>" style="color:black"><?php echo $row["appointment_status"]; ?></option>
										<?php
											foreach ($options as $option) {
										$selected = ($row['appointment_status'] == $option) ? "selected" : "";
										echo "<option value='$option' $selected style='color:black'>$option</option>";
									}
										?>
									</select>
									<span class="focus-input100" data-placeholder="&#xf207;"></span>
								</div>

								<div class="wrap-input100 validate-input">
									<select class="select-style input100" name="staff" id="staff">
										<?php
										$sql = "SELECT * FROM `staff` WHERE `position` LIKE '%Doctor%'";
										$result = $conn->query($sql); ?>
										<option value="" selected style="color:black;">Select Doctor</option>
										<?php
											if ($result->num_rows > 0) {
												// Output data of each row
												while ($row = $result->fetch_assoc()) {
													// Display the full name of the staff
													$fullName = $row['firstname'] . ' ' . $row['lastname'];
													echo '<option value="' . $row['staff_id'] . '" style="color:black">' . $fullName . '</option>';
												}
										?>
									</select>
									<span class="focus-input100" data-placeholder="&#xf207;"></span>
									<?php 
											}
									?>
								</div>

							</div>		
							
							<div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn" style="background-color: green">
                                    <i class="fas fa-check" style="color:white"></i> 
                                </button>
                                <a href="../pet-status.php">
                                    <button type="button" class="login100-form-btn" style="background-color: green">
                                        <i class="fas fa-times" style="color:white"></i> 
                                    </button>
                                </a>
                            </div>
                        </form>
                <?php
                    } else {
                        echo "Appointment data not found.";
                    }
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
    <?php include 'include/footer.php' ?>