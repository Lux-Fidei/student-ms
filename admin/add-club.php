<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (empty($_SESSION['sturecmsaid'])) {
    header('location:logout.php');
    exit;
} 

// Delete Club
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql = "DELETE FROM tbl_club WHERE ClubID=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id',$id, PDO::PARAM_STR);
    $query->execute();
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['submit'])) {
    $clubname = $_POST['clubname'];
    $adviser = $_POST['adviser'];

    // Prepare the SQL query to insert data into the tbl_club table
    $sql = "INSERT INTO tbl_club (ClubName, AdviserID) VALUES (:clubname, :adviser)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':clubname', $clubname, PDO::PARAM_STR);
    $query->bindParam(':adviser', $adviser, PDO::PARAM_INT);

    // Execute the SQL query
    $query->execute();

    // Check if data insertion was successful
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo '<script>alert("Club has been added.")</script>';
        echo "<script>window.location.href ='add-club.php'</script>";
        exit;
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System || Add Club</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
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
                        <h3 class="page-title"> Add Club </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Club</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Club</h4>
                                    <form class="forms-sample" method="post">
                                        <div class="form-group">
                                            <label for="exampleInputClubName">Club Name</label>
                                            <input type="text" name="clubname" class="form-control" placeholder="Enter Club Name" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAdviser">Club Adviser</label>
                                            <select class="form-control" name="adviser" required>
                                                <option value="">Select Adviser</option>
                                                <?php
                                                $sql = "SELECT * FROM tblfaculty";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $row) {
                                                    ?>
                                                    <option value="<?php echo htmlentities($row->ID); ?>"><?php echo htmlentities($row->FirstName . ' ' . $row->LastName); ?></option>
                                                    <?php
                                                }   
                                                ?>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">List of Added Clubs</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Club ID</th>
                                                    <th>Club Name</th>
                                                    <th>Club Adviser</th>
                                                    <th>Actions</th> <!-- Added Actions column -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT c.*, f.FirstName, f.LastName FROM tbl_club c JOIN tblfaculty f ON c.AdviserID = f.ID";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo htmlentities($cnt); ?></td>
                                                            <td><?php echo htmlentities($row->ClubName); ?></td>
                                                            <td><?php echo htmlentities($row->FirstName . ' ' . $row->LastName); ?></td>
                                                            <td>
                                                                <!-- Edit button -->
                                                                <a href="edit-club.php?id=<?php echo $row->ClubID; ?>" class="icon-eye"></a>
                                                                <!-- Delete button -->
                                                                || <a href="?delete=<?php echo $row->ClubID; ?>" class='icon-trash'></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $cnt++;
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="4">No clubs found</td>
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
                <!-- Include footer -->
                <?php include_once('includes/footer.php');?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller
<!-- container-scroller ends -->
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
