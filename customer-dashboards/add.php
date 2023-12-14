<?php include 'includes/header.php';
      include 'includes/nav.php';
     ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style type="text/css">
       .faq-container {
    position: fixed;
    top: 10px; /* Adjust as needed */
    right: 10px; /* Adjust as needed */
    background-color: #ffffff; /* Background color for the FAQ container */
    padding: 10px;
    border: 2px solid #f2f2f2;
}

.faq-item {
    margin-bottom: 15px;
    cursor: pointer;
}

.question-box {
    display: inline-block;
    background-color: #f2f2f2;
    padding: 5px;
    border-radius: 5px;
}

.question-mark {
    font-size: 18px;
    font-weight: bold;
}

.answer {
    display: none;
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
}



   </style>
</head>
<body>
  <main id="main">
        <!-- ======= Contact Section ======= -->
    <section id="add" class="contact">
        <div class="container">
           <div class="section-title">
          <h2>Animal Information/ <span>Add</span></h2>

    <div class="faq-container">
        <div class="faq-item" onmouseover="showAnswers()" onmouseout="hideAnswers()">
            <div class="question-box"><span class="question-mark">?</span></div>
            <div class="answer" id="answer1">This page adds pet</div>
            <div class="answer" id="answer2">Fill up the form with the your pet information</div>
            <div class="answer" id="answer3">After filling up the form, click the add button</div>
            <div class="answer" id="answer4">this will add your pet to the system</div>
        </div>
    </div>
          </div>
        <div class="row" data-aos="fade-in">
          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">

  <form id="petForm">
    <div class="row">
      <div class="form-group col-md-6" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
          <label for="animal_name" style="font-size: 12px;">&#x1F415 Animal Name:</label>
          <input class="form-control" type="text" id="animal_name" name="animal_name" required>
      </div>
    </div>
    <div class="row">
       <div class="form-group col-md-6" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
          <label for="breed" style="font-size: 12px;">&#x1F415 Animal Breed:</label>
          <input class="form-control"type="text" id="breed" name="breed" required>
      </div>
      
    </div>
    <div class="row">
       <div class="form-group" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
          <label for="species" style="font-size: 12px;">&#x1F415 Animal Species:</label>
          <select class="form-control" id="species" onchange="checkIfOthers()" required>
              <option value="" disabled selected>Species</option>
              <option value="Dog">Dog</option>
              <option value="Cat">Cat</option>
              <option value="Bird">Bird</option>
              <option value="Fish">Fish</option>
              <option value="Fish">Reptile</option>
              <option value="Other">Others</option>
          </select>
           <div id="otherSpeciesContainer" style="display:none; width: 100%; max-width: 300px; margin-bottom: 10px;">
              <label for="otherSpecies" style="font-size: 12px;">&#x1F415 Input Animal Species</label>
              <input type="text" id="otherSpecies" oninput="updateOthersValue()" required>
          </div>
        </div>
        <div class="form-group" >
         
      </div>
    </div>
      <div class="row">
                <div class="form-group" style="width: 100%; max-width: 180px; margin-bottom: 10px;">
                  <label for="sex" style="font-size: 12px;">&#9893; Animal Sex</label>
                  <select class="form-control" id="sex" name="sex" required style="font-size: 12px;" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>

                 <div class="form-group" style="width: 100%; max-width: 180px; margin-bottom: 10px;">
                 

                   <label for="birthdate" style="font-size: 12px;">&#x1F4C5; Animal Birthday:</label>
                  <input type="date" class="form-control" name="birthdate" id="birthdate" onchange="calculateAge()" required style="font-size: 12px;" required>
                </div>

                <div class="form-group" style="width: 100%; max-width: 180px; margin-bottom: 10px;">

                    <label for="age" style="font-size: 12px;">&#x1F43E; Animal Age:</label>
                    <input required class="form-control" type="text" name="age" id="age" readonly> 
                </div>
                

                <div class="form-group" style="width: 100%; max-width: 180px; margin-bottom: 10px;">
                    <label for="quantity" style="font-size: 12px;">&#x1F43E; Animal Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="quantity" min="1" pattern="[1-9]\d*" required style="font-size: 12px;" value="1" required>
                </div>

              
        </div>
    
    
            <div class="text-center" style="display: inline-block;">
              <button type="submit" value="Submit" style="color: #E1D9D1;"> Add</button>
              <button type="reset" style = "color: #E1D9D1;">Reset</button>
            </div>
  </form>

  <div id="message"></div>
    </div>
