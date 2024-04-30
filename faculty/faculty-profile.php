<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmfacaid']==0)) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || View Faculty Profile</title>
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
                    <h3 class="page-title"> View Faculty Profile </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> View Faculty Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table border="1" class="table table-bordered mg-b-0">
                                    <?php
                                    $fid = $_SESSION['sturecmfacaid'];
                                    $sql = "SELECT * FROM tblfaculty WHERE ID=:fid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':fid', $fid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            ?>
                                            <tr align="center" class="table-warning">
                                                <td colspan="4" style="font-size:20px;color:black">
                                                    Personal Details
                                                </td>
                                            </tr>
                                            <tr class="table-info">
                                                <th>Profile Pics</th>
                                                <td>
                                                    <img src="../admin/images/<?php echo $row->Image; ?>">
                                                </td>
                                                <td>Hi, I'm <?php echo $row->FirstName . " " . $row->LastName; ?>!
                                                </td>
                                            </tr>
                                            <tr class="table-info">
                                                <th>First Name</th>
                                                <td><?php echo $row->FirstName; ?></td>
                                                <th>Last Name</th>
                                                <td><?php echo $row->LastName; ?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <th>Username</th>
                                                <td><?php echo $row->UserName; ?></td>
                                                <th>Email</th>
                                                <td><?php echo $row->Email; ?></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>Age</th>
                                                <td><?php echo $row->Age; ?></td>
                                            <tr class="table-success">
                                                <th>Gender</th>
                                                <td><?php echo $row->Gender; ?></td>
                                                <th>Address</th>
                                                <td><?php echo $row->Address; ?></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <th>Contact</th>
                                                <td><?php echo $row->Contact; ?></td>
                                                <th>Admission Date</th>
                                                <td><?php echo $row->JoiningDate; ?></td>
                                            </tr>
                                            <?php $cnt = $cnt + 1;
                                        }
                                    } ?>
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
