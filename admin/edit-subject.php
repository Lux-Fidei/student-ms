<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $subjectid = $_GET['id']; // Get subject ID from URL
        $subjectname = $_POST['subjectname'];
        $subjecttype = $_POST['subjecttype'];
        $sql = "UPDATE tblsubjects SET SubjectName=:subjectname, subject_type=:subjecttype WHERE SubjectID=:subjectid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->bindParam(':subjecttype', $subjecttype, PDO::PARAM_STR);
        $query->bindParam(':subjectid', $subjectid, PDO::PARAM_INT);
        if ($query->execute()) {
            echo '<script>alert("Subject details updated successfully.")</script>';
            echo "<script>window.location.href ='add-subject.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }

    // Fetch subject details based on subject ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tblsubjects WHERE SubjectID=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo "<script>alert('Invalid subject ID.');</script>";
            echo "<script>window.location.href ='add-subject.php'</script>";
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Subject</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
                        <h3 class="page-title">Edit Subject</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="add-subject.php">Add Subject</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Subject</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Subject Name</label>
                                            <input type="text" name="subjectname" value="<?php echo $result['SubjectName']; ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName2">Subject Type</label>
                                            <select class="form-control" name="subjecttype" required>
                                                <option value="Core" <?php if ($result['subject_type'] == 'Core') echo 'selected'; ?>>Core</option>
                                                <option value="Specialized" <?php if ($result['subject_type'] == 'Specialized') echo 'selected'; ?>>Specialized</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Include footer -->
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>
    <!-- Include JS files -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
