<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
    header('location:logout.php');
} else{

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Student Management System|| View Students Profile</title>
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
    <link rel="stylesheet" href="css/style.css" />
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
                    <h3 class="page-title">View Student Profile</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Students Profile</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table border="1" class="table table-bordered mg-b-0">
                                    <?php
                                    $sid=$_SESSION['sturecmsstuid'];
                                    $sql="SELECT tblstudent.StudentName,tblstudent.StudentEmail,tblstudent.Gender,tblstudent.DOB,tblstudent.StuID,tblstudent.FatherName,tblstudent.MotherName,tblstudent.ContactNumber,tblstudent.AltenateNumber,tblstudent.Address,tblstudent.UserName,tblstudent.Password,tblstudent.Image,tblstudent.DateofAdmission from tblstudent where tblstudent.StuID=:sid";
                                    $query = $dbh -> prepare($sql);
                                    $query->bindParam(':sid',$sid,PDO::PARAM_STR);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0) {
                                        foreach($results as $row) { ?>
                                            <tr align="center" class="table-warning">
                                                <td colspan="4" style="font-size:20px;color:black;font-style:times;">
                                                    Personal Details
                                                </td>
                                            </tr>
                                            <tr class="pakbol">
                                            <td><img src="../admin/images/<?php echo $row->Image;?>" alt="Student Image"></td>
            
                                            </tr>
                                            <tr class="table-info">
                                                <th>Name</th>
                                                <td><?php echo $row->StudentName;?></td>
                                                <th>Gender</th>
                                                <td><?php echo $row->Gender;?></td>
                                            </tr>
                                            <tr class="table-warning">
                                                <th>Username</th>
                                                <td><?php echo $row->UserName;?></td>
                                                <th>Birthdate (yy-mm-dd)</th>
                                                <td><?php echo $row->DOB;?></td>
                                            </tr>
                                            <tr class="table-danger">
                                                <th>Learner Reference Number (LRN)</th>
                                                <td><?php echo $row->StuID;?></td>
                                                <th>Institutional Email (IE)</th>
                                                <td><?php echo $row->StudentEmail;?></td>
                                            </tr>
                                            <tr class="table-success">
                                                <th>Address</th>
                                                <td><?php echo $row->Address;?></td>
                                                <th>Date of Admission</th>
                                                <td><?php echo $row->DateofAdmission;?></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <th>Phone Number</th>
                                                <td><?php echo $row->ContactNumber;?></td>
                                                <th>Father's Name</th>
                                                <td><?php echo $row->FatherName;?></td>
                                            </tr>
                                            <tr class="table-progress">
                                                <th>Contact Number</th>
                                                <td><?php echo $row->AltenateNumber;?></td>
                                                <th>Mother's Name</th>
                                                <td><?php echo $row->MotherName;?></td>
                                            </tr>
                                        <?php $cnt=$cnt+1;}} ?>
                                </table>
                                <style>
                                  .table th img, .table td img {
                                    width: 23em;
                                   height: 22;
                                    border-radius: 0;
                                    height: 12em;
                                    margin-left:-2;
}
.table-info th, .table-info td, .table-info thead th, .table-info tbody + tbody {
  border-color: #4a4040;
}
.table-info, .table-info > th, .table-info > td {
  background-color: #fefefe;
}
.table-warning th, .table-warning td, .table-warning thead th, .table-warning tbody + tbody {
  border-color: #2a2926;
}
.table-warning, .table-warning > th, .table-warning > td {
  background-color: #fff;
}

                                </style>
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
<?php } ?>
