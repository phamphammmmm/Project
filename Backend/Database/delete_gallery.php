<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin ảnh từ cơ sở dữ liệu
    $query = "SELECT * FROM gallery WHERE image_id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image_path'];

    // Xóa dữ liệu trong cơ sở dữ liệu
    $sql = "DELETE FROM gallery WHERE image_id = $id";
    mysqli_query($conn, $sql);

    // Xóa file ảnh trong thư mục uploads
    $target_dir = "uploads/";
    $target_file = $target_dir . $image_path;
    if (file_exists($target_file)) {
        unlink($target_file);
    }

    // Cập nhật lại các giá trị image_id trong cơ sở dữ liệu
    mysqli_query($conn, "SET @num := 0;");
    mysqli_query($conn, "UPDATE gallery SET image_id = @num := (@num+1);");
    mysqli_query($conn, "ALTER TABLE gallery AUTO_INCREMENT = 1;");

    // Chuyển hướng về trang gallery
    header("Location: gallery.php");
    exit();
} else {
    // Nếu không có id được truyền vào, chuyển hướng về trang gallery
    header("Location: gallery.php");
    exit();
}
?>