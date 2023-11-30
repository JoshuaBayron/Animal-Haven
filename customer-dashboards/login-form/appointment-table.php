<div style="width: 100%; overflow-x: auto;">

					<table id="outputTable" class="form-group" style="width: 100%; font-size: 12px;">
						<thead>
						<tr>
							<th style="width: 5%;">No</th>
							<th style="width: 10%;">Animal Name</th>
							<th style="width: 10%;">Service</th>
							<th style="width: 10%;">Status</th>
							<th style="width: 10%;">Start Date</th>
							<th style="width: 10%;">End Date</th>
							<th style="width: 10%;">Start Time</th>
							<th style="width: 10%;">End Time</th>
							<th style="width: 10%;">Doctor In Charge</th>
                            <th style="width: 10%;">Reciept</th>
						</tr>
						</thead>
						<tbody>
						<?php 
							$counter_for_animals = 1;
							$conn = mysqli_connect("localhost", "root", "", "pawheaven");
							
							if (!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							
							$search_query_for_appointments = isset($_GET["search_query_for_animals"]) ? $_GET["search_query_for_animals"] : '';
							
							if (isset($_GET['animal_id']) && !empty($_GET['animal_id'])) {
								$animal_id = intval($_GET['animal_id']);
								$sql = "SELECT *,  a.animal_name, s.firstname, s.lastname FROM appointment as app
                                INNER JOIN animals as a ON app.animals_id = a.animals_id
								INNER JOIN staff as s ON app.staff_id = s.staff_id
                                WHERE 
                                    a.animals_id = '$animal_id' AND (
                                    a.animal_name LIKE '%$search_query_for_appointments%' OR
                                    app.appointment_service LIKE '%$search_query_for_appointments%' OR
                                    app.appointment_status LIKE '%$search_query_for_appointments%' OR 
                                    app.start_event_time LIKE '%$search_query_for_appointments%' OR 
									app.end_event_time LIKE '%$search_query_for_appointments%' OR 
                                    app.start_event_date LIKE '%$search_query_for_appointments%' OR 
                                    app.end_event_date LIKE '%$search_query_for_appointments%')";
    
										
								$appointment_result = mysqli_query($conn, $sql);
							
								if (mysqli_num_rows($appointment_result) > 0) {
									while ($row = mysqli_fetch_assoc($appointment_result)) {
										echo "<tr>";
										echo "<td>" . $counter_for_animals . "</td>";
										echo "<td>" . $row["animal_name"] . "</td>";
										echo "<td>" . $row["appointment_service"] . "</td>";
										echo "<td>" . $row["appointment_status"] . "</td>";
										echo "<td>" . $row["start_event_date"] . "</td>";
										echo "<td>" . $row["end_event_date"] . "</td>";
										echo "<td>" . $row["start_event_time"] . "</td>";
										echo "<td>" . $row["end_event_time"] . "</td>";
										echo "<td>" . $row["firstname"] ." " . $row["lastname"] . "</td>";
                                        echo "<td>
													<a class='custom-button' href='../backend/export.php?appointment_no=" . $row['appointment_id'] . "' target='_blank'>
														<i class='fas fa-receipt icon'></i>
													</a>
												</td>";
	
										echo "</tr>";
										$counter_for_animals++;
									}
								} else {
									echo "<tr><td colspan='7'>No appointment data available</td></tr>";
								}
							} else {
								
								echo "Invalid animal ID.";
								exit;
							}
							
							mysqli_close($conn);
							
							?>
						</tbody>
					</table>
				</div>