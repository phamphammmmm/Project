<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

// Lấy dữ liệu từ bảng gallery
$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);
$gallery = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gallery</title>
    <style>
    /* CSS cho giao diện hiển thị ảnh */
    .gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .gallery-item {
        margin: 10px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        max-width: 300px;
    }

    .gallery-item img {
        width: 100%;
        height: auto;
    }

    .gallery-item h3 {
        text-align: center;
        margin: 0;
        padding: 10px;
        background-color: #eee;
        font-size: 18px;
        font-weight: normal;
    }

    .gallery-item h5 {
        text-align: center;
        margin: 10px;
        font-size: 14px;
        line-height: 1.4;
    }

    .gallery-item button {
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

    .gallery-item button:hover {
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

    @media (min-width: 992px) {
        .gallery-item {
            width: 33.33%;
        }
    }

    @media (min-width: 1200px) {
        .gallery-item {
            width: 25%;
        }
    }
    </style>
</head>

<body>
    <?php
    include 'header.php';
?>
    <h1>Gallery</h1>
    <div class="gallery">
        <?php foreach ($gallery as $row) { ?>
        <div class="gallery-item">
            <img src="uploads/<?php echo $row['image_path'] ?>" alt="<?php echo $row['item_name'] ?>">
            <h3><?php echo $row['item_name'] ?></h3>
            <h5><?php echo $row['item_description'] ?></h5>
            <h5><?php echo number_format($row['price_item'], 0, '.', ',') . " VND" ?><h5>
                    <button>VIEW</button>
        </div>
        <?php } ?>

    </div>
</body>

</html>