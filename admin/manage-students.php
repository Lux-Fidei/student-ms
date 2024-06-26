<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Code for deletion
    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "DELETE FROM tblstudent WHERE ID = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'manage-students.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Manage Students</title>
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
                        <h3 class="page-title"> Manage Students </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Manage Students</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-sm-flex align-items-center mb-4">
                                        <h4 class="card-title mb-sm-0">Manage Students</h4>
                                        <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Students</a>
                                    </div>
                                    <!-- Search Form -->
                                    <form method="post" action="">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search students..." name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table">
                                        <thead>
    <tr>
        <th class="font-weight-bold">Select</th>
        <th class="font-weight-bold">Student ID</th>
        <th class="font-weight-bold">LRN</th>
        <th class="font-weight-bold">Last Name</th>
        <th class="font-weight-bold">First Name</th>
        <th class="font-weight-bold">Middle Name</th>
        <th class="font-weight-bold">Grade Level</th>
        <th class="font-weight-bold">Track/Strand</th>
        <th class="font-weight-bold">Institutional Email</th>
        <th class="font-weight-bold">Admission Date</th>
        <th class="font-weight-bold">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $sql = "SELECT * FROM tblstudent WHERE FirstName LIKE :search OR LastName LIKE :search OR MiddleInitial LIKE :search OR GradeLevel LIKE :search OR Strand LIKE :search OR EmailAddress LIKE :search OR YearAdmitted LIKE :search";
    $query = $dbh->prepare($sql);
    $search_param = "%$search%";
    $query->bindParam(':search', $search_param, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $cnt = 1;
    foreach ($results as $row) {
    ?>
    <tr>
        <td><input type="checkbox" name="selected_students[]" value="<?php echo $row->ID; ?>"></td>
        <td><?php echo htmlentities($cnt); ?></td>
        <td><?php echo htmlentities($row->LRN); ?></td>
        <td><?php echo htmlentities($row->LastName) ?></td>
        <td><?php echo htmlentities($row->FirstName) ?></td>
        <td><?php echo htmlentities($row->MiddleInitial) ?></td>
        <td><?php echo htmlentities($row->GradeLevel) ?></td>
        <td><?php echo htmlentities($row->Strand) ?></td>
        <td><?php echo htmlentities($row->EmailAddress); ?></td>
        <td><?php echo htmlentities($row->YearAdmitted); ?></td>
        <td>
            <div>
                <a href="edit-student-detail.php?editid=<?php echo htmlentities($row->ID); ?>"><i class='icon-eye'></i></a>
                || <a href="delete-student.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');"><i class="icon-trash"></i></a>
            </div>
        </td>
    </tr>
    <?php $cnt = $cnt + 1;
    } ?>
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
