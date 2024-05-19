<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        // Delete the record examiner from the database
        $sql = "DELETE FROM tbl_record_examineer WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        if($query){
            echo "<script>alert('Record examiner deleted successfully');</script>";
            echo "<script>window.location.href='managerecordexam.php'</script>"; // Redirect to the view record examiner page
        } else {
            echo "<script>alert('Failed to delete record examiner');</script>";
        }
    }
}
?>
