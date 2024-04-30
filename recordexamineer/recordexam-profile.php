<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['record_examineer_id']) == 0) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Record Examineer Management System || View Examineer Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css"/>

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
                    <h3 class="page-title"> View Examineer Profile </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> View Examineer Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table border="1" class="table table-bordered mg-b-0">
                                    <tr align="center" class="table-warning">
                                        <td colspan="4" style="font-size:20px;color:black">
                                            Personal Details
                                        </td>
                                    </tr>
                                    <?php
                                    $eid = $_SESSION['record_examineer_id'];
                                    $sql = "SELECT re.*, c.course_name 
                                            FROM tbl_record_examineer re 
                                            LEFT JOIN tbl_course c ON re.course_id = c.course_id
                                            WHERE ID=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $row = $query->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <tr class="table-info">
                                        <th>Profile Pics</th>
                                        <td>
                                            <img src="../admin/images/<?php echo $row['image']; ?>">
                                        </td>
                                        <td>Hi, I'm <?php echo $row['fname']; ?>!
                                        </td>
                                    </tr>
                                    <tr class="table-info">
                                        <th>Name</th>
                                        <td><?php echo $row['fname']; ?></td>
                                        <th>Email</th>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr class="table-warning">
                                        <th>Username</th>
                                        <td><?php echo $row['uname']; ?></td>
                                        <th>Strand</th>
                                        <td><?php echo $row['course_name']; ?></td>
                                    </tr>
                                    <tr class="table-danger">
                                        <th>Age</th>
                                        <td><?php echo $row['age']; ?></td>
                                        <th>Gender</th>
                                        <td><?php echo $row['gender']; ?></td>
                                    </tr>
                                    <tr class="table-success">
                                        <th>Address</th>
                                        <td><?php echo $row['address']; ?></td>
                                        <th>Contact</th>
                                        <td><?php echo $row['contact']; ?></td>
                                    </tr>
                                    
                                    <!-- Add more rows for additional attributes if needed -->
                                </table>
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
<script src="vendors/select2/select2.min.js"></script>
<script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="js/typeahead.js"></script>
<script src="js/select2.js"></script>
<!-- End custom js for this page -->
</body>
</html>
<?php } ?>
