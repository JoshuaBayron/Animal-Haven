<?php include 'include/header.php'?>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login100">

			<form action="../backend/crude.php" method="POST" id="add-staff" class="login100-form validate-form" enctype="multipart/form-data"> <!--dont edit-->	

				<input type="hidden" name="roles" value="add-walk-in-pet">	

					<span class="login100-form-logo">
						<i class="zmd">
						    <img id="image-preview" src="../../assets/img/logo.png" alt="" width="100%" height="auto">
						</i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Add Customer & Animal Information
					</span>

					<div class="form-container">
						<span class="login100-form-title" style="font-size:20px">
							Customer Information
						</span>
					</div>

					<div class="form-container">

						<div class="wrap-input100 validate-input" data-validate = "Last Name">
							<input required class="input100" type="text" name="lname" id="lname" maxlength=20> 
							<span class="focus-input100" data-placeholder="&#xf207; Last Name"></span>
						</div>
						<br>
						<div class="wrap-input100 validate-input" data-validate = "First Name">
							<input required class="input100" type="text" name="fname" id="fname" maxlength=20> 
							<span class="focus-input100" data-placeholder="&#xf207; First Name"></span>
						</div>
						<br>
						<div class="wrap-input100 validate-input" data-validate = "Middle Initial">
							<input required class="input100" type="text" name="mname" id="mname" maxlength=1> 
							<span class="focus-input100" data-placeholder="&#xf207; Middle Initial"></span>
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
						<div class="wrap-input100 validate-input" data-validate = "Contact">
							<input class="input100" type="tel" pattern="\d{4} \d{3} \d{4}" title="Please enter a valid format (09** *** ****)" name="contact" id="contact" required>
							<span class="focus-input100" data-placeholder="&#x260E; Contact Number"></span>
						</div>
					</div>

					<div class="form-container">
						<span class="login100-form-title" style="font-size:20px">
							Animal Information
						</span>
					</div>

					<div class="form-container">
						<div class="wrap-input100 validate-input" data-validate="Animal Name">
							<input required class="input100" type="text" name="animal" id="animal"> 
							<span class="focus-input100" data-placeholder="&#x1F408; Animal Name"></span>
						</div>
						<div class="wrap-input100 validate-input" data-validate="Quantity">
							<input class="input100" type="number" name="quantity" id="quantity" required>
							<span class="focus-input100" data-placeholder="&#x1F408; Quantity"></span>
						</div>
					</div>
					<div class="form-container">
						<div class="wrap-input100 validate-input" data-validate="Species">
							<select class="select-style input100" name="species" id="species" onchange="toggleOtherInfo()" required>
								<option value="" disabled selected style="color:black"></option>
								<option value="Cat" style="color: black">Cat</option>
								<option value="Dog" style="color: black">Dog</option>
								<option value="Others" style="color: black">Others</option>
							</select>
							<span class="focus-input100" data-placeholder="&#x1F408; Specie"></span>
						</div>
						
						<div class="wrap-input100 hidden" id="otherInput">
							<input class="input100" type="text" name="otherSpecie" id="otherSpecie"> 
							<span class="focus-input100" data-placeholder="&#x1F408; Specify Specie"></span>
						</div>		
					</div>
					<div id=showothers style="display:none;">
						<div class="form-container">
							<div class="wrap-input100">
								<input class="input100" type="text" name="breed" id="breed" placeholder="Breed"> 
								<span class="focus-input100" data-placeholder="&#x1F408;"></span>
							</div>	
							<div class="wrap-input100">
								<select class="select-style input100" name="Animal-gender" id="Animal-gender">
									<option value="Other" disabled selected style="color:black"></option>
									<option value="Male" style="color:black">Male</option>
									<option value="Female" style="color:black">Female</option>
									<option value="Other" style="color:black">Other</option>
								</select>
								<span class="focus-input100" data-placeholder="&#x1F408; Sex"></span>
							</div>
						</div>
						<div class="form-container">
							<div class="wrap-input100" >
								<input class="input100" type="date" name="birthdate" id="birthdate">
								<span class="focus-input100" data-placeholder="&#x1F408; Birthdate"></span>
							</div>		

							<div class="wrap-input100" style="width:20%;" >
								<input class="input100" type="number" name="age" id="age" oninput="updateUnits()"> 
								<span class="focus-input100" data-placeholder="&#x1F408; Age"></span>
							</div>	
							<div class="wrap-input100" style="width:20%;">
								<select class="input100" name="age_unit" id="age_unit">
								<option value="" disabled selected style="color:black"></option>
								<option value="months" style="color: black">Months</option>
								<option value="years" style="color: black">Years</option>
								</select>
								<span class="focus-input100" data-placeholder="&#x1F408; Age"></span>
							</div>
						</div>
					</div>
					

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" style="background-color: green">
							<i class="fas fa-check" style="color:white"></i> 
						</button>
						<a href="../walk-in.php">
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
		var currentDate = new Date();
		var yesterday = new Date(currentDate);
		yesterday.setDate(currentDate.getDate() - 1);
		document.getElementById("birthdate").setAttribute("max", yesterday.toISOString().slice(0, 10));


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
		function updateUnits() {
		var ageInput = document.getElementById('age');
		var unitSelect = document.getElementById('age_unit');
		
		if (parseInt(ageInput.value) > 11) {
			unitSelect.value = 'years';
		} else {
			unitSelect.value = 'months';
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

		function toggleOtherInfo() {
			var speciesSelect = document.getElementById("species");
			var showOthersDiv = document.getElementById("showothers");
			var quantityInput = document.getElementById("quantity");
			var breedInput = document.getElementById("breed");
			var otherInput = document.getElementById("otherInput");
			// Show or hide the 'showothers' div based on the selected species
			showOthersDiv.style.display = (speciesSelect.value === "Cat" || speciesSelect.value === "Dog") ? "block" : "none";

			// Set quantity to 1 and disable the input for "Cat" or "Dog"
			if (speciesSelect.value === "Cat" || speciesSelect.value === "Dog") {
				quantityInput.value = 1;
				quantityInput.disabled = true;
				breedInput.disabled = false;
				otherInput.classList.add("hidden");
			} else {
				// Enable the input for "Others"
				quantityInput.disabled = false;
				breedInput.disabled = true;
				otherInput.classList.remove("hidden");
			}
		}
	</script>

<?php include 'include/footer.php' ?>