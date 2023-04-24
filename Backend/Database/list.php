<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('Location:index1.php');
    exit();
}

require '../db/db.php';
mysqli_select_db($conn, "restaurant");

$sql = "SELECT Categories.category_id, Categories.category_name,Products.product_id, Products.name_sp, Products.price, Products.discount, Products.img, Products.description, Galery.img2
        FROM Categories
        INNER JOIN Products ON Categories.category_id = Products.category_id
        INNER JOIN Galery ON Galery.product_id = Products.product_id";

$result = $conn->query($sql);
$list_cater = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $list_cater[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List sản phẩm</title>
</head>

<body>
    <style>
    .ha1 {
        border-right: solid 1px black;
    }
    </style>
    <?php if (!empty($list_cater)) : ?>
    <div style="display: flex; gap: 3px;">
        <div>
            <div class="ha1">STT</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div>{$value['product_id']}</div> ";
                } ?>
        </div>

        <div>
            <div class="ha1">Tên danh mục</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div value='{$value['category_id']}'>{$value['category_name']}</div> ";
                } ?>
        </div>

        <div>
            <div class="ha1">Tên SP</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div>{$value['name_sp']}</div> ";
                } ?>
        </div>

        <div>
            <div class="ha1">Ảnh SP</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div><img src='{$value['img']}' alt='{$value['name_sp']}' width='100px'></div>";
                } ?>
        </div>

        <div>
            <div class="ha1">Ảnh chi tiết SP</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div><img src='{$value['img2']}' alt='{$value['name_sp']}' width='100px'></div>";
                } ?>
        </div>

        <div>
            <div class="ha1">Giá nhập vào</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div>{$value['price']}</div> ";
                } ?>
        </div>
        <div>
            <div class="ha1">Giá bán</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div>{$value['discount']}</div> ";
                } ?>
        </div>

        <div>
            <div>Chi tiết mô tả sản phẩm</div>
            <?php foreach ($list_cater as $value) {
                    echo "<div>{$value['description']}</div> ";
                } ?>
        </div>
        <div>
            <div><a href="products.php">chuyển sang thêm thông tim sp</a></div>
            <div><a href="add_Categories.php">chuyển sang trang thêm mục sản phẩm</a></div>

            <div><a href="login_out.php">đăng xuất</a></div>
        </div>

    </div>
    <?php else : ?>
    <p>Không có sản phẩm nào.</p>
    <?php endif; ?>
</body>

</html>