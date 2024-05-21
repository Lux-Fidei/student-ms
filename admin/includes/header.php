<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="dashboard.php">
            <strong style="color: white;">MSU MSHS</strong>
          </a>
          <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="images/logo-mini.svg" alt="logo" /></a>
        </div><?php
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
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="greetings">Hello, Adminstrator <?php  echo htmlentities($row->FirstName);?>!</h5>
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
                <img class="img-xs rounded-circle ml-2" src="images/Director.jpg" alt="Profile image"width="32" alt="Profile image"> <span class="font-weight-normal"> <?php  echo htmlentities($row->FirstName);?> </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="images/Director.jpg" width="168" alt="Profile image">
                  <p class="mb-1 mt-3"><?php  echo htmlentities($row->FirstName);?></p>
                  <p class="font-weight-light text-muted mb-0"><?php  echo htmlentities($row->Email);?></p>
                </div><?php $cnt=$cnt+1;}} ?>
                <a class="dropdown-item" href="profile.php"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
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
      <style>
        .navbar .navbar-menu-wrapper {
    transition: width 0.25s ease;
    -webkit-transition: width 0.25s ease;
    -moz-transition: width 0.25s ease;
    -ms-transition: width 0.25s ease;
    color: #fff;
    padding-left: 24px;
    padding-right: 24px;
    width: calc(100% - 240px);
    height: 70px;
    -webkit-box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.11);
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.11);
    background-color: #136c13;
}
      </style>