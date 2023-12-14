<?php include 'includes/header.php';
      include 'includes/nav.php';

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
   <style type="text/css">
       .faq-container {
    position: fixed;
    top: 10px; /* Adjust as needed */
    right: 10px; /* Adjust as needed */
    background-color: #ffffff; /* Background color for the FAQ container */
    padding: 10px;
    border: 2px solid #f2f2f2;
}

.faq-item {
    margin-bottom: 15px;
    cursor: pointer;
}

.question-box {
    display: inline-block;
    background-color: #f2f2f2;
    padding: 5px;
    border-radius: 5px;
}

.question-mark {
    font-size: 18px;
    font-weight: bold;
}

.answer {
    display: none;
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
}



   </style>
</head>
<body>


 <main id="main">

<!-- ======= Animal Information Section ======= -->
<section id="pet-information" class="contact">
  <div class="container">

    <div class="section-title">
      <h2>Pet Trash</h2>

       <div class="faq-container">
        <div class="faq-item" onmouseover="showAnswers()" onmouseout="hideAnswers()">
            <div class="question-box"><span class="question-mark">?</span></div>
            <div class="answer" id="answer1">This is the pet table </div>
            <div class="answer" id="answer2">Clicking the first button on the right side directs you to update page</div>
            <div class="answer" id="answer3">Clicking the second button on the right side allows you to delete a pet information</div>
            
        </div>
    </div>
    </div>
    <form method="GET" class="form-inline">
        <div class="form-group">
          <input type="text" name="search_query_for_animals" placeholder="Search by name, sex, age...">
          <button type="submit" style="background-color: #f34e4e;"><i class="fas fa-search" style="color: #E1D9D1;"></i></button>
          <button href="animal-info.php" style="background-color: #f34e4e;"><i class="fas fa-sync-alt" style="color: #E1D9D1;"></i></button>
          
        </div>
      </form>
    <div class="row" data-aos="fade-in">

      <div class="mt-5 mt-lg-0 d-flex align-items-stretch">

        <div style="width: 100%; overflow-x: auto; height: 350px;">
            <br>
          <table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
            <thead>
              <tr>
                <th style="width: 5%; background-color: #f34e4e;">No</th>
                <th style="width: 15%; background-color: #f34e4e;" >Name</th>
                <th style="width: 10%; background-color: #f34e4e;">Sex</th>
                <th style="width: 5%; background-color: #f34e4e;">Age</th>
                <th style="width: 10%; background-color: #f34e4e;">Birthdate</th>
                <th style="width: 15%; background-color: #f34e4e;">Species</th>
                <th style="width: 15%;background-color: #f34e4e;">Breed</th>
                <th style="width: 5%; background-color: #f34e4e;">Quantity</th>
                <th style="width: 15%; background-color: #f34e4e;">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $counter_for_animals = 1;
            
            $search_query_for_animals = isset($_GET["search_query_for_animals"]) ? $_GET["search_query_for_animals"] : '';
            $customer_id = $_SESSION["customer_id"]; // Retrieve the customer ID from the session
            
            $sql = "SELECT * FROM animals_archive WHERE 
                    customer_id = '$customer_id' AND (
                    animal_name LIKE '%$search_query_for_animals%' OR
                    gender LIKE '%$search_query_for_animals%' OR 
                    age LIKE '%$search_query_for_animals%' OR 
                    birthdate LIKE '%$search_query_for_animals%' OR
                    species LIKE '%$search_query_for_animals%' OR
                    breed LIKE '%$search_query_for_animals%' OR  
                    quantity LIKE '%$search_query_for_animals%')"; 
            
            $animal_result = mysqli_query($conn, $sql);

                 if (mysqli_num_rows($animal_result) > 0) {
                      while ($row = mysqli_fetch_assoc($animal_result)) {
                      echo "<tr>";
                      echo "<td>" . $counter_for_animals . "</td>";
                        echo '<td style="background-color: #ececec;">' . $row["animal_name"] . '</td>';
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["birthdate"] . "</td>";
                        echo '<td style="background-color: #ececec;">' . $row["species"] . '</td>';
                        echo "<td>" . $row["breed"] . "</td>";
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>
                               
                                </a>

                               
                                <a title='Restore Pet' class='custom-button2'  data-id='" . $row["animals_id"] . "' href='#' style=''><i class='fas fa-undo'></i> Restore</a><br>

                                <a title='Delete Pet' class='custom-button3'  data-id='" . $row["animals_id"] . "' href='#' style=''><i class='fas fa-trash-alt'></i> Permanent Delete</a>







                            </td>";
                    

                      echo "</tr>";
                      $counter_for_animals++;
                  }
              } else {
                  echo "<tr><td colspan='8'>No animals data available</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <button onclick="window.location.href='animal-info.php'" style="color:#E1D9D1;"><i class="fas fa-arrow-left" style="color: #E1D9D1;"></i></button>
           <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.js"></script>

    <script type="text/javascript">
        // JavaScript to handle the SweetAlert confirmation
        document.addEventListener('DOMContentLoaded', () => {
            const deleteLinks = document.querySelectorAll('.custom-button2');

            deleteLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const animals_id = link.getAttribute('data-id');
                    confirmDelete(animals_id);
                });
            });

            function confirmDelete(animals_id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will restore the pet to the original table!',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to delete.php with the record ID
                        window.location.href = `backend/restore_pet.php?animals_id=${animals_id}`;
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        
        // JavaScript to handle the SweetAlert confirmation
        document.addEventListener('DOMContentLoaded', () => {
            const deleteLinks = document.querySelectorAll('.custom-button3');

            deleteLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const animals_id = link.getAttribute('data-id');
                    confirmDelete(animals_id);
                });
            });

            function confirmDelete(animals_id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this record!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, redirect to delete.php with the record ID
                        window.location.href = `backend/delete_pet.php?animals_id=${animals_id}`;
                    }
                });
            }
        });
    </script>
        </div>
      </div>
    </div>
  </div>
     <script type="text/javascript">
    function showAnswers() {
    for (var i = 1; i <= 4; i++) {
        var answer = document.getElementById('answer' + i);
        answer.style.display = 'block';
    }
}

function hideAnswers() {
    for (var i = 1; i <= 4; i++) {
        var answer = document.getElementById('answer' + i);
        answer.style.display = 'none';
    }
}



    </script>

</section><!-- End Animal Information Section -->

</main><!-- End #main -->
</body>
</html>
<?php include 'includes/footer.php';
$conn->close();
?>
