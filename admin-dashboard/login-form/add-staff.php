<?php include 'include/header.php'?>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login500">

			<form action="../backend/crude.php" method="POST" id="add-staff" class="login100-form validate-form" enctype="multipart/form-data"> <!--dont edit-->	

				<input type="hidden" name="roles" value="add-staff">	

					<span class="login100-form-logo">
						<i class="zmd">
						    <img id="image-preview" src="../../assets/img/logo.png" alt="" width="100%" height="auto">
						</i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Register Staff
					</span>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "Last Name">
							<input class="input100" required type="text" name="lname" id="lname" maxlength="20"> 
							<span class="focus-input100" data-placeholder="&#xf207; Last Name"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "First Name">
							<input class="input100" required type="text" name="fname" id="fname" maxlength="20"> 
							<span class="focus-input100" data-placeholder="&#xf207; First Name"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "Middle Initial">
							<input class="input100" required type="text" name="mname" id="mname" maxlength="1"> 
							<span class="focus-input100" data-placeholder="&#xf207; Middle Initial"></span>
						</div>
					</div>
					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "Email">
							<input class="input100" type="email" name="email" id="username" required>
							<span class="focus-input100" data-placeholder="&#x2709; Email"></span>
							<div id="email-feedback"></div>
						</div>
					</div>
					
					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate="Password">
							<input class="input100" type="password" name="password" id="password" oninput="checkPasswordStrength(this.value)" required>
							<span class="focus-input100" data-placeholder="&#xf191; Password"></span>
							<div id="password-strength"></div>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate="Retype Password">
							<input class="input100" type="password" name="retypepassword" id="retypepassword" oninput="checkPasswordMatched()" required>
							<span class="focus-input100" data-placeholder="&#xf191; Retype Password"></span>
							<div id="message"></div>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input500">
							<div class = "validate-input">
								<select class="select-style input100" id="position" name="position" onchange="showTextBox()" required>
									<option value="" disabled selected style="color: black"></option>
									<option value="Staff" style="color: black">Staff</option>
									<option value="Doctor 1" style="color: black">Doctor</option>
									<option value="Other" style="color: black">Other</option>
								</select>
								<span class="focus-input100" data-placeholder="&#xf207; Position"></span>
							</div>
							
							<div id="otherPositionDiv" style="display: none;">
								<label for="otherPosition" style="color:white">Specify Other Position:</label>
								<input class="input100" type="text" name="otherPosition" id="otherPosition">
							</div>
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
			</div>
		</div>
	</div>
	<script>
		const fileInput = document.getElementById('edit-icon');
		const imagePreview = document.getElementById('image-preview');

		fileInput.addEventListener('change', function(event) {
			const selectedFile = event.target.files[0]; 

			if (selectedFile) {
				const reader = new FileReader();
				reader.onload = function() {
					imagePreview.src = reader.result;
				};
				reader.readAsDataURL(selectedFile);
			} else {
				imagePreview.src = '../../assets/img/logo.png';
			}
		});

		function checkAndRegister() {
        var email = document.getElementById('username').value;

        if (email.includes('@')) {
            fetch('check_email.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email: email }),
            })
            
        } else {
            $('#email-feedback').html('<div id="error-feedback">Please enter a valid email address</div>');
        }
    }

	function checkPasswordStrength(password) {
		var strength = 0;

		// Add your password strength criteria here
		// For example, you can check the length, use of uppercase/lowercase letters, numbers, and special characters
		var regex = /[A-Za-z]/; // Check for letters
		if (regex.test(password)) {
			strength += 1;
		}

		regex = /\d/; // Check for numbers
		if (regex.test(password)) {
			strength += 1;
		}

		regex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/; // Check for special characters
		if (regex.test(password)) {
			strength += 1;
		}

		// Display the password strength
		var passwordStrengthElement = document.getElementById('password-strength');
		if (strength <= 1) {
			passwordStrengthElement.innerHTML = '<span class="weak">Weak</span>';
		} else if (strength === 2) {
			passwordStrengthElement.innerHTML = '<span class="medium">Medium</span>';
		} else {
			passwordStrengthElement.innerHTML = '<span class="strong">Strong</span>';
		}
		}

		function showTextBox() {
		var positionDropdown = document.getElementById("position");
		var otherPositionDiv = document.getElementById("otherPositionDiv");
		var otherPositionInput = document.getElementById("otherPosition");

		if (positionDropdown.value === "Other") {
			otherPositionDiv.style.display = "block";
			otherPositionInput.required = true;
		} else {
			otherPositionDiv.style.display = "none";
			otherPositionInput.required = false;
		}
	}

	function checkPasswordMatched() {
				var password = document.getElementById("password").value;
				var retypePassword = document.getElementById("retypepassword").value;
				var message = document.getElementById("message");

				if (password === retypePassword) {
					message.style.color = "green";
					message.innerHTML = "Passwords match!";
				} else {
					message.style.color = "red";
					message.innerHTML = "Passwords do not match!";
				}
			}
	</script>

<?php include 'include/footer.php' ?>