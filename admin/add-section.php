<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $section = $_POST['section'];

        // Prepare the SQL query to insert data into the tbl_section table
        $sql = "INSERT INTO tbl_section (Section) VALUES (:section)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':section', $section, PDO::PARAM_STR);

        // Execute the SQL query
        $query->execute();

        // Check if data insertion was successful
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Section has been added.")</script>';
            echo "<script>window.location.href ='add-section.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System || Add Section</title>
    <!-- Include CSS and other necessary files here -->
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
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
    <!-- Include header -->
    <?php include_once('includes/header.php');?>

    <div class="container-fluid page-body-wrapper">
        <!-- Include sidebar -->
        <?php include_once('includes/sidebar.php');?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Section </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Section</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Add Section</h4>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputSection">Section</label>
                                        <input type="text" name="section" class="form-control" placeholder="Enter Section" required="true">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Table to display added sections -->
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List of Added Sections</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                    <thead>
    <tr>
        <th>Section ID</th>
        <th>Section Name</th>
        <th>Action</th> <!-- New column for action buttons -->
    </tr>
</thead>
<tbody>
    <?php
    $sql = "SELECT * FROM tbl_section";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $row) {
            ?>
            <tr>
                <td><?php echo htmlentities($cnt); ?></td>
                <td><?php echo htmlentities($row->Section); ?></td>
                <td>
                    <a href="edit-section.php?id=<?php echo htmlentities($row->ID); ?>" class="btn btn-info btn-sm">Edit</a>
                    <a href="delete-section.php?id=<?php echo htmlentities($row->ID); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?')">Delete</a>
                </td>
            </tr>
            <?php
            $cnt++;
        }
    } else {
        ?>
        <tr>
            <td colspan="3">No sections found</td>
        </tr>
        <?php
    }
    ?>
</tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- Include footer -->
            <?php include_once('includes/footer.php');?>
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
