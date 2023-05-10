<?php
require_once 'connect.php';
include 'header.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    header("Location: meal_user.php");
    exit();
}

$order_id = $_GET['order_id'];

// Truy vấn thông tin đơn hàng từ bảng orders và order_detail
$stmt = mysqli_prepare($conn, "SELECT * FROM orders WHERE order_id = ?");
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$orderResult = mysqli_stmt_get_result($stmt);
$order = mysqli_fetch_assoc($orderResult);

$stmt = mysqli_prepare($conn, "SELECT * FROM order_detail WHERE order_id = ?");
mysqli_stmt_bind_param($stmt, "s", $order_id);
mysqli_stmt_execute($stmt);
$orderDetailResult = mysqli_stmt_get_result($stmt);

// Hiển thị thông tin đơn hàng và in ra bill
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bill</title>
    <style>
    /* CSS cho bill */
    body {
        margin-top: 78px;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        font-size: 14px;
        line-height: 1.5;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f7f7f7;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-top: 0;
    }

    h2,
    h3 {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    h3:last-child {
        margin-bottom: 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bill</h1>
        <h2>Mã đơn hàng: <?php echo $order['order_id']; ?></h2>
        <p>Ngày đặt hàng: <?php echo $order['order_date']; ?></p>
        <p>Thời gian đặt hàng: <?php echo $order['order_time']; ?></p>

        <h3>Thông tin khách hàng</h3>
        <p>Tên: <?php echo isset($order['customer_name']) ? $order['customer_name'] : ''; ?></p>
        <p>Số điện thoại: <?php echo isset($order['phone_order']) ? $order['phone_order'] : ''; ?></p>
        <p>Địa chỉ: <?php echo isset($order['address']) ? $order['address'] : ''; ?></p>

        <h3>Chi tiết đơn hàng</h3>
        <table>
            <thead>
                <tr>
                    <th>Tên món</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($orderDetailResult)) : ?>
                <tr>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo $item['price']; ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h3>Tổng số tiền: <?php echo isset($order['total_price']) ? $order['total_price'] : ''; ?></h3>

        <p>Cảm ơn bạn đã mua hàng!</p>
        <p>Xin vui lòng giữ lại bill này cho mục đích bảo hành.</p>
    </div>
</body>

</html>