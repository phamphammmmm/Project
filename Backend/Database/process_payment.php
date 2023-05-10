<?php
require_once 'connect.php';
// include 'header.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy thông tin người dùng và đơn hàng từ form
    $customer_name = $_POST['name'];
    $phone_order = $_POST['phone'];
    $address_order = $_POST['address'];
    $card_number = $_POST['card_number'];
    $expiration_date = $_POST['expiration_date'];
    $cvv = $_POST['cvv'];

    $selected_items = isset($_POST['selected_items']) ? $_POST['selected_items'] : [];
    $selected_items = is_array($selected_items) ? $selected_items : explode(',', $selected_items);
    

    var_dump($selected_items);

    $totalPrice = isset($_POST['total_price']) ? $_POST['total_price'] : 0;

    $customer_id = $_SESSION['customer_id'];
    // Tạo đơn hàng mới
    $order_id = uniqid($_SESSION['customer_id'] . $_SERVER['REMOTE_ADDR']);
    $order_date = date('Y-m-d');
    $timezone = date_default_timezone_get();
    date_default_timezone_set($timezone);
    $order_time = date('H:i:s');
    

    // Lưu thông tin đơn hàng vào bảng orders
    $stmt = mysqli_prepare($conn, "INSERT INTO orders (customer_id, order_date, order_time, customer_name, phone_order, address) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssss", $customer_id, $order_date, $order_time, $customer_name, $phone_order, $address_order);    
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_errno($stmt)) {
        echo "Lỗi: " . mysqli_stmt_error($stmt);
    }

    $item_name=[]; 
    // Lưu thông tin chi tiết đơn hàng vào bảng order_detail
    foreach ($selected_items as $cart_id) {
        $stmt2 = mysqli_prepare($conn, "SELECT cart.*, meals.item_name, meals.meal_id
        FROM cart
        INNER JOIN meals ON cart.meal_id = meals.meal_id
        WHERE cart.cart_id = ?");
        mysqli_stmt_bind_param($stmt2, "i", $cart_id);
        mysqli_stmt_execute($stmt2);
        $result = mysqli_stmt_get_result($stmt2);
        $item = mysqli_fetch_assoc($result);

        $meal_id = $item['meal_id'];
        $quantity = $item['quantity'];
        $item_name = $item['item_name'];
        $item_names[] = $item_name; 
        $price = $item['price'] * $quantity;
    }
        $item_name = implode(', ', $item_names); // Chuyển đổi mảng thành chuỗi

        var_dump($item_name);
        $stmt3 = mysqli_prepare($conn, "INSERT INTO order_detail (order_id, meal_id, quantity, item_name, price) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt3, "siids", $order_id, $meal_id, $quantity, $item_name, $price);
        mysqli_stmt_execute($stmt3);

        if (mysqli_stmt_errno($stmt3)) {
            echo "Lỗi: " . mysqli_stmt_error($stmt3);
        }
        echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo '<br>';    


    // Hiển thị thông báo thành công và chuyển hướng
    echo '
    <script>
    $(document).ready(function() {
        Swal.fire({
            title: "Đơn hàng '.$name.'mua đã được đặt thành công!",
            icon: "success",
            timer: 1000, // Thời gian hiển thị thông báo (1 giây)
            showConfirmButton: false
        }).then(function() {
            window.location.href = "bill.php?order_id=' . $order_id . '";
        });
    });
    </script>';

    // Remove the items from the cart
    foreach ($selected_items as $cart_id) {
        $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE cart_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $cart_id);
        mysqli_stmt_execute($stmt);
    }

    // Redirect to the "bill.php" page
    header("Location: bill.php?order_id=" . $order_id);
    exit();

}
?>
<!DOCTYPE html>
<html>

<head>
    <title>éc éc</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
</head>

<body>
</body>

</html>