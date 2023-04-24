<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if (!isset($_GET['id'])) {
    echo "Invalid request";
    exit;
}

$id = $_GET['id'];

// Lấy thông tin của hình ảnh có id được truyền vào
$sql = "SELECT * FROM gallery WHERE image_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kiểm tra xem có nút "Save" được nhấn không
if (isset($_POST['save'])) {
    $image_name = $_POST['image_name'];
    $image_description = $_POST['image_description'];
    $last_modified = date('Y-m-d H:i:s');

    if ($_FILES['image_path']['size'] > 0) {
        // Nếu người dùng chọn ảnh mới, upload ảnh đó lên và cập nhật đường dẫn của ảnh trong cơ sở dữ liệu
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image_path"]["name"]);
        move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file);
        $image_path = $_FILES['image_path']['name'];
        $sql = "UPDATE gallery SET image_path = '$image_path' WHERE image_id = $id";
        mysqli_query($conn, $sql);
    }

    // Cập nhật thông tin của hình ảnh trong cơ sở dữ liệu
    $sql = "UPDATE gallery SET image_name = '$image_name', image_description = '$image_description', last_modified = '$last_modified' WHERE image_id = $id";
    mysqli_query($conn, $sql);

    // Chuyển hướng về trang danh sách gallery
    header("Location: Gallery.php");
    exit;
}
?>