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
                    <?php
                      $uid=$_SESSION['sturecmfacaid'];
                      $sql = "SELECT f.FirstName, f.LastName, s.SubjectName, c.course_name, sc.timeslot, sc.building, sc.room
                      FROM schedule sc
                      JOIN tblfaculty f ON sc.faculty_id = f.ID
                      JOIN tblsubjects s ON sc.subject_id = s.SubjectID
                      JOIN tbl_course c ON sc.strand_id = c.course_id;";
                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      foreach($results as $row) {
                        echo '<div>';
                        echo '<div style="margin: 16px">' . $row->FirstName . '</div>';
                        echo '<div style="margin: 16px">' . $row->SubjectName . '</div>';
                        echo '<div style="margin: 16px">' . $row->course_name . '</div>';
                        echo '<div style="margin: 16px">' . $row->timeslot . '</div>';
                        echo '<div style="margin: 16px">' . $row->building . '</div>';
                        echo '<div style="margin: 16px">' . $row->room . '</div>';
                        echo '</div>';
                      }
                    ?>
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