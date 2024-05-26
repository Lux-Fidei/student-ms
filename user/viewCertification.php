<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
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
    <link rel="stylesheet" href="./css/style.css">
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
        <button onclick="window.print()" class="print-button">
        <i class="glyphicon glyphicon-print"></i> PRINT
    </button>
          <div class="content-wrapper" style="display: flex; justify-content: center">
            <div class="row purchace-popup" style="width: 80%">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary" style="padding: 16px; border-radius: 16px">
                <div class="header" style="padding: 16px 16px 0 16px; display: flex; flex-direction: row">
                <div>
                  <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo" width="96px" style="margin-right: 32px">
                  <img src="images/MSU-Marawi.png" alt="Logo" width="96px" style="margin-right: 16px">
                </div>
                <div style="display: flex; flex-direction: column; justify-content: center">
                  <span>Republic of the Philippines</span>
                  <span style="color: #5f1227;">MINDANAO STATE UNIVERSITY</span>
                  <span  style="color: #055727;">SENIOR HIGH SCHOOL</span>
                  <span>Marawi City</span>
                </div>
                
              </div>
              <div>
                <hr style="border-color:black; border:1px solid gold; margin-top: 4px; width: 100%" />
              </div>
                
              <?php
                  if (isset($_POST['submit'])) {
                    $query = "INSERT INTO `request_docs`(`st_id`, `re_id`, `docName`, `isApproved`) VALUES (:st_id, :re_id, 'Certification', 'Pending')";
                    $query = $dbh->prepare($query);
                    $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                    $query->bindParam(':re_id', $_SESSION['record_examineer_id'], PDO::PARAM_STR);
                    $query->execute();
                  }
                ?>
                <?php
                $query = "SELECT isApproved FROM request_docs WHERE st_id=:st_id AND docName='Certification'";
                $query = $dbh->prepare($query);
                $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                if (isset($result['isApproved']) && $result['isApproved'] === 'Approved') { ?>
                  <div>
                    <h1 style="text-align: center">CERTIFICATION</h1>
                    <div style="display: flex; justify-content: center;">
                      <img src="./../admin/images/<?php echo htmlentities($results[0]->Image)?>" alt="someone" style="border: 1px solid black; margin: 32px 0" width="192" height="192">
                    </div>
                    <div style="display: flex; justify-content: center">
                      <p style="width: 72%; text-align: justify"> &emsp;&emsp;&emsp;This is to certify that based on the available in this school,<strong> <?php echo $results[0]->FirstName . ' ' . $results[0]->MiddleInitial . ' ' . $results[0]->LastName ?></strong>, with LRN <?php echo $results[0]->LRN ?>, is officially enrolled as a<strong> <?php echo $results[0]->GradeLevel ?> student</strong> under the <strong><?php echo $results[0]->Strand ?> strand</strong> this first semester, academic year 2023 – 2024.</p>
                    </div>
                    
                    <br />
                    <div style="display: flex; justify-content: center">
                      <p style="width: 72%; text-align: justify">&emsp;&emsp;&emsp;This certification is issued on <?php echo date('F d, Y'); ?> upon the request of Mr. <?php
                      echo htmlentities($results[0]->LastName);
                      ?> in support of his registration for a scholarship.</p>
                      
                    </div>

                  <div style="display: flex; flex-direction: column; align-items: center">
                  <p class="prepared">Prepared by</p>
                    <br />
                    <br />
                  <p class="chairperson" style="font-weight: bold; margin-bottom: 0">
                    <?php
                      $query = "SELECT FirstName, LastName FROM tblfaculty WHERE position = 'Chairperson' AND assignedStrand = '{$results[0]->Strand}'";
                      $query = $dbh->prepare($query);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_ASSOC);

                      if ($result) {
                        echo $result['FirstName'] . ' ' . $result['LastName'];
                      } else {
                        echo 'Chairperson not found';
                      }
                    ?>
                  <p class="position font-italic"><?php echo $results[0]->Strand; ?> Track Chairperson</p>
                    <br />
                    <br />
                  <p class="approved">Approved by</p>
                    <br />
                    <br />
                  <p class="director" style="font-weight: bold; margin-bottom: 0">Junaina M. Dimalna, MAELT</p>  
                  <p class="position font-italic">Director</p>
                  </div>
                </div>
                <?php } else if (isset($result['isApproved']) && $result['isApproved'] === 'Pending'){ ?>
                  <p style="text-align: center">Your request is still Pending</p>
                <?php } else { ?>
                  <form method="post" action="viewCertification.php" style="display: flex; justify-content: center">
                    <input type="hidden" name="submit" value="1">
                    <button class="btn btn-primary mb-3" type="submit"> Request View for Certification </button>
                    
                  </form>
                <?php } ?>
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