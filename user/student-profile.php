<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
}
else {
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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container-scroller">
      <?php include_once('includes/header.php');?>
      <div class="container-fluid page-body-wrapper">
        <?php include_once('includes/sidebar.php');?>
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
                    $sid=$_SESSION['sturecmsstuid'];
                    $sql="SELECT tblstudent.StudentName,tblstudent.StudentEmail,tblstudent.Gender,tblstudent.DOB,tblstudent.StuID,tblstudent.FatherName,tblstudent.MotherName,tblstudent.ContactNumber,tblstudent.AltenateNumber,tblstudent.Address,tblstudent.UserName,tblstudent.Password,tblstudent.Image,tblstudent.DateofAdmission from tblstudent where tblstudent.StuID=:sid";
                    $query = $dbh -> prepare($sql);
                    $query->bindParam(':sid',$sid,PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    ?>
                    <h4 style="margin-bottom: 16px">Personal Details</h4>
                    <div style="display: flex; justify-content: center">
                      <img src=".images/faces/<?php echo $results[0]->Image;?>" width="200" height="200" style="border:solid 1px #000; border-radius: 50%">
                    </div>
                    <div style="display: flex; flex-direction: row; justify-content: space-evenly; margin-top: 32px;">
                      <div style="display: flex;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px">
                          <span style="color: #a4a4a4; margin-bottom: 8px">Name:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Date of Birth:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Gender:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Address:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Phone Number:</span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->StudentName;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->DOB;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Gender;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->Address;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->ContactNumber;?></span>
                        </div>
                      </div>
                      <div style="display: flex;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px">
                          <span style="color: #a4a4a4; margin-bottom: 8px">Father's Name:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Mother's Name:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Alternate Phone Number:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Email:</span>
                          <span style="color: #a4a4a4; margin-bottom: 8px">Learner's Reference Number (LRN):</span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->FatherName;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->MotherName;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->AltenateNumber;?></span>
                          <span style="color: orange; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->StudentEmail;?></span>
                          <span style="color: #1f2335; font-weight: bold; margin-bottom: 8px"><?php echo $results[0]->StuID;?></span>
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