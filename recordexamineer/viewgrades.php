<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if user is logged in
if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
} else {
    // Fetch grades for the logged-in student
    $studentID = $_SESSION['sturecmsaid'];
    $sql = "SELECT * FROM tblgrades WHERE StuID = :studentID";
    $query = $dbh->prepare($sql);
    $query->bindParam(':studentID', $studentID, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grades</title>
    <!-- CSS Styles -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <style>
        /* Adjustments to fix form alignment */
        .container {
            margin-left: 240px; /* Adjust this value according to your sidebar width */
            padding: 20px;
        }

        .main-panel {
            width: calc(100% - 240px); /* Adjust this value according to your sidebar width */
            transition: all 0.3s;
        }

        @media (max-width: 991.98px) {
            .container {
                margin-left: 0;
            }

            .main-panel {
                width: 100%;
            }
        }

        /* Custom styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: black;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">View Grades</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>First Grading</th>
                                <th>Second Grading</th>
                                <th>Semester</th>
                                <th>Faculty</th>
                                <th>Units</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row): ?>
                                <tr>
                                    <td><?php echo $row['Subject']; ?></td>
                                    <td><?php echo $row['FirstGrading']; ?></td>
                                    <td><?php echo $row['SecondGrading']; ?></td>
                                    <td><?php echo $row['Semester']; ?></td>
                                    <td><?php echo $row['Faculty']; ?></td>
                                    <td><?php echo $row['Units']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
