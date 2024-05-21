<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || View Record Examiner</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Custom CSS for table */
        .table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 5px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f3f4f6;
        }

        .table-striped tbody tr:hover {
            background-color: #e2e6ea;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 3px;
            text-decoration: none;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
        }
    </style>
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
                        <h3 class="page-title"> View Staff </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> View Staff</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: left;">Manage Staff</h4>
                                    <!-- Search form -->
                                    <form method="GET" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="search" placeholder="Search...">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </form>
                                    <!-- End of search form -->
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Last Name</th>
                                                    <th>First Name</th>
                                                    <th>Email</th>
                                                    <th>Assigned Strand</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Check if search parameter is set
                                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                                    $search = $_GET['search'];
                                                    // Modify SQL query to include search functionality
                                                    $sql = "SELECT * FROM tbl_record_examineer WHERE lname LIKE '%$search%' OR fname LIKE '%$search%' OR email LIKE '%$search%' OR strand LIKE '%$search%'";
                                                } else {
                                                    // Default SQL query without search
                                                    $sql = "SELECT * FROM tbl_record_examineer";
                                                }
                                                
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $count = 1;
                                                foreach ($results as $result) {
                                                    echo "<tr>";
                                                    echo "<td>" . $count++ . "</td>";
                                                    echo "<td>" . $result->lname ."</td>";
                                                    echo "<td>" . $result->fname ."</td>";
                                                    echo "<td>" . $result->email . "</td>";
                                                    echo "<td>" . $result->strand . "</td>";
                                                    echo "<td>
                                                            <a href='edit-record-examineer.php?id=" . $result->id . "'class='btn btn-info btn-sm'><i class='icon-eye'></i> View</a>
                                                            <a href='delete-recordexam.php?id=" . $result->id . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='icon-trash'></i> Delete</a>
                                                        </td>";
                                                    echo "</tr>";
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

<?php } ?>
