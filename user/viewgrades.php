<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
} else {
    // Fetch grades for the logged-in student
    $studentID = $_SESSION['sturecmsaid'];
    $sql = "SELECT * FROM tblgrades WHERE StuID = :studentID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentID', $studentID, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || View Grades</title>
    <!-- Include CSS and other necessary files here -->
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
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> View Grades </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> View Grades</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="font-weight-bold">Subject</th>
                                                    <th class="font-weight-bold">First Grading</th>
                                                    <th class="font-weight-bold">Second Grading</th>
                                                    <th class="font-weight-bold">Semester</th>
                                                    <th class="font-weight-bold">Faculty</th>
                                                    <th class="font-weight-bold">Units</th>
                                                    <th class="font-weight-bold">Total Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($results as $row): ?>
                                                    <tr>
                                                        <td><?php echo $row['Subject']; ?></td>
                                                        <td><?php echo $row['FirstGrading']; ?></td>
                                                        <td><?php echo $row['SecondGrading']; ?></td>
                                                        <td><?php echo $row['Semester']; ?></td>
                                                        <td><?php echo $row['Faculty']; ?></td>
                                                        <td><?php echo $row['Units']; ?></td>
                                                        <td><?php echo $row['FirstGrading'] * $row['Units'] + $row['SecondGrading'] * $row['Units']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Pagination code -->
                                    <?php
                                    // Code for pagination
                                    // Add pagination logic here
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include_once('includes/footer.php'); ?>
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
