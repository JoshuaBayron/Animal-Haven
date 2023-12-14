<main id="main">

    <!-- ======= Animal Status Section ======= -->
    <section id="pet-status" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Online Customer <span style="font-size:10px">On this page, you can verify online customer accounts. </span></h2>
        </div>

        <div class="d-flex justify-content-end">
          <form method="GET" class="form-inline">
            <div class="form-group">
              <button type="button" style="margin:0" onclick="user()"><i class="bx bx-user"></i></button>
              <button type="button" style="margin:0" onclick="calendar()"><i class="fas fa-calendar"></i></button>
              <button type="button" style="margin:0" onclick="signout()"><i class="fas fa-sign-out-alt"></i></button>
              <button type="submit" ><i class="fas fa-sync-alt"></i></button>
              <input type="text" name="search_query" style="width: 40%;">
              <button type="submit" ><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="row" data-aos="fade-in">
          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
          <div style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">
              <?php include '../tables/customers.php'?>
          </div>

          </div>
        </div>
      </div>
    </section>
    <!-- End Animal Status Section -->
  </main>
  <!-- End #main -->
  <script>
    function openPdfInNewTab() {
    window.open('http://localhost/PawPointment-Final/PawPointment/admin-dashboard/backend/export.php?status-pdf', '_blank');
    }

     // JavaScript to handle the SweetAlert confirmation
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
