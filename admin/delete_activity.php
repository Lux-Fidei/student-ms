<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
    exit();
} else {
    $activity_id = $_GET['id'];

    $sql = "DELETE FROM tbl_activity WHERE id=:activity_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':activity_id', $activity_id, PDO::PARAM_INT);

    if ($query->execute()) {
        echo '<script>alert("Activity deleted successfully.")</script>';
        echo "<script>window.location.href ='academiccalendar.php'</script>";
        exit();
    } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
    }
}
?>
