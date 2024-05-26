<?php
session_start();
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || View Students Profile</title>
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
            background-color: #f0f0f0;
            position: relative;
            overflow: hidden;
            background-image: url(images/watermark.png);
            background-size: 400px;
            background-repeat: no-repeat;
            background-position: center;
            
            
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
                    <h3 class="page-title">View Student Profile</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"> View Students Profile
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card" style="border-radius: 16px">
                            <div class="card-body">
                                <?php
                                $sid = $_SESSION['sturecmsstuid'];
                                $sql = "SELECT s.*, c.ClubName, cm.Position
                                        FROM tblstudent s
                                        LEFT JOIN tbl_club_members cm ON s.ID = cm.StudentID
                                        LEFT JOIN tbl_club c ON cm.ClubID = c.ClubID
                                        WHERE s.LRN = :sid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
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
                                                 width="200" height="200" style="border:solid 1px #000; border-radius: 50%">
                                            <span style="color: #000; font-weight: bold; margin-top: 8px;"><?php echo $results[0]->FirstName . ' ' . $results[0]->MiddleInitial . ' ' . $results[0]->LastName .' | ' . $results[0]->Strand .' '. $results[0]->GradeLevel.'-'.$results[0]->section?></span>
                                        </div><br>
                                        <div class="subheading">PERSONAL INFORMATION</div>
                                        <div
                                            style="display: flex; flex-direction: row; justify-content: left; margin-top: 32px;">
                                            <div style="display: flex;">
                                                <div style="display: flex; flex-direction: column; margin-right: 16px">
                                                    <span style="color: #000; margin-bottom: 8px">Last Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">First Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Middle Name:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Gender:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Age:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Date of Birth:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Place of Birth:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Current Address:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Permanent                                             Address:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Contact Number:</span>
                                                    <span style="color: #000; margin-bottom: 8px">Email Address:</span>
                                                    </div>
                                                    <div style="display: flex; flex-direction: column">
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->LastName;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FirstName;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MiddleInitial;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Gender;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Age;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->DOB;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->PlaceOfBirth;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->CurrentAddress;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->PermanentAddress;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->ContactNo;?></span>
                                                <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->EmailAddress;?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="subheading">ACADEMIC DETAILS</div>
                                <div class="content-section">
                                    <div style="display: flex;">
                                        <div style="display: flex; flex-direction: column; margin-right: 21px">
                                            <span style="color: #000; margin-bottom: 8px">Track/Strand:</span>
                                            <span style="color: #000; margin-bottom: 8px">Grade Level:</span>
                                            <span style="color: #000; margin-bottom: 8px">Learner's Reference Number:</span>
                                            <span style="color: #000; margin-bottom: 8px">School Last Attended:</span>
                                        </div>
                                        <div style="display: flex; flex-direction: column">
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Strand;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->GradeLevel;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->LRN;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->SchoolLastAttended;?></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="subheading">PARENTS/GUARDIANS DETAILS</div>
                                <div class="content-section">
                                    <div style="display: flex;">
                                        <div style="display: flex; flex-direction: column; margin-right: 21px">
                                            <span style="color: #000; margin-bottom: 8px">Father's Name:</span>
                                            <span style="color: #000; margin-bottom: 8px">Father's Contact Number:</span>
                                            <span style="color: #000; margin-bottom: 8px">Mother’s Name:</span>
                                            <span style="color: #000; margin-bottom: 8px">Mother's Contact Number:</span>
                                            <span style="color: #000; margin-bottom: 8px">Contact Number (in case of emergency):</span>
                                            <span style="color: #000; margin-bottom: 8px">Year Admitted:</span>
                                        </div>
                                        <div style="display: flex; flex-direction: column">
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FatherName;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FatherContactNumber;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MotherName;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MotherContactNumber;?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->EmergencyContactNumber?></span>
                                            <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->YearAdmitted;?></span>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="subheading">CLUB MEMBERSHIP</div>
                                        <div class="content-section">
                                            <?php if (!empty($results[0]->ClubName)): ?>
                                                    <div class="content-section">
                                                        <div style="display: flex;">
                                                            <div style="display: flex; flex-direction: column; margin-right: 21px">
                                                                <span style="color: #000; margin-bottom: 8px">Club Name:</span>
                                                                <span style="color: #000; margin-bottom: 8px">Position:</span>
                                                            </div>
                                                            <div style="display: flex; flex-direction: column">
                                                                <?php foreach ($results as $row): ?>
                                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $row->ClubName;?></span>
                                                                    <span style="color: #000; font-weight: bold; margin-bottom: 8px"><?php echo $row->Position;?></span>
                                                                <?php endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <p>No club membership information available.</p>
                                            <?php endif; ?>
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
    </div>
    </div>
</div>
</div>
</body>
</html>
<?php } ?>
