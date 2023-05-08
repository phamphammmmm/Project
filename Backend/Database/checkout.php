<?php
require_once 'connect.php';
include 'header.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : '';
    $selected_items = is_string($selected_items) ? explode(',', $selected_items) : [];

    // Hiển thị thông tin sản phẩm dựa trên cart_id
    echo '<table class="product">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
            
    foreach ($selected_items as $cart_id) {
        $stmt = mysqli_prepare($conn, "SELECT cart.*, meals.item_name, gallery.image_path, gallery.item_description 
        FROM cart
        INNER JOIN meals ON cart.meal_id = meals.meal_id
        INNER JOIN gallery ON meals.item_name = gallery.item_name
        WHERE cart.cart_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cart_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($result);

        // Hiển thị thông tin sản phẩm
        
        echo '<tr>
                <td><img src="uploads/' . $item['image_path'] . '" alt="' . $item['item_name'] . '"></td>
                <td>' . $item['item_name'] . '</td>
                <td>' . $item['item_description'] . '</td>
                <td>' . $item['price'] . '</td>
                <td>' . $item['quantity'] . '</td>
                <td>' . ($item['price'] * $item['quantity']) . '</td>
            </tr>';
}

echo '</tbody></table>';
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
    <style>
    /* Thiết lập các kiểu cho form */
    /* Thiết lập các kiểu cho form */
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"] {
        width: 95%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Thiết lập kiểu cho các sản phẩm */
    body {
        margin-top: 100px;
    }

    .product {
        margin-bottom: 20px;
    }

    .product img {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    .product .name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product .description {
        margin-bottom: 5px;
    }

    .product .price {
        font-weight: bold;
    }
    </style>
</head>

<body>

    <!-- Form thanh toán -->
    <form method="POST" action="process_payment.php">
        <!-- Các trường thông tin người dùng -->
        <label for="name">Họ tên:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Số điện thoại:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="address">Địa chỉ:</label>
        <input type="text" name="address" id="address" required>

        <!-- Các trường thông tin thanh toán-->
        <label for="card_number">Số thẻ:</label>
        <input type="text" name="card_number" id="card_number" required>

        <label for="expiration_date">Ngày hết hạn:</label>
        <input type="text" name="expiration_date" id="expiration_date" required>

        <label for="cvv">CVV:</label>
        <input type="text" name="cvv" id="cvv" required>

        <!-- Các trường ẩn chứa thông tin đơn hàng đã chọn -->
        <?php
    if (isset($_POST['selected_items']) && !empty($_POST['selected_items'])) {
        $selected_items = $_POST['selected_items'];
        foreach ($selected_items as $itemId) {
            echo '<input type="hidden" name="selected_items[]" value="' . $itemId . '">';
        }
    }
?>

        <button type="submit">Order Now</button>
    </form>
</body>


</html>