<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="dashboard.php">
            <strong style="color: white;">MSU MSHS</strong>
        </a>
    </div>
    <?php
        if(isset($_SESSION['sturecmtaid'])) {
            $uid = $_SESSION['sturecmtaid'];
        $sql = "SELECT * FROM tbl_record_examineer WHERE ID = :uid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0) {
            foreach($results as $row) {
    ?>
    <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="greetings">Hello, Teacher Aide <?php echo htmlentities($row->lname); ?>!</h5>
        <style>
            .greetings {
                font-size: 1.5em;
                font-family: math;
            }
        </style>
        <ul class="navbar-nav navbar-nav-right ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="./../admin/images/<?php echo $results[0]->image; ?>" width="32" alt="profile image">
                    <span class="font-weight-normal"> <?php echo htmlentities($row->fname); ?> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                    <img class="img-md rounded-circle" src="./../admin/images/<?php echo $results[0]->image; ?>" width="168" alt="Profile image">
                        <p class="mb-1 mt-3"><?php echo htmlentities($row->fname) . ' ' . htmlentities($row->lname); ?></p>
                        <p class="font-weight-light text-muted mb-0"><?php echo htmlentities($row->email); ?></p>
                    </div>
                    <a class="dropdown-item" href="teacheraide-profile.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
                    <a class="dropdown-item" href="change-password.php"><i class="dropdown-item-icon icon-energy text-primary"></i> Setting</a>
                    <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon icon-power text-primary"></i> Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
    <?php
            }
        }
    }
    ?>
</nav>
