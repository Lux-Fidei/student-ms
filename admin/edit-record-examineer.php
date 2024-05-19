<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $id = $_GET['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $strand = $_POST['strand'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        // Handle image upload if required
        
        $sql = "UPDATE tbl_record_examineer SET fname=:fname, lname=:lname, email=:email, age=:age, strand=:strand, gender=:gender, address=:address, contact=:contact WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_INT);
        $query->bindParam(':strand', $strand, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':contact', $contact, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        echo '<script>alert("Record Examiner details have been updated.")</script>';
        echo "<script>window.location.href = 'managerecordexam.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Edit Record Examiner</title>
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
                        <h3 class="page-title"> Edit Record Examiner </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="view-record-examineer.php">View Staff</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Edit Record Examiner</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Edit Record Examiner</h4>
                                    <form class="forms-sample" method="post">
                                        <?php
                                            $id = $_GET['id'];
                                            $sql = "SELECT * FROM tbl_record_examineer WHERE id=:id";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            foreach($results as $result) {
                                        ?>
                                        <div class="form-group">
                                            <label for="fname">First Name</label>
                                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo htmlentities($result->fname); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="lname">Last Name</label>
                                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo htmlentities($result->lname); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlentities($result->email); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlentities($result->age); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="strand">Assigned Strand</label>
                                            <input type="text" class="form-control" id="strand" name="strand" value="<?php echo htmlentities($result->strand); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="Male" <?php if($result->gender == 'Male') echo 'selected'; ?>>Male</option>
                                                <option value="Female" <?php if($result->gender == 'Female') echo 'selected'; ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlentities($result->address); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Contact</label>
                                            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlentities($result->contact); ?>">
                                        </div>
                                        <!-- Include file input for image if required -->
                                        <?php } ?>
                                        
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                        <a href="view-record-examineer.php" class="btn btn-light">Cancel</a>
                                    </form>
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
