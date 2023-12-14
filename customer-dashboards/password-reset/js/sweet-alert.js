<script>
$(document).ready(function() {
    $("#staff").on("submit", function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "../backend/update.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: response.success,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Handle specific error messages here
                    var errorMessage = response.message;
                    
					if (errorMessage.includes("Staff ID are not in the Table")) {
                        errorMessage = "staff ID not found";
                    } else if (errorMessage.includes("Error updating admin record")) {
                        errorMessage = "Update failed";
                    } else if (errorMessage.includes("Error updating staff record")) {
                        errorMessage = "Update Failed";
                    } else if (errorMessage.includes("Error adding staff record")) {
                        errorMessage = "Adding Failed";
                    }
                    
                    Swal.fire({
                        title: 'Error',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred: ' + error,
                    icon: 'error',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>