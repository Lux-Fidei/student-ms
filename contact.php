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
        function showSlide(index) {
            var slides = $(".slide");
            var dots = $(".menu label");
            slides.removeClass("active").eq(index).addClass("active");
            dots.removeClass("active").eq(index).addClass("active");
        }

        function nextSlide() {
            var currentIndex = $(".slide.active").index();
            var nextIndex = (currentIndex + 1) % $(".slide").length;
            showSlide(nextIndex);
        }

        function prevSlide() {
            var currentIndex = $(".slide.active").index();
            var prevIndex = (currentIndex - 1 + $(".slide").length) % $(".slide").length;
            showSlide(prevIndex);
        }

        $(".arrow-left").click(function() {
            prevSlide();
        });

        $(".arrow-right").click(function() {
            nextSlide();
        });

        $(".menu label").click(function() {
            var index = $(this).index();
            showSlide(index);
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

  .slider-container {
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
    bottom: 20px;
  }

  .menu label {
    cursor: pointer;
    display: inline-block;
    width: 16px;
    height: 16px;
    background: #fff;
    border-radius: 50%;
    margin: 0 .2em;
  }

  .menu label.active {
    background: #000;
  }

  .slide {
    display: none;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-size: cover;
    background-position: 50% 50%;
  }

  .slide.active {
    display: block;
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

  .arrow-left, .arrow-right {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.7);
    border: none;
    font-size: 24px;
    padding: 10px;
    cursor: pointer;
    z-index: 1000;
  }

  .arrow-left {
    left: 10px;
  }

  .arrow-right {
    right: 10px;
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
    <button class="arrow-left">&#9664;</button>
    <button class="arrow-right">&#9654;</button>
    <div class="menu">
      <label class="active"></label>
      <label></label>
      <label></label>
      <label></label>
      <label></label>
    </div>

    <div class="slide slide-1 active"></div>
    <div class="slide slide-2"></div>
    <div class="slide slide-3"></div>
    <div class="slide slide-4"></div>
    <div class="slide slide-5"></div>
  </div>
  <!-- //container -->
  <!--/copy-rights-->
</body>
</html>
