<?php
  include 'includes/header.php';
  include 'includes/nav.php';

$customerId = $_SESSION['customer_id'];; // Replace with the actual customer ID

// Construct the SQL query to retrieve the image based on customer ID
// $sql = "SELECT customers.*, customer_profile_infos.* 
//         FROM customers
//         INNER JOIN customer_profile_infos ON customers.customer_id = customer_profile_infos.customer_id
//         WHERE customers.customer_id = '$customerId'";

$sql = "SELECT customers.*, customer_profile_infos.*, customer_contact_infos.*
        FROM customers
        INNER JOIN customer_profile_infos ON customers.customer_id = customer_profile_infos.customer_id
        INNER JOIN customer_contact_infos ON customers.customer_id = customer_contact_infos.customer_id
        WHERE customers.customer_id = '$customerId'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Assuming 'image' is the column name in the customer_profiles table
    $imageData = $row['image'];
    $id = $row['customer_id'];
    $name = $row['firstname'];
    $fname = $row['firstname'];
    $lname = $row['lastname'];
    $email = $row['email'];
    $password = $row['pass'];
    $contact = $row['contact_number'];
    // Display the image using an HTML img tag
    //echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image">';
} else {
    //echo "Image not found for this customer.";
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Facebook Style Header Notification using PHP Ajax Bootstrap</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 </head>
 <body>
  <br /><br />
  <div class="container">
   <nav class="navbar navbar-inverse">
    <div class="container-fluid">
     <div class="navbar-header">
      <a class="navbar-brand" href="notification.php">Webslesson Tutorial</a>
     </div>
     <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
            
            <a href="notification.php" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span></a>
            <ul href = "notification.php" class="dropdown-menu"></ul>

      </li>
     </ul>
    </div>
   </nav>
   <br />
   <h2 align="center">Facebook Style Header Notification using PHP Ajax Bootstrap</h2>
   <br />
   <form method="post" id="comment_form">
    <div class="form-group">
     <label>Enter Service</label>
     <input type="text" name="subject" id="subject" class="form-control">
    </div>
    <div class="form-group">
     <label>Enter Status</label>
     <textarea name="comment" id="comment" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="submit" name="post" id="post" class="btn btn-info" value="Post" />
    </div>
   </form>
   
  </div>
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
