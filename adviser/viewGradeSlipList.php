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
                  <p style="font-weight: bold">1st Semester, S.Y. 2023 - 2024</p>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th><a href="?sort=name&order=<?php echo ($_GET['sort'] == 'name' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Student Name</a></th>
                        <th><a href="?sort=units&order=<?php echo ($_GET['sort'] == 'units' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Total Units <i class="sort-down"></i></a></th>
                        <th><a href="?sort=subject1&order=<?php echo ($_GET['sort'] == 'subject1' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Subject 1</a></th>
                        <th><a href="?sort=subject2&order=<?php echo ($_GET['sort'] == 'subject2' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Subject 2</a></th>
                        <th><a href="?sort=subject3&order=<?php echo ($_GET['sort'] == 'subject3' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Subject 3</a></th>
                        <th><a href="?sort=average&order=<?php echo ($_GET['sort'] == 'average' && $_GET['order'] == 'asc') ? 'desc' : 'asc'; ?>">Final Average</a></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Write code here to fetch student data from the database and populate the table rows
                      $students = [
                        ['name' => 'Jane Smith', 'units' => 12, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)],
                        ['name' => 'Michael Johnson', 'units' => 15, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)],
                        ['name' => 'Emily Davis', 'units' => 14, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)],
                        ['name' => 'Daniel Wilson', 'units' => 16, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)],
                        ['name' => 'Olivia Martinez', 'units' => 13, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)],
                        ['name' => 'William Anderson', 'units' => 17, 'subject1' => rand(70, 100), 'subject2' => rand(70, 100), 'subject3' => rand(70, 100), 'average' => rand(70, 100)]
                      ];

                      // Sort the students array based on the query parameters 'sort' and 'order'
                      $sort = $_GET['sort'] ?? 'name';
                      $order = $_GET['order'] ?? 'asc';
                      if ($order == 'asc') {
                        usort($students, function ($a, $b) use ($sort) {
                          return $a[$sort] <=> $b[$sort];
                        });
                      } else {
                        usort($students, function ($a, $b) use ($sort) {
                          return $b[$sort] <=> $a[$sort];
                        });
                      }

                      foreach ($students as $student) {
                        echo "<tr>";
                        echo "<td>" . $student['name'] . "</td>";
                        echo "<td>" . $student['units'] . "</td>";
                        if ($student['subject1'] < 75) {
                          echo "<td style='color:red'>" . $student['subject1'] . "%" . "</td>";
                        } else {
                          echo "<td>" . $student['subject1'] . "%" . "</td>";
                        }
                        if ($student['subject2'] < 75) {
                          echo "<td style='color:red'>" . $student['subject2'] . "%" . "</td>";
                        } else {
                          echo "<td>" . $student['subject2'] . "%" . "</td>";
                        }
                        if ($student['subject3'] < 75) {
                          echo "<td style='color:red'>" . $student['subject3'] . "%" . "</td>";
                        } else {
                          echo "<td>" . $student['subject3'] . "%" . "</td>";
                        }
                        if ($student['average'] < 75) {
                          echo "<td style='color:red'>" . $student['average'] . "%" . "</td>";
                        } else {
                          echo "<td>" . $student['average'] . "%" . "</td>";
                        }
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                  <div style="display: flex; justify-content: right; margin: 16px 0 0 0">
                    <button class="btn btn-primary" style="border-radius: 32px">SEND</button>
                  </div>
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