<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Vinegar Food Restaurant</title>
    <link rel="stylesheet" href="/Project/Frontend/Home/home.css" />

</head>

<body onload="autoSlide()">
    <!-- Header navigation panel -->
    <div class="bottom-navigation">
        <a href="home.html">Home</a>
        <a href="/Frontend/About_us/about.html">About us</a>
        <div class="dropdown">
            <button class="dropbtn">Meals</button>
            <div class="dropdown-content">
                <a href="#">Regular</a>
                <a href="#">Lunch</a>
                <a href="#">Snacks</a>
                <a href="#">Desert</a>
                <a href="#">Beverages</a>
            </div>
        </div>
        <a href="/Frontend/Gallery/gallery.html">Gallery</a>
        <a href="/Frontend/Awards/awards.html">Awards</a>
        <a href="catering.html">Catering</a>
        <a href="/Frontend/Recipe/recipe.html">Recipe of the Month</a>
        <a href="/Frontend/Contact/contact.html">Feedback</a>
    </div>

    <!--  section with image carousel -->
    <div class="header">
        <div class="slideshow">
            <img class="slideshow-image active" src="/Project/image/anh1.jpg" alt="Slideshow" />
            <img class="slideshow-image" src="anh2.jpg" alt="Slideshow" />
            <img class="slideshow-image" src="anh3.jpg" alt="Slideshow" />
            <!--add click button-->
            <button class="prev" onclick="prevSlide()">Prev</button>
            <button class="next" onclick="nextSlide()">Next</button>
        </div>

        <!-- <img src="header_image.jpg" alt="Header Image" class="header-image"> -->
        <h1>Welcome to Vinegar Food Restaurant</h1>
        <p class="welcome-message">
            Serving the finest delicacies with a rotating menu of 72
            different
            dishes
        </p>
        <div class="cta-buttons">
            <button onclick="location.href='order.html'">Order Online</button>
            <button onclick="location.href='reservation.html'">
                Make Reservation
            </button>
        </div>
    </div>

    <!-- Menu list section -->
    <div class="menu">
        <h2>Our Menu</h2>
        <ul>
            <span class="menu-icon">&#9776;</span>
            <li><a href="home1.html">Menu 1</a></li>
            <li><a href="menu2.html">Menu 2</a></li>
            <li><a href="menu3.html">Menu 3</a></li>
            <!-- Add more menu items here as needed -->
        </ul>
    </div>

    <!-- Highlights section -->
    <div class="highlights">
        <h2>Highlights</h2>
        <p>At Vinegar Food Restaurant, we are proud to offer:</p>
        <ul>
            <li>Over 1000 branches nationwide</li>
            <li>72 different rotating menus</li>
            <li>240000 delicacies</li>
            <li>Unmatched aroma and taste</li>
        </ul>
    </div>

    <script>

    </script>
    <script src="home.js"></script>
</body>

</html>