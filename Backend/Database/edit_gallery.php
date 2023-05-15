<?php
require_once 'connect.php';
mysqli_select_db($conn, "restaurant");

if ( isset($_GET['id']) && !empty($_GET['id'])) {
$id = $_GET['id'];

//Lấy thông tin của hình ảnh có id được truyền vào
$sql = "SELECT * FROM gallery WHERE image_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
}

// Defined variables for form data
$image_name = "";
$image_description = "";
$last_modified = "";
$price_item="";

// Kiểm tra xem có nút "Save" được nhấn không
if (isset($_POST['save'])) {
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $price_item=$_POST['price_item'];
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
    $sql = "UPDATE gallery SET item_name = '$item_name', item_description = '$item_description',price_item='$price_item', last_modified = '$last_modified' WHERE image_id = $id";
    mysqli_query($conn, $sql);
    
     // Close the connection to the MySQL server
     $conn->close();

    // Chuyển hướng về trang danh sách gallery
    header("Location: Gallery.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa gallery</title>
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

    table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    </style>
</head>

<body>
    <?php
    include 'admin.php';
    ?>
    <!-- HTML form for editing the product information -->
    <form method="POST" action="edit_gallery.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" value="<?php echo $row['item_name']; ?>"><br>

        <label for="image_path">Image Path:</label>
        <input type="file" name="image_path"><br>

        <label for="price_item">Price Item:</label>
        <input type="text" name="price_item" value="<?php echo $row['price_item']; ?>"><br>

        <label for="item_description">Image Description:</label>
        <textarea name="item_description"><?php echo $row['item_description']; ?></textarea><br>

        <input type="submit" name="save" value="Save">
    </form>
</body>

</html>