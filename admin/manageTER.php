<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (empty($_SESSION['sturecmsaid'])) {
    header('location:logout.php');
    exit;
} 

$isTerActive = false; // Set the initial TER form activation status

if (isset($_POST['submit'])) {
    $question = $_POST['question'];

    // Prepare the SQL query to insert data into the tbl_ter_questions table
    $sql = "INSERT INTO tbl_ter_questions (Question) VALUES (:question)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':question', $question, PDO::PARAM_STR);

    // Execute the SQL query
    $query->execute();

    // Check if data insertion was successful
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo '<script>alert("Question has been added.")</script>';
        echo "<script>window.location.href ='manageTER.php'</script>";
        exit;
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

// Check TER form activation status (you need to implement this logic based on your requirements)
if (isset($_POST['enable_ter'])) {
    $isTerActive = true;
} elseif (isset($_POST['disable_ter'])) {
    $isTerActive = false;
}

if ($isTerActive) {
    $terFormDisabledAttribute = ''; // TER form is active, so no disabled attribute
} else {
    $terFormDisabledAttribute = 'disabled'; // TER form is inactive, so add disabled attribute
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage TER Questions</title>
    <!-- Include CSS and other necessary files here -->
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
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .container-scroller {
            background-color: #f7f7f7;
        }

        .page-header {
            background-color: #ffffff;
            padding: 20px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            margin-bottom: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item {
            display: inline-block;
            margin-right: 0.5rem;
            color: #6c757d;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: '/';
            vertical-align: middle;
            font-size: 1rem;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
            color: #6c757d;
        }

        .breadcrumb-item+.breadcrumb-item:hover::before {
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: #495057;
        }

        .btn-primary {
            background-color: #7367f0;
            border-color: #7367f0;
        }

        .btn-primary:hover {
            background-color: #695ee1;
            border-color: #695ee1;
        }
        
        /* Style for the modern buttons */
        .custom-btn {
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .custom-btn.success {
            background-color: #28a745;
            color: #fff;
        }
        
        .custom-btn.success:hover {
            background-color: #218838;
        }
        
        .custom-btn.danger {
            background-color: #dc3545;
            color: #fff;
        }
        
        .custom-btn.danger:hover {
            background-color: #c82333;
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
                        <h3 class="page-title">Manage TER Questions</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage TER Questions</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">TER Form Activation</h4>
                                    <form method="post">
                                        <button type="submit" class="custom-btn success mr-2" name="enable_ter">Enable TER Form</button>
                                        <button type="submit" class="custom-btn danger mr-2" name="disable_ter">Disable TER Form</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Question Form -->
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Question</h4>
                                    <form class="forms-sample" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputQuestion">Question</label>
                                            <input type="text" name="question" class="form-control" placeholder="Enter Question" required="true" <?php echo $terFormDisabledAttribute; ?>>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit" <?php echo $terFormDisabledAttribute; ?>>Add Question</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table to display added questions -->
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">List of Added Questions</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Question ID</th>
                                                    <th>Question</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM tbl_ter_questions";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($row->Question); ?></td>
                                                        </tr>
                                                        <?php
                                                        $cnt++;
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="2">No questions found</td>
                                                    </tr>
                                                    <?php
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
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?php include_once('includes/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- Include scripts -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
</body>

</html>
