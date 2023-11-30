<?php include 'include/header.php'; ?>

<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../../assets/img/animals.jpg');">
			<div class="wrap-login100">

				<span class="login100-form-title p-b-34 p-t-27">
					Update Account
				</span>

				<form method="post" action="../backend/update.php" id="update-staff" enctype="multipart/form-data">
					<input type="hidden" name="role" value="update-staff"> 	
					<input type="hidden" name="customer_id" value="<?php echo $userId; ?>"> 	
					<div class="row">

						<div class="img-profile">
							<div class="profile-image-container">
								<img src="../../logins/backend/img/<?php echo $imageFileName; ?>" alt="<?php echo $imageFileName; ?>" title="<?php echo $imageFileName; ?>" id="profile-image">
								<input type="file" id="edit-icon" name="image" placeholder="Upload Image">

							</div>
						</div>
						<div class="modal" id="image-modal">
							<span class="close-modal" id="close-modal">&times;</span>
							<img class="modal-content" id="modal-image">
						</div>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="lname" value="<?php echo $last_name; ?>"> 	
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="fname" value="<?php echo $first_name; ?>"> 	
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="email" value="<?php echo $email; ?>"> 	
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="pass" value="<?php echo $password; ?>"> 	
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="contact" value="<?php echo $contact; ?>"> 	
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="container-login100-form-btn">
						<input type="submit" value="Update" class="login100-form-btn"> 	
						<a href="../status.php" class="login100-form-btn">Cancel</a>
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
