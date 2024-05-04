<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tblfaculty WHERE (UserName=:uname || Email=:uname) AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['sturecmfacaid'] = $result->ID;
        }

        if(!empty($_POST["remember"])) {
            //COOKIES for username
            setcookie("faculty_login", $_POST["uname"], time() + (10 * 365 * 24 * 60 * 60));
            //COOKIES for password
            setcookie("facultypassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE["faculty_login"])) {
                setcookie("faculty_login", "");
                if(isset($_COOKIE["facultypassword"])) {
                    setcookie("facultypassword", "");
                }
            }
        }
        $_SESSION['login'] = $_POST['uname'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || Login Page</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="./style.css">
    <!-- You may include additional CSS files here -->
    <style>
        .content-wrapper {
        background-image:url(images/FacLogin.png);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        
        
        }
        .auth .auth-form-light {
        background-color:transparent;
        border-radius: 25px;
        width: 90%;
        backdrop-filter: blur(2em);
        position: left 25%;   
}
</style>
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="images/MarawiSeniorHigh-removebg.png" alt="logo"> 
                            <style>
                                .auth .brand-logo img {
                                    width: 150px;
                                    height: 120px;
                                    margin-top: 10px; /* Adjust the top margin */
                                    margin-left: 93px; /* Adjust the left margin */
                                    }
                                </style>
                        </div>
                        <h4>Hello, Faculty! Let's get started.</h4>
                        <style>
                            h4, .h4 {
                        font-size: 1.2rem;
                            color: white;
                            }
                            .text-black{
                                color: white;
                            }
                            .text-muted, .preview-list .preview-item .preview-item-content p .content-category {
                                color: white !important;
                            }
                            .auth form .form-group .form-control, .auth form .form-group .select2-container--default .select2-selection--single, .select2-container--default .auth form .form-group .select2-selection--single, .auth form .form-group .select2-container--default .select2-selection--single .select2-search__field, .select2-container--default .select2-selection--single .auth form .form-group .select2-search__field, .auth form .form-group .typeahead, .auth form .form-group .tt-query, .auth form .form-group .tt-hint {
                            background: transparent;
                            border-radius: 0;
                            font-size: .9375rem;
                            color:white;
                            }
                            </style>
                        <form class="pt-3" id="login" method="post" name="login">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" placeholder="Enter your Username or Email" required="true" name="uname" value="<?php if(isset($_COOKIE["faculty_login"])) { echo $_COOKIE["faculty_login"]; } ?>" >
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" placeholder="Enter your Password" name="password" required="true" value="<?php if(isset($_COOKIE["facultypassword"])) { echo $_COOKIE["facu;typassword"]; } ?>">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Sign in</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if(isset($_COOKIE["faculty_login"])) { ?> checked <?php } ?> /> Keep me signed in
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="mb-2">
                                <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                                    <i class="icon-social-home mr-2"></i>Back Home
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<!-- endinject -->
</body>
</html>