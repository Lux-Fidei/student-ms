<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $stuname = $_POST['stuname'];
        $stuemail = $_POST['stuemail'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $stuid = $_POST['stuid'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $connum = $_POST['connum'];
        $altconnum = $_POST['altconnum'];
        $address = $_POST['address'];
        $eid = $_GET['editid'];
        $sql = "update tblstudent set StudentName=:stuname,StudentEmail=:stuemail,Gender=:gender,DOB=:dob,StuID=:stuid,FatherName=:fname,MotherName=:mname,ContactNumber=:connum,AltenateNumber=:altconnum,Address=:address where ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':stuname', $stuname, PDO::PARAM_STR);
        $query->bindParam(':stuemail', $stuemail, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':stuid', $stuid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mname', $mname, PDO::PARAM_STR);
        $query->bindParam(':connum', $connum, PDO::PARAM_STR);
        $query->bindParam(':altconnum', $altconnum, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Student has been updated")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Update Students</title>
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
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
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
                                    $sql = "SELECT tblstudent.StudentName,tblstudent.StudentEmail,tblstudent.Gender,tblstudent.DOB,tblstudent.StuID,tblstudent.FatherName,tblstudent.MotherName,tblstudent.ContactNumber,tblstudent.AltenateNumber,tblstudent.Address,tblstudent.UserName,tblstudent.Password,tblstudent.Image,tblstudent.DateofAdmission from tblstudent where tblstudent.ID=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $row) {
                                            ?>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Student Name</label>
                                                <input type="text" name="stuname"
                                                       value="<?php echo htmlentities($row->StudentName); ?>"
                                                       class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Student Email</label>
                                                <input type="text" name="stuemail"
                                                       value="<?php echo htmlentities($row->StudentEmail); ?>"
                                                       class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Gender</label>
                                                <select name="gender" class="form-control" required='true'>
                                                    <option value="">Choose Gender</option>
                                                    <option value="Male"
                                                        <?php if($row->Gender == 'Male') echo 'selected'; ?>>Male
                                                    </option>
                                                    <option value="Female"
                                                        <?php if($row->Gender == 'Female') echo 'selected'; ?>>Female
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Date of Birth</label>
                                                <input type="date" name="dob"
                                                       value="<?php echo htmlentities($row->DOB); ?>"
                                                       class="form-control" required='true'>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Learner Reference Number</label>
                                                <input type="text" name="stuid"
                                                       value="<?php echo htmlentities($row->StuID); ?>"
                                                       class="form-control" required='true'>
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
