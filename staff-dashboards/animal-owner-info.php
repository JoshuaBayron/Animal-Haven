<?php 
include 'backend/crude.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

  <main id="main">
    <section id="owners" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Clients Information</h2>
        </div>
          <div class="d-flex justify-content-end">
            <form method="GET" class="form-inline">
              <div class="form-group">
                <input type="text" name="search_query" placeholder="Search by animal name, dates, service..." style="width: 70%;">
                <button type="submit" ><i class="fas fa-search"></i></button>
              </div>
            </form>
          </div>
          
          <div class="row" data-aos="fade-in">
            <div class="mt-5 mt-lg-0 d-flex align-items-stretch">
              <div style="width: 100%; max-height: 430px; overflow-x: auto; overflow-y: auto;">
                <?php 
                  include '../tables/clients.php';
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>

    </section>

  </main>
<?php 
include 'includes/footer.php';
?>