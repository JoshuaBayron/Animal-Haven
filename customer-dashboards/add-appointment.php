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
          <h2>Animal Appointment/ <span>Add</span></h2>

          <div class="faq-container">
              <div class="faq-item" onmouseover="showAnswers()" onmouseout="hideAnswers()">
                  <div class="question-box"><span class="question-mark">?</span></div>
                  <div class="answer" id="answer1">This page adds Pet Appointment</div>
                  <div class="answer" id="answer2">Fill up the form with your desired appointment information</div>
                  <div class="answer" id="answer3">After filling up the form, click the add button</div>
                  <div class="answer" id="answer4">this will notify the clinic through text message</div>
                  <div class="answer" id="answer5">that you have added a new user</div>
              </div>
          </div>
          </div>
        <div class="row" data-aos="fade-in">
          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">

  <form id="petForm" action="backend/add_status_process.php" method="post">
    
    <div class="row">
          <div class="form-group" style="width: 100%; max-width: 200px; margin-bottom: 10px;">
               <label for="animals_id">&#x1F408 Animal/Pet:</label>
                <select class="form-control" id="animals_id" name="animals_id" required style="font-size: 12px;"a>
                <option value="" disabled selected>Select Pet</option>
                     
                    <?php
               
                  $customer_id = $_SESSION['customer_id'];
                  // Fetch IDs from the other_table
                  $sql = "SELECT animals_id, animal_name FROM animals WHERE customer_id = '$customer_id'";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row["animals_id"] . "'>" . $row["animal_name"] . "</option>";
                      }
                    }

               
                ?>
                  </select>
          </div>   
    </div>  
     <div class="row">
          <div class="form-group" style="width: 100%; max-width: 200px; margin-bottom: 10px;">
               <label for="staff_id" style="font-size: 12px;">&#x1F9D1; Staff</label>
                    <select class="form-control" id="staff_id" name="staff_id" required style="font-size: 12px;">
                       <option value="" disabled selected>Select Staff </option>
                       
                      <?php
                   
                    $position = "%Doctor%";
                    // Fetch IDs from the other_table
                    $sql = "SELECT staff_id, firstname FROM staff where position LIKE '$position'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["staff_id"] . "'>" . $row["firstname"] . "</option>";
                        }
                      }

                   
                  ?>
                    </select> 
          </div>   
    </div>  
    <div class="row">
          <div class="form-group" style="width: 100%; max-width: 200px; margin-bottom: 10px;">
                <label for="appointment_service" style="font-size: 12px;">&#x2702; Service</label>
                  <select class="form-control" id="appointment_service" name="appointment_service" required style="font-size: 12px;">
                     <option value="" disabled selected>Select a Service</option>
                    <option value="vaccination">Vaccination</option>
                    <option value="consultation">Consultation</option>
                    <option value="surgery">Surgery</option>
                    <option value="treatment">Treatment</option>
                    <option value="grooming">Grooming</option>
                  </select>
          </div>   
    </div>  
       <div class="row">
                   <div class="form-group" style="width: 100%; max-width: 200px; margin-bottom: 10px;">

                         <label for="date">&#x1F4C5;Select Date:</label>
                        <input class="form-control" type="date" name="date" id="date" style="width: 100%;" required>
                       
                    </div>
                      <div class="form-group" style="width: 100%; max-width: 200px; margin-bottom: 10px;">

                        <label for="time">Select Time:</label>
                        <select class="form-control" name="time" id="time" style="width: 100%;" required>
                          <!-- Populate your custom times dynamically or manually -->
                          <option value="08:00">08:00 AM</option>
                          <option value="08:30">08:30 AM</option>
                          <option value="09:00">09:00 AM</option>
                          <option value="09:30">09:30 AM</option>
                          <option value="10:00">10:00 AM</option>
                          <option value="10:30">10:30 AM</option>
                          <option value="11:00">11:00 AM</option>
                          <option value="11:30">11:30 AM</option>

                          <option value="01:00">01:00 PM</option>
                          <option value="01:30">01:30 PM</option>
                          <option value="02:00">02:00 PM</option>
                          <option value="02:30">02:30 PM</option>
                          <option value="03:00">03:00 PM</option>
                          <option value="03:30">03:30 PM</option>
                          <option value="04:00">04:00 PM</option>
                          <option value="04:30">04:30 PM</option>
                          <option value="05:30">05:30 PM</option>

                          <!-- Add more options as needed -->
                        </select>
                       
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
     // Logic to disable options based on existing database entries
  const dateSelect = document.getElementById('date');
  const timeSelect = document.getElementById('time');

  dateSelect.addEventListener('change', function () {
    const selectedDate = dateSelect.value;

    // Make an AJAX request to fetch existing entries for the selected date
    fetch(`get_existing_entries.php?date=${selectedDate}`)
      .then(response => response.json())
      .then(existingEntries => {
        // Enable all options initially
        [...timeSelect.options].forEach(option => option.disabled = false);

        // Disable options that are already taken
        existingEntries.forEach(existingDatetime => {
          // Extract the time part from the datetime string
          const existingTime = existingDatetime.substr(11, 5);
          const optionToDisable = timeSelect.querySelector(`option[value='${existingTime}']`);
          if (optionToDisable) {
            optionToDisable.disabled = true;
          }
        });
      })
      .catch(error => console.error('Error fetching existing entries:', error));
  });

// Get the current date in the user's local timezone
    var today = new Date().toLocaleDateString('en-CA'); // Adjust 'en-CA' to your desired locale

    // Disable specific holiday dates
    var holidays = ["2023-12-25", "2024-01-01", "2024-04-10", "2024-04-06", "2024-04-07", "2024-04-21", "2024-05-01", "2024-06-12", "2024-06-28", "2024-08-28", "2024-11-27", "2024-12-25", "2024-12-30", "2023-12-30", "2024-11-30"]; // Add more dates as needed

    // Set the minimum attribute of the date input to today
    document.getElementById('date').setAttribute('min', today);

    // Add an event listener to the date input to disable specific holidays
    document.getElementById('date').addEventListener('input', function() {
      var selectedDate = this.value;
      if (holidays.includes(selectedDate)) {
        alert('This date is a holiday');
        this.value = ''; // Clear the selected date
      }
    });
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


           // Get the current time plus 30 minutes in the format required by datetime-local input
        function getCurrentDateTime() {
            const now = new Date();
            now.setMinutes(now.getMinutes() + 30);
            const year = now.getFullYear();
            const month = (now.getMonth() + 1).toString().padStart(2, '0');
            const day = now.getDate().toString().padStart(2, '0');
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        // Set the min attribute of the input to the current time plus 30 minutes
        document.getElementById('start_event_date').min = getCurrentDateTime();

        // Update the min attribute dynamically as the current time changes
        setInterval(() => {
            document.getElementById('start_event_date').min = getCurrentDateTime();
        }, 60000); // Update every minute (adjust as needed)

        document.getElementById('start_event_date').addEventListener('input', function() {
        var selectedDateTime = new Date(this.value);
        var selectedTime = selectedDateTime.getHours();

        // Check if the selected time is outside the allowed range (8 am to 6 pm)
        if (selectedTime < 8 || selectedTime >= 18) {
            alert('Please select a time between 8 am and 6 pm.');
            this.value = ''; // Clear the input value
        }
    });


    </script>
    </script>


</body>
</html>


  <?php include 'includes/footer.php';
  $conn->close();?>