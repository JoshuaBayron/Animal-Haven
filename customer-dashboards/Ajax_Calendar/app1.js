$(document).ready(function() {
    var selectedEvent;

    // Initialize FullCalendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        eventClick: function(event, jsEvent, view) {
            // Open the edit form when an event is clicked
            selectedEvent = event;
            openEditForm();
        },
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
        var title = $('#eventTitle').val();
        var startDateTime = $('#startDateTime').val();
        var endDateTime = $('#endDateTime').val();

        // Add event to the calendar
        $('#calendar').fullCalendar('renderEvent', {
            title: title,
            start: startDateTime,
            end: endDateTime,
            allDay: false // This ensures the event has a specific time
        }, true);

        // Additional code to send data to the server using Ajax
        $.ajax({
            type: 'POST',
            url: 'addEvent.php', // Change this to the endpoint that handles adding events
            data: {
                title: title,
                startDateTime: startDateTime,
                endDateTime: endDateTime
            },
            success: function(response) {
                console.log('Event added successfully');
                highlightBusyDays(); // Update the day colors after adding an event
            },
            error: function() {
                alert('Error adding event');
            }
        });

        // Clear form fields
        $('#eventTitle').val('');
        $('#startDateTime').val('');
        $('#endDateTime').val('');
    };

    // Edit Event function
    window.editEvent = function() {
        // Get form data
        var title = $('#editTitle').val();
        var startDateTime = $('#editStartDateTime').val();
        var endDateTime = $('#editEndDateTime').val();

        // Update event on the calendar
        selectedEvent.title = title;
        selectedEvent.start = startDateTime;
        selectedEvent.end = endDateTime;

        // Additional code to send data to the server using Ajax
        $.ajax({
            type: 'POST',
            url: 'editEvent.php', // Change this to the endpoint that handles editing events
            data: {
                id: selectedEvent.id,
                title: title,
                startDateTime: startDateTime,
                endDateTime: endDateTime
            },
            success: function(response) {
                console.log('Event edited successfully');
                $('#editEventForm').hide();
            },
            error: function() {
                alert('Error editing event');
            }
        });

        // Clear form fields
        $('#editTitle').val('');
        $('#editStartDateTime').val('');
        $('#editEndDateTime').val('');

        // Render the updated event on the calendar
        $('#calendar').fullCalendar('updateEvent', selectedEvent);
        highlightBusyDays();
    };

    // Delete Event function
    window.deleteEvent = function() {
        // Additional code to send data to the server using Ajax
        $.ajax({
            type: 'POST',
            url: 'deleteEvent.php', // Change this to the endpoint that handles deleting events
            data: {
                id: selectedEvent.id
            },
            success: function(response) {
                console.log('Event deleted successfully');
                $('#editEventForm').hide();
            },
            error: function() {
                alert('Error deleting event');
            }
        });

        // Remove the event from the calendar
        $('#calendar').fullCalendar('removeEvents', selectedEvent.id);
        highlightBusyDays();
    };

    // Function to open the edit form
    function openEditForm() {
        $('#editTitle').val(selectedEvent.title);
        $('#editStartDateTime').val(moment(selectedEvent.start).format('YYYY-MM-DDTHH:mm'));
        $('#editEndDateTime').val(moment(selectedEvent.end).format('YYYY-MM-DDTHH:mm'));

        $('#editEventForm').show();
    }

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

        // Highlight days with more than or equal to 10 events
        Object.keys(dateCounts).forEach(function(date) {
            var momentDate = moment(date);
            if (dateCounts[date] >= 17) {
                $('.fc-day[data-date="' + momentDate.format('YYYY-MM-DD') + '"]').css('background-color', 'red');
            } else {
                $('.fc-day[data-date="' + momentDate.format('YYYY-MM-DD') + '"]').css('background-color', ''); // Reset background color
            }
        });
    }
});
