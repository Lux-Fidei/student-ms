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
                <form method="post">
                  <span class="d-lg-flex align-items-center justify-content-center">
                    <?php
                      $uid=$_SESSION['sturecmfacaid'];
                      $class_id = $_POST['class'];
                      $sql = "SELECT 
                      sub.SubjectName,
                      sub.SubjectID,
                      c.course_name AS Strand,
                      sub.grade_level,
                      sub.Semester,
                      sub.Units,
                      e.section,
                      e.class_id,
                      sch.timeslot,
                      sch.faculty_id
                      FROM 
                      enrollments e
                      JOIN 
                      schedule sch ON e.class_id = sch.schedule_id
                      JOIN 
                      tblsubjects sub ON sch.subject_id = sub.SubjectID
                      JOIN 
                      tbl_course c ON sch.strand_id = c.course_id
                      JOIN 
                      tblfaculty f ON sch.faculty_id = f.ID WHERE
                      sch.faculty_id = :faculty_ID AND sch.schedule_id = :schedule_id;";
                      $query = $dbh -> prepare($sql);
                      $query->bindParam(':faculty_ID', $uid, PDO::PARAM_STR);
                      $query->bindParam(':schedule_id', $class_id, PDO::PARAM_STR);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                      foreach($results as $row)
                      {
                    ?>
                    <?php echo htmlentities($row->SubjectName)?>
                  </span>
                  <span class="d-lg-flex justify-content-center">
                    <?php
                    $currentMonth = date('m');
                    if ($currentMonth >= 8 && $currentMonth <= 12) {
                      echo '1st Semester';
                    } else {
                      echo '2nd Semester';
                    }
                    ?>, S.Y. <?php echo (date('Y') - 1). ' - ' . (date('Y')); ?>
                  </span>
                  <div style="display: flex; justify-content: center">
                    <div class="d-lg-flex justify-content-between" style="width: 80%">
                      <span><?php echo htmlentities($row->Strand) . ' ' . htmlentities($row->grade_level) . '-' . htmlentities($row->section)?></span>
                      <span><?php echo htmlentities($row->timeslot)?></span>
                    </div>
                  </div>
                  
                  <div style="display: flex; justify-content: center; margin: 16px 0; ">
                    <table style="width: 88%">
                      <thead>
                        <tr>
                          <th style="width: 40%">Student List:</th>
                          <th>1st Quarter</th>
                          <th>2nd Quarter</th>
                          <th>Final Average</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql2 = "
                            SELECT CONCAT(s.LastName, ', ',s.FirstName, ' ', s.MiddleInitial) AS FullName, s.ID, e.class_id
                            FROM tblstudent s JOIN enrollments e ON s.section = e.section
                            WHERE s.section = :section AND e.class_id = :class_id
                            ORDER BY FullName ASC;
                          ";
                          $query = $dbh->prepare($sql2);
                          $query->bindParam(':section', $row->section, PDO::PARAM_STR);
                          $query->bindParam(':class_id', $row->class_id, PDO::PARAM_STR);
                          $query->execute();
                          $results2 = $query->fetchAll(PDO::FETCH_OBJ);
                          foreach($results2 as $row2) {
                        ?>
                        <tr>
                          <td><?php echo htmlentities($row2->FullName) ?></td>
                          <td>
                            <input id="<?php echo $row->ID; ?>" type="number" step="0.01" min="1" max="100" name="<?php echo 'fg' . $row2->ID; ?>" onchange="updateAverage(this)">
                          </td>
                          <td><input id="<?php echo $row2->ID; ?>" type="number" step="0.01" min="1" max="100" name="<?php echo 'sg' . $row2->ID; ?>" onchange="updateAverage(this)"></td>
                          <td><input id="<?php echo $row->ID; ?>" type="number" step="0.01" min="1" max="100" name="<?php echo 'ag' . $row2->ID; ?>" disabled>
                          <input type="hidden" name="<?php echo 'id' . $row2->ID; ?>" value="<?php echo $row2->ID; ?>">
                          <input type="hidden" name="<?php echo 'fd' . $row2->ID; ?>" value="<?php echo $uid; ?>">
                          <input type="hidden" name="<?php echo 'sd' . $row2->ID; ?>" value="<?php echo $row->SubjectID; ?>">
                          <input type="hidden" name="<?php echo 'sr' . $row2->ID; ?>" value="<?php echo $row->Semester; ?>">
                          <input type="hidden" name="<?php echo 'un' . $row2->ID; ?>" value="<?php echo $row->Units; ?>">
                          </td>
                        </tr>
                        <?php } ?>
                        <input type="hidden" name="id" value="<?php
                          $sql4 = "SELECT MIN(ID) AS SmallestID FROM tblstudent";
                          $query4 = $dbh->prepare($sql4);
                          $query4->execute();
                          $smallestID = $query4->fetch(PDO::FETCH_OBJ);
                          echo htmlentities($smallestID->SmallestID);
                        ?>">
                      </tbody>
                    </table>
                  <script>
                    function updateAverage(input) {
                      var tr = input.parentElement.parentElement;
                        var fg = parseFloat(tr.children[1].children[0].value);
                        var sg = parseFloat(tr.children[2].children[0].value);
                        console.log(fg);
                        var ag = tr.children[3].children[0];
                      if (isNaN(fg) || isNaN(sg)) {
                        ag.value = '';
                      } else {
                        ag.value = ((fg + sg) / 2).toFixed(2);
                      }
                    }
                  </script>
                  <?php }?>
                  </div>
                  <?php
                    if(isset($_POST['submit'])) {
                        for($i = 0; $i < ((count($_POST) - 2))/7; $i++) {
                        $sid = $_POST['sd'.($_POST['id'] + $i)];
                        $id = $_POST['id'.($_POST['id'] + $i)];
                        $fd = $_POST['fd'.($_POST['id'] + $i)];
                        $fg = $_POST['fg'.($_POST['id'] + $i)];
                        $sg = $_POST['sg'.($_POST['id'] + $i)];
                        $sr = $_POST['sr'.($_POST['id'] + $i)];
                        $un = $_POST['un'.($_POST['id'] + $i)];

                        $sql3 = "INSERT INTO tblgrades (StuID, Faculty, Subject, Semester, Units, FirstGrading, SecondGrading) VALUES (:id, :fd, :sid, :sr, :un, :fg, :sg)";
                        $query = $dbh->prepare($sql3);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->bindParam(':fd', $fd, PDO::PARAM_STR);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->bindParam(':sr', $sr, PDO::PARAM_STR);
                        $query->bindParam(':un', $un, PDO::PARAM_STR);
                        $query->bindParam(':fg', $fg, PDO::PARAM_STR);
                        $query->bindParam(':sg', $sg, PDO::PARAM_STR);
                        $query->execute();
                      }
                      if ($query->rowCount() > 0) {
                        echo "<script>alert('Grades successfully added!');</script>";
                      } else {
                        echo "<script>alert('Failed to add grades!');</script>";
                      }
                    }
                  ?>
                  <div style="display: flex; justify-content: flex-end">
                    <button class="btn btn-primary" type="submit" name="submit">Send</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
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
<?php } ?>