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
    .dropdown-content {
        display: none;
    }

    .dropdown:hover .dropdown-content {
        display: block;
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
                    <a href="#">login</a>
                    <a href="#">Register</a>
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
            showMeal(meals.php);
        });
    }

    // Hàm hiển thị phần tương ứng trên trang "Meal"
    function showMeal(meals.php) {
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
    </script>

</body>

</html>