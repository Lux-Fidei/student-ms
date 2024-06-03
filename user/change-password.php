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
    $currentpassword = MD5($_POST['currentpassword']);
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    // Validate new password and confirm password
    if ($newpassword !== $confirmpassword) {
        showAlert("New Password and Confirm Password do not match.");
    } else {
        
        // Fetch current password hash from the database
        $uaID = "SELECT UserAccountID FROM tblstudent WHERE LRN = :uid";
        $query2 = $dbh->prepare($uaID);
        $query2->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query2->execute();
        $result2 = $query2->fetch(PDO::FETCH_ASSOC);
        $sql = "SELECT Password 
                FROM tbl_user_accounts 
                WHERE LRN = :uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $result2['UserAccountID'], PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Verify current password
            if ($currentpassword === $result['Password']) {
                // Hash new password
                $newpasswordHash = MD5($newpassword);
                
                // Update new password in the database
                $updateSql = "UPDATE tbl_user_accounts 
                              SET Password = :newpassword 
                              WHERE ID = :uid";
                $updateQuery = $dbh->prepare($updateSql);
                $updateQuery->bindParam(':newpassword', $newpasswordHash, PDO::PARAM_STR);
                $updateQuery->bindParam(':uid', $result2['UserAccountID'], PDO::PARAM_STR);
                $updateQuery->execute();

                showAlert("Your password has been successfully changed.");
                echo "<script>window.location.href = 'dashboard.php';</script>";
                exit();
            } else {
                showAlert("Your current password is incorrect.");
            }
        } else {
            showAlert("User not found. Please try again.");
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
