<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $nottitle = $_POST['nottitle'];
        $facultyid = $_SESSION['sturecmsaid'];
        $notmsg = $_POST['notmsg'];
        $noticeTo = $_POST['noticeTo'];

        $sql = "INSERT INTO tblnotice (NoticeTitle,NoticeMsg, NoticeTo) VALUES (:nottitle, :notmsg, :noticeTo)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nottitle', $nottitle, PDO::PARAM_STR);
        $query->bindParam(':notmsg', $notmsg, PDO::PARAM_STR);
        $query->bindParam(':noticeTo', $noticeTo, PDO::PARAM_STR);
        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Notice has been added.")</script>';
            echo "<script>window.location.href ='add-notice.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Add Notice</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
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
                        <h3 class="page-title">Add Notice</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Notice</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Add Notice</h4>
                                    <form class="forms-sample" method="post">
                                        <div class="form-group">
                                            <label for="nottitle">Notice Title</label>
                                            <input type="text" name="nottitle" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="noticeTo">Notice For</label>
                                            <select name="noticeTo" class="form-control" required>
                                                <option value="">Select Recipient</option>
                                                <option value="faculty">Faculty</option>
                                                <option value="staff">Staff</option>
                                                <option value="record_examiners">Record Examineer</option>
                                                <option value="student">Student</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="notmsg">Message</label>
                                            <textarea name="notmsg" class="form-control" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Send</button>
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
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
</body>
</html>
<?php } ?>
