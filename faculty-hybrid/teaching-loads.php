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
                          <?php
                          $uid=$_SESSION['sturecmfacaid'];
                          $sql="SELECT * from tblfaculty";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0)
                          {
                          foreach($results as $row)
                          { ?>
                          <option value="<?php echo htmlentities($row->ID);?>"><?php echo htmlentities($row->FirstName);?> <?php echo htmlentities($row->LastName);?></option>
                          <?php }} ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Subject:</label>
                        <select class="form-control" id="subject" name="subject" onchange="updateTimeslot()">
                          <option value="">Select Subject</option>
                          <?php
                          $uid=$_SESSION['sturecmfacaid'];
                          $sql="SELECT * from tblsubjects";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0)
                          {
                          foreach($results as $row)
                          { ?>
                          <option value="<?php echo htmlentities($row->SubjectName); echo '('; echo htmlentities($row->units); echo ' units)'?>"><?php echo htmlentities($row->SubjectName);?> (<?php echo htmlentities($row->units)?> Units)</option>
                          <?php }} ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Strand:</label>
                        <select class="form-control" id="subject" name="subject">
                          <option value="">Select strand</option>
                          <?php
                          $uid=$_SESSION['sturecmfacaid'];
                          $sql="SELECT * from tbl_course";
                          $query = $dbh -> prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0)
                          {
                          foreach($results as $row)
                          { ?>
                          <option value="<?php echo htmlentities($row->course_name);?>"><?php echo htmlentities($row->course_name);?></option>
                          <?php }} ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="timeslot">Select Timeslot:</label>
                        <select class="form-control" id="timeslot" name="timeslot">
                          <option value="">Select Timeslot</option>
                          <script>
                            function updateTimeslot() {
                              var selectedSubject = document.getElementById("subject").value;
                              var selectedSubjectUnits = selectedSubject[selectedSubject.indexOf("(") + 1];
                              var timeslot = document.getElementById("timeslot");
                              timeslot.innerHTML = "";
                              if (selectedSubjectUnits == 3) {
                                var option = document.createElement("option");
                                option.text = "Select Timeslot";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "7:30 - 9:00";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "9:00 - 10:30";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "10:30 - 12:00";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "1:00 - 2:30";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "2:30 - 4:00";
                                timeslot.add(option);
                              } else if (selectedSubjectUnits == 2) {
                                var option = document.createElement("option");
                                option.text = "Select Timeslot"
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "7:30 - 9:00";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "9:00 - 10:30";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "10:30 - 12:00";
                                timeslot.add(option);
                              } else if (selectedSubjectUnits == 1) {
                                var option = document.createElement("option");
                                option.text = "Select Timeslot";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "7:30 - 9:00";
                                timeslot.add(option);
                                option = document.createElement("option");
                                option.text = "9:00 - 10:30";
                                timeslot.add(option);
                              } else {
                                var option = document.createElement("option");
                                option.text = "No TimeSlot Available";
                                timeslot.add(option);
                              }
                            }
                          </script>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Building:</label>
                        <input type="text" class="form-control" id="building" name="building" required="true">
                      </div>
                      <div class="form-group">
                        <label for="faculty">Select Room:</label>
                        <input type="text" class="form-control" id="room" name="room" required="true">
                      </div>
                      <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit">Add Schedule</button>
                      </div>
                    </form>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Faculty</th>
                          <th>Subject</th>
                          <th>Strand</th>
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
                          JOIN tbl_course c ON sc.strand_id = c.course_id;";
                          $query = $dbh->prepare($sql);
                          $query->execute();
                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                          foreach($results as $row) {
                            echo '<tr>';
                            echo '<td>' . $row->FirstName . '</td>';
                            echo '<td>' . $row->SubjectName . '</td>';
                            echo '<td>' . $row->course_name . '</td>';
                            echo '<td>' . $row->timeslot . '</td>';
                            echo '<td>' . $row->building . '</td>';
                            echo '<td>' . $row->room . '</td>';
                            echo '</tr>';
                          }
                        ?>
                      </tbody>
                    </table>
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
