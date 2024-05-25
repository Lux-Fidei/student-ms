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

                  <div class="card card-secondary" style="padding: 16px">
                    <h4>Student Advisees</h4>
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="font-weight: bold">Name</th>
                          <th>Learner's Reference Number (LRN)</th>
                          <th>Strand</th>
                          <th>Advisor</th>
                          <th style="text-align: center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $uid = $_SESSION['sturecmfacaid'];
                        $sql = "SELECT 
                          LastName,
                          StuID,
                          strand
                          FROM 
                          tblstudent
                          WHERE faculty_id = :uid
                          ORDER BY LastName ASC";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $sql = "SELECT FirstName, LastName FROM tblfaculty WHERE ID = :uid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results2 = $query->fetchAll(PDO::FETCH_OBJ);

                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {
                        ?>
                            <tr>
                                <td style="font-weight: bold"><?php echo htmlentities($row->FirstName) ?></td>
                                <td><?php echo htmlentities($row->StuID); ?></td>
                                <td><?php echo htmlentities($row->strand); ?></td>
                                <td><?php echo htmlentities($results2[0]->FirstName); echo ' '; echo htmlentities($results2[0]->LastName); ?></td>
                                  <td style="text-align: center;">
                                  <button class="btn btn-primary" style="border-radius: 50%; padding: 8px">
                                    <a href="view-profile.php?student_id=<?php echo htmlentities($row->StuID); ?>">
                                      <i class="icon-eye" style="color: white;"></i>
                                    </a>
                                  </button>
                                  </td>
                            </tr>
                        <?php
                            $cnt = $cnt + 1;
                            }
                        }
                        ?>
                      </tbody>
                    </table>
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