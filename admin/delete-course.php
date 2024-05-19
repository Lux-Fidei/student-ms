<?php
session_start();
include('includes/dbconnection.php');

if (!isset($_SESSION['sturecmsaid']) || strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit(); // Add exit to stop further execution
}

if (isset($_GET['delid'])) {
    $course_id = $_GET['delid'];
    
    // Delete course from database
    $sql = "DELETE FROM tbl_course WHERE course_id = :course_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':course_id', $course_id, PDO::PARAM_INT);
    $query->execute();
    
    // Check if deletion was successful
    if ($query->rowCount() > 0) {
        // Deletion successful
        $_SESSION['success'] = "Course deleted successfully";
        header('location:manage-course.php'); // Redirect back to view-courses.php after deletion
        exit();
    } else {
        // Deletion failed
        $_SESSION['error'] = "Failed to delete course";
        header('location:manage-course.php'); // Redirect back to view-courses.php
        exit();
    }
} else {
    // If delid parameter is not set, redirect back to view-courses.php
    header('location:manage-course.php');
    exit();
}
?>
