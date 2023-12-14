<main id="main">

    <!-- ======= Staff Section ======= -->
    <section id="staff" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Staff Information <span style="font-size:10px">On this page, you can edit, delete, and register staff. </span></h2>
        </div>

        <div class="d-flex justify-content-end">
          <form method="GET" class="form-inline">
            <div class="form-group">
              <button type="button" style="margin:0" id="redirectButton"><i class="fas fa-plus"></i> Add Staff</button>
              <button type="button" style="margin:0" onclick="user()"><i class="bx bx-user"></i></button>
              <button type="button" style="margin:0" onclick="calendar()"><i class="fas fa-calendar"></i></button>
              <button type="button" style="margin:0" onclick="signout()"><i class="fas fa-sign-out-alt"></i></button>
              <button type="submit" style="margin:0"><i class="fas fa-sync-alt"></i></button>
              <input type="text" style="width: 30%; margin:0"  name="search_query">
              <button type="submit" style="margin:0"><i class="fas fa-search"></i></button>
            </div>
          </form>
        </div>

        <div class="row" data-aos="fade-in">
          <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
            <div style="width: 100%; height:430px; overflow: auto;">
              <?php include '../tables/staff.php'?>
            </div>
          </div>
        </div>

    </div>
  </section>
      <!-- End Staff Section -->
  
  </main>
  <!-- End #main -->
  <script>

  var button = document.getElementById('redirectButton');


  button.addEventListener('click', function() {

    var destinationURL = 'login-form/add-staff.php';

    // Redirect to the specified URL
    window.location.href = destinationURL;
  });

<?= include 'redirect.js';?>

</script>