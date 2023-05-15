<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

//khai báo biến là rỗng trước khi gán để biến không bị gán giá trị thừa
$item_name = "";
$image_path="";
$item_description="";
$price_item="";

    if (isset($_POST['save'])) {
        $item_name = $_POST['item_name'];
        $image_path = $_FILES['image_path']['name'];
        $item_description = mysqli_real_escape_string($conn,($_POST['item_description']));
        $price_item=$_POST['price_item'];
        $last_modified = date('Y-m-d H:i:s');

        // Upload file ảnh vào thư mục /uploads
        $target_dir = "uploads";
        $target_file = $target_dir.'/' . basename($_FILES["image_path"]["name"]);
        move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file);

        // Thực hiện truy vấn insert dữ liệu vào bảng gallery
        $sql = "INSERT INTO gallery (item_name, image_path, item_description, price_item, last_modified) VALUES ('$item_name', '$image_path', '$item_description', '$price_item','$last_modified')";
        mysqli_query($conn, $sql);
        
        // Chuyển hướng trở về trang gallery.php sau khi lưu thành công
        header("Location: gallery.php");
        exit();
    }


?>

<!DOCTYPE html>
<html>

<head>
    <title>Gallery Form</title>
    <style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input,
    textarea {
        margin: 10px;
        padding: 5px;
        width: 300px;
        border-radius: 5px;
        border: none;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    button {
        margin: 10px;
        padding: 5px;
        border-radius: 5px;
        border: none;
        background-color: #4CAF50;
        color: white;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    h1 {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    form {
        border: 2px solid black;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px 40px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <?php
    include 'admin.php';
    ?>
    <h1>Gallery Form</h1>
    <form method="POST" enctype="multipart/form-data">
        <!-- Các trường nhập liệu -->
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" value="<?php echo $item_name ?>">

        <label for="image_path">Image Path:</label>
        <input type="file" name="image_path">

        <label for="price_item">Price Item:</label>
        <input type="text" name="price_item" value="<?php echo $price_item ?>">

        <label for="item_description">Item Description:</label>
        <textarea name="item_description"><?php echo $item_description ?></textarea>

        <button type="submit" name="save">Save</button>
    </form>
</body>

</html>