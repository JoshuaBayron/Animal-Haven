<?php include 'include/header.php'; ?>
<?php
include '../backend/connection.php';

if (isset($_GET['animal_id']) && !empty($_GET['animal_id'])) {
    // Sanitize the input to prevent SQL injection (you can use other methods for this)
    $animal_id = intval($_GET['animal_id']);
    // Define the SQL query
    $sql = "SELECT * FROM `animals` WHERE animals_id = $animal_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $animalName = $row['animal_name'];
            $species = $row['species'];
            $breed = $row['breed'];
            $quantity = $row['quantity'];
            $sex = $row['gender'];
            $age = $row['age'];
            $birthdate = $row['birthdate'];
        }
    }
} else {
    // Handle the case when animal_id is not provided or is empty
    echo "Invalid animal ID.";
    exit; // Stop execution if animal_id is missing
}

// Close the database connection when done
mysqli_close($conn);
?>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login100">

				<span class="login100-form-title p-b-34 p-t-27">
					Animal Information
				</span>

				<form method="post" action="../backend/update-animals.php" id="update-animal">
					<input type="hidden" name="role" value="update-animal">
					<input type="hidden" name="animals_id" value="<?php echo $animal_id?>">
					<div class="form-container">
						<div class="wrap-input100 validate-input">
							<h1 class="input100">Animal Identifier Number: <?php echo $animal_id?></h1> 	
							<span class="focus-input100" ></span>
						</div>
					</div>
					
					<div class="form-container">
						<div class="wrap-input100 validate-input" style="width:75%">
							<label for="animalName" class="focus-input100 input100" style = "top:-30%; left:-3%">Animal Name:</label>
							<input class="input100" type="text" name="animalName" value="<?php echo $animalName; ?>"> 	
							<span class="focus-input100" ></span>
						</div>

						<div class="wrap-input100 validate-input" style="width:20%">
							<label for="quantity" class="focus-input100 input100" style = "top:-30%; left:-10%">Quantity:</label>
							<input class="input100" type="number" name="quantity" value="<?php echo $quantity; ?>"> 
							<span class="focus-input100"></span>
						</div>
					</div>
					
					<div class="form-container">
						<div class="wrap-input100 validate-input" style="width:25%">
							<label for="sex" class="focus-input100 input100" style="top:-30%; left:-10%">Gender:</label>
							<select class="input100-select" name="sex">
								<span class="selected-option"><?php echo $sex; ?></span>
								<option value="Male" <?php if ($sex == 'Male') echo 'selected'; ?> style="color:black">Male</option>
								<option value="Female" <?php if ($sex == 'Female') echo 'selected'; ?> style="color:black">Female</option>
								<option value="Other" <?php if ($sex == 'Other') echo 'selected'; ?> style="color:black">Other</option>
							</select>
							<span class="focus-input100"></span>
						</div>

						<div class="wrap-input100 validate-input" style="width:25%">
							<label for="age" class="focus-input100 input100" style = "top:-30%; left:-10%">Age:</label>
							<input class="input100" type="number" name="age" value="<?php echo $age; ?>">
							<span class="focus-input100" ></span>
						</div>

						<div class="wrap-input100 validate-input" style="width:35%">
							<label for="birthdate" class="focus-input100 input100" style = "top:-30%; left:-10%">Birth Date:</label>
							<input class="input100" type="date" name="birthdate" value="<?php echo $birthdate; ?>"> 	
							<span class="focus-input100"></span>
						</div>
					</div>

					<div class="form-container">
						<div class="wrap-input100 validate-input">
							<label for="species" class="focus-input100 input100" style = "top:-30%; left:-3%">Species:</label>
							<input class="input100" type="text" name="species" value="<?php echo $species; ?>"> 	
							<span class="focus-input100" ></span>
						</div>

						<div class="wrap-input100 validate-input">
							<label for="breed" class="focus-input100 input100" style = "top:-30%; left:-3%">Breed:</label>
							<input class="input100" type="text" name="breed" value="<?php echo $breed; ?>"> 	
							<span class="focus-input100" ></span>
						</div>

					</div>

					<div class="container-login100-form-btn">
						<input type="submit" value="Update" class="login100-form-btn"> 	
						<a href="../animal-info.php" class="login100-form-btn">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
	const profileImage = document.getElementById('profile-image');
	const editIcon = document.getElementById('edit-icon');
	const modal = document.getElementById('image-modal');
	const modalImage = document.getElementById('modal-image');
	const closeModal = document.getElementById('close-modal');

	// Open the modal and display the clicked image
	profileImage.addEventListener('click', () => {
	modalImage.src = profileImage.src;
	modal.style.display = 'block';
	});

	// Close the modal when the close button is clicked
	closeModal.addEventListener('click', () => {
	modal.style.display = 'none';
	});

	// Add an event listener to the edit icon for image change
	editIcon.addEventListener('click', () => {
	const imageInput = document.createElement('input');
	imageInput.type = 'file';
	imageInput.accept = 'image/*';

	// Trigger the file input when the edit icon is clicked
	imageInput.addEventListener('click', (event) => {
		event.stopPropagation(); // Prevent the click from reaching the document
	});

	imageInput.addEventListener('change', (event) => {
		const selectedImage = event.target.files[0];

		if (selectedImage) {
		const imageURL = URL.createObjectURL(selectedImage);
		profileImage.src = imageURL;
		}
	});

	imageInput.click();
	});

	</script>
	<?php include 'include/footer.php'; ?>
</body>
</html>
