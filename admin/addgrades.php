<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $stuid = $_POST['stuid'];
        $subject = $_POST['subject'];
        $first_grading = $_POST['first_grading'];
        $second_grading = $_POST['second_grading'];
        $semester = $_POST['semester'];
        $faculty = $_POST['faculty'];
        $units = $_POST['units'];

        $sql = "INSERT INTO tblgrades (StuID, Subject, FirstGrading, SecondGrading, Semester, Faculty, Units) 
                VALUES (:stuid, :subject, :first_grading, :second_grading, :semester, :faculty, :units)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':first_grading', $first_grading, PDO::PARAM_STR);
        $query->bindParam(':second_grading', $second_grading, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':faculty', $faculty, PDO::PARAM_STR);
        $query->bindParam(':units', $units, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Grades added successfully.")</script>';
        echo "<script>window.location.href ='add-grades.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Grades</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- Include CSS for Add Faculty form -->
    <link rel="stylesheet" href="path/to/add-faculty.css">
    <!-- Custom Styles -->
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
                        <h3 class="page-title">Add Grades</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Grades</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Add Grades Form -->
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" name="addgrades">
                                        <div class="form-group">
                                            <label for="stuid">Student ID</label>
                                            <input type="text" class="form-control" id="stuid" name="stuid" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="first_grading">1st Grading</label>
                                            <input type="text" class="form-control" id="first_grading" name="first_grading" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="second_grading">2nd Grading</label>
                                            <input type="text" class="form-control" id="second_grading" name="second_grading" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <input type="text" class="form-control" id="semester" name="semester" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="faculty">Faculty</label>
                                            <input type="text" class="form-control" id="faculty" name="faculty" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="units">Units</label>
                                            <input type="text" class="form-control" id="units" name="units" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
</body>
</html>
