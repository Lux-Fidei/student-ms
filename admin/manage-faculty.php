<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Manage Faculty</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
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
                    <h3 class="page-title"> Manage Faculty </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Manage Faculty</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex align-items-center mb-4">
                                    <h4 class="card-title mb-sm-0">Manage Faculty</h4>
                                    <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Faculty</a>
                                </div>
                                <!-- Search Form -->
                                <form method="post" action="">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search faculty..." name="search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive border rounded p-1">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="font-weight-bold">Faculty ID</th>
                                            <th class="font-weight-bold">Last Name</th>
                                            <th class="font-weight-bold">First Name</th>
                                            <th class="font-weight-bold">Middle Name</th>
                                            <th class="font-weight-bold">Position</th>
                                            <th class="font-weight-bold">Email</th>
                                            <th class="font-weight-bold">Class Advisory</th>
                                            <th class="font-weight-bold">Club Advisory</th>
                                            <th class="font-weight-bold">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $search = isset($_POST['search']) ? $_POST['search'] : '';
                                        $sql = "SELECT f.*, c.ClubName 
                                                FROM tblfaculty f
                                                LEFT JOIN tbl_club c ON f.ID = c.AdviserID
                                                WHERE f.FirstName LIKE :search
                                                OR f.LastName LIKE :search
                                                OR f.MiddleInitial LIKE :search
                                                OR f.position LIKE :search
                                                OR f.Email LIKE :search
                                                OR c.ClubName LIKE :search";
                                        $query = $dbh->prepare($sql);
                                        $search_param = "%$search%";
                                        $query->bindParam(':search', $search_param, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo htmlentities($row->ID); ?></td>
                                                    <td><?php echo htmlentities($row->LastName); ?></td>
                                                    <td><?php echo htmlentities($row->FirstName); ?></td>
                                                    <td><?php echo htmlentities($row->MiddleInitial); ?></td>
                                                    <td><?php echo htmlentities($row->position); ?></td>
                                                    <td><?php echo htmlentities($row->Email); ?></td>
                                                    <td><?php echo htmlentities($row->advisoryClasses) ? htmlentities($row->advisoryClasses) : 'No advisory class'; ?></td>
                                                    <td><?php echo htmlentities($row->ClubName) ? htmlentities($row->ClubName) : 'No club'; ?></td>
                                                    <td>
                                                        <a href="edit-faculty.php?editid=<?php echo htmlentities($row->ID); ?>"><i class="icon-eye"></i></a>
                                                        || 
                                                        <form method="post" action="delete_faculty.php" style="display:inline;">
                                                            <input type="hidden" name="faculty_id" value="<?php echo htmlentities($row->ID); ?>">
                                                            <button type="submit" onclick="return confirm('Do you really want to delete this faculty member?');" style="border:none; background:none;">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="9" class="text-center">No faculty records found</td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
<!-- Plugin js for this page -->
<script src="./vendors/chart.js/Chart.min.js"></script>
<script src="./vendors/moment/moment.min.js"></script>
<script src="./vendors/daterangepicker/daterangepicker.js"></script>
<script src="./vendors/chartist/chartist.min.js"></script>
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<!-- Custom js for this page -->
<script src="./js/dashboard.js"></script>
</body>
</html>
<?php } ?>
