<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid'])) {
    header('location:logout.php');
    exit(); // Added exit() to prevent further execution
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Login History</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
        }

        .container-scroller {
            min-height: 100vh;
        }
        .page-body-wrapper.full-page-wrapper {
         width: 100%;
         min-height: 0;
        }

        .full-page-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .auth-form-light {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px -6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            padding: 30px;
        }

        .table thead th {
  border-top: 0;
  border-bottom-width: 1px;
  font-family: "Open Sans", sans-serif;
  font-weight: 600;
  font-weight: initial;
  color: white;
}
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #417b2c;
            font-weight: bold;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 45px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn {
        font-size: 0.875rem;
        line-height: 1;
        font-family: "Open Sans", sans-serif;
        font-weight: 600;
        margin-top: -7em;
        }

        /* Add grid lines to table */
        .table th,
        .table td {
            border: 1px solid #000;
        }
        .header {
            display: flex;
            align-items: center;
            margin-left: 9em;
        }
        .header img {
            max-width: 100px; /* Adjust the size of the logo as needed */
            margin-right: 10px;
        }
        h4 {
            text-align: left;
            margin: 0;
            font-size: 17px;
            font-weight: 300;
            font-family: Arial, Helvetica, sans-serif;
        }
        .university-name {
            color: maroon;
            font-size: 20px;
            font-weight: bold;
            font-family: 'Times New Roman', Times, serif;
        }
        .school {
            color: black;
            font-size: 19px;
            font-family: 'Times New Roman', Times, serif;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #fff;
            font-family: 'Times New Roman', Times, serif;
            word-spacing: 15px;
        }
    </style>
</head>

<body>
<div class="header">
        <img src="images/GRADIENT.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
        <div>
            <h4>Republic Of The Philippines</h4>
            <h4 class="university-name">MINDANAO STATE UNIVERSITY</h4>
            <h4 class="school">SENIOR HIGH SCHOOL</h4>
            <h4= class="school">Marawi City</h4>
        </div>
    </div>
    <hr style="border-color:black;border:1px solid gold;"></hr>
    <h1 style="background-image: url(images/okirr1.jpg);background-size: contain;">History Of Transaction </h1>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper">
                <div class="row flex-grow">
                    <div class="col-lg-12 mx-auto">
                        <div class="auth-form-light text-left p-5">
                        <div class="mt-4">
                        <a href="dashboard.php" class="btn btn-primary"><</a>
                            </div>
                            <h4>Faculty Login History</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Faculty Name</th>
                                            <th>Position</th>
                                            <th>Login Time</th>
                                            <th>Logout Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT lh.id, CONCAT(f.FirstName, ' ', f.LastName) AS FacultyName, f.Position, lh.login_time, lh.logout_time 
                                            FROM login_history lh
                                            JOIN tblfaculty f ON lh.user_id = f.UserAccountID
                                            ORDER BY lh.login_time DESC";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                                        if ($query->rowCount() > 0) {
                                            $cnt = 1;
                                            foreach ($results as $result) {
                                                echo "<tr>";
                                                echo "<td>" . htmlentities($cnt) . "</td>";
                                                echo "<td>" . htmlentities($result->FacultyName) . "</td>";
                                                echo "<td>" . htmlentities($result->Position) . "</td>";
                                                echo "<td>" . htmlentities($result->login_time) . "</td>";
                                                echo "<td>" . htmlentities($result->logout_time) . "</td>";
                                                echo "</tr>";
                                                $cnt++;
                                                }
                                                }
                                                ?>
                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </body>
                                                </html>
                                                