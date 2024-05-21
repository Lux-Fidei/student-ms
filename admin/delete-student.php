<?php
session_start();
include('includes/dbconnection.php');

function deleteStudent($studentId, $dbh) {
    // Prepare the SQL statement to delete the student by ID
    $sql = "DELETE FROM tblstudent WHERE ID = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $studentId, PDO::PARAM_INT);

    // Execute the query
    if ($query->execute()) {
        echo "<script>alert('Student record deleted successfully');</script>";
        echo "<script>window.location.href = 'manage-students.php'</script>";
    } else {
        echo "<script>alert('An error occurred while deleting the student record');</script>";
    }
}
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['selected_students'])) {
        $selectedStudents = $_POST['selected_students'];

        // Delete selected records
        foreach ($selectedStudents as $studentId) {
            $sql = "DELETE FROM tblstudent WHERE ID = :student_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':student_id', $studentId, PDO::PARAM_INT);
            $query->execute();
        }

        echo "<script>alert('Selected student records deleted successfully');</script>";
        echo "<script>window.location.href = 'manage-students.php'</script>";
    } else {
        echo "<script>alert('Please select at least one student to delete');</script>";
    }
}

if (isset($_GET['delid'])) {
    $studentId = intval($_GET['delid']);
    deleteStudent($studentId, $dbh);
}
?>
