<?php include 'include/header.php'?> 
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login100">
					<span class="login100-form-logo">
						<i class="zmd"><img src="../../assets/img/logo.png" alt="" width="100%" height="auto"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Update Staff
					</span>
					
					<?php
						require_once '../backend/connection.php';

						if ($_SERVER["REQUEST_METHOD"] == "GET") {
							$staff_id = $_GET["staff_id"];
							$sql = "SELECT * FROM staff WHERE staff_id = $staff_id";
							$result = mysqli_query($conn, $sql);
							
							if (mysqli_num_rows($result) == 1) {
								$row = mysqli_fetch_assoc($result); 
								?>
								<form method="post" action="../backend/crude.php" id="update-staff">
									<input type="hidden" name="roles" value="update-staff"> 	
									<input type="hidden" name="staff_id" value="<?php echo $row["staff_id"]; ?>"> 	
									<div class="form-container">
										<div class="wrap-input100 validate-input" data-validate = "Last Name">
											<input class="input100" type="text" name="lname" value="<?php echo $row["lastname"]; ?>"> 
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>

										<div class="wrap-input100 validate-input" data-validate = "First Name">
											<input class="input100" type="text" name="fname" value="<?php echo $row["firstname"]; ?>"> 
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>

										<div class="wrap-input100 validate-input" data-validate = "Middle Initial">
											<input class="input100" type="text" name="mname" value="<?php echo $row["MI"]; ?>"> 
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>
									</div>

									<div class="form-container">
										<div class="wrap-input100 validate-input" data-validate = "Email">
											<input class="input100" type="email" name="email"  value="<?php echo $row["email"]; ?>" readonly>
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>

										<div class="wrap-input100 validate-input" data-validate="Password">
											<input class="input100" type="password" name="password" value="<?php echo $row["pass"]; ?>">
											<span class="focus-input100" data-placeholder="&#xf191;"></span>
										</div>
									</div>

									<div class="form-container">
										<div class="wrap-input100 validate-input">
											<select class="select-style input100" name="gender" id="gender">
												<option value="<?php echo $row["gender"]; ?>" style="color:black"><?php echo $row["gender"]; ?></option>
												<option value="Male" style="color:black">Male</option>
												<option value="Female" style="color:black">Female</option>
												<option value="Other" style="color:black">Other</option>
											</select>
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>

										
										<div class="wrap-input100 validate-input">
											<select class="select-style input100" name="position" id="position">
												<option value="<?php echo $row["position"]; ?>" style="color:black"><?php echo $row["position"]; ?></option>
												<option value="Staff" style="color:black">Staff</option>
												<option value="Doctor 1" style="color:black">Doctor 1</option>
												<option value="Doctor 2" style="color:black">Doctor 2</option>
												<option value="Cashier" style="color:black">Cashier</option>
											</select>
											<span class="focus-input100" data-placeholder="&#xf207;"></span>
										</div>
									</div>

									<div class="container-login100-form-btn">
										<button type="submit" class="login100-form-btn" style="background-color: green">
											<i class="fas fa-check" style="color:white"></i> 
										</button>
										<a href="../staff.php">
											<button type="button" class="login100-form-btn" style="background-color: green">
												<i class="fas fa-times" style="color:white"></i> 
											</button>
										</a>
									</div>
								</form>
								<?php
							} else {
								echo "Staff data not found.";
							}
						}

						mysqli_close($conn);
						?>
			</div>
		</div>
	</div>
	<?php include 'include/footer.php' ?>