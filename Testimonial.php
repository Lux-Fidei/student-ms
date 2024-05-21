<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developer Testimonial Slider</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="testimonial-slider">
        <div class="slides">
            <div class="slide">
                <img src="images/kent.jpeg" alt="Developer 1">
                <div class="testimonial-content">
                    <p>"Working on this project has been a fantastic experience. The team's collaboration and the technology stack made it an enriching journey."</p>
                    <h4>- Developer 1</h4>
                </div>
            </div>
            <div class="slide">
                <img src="developer2.jpg" alt="Developer 2">
                <div class="testimonial-content">
                    <p>"I am proud of what we have achieved. The project challenged us to push the boundaries of our technical expertise."</p>
                    <h4>- Developer 2</h4>
                </div>
            </div>
            <div class="slide">
                <img src="developer3.jpg" alt="Developer 3">
                <div class="testimonial-content">
                    <p>"This project allowed me to grow professionally and personally. The problem-solving skills I gained are invaluable."</p>
                    <h4>- Developer 3</h4>
                </div>
            </div>
        </div>
        <div class="navigation">
            <span class="nav-btn" onclick="currentSlide(0)"></span>
            <span class="nav-btn" onclick="currentSlide(1)"></span>
            <span class="nav-btn" onclick="currentSlide(2)"></span>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
<script>
    let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const navBtns = document.querySelectorAll('.nav-btn');

function showSlide(index) {
    const slider = document.querySelector('.slides');
    slider.style.transform = `translateX(-${index * 100}%)`;
    navBtns.forEach(btn => btn.classList.remove('active'));
    navBtns[index].classList.add('active');
}

function currentSlide(index) {
    currentIndex = index;
    showSlide(currentIndex);
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
}

// Auto slide every 3 seconds
setInterval(nextSlide, 3000);

// Initial slide
showSlide(currentIndex);

</script>