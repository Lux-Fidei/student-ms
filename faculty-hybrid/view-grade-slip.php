<?php
// Assuming you have a database connection established
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
// Get the student ID from the URL parameter
if (strlen($_SESSION['sturecmfacaid']==0)) {
  header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html>
<head>
  <title>Faculty Management System || Gradeslip</title>
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
  <link rel="stylesheet" href="./style.css">
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
            <div class="card card-secondary" style="border-radius: 8px;">
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
              <div>
                <hr style="border-color:black; border:1px solid gold; margin-top: 4px; width: 96%" />
              </div>
              <div style="text-align: center;">
                <h1>GRADE SLIP</h1>
              </div>
              <div  style="display: flex; flex-direction: row; justify-content: center">
                <div style="display: flex; flex-direction: column; width: 50%">
                  <div style="display: flex; flex-direction: row; margin: 0 16px; margin-bottom: 16px;">
                    <div style="display: flex; flex-direction: column; margin-right: 16px ">
                      <span>Full Name: </span>
                      <span>Track and Strand: </span>
                      <span>Grade Level: </span>
                    </div>
                    <div style="display: flex; flex-direction: column">
                      <?php
                        $query = "SELECT * FROM tblstudent WHERE StuID=:stuid";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $row) {
                          echo "<span>" . htmlentities($row->StudentName) . "</span>";
                          echo "<span>" . htmlentities($row->strand === null ? 'STEAM' : $row->strand) . "</span>";
                          echo "<span>" . '11' . "</span>";
                        }
                      ?>
                    </div>
                  </div>
                  <?php
                  $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                  $query = $dbh->prepare($query);
                  $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                            $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<tr>";
                              echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Subject) . "</td>";
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  $total_units = $row->total_units;
                                }
                                $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                    </div>
                    <div style="display: flex; flex-direction: column">
                      <?php
                        $query = "SELECT * FROM tblstudent WHERE StuID=:stuid";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $row) {
                          echo "<span>" . htmlentities($row->StudentName) . "</span>";
                          echo "<span>" . htmlentities($row->strand === null ? 'STEAM' : $row->strand) . "</span>";
                          echo "<span>" . '11' . "</span>";
                        }
                      ?>
                    </div>
                  </div>
                  <?php
                  $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                  $query = $dbh->prepare($query);
                  $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                            $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<tr>";
                              echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Subject) . "</td>";
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  $total_units = $row->total_units;
                                }
                                $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                    </div>
                    <div style="display: flex; flex-direction: column">
                      <?php
                        $query = "SELECT * FROM tblstudent WHERE StuID=:stuid";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $row) {
                          echo "<span>" . htmlentities($row->StudentName) . "</span>";
                          echo "<span>" . htmlentities($row->strand === null ? 'STEAM' : $row->strand) . "</span>";
                          echo "<span>" . 12 . "</span>";
                        }
                      ?>
                    </div>
                  </div>
                  <?php
                  $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                  $query = $dbh->prepare($query);
                  $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                            $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<tr>";
                              echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Subject) . "</td>";
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  $total_units = $row->total_units;
                                }
                                $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                    </div>
                    <div style="display: flex; flex-direction: column">
                      <?php
                        $query = "SELECT * FROM tblstudent WHERE StuID=:stuid";
                        $query = $dbh->prepare($query);
                        $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($results as $row) {
                          echo "<span>" . htmlentities($row->StudentName) . "</span>";
                          echo "<span>" . htmlentities($row->strand === null ? 'STEAM' : $row->strand) . "</span>";
                          echo "<span>" . 12 . "</span>";
                        }
                      ?>
                    </div>
                  </div>
                  <?php
                  $query = "SELECT COUNT(*) as count FROM tblgrades WHERE StuID=:stuid";
                  $query = $dbh->prepare($query);
                  $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                            $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            foreach ($results as $row) {
                              echo "<tr>";
                              echo "<td style='border: 1px solid black; text-align: center;'>" . htmlentities($row->Subject) . "</td>";
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($results as $row) {
                                  $total_units = $row->total_units;
                                }
                                $query = "SELECT SUM(FirstGrading*Units+SecondGrading*Units)/(SUM(Units)+SUM(Units)) as general_average FROM tblgrades WHERE StuID=:stuid";
                                $query = $dbh->prepare($query);
                                $query->bindParam(':stuid', $_GET['stuID'], PDO::PARAM_STR);
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
              <div style="display: flex; justify-content: flex-end; margin: 16px">
                <button style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 16px; width: 128px">SEND</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <?php include_once('includes/footer.php');?>
    
  </div>
</body>
</html>
<?php }  ?>