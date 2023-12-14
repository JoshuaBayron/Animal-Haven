$(document).ready(function() {
    // Initialize FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        eventAfterAllRender: function(view) {
            highlightBusyDays();
        },
        events: {
            url: 'events.php', // Change this to the endpoint that fetches events from the server
            type: 'GET',
            data: {
                custom_param: 'something'
            },
            error: function() {
                alert('Error fetching events');
            }
        }
    });

// Add Event function
window.addEvent = function() {
    // Get form data
    var animals_id = $('#animals_id').val();
    var staff_id = $('#staff_id').val();
    var appointment_service = $('#appointment_service').val();
    var start_event_date = $('#date').val();
    var start_event_time = $('#time').val();

    // Combine date and time for the full start event datetime
    var start_event_datetime = start_event_date + ' ' + start_event_time;

    // Add event to the calendar
    $('#calendar').fullCalendar('renderEvent', {
        title: appointment_service,
        start: start_event_datetime,
        allDay: false
    }, true);

    // Additional code to send data to the server using Ajax
    $.ajax({
        type: 'POST',
        url: 'addEvent.php',
        data: {
            animalsId: animals_id,
            staffId: staff_id,
            appointmentService: appointment_service,
            startEventDatetime: start_event_datetime,
            startEventDate: start_event_date,
            startEventTime: start_event_time,
        },
        success: function(response) {
            console.log('Event added successfully');
            setTimeout(function() {
                alert('Appointment Successfully Saved.');
                highlightBusyDays();
            }, 100);
        },
        error: function() {
            alert('Error adding event');
        }
    });

    // Clear form fields
    $('#animals_id').val('');
    $('#staff_id').val('');
    $('#appointment_service').val('');
    $('#date').val('');
    $('#time').val('');
};


    // Function to highlight busy days
    function highlightBusyDays() {
        var events = $('#calendar').fullCalendar('clientEvents');
        var dateCounts = {};

        // Count the number of events for each date
        events.forEach(function(event) {
            var startDate = moment(event.start).format('YYYY-MM-DD');
            var endDate = moment(event.end).format('YYYY-MM-DD');

            if (!dateCounts[startDate]) {
                dateCounts[startDate] = 1;
            } else {
                dateCounts[startDate]++;
            }

            if (!dateCounts[endDate]) {
                dateCounts[endDate] = 1;
            } else {
                dateCounts[endDate]++;
            }
        });

        // Highlight days with more than or equal to 20 events
        Object.keys(dateCounts).forEach(function(date) {
            var momentDate = moment(date);

            // Check if the date is a holiday
            var holidayName = isHoliday(momentDate.format('YYYY-MM-DD'));
            if (holidayName) {
                var $dayCell = $('.fc-day[data-date="' + momentDate.format('YYYY-MM-DD') + '"]');
                $dayCell.css('background-color', '#7bdd6d'); // Set background color for holidays
                // $dayCell.append('<div class="holiday-name">' + holidayName + '</div>'); // Display holiday name
            } else if (dateCounts[date] >= 17) {
                $('.fc-day[data-date="' + momentDate.format('YYYY-MM-DD') + '"]').css('background-color', '#ff2b2b');
            } else {
                $('.fc-day[data-date="' + momentDate.format('YYYY-MM-DD') + '"]').css('background-color', ''); // Reset background color
            }
        });
    }

    // Function to check if a date is a holiday
    function isHoliday(date) {
        // Replace this with your logic to determine if a date is a holiday
        // For now, let's assume that January 1st and December 25th are holidays
        var holidays = {
            '2023-12-25': 'Christmas Day',
            '2024-01-01': 'New Years Day',
            '2024-04-10': 'Araw ng Kagitingan',
            '2024-04-06': 'Maundy Thursday',
            '2024-04-07': 'Good Friday',
            '2024-04-21': 'Eidl Fitr',
            '2024-05-01': 'Labor Day',
            '2024-06-12': 'Independence Day',
            '2024-06-28': 'Eidl Adha',
            '2024-08-28': 'National Heroes Day',
            '2024-11-27': 'Bonifacio Day',
            '2024-12-25': 'Christmas Day',
            '2024-12-30': 'Rizal Day',
            '2023-12-30': 'Rizal Day',
            '2024-11-30': 'Kathniel Breakup',
            
            
            // Add more holidays as needed
        };

        return holidays[date] || null;
    }
});
