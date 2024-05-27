<?php
session_start();
include('includes/dbconnection.php');
include_once('./account_helper.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $fid = $_GET['editid'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $position = $_POST['position'];
        $assigned_strand = isset($_POST['assigned_strand']) ? $_POST['assigned_strand'] : '';
        $advisory_class = isset($_POST['advisory_class']) ? $_POST['advisory_class'] : '';
        $uname = $_POST['uname'];
        $image = $_FILES["image"]["name"];
        $extension = substr($image, strlen($image) - 4, strlen($image));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

        // Check if username already exists
        $ret = "SELECT UserName FROM tblfaculty WHERE UserName=:uname AND ID!=:fid";
        $query = $dbh->prepare($ret);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':fid', $fid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            if (!empty($image)) {
                if (in_array($extension, $allowed_extensions)) {
                    $image = md5($image) . time() . $extension;
                    move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);
                    $sql = "UPDATE tblfaculty SET FirstName=:fname, MiddleInitial=:mname, LastName=:lname, Email=:email, Age=:age, Gender=:gender, Address=:address, Contact=:contact, position=:position, assignedStrand=:assigned_strand, advisoryClasses=:advisory_class, UserName=:uname, Image=:image WHERE ID=:fid";
                } else {
                    echo '<script>alert("Invalid image format. Only jpg / jpeg/ png /gif formats are allowed")</script>';
                    $sql = "UPDATE tblfaculty SET FirstName=:fname, MiddleInitial=:mname, LastName=:lname, Email=:email, Age=:age, Gender=:gender, Address=:address, Contact=:contact, position=:position, assignedStrand=:assigned_strand, advisoryClasses=:advisory_class, UserName=:uname WHERE ID=:fid";
                }
            } else {
                $sql = "UPDATE tblfaculty SET FirstName=:fname, MiddleInitial=:mname, LastName=:lname, Email=:email, Age=:age, Gender=:gender, Address=:address, Contact=:contact, position=:position, assignedStrand=:assigned_strand, advisoryClasses=:advisory_class, UserName=:uname WHERE ID=:fid";
            }

            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':mname', $mname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':contact', $contact, PDO::PARAM_STR);
            $query->bindParam(':position', $position, PDO::PARAM_STR);
            $query->bindParam(':assigned_strand', $assigned_strand, PDO::PARAM_STR);
            $query->bindParam(':advisory_class', $advisory_class, PDO::PARAM_STR);
            $query->bindParam(':uname', $uname, PDO::PARAM_STR);
            $query->bindParam(':fid', $fid, PDO::PARAM_STR);
            if (!empty($image) && in_array($extension, $allowed_extensions)) {
                $query->bindParam(':image', $image, PDO::PARAM_STR);
            }

            $query->execute();
            if ($query->rowCount() > 0) {
                echo '<script>alert("Faculty member details have been updated")</script>';
                echo "<script>window.location.href ='manage-faculty.php'</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again")</script>';
            }
        } else {
            echo "<script>alert('Username already exists. Please try again');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Edit Faculty</title>
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
        <?php include_once('includes/header.php'); ?>

        <div class="container-fluid page-body-wrapper">
            <!-- Include sidebar -->
            <?php include_once('includes/sidebar.php'); ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Edit Faculty </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="manage-faculty.php">Manage Faculty</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Edit Faculty</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Edit Faculty</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <?php
                                        $fid = $_GET['editid'];
                                        $sql = "SELECT * from tblfaculty where ID=:fid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':fid', $fid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $row) { ?>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">First Name</label>
                                                    <input type="text" name="fname" class="form-control" value="<?php echo htmlentities($row->FirstName); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Middle Name</label>
                                                    <input type="text" name="mname" class="form-control" value="<?php echo htmlentities($row->MiddleInitial); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Last Name</label>
                                                    <input type="text" name="lname" class="form-control" value="<?php echo htmlentities($row->LastName); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail3">Email</label>
                                                    <input type="email" name="email" class="form-control" value="<?php echo htmlentities($row->Email); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Age</label>
                                                    <input type="number" name="age" class="form-control" value="<?php echo htmlentities($row->Age); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Gender</label>
                                                    <select name="gender" class="form-control" required>
                                                        <option value="Male" <?php if ($row->Gender == 'Male') echo 'selected="selected"'; ?>>Male</option>
                                                        <option value="Female" <?php if ($row->Gender == 'Female') echo 'selected="selected"'; ?>>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Address</label>
                                                    <textarea name="address" class="form-control" required><?php echo htmlentities($row->Address); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Contact</label>
                                                    <input type="text" name="contact" class="form-control" value="<?php echo htmlentities($row->Contact); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Position</label>
                                                    <input type="text" name="position" class="form-control" value="<?php echo htmlentities($row->position); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Assigned Strand</label>
                                                    <input type="text" name="assigned_strand" class="form-control" value="<?php echo htmlentities($row->assignedStrand); ?>">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Profile Pic</label>
                                                    <img src="images/<?php echo htmlentities($row->Image); ?>" width="100" height="100" value="<?php echo htmlentities($row->Image); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">New Profile Pic</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                        <?php }
                                        } ?>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Include footer -->
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <script src="js/file-upload.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
