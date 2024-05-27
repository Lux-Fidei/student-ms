<?php
session_start();
if (empty($_SESSION['record_examineer_id'])) {
    header('location:login.php'); // Redirect to the login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Record Examiner Management System | Dashboard</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
</head>
<body>
    <div class="container-scroller">
        <!-- Include navbar -->
        <?php include_once('includes/header.php');?>
        <div class="container-fluid page-body-wrapper">
            <!-- Include sidebar -->
            <?php include_once('includes/sidebar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row purchace-popup">
                        <div class="col-12 stretch-card grid-margin">
                            <div class="card card-secondary" style="padding: 16px;">
                            <div class="d-sm-flex align-items-center mb-4">
                                        <h4 class="card-title mb-sm-0">Manage Students</h4>
                                        <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Students</a>
                                    </div>
                                    <div class="table-responsive border rounded p-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="font-weight-bold">Student No.</th>
                                                    <th class="font-weight-bold">LRN</th>
                                                    <th class="font-weight-bold">Complete Name</th>
                                                    <th class="font-weight-bold">Institutional Email</th>
                                                    <th class="font-weight-bold">Admission Date</th>
                                                    <th class="font-weight-bold"style="text-align: center">Approve</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $docName = 'Certification';
                                                $isApproved = 'Pending';
                                                    if(isset($_POST['submit']))
                                                    {
                                                        $stuID = $_POST['student_ID'];
                                                        $query = $dbh->prepare("UPDATE request_docs SET isApproved = 'Approved' WHERE st_id = :stuID AND docName = :docName");
                                                        $query->bindParam(':stuID', $stuID,PDO::PARAM_STR);
                                                        $query->bindParam(':docName', $docName,PDO::PARAM_STR);
                                                        $query->execute();
                                                        $lastInsertId = $dbh->lastInsertId();
                                                    }
                                                ?>
                                                <?php
                                                $sql = "SELECT 
                                                s.ID,
                                                s.LRN,
                                                s.LastName,
                                                s.FirstName,
                                                s.MiddleInitial,
                                                s.EmailAddress,
                                                s.YearAdmitted,
                                                r.docName
                                            FROM 
                                                request_docs r
                                            JOIN 
                                                tblstudent s ON r.st_id = s.ID WHERE docName = :docName AND isApproved = :isApproved;
                                            ";
                                                $query = $dbh->prepare($sql);
                                                
                                              $query->bindParam(':docName', $docName, PDO::PARAM_STR);
                                              $query->bindParam(':isApproved', $isApproved, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                $cnt = 1;
                                                foreach ($results as $row) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt); ?></td>
                                                        <td><?php echo htmlentities($row->LRN); ?></td>
                                                
                                                        <td><?php echo htmlentities($row->FirstName) . ' ' . htmlentities($row->MiddleInitial) . ' ' . htmlentities($row->LastName); ?></td>
                                                        <td><?php echo htmlentities($row->EmailAddress); ?></td>
                                                        <td><?php echo htmlentities($row->YearAdmitted); ?></td>
                                                        <td style="display:flex;justify-content:center">
                                                            <div>
                                                                <form method="post">
                                                                    <input type="hidden" name="student_ID" value="<?php echo htmlentities($row->ID);?>">
                                                                    <button type="submit" name="submit"><i class="icon-check"></i></button>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php $cnt = $cnt + 1;
                                                } ?>
                                            </tbody>
                                        </table>
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
