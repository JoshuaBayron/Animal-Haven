<?php
  include 'required/head.php';
  include 'required/navigation/without-dashboard.php';
  $conn = mysqli_connect("localhost","root","","pawheaven");
?>

<!DOCTYPE html>
<html>
 <head>
  <title>Notifications</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 </head>
 <body>
  <main id="main">
             <section id="add" class="contact">
  <div class="container">
 
     <div class="navbar-header">

     </div>
     
    <!--  <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
            
            <a href="notifications.php" class="dropdown-toggle" ><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="bx bx-bell" style="font-size:18px;"></span></a>
            <ul href = "notifications.php" class="dropdown-menu"></ul>

      </li>
     </ul> -->
     <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
     <div style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">

        <table id="outputTable" class="form-group" style="width: 100%; font-size: 16px;">
            <tbody>
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "pawheaven");

                    $search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : '';
                        
                    $sql = "SELECT *, a.animal_name AS animal_name, c.firstname AS customer_firstname, c.lastname AS customer_lastname, s.firstname AS staff_firstname, s.lastname AS staff_lastname 
                            FROM appointment AS app
                            INNER JOIN animals AS a ON app.animals_id = a.animals_id
                            INNER JOIN customers AS c ON app.customer_id = c.customer_id
                            INNER JOIN staff AS s ON app.staff_id = s.staff_id
                            ORDER BY app.appointment_id DESC LIMIT 10; 
                        ";

                        $result = mysqli_query($connect, $sql);
                        $appointment_count = 1;
                        
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {  
                                echo '<tr>
                                        <td>'
                                        .$appointment_count.". ".$row["customer_firstname"]." ".$row["customer_lastname"]. '<br>'
                                        . "Pet name: ". $row["animal_name"]. '<br>'
                                        . "Status: ".$row["appointment_status"]." at ". $row["start_event_date"]." and end at ".$row["end_event_date"].'<br>'
                                        .'</td>
                                        <td></td>
                                    </tr>';
                                $appointment_count++;  
                            }
                        } else {
                            echo "<tr><td colspan='12'>No Notifications available</td></tr>";
                        }
                        
                    ?>
            </tbody>
        </table>
    </div>
</div>
   <br />
   <br />
   <form method="post" id="comment_form">

   </form>
   
  </div>
  </section>
</main>
 </body>
</html>

<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"notifications-backend/fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#comment').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"notifications-backend/insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Required");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
