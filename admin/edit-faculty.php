<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $fid = $_GET['editid'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $department = $_POST['department'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $uname = $_POST['uname'];
        $image = $_FILES["image"]["name"];
        $ret = "select UserName from tblfaculty where UserName=:uname && ID!=:fid";
        $query = $dbh->prepare($ret);
        $query->bindParam(':uname', $uname, PDO::PARAM_STR);
        $query->bindParam(':fid', $fid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() == 0) {
            $sql = "update tblfaculty set FirstName=:fname,LastName=:lname,Email=:email,Age=:age,Department=:department,Gender=:gender,Address=:address,Contact=:contact,UserName=:uname where ID=:fid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':department', $department, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':contact', $contact, PDO::PARAM_STR);
            $query->bindParam(':uname', $uname, PDO::PARAM_STR);
            $query->bindParam(':fid', $fid, PDO::PARAM_STR);
            $query->execute();
            $LastInsertId = $dbh->lastInsertId();
            if ($LastInsertId > 0) {
                echo '<script>alert("Faculty member detail has been updated")</script>';
                echo "<script>window.location.href ='manage-faculty.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
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
                                                    <label for="exampleInputName1">Department</label>
                                                    <input type="text" name="department" class="form-control" value="<?php echo htmlentities($row->Department); ?>" required>
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
                                                    <label for="exampleInputName1">Contact Number</label>
                                                    <input type="text" name="contact" class="form-control" value="<?php echo htmlentities($row->Contact); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Username</label>
                                                    <input type="text" name="uname" class="form-control" value="<?php echo htmlentities($row->UserName); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputName1">Profile Picture</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                        <?php }
                                        } ?>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
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
