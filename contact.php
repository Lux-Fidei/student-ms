<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!doctype html>
<html>
<head>
<title>Student Management System || Contact Us Page</title>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--bootstrap-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!--custom css-->
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<!--script-->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- js -->
<script src="js/bootstrap.js"></script>
<!-- /js -->
<!--fonts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400italic,400,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!--/fonts-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--script-->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Function to move to the next slide
        function nextSlide() {
            var $currentSlide = $(".slide:checked");
            var $nextSlide = $currentSlide.next(".slide");

            if ($nextSlide.length === 0) {
                $nextSlide = $(".slide").first();
            }

            $currentSlide.removeAttr("checked");
            $nextSlide.prop("checked", "checked");
        }

        // Function to move to the previous slide
        function prevSlide() {
            var $currentSlide = $(".slide:checked");
            var $prevSlide = $currentSlide.prev(".slide");

            if ($prevSlide.length === 0) {
                $prevSlide = $(".slide").last();
            }

            $currentSlide.removeAttr("checked");
            $prevSlide.prop("checked", "checked");
        }

        // Click event for the arrow buttons
        $(".arrow-left").click(function() {
            prevSlide();
        });

        $(".arrow-right").click(function() {
            nextSlide();
        });

        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
        });
    });
</script>
<style>
  html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: "Helvetica", sans-serif;
  }

  img {
    width: 100%;
  }

  .slider-container{
    height: 100%;
    width: 100%;
    position: relative;
    overflow: hidden; 
    text-align: center;
  }

  .menu {
    position: absolute;
    left: 0;
    z-index: 900;
    width: 100%;
    bottom: 0;
  }

  .menu label {
    cursor: pointer;
    display: inline-block;
    width: 16px;
    height: 16px;
    background: #fff;
    border-radius: 50px;
    margin: 0 .2em 1em;
  }

  .slide {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 100%;
    z-index: 10;
    padding: 8em 1em 0;
    background-size: cover;
    background-position: 50% 50%;
    transition: left 0s .75s;
  }

  [id^="slide"]:checked + .slide {
    left: 0;
    z-index: 100;
    transition: left .65s ease-out;
  }

  .slide-1 {
    background-image: url("images/1p.png");
  }

  .slide-2 {
    background-image: url("images/2v.png");
  }

  .slide-3 {
    background-image: url("images/3o.png");
  }

  .slide-4 {
    background-image: url("images/4m.png");
  }

  .slide-5 {
    background-image: url("images/5ps.png");
  }

  /* Arrow buttons */
.arrow {
  position: absolute;
  top: 50%;
  width: 40px;
  height: 40px;
  background: rgba(255, 255, 255, 0.5);
  cursor: pointer;
  z-index: 1000;
  display: flex;
  align-items: center;
  justify-content: center;
}

.arrow-left {
  left: 10px;
  transform: translateY(-50%);
}

.arrow-right {
  right: 10px;
  transform: translateY(-50%);
}

.arrow::before {
  content: '';
  border: solid #000;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}

.arrow-left::before {
  transform: rotate(135deg);
}

.arrow-right::before {
  transform: rotate(-45deg);
}


  /* Image size adjuster */
  .size-controls {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
  }

  .size-controls button {
    background: rgba(255, 255, 255, 0.5);
    border: none;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    font-size: 20px;
    cursor: pointer;
    margin: 0 5px;
  }
</style>
</head>
<body>
  <!--header-->
  <?php include_once('includes/header.php');?>
  <!-- Top Navigation -->
  <div class="banner banner5">
    <div class="container">
      <h2></h2>
    </div>
  </div>
  <!--header-->
  <!-- contact -->
  <div class="slider-container">
    <div class="menu">
      <label for="slide-dot-1"></label>
      <label for="slide-dot-2"></label>
      <label for="slide-dot-3"></label>
      <label for="slide-dot-4"></label>
      <label for="slide-dot-5"></label>
    </div>

    <input id="slide-dot-1" type="radio" name="slides" checked>
    <div class="slide slide-1"></div>

    <input id="slide-dot-2" type="radio" name="slides">
    <div class="slide slide-2"></div>

    <input id="slide-dot-3" type="radio" name="slides">
    <div class="slide slide-3"></div>

    <input id="slide-dot-4" type="radio" name="slides">
    <div class="slide slide-4"></div>

    <input id="slide-dot-5" type="radio" name="slides">
    <div class="slide slide-5"></div>

    <!-- Arrow buttons -->
    <div class="arrow arrow-left">
      <label for="slide-dot-4"></label>
    </div>
    <div class="arrow arrow-right">
      <label for="slide-dot-2"></label>
    </div>


  <!-- //container -->
  <?php include_once('includes/footer.php');?>
  <!--/copy-rights-->
</body>
</html>
