<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if (isset($_GET['cart_id'])) {
    $order_cart_idid = $_GET['cart_id'];

    // Xóa order từ cơ sở dữ liệu
    $Sql = "DELETE FROM  cart WHERE cart_id = '$cart_id'";
    if ($conn->query($Sql) === TRUE) {
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