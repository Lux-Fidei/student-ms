<?php
session_start();
include('includes/dbconnection.php');

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

if (isset($_SESSION['login_history_id']) && isset($_SESSION['sturecmfacaid'])) {
    $logoutTime = date("Y-m-d H:i:s"); // Current date and time in Asia/Manila timezone
    $loginHistoryId = $_SESSION['login_history_id'];

    $logoutHistorySql = "UPDATE login_history SET logout_time = :logout_time WHERE id = :id";
    $logoutHistoryStmt = $dbh->prepare($logoutHistorySql);
    $logoutHistoryStmt->bindParam(':logout_time', $logoutTime, PDO::PARAM_STR);
    $logoutHistoryStmt->bindParam(':id', $loginHistoryId, PDO::PARAM_INT);
    $logoutHistoryStmt->execute();
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header('location:login.php');
exit();
?>
