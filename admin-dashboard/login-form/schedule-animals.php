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
			<div class="wrap-login100">
			<?php

			$conn = mysqli_connect("localhost", "id21596882_root", "Animal@123", "id21596882_pawheaven");

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$animal_id = $_GET["animal_id"];
				$firstname = $_GET["firstname"];
				$lastname = $_GET["lastname"];

				$sql_customers = "SELECT customer_id FROM customers WHERE firstname = ? AND lastname = ?";
				$stmt_customers = mysqli_prepare($conn, $sql_customers);
				mysqli_stmt_bind_param($stmt_customers, "ss", $firstname, $lastname);
				mysqli_stmt_execute($stmt_customers);

				// Get the customer ID from the result set
				$customer_id = mysqli_stmt_get_result($stmt_customers)->fetch_assoc()["customer_id"];

				$sql_animals = "SELECT * FROM animals WHERE animals_id = ? AND customer_id = ?";
				$stmt_animals = mysqli_prepare($conn, $sql_animals);
				mysqli_stmt_bind_param($stmt_animals, "ii", $animal_id, $customer_id);
				mysqli_stmt_execute($stmt_animals);
			
				// Get the result set from the statement
				$result_animals = mysqli_stmt_get_result($stmt_animals);
			
				// Check the number of rows returned
				$num_rows_animals = mysqli_num_rows($result_animals);
			
				if ($num_rows_animals == 1) {
					$row_animals = mysqli_fetch_assoc($result_animals);

            ?>
			
			<form action="../backend/crude.php" method="POST" id="add-staff" class="login100-form validate-form" enctype="multipart/form-data">
				
				<input type="hidden" name="roles" value="update-status">	
				<input type="hidden" name="animals_id" value="<?php echo $row["animals_id"]; ?>">
				<input type="hidden" name="customer_id" value="<?php echo $row["customer_id"]; ?>">
					<span class="login100-form-logo">
						<i class="zmd"><img src="../../assets/img/logo.png" alt="" width="100%" height="auto"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Animal Status
					</span>
					<div class="form-container">

						<div class="wrap-input100 validate-input">
							<select class="select-style input100" name="status" id="status">
								<option value="No Status" style="color:black">Select Status</option>
								<option value="On Going" style="color:black">On Going</option>
								<option value="Completed" style="color:black">Completed</option>
								<option value="Admitted" style="color:black">Admitted</option>
								<option value="Consultation" style="color:black">Consultation</option>
							</select>
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>

						<div class="wrap-input100 validate-input">
							<select class="select-style input100" id="staff_id" name="staff_id">
								<option value="" disabled selected>Select Staff</option>
								
								<?php
								// Fetch IDs from the other_table
								$sql = "SELECT * FROM staff WHERE position = 'Doctor' OR position = 'Doctor 1' OR position='Doctor 2'";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									echo "<option value='" . $row["staff_id"] . "' style='color:black'>" . $row["lastname"] .", ". $row["firstname"] ." ". $row["MI"] . "</option>";
									}
									}
								?>
							</select>
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input100 validate-input" data-validate = "Start Date">
							<input class="input100" type="datetime-local" name="start_date" id="start_date">
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "End Date">
							<input class="input100" type="datetime-local" name="end_date" id="end_date">						
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div>
					</div>					
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" style="background-color: green">
							<i class="fas fa-check" style="color:white"></i> 
						</button>
						<a href="../animals.php">
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