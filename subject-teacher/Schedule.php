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
      <?php include_once('includes/header.php');?>
      <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php');?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary">
                  <div class="card-body">
                    <h1>Schedule</h1>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Subject Name</th>
                          <th>Course Name</th>
                          <th>Timeslot</th>
                          <th>Building</th>
                          <th>Room</th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                      $uid=$_SESSION['sturecmfacaid'];
                      $sql = "SELECT f.FirstName, f.LastName, s.SubjectName, c.course_name, sc.timeslot, sc.building, sc.room
                      FROM schedule sc
                      JOIN tblfaculty f ON sc.faculty_id = f.ID
                      JOIN tblsubjects s ON sc.subject_id = s.SubjectID
                      JOIN tbl_course c ON sc.strand_id = c.course_id
                      WHERE sc.faculty_id = :faculty_ID;";
                      $query = $dbh->prepare($sql);
                      $query->bindParam(':faculty_ID', $uid, PDO::PARAM_STR);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      if (count($results) == 0) {
                        echo "<tr><td colspan='6' style='text-align: center'>No scheduled subjects</td></tr>";
                      } else {
                        foreach($results as $row) {
                          echo "<tr>";
                          echo "<td>".$row->FirstName. ' ' . $row-> LastName . "</td>";
                          echo "<td>".$row->SubjectName."</td>";
                          echo "<td>".$row->course_name."</td>";
                          echo "<td>".$row->timeslot."</td>";
                          echo "<td>".$row->building."</td>";
                          echo "<td>".$row->room."</td>";
                          echo "</tr>";
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
        </div>
      </div>
    </div>
  </body>
</html>

<?php }  ?>