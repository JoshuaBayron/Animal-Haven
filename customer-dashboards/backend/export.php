<?php
require('fpdf/fpdf.php'); // Make sure you have FPDF library included

// Function to generate PDF from animal details
function generatePDF($appointment_no) {
    // Create a PDF document
    $pdf = new FPDF();
    $pdf->AddPage();

    // Connect to the database (you might need to update the connection details)
    include 'connection.php';

    // Fetch animal details based on the appointment_no
    $appointment_no = intval($appointment_no);
    $sql = "SELECT *, a.animal_name, s.firstname, s.lastname FROM appointment as app
            INNER JOIN animals as a ON app.animals_id = a.animals_id
            INNER JOIN staff as s ON app.staff_id = s.staff_id
            WHERE app.appointment_id = '$appointment_no'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Define a mapping of appointment statuses to prices
        $priceMapping = [
            'Checkup' => 100,
            'Surgery' => 5000,
            'Deworming' => 500,
            'Groom' => 300,
            // Add more statuses and prices as needed
        ];

        // Output the animal details to the PDF
        while ($row = mysqli_fetch_assoc($result)) {
          
            $pdf->Image('../../assets/img/logo.png', 10, 5, 25);
             
            // Header
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 5, 'Animal Haven Veterinary Clinic', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(0, 10, 'km. 6 La Trinidad, Benguet', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 20, 'Medical Receipt', 0, 1, 'C');

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(60, 10, 'Animal Name: ' . $row['animal_name']);
            $pdf->Ln(); // Move to the next row

            $pdf->Cell(60, 10, 'Service: ' . $row['appointment_service']);
            $pdf->Ln();

            $pdf->Cell(60, 10, 'Status: ' . $row['appointment_status']);
            $pdf->Ln();

            $pdf->Cell(60, 10, 'Service Started: ' . $row['start_event_date']. " ". $row['start_event_time']);
            $pdf->Ln();

            $pdf->Cell(60, 10, 'Service Ended: ' . $row['end_event_date']. " ". $row['end_event_time']);
            $pdf->Ln();

            $pdf->Cell(60, 10, 'Doctor in Charge: ' . $row['firstname']. " ". $row['MI']. ". ". $row['lastname']);
            $pdf->Ln();
            // Calculate and display the price based on the appointment status
            $appointmentService = $row['appointment_service'];
            if (isset($priceMapping[$appointmentService])) {
                $price = $priceMapping[$appointmentService];
                $pdf->Cell(60, 10, 'Price: Php ' . number_format($price, 2));
                $pdf->Ln();
            } else {
                $pdf->Cell(60, 10, 'Price: N/A (Unknown Service)');
                $pdf->Ln();
            }

            $pdf->Output();
        }
    } else {
        echo "No data found for the specified appointment number.";
    }

  
}

// Check if the appointment_no is provided in the URL
if (isset($_GET['appointment_no'])) {
    $appointment_no = $_GET['appointment_no'];
    generatePDF($appointment_no);
} else {
    echo "Appointment number is missing in the URL.";
}

  // Close the database connection
    mysqli_close($conn);
?>
