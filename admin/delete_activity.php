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

        // Start a transaction
        $dbh->beginTransaction();

        try {
            // Prepare SQL statement to delete related comments
            $sql = "DELETE FROM tbl_evaluation_comments WHERE teacher_id = :faculty_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $query->execute();

            // Prepare SQL statement to delete the faculty member
            $sql = "DELETE FROM tblfaculty WHERE ID = :faculty_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':faculty_id', $faculty_id, PDO::PARAM_INT);
            $query->execute();

            // Commit the transaction
            $dbh->commit();

            // Faculty member deleted successfully, redirect back to the manage faculty page
            header('Location: manage-faculty.php');
            exit();
        } catch (PDOException $e) {
            // Rollback the transaction if something failed
            $dbh->rollBack();
            echo "Error deleting faculty member: " . $e->getMessage();
        }
    } else {
        // If faculty ID is not provided, redirect back to the manage faculty page
        header('Location: manage-faculty.php');
        exit();
    }
}
?>
