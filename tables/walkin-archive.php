<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
              <thead>
                <tr>
                  <th style="width: 10%; color:white">Action</th>
                  <th style="width: 1%; color:white">Referrals</th>
                  <th style="width: 10%; color:white">Owners</th>
                  <th style="width: 10%; color:white">Address</th>
                  <th style="width: 10%; color:white">Contact-Number</th>
                  <th style="width: 10%; color:white">Doc In Charge</th>
                  <th style="width: 10%; color:white">Name</th>
                  <th style="width: 10%; color:white">Breed</th>
                  <th style="width: 10%; color:white">Species</th>
                  <th style="width: 5%; color:white">Sex</th>
                  <th style="width: 1%; color:white">Quantity</th>
                  <th style="width: 5%; color:white">Service</th>
                  <th style="width: 5%; color:white">Status</th>
                  <th style="width: 10%; color:white">Start</th>
                  <th style="width: 10%; color:white">End</th>
                  <th style="width: 10%; color:white">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $connect = mysqli_connect("localhost", "root", "", "id21596882_pawheaven");

                $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';
                
                $sql = "SELECT 
                    wc.*,
                    a.*,
                    s.firstname AS staff_firstname,
                    s.lastname AS staff_lastname,
                    wc.referral_no AS referrals
                FROM 
                    `walk_in_customers` wc
                INNER JOIN 
                    `appointment_archive` a ON wc.`referral_no` = a.`referral_no`
                INNER JOIN
                    `staff` s ON a.`staff_id` = s.`staff_id`";

                
                $result = mysqli_query($connect, $sql);
                $appointment_count = 1;
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {  
                        $fullname = $row["firstname"]." ".$row["lastname"];
                        echo '<tr>
                                <td>
                                    <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=restoreAppointment" style="background-color: orange">Restore</a>
                                    <a class="custom-button" href="backend/crude.php?referral='.$row["referrals"].'&appointment_no=' . $row["appointment_id"] . '&role=delete-status"  onclick="return confirm(\'Are you sure you want to Permanently delete this appointment?\')" style="background-color: #8B0000">Delete</a>
                                </td>
                                <td>'.$appointment_count.'</td>
                                <td style="background-color: #aaffaa;"><b>'.$fullname.'</b></td>
                                <td>'.$row["address"].'</td>
                                <td>'.$row["contacts"].'</td>
                                <td style="background-color: #aaffaa;"><b>'.$row["staff_firstname"]." ".$row["staff_lastname"].'</b></td>
                                <td style="background-color: #aaffaa;"><b>'.$row["animal_name"].'</b></td>
                                <td>'.$row["breed"].'</td>
                                <td>'.$row["species"].'</td>
                                <td>'.$row["gender"].'</td>
                                <td>'.$row["quantity"].'</td>
                                <td style="background-color: #aaffaa;">'.$row["appointment_service"].'</td>
                                <td>'.$row["appointment_status"].'</td>
                                <td>'.$row["start_event_date"].'</td>
                                <td>'.$row["end_event_date"].'</td>
                                <td>
                                <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=restoreAppointment" style="background-color: orange">Restore</a>
                                <a class="custom-button" href="backend/crude.php?referral='.$row["referrals"].'&appointment_no=' . $row["appointment_id"] . '&role=delete-status"  onclick="return confirm(\'Are you sure you want to Permanently delete this appointment?\')" style="background-color: #8B0000">Delete</a>
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
            