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
    <style>
    /* CSS cho header */
    header {
        background-color: #333;
        color: #fff;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
    }

    .button ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .button ul li {
        margin-right: 15px;
    }

    .button ul li a {
        color: #fff;
        text-decoration: none;
        padding: 5px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgb(40, 37, 37);
    }

    .dropdown-content a {
        color: white;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #3d2121;
    }

    .dropdown-user {
        position: relative;
    }

    .dropbtn-user {
        padding: 0px 40px 20px 0px;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .dropdown-login {
        display: none;
        position: absolute;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        background-color: #f9f9f9;
    }

    .dropdown-login a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-user:hover .dropdown-login {
        display: block;
    }

    /* Responsive CSS */
    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
        }

        .button ul {
            flex-direction: column;
        }

        .button ul li {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
    </style>

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
                            <a href="#" data-meal="lunch">Lunch</a>
                            <a href="#" data-meal="regular">Regular</a>
                            <a href="#" data-meal="snacks">Snacks</a>
                            <a href="meal_user.php" data-meal="dessert">Dessert</a>
                            <a href="#" data-meal="beverages">Beverages</a>

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
                    <a href="login.php" id="loginBtn">Login</a>
                    <a href="logout.php" id="logoutBtn">Logout</a>
                </div>
            </div>

        </div>
    </header>
    <script>
    // Lấy danh sách các phần tử bữa ăn
    var mealLinks = document.querySelectorAll('.dropdown-content a[data-meal]');

    // Lặp qua danh sách các phần tử bữa ăn và thêm sự kiện click cho chúng
    for (var i = 0; i < mealLinks.length; i++) {
        mealLinks[i].addEventListener('click', function(event) {
            event.preventDefault();

            // Lấy giá trị của thuộc tính "data-meal"
            var meal = this.getAttribute('data-meal');

            // Hiển thị phần tương ứng trên trang "Meal"
            showMeal(meal);
        });
    }

    // Hàm hiển thị phần tương ứng trên trang "Meal"
    function showMeal(meal) {
        // Lấy tất cả các phần tử bữa ăn
        var mealItems = document.querySelectorAll('.meal-item');

        // Lặp qua danh sách các phần tử bữa ăn và kiểm tra bữa ăn tương ứng
        for (var i = 0; i < mealItems.length; i++) {
            var mealItem = mealItems[i];

            // Kiểm tra nếu bữa ăn của phần tử trùng khớp với bữa ăn đã chọn
            if (mealItem.getAttribute('data-meal') === meal) {
                mealItem.style.display = 'block'; // Hiển thị phần tử
            } else {
                mealItem.style.display = 'none'; // Ẩn phần tử
            }
        }
    }

    // Lấy các phần tử liên quan đến login/logout
    var loginBtn = document.getElementById('loginBtn');
    var logoutBtn = document.getElementById('logoutBtn');

    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    var isLoggedIn = <?php echo isset($_SESSION['login']) && $_SESSION['login'] ? 'true' : 'false'; ?>;

    // Ẩn hoặc hiển thị các nút login/logout tương ứng
    if (isLoggedIn) {
        loginBtn.style.display = 'none';
        logoutBtn.style.display = 'block';
    } else {
        loginBtn.style.display = 'block';
        logoutBtn.style.display = 'none';
    }

    // Xử lý sự kiện click cho nút logout
    logoutBtn.addEventListener('click', function(event) {
        event.preventDefault();

        // Chuyển hướng đến trang logout.php để đăng xuất
        window.location.href = 'logout.php';
    });
    </script>

</body>

</html>