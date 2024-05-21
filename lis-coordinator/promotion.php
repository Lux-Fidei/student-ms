<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmlisid']==0)) {
    header('location:logout.php');
} else {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Student  Management System || Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
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
                <div class="content-wrapper" style="margin-top: 64px">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                <div>
                                    <div style="display: flex; margin-bottom: 8px">
                                        <div style="margin: 0">Name of Students</div>
                                        <?php
                                            if(isset($_POST['strand']) && $_POST['strand'] !== "") {
                                                $sql = 'SELECT course_name from tbl_course WHERE course_name=:strand';
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':strand',$_POST['strand'],PDO::PARAM_STR);
                                                $query->execute();
                                                $result = $query->fetch(PDO::FETCH_ASSOC);
                                                echo '(' . $result['course_name'] . '):';
                                            } else {
                                                echo '(All Strand):';
                                            }
                                        ?>
                                    </div>
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
                                                echo "<td><a href='#' onclick='goTo()'>View Grade Slip</a></td>";
                                                $count++;
                                                }
                                            }
                                        } else {
                                            $gradelevel = 13;
                                            $query = "SELECT * FROM tblstudent WHERE GradeLevel !=:graduatedLevel";
                                            $query = $dbh->prepare($query); // Use the grade_level value from the tblstudent table
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
                                                echo "<td><a href='#' onclick='goTo()'>View Grade Slip</a></td>";
                                                $count++;
                                                }
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        .content-wrapper {
                        background-image: url(images/admin.jpg);
                        background-repeat: no-repeat;
                        background-size: cover;
                        padding: 2.75rem 1.5rem 0;
                        width: 100%;
                        -webkit-box-flex: 1;
                        -ms-flex-positive: 1;
                        flex-grow: 1;
                        }
                        </style>
                   
                    
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
               
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script>
        function goTo() {
                    var stuID = event.target.parentNode.parentNode.cells[3].innerText;
                    window.location.href = "view-grade-slip.php?LRN=" + stuID;
                  }
    </script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>
<?php }  ?>
