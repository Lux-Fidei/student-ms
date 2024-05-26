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
  
    <title>Student Management System | Dashboard</title>
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
                  <span style="color: maroon;font-size: 17px;font-weight: bold;font-family: 'Times New Roman', Times, serif;">MINDANAO STATE UNIVERSITY</span>
                  <span  style="color: black;font-size: 17px; font-family: 'Times New Roman', Times, serif;;">SENIOR HIGH SCHOOL</span>
         <span style="text-align: left;margin: 0;font-size: 14px; font-weight: 300;  font-family: Arial, Helvetica, sans-serif;">Marawi City</span>
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <hr style="border-color:black; border:1px solid #80d8a8; margin: 16px 0 0 0; width: 99.3%" />
              </div>
              <div>
                <hr style="border-color:black; border:3px solid #80d8a8; margin-top: 4px; width: 99%" />
              </div>

              <?php
                  if (isset($_POST['submit'])) {
                    $queryRE = "SELECT id FROM tbl_record_examineer WHERE strand = :strand";
                    $query = $dbh->prepare($queryRE);
                    $query->bindParam(':strand', $results[0]->Strand, PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    $query = "INSERT INTO `request_docs`(`st_id`, `re_id`, `docName`, `isApproved`) VALUES (:st_id, :re_id, 'COR', 'Pending')";
                    $query = $dbh->prepare($query);
                    $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                    $query->bindParam(':re_id', $result[0]->id, PDO::PARAM_STR);
                    $query->execute();
                  }
                ?>
                <?php
                $query = "SELECT isApproved FROM request_docs WHERE st_id=:st_id AND docName='COR'";
                $query = $dbh->prepare($query);
                $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                if (isset($result['isApproved']) && $result['isApproved'] === 'Approved') { ?>
                  <div>
                    <h1 style="text-align: center; margin-bottom: 0">CERTIFICATE OF REGISTRATION</h1>
                    <p style="text-align: center; font-weight: bold">First Semester, School Year 2023 - 2024</p>

                    <div style="display: flex; justify-content: center;">
                      <div style="width: 44%; display: flex">
                        <div style="margin-right: 32px">
                          <div style="font-weight: bold">Name</div>
                          <div style="font-weight: bold">LRN</div>
                          <div style="font-weight: bold">Grade & Section</div>
                        </div>
                        <div>
                            <div style="font-weight: bold"><?php echo $results[0]->FirstName . ' ' . $results[0]->MiddleInitial . ' ' . $results[0]->LastName ?></div>
                            <div><?php echo $results[0]->LRN ?></div>
                            <div><?php echo $results[0]->GradeLevel . ' - ' . $results[0]->section ?></div>
                        </div>
                      </div>
                      <div style="width: 44%; display: flex">
                        <div style="margin-right: 32px">
                          <div style="font-weight: bold">Track & Strand</div>
                          <div style="font-weight: bold">E-mail Add.</div>
                          <div style="font-weight: bold">Contact No.</div>
                        </div>
                        <div style="margin-right: 32px">
                          <div style="font-weight: bold"><?php echo $results[0]->Strand ?></div>
                            <div><?php echo $results[0]->EmailAddress ?></div>
                            <div><?php echo $results[0]->ContactNo ?></div>
                        </div>
                      </div>
                    </div>
                    <div style="display: flex; justify-content: center">
                      <table style="border: 1px solid black; width: 88%; margin-top: 16px">
                        <thead>
                          <tr>
                            <th style="padding: 24px 16px; text-align: center">COURSE CODE</th>
                            <th style="padding: 24px 16px; text-align: center">COURSE DESCRIPTION</th>
                            <th style="padding: 24px 16px; text-align: center">UNITS</th>
                            <th style="padding: 24px 16px; text-align: center">DAY</th>
                            <th style="padding: 24px 16px; text-align: center">TIME</th>
                            <th style="padding: 24px 16px; text-align: center">ROOM</th>
                            <th style="padding: 24px 16px; text-align: center">INSTRUCTOR</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                              $sql = "SELECT 
                              s.SubjectName,
                              s.subject_description,
                              s.units,
                              sch.days,
                              sch.timeslot,
                              sch.room,
                              f.FirstName,
                              f.MiddleInitial,
                              f.LastName
                              FROM 
                              schedule sch
                              JOIN 
                              tblsubjects s ON sch.subject_id = s.SubjectID
                              JOIN 
                              tblfaculty f ON sch.faculty_id = f.ID;";
                              $query = $dbh->prepare($sql);
                              $query->execute();
                              $subjectResults = $query->fetchAll(PDO::FETCH_OBJ);

                              $cnt = 1;
                              foreach ($subjectResults as $row) {
                                echo "<tr style='border: 1px solid black'>";
                                echo "<td style='font-weight: bold; padding: 8px 0 8px 16px'>" . $row->SubjectName . "</td>";
                                echo "<td>" . $row->subject_description . "</td>";
                                echo "<td style='font-weight: bold; text-align: center'>" . $row->units . "</td>";
                                echo "<td style='text-align: center'>" . $row->days . "</td>";
                                echo "<td>" . $row->timeslot . "</td>";
                                echo "<td style='text-align: center'>" . $row->room . "</td>";
                                echo "<td>" . $row->FirstName . ' ' . $row->MiddleInitial . '. ' . $row->LastName . "</td>";
                                echo "</tr>";
                              }
                            ?>
                        </tbody>
                      </table>
                    </div>
                    
                    <br />

                  <div style="display: flex; flex-direction: row;">
                    <div style="width: 50%; text-align: center">
                      <span>Certified by:</span>
                      <div style="margin-top: 40px; font-weight: bold"><?php
                        $query = "SELECT FirstName, LastName FROM tblfaculty WHERE assignedStrand = :strand;";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':strand', $results[0]->Strand, PDO::PARAM_STR);
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_ASSOC);
                        echo $result['FirstName'] . ' ' . $result['LastName'];
                      ?></div>
                      <div style="font-weight: bold">Adviser</div>
                    </div>
                    <div style="width: 50%; text-align: center">
                      <span>Approved by:</span>
                      <div style="margin-top: 40px; font-weight: bold">
                        <?php
                          $position = 'Chairperson';
                          $query = "SELECT FirstName, LastName FROM tblfaculty WHERE assignedStrand = :strand and position =:position;";
                          $query = $dbh->prepare($query);
                          $query->bindParam(':strand', $results[0]->Strand, PDO::PARAM_STR);
                          $query->bindParam(':position', $position, PDO::PARAM_STR);
                          $query->execute();
                          $result = $query->fetch(PDO::FETCH_ASSOC);
                          echo $result['FirstName'] . ' ' . $result['LastName'];
                        ?>
                      </div>
                      <div style="font-weight: bold"></div>
                      <div style="font-weight: bold"><?php echo $results[0]->Strand ?> Chairperson</div>
                    </div>
                  </div>
                  <div style="font-style: italic">&nbsp;</div>
                  <div style="font-style: italic">&nbsp;</div>
                  <div style="font-style: italic">&nbsp;</div>
                  <div style="font-style: italic">&nbsp;</div>
                  <div style="font-style: italic">&nbsp;</div>
                  <div style="font-style: italic">Student's Copy</div>
                </div>
                <?php } else if (isset($result['isApproved']) && $result['isApproved'] === 'Pending'){ ?>
                  <p style="text-align: center">Your request is still Pending</p>
                <?php } else { ?>
                  <form method="post" action="viewCOR.php" style="display: flex; justify-content: center">
                    <input type="hidden" name="submit" value="1">
                    <button class="btn btn-primary mb-3" type="submit"> Request View for COR </button>
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