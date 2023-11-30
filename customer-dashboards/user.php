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
    $middle_initial = $row['MI'];
    $password = $row['pass'];
    $contact = $row['contact_number'];
    $address = $row['address'];
    // Display the image using an HTML img tag
    //echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Image">';
} else {
    //echo "Image not found for this customer.";
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Image</title>
  <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">
    .upload{
      width: 140px;
      position: relative;
      margin: auto;
      text-align: center;

    }
    .upload img{
      border-radius:  50%;
      border: 8px solid #DCDCDC;
      width: 125px;
      height: 125px;

    }
    .upload .rightRound
    {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #00BFFF;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;

    }
    .upload .leftRound{
            position: absolute;
      bottom: 0;
        left: 0;
      background: red;
      width: 32px;
      height: 32px;
      line-height: 33px;
      text-align: center;
      border-radius: 50%;
      overflow: hidden;
      cursor: pointer;

    }
    .upload .fa{
      color: white;
    }
    .upload input{
      position: absolute;
      transform: scale(2);
      opacity: 0;
    }
    .upload input::-webkit-file-upload-button, .upload input[type="submit"]{
      cursor: pointer ;
    }


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
    <section id="add" class="contact">
        <div class="container">
            <div class="section-title">
            <h2>Your Account/ <span>Settings</span></h2>
        </div>
       <div class="faq-container">
        <div class="faq-item" onmouseover="showAnswers()" onmouseout="hideAnswers()">
            <div class="question-box"><span class="question-mark">?</span></div>
            <div class="answer" id="answer1">If you wish to change your profile picture</div>
            <div class="answer" id="answer2">click the blue camera and select desired image</div>
            <div class="answer" id="answer3">Edit your information fields provided</div>
            <div class="answer" id="answer4">Once you have made the desired updates, look for the update button</div>
        </div>
    </div>
       <div class="row" data-aos="fade-in">
          

  <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
    <div class="upload">
      <?php
      
      ?>
      
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <img src="img/<?php echo !empty($imageData) ? $imageData: 'noprofile.jpg'; ?>" width = 125 height = 125 title = "<?php echo $imageData; ?>" id = "image">

    

        <div class="rightRound" id = "upload">
          <input type="file" name="fileImg" id = "fileImg" accept = ".jpg, .jpeg, .png,">
          <i class = "fa fa-camera"></i>
        </div> 
        <div class="leftRound" id = "cancel" style="display: none;">
          <i class="fa fa-times"></i>
        </div>

        <div class="rightRound" id = "confirm" style="display: none;">
          <input type="submit" name=" " value = "">
        <i class="fa fa-check"></i>
      </div>
    </div>


  </form>
    <form class="form2" id="form2" action="backend/update_profile.php" method="post">



                    <div class="row">
                        <div class="form-group" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
                               <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname"  value = "<?php echo $lname; ?>" required>
                        </div>  
                         <div class="form-group" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
                                <label for="fname">First Name</label>
                              <input type="text" class="form-control" name="fname" id="fname" value = "<?php echo $fname; ?>" required>
                        </div>  
                         <div class="form-group" style="width: 100%; max-width: 100px; margin-bottom: 10px;">
                                <label for="middle_initial">Middle Initial</label>
                              <input type="text" class="form-control" name="middle_initial" id="middle_initial" value = "<?php echo $middle_initial; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                         <div class="form-group" style="width: 100%; max-width: 300px; margin-bottom: 10px;">
                               <label for="contact">Contact</label>
                                <input type="text" class="form-control" name="contact" id="contact" i value = "<?php echo $contact;?>" readonly>
                        </div>  
                    </div>

                    <div class="row">
                         <div class="form-group" style="width: 100%; max-width: 500px; margin-bottom: 10px;">
                           <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" value = "<?php echo $email; ?>" readonly>
                        </div> 
                       

                    </div>
                    

                    <div class="row">
                         <div class="form-group" style="width: 100%; max-width: 1000px; margin-bottom: 10px;">
                               <label for="address">Address</label>
                              <input type="text" class="form-control" name="address" id="address" value = "<?php echo $address;?>" required>
                        </div>  
                    </div>

                   <div class="text-center" style="display: inline-block;">
                      <button type="submit" style="color: #E1D9D1; background-color:#040b14;">Update</button>
                      <button type="reset" style="color: #E1D9D1; background-color: #040b14;">Reset</button>
                     
                    </div>
                    

  </form>

            <form method="post" action="backend/password-reset-code.php" class="login100-form validate-form">
                    <div class="container-login100-form-btn">
                        <br>
                        <button class="login100-form-btn" type="submit" name="password-reset-link" style="color: #E1D9D1; background-color: #040b14;">Change Password </button>
                    </div>
                </form>
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

    function redirectToAnotherLink() {
    // Replace 'https://example.com' with the link you want to redirect to
    window.location.href = 'backend/password-reset-code';
}



    </script>


  <script type="text/javascript">
    document.getElementById("fileImg").onchange = function(){
      document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]);//preview image

      document.getElementById("cancel").style.display = "block";
      document.getElementById("confirm").style.display = "block";

      document.getElementById("upload").style.display = "none";
    }
        var userImage = document.getElementById('image').src;
    document.getElementById("cancel").onclick = function(){
      document.getElementById("image").src = userImage;
      document.getElementById("cancel").style.display = "none";
      document.getElementById("confirm").style.display = "none";

      document.getElementById("upload").style.display = "block";
    }
    // document.getElementById("image").onchange = function(){
    //   document.getElementById('form').submit();
    // }


  </script>
  <?php

    if(isset($_FILES['fileImg']['name'])){
      $id = $_POST['id'];
      $name = $_POST['name'];

      $imageName = $_FILES['fileImg']['name'];
      $imageSize = $_FILES['fileImg']['size'];
      $tmpName = $_FILES['fileImg']['tmp_name'];


      //image validation

      $validImageExtension = ['jpg', 'jpeg', 'png'];
      $imageExtension = explode('.', $imageName);
      $imageExtension = strtolower(end($imageExtension));
      if(!in_array($imageExtension, $validImageExtension)){
        echo 
        "
          <script>
            alert ('Invalid Image Extension');
            document.location.href = 'user.php';

          </script>

        ";

      }
      elseif($imageSize > 120000000){

        echo "
          <script>
            alert('Image Size is Too Large');
            document.location.href = 'user.php'

        ";
      }
      else
      {
        $newImageName = $name."-". date("Y.m.d"). "-" . date("h.i.sa");
        $newImageName .= "." . $imageExtension;
        $query = "UPDATE customer_profile_infos SET image = '$newImageName' WHERE customer_id = '$id'";
        mysqli_query($conn,$query);
        move_uploaded_file($tmpName,'img/'. $newImageName);
        echo "
          <script>
            document.location.href = 'user.php';

          </script

        ";

      }

    }


  ?>

             </div>
        </div>
    </section>
  </main>
</body>
</html>

 <?php include 'includes/footer.php';
    $conn->close();?>
