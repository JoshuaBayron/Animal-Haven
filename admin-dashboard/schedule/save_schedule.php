<?php 
require_once('db-connect.php');
if($_SERVER['REQUEST_METHOD'] !='POST'){
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}
extract($_POST);
$allday = isset($allday);

if(empty($appointment_id)){
    $sql = "INSERT INTO `appointment` (`appointment_service`,`start_event_date`,`end_event_date`) VALUES ('$appointment_title','$start_event_date','$end_event_date')";
}else{
    $sql = "UPDATE `appointment` set `appointment_service` = '{$appointment_title}', `start_event_date` = '{$start_event_date}', `end_event_date` = '{$end_event_date}' where `id` = '{$appointment_id}'";
}
$save = $conn->query($sql);
if($save){
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
}else{
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: ".$conn->error."<br>";
    echo "SQL: ".$sql."<br>";
    echo "</pre>";
}
$conn->close();
?>