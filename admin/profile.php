<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || View Admin Profile</title>
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        .header {
            display: flex;
            align-items: center;
        }
        .header img {
            max-width: 100px; /* Adjust the size of the logo as needed */
            margin-right: 10px;
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
        .card {
            border-radius: 16px;
        }

        .profile-details {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .profile-details img {
            border: 1px solid #000;
            border-radius: 50%;
        }

        .container-box {
            border: 2px solid #000;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #b3cc9a;
            position: relative;
            overflow: hidden;
        
        }

        .subheading {
            font-weight: bold;
            margin-bottom: 16px;
            border-bottom: 1px solid #000;
            padding-bottom: 8px;
            color:#000;
        }

        .content-section {
            margin-top: 20px;
            position: relative;
            z-index: 1;
        }

        h4 {
            text-align: left;
            margin: 0;
            font-size: 17px;
            font-weight: 300;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <?php include_once('includes/header.php'); ?>
    <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">View Admin Profile</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> View Admin Profile
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card" style="border-radius: 16px">
                            <div class="card-body">
                                <?php
                                $aid = $_SESSION['sturecmsaid'];
                                $sql = "SELECT * FROM tbladmin WHERE ID=:aid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':aid', $aid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                ?>
                                <div class="container-box">
                                    <div class="header">
                                        <img src="images/GRADIENT.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
                                        <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo"> <!-- Change "logo.png" to the path of your logo -->
                                        <div>
                                            <h4>Republic Of The Philippines</h4>
                                            <h4 class="university-name">MINDANAO STATE UNIVERSITY</h4>
                                            <h4 class="school">SENIOR HIGH SCHOOL</h4>
                                            <h4>Marawi City</h4>
                                        </div>
                                    </div>
                                    <hr style="border-color:black;border:1px solid gold;"></hr>
                                    <div class="profile" style="font-weight: bold; align-items: center; color:#181824; font-family:'Times New Roman', Times, serif ">PROFILE</div>
                                    <div class="content-section">
                                        <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                                            <img src="../admin/images/<?php echo $results[0]->AdminImage; ?>"
                                                 width="200" height="200" style="border:solid 1px #000; border-radius: 50%">
                                            <span style="color: #000; font-weight: bold; margin-top: 8px;"><?php echo $results[0]->FirstName . ' ' . $results[0]->MiddleName . ' ' . $results[0]->LastName .' | Director' ?></span>
                                        </div>
                                        <div class="subheading">ADMIN INFORMATION</div>
                                        <div
                                            style="display: flex; flex-direction: row; justify-content: left; margin-top: 32px;">
                                            <div style="display: flex;">
                                                <div style="display: flex; flex-direction: column; margin-right: 16px">
                                                    <span style="color: #000; margin-bottom: 8px">Admin ID:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Last Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">First Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Middle Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Gender:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Age:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Mobile Number:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Email:</span>
                                                    <!-- Add more fields as needed -->
                                                </div>
                                           
                                                <div style="display: flex; flex-direction: column">
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->ID;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->LastName;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FirstName;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MiddleName;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Gender;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Age;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MobileNumber;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Email;?></span>
                                                    <!-- Display more fields as needed -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add more sections for additional information if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php } ?>
