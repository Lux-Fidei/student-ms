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
                  <h5>List of Students
                  </h5>
                  <form method="POST">
                                    <select name="gradelevel">
                                        <option value="">Select Grade Level</option>
                                        <option value="11">Grade 11</option>
                                        <option value="12">Grade 12</option>
                                    </select>
                                    <select name="strand">
                                        <option value="">Select Strand</option>
                                        <?php
                                            $sql = "SELECT course_name FROM tbl_course";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach($results as $result) {
                                                echo '<option value="' . $result->course_name . '">' . $result->course_name . '</option>';
                                            }
                                        ?>
                                    </select>
                                        <button name="submit" type="submit">Search</button>
                                    </form>
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
                      if(isset($_POST['submit']) && $_POST['gradelevel'] !== "" && $_POST['strand'] !== "") {
                          $gradelevel = 13;
                          $query = "SELECT * FROM tblstudent WHERE GradeLevel = :gradelevel AND Strand = :strand AND GradeLevel != :graduatedLevel";
                          $query = $dbh->prepare($query); // Use the grade_level value from the tblstudent table
                          $query->bindParam(':gradelevel',$_POST['gradelevel'],PDO::PARAM_STR);
                          $query->bindParam(':strand',$_POST['strand'],PDO::PARAM_STR);
                          $query->bindParam(':graduatedLevel',$gradelevel,PDO::PARAM_STR);
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
                              echo "<td><a href='#' onclick='goTo()'>View profile</a></td>";
                              $count++;
                              }
                          }
                      } else {
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
                              echo "<td><a href='#' onclick='goTo()'>View Profile</a></td>";
                              $count++;
                              }
                          }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <script>
                  function goTo() {
                    var stuID = event.target.parentNode.parentNode.cells[3].innerText;
                    window.location.href = "./student-profile.php?LRN=" + stuID;
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