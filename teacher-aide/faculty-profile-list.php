<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmtaid']==0)) {
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
  <link rel="stylesheet" href="./css/style.css">
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
                <h1 style="margin-bottom: 16px">View Profiles</h1>
                <div>
                  <h5>List of Faculty
                  </h5>
                  <table id="studentTable">
                    <thead>
                      <tr>
                        <td></td>
                        <th style="width: 192px"><span>First Name</span></th>
                        <th style="width: 192px"><span>Middle Initial</span></th>
                        <th style="width: 192px"><span>Last Name</span></th>
                        <th style="width: 192px" data-toggle="tooltip" data-placement="top" title="Learner's Reference Number"><span>User Account ID</span></th>
                        <th style="width: 192px"><span>Email</span></th>
                        <th style="width: 192px"><span>Action</span></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $query = "SELECT * FROM tblfaculty";
                      $query = $dbh->prepare($query); // Use the grade_level value from the tblstudent table
                      $query->execute();
                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                      if ($query->rowCount() > 0) {
                          $count = 1;
                          foreach($results as $row) {
                          echo "<tr class='data' data-section='" . $row->position . "'>";
                          echo "<td>" . $count . ".&nbsp;&nbsp;</td>";
                          echo "<td>" . $row->FirstName . "</td>";
                          echo "<td>" . $row->MiddleInitial . "</td>";
                          echo "<td>" . $row->LastName . "</td>";
                          echo "<td>" . $row->UserAccountID . "</td>";
                          echo "<td>" . $row->Email . "</td>";
                          echo "<td><a href='#' onclick='goTo()'>View Profile</a></td>";
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
                    window.location.href = "./faculty-profile.php?UserAccountID=" + stuID;
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