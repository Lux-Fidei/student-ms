<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <strong style="color: white; text-align:center">MSU MSHS</strong>
          </a>
        
        </div>
        <?php
       
        $uid= $_SESSION['sturecmlisid'];
        $sql="SELECT CONCAT(f.FirstName, ' ', f.MiddleInitial, '.', ' ', f.LastName) AS FullName, f.FirstName, f.Email, u.Type FROM tblfaculty f JOIN tbl_user_accounts u ON f.ID = u.ID WHERE u.ID = :uid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':uid', $uid,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        $cnt=1;
        if($query->rowCount() > 0)
        {
        foreach($results as $row)
        {               ?>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
            <h5 class="greetings">Hello, <?php  echo htmlentities($row->Type) . ' ' . htmlentities($row->FirstName);?>!</h5>
          <style>
            .greetings
                  {
          font-size: 1.5em;
          font-family: math;
              }
          </style>
          <ul class="navbar-nav navbar-nav-right ml-auto">
          
        
      
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">

              <img class="img-xs rounded-circle ml-2" src="./../admin/images/<?php echo $results[0]->Image; ?>" width="32" alt="Profile image"> <span class="font-weight-normal"> <?php  echo htmlentities($row->FirstName);?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="./../admin/images/<?php echo $results[0]->Image; ?>" width="168" alt="Profile image">

                  <p class="mb-1 mt-3"><?php  echo htmlentities($row->FullName);?></p>
                  <p class="font-weight-light text-muted mb-0"><?php  echo htmlentities($row->Email);?></p><?php $cnt=$cnt+1;}} ?>
                </div>
                <a class="dropdown-item" href="faculty-profile.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                <a class="dropdown-item" href="change-password.php"><i class="dropdown-item-icon icon-energy text-primary"></i> Setting</a>
                <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>