<!--header-->
<div class="header" id="home">
  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"> </span>
          <span class="icon-bar"> </span>
          <span class="icon-bar"> </span>
        </button>
        <h1><p4 class="p4">Republic of the Philippines</h1></p>  
       <h1> <p1  class="p1"><strong>M</strong>indanao <strong>S</strong>tate <strong>U</strong>niversity</p></h1>
        <h1><p2 class="p2"> <strong>SENIOR HIGH SCHOOL</strong></p></h1>
          <h1><p3 class="p3"> Marawi City </p><h1>
            <div class="logo">
         <img src="images/MarawiSeniorHigh-removebg.png">
         </div>
         <div class="logo1">
         <img src="images/Gradient.png">
         </div>

          <style>

              div.logo1 img{
                vertical-align: middle;
                width: 107px;
                margin-left: 76px;
                margin-top: -7em;
            }
             div.logo img{
              vertical-align: middle;
              width: 6em;
               margin-left: 207px;
               margin-top: -5em;

            }

            p4.p4 {
             color: white;
            font-family: times;
            margin-left: -214px; 
            margin-top: 12em;
            font-size: 19px;
              }
               p1.p1 {
             color: maroon;
            font-family: times;
            margin-left: -216px; 
            margin-top: 12em;
            font-size: 23px;
              }
              p2.p2 {
             color: white;
            font-family: Arial, Helvetica, sans-serif;
            margin-left: -217px;
            margin-top: 12em;
            font-size: 19px;
            color:#0a7907;
              }
              p3.p3 {
                color: white;
    font-family: times;
    margin-left: -215px;
    margin-top: 12em;
    font-size: 21px;
              }
              
          </style>
        
        
      </div> 
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right margin-top cl-effect-2">
          <li><a href="index.php"><span data-hover="Home"><strong>Home</strong></span></a></li>
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>About</strong> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="about.php">About</a></li>
              <li><a href="#" onclick="openPopup()">Director</a></li>
              <li><a href="#" onclick="openChartPopup()">Chart</a></li>
        <!-- Add more dropdown items here if needed -->
    </ul>
</li>
          <li><a href="contact.php"><span data-hover="Contact"><strong>VMGO</strong></span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><strong>Users</strong> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="admin/login.php">Admin</a></li>
              <li><a href="user/login.php">Student</a></li>
              <li><a href="faculty/login.php">Faculty</a></li>
              <style>
              ul.nav.navbar-nav.navbar-right.margin-top {
                margin-top: 11px;
              padding: 0;
              margin-right: -1056px;
             }
             .navbar > .container .navbar-brand, .navbar > .container-fluid .navbar-brand {
              margin-left: -232px;
              margin-top: -38px;
             font-size: 21px;
              
              }
          </style>
            </ul>
          </li> 
        </ul>
       
      </div><!-- /.navbar-collapse -->
      <!-- /.container-fluid -->
    </div>
  </nav>
  <!--/script-->
  
</div>
<!-- Top Navigation -->
<!--header-->

<style>
  .dropdown-menu {
    background-color: #344734; /* Background color */
    border: white; /* Remove border */
    border-radius: 0em; /* Rounded corners */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add shadow */
  }
  
  .dropdown-menu li {
    padding: 40px 55px; /* Add padding */
  }
  
  .dropdown-menu li a {
    color: white; /* Text color */
  }
  
  .dropdown-menu li a:hover {
    background-color: green; /* Add hover color */
  }
</style>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .popup-content {
        background-color: white;
        width: 50%;
        margin: 10% auto;
        padding: 20px;
        text-align: center;
        border-radius: 5px;
    }
    .close {
      color: #060606;
  float: right;
  font-size: 2em;
  font-weight: bolder;
  cursor: pointer;
  border-radius: 13em;
    }
</style>
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <img src="images/Director.png" alt="Information" style="max-width: 100%;">
    </div>
</div>

<script>
    // Function to open the popup
    function openPopup() {
        document.getElementById('popup').style.display = 'block';
    }

    // Function to close the popup
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

</script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .chart-popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .chart-popup-content {
      background-color: #0c6200;
  width: 42%;
  margin: 10% auto;
  padding: 1px;
  text-align: center;
  border-radius: 5px;
  margin-top: 2em;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    img {
  vertical-align: middle;
  margin-top: -2em;
}
</style>
</head>
<body>

<div class="chart-popup" id="chart-popup">
    <div class="chart-popup-content">
        <span class="close" onclick="closeChartPopup()">&times;</span>
        <img src="images/org.jpg" alt="Information" style="max-width: 100%;">
    </div>
</div>

<script>
    // Function to open the popup
    function openChartPopup() {
        document.getElementById('chart-popup').style.display = 'block';
    }

    // Function to close the popup
    function closeChartPopup() {
        document.getElementById('chart-popup').style.display = 'none';
    }
</script>

