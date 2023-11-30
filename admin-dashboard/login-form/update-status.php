<?php include 'include/header.php'?>
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
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login500">
			<?php
				$conn = mysqli_connect("localhost", "id21596882_root", "Animal@123", "id21596882_pawheaven");

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				if ($_SERVER["REQUEST_METHOD"] == "GET") {
					$appointment_no = $_GET["appointment_no"];
					$animalName = $_GET["animalName"];
					$customerEmail=$_GET["customerEmail"];
					$staffEmail=$_GET["staffEmail"];

					$sql = "SELECT * FROM appointment WHERE appointment_id = $appointment_no";
					$result = mysqli_query($conn, $sql);

					if (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_assoc($result);
            ?>
			
			<form action="../backend/crude.php" method="POST" id="add-staff" class="login100-form validate-form" enctype="multipart/form-data">
				
				<input type="hidden" name="roles" value="update-status">	
				<input type="hidden" name="appointment_no" value="<?php echo $row["appointment_id"]; ?>">
				<input type="hidden" name="animalName" value="<?php echo $animalName; ?>">
				<input type="hidden" name="customerEmail" value="<?php echo $customerEmail; ?>">
				<input type="hidden" name="staffEmail" value="<?php echo $staffEmail; ?>">
				<input type="hidden" name="service" value="<?php echo $row["appointment_service"]?>">
					<span class="login100-form-logo">
						<i class="zmd"><img src="../../assets/img/logo.png" alt="" width="100%" height="auto"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Animal Status
					</span>
					<div class="form-container">
						<div class="wrap-input500 validate-input">
							<select class="select-style input100" name="status" id="status">
								<?php $options = array("Done", "Admitted", "Consultation"); ?>
								<option value="<?php echo $row["appointment_status"]; ?>" style="color:black"></option>
								<?php
									foreach ($options as $option) {
								$selected = ($row['appointment_status'] == $option) ? "selected" : "";
								echo "<option value='$option' $selected style='color:black'>$option</option>";
							}
								?>
							</select>
							<span class="focus-input100" data-placeholder="&#x2139; Service Status"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "payments">
							<select class="select-style input100" name="payments" id="payments">
							<?php
							$options = array("Paid", "Not Yet Paid", "Half Paid");
							$defaultOption = "Not Yet Paid"; 
							$remarks = $row["remarks"];
							$word = '';	  
							if (stripos($remarks, 'Not Yet Paid') !== false) {
								$word = 'Not Yet Paid';
							} elseif (stripos($remarks, 'Half Paid') !== false) {
								$word = 'Half Paid';
							} elseif (stripos($remarks, 'Paid') !== false) {
								$word = 'Paid';
							}
							?>
							
							<option value="<?php echo isset($row["payment_status"]) ? $word : $defaultOption; ?>" style="color:black">
								<?php echo isset($row["payment_status"]) ? $word : $defaultOption; ?>
							</option>

							<?php
							foreach ($options as $option) {
								$selected = (isset($row['payment_status']) && $row['payment_status'] == $option) ? "selected" : "";
								echo "<option value='$option' $selected style='color:black'>$option</option>";
							}
							?>
							</select>
							<span class="focus-input100" data-placeholder="&#x1F9FE; Payment Status"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "payments">
							<input class="input100" type="text" name="comments" id="comments" value="<?= $row["remarks"];?>">
							<span class="focus-input100" data-placeholder="&#x1F4AC; Add a Remarks"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate="Start Date">
							<input class="input100" type="datetime-local" name="start_date" id="start_date" value="<?php echo $row["start_event_date"]; ?>" readonly>
							<span class="focus-input100" data-placeholder="&#x1F4C6; Date Scheduled"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate="End Date">
							<input class="input100" type="datetime-local" name="end_date" id="end_date" value="<?php echo $row["end_event_date"]; ?>">
							<span class="focus-input100" data-placeholder="&#x1F4C6; Date turnover"></span>
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
	<script>
		var currentDate = new Date();
		var currentDateString = currentDate.toISOString().slice(0,16);

		document.getElementById("end_date").setAttribute("min", currentDateString);

		document.addEventListener("DOMContentLoaded", function () {
        // Array of element IDs to apply dynamic styling
        var elementIds = ["status", "payments", "comments", "start_date", "end_date"];

        // Iterate through each element ID
        elementIds.forEach(function (id) {
            // Get the element and the associated span
            var inputElement = document.getElementById(id);
            var placeholderSpan = inputElement.nextElementSibling;

            // Add the 'has-value' class if the input already has a value
            if (inputElement.value.trim() !== "") {
                placeholderSpan.classList.add("has-value");
            }

            // Add an event listener to the input to dynamically update the class
            inputElement.addEventListener("input", function () {
                if (inputElement.value.trim() !== "") {
                    placeholderSpan.classList.add("has-value");
                } else {
                    placeholderSpan.classList.remove("has-value");
                }
            });
        });
    });
	</script>
	<?php include 'include/footer.php' ?>