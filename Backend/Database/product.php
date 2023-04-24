<?php
require_once 'connect.php';

// Kiểm tra xem tên ảnh có rỗng hay không
if (empty($_POST['image_name'])) {
    echo "Vui lòng nhập tên ảnh";
    exit();
}

// Kiểm tra định dạng hình ảnh
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
$extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
if (!in_array($extension, $allowed_extensions)) {
    echo "Định dạng hình ảnh không hợp lệ";
    exit();
}

$target_dir = "/var/www/html/Project/image"; // Đường dẫn đến thư mục lưu trữ hình ảnh
$target_file = $target_dir . '/' . basename($_FILES['image_file']['name']);

// Kiểm tra lỗi upload
if ($_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
    echo "Lỗi khi tải lên hình ảnh";
    exit();
}

// Di chuyển hình ảnh vào thư mục lưu trữ
if (!move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
    echo "Lỗi khi lưu trữ hình ảnh";
    exit();
}

// Thêm mới hình ảnh vào cơ sở dữ liệu
$sql = "INSERT INTO gallery (image_name, image_path, image_description) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST['image_name'], $target_file, $_POST['image_description']);
if ($stmt->execute()) {
    echo "Thêm mới hình ảnh thành công";
} else {
    echo "Lỗi khi thêm mới hình ảnh: " . $conn->error;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <form method="post" action="upload.php" enctype="multipart/form-data">
        <label for="image_name">Tên ảnh:</label>
        <input type="text" name="image_name" id="image_name"><br><br>

        <label for="image_file">Tải lên ảnh:</label>
        <input type="file" name="image_file" id="image_file"><br><br>

        <label for="image_description">Mô tả:</label>
        <textarea name="image_description" id="image_description"></textarea><br><br>

        <input type="submit" name="submit" value="Tải lên">
    </form>

</body>

</html>