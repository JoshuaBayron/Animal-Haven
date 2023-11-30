<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
    <thead>
        <tr>
            <th style="width: 10%; text-align: center; color:white">Action</th>
            <th style="width: 10%; text-align: center; color:white">ID</th>
            <th style="width: 15%; text-align: center; color:white">First Name</th>
            <th style="width: 15%; text-align: center; color:white">Last Name</th>
            <th style="width: 15%; text-align: center; color:white">Middle Initials</th>
            <th style="width: 15%; text-align: center; color:white">Position</th>
            <th style="width: 20%; text-align: center; color:white">Email</th>
            <th style="width: 10%; text-align: center; color:white">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $conn = mysqli_connect("localhost", "id21596882_root", "Animal@123", "id21596882_pawheaven");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

        $sql = "SELECT * FROM staff WHERE 
            staff_id LIKE '%$search_query%' OR
            firstname LIKE '%$search_query%' OR 
            lastname LIKE '%$search_query%' OR 
            MI LIKE '%$search_query%' OR 
            position LIKE '%$search_query%' OR
            email LIKE '%$search_query%'
            ORDER BY position ASC"; 

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>
                        <a class='custom-button' href='edit-staff.php?staff_id=" . $row["staff_id"] . "&role=update-staff'>
                            Edit
                        </a>
                        <a class='custom-button' href='backend/crude.php?staff_id=" . $row["staff_id"] . "&role=delete-staff' onclick='return confirm(\"Are you sure you want to delete this staff?\")'>
                            Delete
                        </a>
                    </td>";
                echo "<td style='background-color: #aaffaa;'>" . $row["staff_id"] . "</td>";
                echo "<td>" . $row["firstname"] . "</td>";
                echo "<td>" . $row["lastname"] . "</td>";
                echo "<td>" . $row["MI"] . "</td>";
                echo "<td>" . $row["position"] . "</td>";
                echo "<td style='background-color: #aaffaa;'>" . $row["email"] . "</td>";
                echo "<td>
                        <a class='custom-button' href='edit-staff.php?staff_id=" . $row["staff_id"] . "&role=update-staff'>
                            Edit
                        </a>
                        <a class='custom-button' href='backend/crude.php?staff_id=" . $row["staff_id"] . "&role=delete-staff' onclick='return confirm(\"Are you sure you want to delete this staff?\")'>
                            Delete
                        </a>
                    </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No staff data available</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </tbody>
                       
</table>
