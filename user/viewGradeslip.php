<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('location:logout.php');
  } else{
  
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <title>Student  Management System|||Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
  
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
        <div class="main-panel"> <button onclick="window.print()" class="print-button">
        <i class="glyphicon glyphicon-print"></i> PRINT
    </button>
        
          <div class="content-wrapper">
            <div class="row purchace-popup">
              <div class="col-12 stretch-card grid-margin">
                <div class="card card-secondary" style="padding: 16px">
                <div class="header" style="padding: 16px 16px 0 16px; display: flex; justify-content: space-between">
                <div style="display: flex; flex-direction: column; justify-content: center">
                  <span>Republic of the Philippines</span>
                  <span style="color: #5f1227;">MINDANAO STATE UNIVERSITY</span>
                  <span  style="color: #055727;">SENIOR HIGH SCHOOL</span>
                  <span>Marawi City</span>
                </div>
                <div>
                  <img src="images/MarawiSeniorHigh-removebg.png" alt="Logo" width="96px" style="margin-right: 32px">
                  <img src="images/MSU-Marawi.png" alt="Logo" width="96px" style="margin-right: 16px">
                </div>
              </div>
              <div style="display: flex; justify-content: center;">
                <hr style="border-color:black; border:1px solid #80d8a8; margin: 16px 0 0 0; width: 99.3%" />
              </div>
                
              <?php
                  if (isset($_POST['submit'])) {
                    $query = "INSERT INTO `request_docs`(`st_id`, `docName`, `isApproved`) VALUES (:st_id, 'Gradeslip', 'Pending')";
                    $query = $dbh->prepare($query);
                    $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                    $query->execute();
                  }
                ?>
                <?php
                $query = "SELECT isApproved FROM request_docs WHERE st_id=:st_id AND docName='Gradeslip'";
                $query = $dbh->prepare($query);
                $query->bindParam(':st_id', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                  <div  style="display: flex; flex-direction: row; justify-content: center">
                    <div style="display: flex; flex-direction: column; width: 50%">
                      <div style="display: flex; flex-direction: row; margin: 0 16px; margin-bottom: 16px;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px ">
                          <span>Full Name: </span>
                          <span>Track and Strand: </span>
                          <span>Grade Level: </span>
                          <span>Semester: </span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <?php
                            $query = "SELECT * FROM tblstudent WHERE LRN=:stuid";
                            $query = $dbh->prepare($query);
                            $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<span style='font-weight: bold'>" . htmlentities($row->FirstName) . ' ' . htmlentities($row->MiddleInitial) . ' ' . htmlentities($row->LastName) . "</span>";
                              echo "<span>" . htmlentities($row->Strand === null ? 'STEAM' : $row->Strand) . "</span>";
                              echo "<span>" . '11' . "</span>";
                              echo "<span>" . '1st Semester' . "</span>";
                            }
                          ?>
                        </div>
                      </div>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                      $query = $dbh->prepare($query);
                      $query->bindParam(':stuid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_ASSOC);
                      $count = $result['count'];

                      if ($count > 0) {
                        ?>
                        <div style="display: flex; justify-content: center;">
                          <table style="border: 1px solid black; width: 96%">
                            <thead style="border: 1px solid black;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center">SUBJECTS</th style="border: 1px solid black; padding: 8px; text-align: center;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">UNITS</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">1st Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">2nd Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">FINAL</th>
                            </thead>
                            <tbody>
                              <?php
                                $query = "SELECT 
                                g.ID, 
                                g.StuID, 
                                g.Subject, 
                                s.SubjectName, 
                                g.FirstGrading, 
                                g.SecondGrading, 
                                g.Semester, 
                                g.Faculty, 
                                g.Units
                            FROM 
                                tblgrades g
                            JOIN 
                                tblsubjects s
                            ON 
                                g.Subject = s.SubjectID
                            WHERE
                                  g.StuID = :stuid;
                            ";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  echo "<tr>";
                                  echo "<td style='border: 1px solid black; text-align: center;font-weight: bold'>" . htmlentities($row->SubjectName) . "</td>";
                                  echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Units) . "</td>";
                                  if ($row->FirstGrading < 75) {
                                    echo "<td style='border: 1px solid black; text-align: center; color: red;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; text-align: center; color: black;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  }
                                  if ($row->SecondGrading < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  }
                                  if (($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units) < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  }
                                  echo "</tr>";
                                }
                              ?>
                              <tr>
                                <td style="border: solid 1px black; text-align: right">TOTAL UNITS:</td>
                                <td style="text-align: center; border: solid 1px black; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      echo htmlentities($row->total_units);
                                    }
                                  ?>
                                </td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">GENERAL AVERAGE:</td>
                                <td style="border: solid 1px black; text-align: center; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $total_units = $row->total_units;
                                    }
                                    $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $general_average = $row->general_average;
                                    }
                                    if ($general_average < 75) {
                                        echo "<span style='color: red;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    } else {
                                      echo "<span style='color: black;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <?php
                          } else {
                            echo "No grades submitted for this Semester.";
                          }
                        ?>
                    </div>
                    <div style="display: flex; flex-direction: column; width: 50%">
                      <div style="display: flex; flex-direction: row; margin: 0 16px; margin-bottom: 16px;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px ">
                          <span>Full Name: </span>
                          <span>Track and Strand: </span>
                          <span>Grade Level: </span>
                          <span>Semester: </span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <?php
                            $query = "SELECT * FROM tblstudent WHERE LRN=:stuid";
                            $query = $dbh->prepare($query);
                            $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<span style='font-weight: bold'>" . htmlentities($row->FirstName) . ' ' . htmlentities($row->MiddleInitial) . ' ' . htmlentities($row->LastName) . "</span>";
                              echo "<span>" . htmlentities($row->Strand === null ? 'STEAM' : $row->Strand) . "</span>";
                              echo "<span>" . '11' . "</span>";
                              echo "<span>" . '2nd Semester' . "</span>";
                            }
                          ?>
                        </div>
                      </div>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                      $query = $dbh->prepare($query);
                      $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_ASSOC);
                      $count = $result['count'];

                      if ($count > 0) {
                        ?>
                        <div style="display: flex; justify-content: center;">
                          <table style="border: 1px solid black; width: 96%">
                            <thead style="border: 1px solid black;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center">SUBJECTS</th style="border: 1px solid black; padding: 8px; text-align: center;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">UNITS</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">1st Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">2nd Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">FINAL</th>
                            </thead>
                            <tbody>
                              <?php
                                $query = "SELECT * FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  echo "<tr>";
                                  echo "<td style='border: 1px solid black; text-align: center;font-weight: bold;'>" . htmlentities($row->Subject) . "</td>";
                                  echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Units) . "</td>";
                                  if ($row->FirstGrading < 75) {
                                    echo "<td style='border: 1px solid black; text-align: center; color: red;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; text-align: center; color: black;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  }
                                  if ($row->SecondGrading < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  }
                                  if (($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units) < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  }
                                  echo "</tr>";
                                }
                              ?>
                              <tr>
                                <td style="border: solid 1px black; text-align: right">TOTAL UNITS:</td>
                                <td style="text-align: center; border: solid 1px black; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      echo htmlentities($row->total_units);
                                    }
                                  ?>
                                </td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">GENERAL AVERAGE:</td>
                                <td style="border: solid 1px black; text-align: center; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $total_units = $row->total_units;
                                    }
                                    $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $general_average = $row->general_average;
                                    }
                                    if ($general_average < 75) {
                                      echo "<span style='color: red;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    } else {
                                      echo "<span style='color: black;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <?php
                          } else {
                            echo "No grades submitted for this Semester.";
                          }
                        ?>
                    </div>
                  </div>
                  <div  style="display: flex; flex-direction: row; justify-content: center; margin: 16px 0">
                    <div style="display: flex; flex-direction: column; width: 50%">
                      <div style="display: flex; flex-direction: row; margin: 0 16px; margin-bottom: 16px;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px ">
                          <span>Full Name: </span>
                          <span>Track and Strand: </span>
                          <span>Grade Level: </span>
                          <span>Semester: </span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <?php
                            $query = "SELECT * FROM tblstudent WHERE LRN=:stuid";
                            $query = $dbh->prepare($query);
                            $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              foreach ($results as $row) {
                                echo "<span style='font-weight: bold'>" . htmlentities($row->FirstName) . ' ' . htmlentities($row->MiddleInitial) . ' ' . htmlentities($row->LastName) . "</span>";
                                echo "<span>" . htmlentities($row->Strand === null ? 'STEAM' : $row->Strand) . "</span>";
                                echo "<span>" . '12' . "</span>";
                                echo "<span>" . '1st Semester' . "</span>";
                              }
                            }
                          ?>
                        </div>
                      </div>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                      $query = $dbh->prepare($query);
                      $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_ASSOC);
                      $count = $result['count'];

                      if ($count > 0) {
                        ?>
                        <div style="display: flex; justify-content: center;">
                          <table style="border: 1px solid black; width: 96%">
                            <thead style="border: 1px solid black;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center">SUBJECTS</th style="border: 1px solid black; padding: 8px; text-align: center;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">UNITS</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">1st Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">2nd Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">FINAL</th>
                            </thead>
                            <tbody>
                              <?php
                                $query = "SELECT * FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  echo "<tr>";
                                  echo "<td style='border: 1px solid black; text-align: center;font-weight: bold'>" . htmlentities($row->Subject) . "</td>";
                                  echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Units) . "</td>";
                                  if ($row->FirstGrading < 75) {
                                    echo "<td style='border: 1px solid black; text-align: center; color: red;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; text-align: center; color: black;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  }
                                  if ($row->SecondGrading < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  }
                                  if (($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units) < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  }
                                  echo "</tr>";
                                }
                              ?>
                              <tr>
                                <td style="border: solid 1px black; text-align: right">TOTAL UNITS:</td>
                                <td style="text-align: center; border: solid 1px black; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      echo htmlentities($row->total_units);
                                    }
                                  ?>
                                </td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">GENERAL AVERAGE:</td>
                                <td style="border: solid 1px black; text-align: center; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $total_units = $row->total_units;
                                    }
                                    $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $general_average = $row->general_average;
                                    }
                                    if ($general_average < 75) {
                                      echo "<span style='color: red;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    } else {
                                      echo "<span style='color: black;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <?php
                          } else {
                            echo "No grades submitted for this Semester.";
                          }
                        ?>
                    </div>
                    <div style="display: flex; flex-direction: column; width: 50%">
                      <div style="display: flex; flex-direction: row; margin: 0 16px; margin-bottom: 16px;">
                        <div style="display: flex; flex-direction: column; margin-right: 16px ">
                          <span>Full Name: </span>
                          <span>Track and Strand: </span>
                          <span>Grade Level: </span>
                          <span>Semester: </span>
                        </div>
                        <div style="display: flex; flex-direction: column">
                          <?php
                            $query = "SELECT * FROM tblstudent WHERE LRN=:stuid";
                            $query = $dbh->prepare($query);
                            $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<span style='font-weight: bold'>" . htmlentities($row->FirstName) . ' ' . htmlentities($row->MiddleInitial) . ' ' . htmlentities($row->LastName) . "</span>";
                              echo "<span>" . htmlentities($row->Strand === null ? 'STEAM' : $row->Strand) . "</span>";
                              echo "<span>" . '12' . "</span>";
                              echo "<span>" . '2nd Semester' . "</span>";
                            }
                          ?>
                        </div>
                      </div>
                      <?php
                      $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                      $query = $dbh->prepare($query);
                      $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                      $query->execute();
                      $result = $query->fetch(PDO::FETCH_ASSOC);
                      $count = $result['count'];

                      if ($count > 0) {
                        ?>
                        <div style="display: flex; justify-content: center;">
                          <table style="border: 1px solid black; width: 96%">
                            <thead style="border: 1px solid black;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center">SUBJECTS</th style="border: 1px solid black; padding: 8px; text-align: center;">
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">UNITS</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">1st Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">2nd Quarter</th>
                              <th style="border: 1px solid black; padding: 8px; text-align: center;">FINAL</th>
                            </thead>
                            <tbody>
                              <?php
                                $query = "SELECT * FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  echo "<tr>";
                                  echo "<td style='border: 1px solid black; text-align: center;font-weight: bold'>" . htmlentities($row->Subject) . "</td>";
                                  echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Units) . "</td>";
                                  if ($row->FirstGrading < 75) {
                                    echo "<td style='border: 1px solid black; text-align: center; color: red;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; text-align: center; color: black;'>" . htmlentities($row->FirstGrading) . "</td>";
                                  }
                                  if ($row->SecondGrading < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities($row->SecondGrading) . "</td>";
                                  }
                                  if (($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units) < 75) {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: red;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  } else {
                                    echo "<td style='border: 1px solid black; padding: 8px; text-align: center; color: black;'>" . htmlentities(($row->FirstGrading*$row->Units+$row->SecondGrading*$row->Units)/($row->Units+$row->Units)) . "</td>";
                                  }
                                  echo "</tr>";
                                }
                              ?>
                              <tr>
                                <td style="border: solid 1px black; text-align: right">TOTAL UNITS:</td>
                                <td style="text-align: center; border: solid 1px black; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      echo htmlentities($row->total_units);
                                    }
                                  ?>
                                </td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                                <td style="border: solid 1px black;"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">GENERAL AVERAGE:</td>
                                <td style="border: solid 1px black; text-align: center; font-weight: bold">
                                  <?php
                                    $query = "SELECT SUM(Units) as total_units FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $total_units = $row->total_units;
                                    }
                                    $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                    $query = $dbh->prepare($query);
                                    $query->bindParam(':stuid', $_SESSION['sturecmsstuid'], PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $row) {
                                      $general_average = $row->general_average;
                                    }
                                    if ($general_average < 75) {
                                      echo "<span style='color: red;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    } else {
                                      echo "<span style='color: black;'>" . round(htmlentities($general_average), 2) . "</span>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <?php
                          } else {
                            echo "No grades submitted for this Semester.";
                          }
                        ?>
                    </div>
                  </div>
                  <div style="text-align: center; margin-top: 24px;">
                    <div>
                      <?php
                          $query = "SELECT FirstName, LastName FROM tblfaculty WHERE assignedStrand = :strand;";
                          $query = $dbh->prepare($query);
                          $query->bindParam(':strand', $results[0]->Strand, PDO::PARAM_STR);
                          $query->execute();
                          $result = $query->fetch(PDO::FETCH_ASSOC);

                          echo '<span style="font-weight: bold">' . htmlentities($result['FirstName'] . ' ' . $result['LastName']) . '</span>';
                        ?>
                    </div>
                    <div>Adviser</div>
                  </div>
                </div>
                </div>
            </div>
          </div>
          <!-- partial -->
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php');?>
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>