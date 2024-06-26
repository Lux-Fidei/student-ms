<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                <img class="img-xs rounded-circle" src="./../../admin/images/<?php echo $results[0]->image; ?>" width="32" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <?php
                    $uid = $_SESSION['sturecmtaid'];
                    $sql = "SELECT * FROM tbl_record_examineer WHERE UserAccountID =:uid";    
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                            ?>
                            <p class="profile-name"><?php  echo htmlentities($row->fname) . ' ' . htmlentities($row->mname) . '. ' . htmlentities($row->lname);?></p>
                            <p class="designation"><?php echo htmlentities($row->email); ?></p>
                    <?php
                            $cnt = $cnt + 1;
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
            <a class="nav-link" href="student-profile-list.php">
                <span class="menu-title">Student Profile</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="faculty-profile-list.php">
                <span class="menu-title">Faculty Profile</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
        </li>
    </ul>
</nav>
