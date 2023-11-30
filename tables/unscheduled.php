<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
            <thead>
              <tr>
              <th style="width: 1%; color:white">No</th>
                  <th style="width: 10%;color:white">Owners</th>
                  <th style="width: 10%;color:white">Address</th>
                  <th style="width: 10%;color:white">Contacts</th>
                  <th style="width: 10%;color:white">Email</th>
                  <th style="width: 10%;color:white">Name</th>
                  <th style="width: 5%;color:white">Service</th>
                  <th style="width: 5%;color:white">Status</th>
                  <th style="width: 10%;color:white">Start</th>
                  <th style="width: 10%;color:white">End</th>
                  <th style="width: 10%;color:white">Breed</th>
                  <th style="width: 10%;color:white">Species</th>
                  <th style="width: 5%;color:white">Sex</th>
                  <th style="width: 1%;color:white">Quantity</th>
                  <th style="width: 10%;color:white">Action</th>   
              </tr>
            </thead>
            <tbody>
            <?php 
            $counter_for_animals = 1;

            $search_query_for_animals = isset($_GET["search_query"]) ? $_GET["search_query"] : '';
            
            $sql = "SELECT 
                    app.*, 
                    a.animal_name AS animal_name,
                    c.firstname AS customer_firstname,
                    c.lastname AS customer_lastname,
                    c.address AS customer_address,
                    c.email AS customer_email,
                    cci.contact_number AS contact
                FROM appointment AS app
                INNER JOIN animals AS a ON app.animals_id = a.animals_id
                INNER JOIN customers AS c ON app.customer_id = c.customer_id
                INNER JOIN customer_contact_infos AS cci ON a.customer_id = cci.customer_id
                WHERE 
                    (app.appointment_service LIKE '%$search_query_for_animals%' OR
                    app.appointment_status LIKE '%$search_query_for_animals%' OR 
                    app.start_event_date LIKE '%$search_query_for_animals%')
                AND
                    app.end_event_date = ''";

            
            $animal_result = mysqli_query($conn, $sql);
            $appointment_count = 1;
                 if (mysqli_num_rows($animal_result) > 0) {
                      while ($row = mysqli_fetch_assoc($animal_result)) {

                          echo '<tr>
                                  <td>'.$appointment_count.'</td>
                                  <td style="background-color: #aaffaa;"><b>'.$row["customer_firstname"]." ".$row["customer_lastname"].'</b></td>
                                  <td>'.$row["customer_address"].'</td>
                                  <td>'.$row["contact"].'</td>
                                  <td>'.$row["customer_email"].'</td>
                                  <td style="background-color: #aaffaa;"><b>'.$row["animal_name"].'</b></td>
                                  <td>'.$row["appointment_service"].'</td>
                                  <td>'.$row["appointment_status"].'</td>
                                  <td>'.$row["start_event_date"].'</td>
                                  <td>'.$row["end_event_date"].'</td>
                                  <td>'.$row["breed"].'</td>
                                  <td>'.$row["species"].'</td>
                                  <td>'.$row["gender"].'</td>
                                  <td>'.$row["quantity"].'</td>
                                  <td>
                                      <a class="custom-button" href="login-form/update-status2.php?appointment_no=' . $row["appointment_id"] . '&animalName='.$row["animal_name"].'&customerEmail='.$row["customer_email"].'&animalID='.$row["animals_id"].'">Edit</a>
                                      <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=delete-status"  onclick="return confirm(\'Are you sure you want to delete this appointment?\')">Delete</a>
                                  </td>
                              </tr>';
                          $appointment_count++;  
                        }
                      } else {
                          echo "<tr><td colspan='12'>No status data available</td></tr>";
                      }
              ?>
            </tbody>
          </table>