<?php 
    include 'include/header.php';
	require_once '../backend/fetch_user.php';
    include 'nav.html';
?>

   <br>
    <form action="../backend/crude.php" method="POST" id="admin" class="login100-form validate-form" enctype="multipart/form-data">
        <input type="hidden" name="roles" value="add-address">
        
        <div class="wrap-input500 validate-input" data-validate="Enter Address">
            <input class="input100" type="tel" name="address" id="address" placeholder="Enter Address">
            <span class="focus-input100" data-placeholder="&#xf207;"></span>
        </div>
        
        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn" style="background-color: green">
                <i class="fas fa-check" style="color:white"></i> 
            </button>
            <a href="../services.php">
				<button type="button" class="login100-form-btn" style="background-color: green">
					<i class="fas fa-times" style="color:white"></i> 
				</button>
            </a>
        </div>
    </form>
    <br>
    <div style="width: 100%; max-height: 95px; overflow-x: auto; overflow-y: auto;">
        <table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center">No.</th>
                    <th style="width: 20%; text-align: center">Address</th>
                    <th style="width: 5%;text-align: center">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                require '../backend/connection.php';
                $count = 1;
                $show_query = "SELECT * FROM admin_address_infos WHERE admin_id = 1";
                $result = $conn->query($show_query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>" . $count . "</td>";
                        echo "<td>" . $row["business_address"] . "</td>";
                        echo "<td>
                        <a class='custom-button' href='../backend/crude.php?address_id=" . $row["address_id"] . "&role=delete-address' onclick='return confirm(\"Are you sure you want to delete this address?\")'>
                            Delete
                        </a>
                        </td>";

                        echo "</tr>";
                        $count++;
                        }
                        } else {
                        echo "<tr><td colspan='7'>No contacts available</td></tr>";
                    }
                    mysqli_close($conn);
                ?>
            </tbody>                   
        </table>
    </div>
</div>	
<?php 
include 'include/footer.php' 
?>