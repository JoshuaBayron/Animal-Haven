<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
    <thead>
        <tr>
            <th style="width: 10%; color: white;">Action</th>
            <th style="width: 1%; color: white;">No</th>
            <th style="width: 20%; color: white;">Owners</th>
            <th style="width: 20%; color: white;">Address</th>
            <th style="width: 20%; color: white;">Contacts</th>
            <th style="width: 20%; color: white;">Email</th>
            <th style="width: 10%; color: white;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

        $sql = "SELECT *,
                    c.firstname AS customer_firstname,
                    c.lastname AS customer_lastname,
                    c.address AS customer_address,
                    c.email AS customer_email,
                    cci.contact_number AS contact
            FROM customers AS c 
            INNER JOIN customer_contact_infos AS cci ON c.customer_id = cci.customer_id
            WHERE
                (c.firstname LIKE '%$search_query%' OR
                c.lastname LIKE '%$search_query%' OR
                c.address LIKE '%$search_query%' OR
                cci.contact_number LIKE '%$search_query%' OR
                c.email LIKE '%$search_query%')
            ORDER BY c.customer_id DESC";

        $result = mysqli_query($conn, $sql);
        $appointment_count = 1;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td>
                        <?php
                        if ($row["verify_status"] == 0) {
                            echo '<a class="custom-button" href="backend/crude.php?customer_no=' . $row["customer_id"] . '&customerEmail=' . $row["customer_email"] . '&role=verifyEmail" style="background-color: blue">Verify</a>';
                        } else {
                            echo '<a class="custom-button" href="backend/crude.php?customer_no=' . $row["customer_id"] . '&customerEmail=' . $row["customer_email"] . '&role=unverifyEmail" style="background-color: green"><span class="fa fa-check-square"> </span> Verified</a>';
                        }
                        ?>
                    </td>
                    <td><?= $appointment_count ?></td>
                    <td style="background-color: #aaffaa;"><b><?= $row["customer_firstname"] . " " . $row["customer_lastname"] ?></b></td>
                    <td><?= $row["customer_address"] ?></td>
                    <td><?= $row["contact"] ?></td>
                    <td><?= $row["customer_email"] ?></td>
                    <td>
                        <?php
                        if ($row["verify_status"] == 0) {
                            echo '<a class="custom-button" href="backend/crude.php?customer_no=' . $row["customer_id"] . '&customerEmail=' . $row["customer_email"] . '&role=verifyEmail" style="background-color: blue">Verify</a>';
                        } else {
                            echo '<a class="custom-button" href="backend/crude.php?customer_no=' . $row["customer_id"] . '&customerEmail=' . $row["customer_email"] . '&role=unverifyEmail" style="background-color: green"><span class="fa fa-check-square"> </span> Verified</a>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $appointment_count++;
            }
        } else {
            echo "<tr><td colspan='7'>No status data available</td></tr>";
        }
        ?>
    </tbody>
</table>
