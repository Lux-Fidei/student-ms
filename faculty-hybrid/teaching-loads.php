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
                          $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
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
                        <select class="form-control" id="subject" name="subject" >

                          <option value="">Select Subject</option>
                          <?php
                          $uid=$_SESSION['sturecmfacaid'];
                          $sql="SELECT * from tblsubjects";
                          $query = $dbh -> prepare($sql);
                          $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0)
                          {
                          foreach($results as $row)
                          { ?>
                          <option value="<?php echo htmlentities($row->SubjectName);?>"><?php echo htmlentities($row->SubjectName);?> (<?php echo htmlentities($row->units)?> Units)</option>
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
                          $query-> bindParam(':uid', $uid, PDO::PARAM_STR);
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
                            var selectedSubject = document.getElementById("subject").value;
                            var units = selectedSubject[selectedSubject[selectedSubject.indexOf("(") + 1]];
                            var timeslots = [];
                            if (units == 3) {
                              timeslots = ["8:00 AM - 10:00 AM", "10:00 AM - 12:00 PM", "1:00 PM - 3:00 PM"];
                            } else if (units == 2) {
                              timeslots = ["8:00 AM - 10:00 AM", "10:00 AM - 12:00 PM", "1:00 PM - 3:00 PM", "3:00 PM - 5:00 PM"];
                            } else if (units == 1) {
                              timeslots = ["8:00 AM - 10:00 AM", "10:00 AM - 12:00 PM", "1:00 PM - 3:00 PM", "3:00 PM - 5:00 PM", "5:00 PM - 7:00 PM"];
                            }

                            for (var i = 0; i < timeslots.length; i++) {
                              var option = document.createElement("option");
                              option.text = timeslots[i];
                              option.value = timeslots[i];
                              document.getElementById("timeslot").appendChild(option);
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
                        <button class="btn btn-primary">Add Handle</button>
                        <button class="btn btn-primary" type="submit">SEND</button>
                      </div>
                    </form>
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
