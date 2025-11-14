<?php

require('dbms.php'); // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpotOn</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<div class="head">
    <h1>SpotOn</h1>
    <div class="anchor">
        <div class="home"><a href="index.php">Home</a></div>
        <div class="routine"><a href="view.php">View</a></div>
        <div class="formatting"><a href="formatting.html">Formatting</a></div>
        <div class="form">
            <ul>
                <li>
                    Form
                    <ul class="dropdown">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="insert.php">Register</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="banner-box">
    <div class="vertical-line"></div>
    <div class="paragraph">
        <h2><pre> Welcome to the<br> Universe of SpotOn</pre></h2>
        <div class="end">
            <h4>“Start booking reliable spot for parking your transportation and reduce your burden."</h4>
        </div>
    </div>
</div>

<div class="row1">
    <div class="first">1k+ <p>customers</p></div>
    <div class="second">20k+ <p>spot providers</p></div>
    <div class="third">60+ <p>companies</p></div>
    <div class="fourth">80+ <p>services</p></div>
</div>

<div class="video">
    <iframe width="1250" height="600" src="https://www.youtube.com/embed/Adbp0N17QFg" title="Forward Parking" frameborder="0" allowfullscreen></iframe>
</div>

<div class="wheel">
    <h1 class="two-wheel">Spot Category</h1>
    <p class="side">
        One-stop solution for all parking service needs. We offer a wide range of parking across<br>
        various categories of vehicles ensuring convenience, quality, and satisfaction.
    </p>
</div>

<div class="one">
    <p>
        Explore the world of two-wheelers, all in one place.<br>
        Get the latest updates on models, prices, and riding tips.<br>
        Track your rides, plan routes, and monitor fuel efficiency.<br>
        Join a passionate community of bikers and cycling enthusiasts.<br>
        Find nearby service centers, accessories, and maintenance guides.<br>
        Enhance your riding experience with SpotOn recommendations!
    </p>
</div>

<div class="two">
    <p>
        Explore the world of four-wheelers, from daily drivers to luxury cars.<br>
        Access reviews, compare specs, and get maintenance tips.<br>
        Connect with car clubs and events near you.<br>
        Book parking, services, and track your trips with ease.<br>
        Discover nearby charging/fuel stations and service points.<br>
        Drive smarter with SpotOn!
    </p>
</div>

<div class="upper">
    <h3>Never struggle with parking again!</h3>
    <h3>Easy & secure booking</h3>
    <button class="join">Join Us</button>
</div>

<footer class="main-footer">
    <div class="foot">
        <img src="logo.png" alt="Logo">
        <div class="contact">
            <h2>Contact Us</h2>
            <p>For any query or additional information that you may require from us.</p><br>
            <form action="contact.php" method="post">
                <input type="text" name="fullname" placeholder="Full Name" required><br><br>
                <input type="email" name="email" placeholder="Email" required><br><br>
                <input type="number" name="phone" placeholder="Phone number" required><br><br>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</footer>

</body>
</html>
