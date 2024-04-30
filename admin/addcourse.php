<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];
        $date_created = date("Y-m-d H:i:s"); // Current timestamp

        $sql = "INSERT INTO tbl_course (course_name, course_description, date_created) VALUES (:course_name, :course_description, :date_created)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':course_name', $course_name, PDO::PARAM_STR);
        $query->bindParam(':course_description', $course_description, PDO::PARAM_STR);
        $query->bindParam(':date_created', $date_created, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<script>alert("Course added successfully.")</script>';
            echo "<script>window.location.href ='addcourse.php'</script>";
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
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
                        <h3 class="page-title"> Add Course </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Course</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Course</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Course Name</label>
                                            <input type="text" name="course_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Course Description</label>
                                            <textarea name="course_description" class="form-control" required></textarea>
                                        </div>
                                        <!-- Date created is automatically generated -->
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
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
