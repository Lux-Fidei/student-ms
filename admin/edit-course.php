<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit(); // Add exit to stop further execution
}

// Check if editid parameter is provided
if (!isset($_GET['editid'])) {
    header('location:manage-course.php');
    exit(); // Add exit to stop further execution
}

// Get the course ID from the URL parameter
$course_id = $_GET['editid'];

// Fetch course details from the database
$sql = "SELECT * FROM tbl_course WHERE course_id = :course_id";
$query = $dbh->prepare($sql);
$query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

// Check if course exists
if (!$result) {
    // Redirect to view-courses.php if course does not exist
    header('location:manage-course.php');
    exit(); // Add exit to stop further execution
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $course_name = $_POST['course_name'];
    $course_description = $_POST['course_description'];

    // Update course details in the database
    $sql = "UPDATE tbl_course SET course_name = :course_name, course_description = :course_description WHERE course_id = :course_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':course_name', $course_name, PDO::PARAM_STR);
    $query->bindParam(':course_description', $course_description, PDO::PARAM_STR);
    $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $query->execute();

    // Redirect to view-courses.php after updating
    header('location:manage-course.php');
    exit(); // Add exit to stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                        <h3 class="page-title">Edit Course</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="manage-course.php">View Courses</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Course</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label for="course_name">Course Name</label>
                                            <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo htmlentities($result['course_name']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="course_description">Course Description</label>
                                            <textarea class="form-control" id="course_description" name="course_description" rows="3" required><?php echo htmlentities($result['course_description']); ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Update Course</button>
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
