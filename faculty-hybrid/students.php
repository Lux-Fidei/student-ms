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
                  <div class="card-body">
                    <h5>Sports Grade Level: </h5>
                    <Select class="form-control" id="section" name="Grade-level" onchange="filterTable()" style="margin-bottom: 16px">
                      <option value="">Select Grade Level</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </Select>
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
                    (<?php echo htmlentities($row->assignedStrand); ?>):
                    </h5>
                    <table id="studentTable">
                      <caption>List of Students</caption>
                      <thead>
                        <tr>
                          <td></td>
                          <th style="width: 192px"><span>First Name</span></th>
                          <th style="width: 192px"><span>Last Name</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $query = "SELECT * FROM tblstudent";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':gradeLevel', $row->grade_level, PDO::PARAM_STR); // Use the grade_level value from the tblstudent table
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                          $count = 1;
                          foreach($results as $row) {
                            echo "<tr class='data' data-section='" . $row->grade_level . "'>";
                            echo "<td>" . $count . ".&nbsp;&nbsp;</td>";
                            if (strpos($row->StudentName, ' ') !== false) {
                              list($firstName, $lastName) = explode(" ", $row->StudentName, 2);
                            } else {
                              $firstName = $row->StudentName;
                              $lastName = "";
                            }
                            echo "<td>" . $firstName . "</td>";
                            echo "<td>" . $lastName . "</td>";
                            $count++;
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <script>
                    function filterTable() {
                      var gradeLevel = document.getElementById("section").value;
                      var rows = document.getElementsByClassName("data");
                      for (var i = 0; i < rows.length; i++) {
                        var row = rows[i];
                        var rowGradeLevel = row.getAttribute("data-section");
                        if (gradeLevel === "" || rowGradeLevel === gradeLevel) {
                          row.style.display = "table-row";
                        } else {
                          row.style.display = "none";
                        }
                      }
                    }
                  </script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </body>
  </html>
<?php } ?>