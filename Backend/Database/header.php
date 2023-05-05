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
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>

                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Meals</a>
                        <div class="dropdown-content">
                            <a href="#">Regular</a>
                            <a href="#">Lunch</a>
                            <a href="#">Snacks</a>
                            <a href="#">Desert</a>
                            <a href="#">Beverages</a>
                        </div>
                    </li>

                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Awards</a></li>
                    <li><a href="#">Catering</a></li>
                    <li><a href="recipe.php">Recipe of the month</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                </ul>
            </div>

            <div class="search">
                <form action="" id="search-box">
                    <input type="text" id="search-text" placeholder="You want to find ?" required />
                    <button id="search-btn">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <div class="dropdown-user">
                <button class="dropbtn-user"><i class="fa-solid fa-user"></i></button>
                <div class="dropdown-login">
                    <a href="login.php">login</a>
                    <a href="register.php">Register</a>
                </div>
            </div>
        </div>
    </header>
</body>

</html>