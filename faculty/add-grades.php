<?php
session_start();
include('includes/dbconnection.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Get form data
    $lrn = $_POST['lrn'];
    $subject = $_POST['subject'];
    $first_grading = $_POST['first_grading'];
    $second_grading = $_POST['second_grading'];
    $semester = $_POST['semester'];
    $officer = $_POST['officer']; // Updated to receive faculty ID
    $units = $_POST['units'];

    // Check if the student ID exists
    $sql = "SELECT * FROM tblstudent WHERE StuID = :lrn";
    $query = $dbh->prepare($sql);
    $query->bindParam(':lrn', $lrn, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result) {
        // Insert grades into the database
        $sql = "INSERT INTO tblgrades (StuID, Subject, FirstGrading, SecondGrading, Semester, Faculty, Units) 
                VALUES (:lrn, :subject, :first_grading, :second_grading, :semester, :officer, :units)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':lrn', $lrn, PDO::PARAM_STR);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':first_grading', $first_grading, PDO::PARAM_STR);
        $query->bindParam(':second_grading', $second_grading, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':officer', $officer, PDO::PARAM_INT); // Assuming Faculty ID is an integer
        $query->bindParam(':units', $units, PDO::PARAM_INT);
        
        if($query->execute()) {
            echo "<script>alert('Grades sent successfully to the student');</script>";
        } else {
            echo "<script>alert('Failed to send grades');</script>";
        }
    } else {
        echo "<script>alert('Student with LRN $lrn does not exist');</script>";
    }
}

if (strlen($_SESSION['sturecmfacaid'] == 0)) {
    header('location:logout.php');
} else {
    // Fetch faculty members' information from the database
    $sql = "SELECT ID, CONCAT(FirstName, ' ', LastName) AS FullName FROM tblfaculty";
    $query = $dbh->prepare($sql);
    $query->execute();
    $facultyList = $query->fetchAll(PDO::FETCH_ASSOC);
    
    $sql = "SELECT * FROM tblsemesters";
    $query = $dbh->prepare($sql);
    $query->execute();
    $semesters = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Dashboard</title>
    <!-- plugins:css -->
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
        <!-- Include header -->
        <?php include_once('includes/header.php');?>
        <!-- Include sidebar -->
        <?php include_once('includes/sidebar.php');?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center mb-4">Add Grades</h4>
                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputName1">LRN</label>
                                        <input type="text" name="lrn" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Subject</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">1st Grading</label>
                                        <input type="text" name="first_grading" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">2nd Grading</label>
                                        <input type="text" name="second_grading" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Semester</label>
                                        <select class="form-control" name="semester" required>
                                            <option value="">Select Semester</option>
                                            <?php foreach ($semesters as $semester) { ?>
                                                <option value="<?php echo $semester['SemesterName']; ?>"><?php echo $semester['SemesterName']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Officer</label>
                                        <select class="form-control" name="officer" required>
                                            <option value="">Select Officer</option>
                                            <?php foreach ($facultyList as $faculty) { ?>
                                                <option value="<?php echo $faculty['ID']; ?>"><?php echo $faculty['FullName']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Units</label>
                                        <input type="text" name="units" class="form-control" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                                    </div>
                                </form>
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

<?php }  ?>
