<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    if (isset($_POST['submit'])) {
        $activity_id = $_GET['id'];
        $activity_name = $_POST['activity_name'];
        $date_allocated = $_POST['date_allocated'];
        $schoolyear_id = $_POST['schoolyear_id'];

        $sql = "UPDATE tbl_activity SET activity_name=:activity_name, date_allocated=:date_allocated, schoolyear_id=:schoolyear_id WHERE id=:activity_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':activity_name', $activity_name, PDO::PARAM_STR);
        $query->bindParam(':date_allocated', $date_allocated, PDO::PARAM_STR);
        $query->bindParam(':schoolyear_id', $schoolyear_id, PDO::PARAM_INT);
        $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);

        if ($query->execute()) {
            echo '<script>alert("Activity updated successfully.")</script>';
            echo "<script>window.location.href ='academiccalendar.php'</script>";
            exit();
        } else {
            echo '<script>alert("Something went wrong. Please try again.")</script>';
        }
    } else {
        // Fetch existing activity details
        $activity_id = $_GET['id'];
        $sql = "SELECT * FROM tbl_activity WHERE id=:activity_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Activity</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/header.php');?>

        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php');?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Edit Activity </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Edit Activity</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Edit Activity</h4>
                                    <form class="forms-sample" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Activity Name</label>
                                            <input type="text" name="activity_name" class="form-control" value="<?php echo htmlentities($result['activity_name']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Date Allocated</label>
                                            <input type="date" name="date_allocated" class="form-control" value="<?php echo htmlentities($result['date_allocated']); ?>" required>
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
                                                    $selected = ($schoolyear['id'] == $result['schoolyear_id']) ? 'selected' : '';
                                                    echo "<option value='" . $schoolyear['id'] . "' $selected>" . $schoolyear['schoolyear'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger mr-2" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>
    
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
