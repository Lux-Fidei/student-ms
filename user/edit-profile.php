<?php
session_start();
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
    exit(); // Add exit to prevent further execution
} 

// Process form submission
if(isset($_POST['submit'])){
    $eid = $_SESSION['sturecmsstuid']; // Use session ID instead of $_GET['editid']
    
    // Get data from the form
    $image = $_FILES['image']['name'];
    
    // Handle file upload
    if($image){
        $target_dir = "../admin/images/";
        $target_file = $target_dir . basename($image);    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File uploaded successfully, proceed with database update
        } else {
            // File upload failed, handle the error
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Update the record in the database
    $sql = "UPDATE tblstudent SET 
                Image=:image
            WHERE LRN=:eid";

    $query = $dbh->prepare($sql);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    
    if($query->execute()){
        echo '<script>alert("Student photo updated successfully")</script>';
        // Redirect to a success page or reload the page to reflect changes
        // header('Location: success.php');
        // exit();
    } else {
        echo '<script>alert("Something went wrong. Please try again")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Update Photo</title>
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
                                            <div class="page-header">
                                                <h3 class="page-title"> Update Photo </h3>
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page"> Update Photo</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">Update Profile Photo</h4>
                                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                                        <?php
                                                        $eid = $_SESSION['sturecmsstuid']; // Use session ID instead of $_GET['editid']
                                                        $sql = "SELECT Image FROM tblstudent WHERE ID=:eid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $row = $query->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="image">Photo</label>
                                                            <input type="file" class="form-control-file" id="image" name="image" required>
                                                            <input type="hidden" name="currentimage" value="<?php echo htmlentities($row['Image']); ?>">
                                                            <?php if(!empty($row['Image'])): ?>
                                                            <img src="admin/images/<?php echo htmlentities($row['Image']); ?>" width="100" height="100">
                                                            <?php endif; ?>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary btn-block" name="submit">Update Photo</button>
                                                    </form>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
