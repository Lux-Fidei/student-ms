<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (empty($_SESSION['sturecmfacaid'])) {
    header('location:logout.php');
    exit;
} 

// Function to handle database errors
function handleDBError($message) {
    echo '<script>alert("' . $message . '")</script>';
}

$isClubAdviser = false;

// Check if the logged-in user is a club adviser
if (!empty($_SESSION['sturecmfacaid'])) {
    $adviserID = $_SESSION['sturecmfacaid'];
    $sql = "SELECT * FROM tblfaculty WHERE ID = :adviser_id";
    try {
        $query = $dbh->prepare($sql);
        $query->bindParam(':adviser_id', $adviserID, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row && $row['IsClubAdviser'] == 1) {
            $isClubAdviser = true;
            // Fetch the club name assigned to the faculty member
            $facultyID = $_SESSION['sturecmfacaid'];
            $clubName = '';
            $sql = "SELECT ClubName FROM tbl_club WHERE AdviserID = :faculty_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':faculty_id', $facultyID, PDO::PARAM_INT);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $clubName = $row['ClubName'];
            }
        }
    } catch (PDOException $e) {
        handleDBError("Error retrieving user information: " . $e->getMessage());
    }
}


// Handle adding club members
if (isset($_POST['add_member'])) {
    $studentID = $_POST['student'];
    $position = $_POST['position'];

    // Check if ClubID is set
    if (!empty($_POST['club_id'])) {
        $clubID = $_POST['club_id'];
        $insertMemberSQL = "INSERT INTO tbl_club_members (ClubID, StudentID, Position) VALUES (:club_id, :student_id, :position)";
        try {
            $insertMemberQuery = $dbh->prepare($insertMemberSQL);
            $insertMemberQuery->bindParam(':club_id', $clubID, PDO::PARAM_INT);
            $insertMemberQuery->bindParam(':student_id', $studentID, PDO::PARAM_INT);
            $insertMemberQuery->bindParam(':position', $position, PDO::PARAM_STR);
            $insertMemberQuery->execute();
        } catch (PDOException $e) {
            handleDBError("Error adding club member: " . $e->getMessage());
        }
    } else {
        handleDBError("Error adding club member: Club ID is not set.");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System || Add Club</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
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
                        <h3 class="page-title"> Club: <?php echo $clubName; ?></h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> Add Club</li>
                            </ol>
                        </nav>
                    </div>
                    <?php if($isClubAdviser): ?>
                    <!-- Club adviser form -->
                   
                    <!-- Club member form -->
                    <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Club Members</h4>
                <form method="post">
                    <div class="form-group">
                        <label>Student Name</label>
                        <input type="text" class="form-control" name="student_name" id="student_name" required>
                    </div>
                    <div class="form-group">
                        <label>Student ID</label>
                        <input type="text" class="form-control" name="student_id" id="student_id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <select class="form-control" name="position" required>
                            <option value="">Select Position</option>
                            <option value="officer">Officer</option>
                            <option value="member">Member</option>
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
                <h4 class="card-title">Added Club Members</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display added members here -->
                            <?php
                            $sql = "SELECT * FROM tbl_club_members WHERE ClubID = :club_id";
                            try {
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':club_id', $lastInsertId, PDO::PARAM_INT); // Assuming $lastInsertId is the ClubID
                                $query->execute();
                                $members = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($members as $member) {
                                    echo '<tr>';
                                    echo '<td>'.$member['StudentID'].'</td>';
                                    echo '<td>'.$member['Position'].'</td>';
                                    echo '</tr>';
                                }
                            } catch (PDOException $e) {
                                handleDBError("Error retrieving club members: " . $e->getMessage());
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to fetch and display Student ID based on entered name
    document.getElementById('student_name').addEventListener('input', function() {
        var studentName = this.value;
        // Make an AJAX request to fetch Student ID based on name
        // Assuming an endpoint called fetch_student_id.php is available
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_student_id.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('student_id').value = xhr.responseText;
            }
        };
        xhr.send('student_name=' + studentName);
    });
</script>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Include footer -->
    <?php include_once('includes/footer.php');?>
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
