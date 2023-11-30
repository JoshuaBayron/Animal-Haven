<?php 
include 'required/head.php';
require 'required/navigation/without-dashboard.php'
?>
<main id="main">
  
  <!-- ======= walk-in Section ======= -->
  <section id="Walk-in" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Walk-In Schedules</h2>
      </div>
      <div class="d-flex justify-content-end">
          <div class="form-inline">
            <div class="form-group">
              <button type="button" style="margin:0" onclick="user()"><i class="bx bx-user"></i></button>
              <button type="button" style="margin:0" onclick="calendar()"><i class="fas fa-calendar"></i></button>
              <button type="button" style="margin:0" onclick="signout()"><i class="fas fa-sign-out-alt"></i></button>
            </div>
          </div>
        </div>
      <div class="container-fluid pt-5" id="service">
          <div class="container">
            <div class="row pb-3">
            <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow" >
                    <div style="">
                        <h5 class="card-title" style="background-color: #FFFF8F; color: black; text-align: center; padding: 10px;">Current Month Schedule</h5>
                    </div>
                    <div class="card-body">
                      <div class="container-fluid" style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">
                          <?php
                          // Assuming you have a database connection established

                          // Get the current month and year
                          $currentMonth = date('m');
                          $currentYear = date('Y');

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
                                      a.* 
                                  FROM 
                                      `appointment` AS app
                                  INNER JOIN 
                                      `walk_in_customers` AS a ON app.`referral_no` = a.`referral_no`
                                  WHERE 
                                      MONTH(app.`start_event_date`) = $currentMonth 
                                      AND YEAR(app.`start_event_date`) = $currentYear
                                  ORDER BY appointment_id DESC";

                          // Execute the query
                          $result = mysqli_query($conn, $sql);

                          // Check for errors
                          if (!$result) {
                              die('Error: ' . mysqli_error($conn));
                          }

                          // Display the results
                          while ($row = mysqli_fetch_assoc($result)) {
                              // Output the appointment details as needed
                              echo "Animal: " . $row['animal_name'] . "<br>";
                              echo "Service: " .$row['appointment_service']. "<br>";
                              echo'<a class="custom-button" href="show-schedules.php?appointment_no=' . $row["appointment_id"] .'">Read More</a>';
                              
                              echo "<hr>";
                          }
                          ?>
                      </div>
                  </div>

                </div>
            </div>
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
      },
      editable: true
    });

    calendar.render();

    $('#schedule-form').on('reset', function() {
      $(this).find('input:hidden').val('')
      $(this).find('input:visible').first().focus()
    })

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
  
  <?= include 'required/details/redirect.js';?>
</script>