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
                  <th style="width: 10%; color:white">Date Appointed</th>
                  <th style="width: 10%; color:white">Date Turned Over</th>
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
                    `appointment` a ON wc.`referral_no` = a.`referral_no`
                INNER JOIN
                    `staff` s ON a.`staff_id` = s.`staff_id`
                    WHERE
                            (wc.firstname LIKE '%$search_query%' OR
                            wc.lastname LIKE '%$search_query%' OR
                            wc.address LIKE '%$search_query%' OR
                            wc.firstname LIKE '%$search_query%' OR
                            wc.lastname LIKE '%$search_query%' OR
                            wc.animal_name LIKE '%$search_query%' OR
                            wc.breed LIKE '%$search_query%' OR
                            wc.species LIKE '%$search_query%' OR
                            wc.gender LIKE '%$search_query%' OR
                            wc.quantity LIKE '%$search_query%' OR
                            a.appointment_service LIKE '%$search_query%' OR
                            a.appointment_status LIKE '%$search_query%')
                        ORDER BY a.appointment_ID DESC";

                
                $result = mysqli_query($connect, $sql);
                $appointment_count = 1;
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {  
                        $fullname = $row["firstname"]." ".$row["lastname"];
                        echo '<tr>
                                <td>
                                    <a class="custom-button" href="login-form/update-status1.php?appointment_no=' . $row["appointment_id"] . '&referral='.$row["referral_no"]. '&animalName='.$row["animal_name"].'&fullname='.$fullname.'" style="background-color:#8B4000">Edit</a>
                                    <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=archivingAppointment"  onclick="return confirm(\'Are you sure you want to delete this appointment?\')" style="background-color:red">Archive</a>
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
                                    <a class="custom-button" href="login-form/update-status1.php?appointment_no=' . $row["appointment_id"] . '&referral='.$row["referral_no"]. '&animalName='.$row["animal_name"].'&fullname='.$fullname.'" style="background-color:#8B4000">Edit</a>
                                    <a class="custom-button" href="backend/crude.php?appointment_no=' . $row["appointment_id"] . '&role=archivingAppointment"  onclick="return confirm(\'Are you sure you want to delete this appointment?\')" style="background-color:red">Archive</a>
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
            