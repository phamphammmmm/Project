<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">RESTAURANT</div>

            <div class="button">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">About Us</a></li>

                    <li class="dropdown">
                        <a href="meal_user.php" class="dropbtn">Meals</a>
                        <div class="dropdown-content">
                            <a href="#">Regular</a>
                            <a href="#">Lunch</a>
                            <a href="#">Snacks</a>
                            <a href="#">Desert</a>
                            <a href="#">Beverages</a>
                        </div>
                    </li>

                    <li><a href="gallery_user.php">Gallery</a></li>
                    <li><a href="#">Awards</a></li>
                    <li><a href="#">Catering</a></li>
                    <li><a href="recipe.php">Recipe of the month</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="feedback.php">Feedback us</a></li>

                </ul>
            </div>


            <div class="dropdown-user">
                <button class="dropbtn-user"><i class="fa-solid fa-user"></i></button>
                <div class="dropdown-login">
                    <a href="#">login</a>
                    <a href="#">Register</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>