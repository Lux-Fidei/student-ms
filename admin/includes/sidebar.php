<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                <img class="img-xs rounded-circle" src="images/Director.jpg" width="32" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <?php
        $aid= $_SESSION['sturecmsaid'];
$sql="SELECT * from tbladmin where ID=:aid";

$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1; 
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                  <p class="profile-name"><?php  echo htmlentities($row->LastName).' '.htmlentities ($row->FirstName)?></p>
                  <p class="designation"><?php  echo htmlentities($row->Email);?></p><?php $cnt=$cnt+1;}} ?>
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
              <a class="nav-link" href="history_logs.php">
                <span class="menu-title">History of Transaction</span>
                <i class="icon-doc menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth3" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Subjects</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth3">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-subject.php"> Add Subject </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth12" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Semester</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth12">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="semester.php"> Add Semester </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth6" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Strand</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="auth6">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="addcourse.php"> Add Strand</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-course.php"> Manage Strands </a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Grade and Section</span>
                <i class="icon-layers menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="gradesec.php">Gradelevel</a></li>
                  <li class="nav-item"> <a class="nav-link" href="add-section.php">Sections</a></li>
                </ul>
              </div>
              
              <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth4" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Faculty</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="auth4">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-faculty.php"> Add Faculty </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-faculty.php"> Manage Faculty </a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth7" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Staff</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="auth7">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="addrecordexamineer.php"> Add Staff</a></li>
                  <li class="nav-item"> <a class="nav-link" href="managerecordexam.php"> Manage Staff</a></li>
                </ul>
              </div>
            </li>

            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Student</span>
                <i class="icon-people menu-icon"></i>
              </a>  
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-students.php">Add Student</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-students.php">Manage Student</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add-club.php">
                <span class="menu-title">Club</span>
                <i class="icon-notebook menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Notice</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-notice.php"> Add Notice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-notice.php"> Manage Notice </a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth1" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Public Notice</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-public-notice.php"> Add Public Notice </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-public-notice.php"> Manage Public Notice </a></li>
                </ul>
              </div>
              <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">School Details</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="about-us.php"> About Us </a></li>
                  <li class="nav-item"> <a class="nav-link" href="contact-us.php"> Contact Us </a></li>
                  <li class="nav-item"> <a class="nav-link" href="mission-vision.php">Vision</a></li>
                </ul>
              </div>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="between-dates-reports.php">
                <span class="menu-title">Reports</span>
                <i class="icon-notebook menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="search.php">
                <span class="menu-title">Search</span>
                <i class="icon-magnifier menu-icon"></i>
  
              </a>
            </li>
            </li>
          </ul>
        </nav>