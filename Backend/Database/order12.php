<?php
require_once 'connect.php';

// Lấy dữ liệu từ bảng đơn hàng
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);

// Hiển thị dữ liệu trên giao diện admin
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row["id"] . " - Tên khách hàng: " . $row["customer_name"] . " - Số điện thoại: " . $row["phone"] . "<br>";
}
// Xử lý submit form xem chi tiết đơn hàng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // Lấy thông tin đơn hàng từ cơ sở dữ liệu
    $sql = "SELECT * FROM orders WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Hiển thị chi tiết đơn hàng trên giao diện admin
    echo "ID đơn hàng: " . $row["id"] . "<br>";
    echo "Tên khách hàng: " . $row["customer_name"] . "<br>";
    echo "Số điện thoại: " . $row["phone"] . "<br>";
    echo "Địa chỉ: " . $row["address"] . "<br>";

    // Hiển thị chi tiết sản phẩm trong đơn hàng

}

// Xử lý submit form quản lí đơn hàng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);

    // Cập nhật trạng thái đơn hàng vào cơ sở dữ liệu
    $sql = "UPDATE orders SET status='$status' WHERE id=$id";
    mysqli_query($conn, $sql);
}

// Thống kê số lượng người dùng
$sql = "SELECT COUNT(*) as count FROM users";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Số lượng người dùng: " . $row["count"] . "<br>";

// Thống kê số lượng đơn hàng
$sql = "SELECT COUNT(*) as count FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Số lượng đơn hàng: " . $row["count"] . "<br>";

// Thống kê tổng giá trị đơn hàng
$sql = "SELECT SUM(total_price) as total FROM orders";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo "Tổng giá trị đơn hàng: " . $row["total"] . "<br>";

// Thống kê số lượng đơn hàng theo trạng thái
$sql = "SELECT status, COUNT(*) as count FROM orders GROUP BY status";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo "Trạng thái " . $row["status"] . ": " . $row["count"] . "<br>";
}