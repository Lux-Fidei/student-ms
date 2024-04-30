<?php
session_start();
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
    $uname = $_POST['uname'];
    $password = md5($_POST['password']);
    $sql = "SELECT ID FROM tbl_record_examineer WHERE (uname=:uname || email=:uname) AND Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uname', $uname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['record_examineer_id'] = $result->ID;
        }

        if(!empty($_POST["remember"])) {
            // COOKIES for username
            setcookie("record_examineer_login", $_POST["uname"], time() + (10 * 365 * 24 * 60 * 60));
            // COOKIES for password
            setcookie("record_examineer_password", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if(isset($_COOKIE["record_examineer_login"])) {
                setcookie("record_examineer_login", "");
                if(isset($_COOKIE["record_examineer_password"])) {
                    setcookie("record_examineer_password", "");
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
    <title>Record Examiner Management System | Login</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <style>
       .content-wrapper {
        background-image:url(images/Stdlog.jpg);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        }
        .auth .auth-form-light {
        background-color: transparent;
        border-radius: 30px;
        width: 100%;
        backdrop-filter: blur(2em);
        position: left 25%;   
    }
    .auth .brand-logo img {
        width: 150px;
        height: 120px;
        margin-top: 10px;
        margin-left: 115px;
    }
    h4, .h4 {
        font-size: 1.13rem;
        color: white;
    }
    .text-black {
        color: white;
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
                                <img src="images/MarawiSeniorHigh-removebg.png">
                            </div>
                            <h4>Hello, Record Examiner! Let's get started.</h4>
                            <form class="pt-3" id="login" method="post" name="login">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Username or Email" required="true" name="uname" value="<?php if(isset($_COOKIE["record_examineer_login"])) { echo $_COOKIE["record_examineer_login"]; } ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required="true" value="<?php if(isset($_COOKIE["record_examineer_password"])) { echo $_COOKIE["record_examineer_password"]; } ?>">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Sign in</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if(isset($_COOKIE["record_examineer_login"])) { ?> checked <?php } ?> /> Keep me signed in 
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
        </div>
    </div>
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject
</body>
</html>
