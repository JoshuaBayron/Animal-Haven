<main id="main">

    <!-- ======= Animal Status Section ======= -->
    <section id="pet-status" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Walk-in's Appointments Archive <span style="font-size:10px">On this page, you can restore, and permanently delete walk in appointments. </span></h2>
        </div>

        <div class="d-flex justify-content-end">
          <form method="GET" class="form-inline">
            <div class="form-group">
              <button type="button" style="margin:0" onclick="user()"><i class="bx bx-user"></i></button>
              <button type="button" style="margin:0" onclick="calendar()"><i class="fas fa-calendar"></i></button>
              <button type="button" style="margin:0" onclick="signout()"><i class="fas fa-sign-out-alt"></i></button>
              <button type="submit" style="margin:0"><i class="fas fa-sync-alt"></i></button>
              <input type="text" style="width: 40%; margin:0"  name="search_query" >
              <button type="submit" style="margin:0"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="row" data-aos="fade-in">
          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
          <div style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">
              <?php include '../tables/walkin-archive.php'?>
          </div>

          </div>
        </div>

        <div class="d-flex justify-content-end">
        <button onclick="window.location.href='walk-in.php'" style="color:#E1D9D1;"><i class="fas fa-arrow-left" style="color: #E1D9D1;"></i></button>
        </div>

      </div>
    </section>
    <!-- End Animal Status Section -->
  </main>
  <!-- End #main -->
  <script>

var button = document.getElementById('redirectButton');


button.addEventListener('click', function() {

  var destinationURL = 'login-form/add-appointment.php';

  // Redirect to the specified URL
  window.location.href = destinationURL;
});
function openPdfInNewTab() {
    window.open('http://localhost/PawPointment-Final/PawPointment/admin-dashboard/backend/export.php?Status-PDF-for-walkin', '_blank');
}

document.addEventListener('DOMContentLoaded', () => {
        const deleteLinks = document.querySelectorAll('.custom-button1');

        deleteLinks.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                const animals_id = link.getAttribute('data-id');
                confirmDelete(animals_id);
            });
        });

        function confirmDelete(animals_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to delete.php with the record ID
                    window.location.href = `backend/archive_pet.php?animals_id=${animals_id}`;
                }
            });
        }
    });
    <?= include 'redirect.js';?>
</script>