</div>
</div>
</section>
</main>

<script>
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


function checkIfOthers() {
    var petSpeciesDropdown = document.getElementById("species");
    var otherSpeciesContainer = document.getElementById("otherSpeciesContainer");
    var otherSpeciesInput = document.getElementById("otherSpecies");

    if (petSpeciesDropdown.value === "Other") {
        otherSpeciesContainer.style.display = "block";
        otherSpeciesInput.required = true;
    } else {
        otherSpeciesContainer.style.display = "none";
        otherSpeciesInput.required = false;
    }
}

function updateOthersValue() {
    var petSpeciesDropdown = document.getElementById("species");
    var otherSpeciesInput = document.getElementById("otherSpecies");

    // Set the value of the "Others" option to what is entered in the text box
    petSpeciesDropdown.options[petSpeciesDropdown.options.length - 1].value = otherSpeciesInput.value;
}
</script>


 <script type="text/javascript">
            function showAnswers() {
            for (var i = 1; i <= 4; i++) {
                var answer = document.getElementById('answer' + i);
                answer.style.display = 'block';
            }
        }

        function hideAnswers() {
            for (var i = 1; i <= 4; i++) {
                var answer = document.getElementById('answer' + i);
                answer.style.display = 'none';
            }
        }


        function updateUnits() {
    var ageInput = document.getElementById('age');
    var unitSelect = document.getElementById('age_unit');
    
    // Check if age is greater than 11
    if (parseInt(ageInput.value) > 11) {
      // If greater than 11, set the unit to "Months"
      unitSelect.value = 'years';
    } else {
      // Otherwise, set the unit to "Years"
      unitSelect.value = 'months';
    }
    }


    </script>
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"notifications-backend/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#animal_name').val() != '' && $('#breed').val() != '' && $('#species').val() != '' && $('#sex').val() != '' && $('#age').val() != '' && $('#birthdate').val() != '' && $('#quantity').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"backend/add_pet_process.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#petForm')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
  <script>
    // Submit event listener for the form
    document.getElementById('petForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      
      // Get form data
      var Animal_name = document.getElementById('animal_name').value;
      var Breed = document.getElementById('breed').value;
      var Species = document.getElementById('species').value;
      var Sex = document.getElementById('sex').value;
      var Birthdate = document.getElementById('birthdate').value;
      var Age = document.getElementById('age').value;
      var Quantity = document.getElementById('quantity').value;
      // Make an AJAX request to process_form.php
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'backend/add_pet_process.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function() {
        if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.success) {
             // Pet information saved successfully
            Swal.fire({
            title: "Success",
            text: "Pet information has been saved.",
            icon: "success",
            timer: 2000, // Automatically close after 2 seconds
            showConfirmButton: false // Hide the "OK" button
            }).then(function() {
            // Redirect to another page after showing the success message
            window.location.href = "animal-info.php";
  });
          } else {
            Swal.fire({
              title: "Error",
              text: "An error occurred while saving pet information.",
              icon: "error"
            }).then(function() {
                // Redirect to another error page after showing the error message
                window.location.href = "add.php";
});
          }
        } else {
          Swal.fire({
            title: "Error",
            text: "An error occurred while processing the form.",
            icon: "error"
          }).then(function() {
            // Redirect to another error page after showing the error message
            window.location.href = "add.php";
            });
        }
      };
      xhr.send('animal_name=' + Animal_name + '&breed=' + Breed + '&age=' + Age + '&species=' + Species + '&sex=' + Sex + '&birthdate=' + Birthdate + '&quantity=' + Quantity);
    });



  
  </script>
</body>
</html>


  <?php include 'includes/footer.php';
   $conn->close();?>
 
