<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                <img class="img-xs rounded-circle" src="./../admin/images/<?php echo $results[0]->image; ?>" width="32" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <?php
                    if(isset($_SESSION['record_examineer_id'])) {
                        $uid = $_SESSION['record_examineer_id'];
                        $sql = "SELECT * FROM tbl_record_examineer WHERE UserAccountID = :uid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        if($query->rowCount() > 0) {
                            foreach($results as $row) {
                    ?>
                    <p class="profile-name"><?php echo htmlentities($row->lname); ?></p>
                    <p class="designation"><?php echo htmlentities($row->email); ?></p>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="requestCOR.php">
                <span class="menu-title">COR</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="requestCertification.php">
                <span class="menu-title">Certification</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
