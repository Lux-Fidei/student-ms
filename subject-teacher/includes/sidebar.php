<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="../admin/images/<?php echo $results[0]->Image; ?>" width="32" alt="Profile image"> 
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <?php
                    $uid = $_SESSION['sturecmfacaid'];
                    $sql = "SELECT * FROM tblfaculty WHERE ID=:uid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $row) {
                    ?>
                            <p class="profile-name"><?php echo htmlentities($row->FirstName); ?></p>
                            <p class="designation"><?php echo htmlentities($row->Email); ?></p>
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
            <a class="nav-link" href="select-subject.php">
                <span class="menu-title">Grades</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
            <li class="nav-item">
            <a class="nav-link" href="manage-club.php">
                <span class="menu-title">Club</span>
                <i class="icon-screen-desktop menu-icon"></i>
            </a>
        </li>
       
       
       

                
    </ul>
</nav>
