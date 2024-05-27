<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
    exit();
}

function showAlert($message) {
    echo "<script>alert('$message');</script>";
}

if (isset($_POST['submit'])) {
    $uid = $_SESSION['sturecmsstuid'];
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    // Validate new password and confirm password
    if ($newpassword !== $confirmpassword) {
        showAlert("New Password and Confirm Password do not match.");
    } else {
        // Fetch current password hash from the database
        $sql = "SELECT ua.Password 
                FROM tbl_user_accounts ua 
                JOIN tblstudent s ON ua.ID = s.UserAccountID 
                WHERE s.ID = :uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);

        if ($result) {
            // Verify current password
            if (password_verify($currentpassword, $result->Password)) {
                // Hash new password
                $newpasswordHash = password_hash($newpassword, PASSWORD_DEFAULT);
                
                // Update new password in the database
                $updateSql = "UPDATE tbl_user_accounts 
                              SET Password = :newpassword 
                              WHERE ID = (SELECT UserAccountID FROM tblstudent WHERE ID = :uid)";
                $updateQuery = $dbh->prepare($updateSql);
                $updateQuery->bindParam(':newpassword', $newpasswordHash, PDO::PARAM_STR);
                $updateQuery->bindParam(':uid', $uid, PDO::PARAM_STR);
                $updateQuery->execute();

                showAlert("Your password has been successfully changed.");
                echo "<script>window.location.href = 'dashboard.php';</script>";
                exit();
            } else {
                showAlert("Your current password is incorrect.");
            }
        } else {
            showAlert("Something went wrong. Please try again.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Change Password</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-scroller">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">Change Password</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Change Password</h4>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label>Current Password:</label>
                                        <input type="password" name="currentpassword" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>New Password:</label>
                                        <input type="password" name="newpassword" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password:</label>
                                        <input type="password" name="confirmpassword" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once('includes/footer.php'); ?>
        </div>
    </div>
</div>
</body>
</html>
