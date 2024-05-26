<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmtaid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Management System || View Faculty Profile</title>
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
            background-color: #f7ecd6;
            position: relative;
            overflow: hidden;
            background-image: url(images/watermark.png);
            background-size: 500px;
            background-repeat: no-repeat;
            background-position:center;
            
            
            

        
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
                    <h3 class="page-title">View Faculty Profile</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> View Faculty Profile
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card" style="border-radius: 16px">
                            <div class="card-body">
                                <?php
                                $fid = $_GET['UserAccountID'];
                                $sql = "SELECT *
                                        FROM tblfaculty
                                        WHERE UserAccountID = :fid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':fid', $fid, PDO::PARAM_STR);
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
                                            <img src="../admin/images/<?php echo $results[0]->Image; ?>"
                                                 width="200" height="200" style="border: solid 1px #000; border-radius: 50%">
                                            <span style="color: #000; font-weight: bold; margin-top: 8px;">
                                                <?php 
                                                echo $results[0]->FirstName . ' ' . $results[0]->MiddleInitial . ' ' . $results[0]->LastName . ' | ' . $results[0]->position;
                                                if (isset($results[0]->ClubName)) {
                                                    echo ' | Club Adviser: ' . $results[0]->ClubName;
                                                }
                                                ?>
                                                
                                            </span>
                                        </div><br>
                                        <div class="subheading" style="font-weight: bold; align-items: center; color:#181824; font-family:'Times New Roman', Times, serif">PERSONAL INFORMATION</div>
                                        <div style="display: flex; flex-direction: row; justify-content: left; margin-top: 32px;">
                                            <div style="display: flex;">
                                                <div style="display: flex; flex-direction: column; margin-right: 16px">
                                                    <span style="color: #000; margin-bottom: 8px">Last Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">First Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Middle Initial:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Email:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Age:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Gender:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Address:</span>
                                                    <span
                                                    style="color: #000; margin-bottom: 8px">Contact Number:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Position</span>
                                                    <!-- Add other fields here -->
                                                </div>
                                                <div style="display: flex; flex-direction: column">
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->LastName;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FirstName;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MiddleInitial;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Email;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Age;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Gender;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Address;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Contact;?></span>
                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->position;?></span>
                                                    <!-- Add other fields here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="subheading" style="font-family: 'Times New Roman', Times, serif;">MATRIX</div>
                                    <div class="content-section">
                                        <!-- Add other information fields here -->
                                    </div>

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