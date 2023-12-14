<?php 
    require_once('db-connect.php');
    include 'includes/header.php';
    include 'includes/nav.php';
    // date_default_timezone_set('Asia/Taipei');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <script src="app.js"></script>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        #calendar {
            width: 60%; /* Adjust the width as needed */
            height: 500px; /* Adjust the height as needed */
            margin-top: 50px;
            margin-right: 10px; /* Add margin for spacing between calendar and form */
            margin-left: 200px;
        }

        #addEventForm {
            width: 25%; /* Adjust the width as needed */
            margin-top: 150px;
        }

        #addEventForm form {
            display: flex;
            flex-direction: column;
            align-items: center;

        }
    </style>
</head>
<body>
    <div class="container">
        <div id="calendar"></div>
        <div id="addEventForm">
            <h2>Add Appointment</h2>
            <form id="eventForm">
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
                  <label for="appointment_service" style="font-size: 12px;">&#x2702; Service</label>
                                      <select class="form-control" id="appointment_service" name="appointment_service" required style="font-size: 12px;">
                                         <option value="" disabled selected>Select a Service</option>
                                        <option value="vaccination">Vaccination</option>
                                        <option value="consultation">Consultation</option>
                                        <option value="surgery">Surgery</option>
                                        <option value="treatment">Treatment</option>
                                        <option value="grooming">Grooming</option>
                  </select> 
                  <label for="date">&#x1F4C5; Appointment Date:</label> 
                  <input class="form-control" type="date" name="date" id="date" required style="width: 100%;" required>
                  <label for="time">&#x1F4C5; Appointment Time:</label>
                  <select class="form-control" name="time" id="time" required>
                  <!-- Populate your custom times dynamically or manually -->
                  <option value="08:00" >08:00 AM</option>
                  <option value="08:30">08:30 AM</option>
                  <option value="09:00">09:00 AM</option>
                  <option value="09:30">09:30 AM</option>
                  <option value="10:00">10:00 AM</option>
                  <option value="10:30">10:30 AM</option>
                  <option value="11:00">11:00 AM</option>
                  <option value="11:30">11:30 AM</option>

                  <option value="13:00">01:00 PM</option>
                  <option value="13:30">01:30 PM</option>
                  <option value="14:00">02:00 PM</option>
                  <option value="14:30">02:30 PM</option>
                  <option value="15:00">03:00 PM</option>
                  <option value="15:30">03:30 PM</option>
                  <option value="16:00">04:00 PM</option>
                  <option value="16:30">04:30 PM</option>
                  <option value="17:30">05:30 PM</option>

                  <!-- Add more options as needed -->
                </select> 
               
                
                <button type="button" onclick="addEvent()" style="background-color: #040b14;">Add Appointments</button>
            </form>
        </div>
    </div>
     <!-- Legend for the calendar -->
<div style="margin-top: 20px; text-align: center; font-size: 24px;">
    <span style="color: green; padding-right: 15px; font-size: 40px;">&#9679;</span> Available Slots
    <span style="color: red; padding: 0 15px; font-size: 40px;">&#9679;</span> Full Slots
    <span style="color: yellow; padding-left: 15px; font-size: 30px;">&#9679;</span> Holidays
</div>
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
</body>
</html>

</html>

<?php include 'includes/footer.php'; ?>

