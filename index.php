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
	<body><br><br>
<?php include_once('includes/header.php');?>


<div class="slideshow">
  <li>
<span>Slide One</span> </li>
  <li> <span>Slide Two</span> </li>
  <li> <span>Slide Three</span> </li>
  <li> <span>Slide Four</span> </li>
  	
</div>
	</body>
	
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
    <div class="course-title">                        Sports                                 </div>
  </div>
</div><br>
<style>
	.offered-courses-container {
  text-align: center;
  padding: 20px;
  background-image: url(images/Strands\ bg.png);
  background-size: cover;
  background-repeat: no-repeat;
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
.slideshow-container {
  max-width: 1020px;
  position: relative;
  padding:60px;
  margin: auto;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Hide the images by default */


/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(1,1,1,1,1);
}

/* Caption text */


/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fade animation */
.fade {
  -webkit-animation-name:fade;
  -webkit-animation-duration: 12s;
  animation-name: fade;
  animation-duration: 3s;
}

@-webkit-keyframes fade {
  from {opacity: .4}
  to {opacity: .3}
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
</style>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){        
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>
<!--/script-->

<!-- Add the following CSS and JavaScript for the slideshow -->
<!-- Slideshow container -->
<body>
<div class="content-tes">
  <div class="testimonial">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 6</div>
    <img src="images/kent-testimonials.png" style="width:100%">
   
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 6</div>
    <img src="images/kiko-testimonials.png" style="width:100%">
    
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 6</div>
    <img src="images/basser-testimonials.png" style="width:100%">
    
  </div>

  <div class="mySlides fade">
    <div class="numbertext">4 / 5</div>
    <img src="images/ammar-testimonials.png" style="width:100%">
  
  </div>

  <div class="mySlides fade">
    <div class="numbertext">5 / 5</div>
    <img src="images/lala-testimonials.png" style="width:100%">
    
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span>
  <span class="dot" onclick="currentSlide(6)"></span>
</div>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3000); // Change image every 2 seconds
}
</script>
</div>
</div>
</body>


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