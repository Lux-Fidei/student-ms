<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmtaid']==0)) {
  header('location:logout.php');
  } else{
   
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| View Notice</title>
    <!-- plugins:css -->
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
    <link rel="stylesheet" href="./css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> View Notice </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> View Notice</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          

              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                  <div class="header" style="padding: 16px 16px 0 16px; display: flex; justify-content: center; width: 100%; margin-bottom: 16px">
                  <div style="display: flex; flex-direction: row; justify-content: center">
                    <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo" width="96px" style="margin-right: 16px">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                      <span style="text-align: center; font-family:'Times New Roman' , Times, serif; font-size:medium">Republic of the Philippines</span>
                    <span style="color: #5f1227;text-align: center; font-family:'Times New Roman' , Times, serif;">MINDANAO STATE UNIVERSITY</span>
                    <span  style="color: #055727;text-align: center; font-family:'Times New Roman' , Times, serif;">SENIOR HIGH SCHOOL</span>
                    <span style="text-align: center; font-family:'Times New Roman' , Times, serif; font-size:medium">Marawi City</span>
                    </div>
                    
                    <img src="images/MSU-Marawi.png" alt="Logo" width="96px">
                  </div>
              </div>
                    <table border="1" class="table table-bordered mg-b-0">
                      <?php
                        $stuclass="staff";
                        $sql="SELECT * FROM tblnotice WHERE NoticeTo = :sentTo";
                        $query = $dbh -> prepare($sql);
                        $query->bindParam(':sentTo',$stuclass,PDO::PARAM_STR);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                        foreach($results as $row)
                        {
                      ?>
 <tr align="center">
<td colspan="4">
 Notice</td></tr>
<tr>
    <th>Notice Announced Date</th>
    <td><?php echo date("F j, Y | h:i A", strtotime($row->CreationDate)); ?></td>
  </tr>
    <tr>
    <th>Noitice Title</th>
    <td><?php  echo $row->NoticeTitle;?></td>
  </tr>
  <tr>
     <th>Message</th>
    <td><?php  echo $row->NoticeMsg;?></td>
     
  </tr>
  
  <?php $cnt=$cnt+1;}} else { ?>
<tr>
  <th colspan="2" style="color:red;">No Notice Found</th>
</tr>
  <?php } ?>
</table>
                  </div>
        </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
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
</html><?php }  ?>