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
                            $UnsectionedStudents = $dbh->prepare("SELECT COUNT(*) FROM tblstudent WHERE section IS NULL");
                            $UnsectionedStudents->execute();
                            $results = $UnsectionedStudents->fetchAll(PDO::FETCH_OBJ);
                            if ($results[0]->{'COUNT(*)'} < 0) {
                              echo "<div class='alert alert-danger' role='alert'>All Students have Sections!!!</div>";
                            } else {
                              $getSection = $dbh->prepare("SELECT MAX(section) AS max_section FROM tblstudent");
                              $getSection->execute();
                              $currectSection = $getSection->fetch(PDO::FETCH_OBJ);
                              $section = intval($currectSection->max_section) + 1;
                              $setSection = $dbh->prepare("UPDATE tblstudent SET section=:section WHERE section IS NULL");
                              $setSection->bindParam(':section', $section, PDO::PARAM_STR);
                              if ($setSection->execute()) {
                                echo "<div class='alert alert-success' role='alert'>Section added successfully!</div>";
                              } else {
                                echo "<div class='alert alert-danger' role='alert'>Error adding section!</div>";
                              }
                            }
                      };
                    ?>
                    <form method="post">
                      <div class="card-body" style="display: flex; flex-direction: row">
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
                          <button type="submit" class="btn btn-primary mr-2">Set Section</button>
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
    </body>
  </html>
<?php }  ?>