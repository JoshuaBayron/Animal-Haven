<?php
//fetch.php;
if(isset($_POST["view"]))
{
 include("connect.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE appointment SET appoint_status=1 WHERE appoint_status=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT *, a.animal_name AS animal_name, c.firstname AS customer_firstname, c.lastname AS customer_lastname, s.firstname AS staff_firstname, s.lastname AS staff_lastname 
    FROM appointment AS app
    INNER JOIN animals AS a ON app.animals_id = a.animals_id
    INNER JOIN customers AS c ON app.customer_id = c.customer_id
    INNER JOIN staff AS s ON app.staff_id = s.staff_id
    ORDER BY app.appointment_id DESC LIMIT 10";

$appointment_count = 1;
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0 )
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
               <li>
                <a href="animal-status.php">
                 <strong>'.$row["appointment_service"].'</strong><br />
                 <small><em>'.$row["start_event_date"].'</em></small>
                 <small><em>'.$row["start_event_time"].'</em></small>
                </a>
               </li>
               <li class="divider"></li>
            ';
  }
 }
 else
 {
  $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
 }
 
 $query_1 = "SELECT * FROM appointment WHERE appoint_status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}
?>