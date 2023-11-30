<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
              <thead>
                <tr>
                  <th style="width: 10%;color:white">Action</th>
                  <th style="width: 1%; color:white">No</th>
                  <th style="width: 10%;color:white">Owners</th>
                  <th style="width: 10%;color:white">Address</th>
                  <th style="width: 10%;color:white">Contacts</th>
                  <th style="width: 10%;color:white">Email</th>
                  <th style="width: 10%;color:white">Doc In Charge</th>
                  <th style="width: 10%;color:white">Name</th>
                  <th style="width: 5%;color:white">Service</th>
                  <th style="width: 5%;color:white">Status</th>
                  <th style="width: 10%;color:white">Start</th>
                  <th style="width: 10%;color:white">End</th>
                  <th style="width: 10%;color:white">Breed</th>
                  <th style="width: 10%;color:white">Species</th>
                  <th style="width: 5%;color:white">Sex</th>
                  <th style="width: 1%;color:white">Quantity</th>
                  <th style="width: 1%;color:white">Payment Status</th>
                  <th style="width: 1%;color:white">Remark</th>
                  <th style="width: 10%;color:white">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

                $sql = "SELECT *,
                                a.animal_name AS animal_name,
                                c.firstname AS customer_firstname,
                                c.lastname AS customer_lastname,
                                c.address AS customer_address,
                                c.email AS customer_email,
                                s.firstname AS staff_firstname,
                                s.lastname AS staff_lastname,
                                s.email AS staff_email,
                                cci.contact_number AS contact
                        FROM appointment_archive AS app
                        INNER JOIN animals AS a ON app.animals_id = a.animals_id
                        INNER JOIN customers AS c ON app.customer_id = c.customer_id
                        INNER JOIN staff AS s ON app.staff_id = s.staff_id
                        INNER JOIN customer_contact_infos AS cci ON a.customer_id = cci.customer_id
                        WHERE
                            (c.firstname LIKE '%$search_query%' OR
                            c.lastname LIKE '%$search_query%' OR
                            c.address LIKE '%$search_query%' OR
                            s.firstname LIKE '%$search_query%' OR
                            s.lastname LIKE '%$search_query%' OR
                            a.animal_name LIKE '%$search_query%' OR
                            a.breed LIKE '%$search_query%' OR
                            a.species LIKE '%$search_query%' OR
                            a.gender LIKE '%$search_query%' OR
                            a.quantity LIKE '%$search_query%' OR
                            app.appointment_service LIKE '%$search_query%' OR
                            app.appointment_status LIKE '%$search_query%')
                        ORDER BY app.appointment_ID DESC";
                
                $result = mysqli_query($conn, $sql);
                $appointment_count = 1;
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                      $payment = $row["payment_status"];
                      $color = '';

                      if (stripos($payment, 'Not Yet Paid') !== false) {
                          $color = 'red';
                      } elseif (stripos($payment, 'Half Paid') !== false) {
                          $color = 'blue';
                      } elseif (stripos($payment, 'Paid') !== false) {
                          $color = 'green';
                      }

                        echo '<tr>
                                <td>
                                <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=restoreAppointment">Restore</a>
                                <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=deleteAppointment"  onclick="return confirm(\'Are you sure you want to permanently delete this appointment?\')">Delete</a>
                                </td>
                                </td>
                                <td>'.$appointment_count.'</td>
                                <td style="background-color: #aaffaa;"><b>'.$row["customer_firstname"]." ".$row["customer_lastname"].'</b></td>
                                <td>'.$row["customer_address"].'</td>
                                <td>'.$row["contact"].'</td>
                                <td>'.$row["customer_email"].'</td>
                                <td style="background-color: #aaffaa;"><b>'.$row["staff_firstname"]." ".$row["staff_lastname"].'</b></td>
                                <td style="background-color: #aaffaa;"><b>'.$row["animal_name"].'</b></td>
                                <td>'.$row["appointment_service"].'</td>
                                <td>'.$row["appointment_status"].'</td>
                                <td>'.$row["start_event_date"].'</td>
                                <td>'.$row["end_event_date"].'</td>
                                <td>'.$row["breed"].'</td>
                                <td>'.$row["species"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["quantity"].'</td>
                                <td style="color:'. $color .'">'.$payment.'</td>
                                <td>'.$row["remarks"].'</td>
                                <td>
                                <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=restoreAppointment">Restore</a>
                                <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=deleteAppointment" onclick="return confirm(\'Are you sure you want to permanently delete this appointment?\')">Delete</a>
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
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>