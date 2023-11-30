<?php
include 'backend/crude.php';
include 'includes/header.php';
include 'includes/nav.php';

$counter_for_animals = 1;
$staff_ID = $_SESSION['staff_id'];
$search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

$sqlAppointment = "SELECT t1.*, t2.* FROM appointment t1
    JOIN animals t2 ON t1.animals_id = t2.animals_id
    WHERE t1.staff_id = $staff_ID AND (
        t2.animal_name LIKE '%$search_query%' 
        OR t1.appointment_service LIKE '%$search_query%' 
        OR t1.start_event_date LIKE '%$search_query%' 
        OR t1.end_event_date LIKE '%$search_query%'
        OR t1.appointment_status LIKE '%$search_query%'
    )";

$resultAppointment = $conn->query($sqlAppointment);

if (!$resultAppointment) {
    die("Query failed: " . $conn->error);
}

?>

<main id="main">
    <section id="pet-status" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Animal Status</h2>
            </div>

            <div class="d-flex justify-content-end">  
                <form method="GET" class="form-inline">
                    <div class="form-group">
                        <input type="text" name="search_query" placeholder="Search by animal name" style="width: 70%;">
                        <button type="submit"><i class="fas fa-search"></i></button>
                        <button id="refreshButton">Refresh</button>
                        <button id="showAllButton">Show All</button>
                    </div>
                </form>
            </div>

            <div class="row" data-aos="fade-in">
                <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
                    <div style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">
                        <table id="animalStatusTable" class="form-group" style="width: 100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width: 3%;">No</th>
                                    <th style="width: 10%;">Animal Name</th>
                                    <th style="width: 8%;">Service</th>
                                    <th style="width: 10%;">Start</th>
                                    <th style="width: 10%;">End</th>
                                    <th style="width: 10%;">Status</th>
                                    <th style="width: 10%;">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($resultAppointment->num_rows > 0) {
                                    while ($row = $resultAppointment->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $counter_for_animals . "</td>";
                                        echo "<td>" . $row['animal_name'] . "</td>";
                                        echo "<td>" . $row['appointment_service'] . "</td>";
                                        echo "<td>" . $row['start_event_date'] . "</td>";
                                        echo "<td>" . $row['end_event_date'] . "</td>";
                                        echo "<td>" . $row['appointment_status'] . "</td>";
                                        echo "<td>";
                                        // Update button
                                        echo "<a class='custom-button' onclick='toggleUpdateForm(" . $row['appointment_id'] . ")'><i class='fas fa-pencil-alt'></i></a>";
                                        // Delete button
                                        echo "<a class='custom-button' onclick='confirmDelete(" . $row['appointment_id'] . ")'><i class='fas fa-trash'></i></a>";
                                        echo "</td>";
                                        echo "</tr>";

                                        // Update form
                                        echo "<tr style='display:none;' id='updateFormRow" . $row['appointment_id'] . "'>";
                                        echo "<td colspan='6'>";
                                        echo "<form id='updateForm" . $row['appointment_id'] . "' method='POST'>";
                                        echo "<input type='hidden' name='appointment_id' value='" . $row['appointment_id'] . "'>";
                                        echo "<select name='new_appointment_status'>";
                                        // Generate options based on your data or some predefined options
                                        $options = array("Done", "Admitted", "Consultation");

                                        foreach ($options as $option) {
                                            $selected = ($row['appointment_status'] == $option) ? "selected" : "";
                                            echo "<option value='$option' $selected>$option</option>";
                                        }
                                        echo "</select>";

                                        echo "<button type='submit' name='update'>Update</button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "</tr>";

                                        $counter_for_animals++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No appointment data available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'includes/footer.php';
?>

<script type="text/javascript">

    function confirmDelete(appointmentId) {
        if (confirm("Are you sure you want to delete this appointment?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "delete-appointment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Remove the row from the table after successful deletion
                    const tableRow = document.getElementById("row-" . appointmentId);
                    tableRow.remove();
                }
            };
            xhr.send("appointmentId=" + appointmentId);
        }
    }

         document.getElementById('refreshButton').addEventListener('click', function() {
         location.reload();
    });
      document.getElementById('showAllButton').addEventListener('click', function() {
         var items = document.querySelectorAll('li');
      items.forEach(function(item) {
        item.classList.toggle('hidden');
      });
});
</script>
