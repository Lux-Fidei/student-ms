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
    $clubName = '';

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
            $sql = "SELECT ClubName FROM tbl_club WHERE AdviserID = :faculty_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':faculty_id', $adviserID, PDO::PARAM_INT);
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
if (isset($_POST['add_member']) && $isClubAdviser) {
    $studentName = $_POST['student_name'];
    $position = $_POST['position'];

    // Retrieve ClubID from the database based on the logged-in user's ID
    $clubID = null;
    $sql = "SELECT ClubID FROM tbl_club WHERE AdviserID = :adviser_id";
    try {
        $query = $dbh->prepare($sql);
        $query->bindParam(':adviser_id', $adviserID, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $clubID = $row['ClubID'];

            // Retrieve StudentID from the database based on the entered student name
            $studentID = null;
            $sqlStudent = "SELECT ID FROM tblstudent WHERE StudentName = :student_name";
            try {
                $queryStudent = $dbh->prepare($sqlStudent);
                $queryStudent->bindParam(':student_name', $studentName, PDO::PARAM_STR);
                $queryStudent->execute();
                $rowStudent = $queryStudent->fetch(PDO::FETCH_ASSOC);
                if ($rowStudent) {
                    $studentID = $rowStudent['ID'];

                    // Insert club member
                    $insertMemberSQL = "INSERT INTO tbl_club_members (ClubID, StudentID, Position) VALUES (:club_id, :student_id, :position)";
                    try {
                        $insertMemberQuery = $dbh->prepare($insertMemberSQL);
                        $insertMemberQuery->bindParam(':club_id', $clubID, PDO::PARAM_INT);
                        $insertMemberQuery->bindParam(':student_id', $studentID, PDO::PARAM_INT);
                        $insertMemberQuery->bindParam(':position', $position, PDO::PARAM_STR);
                        $insertMemberQuery->execute();
                        echo '<script>alert("Club member added successfully.")</script>';
                    } catch (PDOException $e) {
                        echo '<script>alert("Error adding club member: ' . $e->getMessage() . '")</script>';
                    }
                } else {
                    echo '<script>alert("Error retrieving StudentID: Student not found.")</script>';
                }
            } catch (PDOException $e) {
                echo '<script>alert("Error retrieving StudentID: ' . $e->getMessage() . '")</script>';
            }
        } else {
            echo '<script>alert("Error retrieving ClubID: Club not found.")</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Error retrieving ClubID: ' . $e->getMessage() . '")</script>';
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
                                                $sql = "SELECT cm.StudentID, s.StudentName, cm.Position FROM tbl_club_members cm INNER JOIN tblstudent s ON cm.StudentID = s.ID WHERE cm.ClubID = :club_id";
                                                try {
                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':club_id', $clubID, PDO::PARAM_INT);
                                                    $query->execute();
                                                    $members = $query->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($members as $member) {
                                                        echo '<tr>';
                                                        echo '<td>'.$member['StudentName'].'</td>';
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
