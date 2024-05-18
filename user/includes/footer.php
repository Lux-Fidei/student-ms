<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
  <span class="text-muted d-block text-center text-sm-left d-sm-inline-block" style="color: blue;">Student  Management System</span>
    <?php
      $sql2 = "SELECT UserAccountID FROM tblstudent WHERE ID = :useraccid";
      $query = $dbh->prepare($sql2);
      $query->bindParam(':useraccid', $_SESSION['sturecmsuid'], PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      $sql = "SELECT expiryDate FROM tbl_user_accounts WHERE ID = :useraccid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':useraccid', $results[0]->UserAccountID, PDO::PARAM_STR);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      
        echo '<span class="text-muted d-block text-center text-sm-left d-sm-inline-block" style="color: blue;">' .'Account Expiry: '.date('F j, Y', strtotime($results[0]->expiryDate)) . '</span>';
      
    ?>
  </div>
  <style>
    .footer {
  background: #26263d;
  padding: 0 1.5rem 1.5rem;
  transition: all 0.25s ease;
  -moz-transition: all 0.25s ease;
  -webkit-transition: all 0.25s ease;
  -ms-transition: all 0.25s ease;
  font-size: calc(0.875rem - 0.05rem);
  font-family: "Open Sans", sans-serif;
}
  </style>
</footer>