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
    // Lấy thông tin người dùng và đơn hàng từ form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $card_number = $_POST['card_number'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];
    $selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : '';
    $selected_items = is_string($selected_items) ? explode(',', $selected_items) : [];

    // Tạo đơn hàng mới
    $order_id = uniqid(); // Tạo order_id duy nhất
    $order_date = date('Y-m-d');
    $order_time = date('H:i:s');

    // Lưu thông tin đơn hàng vào bảng orders
    $stmt = mysqli_prepare($conn, "INSERT INTO orders (order_id, customer_id, order_date, order_time) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $order_id, $customer_id, $order_date, $order_time);
    mysqli_stmt_execute($stmt);

    // Lưu thông tin chi tiết đơn hàng vào bảng order_detail
    foreach ($selected_items as $cart_id) {
        $stmt = mysqli_prepare($conn, "SELECT cart.*, meals.item_name, meals.price 
        FROM cart
        INNER JOIN meals ON cart.meal_id = meals.meal_id
        WHERE cart.cart_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cart_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($result);

        $meal_id = $item['meal_id'];
        $quantity = $item['quantity'];
        $item_name = $item['item_name'];
        $price = $item['price'];

        $stmt = mysqli_prepare($conn, "INSERT INTO order_detail (order_id, meal_id, quantity, item_name, price) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "siids", $order_id, $meal_id, $quantity, $item_name, $price);
        mysqli_stmt_execute($stmt);
    }

    // Sau khi đã lưu đơn hàng thành công, bạn có thể thực hiện các thao tác tiếp theo, như hiển thị thông báo hoặc chuyển hướng người dùng đến trang cảm ơn.

    // Ví dụ: Hiển thị thông báo thành công và chuyển hướng
    echo '<p>Đơn hàng của bạn đã được đặt thành công!</p>';
    echo '<p>Cảm ơn bạn đã mua hàng!</p>';
    echo '<p>Mã đơn hàng của bạn: ' . $order_id . '</p>';
    echo '<p>Tổng số tiền: ' . $totalPrice . '</p>';

    // Sau khi hiển thị thông báo, bạn có thể xóa các sản phẩm trong giỏ hàng của người dùng, hoặc thực hiện các thao tác khác.

    // Ví dụ: Xóa các sản phẩm đã được đặt từ giỏ hàng
    foreach ($selected_items as $cart_id) {
        $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE cart_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cart_id);
        mysqli_stmt_execute($stmt);
    }
}