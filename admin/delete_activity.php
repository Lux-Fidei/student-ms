<?php
// Include database connection or any necessary files
include('includes/dbconnection.php');

// Check if the activity ID is provided in the request
if(isset($_POST['activity_id'])) {
    $activity_id = $_POST['activity_id'];

    // Prepare SQL statement to delete the activity
    $sql = "DELETE FROM tbl_activity WHERE activity_id = :activity_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);

    // Execute the SQL statement
    if ($query->execute()) {
        // Activity deleted successfully, redirect back to the activity list page
        header('Location: academiccalendar.php');
        exit();
    } else {
        // An error occurred while deleting the activity
        echo "Error deleting activity.";
    }
} else {
    // If activity ID is not provided, redirect back to the activity list page
    header('Location: academiccalendar.php');
    exit();
}
?>
