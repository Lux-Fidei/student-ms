<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Check if the user is logged in
if (empty($_SESSION['sturecmfacaid'])) {
    header('location:logout.php');
    exit;
}

// Check if the logged-in user is a club adviser
if (!empty($_SESSION['sturecmfacaid'])) {
    $adviserID = $_SESSION['sturecmfacaid'];

    // Check if student ID is provided in the URL
    if(isset($_GET['student_id'])) {
        $studentID = $_GET['student_id'];

        // Delete the club member
        $deleteMemberSQL = "DELETE FROM tbl_club_members WHERE StudentID = :student_id";
        $deleteMemberQuery = $dbh->prepare($deleteMemberSQL);
        $deleteMemberQuery->bindParam(':student_id', $studentID, PDO::PARAM_INT);
        $deleteMemberQuery->execute();

        // Redirect back to the page displaying club members
        header("Location: manage-club.php");
        exit;
    } else {
        // Redirect back to the page displaying club members if student ID is not provided
        header("Location: manage-club.php");
        exit;
    }
} else {
    // Redirect to logout if user is not logged in
    header('location:logout.php');
    exit;
}
?>
