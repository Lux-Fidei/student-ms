<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
    header('location:logout.php');
} else {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- End layout styles -->
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include_once('includes/header.php');?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include_once('includes/sidebar.php');?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                <div class="page-header">
                          <h3 class="page-title"> Update Students </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Update Students</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Update Students</h4>
                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <?php
                                        $eid = $_GET['editid'];
                                        $sql = "SELECT * FROM tblstudent WHERE ID=:eid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) {
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Last Name</label>
                                        <input type="text" name="stulname" value="<?php echo htmlentities($row->LastName); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">First Name</label>
                                        <input type="text" name="stufname" value="<?php echo htmlentities($row->FirstName); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Middle Initial</label>
                                        <input type="text" name="stumname" value="<?php echo htmlentities($row->MiddleInitial); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Gender</label>
                                        <select name="gender" class="form-control" required='true'>
                                            <option value="">Choose Gender</option>
                                            <option value="Male" <?php if($row->Gender == 'Male') echo 'selected'; ?>>Male</option>
                                            <option value="Female" <?php if($row->Gender == 'Female') echo 'selected'; ?>>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Age</label>
                                        <input type="number" name="age" value="<?php echo htmlentities($row->Age); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Date of Birth</label>
                                        <input type="date" name="dob" value="<?php echo htmlentities($row->DOB); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Place of Birth</label>
                                        <input type="text" name="pob" value="<?php echo htmlentities($row->PlaceOfBirth); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Current Address</label>
                                        <input type="text" name="curaddress" value="<?php echo htmlentities($row->CurrentAddress); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Permanent Address</label>
                                        <input type="text" name="peraddress" value="<?php echo htmlentities($row->PermanentAddress); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Contact Number</label>
                                        <input type="text" name="connum" value="<?php echo htmlentities($row->ContactNo); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Email Address</label>
                                        <input type="email" name="email" value="<?php echo htmlentities($row->EmailAddress); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Strand</label>
                                        <input type="text" name="strand" value="<?php echo htmlentities($row->Strand); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Grade Level</label>
                                        <input type="text" name="gradelevel" value="<?php echo htmlentities($row->GradeLevel); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">LRN</label>
                                        <input type="text" name="lrn" value="<?php echo htmlentities($row->LRN); ?>" class="form-control" required='true'>
                                    </div>
                                    <div class="form-group">
                                            <label for="exampleInputName1">School Last Attended</label>
                                            <input type="text" name="school_last_attended" value="<?php echo htmlentities($row->SchoolLastAttended); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Father's Name</label>
                                            <input type="text" name="fathername" value="<?php echo htmlentities($row->FatherName); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Father's Contact Number</label>
                                            <input type="text" name="father_contact_number" value="<?php echo htmlentities($row->FatherContactNumber); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Mother's Name</label>
                                            <input type="text" name="mothername" value="<?php echo htmlentities($row->MotherName); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Mother's Contact Number</label>
                                            <input type="text" name="mother_contact_number" value="<?php echo htmlentities($row->MotherContactNumber); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Emergency Contact Number</label>
                                            <input type="text" name="emergency_contact_number" value="<?php echo htmlentities($row->EmergencyContactNumber); ?>" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <img src="images/<?php echo htmlentities($row->Image);?>" width="100" height="100" value="<?php echo htmlentities($row->Image);?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Year Admitted</label>
                                            <input type="text" name="year_admitted" value="<?php echo htmlentities($row->YearAdmitted); ?>" class="form-control" required='true'>
                                        </div>
                                        <!-- Add other input fields similarly -->
                                        <!-- End of other input fields -->
                                        <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
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
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>
<?php } ?>
