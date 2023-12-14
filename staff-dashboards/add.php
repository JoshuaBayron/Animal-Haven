<?php 
include 'backend/crude.php';
include 'includes/header.php';
include 'includes/nav.php';
?>
  <style>
  /* Style the form container */
  .form-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }

  /* Style form labels */
  label {
    color: #333;
    font-weight: bold;
  }

  /* Style form input fields */
  input[type="text"],
  input[type="number"],
  select,
  input[type="date"],
  input[type="time"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
  }

  /* Style the submit button */
  .button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
  }

  /* Style the submit button on hover */
  .button:hover {
    background-color: #0056b3;
  }
</style>
<main id="main">

<section id="add" class="contact">
<div class="container">
  
  <div class="section-title">
    <h2>Schedule/ <span>Add Appointment</span></h2>
  </div>
  
  <div class="row" data-aos="fade-in">
  
    <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
      <form class="form" id="form" method="POST" action="add.html">

        <label for="services" style="color: black">Services</label>
        <select name="appointment_service" id="services"> 
          <option value="VACCINATION">Pet Vaccination</option>
          <option value="TREATMENT">Pet Treatment</option>
          <option value="CONSULTATION">Pet Consultation</option>
          <option value="SURGERY">Pet Surgery</option>
          <option value="GROOMING">Pet Grooming</option>
          <option value="DEWORMING">Pet Deworming</option>
        </select></br>
             

        <label class="form-label" for="name">Date</label>
        <input type="date" id="date" name="start_event_date" required>
        <br/>

        <label class="form-label" for="name">Time</label>
        <input type="time" id="time" name="start_event_time" required />


        <label class="form-label" for="name">Patient's Name</label>
        <input class="input" type="text" id="name" name="animal_name" maxlength="36">
            
        <label class="form-label" for="count">Patient's ID</label>
        <input class="input" type="number" id="count" name="animals_id" min="0" max="1000000" maxlength="7"><br/>
        <input type="submit" value="Submit" class="button button-white" name="submit">
      </form> 
    </div> 
  </div>
</div>         
</main>

<?php 
include 'includes/footer.php';
?>