<?php
session_start();
include('includes/dbconnection.php');

// Check if the user is logged in
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Check if the faculty ID is provided in the request
    if (isset($_POST['faculty_id'])) {
        $faculty_id = $_POST['faculty_id'];

        // Prepare SQL statement to delete the faculty member
        $sql = "DELETE FROM tblfaculty WHERE ID = :faculty_id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);

        // Execute the SQL statement
        if ($query->execute()) {
            // Faculty member deleted successfully, redirect back to the manage faculty page
            header('Location: manage-faculty.php');
            exit();
        } else {
            // An error occurred while deleting the faculty member
            echo "Error deleting faculty member.";
        }
    } else {
        // If faculty ID is not provided, redirect back to the manage faculty page
        header('Location: manage-faculty.php');
        exit();
    }
}
?>
