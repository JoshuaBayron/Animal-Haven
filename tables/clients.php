<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
                <thead>
                  <tr>
                    <th style="width: 5%;color:white">No</th>
                    <th style="width: 15%;color:white">Customer Name</th>
                    <th style="width: 15%;color:white">Email</th>
                    <th style="width: 10%;color:white">Contact Number</th>
                    <th style="width: 10%;color:white">Address</th>
                    <th style="width: 1%color:white">||</th>
                    <th style="width: 15%;color:white">Animal Name</th>
                    <th style="width: 10%;color:white">Breed</th>
                    <th style="width: 10%;color:white">Species</th>
                    <th style="width: 5%color:white">Quantity</th>
                    <th style="width: 10%color:white">Referral Number</th>
                  </tr>
                </thead>
                <tbody>
                <?php

                $connect = mysqli_connect("localhost", "id21596882_root", "Animal@123", "id21596882_pawheaven");
                $staff_ID = $_SESSION['staff_id'];
                $search_query = isset($_GET["search_query"]) ? mysqli_real_escape_string($connect, $_GET["search_query"]) : '';

                $sql = "SELECT *, c.email AS customer_email, c.firstname AS customer_firstname, c.lastname AS customer_lastname, c.MI AS customer_MI, c.address AS customer_address
                FROM appointment AS app
                INNER JOIN customers AS c ON c.customer_id = app.customer_id
                INNER JOIN animals AS a ON a.animals_id = app.animals_id
                INNER JOIN customer_contact_infos AS con ON con.customer_id = c.customer_id
                INNER JOIN staff AS t1 ON t1.staff_id = app.staff_id
                WHERE t1.staff_id = $staff_ID AND(
                        a.animal_name LIKE '%$search_query%' 
                      OR c.lastname LIKE '%$search_query%' 
                      OR c.firstname LIKE '%$search_query%' 
                      OR c.MI LIKE '%$search_query%'
                      OR c.email LIKE '%$search_query%' 
                      OR con.contact_number LIKE '%$search_query%' 
                      OR a.quantity LIKE '%$search_query%'
                      OR a.animals_id LIKE '%$search_query%'
                      OR a.breed LIKE '%$search_query%'
                      OR a.species LIKE '%$search_query%'
                    )";
                
                $result = mysqli_query($connect, $sql);
                $appointment_count = 1;
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>
                        <td>'.$appointment_count.'</td>
                        <td>'.$row["customer_lastname"].", ".$row["customer_firstname"]." ".$row["customer_MI"].".".'</td>
                        <td>'.$row["customer_email"].'</td>
                        <td>'.$row["contact_number"].'</td>
                        <td>'.$row["customer_address"].'</td>
                        <td> || </td>
                        <td>'.$row["animal_name"].'</td>
                        <td>'.$row["breed"].'</td>
                        <td>'.$row["species"].'</td> 
                        <td>'.$row["quantity"].'</td>
                        <td>'.$row["animals_id"].'</td>
                        </tr>';
                        $appointment_count++;
                    }
                } else {
                    echo "<tr><td colspan='12'>No status data available</td></tr>";
                }
                ?>
                </tbody>
              </table>  