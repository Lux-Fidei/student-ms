<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit(); // Add exit to prevent further execution
} else {
    if (isset($_POST['submit'])) {
        $activity_name = $_POST['activity_name'];
        $date_allocated = $_POST['date_allocated'];
        $schoolyear_id = $_POST['schoolyear_id'];
        $date_created = date("Y-m-d H:i:s"); // Current timestamp

        $sql = "INSERT INTO tbl_activity (activity_name, date_allocated, schoolyear_id, date_created) VALUES (:activity_name, :date_allocated, :schoolyear_id, :date_created)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
        $query->bindParam(':date_allocated', $date_allocated, PDO::PARAM_STR);
        $query->bindParam(':schoolyear_id', $schoolyear_id, PDO::PARAM_INT);
        $query->bindParam(':date_created', $date_created, PDO::PARAM_STR);

        if ($query->execute()) {
            echo '<script>alert("Activity added successfully.")</script>';
            echo "<script>window.location.href ='academiccalendar.php'</script>";
            exit(); // Add exit to prevent further execution
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Activity</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                        <h3 class="page-title"> Add Activity </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Activity</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Activity</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Activity Name</label>
                                            <input type="text" name="activity_name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Date Allocated</label>
                                            <input type="date" name="date_allocated" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">School Year</label>
                                            <select name="schoolyear_id" class="form-control" required>
                                                <option value="">Select School Year</option>
                                                <?php
                                                // Fetch school years from tblschoolyear
                                                $sql_schoolyear = "SELECT * FROM tblschoolyear";
                                                $query_schoolyear = $dbh->prepare($sql_schoolyear);
                                                $query_schoolyear->execute();
                                                $result_schoolyear = $query_schoolyear->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                // Loop through school years and create options
                                                foreach ($result_schoolyear as $schoolyear) {
                                                    echo "<option value='" . $schoolyear['id'] . "'>" . $schoolyear['schoolyear'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger mr-2" name="submit">Submit</button>
                                    </form>
                                    
                                    <!-- Table with edit and delete buttons -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Activity Name</th>
                                                    <th>Date Allocated</th>
                                                    <th>School Year</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch activity data from the database
                                                $sql = "SELECT a.*, s.schoolyear FROM tbl_activity a JOIN tblschoolyear s ON a.schoolyear_id = s.id";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                                                // Loop through each activity and display it in the table
                                                foreach ($result as $row) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['activity_name'] . "</td>";
                                                    echo "<td>" . $row['date_allocated'] . "</td>";
                                                    echo "<td>" . $row['schoolyear'] . "</td>";
                                                    echo "<td>";
                                                    echo "<a href='edit_activity.php?id="  . "' class='btn btn-info btn-sm'>Edit</a>";
                                                    echo "<a href='delete_activity.php?id="  . "' class='btn btn-danger btn-sm'>Delete</a>";
                                                    echo "</td>";
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
