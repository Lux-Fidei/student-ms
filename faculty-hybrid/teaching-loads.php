<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmfacaid']==0)) {
  header('location:logout.php');
} else{
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Faculty Management System || Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./style.css">
    <!-- End layout styles -->
   
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                  <div class="card-body">
                    <form method="post" action="">
                      <div class="form-group">
                        <label for="faculty">Select Faculty:</label>
                        <select class="form-control" id="faculty" name="faculty">
                          <option value="">Select Faculty</option>
                          <option value="">Faculty 1</option>
                          <option value="">Faculty 2</option>
                          <option value="">Faculty 3</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Subject:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select subject</option>
                          <option value="">subject 1</option>
                          <option value="">subject 2</option>
                          <option value="">subject 3</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Strand:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select strand</option>
                          <option value="">strand 1</option>
                          <option value="">strand 2</option>
                          <option value="">strand 3</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Timeslot:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select Timeslot</option>
                          <option value="">Timeslot 1</option>
                          <option value="">Timeslot 2</option>
                          <option value="">Timeslot 3</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Building:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select Building</option>
                          <option value="">Building 1</option>
                          <option value="">Building 2</option>
                          <option value="">Building 3</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Room:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select Room</option>
                          <option value="">Room 1</option>
                          <option value="">Room 2</option>
                          <option value="">Room 3</option>
                        </select>
                      </div>
                      <div class="form-group text-right">
                        <button class="btn btn-primary">Add Handle</button>
                        <button class="btn btn-primary">Done</button>
                      </div>
                      <div class="form-group text-right">
                        <button class="btn btn-primary">SEND</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
        <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>

<?php }  ?>
