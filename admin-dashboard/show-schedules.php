<?php 
include 'required/head.php';
require 'required/navigation/without-dashboard.php'
?>
<main id="main">
  
  <!-- ======= walk-in Section ======= -->
  <section id="Walk-in" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Schedules <span style="font-size:10px">On this page, you can view the availed service. </span></h2>
      </div>
      
      <div class="container-fluid pt-5" id="service">
          <div class="container">
            <div class="row pb-3">
            <div class="row">

                        <?php
                          $appointmentID = $_GET["appointment_no"];

                          // SQL query to fetch appointments for the current month
                          $sql = "SELECT 
                                      app.`appointment_id`, 
                                      app.`appointment_service`, 
                                      app.`appointment_status`, 
                                      app.`start_event_date`, 
                                      app.`end_event_date`, 
                                      app.`animals_id`, 
                                      app.`staff_id`, 
                                      app.`customer_id`, 
                                      app.`referral_no`,
                                      a.*,
                                      s.firstname AS staff_firstname,
                                      s.lastname AS staff_lastname  
                                  FROM 
                                      `appointment` AS app
                                  JOIN 
                                      `walk_in_customers` AS a ON app.`referral_no` = a.`referral_no`
                                  JOIN 
                                      `staff` AS s ON app.`staff_id` = s.`staff_id`
                                  WHERE 
                                  `appointment_id` =  $appointmentID ";

                          // Execute the query
                          $result = mysqli_query($conn, $sql);

                          // Check for errors
                          if (!$result) {
                              die('Error: ' . mysqli_error($conn));
                          }

                          // Display the results
                          while ($row = mysqli_fetch_assoc($result)) {
                              // Output the appointment details as needed
                              echo "Staff ID: " . $row['staff_firstname'] . " " . $row['staff_lastname'] . "<br>";
                              echo "Owner: " . $row['firstname'] ." ". $row['lastname']. "<br>";
                              echo "Animal: " . $row['animal_name'] . "<br>";
                              echo "Details: ".$row['appointment_service']. " starts at " .$row['start_event_date']." and ends in ".$row['end_event_date']. 
                              " it was currently ".$row['appointment_status']."<br>";
                              echo'<button style="width:30%; margin-left:3px; border-radius:50px"  onclick="redirectToCalendar()" >Back to Calendar</button>';
                              echo "<hr>";
                          }
                          ?>
                        
          </div>
      </div>
    </div>
  </section>
  <!-- End Animal Status Section -->
</main>
<!-- End #main -->
<?php 
$schedules = $conn->query("SELECT * FROM `appointment`");
$sched_res = [];
foreach($schedules->fetch_all(MYSQLI_ASSOC) as $row){
    $row['sdate'] = date("F d, Y h:i A",strtotime($row['start_event_date']));
    $row['edate'] = date("F d, Y h:i A",strtotime($row['end_event_date']));
    $sched_res[$row['appointment_id']] = $row;
}
?>
<?php 
if(isset($conn)) $conn->close();
?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')
</script>
<script>
    function redirectToCalendar() {
        // Change 'your-calendar-page.html' to the actual page URL you want to redirect to
        window.location.href = 'index.php';
    }
</script>

<script>
  var calendar;
  var Calendar = FullCalendar.Calendar;
  var events = [];

  $(function() {
    if (!!scheds) {
      Object.keys(scheds).map(k => {
        var row = scheds[k]
        events.push({ id: row.id, title: row.appointment_service, start: row.start_event_date, end: row.end_event_date });
      })
    }
    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()

    calendar = new Calendar(document.getElementById('calendar'), {
      headerToolbar: {
        left: 'prev,next today',
        right: 'dayGridMonth,dayGridWeek,list',
        center: 'title',
      },
      selectable: true,
      
      // Random default events
      events: events,
      eventClick: function(info) {
        var _details = $('#event-details-modal')
        var id = info.event.id
        if (!!scheds[id]) {
          _details.find('#appointment_title').text(scheds[id].appointment_service)
          _details.find('#start_event_date').text(scheds[id].sdate)
          _details.find('#end_event_date').text(scheds[id].edate)
          _details.find('#edit,#delete').attr('data-id', id)
          _details.modal('show')
        } else {
          alert("Event is undefined");
        }
      },
      eventDidMount: function(info) {
        // Do Something after events mounted
      },
      editable: true
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function() {
      $(this).find('input:hidden').val('')
      $(this).find('input:visible').first().focus()
    })

    // Edit Button
    $('#edit').click(function() {
      var id = $(this).attr('data-id')
      if (!!scheds[id]) {
        var _form = $('#schedule-form')
        console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
        _form.find('[name="appointment_id"]').val(id)
        _form.find('[name="appointment_title"]').val(scheds[id].appointment_service)
        _form.find('[name="start_event_date"]').val(String(scheds[id].start_event_date).replace(" ", "T"))
        _form.find('[name="end_event_date"]').val(String(scheds[id].end_event_date).replace(" ", "T"))
        $('#event-details-modal').modal('hide')
        _form.find('[name="title"]').focus()
      } else {
        alert("Event is undefined");
      }
    })

    // Delete Button / Deleting an Event
    $('#delete').click(function() {
      var id = $(this).attr('data-id')
      if (!!scheds[id]) {
        var _conf = confirm("Are you sure to delete this scheduled event?");
        if (_conf === true) {
          location.href = "./delete_schedule.php?id=" + id;
        }
      } else {
        alert("Event is undefined");
      }
    })

   
  });
</script>