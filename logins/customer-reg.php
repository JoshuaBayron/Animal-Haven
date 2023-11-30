<?php include 'header.php'?>

<style>
    .cancel-button {
        position: absolute;
        top: 30px;
        right: 20%; 
        background-color: transparent;
        border: none;
        color: red; 
        cursor: pointer;
    }
    #error-feedback {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #success-feedback {
        color: green;
        font-size: 14px;
        margin-top: 5px;
    }

    #password-strength {
        margin-top: 5px;
        color: #999;
    }
    .weak {
        color: red;
    }
    .medium {
        color: orange;
    }
    .strong {
        color: green;
    }
    .error {
        color: red;
    }
</style>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('bgR.png');">
            <div class="wrap-login500">
                <form action="backend/crude.php" method="POST" id="customer" class="login100-form validate-form" enctype="multipart/form-data"> 
                    <input type="hidden" name="role" value="customer_reg">	

                    <span class="login100-form-logo">
                        <i class="zmd"><img src="../assets/img/logo.png" alt="" width="100%" height="auto"></i>
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        Register Account
                    </span>
					<div class="form-container">
						<!-- <div class="wrap-input100 validate-input" data-validate = "image">
							<input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value="" class="input100">
							<span class="focus-input100" data-placeholder="&#xf207;"></span>
						</div> -->
					</div>

					<div class="form-container">
						<div class="wrap-input500 validate-input" data-validate = "First Name" style="width:100%">
							<input class="input100" type="text" name="fname" id="fname"> 
							<span class="focus-input100" data-placeholder="&#xf207; First Name"></span>
						</div>

						<div class="wrap-input500 validate-input" data-validate = "Last Name" style="width:100%">
							<input class="input100" type="text" name="lname" id="lname"> 
							<span class="focus-input100" data-placeholder="&#xf207; Last Name"></span>
						</div>

						<div class="wrap-input500 validate-input" data-validate = "MI" style="width:50%">
							<input class="input100" type="text" name="mname" id="mname"  maxlength="1"> 
							<span class="focus-input100" data-placeholder="&#xf207; MI"></span>
						</div>


					</div>

					<div class="form-container">

						<div class="wrap-input500 validate-input" data-validate="Username">
							<input class="input100" type="email" name="username" id="username" required>
							<span class="focus-input100" data-placeholder="&#x2709; Email"></span>
							<div id="email-feedback"></div>
						</div>
					</div>
					<div class="form-container">
	
						<div class="wrap-input500 validate-input" data-validate="Password">
							<input class="input100" type="password" name="pass" id="pass" oninput="checkPasswordStrength(this.value)" required>
							<span class="focus-input100" data-placeholder="&#xf191; Password"></span>
							<div id="password-strength"></div>
						</div>

					</div>

					<div class="form-container">

						<div class="wrap-input500 validate-input" data-validate = "Contact">
							<input class="input100" type="tel" pattern="\d{4} \d{3} \d{4}" title="Please enter a valid format (09** *** ****)" name="contact_number" id="contact_number" required>
							<span class="focus-input100" data-placeholder="&#x260E; Contact Number"></span>
						</div>
					</div>

					<div class="form-container">
                        <div class="wrap-input500 validate-input" data-validate="Address">
							<input class="input100" type="text" name="address" id="address" required oninput="validateAddress()">
                            <span class="focus-input100" data-placeholder="🏢 Address"></span>
							<span id="addressError" class="error"></span>
                        </div>
                    </div>

					<div class="form-container">

						<div class="wrap-input500 validate-input" data-validate="Gender">
							<select class="input100" name="gender" id="gender" required>
								<option value="" disabled selected></option>
								<option value="Male" style="color:black">Male</option>
								<option value="Female" style="color:black">Female</option>
								<option value="Prefer Not to Say" style="color:black">Prefer Not to Say</option>
							</select>
							<span class="focus-input100" data-placeholder="⚧ Gender"></span>
						</div>

					</div>
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">Register</button>
					</div>
					<a href="../index.php" class="wrap-logText">Login Here</a>
					
				</form>
			</div>
		</div>
	</div>
	<script>
    $(document).ready(function () {
        $('#emailForm').validate({
            rules: {
                username: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter your email',
                    email: 'Please enter a valid email address'
                }
            },
            submitHandler: function (form) {
                checkAndRegister();
            }
        });
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
	function validateAddress() {
	var addressInput = document.getElementById('address').value.trim();
	var addressComponents = addressInput.split(',');
	if (addressComponents.length === 5) {
		document.getElementById('addressError').innerText = '';
		return true;
	} else {
		document.getElementById('addressError').innerText = 'Output is like (123 Main St, Suburbville, Citytown, Province, Country)'; 
		return false; 
	}
	}
</script>

	<?php include 'footer.php' ?>