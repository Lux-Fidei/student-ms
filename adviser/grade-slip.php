<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmfacaid']==0)) {
  header('location:logout.php');
} else  {
?>

<!DOCTYPE html>
<html>
<head>
  <title>Faculty Management System || Gradeslip</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
  <link rel="stylesheet" href="./style.css">
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
            <div class="card card-secondary"  style="border-radius: 8px">
              <div class="card-body">
                <h1 style="margin-bottom: 16px">Grade Slip</h1>
                <div class="form-group">
                  <label for="faculty"  style="margin-bottom: 16px">Select Grade Level:</label>
                  <select class="form-control" id="subject" name="subject" onchange="filterTable()">
                    <option value="">Select Grade Level</option>
                    <option value="11">Grade 11</option>
                    <option value="12">Grade 12</option>
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
                  (<?php echo htmlentities($row->assignedStrand); ?>):
                  </h5>
                  <table id="studentTable">
                    <thead>
                      <tr>
                        <td></td>
                        <th style="width: 192px"><span>First Name</span></th>
                        <th style="width: 192px"><span>Last Name</span></th>
                        <th style="width: 192px" data-toggle="tooltip" data-placement="top" title="Learner's Reference Number"><span>LRN</span></th>
                        <th style="width: 192px"><span>email</span></th>
                        <th style="width: 192px"><span>Action</span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "SELECT * FROM tblstudent";
                      $query = $dbh->prepare($query); // Use the grade_level value from the tblstudent table
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      if ($query->rowCount() > 0) {
                        $count = 1;
                        foreach($results as $row) {
                          echo "<tr class='data' data-section='" . $row->GradeLevel . "'>";
                          echo "<td>" . $count . ".&nbsp;&nbsp;</td>";
                          echo "<td>" . $row->FirstName . "</td>";
                          echo "<td>" . $row->LastName . "</td>";
                          echo "<td>" . $row->LRN . "</td>";
                          echo "<td>" . $row->EmailAddress . "</td>";
                          echo "<td><a href='#' onclick='goTo()'>View Grade Slip</a></td>";
                          $count++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <script>
                  function goTo() {
                    var stuID = event.target.parentNode.parentNode.cells[3].innerText;
                    window.location.href = "view-grade-slip.php?LRN=" + stuID;
                  }
                  function filterTable() {
                    var gradeLevel = document.getElementById("subject").value;
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
    </div>
    <?php include_once('includes/footer.php');?>
    
  </div>
</body>
</html>

<?php }  ?>