    <?php
    session_start();
    error_reporting(0);
    include('includes/dbconnection.php');
    include_once('./account_helper.php');

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $loginSql = "SELECT ID, Type FROM tbl_user_accounts WHERE UserName=:username AND Password=:password AND (expiryDate IS NULL OR expiryDate > NOW())";
        
        $query = $dbh->prepare($loginSql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $user_accounts = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() == 0) {
            echo "<script>alert('Invalid Details');</script>";
        } else {
            $first_match = $user_accounts[0];
            $userId = $first_match->ID;

            date_default_timezone_set('Asia/Manila');
            $loginTime = date("Y-m-d H:i:s");

            if ($first_match->Type == 'faculty') {
                $sql = "SELECT * FROM tblfaculty WHERE UserAccountID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmfacaid'] = $result->ID;
                    }
                }

                // Log the login time for faculty
                $loginTime = date("Y-m-d H:i:s");
                $loginHistorySql = "INSERT INTO login_history (user_id, login_time) VALUES (:user_id, :login_time)";
                $loginHistoryStmt = $dbh->prepare($loginHistorySql);
                $loginHistoryStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $loginHistoryStmt->bindParam(':login_time', $loginTime, PDO::PARAM_STR);
                $loginHistoryStmt->execute();

                // Store the login history ID in the session
                $_SESSION['login_history_id'] = $dbh->lastInsertId();

                echo "<script type='text/javascript'> document.location ='/faculty-hybrid/dashboard.php'; </script>";
            } else if ($first_match->Type == 'admin') {
                $sql = "SELECT * FROM tbladmin WHERE UserAccountID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmsaid'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/admin/dashboard.php'; </script>";
            } else if ($first_match->Type == 'student') {
                $sql = "SELECT LRN,ID FROM tblstudent WHERE UserAccountID = :useraccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useraccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmsstuid'] = $result->LRN;
                        $_SESSION['sturecmsuid'] = $result->ID;
                    }
                    $_SESSION['login'] = $_POST['LRN'];
                }

                if (!empty($_POST["remember"])) {
                    //COOKIES for username
                    setcookie("user_login", $_POST["stuid"], time() + (10 * 365 * 24 * 60 * 60));
                    //COOKIES for password
                    setcookie("userpassword", $_POST["password"], time() + (10 * 365 * 24 * 60 * 60));
                } else {
                    if (isset($_COOKIE["user_login"])) {
                        setcookie("user_login", "");
                        if (isset($_COOKIE["userpassword"])) {
                            setcookie("userpassword", "");
                        }
                    }
                }
                echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
            } else if ($first_match->Type == 'Chairperson') {
                $sql = "SELECT * FROM tblfaculty WHERE UserAccountID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmfacaid'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/faculty-hybrid/dashboard.php'; </script>";
                
            } else if ($first_match->Type === 'Subject Teacher') {
                $sql = "SELECT * FROM tblfaculty WHERE UserAccountID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmfacaid'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/subject-teacher/dashboard.php'; </script>";
            } else if($first_match->Type === 'Record Examineer') {
                $sql = "SELECT * FROM tbl_user_accounts WHERE ID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmfacaid'] = $result->ID;
                        $_SESSION['record_examineer_id'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/recordexamineer/dashboard.php'; </script>";
            } else if($first_match->Type === 'LIS Coordinator') {
                $sql = "SELECT * FROM tbl_user_accounts WHERE ID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmlisid'] = $result->ID;
                        $_SESSION['record_examineer_id'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/lis-coordinator/dashboard.php'; </script>";
            } else if($first_match->Type === 'Teacher Aide') {
                $sql = "SELECT * FROM tbl_user_accounts WHERE ID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmtaid'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/teacher-aide/dashboard.php'; </script>";
            } else if($first_match->Type === 'Adviser') {
                $sql = "SELECT * FROM tbl_user_accounts WHERE ID = :useracccountid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useracccountid', $userId, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $_SESSION['sturecmfacaid'] = $result->ID;
                    }
                }
                echo "<script type='text/javascript'> document.location ='/student-ms/adviser/dashboard.php'; </script>";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Student Management System || Student Login Page</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="css/style.css">
        <style>
            .content-wrapper {
                background-image: url(images/annex.jpg);
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }
            .auth .auth-form-light {
                background-color: transparent; 
                border-radius: 30px;
                width: 100%;
                backdrop-filter: blur(15px);
                position: left 25%;
                border: 3px solid #e3e3e3;
                box-shadow: 0 0 100px rgba(0, 0, 2, 1);
            }
            h4, .h4 {
                font-size: 1.13rem;
                color: white;
            }
            .auth form .form-group .form-control,
            .auth form .form-group .select2-container--default .select2-selection--single,
            .select2-container--default .auth form .form-group .select2-selection--single,
            .auth form .form-group .select2-container--default .select2-selection--single .select2-search__field,
            .select2-container--default .select2-selection--single .auth form .form-group .select2-search__field,
            .auth form .form-group .typeahead,
            .auth form .form-group .tt-query,
            .auth form .form-group .tt-hint {
                background: transparent;
                border-radius: 0;
                font-size: .9375rem;
                color: white;
            }
            .auth form .auth-link {
                font-size: 0.875rem;
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
                                <div class="brand-logo" style="padding-left: 7.3em;">
                                    <img src="images/MarawiSeniorHigh-removebg.png">
                                </div>
                                <h4>Hello, User! Let's get started.</h4>
                                <form class="pt-3" id="login" method="post" name="login">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg" placeholder="Username" required="true" name="username" value="<?php if (isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" required="true" value="<?php if (isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-success btn-block loginbtn" name="login" type="submit">Sign in</button>
                                    </div>
                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" id="remember" class="form-check-input" name="remember" <?php if (isset($_COOKIE["user_login"])) { ?> checked <?php } ?> /> Keep me signed in </label>
                                        </div>
                                        <a href="forgot-password.php" class="auth-link text-black">Forgot password?</a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="../index.php" class="btn btn-block btn-facebook auth-form-btn">
                                            <i class="icon-social-home mr-2"></i>Back Home </a>
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
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        <!-- endinject -->
    </body>
    </html>
