<?php
session_start();
include('includes/dbconnection.php');
include_once('./account_helper.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
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
    var_dump($_POST);
    if (isset($_POST['submit'])) {
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
        $extension = substr($image, strlen($image) - 4, strlen($image));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        if (!$firstname || !$lastname) {
            echo "Insufeficient";
        } else {

            $uid = createAccount($uname, $password, 'student');
            $image = md5($image) . time() . $extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $image);
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
                echo 'OK';
            } else {
                echo 'FAILED';
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
    <script src="/js/papaparse.min.js"></script>
    <script src="/js/jquery-1.11.0.min.js" ></script>
</head>

<body>
    <div class="container-scroller">
        <?php include_once('includes/header.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/sidebar.php'); ?>
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
                                    <h4 class="card-title" style="text-align: center;">Import Student</h4>
                                    <input type="file" id="fileInput">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <script lang="text/javascript">
        
            var fileInput = document.getElementById('fileInput');

            fileInput.addEventListener('change', function(e) {
                var file = e.target.files[0];

                Papa.parse(file, {
                    complete: function(results) {
                        // Validate data here (ensure data types and required fields)
                        var jsonData = [];
                        if (results.data.length == 0) return;
                        var header = results.data[0];
                        for (var i = 1; i < results.data.length; i++) { // Skip header row (assuming row 1)
                            var rowData = results.data[i];
                            // Convert row data to a JSON object suitable for your table schema
                            jsonData.push(rowData);
                        }

                        // Use AJAX to send the jsonData to create-student.php
                        console.log(jsonData);
                        
                        for (let index = 0; index < jsonData.length; index++) {
                            const record = jsonData[index];

                            const student = {
                                submit: true,
                                lastname: '',
                                firstname: '',
                                middleinitial: '',
                                gender: '',
                                age: '',
                                dob: '',
                                placeofbirth: '',
                                currentaddress: '',
                                permanentaddress: '',
                                contactno: '',
                                email: '',
                                strand: '',
                                gradelevel: '',
                                lrn: '',
                                schoollastattended: '',
                                fathername: '',
                                fathercontactnumber: '',
                                mothername: '',
                                mothercontactnumber: '',
                                emergencycontactnumber: '',
                                uname: '',
                                password: '',
                            }
                            // const map = {
                            //     lastname: 'LastName',
                            //     dob: 'BirthDate',
                            // };
                            header.forEach(((col, index) => {
                                student[col] = record[index];
                            }))
                            $.post('import-students.php', student, () => {
                                console.log('Saved');
                            })
                            
                        }
                       
                    }
                });
            });


        
    </script>
</body>

</html>