<?php
require_once 'connect.php';
mysqli_select_db($conn, 'restaurant');
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['order_id'])) {
    header("Location: index.php");
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
    /* ... */
    </style>
</head>

<body>
    <h1>Bill</h1>
    <h2>Mã đơn hàng: <?php echo $order['order_id']; ?></h2>
    <p>Ngày đặt hàng: <?php echo $order['order_date']; ?></p>
    <p>Thời gian đặt hàng: <?php echo $order['order_time']; ?></p>

    <h3>Thông tin khách hàng</h3>
    <p>Tên: <?php echo $order['name']; ?></p>
    <p>Số điện thoại: <?php echo $order['phone']; ?></p>
    <p>Địa chỉ: <?php echo $order['address']; ?></p>

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

    <h3>Tổng số tiền: <?php echo $order['total_price']; ?></h3>

    <p>Cảm ơn bạn đã mua hàng!</p>
    <p>Xin vui lòng giữ lại bill này cho mục đích bảo hành.</p>
</body>

</html>