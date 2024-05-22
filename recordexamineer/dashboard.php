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
                            <div class="card card-secondary">
                                <span class="card-body d-lg-flex align-items-center">
                                    <p class="mb-lg-0">Notices from the school kindly check! </p>
                                    <a href="view-notice.php" target="_blank" class="btn btn-warning purchase-button btn-sm my-1 my-sm-0 ml-auto">View Notice</a>
                                </span>
                                <div id="pie-chart" class="ct-chart">
                                    <canvas id="pie-chart"></canvas>
                                </div>
                                <script>
                                    var ctx = document.getElementById('pie-chart').getContext("2d");
                                    var data = {
                                        labels: ["COR", "Certification", "Gradeslip"],
                                        datasets: [{
                                            label: "My First dataset",
                                            data: [300, 50, 100],
                                            backgroundColor: [
                                                'rgba(255, 99, 132, 0.2)',
                                                'rgba(54, 162, 235, 0.2)',
                                                'rgba(255, 206, 86, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    };
                                    var options = {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    };
                                    var myPieChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: data,
                                        options: options
                                    });
                                </script>
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
