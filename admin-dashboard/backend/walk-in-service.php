<?php
require('fpdf/fpdf.php');
require('connection.php');

function getQueryBasedOnInterval($interval) {
    $commonColumns = "`appointment_id`, `appointment_service`, `appointment_status`, `start_event_date`, `end_event_date`";
    
    switch ($interval) {
        case 'daily':
            return "SELECT $commonColumns  FROM appointment AS app INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no  WHERE DATE(`start_event_date`) = CURDATE()";
        case 'weekly':
            return "SELECT $commonColumns FROM `appointment` AS app INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no  WHERE YEARWEEK(`start_event_date`, 1) = YEARWEEK(NOW(), 1)";
        case 'monthly':
            return "SELECT $commonColumns FROM `appointment` AS app INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no  WHERE YEAR(`start_event_date`) = YEAR(NOW()) AND MONTH(`start_event_date`) = MONTH(NOW())";
        default:
            return "SELECT $commonColumns FROM `appointment` AS app INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no ";
    }
}


if (isset($_GET["printpdf"])) {
    // Fetch data based on selected time interval (daily, weekly, monthly)
    $interval = isset($_GET['interval']) ? $_GET['interval'] : 'daily';
    $query = getQueryBasedOnInterval($interval);
    $result = $conn->query($query);

    // Initialize service count array
    $serviceCount = array(
        'vaccination' => 0,
        'treatment' => 0,
        'consultation' => 0,
        'surgery' => 0,
        'grooming' => 0
    );

    // Set interval title
    switch ($interval) {
        case 'daily':
            $intervalTitle = 'Services Records For Walk-In - ' . date('F j, Y');
            $serviceTitle = 'Services Rendered For the Day - ' . date('F j, Y');
            break;
        case 'weekly':
            $intervalTitle = 'Services Records For Walk-In - Week of ' . date('F j, Y', strtotime('last Monday'));
            $serviceTitle = 'Services Rendered For Week of ' . date('F j, Y', strtotime('last Monday'));
            break;
        case 'monthly':
            $intervalTitle = 'Services Records For Walk-In - ' . date('F Y');
            $serviceTitle = 'Services Rendered For the Month of ' . date('F Y');
            break;
        default:
            $intervalTitle = 'Services Records For Walk-In';
            $serviceTitle = 'Services Rendered For Online';
            break;
    }

    // FPDF initialization
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image('../../assets/img/logo.png', 10, 5, 25);
    // Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 5, 'Animal Haven Veterinary Clinic', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'km. 6 La Trinidad, Benguet', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 20, $intervalTitle, 0, 1, 'C');

    // Set column names
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(5, 6, 'No', 1);
    $pdf->Cell(40, 6, 'Service', 1);
    $pdf->Cell(30, 6, 'Status', 1);
    $pdf->Cell(30, 6, 'Start Date', 1);
    $pdf->Cell(30, 6, 'End Date', 1);
    $pdf->Ln();

    // Set data from the database
    $pdf->SetFont('Arial', '', 6);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(5, 6, $row['appointment_id'], 1);
        $pdf->Cell(40, 6, $row['appointment_service'], 1);
        $pdf->Cell(30, 6, $row['appointment_status'], 1);
        $pdf->Cell(30, 6, $row['start_event_date'], 1);
        $pdf->Cell(30, 6, $row['end_event_date'], 1);

        // Increment the service count based on the service type
        $serviceType = strtolower($row['appointment_service']);
        if (array_key_exists($serviceType, $serviceCount)) {
            $serviceCount[$serviceType]++;
        }

        $pdf->Ln();
    }

     // Display the service count
     $pdf->Ln();
     $pdf->SetFont('Arial', 'B', 8);
     $pdf->Cell(0, 10, $serviceTitle, 0, 1, 'L');
 
     // Table Header
     $pdf->Cell(30, 4, 'Service', 1);
     $pdf->Cell(30, 4, 'Count', 1);
     $pdf->Ln();
 
     // Table Data
     foreach ($serviceCount as $service => $count) {
         $pdf->Cell(30, 4, ucfirst($service), 1);
         $pdf->Cell(30, 4, $count, 1);
         $pdf->Ln();
     }
     

    // Output the PDF
    $pdf->Output();

    // Close connection
    $conn->close();
}elseif (isset($_POST["printExcel"])) {
    $interval = isset($_POST['interval']) ? $_POST['interval'] : 'daily';
    $query = getQueryBasedOnInterval($interval);
    $result = $conn->query($query);

    switch ($interval) {
        case 'daily':
            $intervalTitle = 'Services Records For Walk-In - ' . date('F j, Y');
            break;
        case 'weekly':
            $intervalTitle = 'Services Records For Walk-In - Week of ' . date('F j, Y', strtotime('last Monday'));
            break;
        case 'monthly':
            $intervalTitle = 'Services Records For Walk-In - ' . date('F Y');
            break;
        default:
            $intervalTitle = 'Services Records For Walk-In';
            break;
    }

    if (mysqli_num_rows($result) > 0) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $intervalTitle . '.xls"');
        
        echo '
            <table class="table" border="1">
                <tr>
                    <th>No</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Appointed Date</th>
                    <th>Turnover Date</th>
                    <th>Payment Status</th>
                    <th>Species</th>
                    <th>Remarks</th>
                </tr>
        ';

        $appointment_count = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <tr>
                    <td>' . $row["appointment_id"] . '</td>
                    <td>' . $row["appointment_service"] . '</td>
                    <td>' . $row["appointment_status"] . '</td>
                    <td>' . $row["start_event_date"] . '</td>
                    <td>' . $row["end_event_date"] .'</td>
                    <td>' . $row["payment_status"] . '</td>
                    <td>' . $row["remarks"] . '</td>
                </tr>';
            $appointment_count++;
        }
        echo '</table>';
        exit(); // Add this line to prevent further execution
    } else {
        header('Location: ../pet-status.php');
        exit();
    }
} 
?>