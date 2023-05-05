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
        $item_description = mysqli_real_escape_string($conn, $_POST['item_description']);
        $price_item=$_POST['price_item'];
        $last_modified = date('Y-m-d H:i:s');

        // Upload file ảnh vào thư mục /uploads
        $target_dir = "uploads";
        $target_file = $target_dir.'/' . basename($_FILES["image_path"]["name"]);
        move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file);

        // Thực hiện truy vấn insert dữ liệu vào bảng gallery
        $sql = "INSERT INTO gallery (item_name, image_path, item_description, price_item, last_modified) VALUES ('$item_name', '$image_path', '$item_description', '$price_item','$last_modified')";
        mysqli_query($conn, $sql);
    }

    // Lấy dữ liệu từ bảng gallery
    $query = "SELECT * FROM gallery";
    $result = mysqli_query($conn, $query);
    $gallery = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <h1>Gallery Form</h1>
    <<form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="image_id" value="<?php echo $image_id ?>">
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
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Last Modified</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gallery as $row) { ?>
                <tr>
                    <td><?php echo $row['image_id'] ?></td>
                    <td><?php echo $row['item_name'] ?></td>
                    <td><?php echo $row['image_path'] ?></td>
                    <td><?php echo $row['item_description'] ?></td>
                    <td><?php echo number_format($row['price_item'], 0, '.', ',') . " VND" ?></td>
                    <td><?php echo $row['last_modified'] ?></td>
                    <td>
                        <a href="edit_gallery.php?id=<?php echo $row['image_id'] ?>">Edit</a>
                        <a href="delete_gallery.php?id=<?php echo $row['image_id'] ?>"
                            onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
</body>

</html>