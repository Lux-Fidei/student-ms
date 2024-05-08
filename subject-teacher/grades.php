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
    <title>Faculty Management System || Grades</title>
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
                <div class="card card-secondary" style="border-radius: 16px; padding: 16px">
                  <span class="d-lg-flex align-items-center justify-content-center">
                    Filipino
                  </span>
                  <span class="d-lg-flex justify-content-center">
                    1st Semester, SY 2022 - 2023
                  </span>
                  <div class="d-lg-flex justify-content-between">
                    <span>ICT 12-1</span>
                    <span>08:00 - 10:00</span>
                  </div>
                  <div style="display: flex; justify-content: center; margin: 16px 0">
                    <table style="width: 96%">
                      <thead>
                        <tr>
                          <th style="width: 40%">Student List:</th>
                          <th>1st Quarter</th>
                          <th>2nd Quarter</th>
                          <th>Final Average</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>John Doe</td>
                          <td>90</td>
                          <td>85</td>
                          <td>87.5</td>
                        </tr>
                        <tr>
                          <td>Jane Doe</td>
                          <td>85</td>
                          <td>90</td>
                          <td>87.5</td>
                        </tr>
                        <tr>
                          <td>John Smith</td>
                          <td>80</td>
                          <td>85</td>
                          <td>82.5</td>
                        </tr>
                        <tr>
                          <td>Jane Smith</td>
                          <td>85</td>
                          <td>90</td>
                          <td>87.5</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div style="display: flex; justify-content: flex-end">
                    <button class="btn btn-primary ">Send</button>
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