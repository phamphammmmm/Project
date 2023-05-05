<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

// Lấy dữ liệu từ bảng meals
$query = "SELECT * FROM meals";
$result = mysqli_query($conn, $query);
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Meal</title>
    <style>
    /* CSS cho giao diện hiển thị món ăn */
    .meal {
        flex-wrap: wrap;
        justify-content: center;
    }

    .meal-item {
        margin: 40px 10px;
        padding: 10px;
        text-align: center;
        border: 1px solid #ccc;
    }

    .meal-item ul {
        display: flex;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .meal-item li {
        display: inline-block;
        margin: 5px;
        padding: 5px;
        border: 1px solid #ccc;
    }

    .meal-item img {
        width: 100%;
        height: auto;
    }

    .meal-item h3 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .meal-item h4 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .meal-item h5 {
        text-align: center;
        margin: 10px;
        font-size: 14px;
        line-height: 1.4;
    }

    .meal-item button {
        display: block;
        margin: 10px auto;
        padding: 10px 20px;
        border: none;
        background-color: #2ecc71;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
    }

    .meal-item button:hover {
        background-color: #27ae60;
    }

    @media (min-width: 768px) {
        .col-sm-6 {
            flex-basis: 50%;
        }

        .col-md-4 {
            flex-basis: 33.33%;
        }

        .col-lg-3 {
            flex-basis: 25%;

        }
    }

    @media (min-width: 1200px) {
        .meal-item {
            width: 25%;
        }
    }
    </style>
</head>

<body>
    <h1>Meal</h1>
    <div class="meal">
        <?php
        // Danh sách các tên bữa ăn
        $meal_names = array("lunch", "regular","Snacks","Desert","Beverages");

        // Lặp qua các tên bữa ăn
        foreach ($meal_names as $meal_name) {
        ?>
        <div class="meal-item">
            <h3><?php echo ucfirst($meal_name) ?></h3>
            <?php 
                // Lấy danh sách các món ăn tương ứng với bữa ăn hiện tại
                $query = "SELECT * FROM meals WHERE meal_name = '".$meal_name."'";
                $result = mysqli_query($conn, $query);
                $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <ul>
                <?php foreach ($items as $item) { ?>
                <?php 
                        // Lấy danh sách các ảnh tương ứng với món ăn hiện tại
                        $query = "SELECT * FROM gallery WHERE item_name = '".$item['item_name']."'";
                        $result = mysqli_query($conn, $query);
                        $gallerys = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    ?>
                <li>

                    <?php foreach ($gallerys as $gallery) { ?>
                    <img src="uploads/<?php echo $gallery['image_path'] ?>" alt="" width="100">
                    <?php } ?>
                    <h4><?php echo $item['item_name'] ?></h4>
                    <p><?php echo $gallery['item_description'] ?></p>
                    <p><?php echo number_format($gallery['price_item'], 0, '.', ',') . " VND" ?></p>
                    <button>VIEW</button>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php } ?>
    </div>

</body>