<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>
<head>
<title>Student  Management System || Home Page</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!--coustom css-->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<!--script-->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- js -->
<script src="js/bootstrap.js"></script>
<!-- /js -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--/fonts-->
<!--hover-girds-->
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/component.css" />
<script src="js/modernizr.custom.js"></script>
<!--/hover-grids-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
<!--/script-->
</head>
	<body>
<?php include_once('includes/header.php');?>
<br>

<div class="slideshow">
  <li>
<span>Slide One</span> </li>
  <li> <span>Slide Two</span> </li>
  <li> <span>Slide Three</span> </li>
  <li> <span>Slide Four</span> </li>
  	
</div>
	</body><br>
	
<div class="courses">
<div class="offered-courses-container">
  <h2>Offered Strands</h2>
  <div class="course-box">
    <img src="images/ABM.jpg" alt="Course 1">
    <div class="course-title">Accountancy, Business, and Management</div>
  </div>
  <div class="course-box">
    <img src="images/STEM.jpg" alt="Course 2">
    <div class="course-title">Science, Technology, Engineering, and Mathematics</div>
  </div>
  <div class="course-box">
    <img src="images/HUMMS.jpg" alt="Course 3">
    <div class="course-title" style="align-items: center;"> Hummanities and Social Sciences                                   </div>
  </div>
  <div class="course-box">
    <img src="images/ICT.jpeg" alt="Course 4">
    <div class="course-title">Information, Communication and Technology</div>
  </div>
  <div class="course-box">
    <img src="images/AFA.jpg" alt="Course 5">
    <div class="course-title">                 Agri-Fishery Arts                         </div>
  </div>
  <div class="course-box">
    <img src="images/SPORTS.jpg" alt="Course 6">
    <div class="course-title">                        Sports                                </div>
  </div>
</div>
<style>
	.offered-courses-container {
  text-align: center;
  padding: 20px;
}

.offered-courses-container h2 {
  margin-bottom: 20px;
  font-size: 24px;
  color: #333;
}

.course-box {
  display: inline-block;
  width: 300px;
  margin: 10px;
  text-align: center;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  transition: transform 0.2s;
}

.course-box:hover {
  transform: scale(1.05);
}

.course-box img {
  width: 100%;
  height: auto;
}

.course-title {
  padding: 10px;
  font-size: 16px;
  background-color: #f7f7f7;
}

</style>




<!--testmonials-->
<div class="testimonials">
	<div class="container">
			<div class="testimonial-nfo">
        <h3>Public Notice</h3>
        <marquee  style="height:350px;" direction ="up" onmouseover="this.stop();" onmouseout="this.start();">
				<?php
$sql="SELECT * from tblpublicnotice";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
		<a href="view-public-notice.php?viewid=<?php echo htmlentities ($row->ID);?>" target="_blank" style="color:#fff;">
          <?php  echo htmlentities($row->NoticeTitle);?>(<?php  echo htmlentities($row->CreationDate);?>)</a>
          <hr /><br />
			<?php $cnt=$cnt+1;}} ?>
	</marquee>
       </div>
	</div>
</div>

<!--\testmonials-->
<!--specfication-->

<!--/specfication-->
<?php include_once('includes/footer.php');?>
	</body>
</html>