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
    body {
        margin: 0;
    }

    header {
        position: fixed;
        background-color: #333;
        color: #fff;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        padding: 10px 0px;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        border-bottom: solid 1px #fff;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-sizing: border-box;
    }

    .logo {
        font-size: 30px;
        font-weight: bold;
        padding: 5px 20px;
        color: white;
    }

    .spacing {
        width: 350px;
    }

    .button ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .button ul li {
        margin-right: 15px;
        font-size: 15px;
    }

    .button ul li a {
        color: #fff;
        text-decoration: none;
        padding: 5px;
        transition: all 0.3s ease;
    }

    .button ul li a:hover {
        text-decoration: underline;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: rgb(40, 37, 37);
    }

    .dropdown-content a {
        color: white;
        font-size: 0.9em;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: background-color 0.3s ease;
    }

    .dropdown-content a:hover {
        background-color: #3d2121;
    }

    .navbar .button ul li a:hover,
    .dropdown:hover .dropbtn {
        text-decoration: underline;
    }

    /* user */
    .dropdown-user {
        display: flex;
        position: relative;
        padding-right: 6%;
    }

    .dropbtn-user {
        background: none;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 1.3em;
    }

    .dropdown-login {
        display: none;
        position: absolute;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .navbar .dropdown-user .dropdown-login a {
        background-color: rgb(40, 37, 37);
        color: white;
        text-decoration: none;
        font-size: 1.2em;
    }

    .dropdown-login a:hover {
        background-color: #3d2121;
    }

    .dropdown-user:hover .dropdown-login {
        display: flex;
    }

    .logo a {
        text-decoration: none;
        color: white;
    }

    .cart a {
        color: white;
    }

    .cart {
        margin: 5px 20px;
        font-size: 20px;
    }

    .btn-icon {
        margin: 5px 40px 0px 0px;
        display: flex;
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
            <div class="logo"><a href="home.php">VINEGAER</a></div>
            <div class="spacing"></div>
            <div class="button">
                <ul>
                    <li><a href="about.php">about</a></li>
                    <li class="dropdown">
                        <a href="meal_user.php" class="dropbtn">meals</a>
                        <div class="dropdown-content">
                            <a href="#" data-meal="lunch">lunch</a>
                            <a href="#" data-meal="regular">Regular</a>
                            <a href="#" data-meal="snacks">snacks</a>
                            <a href="#" data-meal="dessert">dessert</a>
                            <a href="#" data-meal="beverages">beverages</a>
                        </div>
                    </li>
                    <li><a href="gallery_user.php">gallery</a></li>
                    <li><a href="awards.php">awards</a></li>
                    <li><a href="recipe.php">recipe of the month</a></li>
                    <li><a href="feedback.php">feedback</a></li>

                </ul>
            </div>
            <div class="btn-icon">
                <div class="cart"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></div>
                <div class="dropdown-user">
                    <button class="dropbtn-user"><i class="fa-solid fa-user"></i></button>
                    <div class="dropdown-login">
                        <a href="login.php" id="loginBtn">Login</a>
                        <a href="logout.php" id="logoutBtn">Logout</a>
                    </div>
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

</html>l