<?php
require('fpdf/fpdf.php');
$connect = mysqli_connect("localhost", "root", "", "pawheaven");

$doctorData = [];
$output = '';

// export excel start
if (isset($_POST["status"])) {
    $currentMonth = date('m');
    $currentYear = date('Y');
    $query = "SELECT *, a.animal_name AS animal_name, 
        c.firstname AS customer_firstname, 
        c.lastname AS customer_lastname, 
        s.firstname AS staff_firstname,
        s.lastname AS staff_lastname, 
        s.MI AS staff_MI 
        FROM appointment AS app
        INNER JOIN animals AS a ON app.animals_id = a.animals_id
        INNER JOIN customers AS c ON app.customer_id = c.customer_id
        INNER JOIN staff AS s ON app.staff_id = s.staff_id
        WHERE MONTH(app.start_event_date) = $currentMonth
        AND YEAR(app.start_event_date) = $currentYear";

    $excel_result = mysqli_query($connect, $query);
    if (mysqli_num_rows($excel_result) > 0) {
        $output .= '
            <table class="table" border="1">
                <tr>
                    <th>No</th>
                    <th>Owner</th>
                    <th>Animal Name</th>
                    <th>Doctor in Charge</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Breed</th>
                    <th>Species</th>
                    <th>Sex</th>
                    <th>Quantity</th>
                </tr>
        ';
        $appointment_count = 1;
        while ($row = mysqli_fetch_array($excel_result)) {
            $output .= '
                <tr>
                    <td>' . $appointment_count . '</td>
                    <td>' . $row["customer_firstname"] . " " . $row["customer_lastname"] . '</td>
                    <td>' . $row["animal_name"] . '</td>
                    <td>' . $row["staff_firstname"] . " " . $row["staff_lastname"] . '</td>
                    <td>' . $row["appointment_service"] . '</td>
                    <td>' . $row["appointment_status"] . '</td>
                    <td>' . $row["start_event_date"] . '</td>
                    <td>' . $row["end_event_date"] .'</td>
                    <td>' . $row["breed"] . '</td>
                    <td>' . $row["species"] . '</td>
                    <td>' . $row["gender"] . '</td>
                    <td>' . $row["quantity"] . '</td>
                </tr>';
            $appointment_count++;
        }
        $output .= '</table>';
        $currentDate = date("y-m-d");
        $filename = 'Animal-Status-' . $currentDate . '.xls';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
    } else {
       header('Location: ../pet-status.php');
        exit();         
    }
}elseif (isset($_POST["status-walkin"])) {
        $currentMonth = date('m');
        $currentYear = date('Y');
        $query = "SELECT *, 
                c.animal_name AS animal_name, 
                c.firstname AS customer_firstname, 
                c.lastname AS customer_lastname, 
                s.firstname AS staff_firstname, 
                s.lastname AS staff_lastname, 
                s.MI AS staff_MI 
        FROM appointment AS app 
        INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no 
        INNER JOIN staff AS s ON app.staff_id = s.staff_id
        WHERE YEAR(app.start_event_date) = $currentYear 
        AND MONTH(app.start_event_date) = $currentMonth";
    
        $excel_result = mysqli_query($connect, $query);
        if (mysqli_num_rows($excel_result) > 0) {
            $output .= '
                <table class="table" border="1">
                    <tr>
                        <th>No</th>
                        <th>Owner</th>
                        <th>Animal Name</th>
                        <th>Doctor in Charge</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Breed</th>
                        <th>Species</th>
                        <th>Sex</th>
                        <th>Quantity</th>
                    </tr>
            ';
            $appointment_count = 1;
            while ($row = mysqli_fetch_array($excel_result)) {
                $output .= '
                    <tr>
                        <td>' . $appointment_count . '</td>
                        <td>' . $row["customer_firstname"] . " " . $row["customer_lastname"] . '</td>
                        <td>' . $row["animal_name"] . '</td>
                        <td>' . $row["staff_firstname"] . " " . $row["staff_lastname"] . '</td>
                        <td>' . $row["appointment_service"] . '</td>
                        <td>' . $row["appointment_status"] . '</td>
                        <td>' . $row["start_event_date"] . '</td>
                        <td>' . $row["end_event_date"] .'</td>
                        <td>' . $row["breed"] . '</td>
                        <td>' . $row["species"] . '</td>
                        <td>' . $row["gender"] . '</td>
                        <td>' . $row["quantity"] . '</td>
                    </tr>';
                $appointment_count++;
            }
            $output .= '</table>';
            $currentDate = date("y-m-d");
            $filename = 'Animal-Status-' . $currentDate . '.xls';
    
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=' . $filename);
            echo $output;
        } else {
           header('Location: ../pet-status.php');
            exit();         
        }
} elseif (isset($_GET["status-pdf"])) {
    $currentYear = date('Y');
    $currentMonth = date('m');
    
    $sql = "SELECT *, a.animal_name AS animal_name, 
                c.firstname AS customer_firstname, 
                c.lastname AS customer_lastname, 
                s.firstname AS staff_firstname,
                s.lastname AS staff_lastname, 
                s.MI AS staff_MI 
          FROM appointment AS app
          INNER JOIN animals AS a ON app.animals_id = a.animals_id
          INNER JOIN customers AS c ON app.customer_id = c.customer_id
          INNER JOIN staff AS s ON app.staff_id = s.staff_id
          WHERE YEAR(app.start_event_date) = $currentYear
          AND MONTH(app.start_event_date) = $currentMonth";


    $result = $connect->query($sql);
    $appointment_count = 1;
    $totalPrice = 0;
    $priceMapping = [
        'checkup' => 100,
        'surgery' => 5000,
        'deworming' => 500,
        'groom' => 300,
        'vaccine' => 300,
        'treatment' => 300,
        // Add more statuses and prices as needed
    ];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('../../assets/img/logo.png', 10, 5, 25);
    // Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 5, 'Animal Haven Veterinary Clinic', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'km. 6 La Trinidad, Benguet', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 20, 'Services Income Records - ' . date('F Y'), 0, 1, 'C');

    // Define column headers
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(5, 6, 'ID', 1);
    $pdf->Cell(20, 6, 'Owner', 1);
    $pdf->Cell(15, 6, 'Animal', 1);
    $pdf->Cell(15, 6, 'Service', 1);
    $pdf->Cell(10, 6, 'Status', 1);
    $pdf->Cell(25, 6, 'Appointment Start', 1);
    $pdf->Cell(25, 6, 'Appointment End ', 1);
    $pdf->Cell(20, 6, 'Breed', 1);
    $pdf->Cell(15, 6, 'Species', 1);
    $pdf->Cell(10, 6, 'Gender', 1);
    $pdf->Cell(10, 6, 'Quantity', 1);
    $pdf->Cell(20, 6, 'Price', 1);
    $pdf->Ln(); // Move to the next line

    // Loop through the query results and add data to the PDF table
    $pdf->SetFont('Arial', '', 6);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(5, 6, $appointment_count, 1);
        $pdf->Cell(20, 6, $row["customer_firstname"] . " " . $row["customer_lastname"], 1);
        $pdf->Cell(15, 6, $row["animal_name"], 1);
        $pdf->Cell(15, 6, $row["appointment_service"], 1);
        $pdf->Cell(10, 6, $row["appointment_status"], 1);
        $pdf->Cell(25, 6, $row["start_event_date"], 1);
        $pdf->Cell(25, 6, $row["end_event_date"], 1);
        $pdf->Cell(20, 6, $row["breed"], 1);
        $pdf->Cell(15, 6, $row["species"], 1);
        $pdf->Cell(10, 6, $row["gender"], 1);
        $pdf->Cell(10, 6, $row["quantity"], 1);

        $appointmentService = $row['appointment_service'];
        $price = 0;

        if (isset($priceMapping[$appointmentService])) {
            $price = $priceMapping[$appointmentService];
            $totalPrice += $price;
            $pdf->Cell(20, 6, number_format($price, 2), 1);
        } else {
            $pdf->Cell(20, 6, 'Unknown Service', 1);
        }

        $doctorMI = $row["staff_MI"];
        $doctorfname = $row["staff_firstname"];
        $doctorlname = $row["staff_lastname"];
        if (!isset($doctorData[$doctorMI][$doctorfname][$doctorlname])) {
            $doctorData[$doctorMI][$doctorfname][$doctorlname] = [
                'appointments' => 0,
                'services' => [],
                'totalPrice' => 0,
                'MI' => $doctorMI,
                'firstname' => $doctorfname,
                'lastname' => $doctorlname,
            ];
        }

        // Update appointment count
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['appointments']++;

        // Track services and prices
        if (!isset($doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService])) {
            $doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService] = 0;
        }
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService]++;
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['totalPrice'] += $price;

        $pdf->Ln(); // Move to the next line
        $appointment_count++;
    }

    $pdf->Output();
}elseif (isset($_GET["Status-PDF-for-walkin"])) {
    $currentYear = date('Y');
    $currentMonth = date('m');  // Use 'm' for numeric representation of the month

    $sql = "SELECT *, 
            c.animal_name AS animal_name, 
            c.firstname AS customer_firstname, 
            c.lastname AS customer_lastname, 
            s.firstname AS staff_firstname, 
            s.lastname AS staff_lastname, 
            s.MI AS staff_MI 
    FROM appointment AS app 
    INNER JOIN walk_in_customers AS c ON app.referral_no = c.referral_no 
    INNER JOIN staff AS s ON app.staff_id = s.staff_id
    WHERE YEAR(app.start_event_date) = $currentYear 
    AND MONTH(app.start_event_date) = $currentMonth";

    $result = $connect->query($sql);
    $appointment_count = 1;
    $totalPrice = 0;
    $priceMapping = [
        'Consultation' => 100,
        'Surgery' => 5000,
        'Deworming' => 500,
        'Grooming' => 300,
        'Vaccination' => 300,
        'Treatment' => 300,
        // Add more statuses and prices as needed
    ];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('../../assets/img/logo.png', 10, 5, 25);
    // Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 5, 'Animal Haven Veterinary Clinic', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, 'km. 6 La Trinidad, Benguet', 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 20, 'Services Income Records - ' . date('F Y'), 0, 1, 'C');

    // Define column headers
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->Cell(5, 6, 'ID', 1);
    $pdf->Cell(20, 6, 'Owner', 1);
    $pdf->Cell(15, 6, 'Animal', 1);
    $pdf->Cell(15, 6, 'Service', 1);
    $pdf->Cell(10, 6, 'Status', 1);
    $pdf->Cell(25, 6, 'Appointment Start', 1);
    $pdf->Cell(25, 6, 'Appointment End ', 1);
    $pdf->Cell(20, 6, 'Breed', 1);
    $pdf->Cell(15, 6, 'Species', 1);
    $pdf->Cell(10, 6, 'Gender', 1);
    $pdf->Cell(10, 6, 'Quantity', 1);
    $pdf->Cell(20, 6, 'Price', 1);
    $pdf->Ln(); // Move to the next line

    // Loop through the query results and add data to the PDF table
    $pdf->SetFont('Arial', '', 6);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(5, 6, $appointment_count, 1);
        $pdf->Cell(20, 6, $row["customer_firstname"] . " " . $row["customer_lastname"], 1);
        $pdf->Cell(15, 6, $row["animal_name"], 1);
        $pdf->Cell(15, 6, $row["appointment_service"], 1);
        $pdf->Cell(10, 6, $row["appointment_status"], 1);
        $pdf->Cell(25, 6, $row["start_event_date"], 1);
        $pdf->Cell(25, 6, $row["end_event_date"], 1);
        $pdf->Cell(20, 6, $row["breed"], 1);
        $pdf->Cell(15, 6, $row["species"], 1);
        $pdf->Cell(10, 6, $row["gender"], 1);
        $pdf->Cell(10, 6, $row["quantity"], 1);

        $appointmentService = $row['appointment_service'];
        if (isset($priceMapping[$appointmentService])) {
            $price = $priceMapping[$appointmentService];
            $totalPrice += $price;
            $pdf->Cell(20, 6, number_format($price, 2), 1);
        } else {
            $price = 0; // Set a default value if the service is unknown
            $pdf->Cell(20, 6, 'Unknown Service', 1);
        }

        $doctorMI = $row["staff_MI"];
        $doctorfname = $row["staff_firstname"];
        $doctorlname = $row["staff_lastname"];
        if (!isset($doctorData[$doctorMI][$doctorfname][$doctorlname])) {
            $doctorData[$doctorMI][$doctorfname][$doctorlname] = [
                'appointments' => 0,
                'services' => [],
                'totalPrice' => 0,
                'MI' => $doctorMI,
                'firstname' => $doctorfname,
                'lastname' => $doctorlname,
            ];
        }

        // Update appointment count
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['appointments']++;

        // Track services and prices
        if (!isset($doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService])) {
            $doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService] = 0;
        }
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['services'][$appointmentService]++;
        $doctorData[$doctorMI][$doctorfname][$doctorlname]['totalPrice'] += $price;

        $pdf->Ln(); // Move to the next line
        $appointment_count++;
    }

    $pdf->Output();
}
?>
