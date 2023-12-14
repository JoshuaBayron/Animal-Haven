<?php include 'header.php'?>

<?php

       // Database connection parameters
    include 'connection.php';

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve data based on the provided ID
    if (isset($_GET['animals_id'])) {
        $animals_id = $_GET['animals_id'];
        $selectQuery = "SELECT animals_id, animal_name, breed , species, gender, birthdate, age, quantity FROM animals WHERE animals_id = '$animals_id'";
        $result = mysqli_query($conn, $selectQuery);
        $row = mysqli_fetch_assoc($result);
    }




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.min.css">
    <style type="text/css">
        
         .back-button {
      position: absolute;
      top: 10px;
      left: 10px;
      background-color: #8b9b8d;
      color: #fff;
      border: none;
      padding: 8px 12px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }
    </style>
</head>


<body>
    
    <div class="limiter">
        <div class="container-login100" style="background-color: black;">
            <div class="wrap-login100">

            
            
            <form action="" method="POST" id="customer" class="login100-form validate-form" enctype="multipart/form-data"> 
                <input type="hidden" name="role" value="customer">  
                <div class="container-login100-form-btn">
                     <a href="../animal-info.php">
                          <button type = "button" class="back-button" >
                              <span class="arrow">&#9664;</span>
                          </button>
                    </a>
                </div>
                    <span class="login100-form-logo">
                        <i class="zmd"><img src="images/logo.png" alt="" width="100%" height="auto"></i>
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27" style="font-weight: bold;">
                        Update Pet
                    </span>
                    <div class="form-container">
                        <input type="hidden" name="animals_id" value="<?php echo $row['animals_id']; ?>" ><br>
                    </div>

                    <div class="form-container">
                        <div class="wrap-input100 validate-input" data-validate = "First Name">
                            <label  class = "input100" for="animal_name" style=" color: black;">&#x1F415 Animal Name:</label>
                             <input type="text" class = "input100" name="animal_name" value="<?php echo $row['animal_name']; ?>" placeholder="Animal Name" required >
                          
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Last Name">
                            <label class = "input100" for="breed" style=" color: black;" >&#x1F415 Breed:</label>

                            <input class = "input100" type="text" name="breed" value="<?php echo $row['breed']; ?>" placeholder="Pet age" required >
                        </div>

                        <div class="wrap-input100 validate-input" data-validate = "Last Name">
                                <label class = "input100" for="species" style=" color: black;">&#x1F415 Species:</label>
                                <input class = " input100" type="text" name="species" value="<?php echo $row['species']; ?>" placeholder="Pet birthdate" required >
                        </div>
                    </div>

                    <div class="form-container">
                       
                 
                        <div class="wrap-input100 validate-input" data-validate="Gender">
                           <label class = "input100" for="birthdate"style=" color: black;"style=" color: black;" >Pet's Birthday:</label>
                            <input type="date"  class = "input100" name="birthdate" id="birthdate" value="<?php echo $row['birthdate']; ?>" onchange="calculateAge()"  required >
                       </div>

                        <div class="wrap-input100 validate-input" data-validate="Gender">
                            <label class = "input100" for="age" style=" color: black;">Pet's Age:</label>
                            <input class = "input100" type="text" name="age" id="age" value="<?php echo $row['age']; ?>" readonly > 
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Gender">
                            <label class = "input100" for="quantity" style=" color: black;" >Quantity:</label>
                            <input class = "input100" type="number" name="quantity" value="<?php echo $row['quantity']; ?>" placeholder="Pet sex" min="1" pattern="[1-9]\d*" required  >
                        </div>
                    </div>
                    
                    <div class="form-container">
                        
                        <div class="wrap-input100 validate-input" data-validate="Gender">
                            <label class = "input100" for="gender" style=" color: black;">Gender:</label>

                            <select class="input100" id="gender" name="gender" required >
                                <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" style="background-color: green;width:50px">
							<i class="fas fa-check" style="color:white"></i> 
						</button>
						<a href="../animal-info.php">
							<button type="button" class="login100-form-btn" style="background-color: green">
								<i class="fas fa-times" style="color:white"></i> 
							</button>
						</a>
                    </div>
                    
                </form>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
        function calculateAge() {
    // Get the selected birthday
    var birthdayInput = document.getElementById("birthdate");
    var birthday = new Date(birthdayInput.value);

    // Validate that the entered date is not after today
    var currentDate = new Date();
    if (birthday > currentDate) {
        alert("Please select a valid date that is not after today.");
        birthdayInput.value = '';  // Clear the input
        return;
    }

    // Calculate the age in days, months, or years
    var ageInDays = Math.floor((currentDate - birthday) / (1000 * 60 * 60 * 24));
    var ageInMonths = (currentDate.getMonth() - birthday.getMonth()) + 12 * (currentDate.getFullYear() - birthday.getFullYear());
    var ageInYears = currentDate.getFullYear() - birthday.getFullYear();

    // Determine whether to display age in days, months, or years
    var age;
    if (ageInDays < 0 || ageInMonths < 0 || ageInYears < 0) {
        alert("Invalid age. Please select a valid date.");
        birthdayInput.value = '';  // Clear the input
        return;
    }

    if (ageInDays <= 30) {
        age = ageInDays + ' day/s';
    } else if (ageInMonths < 12) {
        age = ageInMonths + ' month/s';
    } else {
        age = ageInYears + ' year/s';
    }

    // Update the age input field
    var ageInput = document.getElementById("age");
    ageInput.value = age;
}

    </script>
</body>
</html>
<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle the update here
        $animals_id = $_POST['animals_id'];
        $animal_name = $_POST['animal_name'];
        $breed = $_POST['breed'];
        $species = $_POST['species'];
        $gender = $_POST['gender'];
        $birthdate = $_POST['birthdate'];
        $age = $_POST['age'];
        $quantity = $_POST['quantity'];

        $updateQuery = "UPDATE animals SET animal_name = '$animal_name', breed = '$breed', species = '$species', gender = '$gender', birthdate = '$birthdate', age = '$age', quantity = '$quantity' WHERE animals_id = '$animals_id'";
        if ($conn->query($updateQuery) === TRUE) {
            //echo "Record updated successfully";
            // header('Location: ../animal-info.php');
       echo "<script>
                Swal.fire({
                    title: 'Pet Information Updated Successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-info.php'; // Redirect to desired page after successful insert
                    }
                });
            </script>";

        } else {
            echo "Error updating record: " . mysqli_error($conn);
         echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to Update.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.href = '../animal-info.php'; // Redirect to desired page after error
                    }
                });
            </script>";
        }
    }
    
    ?>

    <?php
        $conn->close();

    ?>
 <style>
    .container-login100-form-btn {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.login100-form-btn {
  font-family: Poppins-Medium;
  font-size: 16px;
  color: #555555;
  line-height: 1.2;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  min-width: 120px;
  height: 50px;
  border-radius: 25px;

  background: #9152f8;
  background: -webkit-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: -o-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: -moz-linear-gradient(bottom, #ffff00, #4C3D3D);
  background: linear-gradient(bottom, #ffff00, #4C3D3D);
  position: relative;
  z-index: 1;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: #fff;
  top: 0;
  left: 0;
  opacity: 1;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn[type="submit"]::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: green;

  top: 0;
  left: 0;
  opacity: 1;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn[type="button"]::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 25px;
  background-color: red;

  top: 0;
  left: 0;
  opacity: 1;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn:hover {
  color: #fff;
}

.login100-form-btn:hover:before {
  opacity: 0;
}
 </style>
 <?php include 'footer.php' ?>