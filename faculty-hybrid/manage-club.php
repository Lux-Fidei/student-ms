<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (empty($_SESSION['sturecmfacaid'])) {
    header('location:logout.php');
    exit;
}

$isClubAdviser = false;
$clubID = null;

// Check if the logged-in user is a club adviser
if (!empty($_SESSION['sturecmfacaid'])) {
    $adviserID = $_SESSION['sturecmfacaid'];
    $sql = "SELECT * FROM tbl_club WHERE AdviserID = :adviser_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':adviser_id', $adviserID, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $isClubAdviser = true;
        $clubID = $row['ClubID'];
        $clubName = $row['ClubName'];
    }
}

// Handle adding club members
if (isset($_POST['add_member']) && $isClubAdviser) {
    $studentName = $_POST['student_name'];
    $position = $_POST['position'];

    // Check if the student is already a member of the club
    $sqlCheckMember = "SELECT * FROM tbl_club_members WHERE ClubID = :club_id AND Position = :position AND StudentID = (SELECT ID FROM tblstudent WHERE CONCAT(FirstName, ' ', LastName) = :student_name)";
    $queryCheckMember = $dbh->prepare($sqlCheckMember);
    $queryCheckMember->bindParam(':club_id', $clubID, PDO::PARAM_INT);
    $queryCheckMember->bindParam(':position', $position, PDO::PARAM_STR);
    $queryCheckMember->bindParam(':student_name', $studentName, PDO::PARAM_STR);
    $queryCheckMember->execute();
    $memberExists = $queryCheckMember->fetch(PDO::FETCH_ASSOC);

    if ($memberExists) {
        echo '<script>alert("This student is already a member of the club with the selected position.")</script>';
    } else {
        // If the selected position is not "Member", check if another student already holds the position
        if ($position !== "Member") {
            $sqlCheckPosition = "SELECT * FROM tbl_club_members WHERE ClubID = :club_id AND Position = :position";
            $queryCheckPosition = $dbh->prepare($sqlCheckPosition);
            $queryCheckPosition->bindParam(':club_id', $clubID, PDO::PARAM_INT);
            $queryCheckPosition->bindParam(':position', $position, PDO::PARAM_STR);
            $queryCheckPosition->execute();
            $positionTaken = $queryCheckPosition->fetch(PDO::FETCH_ASSOC);

            if ($positionTaken) {
                echo '<script>alert("Another student already holds the selected position. Only one student can hold this position at a time.")</script>';
            } else {
                // Retrieve StudentID from the database based on the entered student name
                $sqlStudent = "SELECT ID FROM tblstudent WHERE CONCAT(FirstName, ' ', LastName) = :student_name";
                $queryStudent = $dbh->prepare($sqlStudent);
                $queryStudent->bindParam(':student_name', $studentName, PDO::PARAM_STR);
                $queryStudent->execute();
                $rowStudent = $queryStudent->fetch(PDO::FETCH_ASSOC);
                if ($rowStudent) {
                    $studentID = $rowStudent['ID'];

                    // Insert club member
                    $insertMemberSQL = "INSERT INTO tbl_club_members (ClubID, StudentID, Position) VALUES (:club_id, :student_id, :position)";
                    $insertMemberQuery = $dbh->prepare($insertMemberSQL);
                    $insertMemberQuery->bindParam(':club_id', $clubID, PDO::PARAM_INT);
                    $insertMemberQuery->bindParam(':student_id', $studentID, PDO::PARAM_INT);
                    $insertMemberQuery->bindParam(':position', $position, PDO::PARAM_STR);
                    $insertMemberQuery->execute();
                    echo '<script>alert("Club member added successfully.")</script>';
                } else {
                    echo '<script>alert("Student not found.")</script>';
                }
            }
        } else {
            // Retrieve StudentID from the database based on the entered student name
            $sqlStudent = "SELECT ID FROM tblstudent WHERE CONCAT(FirstName, ' ', LastName) = :student_name";
            $queryStudent = $dbh->prepare($sqlStudent);
            $queryStudent->bindParam(':student_name', $studentName, PDO::PARAM_STR);
            $queryStudent->execute();
            $rowStudent = $queryStudent->fetch(PDO::FETCH_ASSOC);
            if ($rowStudent) {
                $studentID = $rowStudent['ID'];

                // Insert club member
                $insertMemberSQL = "INSERT INTO tbl_club_members (ClubID, StudentID, Position) VALUES (:club_id, :student_id, :position)";
                $insertMemberQuery = $dbh->prepare($insertMemberSQL);
                $insertMemberQuery->bindParam(':club_id', $clubID, PDO::PARAM_INT);
                $insertMemberQuery->bindParam(':student_id', $studentID, PDO::PARAM_INT);
                $insertMemberQuery->bindParam(':position', $position, PDO::PARAM_STR);
                $insertMemberQuery->execute();
                echo '<script>alert("Club member added successfully.")</script>';
            } else {
                echo '<script>alert("Student not found.")</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System || Add Club Members</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
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
                    <h3 class="page-title"> Add Club Members </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Club Members</li>
                        </ol>
                    </nav>
                </div>

                <?php if($isClubAdviser): ?>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Members to <?php echo htmlspecialchars($clubName); ?></h4>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Student Name</label>
                                        <input type="text" class="form-control" name="student_name"  placeholder="Enter First Name and Last Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select class="form-control" name="position" required>
                                            <option value="">Select Position</option>
                                            <option value="President">President</option>
                                            <option value="Vice President">Vice President</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Auditor">Auditor</option>
                                            <option value="Member">Member</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="add_member">Add Member</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Members of <?php echo htmlspecialchars($clubName); ?></h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Position</th>
                                <th>Action</th> <!-- New column for action -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT cm.StudentID, CONCAT(s.FirstName, ' ', s.LastName) AS StudentName, cm.Position FROM tbl_club_members cm INNER JOIN tblstudent s ON cm.StudentID = s.ID WHERE cm.ClubID = :club_id";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':club_id', $clubID, PDO::PARAM_INT);
                            $query->execute();
                            $members = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($members as $member) {
                                echo '<tr>';
                                echo '<td>'.htmlspecialchars($member['StudentName']).'</td>';
                                echo '<td>'.htmlspecialchars($member['Position']).'</td>';
                                echo '<td><a href="delete_member.php?student_id='.$member['StudentID'].'" class="btn btn-danger btn-sm">Delete</a></td>'; // Delete action button
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

                <?php else: ?>
                <p>You are not a club adviser.</p>
                <?php
                endif; ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- Include footer -->
                <?php include_once('includes/footer.php');?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
    </body>
    </html>

