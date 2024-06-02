<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmfacaid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Subject Teacher</title>
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
  <div class="container-scroller">
    <?php include_once('includes/header.php');?>
    <div class="container-fluid page-body-wrapper">
      <?php include_once('includes/sidebar.php');?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row purchace-popup">
            <div class="col-12 stretch-card grid-margin">
              <card class="card-secondary" style="width:100%">
                <form action="grades.php" method="post" name="submit" style="display: flex; justify-content: center; width: 100%">
                  <div class="form-group">
                    <label for="class">Select Class:</label>
                    <select name="class" id="class" class="form-control" required="true" style="width: 256px" onchange="this.form.submit()">
                      <option value="">Select Class</option>
                      <?php
                        $uid = $_SESSION['sturecmfacaid'];
                        $sql = "SELECT tblsubjects.SubjectName, schedule.schedule_id  
                        FROM enrollments 
                        JOIN schedule ON enrollments.class_id = schedule.schedule_id 
                        JOIN tblsubjects ON schedule.subject_id = tblsubjects.SubjectID 
                        WHERE schedule.faculty_id = :uid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                          foreach ($results as $row) {
                            echo "<option value='" . htmlentities($row->schedule_id) . "'>" . htmlentities($row->SubjectName) . "</option>";
                            $cnt = $cnt + 1;
                          }
                        }
                      ?>
                    </select>
                  </div>
                </form>
              </card>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php } ?>