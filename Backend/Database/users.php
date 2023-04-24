<?php
require_once 'connect.php';

// Lấy dữ liệu từ bảng người dùng
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Hiển thị dữ liệu trên giao diện admin
while ($row = mysqli_fetch_assoc($result)) {
    echo "ID: " . $row["id"] . " - Tên: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
}

// Xử lý submit form thêm người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Thêm người dùng vào cơ sở dữ liệu
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $sql);
}

// Xử lý submit form sửa người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Cập nhật thông tin người dùng vào cơ sở dữ liệu
$sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$id";
mysqli_query($conn, $sql);
}

// Xử lý submit form xóa người dùng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);

    // Xóa người dùng khỏi cơ sở dữ liệu
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($conn, $sql);
}

///
// Xử lý submit form tìm kiếm người dùng
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

    // Tìm kiếm người dùng theo từ khóa
    $sql = "SELECT * FROM users WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);
}

// Xử lý submit form sắp xếp người dùng
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $orderby = mysqli_real_escape_string($conn, $_GET["orderby"]);
    $order = mysqli_real_escape_string($conn, $_GET["order"]);

    // Sắp xếp danh sách người dùng
    $sql = "SELECT * FROM users ORDER BY $orderby $order";
    $result = mysqli_query($conn, $sql);
}
?>
<form method="GET" action="">
    <label for="orderby">Sắp xếp theo:</label>
    <select name="orderby" id="orderby">
        <option value="name">Tên</option>
        <option value="email">Email</option>
        <option value="register_date">Ngày đăng ký</option>
    </select>
    <label for="order">Thứ tự:</label>
    <select name="order" id="order">
        <option value="ASC">Tăng dần</option>
        <option value="DESC">Giảm dần</option>
    </select>
    <button type="submit">Sắp xếp</button>
</form>