<?php
session_start();
error_reporting(0);
if (empty($_SESSION['record_examineer_id'])) {
    header('location:login.php'); // Redirect to the login page
    exit();
}

include('includes/dbconnection.php'); // Include the database connection

// Fetch faculties with their names 
function getFaculties($dbh) {
    $sql = "SELECT ID, CONCAT(FirstName, ' ', MiddleInitial, '. ', LastName) as FullName FROM tblfaculty";
    $query = $dbh->query($sql);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

$faculties = getFaculties($dbh);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    $evaluationSql = "SELECT question_id, 
                             SUM(CASE WHEN answer = 'Always' THEN 1 ELSE 0 END) as always_count,
                             SUM(CASE WHEN answer = 'Often' THEN 1 ELSE 0 END) as often_count,
                             SUM(CASE WHEN answer = 'Sometimes' THEN 1 ELSE 0 END) as sometimes_count,
                             SUM(CASE WHEN answer = 'Seldom' THEN 1 ELSE 0 END) as seldom_count,
                             SUM(CASE WHEN answer = 'Never' THEN 1 ELSE 0 END) as never_count
                      FROM tbl_evaluation 
                      WHERE teacher_id = :teacher_id 
                      GROUP BY question_id";
    $stmt = $dbh->prepare($evaluationSql);
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->execute();
    $evaluations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalAnswersSql = "SELECT COUNT(*) as total_answers FROM tbl_evaluation WHERE teacher_id = :teacher_id";
    $stmt = $dbh->prepare($totalAnswersSql);
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->execute();
    $totalAnswers = $stmt->fetch(PDO::FETCH_ASSOC);

    $commentsSql = "SELECT comment FROM tbl_evaluation_comments WHERE teacher_id = :teacher_id";
    $stmt = $dbh->prepare($commentsSql);
    $stmt->bindParam(':teacher_id', $teacher_id, PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['evaluations' => $evaluations, 'total_answers' => $totalAnswers['total_answers'], 'comments' => $comments]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Record Examiner Management System | Dashboard</title>
    <!-- Include CSS and other necessary files here -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
</head>
<body>
    <div class="container-scroller">
        <!-- Include navbar -->
        <?php include_once('includes/header.php');?>
        <div class="container-fluid page-body-wrapper">
            <!-- Include sidebar -->
            <?php include_once('includes/sidebar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row purchace-popup">
                        <div class="col-12 stretch-card grid-margin">
                            <div class="card card-secondary">
                                <span class="card-body d-lg-flex align-items-center">
                                    <p class="mb-lg-0">Notices from the school kindly check! </p>
                                    <a href="view-notice.php" target="_blank" class="btn btn-warning purchase-button btn-sm my-1 my-sm-0 ml-auto">View Notice</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Faculty Evaluations</h4>
                                    <div class="dropdown">
                                        <select id="facultySelect" class="form-control">
                                            <option value="" selected disabled>Select Faculty</option>
                                            <?php foreach ($faculties as $faculty) {
                                                echo "<option value='".$faculty['ID']."'>".$faculty['FullName']."</option>";
                                            } ?>
                                        </select>
                                    </div>
                                    <div id="evaluationSummaryDiv">
                                        <!-- Evaluation Summary Table will be loaded here -->
                                    </div>
                                    <div id="commentsTableDiv">
                                        <!-- Comments Table will be loaded here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Include footer -->
              
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script>
        document.getElementById("facultySelect").addEventListener("change", function() {
            var facultyId = this.value;
            fetchEvaluationData(facultyId);
        });

        function fetchEvaluationData(facultyId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    createAndPopulateEvaluationSummaryTable(response.evaluations, response.total_answers);
                    createAndPopulateCommentsTable(response.comments);
                }
            };
            xhr.send("teacher_id=" + facultyId);
        }

        function createAndPopulateEvaluationSummaryTable(evaluations, totalAnswers) {
    var tableDiv = document.getElementById("evaluationSummaryDiv");
    var tableHTML = "<table class='table table-striped'><thead><tr><th>Question No.</th><th>Question ID</th><th>Always</th><th>Often</th><th>Sometimes</th><th>Seldom</th><th>Never</th></tr></thead><tbody>";
    evaluations.forEach(function(evaluation, index) {
        tableHTML += "<tr><td>" + (index + 1) + "</td><td>" + evaluation.question_id + "</td><td>" + evaluation.always_count + "</td><td>" + evaluation.often_count + "</td><td>" + evaluation.sometimes_count + "</td><td>" + evaluation.seldom_count + "</td><td>" + evaluation.never_count + "</td></tr>";
    });
    tableHTML += "</tbody></table>";
    tableHTML += "<p>Total Answers: " + totalAnswers + "</p>";
    tableDiv.innerHTML = tableHTML;
}

        function createAndPopulateCommentsTable(comments) {
            var tableDiv = document.getElementById("commentsTableDiv");
            var tableHTML = "<table class='table table-striped'><thead><tr><th>Name of Respondents</th></tr></thead><tbody>";
            comments.forEach(function(comment) {
                tableHTML += "<tr><td>" + comment.comment + "</td></tr>";
            });
            tableHTML += "</tbody></table>";
            tableDiv.innerHTML = tableHTML;
        }
    </script>
    <style>
           .content-wrapper {
        background-image: url(images/staff.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  padding: 2.75rem 1.5rem 0;
  width: 100%;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1; 
}
    </style>
</body>
</html>
