<?php
// Include database connection or any necessary files
include('includes/dbconnection.php');

// Check if the school year ID is provided in the request
if(isset($_GET['id'])) {
    $school_year_id = $_GET['id'];

    // Prepare SQL statement to delete the school year
    $sql = "DELETE FROM tblschoolyear WHERE id = :school_year_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':school_year_id', $school_year_id, PDO::PARAM_INT);

    // Execute the SQL statement
    if ($query->execute()) {
        // School year deleted successfully, redirect back to the page where school years are listed
        header('Location: addschoolyear.php');
        exit();
    } else {
        // An error occurred while deleting the school year
        echo "Error deleting school year.";
    }
} else {
    // If school year ID is not provided, redirect back to the page where school years are listed
    header('Location: list-schoolyears.php');
    exit();
}
?>
