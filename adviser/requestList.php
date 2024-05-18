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
  
    <title>Student  Management System|||Dashboard</title>
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
                <div class="card card-secondary" style="padding: 16px">
                  <h4>Request List</h4>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Name of Requester</th>
                        <th>Purpose</th>
                        <th>Date of Request</th>
                        <th style="text-align: center">Approve</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Add your PHP code here to fetch and display the data from the database -->
                      <?php
                      // Mock data for demonstration purposes
                      $mockData = [
                        ['John Doe', 'Request for Leave', '2022-08-15'],
                        ['Jane Smith', 'Request for Transcript', '2022-08-16'],
                        ['Michael Johnson', 'Request for Course Change', '2022-08-17'],
                        ['Emily Davis', 'Request for Scholarship', '2022-08-18'],
                        ['David Wilson', 'Request for Internship', '2022-08-19']
                      ];

                      foreach ($mockData as $data) {
                        echo "<tr>";
                        echo "<td>".$data[0]."</td>";
                        echo "<td>".$data[1]."</td>";
                        echo "<td>".$data[2]."</td>";
                        echo "<td style='text-align: center'><a href='#'><i class='icon-check'></i></a></td>";
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
          </div>
          <!-- partial -->
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php');?>
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
</html><?php }  ?>