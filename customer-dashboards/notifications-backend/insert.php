<?php
//insert.php
if(isset($_POST["subject"]))
{
 include("connect.php");
 $appointment_service = mysqli_real_escape_string($connect, $_POST["subject"]);
 $appointment_status = mysqli_real_escape_string($connect, $_POST["comment"]);
 $query = "
 INSERT INTO appointment(appointment_service, appointment_status)
 VALUES ('$appointment_service', '$appointment_status')
 ";
 mysqli_query($connect, $query);
}
?>
