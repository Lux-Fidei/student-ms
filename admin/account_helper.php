<?php
function createAccount($username, $password, $type) {
    global $dbh;
    $currentDate = new DateTime();
    $twoYearsLater = $currentDate->modify('+2 years');
    $formattedDate = $twoYearsLater->format('Y-m-d');

    $sql = "INSERT INTO tbl_user_accounts (UserName, Password, Type, expiryDate) VALUES (:useranme, :password, :type, :expiry)";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':useranme', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':type', $type, PDO::PARAM_STR);
    $query->bindParam(':expiry', $formattedDate, PDO::PARAM_STR);
    try {
        $query->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $dbh->lastInsertId();
}
function disableAccount($id) {
    global $dbh;
    $currentDate = new DateTime();
    $twoYearsLater = $currentDate->modify('+2 years');
    $formattedDate = $twoYearsLater->format('Y-m-d');

    $sql = "UPDATE INTO tbl_user_accounts SET disabled = 1 WHERE ID = :id";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    try {
        $query->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return $dbh->lastInsertId();
}
?>