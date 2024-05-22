<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $strand = $_POST['strand'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $uname = $_POST['uname'];
        $password = md5($_POST['password']);
        $image = $_FILES["image"]["name"];
        $extension = substr($image, strlen($image) - 4, strlen($image));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

        if (in_array($extension, $allowed_extensions)) {
            $image = md5($image) . time() . $extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);

            $sql = "INSERT INTO tbl_record_examineer (fname,mname ,lname, email, age, strand, gender, address, contact, uname, password, image) VALUES (:fname, :mname,:lname, :email, :age, :strand, :gender, :address, :contact, :uname, :password, :image)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':mname', $fname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_INT);
            $query->bindParam(':strand', $strand, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':contact', $contact, PDO::PARAM_STR);
            $query->bindParam(':uname', $uname, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':image', $image, PDO::PARAM_STR);

            if ($query->execute()) {
                echo '<script>alert("Record examiner has been added.")</script>';
                echo "<script>window.location.href ='addrecordexamineer.php'</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again.")</script>';
            }
        } else {
            echo '<script>alert("Image has invalid format. Only jpg / jpeg / png / gif format allowed.")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Add Record Examiner</title>
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
                        <h3 class="page-title"> Add Staff </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Staff</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Staff</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">First Name</label>
                                            <input type="text" name="fname" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputName1">Middle Name</label>
                                            <input type="text" name="fname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Last Name</label>
                                            <input type="text" name="lname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Age</label>
                                            <input type="number" name="age" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Strand</label>
                                            <select name="strand" class="form-control" required>
                                                <option value="">Select Strand</option>
                                                <?php
                                                $sql = "SELECT * FROM tbl_course";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                foreach ($results as $result) {
                                                    echo "<option value='" . $result->course_name . "'>" . $result->course_name . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Choose Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Address</label>
                                            <textarea name="address" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Contact Number</label>
                                            <input type="text" name="contact" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Username</label>
                                            <input type="text" name="uname" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Password</label>
                                            <input type="password" name="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Profile Picture</label>
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
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
