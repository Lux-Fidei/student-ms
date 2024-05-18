<?php
session_start();
include('includes/dbconnection.php');
include_once('./account_helper.php');
if (strlen($_SESSION['sturecmsaid'])==0) {
    header('location:logout.php');
} else {
    $sqlSemester = "SELECT * FROM tblsemesters";
    $sqlStrand = "SELECT * FROM tbl_course";

    $querySemester = $dbh->prepare($sqlSemester);
    $querySemester->execute();
    $semesters = $querySemester->fetchAll(PDO::FETCH_ASSOC);

    $queryStrand = $dbh->prepare($sqlStrand);
    $queryStrand->execute();
    $strands = $queryStrand->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['submit'])) {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $middleinitial = $_POST['middleinitial'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $dob = $_POST['dob'];
        $placeofbirth = $_POST['placeofbirth'];
        $currentaddress = $_POST['currentaddress'];
        $permanentaddress = $_POST['permanentaddress'];
        $contactno = $_POST['contactno'];
        $email = $_POST['email'];
        $strand = $_POST['strand'];
        $gradelevel = $_POST['gradelevel'];
        $lrn = $_POST['lrn'];
        $schoollastattended = $_POST['schoollastattended'];
        $fathername = $_POST['fathername'];
        $fathercontactnumber = $_POST['fathercontactnumber'];
        $mothername = $_POST['mothername'];
        $mothercontactnumber = $_POST['mothercontactnumber'];
        $emergencycontactnumber = $_POST['emergencycontactnumber'];
        $uname = $_POST['uname'];
        $password = md5($_POST['password']);
        $image = $_FILES["image"]["name"];
        $extension = substr($image, strlen($image)-4, strlen($image));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        $uid = createAccount($uname, $password, 'student');
        if(!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Image has invalid format. Only jpg/jpeg/png/gif format allowed');</script>";
        } else {
            $image = md5($image).time().$extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/".$image);
            $yearadmitted = date('Y-m-d H:i:s'); // Current timestamp
            
            $sql = "INSERT INTO tblstudent (LastName, FirstName, MiddleInitial, Gender, Age, DOB, PlaceOfBirth, CurrentAddress, PermanentAddress, ContactNo, EmailAddress, Strand, GradeLevel, LRN, SchoolLastAttended, FatherName, FatherContactNumber, MotherName, MotherContactNumber, EmergencyContactNumber, YearAdmitted, UserAccountID, Image) VALUES (:lastname, :firstname, :middleinitial, :gender, :age, :dob, :placeofbirth, :currentaddress, :permanentaddress, :contactno, :email, :strand, :gradelevel, :lrn, :schoollastattended, :fathername, :fathercontactnumber, :mothername, :mothercontactnumber, :emergencycontactnumber, :yearadmitted, :useraccountid, :image)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $query->bindParam(':middleinitial', $middleinitial, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':dob', $dob, PDO::PARAM_STR);
            $query->bindParam(':placeofbirth', $placeofbirth, PDO::PARAM_STR);
            $query->bindParam(':currentaddress', $currentaddress, PDO::PARAM_STR);
            $query->bindParam(':permanentaddress', $permanentaddress, PDO::PARAM_STR);
            $query->bindParam(':contactno', $contactno, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':strand', $strand, PDO::PARAM_STR);
            $query->bindParam(':gradelevel', $gradelevel, PDO::PARAM_STR);
            $query->bindParam(':lrn', $lrn, PDO::PARAM_STR);
            $query->bindParam(':schoollastattended', $schoollastattended, PDO::PARAM_STR);
            $query->bindParam(':fathername', $fathername, PDO::PARAM_STR);
            $query->bindParam(':fathercontactnumber', $fathercontactnumber, PDO::PARAM_STR);
            $query->bindParam(':mothername', $mothername, PDO::PARAM_STR);
            $query->bindParam(':mothercontactnumber', $mothercontactnumber, PDO::PARAM_STR);
            $query->bindParam(':emergencycontactnumber', $emergencycontactnumber, PDO::PARAM_STR);
            $query->bindParam(':yearadmitted', $yearadmitted, PDO::PARAM_STR);
            //$query->bindParam(':uname', $uname, PDO::PARAM_STR);
            //$query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':useraccountid', $uid, PDO::PARAM_INT);
            $query->bindParam(':image', $image, PDO::PARAM_STR);
            
            $lastInsertId = $query->execute();
            if ($lastInsertId) {
                echo '<script>alert("Student has been added.");</script>';
                echo "<script>window.location.href ='add-students.php';</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again.");</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Add Students</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
    <?php include_once('includes/header.php');?>
    <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php');?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Student </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Students</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Add Student</h4>
                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input type="text" name="lastname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="text" name="firstname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Middle Initial:</label>
                                        <input type="text" name="middleinitial" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <input type="number" name="age" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="date" name="dob" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Place of Birth:</label>
                                        <input type="text" name="placeofbirth" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Current Address:</label>
                                        <input type="text" name="currentaddress" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Permanent Address:</label>
                                        <input type="text" name="permanentaddress" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact No.:</label>
                                        <input type="text" name="contactno" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address:</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Strand and Grade Level:</label>
                                        <select name="strand" class="form-control" required>
                                            <option value="">Select Strand</option>
                                            <?php foreach ($strands as $strand) { ?>
                                                <option value="<?php echo $strand['course_name']; ?>"><?php echo $strand['course_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <select name="gradelevel" class="form-control" required>
                                            <option value="">Select Grade Level</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>LRN:</label>
                                        <input type="text" name="lrn" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>School Last Attended:</label>
                                        <input type="text" name="schoollastattended" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Father’s Name:</label>
                                        <input type="text" name="fathername" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number:</label>
                                        <input type="text" name="fathercontactnumber" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Mother’s Name:</label>
                                        <input type="text" name="mothername" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number (optional):</label>
                                        <input type="text" name="mothercontactnumber" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number (in case of emergency):</label>
                                        <input type="text" name="emergencycontactnumber" class="form-control">
                                    </div>
                                    <div class="form-group">
                                    <label>Year Admitted:</label>
                                       <input type="text" name="yearadmitted" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                                        </div>


                                    <div class="form-group">
                                        <label>Username:</label>
                                        <input type="text" name="uname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password:</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Student Photo:</label>
                                        <input type="file" name="image" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
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
</body>
</html>