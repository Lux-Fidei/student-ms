<?php
session_start();
include('includes/dbconnection.php');
include_once('./account_helper.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
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
        $password = md5($_POST['password']);
        $image = $_FILES["image"]["name"];
        $extension = substr($image, strlen($image) - 4, strlen($image));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        $uid = createAccount($uname, $password, 'faculty');
       
        if (in_array($extension, $allowed_extensions)) {
            $image = md5($image) . time() . $extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);

            $sql = "INSERT INTO tblfaculty (FirstName, LastName,MiddleInitial, Email, Age,Gender, Address, Contact, position, assignedStrand, advisoryClasses, UserAccountID, Image) VALUES (:fname, :lname,:mname, :email, :age, :gender, :address, :contact, :position, :assigned_strand, :advisory_class, :useraccountid, :image)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':mname', $mname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_INT);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':contact', $contact, PDO::PARAM_STR);
            $query->bindParam(':position', $position, PDO::PARAM_STR);
            $query->bindParam(':assigned_strand', $assigned_strand, PDO::PARAM_STR);
            $query->bindParam(':advisory_class', $advisory_class, PDO::PARAM_STR);
            // $query->bindParam(':uname', $uname, PDO::PARAM_STR);
            // $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':useraccountid', $uid, PDO::PARAM_INT);
            $query->bindParam(':image', $image, PDO::PARAM_STR);

            try {
                $query->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo '<script>alert("Logo has Invalid format. Only jpg / jpeg/ png /gif format allowed")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Add Faculty</title>
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
                        <h3 class="page-title"> Add Faculty</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Faculty</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Faculty</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
    <label for="exampleInputName1">First Name</label>
    <input type="text" name="fname" class="form-control" required>
</div>
<div class="form-group">
<label for="exampleInputName1">Middle Name</label>
    <input type="text" name="mname" class="form-control" required>
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
    <div class="form-group">
        <label for="exampleInputName1">Position</label>
        <select name="position" class="form-control" required>
            <option value="">Choose Faculty Type</option>
            <option value="Visiting Teacher">Visiting Teacher</option>
            <option value="Adviser (Subject)">Adviser (Subject)</option>
            <option value="Chairperson (Subject)">Chairperson (Subject)</option>
            <option value="Chairperson (Adviser & Subject)">Chairperson (Adviser & Subject)</option>
        </select>
    </div>
    <div id="additional-fields"></div>

    <script>
        document.querySelector('select[name="position"]').addEventListener('change', function() {
            var position = this.value;
            var additionalFields = document.getElementById('additional-fields');

            if (position === 'Chairperson (Subject)') {
                additionalFields.innerHTML = `
                    <div class="form-group">
                        <label for="exampleInputName1">Assigned Strand/Track</label>
                        <input type="text" name="assigned_strand" class="form-control" required>
                    </div>
                `;
            } else if (position === 'Adviser (Subject)') {
                additionalFields.innerHTML = `
                    <div class="form-group">
                        <label for="exampleInputName1">Advisory Class/es</label>
                        <input type="text" name="advisory_class" class="form-control" required>
                    </div>
                `;
            } else if (position === 'Chairperson (Adviser & Subject)'){
                additionalFields.innerHTML = `
                    <div class="form-group">
                        <label for="exampleInputName1">Assigned Strand/Track</label>
                        <input type="text" name="assigned_strand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Advisory Class/es</label>
                        <input type="text" name="advisory_class" class="form-control" required>
                    </div>
                `;
            } else {
                additionalFields.innerHTML = '';
            }
        });
    </script>
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
