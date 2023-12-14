<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
    <thead>
        <tr>
            
            <th style="width: 10%; text-align: center; color:white">No</th>
            <th style="width: 15%; text-align: center; color:white">Time</th>
            <th style="width: 15%; text-align: center; color:white">ID</th>
            <th style="width: 15%; text-align: center; color:white">Position</th>
            <th style="width: 15%; text-align: center; color:white">Name</th>
            <th style="width: 20%; text-align: center; color:white">Description</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
        $counter_for_activity = 1;
        $conn = mysqli_connect("localhost", "root", "", "id21596882_pawheaven");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';

        $sql = "SELECT * FROM appointmentactivitylog WHERE 
            log_id  LIKE '%$search_query%' OR
            user_id LIKE '%$search_query%' OR 
            position LIKE '%$search_query%' OR 
            firstname LIKE '%$search_query%' OR 
            lastname LIKE '%$search_query%' OR 
            description LIKE '%$search_query%' OR 
            time_stamp LIKE '%$search_query%' 
            ORDER BY log_id DESC"; 

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
              
                echo "<td>" . $counter_for_activity . "</td>";
                echo "<td>" . $row["time_stamp"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                 echo "<td>" . $row["position"] . "</td>";
                 echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                
                echo "</tr>";
                $counter_for_activity++;
            }
        } else {
            echo "<tr><td colspan='7'>No Activity data available</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </tbody>
                       
</table>
