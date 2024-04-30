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
   
    <title>Student  Management System || Dashboard</title>
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
                                            <div class="d-sm-flex align-items-baseline report-summary-header">
                                                <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">Updated Report</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row report-inner-cards-wrapper">
                                        
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql2 ="SELECT * from  tblstudent";
                                                $query2 = $dbh -> prepare($sql2);
                                                $query2->execute();
                                                $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                                                $totstu=$query2->rowCount();
                                                ?>
                                                <span class="report-title">Total Students</span>
                                                <h4><?php echo htmlentities($totstu);?></h4>
                                                <a href="manage-students.php"><span class="report-count"> View Students</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-danger">
                                                <i class="icon-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql3 ="SELECT * from  tblnotice";
                                                $query3 = $dbh -> prepare($sql3);
                                                $query3->execute();
                                                $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                                                $totnotice=$query3->rowCount();
                                                ?>
                                                <span class="report-title">Total Class Notice</span>
                                                <h4><?php echo htmlentities($totnotice);?></h4>
                                                <a href="manage-notice.php"><span class="report-count"> View Notices</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-warning">
                                                <i class="icon-doc"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql4 ="SELECT * from  tblpublicnotice";
                                                $query4 = $dbh -> prepare($sql4);
                                                $query4->execute();
                                                $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                                                $totpublicnotice=$query4->rowCount();
                                                ?>
                                                <span class="report-title">Total Public Notice</span>
                                                <h4><?php echo htmlentities($totpublicnotice);?></h4>
                                                <a href="manage-public-notice.php"><span class="report-count"> View PublicNotices</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-primary">
                                                <i class="icon-doc"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row report-inner-cards-wrapper">
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql5 ="SELECT * from  tblsubjects";
                                                $query5 = $dbh -> prepare($sql5);
                                                $query5->execute();
                                                $results5=$query5->fetchAll(PDO::FETCH_OBJ);
                                                $totsubjects=$query5->rowCount();
                                                ?>
                                                <span class="report-title">Total Subjects</span>
                                                <h4><?php echo htmlentities($totsubjects);?></h4>
                                                <a href="manage-subjects.php"><span class="report-count"> View Subjects</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-info">
                                                <i class="icon-book-open"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql6 ="SELECT * from  tbl_section";
                                                $query6 = $dbh -> prepare($sql6);
                                                $query6->execute();
                                                $results6=$query6->fetchAll(PDO::FETCH_OBJ);
                                                $totsections=$query6->rowCount();
                                                ?>
                                                <span class="report-title">Total Sections</span>
                                                <h4><?php echo htmlentities($totsections);?></h4>
                                                <a href="manage-sections.php"><span class="report-count"> View Sections</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-warning">
                                                <i class="icon-grid"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xl report-inner-card">
                                            <div class="inner-card-text">
                                                <?php 
                                                $sql7 ="SELECT DISTINCT GradeLevel from  tbl_class";
                                                $query7 = $dbh -> prepare($sql7);
                                                $query7->execute();
                                                $results7=$query7->fetchAll(PDO::FETCH_OBJ);
                                                $totgradelevel=$query7->rowCount();
                                                ?>
                                                <span class="report-title">Total Grade Levels</span>
                                                <h4><?php echo htmlentities($totgradelevel);?></h4>
                                                <a href="gradesec.php"><span class="report-count"> View Grade Levels</span></a>
                                            </div>
                                            <div class="inner-card-icon bg-success">
                                                <i class="icon-grid"></i>
                                            </div>
                                        </div>
                                    </div>
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
<?php }  ?>
