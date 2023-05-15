<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Xóa bản ghi trong bảng `order_detail` liên quan đến order cần xóa
    $deleteOrderDetailSql = "DELETE FROM order_detail WHERE order_id = '$order_id'";
    $conn->query($deleteOrderDetailSql);

    // Xóa order từ cơ sở dữ liệu
    $deleteSql = "DELETE FROM orders WHERE order_id = '$order_id'";
    if ($conn->query($deleteSql) === TRUE) {
        $message = "Order deleted successfully.";
        header('Location: order_admin.php');
        exit();
    } else {
        $message = "Error deleting order: " . $conn->error;
    }
} else {
    $message = "Invalid order ID.";
}

echo $message;
?>