<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
<?php
require_once 'connection.php';
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $roles = $_POST["roles"];
    
    switch ($roles) {
        case "admin":
            functionUpdateAdmin($conn);
            break;

        case "add-contacts":
            functionAdminContact($conn);
            break;

        case "add-staff":
            functionAddStaff($conn);
            break;
            
        case "add-address":
            functionAddAddress($conn);
            break;
        
        case "add-customer-information":
            functionAddConInfo($conn);
            break;
            
        case "add-walk-in-pet":
            functionAddWalkIn($conn);
            break;

        case "add-services":
            functionaddDescription($conn);
            break;

        case "add-schedule":
            functionaddSchedule($conn);
            break;
            
        case "update-staff":
            functionEditStaff($conn);
            break;

        case "update-status":
            functionUpdateStatus($conn);
            break;
        
        case "update-status-for-walkin":
            functionUpdateStatusforWalkin($conn);
            break;

        case "update-services":
            functionUpdateServices($conn);
            break;
        
        case "schedule-appointment":
            functionScheduleAppointment($conn);
            break;

        case "send-reset-password":
            functionResetPasswordforStaff($conn);
            break;
            
        default:
            errorMessage("Invalid Role!");
            break;
    }
}else if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $role = $_GET["role"];

    switch ($role) {
        case "delete-staff":
            functionDeleteStaff($conn);
            break;

        case "delete-status":
            functionDeleteStatus($conn);
            break;

        case "delete-contact":
            functionDeleteContact($conn);
            break;
        
        case "delete-address":
            functionDeleteAddress($conn);
            break;
        
        case "delete-services":
            functionDeleteServices($conn);
            break;
            
        case "archivingAppointment":
            archiveAppointments($conn);
            break;
            
        case "restoreAppointment":
            restoreAppointments($conn);
            break;
        
        case "deleteAppointment":
            deleteAppointment($conn);
            break;
            
        case "approve":
            approveStatus($conn);
            break;
        
        case "cancel":
            cancelStatus($conn);
            break;

        case "unverifyEmail":
            unverifyEmail($conn);
            break;

        case "verifyEmail":
            verifyEmail($conn);
            break;

        default:
            errorMessage("Invalid Role!");
            break;
    }
}else {
    errorMessage("Invalid Request!");
}

$conn->close();
?>
