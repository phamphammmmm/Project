<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

// kiểm tra xem id có được truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin bức ảnh dựa trên id
    $query = "SELECT image_path FROM gallery WHERE image_id = '$id'";
    $result = mysqli_query($conn, $query);
    $image = mysqli_fetch_assoc($result);
    $image_path = $image['image_path'];

    // Xóa bức ảnh khỏi thư mục uploads
    unlink("uploads/" . $image_path);

    // Thực hiện truy vấn delete dữ liệu từ bảng gallery
    $sql = "DELETE FROM gallery WHERE image_id = '$id'";
    mysqli_query($conn, $sql);

    // Chuyển hướng về trang quản trị gallery
    header("Location: gallery.php");
    exit();
}
?>