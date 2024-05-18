<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    // If form is submitted for updating subject
    if (isset($_POST['update'])) {
        $subjectid = $_POST['subjectid'];
        $subjectname = $_POST['subjectname'];

        $sql = "UPDATE tblsubjects SET SubjectName = :subjectname WHERE SubjectID = :subjectid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectid', $subjectid, PDO::PARAM_INT);
        $query->bindParam(':subjectname', $subjectname, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Subject has been updated.")</script>';
        echo "<script>window.location.href ='manage-subjects.php'</script>";
    }

    // If edit button is clicked
    if (isset($_GET['edit'])) {
        $subjectid = $_GET['edit'];

        $sql = "SELECT * FROM tblsubjects WHERE SubjectID = :subjectid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':subjectid', $subjectid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch all subjects
    $sql = "SELECT * FROM tblsubjects";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System || Manage Subjects</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <style>
        /* Adjustments to fix form alignment */
        .content-wrapper {
            margin-left: 240px; /* Adjust this value according to your sidebar width */
            height: 100em;
        }

        .main-panel {
            width: calc(100% - 240px); /* Adjust this value according to your sidebar width */
            transition: all 0.3s;
        }

        @media (max-width: 991.98px) {
            .content-wrapper {
                margin-left: 0;
            }

            .main-panel {
                width: 100%;
            }
        }

        /* Custom styles for table */
        .card-title {
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: gray;
            font-weight: 600;
            color: #333;
            border-top: 1px solid #dee2e6;
        }

        .table tbody tr:nth-child(even) {
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        <?php include_once('includes/header.php'); ?>
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- Main Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Manage Subjects </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Manage Subjects</li>
                        </ol>
                    </nav>
                </div>
                <!-- List of Subjects -->
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List of Subjects</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ($results as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo htmlentities($row->SubjectName); ?></td>
                                                    <td><a href="?edit=<?php echo $row->SubjectID; ?>">Edit</a></td>
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
    <!-- JS Scripts -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
