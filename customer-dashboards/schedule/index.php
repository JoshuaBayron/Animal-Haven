<?php 
    require_once('db-connect.php');
    include 'includes/header.php';
    include 'includes/nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        /* Adjust the width and margin for the calendar container */
        #calendar {
            width: 70%; /* Adjust the width as needed */
            margin-left: 30%; /* Move the calendar to the right */
            margin-right: auto;
            margin-top: 20px; /* Add some top margin to separate from the left nav */
        }

        .cardt {
            width: 70%; /* Adjust the width as needed */
            margin-top: 20px; /* Add some top margin to separate from the left nav */
            margin-left: 30%;
        }

        .custom-modal {
            position: fixed;
            width: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .full-day-full {
            background-color: red !important;
            height: 10%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

    </style>
</head>
<body>
    <?php 


    ?>
    <div class="container py-5" id="page-container">
        <div class="row">
           <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header text-light" style="background-color: #040b14;">
                        <h5 class="card-title">Add Appointment</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                    <div class="form-group mb-2">
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
                                <div class="form-group mb-2">
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
                                <div class="form-group mb-2">
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

                                <div class="form-group mb-2">
                                    <label for="start_event_date">&#x1F4C5; Appointment Date:</label>
                                    <input class="form-control" type="datetime-local" id="start_event_date" name="start_event_date" required style="width: 100%;">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer" style="margin-top: 20px;">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"
                                style="background-color: #040b14;"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset"
                                form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

<!-- Permanent Event Details Modal -->
<div class="modal" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
    <div class="modal-dialog modal-dialog-centered custom-modal">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
                <h5 class="modal-title">Schedule Details</h5>
                <button type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body rounded-0">
                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted">Service</dt>
                        <dd id="title" class="fw-bold fs-4"></dd>
                        <dt class="text-muted">Status</dt>
                        <dd id="description" class=""></dd>
                        <dt class="text-muted">Start</dt>
                        <dd id="start" class=""></dd>
                        <dt class="text-muted">End</dt>
                        <dd id="end" class=""></dd>
                    </dl>
                </div>
            </div>
            <div class="modal-footer rounded-0">
                <div class="text-end">
                   <!--  <button type="button" class="btn btn-danger btn-sm rounded-0" id="edit" data-id="">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button> -->
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


     <?php
    $schedules = $conn->query("SELECT * FROM `appointment`");
    $sched_res = [];
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_event_date']));
        $row['edate'] = ($row['end_event_date'] !== null) ? date("F d, Y h:i A", strtotime($row['end_event_date']))
            : null;
        $sched_res[$row['appointment_id']] = $row;
    }
    ?>
    <?php
    if (isset($conn)) $conn->close();
    ?>

    <script>
   
        document.addEventListener('DOMContentLoaded', function () {
    var scheds = <?= json_encode($sched_res) ?>;
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,list',
        },
        events: Object.keys(scheds).map(function (k) {
            var row = scheds[k];
            return {
                id: row.appointment_id,
                title: row.appointment_service,
                start: row.start_event_date,
                end: row.end_event_date,
            };
        }),
        eventClick: function (info) {
            var _details = $('#event-details-modal');
            var id = info.event.id;
            if (!!scheds[id]) {
                _details.find('#title').text(scheds[id].appointment_service);
                _details.find('#description').text(scheds[id].appointment_status);
                _details.find('#start').text(scheds[id].start_event_date);
                _details.find('#end').text(scheds[id].end_event_date);
                _details.find('#edit').attr('data-id', id);
                _details.find('#delete').attr('data-id', id);
                _details.modal('show');
            } else {
                alert("Event is undefined");
            }
        },
        dayCellContent: function (info) {
            var date = info.date.toISOString().split('T')[0];
            var appointmentsForDate = calendar.getEvents().filter(function (event) {
                var eventStartDate = event.start.toISOString().split('T')[0];
                return eventStartDate === date;
            });

            var dayHtml = '<span class="fc-daygrid-day-number">' + info.dayNumberText + '</span>';

            if (appointmentsForDate.length >= 6) {
                dayHtml += '<div class="full-day-full"></div>';
            }

            return { html: dayHtml };
        },
        eventRender: function (info) {
            var eventStartDate = info.event.start.toISOString().split('T')[0];
            var date = info.date.toISOString().split('T')[0];

            if (eventStartDate === date) {
                if (calendar.getEvents().filter(function (event) {
                    return eventStartDate === date;
                }).length >= 2) {
                    var element = info.el.querySelector('.fc-content');
                    element.style.backgroundColor = 'red';
                }
            }
        },

    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function () {
        $(this).find('input:hidden').val('');
        $(this).find('input:visible').first().focus();
    });

    // Edit Button
    $('#edit').click(function () {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            var _form = $('#schedule-form');
            _form.find('[name="id"]').val(id);
            _form.find('[name="title"]').val(scheds[id].appointment_service);
            _form.find('[name="description"]').val(scheds[id].appointment_status);
            _form.find('[name="start_datetime"]').val(scheds[id].start_event_date.replace(" ", "T"));
            _form.find('[name="end_datetime"]').val(scheds[id].end_event_date.replace(" ", "T"));
            $('#event-details-modal').modal('hide');
            _form.find('[name="title"]').focus();
        } else {
            alert("Event is undefined");
        }
    });

    // Delete Button / Deleting an Event
    $('#delete').click(function () {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "./delete_schedule.php?id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    });
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

<?php include 'includes/footer.php'; ?>
