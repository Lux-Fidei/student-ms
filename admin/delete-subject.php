<?php
// Include database connection or any necessary files
include('includes/dbconnection.php');

// Check if the subject ID is provided in the request
if(isset($_GET['id'])) {
    $subject_id = $_GET['id'];

    // Prepare SQL statement to delete the subject
    $sql = "DELETE FROM tblsubjects WHERE SubjectID = :subject_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);

    // Execute the SQL statement
    if ($query->execute()) {
        // Subject deleted successfully, redirect back to the add-subject page
        header('Location: add-subject.php');
        exit();
    } else {
        // An error occurred while deleting the subject
        echo "Error deleting subject.";
    }
} else {
    // If subject ID is not provided, redirect back to the add-subject page
    header('Location: add-subject.php');
    exit();
}
?>
