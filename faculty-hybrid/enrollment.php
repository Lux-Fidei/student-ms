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
                <div class="card card-secondary"  style="border-radius: 12px">
                  <?php
                    if(isset($_POST['submit']))
                    {
                          $section = $_POST['section'];
                          $class_id = $_POST['classes'];
                          $query = $dbh->prepare("SELECT * FROM enrollments WHERE section = :section AND class_id = :class_id");
                          $query->bindParam(':section', $section,PDO::PARAM_STR);
                          $query->bindParam(':class_id', $class_id,PDO::PARAM_STR);
                          $query->execute();
                          $results = $query->fetchAll(PDO::FETCH_OBJ);
                          if ($query->rowCount() > 0) {
                            echo "<div class='alert alert-danger' role='alert'>Section already enrolled in this class!</div>";
                          } else {
                            $query = $dbh->prepare("INSERT INTO enrollments (section, class_id) VALUES (:section, :class_id)");
                            $query->bindParam(':section', $section,PDO::PARAM_STR);
                            $query->bindParam(':class_id', $class_id,PDO::PARAM_STR);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if ($lastInsertId) {
                              echo "<div class='alert alert-success' role='alert'>Section enrolled successfully!</div>";
                            } else {
                              echo "<div class='alert alert-danger' role='alert'>Error enrolling section!</div>";
                            }
                          }
                    };
                  ?>
                  <form method="post">
                    <div class="card-body" style="display: flex; flex-direction: row">
                      <div style="margin-right: 16px; width: 32%;">
                        <h5 style="margin-bottom: 16px">Section</h5>
                        <select class="form-control" id="section" name="section" onchange="filterTable()">
                          <option value="">Select Section</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div style="margin-right: 16px; width: 32%;">
                        <h5 style="margin-bottom: 16px">Classes</h5>
                        <select class="form-control" id="classes" name="classes">
                          <option value="">Select Class</option>
                          <?php
                            $queryStrand = "SELECT course_id FROM tbl_course WHERE course_name = :course_name";
                            $query = $dbh->prepare($queryStrand);
                            $query->bindParam(':course_name', $row->assignedStrand, PDO::PARAM_STR);
                            $query->execute();
                            $strandResult = $query->fetchAll(PDO::FETCH_OBJ);
                            $queryClass = "SELECT s.SubjectName, sch.timeslot, sch.days, sch.schedule_id FROM schedule sch JOIN tblsubjects s ON sch.subject_id = s.SubjectID WHERE sch.strand_id = :strand_id";
                            $query2 = $dbh->prepare($queryClass);
                            $query2->bindParam(':strand_id', $strandResult[0]->course_id, PDO::PARAM_STR);
                            $query2->execute();
                            $classResult = $query2->fetchAll(PDO::FETCH_OBJ);
                            if ($query2->rowCount() > 0) {
                              foreach($classResult as $row) {
                                echo "<option value='" . $row->schedule_id . "'>" . $row->SubjectName . "</option>";
                              }
                            } else {
                              echo "<option value=''>No classes found!</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div>
                        <h5>Name of Students
                          <?php
                            $uid = $_SESSION['sturecmfacaid'];
                            $sql = "SELECT * FROM tblfaculty WHERE ID=:uid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                          ?>
                        (<?php echo htmlentities($results[0]->assignedStrand); ?>):
                        </h5>
                        <table id="studentTable">
                          <thead>
                            <tr>
                              <td></td>
                              <th style="width: 192px"><span>First Name</span></th>
                              <th style="width: 192px"><span>Last Name</span></th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $query = "SELECT * FROM tblstudent WHERE Strand=:strand";
                              $query = $dbh->prepare($query);
                              $query->bindParam(':strand', $results[0]->assignedStrand, PDO::PARAM_STR); // Use the assignedStrand value from the faculty table
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              if ($query->rowCount() > 0) {
                                $count = 1;
                                foreach($results as $row) {
                                  echo "<tr class='data' data-section='" . $row->section . "'>";
                                  echo "<td>" . $count . ".&nbsp;&nbsp;</td>";
                                  echo "<td>" . $row->FirstName . "</td>";
                                  echo "<td>" . $row->LastName . "</td>";
                                  $count++;
                                }
                              } else {
                                echo "<tr><td colspan='3'>No students found!</td></tr>";
                              }
                            ?>
                            <div id="noStudentsFound" style="display: none">No students found!</div>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div style="margin: 0 16px 16px 16px; display: flex; justify-content: right">
                        <input type="hidden" name="submit" value="true">
                        <button type="submit" class="btn btn-primary mr-2">Enroll</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once('includes/footer.php');?>
    </div>
      <script>
        function filterTable() {
          var section = document.getElementById("section").value;
          var rows = document.getElementsByClassName("data");
          for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var rowSection = row.getAttribute("data-section");
            if (section === "" || rowSection === section) {
            row.style.display = "table-row";
            } else {
            row.style.display = "none";
            }
          }
        }
      </script>
    </body>
  </html>
<?php }  ?>